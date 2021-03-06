<?php

	if ( strstr($_SERVER["SERVER_SIGNATURE"],"localhost") == "" &&  strpos($_SERVER["SERVER_SIGNATURE"],"127.0.0.1") == "" ) { // Online Server

        //Configuração no servidor
        $HOST 		= "localhost";
	$USER 		= "root";
	$PASS 		= "";
	$DB		= "sistemas_segura";

        @define('BASE_PATH',"/segura/"); #Terminado com /
        @define('REAL_PATH',"C:\\xampp\\htdocs\\segura\\"); #Terminado com /

	} else { // LOCALHOST

		//Configuração Local do MySQL
		$HOST 		= "localhost";
		$USER 		= "root";
		$PASS 		= "";
		$DB		= "sistemas_segura";

		@define('BASE_PATH',"/segura/"); #Terminado com /
		@define('REAL_PATH',"C:\\xampp\\htdocs\\segura\\"); #Terminado com /
		
	}
	
	@define('BASE_URL',"http://".$_SERVER["HTTP_HOST"].BASE_PATH);
	@define('BASE_URLS',"https://".$_SERVER["HTTP_HOST"].BASE_PATH);
	
	@define('IMG',BASE_URL."view/imgs/");
	
	@define('CSS',BASE_URL."view/css/");

	@define('JS',BASE_URL."view/js/");

	//@define("FPDF_FONTPATH",REAL_PATH."classes/fpdf/font/");

	@define('DOCTRINE_PATH', REAL_PATH . 'model/thirdparty/doctrine');
	
	@define('MODELS_PATH', REAL_PATH . 'model/app');

?>
