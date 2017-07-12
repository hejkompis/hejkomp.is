<?php

	class Tag {

		public static function setTagName($tag) {

			if(is_array($tag)) {
				$tag = $tag[0];
			}

			$tags = [
				'fåtöljen' 		=> 'Sådant jag vill läsa',
				'bokhyllan' 	=> 'Läsvärt',
				'webben' 		=> 'Till och för webbutveckling',
				'jobbet' 		=> 'Jobbrelaterat',
				'skolan' 		=> 'Bra att ha i skolan',
				'köket' 		=> 'Matlagning och recept',
				'baren' 		=> 'Barskåpet',
				'träning' 		=> 'Allt om träning',
				'teve' 			=> 'Sevärt',
				'musiken' 		=> 'Låtar jag lyssnar på',
				'inspiration' 	=> 'Inspiration',
				'lägenheten' 	=> 'Vackert till lägenheten',
				'garderoben' 	=> 'Kläder som borde finnas i min garderob',
				'själen'		=> 'Sådant jag mår bra av',
				'prylen'		=> 'Ting jag borde äga'
 			];

 			$output = array_key_exists($tag, $tags) ? $tags[$tag] : $tag;

 			return $output;

		}

	}