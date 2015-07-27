    <?php
    
$idTurma = $_POST["listaFrequencia_idTurma_PDF"];

set_time_limit(0);

$db = mysql_connect("localhost", "sistemas_admin", "eF74123698");
mysql_select_db("sistemas_segura", $db);
$result = mysql_query("
                SELECT 
                    t.*,
                    c.nome as curso,
                    c.cargaHoraria,
                    i.nome as instrutor
                FROM
                    (
                            Turma t LEFT JOIN Curso c on t.idCurso = c.idCurso
                    )
                    LEFT JOIN Instrutor i on t.idInstrutor = i.idInstrutor 
                WHERE 
                    t.idTurma = $idTurma", $db);

// Escreve resultado até que não haja mais linhas na tabela
while ($row = mysql_fetch_array($result)) {
    $turma = $row;
}
mysql_free_result($result);
mysql_close($db);


$db = mysql_connect("localhost", "sistemas_admin", "eF74123698");
mysql_select_db("sistemas_segura", $db);
$result = mysql_query("SELECT m.idMatricula, a.nome, a.vinculo, a.cpf FROM Matricula m LEFT JOIN Aluno a on m.idAluno = a.idAluno WHERE m.idTurma = $idTurma and a.status != 'Excluido' and m.status = 'Matriculado'", $db);

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
        $aux = $aux . "<tr><td>" . $contador . "</td><td>" . $row["nome"] . "</td><td>" . $row["vinculo"] . "</td><td>" . $row["cpf"] . "</td><td></td><td>" . $row["idMatricula"] . "</td></tr>";
    } else if ($contador > 20 && $contador <= 40) {
        $aux2 = $aux2 . "<tr><td>" . $contador . "</td><td>" . $row["nome"] . "</td><td>" . $row["vinculo"] . "</td><td>" . $row["cpf"] . "</td><td></td><td>" . $row["idMatricula"] . "</td></tr>";
    } else if ($contador > 40 && $contador <= 60) {
        $aux3 = $aux3 . "<tr><td>" . $contador . "</td><td>" . $row["nome"] . "</td><td>" . $row["vinculo"] . "</td><td>" . $row["cpf"] . "</td><td></td><td>" . $row["idMatricula"] . "</td></tr>";
    } else if ($contador > 60 && $contador <= 80) {
        $aux4 = $aux4 . "<tr><td>" . $contador . "</td><td>" . $row["nome"] . "</td><td>" . $row["vinculo"] . "</td><td>" . $row["cpf"] . "</td><td></td><td>" . $row["idMatricula"] . "</td></tr>";
    } else if ($contador > 80 && $contador <= 100) {
        $aux5 = $aux5 . "<tr><td>" . $contador . "</td><td>" . $row["nome"] . "</td><td>" . $row["vinculo"] . "</td><td>" . $row["cpf"] . "</td><td></td><td>" . $row["idMatricula"] . "</td></tr>";
    }
}
mysql_free_result($result);
mysql_close($db);

$lista = "";
    
    
    require('dompdf_config.inc.php');
    $html =
  '<html><body>'.
  '<p>Put your html here, or generate it with your favourite '.
  'templating system.</p>'.
  '</body></html>';
  
  ini_set("memory_limit", "10M");
$html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->set_paper('a4', 'landscape');
$dompdf->render();
$dompdf->stream("Lista de Frequência.pdf", array("Attachment" => true));

    
    ?>


