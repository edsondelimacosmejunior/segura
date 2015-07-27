<?php

Class Controller_Curso extends Proto_Controller {

//Classe de controle onde o próprio nome da função da mostra que ação realiza
    function index() {
        $this->init_session();
        $this->show("pages/interno/index.tpl");
    }

    function mostrarCadastro() {
        $this->init_session();
        $this->show("pages/interno/modulo/curso/cadastro.tpl");
    }

    function listarCursos() {
        $this->init_session();

        //Recupera o id do usuário logado
        $idUsuario = $this->escape("user");
        //Recuperando dados do usuário
        $u = Doctrine::getTable("Usuario")->find($idUsuario);

        $cursos = Doctrine_Query::create()
                ->select("c.*") // Seleciona os campos
                ->from("Curso c")
                ->where("status != 'Excluido'")
                ->execute()
                ->toArray();

        if ($this->logado()) {
            $this->set("usuario", $u->login);
            $this->set("cursos", $cursos);

            $this->show("pages/interno/modulo/curso/lista.tpl");
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
        $cargaHoraria = $this->escape("cargaHoraria");
        $conteudo = $this->escape("conteudo");
        //$valor = $this->escape("valor");
        $validade = $this->escape("validade");
        $corFundo= $this->escape("corFundo"); 
        $corFonte= $this->escape("corFonte");
        $tamanhoFonte= $this->escape("tamanhoFonte");        
        $status = "Ativo";
        
        $curso = new Curso();
                
        $curso->nome = $nome;
        $curso->cargaHoraria = $cargaHoraria;
        $curso->conteudo = $conteudo;
        //$curso->valor = $valor;
        $curso->validade = $validade;
        $curso->corFundo = $corFundo;
        $curso->corFonte = $corFonte;
        $curso->tamanhoFonte = $tamanhoFonte;
        $curso->status = $status;
        $curso->usuarioResponsavel = $usuario->login;

        if ($curso->trySave()) {
            $this->success("Curso cadastrado com sucesso.");
        } else {
            $this->error("Erro ao cadastrar o curso. Tente novamente ou contate o administrador.");
        }
    }

    function enviarAtualizar() {
        $this->init_session();
        $idCurso = $this->getArg(0);

        //$curso = Doctrine::getTable("Curso")->findOneByIdcurso($idCurso);
        
        $cursos = Doctrine_Query::create()
                ->select("c.*") // Seleciona os campos
                ->from("Curso c")
                ->where("c.idCurso = $idCurso")
                ->execute()
                ->toArray();

	$curso = $cursos[0];

        $this->set("curso", $curso);
        $this->show("pages/interno/modulo/curso/atualizacao.tpl");
    }

    function atualizar() {
        $this->valida_sessao();

        $idCurso = $this->escape("idCurso");
        $nome = $this->escape("nome");
        $cargaHoraria = $this->escape("cargaHoraria");
        $conteudo = $this->escape("conteudo");
        //$valor = $this->escape("valor");
        $validade = $this->escape("validade");
        $corFundo = $this->escape("corFundo");
        $corFonte = $this->escape("corFonte");
        $tamanhoFonte = $this->escape("tamanhoFonte");
       
        $curso = Doctrine::getTable("Curso")->findOneByIdcurso($idCurso);

        $curso->nome = $nome;
        $curso->cargaHoraria = $cargaHoraria;
        $curso->conteudo = $conteudo;
        //$curso->valor = $valor;
        $curso->validade = $validade;
        $curso->corFundo = $corFundo;
        $curso->corFonte = $corFonte;
        $curso->tamanhoFonte = $tamanhoFonte;
        
        if ($curso->trySave()) {
            $this->success('Dados atualizados com sucesso.');
        } else {
            $this->error('Não foi possível atualizar os dados do curso.');
        }
    }

    function excluir() {
        $this->init_session();
        $idCurso = $this->escape("idCurso");

        $curso = Doctrine::getTable("Curso")->findOneByIdcurso($idCurso);

        $curso-> status= "Excluido";

        if ($curso->trySave()) {
            $this->success("Curso excluído com sucesso.");
        } else {
            $this->error("Erro ao excluir o curso. Tente novamente ou contate o administrador.");
        }
    }

    function visualizar() {
        $this->init_session();
        $idCurso = $this->getArg(0);

        //$curso = Doctrine::getTable("Curso")->findOneByIdcurso($idCurso);
        
        $cursos = Doctrine_Query::create()
                ->select("c.*") // Seleciona os campos
                ->from("Curso c")
                ->where("c.idCurso = $idCurso")
                ->execute()
                ->toArray();

	$curso = $cursos[0];

        // Aqui pegamos a data, e dividimos ela em duas, usando a métodoExplode()
        $data = explode(" ", $curso["dataCadastro"]);

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

        $curso["dataCadastro"] = $data;

        $this->set("curso", $curso);
        $this->show("pages/interno/modulo/curso/visualizacao.tpl");
    }
    
    function enviarFormularioUploadConteudo() {
        $this->init_session();
        $idCurso = $this->getArg(0);

        $curso = Doctrine::getTable("Curso")->findOneByIdcurso($idCurso);

        $this->set("curso", $curso);
        $this->show("pages/interno/modulo/curso/uploadConteudo.tpl");
    }

    function armazenarConteudo() {
        //Inicia a sessão
        $this->init_session();
        
        $idCurso = $this->escape("idCurso");
        $extensao = $this->escape("extensao");

        $curso = Doctrine::getTable("Curso")->findOneByIdcurso($idCurso);
        
        //Atribui os valores do formulário ao objeto
        $curso->patchConteudo = microtime() . "" . $extensao;

        if ($curso->trySave()) {
            //Envia a mensagem de confirmação de cadastro
            $this->success($curso->patchConteudo);
        } else {
            //Envia a mensagem de erro em caso de falha no cadastro
            $this->error("Erro ao salvar.");
        }

    }
    
    function uploadConteudo() {
        $nome = $_POST['uploadConteudoCurso_nomeUpload'];
        $uploaddir = 'view/imgs/uploads/';
        $uploadfile = $uploaddir . $_FILES['userfile']['name'];

        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir . $nome)) {
            header('Location: http://10.0.0.250/segura/interno/');
        } else {
            print "Erro de upload. Aqui está alguma informação:\n";
            print_r($_FILES);
        }
    }
    
    function certificados(){
        
        
    }
}
?>