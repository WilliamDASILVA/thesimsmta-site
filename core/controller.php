<?php

	class Controller extends Parameters{

		/*	--------------------------------------------------- *\
				Heritages
		\*	--------------------------------------------------- */
		private $extendsClasses = array("Util", "Langages");
		private $extendedClasses = array();

		public $vars = array();
		public $layout = "default";
		public $cssLoaded = array();
		public $jsLoaded = array();
		public $isFooterEnabled = true;

		/*	--------------------------------------------------- *\
				Construct function
		\*	--------------------------------------------------- */
		function __construct(){
			foreach($this->extendsClasses as $className) $this->extendedClasses[] = new $className;
		}

		/*	--------------------------------------------------- *\
				Call function
		\*	--------------------------------------------------- */
		function __call($funcName, $tArgs) {
		    foreach($this->extendedClasses as &$object) {
		        if(method_exists($object, $funcName)) return call_user_func_array(array($object, $funcName), $tArgs);
		    }
		    throw new Exception("The $funcName method doesn't exist");
		}


		function render($filename){
			/*	--------------------------------------------------- *\
					Vars
			\*	--------------------------------------------------- */
			$this->vars['cssLoaded'] = $this->cssLoaded;
			$this->vars['jsLoaded'] = $this->jsLoaded;
			$this->vars['pageTitle'] = $this->params['global']['page_title'];
			$this->vars['isFooterEnabled'] = $this->isFooterEnabled;
			$this->vars['params'] = $this->params;

			/*	--------------------------------------------------- *\
					Core
			\*	--------------------------------------------------- */
			extract($this->vars);
			ob_start();
			require(ROOT."views/".get_class($this)."/".$filename.".php");

			$content_for_layout = ob_get_clean();
			ob_start();
			require_once(ROOT."views/layout/header.php");
			$content_for_header = ob_get_clean();
			require_once(ROOT."views/layout/footer.php");
			$content_for_footer = ob_get_clean();
			
			if($this->layout == false){
				echo $content_for_layout;
			}
			else{
				require(ROOT."views/layout/".$this->layout.".php");
			}
		}

		function set($d){
			$this->vars = array_merge($this->vars, $d);
		}

		function loadModel($name){
			require_once(ROOT."models/".strtolower($name).".php");
			$this->$name = new $name();
		}

		function includeModel(){
			require_once(ROOT."core/model.php");
			$this->Model = new Model();
		}

		static function staticLoadModel($name = null){
			require_once(ROOT."models/".strtolower($name).".php");
			return new $name();
		}


		/*	--------------------------------------------------- *\
				Chargement des ressources
		\*	--------------------------------------------------- */
		function loadCSS($cssName, $cdn = false){
			if($cdn == false){
				$target = WEBROOT."views/layout/css/".$cssName;
				array_push($this->cssLoaded, $target);
			}
			else{
				$target = $cssName;
				array_push($this->cssLoaded, $target);
			}
			
		}

		function loadJS($jsName, $cdn = false){
			if($this->params['prod']['minified'] == true){
				$jsName = str_replace(".js", ".min.js", $jsName);
			}

			if($cdn == false){
				$target = WEBROOT."views/layout/js/".$jsName;
				array_push($this->jsLoaded, $target);
			}
			else{
				$target = $jsName;
				array_push($this->jsLoaded, $target);
			}
			
		}
	}
?>