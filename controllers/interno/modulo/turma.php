<?php

Class Controller_Turma extends Proto_Controller {

//Classe de controle onde o próprio nome da função da mostra que ação realiza
    function index() {
        $this->init_session();
        $this->show("pages/interno/index.tpl");
    }

    function mostrarCadastro() {
        $this->init_session();

        $cursos = Doctrine_Query::create()
                ->select("c.*") // Seleciona os campos
                ->from("Curso c")
                ->where("c.status like 'Ativo'")
                ->orderBy("c.nome")
                ->execute()
                ->toArray();

        $instrutores1 = Doctrine_Query::create()
                ->select("i.*") // Seleciona os campos
                ->from("Instrutor i")
                ->where("i.status like 'Ativo'")
                ->orderBy("i.nome")
                ->execute()
                ->toArray();
        
        $instrutores2 = Doctrine_Query::create()
                ->select("i.*") // Seleciona os campos
                ->from("Instrutor i")
                ->where("i.status like 'Ativo'")
                ->orderBy("i.nome")
                ->execute()
                ->toArray();

	$instrutores3 = Doctrine_Query::create()
                ->select("i.*") // Seleciona os campos
                ->from("Instrutor i")
                ->where("i.status like 'Ativo'")
                ->orderBy("i.nome")
                ->execute()
                ->toArray();
	
	$instrutores4 = Doctrine_Query::create()
                ->select("i.*") // Seleciona os campos
                ->from("Instrutor i")
                ->where("i.status like 'Ativo'")
                ->orderBy("i.nome")
                ->execute()
                ->toArray();
	
        $this->set("cursos", $cursos);
        $this->set("instrutores1", $instrutores1);
        $this->set("instrutores2", $instrutores2);
	$this->set("instrutores3", $instrutores3);
        $this->set("instrutores4", $instrutores4);
        
        $this->show("pages/interno/modulo/turma/cadastro.tpl");
    }

    function listarTurmas() {
        //Inicia a sessÃ£o
        $this->init_session();

        //Recupera o id do usuário logado
        $idUsuario = $this->escape("user");
        //Recuperando dados do usuário
        $u = Doctrine::getTable("Usuario")->find($idUsuario);

	$db = mysql_connect("localhost", "root", "");
        mysql_select_db("sistemas_segura", $db);
        $result = mysql_query("
        	SELECT 
        		t.idTurma,
        		t.nome as turma,
        		t.periodo,
        		t.status,
        		c.nome as curso,
        		i.nome as instrutor
        	FROM 
        		(	
        			turma t LEFT JOIN instrutor i on t.idInstrutor1 = i.idInstrutor
        		)

        		left join curso c on t.idCurso = c.idCurso
        	WHERE 
        		t.status != 'Excluido'", $db);
        
        // Escreve resultado até que não haja mais linhas na tabela
        while ($row = mysql_fetch_array($result)) {
            $turmas[] = $row;
        }
        mysql_free_result($result);
        mysql_close($db);
        
        if ($this->logado()) {
            $this->set("usuavisrio", $u->login);
            $this->set("turmas", $turmas);

            //Abre a página da lista
            $this->show("pages/interno/modulo/turma/lista.tpl");
        } else {
            echo "<script>alert('Sua sessão expirou. Por favor, refaça seu login.'); window.location = '" . BASE_URL . "'</script>";
        }
    }
    
    function listarTurmasAtivas() {
        //Inicia a sessÃ£o
        $this->init_session();

        //Recupera o id do usuário logado
        $idUsuario = $this->escape("user");
        //Recuperando dados do usuário
        $u = Doctrine::getTable("Usuario")->find($idUsuario);
	
	$db = mysql_connect("localhost", "root", "");
        mysql_select_db("sistemas_segura", $db);
        $result = mysql_query("
        	SELECT 
        		t.idTurma,
        		t.nome as turma,        		
        		t.periodo,
        		t.status,        		
        		c.nome as curso,
        		i.nome as instrutor
        	FROM 
        		(	
        			turma t LEFT JOIN instrutor i on t.idInstrutor1 = i.idInstrutor
        		)

        		left join curso c on t.idCurso = c.idCurso
        	WHERE 
        		t.status = 'Ativo'", $db);
        
        // Escreve resultado até que não haja mais linhas na tabela
        while ($row = mysql_fetch_array($result)) {
            $turmas[] = $row;
        }
        mysql_free_result($result);
        mysql_close($db);
        
        if ($this->logado()) {
            $this->set("usuario", $u->login);
            $this->set("turmas", $turmas);

            //Abre a página da lista
            $this->show("pages/interno/modulo/turma/lista.tpl");
        } else {
            echo "<script>alert('Sua sessão expirou. Por favor, refaça seu login.'); window.location = '" . BASE_URL . "'</script>";
        }
    }
    
    function listarTurmasConcluidas() {
        //Inicia a sessÃ£o
        $this->init_session();

        //Recupera o id do usuário logado
        $idUsuario = $this->escape("user");
        //Recuperando dados do usuário
        $u = Doctrine::getTable("Usuario")->find($idUsuario);
	
	$db = mysql_connect("localhost", "root", "");
        mysql_select_db("sistemas_segura", $db);
        $result = mysql_query("
        	SELECT 
        		t.idTurma,
        		t.nome as turma,        		
        		t.periodo,
        		t.status,        		
        		c.nome as curso,
        		i.nome as instrutor
        	FROM 
        		(	
        			turma t LEFT JOIN instrutor i on t.idInstrutor1 = i.idInstrutor
        		)

        		left join curso c on t.idCurso = c.idCurso
        	WHERE 
        		t.status = 'Concluido'", $db);
        
        // Escreve resultado até que não haja mais linhas na tabela
        while ($row = mysql_fetch_array($result)) {
            $turmas[] = $row;
        }
        mysql_free_result($result);
        mysql_close($db);
        
        if ($this->logado()) {
            $this->set("usuario", $u->login);
            $this->set("turmas", $turmas);

            //Abre a página da lista
            $this->show("pages/interno/modulo/turma/lista.tpl");
        } else {
            echo "<script>alert('Sua sessão expirou. Por favor, refaça seu login.'); window.location = '" . BASE_URL . "'</script>";
        }
    }

    function cadastrar() {
        $this->init_session();

        //Recupera o id do usuário logado
        $idUsuario = $this->escape("user");
        $nome = $this->escape("nome");
        $curso = $this->escape("curso");
        $idInstrutor1 = $this->escape("idInstrutor1");
        $idInstrutor2 = $this->escape("idInstrutor2");
        $idInstrutor3 = $this->escape("idInstrutor3");
        $idInstrutor4 = $this->escape("idInstrutor4");
        $periodo = $this->escape("periodo");
        $local = $this->escape("local");
        $dataTurma = $this->escape("dataTurma");
        $valor = $this->escape("valor");
        $status = "Ativo";

        $usuario = Doctrine::getTable("Usuario")->find($idUsuario);

        $turma = new Turma();

        $turma->nome = $nome;
        $turma->idCurso = $curso;
        $turma->idInstrutor1 = $idInstrutor1;
        $turma->idInstrutor2 = $idInstrutor2;
        $turma->idInstrutor3 = $idInstrutor3;
        $turma->idInstrutor4 = $idInstrutor4;
        $turma->periodo = $periodo;
        $turma->local = $local;
        $turma->dataTurma = $dataTurma;
        $turma->valor = $valor;
        $turma->status = $status;
        $turma->usuarioResponsavel = $usuario->login;

        if ($turma->trySave()) {
            $this->success("Turma cadastrada com sucesso.");
        } else {
            $this->error("Erro ao cadastrar a turma. Tente novamente ou contate o administrador.");
        }
    }

    function enviarAtualizar() {
        $this->init_session();
        $idTurma = $this->getArg(0);

        //$turma = Doctrine::getTable("Turma")->findOneByIdturma($idTurma);
        
        $turmas = Doctrine_Query::create()
                ->select("t.*") // Seleciona os campos
                ->from("Turma t")
                ->where("t.idTurma = $idTurma")
                ->execute()
                ->toArray();

	$turma = $turmas[0];
        
        $cursos = Doctrine_Query::create()
                ->select("c.*") // Seleciona os campos
                ->from("Curso c")
                ->where("c.status like 'Ativo'")
                ->orderBy("c.nome")
                ->execute()
                ->toArray();
        
        $instrutores1 = Doctrine_Query::create()
                ->select("i.*") // Seleciona os campos
                ->from("Instrutor i")
                ->where("i.status like 'Ativo'")
                ->orderBy("i.nome")
                ->execute()
                ->toArray();
        
        $instrutores2 = Doctrine_Query::create()
                ->select("i.*") // Seleciona os campos
                ->from("Instrutor i")
                ->where("i.status like 'Ativo'")
                ->orderBy("i.nome")
                ->execute()
                ->toArray();
        
        $instrutores3 = Doctrine_Query::create()
                ->select("i.*") // Seleciona os campos
                ->from("Instrutor i")
                ->where("i.status like 'Ativo'")
                ->orderBy("i.nome")
                ->execute()
                ->toArray();
        
        $instrutores4 = Doctrine_Query::create()
                ->select("i.*") // Seleciona os campos
                ->from("Instrutor i")
                ->where("i.status like 'Ativo'")
                ->orderBy("i.nome")
                ->execute()
                ->toArray();

        $this->set("cursos", $cursos);
        $this->set("instrutores1", $instrutores1);
        $this->set("instrutores2", $instrutores2);
        $this->set("instrutores3", $instrutores3);
        $this->set("instrutores4", $instrutores4);
        $this->set("turma", $turma);
        $this->show("pages/interno/modulo/turma/atualizacao.tpl");
    }

    function atualizar() {
        $this->valida_sessao();

        $idTurma = $this->escape("idTurma");
        $nome = $this->escape("nome");
        $curso = $this->escape("curso");
        $idInstrutor1 = $this->escape("idInstrutor1");
        $idInstrutor2 = $this->escape("idInstrutor2");
        $idInstrutor3 = $this->escape("idInstrutor3");
        $idInstrutor4 = $this->escape("idInstrutor4");
        $periodo = $this->escape("periodo");
        $local = $this->escape("local");
        $dataTurma = $this->escape("dataTurma");
        $valor = $this->escape("valor");        
        
        $turma = Doctrine::getTable("Turma")->findOneByIdturma($idTurma);
        
        $turma->nome = $nome;
        $turma->idCurso = $curso;
        $turma->idInstrutor1 = $idInstrutor1;
        $turma->idInstrutor2 = $idInstrutor2;
        $turma->idInstrutor3 = $idInstrutor3;
        $turma->idInstrutor4 = $idInstrutor4;
        $turma->periodo = $periodo;
        $turma->local = $local;
        $turma->dataTurma = $dataTurma;
        $turma->valor = $valor;
        
        if ($turma->trySave()) {
            $this->success('Dados atualizados com sucesso.');
        } else {
            $this->error('Não foi possível atualizar os dados da turma.');
        }
    }

    function excluir() {
        $this->init_session();
        $idTurma = $this->escape("idTurma");

        $turma = Doctrine::getTable("Turma")->findOneByIdturma($idTurma);

        $turma->status = "Excluido";

        if ($turma->trySave()) {
            $this->success("Turma excluída com sucesso.");
        } else {
            $this->error("Erro ao excluir a turma. Tente novamente ou contate o administrador.");
        }
    }
    
    function concluirTurma() {
        $this->init_session();
        $idTurma = $this->escape("idTurma");

        $turma = Doctrine::getTable("Turma")->find($idTurma);

        if ($turma->status != "Concluido") {
        	//Alterando o status
	        $turma->status = "Concluido";
        }else{
        	//Alterando o status
	        $turma->status = "Ativo";	        
        }
      

        if ($turma->trySave()) 
            $this->success("Turma concluída com sucesso.");
         else 
            $this->error("Erro ao concluir a turma. Tente novamente ou contate o administrador.");
        
    }

    function visualizar() {
        $this->init_session();
        $idTurma = $this->getArg(0);
	
	//$turma = Doctrine::getTable("Turma")->findOneByIdturma($idTurma);
        
        $turmas = Doctrine_Query::create()
                ->select("t.*") // Seleciona os campos
                ->from("Turma t")
                ->where("t.idTurma = $idTurma")
                ->execute()
                ->toArray();

	$turma = $turmas[0];

        // Aqui pegamos a data, e dividimos ela em duas, usando a métodoExplode()
        $data = explode(" ", $turma["dataCadastro"]);

        // AQUI TEMOS AS DUAS PARTES
        $data1 = $data[0]; // DATA (xxxx-xx-xx)
        $data2 = $data[1]; // HORA (xx:xx:xx)
        // Agora dividimos a data em três partes, também usando o método Explode()
        $dataAno = explode("-", $data1);

        $dia = $dataAno[2]; // Retorna o dia
        $mes = $dataAno[1]; // Retorna o mês
        $ano = $dataAno[0]; // Retorna o ano

        $data = $dia . "/" . $mes . "/" . $ano . " às " . $data2;

        $turma["dataCadastro"] = $data;
        
        $prematriculados = Doctrine_Query::create()
                ->select("COUNT(m.status)")  
                ->from("Matricula m")
                ->where("m.idTurma = $idTurma and status='Pre-matricula'")
                ->execute()
                ->toArray();
        
        $matriculados = Doctrine_Query::create()
                ->select("COUNT(m.status)") 
                ->from("Matricula m")
                ->where("m.idTurma = $idTurma and status='Matriculado'")
                ->execute()
                ->toArray();       
        
        $cancelados = Doctrine_Query::create()
                ->select("COUNT(m.status)") 
                ->from("Matricula m")
                ->where("m.idTurma = $idTurma and status='Cancelado'")
                ->execute()
                ->toArray();
        
        $remarcados = Doctrine_Query::create()
                ->select("COUNT(m.status)") 
                ->from("Matricula m")
                ->where("m.idTurma = $idTurma and status='Remarcado'")
                ->execute()
                ->toArray();
        
        $concluidos = Doctrine_Query::create()
                ->select("COUNT(m.status)")
                ->from("Matricula m")
                ->where("m.idTurma = $idTurma and status='Concluido'")
                ->execute()
                ->toArray();
                
        $db = mysql_connect("localhost", "root", "");
        mysql_select_db("sistemas_segura", $db);
        $result = mysql_query("SELECT 
				   m.idMatricula, 
				   m.status, 
				   m.pagamento,
				   m.observacao, 
				   a.idAluno, 
				   a.nome as aluno,
				   a.vinculo, 
				   a.cpf, 
				   a.telefone1,
				   e.nomeFantasia as empresa,
				   t.idCurso,
				   c.nome as curso
			      FROM 
			      	 (
                                   ( 
                                     (
			               matricula m LEFT JOIN aluno a on m.idAluno = a.idAluno 
			      	     )  
  				    LEFT JOIN empresa e on a.vinculo = e.idEmpresa
  			      	   )
   		      	          LEFT JOIN turma t on m.idTurma = t.idTurma
				 )
                                 LEFT JOIN curso c on t.idCurso = c.idCurso
			      WHERE m.idTurma = $idTurma and 
			      a.status != 'Excluido' and 
			      m.status != 'Cancelado'", $db);
        
        // Escreve resultado até que não haja mais linhas na tabela
        while ($row = mysql_fetch_array($result)) {
            $alunos[] = $row;
        }
        mysql_free_result($result);
        mysql_close($db);
        
        
        // Consulta para instrutor1
	$db2 = mysql_connect("localhost", "root", "");
        mysql_select_db("sistemas_segura", $db2);
        $result2 = mysql_query("SELECT
				   i.nome as instrutor1
			      FROM 
  		      	          (
  		      	            (
                                      ( 
                                        (
			                  matricula m LEFT JOIN aluno a on m.idAluno = a.idAluno 
			      	        )  
  				       LEFT JOIN empresa e on a.vinculo = e.idEmpresa
  			      	      )
   		      	             LEFT JOIN turma t on m.idTurma = t.idTurma
				    )
                                   LEFT JOIN curso c on t.idCurso = c.idCurso
                                  )
	                        LEFT JOIN instrutor i on i.idInstrutor = t.idInstrutor1
			      WHERE m.idTurma = $idTurma and a.status != 'Excluido' and m.status != 'Cancelado'
			      LIMIT 0,1", $db2);
       
        // Escreve resultado até que não haja mais linhas na tabela
        while ($row2 = mysql_fetch_array($result2)) {
            $instrutores1[] = $row2;
        }
        mysql_free_result($result2);
        mysql_close($db2);     
	
	
	// Consulta para instrutor2
	$db3 = mysql_connect("localhost", "root", "");
        mysql_select_db("sistemas_segura", $db3);
        $result3 = mysql_query("SELECT
				   i.nome as instrutor2
			      FROM 
  		      	          (
  		      	            (
                                      ( 
                                        (
			                  matricula m LEFT JOIN aluno a on m.idAluno = a.idAluno 
			      	        )  
  				       LEFT JOIN empresa e on a.vinculo = e.idEmpresa
  			      	      )
   		      	             LEFT JOIN turma t on m.idTurma = t.idTurma
				    )
                                   LEFT JOIN curso c on t.idCurso = c.idCurso
                                  )
	                        LEFT JOIN instrutor i on i.idInstrutor = t.idInstrutor2
			      WHERE m.idTurma = $idTurma and 
			      a.status != 'Excluido' and 
			      m.status != 'Cancelado'
			      LIMIT 0,1", $db3);
       
        // Escreve resultado até que não haja mais linhas na tabela
        while ($row3 = mysql_fetch_array($result3)) {
            $instrutores2[] = $row3;
        }
        mysql_free_result($result3);
        mysql_close($db3);     
        
        
	// Consulta para instrutor3
	$db4 = mysql_connect("localhost", "root", "");
        mysql_select_db("sistemas_segura", $db4);
        $result4 = mysql_query("SELECT
				   i.nome as instrutor3
			      FROM 
  		      	          (
  		      	            (
                                      ( 
                                        (
			                  matricula m LEFT JOIN aluno a on m.idAluno = a.idAluno 
			      	        )  
  				       LEFT JOIN empresa e on a.vinculo = e.idEmpresa
  			      	      )
   		      	             LEFT JOIN turma t on m.idTurma = t.idTurma
				    )
                                   LEFT JOIN curso c on t.idCurso = c.idCurso
                                  )
	                        LEFT JOIN instrutor i on i.idInstrutor = t.idInstrutor3
			      WHERE m.idTurma = $idTurma and 
			      a.status != 'Excluido' and 
			      m.status != 'Cancelado'
			      LIMIT 0,1", $db4);
       
        // Escreve resultado até que não haja mais linhas na tabela
        while ($row4 = mysql_fetch_array($result4)) {
            $instrutores3[] = $row4;
        }
        mysql_free_result($result4);
        mysql_close($db4);     
        
        // ------------------------------------------------------------------------------------------------------------
        
        // Consulta para instrutor4
	$db5 = mysql_connect("localhost", "root", "");
        mysql_select_db("sistemas_segura", $db5);
        $result5 = mysql_query("SELECT
				   i.nome as instrutor4
			      FROM 
  		      	          (
  		      	            (
                                      ( 
                                        (
			                  matricula m LEFT JOIN aluno a on m.idAluno = a.idAluno 
			      	        )  
  				       LEFT JOIN empresa e on a.vinculo = e.idEmpresa
  			      	      )
   		      	             LEFT JOIN turma t on m.idTurma = t.idTurma
				    )
                                   LEFT JOIN curso c on t.idCurso = c.idCurso
                                  )
	                        LEFT JOIN instrutor i on i.idInstrutor = t.idInstrutor4
			      WHERE m.idTurma = $idTurma and 
			      a.status != 'Excluido' and 
			      m.status != 'Cancelado'
			      LIMIT 0,1", $db5);
       
        // Escreve resultado até que não haja mais linhas na tabela
        while ($row5 = mysql_fetch_array($result5)) {
            $instrutores4[] = $row5;
        }
        mysql_free_result($result5);
        mysql_close($db5);     
        
	
	$this->set("idTurma", $idTurma);
        $this->set("turma", $turma);
        $this->set("alunos", $alunos);
        $this->set("instrutores1", $instrutores1);
        $this->set("instrutores2", $instrutores2);
        $this->set("instrutores3", $instrutores3);
        $this->set("instrutores4", $instrutores4);
        $this->set("prematriculados", $prematriculados);
        $this->set("matriculados", $matriculados);
        $this->set("cancelados", $cancelados);
        $this->set("remarcados", $remarcados);
        $this->set("concluidos", $concluidos);
        $this->show("pages/interno/modulo/turma/visualizacao.tpl");
    }
    
    function pagamento() {
        //Inicia a sessão
        $this->init_session();

        //Recebendo parâmetros
        $idMatricula = $this->escape("idMatricula");

        //Buscando matricula desejada
        $matricula = Doctrine::getTable("Matricula")->find($idMatricula);

	if ($matricula->pagamento != "") {
        	//Alterando o pagamento
	        $matricula->pagamento= "";
        }else{
        	//Alterando o pagamento
	        $matricula->pagamento= date('d/m/y');	        
        }
        
        //Salvando
        if ($matricula->trySave())
        //Mensagem de confirmação
            $this->success($matricula->pagamento);
        else
        //Mensagem de erro
            $this->error('Não foi possível efetuar o pagamento.');
    }
    
    function confirmarMatricula() {
        //Inicia a sessão
        $this->init_session();

        //Recebendo parâmetros
        $idMatricula = $this->escape("idMatricula");

        //Buscando matricula desejada
        $matricula = Doctrine::getTable("Matricula")->find($idMatricula);
	
	if ($matricula->status === "Matriculado") {
        	//Alterando o status
	        $matricula->status = "Pre-matricula";
        }else{
        	//Alterando o status
	        $matricula->status = "Matriculado";	        
        }
	
        //Alterando o status
        //$matricula->status = "Matriculado";

        //Salvando
        if ($matricula->trySave()){
            $this->success('Matrícula confirmada com sucesso.');
        }
        else{
            $this->error('Não foi possível confirmar a matricula.');
        }
    }
    
    function confirmarObservacao() {
        $this->init_session();
        $idMatricula = $this->escape("idMatricula");
        $observacao= $this->escape("observacao");

        $matricula = Doctrine::getTable("Matricula")->find($idMatricula);

        $matricula->observacao = $observacao;

        if ($matricula->trySave()){
            $this->success('Observação adicionada com sucesso.');
        }
        else{
            $this->error('Não foi possível adicionar a observação.');
        }
    }
    
    function cancelarMatricula() {
        //Inicia a sessão
        $this->init_session();

        //Recebendo parâmetros
        $idMatricula = $this->escape("idMatricula");

        //Buscando matricula desejada
        $matricula = Doctrine::getTable("Matricula")->find($idMatricula);

        //Alterando o status
        $matricula->status = "Cancelado";

        //Salvando
        if ($matricula->trySave())
        //Mensagem de confirmação
            $this->success('Matrícula cancelada com sucesso.');
        else
        //Mensagem de erro
            $this->error('Não foi possível cancelar a matricula.');
    }

    function concluirCurso() {
        //Inicia a sessão
        $this->init_session();

        //Recebendo parâmetros
        $idMatricula = $this->escape("idMatricula");

        //Buscando matricula desejada
        $matricula = Doctrine::getTable("Matricula")->find($idMatricula);

        //Alterando o status
        $matricula->status = "Concluido";

        //Salvando
        if ($matricula->trySave())
        //Mensagem de confirmação
            $this->success('Curso concluído com sucesso.');
        else
        //Mensagem de erro
            $this->error('Não foi possível concluir o curso.');
    }
    
    function remarcarTurma() {
        //Inicia a sessão
        $this->init_session();

        //Recebendo parâmetros
        $idMatricula = $this->escape("idMatricula");

        //Buscando matricula desejada
        $matricula = Doctrine::getTable("Matricula")->find($idMatricula);

        //Alterando o status
        $matricula->status = "Remarcado";

        //Salvando
        if ($matricula->trySave())
        //Mensagem de confirmação
            $this->success('Matrícula remarcada com sucesso.');
        else
        //Mensagem de erro
            $this->error('Não foi possível remarcar a matricula.');
    }


    function mostrarRealizarMatricula() {
        $this->init_session();
        $idTurma = $this->getArg(0);

        $this->set("idTurma", $idTurma);
        $this->show("pages/interno/modulo/turma/matricula.tpl");
    }

    function realizarMatricula() {
        //Inicia a sessÃ£o
        $this->init_session();

        //Recupera o id do usuário logado
        $idUsuario = $this->escape("user");
        $idTurma = $this->escape("idTurma");
        $alunos = json_decode($this->escape("alunos"));

        $u = Doctrine::getTable("Usuario")->find($idUsuario);

        $v = 1;
        $idAluno = "";
        $retorno = true;

        for ($i = 0; $i < count($alunos); $i++) {
            $matricula = new Matricula();

            $matricula->idTurma = $idTurma;
            $matricula->idAluno = $alunos[$i]->idAluno;
            $matricula->status = "Pre-matricula";
            $matricula->usuarioResponsavel = $u->login;
            
            $idAluno = $matricula->idAluno;

            $v = Doctrine_Query::create()
                    ->select("m.*")
                    ->from("Matricula m")
                    ->where("m.idAluno = $idAluno and m.idTurma = $idTurma and m.status not like 'Cancelado'")
                    ->execute();

            if ($v->count() == 0) {
                $matricula->trySave();
            } else {
                $this->success("Aluno já está cadastrado na turma. Por favor, retire-o da lista de pré-matrícula.");
            }
        }

        if ($retorno) {
            $this->success("Matrícula realizada com sucesso.");
        } else {
            $this->error("Erro ao realizar matrícula. Tente novamente ou contate o administrador do sistema.");
        }
    }

    function emitirRecibo() {
        $this->init_session();

        //Recupera o id do usuário logado
        $idMatricula = $this->escape("idMatricula");

        $db = mysql_connect("localhost", "root", "");
        mysql_select_db("sistemas_segura", $db);

        $result = mysql_query("SELECT 
           m.idMatricula, 
           m.status, 
           m.pagamento,
           a.nome as aluno, 
           a.telefone1,
           a.cpf,
           c.nome as curso,
           t.valor 
        FROM 
            (
                (
                   matricula m LEFT JOIN aluno a on m.idAluno = a.idAluno 
                )
                LEFT JOIN turma t on m.idTurma = t.idTurma
            ) 
            LEFT JOIN curso c on t.idCurso = c.idCurso
        WHERE 
           m.idMatricula = $idMatricula", $db);

        // Escreve resultado até que não haja mais linhas na tabela
        while ($row = mysql_fetch_array($result)) {
            $matricula[] = $row;
        }
        mysql_free_result($result);
        mysql_close($db);


        $f = fopen("C:\\xampp\\htdocs\\recibo\\recibo.txt", "w+");


        fwrite($f, "Emissao de Recibo\n");
        fwrite($f, "SEGURA TREINAMENTOS ESPECIALIZADOS LTDA\n"); 
        fwrite($f, "21.370.136/0001-63\n");
        fwrite($f, "(84) 3312.6006 / 8898.4382\n");
        fwrite($f, "www.segurarn.com.br\n");       
        fwrite($f, "--------------------------------\n");
        fwrite($f, "Matricula: ");
        fwrite($f, "" .$matricula[0]["idMatricula"]. "\n");
        fwrite($f, "Nome: ");
        fwrite($f, "" .$matricula[0]["aluno"]. "\n");
        fwrite($f, "Telefone: ");
        fwrite($f, "" .$matricula[0]["telefone1"]. "\n");
        fwrite($f, "CPF: ");
        fwrite($f, "" .$matricula[0]["cpf"]. "\n");
        fwrite($f, "Curso: ");
        fwrite($f, "" .$matricula[0]["curso"]. "\n");
        fwrite($f, "Data de Pagamento: ");
        fwrite($f, "" .$matricula[0]["pagamento"]. "\n");        
        fwrite($f, "Valor: ");
        fwrite($f, "" .$matricula[0]["valor"]. "\n");
        fwrite($f, "--------------------------------");

        fclose($f);
        
        echo json_encode($idMatricula);
    }
}

?>