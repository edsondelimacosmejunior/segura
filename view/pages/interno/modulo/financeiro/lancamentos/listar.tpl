
<script>
    $(function () {
        $("input:submit, a, button", ".demo").button();
        $("a", ".demo").click(function () {
            return false;
        });
    });

    /*LancamentoFinanceiro Pai de Mascaras*/
    function Mascara(o, f) {
        v_obj = o
        v_fun = f
        setTimeout("execmascara()", 1)
    }

    /*LancamentoFinanceiro que Executa os objetos*/
    function execmascara() {
        v_obj.value = v_fun(v_obj.value)
    }

    /*LancamentoFinanceiro que permite apenas numeros*/
    function Inteiro(v) {
        return v.replace(/\D/g, "")
    }

    function Rg(v) {
        v = v.replace(/\D/g, "")
        v = v.replace(/(\d{3})(\d)/, "$1.$2")
        v = v.replace(/(\d{3})(\d)/, "$1.$2")
        return v;
    }

    function Cpf(v) {
        v = v.replace(/\D/g, "")
        v = v.replace(/(\d{3})(\d)/, "$1.$2")
        v = v.replace(/(\d{3})(\d)/, "$1.$2")
        v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2")
        return v
    }
    /*LancamentoFinanceiro que padroniza telefone (11) 4184-1241*/
    function Telefone(v) {
        v = v.replace(/\D/g, "")
        v = v.replace(/^(\d\d)(\d)/g, "($1) $2")
        v = v.replace(/(\d{4})(\d)/, "$1-$2")
        return v
    }

    /*LancamentoFinanceiro que padroniza CEP*/
    function Cep(v) {
        v = v.replace(/\D/g, "")
        v = v.replace(/^(\d{5})(\d)/, "$1-$2")
        return v
    }

    /*LancamentoFinanceiro que padroniza CNPJ*/
    function Cnpj(v) {
        v = v.replace(/\D/g, "")
        v = v.replace(/^(\d{2})(\d)/, "$1.$2")
        v = v.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3")
        v = v.replace(/\.(\d{3})(\d)/, ".$1/$2")
        v = v.replace(/(\d{4})(\d)/, "$1-$2")
        return v
    }

    function Email(email)
    {
        er = /^[a-zA-Z0-9][a-zA-Z0-9\._-]+@([a-zA-Z0-9\._-]+\.)[a-zA-Z-0-9]{2}/;

        if (er.exec(email))
        {
            return true;
        } else {
            return false;
        }
    }


    /*LancamentoFinanceiro que padroniza DATA*/
    function Data(v) {
        v = v.replace(/\D/g, "")
        v = v.replace(/(\d{2})(\d)/, "$1/$2")
        v = v.replace(/(\d{2})(\d)/, "$1/$2")
        return v
    }

    function Moeda(v) {
        //v = z.value;
        v = v.replace(/\D/g, "")  //permite digitar apenas números
        //v=v.replace(/[0-9]{12}/,"inválido")   //limita pra máximo 999.999.999,99
        //v=v.replace(/(\d{1})(\d{8})$/,"$1.$2")  //coloca ponto antes dos últimos 8 digitos
        //v=v.replace(/(\d{1})(\d{5})$/,"$1.$2")  //coloca ponto antes dos últimos 5 digitos
        v = v.replace(/(\d{1})(\d{1,2})$/, "$1.$2")        //coloca virgula antes dos últimos 2 digitos
        return v
    }

    function VerificaData(digData)
    {
        var bissexto = 0;
        var data = digData;
        var tam = data.length;
        if (tam == 10)
        {
            var dia = data.substr(0, 2)
            var mes = data.substr(3, 2)
            var ano = data.substr(6, 4)
            if ((ano > 1900) || (ano < 2100))
            {
                switch (mes)
                {
                    case '01':
                    case '03':
                    case '05':
                    case '07':
                    case '08':
                    case '10':
                    case '12':
                        if (dia <= 31)
                        {
                            return true;
                        }
                        break

                    case '04':
                    case '06':
                    case '09':
                    case '11':
                        if (dia <= 30)
                        {
                            return true;
                        }
                        break
                    case '02':
                        /* Validando ano Bissexto / fevereiro / dia */
                        if ((ano % 4 == 0) || (ano % 100 == 0) || (ano % 400 == 0))
                        {
                            bissexto = 1;
                        }
                        if ((bissexto == 1) && (dia <= 29))
                        {
                            return true;
                        }
                        if ((bissexto != 1) && (dia <= 28))
                        {
                            return true;
                        }
                        break
                }
            }
        }
        return false;
    }

</script>

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

    #conteudoResultado tr:hover td {
        background:#F7B64B;
    }

    h1 {
        font-size: 1.2em;
        margin: .6em 0;
    }

    div#resultado-contain table td, div#resultado-contain table th { 
        border: 1px solid #eee;
        padding: .6em 10px;
        text-align: left;
    }

    .over {
        background: #03c;	
    }

</style>

