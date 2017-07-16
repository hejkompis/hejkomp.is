<?php

	class Leaving {

		static public function fallback($data) {

			$url = $data['for'];
			$referrer = isset($data['referrer']) ? $data['referrer'] : 'Unknown';

			$payload = [
				'v' 	=> '1', 				// Version.
				'tid' 	=> 'UA-99821474-2', 	// Tracking ID / Property ID.
				'cid' 	=> '777',				// Anonymous Client ID.
				't' 	=> 'event',				// Hit Type. pageview/event
				'ec' 	=> 'Leaving',	        // Event Category. Required.
				'ea' 	=> $referrer,         	// Event Action. Required.
				'el' 	=> $url,      			// Event label.
			];

			$response = Curl::get('https://www.google-analytics.com/collect', false, 'post', $payload);

			header('Location: '.$url);

		}

	}