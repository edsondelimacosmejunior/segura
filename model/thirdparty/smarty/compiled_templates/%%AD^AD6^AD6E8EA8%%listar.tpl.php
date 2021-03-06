<?php /* Smarty version 2.6.18, created on 29-09-2015 14:22:06
         compiled from pages/interno/modulo/financeiro/centroCusto/listar.tpl */ ?>

<script>
    $(function() {
        $("input:submit, a, button", ".demo").button();
        $("a", ".demo").click(function() {
            return false;
        });
    });

    /*CentroCusto Pai de Mascaras*/
    function Mascara(o, f) {
        v_obj = o
        v_fun = f
        setTimeout("execmascara()", 1)
    }

    /*CentroCusto que Executa os objetos*/
    function execmascara() {
        v_obj.value = v_fun(v_obj.value)
    }

    /*CentroCusto que permite apenas numeros*/
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
    /*CentroCusto que padroniza telefone (11) 4184-1241*/
    function Telefone(v) {
        v = v.replace(/\D/g, "")
        v = v.replace(/^(\d\d)(\d)/g, "($1) $2")
        v = v.replace(/(\d{4})(\d)/, "$1-$2")
        return v
    }

    /*CentroCusto que padroniza CEP*/
    function Cep(v) {
        v = v.replace(/\D/g, "")
        v = v.replace(/^(\d{5})(\d)/, "$1-$2")
        return v
    }

    /*CentroCusto que padroniza CNPJ*/
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


    /*CentroCusto que padroniza DATA*/
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

</style>

