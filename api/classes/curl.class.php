<?php

	class Curl {

		public static function get($url, $headers = false, $request = 'get', $data = false) {

			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, $url); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			
			if($request === 'post') {
				
				if(is_array($data)) {
					$fields = '';
					foreach ($data as $key => $value) {
					    $fields .= $key . '=' . $value . '&';
					}
					rtrim($fields, '&');

					curl_setopt($ch, CURLOPT_POST, count($data));
	    			curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
				}

				else {
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
					curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				}
				
			}

			if($headers) {
				$headers = !is_array($headers) ? array($headers) : $headers;
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			}

			$output = curl_exec($ch); 

			return json_decode($output);
		
		}

	}