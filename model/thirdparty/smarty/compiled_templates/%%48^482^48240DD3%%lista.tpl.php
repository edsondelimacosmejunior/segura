<?php /* Smarty version 2.6.18, created on 03-02-2015 23:28:01
         compiled from pages/interno/modulo/instrutor/lista.tpl */ ?>
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

<script>$("#statusInformacao").html("Voce está em: Instrutor >> Listar.");</script>

<script>
    $(function() {
        $( "#dialogInstrutor-confirmExclusao" ).dialog({
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
                    confirmarExclusaoInstrutor();
                }
            }
        });
    });
</script>

<div id="dialogInstrutor-confirmExclusao" title="Confirma a exclusão deste instrutor?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Ao realizar a exclusão deste instrutor, ele não estará mais disponível. Tem certeza que deseja excluir?</p>
</div>

<input type="text" id="auxDialogs" name="auxDialogs" style="display: none;" />


<div id="resultado-contain">
    <table id="resultado">
        <thead class="ui-widget-header ">
            <tr>
                <th>#</th>
                <th>Nome</th>
<!--                
		<th>CPF</th>
                <th>Data de Nascimento</th>     
                <th>Email</th>
                <th>Telefone Principal</th>
                <th>Telefone Extra</th>
                <th>Cidade</th>
                <th>Formação</th>
                <th>Status</th>
-->                
		<th>Currículo</th>
		<th>Contrato</th>	
                <th>Opções</th>
            </tr>
        </thead>
        <tbody id="conteudoResultado">
            <?php $_from = $this->_tpl_vars['instrutores']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['instrutores']):
?>
            <tr>
                <td><?php echo $this->_tpl_vars['instrutores']['idInstrutor']; ?>
</td>
                <td><?php echo $this->_tpl_vars['instrutores']['nome']; ?>
</td>
<!--                
		<td><?php echo $this->_tpl_vars['instrutores']['cpf']; ?>
</td>
                <td><?php echo $this->_tpl_vars['instrutores']['dataNascimento']; ?>
</td>
                <td><?php echo $this->_tpl_vars['instrutores']['email']; ?>
</td>
                <td><?php echo $this->_tpl_vars['instrutores']['telefone1']; ?>
</td>
                <td><?php echo $this->_tpl_vars['instrutores']['telefone2']; ?>
</td>
                <td><?php echo $this->_tpl_vars['instrutores']['cidade']; ?>
</td>
                <td><?php echo $this->_tpl_vars['instrutores']['formacao']; ?>
</td>
                <td><?php echo $this->_tpl_vars['instrutores']['status']; ?>
</td>
-->                
		<td>
                    <button id="<?php echo $this->_tpl_vars['instrutores']['patchCurriculum']; ?>
" onclick="javascript:downloadCurriculo(this);" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="float:left; margin-right:10px; cursor:pointer" title="Baixar Currículo"><img src="<?php echo $this->_tpl_vars['IMG']; ?>
../imgs/download.png"></button>
                    <?php echo $this->_tpl_vars['instrutores']['patchCurriculum']; ?>

                </td>
                <td>
                    <button id="<?php echo $this->_tpl_vars['instrutores']['patchContrato']; ?>
" onclick="javascript:downloadContrato(this);" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="float:left; margin-right:10px; cursor:pointer" title="Baixar Contrato"><img src="<?php echo $this->_tpl_vars['IMG']; ?>
../imgs/download2.png"></button>
                    <?php echo $this->_tpl_vars['instrutores']['patchContrato']; ?>

                </td>
                <td>
                    <button id="<?php echo $this->_tpl_vars['instrutores']['idInstrutor']; ?>
" onclick="uploadCurriculo(this)" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Anexar Currículo"><img src="<?php echo $this->_tpl_vars['IMG']; ?>
../imgs/curriculo.png"></button>
                    <button id="<?php echo $this->_tpl_vars['instrutores']['idInstrutor']; ?>
" onclick="uploadContrato(this)" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Anexar Contrato"><img src="<?php echo $this->_tpl_vars['IMG']; ?>
../imgs/contrato.png"></button>
                    <button id="<?php echo $this->_tpl_vars['instrutores']['idInstrutor']; ?>
" onclick="uploadAssinatura(this)" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Anexar Assinatura"><img src="<?php echo $this->_tpl_vars['IMG']; ?>
../imgs/assinatura.png"></button>
                    <button id="<?php echo $this->_tpl_vars['instrutores']['idInstrutor']; ?>
" onclick="visualizar(this)" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Visualizar"><img src="<?php echo $this->_tpl_vars['IMG']; ?>
../imgs/visualizar.png"></button>
                    <button id="<?php echo $this->_tpl_vars['instrutores']['idInstrutor']; ?>
" onclick="atualizar(this)" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Atualizar"><img src="<?php echo $this->_tpl_vars['IMG']; ?>
../imgs/atualizar.png"></button>
                    <button id="<?php echo $this->_tpl_vars['instrutores']['idInstrutor']; ?>
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
interno/modulo/instrutor/visualizar/' + variavel)
    }
    
    idInstrutor="";
    
    function abrirExcluir(botao){
        idInstrutor = botao.id;
        $("#auxDialogs").val(botao.id);
        $("#dialogInstrutor-confirmExclusao").dialog("open");            
    }
    
    function confirmarExclusaoInstrutor() {
        $.ajax({
                url: "<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/instrutor/excluir",
                data: {
                    "idInstrutor": idInstrutor
                },
                cache: false,
                success: function(data){
                    respostaDoControlador = eval(data);
                    mensagem = respostaDoControlador.message;
            
                    if(mensagem == "Instrutor excluído com sucesso."){
                    
                        $().message(respostaDoControlador.message);
                        openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/instrutor/listarInstrutores/");
                    }
                },
                error: function(data){
                    respostaDoControlador = eval(data);
                    $().message(respostaDoControlador.message);
                    openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/instrutor/listarInstrutores/");
                },
                dataType: "json"
            });
    }
    
    function atualizar(botao) {
        variavel = botao.id
        openlink('<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/instrutor/enviarAtualizar/' + variavel)
    }
    
    function uploadCurriculo(botao) {
        variavel = botao.id
        openlink('<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/instrutor/enviarFormularioUploadCurriculo/' + variavel)
    }
    
    function uploadContrato(botao) {
        variavel = botao.id
        openlink('<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/instrutor/enviarFormularioUploadContrato/' + variavel)
    }

    function uploadAssinatura(botao) {
        variavel = botao.id
        openlink('<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/instrutor/enviarFormularioUploadAssinatura/' + variavel)
    }
    
    function downloadCurriculo(patch) {
        window.open("../view/imgs/uploads/" + patch.id + "", "_blank");
    }
    
    function downloadContrato(patch) {
        window.open("../view/imgs/uploads/" + patch.id + "", "_blank");
    }
</script>