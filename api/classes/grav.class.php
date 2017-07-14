<?php

	date_default_timezone_set('Europe/Stockholm');

	class Grav {

		static public function get_saved_items() {

			$data = Content::get_all();

			foreach($data as $key => $value) {

				$folder_name = $value->folder_name;

				if (!file_exists('../user/pages/blog/'.$folder_name)) {
					mkdir('../user/pages/blog/'.$folder_name, 0777, true);

					$tags = !empty($value->tags) ? implode(',', $value->tags) : '';

					$content = "---\r\n";
					$content .= "title:  ".$value->name."\r\n";
					$content .= "slug:  ".$value->slug."\r\n";
					$content .= "source:  ".$value->url."\r\n";
					$content .= "date:  ".date('Y-m-d H:i', $value->timestamp)."\r\n";
					$content .= "taxonomy:"."\r\n  tag: [".$tags."]\r\n";

					$img_data = [];

					if($value->image) {

						$img_data = getimagesize($value->image);

						if($img_data[0] > 320 && $img_data[1] > 320) {
						
							$image = Content::curl_get_contents($value->image);

							$fp = fopen('../user/pages/blog/'.$folder_name.'/image.jpg', 'w');
							fwrite($fp, $image);
							fclose($fp);

							$content .= "image:  image.jpg\r\n";

						}
						
					}

					$content .= "---";

					$img_data = [];

					$fp = fopen('../user/pages/blog/'.$folder_name.'/post.md','wb');
					fwrite($fp,$content);
					fclose($fp);
					
				}

			}

		}

		public static function publish_item($data) {
			
			if(empty($data['tag'])) { echo 'tag saknas, stänger av.'; die; }
			$date = !empty($data['date']) ? strtotime($data['date']) : time();

			$selectedPosts = [];

			$di = new RecursiveDirectoryIterator('../user/pages/blog/');
			foreach (new RecursiveIteratorIterator($di) as $filename => $file) {
			    if($file->getFilename() == 'post.md') {
				 	$postmd = fopen($file->getRealPath(),"r") or die("Gick ej att öppna filen");
					$postData = fread($postmd, filesize($file->getRealPath()));
					fclose($postmd);
					
					$postData = ltrim($postData, "--- \n");
					$postData = rtrim($postData, " ---");

					$postDataArray = explode("\n", $postData);

					foreach($postDataArray as $key => $value) {

						$value = trim($value);

						if($value != '') {
							$splitValue = explode(": ", $value);
							if(!empty($splitValue[1])) {
								$postDataArray[trim($splitValue[0])] = trim($splitValue[1]);
							}
							if(array_key_exists('tag', $postDataArray)) {
								$tagString = ltrim($postDataArray['tag'], "[");
								$tagString = rtrim($tagString, "]");

								$tagArray = explode(',', $tagString);
								$postDataArray['tagArray'] = [];
								foreach($tagArray as $tag) {
									if($tag != '') { array_push($postDataArray['tagArray'],$tag); }
 								}
							}
						}
						unset($postDataArray[$key]);

					}

					$postDataArray['timestamp'] = strtotime($postDataArray['date']);

					if(in_array($data['tag'], $postDataArray['tagArray'])) {
						array_push($selectedPosts, $postDataArray);
					}

			    }

			    $postmd = '';
			    
			}

			$lastWeeksPosts = [];

			$now = time();
			$then = $now - (7*24*60*60);

			foreach($selectedPosts as $post) {
				if($post['timestamp'] <= $now && $post['timestamp'] >= $then) {
					array_push($lastWeeksPosts, $post);
				}
			}

			if(!empty($lastWeeksPosts)) {
				$selectedPost = self::getRandomPost($lastWeeksPosts);
			} elseif(!empty($selectedPosts)) {
				$selectedPost = self::getRandomPost($selectedPosts);
			} else {
				die('Hittar inga sparade poster med taggen '.$data['tag'].'.');
			}

			echo '<pre>';
			print_r($selectedPost);
			echo '</pre>';

		}

		static private function getRandomPost($posts) {
			$noofPosts = count($posts)-1;
			$randomValue = rand(0, $noofPosts);
			return $posts[$randomValue];
		}

	}

	// Content-Type: application/json
	// x-li-format: json

	// {
	//   "comment": "Check out developer.linkedin.com!",
	//   "content": {
	//     "title": "LinkedIn Developers Resources",
	//     "description": "Leverage LinkedIn's APIs to maximize engagement",
	//     "submitted-url": "https://developer.linkedin.com",  
	//     "submitted-image-url": "https://example.com/logo.png"
	//   },
	//   "visibility": {
	//     "code": "anyone"
	//   }  
	// }