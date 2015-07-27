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

require_once("_includes/config.php");

function smarty_function_menu_link($params, &$smarty)
{

	$url 	= $params["url"];
	$name 	= $params["name"];
	$icon 	= $params["icon"];


	echo "<div class=\"link_menu\">";
	echo "	<div class=\"url\">$url</div>";
	echo "	<a href=\"javascript: void(0);\" style=\"background-image: url('".IMAGENS.$icon."')\">$name</a>";
	echo "</div>";
	
}

?>