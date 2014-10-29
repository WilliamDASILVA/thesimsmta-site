<?php
	/*	--------------------------------------------------- *\
			API - Controller
	\*	--------------------------------------------------- */
	class API{

		/*	--------------------------------------------------- *\
				[function] getUserInformations()
		
				* Retourne les informations d'un utilisateur *
		
				Return: json
		\*	--------------------------------------------------- */
		function getUserInformations(){
			$inputs = mta::getInput();
			if(isset($inputs[1]) && !empty($inputs[1]) && isset($inputs[2]) && !empty($inputs[2])){
				$users = Controller::staticLoadModel("Users");
				try {
					$d = $users->getUser($inputs[1], $inputs[2]);
					mta::doReturn(array("success" => "ok", "data" => $d), $inputs[0]);
				} catch (Exception $e) {
					mta::doReturn(array("error" => $e->getMessage()), $inputs[0]);
				}
			}
			else{
				mta::doReturn(array("error" => "Missing arguments"), $inputs[0]);
			}
		}

	}
?>