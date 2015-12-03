<?php /* Smarty version 2.6.18, created on 14-10-2015 17:57:28
         compiled from pages/interno/modulo/financeiro/relatorios/contasRecebidas.tpl */ ?>
<style>
    body { 
        font-size: 62.5%;
    }
    label, input { 
        display:block;
    }
    input.text { 
        margin-bottom:12px;
        width:95%;
        padding: .4em;
    }
    fieldset { 
        padding:0;
        border:0;
        margin-top:25px;
    }
    h1 {
        font-size: 1.2em;
        margin: .6em 0;
    }
    div#relatorio-contain {
        width: 500px;
        margin: 20px 0;
    }
    div#relatorio-contain table { 
        margin: 1em 0;
        border-collapse: collapse;
        width: 100%;
    }
    div#relatorio-contain table td, div#relatorio-contain table th { 
        border: 1px solid #eee;
        padding: .6em 10px;
        text-align: left;
    }
    div#resultado-contain table td, div#resultado-contain table th { 
        border: 1px solid #eee;
        padding: .6em 10px;
        text-align: left;
    }

    .over {
        background: #03c;	
    }

    #borda-tipoLancamentos{
        margin-top:5px;
        width: 480px;
        height: 25px;
        display:inline-block;
        border-left:10px;
        background-image: url("<?php echo $this->_tpl_vars['IMG']; ?>
tab2.jpg");
        border: 1px;
        border-color: #AAAAAA;
        border-style: solid;
    }
    #borda-tipoLancamentos a{
        vertical-align: middle;
        margin-left: 10px;
        color: black;
        font-size: 0.9em;
        font-weight: bolder;
        font-style: italic;

    }
    #tipoLancamentos{
        width: 480px;
        border-left:10px;
        display: block;
        height: 180px;
        overflow: scroll;
        text-align: center;
    }
    
    
    #borda-centroCustos{
        margin-top:5px;
        width: 480px;
        height: 25px;
        display:inline-block;
        border-left:10px;
        background-image: url("<?php echo $this->_tpl_vars['IMG']; ?>
tab2.jpg");
        border: 1px;
        border-color: #AAAAAA;
        border-style: solid;
    }
    #borda-centroCustos a{
        vertical-align: middle;
        margin-left: 10px;
        color: black;
        font-size: 0.9em;
        font-weight: bolder;
        font-style: italic;

    }
    #centroCustos{
        width: 480px;
        border-left:10px;
        display: block;
        height: 180px;
        overflow: scroll;
        text-align: center;
    }
    
    

    #selectable .ui-selecting { background: #FECA40; }
    #selectable:hover{
        cursor: pointer;
    }
    #selectable .ui-selected { background: #F39814; color: white; }
    #selectable { list-style-type: none; margin: 0; padding: 0; width: 100%; text-align: left; }
    #selectable li { margin: 3px; padding: 0.4em; font-size: 0.9em; height: 15px; }


    #feedback2 { font-size: 0.9em; }
    #selectable2 .ui-selecting { background: #FECA40; }
    #selectable2:hover{
        cursor: pointer;
    }
    #selectable2 .ui-selected { background: #F39814; color: white; }
    #selectable2 { list-style-type: none; margin: 0; padding: 0; width: 100%; text-align: left; }
    #selectable2 li { margin: 3px; padding: 0.4em; font-size: 0.9em; height: 15px; }
</style>

<script>
    $(function() {
        $("#selectable").selectable({
            stop: function() {
                //var result = $( "#select-result" ).empty();
                $("#tipoLancamento").val("");
                $(".ui-selected", this).each(function() {
                    var index = $(this).attr("foo");
                    //result.append((index));
                    if (index != "") {
                        $("#tipoLancamento").val($("#tipoLancamento").val() + "-" + index);
                    }
                });
            }
        });
    });
    
    
    $(function() {
        $("#selectable2").selectable({
            stop: function() {
                //var result = $( "#select-result" ).empty();
                $("#centroCusto").val("");
                $(".ui-selected", this).each(function() {
                    var index = $(this).attr("foo");
                    //result.append((index));
                    if (index != "") {
                        $("#centroCusto").val($("#centroCusto").val() + "-" + index);
                    }
                });
            }
        });
    });


    /*
     * I don't actually use this here, but it is provided as it might be useful and demonstrates
     * getting the TR nodes from DataTables
     */
    function fnGetSelected(oTableLocal)
    {
        var aReturn = new Array();
        var aTrs = oTableLocal.fnGetNodes();

        for (var i = 0; i < aTrs.length; i++)
        {
            if ($(aTrs[i]).hasClass('row_selected'))
            {
                aReturn.push(aTrs[i]);
            }
        }
        return aReturn;
    }
</script>

