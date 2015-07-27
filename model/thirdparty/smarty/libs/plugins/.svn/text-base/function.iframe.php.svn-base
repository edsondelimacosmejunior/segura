<?php

	function smarty_function_iframe($params, &$smarty)
	{
	
		$url	= (isset($params["url"]))? $params["url"] : "";
		$border	= (isset($params["border"]))? $params["border"] : "0";
		$width	= (isset($params["width"]))? $params["width"] : "550";
		$height	= (isset($params["height"]))? $params["height"] : "800";
	
		echo "<iframe src=\"$url\" frameborder=\"$border\" style=\"width: ".$width."px; height: ".$height."px;\"></iframe>";
		
	}

?>