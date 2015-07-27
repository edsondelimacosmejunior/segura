<?php
// Habilito as mensagens de erro
error_reporting (E_ALL);

setlocale(LC_ALL, "pt_BR", "pt_BR.utf-8", "portuguese");

// Verifica se a versão do PHP é inferior à 5.1.0
if (version_compare(phpversion(), '5.1.0', '<') == true) { die ('PHP5.1 Only'); }

// Separador padrão do diretório "/" ou "\"
define ('DIRSEP', DIRECTORY_SEPARATOR);

// Configurações
require_once("_includes".DIRSEP."config.php");

#----- DOCTRINE -----#	

require_once(DOCTRINE_PATH . DIRECTORY_SEPARATOR . 'Doctrine.php');

spl_autoload_register(array('Doctrine', 'autoload'));

Doctrine_Manager::getInstance()->setAttribute('model_loading', 'conservative');
Doctrine_Manager::getInstance()->setAttribute(Doctrine::ATTR_AUTO_ACCESSOR_OVERRIDE, true);

#Doctrine_Manager::connection(DSN, 'sandbox');
$conn = Doctrine_Manager::connection("mysql://$USER:$PASS@$HOST/$DB");

#----- END_DOCTRINE -----#

Doctrine::loadModels( REAL_PATH . "model".DIRSEP."app" );

// Carregando o mapeamento das classes
require_once("_includes".DIRSEP."class_mapping.php");


$reg = new Register();

// Instanciando o objeto Smarty
include(REAL_PATH."model".DIRSEP."thirdparty".DIRSEP."smarty".DIRSEP."libs".DIRSEP."Smarty.class.php");

// Objeto Smarty :)
$s = new Smarty;

$s->template_dir = REAL_PATH."view".DIRSEP;
$s->compile_dir  = REAL_PATH."model".DIRSEP."thirdparty".DIRSEP."smarty".DIRSEP."compiled_templates".DIRSEP;
$s->config_dir   = REAL_PATH."model".DIRSEP."thirdparty".DIRSEP."smarty".DIRSEP."configs".DIRSEP;
$s->cache_dir    = REAL_PATH."model".DIRSEP."thirdparty".DIRSEP."smarty".DIRSEP."cache".DIRSEP;
//$s->load_filter('output','optmizer');

$s->left_delimiter = '{{';
$s->right_delimiter = '}}';

$s->compile_check = true;

$s->assign('BASE_URL',BASE_URL);
$s->assign('BASE_URLS',BASE_URLS); // BASE_URL + HTTPS

$reg->set("s",$s);

?>
