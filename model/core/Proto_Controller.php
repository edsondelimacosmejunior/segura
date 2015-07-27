<?php
/**
 * Proto_Controller
 * 
 * @package    Models
 * @subpackage Core
 */
abstract class Proto_Controller extends Base_Controller {

	function valida_sessao() {
		
		$this->init_session();
		
		if (!$this->logado()) {
			$this->go(BASE_PATH."logar");
		}
		
	}
	

	
	function logado() {
		
		$this->init_session();
		
		if (isset($_SESSION["logado"]) && $_SESSION["logado"] )
			return true;
		else
			return false;
		
	}
	
	
	function check_roles($roles) {
		
		$this->init_session();

		$u = $_SESSION["user"];
		
		// Verifica se há algum papel do usuário igual ao papel em verificação.
		foreach ($u["Permissao"] as $p) {

			if (is_array($roles)) {
				foreach ($roles as $r) {
					if ($r == $p["Papel"]["id"]) {
						return true;
					}
				}
			} else {
				if ($roles == $p["Papel"]["id"]) {
					return true;
				}
			}
		}

		// Caso não haja nenhum, retorna falso.
		return false;
		
	}
	
	function connect() {

		require("_includes/config.php");

		$this->con = new PDO("odbc:Driver={SQL Native Client};Server=$MSHOST;Database=$MSDB; Uid=$MSUSER;Pwd=$MSPASS;");
		
	}

	function generate_model() {
		
		$this->go("model/thirdparty/doctrine/sandbox/generate.php");
		
	}
	
	function error($str = "", $data = null) {

		$out = array();
		
		$out["message"] 	= $str;
		$out["success"] 	= false;

		if ($data)
			$out["data"] 	= $data;
				
		echo json_encode($out);
		
		die();
	}
	
	//A SAIDA DO PHP DEVE SER UM ARRAY COM -MESSAGE, SUCCESS E DATA
	function success($str = "", $data = null) {
		
		$out = array();
		
		$out["message"] 	= $str;
		$out["success"] 	= true;

		if ($data)
			$out["data"] 	= $data;
				
		echo json_encode($out);
		
		die();
	}
	
}

?>