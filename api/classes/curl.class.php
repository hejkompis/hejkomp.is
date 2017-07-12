<?php

	class Curl {

		public static function get($url, $headers = false, $request = 'get', $data = false) {

			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, $url); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			
			if($request === 'post') {
				$fields = '';
				foreach ($data as $key => $value) {
				    $fields .= $key . '=' . $value . '&';
				}
				rtrim($fields, '&');

				curl_setopt($ch, CURLOPT_POST, count($data));
    			curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
			}

			if($headers) {
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			    	$headers
			    ));
			}

			$output = curl_exec($ch); 

			return json_decode($output);
		
		}

	}