<script>
    $("#dataInicial").datepicker({
        changeMonth: true,
        numberOfMonths: 1,
        dateFormat: 'dd/mm/yy',
        monthNames: ['Janeiro', 'Fevereiro', 'Mar&ccedil;o', 'Abril', 'Maio', 'Junho',
            'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        dayNamesMin: ['Do', 'Se', 'Te', 'Qa', 'Qi', 'Se', 'Sa'],
        prevText: 'Anterior',
        nextText: 'Pr&oacute;ximo',
        monthNamesShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"]
    });
    $("#dataFinal").datepicker({
        changeMonth: true,
        numberOfMonths: 1,
        dateFormat: 'dd/mm/yy',
        monthNames: ['Janeiro', 'Fevereiro', 'Mar&ccedil;o', 'Abril', 'Maio', 'Junho',
            'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        dayNamesMin: ['Do', 'Se', 'Te', 'Qa', 'Qi', 'Se', 'Sa'],
        prevText: 'Anterior',
        nextText: 'Pr&oacute;ximo',
        monthNamesShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"]
    });
</script>

<script>$("#statusInformacao").html("Você está em: Financeiro >> Relatórios >> Contas Recebidas.");</script>

<input type="text" id="tipoLancamento" style="display: none;" value="x" />
<input type="text" id="centroCusto" style="display: none;" value="x" />

<div id="relatorio-contain" class="ui-widget" style="margin:20px auto;">
    <table id="relatorio" class="ui-widget ui-widget-content">
        <thead>
            <tr class="ui-widget-header ">
                <th>Relatório de Contas Recebidas</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>

                    <fieldset>
                        <div id="borda-tipoLancamentos" class="ui-corner-top"><a>Selecione o(s) Tipo(s) de Lançamento(s).</a></div>
                        <div id="tipoLancamentos" class="ui-layout-content" name="c2" id="c2">
                            <ol id="selectable">
                                <li rel="" foo="" class="ui-widget-content">Todos</li> 
                                <?php $_from = $this->_tpl_vars['tipoLancamentos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tipoLancamentos']):
?>
                                <li rel="<?php echo $this->_tpl_vars['tipoLancamentos']['idTipoLancamento']; ?>
" foo="<?php echo $this->_tpl_vars['tipoLancamentos']['idTipoLancamento']; ?>
" class="ui-widget-content"><?php echo $this->_tpl_vars['tipoLancamentos']['nome']; ?>
</li>
                                    <?php endforeach; endif; unset($_from); ?>
                            </ol>
                        </div>
                        <div id="borda-centroCustos" class="ui-corner-top"><a>Selecione o(s) Centro(s) de Custo(s).</a></div>
                        <div id="centroCustos" class="ui-layout-content" name="c2" id="c2">
                            <ol id="selectable2">
                                <li rel="" foo="" class="ui-widget-content">Todos</li> 
                                <?php $_from = $this->_tpl_vars['centroCustos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['centroCustos']):
?>
                                <li rel="<?php echo $this->_tpl_vars['centroCustos']['idCentroCusto']; ?>
" foo="<?php echo $this->_tpl_vars['centroCustos']['idCentroCusto']; ?>
" class="ui-widget-content"><?php echo $this->_tpl_vars['centroCustos']['nome']; ?>
</li>
                                    <?php endforeach; endif; unset($_from); ?>
                            </ol>
                        </div>
                        <table style="width: 100px;"> 
                            <tr>
                                <td><label for="dataInicial">De:</label></td>
                                <td><input type="text" id="dataInicial" size="10" maxlength="10" onKeyDown="Mascara(this, Data);"/></td>
                            </tr>
                            <tr>
                                <td><label for="dataFinal">Até:</label></td>
                                <td><input type="text" id="dataFinal" size="10" maxlength="10" onKeyDown="Mascara(this, Data);"/></td>
                            </tr>
                        </table>
                    </fieldset>

                    <button id="consultar" onclick="gerarRelatorio()" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="float:right; margin-right:10px;">
                        <span class="ui-button-text">Consultar</span>
                    </button>

                </td>
            </tr>
        </tbody>
    </table>
</div>

<div id="resultado-contain" style="display: none">
    <h1>Resultado da Consulta</h1>
    <label for="valorTotal" id="valorTotal" style="margin: 10px;"></label>

    <button id="refazerRelatorio" onclick="refazerRelatorio()" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="float:left; margin:10px;">
        <span class="ui-button-text">Refazer Relatório</span>
    </button>

    <button id="gerarEXCEL" onclick="exportarExcel()" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="float:left; margin:10px;">
        <span class="ui-button-text">Exportar para Excel</span>
    </button>
    <br />

    <div id="formulario">
        <form action="../extensions/excel/modeloGCPHPEXCEL.php" method="post" id="excel" style="display: none;">
            <input type="text" id="nomeEXCEL" name="nomeEXCEL" />
            <input type="text" id="cabecalhoEXCEL" name="cabecalhoEXCEL" value="<th>#</th><th>Centro de Custo</th><th>Fornecedor</th><th>Despesa</th><th>Data de Emissão</th><th>Data de Vencimento</th><th>Valor Original</th><th>Valor Baixado</th><th>Data de Baixa</th><th>Tipo de Lançamento</th><th>Status</th>" />
            <input type="text" id="extrasEXCEL" name="extrasEXCEL" />
            <input type="text" id="tabelaEXCEL" name="tabelaEXCEL" />
        </form>
    </div>

    <table id="resultado">
        <thead class="ui-widget-header ">
            <tr id="cabecalho">
                <th>#</th>
                <th>Centro de Custo</th>
                <th>Fornecedor</th>
                <th>Despesa</th>
                <th>Data de Emissão</th>
                <th>Data de Vencimento</th>
                <th>Valor Original</th>
                <th>Valor Baixado</th>
                <th>Data de Baixa</th>
                <th>Tipo de Lançamento</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody id="conteudoResultado">

        </tbody>
    </table>   
</div>




<script type="text/javascript" charset="utf-8">

    function alertaVazio(campos, contador) {
        document.getElementById("dataInicial").style.borderColor = '#F8F8F8';
        document.getElementById("dataFinal").style.borderColor = '#F8F8F8';

        for (i = 0; i < contador; i = i + 1) {
            document.getElementById(campos[i]).style.borderColor = '#FF3300';
            document.getElementById(campos[i]).style.backgroundColor = '#FFEDBF';
        }

    }

    function gerarRelatorio() {
        campos = new Array(5);
        contador = 0;

        if ($("#tipoLancamento").val() == "x") {
            campos[contador] = "tipoLancamentos";
            contador = contador + 1;
        }

        if (contador == 0) {
            var newRowContent = "<tr><td colspan=\"10\">Buscando dados no servidor. Por favor aguarde!</td></tr>";
            $("#resultado tbody").append(newRowContent);

            document.getElementById("resultado-contain").style.display = "inline-block";
            document.getElementById("relatorio-contain").style.display = "none";

            $.ajax({
                url: "<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/financeiro/relatorios/contasrecebidas/gerar",
                data: {
                    "tipoLancamento": $("#tipoLancamento").val(),
                    "centroCusto": $("#centroCusto").val(),
                    "dataInicial": $("#dataInicial").val(),
                    "dataFinal": $("#dataFinal").val()
                },
                cache: false,
                success: function(data) {

                    $("#resultado tbody").html("");
                    if (data.length > 0) {
                        for (var i = 0; i < data.length; i++) {
                            var newRowContent = "<tr><td>" + data[i].idLancamentoFinanceiro + "</td><td>" + data[i].centroCusto + "</td><td>" + data[i].nomeFantasia + "</td><td>" + data[i].nome + "</td><td> " + data[i].dataEmissao + "</td><td> " + data[i].dataVencimento + "</td><td>" + data[i].valorOriginal + "</td><td>" + data[i].valorBaixado + "</td><td>" + data[i].dataBaixa + "</td><td>" + data[i].tipoLancamento + "</td><td>" + data[i].status + "</td></tr>";
                            $("#resultado tbody").append(newRowContent);
                        }
                        $("#valorTotal").append("Valor total da sua pesquisa: " + data[data.length - 1].valorTotal);
                    } else {
                        var newVazio = "<tr><td>Nenhum dado encontrado!</td></tr>";
                        $("#resultado tbody").append(newVazio);
                    }

                    var pegaCodigoTabela = document.getElementById('conteudoResultado').innerHTML;
                    $("#tabelaEXCEL").val(pegaCodigoTabela);



                    $('#resultado tr').click(function() {
                        if ($(this).hasClass('row_selected'))
                            $(this).removeClass('row_selected');
                        else
                            $(this).addClass('row_selected');
                    });

                    var oTable = $('#resultado').dataTable({
                        "sScrollY": "400px",
                        "sScrollX": "1100px",
                        "bPaginate": true,
                        "sPaginationType": "full_numbers",
                        "bScrollCollapse": true,
                        "oLanguage": {
                            "sProcessing": "Processando...",
                            "sLengthMenu": "Mostrar _MENU_ registros",
                            "sZeroRecords": "N&atilde;o foram encontrados resultados",
                            "sInfo": "Mostrando de _START_ at&eacute; _END_ de _TOTAL_ registros",
                            "sInfoEmpty": "Mostrando de 0 at&eacute; 0 de 0 registros",
                            "sInfoFiltered": "(filtrado de _MAX_ registros no total)",
                            "sInfoPostFix": "",
                            "sSearch": "Buscar:",
                            "sUrl": "",
                            "oPaginate": {
                                "sFirst": "Primeiro",
                                "sPrevious": "Anterior",
                                "sNext": "Seguinte",
                                "sLast": "&Uacute;ltimo"
                            }
                        }
                    });

                },
                error: function(data) {
                    $().message("Problemas ao acessar o servidor");

                },
                dataType: "json"

            });
        } else {
            $().message("Informe os filtros da pesquisa!");
            alertaVazio(campos, contador);
        }
    }


    function exportarExcel() {
        //var pegaCodigoCabecalho = document.getElementById('cabecalho').innerHTML;

        //alert(pegaCodigo);
        $("#nomeEXCEL").val("Relatorio_Contas_Recebidas");
        //$("#cabecalhoEXCEL").val(pegaCodigoCabecalho);
        $("#extrasEXCEL").val($("#tipoLancamentoFiltro").val() + "");

        document.getElementById("excel").submit();
    }

    function refazerRelatorio() {
        openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/financeiro/relatorios/contasrecebidas/mostrar/");
    }

</script>