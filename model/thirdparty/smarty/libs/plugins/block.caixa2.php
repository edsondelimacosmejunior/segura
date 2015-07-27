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

function smarty_block_caixa2($params, $content, &$smarty)
{

	$titulo	= $params["titulo"];
	$width	= (isset($params["width"]))? $params["width"] : 577;
	$w2 	= $width-11;
	$w3		= $width-21;
	$w4		= $width-1;
	$align	= (isset($params["align"]))? $params["align"] : "left";
	$estilo = (isset($params["estilo"]))? $params["estilo"] : "";
	$class = (isset($params["class"]))? $params["class"] : "";
	$estilo_externo = (isset($params["estilo_externo"]))? $params["estilo_externo"] : "";
	$id	 	= $params["id"];
	$display = $params["display"];
	$tema 	= $params["tema"];
	$fontsize = $params["fontsize"];
	$textalign = $params["textalign"];

	$id_att = "";
	
	if ($id != "")
		$id_att = "id='".$id."'";
	
	if (!$tema)
		$tema = 1;
	
	if ($display == "")
		$display = "block";
	
	if ($fontsize == "")
		$fontsize = "12";
	
	if ($textalign == "")
		$textalign = "justify";

	if (trim($content) == "") {
		$content = "Não há conteúdo para esta seção.";
	}

    $_output = 	'<div '.$id_att.' class="caixa" style="text-align: left; margin: 0 0 10px; border-right: 2px solid #ccc; border-bottom: 1px solid #ccc; width: '.$width.'px; float: '.$align.'; display: '.$display.'; '.$estilo_externo.' ">
					<div style="border: 1px solid #bbb; width: '.$w4.'px; display: block; float: left;">
	
						<div style="background: url('.BASE_PATH.'view/imagens/bg_caixa_'.$tema.'.jpg) #FFF bottom repeat-x; float: left; width: '.$w2.'px; padding: 4px 5px 2px; height: 19px; color: #444;">
							<img src="'.BASE_PATH.'view/imagens/cms/bullet2.gif" alt="" style="float: left; display: block;" />
							<div style="float: left; display: block; line-height: 12pt; font-size:11px; font-family: \'verdana\';">'.$titulo.'</div>
						</div>
					
						<div class="conteudo_caixa '.$class.'" style="font-size:'.$fontsize.'px; background: url('.BASE_PATH.'view/imagens/sombra_caixa.jpg) #FFF top repeat-x; display: block; width: '.$w3.'px; float: left; text-align: '.$textalign.'; padding: 10px; '.$estilo.'">

							'.$content.'

						</div>
						
					</div>
				</div>';

	return $_output;

}

/* vim: set expandtab: */

?>
