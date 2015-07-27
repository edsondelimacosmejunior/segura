<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Smarty {make_menu} function plugin
 *
 * Type:     function<br>
 * Name:     make_menu<br>
 * Date:     May 3, 2002<br>
 *
 * @link http://smarty.php.net/manual/en/language.function.cycle.php {cycle}
 *       (Smarty online manual)
 * @author Marcos Tullyo Campos <mtullyoc at gmail dot com>
 * @version  0.3
 * @param array
 * @param Smarty
 * @return string|null
 */



function smarty_function_botao($params, &$smarty)
{
	
	$botao 			= $params["nome"];
	$title			= $params["title"];
	$link 			= $params["link"];
	$onclick		= $params["onclick"];
	$align 			= $params["align"];
	$icone 			= $params["icone"];
	$onmouserover	= $params["onmouserover"];
	$onmouserout	= $params["onmouserout"];
	
	$tipo		= $params["tipo"];
	
	$BASE_PATH = $smarty->get_template_vars();
	$BASE_PATH = $BASE_PATH["BASE_PATH"];
	
	$onclick_att = "";
	
	if ($link == "")
		$link = "javascript: void(0);";
	
	if ($onclick != "")
		$onclick_att = "onclick=\"$onclick\"";

	if ($align == "center") {
		echo "<div class=\"botao\" style=\"float: left; margin: 4px 4px; \">";
		echo "	<a title=\"$title\" href=\"$link\" $onclick_att style=\"padding: 2px 7px; line-height: 30px; width: 115px;  font-size: 12px;\" >";
		if ($icone != "") {
			echo "	<img src=\"".$BASE_PATH."view/imagens/".$icone."\" border=\"0\" style='margin: 4px 0 0;' />";
		}
		echo "<span style='width: 115px; float: left; display: block;'>$botao</span></a>";
		echo "</div>";
	} elseif ($tipo == 2) {
		echo "<div style=\"display: inline;\">";
		echo "	<img src=\"".$BASE_PATH."view/imagens/".$icone."\" align=\"top\" border=\"0\" style=\"margin:2px;\"/>";
		echo "</div>";		
	} else {
		echo "<div class=\"botao\" >";
		if ($icone != "") {
			echo "<a title=\"$title\" href=\"$link\" $onclick_att >";
			echo "	<img src=\"".$BASE_PATH."view/imagens/".$icone."\" border=\"0\" align=\"left\" style=\"margin-right: 2px;\"/>";
			echo $botao;
			echo "</a>";
		} else {
			echo "<a title=\"$title\" onmouserover=\"$onmouserover\" onmouserout=\"$onmouserout\" href=\"$link\" $onclick_att style=\"line-height: 16px;\" >";
			echo $botao;
			echo "</a>";		}
		echo "</div>";
	}
	
	
}

?>
