<?php

$nome = $_POST["nomeEXCEL"];
$cabecalho = $_POST["cabecalhoEXCEL"];
$extras = $_POST["extrasEXCEL"];
$tabela = $_POST["tabelaEXCEL"];

// Incluimos a classe PHPExcel
include 'PHPExcel/Classes/PHPExcel.php';


//$cabecalho = "<th>OS</th><th>Chapa</th><th>Nome</th><th>CPF</th><th>RG</th><th>Função</th><th>Data de Nascimento</th><th>Data de Admissão</th><th>Banco</th><th>Agência</th><th>Conta</th><th>Operação</th>";
//$tabela = "<tr><td>coluna 1</td><td>coluna 2</td></tr><tr><td>coluna 3</td><td>coluna 4</td></tr>";



$retiraFechamentosColunasCabecalho = explode("</th>", $cabecalho);

$cabecalho = "";
$numeroCabecalhos = 0;

for ($i = 0; $i < count($retiraFechamentosColunasCabecalho); $i++) {
    $cabecalho = $cabecalho . $retiraFechamentosColunasCabecalho[$i];
    $numeroCabecalhos++;
}

$retiraFechamentosLinhasCabecalho = explode("</tr>", $cabecalho);

$cabecalho = "";

for ($i = 0; $i < count($retiraFechamentosLinhasCabecalho); $i++) {
    $cabecalho = $cabecalho . $retiraFechamentosLinhasCabecalho[$i];
}




$retiraFechamentosColunas = explode("</td>", $tabela);

$tabela = "";

for ($i = 0; $i < count($retiraFechamentosColunas); $i++) {
    $tabela = $tabela . $retiraFechamentosColunas[$i];
}

$retiraFechamentosLinhas = explode("</tr>", $tabela);

$tabela = "";

for ($i = 0; $i < count($retiraFechamentosLinhas); $i++) {
    $tabela = $tabela . $retiraFechamentosLinhas[$i];
}




$limiteCabecalho = "B2";

switch ($numeroCabecalhos) {
    case 2:
        $limiteCabecalho = "B";
        break;
    case 3:
        $limiteCabecalho = "C";
        break;
    case 4:
        $limiteCabecalho = "D";
        break;
    case 5:
        $limiteCabecalho = "E";
        break;
    case 6:
        $limiteCabecalho = "F";
        break;
    case 7:
        $limiteCabecalho = "G";
        break;
    case 8:
        $limiteCabecalho = "H";
        break;
    case 9:
        $limiteCabecalho = "I";
        break;
    case 10:
        $limiteCabecalho = "J";
        break;
    case 11:
        $limiteCabecalho = "K";
        break;
    case 12:
        $limiteCabecalho = "L";
        break;
    case 13:
        $limiteCabecalho = "M";
        break;
    case 14:
        $limiteCabecalho = "N";
        break;
    case 15:
        $limiteCabecalho = "O";
        break;
    case 16:
        $limiteCabecalho = "P";
        break;
    case 17:
        $limiteCabecalho = "Q";
        break;
}




// Instanciamos a classe
$objPHPExcel = new PHPExcel();

// Podemos definir as propriedades do documento
$objPHPExcel->getProperties()->setCreator("OutBox Sistemas")
        ->setLastModifiedBy("OutBox Sistemas")
        ->setTitle("$nome")
        ->setSubject("$extras")
        ->setDescription("Relatório");

// Adicionamos um estilo de A1 até D1 
$objPHPExcel->getActiveSheet()->getStyle('B2:'.$limiteCabecalho.'2')->applyFromArray(
        array('fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'F6AF3A')
            ),
        )
);

// Definimos o estilo da fonte
$objPHPExcel->getActiveSheet()->getStyle('B2:'.$limiteCabecalho.'2')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A2:C1')->getFont()->setSize(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);


//$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 1, "Conel Construções e Engenharia LTDA");
//$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 2, "CNPJ 07.005.345/0001-87");
//$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 3, "Rua Manoel Batista Neto, 67. Alto de Sumaré, Mossoró-RN");
//$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 4, "Telefones: +55 84 3312.0969 / +55 84 3312.2444");
//$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 5, "Conel Construções e Engenharia LTDA");
//$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 6, "Conel Construções e Engenharia LTDA");
// Criamos as colunas
//$objPHPExcel->setActiveSheetIndex(0)
//        ->setCellValue('A1', 'Listagem de Credenciamento')
//        ->setCellValue('B1', "Nome ")
//       ->setCellValue("C1", "Sobrenome")
//        ->setCellValue("D1", "E-mail");
// Podemos configurar diferentes larguras paras as colunas como padrão
//$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(90);
//$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
//$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
//$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);

$colunasCabecalho = explode("<tr>", $cabecalho);
for ($i = 0; $i < count($colunasCabecalho); $i++) {
    $linhasCabecalho = explode("<th>", $colunasCabecalho[$i]);
    for ($j = 0; $j < count($linhasCabecalho); $j++) {
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($j, ($i + 2), $linhasCabecalho[$j]);
    }
}

$colunas = explode("<tr>", $tabela);
for ($i = 0; $i < count($colunas); $i++) {
    $linhas = explode("<td>", $colunas[$i]);
    for ($j = 0; $j < count($linhas); $j++) {
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($j, ($i + 2), $linhas[$j]);
    }
}

// Também podemos escolher a posição exata aonde o dado será inserido (coluna, linha, dado);
//$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 2, $tabela);
//$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 2, $retiraFechamentosColunas[1]);
//$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, 2, $retiraFechamentosColunas[2]);
// Exemplo inserindo uma segunda linha, note a diferença no segundo parâmetro
//$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 3, "Beltrano");
//$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 3, " da Silva Sauro");
//$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, 3, "beltrando@exemplo.com.br");
// Podemos renomear o nome das planilha atual, lembrando que um único arquivo pode ter várias planilhas
$objPHPExcel->getActiveSheet()->setTitle('Sismico');

// Cabeçalho do arquivo para ele baixar
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$nome.'.xls"');
header('Cache-Control: max-age=0');
// Se for o IE9, isso talvez seja necessário
header('Cache-Control: max-age=1');

// Acessamos o 'Writer' para poder salvar o arquivo
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

// Salva diretamente no output, poderíamos mudar arqui para um nome de arquivo em um diretório ,caso não quisessemos jogar na tela
$objWriter->save('php://output');

exit;
?>