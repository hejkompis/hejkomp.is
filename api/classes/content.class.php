<?php
	
	class Content {

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

		public static function get_data($origin, $url, $var, $headers = false) {

			$obj_array = Curl::get($url, $headers);
			$return_array = [];

			foreach($obj_array->$var as $obj) {
				$return_array[] = new Content($origin, $obj, $var);
			}

			return $return_array;
		}

		public static function get_all() {

			function cmp($a, $b) {
				return strcmp($a->timestamp, $b->timestamp);
			}

			$output = [];

			$spotify_items = !empty(Spotify::get_favourites()) ? Spotify::get_favourites() : [];
			$pocket_items = !empty(Pocket::get_all()) ? Pocket::get_all() : [];

			$output = array_merge($spotify_items, $pocket_items);
			usort($output, "cmp");

			$output = array_reverse($output);

			return $output;
		}

		public static function set_folder_name($timestamp, $str) {

			$output = '';
			
			$str = strip_tags($str); 
			$str = preg_replace('/[\r\n\t ]+/', ' ', $str);
			$str = preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', ' ', $str);
			$str = strtolower($str);
			$str = html_entity_decode( $str, ENT_QUOTES, "utf-8" );
			$str = htmlentities($str, ENT_QUOTES, "utf-8");
			$str = preg_replace("/(&)([a-z])([a-z]+;)/i", '$2', $str);
			$str = str_replace(' ', '-', $str);
			$str = rawurlencode($str);
			$str = str_replace('%', '-', $str);

			$date = date('Y-m-d', $timestamp);

			$output = $date.'-'.$str;

			return $output;

		}

		public static function set_name($str) {
			
			$str = strip_tags($str); 
			$str = preg_replace('/[\r\n\t ]+/', ' ', $str);
			$str = preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', ' ', $str);
			$str = str_replace('[', '', $str);
			$str = str_replace(']', '', $str);
			$str = html_entity_decode( $str, ENT_QUOTES, "utf-8" );
			$str = htmlentities($str, ENT_QUOTES, "utf-8");

			return $str;

		}

		public static function set_slug($str) {
			
			$str = strip_tags($str); 
			$str = preg_replace('/[\r\n\t ]+/', ' ', $str);
			$str = preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', ' ', $str);
			$str = strtolower($str);
			$str = html_entity_decode( $str, ENT_QUOTES, "utf-8" );
			$str = htmlentities($str, ENT_QUOTES, "utf-8");
			$str = preg_replace("/(&)([a-z])([a-z]+;)/i", '$2', $str);
			$str = str_replace(' ', '-', $str);
			$str = rawurlencode($str);
			$str = str_replace('%', '-', $str);

			return $str;

		}	

		public static function curl_get_contents($url) {
		
			$ch = curl_init($url);
			
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			
			$data = curl_exec($ch);
			curl_close($ch);
			
			return $data;
		}

	}