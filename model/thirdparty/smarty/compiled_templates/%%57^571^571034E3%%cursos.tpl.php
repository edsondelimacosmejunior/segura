<?php /* Smarty version 2.6.18, created on 09-07-2015 09:25:58
         compiled from pages/interno/modulo/aluno/cursos.tpl */ ?>
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

<script>$("#statusInformacao").html("Voce está em: Aluno >> Listar >> Cursos.");</script>
<button id="refazerRelatorio" onclick="voltar()" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="float:left; margin:10px;">
        <span class="ui-button-text">Voltar</span>
    </button>

<div id="resultado-contain">
    <table id="resultado">
        <thead class="ui-widget-header ">
            <tr>
                <th>Matricula</th>
                <th>Aluno</th>
                <th>Curso</th>
                <th>Codigo da Turma</th>
                <th>Nome</th>
                <th>Período</th>
                <th>Status</th>
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
                <td><?php echo $this->_tpl_vars['alunos']['nome']; ?>
</td>
                <td><?php echo $this->_tpl_vars['alunos']['curso']; ?>
</td>
                <td><?php echo $this->_tpl_vars['alunos']['idTurma']; ?>
</td>
                <td><?php echo $this->_tpl_vars['alunos']['turma']; ?>
</td>
                <td><?php echo $this->_tpl_vars['alunos']['periodo']; ?>
</td>
                <td><?php echo $this->_tpl_vars['alunos']['status']; ?>
</td>
                <td>
                    <button id="<?php echo $this->_tpl_vars['alunos']['idTurma']; ?>
" onclick="visualizar(this)" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Visualizar"><img src="<?php echo $this->_tpl_vars['IMG']; ?>
../imgs/visualizar.png"></button>
                </td>

            </tr>
            <?php endforeach; endif; unset($_from); ?>
        </tbody>
    </table>
</div>

<script>
    var oTable = $('#resultado').dataTable({
        "sScrollY": "600px",
        "sScrollX": "1100px",
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
interno/modulo/turma/visualizar/' + variavel)
    }
    
    function voltar() {
        openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/aluno/mostrarPesquisa/");
    }

</script>