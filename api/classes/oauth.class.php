<?php

	class Oauth {

		public 	$client_id,
				$client_secret,
				$redirect_uri,
				$auth_uri;


		function __get($var) {
			if ($this->$var) {
				return $this->$var;
			}
		}

		function __isset($var) { 
			if ($this->$var) {
				return TRUE; 
			}
			return FALSE; 
		}

		function __construct($input) {

			// tvätta input
			$clear_input = DB::clean($input);

			echo '<pre>';
				var_dump($clear_input);
			echo '</pre>';
			die;

			// hämta token etc baserat på namn ($input['name'])
			$credentials = self::get_from_db($clear_input['name']);

			// om svars-url vid auktorisering svarar med ett ?error så visa det och avbryt
			if(isset($clear_input['error'])) {
		
				echo $clear_input['error'] . ': ' . $clear_input['error_description'];
				die;
		
			}

			// om svars-url vid auktorisering svarar med en auth-kod ?code
			elseif(isset($clear_input['code'])) {
			
				if($credentials['state'] == $clear_input['state']) {
					// Get token so you can make API calls
					$credentials = self::get_token($clear_input);
				} else {
					// CSRF attack? Or did you mix up your states?
					die('CSRF-prevention');
				}
	
			} 

			else {

				if(empty($credentials)) {

					$credentials = self::create_db($clear_input['name']);

				}

				if(!empty($credentials) && $credentials['expires_at'] < time()) {

				 	$credentials = self::reset($clear_input['name']);

				}

				if($credentials['access_token'] == '' && $credentials['state'] == '') {
			
				 	self::get_authorization($data);
			
				}

			}

		}

		private static function get_authorization($data) {

			$params = [
				'response_type' => 'code',
				'client_id' 	=> $data['client_id'],
				'redirect_uri' 	=> $data['redirect_uri'],
				'state' 		=> uniqid('', true),
				'scope' 		=> $data['scope']
			];

			$url = 'https://www.linkedin.com/oauth/v2/authorization?'.http_build_query($params);

			$data = [
				'state' => $params['state']
			];

			self::update_db($data);
			
			header('Location: '.$url);

		}

		static public function get_token($data) {

			$new_credentials = self::get_from_db();

			$postdata = [
				'grant_type' 	=> 'authorization_code',
				'code' 			=> $data['code'],
				'redirect_uri' 	=> REDIRECT_URI,
				'client_id' 	=> CLIENT_ID,
				'client_secret' => CLIENT_KEY
			];

			$token = Curl::get('https://www.linkedin.com/oauth/v2/accessToken', true, 'post', $postdata);

			$data = [
				'access_token' 	=> $token->access_token,
				'expires_in' 	=> $token->expires_in,
				'expires_at'	=> time() + $token->expires_in
			];

			self::update_db($data);

			$new_credentials['access_token'] = $token->access_token;
			$new_credentials['expires_in'] = $token->expires_in;
			$new_credentials['expires_at'] = time() + $token->expires_in;
			return $new_credentials;

		}

		public static function reset($name) {

			$clear_data = [
				'name' 			=> $name,
				'state' 		=> '',
				'access_token' 	=> '',
				'expires_in' 	=> 0,
				'expires_at'	=> 0
			];

			self::update_db($clear_data);

		}

		private static function get_from_db($name) {

			$clean_name = DB::clean($name);

			$sql = 'SELECT * FROM tokens WHERE name = "'.$clean_name.'" LIMIT 1';
			$data = DB::query($sql, true);

			return $data;

		}

		private static function create_db($name) {

			$clean_name = DB::clean($name);

			$sql = "INSERT INTO tokens (name, access_token, state, expires_in, expires_at) VALUES (
				'".$clean_name."',
				'', 
				'', 
				0, 
				0
			)";
			DB::query($sql);

			$output = self::get_from_db($clean_name);
			return $output;

		}

		private static function update_db($input) {

			$clean_input = DB::clean($input);

			$string = '';

			foreach($clean_input as $key => $value) {
				if(is_string($value)) {
					$value = '"'.$value.'"';
				}

				$string .= $key.' = '.$value.', ';
			}

			$string = rtrim($string, ', ');

			$sql = 'UPDATE tokens SET '.$string.' WHERE name = "'.$clean_input['name'].'"';
			DB::query($sql);

			$output = self::get_from_db($clean_input['name']);
			return $output;

		}

	}