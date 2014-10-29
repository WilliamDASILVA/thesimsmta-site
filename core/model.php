<?php
	class Model{
		public $table;
		public $id;
		private $db;
		/*	--------------------------------------------------- *\
		*		
		*
		*		Version PDO
		*
		*
		\*	--------------------------------------------------- */
		function __construct(){
			try{
				$this->db = new PDO("mysql:host=127.0.0.1;dbname=thesimsmta;charset=utf8", "root", "", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
			}
			catch(PDOException $e){
				print "Une erreur est survenue: " .$e->getMessage()."<br />";
				die();
			}
		}

		/*	--------------------------------------------------- *\
				Find
		\*	--------------------------------------------------- */
		function find($data = array(), $options = array()){
			if(isset($data) && !empty($data)){
				$currentData = array(	"conditions" => "1=1",
									 	"limit" 	 => "",
									 	"order"		 => "id DESC",
									 	"fields"	 => "*"
									 	);
				$currentOptions = array(
							"table"		=> $this->table
						);

				foreach ($data as $key => $value) {
					$currentData[$key] = $value;
				}
				foreach ($options as $key => $value) {
					$currentOptions[$key] = $value;
				}


				$r = $this->db->query("SELECT ".$currentData["fields"]." FROM `".$currentOptions["table"]."` WHERE ".$currentData["conditions"]." ORDER BY ".$currentData["order"]." ".$currentData["limit"]." ");

				$r->setFetchMode(PDO::FETCH_ASSOC);
				$d = array();
				while($result = $r->fetch()){
					$d[] = $result;
				}
				$r->closeCursor();
				return $d;
			}
			else{
				return false;
			}
		}


		/*	--------------------------------------------------- *\
				Save
		\*	--------------------------------------------------- */
		function save($data = array(), $options = array()){
			if(isset($data) && !empty($data)){
				$currentOptions = array(
					"table"		=> $this->table
					);
				foreach ($options as $key => $value) {
					$currentOptions[$key] = $value;
				}


				if(isset($data['id']) && !empty($data['id'])){
					/*	--------------------------------------------------- *\
							Update
					\*	--------------------------------------------------- */
					$sql = "UPDATE ".$currentOptions['table']." SET ";
					foreach ($data as $key => $value) {
						if($key != "id"){
							$sql .= "$key='".$value."',";
						}
					}
					$sql = substr($sql, 0,-1);
					$sql .= " WHERE id='".$data['id']."'";
					$return = "true";
				}
				else{
					/*	--------------------------------------------------- *\
							Insert
					\*	--------------------------------------------------- */
					$sql = "INSERT INTO ".$currentOptions['table']." (";
					unset($data['id']);
					foreach ($data as $key => $value) {
						$sql .= "`$key`,";
					}
					$sql = substr($sql, 0,-1);
					$sql .= ") VALUES (";

					foreach ($data as $key => $value) {
						$sql .= "'".addslashes($value)."',";
					}
					$sql = substr($sql, 0,-1);
					$sql .= ")";

				}
				$r = $this->db->exec($sql);
				
				if(!isset($return)){
					$return = $this->db->lastInsertId ();
				}
				return $return;
			}
			else{
				return false;
			}
		}

		/*	--------------------------------------------------- *\
				Delete
		\*	--------------------------------------------------- */
		function delete($id=null){
			if($id == null){
				$id = $this->id;
			}

			$r = $this->db->exec("DELETE FROM `".$this->table."` WHERE id=$id");
		}

		/*	--------------------------------------------------- *\
				Query: select
		\*	--------------------------------------------------- */
		function selectQuery($query){
			if(isset($query)){
				$r = $this->db->query($query);
				$r->setFetchMode(PDO::FETCH_ASSOC);

				$d = array();
				while($data = $r->fetch()){
					$d[] = $data;
				}
				return $d;
			}
		}


		/*	--------------------------------------------------- *\
				Other functions
		\*	--------------------------------------------------- */
		static function load($name){
			require(ROOT."models/".strtolower($name).".php");
			return new $name();
		}

		function loadModel($name){
			require "models/".strtolower($name).".php";
			return new $name();
		}
	}
?>