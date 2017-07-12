<?php

	class Home {

		static public function fallback() {

			$content_list = [
				array(
					'origin' 	=> 'pocket',
					'type' 		=> 'list'),
				// array(
				// 	'origin' 	=> 'instagram',
				// 	'url' 		=> 'https://api.instagram.com/v1/users/self/media/liked/?access_token=220895584.1c7c6b4.e8acab65afee48aebb926562155d6157', 
				// 	'type' 		=>'data')
				 	array(
				 		'origin' 	=> 'spotify',
				 		'url'		=> 'https://api.spotify.com/v1/users/amadore/playlists/6jP2cBhQHmEqxoCr4UMp03/tracks?offset=800',
				 		'type' 		=> 'items',
				 		'headers' 	=> 'Authorization: Bearer BQAscbHBdjdYCUHBwIhtINdR7b7qBFYfIyV2Gi6of8q4nhel2yqhcgaAYRB2TcoFTbo0BQ_ibD8zcGu6UNpkf_yClDfwl4396XMGxVurPf2xO9mJFH2DQlUPIlutFVwiYOh92qJ8SGs')
			];

			$output = [
			'title' 	=> 'Hej kompis!',
			'objects'	=> Content::get_all()
			];
			return $output;

		}

	}