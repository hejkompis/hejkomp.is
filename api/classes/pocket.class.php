<?php
	
	class Pocket {
		private $type = 'Pocket', 
				$name,
				$folder_name,
				$slug,
				$url, 
				$image, 
				$tags = [],
				$timestamp;

		function __construct($object) {
			
			if($object->given_title) {
				$this->name = $object->given_title;
			}
			elseif($object->resolved_title) {
				$this->name = $object->resolved_title;
			}
			else {
				$this->name = $object->resolved_url;
			}
			$this->url 			= $object->resolved_url;
			$this->timestamp 	= $object->time_added;
			$this->folder_name = Content::set_folder_name($this->timestamp, $this->name);
			$this->slug = Content::set_slug($this->name);
			if(isset($object->image) && is_object($object->image)) {
				$this->image 	= $object->image->src;
			}
			if(isset($object->tags) && is_object($object->tags)) {
				foreach($object->tags as $tag) {
					array_push($this->tags, $tag->tag);
				}
			}

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

		public static function get_all() {

			$output = [];

			$url = 'https://getpocket.com/v3/get?consumer_key=50971-c998235ca8644c65abc85bab&access_token=bacf9a9c-868b-ba06-253b-f4eb09&detailType=complete';

			$data = Curl::get($url);

			// $count = 1;

			// foreach($data->list as $item) {
				
			// 	if($count++ <= 50) {
			// 		$output[] = new Pocket($item);
			// 	}
				
			// }
			
			foreach($data->list as $item) {
				
				$output[] = new Pocket($item);
				
			}

			$output = array_reverse($output);

			foreach($output as $key => $value) {
				Grav::save_item($value);
			}
		}		

	}