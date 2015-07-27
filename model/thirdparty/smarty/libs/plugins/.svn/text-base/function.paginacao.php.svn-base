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



function smarty_function_paginacao($params, &$smarty)
{
	
	$funcao		= $params["funcao"];
	$paginas 	= $params["paginas"];
	$tipo_setor = $params["tipo_setor"];
	$div 		= $params["div"];
	
	if ($paginas > 0) {

		echo '<div>';
			echo '<div class="botao" style="line-height: 20px; height: 25px;"><a href="javascript: '.$funcao.'(-1);" >&raquo;</a></div>';
	
			$vars = $smarty->get_template_vars();
			
			if (!$tipo_setor) {
				for ($i = $paginas; $i >= 0 ; $i--) {
				
					echo "<div class=\"botao\" style=\"line-height: 20px; height: 25px;\"><a href=\"javascript: ".$funcao."($i);\" >".($i+1)."</a></div>";
			
				}
			} else {
				if ($div) {
					for ($i = $paginas; $i >= 0 ; $i--) {
						echo "<div class=\"botao\" style=\"line-height: 20px; height: 25px;\"><a href=\"javascript: ".$funcao."($i,$tipo_setor,'$div');\" >".($i+1)."</a></div>";
					}
				} else {
					for ($i = $paginas; $i >= 0 ; $i--) {
						echo "<div class=\"botao\" style=\"line-height: 20px; height: 25px;\"><a href=\"javascript: ".$funcao."($i,$tipo_setor);\" >".($i+1)."</a></div>";
					}
				}
			}
	
			echo "<div class=\"botao\" style=\"line-height: 20px; height: 25px;\"><a href=\"javascript: $funcao(0);\" >&laquo;</a></div>";
			echo "<div class=\"botao\" style=\"line-height: 20px; height: 23px; padding: 2px 10px 0 4px;\">Páginas:</div>";
		echo '</div>';

	}	
}

?>
