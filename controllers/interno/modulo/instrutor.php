<?php

Class Controller_Instrutor extends Proto_Controller {

//Classe de controle onde o próprio nome da função da mostra que ação realiza
    function index() {
        $this->init_session();
        $this->show("pages/interno/index.tpl");
    }

    function mostrarCadastro() {
        $this->init_session();
        $this->show("pages/interno/modulo/instrutor/cadastro.tpl");
    }

    function listarInstrutores() {
        //Inicia a sessÃ£o
        $this->init_session();

        //Recupera o id do usuário logado
        $idUsuario = $this->escape("user");
        //Recuperando dados do usuário
        $u = Doctrine::getTable("Usuario")->find($idUsuario);

        $instrutores = Doctrine_Query::create()
                ->select("i.*") // Seleciona os campos
                ->from("Instrutor i")
                ->where("status != 'Excluido'")
                ->execute()
                ->toArray();

        if ($this->logado()) {
            $this->set("usuario", $u->login);
            $this->set("instrutores", $instrutores);

            //Abre a página da lista
            $this->show("pages/interno/modulo/instrutor/lista.tpl");
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
        $formacao = $this->escape("formacao");
        $numeroRegistro = $this->escape("numeroRegistro");
        $status = "Ativo";

        $instrutor = new Instrutor();

        $instrutor->nome = $nome;
        $instrutor->sexo = $sexo;
        $instrutor->cpf = $cpf;
        $instrutor->rg = $rg;
        $instrutor->dataNascimento = $dataNascimento;
        $instrutor->rua = $rua;
        $instrutor->numero = $numero;
        $instrutor->bairro = $bairro;
        $instrutor->cep = $cep;
        $instrutor->cidade = $cidade;
        $instrutor->uf = $uf;
        $instrutor->email = $email;
        $instrutor->telefone1 = $telefone1;
        $instrutor->telefone2 = $telefone2;
        $instrutor->escolaridade = $escolaridade;
        $instrutor->formacao = $formacao;
        $instrutor->numeroRegistro = $numeroRegistro;
        $instrutor->status = $status;
        $instrutor->usuarioResponsavel = $usuario->login;

        if ($instrutor->trySave()) {
            $this->success("Instrutor cadastrado com sucesso.");
        } else {
            $this->error("Erro ao cadastrar o instrutor. Tente novamente ou contate o administrador.");
        }
    }

    function enviarAtualizar() {
        $this->init_session();
        $idInstrutor = $this->getArg(0);

        //$instrutor = Doctrine::getTable("Instrutor")->findOneByIdinstrutor($idInstrutor);
        
        $instrutores = Doctrine_Query::create()
                ->select("i.*") // Seleciona os campos
                ->from("Instrutor i")
                ->where("i.idInstrutor = $idInstrutor")
                ->execute()
                ->toArray();

	$instrutor = $instrutores[0];

        $this->set("instrutor", $instrutor);
        $this->show("pages/interno/modulo/instrutor/atualizacao.tpl");
    }

    function atualizar() {
        $this->valida_sessao();

        $idInstrutor = $this->escape("idInstrutor");
        $nome = $this->escape("nome");
        $sexo = $this->escape("sexo");
        $cpf = $this->escape("cpf");
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
        $formacao = $this->escape("formacao");
        $numeroRegistro = $this->escape("numeroRegistro");

        $instrutor = Doctrine::getTable("Instrutor")->findOneByIdinstrutor($idInstrutor);

        $instrutor->nome = $nome;
        $instrutor->sexo = $sexo;
        $instrutor->cpf = $cpf;
        $instrutor->rg = $rg;
        $instrutor->dataNascimento = $dataNascimento;
        $instrutor->rua = $rua;
        $instrutor->numero = $numero;
        $instrutor->bairro = $bairro;
        $instrutor->cep = $cep;
        $instrutor->cidade = $cidade;
        $instrutor->uf = $uf;
        $instrutor->email = $email;
        $instrutor->telefone1 = $telefone1;
        $instrutor->telefone2 = $telefone2;
        $instrutor->escolaridade = $escolaridade;
        $instrutor->formacao = $formacao;
        $instrutor->numeroRegistro = $numeroRegistro;

        if ($instrutor->trySave()) {
            $this->success('Dados atualizados com sucesso.');
        } else {
            $this->error('Não foi possível atualizar os dados do instrutor.');
        }
    }

    function excluir() {
        $this->init_session();
        $idInstrutor = $this->escape("idInstrutor");

        $instrutor = Doctrine::getTable("Instrutor")->findOneByIdinstrutor($idInstrutor);

        $instrutor->status = "Excluido";

        if ($instrutor->trySave()) {
            $this->success("Instrutor excluído com sucesso.");
        } else {
            $this->error("Erro ao excluir o instrutor. Tente novamente ou contate o administrador.");
        }
    }

    function visualizar() {
        $this->init_session();
        $idInstrutor = $this->getArg(0);

        //$instrutor = Doctrine::getTable("Instrutor")->findOneByIdinstrutor($idInstrutor);
        
        $instrutores = Doctrine_Query::create()
                ->select("i.*") // Seleciona os campos
                ->from("Instrutor i")
                ->where("i.idInstrutor = $idInstrutor")
                ->execute()
                ->toArray();

	$instrutor = $instrutores[0];

        // Aqui pegamos a data, e dividimos ela em duas, usando a métodoExplode()
        $data = explode(" ", $instrutor["dataCadastro"]);

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

        $instrutor["dataCadastro"] = $data;

        $this->set("instrutor", $instrutor);
        $this->show("pages/interno/modulo/instrutor/visualizacao.tpl");
    }

    function enviarFormularioUploadCurriculo() {
        $this->init_session();
        $idInstrutor = $this->getArg(0);

        $instrutor = Doctrine::getTable("Instrutor")->findOneByIdinstrutor($idInstrutor);

        $this->set("instrutor", $instrutor);
        $this->show("pages/interno/modulo/instrutor/uploadCurriculo.tpl");
    }

    function armazenarCurriculo() {
        //Inicia a sessão
        $this->init_session();
        
        $idInstrutor = $this->escape("idInstrutor");
        $extensao = $this->escape("extensao");

        $instrutor = Doctrine::getTable("Instrutor")->findOneByIdinstrutor($idInstrutor);
        
        //Atribui os valores do formulário ao objeto
        $instrutor->patchCurriculum = microtime() . "" . $extensao;

        if ($instrutor->trySave()) {
            //Envia a mensagem de confirmação de cadastro
            $this->success($instrutor->patchCurriculum);
        } else {
            //Envia a mensagem de erro em caso de falha no cadastro
            $this->error("Erro ao salvar.");
        }

    }
    
    function uploadCurriculo() {
        $nome = $_POST['uploadCurriculoInstrutor_nomeUpload'];
        $uploaddir = 'view/imgs/uploads/';
        $uploadfile = $uploaddir . $_FILES['userfile']['name'];

        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir . $nome)) {
            header('Location: http://10.0.0.250/segura/interno/');
        } else {
            print "Erro de upload. Aqui está alguma informação:\n";
            print_r($_FILES);
        }
    }
    
    function enviarFormularioUploadContrato() {
        $this->init_session();
        $idInstrutor = $this->getArg(0);

        $instrutor = Doctrine::getTable("Instrutor")->findOneByIdinstrutor($idInstrutor);

        $this->set("instrutor", $instrutor);
        $this->show("pages/interno/modulo/instrutor/uploadContrato.tpl");
    }

    function armazenarContrato() {
        //Inicia a sessão
        $this->init_session();
        
        $idInstrutor = $this->escape("idInstrutor");
        $extensao = $this->escape("extensao");

        $instrutor = Doctrine::getTable("Instrutor")->findOneByIdinstrutor($idInstrutor);
        
        //Atribui os valores do formulário ao objeto
        $instrutor->patchContrato = microtime() . "" . $extensao;

        if ($instrutor->trySave()) {
            //Envia a mensagem de confirmação de cadastro
            $this->success($instrutor->patchContrato);
        } else {
            //Envia a mensagem de erro em caso de falha no cadastro
            $this->error("Erro ao salvar.");
        }

    }
    
    function uploadContrato() {
        $nome = $_POST['uploadContratoInstrutor_nomeUpload'];
        $uploaddir = 'view/imgs/uploads/';
        $uploadfile = $uploaddir . $_FILES['userfile']['name'];

        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir . $nome)) {
            header('Location: http://10.0.0.250/segura/interno/');
        } else {
            print "Erro de upload. Aqui está alguma informação:\n";
            print_r($_FILES);
        }
    }
    
    function enviarFormularioUploadAssinatura() {
        $this->init_session();
        $idInstrutor = $this->getArg(0);

        $instrutor = Doctrine::getTable("Instrutor")->findOneByIdinstrutor($idInstrutor);

        $this->set("instrutor", $instrutor);
        $this->show("pages/interno/modulo/instrutor/uploadAssinatura.tpl");
    }

    function armazenarAssinatura() {
        //Inicia a sessão
        $this->init_session();
        
        $idInstrutor = $this->escape("idInstrutor");
        $extensao = $this->escape("extensao");

        $instrutor = Doctrine::getTable("Instrutor")->findOneByIdinstrutor($idInstrutor);
        
        //Atribui os valores do formulário ao objeto
        $instrutor->patchAssinatura = microtime() . "" . $extensao;

        if ($instrutor->trySave()) {
            //Envia a mensagem de confirmação de cadastro
            $this->success($instrutor->patchAssinatura);
        } else {
            //Envia a mensagem de erro em caso de falha no cadastro
            $this->error("Erro ao salvar.");
        }

    }
    
    function uploadAssinatura() {
        $nome = $_POST['uploadAssinaturaInstrutor_nomeUpload'];
        $uploaddir = 'view/imgs/uploads/';
        $uploadfile = $uploaddir . $_FILES['userfile']['name'];

        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir . $nome)) {
            header('Location: http://10.0.0.250/segura/interno/');
        } else {
            print "Erro de upload. Aqui está alguma informação:\n";
            print_r($_FILES);
        }
    }
}
?>