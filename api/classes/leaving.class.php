<?php

	class Leaving {

		static public function fallback($data) {

			$url = $data['for'];
			header('Location: '.$url);

		}

	}