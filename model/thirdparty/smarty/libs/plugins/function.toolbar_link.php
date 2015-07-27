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

function smarty_function_toolbar_link($params, &$smarty)
{

	$url 	= $params["url"];
	$name 	= $params["name"];
	$icon 	= $params["icon"];
	$tipo 	= $params["tipo"];


	echo "<a href=\"javascript: void(0);\" class=\"link_toolbar\">";

	if ($tipo == 2)
		echo "	<div class=\"url\">out:$url</div>";
	else
		echo "	<div class=\"url\">$url</div>";
	
	echo "	<span style=\"margin: 0 0 0 0; width: 24px; height: 24px; background: transparent url('".IMAGENS.$icon."') no-repeat left center; \"></span>$name";
	echo "</a>";
	
}

?>