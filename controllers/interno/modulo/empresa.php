<?php

Class Controller_Empresa extends Proto_Controller {

//Classe de controle onde o próprio nome da função da mostra que ação realiza
    function index() {
        $this->init_session();
        $this->show("pages/interno/index.tpl");
    }

    function mostrarCadastro() {
        $this->init_session();
        $this->show("pages/interno/modulo/empresa/cadastro.tpl");
    }

    function listarEmpresas() {
        //Inicia a sessÃ£o
        $this->init_session();

        //Recupera o id do usuário logado
        $idUsuario = $this->escape("user");
        //Recuperando dados do usuário
        $u = Doctrine::getTable("Usuario")->find($idUsuario);

        $empresas = Doctrine_Query::create()
                ->select("e.*") // Seleciona os campos
                ->from("Empresa e")
                ->where("status != 'Excluido'")
                ->execute()
                ->toArray();

        if ($this->logado()) {
            $this->set("usuario", $u->login);
            $this->set("empresas", $empresas);

            //Abre a página da lista
            $this->show("pages/interno/modulo/empresa/lista.tpl");
        } else {
            echo "<script>alert('Sua sessão expirou. Por favor, refaça seu login.'); window.location = '" . BASE_URL . "'</script>";
        }
    }

    function cadastrar() {
        $this->init_session();
        
        //Recupera o id do usuário logado
        $idUsuario = $this->escape("user");
        $usuario = Doctrine::getTable("Usuario")->find($idUsuario);
        
        $nomeFantasia = $this->escape("nomeFantasia");
        $razaoSocial = $this->escape("razaoSocial");
        $cnpj = $this->escape("cnpj");
        $rua = $this->escape("rua");
        $numero = $this->escape("numero");
        $bairro = $this->escape("bairro");
        $cep = $this->escape("cep");
        $cidade = $this->escape("cidade");
        $uf = $this->escape("uf");
        $contato = $this->escape("contato");
        $telefone1 = $this->escape("telefone1");
        $telefone2 = $this->escape("telefone2");
        $email = $this->escape("email");        
        $inscricaoEstadual = $this->escape("inscricaoEstadual");
        $inscricaoMunicipal = $this->escape("inscricaoMunicipal");
        $observacao = $this->escape("observacao");
        $status = "Ativo";
                
        $empresa = new Empresa();
        
        $empresa->nomeFantasia = $nomeFantasia;
        $empresa->razaoSocial = $razaoSocial;
        $empresa->cnpj = $cnpj;
        $empresa->rua = $rua;
        $empresa->numero = $numero;
        $empresa->bairro = $bairro;
        $empresa->cep = $cep;
        $empresa->cidade = $cidade;
        $empresa->uf = $uf;
        $empresa->contato = $contato;
        $empresa->telefone1 = $telefone1;
        $empresa->telefone2 = $telefone2;
        $empresa->email = $email;
        $empresa->inscricaoEstadual = $inscricaoEstadual;
        $empresa->inscricaoMunicipal = $inscricaoMunicipal;
        $empresa->observacao = $observacao;
        $empresa->status = $status;
        $empresa->usuarioResponsavel = $usuario->login;
        
        if ($empresa->trySave()) {
            $this->success("Empresa cadastrada com sucesso.");
        } else {
            $this->error("Erro ao cadastrar a empresa. Tente novamente ou contate o administrador.");
        }
    }

    function enviarAtualizar() {
        $this->init_session();
        $idEmpresa = $this->getArg(0);

        //$empresa = Doctrine::getTable("Empresa")->findOneByIdempresa($idEmpresa);
        
        $empresas = Doctrine_Query::create()
                ->select("e.*") // Seleciona os campos
                ->from("Empresa e")
                ->where("e.idEmpresa = $idEmpresa")
                ->execute()
                ->toArray();

	$empresa = $empresas[0];

        $this->set("empresa", $empresa);
        $this->show("pages/interno/modulo/empresa/atualizacao.tpl");
    }

    function atualizar() {
        $this->valida_sessao();

        $idEmpresa = $this->escape("idEmpresa");
        $nomeFantasia = $this->escape("nomeFantasia");
        $razaoSocial = $this->escape("razaoSocial");
        $cnpj = $this->escape("cnpj");
        $rua = $this->escape("rua");
        $numero = $this->escape("numero");
        $bairro = $this->escape("bairro");
        $cep = $this->escape("cep");
        $cidade = $this->escape("cidade");
        $uf = $this->escape("uf");
        $contato = $this->escape("contato");
        $telefone1 = $this->escape("telefone1");
        $telefone2 = $this->escape("telefone2");
        $email = $this->escape("email");        
        $inscricaoEstadual = $this->escape("inscricaoEstadual");
        $inscricaoMunicipal = $this->escape("inscricaoMunicipal");
        $observacao = $this->escape("observacao");
        
        $empresa = Doctrine::getTable("Empresa")->findOneByIdempresa($idEmpresa);

        $empresa->nomeFantasia = $nomeFantasia;
        $empresa->razaoSocial = $razaoSocial;
        $empresa->cnpj = $cnpj;
        $empresa->rua = $rua;
        $empresa->numero = $numero;
        $empresa->bairro = $bairro;
        $empresa->cep = $cep;
        $empresa->cidade = $cidade;
        $empresa->uf = $uf;
        $empresa->contato = $contato;
        $empresa->telefone1 = $telefone1;
        $empresa->telefone2 = $telefone2;
        $empresa->email = $email;
        $empresa->inscricaoEstadual = $inscricaoEstadual;
        $empresa->inscricaoMunicipal = $inscricaoMunicipal;
        $empresa->observacao = $observacao;
        
        if ($empresa->trySave()) {
            $this->success('Dados atualizados com sucesso.');
        } else {
            $this->error('Não foi possível atualizar os dados do empresa.');
        }
    }

    function excluir() {
        $this->init_session();
        $idEmpresa = $this->escape("idEmpresa");

        $empresa = Doctrine::getTable("Empresa")->findOneByIdempresa($idEmpresa);

        $empresa-> status= "Excluido";

        if ($empresa->trySave()) {
            $this->success("Empresa excluída com sucesso.");
        } else {
            $this->error("Erro ao excluir a empresa. Tente novamente ou contate o administrador.");
        }
    }
    
    function visualizar() {
        $this->init_session();
        $idEmpresa = $this->getArg(0);

        //$empresa = Doctrine::getTable("Empresa")->findOneByIdempresa($idEmpresa);
        
        $empresas = Doctrine_Query::create()
                ->select("e.*") // Seleciona os campos
                ->from("Empresa e")
                ->where("e.idEmpresa = $idEmpresa")
                ->execute()
                ->toArray();

	$empresa = $empresas[0];

        // Aqui pegamos a data, e dividimos ela em duas, usando a métodoExplode()
        $data = explode(" ", $empresa["dataCadastro"]);

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
        
        $empresa["dataCadastro"] = $data;

        $this->set("empresa", $empresa);
        $this->show("pages/interno/modulo/empresa/visualizacao.tpl");
    }

}

?>
