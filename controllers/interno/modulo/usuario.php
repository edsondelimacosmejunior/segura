<?php

Class Controller_Usuario extends Proto_Controller {

//Classe de controle onde o próprio nome da função da mostra que ação realiza
    function index() {
        $this->init_session();
        $this->show("pages/interno/index.tpl");
    }

    function mostrarCadastro() {
        $this->init_session();
        $this->show("pages/interno/modulo/usuario/cadastro.tpl");
    }

    function listarUsuarios() {
         //Inicia a sessÃ£o
        $this->init_session();

        //Recupera o id do usuário logado
        $idUsuario = $this->escape("user");
        //Recuperando dados do usuário
        $u = Doctrine::getTable("Usuario")->find($idUsuario);

        $usuarios = Doctrine_Query::create()
                ->select("u.*") // Seleciona os campos
                ->from("Usuario u")
                ->where("status != 'Excluido'")
                ->execute()
                ->toArray();

        if ($this->logado()) {
            $this->set("usuario", $u->login);
            $this->set("usuarios", $usuarios);

            //Abre a página da lista
            $this->show("pages/interno/modulo/usuario/lista.tpl");
        } else {
            echo "<script>alert('Sua sessão expirou. Por favor, refaça seu login.'); window.location = '" . BASE_URL . "'</script>";
        }
    }

    function cadastrar() {
        $this->init_session();

        $nome = $this->escape("nome");
        $login = $this->escape("login");
        $senha = $this->escape("senha");
        $email = $this->escape("email");
        $status = "Ativo";
        $nivel = $this->escape("nivel");

        $verificaLogin = $login;

        $v = Doctrine_Query::create()
                ->select("u.*")
                ->from("Usuario u")
                ->where("login = '$verificaLogin'")
                ->execute();

        if ($v->count() == 0) {
            //Faz o cadastro
            $usuario = new Usuario();

            $usuario->nome = $nome;
            $usuario->login = $login;
            $usuario->senha = $senha;
            $usuario->email = $email;
            $usuario->status = $status;
            $usuario->nivel = $nivel;

            if ($usuario->trySave()) {
                $this->success("Usuário cadastrado com sucesso.");
            } else {
                $this->error("Erro ao cadastrar o usuário. Tente novamente ou contate o administrador.");
            }
        } else {
            $this->error("Login já cadastrado.");
        }
    }

    function enviarAtualizar() {
        $this->init_session();
        $idUsuario = $this->getArg(0);

        //$usuario = Doctrine::getTable("Usuario")->findOneByIdusuario($idUsuario);
        
        $usuarios = Doctrine_Query::create()
                ->select("u.*") // Seleciona os campos
                ->from("Usuario u")
                ->where("u.idUsuario = $idUsuario")
                ->execute()
                ->toArray();

	$usuario = $usuarios[0];

        $this->set("usuario", $usuario);
        $this->show("pages/interno/modulo/usuario/atualizacao.tpl");
    }

    function atualizar() {
        $this->valida_sessao();

        $idUsuario = $this->escape("idUsuario");
        $nome = $this->escape("nome");
        $senha = $this->escape("senha");
        $email = $this->escape("email");
        $nivel = $this->escape("nivel");
        
        $usuario = Doctrine::getTable("Usuario")->findOneByIdusuario($idUsuario);

        $usuario->nome = $nome;
        $usuario->senha = $senha;
        $usuario->email = $email;
        $usuario->nivel = $nivel;        
        
        if ($usuario->trySave()) {
            $this->success('Dados atualizados com sucesso.');
        } else {
            $this->error('Não foi possível atualizar os dados do usuário.');
        }
    }

    function excluir() {
        $this->init_session();
        $idUsuario = $this->escape("idUsuario");

        $usuario = Doctrine::getTable("Usuario")->findOneByIdusuario($idUsuario);

        $usuario-> status= "Excluido";

        if ($usuario->trySave()) {
            $this->success("Usuário excluído com sucesso.");
        } else {
            $this->error("Erro ao excluir o usuário. Tente novamente ou contate o administrador.");
        }
    }
    
    function visualizar() {
        $this->init_session();
        $idUsuario = $this->getArg(0);

        //$usuario = Doctrine::getTable("Usuario")->findOneByIdusuario($idUsuario);
        
        $usuarios = Doctrine_Query::create()
                ->select("u.*") // Seleciona os campos
                ->from("Usuario u")
                ->where("u.idUsuario = $idUsuario")
                ->execute()
                ->toArray();

	$usuario = $usuarios[0];


        // Aqui pegamos a data, e dividimos ela em duas, usando a métodoExplode()
        $data = explode(" ", $usuario["dataCadastro"]);

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
        
        $usuario["dataCadastro"] = $data;

        $this->set("usuario", $usuario);
        $this->show("pages/interno/modulo/usuario/visualizacao.tpl");
    }

}

?>
