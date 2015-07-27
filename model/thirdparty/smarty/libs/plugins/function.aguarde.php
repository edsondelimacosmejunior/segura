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



function smarty_function_aguarde($params, &$smarty)
{

	echo '\'<div style="margin: auto;"><img src="'.BASE_URL.'view/imagens/cms/aguarde.gif" style="margin: auto;" /></div>\'';
	
}

?>
