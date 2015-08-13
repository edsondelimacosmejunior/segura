<?php

/** /gec/controllers/interno/modulo/corporativo/formaPagamento.php
 * Controller_Formapagamento
 * 
 * @author Edson Junior
 * @package Controllers
 */
Class Controller_Formapagamento extends Proto_Controller {

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
        
        $formaPagamentos = Doctrine_Query::create()
                ->select("b.*")
                ->from("Formapagamento b")
                ->where("b.status like 'Ativo'")
                ->execute()
                ->toArray();

        //Envia os Centros de Custo para a página
        $this->set("formaPagamentos", $formaPagamentos);
        
        //Abre a página
        $this->show("pages/interno/modulo/financeiro/formaPagamento/listar.tpl");
    }
    
    
    function cadastrar() {
        //Inicia a sessão
        $this->init_session();

        //Recupera o id do usuário logado
        $idUsuario = $this->escape("user");
         //Recuperando dados do usuário
        $u = Doctrine::getTable("Usuario")->find($idUsuario);

        $formaPagamento = new Formapagamento();

        //Recupera dados do formulário
        $formaPagamento->nome = $this->escape("nome");
        $formaPagamento->descricao = $this->escape("descricao");
        $formaPagamento->status = "Ativo";
        $formaPagamento->usuarioCriacao = $idUsuario;

        //Verifica se a Nota Fiscal foi salva corretamente
        if ($formaPagamento->trySave()) {
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
        $idFormaPagamento = $this->escape("idFormaPagamento");

        $formaPagamento = Doctrine::getTable("Formapagamento")->find($idFormaPagamento);

        $formaPagamento->nome = $this->escape("nome");
        $formaPagamento->descricao = $this->escape("descricao");

        //Verifica se a Nota Fiscal foi salva corretamente
        if ($formaPagamento->trySave()) {
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
        $idFormaPagamento = $this->escape("idFormaPagamento");

        $formaPagamento = Doctrine_Query::create()
                ->select("b.*")
                ->from("Formapagamento b")
                ->where("b.idFormaPagamento = " . $idFormaPagamento . "")
                ->execute()
                ->toArray();

        echo json_encode($formaPagamento);
    }
    
    function excluir() {
        $this->init_session();
        $idFormaPagamento = $this->getArg(0);

        $formaPagamento = Doctrine::getTable("Formapagamento")->findOneByIdFormapagamento($idFormaPagamento);

        $formaPagamento-> status= "Excluido";

        if ($formaPagamento->trySave()) {
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