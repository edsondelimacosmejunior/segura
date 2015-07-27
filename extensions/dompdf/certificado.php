<?php

$idMatricula = $_POST["idMatriculaCertificadoPDF"];

$db = mysql_connect("localhost", "root", "");
mysql_select_db("segura", $db);

$result = mysql_query("SELECT 
           m.idMatricula, 
           m.status, 
           a.nome as aluno, 
           a.telefone1,
           a.cpf,
           c.nome as curso 
        FROM 
            (
                (
                   Matricula m LEFT JOIN Aluno a on m.idAluno = a.idAluno 
                )
                LEFT JOIN Turma t on m.idTurma = t.idTurma
            ) 
            LEFT JOIN Curso c on t.idCurso = c.idCurso
        WHERE 
           m.idMatricula = $idMatricula", $db);

// Escreve resultado até que não haja mais linhas na tabela
while ($row = mysql_fetch_array($result)) {
    $matricula[] = $row;
}
mysql_free_result($result);
mysql_close($db);


$html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd" >
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />

        <meta name="description" content="" />
        <meta name="keywords" content="" />

    </head>
    <style>
        body {
            font-size: 62.5%;
        }

        .corpo{
            height: 230px;
            width: 720px;
            display: block;
            text-align: left;
            font-size: 13px;
            border: solid 1px black;
        }

        #ladoEsquerdo{
            height: 230px;
            width: 360px;
            display: block;
            float: left;
            text-align: left;
            border-right: solid 1px black;
        }

        #cabecalhoLadoEsquerdo{
            height: 55px;
            width: 360px;
            display: block;
            text-align: center;
            font-size: 15px;
            border-bottom: solid 1px black;
        }
        
        #logoSegura{
            height: 43px;
            width: 128px;
            display: inline-block;
            text-align: left;
            margin-top: 5px;
            margin-left: 5px;
            background-image: url("logoSeguraCertificado.png");
        }
        
        #meioCabecalhoLadoEsquerdo{
            height: 45px;
            width: 120px;
            display: inline-block;
            text-align: center;
            margin-top: 15px;
        }
        
        #logoIso{
            height: 43px;
            width: 93px;
            display: inline-block;
            text-align: left;
            margin-top: 5px;
            background-image: url("logoIsoCertificado.png");
        }

        #corpo1LadoEsquerdo{
            height: 35px;
            width: 360px;
            display: block;
            text-align: center;
            font-weight: bold;
            margin-top: 5px;
            font-size: 25px;
            border-bottom: solid 1px black;
        }
        
        #corpo2LadoEsquerdo{
            height: 30px;
            width: 355px;
            display: block;
            text-align: left;
            font-size: 15px;
            padding-left: 5px;
            padding-top: 5px;
            border-bottom: solid 1px black;
        }
        
        #corpo3LadoEsquerdo{
            height: 35px;
            width: 360px;
            display: block;
            text-align: left;
            border-bottom: solid 1px black;
        }
        
        #conclusaoLadoEsquerdo{
            height: 35px;
            width: 120px;
            display: inline-block;
            text-align: left;
            border-right: solid 1px black;
        }
        
        #cargaHorariaLadoEsquerdo{
            height: 35px;
            width: 120px;
            display: inline-block;
            text-align: left;
            border-right: solid 1px black;
        }
        
        #cpfLadoEsquerdo{
            height: 35px;
            width: 110px;
            display: inline-block;
            text-align: left;
        }
        
        #rodapeLadoEsquerdo{
            height: 65px;
            width: 360px;
            display: block;
            text-align: left;
        }

        #ladoDireito{
            height: 230px;
            width: 355px;
            display: inline-block;
            float: right;
            text-align:left;
            background-color: red;
        }

        #imgCurso{
            height: 165px;
            width: 190px;
            display: inline-block;
            text-align: left;
            background-color: gray;
        }
        
        #qrCode{
            height: 165px;
            width: 160px;
            display: inline-block;
            text-align: left;
        }
        
        #rodapeLadoDireito{
            height: 65px;
            width: 355px;
            display: block;
            text-align: left;
            background-color: black;
        }


    </style>
    <body>
        <div class="corpo">
            <div id="ladoEsquerdo">
                <div id="cabecalhoLadoEsquerdo">
                    <div id="logoSegura"></div>
                    <div id="meioCabecalhoLadoEsquerdo">Consultoria e <br />Treinamento</div>
                    <div id="logoIso"></div>
                </div>
                <div id="corpo1LadoEsquerdo">
                    NR-20 BÁSICO/CBASI
                </div>
                <div id="corpo2LadoEsquerdo">
                    Nome: Edson de Lima Cosme Junior
                </div>
                <div id="corpo3LadoEsquerdo">
                    <div id="conclusaoLadoEsquerdo">Conclusão: <br /> 13/09/2014</div>
                    <div id="cargaHorariaLadoEsquerdo">Carga Horária: <br /> 08 Horas</div>
                    <div id="cpfLadoEsquerdo">CPF: <br /> 088.871.384-35</div>
                </div>
                <div id="rodapeLadoEsquerdo">
                </div>
            </div>
            <div id="ladoDireito">
                <div id="imgCurso">
                </div>
                <div id="qrCode">
                    <img src="http://chart.apis.google.com/chart?cht=qr&chl=http://www.techcaffe.net&chs=120x120" alt="TECHcaffe - QR code"/>
                </div>
                <div id="rodapeLadoDireito">
                </div>
            </div>

        </div>
    </body>
</html>';

/* Carrega a classe DOMPdf */
require_once("dompdf_config.inc.php");

/* Cria a instância */
$dompdf = new DOMPDF();

/* Carrega seu HTML */
$dompdf->load_html($html);

/* Renderiza */
$dompdf->render();

/* Exibe */
$dompdf->stream(
        "certificado.pdf", /* Nome do arquivo de saída */ array(
    "Attachment" => true /* Para download, altere para true */
        )
);
?>

