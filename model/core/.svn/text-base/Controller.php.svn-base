<?php
/**
 * Controller
 * 
 * @package    Models
 * @subpackage Core
 */
Class Controller {
	private $reg;
	private $path;
	private $args = array();
	private $file;
	private $controller;
	private $action;
	

	function __construct($reg) {
		$this->reg = $reg;
		
		//Local onde estao localizados os controladores
		$this->setPath(REAL_PATH . 'controllers');
	}

	function setPath($path) {
		$path = rtrim($path, '/\\');
		$path .= DIRSEP;
		
		// Verifica se existe esse caminho
		if (is_dir($path) == false) {
			throw new Exception ('Pasta de controladores inválida: "' . $path . '"');
		}

		$this->path = $path;
	}

	function getArg($key) {
		if (!isset($this->args[$key])) { return null; }
		return $this->args[$key];
	}

	function delegate() {
		// Analisa a variável $_GET["route"], definindo qual controlador será responsável pela requisição
		$this->getController($file, $controller, $action, $args);

		// File available?
		if (is_readable($file) == false) {
			$this->notFound("não foi possível ler o arquivo $file.");
		}
		
		// Include the file
		require ($file);

		// Initiate the class
		$classe = 'Controller_' . ucfirst($controller);

		$controller = new $classe($this->reg);

		// Action available?
		if (is_callable(array($controller, $action))) {

			#$this->reg["args"] = $this->args;

			$controller->setVar("args",$this->args);
			$controller->$action();
			
		} else if(is_callable(array($controller, "index"))) {

			$this->args = array_merge(array($action),$this->args);
			
			$controller->setVar("args",$this->args);
			
			$controller->index();

		} else {
			
			$this->notFound('não foi encontrado nenhum método para ser chamado.');
			
		}
		
		// Run action
	}
	
	private function extractArgs($args) {
		if (count($args) == 0) { return false; }
		$this->args = $args;
	}
	
	private function getController(&$file, &$controller, &$action, &$args) {
		
		$route = (empty($_GET['route'])) ? 'index' : $_GET['route'];

		// Obtém as partes da URL
		$route = rtrim($route, '/\\'); // - /include/ ==> /include
		$parts = explode('/', $route); // - /include/cache ==> Array('include','cache')


		// Procurar o controlador correto
		$ini_path = $this->path;
		foreach ($parts as $part) {
			$fullpath = $ini_path . $part;
			
			// Existe um diretório com esse caminho?
			if (is_dir($fullpath)) {
				$ini_path .= $part . DIRSEP;
				array_shift($parts);
				continue;
			}

			// Find the file
			if (is_file($fullpath . '.php')) {
				$controller = $part;
				array_shift($parts);
				break;
			}

		}

		if (empty($controller)) { $controller = 'index'; };

		// Get action
		$action = array_shift($parts);

		if (empty($action)) { $action = 'index'; }

		$file = $ini_path . strtolower($controller) . '.php';
		$this->args = $parts;
	}


	private function notFound($arg) {
		die("404 Not Found: $arg");
	}

}

?>
