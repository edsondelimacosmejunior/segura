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



function smarty_function_br($params, &$smarty)
{

	$width	= (isset($params["width"]))? $params["width"] : "580";

	echo "<div style=\"width: {$width}px; height: 10px; display:block; float: left;\"> &nbsp; </div>";
	
}

?>
