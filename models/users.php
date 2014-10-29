<?php
	/*	--------------------------------------------------- *\
			Users - Model
	\*	--------------------------------------------------- */
	class Users extends Model{
		public $table = "users";
		private $slug = "thesimsmta";

		/*	--------------------------------------------------- *\
				[function] getUser(string email, string password)
		
				* Retourne les informations d'un utilisateur selon son adresse mail *
		
				Return: data, exception
		\*	--------------------------------------------------- */
		function getUser($email = null, $password = null){
			if(isset($email) && isset($password)){
				$password = md5($password."-".$this->slug);
				$d = $this->find(array("conditions" => "email = '$email' AND password = '$password'"));
				if(count($d) == 0){
					throw new Exception("Account doesn't exist");
				}
				else{
					return $d[0];
				}
			}
			else{
				throw new Exception("Missing arguments");
				
			}
		}

		function test(){

		}
	}
?>