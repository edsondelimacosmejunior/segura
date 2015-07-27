<?php

/**
 * AutoClass
 * 
 * @package    Models
 * @subpackage Core
 */
class AutoClass {
	
	function __call($method,$args) {
		
		$prefix 	= strtolower(substr($method,0,3));
		$attribute	= strtolower(substr($method,3));
		
		if (empty($prefix) || empty($attribute)) {
			die("Method or attribute invalid! (model/core/autoclass.class.php)");
		} elseif ($prefix == "set") {
			$this->$attribute = $args[0];
		} elseif ($prefix == "get") {
			return $this->$attribute;
		} else {
			return false;
		}
	}
}

?>
