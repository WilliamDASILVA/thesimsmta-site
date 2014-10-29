<?php
	/*	--------------------------------------------------- *\
			Langages
	\*	--------------------------------------------------- */

	class Langages{

		public $currentLangage = "en";
		public $table = array();

		/*	--------------------------------------------------- *\
				Retourne le texte correspondant
		\*	--------------------------------------------------- */
		function langage($category, $element){
			require(ROOT."langages/".$this->currentLangage.".php");
			$this->table = $langage;

			return $langage[$category][$element];
		}

		/*	--------------------------------------------------- *\
				Retourne le langage actuel
		\*	--------------------------------------------------- */
		function getLangage(){
			return $this->currentLangage;
		}

		/*	--------------------------------------------------- *\
				Définir le langage
		\*	--------------------------------------------------- */

		function setLangage($langage){
			if(isset($langage) && !empty($langage)){
				/*	--------------------------------------------------- *\
						Vérification si la langue existe
				\*	--------------------------------------------------- */
				if(file_exists(ROOT."langages/".$langage.".php")){
					$expires = date("D, d-M-Y H:i:s", time()+ 3600) . " GMT";
					header("Set-Cookie: c_langage=$langage; path=/; expires=$expires;");
				}
				else{
					/*	--------------------------------------------------- *\
							Langue non existante, anglais par default
					\*	--------------------------------------------------- */
					$langage = "en";
				}
				$this->currentLangage = $langage;
			}
			else{
				return false;
			}
		}

		/*	--------------------------------------------------- *\
				Construct
		\*	--------------------------------------------------- */
		function __construct(){
			if(isset($_COOKIE['c_langage']) && !empty($_COOKIE['c_langage'])){
				/*	--------------------------------------------------- *\
						Cookie existant, on définit la langue
				\*	--------------------------------------------------- */
				$this->currentLangage = $_COOKIE['c_langage'];
			}
			else{
				/*	--------------------------------------------------- *\
						Aucun cookie, détection automatique
				\*	--------------------------------------------------- */
				$autolangage = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
				$autolangage = strtolower(substr(chop($autolangage[0]),0,2));

				if(isset($autolangage) && !empty($autolangage)){
					/*	--------------------------------------------------- *\
							Langage détécté
					\*	--------------------------------------------------- */
					$selectedLangage = $autolangage;
				}
				else{
					/*	--------------------------------------------------- *\
							Aucun langage détécté, on définit l'anglais
					\*	--------------------------------------------------- */
					$selectedLangage = "en";
				}
				$this->setLangage($selectedLangage);
			}
		}


	}
?>