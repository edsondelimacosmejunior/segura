<?php

/** /gec/controllers/interno/modulo/corporativo/tipoLancamento.php
 * Controller_Tipolancamento
 * 
 * @author Edson Junior
 * @package Controllers
 */
Class Controller_Fluxocaixa extends Proto_Controller {

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

        $mes = date("m");
        $ano = date("Y");

        $dias_do_mes = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);

        $semana = 1;
        $auxSemanas["DATAINICIAL"] = "1";
        $auxSemanas["SEMANA"] = "1";
        $auxSemanas["DATAFINAL"] = "";
        $retornoSemana = false;

        for ($d = 1; $d <= $dias_do_mes; $d++) {
            $row["DIA"] = "";
            $row["DIASEMANA"] = "";
            $row["SEMANA"] = "";
            $row["MES"] = $mes;
            $row["ANO"] = $ano;
            $row["DESPESAS"] = 0;
            $row["RECEITAS"] = 0;
            $row["SALDO"] = 0;
            $row["SALDOANTERIOR"] = 0;

            $retornoSemana = false;


            $dia_da_semana = jddayofweek(cal_to_jd(CAL_GREGORIAN, $mes, $d, $ano), 0);

            switch ($dia_da_semana) {
                case 0:
                    $row["DIASEMANA"] = "Domingo";
                    $auxSemanas["DATAFINAL"] = "" . "" . $d . "/" . $mes . "/" . $ano;

                    $semanas[] = $auxSemanas;
                    $semanas2[] = $auxSemanas;
                    $auxSemanas["DATAINICIAL"] = "";
                    $auxSemanas["DATAFINAL"] = "";
                    $retornoSemana = true;
                    break;
                case 1:
                    $row["DIASEMANA"] = "Segunda";

                    if ($d != 1) {
                        $semana++;
                        $auxSemanas["SEMANA"] = "" . $semana;
                    }

                    $auxSemanas["DATAINICIAL"] = "" . $d;
                    break;
                case 2:
                    $row["DIASEMANA"] = "Terca";
                    break;
                case 3:
                    $row["DIASEMANA"] = "Quarta";
                    break;
                case 4:
                    $row["DIASEMANA"] = "Quinta";
                    break;
                case 5:
                    $row["DIASEMANA"] = "Sexta";
                    break;
                case 6:
                    $row["DIASEMANA"] = "Sabado";
                    break;
            }

            if ($retornoSemana == false && $d == $dias_do_mes) {
                $auxSemanas["DATAFINAL"] = "" . "" . $d . "/" . $mes . "/" . $ano;

                $semanas[] = $auxSemanas;
                $semanas2[] = $auxSemanas;
            }
            $row["DIA"] = $d;
            $row["SEMANA"] = $semana;

            $retorno[] = $row;
        }

        $lancamentos = Doctrine_Query::create()
                ->select("l.pagarReceber, "
                        . "l.dataBaixa, "
                        . "sum(valorBaixado) as valorBaixado")
                ->from("Lancamentofinanceiro l")
                ->where("l.status like 'Baixado' and l.dataBaixa >= '" . $ano . "-" . $mes . "-01' and l.dataBaixa <= '" . $ano . "-" . $mes . "-" . $dias_do_mes . "'")
                ->groupBy("l.pagarReceber, "
                        . "l.dataBaixa")
                ->execute()
                ->toArray();


        $saldoInicial = 0;
        $saldoFinal = 0;
        $totalReceitas = 0;
        $totalDespesas = 0;

        //Recupera todos os registros

        for ($j = 0; $j < count($lancamentos); $j++) {
            $pieces = explode("-", $lancamentos[$j]["dataBaixa"]);

            for ($i = 0; $i < count($retorno); $i++) {

                if ($retorno[$i]["DIA"] == $pieces[2]) {
                    if ($lancamentos[$j]["pagarReceber"] == 0) {
                        $retorno[$i]["DESPESAS"] += $lancamentos[$j]["valorBaixado"];
                        $totalDespesas += $lancamentos[$j]["valorBaixado"];
                    } else if ($lancamentos[$j]["pagarReceber"] == 1) {
                        $retorno[$i]["RECEITAS"] += $lancamentos[$j]["valorBaixado"];
                        $totalReceitas += $lancamentos[$j]["valorBaixado"];
                    }
                }
            }
        }
        
        $saldoAtual = 0;
        for ($i = 0; $i < count($retorno); $i++) {
            $retorno[$i]["SALDOANTERIOR"] = $saldoAtual;

            $retorno[$i]["SALDO"] = $retorno[$i]["SALDOANTERIOR"];
            $retorno[$i]["SALDO"] += $retorno[$i]["RECEITAS"];
            $retorno[$i]["SALDO"] -= $retorno[$i]["DESPESAS"];

            $saldoAtual += $retorno[$i]["RECEITAS"];
            $saldoAtual -= $retorno[$i]["DESPESAS"];

            //$retorno[$i]["SALDOANTERIOR"] = money_format('%.2n', $retorno[$i]["SALDOANTERIOR"]);
            //$retorno[$i]["SALDO"] = money_format('%.2n', $retorno[$i]["SALDO"]);
            //$retorno[$i]["RECEITAS"] = money_format('%.2n', $retorno[$i]["RECEITAS"]);
            //$retorno[$i]["DESPESAS"] = money_format('%.2n', $retorno[$i]["DESPESAS"]);
            
            $retorno[$i]["SALDOANTERIOR"] = 'R$' . number_format($retorno[$i]["SALDOANTERIOR"], 2, ',', '.');
            $retorno[$i]["SALDO"] = 'R$' . number_format($retorno[$i]["SALDO"], 2, ',', '.');
            $retorno[$i]["RECEITAS"] = 'R$' . number_format($retorno[$i]["RECEITAS"], 2, ',', '.');
            $retorno[$i]["DESPESAS"] = 'R$' . number_format($retorno[$i]["DESPESAS"], 2, ',', '.');
        }
        


        $saldoFinal = $saldoInicial + $totalReceitas - $totalDespesas;

        //$saldoInicial = money_format('%.2n', $saldoInicial);
        //$saldoFinal = money_format('%.2n', $saldoFinal);
        //$totalReceitas = money_format('%.2n', $totalReceitas);
        //$totalDespesas = money_format('%.2n', $totalDespesas);
        
        $saldoInicial = 'R$' . number_format($saldoInicial, 2, ',', '.');
        $saldoFinal = 'R$' . number_format($saldoFinal, 2, ',', '.');
        $totalReceitas = 'R$' . number_format($totalReceitas, 2, ',', '.');
        $totalDespesas = 'R$' . number_format($totalDespesas, 2, ',', '.');
        
        $tiposLancamentos = Doctrine_Query::create()
                ->select("t.*")
                ->from("Tipolancamento t")
                ->where("t.status like 'Ativo'")
                ->execute()
                ->toArray();

        //Envia os Centros de Custo para a página
        $this->set("semanas", $semanas);
        $this->set("semanas2", $semanas2);
        $this->set("calendario", $retorno);
        $this->set("totalReceitas", $totalReceitas);
        $this->set("totalDespesas", $totalDespesas);
        $this->set("saldoInicial", $saldoInicial);
        $this->set("saldoFinal", $saldoFinal);
        $this->set("tiposLancamentos", $tiposLancamentos);

        //Abre a página
        $this->show("pages/interno/modulo/financeiro/relatorios/fluxoCaixa.tpl");
    }
    
    function filtrar() {
        //Inicia uma Sessão
        $this->init_session();
        
        $mes = $this->escape("mes");
        $ano = $this->escape("ano");

        $dias_do_mes = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);

        $semana = 1;
        $auxSemanas["DATAINICIAL"] = "1";
        $auxSemanas["SEMANA"] = "1";
        $auxSemanas["DATAFINAL"] = "";
        $retornoSemana = false;

        for ($d = 1; $d <= $dias_do_mes; $d++) {
            $row["DIA"] = "";
            $row["DIASEMANA"] = "";
            $row["SEMANA"] = "";
            $row["MES"] = $mes;
            $row["ANO"] = $ano;
            $row["DESPESAS"] = 0;
            $row["RECEITAS"] = 0;
            $row["SALDO"] = 0;
            $row["SALDOANTERIOR"] = 0;

            $retornoSemana = false;


            $dia_da_semana = jddayofweek(cal_to_jd(CAL_GREGORIAN, $mes, $d, $ano), 0);

            switch ($dia_da_semana) {
                case 0:
                    $row["DIASEMANA"] = "Domingo";
                    $auxSemanas["DATAFINAL"] = "" . "" . $d . "/" . $mes . "/" . $ano;

                    $semanas[] = $auxSemanas;
                    $semanas2[] = $auxSemanas;
                    $auxSemanas["DATAINICIAL"] = "";
                    $auxSemanas["DATAFINAL"] = "";
                    $retornoSemana = true;
                    break;
                case 1:
                    $row["DIASEMANA"] = "Segunda";

                    if ($d != 1) {
                        $semana++;
                        $auxSemanas["SEMANA"] = "" . $semana;
                    }

                    $auxSemanas["DATAINICIAL"] = "" . $d;
                    break;
                case 2:
                    $row["DIASEMANA"] = "Terca";
                    break;
                case 3:
                    $row["DIASEMANA"] = "Quarta";
                    break;
                case 4:
                    $row["DIASEMANA"] = "Quinta";
                    break;
                case 5:
                    $row["DIASEMANA"] = "Sexta";
                    break;
                case 6:
                    $row["DIASEMANA"] = "Sabado";
                    break;
            }

            if ($retornoSemana == false && $d == $dias_do_mes) {
                $auxSemanas["DATAFINAL"] = "" . "" . $d . "/" . $mes . "/" . $ano;

                $semanas[] = $auxSemanas;
                $semanas2[] = $auxSemanas;
            }
            $row["DIA"] = $d;
            $row["SEMANA"] = $semana;

            $retorno[] = $row;
        }

        $lancamentos = Doctrine_Query::create()
                ->select("l.pagarReceber, "
                        . "l.dataBaixa, "
                        . "sum(valorBaixado) as valorBaixado")
                ->from("Lancamentofinanceiro l")
                ->where("l.status like 'Baixado' and l.dataBaixa >= '" . $ano . "-" . $mes . "-01' and l.dataBaixa <= '" . $ano . "-" . $mes . "-" . $dias_do_mes . "'")
                ->groupBy("l.pagarReceber, "
                        . "l.dataBaixa")
                ->execute()
                ->toArray();


        $saldoInicial = 0;
        $saldoFinal = 0;
        $totalReceitas = 0;
        $totalDespesas = 0;

        //Recupera todos os registros

        for ($j = 0; $j < count($lancamentos); $j++) {
            $pieces = explode("-", $lancamentos[$j]["dataBaixa"]);

            for ($i = 0; $i < count($retorno); $i++) {

                if ($retorno[$i]["DIA"] == $pieces[2]) {
                    if ($lancamentos[$j]["pagarReceber"] == 0) {
                        $retorno[$i]["DESPESAS"] += $lancamentos[$j]["valorBaixado"];
                        $totalDespesas += $lancamentos[$j]["valorBaixado"];
                    } else if ($lancamentos[$j]["pagarReceber"] == 1) {
                        $retorno[$i]["RECEITAS"] += $lancamentos[$j]["valorBaixado"];
                        $totalReceitas += $lancamentos[$j]["valorBaixado"];
                    }
                }
            }
        }
        
        $saldoAtual = 0;
        for ($i = 0; $i < count($retorno); $i++) {
            $retorno[$i]["SALDOANTERIOR"] = $saldoAtual;

            $retorno[$i]["SALDO"] = $retorno[$i]["SALDOANTERIOR"];
            $retorno[$i]["SALDO"] += $retorno[$i]["RECEITAS"];
            $retorno[$i]["SALDO"] -= $retorno[$i]["DESPESAS"];

            $saldoAtual += $retorno[$i]["RECEITAS"];
            $saldoAtual -= $retorno[$i]["DESPESAS"];

            //$retorno[$i]["SALDOANTERIOR"] = money_format('%.2n', $retorno[$i]["SALDOANTERIOR"]);
            //$retorno[$i]["SALDO"] = money_format('%.2n', $retorno[$i]["SALDO"]);
            //$retorno[$i]["RECEITAS"] = money_format('%.2n', $retorno[$i]["RECEITAS"]);
            //$retorno[$i]["DESPESAS"] = money_format('%.2n', $retorno[$i]["DESPESAS"]);
            
            $retorno[$i]["SALDOANTERIOR"] = 'R$' . number_format($retorno[$i]["SALDOANTERIOR"], 2, ',', '.');
            $retorno[$i]["SALDO"] = 'R$' . number_format($retorno[$i]["SALDO"], 2, ',', '.');
            $retorno[$i]["RECEITAS"] = 'R$' . number_format($retorno[$i]["RECEITAS"], 2, ',', '.');
            $retorno[$i]["DESPESAS"] = 'R$' . number_format($retorno[$i]["DESPESAS"], 2, ',', '.');
        }
        


        $saldoFinal = $saldoInicial + $totalReceitas - $totalDespesas;

        //$saldoInicial = money_format('%.2n', $saldoInicial);
        //$saldoFinal = money_format('%.2n', $saldoFinal);
        //$totalReceitas = money_format('%.2n', $totalReceitas);
        //$totalDespesas = money_format('%.2n', $totalDespesas);
        
        $saldoInicial = 'R$' . number_format($saldoInicial, 2, ',', '.');
        $saldoFinal = 'R$' . number_format($saldoFinal, 2, ',', '.');
        $totalReceitas = 'R$' . number_format($totalReceitas, 2, ',', '.');
        $totalDespesas = 'R$' . number_format($totalDespesas, 2, ',', '.');
        
        $tiposLancamentos = Doctrine_Query::create()
                ->select("t.*")
                ->from("Tipolancamento t")
                ->where("t.status like 'Ativo'")
                ->execute()
                ->toArray();

        //Envia os Centros de Custo para a página
        $this->set("semanas", $semanas);
        $this->set("semanas2", $semanas2);
        $this->set("calendario", $retorno);
        $this->set("totalReceitas", $totalReceitas);
        $this->set("totalDespesas", $totalDespesas);
        $this->set("saldoInicial", $saldoInicial);
        $this->set("saldoFinal", $saldoFinal);
        $this->set("tiposLancamentos", $tiposLancamentos);

        //Abre a página
        $this->show("pages/interno/modulo/financeiro/relatorios/fluxoCaixa.tpl");
    }

    function getReceitas() {
        //Inicia uma Sessão
        $this->init_session();

        //Recupera o id do usuário logado
        $idTipoLancamento = $this->escape("idTipoLancamento");
        $dia = $this->escape("dia");
        $mes = $this->escape("mes");
        $ano = $this->escape("ano");


        $lancamentos = Doctrine_Query::create()
                ->select("l.idLancamentoFinanceiro, "
                        . "l.valorBaixado")
                ->from("Lancamentofinanceiro l")
                ->where("l.status like 'Baixado' and l.pagarReceber = 1 and l.dataBaixa = '" . $ano . "-" . $mes . "-" . $dia . "' and l.idTipoLancamento = $idTipoLancamento")
                ->execute()
                ->toArray();
        
        $valorTotal = 0;
        for ($i = 0; $i < count($lancamentos); $i++) {
            $valorTotal += $lancamentos[$i]["valorBaixado"];
        }
        

        setlocale(LC_MONETARY, 'it_IT');

        //$valorTotal = money_format('%.2n', $valorTotal);
        $valorTotal = pv($valorTotal);


        echo $valorTotal;
    }
    
    function getDespesas() {
        //Inicia uma Sessão
        $this->init_session();

        //Recupera o id do usuário logado
        $idTipoLancamento = $this->escape("idTipoLancamento");
        $dia = $this->escape("dia");
        $mes = $this->escape("mes");
        $ano = $this->escape("ano");


        $lancamentos = Doctrine_Query::create()
                ->select("l.idLancamentoFinanceiro, "
                        . "l.valorBaixado")
                ->from("Lancamentofinanceiro l")
                ->where("l.status like 'Baixado' and l.pagarReceber = 0 and l.dataBaixa = '" . $ano . "-" . $mes . "-" . $dia . "' and l.idTipoLancamento = $idTipoLancamento")
                ->execute()
                ->toArray();
        
        $valorTotal = 0;
        for ($i = 0; $i < count($lancamentos); $i++) {
            $valorTotal += $lancamentos[$i]["valorBaixado"];
        }
        

        setlocale(LC_MONETARY, 'it_IT');

        //$valorTotal = money_format('%.2n', $valorTotal);
        $valorTotal = pv($valorTotal);


        echo $valorTotal;
    }
    
    function getDespesasTotal() {
        //Inicia uma Sessão
        $this->init_session();

        //Recupera o id do usuário logado
        $idTipoLancamento = $this->escape("idTipoLancamento");
        $mes = $this->escape("mes");
        $ano = $this->escape("ano");

        $dias_do_mes = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);

        $lancamentos = Doctrine_Query::create()
                ->select("l.idLancamentoFinanceiro, "
                        . "l.valorBaixado")
                ->from("Lancamentofinanceiro l")
                ->where("l.status like 'Baixado' and l.pagarReceber = 0 and l.dataBaixa >= '" . $ano . "-" . $mes . "-01' and l.dataBaixa <= '" . $ano . "-" . $mes . "-" . $dias_do_mes . "' and l.idTipoLancamento = $idTipoLancamento")
                ->execute()
                ->toArray();
        
        $valorTotal = 0;
        for ($i = 0; $i < count($lancamentos); $i++) {
            $valorTotal += $lancamentos[$i]["valorBaixado"];
        }
        

        setlocale(LC_MONETARY, 'it_IT');

        //$valorTotal = money_format('%.2n', $valorTotal);
        $valorTotal = pv($valorTotal);


        echo $valorTotal;
    }
    
    function getReceitasTotal() {
        //Inicia uma Sessão
        $this->init_session();

        //Recupera o id do usuário logado
        $idTipoLancamento = $this->escape("idTipoLancamento");
        $mes = $this->escape("mes");
        $ano = $this->escape("ano");

        $dias_do_mes = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);

        $lancamentos = Doctrine_Query::create()
                ->select("l.idLancamentoFinanceiro, "
                        . "l.valorBaixado")
                ->from("Lancamentofinanceiro l")
                ->where("l.status like 'Baixado' and l.pagarReceber = 1 and l.dataBaixa >= '" . $ano . "-" . $mes . "-01' and l.dataBaixa <= '" . $ano . "-" . $mes . "-" . $dias_do_mes . "' and l.idTipoLancamento = $idTipoLancamento")
                ->execute()
                ->toArray();
        
        $valorTotal = 0;
        for ($i = 0; $i < count($lancamentos); $i++) {
            $valorTotal += $lancamentos[$i]["valorBaixado"];
        }
        

        setlocale(LC_MONETARY, 'it_IT');

        //$valorTotal = money_format('%.2n', $valorTotal);
        $valorTotal = pv($valorTotal);


        echo $valorTotal;
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