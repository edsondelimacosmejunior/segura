<?php

/** /gec/controllers/interno/modulo/corporativo/centroCusto.php
 * Controller_Centrocusto
 * 
 * @author Edson Junior
 * @package Controllers
 */
Class Controller_Centrocusto extends Proto_Controller {

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
        
        $centroCustos = Doctrine_Query::create()
                ->select("b.*")
                ->from("Centrocusto b")
                ->where("b.status like 'Ativo'")
                ->execute()
                ->toArray();

        //Envia os Centros de Custo para a página
        $this->set("centroCustos", $centroCustos);
        
        //Abre a página
        $this->show("pages/interno/modulo/financeiro/centroCusto/listar.tpl");
    }
    
    
    function cadastrar() {
        //Inicia a sessão
        $this->init_session();

        //Recupera o id do usuário logado
        $idUsuario = $this->escape("user");
         //Recuperando dados do usuário
        $u = Doctrine::getTable("Usuario")->find($idUsuario);

        $centroCusto = new Centrocusto();

        //Recupera dados do formulário
        $centroCusto->nome = $this->escape("nome");
        $centroCusto->descricao = $this->escape("descricao");
        $centroCusto->status = "Ativo";
        $centroCusto->usuarioCriacao = $idUsuario;

        //Verifica se a Nota Fiscal foi salva corretamente
        if ($centroCusto->trySave()) {
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
        $idCentroCusto = $this->escape("idCentroCusto");

        $centroCusto = Doctrine::getTable("Centrocusto")->find($idCentroCusto);

        $centroCusto->nome = $this->escape("nome");
        $centroCusto->descricao = $this->escape("descricao");

        //Verifica se a Nota Fiscal foi salva corretamente
        if ($centroCusto->trySave()) {
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
        $idCentroCusto = $this->escape("idCentroCusto");

        $centroCusto = Doctrine_Query::create()
                ->select("b.*")
                ->from("Centrocusto b")
                ->where("b.idCentroCusto = " . $idCentroCusto . "")
                ->execute()
                ->toArray();

        echo json_encode($centroCusto);
    }
    
    function excluir() {
        $this->init_session();
        $idCentroCusto = $this->getArg(0);

        $centroCusto = Doctrine::getTable("Centrocusto")->findOneByIdCentrocusto($idCentroCusto);

        $centroCusto-> status= "Excluido";

        if ($centroCusto->trySave()) {
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