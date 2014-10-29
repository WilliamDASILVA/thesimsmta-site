<?php


	session_start();

	define("WEBROOT", str_replace("index.php", "", $_SERVER['SCRIPT_NAME']));
	define("ROOT", str_replace("index.php", "", $_SERVER['SCRIPT_FILENAME']));



	require_once(ROOT."core/mta.php");


	/*	--------------------------------------------------- *\
			Require files
	\*	--------------------------------------------------- */
	require_once(ROOT."core/parameters.php");
	require_once(ROOT."core/langages.php");
	require_once(ROOT."core/model.php");
	require_once(ROOT."core/controller.php");
	require_once(ROOT."core/util.php");


	/*	--------------------------------------------------- *\
			Redirection si il n'y a aucune valeur
	\*	--------------------------------------------------- */
	if(empty($_GET['p'])){
		$controller = "home";
		$action = "index";
		$g = array();

	}
	else{
		$g = explode("/", $_GET['p']);
		$controller = $g[0];
		$action = isset($g[1]) ? $g[1] : "index";
		
	}
	/*	--------------------------------------------------- *\
			404 > Not Found
	\*	--------------------------------------------------- */
	if($controller == "404"){
		$controller = "NotFound";
	}

	if(file_exists('controllers/'.$controller.'.php')){
		require_once('controllers/'.$controller.'.php');

		if(strpos($_SERVER['HTTP_USER_AGENT'], "MTA") !== false){
			require_once("controllers/api.php");
			$controller = new API();
			$controller->$action();
		}
		else{
			$controllerName = $controller;
			$controller = new $controllerName();
			
			if(method_exists($controller, $action)){
				unset($g[0]); unset($g[1]);
				call_user_func_array(array($controller, $action), $g);
			}
			else{
				header("Location: ".WEBROOT."404");
			}
		}
		
	}
	else{
		require_once('controllers/notfound.php');
		$d = new NotFound();
		call_user_func_array(array($d, 'index'), $g);
	}
?>