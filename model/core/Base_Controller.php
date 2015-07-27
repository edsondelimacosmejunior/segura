<?php
/**
 * Base_Controller
 * 
 * @package    Models
 * @subpackage Core
 */
Abstract Class Base_Controller{

	protected $reg;
	protected $db;
	protected $cat;
	protected $css_array = array();
	protected $js_array = array();
	protected $js;

	function __construct($reg) {

		$this->reg = $reg;
		$this->args = $this->reg["args"];
		
		$this->set("IMG", IMG);
		$this->set("CSS", CSS);
		$this->set("JS", JS);
		$this->set("BASE_PATH",BASE_PATH);
		$this->set("BASE_URL",BASE_URL);
		
		header('Content-type: text/html; charset=utf-8');
		
	}

	function init_session() {

		if (!isset($_SESSION)) 
			session_start();
		
	}

	function close_session() {
		if (isset($_SESSION)) 
			session_destroy();
	}


	/**
	*	Este método abstrato obriga cada controlador a implementá-lo. 
	*/
	abstract function index();

	public static function debug($array)
	{
		echo "<pre>";
		print_r($array);
		echo "</pre>";
		die();
	}
	
	function display($include,$pag = "") {
		
		$this->set("CSS_ARRAY", $this->css_array);
		
		$this->set("SCRIPT",$this->js);		
		$this->set("JS_ARRAY",$this->js_array);

		$this->set("pagina",$include);
		
		if ($pag == "") {
			$this->reg["s"]->display("portal/index.tpl");
		} else {
			$this->reg["s"]->display($pag);
		}

	}
	
	function show($pagina) {
		
		$this->set("JS_ARRAY",$this->js_array);
		$this->set("CSS_ARRAY",$this->css_array);
		$this->set("SCRIPT",$this->js);
		
		$this->reg["s"]->display($pagina);

	}
	
	function set($variavel,$valor) {
		$this->reg["s"]->assign($variavel,$valor);
	}
	
	function setVar($var,$value) {
		$this->reg[$var] = $value;
	}

	function get($var) {
		return $this->reg[$var];
	}
	
	function getArg($arg) {
		if (isset($this->reg["args"][$arg]))
			return mysql_real_escape_string($this->reg["args"][$arg]);
		else
			return "";
	}
	
	function getNumArgs() {
		return count($this->reg["args"]);
	}
	

	function addJS($file,$path="") {
		if (!$path)
			$this->js_array[] = SCRIPTS.$file;
		else
			$this->js_array[] = $path.$file;
	}
	
	function dump_js() {
		
		$out = "";
		
		foreach ($this->js_array as $js) {
			$out .= "<script src=\"$js\" type=\"text/javascript\"></script>\n";
		}

		return $out;		

	}
	
	function addCSS($file,$path="") {
		if (!$path)
			$this->css_array[] = ESTILOS.$file;
		else
			$this->css_array[] = $path.$file;
	}
	
	function dump_css() {
		
		$out = "";
		
		foreach ($this->css_array as $css) {
			
			$out .= "<link href=\"$css\" rel=\"stylesheet\" type=\"text/css\" />\n";
		}

		return $out;		

	}
	
	function noCache() {

		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
	}

	function mkpath($path) {
		if(@mkdir($path) or file_exists($path)) return true;
		return ($this->mkpath(dirname($path)) and mkdir($path));
	}
	
	function back() {
		if ($_SERVER["HTTP_REFERER"]) {
			Header("Location: ".$_SERVER["HTTP_REFERER"]);
		} else {
			echo "
				<script>
					window.history.back(-1);
				</script>
			";
		}
	}
	
	function go($url) {
		Header("Location: ".$url);
	}
	
	function getLastUrl() {
		return @$_SERVER["HTTP_REFERER"]."";
	}
	
	function escape($variavel) {
		
		if (!isset($_SESSION))
			session_start();
		
		if (isset($_GET[$variavel])) {
			return stripslashes($_GET[$variavel]);
		} elseif (isset($_POST[$variavel])) {
			return stripslashes($_POST[$variavel]);
		} elseif (isset($_SESSION[$variavel])) {
			return @stripslashes($_SESSION[$variavel]);
		} else {
			return null;
		}
		
	}
	
	function fetch($tpl) {
		return $this->dump_js().$this->dump_css().$this->reg["s"]->fetch($tpl, null, null, false);
	}
	
	function optmizer() {
		$this->reg["s"]->load_filter('output','optmizer');
	}
	
}

?>