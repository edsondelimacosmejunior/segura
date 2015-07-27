<?php

Class Controller_Aluno extends Proto_Controller {

//Classe de controle onde o próprio nome da função da mostra que ação realiza
    function index() {
        $this->init_session();
        $this->show("pages/interno/index.tpl");
    }

    function mostrarCadastro() {
        $this->init_session();

        $empresas = Doctrine_Query::create()
                ->select("e.*") // Seleciona os campos
                ->from("Empresa e")
                ->where("e.status like 'Ativo'")
                ->orderBy("e.nomeFantasia")
                ->execute()
                ->toArray();

        $this->set("empresas", $empresas);
        $this->show("pages/interno/modulo/aluno/cadastro.tpl");
    }

    function listarAlunos() {
        //Inicia a sessÃ£o
        $this->init_session();

        //Recupera o id do usuário logado
        $idUsuario = $this->escape("user");
        //Recuperando dados do usuário
        $u = Doctrine::getTable("Usuario")->find($idUsuario);

        $alunos = Doctrine_Query::create()
                ->select("a.*") // Seleciona os campos
                ->from("Aluno a")
                ->where("status != 'Excluido'")
                ->execute()
                ->toArray();

        if ($this->logado()) {
            $this->set("usuario", $u->login);
            $this->set("alunos", $alunos);

            //Abre a página da lista
            $this->show("pages/interno/modulo/aluno/lista.tpl");
        } else {
            echo "<script>alert('Sua sessão expirou. Por favor, refaça seu login.'); window.location = '" . BASE_URL . "'</script>";
        }
    }
    
    function mostrarPesquisa() {
        //Inicia a sessÃ£o
        $this->init_session();

        //Recupera o id do usuário logado
        $idUsuario = $this->escape("user");
        //Recuperando dados do usuário
        $u = Doctrine::getTable("Usuario")->find($idUsuario);

        if ($this->logado()) {

            //Abre a página da lista
            $this->show("pages/interno/modulo/aluno/pesquisa.tpl");
        } else {
            echo "<script>alert('Sua sessão expirou. Por favor, refaça seu login.'); window.location = '" . BASE_URL . "'</script>";
        }
    }

    function cadastrar() {

        $this->init_session();

        //Recupera o id do usuário logado
        $idUsuario = $this->escape("user");
        $usuario = Doctrine::getTable("Usuario")->find($idUsuario);

        $nome = $this->escape("nome");
        $sexo = $this->escape("sexo");
        $cpf = $this->escape("cpf");
        $matricula = $this->escape("matricula");
        $rg = $this->escape("rg");
        $dataNascimento = $this->escape("dataNascimento");
        $rua = $this->escape("rua");
        $numero = $this->escape("numero");
        $bairro = $this->escape("bairro");
        $cep = $this->escape("cep");
        $cidade = $this->escape("cidade");
        $uf = $this->escape("uf");
        $email = $this->escape("email");
        $telefone1 = $this->escape("telefone1");
        $telefone2 = $this->escape("telefone2");
        $escolaridade = $this->escape("escolaridade");
        $vinculo = $this->escape("vinculo");
        $status = "Ativo";
        
     	$verificaCPF = $cpf;

        $v = Doctrine_Query::create()
                ->select("a.*")
                ->from("Aluno a")
                ->where("a.status like 'Ativo'")
                ->andWhere("a.cpf = '$verificaCPF'")
                ->andWhere("a.cpf != ''")
                ->execute();

        if ($v->count() == 0) {
     
	        $aluno = new Aluno();
	
	        $aluno->nome = $nome;
	        $aluno->sexo = $sexo;
	        $aluno->cpf = $cpf;
	        $aluno->matricula = $matricula;        
	        $aluno->rg = $rg;
	        $aluno->dataNascimento = $dataNascimento;
	        $aluno->rua = $rua;
	        $aluno->numero = $numero;
	        $aluno->bairro = $bairro;
	        $aluno->cep = $cep;
	        $aluno->cidade = $cidade;
	        $aluno->uf = $uf;
	        $aluno->email = $email;
	        $aluno->telefone1 = $telefone1;
	        $aluno->telefone2 = $telefone2;
	        $aluno->escolaridade = $escolaridade;
	        $aluno->vinculo = $vinculo;
	        $aluno->status = $status;
        	$aluno->usuarioResponsavel = $usuario->login;

	        if ($aluno->trySave()) {
	            $this->success("Aluno cadastrado com sucesso.");
        	} else {
	            $this->error("Erro ao cadastrar o aluno. Tente novamente ou contate o administrador.");
        	}
        } else {
            $this->error("CPF já cadastrado.");
        }
    }

    function enviarAtualizar() {
        $this->init_session();
        $idAluno = $this->getArg(0);

        //$aluno = Doctrine::getTable("Aluno")->findOneByIdaluno($idAluno);
        
        $alunos = Doctrine_Query::create()
                ->select("a.*") // Seleciona os campos
                ->from("Aluno a")
                ->where("a.idAluno = $idAluno")
                ->execute()
                ->toArray();

	$aluno = $alunos[0];

        $empresas = Doctrine_Query::create()
                ->select("e.*") // Seleciona os campos
                ->from("Empresa e")
                ->where("e.status like 'Ativo'")
                ->execute()
                ->toArray();

        $this->set("empresas", $empresas);
        $this->set("aluno", $aluno);
        $this->show("pages/interno/modulo/aluno/atualizacao.tpl");
    }

    function atualizar() {
        $this->valida_sessao();

        $idAluno = $this->escape("idAluno");
        $nome = $this->escape("nome");
        $sexo = $this->escape("sexo");
        $cpf = $this->escape("cpf");
        $matricula = $this->escape("matricula");        
        $rg = $this->escape("rg");
        $dataNascimento = $this->escape("dataNascimento");
        $rua = $this->escape("rua");
        $numero = $this->escape("numero");
        $bairro = $this->escape("bairro");
        $cep = $this->escape("cep");
        $cidade = $this->escape("cidade");
        $uf = $this->escape("uf");
        $email = $this->escape("email");
        $telefone1 = $this->escape("telefone1");
        $telefone2 = $this->escape("telefone2");
        $escolaridade = $this->escape("escolaridade");
        $vinculo = $this->escape("vinculo");
        //$status = $this->escape("status");

        $aluno = Doctrine::getTable("Aluno")->findOneByIdaluno($idAluno);

        $aluno->nome = $nome;
        $aluno->sexo = $sexo;
        $aluno->cpf = $cpf;
        $aluno->matricula = $matricula;        
        $aluno->rg = $rg;
        $aluno->dataNascimento = $dataNascimento;
        $aluno->rua = $rua;
        $aluno->numero = $numero;
        $aluno->bairro = $bairro;
        $aluno->cep = $cep;
        $aluno->cidade = $cidade;
        $aluno->uf = $uf;
        $aluno->email = $email;
        $aluno->telefone1 = $telefone1;
        $aluno->telefone2 = $telefone2;
        $aluno->escolaridade = $escolaridade;
        $aluno->vinculo = $vinculo;

        if ($aluno->trySave()) {
            $this->success('Dados atualizados com sucesso.');
        } else {
            $this->error('Não foi possível atualizar os dados do aluno.');
        }
    }

    function excluir() {
        $this->init_session();
        $idAluno = $this->escape("idAluno");

        $aluno = Doctrine::getTable("Aluno")->findOneByIdaluno($idAluno);

        $aluno->status = "Excluido";

        if ($aluno->trySave()) {
            $this->success("Aluno excluído com sucesso.");
        } else {
            $this->error("Erro ao excluir o aluno. Tente novamente ou contate o administrador.");
        }
    }

    function visualizar() {
        $this->init_session();
        $idAluno = $this->getArg(0);

	$db = mysql_connect("localhost", "root", "");
	mysql_select_db("sistemas_segura", $db);
	$result = mysql_query("
                SELECT 
                    a.*,
                    e.nomeFantasia
                FROM
                    aluno a LEFT JOIN empresa e on a.vinculo = e.idEmpresa
                WHERE 
                    a.idAluno = $idAluno", $db);

	// Escreve resultado até que não haja mais linhas na tabela
	while ($row = mysql_fetch_array($result)) {
	    $alunos[] = $row;
	}
	mysql_free_result($result);
	mysql_close($db);
	
	$aluno = $alunos[0];

        // Aqui pegamos a data, e dividimos ela em duas, usando a métodoExplode()
        $data = explode(" ", $aluno["dataCadastro"]);

        // AQUI TEMOS AS DUAS PARTES
        $data1 = $data[0]; // DATA (xxxx-xx-xx)
        $data2 = $data[1]; // HORA (xx:xx:xx)
        // Agora dividimos a data em três partes, também usando o método Explode()
        $dataAno = explode("-", $data1);

        $dia = $dataAno[2]; // Retorna o dia
        $mes = $dataAno[1]; // Retorna o mês
        $ano = $dataAno[0]; // Retorna o ano

        /* Como deve ter notado, dentro das variáveis existem o número de array, o 0(zero) trás o ano, 1 o mês e o 2 o dia para saber mais recomendo pesquisar sobre a função

          Agora vamos formatar a data, trazemos as strings, e a hora
          Aonde dia traz a string $data1[2]
          Aonde mês traz a string $data1[1]
          Aonde ano traz a string $data1[0]

          Como não precisamos "explodir" a hora trazemos ela normalmente através da string $data2

         */
        $data = $dia . "/" . $mes . "/" . $ano . " às " . $data2;

        $aluno["dataCadastro"] = $data;

        $this->set("aluno", $aluno);
        $this->show("pages/interno/modulo/aluno/visualizacao.tpl");
    }

    function getAlunos() {
        //Inicia a sessão
        $this->init_session();

        //Recupera os filtros do aluno
        $nome = $this->escape("nome");
        $cpf = $this->escape("cpf");
        $rg = $this->escape("rg");

        $alunos = Doctrine_Query::create()
                ->select("a.idAluno, a.nome, a.cpf, a.rg, a.dataNascimento, a.status, telefone1")
                ->from("Aluno a")
                ->where("a.nome like '%$nome%' and a.cpf like '%$cpf%' and a.rg like '%$rg%' and a.status like 'Ativo'")
                ->execute()
                ->toArray();

        //Retorna a variável $resultado
        echo json_encode($alunos);
    }
    
    function listarCursos() {
        //Inicia a sessÃ£o
        $this->init_session();

        $idAluno = $this->escape("idAluno");

	$db = mysql_connect("localhost", "root", "");
	mysql_select_db("sistemas_segura", $db);
	$result = mysql_query("
                SELECT 
                    a.idAluno,
                    a.nome,
                    t.idTurma,
                    c.nome as curso,
                    t.nome as turma,
                    t.periodo,
                    t.dataTurma,
                    m.idMatricula,
                    m.status
                FROM
                    (
                        (
                            aluno a LEFT JOIN matricula m on a.idAluno = m.idAluno
                        ) 
                        LEFT JOIN turma t on m.idTurma = t.idTurma
                    )
                    LEFT JOIN curso c on t.idCurso = c.idCurso
                WHERE 
                    a.idAluno = $idAluno", $db);

	// Escreve resultado atÃ© que nÃ£o haja mais linhas na tabela
	while ($row = mysql_fetch_array($result)) {
	    $alunos[] = $row;
	}

        $this->set("alunos", $alunos);
        $this->show("pages/interno/modulo/aluno/cursos.tpl");
    }

}
?>