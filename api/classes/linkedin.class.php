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

			$clean_data = DB::clean($data);

			$credentials = self::get_from_db();

			if(isset($clean_data['error'])) {
		
				echo $clean_data['error'] . ': ' . $clean_data['error_description'];
				die;
		
			}

			elseif(isset($clean_data['code'])) {
			
				if($credentials['state'] == $clean_data['state']) {
					// Get token so you can make API calls
					$credentials = self::get_token($clean_data);
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

				$static_day = isset($clean_data['day']) ? $clean_data['day'] : false;
				$day_category_settings = self::get_day_category($static_day);

				$post = Grav::publish_item($day_category_settings);

				$standard_comment = $post['post_type'] == 'last_week' ? $day_category_settings['comment_last_week'] : $day_category_settings['comment_all_time'];

				$source = $post['source'];
				$source = ltrim($source, "'");
				$source = rtrim($source, "'");
				$source = ltrim($source, " ");
				$source = rtrim($source, " ");

				$contentArray = [
					'title' => $post['title'],
					'description' => isset($post['description']) ? $post['description'] : $day_category_settings['description'],
					'submitted-url' => 'http://'.ROOT.'/api/leaving/?for='.$source.'&referrer=Linkedin',
					//'submitted-image-url' => isset($post['imageUrl']) ? $post['imageUrl'] : ''
					'submitted-image-url' => ''
				];

				$visbilityArray = [
					'code' => 'anyone'
				];

				$postArray = [
					'comment' => array_key_exists('comment', $post) && $post['comment'] != '' ? $post['comment'] : $standard_comment,
					'content' => $contentArray,
					'visibility' => $visbilityArray
				];

				//$postArray['comment'] .= "\n";

				$postdata = json_encode($postArray);

				$headers = [
					'Content-Type: application/json',
					'x-li-format: json',
					'Authorization: Bearer '.$credentials['access_token']
				];

				$response = Curl::get('https://api.linkedin.com/v1/people/~/shares?format=json', $headers, 'post', $postdata);

				echo '<pre>';
					print_r($response);
					//print_r($postdata);
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

		public static function get_day_category($static_day = false) {

			$day = $static_day ? $static_day : date('N');
			$output = [];

			switch ($day) {
				case "1":
					// Monday
					$output['tag'] = 'låtar';
					$output['description'] = '';
					$output['comment_last_week'] = 'Jag tänkte tipsa om en bra låt jag hittat veckan som gått. Se alla låtar som finns på min favoritlista på http://hejkomp.is/tag:låtar';
					$output['comment_all_time'] = 'Det är måndag och jag tänkte att en låt från min favoritlista kunde pigga upp. Se hela listan på http://hejkomp.is/tag:låtar';
					break;
				case "2":
					// Tuesday
					$output['tag'] = 'inspiration';
					$output['description'] = '';
					$output['comment_last_week'] = 'Lite inspiration behövs varje tisdag! Denna har jag hittat veckan som gått. Hitta mer inspiration på http://hejkomp.is/tag:inspiration';
					$output['comment_all_time'] = 'Lite inspiration behövs varje tisdag! Denna är en favorit från arkivet. Alla finns på http://hejkomp.is/tag:inspiration';
					break;
				case "3":
					// Wednesday
					$output['tag'] = 'jobbet';
					$output['description'] = '';
					$output['comment_last_week'] = 'Jag samlar bra och läsvärda jobbartiklar på min sajt, http://hejkomp.is/tag:jobbet, och delar med mig av en från den senaste veckan här.';
					$output['comment_all_time'] = 'Jag samlar bra och läsvärda jobbartiklar på min sajt, http://hejkomp.is/tag:jobbet, och tänkte här dela med mig av en ur arkivet.';
					break;
				case "4":
					// Thursday
					$output['tag'] = 'köket';
					$output['description'] = '';
					$output['comment_last_week'] = 'Nånting som jag tycker är svårt efter en lång jobbdag är att hitta motivation att laga god middagsmat. Ett bra recept brukar dock göra susen. Därför tänkte jag tipsa om ett spännande recept jag hittat nyss. Se fler recept på http://hejkomp.is/tag:köket';
					$output['comment_all_time'] = 'Bra recept kan man aldrig få för många. Därför tänkte jag dela med mig av recept från mitt arkiv. Se alla mina sparade recept på http://hejkomp.is/tag:köket';
					break;
				case "5":
					// Friday
					die;
					break;
				case "6":
					// Saturday
					$output['tag'] = 'fåtöljen';
					$output['description'] = '';
					$output['comment_last_week'] = 'Lördag morgon, och äntligen tid att läsa en av de där riktigt bra artikel jag inte hunnit med från veckan som gått. Se alla jag sparat, på http://hejkomp.is/tag:fåtöljen';
					$output['comment_all_time'] = 'Lördag morgon, och äntligen tid att läsa en riktigt bra artikel ur arkivet. Se hela artikelbiblioteket på http://hejkomp.is/tag:fåtöljen';
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