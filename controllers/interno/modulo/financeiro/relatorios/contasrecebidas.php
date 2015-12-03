<?php

/** /gec/controllers/interno/modulo/corporativo/tipoLancamento.php
 * Controller_Tipolancamento
 * 
 * @author Edson Junior
 * @package Controllers
 */
Class Controller_Contasrecebidas extends Proto_Controller {

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

    function mostrar() {
        //Inicia uma Sessão
        $this->init_session();


        $tipoLancamentos = Doctrine_Query::create()
                ->select("b.*")
                ->from("Tipolancamento b")
                ->where("b.status like 'Ativo'")
                ->execute()
                ->toArray();
        
        $centroCustos = Doctrine_Query::create()
                ->select("b.*")
                ->from("Centrocusto b")
                ->where("b.status like 'Ativo'")
                ->execute()
                ->toArray();

        //Envia os Centros de Custo para a página
        $this->set("tipoLancamentos", $tipoLancamentos);
        $this->set("centroCustos", $centroCustos);

        //Abre a página
        $this->show("pages/interno/modulo/financeiro/relatorios/contasRecebidas.tpl");
    }

    function gerar() {
        //Inicia uma Sessão
        $this->init_session();

        $tipoLancamento = $this->escape("tipoLancamento");
        $centroCusto = $this->escape("centroCusto");
        $dataInicial = implode("-", array_reverse(explode("/", $this->escape("dataInicial"))));
        $dataFinal = implode("-", array_reverse(explode("/", $this->escape("dataFinal"))));

        //Variável que irá armazenar o conteúdo dinâmico da SQL
        $complementoSql = "";

        //Adiciona o filtro do Movimento na SQL dinâmica
        //Verifica se o filtro foi enviado
        if (strcmp($tipoLancamento, "") != 0) {
            //Separa a String oriunda do filtro, obtendo todos os movimentos escolhidos
            $escolhidos = explode("-", $tipoLancamento);
            //Contador de movimentos escolhidos
            $contTipoLancamento = 0;

            $complementoSql = $complementoSql . " and (";

            //Adiciona todos os movimentos escolhidos à SQL
            for ($i = 1; $i < sizeof($escolhidos); $i++) {

                //Verifica se já foi adicionado algum movimento à SQL, se sim, adiciona um OR
                if ($contTipoLancamento > 0) {
                    //Adiciona o filtro à SQL
                    $complementoSql = $complementoSql . " or l.idTipoLancamento = " . $escolhidos[$i] . "";
                    //Incrementa o contador de movimentos
                    $contTipoLancamento++;
                } else {
                    //Adiciona o filtro à SQL
                    $complementoSql = $complementoSql . "l.idTipoLancamento = " . $escolhidos[$i] . "";
                    //Incrementa o contador de movimentos
                    $contTipoLancamento++;
                }
            }

            $complementoSql = $complementoSql . ") ";
        }
        
        if (strcmp($centroCusto, "") != 0) {
            //Separa a String oriunda do filtro, obtendo todos os movimentos escolhidos
            $escolhidos = explode("-", $centroCusto);
            //Contador de movimentos escolhidos
            $contCentroCusto = 0;

            $complementoSql = $complementoSql . " and (";

            //Adiciona todos os movimentos escolhidos à SQL
            for ($i = 1; $i < sizeof($escolhidos); $i++) {

                //Verifica se já foi adicionado algum movimento à SQL, se sim, adiciona um OR
                if ($contCentroCusto > 0) {
                    //Adiciona o filtro à SQL
                    $complementoSql = $complementoSql . " or l.idCentroCusto = " . $escolhidos[$i] . "";
                    //Incrementa o contador de movimentos
                    $contCentroCusto++;
                } else {
                    //Adiciona o filtro à SQL
                    $complementoSql = $complementoSql . "l.idCentroCusto = " . $escolhidos[$i] . "";
                    //Incrementa o contador de movimentos
                    $contCentroCusto++;
                }
            }

            $complementoSql = $complementoSql . ") ";
        }

        $lancamentos = Doctrine_Query::create()
                ->select("l.idLancamentoFinanceiro, "
                        . "l.nome, "
                        . "l.dataEmissao, "
                        . "l.dataVencimento, "
                        . "l.valorOriginal, "
                        . "l.valorBaixado, "
                        . "l.dataBaixa, "
                        . "l.status, "
                        . "t.nome as tipoLancamento, "
                        . "e.nomeFantasia as nomeFantasia, "
                        . "c.nome as centroCusto")
                ->from("Lancamentofinanceiro l")
                ->leftJoin("l.Empresa e")
                ->leftJoin("l.Tipolancamento t")
                ->leftJoin("l.Centrocusto c")
                ->where("l.status like 'Baixado' and l.pagarReceber = 1 and l.dataBaixa >= '$dataInicial' and l.dataBaixa <= '$dataFinal' $complementoSql")
                ->execute()
                ->toArray();

        $valorTotal = 0;
        for ($i = 0; $i < sizeof($lancamentos); $i++) {
            $valorTotal += $lancamentos[$i]["valorBaixado"];
            $lancamentos[$i]["valorTotal"] = $valorTotal;

            $lancamentos[$i]["valorOriginal"] = 'R$' . number_format($lancamentos[$i]["valorOriginal"], 2, ',', '.');
            $lancamentos[$i]["valorBaixado"] = 'R$' . number_format($lancamentos[$i]["valorBaixado"], 2, ',', '.');
            $lancamentos[$i]["valorTotal"] = 'R$' . number_format($lancamentos[$i]["valorTotal"], 2, ',', '.');


            $lancamentos[$i]["dataEmissao"] = implode("/", array_reverse(explode("-", $lancamentos[$i]["dataEmissao"])));
            $lancamentos[$i]["dataVencimento"] = implode("/", array_reverse(explode("-", $lancamentos[$i]["dataVencimento"])));
            $lancamentos[$i]["dataBaixa"] = implode("/", array_reverse(explode("-", $lancamentos[$i]["dataBaixa"])));
        }

        echo json_encode($lancamentos);
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