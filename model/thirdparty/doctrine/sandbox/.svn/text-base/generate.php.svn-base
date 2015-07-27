<?php

require("config.php");

try {
	
	Doctrine::generateModelsFromDb('../../../app', array('doctrine'),array('generateTableClasses' => true));

	echo "Modelo importado!!!";
	
} catch (Exception $e) {
	
	echo "Falha ao importar modelo.<p>";
	
	echo $e->getMessage();
	
}


?>