<script>
    
    $(function() {
        $( "#dialogCentroCusto-confirmExclusao" ).dialog({
            autoOpen: false,
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "Confirmar": function() {
                    $( this ).dialog( "close" );
                    confirmarExclusaoCentroCusto();
                },
                "Cancelar": function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    });
</script>

<div id="dialogCentroCusto-confirmExclusao" title="Confirma a exclusão deste item?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Ao realizar a exclusão deste item ele não será mais acessível. Tem certeza que deseja excluir?</p>
</div>

<input type="text" id="auxDialogsCentroCusto" name="auxDialogsCentroCusto" style="display: none;" />

<div id="formulario" style="display: none">
    <form action="../extensions/dompdf/centrocusto.php" method="post" id="pdf">

    </form>
</div>


<script>$("#statusInformacao").html("Você está em: Financeiro >> Centro de Custo >> Listar..");</script>

<div id="resultado-contain">
    
    <button id="novaCentroCusto" onclick="abrirDialogNovoCentroCusto()" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="float:left; margin:10px;">
        <span class="ui-button-text">Novo Centro de Custo</span>
    </button>
    
     <br />

    <table id="resultado">
        <thead class="ui-widget-header ">
            <tr>
                <th>#</th>
                <th>Centro de Custo</th>
                <th>Descrição</th>
                <th>Usuário de Criação</th>
                <th>Data de Criação</th>
                <th>Opção</th>
            </tr>
        </thead>
        <tbody id="conteudoResultado">
            <?php $_from = $this->_tpl_vars['centroCustos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['centroCustos']):
?>
            <tr>
                <td><?php echo $this->_tpl_vars['centroCustos']['idCentroCusto']; ?>
</td>
                <td><?php echo $this->_tpl_vars['centroCustos']['nome']; ?>
</td>
                <td><?php echo $this->_tpl_vars['centroCustos']['descricao']; ?>
</td>
                <td><?php echo $this->_tpl_vars['centroCustos']['usuarioCriacao']; ?>
</td>
                <td><?php echo $this->_tpl_vars['centroCustos']['dataCriacao']; ?>
</td>
                <td>
                    <button id="<?php echo $this->_tpl_vars['centroCustos']['idCentroCusto']; ?>
" onclick="javascript:abreEditarCentroCusto(this);" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Atualizar"><img src="<?php echo $this->_tpl_vars['IMG']; ?>
../imgs/atualizar.png"></button>
                    <button id="<?php echo $this->_tpl_vars['centroCustos']['idCentroCusto']; ?>
" onclick="abrirExcluir(this)" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Excluir"><img src="<?php echo $this->_tpl_vars['IMG']; ?>
../imgs/excluir.png"></button>
                </td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
        </tbody>
    </table>
</div>


<script>
    var oTable = $('#resultado').dataTable({
        "sScrollY": "600px",
        "sScrollX": "800px",
        "bPaginate": true,
        "sPaginationType": "full_numbers",
        "bScrollCollapse": true,
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

    function abrirDialogNovoCentroCusto() {
        $("#dialog-formularioCentroCusto_nome").val("");
        $("#dialog-formularioCentroCusto_descricao").val("");

        $("#dialog-formularioCentroCusto").dialog("open");
    }

    function abreEditarCentroCusto(variavel) {
        $.ajax({
            url: "<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/financeiro/centrocusto/buscar",
            data: {
                "idCentroCusto": variavel.id
            },
            cache: false,
            success: function(data) {
                $("#dialog-formularioEditaCentroCusto_id").val(data[0].idCentroCusto);
                $("#dialog-formularioEditaCentroCusto_nome").val(data[0].nome);
                $("#dialog-formularioEditaCentroCusto_descricao").val(data[0].descricao);

                $("#dialog-formularioEditaCentroCusto").dialog("open");
            },
            error: function(data) {
                respostaDoControlador = eval(data);
                $().message(respostaDoControlador.message);
            },
            dataType: "json"

        });
    }

    function gravarCentroCusto() {
        campos = new Array(7);
        contador = 0;


        if ($("#dialog-formularioCentroCusto_nome").val() == "") {
            campos[contador] = "dialog-formularioCentroCusto_nome";
            contador = contador + 1;
        }
        if ($("#dialog-formularioCentroCusto_descricao").val() == "") {
            campos[contador] = "dialog-formularioCentroCusto_descricao";
            contador = contador + 1;
        }

        if (contador == 0) {

            $.ajax({
                url: "<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/financeiro/centrocusto/cadastrar",
                data: {
                    "nome": $("#dialog-formularioCentroCusto_nome").val(),
                    "descricao": $("#dialog-formularioCentroCusto_descricao").val()
                },
                cache: false,
                success: function(data) {
                    respostaDoControlador = eval(data);
                    $().message("Centro de Custo cadastrado com sucesso!");
                    $("#dialog-formularioCentroCusto").dialog("close");
                    openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/financeiro/centrocusto/listar/");
                },
                error: function(data) {
                    respostaDoControlador = eval(data);
                    $().message(respostaDoControlador.message);
                },
                dataType: "json"

            });


        } else {
            $().message("Campos obrigatórios não foram preenchidos!");
            alertaVazio(campos, contador);
        }
    }

    function editarCentroCusto() {
        campos = new Array(7);
        contador = 0;


        if ($("#dialog-formularioEditaCentroCusto_nome").val() == "") {
            campos[contador] = "dialog-formularioEditaCentroCusto_nome";
            contador = contador + 1;
        }
        if ($("#dialog-formularioEditaCentroCusto_descricao").val() == "") {
            campos[contador] = "dialog-formularioEditaCentroCusto_descricao";
            contador = contador + 1;
        }

        if (contador == 0) {

            $.ajax({
                url: "<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/financeiro/centrocusto/editar",
                data: {
                    "idCentroCusto": $("#dialog-formularioEditaCentroCusto_id").val(),
                    "nome": $("#dialog-formularioEditaCentroCusto_nome").val(),
                    "descricao": $("#dialog-formularioEditaCentroCusto_descricao").val()
                },
                cache: false,
                success: function(data) {
                    respostaDoControlador = eval(data);
                    $().message("Centro de Custo editado com sucesso!");
                    $("#dialog-formularioEditaCentroCusto").dialog("close");
                    openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/financeiro/centrocusto/listar/");
                },
                error: function(data) {
                    respostaDoControlador = eval(data);
                    $().message(respostaDoControlador.message);
                },
                dataType: "json"

            });


        } else {
            $().message("Campos obrigatórios não foram preenchidos!");
            alertaVazio(campos, contador);
        }
    }
    
    function abrirExcluir(botao){
        $("#auxDialogsCentroCusto").val(botao.id);
        $("#dialogCentroCusto-confirmExclusao").dialog("open");
    }
    
    function confirmarExclusaoCentroCusto() {
        openlink('<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/financeiro/centrocusto/excluir/' + $("#auxDialogsCentroCusto").val())
        openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/financeiro/centrocusto/listar/");
    }


    function refazerRelatorio() {
        openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/financeiro/centrocusto/listar/");
    }
    
    function gerarPDF() {
        document.getElementById("pdf").submit();
    }
</script>