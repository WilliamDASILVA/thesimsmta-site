<?php
	/*	--------------------------------------------------- *\
			Statistics - Model
				Table:
					- id
					- userID
					- money
					- health
					- energy
					- hungry
	\*	--------------------------------------------------- */
	class Statistics extends Model{
		public $table = "statistics";

		/*	--------------------------------------------------- *\
				[function] add(id userID, float money, float health, float energy float hungry)
		
				* Add a new statistics insteance for a user *
		
				Return: int, exception
		\*	--------------------------------------------------- */
		function add($userID = null, $money = null, $health = null, $energy = null, $hungry = null){

		}

		/*	--------------------------------------------------- *\
				[function] getStatistic(int userID, string statistic)
		
				* Return a specific statistic *
		
				Return: float, exception
		\*	--------------------------------------------------- */
		function getStatistic($userID = null, $statistic = null){
			if(isset($userID) && isset($statistic)){
				$d = $this->find(array("conditions" => "userID = '$userID'", "fields" => $statistic));
				return $d[0];
			}
			else{
				throw new Exception("Missing arguments");
				
			}
		}

		/*	--------------------------------------------------- *\
				[function] getUserStatistics(int userID)
		
				* Return all the statistics from a player *
		
				Return: data, exception
		\*	--------------------------------------------------- */
		function getUserStatistics($userID = null){
			if(isset($userID)){
				$d = $this->find(array("conditions" => "userID = '$userID'"));
				return $d[0];
			}
			else{
				throw new Exception("Missing arguments");
				
			}
		}
	}
?>