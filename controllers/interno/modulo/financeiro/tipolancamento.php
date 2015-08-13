<?php

/** /gec/controllers/interno/modulo/corporativo/tipoLancamento.php
 * Controller_Tipolancamento
 * 
 * @author Edson Junior
 * @package Controllers
 */
Class Controller_Tipolancamento extends Proto_Controller {

    /**
     * Método Inicial
     * Responsável por redirencionar a aplicação para sua página inicial interna 
     * 
     * @return
     */
    function index() {
        //Inicia uma Sessão
        $this->init_session();
        //Realiza o redirecionamento
        $this->show("pages/interno/index.tpl");
    }
    
    function listar() {
        //Inicia uma Sessão
        $this->init_session();
        
        $tipoLancamentos = Doctrine_Query::create()
                ->select("b.*")
                ->from("Tipolancamento b")
                ->where("b.status like 'Ativo'")
                ->execute()
                ->toArray();

        //Envia os Centros de Custo para a página
        $this->set("tipoLancamentos", $tipoLancamentos);
        
        //Abre a página
        $this->show("pages/interno/modulo/financeiro/tipoLancamento/listar.tpl");
    }
    
    
    function cadastrar() {
        //Inicia a sessão
        $this->init_session();

        //Recupera o id do usuário logado
        $idUsuario = $this->escape("user");
         //Recuperando dados do usuário
        $u = Doctrine::getTable("Usuario")->find($idUsuario);

        $tipoLancamento = new Tipolancamento();

        //Recupera dados do formulário
        $tipoLancamento->nome = $this->escape("nome");
        $tipoLancamento->descricao = $this->escape("descricao");
        $tipoLancamento->status = "Ativo";
        $tipoLancamento->usuarioCriacao = $idUsuario;

        //Verifica se a Nota Fiscal foi salva corretamente
        if ($tipoLancamento->trySave()) {
            //Envia a mensagem de confirmação de cadastro
            $this->success("Cadastro realizado com sucesso!");
        } else {
            //Envia a mensagem de erro em caso de falha no cadastro
            $this->error("Erro ao gravar.");
        }
    }
    
    function editar() {
        //Inicia a sessão
        $this->init_session();

        //Recupera dados do formulário
        $idTipoLancamento = $this->escape("idTipoLancamento");

        $tipoLancamento = Doctrine::getTable("Tipolancamento")->find($idTipoLancamento);

        $tipoLancamento->nome = $this->escape("nome");
        $tipoLancamento->descricao = $this->escape("descricao");

        //Verifica se a Nota Fiscal foi salva corretamente
        if ($tipoLancamento->trySave()) {
            //Envia a mensagem de confirmação de cadastro
            $this->success("Cadastro editado com sucesso!");
        } else {
            //Envia a mensagem de erro em caso de falha no cadastro
            $this->error("Erro ao gravar.");
        }
    }
    
    function buscar() {
        //Inicia uma Sessão
        $this->init_session();

        //Recupera o id do usuário logado
        $idTipoLancamento = $this->escape("idTipoLancamento");

        $tipoLancamento = Doctrine_Query::create()
                ->select("b.*")
                ->from("Tipolancamento b")
                ->where("b.idTipoLancamento = " . $idTipoLancamento . "")
                ->execute()
                ->toArray();

        echo json_encode($tipoLancamento);
    }
    
    function excluir() {
        $this->init_session();
        $idTipoLancamento = $this->getArg(0);

        $tipoLancamento = Doctrine::getTable("Tipolancamento")->findOneByIdTipolancamento($idTipoLancamento);

        $tipoLancamento-> status= "Excluido";

        if ($tipoLancamento->trySave()) {
            $this->success("Cadastro excluído com sucesso.");
        } else {
            $this->error("Erro ao excluir. Tente novamente ou contate o administrador.");
        }
    }

        
}

/**
     * Função pv
     * Realiza a troca de pontos por vírgula e vice-versa
     * 
     * @return String
     */
function pv($pv_var) {
//muda ponto para virgula ou vice-versa
//ex. x=pv("100.00"); o resultado será 100,00
//ex. x=pv("100,00"); o resultado será 100.00
    $pv_tipo = ',';
    for ($f = 1; $f <= strlen(strval($pv_var)); $f++) {
        if ($pv_var[$f] == '.')
            $pv_tipo = '.';
        if ($pv_var[$f] == ',')
            $pv_tipo = ',';
    }
    if ($pv_tipo == '.') {
        return str_replace('.', ',', $pv_var);
    } else {
        return str_replace(',', '.', $pv_var);
    }
}

?>