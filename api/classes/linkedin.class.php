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

				// if($data['return']) {
				// 	if(method_exists(Linkedin, $data['return'])) {
				// 		self::$data['return'];	
				// 	}
					
				// }

			}
			
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

			if($_SESSION[SESSION]['linkedin']['expires_at'] < time()) {
				Curl::get('http://'.ROOT.'/api/linkedin/');
			}

			if(!isset($_SESSION[SESSION]['linkedin'])) {
				Curl::get('http://'.ROOT.'/api/linkedin/');
			}			

			$data['tag'] = 'inspiration';

			$post = Grav::publish_item($data);

			$contentArray = [
				'title' => $post['title'],
				'description' => isset($post['description']) ? $post['description'] : '',
				'submitted-url' => 'http://'.ROOT.'/api/leaving/?for='.$post['source'].'&referrer=Linkedin',
				'submitted-image-url' => isset($post['imageUrl']) ? $post['imageUrl'] : ''
			];

			$visbilityArray = [
				'code' => 'connections-only'
			];

			$postArray = [
				'comment' => 'Testar att bygga en delningsfunktion...',
				'content' => $contentArray,
				'visibility' => $visbilityArray
			];

			$postdata = json_encode($postArray);

			$headers = [
				'Content-Type: application/json',
				'x-li-format: json'
			];

			$response = Curl::get('https://api.linkedin.com/v1/people/~/shares?format=json', $headers, 'post', $postdata);

			echo '<pre>';
			print_r($response);
			echo '</pre>';

		}

	}