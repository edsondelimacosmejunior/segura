<?php

$idMatricula = $_POST["idMatriculaCertificadoPDF"];

$db = mysql_connect("localhost", "root", "");
mysql_select_db("sistemas_segura", $db);


$result = mysql_query("SELECT 
           m.idMatricula, 
           m.status, 
           a.nome as aluno, 
           a.telefone1,
           a.cpf,
           c.nome as curso,
           c.cargaHoraria,
           t.dataTurma,
           c.patchConteudo,
           t.idInstrutor1,
           t.idInstrutor2,
           t.idInstrutor3,
           t.idInstrutor4,
           t.local
        FROM 
            (
                (
                   Matricula m LEFT JOIN Aluno a on m.idAluno = a.idAluno 
                )
                LEFT JOIN Turma t on m.idTurma = t.idTurma
            ) 
            LEFT JOIN Curso c on t.idCurso = c.idCurso
        WHERE 
           m.idMatricula = $idMatricula and
           m.status like 'Concluido'", $db);

// Escreve resultado até que não haja mais linhas na tabela
while ($row = mysql_fetch_array($result)) {

    if ($row["idInstrutor1"]) {
        $row["idInstrutor1"] = getPatchAssinatura($row["idInstrutor1"]);
    } else {
        $row["idInstrutor1"] = "assinaturaBranco.jpg";
    }
    if ($row["idInstrutor2"]) {
        $row["idInstrutor2"] = getPatchAssinatura($row["idInstrutor2"]);
    } else {
        $row["idInstrutor2"] = "assinaturaBranco.jpg";
    }
    if ($row["idInstrutor3"]) {
        $row["idInstrutor3"] = getPatchAssinatura($row["idInstrutor3"]);
    } else {
        $row["idInstrutor3"] = "assinaturaBranco.jpg";
    }
    if ($row["idInstrutor4"]) {
        $row["idInstrutor4"] = getPatchAssinatura($row["idInstrutor4"]);
    } else {
        $row["idInstrutor4"] = "assinaturaBranco.jpg";
    }
    
    if ($row["patchConteudo"]) {
        
    } else {
        $row["patchConteudo"] = "gradeBranco.jpg";
    }

    $matricula[] = $row;
}



mysql_free_result($result);
mysql_close($db);

if($matricula){
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
            height: 248px;
            width: 740px;
            display: block;
            text-align: left;
            font-size: 13px;
            background-image: url("certificado.jpg");
        }
        
        #ladoEsquerdo{
            height: 235px;
            width: 370px;
            display: inline-block;
            float: left;
            text-align: left;
        }
        
        #cabecalho{
            height: 73px;
            width: 345px;
            display: block;
            text-align: center;
            font-weight: bold;
            margin-left: 15px;
            margin-top: 5px;
        }
        
        #curso{
            height: 32px;
            width: 345px;
            display: block;
            text-align: center;
            font-weight: bold;
            margin-left: 15px;
            font-size: 20px;
            font-family: "Arial Black, Gadget, sans-serif";
        }
        
        #nome{
            height: 15px;
            width: 327px;
            display: block;
            text-align: left;
            margin-top: 17px;
            margin-left: 15px;
            font-size: 11px;
            font-weight: bold;
            font-family: "Arial, Helvetica, sans-serif";
        }
        
        #faixa3{
            height: 35px;
            width: 345px;
            margin-top: 17px;
            margin-left: 15px;
            display: block;
            text-align: left;
            font-family: "Arial, Helvetica, sans-serif";
        }
        
        #conclusao{
            height: 13px;
            width: 104px;
            display: inline-block;
            text-align: left;
            margin-left: 5px;
            font-family: "Arial, Helvetica, sans-serif";
            font-weight: bold;
        }
        
        #cargaHoraria{
            height: 13px;
            width: 99px;
            display: inline-block;
            text-align: left;
            margin-left: 10px;
            font-family: "Arial, Helvetica, sans-serif";
            font-weight: bold;
        }
        
        #cpf{
            height: 13px;
            width: 109px;
            display: inline-block;
            text-align: left;
            margin-left: 10px;
            font-family: "Arial, Helvetica, sans-serif";
            font-weight: bold;
        }
        
        #rodape{
            height: 35px;
            width: 340px;
            display: block;
            margin-left: 15px;
        }
        
        #ladoDireito{
            height: 235px;
            width: 375px;
            display: inline-block;
            float: left;
            text-align: left;
        }
        
        #ladoDireitoA{
            height: 130px;
            width: 240px;
            display: inline-block;
            margin-left: 14px;
        }
        
        #ladoDireitoB{
            height: 152px;
            width: 80px;
            display: inline-block;
            margin-left: 5px;
        }

        #cabecalho2{
            height: 40px;
            width: 230px;
            margin-top: 8px;
            display: block;
        }
        
        #grade{
            height: 120px;
            width: 245px;
            display: block;
        }
        
        #qrcode{
            height: 70px;
            width: 70px;
            margin-top: 8px;
            display: block;
        }
        
        #matricula{
            height: 10px;
            width: 70px;
            text-align: center;
            display: block;
            font-family: "Arial, Helvetica, sans-serif";
        }
        
        #local{
            height: 10px;
            width: 325px;
            margin-top: 27px;
            text-align: right;
            font-size: 8px;
            margin-left: 25px;
            display: block;
        }

        #assinaturas{
            height: 25px;
            width: 327px;
            margin-left: 20px;
            display: block;
        }
        
    </style>
    <body>
        <div class="corpo">
            <div id="ladoEsquerdo">
                <div id="cabecalho">
                <table height="78" cellspacing="0" cellpadding="3" style="width:300px;">
                    <tbody>
                        <tr>
                            <td height="50">
                                <div style="float: left; width: 120px"><img width="120" src="logo_topo.png"></div>
                            </td>
                            <td style=" height=50px; width: 75px;">
                                <div style="color:#59A270; font-size:12px; font-weight:bold; font-family: Arial Black, Helvetica, sans-serif; position:relative; margin-left: 8px;float: left; width: 95px">Consultoria e Treinamento</div>
                            </td>
                            <td height="50">
                                <div style="float: left; width: 90px"><img width="90" src="logo_topo2.jpg";"></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
                <div id="curso">
                    ' . $matricula[0]["curso"] . '
                </div>
                <div id="nome">
                    ' . $matricula[0]["aluno"] . '
                </div>
                <div id="faixa3">
                    <div id="conclusao">' . $matricula[0]["dataTurma"] . '</div>
                    <div id="cargaHoraria">' . $matricula[0]["cargaHoraria"] . '</div>
                    <div id="cpf">' . $matricula[0]["cpf"] . '</div>
                </div>
                <div id="rodape">
                    <img width="340" src="diretor.jpg";">
                </div>
            </div>
            <div id="ladoDireito">
                <div id="ladoDireitoA">
                    <div id="cabecalho2">
                        <img width="125" src="cabecalho2.jpg";">
                    </div>
                    <div id="grade">
                        <img src="../../view/imgs/uploads/' . $matricula[0]["patchConteudo"] . '" alt="Grade Curricular" width="245px"; height="120px;" />
                    </div>
                </div>
                <div id="ladoDireitoB">
                    <div id="qrcode">
                        <img src="http://chart.apis.google.com/chart?cht=qr&chl=CPF=' . $matricula[0]["cpf"] . '/MAT=' . $matricula[0]["idMatricula"] . '&chs=80x80" alt="Segura - QR code"/>
                    </div>
                    <div id="matricula">' . $matricula[0]["idMatricula"] . '</div>
                </div>
                <div id="local">
                ' . $matricula[0]["local"] . '
                </div>
                <div id="assinaturas">
                <table height="75" style="width:300px;">
                    <tbody>
                        <tr>
                            <td>
                               <img src="../../view/imgs/uploads/' . $matricula[0]["idInstrutor3"] . '" alt="Assinatura" width="55px"; height="25px;" />
                            </td>
                            <td>
                                <img src="../../view/imgs/uploads/' . $matricula[0]["idInstrutor1"] . '" alt="Assinatura" width="55px"; height="25px;" />
                            </td>
                            <td>
                                <img src="../../view/imgs/uploads/' . $matricula[0]["idInstrutor2"] . '" alt="Assinatura" width="55px"; height="25px;" />
                            </td>
                            <td>
                                <img src="../../view/imgs/uploads/' . $matricula[0]["idInstrutor4"] . '" alt="Assinatura" width="55px"; height="25px;" />
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </body>
</html>';
}else{
    $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd" >
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    </head>
    <body>
    Nenhum aluno apto a obter certificado
        </body>
</html>';
}
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

<?php

function getPatchAssinatura($idInstrutor) {
    
$db2 = mysql_connect("localhost", "root", "");
mysql_select_db("sistemas_segura", $db2);

    $result2 = mysql_query("SELECT 
           i.idInstrutor, 
           i.patchAssinatura
        FROM 
            Instrutor i
        WHERE 
           i.idInstrutor = $idInstrutor", $db2);

    // Escreve resultado até que não haja mais linhas na tabela
    while ($row2 = mysql_fetch_array($result2)) {
        
        if ($row2["patchAssinatura"]) {
            $patch = $row2["patchAssinatura"];
        }else{
            $patch = "assinaturaBranco.jpg";
        }
    }
    
    return $patch;
}
?>

