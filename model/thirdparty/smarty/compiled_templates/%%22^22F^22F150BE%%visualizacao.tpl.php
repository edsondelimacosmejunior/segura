<?php /* Smarty version 2.6.18, created on 16-10-2015 20:31:42
         compiled from pages/interno/modulo/turma/visualizacao.tpl */ ?>
<script type="text/javascript">
    $(function () {
        $("#tabs_visualizaTurma").tabs();
    });

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
    h1 {
        font-size: 1.2em;
        margin: .6em 0;
    }
    div#tabs_cadastroTurma-contain {
        width: 350px;
        margin: 20px 0;
        font-size: 90.5%;
    }
    div#tabs_cadastroTurma-contain table {
        margin: 1em 0;
        border-collapse: collapse;
        width: 100%;
    }
    div#tabs_cadastroTurma-contain table td, div#romaneio-contain table th {
        border: 1px solid #eee;
        padding: .6em 10px;
        text-align: left;
    }
    .ui-dialog .ui-state-error {
        padding: .3em;
    }
    .validateTips {
        border: 1px solid transparent;
        padding: 0.3em;
    }



</style>

<script>
    $(function () {
        $("#dialog-confirmMatricula").dialog({
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
                    confirmarMatricula();
                }
            }
        });
    });

    $(function () {
        $("#dialog-addObservacao").dialog({
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
                    confirmarObservacao();
                }
            }
        });
    });

    $(function () {
       $("#dialog-addFormaPagamento").dialog({
            autoOpen: false,
            resizable: false,
            height: 200,
            width: 450,
            modal: true,
            buttons: {
                "Cancelar": function () {
                    $(this).dialog("close");
                },
                "Confirmar": function () {
                    $(this).dialog("close");
                    pagamento();
                }
            }
        });
    });

</script>

<div id="dialog-confirmMatricula" title="Confirma o pagamento?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>É necessário efetuar o pagamento para confirmar a matrícula. Confirma que o pagamento foi recebido?</p>
</div>

<input type="text" id="auxDialogs" name="auxDialogs" style="display: none;" />
<input type="text" id="idTurma" name="idTurma" style="display: none;" value="<?php echo $this->_tpl_vars['turma']['idTurma']; ?>
" />



<script>$("#statusInformacao").html("Vocé está em: Turma >> Listar Turmas >> Visualizar Cadastro da Turma.");</script>

<div id="formulario" style="display: none">
    <form action="../extensions/dompdf/listaFrequencia.php" method="post" id="listaFrequencia">
        <input type="text" id="listaFrequencia_idTurma_PDF" name="listaFrequencia_idTurma_PDF" />
    </form>

    <form action="../extensions/dompdf/protocolo.php" method="post" id="protocolo">
        <input type="text" id="protocolo_idTurma_PDF" name="protocolo_idTurma_PDF" />
    </form>

    <form action="../extensions/dompdf/reciboTxt.php" method="post" id="recibo">
        <input type="text" id="idMatriculaPDF" name="idMatriculaPDF" />
    </form>

    <form action="../extensions/dompdf/testeCertificado.php" method="post" id="certificado" target="_blank">
        <input type="text" id="idMatriculaCertificadoPDF" name="idMatriculaCertificadoPDF"/>
    </form>
</div>

<div id="tabs_visualizaTurma">
    <ul>
        <li><a href="#tabs-1">Alunos</a></li>
        <li><a href="#tabs-2">Dados Cadastrais</a></li>
        <li><a href="#tabs-3">Sobre o Cadastro</a></li>
        <li><a href="#tabs-4">Quantidades</a></li>
    </ul>

    <div id="tabs-1">
        <fieldset style="background-color: whitesmoke;">
            <legend>Turma: <?php echo $this->_tpl_vars['turma']['idTurma']; ?>
 | Nome: <?php echo $this->_tpl_vars['turma']['nome']; ?>
</legend>            
            <legend>Lista de Alunos:</legend>            
            <button id="<?php echo $this->_tpl_vars['turma']['idTurma']; ?>
