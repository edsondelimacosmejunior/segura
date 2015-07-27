<?php

$idTurma = $_POST["protocolo_idTurma_PDF"];

set_time_limit(0);

$db = mysql_connect("localhost", "root", "");
mysql_select_db("sistemas_segura", $db);
$result = mysql_query("
                SELECT 
                    t.*,
                    c.nome as curso,
                    c.cargaHoraria,
                    i.nome as instrutor
                FROM
                    (
                            turma t LEFT JOIN curso c on t.idCurso = c.idCurso
                    )
                    LEFT JOIN instrutor i on t.idInstrutor1 = i.idInstrutor 
                WHERE 
                    t.idTurma = $idTurma", $db);

// Escreve resultado até que não haja mais linhas na tabela
while ($row = mysql_fetch_array($result)) {
    $turma = $row;
}
mysql_free_result($result);
mysql_close($db);


$db = mysql_connect("localhost", "root", "");
mysql_select_db("sistemas_segura", $db);
$result = mysql_query("
        SELECT 
            m.idMatricula, 
            a.nome, 
            a.vinculo, 
            a.cpf 
        FROM 
            matricula m LEFT JOIN aluno a on m.idAluno = a.idAluno 
        WHERE 
            m.idTurma = $idTurma and 
            a.status != 'Excluido' and
            m.status = 'Concluido' and
            a.vinculo = '1'
        ORDER BY
            a.nome", $db);

$aux = "";
$aux2 = "";
$aux3 = "";
$aux4 = "";
$aux5 = "";
$contador = 0;
// Escreve resultado até que não haja mais linhas na tabela
while ($row = mysql_fetch_array($result)) {
    $contador++;

    if ($contador <= 20) {
        $aux = $aux . "<tr><td>" . $contador . "</td><td>" . $row["nome"] . "</td><td>" . "</td><td>" . "</td></tr>";
    } else if ($contador > 20 && $contador <= 40) {
        $aux2 = $aux2 . "<tr><td>" . $contador . "</td><td>" . $row["nome"] . "</td><td>" . "</td><td>" . "</td></tr>";
    } else if ($contador > 40 && $contador <= 60) {
        $aux3 = $aux3 . "<tr><td>" . $contador . "</td><td>" . $row["nome"] . "</td><td>" . "</td><td>" . "</td></tr>";
    } else if ($contador > 60 && $contador <= 80) {
        $aux4 = $aux4 . "<tr><td>" . $contador . "</td><td>" . $row["nome"] . "</td><td>" . "</td><td>" . "</td></tr>";
    } else if ($contador > 80 && $contador <= 100) {
        $aux5 = $aux5 . "<tr><td>" . $contador . "</td><td>" . $row["nome"] . "</td><td>" . "</td><td>" . "</td></tr>";
    }
}
mysql_free_result($result);
mysql_close($db);

$lista = "";

if (strcmp($aux, "") != 0) {
    $lista = $lista . '<div class="corpo">
            <div id="cabecalho">
                <div id="logoEsquerda"></div>
                <div id="logoEsquerda2"></div>
                <div id="cabecalhoDetalhesEsquerdo">
                   
                </div>
                <div id="cabecalhoDetalhesDireito">
                    <table style="font-size: 16px;" border = 1>
                        <tr>
                            <td rowspan="2" style="font-size: 22px; text-align: center;"> LISTA DE PROTOCOLO </td>
                            <td> FORM-SEGURA-062 </td>
                        </tr>
                        <tr>
                            <td> Revisão: 00 </td>
                        </tr>
                    </table>
                </div>
                <div id="logoDireita"></div>
            </div>
            <div id="dadosCurso">
                <table>
                    <tr>
                        <td colspan = 2><b>TÍTULO DO PROGRAMA:</b></td>
                        <td>'.$turma["curso"].'</td>
                        <td></td>
                        <td></td>
                        <td><b>PERÍODO:</b></td>
                        <td>'.$turma["periodo"].'</td>
                    </tr>
                    <tr>
                        <td><b>CARGA HORÁRIA:</b></td>
                        <td>'.$turma["cargaHoraria"].'</td>
                        <td><b>INSTRUTORES</b></td>
                        <td colspan = 2>____________________________________________</td>
                        <td><b>LOCAL:</b></td>
                        <td>'.$turma["local"].'</td>
                    </tr>
                </table>
            </div>
                <!--<div id="informacoesGerais">
                    <?php
                    echo ("Hora: ".date("h:i:s"));
                    echo ("  Data: ".date("d/m/Y"));
                    ?><br>   
                </div>
                -->
            
            <div id="relatorio">
                
                <div class="dadosRelatorio">
                    <table id="tabelaRelatorio" border = 1 style="width:1000px; text-align:center;">
                        <tr>
                            <td style="text-align:center;"><b>ORD.</b></td>
                            <td style="text-align:center;"><b>NOME</b></td>
                            <td style="text-align:center;"><b>DATA</b></td>
                            <td style="text-align:center;"><b>ASSINATURA</b></td>
                        </tr>
                        ' . $aux . '
                    </table>
                </div>
            </div>
<br><br>
            <div id="rodape">
                <div id="rodapeDetalhes1">
                    SEGURA CONSULTORIA, TREINAMENTO E LOCAÇÕES LTDA.<br />
                    CNPJ: 07.197.127/0001-91 - Insc. Munic.: 153.000-3<br />
                    Cód. Ativ. Princ.: 82.9.97.099<br />
                    Cód. Ativ. Sec.: 43.23.23.003 / 85.9.96.004<br />
                    www.segurarn.com.br.
                </div>
                <div id="rodapeDetalhes2">
                    NATAL-RN<br />
                    Av. Lima e Silva, 1525, Lagoa Nova<br />
                    CEP: 59.075-710 - Natal/RN<br />
                    Fones: (84) 3231.0025 / 8895.4385<br />
                </div>
                <div id="rodapeDetalhes3">
                    MOSSORÓ-RN<br />
                    Av. Presidente Dutra, 3100, Alto do Sumaré<br />
                    CEP: 59.633-550 - Mossoró/RN<br />
                    Fones: (84) 3312.1317 / 3312.6006 / 8898.4382<br />
                </div>
                <div id="rodapeDetalhes4">
                    MARUIM-SE<br />
                    BR 101, KM 75, s/n - Maruim/SE<br />
                    CEP: 49.770-000<br />
                    Fones: (79) 3281.3574 / 8865.1616<br />
                </div>
            </div>
        </div>';
}

if (strcmp($aux2, "") != 0) {
    $lista = $lista . '<div class="corpo">
            <div id="cabecalho">
                <div id="logoEsquerda"></div>
                <div id="logoEsquerda2"></div>
                <div id="cabecalhoDetalhesEsquerdo">
                   
                </div>
                <div id="cabecalhoDetalhesDireito">
                    <table style="font-size: 16px;" border = 1>
                        <tr>
                            <td rowspan="2" style="font-size: 22px; text-align: center;"> LISTA DE PROTOCOLO </td>
                            <td> FORM-SEGURA-062 </td>
                        </tr>
                        <tr>
                            <td> Revisão: 00 </td>
                        </tr>
                    </table>
                </div>
                <div id="logoDireita"></div>
            </div>
            <div id="dadosCurso">
                <table>
                    <tr>
                        <td colspan = 2><b>TÍTULO DO PROGRAMA:</b></td>
                        <td>'.$turma["curso"].'</td>
                        <td></td>
                        <td></td>
                        <td><b>PERÍODO:</b></td>
                        <td>'.$turma["periodo"].'</td>
                    </tr>
                    <tr>
                        <td><b>CARGA HORÁRIA:</b></td>
                        <td>'.$turma["cargaHoraria"].'</td>
                        <td><b>INSTRUTORES</b></td>
                        <td colspan = 2>____________________________________________</td>
                        <td><b>LOCAL:</b></td>
                        <td>'.$turma["local"].'</td>
                    </tr>
                </table>
            </div>
                <!--<div id="informacoesGerais">
                    <?php
                    echo ("Hora: ".date("h:i:s"));
                    echo ("  Data: ".date("d/m/Y"));
                    ?><br>   
                </div>
                -->
            
            <div id="relatorio">
                
                <div class="dadosRelatorio">
                    <table id="tabelaRelatorio" border = 1 style="width:1000px; text-align:center;">
                        <tr>
                            <td style="text-align:center;"><b>ORD.</b></td>
                            <td style="text-align:center;"><b>NOME</b></td>
                            <td style="text-align:center;"><b>DATA</b></td>
                            <td style="text-align:center;"><b>ASSINATURA</b></td>
                        </tr>
                        ' . $aux2 . '
                    </table>
                </div>
            </div>
<br><br>
            <div id="rodape">
                <div id="rodapeDetalhes1">
                    SEGURA CONSULTORIA, TREINAMENTO E LOCAÇÕES LTDA.<br />
                    CNPJ: 07.197.127/0001-91 - Insc. Munic.: 153.000-3<br />
                    Cód. Ativ. Princ.: 82.9.97.099<br />
                    Cód. Ativ. Sec.: 43.23.23.003 / 85.9.96.004<br />
                    www.segurarn.com.br.
                </div>
                <div id="rodapeDetalhes2">
                    NATAL-RN<br />
                    Av. Lima e Silva, 1525, Lagoa Nova<br />
                    CEP: 59.075-710 - Natal/RN<br />
                    Fones: (84) 3231.0025 / 8895.4385<br />
                </div>
                <div id="rodapeDetalhes3">
                    MOSSORÓ-RN<br />
                    Av. Presidente Dutra, 3100, Alto do Sumaré<br />
                    CEP: 59.633-550 - Mossoró/RN<br />
                    Fones: (84) 3312.1317 / 3312.6006 / 8898.4382<br />
                </div>
                <div id="rodapeDetalhes4">
                    MARUIM-SE<br />
                    BR 101, KM 75, s/n - Maruim/SE<br />
                    CEP: 49.770-000<br />
                    Fones: (79) 3281.3574 / 8865.1616<br />
                </div>
            </div>
        </div>';
}

if (strcmp($aux3, "") != 0) {
    $lista = $lista . '<div class="corpo">
            <div id="cabecalho">
                <div id="logoEsquerda"></div>
                <div id="logoEsquerda2"></div>
                <div id="cabecalhoDetalhesEsquerdo">
                   
                </div>
                <div id="cabecalhoDetalhesDireito">
                    <table style="font-size: 16px;" border = 1>
                        <tr>
                            <td rowspan="2" style="font-size: 22px; text-align: center;"> LISTA DE PROTOCOLO </td>
                            <td> FORM-SEGURA-062 </td>
                        </tr>
                        <tr>
                            <td> Revisão: 00 </td>
                        </tr>
                    </table>
                </div>
                <div id="logoDireita"></div>
            </div>
            <div id="dadosCurso">
                <table>
                    <tr>
                        <td colspan = 2><b>TÍTULO DO PROGRAMA:</b></td>
                        <td>'.$turma["curso"].'</td>
                        <td></td>
                        <td></td>
                        <td><b>PERÍODO:</b></td>
                        <td>'.$turma["periodo"].'</td>
                    </tr>
                    <tr>
                        <td><b>CARGA HORÁRIA:</b></td>
                        <td>'.$turma["cargaHoraria"].'</td>
                        <td><b>INSTRUTORES</b></td>
                        <td colspan = 2>____________________________________________</td>
                        <td><b>LOCAL:</b></td>
                        <td>'.$turma["local"].'</td>
                    </tr>
                </table>
            </div>
                <!--<div id="informacoesGerais">
                    <?php
                    echo ("Hora: ".date("h:i:s"));
                    echo ("  Data: ".date("d/m/Y"));
                    ?><br>   
                </div>
                -->
            
            <div id="relatorio">
                
                <div class="dadosRelatorio">
                    <table id="tabelaRelatorio" border = 1 style="width:1000px; text-align:center;">
                        <tr>
                            <td style="text-align:center;"><b>ORD.</b></td>
                            <td style="text-align:center;"><b>NOME</b></td>
                            <td style="text-align:center;"><b>DATA</b></td>
                            <td style="text-align:center;"><b>ASSINATURA</b></td>
                        </tr>
                        ' . $aux3 . '
                    </table>
                </div>
            </div>
<br><br>
            <div id="rodape">
                <div id="rodapeDetalhes1">
                    SEGURA CONSULTORIA, TREINAMENTO E LOCAÇÕES LTDA.<br />
                    CNPJ: 07.197.127/0001-91 - Insc. Munic.: 153.000-3<br />
                    Cód. Ativ. Princ.: 82.9.97.099<br />
                    Cód. Ativ. Sec.: 43.23.23.003 / 85.9.96.004<br />
                    www.segurarn.com.br.
                </div>
                <div id="rodapeDetalhes2">
                    NATAL-RN<br />
                    Av. Lima e Silva, 1525, Lagoa Nova<br />
                    CEP: 59.075-710 - Natal/RN<br />
                    Fones: (84) 3231.0025 / 8895.4385<br />
                </div>
                <div id="rodapeDetalhes3">
                    MOSSORÓ-RN<br />
                    Av. Presidente Dutra, 3100, Alto do Sumaré<br />
                    CEP: 59.633-550 - Mossoró/RN<br />
                    Fones: (84) 3312.1317 / 3312.6006 / 8898.4382<br />
                </div>
                <div id="rodapeDetalhes4">
                    MARUIM-SE<br />
                    BR 101, KM 75, s/n - Maruim/SE<br />
                    CEP: 49.770-000<br />
                    Fones: (79) 3281.3574 / 8865.1616<br />
                </div>
            </div>
        </div>';
}

if (strcmp($aux4, "") != 0) {
    $lista = $lista . '<div class="corpo">
            <div id="cabecalho">
                <div id="logoEsquerda"></div>
                <div id="logoEsquerda2"></div>
                <div id="cabecalhoDetalhesEsquerdo">
                   
                </div>
                <div id="cabecalhoDetalhesDireito">
                    <table style="font-size: 16px;" border = 1>
                        <tr>
                            <td rowspan="2" style="font-size: 22px; text-align: center;"> LISTA DE PROTOCOLO </td>
                            <td> FORM-SEGURA-062 </td>
                        </tr>
                        <tr>
                            <td> Revisão: 00 </td>
                        </tr>
                    </table>
                </div>
                <div id="logoDireita"></div>
            </div>
            <div id="dadosCurso">
                <table>
                    <tr>
                        <td colspan = 2><b>TÍTULO DO PROGRAMA:</b></td>
                        <td>'.$turma["curso"].'</td>
                        <td></td>
                        <td></td>
                        <td><b>PERÍODO:</b></td>
                        <td>'.$turma["periodo"].'</td>
                    </tr>
                    <tr>
                        <td><b>CARGA HORÁRIA:</b></td>
                        <td>'.$turma["cargaHoraria"].'</td>
                        <td><b>INSTRUTORES</b></td>
                        <td colspan = 2>____________________________________________</td>
                        <td><b>LOCAL:</b></td>
                        <td>'.$turma["local"].'</td>
                    </tr>
                </table>
            </div>
                <!--<div id="informacoesGerais">
                    <?php
                    echo ("Hora: ".date("h:i:s"));
                    echo ("  Data: ".date("d/m/Y"));
                    ?><br>   
                </div>
                -->
            
            <div id="relatorio">
                
                <div class="dadosRelatorio">
                    <table id="tabelaRelatorio" border = 1 style="width:1000px; text-align:center;">
                        <tr>
                            <td style="text-align:center;"><b>ORD.</b></td>
                            <td style="text-align:center;"><b>NOME</b></td>
                            <td style="text-align:center;"><b>DATA</b></td>
                            <td style="text-align:center;"><b>ASSINATURA</b></td>
                        </tr>
                        ' . $aux4 . '
                    </table>
                </div>
            </div>
<br><br>
            <div id="rodape">
                <div id="rodapeDetalhes1">
                    SEGURA CONSULTORIA, TREINAMENTO E LOCAÇÕES LTDA.<br />
                    CNPJ: 07.197.127/0001-91 - Insc. Munic.: 153.000-3<br />
                    Cód. Ativ. Princ.: 82.9.97.099<br />
                    Cód. Ativ. Sec.: 43.23.23.003 / 85.9.96.004<br />
                    www.segurarn.com.br.
                </div>
                <div id="rodapeDetalhes2">
                    NATAL-RN<br />
                    Av. Lima e Silva, 1525, Lagoa Nova<br />
                    CEP: 59.075-710 - Natal/RN<br />
                    Fones: (84) 3231.0025 / 8895.4385<br />
                </div>
                <div id="rodapeDetalhes3">
                    MOSSORÓ-RN<br />
                    Av. Presidente Dutra, 3100, Alto do Sumaré<br />
                    CEP: 59.633-550 - Mossoró/RN<br />
                    Fones: (84) 3312.1317 / 3312.6006 / 8898.4382<br />
                </div>
                <div id="rodapeDetalhes4">
                    MARUIM-SE<br />
                    BR 101, KM 75, s/n - Maruim/SE<br />
                    CEP: 49.770-000<br />
                    Fones: (79) 3281.3574 / 8865.1616<br />
                </div>
            </div>
        </div>';
}

if (strcmp($aux5, "") != 0) {
    $lista = $lista . '<div class="corpo">
            <div id="cabecalho">
                <div id="logoEsquerda"></div>
                <div id="logoEsquerda2"></div>
                <div id="cabecalhoDetalhesEsquerdo">
                   
                </div>
                <div id="cabecalhoDetalhesDireito">
                    <table style="font-size: 16px;" border = 1>
                        <tr>
                            <td rowspan="2" style="font-size: 22px; text-align: center;"> LISTA DE PROTOCOLO </td>
                            <td> FORM-SEGURA-062 </td>
                        </tr>
                        <tr>
                            <td> Revisão: 00 </td>
                        </tr>
                    </table>
                </div>
                <div id="logoDireita"></div>
            </div>
            <div id="dadosCurso">
                <table>
                    <tr>
                        <td colspan = 2><b>TÍTULO DO PROGRAMA:</b></td>
                        <td>'.$turma["curso"].'</td>
                        <td></td>
                        <td></td>
                        <td><b>PERÍODO:</b></td>
                        <td>'.$turma["periodo"].'</td>
                    </tr>
                    <tr>
                        <td><b>CARGA HORÁRIA:</b></td>
                        <td>'.$turma["cargaHoraria"].'</td>
                        <td><b>INSTRUTORES</b></td>
                        <td colspan = 2>____________________________________________</td>
                        <td><b>LOCAL:</b></td>
                        <td>'.$turma["local"].'</td>
                    </tr>
                </table>
            </div>
                <!--<div id="informacoesGerais">
                    <?php
                    echo ("Hora: ".date("h:i:s"));
                    echo ("  Data: ".date("d/m/Y"));
                    ?><br>   
                </div>
                -->
            
            <div id="relatorio">
                
                <div class="dadosRelatorio">
                    <table id="tabelaRelatorio" border = 1 style="width:1000px; text-align:center;">
                        <tr>
                            <td style="text-align:center;"><b>ORD.</b></td>
                            <td style="text-align:center;"><b>NOME</b></td>
                            <td style="text-align:center;"><b>DATA</b></td>
                            <td style="text-align:center;"><b>ASSINATURA</b></td>
                        </tr>
                        ' . $aux5 . '
                    </table>
                </div>
            </div>
<br><br>
            <div id="rodape">
                <div id="rodapeDetalhes1">
                    SEGURA CONSULTORIA, TREINAMENTO E LOCAÇÕES LTDA.<br />
                    CNPJ: 07.197.127/0001-91 - Insc. Munic.: 153.000-3<br />
                    Cód. Ativ. Princ.: 82.9.97.099<br />
                    Cód. Ativ. Sec.: 43.23.23.003 / 85.9.96.004<br />
                    www.segurarn.com.br.
                </div>
                <div id="rodapeDetalhes2">
                    NATAL-RN<br />
                    Av. Lima e Silva, 1525, Lagoa Nova<br />
                    CEP: 59.075-710 - Natal/RN<br />
                    Fones: (84) 3231.0025 / 8895.4385<br />
                </div>
                <div id="rodapeDetalhes3">
                    MOSSORÓ-RN<br />
                    Av. Presidente Dutra, 3100, Alto do Sumaré<br />
                    CEP: 59.633-550 - Mossoró/RN<br />
                    Fones: (84) 3312.1317 / 3312.6006 / 8898.4382<br />
                </div>
                <div id="rodapeDetalhes4">
                    MARUIM-SE<br />
                    BR 101, KM 75, s/n - Maruim/SE<br />
                    CEP: 49.770-000<br />
                    Fones: (79) 3281.3574 / 8865.1616<br />
                </div>
            </div>
        </div>';
}

$html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd" >
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />

		<meta name="description" content="" />
	  	<meta name="keywords" content="" />
                <link href="{{$CSS}}sunset.css" rel="stylesheet" type="text/css" />
		<link href="{{$CSS}}darkness/jquery-ui-1.8.14.custom.css" rel="stylesheet" type="text/css" />
		<link href="{{$CSS}}layout-default.css" rel="stylesheet" type="text/css" />
		<link href="{{$CSS}}menu2.css" rel="stylesheet" type="text/css" />
		<link href="{{$CSS}}jquery.message.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" media="screen" href="{{$CSS}}flexigrid/flexigrid.css" />

		<script src="{{$JS}}jquery-1.3.2.min.js" type="text/javascript"></script>
                <script type="text/javascript" src="{{$JS}}ajaxupload.js"></script>

		<script src="{{$JS}}jquery/jquery.metadata.js" type="text/javascript"></script>
		<script src="{{$JS}}jquery/chili-1.7.pack.js" type="text/javascript"></script>
		<script src="{{$JS}}jquery/effects.core.js" type="text/javascript"></script>
		<script src="{{$JS}}jquery/mbMenu.js" type="text/javascript"></script>

		<script src="{{$JS}}jquery-ui-1.7.2.custom.min.js" type="text/javascript"></script>
		<script src="{{$JS}}jquery.layout.min.js" type="text/javascript"></script>
		<script src="{{$JS}}jquery.qtip-1.0.0-rc3.min.js" type="text/javascript"></script>
		<script src="{{$JS}}jquery/jquery.message.min.js" type="text/javascript"></script>

		<script src="{{$JS}}flexigrid.patched.js" type="text/javascript"></script>

		<script src="{{$JS}}validadores.js" type="text/javascript"></script>

		
	</head>
<style>
    body {
        font-size: 62.5%;
    }

    .corpo{
            height: 700px;
            width: 1000px;
            display: block;
            text-align: left;
        }
        
        #cabecalho{
            height: 80px;
            width: 1000px;
            display: block;
            border-bottom: solid 1px black;
        }
        
        #cabecalhoDetalhesEsquerdo{
            height: 50px;
            width: 50px;
            margin: 5px;
            float: left;
            display: inline-block;
        }

        #cabecalhoDetalhesDireito{
            height: 50px;
            width: 500px;
            margin: 5px;
            float: left;
            display: inline-block;
        }
    
    #logoEsquerda{
            height: 50px;
            width: 150px;
            margin: 5px;
            float: rigth;
            display: block;
            background-image: url("logoSegura.png");
    }
    
    #logoEsquerda2{
            height: 58px;
            width: 96px;
            margin: 5px;
            float: left;
            display: inline-block;
            background-image: url("cabecalho.png");
    }
    
    #logoDireita{
            height: 73px;
            width: 150px;
            margin: 0px;
            float: right;
            display: inline-block;
            background-image: url("logoIso.png");            
            
    }

    #relatorio{
        height: 450px;
        width: 1000px;
        display: block;
    }

    #dadosCurso{
        font-size:15px;
    }
    
    .dadosRelatorio{
        font-size:12px;
    }
    
    #rodape{
            height: 95px;
            width: 1000px;
            font-size: 10px;
            display: block;
        }
        
        #rodapeDetalhes1{
            height: 95px;
            width: 236px;
            padding-left: 10px;
            
            float:left;
            border-right: solid 1px black;
        }

        #rodapeDetalhes2{
            height: 95px;
            width: 236px;
            padding-left: 10px;
            display: inline-block;
            float:left;
            border-right: solid 1px black;
        }

        #rodapeDetalhes3{
            height: 95px;
            width: 236px;
            padding-left: 10px;
            display: inline-block;
            float:left;
            border-right: solid 1px black;
        }

        #rodapeDetalhes4{
            height: 95px;
            width: 237px;
            padding-left: 10px;
            display: inline-block;
            float:left;
        }    

</style>
<body>

' . $lista . '
</body>
</html>';

require_once ("dompdf_config.inc.php");
//$html= file_get_contents("../../view/pages/interno/modulo/pdf/relatorioEconomico.tpl");

$html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->set_paper('a4', 'landscape');
$dompdf->render();
$dompdf->stream("Protocolo.pdf", array("Attachment" => true));
?>