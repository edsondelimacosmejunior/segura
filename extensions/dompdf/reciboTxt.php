<?php

//Recupera o id do usuário logado
$idMatricula = $_POST["idMatriculaPDF"];

$db = mysql_connect("localhost", "root", "");
mysql_select_db("sistemas_segura", $db);

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


$f = fopen("recibo.txt", "w+");

fwrite($f, "M");
fwrite($f, "" . $matricula[0]["idMatricula"] . "\n");
fwrite($f, "" . $matricula[0]["aluno"] . "\n");
fwrite($f, "" . $matricula[0]["telefone1"] . "\n");
fwrite($f, "" . $matricula[0]["cpf"] . "\n");
fwrite($f, "" . $matricula[0]["curso"] . "\n");

fclose($f);

//file_put_contents($arquivo, $dados);

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment');

readfile("recibo.txt");

exit;
?>