<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Smarty {caixa}{/caixa} block plugin
 *
 * @author Marcos Tullyo Campos <mtullyoc at gmail dot com>
 * @return string string $content re-formatted
 */

require_once("_includes/config.php");

function smarty_block_menu($params, $content, &$smarty)
{

	$width	= (isset($params["width"]))? $params["width"] - 20 : 550;
	$align	= (isset($params["align"]))? $params["align"] : "left";
	$estilo = (isset($params["estilo"]))? $params["estilo"] : "";
	$id	 	= $params["id"];
	$display = $params["display"];


	$id_att = "";

	if ($id != "")
		$id_att = "id='".$id."'";
	
	if ($display == "")
		$display = "block";

	if (trim($content) != "") {
	    $_output = 	'<div '.$id_att.' style="margin: -11px 0 10px; height: 25px; width: 100%; float: '.$align.'; display: '.$display.'; ">

							'.$content.'
		
					</div><br /><br />';
	}
	return $_output;

}

/* vim: set expandtab: */

?>
