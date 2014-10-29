<?php
	/*	--------------------------------------------------- *\
			Util
	\*	--------------------------------------------------- */

	class Util{

		/*	--------------------------------------------------- *\
				Convertir une chaine de caractère
				pour une URL
		\*	--------------------------------------------------- */
		function Util_urlencode($string){
			if(isset($string)){
				$string = htmlentities($string, ENT_NOQUOTES, "UTF-8");
				$string = preg_replace('#&([A-za-z])(?:acute|grave|cedil|circ|orn|ring|slash|th|tilde|uml);#', '\1', $string);
				$string = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $string);
				$string = preg_replace('#&[^;]+;#', '', $string);

				$string = str_replace(" ", "_", $string);

				return $string;
			}
			else{
				return false;
			}
		}
	}
?>