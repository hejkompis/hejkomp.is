<?php
	
	$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);

	define('REDIRECT_URI', (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://'.$_SERVER['HTTP_HOST'].$uri_parts[0]);
	define('SCOPE', 'playlist-read-private user-library-read user-read-currently-playing');

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

			$this->name 		= Content::set_name($object['name']);
			$this->url 			= $object['url'];
			$this->timestamp 	= strtotime($object['timestamp']);
			$this->folder_name 	= Content::set_folder_name($this->timestamp, $this->name);
			$this->slug = Content::set_slug($this->name);
			$this->image 		= $object['image'];	
			$this->tags 		= [$object['tag']];
			$this->description	= [Tag::setTagName($object['tag'])];
		
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

			$credentials = self::get_credentials($data);

			if($credentials['expires_at'] >= time() &&  $credentials['access_token'] != '') {

				// do good stuff here
				$no_of_songs = self::get_playlist_length($credentials);
				$headers = 'Authorization: Bearer '.$credentials['access_token'];

				$output = [];			

				for($i = 0; $i < $no_of_songs; $i += 100) {

					$url = 'https://api.spotify.com/v1/users/amadore/playlists/6jP2cBhQHmEqxoCr4UMp03/tracks?offset='.$i;
					
					$data = Curl::get($url, $headers);
					
					foreach($data->items as $item) {

						$image = false;

						if(isset($item->track->album->images[0]->url) && is_object($item->track->album)) {
							$image = $item->track->album->images[0]->url;
						}

						$item_data = [
							'name' => $item->track->artists[0]->name.' - '.$item->track->name,
							'url' => $item->track->external_urls->spotify,
							'timestamp' => $item->added_at,
							'image' => $image,
							'tag' => 'låtar'
						];
						
						$output[] = new Spotify($item_data);
						
					}

				}

				foreach($output as $key => $value) {

					Grav::save_item($value);
				}

			}

		}

		public static function get_albums($data = false) {

			$credentials = self::get_credentials($data);

			if($credentials['expires_at'] >= time() &&  $credentials['access_token'] != '') {

				// do good stuff here
				$no_of_albums = self::get_albums_length($credentials);
				$headers = 'Authorization: Bearer '.$credentials['access_token'];

				$output = [];			

				echo $no_of_albums.'<br />';

				for($i = 0; $i < $no_of_albums; $i += 20) {

					$url = 'https://api.spotify.com/v1/me/albums?market=SE&offset='.$i;
					
					$data = Curl::get($url, $headers);

					foreach($data->items as $item) {

						$image = false;

						if(isset($item->album->images[0]->url) && is_object($item->album)) {
							$image = $item->album->images[0]->url;
						}

						$item_data = [
							'name' => $item->album->artists[0]->name.' - '.$item->album->name,
							'url' => $item->album->external_urls->spotify,
							'timestamp' => $item->added_at,
							'image' => $image,
							'tag' => 'album'
						];
						
						$output[] = new Spotify($item_data);
						
					}

				}

				foreach($output as $key => $value) {
					Grav::save_item($value);
				}

			}

		}

		public static function get_current($data = false) {

			$credentials = self::get_credentials($data);

			if($credentials['expires_at'] >= time() &&  $credentials['access_token'] != '') {

				// do good stuff here
				$headers = 'Authorization: Bearer '.$credentials['access_token'];

				$url = 'https://api.spotify.com/v1/me/player/currently-playing';
				$data = Curl::get($url, $headers);

				$output = [
					'status' => '',
					'artist' => '',
					'track' => '',
					'url' => ''
				];

				if($data->is_playing) {

					$output['status'] = 'playing';
					$output['artist'] = $data->item->album->artists[0]->name;
					$output['track'] = $data->item->name;
					$output['url'] = $data->item->external_urls->spotify;

				} else {

					$output['status'] = 'paused';

				}

				$string = '';

				foreach($output as $key => $value) {
					if(is_string($value)) {
						$value = '"'.$value.'"';
					}

					$string .= $key.' = '.$value.', ';
				}

				$string = rtrim($string, ', ');

				$sql = 'UPDATE currently_playing SET '.$string.'';
				DB::query($sql);

			}

		}

		public static function print_current() {

			$sql = 'SELECT * FROM currently_playing LIMIT 1';
			$data = DB::query($sql, true);

			echo json_encode($data);

		}

		private static function get_credentials($data) {

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

					if($credentials['refresh_token'] != '') {

						$data = [
							'code' => $credentials['refresh_token']
						];

						$credentials = self::get_refresh_token($data);

					} else {

						$credentials = self::reset_db();

					}

				}

				if($credentials['access_token'] == '') {
			
					self::get_authorization();
			
				}

			}

			return $credentials;

		}

		private static function get_authorization() {

			$params = [
				'response_type' => 'code',
				'client_id' 	=> SPOTIFY_CLIENT_ID,
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

			$postdata = [
				'grant_type' 	=> 'authorization_code',
				'code' 			=> $data['code'],
				'redirect_uri' 	=> REDIRECT_URI,
				'client_id' 	=> SPOTIFY_CLIENT_ID,
				'client_secret' => SPOTIFY_CLIENT_KEY
			];

			$token = Curl::get('https://accounts.spotify.com/api/token', true, 'post', $postdata);

			$data = [
				'access_token' 	=> $token->access_token,
				'refresh_token' => $token->refresh_token,
				'expires_in' 	=> $token->expires_in,
				'expires_at'	=> time() + $token->expires_in
			];

			self::update_db($data);

			$new_credentials['access_token'] 	= $token->access_token;
			$new_credentials['refresh_token'] 	= $token->refresh_token;
			$new_credentials['expires_in'] 		= $token->expires_in;
			$new_credentials['expires_at'] 		= time() + $token->expires_in;
			return $new_credentials;

		}

		static public function get_refresh_token($data) {

			$postdata = [
				'grant_type' 	=> 'refresh_token',
				'refresh_token' => $data['code'],
				'redirect_uri' 	=> REDIRECT_URI,
				'client_id' 	=> SPOTIFY_CLIENT_ID,
				'client_secret' => SPOTIFY_CLIENT_KEY
			];

			$token = Curl::get('https://accounts.spotify.com/api/token', true, 'post', $postdata);

			$data = [
				'access_token' 	=> $token->access_token,
				'expires_in' 	=> $token->expires_in,
				'expires_at'	=> time() + $token->expires_in
			];

			self::update_db($data);

			$new_credentials['access_token'] 	= $token->access_token;
			$new_credentials['expires_in'] 		= $token->expires_in;
			$new_credentials['expires_at'] 		= time() + $token->expires_in;
			return $new_credentials;

		}

		public static function reset_db() {

			$clear = [
				'state' 		=> '',
				'access_token' 	=> '',
				'refresh_token' => '',
				'expires_in' 	=> 0,
				'expires_at'	=> 0
			];

			self::update_db($clear);

			return $clear;

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

		static function get_albums_length($input) {

			$output = [];

			$url = 'https://api.spotify.com/v1/me/albums';
			//'type' 		=> 'items',
			$headers = 'Authorization: Bearer '.$input['access_token'];

			$output = Curl::get($url, $headers);

			return $output->total;

		}

	}