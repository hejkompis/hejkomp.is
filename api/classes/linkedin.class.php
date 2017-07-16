<?php

	define('CLIENT_ID', '785m6qrraf5l3x');
	define('CLIENT_KEY', '3ju0gOKcRpUXGlNB');
	define('REDIRECT_URI', 'http://'.ROOT.'/api/linkedin/');
	define('SCOPE', 'r_basicprofile r_emailaddress rw_company_admin w_share');

	class Linkedin {

		static public function fallback($data) {

			if(!isset($_SESSION[SESSION]['linkedin'])) {

				self::reset_linkedin_session();

			}

			if (isset($data['error'])) {
		
				echo $data['error'] . ': ' . $data['error_description'];
				die;
		
			} elseif(isset($data['code'])) {
			
				if ($data['state'] == $data['state']) {
					// Get token so you can make API calls
					self::get_token($data);
				} else {
					// CSRF attack? Or did you mix up your states?
					die;
				}
	
			} else { 
	
				if ($_SESSION[SESSION]['linkedin']['expires_at'] < time()) {
					// Token has expired, clear the state
					self::reset_linkedin_session();
				}
	
				if (empty($_SESSION[SESSION]['linkedin']['access_token'])) {
					// Start authorization process
					self::get_authorization();
				}

			}

			// push data to Linkedin API

		}

		static public function get_token($data) {

			$postdata = [
				'grant_type' 	=> 'authorization_code',
				'code' 			=> $data['code'],
				'redirect_uri' 	=> REDIRECT_URI,
				'client_id' 	=> CLIENT_ID,
				'client_secret' => CLIENT_KEY
			];

			$token = Curl::get('https://www.linkedin.com/oauth/v2/accessToken', true, 'post', $postdata);

			$_SESSION[SESSION]['linkedin']['access_token'] = $token->access_token;
			$_SESSION[SESSION]['linkedin']['expires_in'] = $token->expires_in;
			$_SESSION[SESSION]['linkedin']['expires_at'] = time() + $_SESSION[SESSION]['linkedin']['expires_in'];

		}

		public static function reset_linkedin_session() {

			$_SESSION[SESSION]['linkedin'] = [];

			$_SESSION[SESSION]['linkedin']['expires_in'] = 0;
			$_SESSION[SESSION]['linkedin']['expires_at'] = 0;

		}

		private static function get_authorization() {

			$params = [
				'response_type' => 'code',
				'client_id' 	=> CLIENT_ID,
				'redirect_uri' 	=> REDIRECT_URI,
				'state' 		=> uniqid('', true),
				'scope' 		=> SCOPE
			];

			$url = 'https://www.linkedin.com/oauth/v2/authorization?'.http_build_query($params);

			$_SESSION[SESSION]['linkedin']['state'] = $params['state'];
			
			header('Location: '.$url);

		}

		public static function post() {

			if(!isset($_SESSION[SESSION]['linkedin'])) {
				$data['return'] = 'post';
				self::fallback($data);
			}

			if($_SESSION[SESSION]['linkedin']['expires_at'] < time()) {
				$data['return'] = 'post';
				self::fallback($data);
			}			

			$what_post = self::get_what_post();

			$post = Grav::publish_item($what_post['tag']);

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
				'Authorization: Bearer '.$_SESSION[SESSION]['linkedin']['access_token']
			];

			$response = Curl::get('https://api.linkedin.com/v1/people/~/shares?format=json', $headers, 'post', $postdata);

			echo '<pre>';
			print_r($response);
			echo '</pre>';

		}

		public static function get_what_post() {

			$day = date('N');
			$output = [];

			switch ($day) {
				case "1":
					// Monday
					$output['tag'] = 'musiken';
					$output['description'] = '';
					$output['comment'] = 'Musikmåndag: Ett tips från mina favoritlåtar på Spotify.';
					break;
				case "2":
					// Tuesday
					die;
					break;
				case "3":
					// Wednesday
					$output['tag'] = 'jobbet';
					$output['description'] = '';
					$output['comment'] = 'Halva jobbveckan har snart gått, och det är nu det behövs en bra jobbrelateradartikel att läsa.';
					break;
				case "4":
					// Thursday
					$output['tag'] = 'köket';
					$output['description'] = '';
					$output['comment'] = 'Vad ska du äta idag? Här kommer ett kökstips.';
					break;
				case "5":
					// Friday
					$output['tag'] = 'inspiration';
					$output['description'] = '';
					$output['comment'] = 'Varje fredag tipsar jag om en artikel eller pryl, en artikel eller något annat jag inspireras av.';
					break;
				case "7":
					// Saturday
					$output['tag'] = 'fåtöljen';
					$output['description'] = '';
					$output['comment'] = 'Äntligen finns det tid till långläsning.';
					break;
				case "6":
					// Sunday
					die;
					break;
				default:
					die;
			}

			return($output);

		}

	}