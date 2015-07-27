<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd" >
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
            height: 500px;
            width: 1000px;
            display: block;
            text-align: left;
            font-size: 14px;
        }

        #cabecalho{
            height: 80px;
            width: 1000px;
            display: inline-block;
            border-bottom: solid 1px black;
        }

        #cabecalhoDetalhesEsquerdo{
            height: 50px;
            width: 100px;
            margin: 5px;
            float: left;
            display: inline-block;
        }

        #cabecalhoDetalhesDireito{
            height: 50px;
            width: 400px;
            margin: 5px;
            float: left;
            display: inline-block;
        }

        #logoEsquerda{
            height: 50px;
            width: 150px;
            margin: 5px;
            float: left;
            display: inline-block;
            background-image: url("imgs/logoSegura.png");
        }

        #logoEsquerda2{
            height: 58px;
            width: 96px;
            margin: 5px;
            float: left;
            display: inline-block;
            background-image: url("imgs/cabecalho.png");
        }

        #logoDireita{
            height: 72px;
            width: 150px;
            margin: 0px;
            margin-top: -3px;
            float: right;
            display: inline-block;
            background-image: url("imgs/logoIso.png");            

        }

        #relatorio{
            min-height: 500px;
            width: 1000px;
            display: block;
        }

        #rodape{
            height: 95px;
            width: 1000px;
            display: inline-block;
            font-size: 14px;
        }

        #rodapeDetalhes1{
            height: 95px;
            width: 236px;
            padding-left: 10px;
            display: inline-block;
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
        <div class="corpo">
            <div id="cabecalho">
                <div id="logoEsquerda"></div>
                <div id="logoEsquerda2"></div>
                <div id="cabecalhoDetalhesEsquerdo"></div>
                <div id="cabecalhoDetalhesDireito">
                    <table style="font-size: 14px;" border = 1>
                        <tr>
                            <td style="font-size: 22px; text-align: center;">CONSULTA DE CERTIFICADOS</td>
                        </tr>
                    </table>
                </div>
                <div id="logoDireita"></div>
            </div>

            <div id="relatorio">
                <?php
                $cpf = $_REQUEST['cpf'];
                $certificado = $_REQUEST['certificado'];

                $db = mysql_connect("localhost", "root", "");
                mysql_select_db("sistemas_segura", $db);

                if ($cpf == "" && $certificado == "") {
                    $result = "vazio";
                } else if ($cpf == "") {
                    $result = mysql_query("SELECT 
                                                  m.idMatricula, 
                                                  a.nome, 
                                                  a.cpf, 
                                                  c.nome as curso,
                                                  t.dataTurma as dataConclusao
                                           FROM 
                                               (
                                                    (
                                                        Matricula m LEFT JOIN Aluno a on m.idAluno = a.idAluno
                                                    ) 
                                                     LEFT JOIN Turma t on m.idTurma = t.idTurma
                                               ) 
                                                LEFT JOIN Curso c on c.idCurso = t.idCurso 
                                           WHERE 
                                                m.status like 'Concluido' and 
                                                m.idMatricula = " . $certificado . "", $db);
                } else if ($certificado == "") {
                    $result = mysql_query("SELECT 
                                                  m.idMatricula, 
                                                  a.nome, 
                                                  a.cpf, 
                                                  c.nome as curso,
                                                  t.dataTurma as dataConclusao 
                                           FROM 
                                                (
                                                    (
                                                        Matricula m LEFT JOIN Aluno a on m.idAluno = a.idAluno
                                                     ) 
                                                      LEFT JOIN Turma t on m.idTurma = t.idTurma
                                                ) 
                                                 LEFT JOIN Curso c on c.idCurso = t.idCurso 
                                           WHERE 
                                                 a.cpf like '" . $cpf . "' and
                                                 m.status like 'Concluido'", $db);
                } else {
                    $result = mysql_query("SELECT 
                                                  m.idMatricula, 
                                                  a.nome, 
                                                  a.cpf, 
                                                  c.nome as curso, 
                                                  t.dataTurma as dataConclusao 
                                           FROM 
                                               (
                                                    (
                                                        Matricula m LEFT JOIN Aluno a on m.idAluno = a.idAluno
                                                    ) 
                                                     LEFT JOIN Turma t on m.idTurma = t.idTurma
                                               ) 
                                                LEFT JOIN Curso c on c.idCurso = t.idCurso 
                                           WHERE 
                                                a.cpf like '" . $cpf . "' and
                                                m.status like 'Concluido' and 
                                                m.idMatricula = " . $certificado . "", $db);
                }

                $CERTIFICADO = "";
                $NOME = "";
                $CPF = "";
                $CURSO = "";
                $DATACONCLUSAO = "";
                $AUX = "";
                $CONTADOR = 0;

                if ($result != "vazio") {
                    // Escreve resultado até que não haja mais linhas na tabela
                    while ($row = mysql_fetch_array($result)) {
                        $CONTADOR++;
                        $CERTIFICADO = $row["idMatricula"];
                        $NOME = $row["nome"];
                        $CPF = $row["cpf"];
                        $CURSO = $row["curso"];
                        $DATACONCLUSAO = $row["dataConclusao"];
                        $AUX = $AUX . "<tr><td>" . $CERTIFICADO . "</td><td>" . $NOME . "</td><td>" . $CPF . "</td><td>" . $DATACONCLUSAO . "</td><td>" . $CURSO . "</td></tr>";
                    }

                    mysql_free_result($result);
                    mysql_close($db);
                }

                if (strcmp($AUX, "") == 0) {
                    $AUX = "<br><br><br><br>Nenhum certificado foi encontrado.";
                }
                
                ?>
                <table>
                    <tr>
                        <td style="width:200px; font-size: 18px;"><b>Nº do Certificado</b></td>
                        <td style="width:200px; font-size: 18px;"><b>Nome</b></td>
                        <td style="width:200px; font-size: 18px;"><b>CPF</b></td>
                        <td style="width:200px; font-size: 18px;"><b>Data de Conclusão</b></td>
                        <td style="width:200px; font-size: 18px;"><b>Curso</b></td>
                    </tr>
                    <tr>
                        <td><?php echo "$AUX" ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>