<?php
	/*	--------------------------------------------------- *\
			Towns - Model
				Table:
					- id
					- name
					- max_player
					- map
					- mayorID
	\*	--------------------------------------------------- */
	class Towns extends Model{
		public $table = "towns";


		/*	--------------------------------------------------- *\
				[function] add(string name, int max_player, int mayorID)
		
				* Add a new town *
		
				Return: int, exception
		\*	--------------------------------------------------- */
		function add($name = null, $max_player = 9, $mayorID = null){
			if(isset($name) && isset($max_player) && isset($mayorID)){
				
			}
			else{
				throw new Exception("Invalid arguments");
				
			}
		}


		/*	--------------------------------------------------- *\
				[function] getTowns()
		
				* Returns all the towns *
		
				Return: data, exception
		\*	--------------------------------------------------- */
		function getTowns(){
			$d = $this->find(array("conditions" => "1=1"));
			if(count($d) != 0){
				return $d;
			}
			else{
				throw new Exception("No town");
				
			}
		}


	}
?>