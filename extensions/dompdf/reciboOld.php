<?php

//set_time_limit(0);

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
                    <br /><br />Recibo Nº 000719
                </div>
                <div id="corpoLadoEsquerdo">
                    <table style="height: 150px;">
                        <tr>
                            <td><b>Nome:</b></td>
                            <td colspan="3">Edson de Lima Cosme Junior</td>
                        </tr>
                        <tr>
                            <td><b>Telefone:</b></td>
                            <td colspan="3">(84) 9666-6612</td>
                        </tr>
                        <tr>
                            <td><b>CPF:</b></td>
                            <td colspan="3">088.871.384-35</td>
                        </tr>
                        <tr>
                            <td><b>Curso:</b></td>
                            <td colspan="3">Ciências da Computação</td>
                        </tr>
                        <tr>
                            <td><b>Data:</b></td>
                            <td colspan="3">08/11/2014</td>
                        </tr>
                        <tr>
                            <td><b>R$</b></td>
                            <td colspan="3">100,00</td>
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
                                <td><b>Nº 000719</b></td>
                            </tr>
                            <tr>
                                <td><b>R$</b></td>
                                <td>100,00</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="corpoLadoDireito">
                    <table style="height: 100px; width: 480px;">
                        <tr>
                            <td style="text-align: right;"><b>Nome:</b></td>
                            <td colspan="3" style="text-align: left;">Edson de Lima Cosme Junior</td>
                        </tr>
                        <tr>
                            <td style="text-align: right;"><b>Curso:</b></td>
                            <td colspan="3" style="text-align: left;">Ciências da Computação</td>
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

/*
ini_set("memory_limit", "1000M");
require_once ("dompdf_config.inc.php");
//$html= file_get_contents("../../view/pages/interno/modulo/pdf/relatorioEconomico.tpl");

$html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->set_paper('a4', 'landscape');
$dompdf->render();
$dompdf->stream("Cartas_Oficiais.pdf", array("Attachment" => true));
*/

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
    "saida.pdf", /* Nome do arquivo de saída */
    array(
        "Attachment" => false /* Para download, altere para true */
    )
);
?>

