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
 * Date:     Oct 20, 2007<br>
 *
 * @author Marcos Tullyo Campos <mtullyoc at gmail dot com>
 */



function smarty_function_listar_links($params, &$smarty)
{

	include("_includes/config.php");
	
	$con    = mysql_pconnect($HOST,$USER,$PASS) or die(mysql_errno());
	$db     = mysql_select_db($DB) or die(mysql_errno()."aqui");
	
	if (isset($params["portal"]) && $params["portal"] != "") {
		echo "<select id=\"".$params["name"]."\" name=\"".$params["name"]."\">";

			echo "<optgroup label=\"RAIZ\">\n";

				if ($params["pai_atual"] == "0")
					echo "<option value=0 selected >»»RAIZ««</option>\n";
				else
					echo "<option value=0 >»»RAIZ««</option>\n";
					
				echo build_select($con,$params["portal"],0,0,$params["pai_atual"],$params["id_atual"]);

			echo "</optgroup>\n";

		echo "</select>";
	}
	
	
}

/*
 * Função utilizada para construir todo os menu do Portal
 * 
 */
function build_select($con,$portal,$pai,$nivel=0,$pai_atual,$id_atual) {

//	if ($nivel > 1) { return; }
	
	$sql    = "select * from links l inner join links_do_subportal ls
			on l.id = ls.links_id
			where subportais_id=".$portal." and pai=".$pai." and ativo=1
			order by link";

	$result = mysql_query($sql);
	
	$r = "";
	
	$nivel++;
	
	while($links = mysql_fetch_assoc($result)) {
		
		$fi = build_select($con,$portal,$links["id"],$nivel,$pai_atual,$id_atual);

		if ($pai_atual == $links["id"])
			$selected = "selected";
		else
			$selected = "";

		if ($id_atual == $links["id"])
			$selected .= " disabled";
		
		if ($fi == "") {

			if ($nivel==1) {
				$r .= "<optgroup value=".$links["id"]." label=\"".$links["link"]."\">\n";

					$r .= "\t<option value=".$links["id"]." $selected>»»".$links["link"]."««</option>\n";

				$r .= "</optgroup>\n";
			} else {
				$r .= "\t<option value=".$links["id"]." $selected>".$links["link"]."</option>\n";
			}
		} else {

			if ($nivel==1) {
	
				$r .= "<optgroup value=".$links["id"]." label=\"".$links["link"]."\">\n";
	
				$r .= "\t<option value=".$links["id"]." $selected>»»".$links["link"]."««</option>\n";
				
				if ($id_atual != $links["id"])
					$r .= $fi."\n";
				$r .= "</optgroup>\n";
			} else {
				$r .= "\t<option value=".$links["id"]." $selected>".$links["link"]."</option>\n";				
				if ($id_atual != $links["id"])
					$r .= $fi."\n";
			}

		}
	}
	
	return $r;
	
}
	

?>