" onclick="gerarListaFrequencia(this)" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;">Lista de Frequência</button>
            <button id="<?php echo $this->_tpl_vars['turma']['idTurma']; ?>
" onclick="gerarProtocolo(this)" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;">Protocolo</button>

            <table id="resultado">
                <thead class="ui-widget-header ">
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Vínculo</th>
                        <th>CPF</th>
                        <th>Telefone</th>
                        <th>Observação</th>                        
                        <th>Status</th>
                        <th>Pagamento</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody id="conteudoResultado">
                    <?php $_from = $this->_tpl_vars['alunos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['alunos']):
?>
                    <tr>
                        <td><?php echo $this->_tpl_vars['alunos']['idMatricula']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['alunos']['aluno']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['alunos']['empresa']; ?>
</td>                        
                        <td><?php echo $this->_tpl_vars['alunos']['cpf']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['alunos']['telefone1']; ?>
</td>
                        <td id="observacao-<?php echo $this->_tpl_vars['alunos']['idMatricula']; ?>
"><?php echo $this->_tpl_vars['alunos']['observacao']; ?>
</td>
                        <td id="status-<?php echo $this->_tpl_vars['alunos']['idMatricula']; ?>
"><?php echo $this->_tpl_vars['alunos']['status']; ?>
</td> 
                        <td id="pagamento-<?php echo $this->_tpl_vars['alunos']['idMatricula']; ?>
"><?php echo $this->_tpl_vars['alunos']['pagamento']; ?>
</td>
                        <td>
                            <button id="<?php echo $this->_tpl_vars['alunos']['idMatricula']; ?>
" onclick="abrirObservacao(this);" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Observação"><img src="<?php echo $this->_tpl_vars['IMG']; ?>
../imgs/observacao.png"></button>
                            <!--<button id="<?php echo $this->_tpl_vars['alunos']['idMatricula']; ?>
" onclick="pagamento(this);" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Efetuar Pagamento"><img src="<?php echo $this->_tpl_vars['IMG']; ?>
../imgs/pagamento.png"></button>-->
                            <button id="<?php echo $this->_tpl_vars['alunos']['idMatricula']; ?>
" onclick="abrirFormaPagamento(this);" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Efetuar Pagamento"><img src="<?php echo $this->_tpl_vars['IMG']; ?>
../imgs/pagamento.png"></button>
                            <button id="<?php echo $this->_tpl_vars['alunos']['idMatricula']; ?>
" onclick="abrirConfirmarMatricula(this);" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Matricular"><img src="<?php echo $this->_tpl_vars['IMG']; ?>
../imgs/matricular.png"></button>
                            <button id="<?php echo $this->_tpl_vars['alunos']['idMatricula']; ?>
" onclick="emitirRecibo(this);" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Emitir Recibo"><img src="<?php echo $this->_tpl_vars['IMG']; ?>
../imgs/recibo.png"></button>
                            <button id="<?php echo $this->_tpl_vars['alunos']['idMatricula']; ?>
" onclick="remarcarTurma(this);" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Remarcar"><img src="<?php echo $this->_tpl_vars['IMG']; ?>
../imgs/remarcar.png"></button>
                            <button id="<?php echo $this->_tpl_vars['alunos']['idMatricula']; ?>
" onclick="cancelarMatricula(this);" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Cancelar Matrícula"><img src="<?php echo $this->_tpl_vars['IMG']; ?>
../imgs/cancelar.png"></button>
                            <button id="<?php echo $this->_tpl_vars['alunos']['idMatricula']; ?>
" onclick="concluirCurso(this);" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Concluir Curso"><img src="<?php echo $this->_tpl_vars['IMG']; ?>
../imgs/concluido.png"></button>
                            <button id="<?php echo $this->_tpl_vars['alunos']['idMatricula']; ?>
" onclick="emitirCertificado(this);" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Emitir Certificado"><img src="<?php echo $this->_tpl_vars['IMG']; ?>
../imgs/certificado.png"></button>
                        </td>
                    </tr>
                    <?php endforeach; endif; unset($_from); ?>
                </tbody>
            </table>
            <a id="linkRecibo" href="/recibo/recibo.txt" download target="_blank"></a> 
        </fieldset>
    </div>

    <div id="tabs-2">
        <fieldset style="background-color: whitesmoke;">
            <legend>Informações da Turma</legend>
            <table> 
                <tr>
                    <td><label for="formTurma_Curso">Curso:</label></td>
                    <td>
                        <select id="formTurma_Curso" class="text ui-widget-content ui-corner-all">
                            <option value="" readonly=""><?php echo $this->_tpl_vars['alunos']['curso']; ?>
</option>
                        </select>
                    </td>
                </tr>
                <?php $_from = $this->_tpl_vars['instrutores1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['instrutores1']):
?>
                <tr>
                    <td><label for="formTurma_Instrutor1">Instrutor 1:</label></td>
                    <td>
                        <select id="formTurma_Instrutor1" class="text ui-widget-content ui-corner-all">
                            <option value="" readonly=""><?php echo $this->_tpl_vars['instrutores1']['instrutor1']; ?>
</option>
                        </select>
                    </td>
                </tr>
                <?php endforeach; endif; unset($_from); ?>
                <?php $_from = $this->_tpl_vars['instrutores2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['instrutores2']):
?>
                <tr>
                    <td><label for="formTurma_Instrutor2">Instrutor 2:</label></td>
                    <td>
                        <select id="formTurma_Instrutor2" class="text ui-widget-content ui-corner-all">
                            <option value="" readonly=""><?php echo $this->_tpl_vars['instrutores2']['instrutor2']; ?>
</option>
                        </select>
                    </td>
                </tr>
                <?php endforeach; endif; unset($_from); ?>
                <?php $_from = $this->_tpl_vars['instrutores3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['instrutores3']):
?>
                <tr>
                    <td><label for="formTurma_Instrutor3">Instrutor 3:</label></td>
                    <td>
                        <select id="formTurma_Instrutor3" class="text ui-widget-content ui-corner-all">
                            <option value="" readonly=""><?php echo $this->_tpl_vars['instrutores3']['instrutor3']; ?>
</option>
                        </select>
                    </td>
                </tr>
                <?php endforeach; endif; unset($_from); ?>
                <?php $_from = $this->_tpl_vars['instrutores4']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['instrutores4']):
?>
                <tr>
                    <td><label for="formTurma_Instrutor4">Instrutor 4:</label></td>
                    <td>
                        <select id="formTurma_Instrutor4" class="text ui-widget-content ui-corner-all">
                            <option value="" readonly=""><?php echo $this->_tpl_vars['instrutores4']['instrutor4']; ?>
</option>
                        </select>
                    </td>
                </tr>
                <?php endforeach; endif; unset($_from); ?>
                <tr>
                    <td><label for="formTurma_Nome">Nome:</label></td>
                    <td><input type="text" id="formTurma_Nome" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['turma']['nome']; ?>
" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formTurma_Periodo">Período:</label></td>
                    <td><input type="text" id="formTurma_Periodo" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['turma']['periodo']; ?>
" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formTurma_Local">Local:</label></td>
                    <td><input type="text" id="formTurma_Local" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['turma']['local']; ?>
" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formTurma_Data">Data de Conclusão:</label></td>
                    <td><input type="text" id="formTurma_Data" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['turma']['dataTurma']; ?>
" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formTurma_Valor">Valor:</label></td>
                    <td><input type="text" id="formTurma_Valor" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['turma']['valor']; ?>
" readonly=""/></td>
                </tr>
            </table>
        </fieldset>
    </div>

    <div id="tabs-3">
        <fieldset style="background-color: whitesmoke;">
            <legend>Informações de Cadastro da Turma</legend>
            <table> 
                <tr>
                    <td><label for="formTurma_Status">Status:</label></td>
                    <td><input type="text" id="formTurma_Status" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['turma']['status']; ?>
" readonly=""/></td>
                </tr>

                <tr>
                    <td><label for="formTurma_UsuarioResponsavel">Usuário Responsável:</label></td>
                    <td><input type="text" id="formTurma_UsuarioResponsavel" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['turma']['usuarioResponsavel']; ?>
" readonly=""/></td>
                </tr>

                <tr>
                    <td><label for="formTurma_DataCadastro">Data de Cadastro:</label></td>
                    <td><input type="text" id="formTurma_DataCadastro" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['turma']['dataCadastro']; ?>
" readonly=""/></td>
                </tr>
            </table>
        </fieldset>
    </div>

    <div id="tabs-4">
        <fieldset style="background-color: whitesmoke;">
            <legend>Quantidade de Alunos:</legend>
            <table>
                <?php $_from = $this->_tpl_vars['prematriculados']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['prematriculados']):
?>
                <tr>
                    <td><label for="formTurma_StatusPreMatriculado">Pré-Matriculados:</label></td>
                    <td><input type="text" id="formTurma_StatusPreMatriculado" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['prematriculados']['COUNT']; ?>
" readonly=""/></td>
                </tr>
                <?php endforeach; endif; unset($_from); ?>
                <?php $_from = $this->_tpl_vars['matriculados']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['matriculados']):
?>
                <tr>
                    <td><label for="formTurma_StatusMatriculado">Matriculados:</label></td>
                    <td><input type="text" id="formTurma_StatusMatriculado" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['matriculados']['COUNT']; ?>
" readonly=""/></td>
                </tr>
                <?php endforeach; endif; unset($_from); ?>
                <?php $_from = $this->_tpl_vars['cancelados']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cancelados']):
?>
                <tr>
                    <td><label for="formTurma_StatusCancelado">Cancelados:</label></td>
                    <td><input type="text" id="formTurma_StatusCancelado" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['cancelados']['COUNT']; ?>
" readonly=""/></td>
                </tr>
                <?php endforeach; endif; unset($_from); ?>
                <?php $_from = $this->_tpl_vars['remarcados']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['remarcados']):
