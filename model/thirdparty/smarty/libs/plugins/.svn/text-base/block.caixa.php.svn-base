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

function smarty_block_caixa($params, $content, &$smarty)
{

	$titulo	= $params["titulo"];
	$width	= (isset($params["width"]))? $params["width"] : 582;
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

	if (trim($content) == "") {
		$content = "N�o h� conte�do para est� se��o.";
	}
	    $_output = 	'<div '.$id_att.' class="caixa" style="display: '.$display.'; margin: 10px 8px 0 0; border-right: 2px solid #ccc; border-bottom: 1px solid #ccc; width: '. ($width + 1) .'px; float: left; ">
						<div style="border: 1px solid #999; width: '.$w4.'px; float: '.$align.'; ">
	
							<div style="background: url('.BASE_PATH.'view/imagens/bg_caixa_5.jpg) #FFF bottom repeat-x;  width: '.$w2.'px; padding: 5px; text-align: left;">
								<img src="'.BASE_PATH.'view/imagens/cms/bullet2.gif" alt="" />'.$titulo.'
							</div>
						
							<div class="conteudo_caixa" style="width:'.$w3.'px;">
						
								'.$content.'
						
							</div>
						</div>
					</div>';
	return $_output;

}

/* vim: set expandtab: */

?>
