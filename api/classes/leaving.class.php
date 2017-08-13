<?php

	class Leaving {

		static public function fallback($data) {

			$url = $data['for'];
			$referrer = (isset($data['referrer']) && $data['referrer'] != '') ? $data['referrer'] : 'Unknown';

			// pageview
			
			$pw_payload = [
				'v' 	=> '1', 					// Version.
				'tid' 	=> 'UA-99821474-2', 		// Tracking ID / Property ID.
				'cid' 	=> self::set_ga_cookie(),	// Anonymous Client ID.
				't' 	=> 'pageview',				// Hit Type. pageview/event
				'dh' 	=> ROOT,	       			// Document hostname.
				'dp' 	=> '/leaving',         		// Page.
				'dt' 	=> 'Leaving',      			// Title.
			];

			$response = Curl::get('https://www.google-analytics.com/collect', false, 'post', $pw_payload);

			/*
			
			v=1              // Version.
			&tid=UA-XXXXX-Y  // Tracking ID / Property ID.
			&cid=555         // Anonymous Client ID.
			&t=pageview      // Pageview hit type.
			&dh=mydemo.com   // Document hostname.
			&dp=/home        // Page.
			&dt=homepage     // Title.

			 */

			// event

			$ev_payload = [
				'v' 	=> '1', 					// Version.
				'tid' 	=> 'UA-99821474-2', 		// Tracking ID / Property ID.
				'cid' 	=> self::set_ga_cookie(),	// Anonymous Client ID.
				't' 	=> 'event',					// Hit Type. pageview/event
				'ec' 	=> 'Leaving',	        	// Event Category. Required.
				'ea' 	=> $referrer,         		// Event Action. Required.
				'el' 	=> $url,      				// Event label.
			];

			$response = Curl::get('https://www.google-analytics.com/collect', false, 'post', $ev_payload);

			header('Location: '.$url);

		}

		// Gets the current Analytics session identifier or create a new one
		// if it does not exist
		private static function set_ga_cookie() {
			
			if (isset($_COOKIE['_ga'])) {

			    // An analytics cookie is found
			    list($version, $domainDepth, $cid1, $cid2) = preg_split('[\.]', $_COOKIE["_ga"], 4);
			    $contents = array(
			        'version' => $version,
			        'domainDepth' => $domainDepth,
			        'cid' => $cid1 . '.' . $cid2
			    );
			    $cid      = $contents['cid'];
			}

			else {
			    
			    // no analytics cookie is found. Create a new one
			    $cid1 = mt_rand(0, 2147483647);
			    $cid2 = mt_rand(0, 2147483647);

			    $cid = $cid1 . '.' . $cid2;
			    setcookie('_ga', 'GA1.2.' . $cid, time() + 60 * 60 * 24 * 365 * 2, '/');
			}
			
			return $cid;
		
		}

	}