<script>

    $(function () {
        $("#dialogLancamentoFinanceiro-confirmExclusao").dialog({
            autoOpen: false,
            resizable: false,
            height: 140,
            modal: true,
            buttons: {
                "Cancelar": function () {
                    $(this).dialog("close");
                },
                "Confirmar": function () {
                    $(this).dialog("close");
                    confirmarExclusaoLancamentoFinanceiro();
                }                
            }
        });
    });

    $(function () {
        $("#dialogLancamentoFinanceiro-confirmExtorno").dialog({
            autoOpen: false,
            resizable: false,
            height: 140,
            modal: true,
            buttons: {
                "Cancelar": function () {
                    $(this).dialog("close");
                },
                "Confirmar": function () {
                    $(this).dialog("close");
                    confirmarExtornoLancamentoFinanceiro();
                }                
            }
        });
    });
</script>

<div id="dialogLancamentoFinanceiro-confirmExclusao" title="Confirma a exclusão deste item?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Ao realizar a exclusão deste item ele não será mais acessível. Tem certeza que deseja excluir?</p>
</div>

<div id="dialogLancamentoFinanceiro-confirmExtorno" title="Confirma o estorno?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Ao realizar o estorno dos valores baixados deste lançamentos as informações de baixa serão perdidas. Tem certeza?</p>
</div>

<input type="text" id="auxDialogsLancamentoFinanceiro" name="auxDialogsLancamentoFinanceiro" style="display: none;" />

<div id="formulario" style="display: none">
    <form action="../extensions/dompdf/tipolancamento.php" method="post" id="pdf">

    </form>
</div>


<script>$("#statusInformacao").html("Você está em: Financeiro >> Lançamento Financeiro >> Listar..");</script>

<div id="resultado-contain">
    <table id="resultado">
        <thead class="ui-widget-header ">
            <tr>
                <th>#</th>
                <th>Centro de Custo</th>
                <th>Fornecedor</th>
                <th>Lançamento Financeiro</th>
                <th>Data de Vencimento</th>
                <th>Valor Original</th>
                <th>Valor Baixado</th>
                <th>Tipo</th>
                <th>Forma de Pagamento</th>
                <th>Status</th>
                <th>Opções</th>
            </tr>
        </thead>
        <tbody id="conteudoResultado">
            {{foreach from=$lancamentosFinanceiros item=lancamentosFinanceiros}}
            <tr>
                <td>{{$lancamentosFinanceiros.idLancamentoFinanceiro}}</td>
                <td>{{$lancamentosFinanceiros.centroCusto}}</td>
                <td>{{$lancamentosFinanceiros.nomeFantasia}}</td>
                <td>{{$lancamentosFinanceiros.nome}}</td>
                <td>{{$lancamentosFinanceiros.dataVencimento}}</td>
                <td>{{$lancamentosFinanceiros.valorOriginal}}</td>
                <td>{{$lancamentosFinanceiros.valorBaixado}}</td>
                <td>{{$lancamentosFinanceiros.tipoLancamento}}</td>
                <td>{{$lancamentosFinanceiros.formaPagamento}}</td>
                <td>{{$lancamentosFinanceiros.status}}</td>
                <td>
                    <button id="{{$lancamentosFinanceiros.idLancamentoFinanceiro}}" onclick="visualizar(this)" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Visualizar"><img src="{{$IMG}}../imgs/visualizar.png"></button>
                    <button id="{{$lancamentosFinanceiros.idLancamentoFinanceiro}}" onclick="editar(this);" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Atualizar"><img src="{{$IMG}}../imgs/atualizar.png"></button>
                    <button id="{{$lancamentosFinanceiros.idLancamentoFinanceiro}}" onclick="abrirBaixa(this);" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Baixar"><img src="{{$IMG}}../imgs/pagamento.png"></button>
                    <button id="{{$lancamentosFinanceiros.idLancamentoFinanceiro}}" onclick="abrirExtornar(this)" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Estornar"><img src="{{$IMG}}../imgs/estornar.png"></button>
                    <button id="{{$lancamentosFinanceiros.idLancamentoFinanceiro}}" onclick="abrirExcluir(this)" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Excluir"><img src="{{$IMG}}../imgs/excluir.png"></button>
                </td>
            </tr>
            {{/foreach}}
        </tbody>
    </table>
</div>