?>
                <tr>
                    <td><label for="formTurma_StatusRemarcado">Remarcados:</label></td>
                    <td><input type="text" id="formTurma_StatusRemarcado" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['remarcados']['COUNT']; ?>
" readonly=""/></td>
                </tr>
                <?php endforeach; endif; unset($_from); ?>
                <?php $_from = $this->_tpl_vars['concluidos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['concluidos']):
?>
                <tr>
                    <td><label for="formTurma_StatusConcluido">Concluídos:</label></td>
                    <td><input type="text" id="formTurma_StatusConcluido" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['concluidos']['COUNT']; ?>
" readonly=""/></td>
                </tr>
                <?php endforeach; endif; unset($_from); ?>
            </table>
        </fieldset>
    </div>
</div>
<table>
    <tr>
        <td><button onclick="cancelar()" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" >Voltar</button></td>
    </tr>
</table>

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

    function cancelar() {
        openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/turma/listarTurmasAtivas/");
    }

    function confirmarMatricula() {
        $.ajax({
            url: "<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/turma/confirmarMatricula",
            data: {
                "idMatricula": $("#auxDialogs").val()
            },
            cache: false,
            success: function (data) {
                $().message(data.message);
                //openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/turma/visualizar/" + $("#idTurma").val());
                $("#status-" + $("#auxDialogs").val()).html("");
                $("#status-" + $("#auxDialogs").val()).append("Matriculado");
            },
            error: function (data) {
                $().message("Problemas ao acessar o servidor.");

            },
            dataType: "json"

        });
    }

    function abrirConfirmarMatricula(botao) {
        $("#auxDialogs").val(botao.id);
        $("#dialog-confirmMatricula").dialog("open");
    }

    function abrirObservacao(botao) {
        $("#auxDialogs").val(botao.id);
        $("#dialog-addObservacao").dialog("open");
    }

    function confirmarObservacao() {
        $.ajax({
            url: "<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/turma/confirmarObservacao",
            data: {
                "idMatricula": $("#auxDialogs").val(),
                "observacao": $("#observacao").val()
            },
            cache: false,
            success: function (data) {
                $().message(data.message);
                //openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/turma/visualizar/" + $("#idTurma").val());
                $("#observacao-" + $("#auxDialogs").val()).html("");
                $("#observacao-" + $("#auxDialogs").val()).append($("#observacao").val());
            },
            error: function (data) {
                $().message("Problemas ao acessar o servidor.");

            },
            dataType: "json"

        });
    }

    function abrirFormaPagamento(botao) {
        $("#auxDialogs").val(botao.id);
        valorTurma = parseFloat(<?php echo $this->_tpl_vars['turma']['valor']; ?>
);
        $("#dialog-addFormaPagamento_valorBaixado").val(valorTurma);
        $("#dialog-addFormaPagamento").dialog("open");
    }

    function pagamento() {
        variavel = $("#auxDialogs").val();
        $.ajax({
            url: "<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/turma/verificaPagamento",
            data: {
                "idMatricula": variavel,
                "formaPagamento": $("#dialog-addFormaPagamento_formaPagamento").val(),
                "valorBaixado": $("#dialog-addFormaPagamento_valorBaixado").val()
            },
            cache: false,
            success: function (data) {
                //openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/turma/visualizar/" + $("#idTurma").val());
                $().message("Pagamento realizado com sucesso.");
                $("#pagamento-" + variavel).html("");
                $("#pagamento-" + variavel).append(data.message);
            },
            error: function (data) {
                $().message("Problemas ao acessar o servidor.");

            },
            dataType: "json"

        });
    }

    function cancelarMatricula(botao) {
        variavel = botao.id;
        $.ajax({
            url: "<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/turma/cancelarMatricula",
            data: {
                "idMatricula": variavel
            },
            cache: false,
            success: function (data) {
                $().message(data.message);
                //openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/turma/visualizar/" + $("#idTurma").val());
                $("#status-" + variavel).html("");
                $("#status-" + variavel).append("Cancelado");
            },
            error: function (data) {
                $().message("Problemas ao acessar o servidor.");

            },
            dataType: "json"

        });
    }


    function remarcarTurma(botao) {
        variavel = botao.id;
        $.ajax({
            url: "<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/turma/remarcarTurma",
            data: {
                "idMatricula": variavel
            },
            cache: false,
            success: function (data) {
                $().message(data.message);
                //openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/turma/visualizar/" + $("#idTurma").val());
                $("#status-" + variavel).html("");
                $("#status-" + variavel).append("Remarcado");
            },
            error: function (data) {
                $().message("Problemas ao acessar o servidor.");

            },
            dataType: "json"

        });
    }

    function gerarListaFrequencia(botao) {
        $("#listaFrequencia_idTurma_PDF").val(botao.id);
        document.getElementById("listaFrequencia").submit();
    }

    function gerarProtocolo(botao) {
        $("#protocolo_idTurma_PDF").val(botao.id);
        document.getElementById("protocolo").submit();
    }

    function emitirRecibo(botao) {
        variavel = botao.id;

        $.ajax(
                {
                    url: "<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/turma/emitirRecibo",
                    data: {
                        "idMatricula": variavel
                    },
                    cache: false,
                    success: function (data) {
                        $().message("Realizando o download do recibo ...");
                        document.getElementById('linkRecibo').click();

                    },
                    error: function (data) {
                        $().message("Problemas ao acessar o servidor");
                    },
                    dataType: "json"
                }
        );
    }

    function emitirCertificado(botao) {
        $("#idMatriculaCertificadoPDF").val(botao.id);
        document.getElementById("certificado").submit();
    }

    function concluirCurso(botao) {
        variavel = botao.id;
        $.ajax({
            url: "<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/turma/concluirCurso",
            data: {
                "idMatricula": variavel
            },
            cache: false,
            success: function (data) {
                $().message(data.message);
                //openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/turma/visualizar/" + $("#idTurma").val());
                $("#status-" + $("#auxDialogs").val()).html("");
                $("#status-" + $("#auxDialogs").val()).append("Concluido");
            },
            error: function (data) {
                $().message("Problemas ao acessar o servidor.");

            },
            dataType: "json"

        });
    }
</script>