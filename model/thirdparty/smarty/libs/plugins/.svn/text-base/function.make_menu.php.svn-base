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



function smarty_function_make_menu($params, &$smarty)
{

	include("_includes/config.php");
	
	$con    = mysql_pconnect($HOST,$USER,$PASS) or die(mysql_errno());
	$db     = mysql_select_db($DB) or die(mysql_errno()."aqui");

	mysql_query("set names latin1");
	
	if (isset($params["portal"]) && $params["portal"] != "") {
		echo "<ul class='primary-nav'>";
		echo build_1($con,$params["portal"],0);
		echo "</ul>";
	} elseif (isset($params["modulos"]) && $params["modulos"] != "") {
		echo build_2($params["modulos"],0);
	} else {
		die("Erro ao tentar construir o menu.");
	}
	
}

/*
 * Função utilizada para construir todo os menu do Portal
 * 
 */
function build_1($con,$portal,$pai,$nivel=0) {

	include("_includes/config.php");

	if ($nivel > 1) { return; }
	
	$sql    = "select * from links l inner join links_do_subportal ls
			on l.id = ls.links_id
			where subportais_id=".$portal." and pai=".$pai." and ativo=1
			order by ordem,link";

	$result = mysql_query($sql);
	
	$r = "";
	
	$nivel++;
	
	while($links = mysql_fetch_assoc($result)) {
		
		$fi = build_1($con,$portal,$links["id"],$nivel);
		
		if ($fi == "") {

			$r .= "<li>\n";
			if (substr($links["url"],0,4) == "http")
				$r .= "	<a href='".$links["url"]."'>".$links["link"]."</a>\n";
			else
				$r .= "	<a href='".BASE_PATH.$links["url"]."'>".$links["link"]."</a>\n";

		} else {
			$r .= "<li class='menuparent'>\n";
			if (substr($links["url"],0,4) == "http")
				$r .= "	<a href='".$links["url"]."' class='menuparent'>".$links["link"]."</a>\n";
			else
				$r .= "	<a href='".BASE_PATH.$links["url"]."' class='menuparent'>".$links["link"]."</a>\n";
			$r .= "	<ul>\n";
			$r .= $fi."\n";
			$r .= "	</ul>\n";
		}
		$r .= "</li>\n";
	}
	
	return $r;
	
}

/*
 * Função utilizada para construir o menu de todo o CMS
 * 
 */
function build_2($modulos) {

	include("_includes/config.php");

	foreach ($modulos as $modulo) {
		
		if ($modulo["pai"] == 0) {
			echo "<li  onclick=\"clicou(this)\" class=\"item\">\n";
			$link = $modulo["url"];

			$out = "<ul>\n";
			foreach ($modulos as $mod) {
				if ($mod["pai"] == $modulo["id"]) {
					$mostra = true;
					$out .= "<li><a href='".BASE_URL.$mod["url"]."'>".$mod["link"]."</a></li>\n";
				}
			}
			$out .= "</ul>\n";

			if ($mostra) {
				
				echo "<a href='".BASE_URL.$link."' onclick='return false;'>".$modulo["link"]."</a>\n";				
				echo $out;
				
			} else {
				
				if ($link == "#") {
					echo "<a href='".BASE_URL.$link."' onclick='return false;'>".$modulo["link"]."</a>\n";
				} else {
					echo "<a href='".BASE_URL.$link."'>".$modulo["link"]."</a>\n";
				}
				
			}


			$mostra = false;
			echo "</li>\n";
		}
	}
	
	
}

?>
