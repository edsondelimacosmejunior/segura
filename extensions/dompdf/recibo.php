<?php

$idMatricula = $_POST["idMatriculaPDF"];

$db = mysql_connect("localhost", "root", "");
mysql_select_db("sistemas_segura", $db);

$result = mysql_query("SELECT 
           m.idMatricula, 
           m.status, 
           t.dataTurma, 
           t.valor, 
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
            height: 310px;
            width: 720px;
            display: inline-block;
            text-align: left;
            font-size: 13px;
            border: solid 1px black;
        }

        #ladoEsquerdo{
            height: 310px;
            width: 239px;
            display: inline-block;
            float: left;
            text-align: left;
            border-right: solid 1px black;
        }

        #cabecalhoLadoEsquerdo{
            height: 110px;
            width: 240px;
            display: inline-block;
            text-align: center;
            font-size: 15px;
        }

        #corpoLadoEsquerdo{
            height: 150px;
            width: 240px;
            display: block;
            text-align: left;
            margin-top: 10px;
        }

        #ladoDireito{
            height: 310px;
            width: 480px;
            display: inline-block;
            float: right;
            text-align:left;
            
        }

        #cabecalhoLadoDireito{
            height: 110px;
            width: 480px;
            display: inline-block;
            text-align: center;
            
        }

        #corpoLadoDireito{
            height: 100px;
            width: 480px;
            display: block;
            text-align: center;
            
        }

        #rodapeLadoDireito{
            height: 50px;
            width: 480px;
            margin-top: 10px;
            display: block;
            text-align: center;
            font-size: 10px;
            
        }


        #logoEsquerda{
            height: 50px;
            width: 150px;
            margin-left: 45px;
            margin-top: 25px;
            background-image: url("logoSegura.png");
            
        }

        #logoDireita{
            height: 50px;
            width: 150px;
            margin-left: 45px;
            margin-top: 25px;
            float: left;
            display: inline-block;
            background-image: url("logoSegura.png");
        }

        #detalhes{
            height: 50px;
            width: 150px;
            margin-left: 145px;
            display: inline-block;
            float: right;
            margin-top: 25px;
        }


    </style>
    <body>
        <div class="corpo">
            <div id="ladoEsquerdo">
                <div id="cabecalhoLadoEsquerdo">
                    <div id="logoEsquerda"></div>
                    <br /><br />Recibo Nº '.$matricula[0]["idMatricula"].'
                </div>
                <div id="corpoLadoEsquerdo">
                    <table style="height: 150px;">
                        <tr>
                            <td><b>Nome:</b></td>
                            <td colspan="3">'.$matricula[0]["aluno"].'</td>
                        </tr>
                        <tr>
                            <td><b>Telefone:</b></td>
                            <td colspan="3">'.$matricula[0]["telefone1"].'</td>
                        </tr>
                        <tr>
                            <td><b>CPF:</b></td>
                            <td colspan="3">'.$matricula[0]["cpf"].'</td>
                        </tr>
                        <tr>
                            <td><b>Curso:</b></td>
                            <td colspan="3">'.$matricula[0]["curso"].'</td>
                        </tr>
                        <tr>
                            <td><b>Data:</b></td>
                            <td colspan="3">'.$matricula[0]["dataTurma"].'</td>
                        </tr>
                        <tr>
                            <td><b>R$</b></td>
                            <td colspan="3">'.$matricula[0]["valor"].'</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div id="ladoDireito">
                <div id="cabecalhoLadoDireito">
                    <div id="logoDireita"></div>
                    <div id="detalhes">
                        <table style="height: 50px;">
                            <tr>
                                <td><b>RECIBO:</b></td>
                                <td><b>Nº '.$matricula[0]["idMatricula"].'</b></td>
                            </tr>
                            <tr>
                                <td><b>R$</b></td>
                                <td>'.$matricula[0]["valor"].'</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="corpoLadoDireito">
                    <table style="height: 100px; width: 480px;">
                        <tr>
                            <td style="text-align: left;"><b>Nome:</b></td>
                            <td colspan="3" style="text-align: left;">'.$matricula[0]["aluno"].'</td>
                        </tr>
                        <tr>
                            <td style="text-align: left;"><b>Curso:</b></td>
                            <td colspan="3" style="text-align: left;">'.$matricula[0]["curso"].'</td>
                        </tr>
                    </table>
                </div>
                <div id="rodapeLadoDireito">
                    Centro de Treinamento Técnico e Profissional - SEGURA <br />
                    Av. Presidente Dutra, 3100, Alto do Sumaré, Mossoró-RN <br />
                    (BR 304, saída p/ Natal, antes do posto de combustível FAN)<br />
                    Fones: (84) 3312.1317 / 3312.6006 / 8898.4382<br />
                    www.segurarn.com.br
                    
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
        "recibo.pdf", /* Nome do arquivo de saída */ array(
    "Attachment" => true /* Para download, altere para true */
        )
);
?>

