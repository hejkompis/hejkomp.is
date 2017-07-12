<?php

	class Leaving {

		static public function external() {

			$url = $_GET['link'];
			header('Location: '.$url);

		}

	}