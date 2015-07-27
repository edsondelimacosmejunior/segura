<?php

	$classpath;

	$classpath[] = REAL_PATH."model/app/";
	$classpath[] = REAL_PATH."model/agents/";
	$classpath[] = REAL_PATH."model/core/";
	$classpath[] = REAL_PATH."model/thirdparty/";
	

	foreach ($classpath as $p) {
		
		set_include_path(get_include_path().PATH_SEPARATOR.$p);
		
	}

	function my_autoload($class_name) {
		
		require_once($class_name.".php");
			
	}

	spl_autoload_register("my_autoload");

?>