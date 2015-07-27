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

function smarty_block_center($params, $content, &$smarty)
{
    if (is_null($content)) {
		return;
    }

    $_output = 	'<div class="div_center">
				
						'.$content.'

				</div>';

    return $assign ? $smarty->assign($assign, $_output) : $_output;

}

/* vim: set expandtab: */

?>
