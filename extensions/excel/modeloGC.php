<?php
$nome = $_POST["nomeEXCEL"];
$cabecalho = $_POST["cabecalhoEXCEL"];
$extras = $_POST["extrasEXCEL"];
$tabela = $_POST["tabelaEXCEL"];

header("Content-type: application/vnd.ms-excel");
header("Content-type: application/force-download");
header("Content-Disposition: attachment; filename=$nome.xls");
header("Pragma: no-cache");


$html = '
        <table>
            <tr>
                <td colspan="6">
                    Conel Construções e Engenharia LTDA
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    CNPJ 07.005.345/0001-87
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    Rua Manoel Batista Neto, 67. Alto de Sumaré, Mossoró-RN
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    Telefones: +55 84 3312.0969 / +55 84 3312.2444
                </td>
           </tr>
           <tr>
                <td colspan="6">'.$nome.'</td>
            </tr>
            <tr>
                <td colspan="6">'.$extras.'</td>
            </tr>
           <tr>
                <td colspan="6">
                    
                </td>
           </tr>
        </table>
        <table>
            '.$cabecalho.'
            '.$tabela.'
        </table>';


$html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');

echo $html;
?>
