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

function smarty_block_aba($params, $content, &$smarty)
{

	$titulo	= $params["titulo"];
	$width	= (isset($params["width"]))? $params["width"] : 583;
	$w2 	= $width-10;
	$w3		= $width-20;
	$align	= (isset($params["align"]))? $params["align"] : "left";
	$estilo = (isset($params["estilo"]))? $params["estilo"] : "";
	$id	 	= $params["id"];
	$display = $params["display"];

	$id_att = "";

	if ($id != "")
		$id_att = "id='".$id."'";
	
	if ($display == "")
		$display = "block";

	if (trim($content) == "") {
		$content = "N�o h� conte�do para esta se��o.";
	}
    $_output = 	'
	<div style="overflow: hidden; margin: auto; display: block;">
	
		<div '.$id_att.' class="conteudo" style=" display: '.$display.'; margin: auto; '.$estilo.'> ">
		
			'.$content.'
		
		</div>
	
	</div>';


	return $_output;

}

/* vim: set expandtab: */

?>
