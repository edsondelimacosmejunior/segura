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

function smarty_block_caixa3($params, $content, &$smarty)
{

	$titulo	= $params["titulo"];
	$width	= (isset($params["width"]))? $params["width"] : 577;
	$w2 	= $width-11;
	$w3		= $width-21;
	$w4		= $width-1;
	$align	= (isset($params["align"]))? $params["align"] : "left";
	$estilo = (isset($params["estilo"]))? $params["estilo"] : "";
	$id	 	= $params["id"];
	$display = $params["display"];


	$id_att = "";
	
	if ($titulo == "")
		$titulo = "Sem T�tulo";

	if ($id != "")
		$id_att = "id='".$id."'";
	
	if ($display == "")
		$display = "block";

	if (trim($content) != "") {
	    $_output = 	'<div class="caixa" style="border-right: 2px solid #ccc; border-bottom: 1px solid #bbb; width: '.$width.'px; float: '.$align.'; display: '.$display.'; ">
						<div '.$id_att.' style="border: 1px solid #ddd; width: '.$w4.'px; float: '.$align.'; display: '.$display.'; ">
						
							<div class="conteudo_caixa" style="font-size: 10pt; #FFF top repeat-x; display: block; width: '.$w3.'px; float: left; text-align: justify; padding: 10px; overflow: hidden; '.$estilo.'">
						
								'.$content.'
					
							</div>
							
						</div>
					</div>';
	} else {
	    $_output = 	'<div class="caixa" style="border-right: 2px solid #ccc; border-bottom: 1px solid #ccc; width: '.$width.'px; float: '.$align.'; display: '.$display.'; ">
						<div '.$id_att.' style="border: 1px solid #888; width: '.$w4.'px; float: '.$align.'; display: '.$display.'; ">
		
							<div style="display: block; width: '.$w3.'px; text-align: justify; padding: 10px;">
						
								N�o h� conte�do para esta se��o.
						
							</div>
							
						</div>
					</div>';
	}
	return $_output;

}

/* vim: set expandtab: */

?>
