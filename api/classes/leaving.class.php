<?php

	class Leaving {

		static public function external() {

			$url = $_GET['for'];
			header('Location: '.$url);

		}

	}