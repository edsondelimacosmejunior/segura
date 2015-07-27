<?php
$idTurma = $_POST["idTurmaCertificadoPDF"];

$db = mysql_connect("localhost", "root", "");
mysql_select_db("sistemas_segura", $db);


$result = mysql_query("SELECT 
           m.idMatricula, 
           m.status, 
           a.nome as aluno, 
           a.telefone1,
           a.cpf,
           a.matricula as matpetrobras,
           c.nome as curso,
           c.cargaHoraria,
           c.corFundo,
           c.corFonte,
           c.tamanhoFonte,
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
           t.idTurma = $idTurma and
           t.status like 'Concluido' and
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd" >
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />

        <meta name="description" content="" />
        <meta name="keywords" content="" />


    </head>
    <style>

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
            height: 150px;
            width: 323px;
            display: block;
            float: left;
            text-align: left;
        }

        #ladoDireitoA{
            height: 105px;
            width: 200px;
            display: inline-block;
            background-color: red;
        }

        #ladoDireitoB{
            height: 105px;
            width: 80px;
            display: inline-block;
            margin-left: 5px;
            background-color: black;
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
        <?php for ($i = 0; $i < count($matricula); $i++) {
        
        ?>
        <div style="margin:0 auto; padding:0; width:690px; height:228px; border:1px solid #ccc; margin-bottom:1px;">
            <div style="float:left;">
                <div style="border: 3px solid #ed5d16; margin: 4px;">
                    <table height="214" cellspacing="0" cellpadding="3" border="1" style="width:331px; border: 2px solid #59A270; border-collapse:collapse;">
                        <tbody>
                            <tr>
                                <td height="45" colspan="3">
                                    <div style="float: left; width: 125px"><img width="125" src="logo_topo.jpg" style="margin-left: 2px;"></div>
                                    <div style="color:#59A270; font-size:12px; font-weight:bold; font-family:'Arial Black', Helvetica, sans-serif; position:relative; margin-left: 8px;float: left; width: 94px">Consultoria e Treinamento</div>
                                    <div style="float: left; width: 90px"><img width="90" src="logo_topo2.jpg" style="margin-left: 2px;"></div>
                                </td>
                            </tr>
                            <tr>
                                <td style="background:<?php echo($matricula[$i]["corFundo"]) ?>; border:2px solid #59A270; height:40px; text-align:center; font-size:<?php echo($matricula[$i]["tamanhoFonte"]) ?>px; color:<?php echo($matricula[$i]["corFonte"]) ?>; font-weight:bold; font-family:'Arial Black', Gadget, sans-serif;" colspan="3">
                                    <?php echo($matricula[$i]["curso"]) ?>
                                </td>
                            </tr>
                            <tr>
                                <td height="20" style="border:2px solid #59A270;" colspan="3">
                                    <div style="text-align:left; font-size:9px; color:#000; font-family:Arial, Helvetica, sans-serif;margin-top: -1px;margin-bottom: -1px;">
                                        Nome:
                                    </div>
                                    <div style="text-align:Left; font-size:11px;  color:#000; font-weight:bold; font-family:Arial, Helvetica, sans-serif;margin-top: -1px;margin-bottom: -1px;">
                                        <?php echo($matricula[$i]["aluno"]) ?>             
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td height="20" style="border:2px solid #59A270;">
                                    <div style="text-align:left; font-size:9px; color:#000; font-family:Arial, Helvetica, sans-serif; margin-top: -2px;margin-bottom: -2px;">
                                        Conclusão:
                                    </div>
                                    <div style="text-align:Left; font-size:11px;  color:#000; font-weight:bold; font-family:Arial, Helvetica, sans-serif; margin-top: -2px;margin-bottom: -2px;">
                                        <?php echo($matricula[$i]["dataTurma"]) ?>            
                                    </div>
                                </td>
                                <td style="border:2px solid #59A270;">
                                    <div style="text-align:left; font-size:9px; color:#000; font-family:Arial, Helvetica, sans-serif; margin-top: -2px;margin-bottom: -2px;">
                                        Carga Horária:
                                    </div>
                                    <div style="text-align:Left; font-size:11px; color:#000; font-weight:bold; font-family:Arial, Helvetica, sans-serif;">
                                        <?php echo($matricula[$i]["cargaHoraria"]) ?>
                                    </div>
                                </td>
                                <td style="border:2px solid #59A270;">
                                    <div style="text-align:left; font-size:9px; color:#000; font-family:Arial, Helvetica, sans-serif; margin-left:3px;margin-top: -2px;margin-bottom: -2px;">
                                        <?php 
                                            if (strcmp($matricula[$i]["cpf"], "") != 0) {
                                                echo("CPF:"); 
                                            }else{
                                                echo("MATRICULA:");
                                            }
                                        ?>
                                    </div>
                                    <div style="text-align:Left; font-size:11px;  color:#000; font-weight:bold; font-family:Arial, Helvetica, sans-serif; margin-top: -2px;margin-bottom: -2px;">
                                        <?php 
                                            if (strcmp($matricula[$i]["cpf"], "") != 0) {
                                                echo($matricula[$i]["cpf"]); 
                                            }else{
                                                echo($matricula[$i]["matpetrobras"]); 
                                            }
                                        ?>            
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="bottom" align="center" style="border:2px solid #59A270; font-family:Arial, Helvetica, sans-serif;" colspan="3">
                                    <div style="text-align:center; font-size:11px;  color:#000; font-weight:bold; font-family:Arial, Helvetica, sans-serif;">
                                        Roberto Jackson dos Santos
                                    </div>
                                    <div style="text-align:center; font-size:8px; color:#000;">
                                        Diretor (REG. FUNDACENTRO 39/0047-8)
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="float:right;">
                <div style="border: 3px solid #ed5d16; margin: 4px;">
                    <table height="214" cellspacing="0" cellpadding="2" border="1" id="background" style="width:331px; border: 2px solid #59A270; border-collapse:collapse;">
                        <tbody>
                            <tr>
                                <td>
                                    <div id="ladoDireito">
                                        <table>
                                            <tr>
                                                <td style="height: 145px; width: 250px">
                                                    <img width="225" src="../../view/imgs/uploads/<?php echo($matricula[$i]["patchConteudo"]) ?>"  alt="Grade Curricular" />
                                                </td>
                                                <td valign="top" style="height: 70px; width: 70px; text-align:center; color:#000; font-size:11px; font-weight:bold; font-family:Verdana, Geneva, sans-serif;">
                                                    <img src="http://chart.apis.google.com/chart?cht=qr&chl=<?php echo('CPF=' . $matricula[$i]["cpf"] . '/MAT=' . $matricula[$i]["idMatricula"] . ''); ?>&chs=80x80" alt="Segura - QR code"/>
                                                    <?php echo($matricula[$i]["idMatricula"]) ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" height="50" style="border: 2px solid #59A270; border-collapse:collapse; font-family:Arial, Helvetica, sans-serif;" colspan="3">
                                    <div style="text-align:center; font-size:10px; float:left;">
                                        <b style="font-size:10px;">Instrutores:</b>
                                    </div>
                                    <div style="text-align:center; font-size:10px; float:right;">
                                        <b>Local:</b><?php echo($matricula[$i]["local"]) ?>            
                                    </div>
                                    
                                    <div style="color:#000; font-size:11px; font-family:Arial, Helvetica, sans-serif; text-align:center; margin-top: 15px;">
                                        <table height="30" style="width:300px;">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="../../view/imgs/uploads/<?php echo($matricula[$i]["idInstrutor3"]); ?>" alt="Assinatura" width="75px" height="25px;" />
                                                    </td>
                                                    <td>
                                                        <img src="../../view/imgs/uploads/<?php echo($matricula[$i]["idInstrutor1"]); ?>" alt="Assinatura" width="75px" height="25px;" />
                                                    </td>
                                                    <td>
                                                        <img src="../../view/imgs/uploads/<?php echo($matricula[$i]["idInstrutor2"] ); ?>" alt="Assinatura" width="75px" height="25px;" />
                                                    </td>
                                                    <td>
                                                        <img src="../../view/imgs/uploads/<?php echo($matricula[$i]["idInstrutor4"]); ?>" alt="Assinatura" width="75px" height="25px;" />
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <?php
        if((($i+2) % 4) == 1){
            echo "<div style=\"page-break-before: always;\"> </div><p>";
        }
        
        } ?>
    </body>
</html>


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
        } else {
            $patch = "assinaturaBranco.jpg";
        }
    }

    return $patch;
}
?>


