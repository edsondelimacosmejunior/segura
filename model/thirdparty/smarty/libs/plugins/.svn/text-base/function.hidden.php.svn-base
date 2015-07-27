<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Smarty {hidden} function plugin
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



function smarty_function_hidden($params, &$smarty)
{

	$hv = $smarty->get_template_vars('hidden_values');

	if ($hv != null)
	{
		foreach($hv as $key => $value)
		{
			echo '<input type="hidden" name="'.$key.'" value="'.$value.'" />';
		}
	}
}

?>
