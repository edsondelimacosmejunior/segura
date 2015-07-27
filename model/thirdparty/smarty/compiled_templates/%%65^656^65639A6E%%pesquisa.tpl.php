<?php /* Smarty version 2.6.18, created on 08-07-2015 21:35:38
         compiled from pages/interno/modulo/aluno/pesquisa.tpl */ ?>
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

    #alunosResultado tr:hover td {
        background:#F7B64B;
    }

    #dialog-buscaAlunos_alunosResultado tr:hover td {
        background:#F7B64B;
    }

</style>

<script>$("#statusInformacao").html("Você está em: Aluno >> Pesquisar.");</script>


<script>
    $(function() {
        $( "#dialogAluno-confirmExclusao" ).dialog({
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
                    confirmarExclusaoAluno();
                }
            }
        });
    });
</script>

<div id="dialogAluno-confirmExclusao" title="Confirma a exclusão deste aluno?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Ao realizar a exclusão deste aluno, ele não estará mais disponível. Tem certeza que deseja excluir?</p>
</div>

<input type="text" id="auxDialogs" name="auxDialogs" style="display: none;" />

<table> 
    <tr>
        <td><label for="nome">Nome:</label></td>
        <td><input type="text" id="nome" size="70" onkeypress="return runScriptBuscaAluno(event)"/></td>
    </tr>
    <tr>
        <td><label for="cpf">CPF:</label></td>
        <td><input type="text" id="cpf" size="70" onkeypress="return runScriptBuscaAluno(event)" /></td>
    </tr>
    <tr>
        <td><label for="rg">RG:</label></td>
        <td><input type="text" id="rg" size="70" onkeypress="return runScriptBuscaAluno(event)" /></td>
    </tr>
    <tr>
        <td><button onclick="getAluno()" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;">Pesquisar</button></td>
    </tr>
</table>


<table id="alunos" style="width: 100%; text-align: center;">
    <thead class="ui-widget-header ">
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Telefone Principal</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody id="alunosResultado">

    </tbody>
</table>


<script type="text/javascript" charset="utf-8">
    function runScriptBuscaAluno(e) {
        if (e.keyCode == 13) {
            getAluno();
            return false;
        }
    }

    function getAluno() {

        campos = new Array(6);
        contador = 0;

        if ($("#nome").val() == "" && $("#cpf").val() == "" && $("#rg").val() == "") {
            campos[contador] = "nome";
            contador = contador + 1;
            campos[contador] = "cpf";
            contador = contador + 1;
            campos[contador] = "rg";
            contador = contador + 1;
        }

        if (contador == 0) {
            $("#alunosResultado").html("");
            var newRowContent = "<tr><td colspan=\"5\">Buscando dados no servidor. Por favor, aguarde.</td></tr>";
            $("#alunosResultado").append(newRowContent);

            $.ajax({
                url: "<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/aluno/getAlunos",
                data: {
                    "nome": $("#nome").val(),
                    "cpf": $("#cpf").val(),
                    "rg": $("#rg").val()
                },
                cache: false,
                success: function(data) {
                    $("#alunosResultado").html("");
                    var newRowContent = "";
                    if (data != null) {
                        posicao = 0;
                        for (var i = 0; i < data.length; i++) {
                            //var newRowContent = "<tr class=\"linhas\"><td class=\"buscaAlunosIdAluno\">" + data[i].idAluno + "</td><td class=\"buscaAlunosNome\">" + data[i].nome + "</td><td class=\"buscaAlunosCpf\">" + data[i].cpf + "</td><td class=\"buscaAlunosRg\">" + data[i].rg + "</td><td class=\"buscaAlunosDataNascimento\">" + data[i].dataNascimento + "</td><td><button id=\"buscaAlunos-" + posicao + "\" onclick=\"javascript:adicionarMatricula(this);\" class=\"ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all\" style=\"float:left; margin-right:10px;\"><span class=\"ui-button-text\">Usar Este</span></button></td></tr>";
                            newRowContent = newRowContent + '<tr><td>' + data[i].idAluno + '</td><td>' + data[i].nome + '</td><td>' + data[i].cpf + '</td><td>' + data[i].telefone1 + '</td><td>'+
                    '<button id=' + data[i].idAluno + ' onclick="visualizar(this)" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Visualizar"><img src="<?php echo $this->_tpl_vars['IMG']; ?>
../imgs/visualizar.png"></button>'+
                    '<button id=' + data[i].idAluno + ' onclick="atualizar(this)" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Atualizar"><img src="<?php echo $this->_tpl_vars['IMG']; ?>
../imgs/atualizar.png"></button>'+
                    '<button id=' + data[i].idAluno + ' onclick="abrirExcluir(this)" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Excluir"><img src="<?php echo $this->_tpl_vars['IMG']; ?>
../imgs/excluir.png"></button>'+
                    '<button id=' + data[i].idAluno + ' onclick="cursos(this)" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Turmas"><img src="<?php echo $this->_tpl_vars['IMG']; ?>
../imgs/concluido.png"></button></td></tr>';
                        }
                        $("#alunosResultado").append(newRowContent);
                    } else {
                        var newVazio = "<tr><td colspan=\"5\">Nenhum dado encontrado.</td></tr>";
                        $("#alunosResultado").append(newVazio);
                    }
                },
                error: function(data) {
                    $().message("Problemas ao acessar o servidor.");

                },
                dataType: "json"

            });
        } else {
            $().message("Informe ao menos um filtro da pesquisa.");
            alertaVazio(campos, contador);
        }
    }
    
    
    function visualizar(botao) {
        variavel = botao.id
        
        openlink('<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/aluno/visualizar/' + variavel)
    }
    
    function cursos(botao) {
        $.ajax({
            url: "<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/aluno/listarCursos/",
            data: {
                "idAluno": botao.id
            },
            cache: false,
            success: function(data) {
                $("#tab0").html(data);
                $("#status span").html("");
                reset_buttons();
            },
            error: function(data) {
                $().message("Problemas ao acessar o servidor");
            }

        });
    }
    
    
    function abrirExcluir(botao){
        idAluno = botao.id;
        $("#auxDialogs").val(botao.id);
        $("#dialogAluno-confirmExclusao").dialog("open");            
    }
    
    function confirmarExclusaoAluno() {
        $.ajax({
                url: "<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/aluno/excluir",
                data: {
                    "idAluno": idAluno
                },
                cache: false,
                success: function(data){
                    respostaDoControlador = eval(data);
                    mensagem = respostaDoControlador.message;
            
                    if(mensagem == "Aluno excluído com sucesso."){
                    
                        $().message(respostaDoControlador.message);
                        getAluno();
                    }
                },
                error: function(data){
                    respostaDoControlador = eval(data);
                    $().message(respostaDoControlador.message);
                    openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/aluno/listarAlunos/");
                },
                dataType: "json"
            });
    }
    
    function atualizar(botao) {
        variavel = botao.id
        openlink('<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/aluno/enviarAtualizar/' + variavel)
    }

</script>