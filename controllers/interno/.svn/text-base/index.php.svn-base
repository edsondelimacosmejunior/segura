<?php

/** /protogame/controllers/interno/index.php
 * Controller_Index
 * 
 * @author Marcos Tullyo
 * @package Controllers
 */
Class Controller_Index Extends Proto_Controller {

	/**
	 * Initial Method. 
	 * @return 
	 * 
	 */
	function index() {

		$this->valida_sessao();
        		
		$this->show("pages/interno/index.tpl");

	}
	
	function logout() {
		
		if ($this->logado())
			$_SESSION["logado"]    = false;
			$_SESSION["projeto"]   = false;
			$_SESSION["idprojeto"] = 0;
		
		$this->go(BASE_URL);
		
	}
	
	function newproject(){
	    
	    $_SESSION["idprojeto"] = -1;
	    
	    $this->show("pages/interno/index.tpl");
	    
	}
	
	function criarprojeto(){
	    
	    $this->valida_sessao();
	    
	    $nome_projeto = $this->escape("nomeproj");
	    $usuario = $this->escape("user");
	    
	    $numero_profissionais=10;
	    $custo_padrao_hora=50;
	    
	    $p_analise = 10;
	    $p_projeto = 25;
	    $p_implementacao = 50;
	    $p_testes = 15;
	    
	    //cod: 10 - 20 - 55 - 15
	    //art: 30 - 27 - 15 - 28
	    
	    $projeto = new Projeto();
	    $projeto->idUsuario   = $usuario;
	    $projeto->nome        = $nome_projeto;
	    $projeto->linhasDeCodigoPrevistas = rand(300000, 600000);
	    $projeto->artefatosPrevistos = $projeto->linhasDeCodigoPrevistas * (1/100); //1% do codigo
	    $projeto->tempo = round($projeto->linhasDeCodigoPrevistas / ($numero_profissionais * 194 * 5));
	    $projeto->orcamento = ($numero_profissionais * $custo_padrao_hora * 8 * 5 * $projeto->tempo) * 1.12; //custo esperado + 12%
	    $projeto->saldo = $projeto->orcamento;
	    $projeto->percentualErros = 1.5;
	    $projeto->idStatus = 0;
	    
	    $projeto->save();
	    
	    $meta1 = new Meta();
	    $meta1->nome = "Análise";
	    $meta1->idProjeto = $projeto->idProjeto;
	    $meta1->tempo = round($projeto->tempo * ($p_analise/100));
	    $meta1->linhasDeCodigo = round($projeto->linhasDeCodigoPrevistas * (10/100));
	    $meta1->artefatos = round($projeto->artefatosPrevistos * (30/100));
	    $meta1->save();
	    
	    $meta2 = new Meta();
	    $meta2->nome = "Projeto";
	    $meta2->idProjeto = $projeto->idProjeto;
	    $meta2->tempo = round($projeto->tempo * ($p_projeto/100));
	    $meta2->linhasDeCodigo = round($projeto->linhasDeCodigoPrevistas * (20/100));
	    $meta2->artefatos = round($projeto->artefatosPrevistos * (27/100));
	    $meta2->save();
	    
	    $meta3 = new Meta();
	    $meta3->nome = "Implementação";
	    $meta3->idProjeto = $projeto->idProjeto;
	    $meta3->tempo = round($projeto->tempo * ($p_implementacao/100));
	    $meta3->linhasDeCodigo = round($projeto->linhasDeCodigoPrevistas * (55/100));
	    $meta3->artefatos = round($projeto->artefatosPrevistos * (15/100));
	    $meta3->save();
	    
	    $meta4 = new Meta();
	    $meta4->nome = "Testes e Validação";
	    $meta4->idProjeto = $projeto->idProjeto;
	    $meta4->tempo = ($projeto->tempo - $meta3->tempo - $meta2->tempo - $meta1->tempo);
	    $meta4->linhasDeCodigo = ($projeto->linhasDeCodigoPrevistas - $meta3->linhasDeCodigo - $meta2->linhasDeCodigo - $meta1->linhasDeCodigo);
	    $meta4->artefatos = ($projeto->artefatosPrevistos - $meta3->artefatos - $meta2->artefatos - $meta1->artefatos);
	    $meta4->save();
	    
	    for($i = 0; $i < $projeto->tempo; $i++){
	        
	        $semana = new Semana();
	        $semana->idProjeto = $projeto->idProjeto;
	        $semana->save();
	        
	        for($j = 0; $j < 5; $j++){
	            $dia = new Dia();
	            $dia->idSemana = $semana->idSemana;
	            $dia->save();
	        }
	    }
	    
	    
	    $_SESSION["idprojeto"]   = $projeto->idProjeto;
	    $_SESSION["projeto"]     = true;
	    
	    $apresentacao = $this->escape("apresentacao");
	    
	    if($apresentacao == true){
	        $this->set("apresentacao",true);
	    }else{
	        $this->set("apresentacao",false);
	    }
        $this->show("pages/interno/index.tpl");    
	    
	}
	
	function carregarprojetos(){
	    
	    $idu = $this->escape("user");
	    
	    $projs = Doctrine_Query::create()
	                ->select("p.*")
	                ->from("Projeto p")
	                ->where("p.idUsuario = ?", $idu)
	                ->execute()
	                ->toArray();
	                
	    $this->set("projs", $projs);
	                
	    $_SESSION["idprojeto"] = -2;
	    
	    $this->show("pages/interno/index.tpl");
	    
	}
	
	function open_proj(){
	    
	    $idp = $this->escape("abrirprojeto");
	    
	    $_SESSION["idprojeto"]   = $idp;
	    $_SESSION["projeto"]     = true;
	    
	    $this->show("pages/interno/index.tpl");
	    
	}
	
	function trocar_projeto(){
	    
	    $this->init_session();
	    
	    $idu = $this->escape("user");
	    
	    $projs = Doctrine_Query::create()
	                ->select("p.*")
	                ->from("Projeto p")
	                ->where("p.idUsuario = ?", $idu)
	                ->execute()
	                ->toArray();
	                
	    $this->set("projs", $projs);
	                
	    $_SESSION["idprojeto"] = -2;
	    $_SESSION["projeto"] = false;
	    
	    $this->show("pages/interno/index.tpl");
	    
	}
	
	function phpinfo() {
		
		phpinfo();
		
	}
	
}

?>