<?php
	
	$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);

	define('REDIRECT_URI', (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://'.$_SERVER['HTTP_HOST'].$uri_parts[0]);
	define('SCOPE', 'r_basicprofile r_emailaddress rw_company_admin w_share');

	class Linkedin {

		static public function fallback($data) {

			$credentials = self::get_from_db();

			if(isset($data['error'])) {
		
				echo $data['error'] . ': ' . $data['error_description'];
				die;
		
			}

			elseif(isset($data['code'])) {
			
				if($credentials['state'] == $data['state']) {
					// Get token so you can make API calls
					$credentials = self::get_token($data);
				} else {
					// CSRF attack? Or did you mix up your states?
					die;
				}
	
			} 

			else {

				if($credentials['expires_at'] < time()) {

					$credentials = self::reset_linkedin_session();

				}

				if($credentials['access_token'] == '' && $credentials['state'] == '') {
			
					self::get_authorization();
			
				}

			}

			echo '<pre>';
				print_r($credentials);
			echo '</pre>';

		}

		public static function post($data) {

			$credentials = self::get_from_db();

			if(isset($data['error'])) {
		
				echo $data['error'] . ': ' . $data['error_description'];
				die;
		
			}

			elseif(isset($data['code'])) {
			
				if($credentials['state'] == $data['state']) {
					// Get token so you can make API calls
					$credentials = self::get_token($data);
				} else {
					// CSRF attack? Or did you mix up your states?
					die;
				}
	
			}

			else {

				if($credentials['expires_at'] < time()) {

					$credentials = self::reset_linkedin_session();

				}

				if($credentials['access_token'] == '') {
			
					self::get_authorization();
			
				}

			}

			if($credentials['expires_at'] >= time() &&  $credentials['access_token'] != '') {

				$what_post = self::get_what_post();

				$post = Grav::publish_item($what_post);

				$contentArray = [
					'title' => $post['title'],
					'description' => isset($post['description']) ? $post['description'] : $what_post['description'],
					'submitted-url' => 'http://'.ROOT.'/api/leaving/?for='.$post['source'].'&referrer=Linkedin',
					'submitted-image-url' => isset($post['imageUrl']) ? $post['imageUrl'] : ''
				];

				$visbilityArray = [
					'code' => 'connections-only'
				];

				$postArray = [
					'comment' => $what_post['comment'],
					'content' => $contentArray,
					'visibility' => $visbilityArray
				];

				$postdata = json_encode($postArray);

				$headers = [
					'Content-Type: application/json',
					'x-li-format: json',
					'Authorization: Bearer '.$credentials['access_token']
				];

				$response = Curl::get('https://api.linkedin.com/v1/people/~/shares?format=json', $headers, 'post', $postdata);

				echo '<pre>';
					print_r($response);
				echo '</pre>';

			}

		}

		private static function get_authorization() {

			$params = [
				'response_type' => 'code',
				'client_id' 	=> LINKEDIN_CLIENT_ID,
				'redirect_uri' 	=> REDIRECT_URI,
				'state' 		=> uniqid('', true),
				'scope' 		=> SCOPE
			];

			$url = 'https://www.linkedin.com/oauth/v2/authorization?'.http_build_query($params);

			$data = [
				'state' => $params['state']
			];

			self::update_db($data);
			
			header('Location: '.$url);

		}

		static public function get_token($data) {

			$new_linkedin_credentials = self::get_from_db();

			$postdata = [
				'grant_type' 	=> 'authorization_code',
				'code' 			=> $data['code'],
				'redirect_uri' 	=> REDIRECT_URI,
				'client_id' 	=> LINKEDIN_CLIENT_ID,
				'client_secret' => LINKEDIN_CLIENT_KEY
			];

			$token = Curl::get('https://www.linkedin.com/oauth/v2/accessToken', true, 'post', $postdata);

			$data = [
				'access_token' 	=> $token->access_token,
				'expires_in' 	=> $token->expires_in,
				'expires_at'	=> time() + $token->expires_in
			];

			self::update_db($data);

			$new_linkedin_credentials['access_token'] = $token->access_token;
			$new_linkedin_credentials['expires_in'] = $token->expires_in;
			$new_linkedin_credentials['expires_at'] = time() + $token->expires_in;
			return $new_linkedin_credentials;

		}

		public static function reset_linkedin_session() {

			$clear = [
				'state' 		=> '',
				'access_token' 	=> '',
				'expires_in' 	=> 0,
				'expires_at'	=> 0
			];

			self::update_db($clear);

			return $clear;

		}

		private static function get_from_db() {

			$sql = 'SELECT * FROM tokens WHERE name = "linkedin"';
			$cred = DB::query($sql, true);

			return $cred;

		}

		private static function update_db($data) {

			$string = '';

			foreach($data as $key => $value) {
				if(is_string($value)) {
					$value = '"'.$value.'"';
				}

				$string .= $key.' = '.$value.', ';
			}

			$string = rtrim($string, ', ');

			$sql = 'UPDATE tokens SET '.$string.' WHERE name = "linkedin"';
			DB::query($sql);

		}

		public static function get_what_post() {

			$day = date('N');
			$output = [];

			switch ($day) {
				case "1":
					// Monday
					$output['tag'] = 'låtar';
					$output['description'] = '';
					$output['comment'] = 'Musikmåndag: Ett tips från mina favoritlåtar på Spotify. Se hela listan på http://hejkomp.is/tag:musiken';
					break;
				case "2":
					// Tuesday
					die;
					break;
				case "3":
					// Wednesday
					$output['tag'] = 'jobbet';
					$output['description'] = '';
					$output['comment'] = 'Halva jobbveckan har snart gått, och det är nu det behövs en bra jobbrelaterad artikel att läsa. Hitta fler på http://hejkomp.is/tag:jobbet';
					break;
				case "4":
					// Thursday
					$output['tag'] = 'köket';
					$output['description'] = '';
					$output['comment'] = 'Vet du vad du ska du äta idag? Här kommer ett tips till köket. Hitta mer på http://hejkomp.is/tag:köket';
					break;
				case "5":
					// Friday
					$output['tag'] = 'inspiration';
					$output['description'] = '';
					$output['comment'] = 'Lite inspiration behövs varje fredag! Det finns mer på http://hejkomp.is/tag:inspiration';
					break;
				case "6":
					// Saturday
					$output['tag'] = 'fåtöljen';
					$output['description'] = '';
					$output['comment'] = 'Lördag morgon, och äntligen tid att läsa en riktigt bra artikel. Se alla jag sparat, på http://hejkomp.is/tag:fåtöljen';
					break;
				case "7":
					// Sunday
					die;
					break;
				default:
					die;
			}

			return($output);

		}

	}