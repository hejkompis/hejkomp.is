<?php

	define('CLIENT_ID', 'f6a80d92d1c34a0abea6656a44150dfb');
	define('CLIENT_KEY', 'cd2e7f85d91c413f993dbbf12f9e400d');
	
	$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);

	define('REDIRECT_URI', (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://'.$_SERVER['HTTP_HOST'].$uri_parts[0]);
	define('SCOPE', 'playlist-read-private');

	class Spotify {

		private $type = 'Spotify', 
				$name,
				$folder_name,
				$slug,
				$url, 
				$image, 
				$tags = [], 
				$description = [], 
				$timestamp;

		function __construct($object) {

			$this->name 		= $object->track->artists[0]->name.' - '.$object->track->name;
			$this->url 			= $object->track->external_urls->spotify;
			$this->timestamp 	= strtotime($object->added_at);
			$this->folder_name 	= Content::set_folder_name($this->timestamp, $this->name);
			$this->slug = Content::set_slug($this->name);
			if(isset($object->track->album->images[0]->url) && is_object($object->track->album)) {
				$this->image 	= $object->track->album->images[0]->url;	
			}
			$this->tags 		= ['musiken'];
			$this->description	= [Tag::setTagName('musiken')];
		
		}

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

		static public function fallback($data) {

			die('Method not in use');

		}

		public static function get_favourites($data = false) {

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

					self::reset_db();

				}

				if($credentials['access_token'] == '') {
			
					self::get_authorization();
			
				}

			}

			if($credentials['expires_at'] >= time() &&  $credentials['access_token'] != '') {

				// do good stuff here
				$no_of_songs = self::get_playlist_length($credentials);
				$headers = 'Authorization: Bearer '.$credentials['access_token'];

				$output = [];			

				for($i = 0; $i < $no_of_songs; $i += 100) {

					$url = 'https://api.spotify.com/v1/users/amadore/playlists/6jP2cBhQHmEqxoCr4UMp03/tracks?offset='.$i;
					
					$data = Curl::get($url, $headers);
					
					foreach($data->items as $item) {
						
						$output[] = new Spotify($item);
						
					}

				}

				foreach($output as $key => $value) {
					Grav::save_item($value);
				}

			}

		}

		private static function get_authorization() {

			$params = [
				'response_type' => 'code',
				'client_id' 	=> CLIENT_ID,
				'redirect_uri' 	=> REDIRECT_URI,
				'state' 		=> uniqid('', true),
				'scope' 		=> SCOPE
			];

			$url = 'https://accounts.spotify.com/authorize?'.http_build_query($params);

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
				'client_id' 	=> CLIENT_ID,
				'client_secret' => CLIENT_KEY
			];

			$token = Curl::get('https://accounts.spotify.com/api/token', true, 'post', $postdata);

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

		public static function reset_db() {

			$clear = [
				'state' 		=> '',
				'access_token' 	=> '',
				'expires_in' 	=> 0,
				'expires_at'	=> 0
			];

			self::update_db($clear);

		}

		private static function get_from_db() {

			$sql = 'SELECT * FROM tokens WHERE name = "spotify"';
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

			$sql = 'UPDATE tokens SET '.$string.' WHERE name = "spotify"';
			DB::query($sql);

		}

		static function get_playlist_length($input) {

			$output = [];

			$url = 'https://api.spotify.com/v1/users/amadore/playlists/6jP2cBhQHmEqxoCr4UMp03/tracks';
			//'type' 		=> 'items',
			$headers = 'Authorization: Bearer '.$input['access_token'];

			$output = Curl::get($url, $headers);

			return $output->total;

		}

	}