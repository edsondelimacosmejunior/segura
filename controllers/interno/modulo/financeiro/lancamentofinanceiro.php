<?php

/** /gec/controllers/interno/modulo/corporativo/lancamentoFinanceiro.php
 * Controller_Lancamentofinanceiro
 * 
 * @author Edson Junior
 * @package Controllers
 */
Class Controller_Lancamentofinanceiro extends Proto_Controller {

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

    function abrirFormulario() {
        //Inicia uma Sessão
        $this->init_session();
        
        $centroCustos = Doctrine_Query::create()
                ->select("b.*")
                ->from("Centrocusto b")
                ->where("b.status like 'Ativo'")
                ->execute()
                ->toArray();

        $formasPagamentos = Doctrine_Query::create()
                ->select("f.*")
                ->from("Formapagamento f")
                ->where("f.status like 'Ativo'")
                ->execute()
                ->toArray();

        $tiposLancamentos = Doctrine_Query::create()
                ->select("t.*")
                ->from("Tipolancamento t")
                ->where("t.status like 'Ativo'")
                ->execute()
                ->toArray();

        $empresas = Doctrine_Query::create()
                ->select("e.*")
                ->from("Empresa e")
                ->where("e.status like 'Ativo'")
                ->orderBy("e.nomeFantasia")
                ->execute()
                ->toArray();

        //Envia os Centros de Custo para a página
        $this->set("centroCustos", $centroCustos);
        $this->set("formasPagamentos", $formasPagamentos);
        $this->set("tiposLancamentos", $tiposLancamentos);
        $this->set("empresas", $empresas);

        //Abre a página
        $this->show("pages/interno/modulo/financeiro/lancamentos/cadastro.tpl");
    }

    function listar() {
        //Inicia uma Sessão
        $this->init_session();

        $lancamentosFinanceiros = Doctrine_Query::create()
                ->select("l.idLancamentoFinanceiro, "
                        . "l.nome, "
                        . "l.dataVencimento, "
                        . "CONCAT('R$ ', REPLACE(REPLACE(REPLACE(FORMAT(l.valorOriginal, 2),'.',';'),',','.'),';',',')) AS valorOriginal,"
                        . "CONCAT('R$ ', REPLACE(REPLACE(REPLACE(FORMAT(l.valorBaixado, 2),'.',';'),',','.'),';',',')) AS valorBaixado,"
                        . "l.status, "
                        . "t.nome as tipoLancamento, "
                        . "f.nome as formaPagamento, "
                        . "e.nomeFantasia as nomeFantasia, "
                        . "c.nome as centroCusto")
                ->from("Lancamentofinanceiro l")
                ->leftJoin("l.Tipolancamento t")
                ->leftJoin("l.Formapagamento f")
                ->leftJoin("l.Empresa e")
                ->leftJoin("l.Centrocusto c")
                ->where("l.status not like 'Excluido'")
                ->execute()
                ->toArray();

        for ($j = 0; $j < count($lancamentosFinanceiros); $j++) {
            $lancamentosFinanceiros[$j]["dataVencimento"] = implode("/", array_reverse(explode("-", $lancamentosFinanceiros[$j]["dataVencimento"])));
        }

        //Envia os Centros de Custo para a página
        $this->set("lancamentosFinanceiros", $lancamentosFinanceiros);

        //Abre a página
        $this->show("pages/interno/modulo/financeiro/lancamentos/listar.tpl");
    }

    function cadastrar() {
        //Inicia a sessão
        $this->init_session();

        //Recupera o id do usuário logado
        $idUsuario = $this->escape("user");
        //Recuperando dados do usuário
        $u = Doctrine::getTable("Usuario")->find($idUsuario);

        $lancamentoFinanceiro = new Lancamentofinanceiro();

        //Recupera dados do formulário
        $lancamentoFinanceiro->nome = $this->escape("nome");
        $lancamentoFinanceiro->descricao = $this->escape("descricao");
        $lancamentoFinanceiro->pagarReceber = $this->escape("pagarReceber");
        $lancamentoFinanceiro->dataEmissao = implode("-", array_reverse(explode("/", $this->escape("dataEmissao"))));
        $lancamentoFinanceiro->dataVencimento = implode("-", array_reverse(explode("/", $this->escape("dataVencimento"))));
        //$lancamentoFinanceiro->dataBaixa = implode("-", array_reverse(explode("/", $this->escape("dataBaixa"))));
        $lancamentoFinanceiro->valorOriginal = $this->escape("valorOriginal");
        $lancamentoFinanceiro->desconto = $this->escape("desconto");
        $lancamentoFinanceiro->juros = $this->escape("juros");
        $lancamentoFinanceiro->cartorio = $this->escape("cartorio");
        $lancamentoFinanceiro->valorLiquido = $lancamentoFinanceiro->valorOriginal - $lancamentoFinanceiro->desconto + $lancamentoFinanceiro->juros + $lancamentoFinanceiro->cartorio;
        //$lancamentoFinanceiro->valorBaixado = $this->escape("valorBaixado");
        $lancamentoFinanceiro->idFormaPagamento = $this->escape("idFormaPagamento");
        $lancamentoFinanceiro->idTipoLancamento = $this->escape("idTipoLancamento");
        $lancamentoFinanceiro->idCentroCusto = $this->escape("idCentroCusto");
        $lancamentoFinanceiro->idEmpresa = $this->escape("idEmpresa");
        $lancamentoFinanceiro->status = "Pendente";
        $lancamentoFinanceiro->usuarioCriacao = $idUsuario;

        //Verifica se a Nota Fiscal foi salva corretamente
        if ($lancamentoFinanceiro->trySave()) {
            //Envia a mensagem de confirmação de cadastro
            $this->success("Cadastro realizado com sucesso!");
        } else {
            //Envia a mensagem de erro em caso de falha no cadastro
            $this->error("Erro ao gravar.");
        }
    }

    function visualizar() {
        $this->init_session();
        $idLancamentoFinanceiro = $this->escape("idLancamentoFinanceiro");

        $lancamentos = Doctrine_Query::create()
                ->select("l.*, t.nome as tipoLancamento, f.nome as formaPagamento, e.nomeFantasia as nomeFantasia, c.nome as centroCusto")
                ->from("Lancamentofinanceiro l")
                ->leftJoin("l.Tipolancamento t")
                ->leftJoin("l.Formapagamento f")
                ->leftJoin("l.Empresa e")
                ->leftJoin("l.Centrocusto c")
                ->where("l.idLancamentoFinanceiro = $idLancamentoFinanceiro")
                ->execute()
                ->toArray();

        for ($j = 0; $j < count($lancamentos); $j++) {
            $lancamentos[$j]["dataVencimento"] = implode("/", array_reverse(explode("-", $lancamentos[$j]["dataVencimento"])));
            $lancamentos[$j]["dataBaixa"] = implode("/", array_reverse(explode("-", $lancamentos[$j]["dataBaixa"])));
            $lancamentos[$j]["dataEmissao"] = implode("/", array_reverse(explode("-", $lancamentos[$j]["dataEmissao"])));

            if ($lancamentos[$j]["pagarReceber"] == 1) {
                $lancamentos[$j]["pagarReceberNome"] = "Receber";
            } else {
                $lancamentos[$j]["pagarReceberNome"] = "Pagar";
            }
        }

        $lancamento = $lancamentos[0];



        $this->set("lancamento", $lancamento);
        $this->show("pages/interno/modulo/financeiro/lancamentos/visualiza.tpl");
    }

    function enviarAtualizar() {
        $this->init_session();
        $idLancamentoFinanceiro = $this->escape("idLancamentoFinanceiro");

        //$empresa = Doctrine::getTable("Empresa")->findOneByIdempresa($idEmpresa);

        $lancamentos = Doctrine_Query::create()
                ->select("l.*, t.idTipoLancamento, t.nome as tipoLancamento, f.idFormaPagamento, f.nome as formaPagamento, e.idEmpresa, e.nomeFantasia as nomeFantasia, c.idCentroCusto, c.nome as centroCusto")
                ->from("Lancamentofinanceiro l")
                ->leftJoin("l.Tipolancamento t")
                ->leftJoin("l.Formapagamento f")
                ->leftJoin("l.Empresa e")
                ->leftJoin("l.Centrocusto c")
                ->where("l.idLancamentoFinanceiro = $idLancamentoFinanceiro")
                ->execute()
                ->toArray();


        for ($j = 0; $j < count($lancamentos); $j++) {
            $lancamentos[$j]["dataVencimento"] = implode("/", array_reverse(explode("-", $lancamentos[$j]["dataVencimento"])));
            $lancamentos[$j]["dataBaixa"] = implode("/", array_reverse(explode("-", $lancamentos[$j]["dataBaixa"])));
            $lancamentos[$j]["dataEmissao"] = implode("/", array_reverse(explode("-", $lancamentos[$j]["dataEmissao"])));

            if ($lancamentos[$j]["pagarReceber"] == 1) {
                $lancamentos[$j]["pagarReceberNome"] = "Receber";
            } else {
                $lancamentos[$j]["pagarReceberNome"] = "Pagar";
            }
        }

        $lancamento = $lancamentos[0];


        $formasPagamentos = Doctrine_Query::create()
                ->select("f.*")
                ->from("Formapagamento f")
                ->where("f.status like 'Ativo'")
                ->execute()
                ->toArray();

        $tiposLancamentos = Doctrine_Query::create()
                ->select("t.*")
                ->from("Tipolancamento t")
                ->where("t.status like 'Ativo'")
                ->execute()
                ->toArray();

        $empresas = Doctrine_Query::create()
                ->select("e.*")
                ->from("Empresa e")
                ->where("e.status like 'Ativo'")
                ->orderBy("e.nomeFantasia")
                ->execute()
                ->toArray();
        
        $centroCustos = Doctrine_Query::create()
                ->select("b.*")
                ->from("Centrocusto b")
                ->where("b.status like 'Ativo'")
                ->execute()
                ->toArray();

        //Envia os Centros de Custo para a página
        $this->set("formasPagamentos", $formasPagamentos);
        $this->set("tiposLancamentos", $tiposLancamentos);
        $this->set("centroCustos", $centroCustos);
        $this->set("empresas", $empresas);
        $this->set("lancamento", $lancamento);

        $this->show("pages/interno/modulo/financeiro/lancamentos/edita.tpl");
    }

    function editar() {
        //Inicia a sessão
        $this->init_session();

        //Recupera dados do formulário
        $idLancamentoFinanceiro = $this->escape("idLancamentoFinanceiro");

        $lancamentoFinanceiro = Doctrine::getTable("Lancamentofinanceiro")->find($idLancamentoFinanceiro);

        //Recupera dados do formulário
        $lancamentoFinanceiro->nome = $this->escape("nome");
        $lancamentoFinanceiro->descricao = $this->escape("descricao");
        $lancamentoFinanceiro->pagarReceber = $this->escape("pagarReceber");
        $lancamentoFinanceiro->dataEmissao = implode("-", array_reverse(explode("/", $this->escape("dataEmissao"))));
        $lancamentoFinanceiro->dataVencimento = implode("-", array_reverse(explode("/", $this->escape("dataVencimento"))));
        $lancamentoFinanceiro->valorOriginal = $this->escape("valorOriginal");
        $lancamentoFinanceiro->desconto = $this->escape("desconto");
        $lancamentoFinanceiro->juros = $this->escape("juros");
        $lancamentoFinanceiro->cartorio = $this->escape("cartorio");
        $lancamentoFinanceiro->valorLiquido = $lancamentoFinanceiro->valorOriginal - $lancamentoFinanceiro->desconto + $lancamentoFinanceiro->juros + $lancamentoFinanceiro->cartorio;
        $lancamentoFinanceiro->idFormaPagamento = $this->escape("idFormaPagamento");
        $lancamentoFinanceiro->idTipoLancamento = $this->escape("idTipoLancamento");
        $lancamentoFinanceiro->idCentroCusto = $this->escape("idCentroCusto");
        $lancamentoFinanceiro->idEmpresa = $this->escape("idEmpresa");

        //Verifica se a Nota Fiscal foi salva corretamente
        if ($lancamentoFinanceiro->trySave()) {
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
        $idLancamentoFinanceiro = $this->escape("idLancamentoFinanceiro");

        $lancamentos = Doctrine_Query::create()
                ->select("b.*,"
                        . "CONCAT('R$ ', REPLACE(REPLACE(REPLACE(FORMAT(b.valorOriginal, 2),'.',';'),',','.'),';',',')) AS valorOriginal, "
                        . "CONCAT('R$ ', REPLACE(REPLACE(REPLACE(FORMAT(b.desconto, 2),'.',';'),',','.'),';',',')) AS desconto, "
                        . "CONCAT('R$ ', REPLACE(REPLACE(REPLACE(FORMAT(b.juros, 2),'.',';'),',','.'),';',',')) AS juros, "
                        . "CONCAT('R$ ', REPLACE(REPLACE(REPLACE(FORMAT(b.cartorio, 2),'.',';'),',','.'),';',',')) AS cartorio, "
                        . "CONCAT('R$ ', REPLACE(REPLACE(REPLACE(FORMAT(b.valorLiquido, 2),'.',';'),',','.'),';',',')) AS valorLiquido")
                ->from("Lancamentofinanceiro b")
                ->where("b.idLancamentoFinanceiro = " . $idLancamentoFinanceiro . "")
                ->execute()
                ->toArray();

        for ($j = 0; $j < count($lancamentos); $j++) {
            $lancamentos[$j]["dataVencimento"] = implode("/", array_reverse(explode("-", $lancamentos[$j]["dataVencimento"])));
            $lancamentos[$j]["dataBaixa"] = implode("/", array_reverse(explode("-", $lancamentos[$j]["dataBaixa"])));
            $lancamentos[$j]["dataEmissao"] = implode("/", array_reverse(explode("-", $lancamentos[$j]["dataEmissao"])));
            
            /*
            
            $lancamentos[$j]["desconto"] = pv($lancamentos[$j]["desconto"]);
            //Formata a moeda com duas cmostraasas decimais
            $lancamentos[$j]["desconto"] = money_format('%.2n', $lancamentos[$j]["desconto"]);
            
            $lancamentos[$j]["juros"] = pv($lancamentos[$j]["juros"]);
            //Formata a moeda com duas cmostraasas decimais
            $lancamentos[$j]["juros"] = money_format('%.2n', $lancamentos[$j]["juros"]);
            
            $lancamentos[$j]["cartorio"] = pv($lancamentos[$j]["cartorio"]);
            //Formata a moeda com duas cmostraasas decimais
            $lancamentos[$j]["cartorio"] = money_format('%.2n', $lancamentos[$j]["cartorio"]);
            
            $lancamentos[$j]["valorLiquido"] = pv($lancamentos[$j]["valorLiquido"]);
            //Formata a moeda com duas cmostraasas decimais
            $lancamentos[$j]["valorLiquido"] = money_format('%.2n', $lancamentos[$j]["valorLiquido"]);
            */
            if ($lancamentos[$j]["pagarReceber"] == 1) {
                $lancamentos[$j]["pagarReceberNome"] = "Receber";
            } else {
                $lancamentos[$j]["pagarReceberNome"] = "Pagar";
            }
        }
        echo json_encode($lancamentos);
    }

    function baixar() {
        //Inicia uma Sessão
        $this->init_session();

        //Recupera o id do usuário logado
        $idLancamentoFinanceiro = $this->escape("idLancamentoFinanceiro");
        $valorBaixado = $this->escape("valorBaixado");
        $dataBaixa = implode("-", array_reverse(explode("/", $this->escape("dataBaixa"))));

        $lancamentoFinanceiro = Doctrine::getTable("Lancamentofinanceiro")->find($idLancamentoFinanceiro);

        //Recupera dados do formulário
        $lancamentoFinanceiro->dataBaixa = $dataBaixa;
        $lancamentoFinanceiro->valorBaixado = $valorBaixado;
        $lancamentoFinanceiro->status = "Baixado";

        //Verifica se a Nota Fiscal foi salva corretamente
        if ($lancamentoFinanceiro->trySave()) {
            //Envia a mensagem de confirmação de cadastro
            $this->success("Baixado com sucesso!");
        } else {
            //Envia a mensagem de erro em caso de falha no cadastro
            $this->error("Erro ao gravar.");
        }

        echo json_encode($lancamentoFinanceiro);
    }
    
    function extornar() {
        //Inicia uma Sessão
        $this->init_session();

        //Recupera o id do usuário logado
        $idLancamentoFinanceiro = $this->getArg(0);
        $lancamentoFinanceiro = Doctrine::getTable("Lancamentofinanceiro")->find($idLancamentoFinanceiro);

        //Recupera dados do formulário
        $lancamentoFinanceiro->dataBaixa = null;
        $lancamentoFinanceiro->valorBaixado = null;
        $lancamentoFinanceiro->status = "Pendente";

        if ($lancamentoFinanceiro->trySave()) {
            $this->success("Lançamento extornado com sucesso.");
        } else {
            $this->error("Erro ao excluir. Tente novamente ou contate o administrador.");
        }
    }

    function excluir() {
        $this->init_session();
        $idLancamentoFinanceiro = $this->getArg(0);

        $lancamentoFinanceiro = Doctrine::getTable("Lancamentofinanceiro")->findOneByIdLancamentofinanceiro($idLancamentoFinanceiro);

        $lancamentoFinanceiro->status = "Excluido";

        if ($lancamentoFinanceiro->trySave()) {
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