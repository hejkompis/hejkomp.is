<?php 

	class Spotify_old {

		private static $access_token = '';

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

		private static function set_access_token() {

			$url = 'https://accounts.spotify.com/api/token';
			$headers = 'Authorization: Basic ZjZhODBkOTJkMWMzNGEwYWJlYTY2NTZhNDQxNTBkZmI6Y2QyZTdmODVkOTFjNDEzZjk5M2RiYmYxMmY5ZTQwMGQ=';
			$data = [
				'grant_type' => 'refresh_token',
				'refresh_token' => 'AQA62ufl1llWZ-E7gqbZYnktEmbeyqjyx-QCp_sHV9uBCboVtm7VO4ml8VlnAda2UJpwWLZ1colozBtGhON95_iHHdltCTkdIPZoEJe5KY4AvqrVMEsZREhfujiYF_oOeT0'
			];

			$data = Curl::get($url, $headers, 'post', $data);

			echo '<pre>';
				var_dump($data);
			echo '</pre>';
			die;

			Spotify::$access_token = $data->access_token;

		}

		static function get_playlist_length() {

			self::set_access_token();

			$output = [];

			$url = 'https://api.spotify.com/v1/users/amadore/playlists/6jP2cBhQHmEqxoCr4UMp03/tracks';
			//'type' 		=> 'items',
			$headers = 'Authorization: Bearer '.Spotify::$access_token;

			$output = Curl::get($url, $headers);

			return $output->total;

		}

		static function get_all() {

			self::set_access_token();
			$headers = 'Authorization: Bearer '.Spotify::$access_token;

			$no_of_songs = self::get_playlist_length();

			$output = [];			

			for($i = 0; $i < $no_of_songs; $i += 100) {

				$url = 'https://api.spotify.com/v1/users/amadore/playlists/6jP2cBhQHmEqxoCr4UMp03/tracks?offset='.$i;
				
				$data = Curl::get($url, $headers);

				// $count = 1;

				// foreach($data->items as $item) {
					
				// 	if($count++ <= 2) {
				// 		$output[] = new Spotify($item);
				// 	}
					
				// }
				
				foreach($data->items as $item) {
					
					$output[] = new Spotify($item);
					
				}

			}
			return $output;

		}

	}