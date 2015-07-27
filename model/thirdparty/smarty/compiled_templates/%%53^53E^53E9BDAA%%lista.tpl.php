<?php /* Smarty version 2.6.18, created on 03-02-2015 02:37:41
         compiled from pages/interno/modulo/empresa/lista.tpl */ ?>
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

    .ui-dialog .ui-state-error {
        padding: .3em;
    }
    .validateTips {
        border: 1px solid transparent;
        padding: 0.3em;
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

</style>

<script>$("#statusInformacao").html("Voce está em: Empresa >> Listar.");</script>

<script>
    $(function() {
        $( "#dialogEmpresa-confirmExclusao" ).dialog({
            autoOpen: false,
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "Cancelar": function() {
                    $( this ).dialog( "close" );
                },
                "Confirmar": function() {
                    $( this ).dialog( "close" );
                    confirmarExclusaoEmpresa();
                }
            }
        });
    });
</script>

<div id="dialogEmpresa-confirmExclusao" title="Confirma a exclusão desta empresa?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Ao realizar a exclusão desta empresa, ela não estará mais disponível. Tem certeza que deseja excluir?</p>
</div>

<input type="text" id="auxDialogs" name="auxDialogs" style="display: none;" />


<div id="resultado-contain">
    <table id="resultado">
        <thead class="ui-widget-header ">
            <tr>
                <th>#</th>
                <th>Nome Fantasia</th>
<!--                <th>Razão Social</th>
                <th>CNPJ</th>
-->                <th>Nome do Contato</th>

                <th>Telefone Principal</th>
<!--                <th>Telefone Auxiliar</th>
-->                <th>Email</th>
                <th>Opções</th>
            </tr>
        </thead>
        <tbody id="conteudoResultado">
            <?php $_from = $this->_tpl_vars['empresas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['empresas']):
?>
            <tr>
                <td><?php echo $this->_tpl_vars['empresas']['idEmpresa']; ?>
</td>
                <td><?php echo $this->_tpl_vars['empresas']['nomeFantasia']; ?>
</td>
<!--                <td><?php echo $this->_tpl_vars['empresas']['razaoSocial']; ?>
</td>
                <td><?php echo $this->_tpl_vars['empresas']['cnpj']; ?>
</td>
-->
                <td><?php echo $this->_tpl_vars['empresas']['contato']; ?>
</td>
                <td><?php echo $this->_tpl_vars['empresas']['telefone1']; ?>
</td>
<!--                <td><?php echo $this->_tpl_vars['empresas']['telefone2']; ?>
</td>
-->
                <td><?php echo $this->_tpl_vars['empresas']['email']; ?>
</td>
                <td>
                    <button id="<?php echo $this->_tpl_vars['empresas']['idEmpresa']; ?>
" onclick="visualizar(this)" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Visualizar"><img src="<?php echo $this->_tpl_vars['IMG']; ?>
../imgs/visualizar.png"></button>
                    <button id="<?php echo $this->_tpl_vars['empresas']['idEmpresa']; ?>
" onclick="atualizar(this)" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Atualizar"><img src="<?php echo $this->_tpl_vars['IMG']; ?>
../imgs/atualizar.png"></button>
                    <button id="<?php echo $this->_tpl_vars['empresas']['idEmpresa']; ?>
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
        "sScrollX": "1300px",
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
    
    function visualizar(botao) {
        variavel = botao.id
        openlink('<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/empresa/visualizar/' + variavel)
    }
    
    idEmpresa="";
    
    function abrirExcluir(botao){
        idEmpresa = botao.id;
        $("#auxDialogs").val(botao.id);
        $("#dialogEmpresa-confirmExclusao").dialog("open");            
    }
    
    function confirmarExclusaoEmpresa() {
        $.ajax({
                url: "<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/empresa/excluir",
                data: {
                    "idEmpresa": idEmpresa
                },
                cache: false,
                success: function(data){
                    respostaDoControlador = eval(data);
                    mensagem = respostaDoControlador.message;
            
                    if(mensagem == "Empresa excluída com sucesso."){
                    
                        $().message(respostaDoControlador.message);
                        openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/empresa/listarEmpresas/");
                    }
                },
                error: function(data){
                    respostaDoControlador = eval(data);
                    $().message(respostaDoControlador.message);
                    openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/empresa/listarEmpresas/");
                },
                dataType: "json"
            });
    }
    
    function atualizar(botao) {
        variavel = botao.id
        openlink('<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/empresa/enviarAtualizar/' + variavel)
    }
</script>