<script>
    var oTable = $('#resultado').dataTable({
        "sScrollY": "600px",
        "sScrollX": "1200px",
        "bPaginate": true,
        "sPaginationType": "full_numbers",
        "bScrollCollapse": true,
        "aaSorting": [[0, "desc"]],
        //"bRetrieve":true,
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

    new FixedHeader(oTable);
</script>      


<script type="text/javascript" charset="utf-8">

    function editar(botao) {
        variavel = botao.id
        //openlink('{{$BASE_PATH}}interno/modulo/corporativo/empresa/visualizar/' + variavel)

        $.ajax({
            url: "{{$BASE_PATH}}interno/modulo/financeiro/lancamentofinanceiro/enviarAtualizar/",
            data: {
                "idLancamentoFinanceiro": variavel
            },
            cache: false,
            success: function (data) {

                $("#tab0").html(data);
                $("#status span").html("");
                reset_buttons();

                //$("#dialog-exibeRequisicao").html(data);
                //$("#dialog-exibeRequisicao").dialog("open");
            },
            error: function (data) {
                $().message("Problemas ao acessar o servidor");
            }

        });

    }

    function abrirExcluir(botao) {
        $("#auxDialogsLancamentoFinanceiro").val(botao.id);
        $("#dialogLancamentoFinanceiro-confirmExclusao").dialog("open");
    }

    function abrirExtornar(botao) {
        $("#auxDialogsLancamentoFinanceiro").val(botao.id);
        $("#dialogLancamentoFinanceiro-confirmExtorno").dialog("open");
    }

    function abrirBaixa(variavel) {
        $("#dialog-formularioBaixaLancamento_id").val("");
        $("#dialog-formularioBaixaLancamento_valorOriginal").val("");
        $("#dialog-formularioBaixaLancamento_desconto").val("");
        $("#dialog-formularioBaixaLancamento_juros").val("");
        $("#dialog-formularioBaixaLancamento_cartorio").val("");
        $("#dialog-formularioBaixaLancamento_valorLiquido").val("");
        $("#dialog-formularioBaixaLancamento_valorBaixado").val("");
        $("#dialog-formularioBaixaLancamento_dataBaixa").val("");


        $.ajax({
            url: "{{$BASE_PATH}}interno/modulo/financeiro/lancamentofinanceiro/buscar",
            data: {
                "idLancamentoFinanceiro": variavel.id
            },
            cache: false,
            success: function (data) {
                $("#dialog-formularioBaixaLancamento_id").val(data[0].idLancamentoFinanceiro);
                $("#dialog-formularioBaixaLancamento_valorOriginal").val(data[0].valorOriginal);
                $("#dialog-formularioBaixaLancamento_desconto").val(data[0].desconto);
                $("#dialog-formularioBaixaLancamento_juros").val(data[0].juros);
                $("#dialog-formularioBaixaLancamento_cartorio").val(data[0].cartorio);
                $("#dialog-formularioBaixaLancamento_valorLiquido").val(data[0].valorLiquido);
                $("#dialog-formularioBaixaLancamento_valorBaixado").val(data[0].valorBaixado);
                $("#dialog-formularioBaixaLancamento_dataBaixa").val(data[0].dataBaixa);

                $("#dialog-formularioBaixaLancamento").dialog("open");
            },
            error: function (data) {
                respostaDoControlador = eval(data);
                $().message(respostaDoControlador.message);
            },
            dataType: "json"

        });
    }


    function efetuarBaixa() {
        $.ajax({
            url: "{{$BASE_PATH}}interno/modulo/financeiro/lancamentofinanceiro/baixar",
            data: {
                "idLancamentoFinanceiro": $("#dialog-formularioBaixaLancamento_id").val(),
                "valorBaixado": $("#dialog-formularioBaixaLancamento_valorBaixado").val(),
                "dataBaixa": $("#dialog-formularioBaixaLancamento_dataBaixa").val()
            },
            cache: false,
            success: function (data) {
                $().message(data.message);
                $("#dialog-formularioBaixaLancamento").dialog("close");
                openlink("{{$BASE_PATH}}interno/modulo/financeiro/lancamentofinanceiro/listar/");
            },
            error: function (data) {
                respostaDoControlador = eval(data);
                $().message(respostaDoControlador.message);
            },
            dataType: "json"

        });
    }

    function visualizar(botao) {
        variavel = botao.id
        //openlink('{{$BASE_PATH}}interno/modulo/corporativo/empresa/visualizar/' + variavel)

        $.ajax({
            url: "{{$BASE_PATH}}interno/modulo/financeiro/lancamentofinanceiro/visualizar/",
            data: {
                "idLancamentoFinanceiro": variavel
            },
            cache: false,
            success: function (data) {

                $("#tab0").html(data);
                $("#status span").html("");
                reset_buttons();

                //$("#dialog-exibeRequisicao").html(data);
                //$("#dialog-exibeRequisicao").dialog("open");
            },
            error: function (data) {
                $().message("Problemas ao acessar o servidor");
            }

        });

    }

    function confirmarExclusaoLancamentoFinanceiro() {
        openlink('{{$BASE_PATH}}interno/modulo/financeiro/lancamentofinanceiro/excluir/' + $("#auxDialogsLancamentoFinanceiro").val())
        openlink("{{$BASE_PATH}}interno/modulo/financeiro/lancamentofinanceiro/listar/");
    }

    function confirmarExtornoLancamentoFinanceiro() {
        openlink('{{$BASE_PATH}}interno/modulo/financeiro/lancamentofinanceiro/extornar/' + $("#auxDialogsLancamentoFinanceiro").val())
        openlink("{{$BASE_PATH}}interno/modulo/financeiro/lancamentofinanceiro/listar/");
    }


    function refazerRelatorio() {
        openlink("{{$BASE_PATH}}interno/modulo/financeiro/lancamentofinanceiro/listar/");
    }

    function gerarPDF() {
        document.getElementById("pdf").submit();
    }
</script>