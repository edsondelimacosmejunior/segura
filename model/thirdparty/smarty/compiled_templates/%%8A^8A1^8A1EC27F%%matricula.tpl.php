<?php /* Smarty version 2.6.18, created on 01-04-2015 00:28:39
         compiled from pages/interno/modulo/turma/matricula.tpl */ ?>
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

    #matriculaResultado tr:hover td {
        background:#F7B64B;
    }

    #dialog-buscaAlunos_alunosResultado tr:hover td {
        background:#F7B64B;
    }

</style>
<script>
    $(function() {
        $("#dialog-buscaAlunos").dialog({
            height: 800,
            width: 1000,
            modal: true,
            autoOpen: false
        });
    });
</script>

<input type="text" name="text" id="idTurma" value="<?php echo $this->_tpl_vars['idTurma']; ?>
" style="display: none;"/>

<script>$("#statusInformacao").html("Você está em: Turma >> Listar >> Pré-matrícula.");</script>

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
        <td><button onclick="finalizarMatricula()" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;">Finalizar Pré-matrícula</button></td>
    </tr>
</table>


<table id="matricula" style="width: 100%; text-align: center;">
    <thead class="ui-widget-header ">
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>RG</th>
            <th>Data de Nascimento</th>
            <th>Escolha</th>
        </tr>
    </thead>
    <tbody id="matriculaResultado">

    </tbody>
</table>


<script type="text/javascript" charset="utf-8">
    function runScriptBuscaAluno(e) {
        if (e.keyCode == 13) {
            getAluno();
            return false;
        }
    }
    
    function finalizarMatricula(){
        var i, linhasDaTabela = new Array();

        var tamanho = $('.matriculaResultado').length;
        var indice = 0;
        for (i = 0; i < $('.matriculaResultado').length; i++) {
            if (posicao.id != i) {
                linhasDaTabela[indice] = new Object();
                linhasDaTabela[indice].idAluno = $('.matriculaResultadoIdAluno')[i].innerHTML.replace(/<[^<>]+>/g, '');
                indice++;
            }
        }
        var alunos = JSON.stringify(linhasDaTabela);
        
        $.ajax({
                url: "<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/turma/realizarMatricula",
                data: {
                    "idTurma": $("#idTurma").val(),
                    "alunos": alunos
                },
                cache: false,
                success: function(data) {
                    $().message("Matrícula realizada com sucesso.");
                    openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/turma/visualizar/" + $("#idTurma").val())
                },
                error: function(data) {
                    $().message("Problemas ao acessar o servidor.");
                },
                dataType: "json"

            });
    }
    

    function alertaVazio(campos, contador) {
        document.getElementById("nome").style.borderColor = '#F8F8F8';
        document.getElementById("cpf").style.borderColor = '#F8F8F8';
        document.getElementById("rg").style.borderColor = '#F8F8F8';

        for (i = 0; i < contador; i = i + 1) {
            document.getElementById(campos[i]).style.borderColor = '#FF3300';
            document.getElementById(campos[i]).style.backgroundColor = '#FFEDBF';
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
            $("#dialog-buscaAlunos").dialog("open");
            $("#dialog-buscaAlunos_alunosResultado").html("");
            var newRowContent = "<tr><td colspan=\"4\">Buscando dados no servidor. Por favor, aguarde.</td></tr>";
            $("#dialog-buscaAlunos_alunosResultado").append(newRowContent);

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
                    $("#dialog-buscaAlunos_alunosResultado").html("");

                    if (data != null) {
                        posicao = 0;
                        for (var i = 0; i < data.length; i++) {
                            var newRowContent = "<tr class=\"linhas\"><td class=\"buscaAlunosIdAluno\">" + data[i].idAluno + "</td><td class=\"buscaAlunosNome\">" + data[i].nome + "</td><td class=\"buscaAlunosCpf\">" + data[i].cpf + "</td><td class=\"buscaAlunosRg\">" + data[i].rg + "</td><td class=\"buscaAlunosDataNascimento\">" + data[i].dataNascimento + "</td><td><button id=\"buscaAlunos-" + posicao + "\" onclick=\"javascript:adicionarMatricula(this);\" class=\"ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all\" style=\"float:left; margin-right:10px;\"><span class=\"ui-button-text\">Usar Este</span></button></td></tr>";
                            $("#dialog-buscaAlunos_alunosResultado").append(newRowContent);
                            posicao++;
                        }
                    } else {
                        var newVazio = "<tr><td colspan=\"4\">Nenhum dado encontrado.</td></tr>";
                        $("#dialog-buscaAlunos_alunosResultado").append(newVazio);
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

    function adicionarMatricula(posicao) {
        var linhasDaTabela = new Array();
        var aux = "" + posicao.id;
        var array = aux.split("-");

        document.getElementById(posicao.id).style.display = 'none';
        
        linhasDaTabela[0] = new Object();
        linhasDaTabela[0].idAluno = $('.buscaAlunosIdAluno')[array[1]].innerHTML.replace(/<[^<>]+>/g, '');
        linhasDaTabela[0].nome = $('.buscaAlunosNome')[array[1]].innerHTML.replace(/<[^<>]+>/g, '');
        linhasDaTabela[0].cpf = $('.buscaAlunosCpf')[array[1]].innerHTML.replace(/<[^<>]+>/g, '');
        linhasDaTabela[0].rg = $('.buscaAlunosRg')[array[1]].innerHTML.replace(/<[^<>]+>/g, '');
        linhasDaTabela[0].dataNascimento = $('.buscaAlunosDataNascimento')[array[1]].innerHTML.replace(/<[^<>]+>/g, '');

        var local = jQuery("#matriculaResultado tr").length;
        // ai, se vc quiser saber o codigo da linha 10 por exemplo, é só fazer assim: 
        var html = "<tr class=\"matriculaResultado\"><td class=\"matriculaResultadoIdAluno\">" + linhasDaTabela[0].idAluno + "</td><td class=\"matriculaResultadoNome\">" + linhasDaTabela[0].nome + "</td><td class=\"matriculaResultadoCpf\">" + linhasDaTabela[0].cpf + "</td><td class=\"matriculaResultadoRg\">" + linhasDaTabela[0].rg + "</td><td class=\"matriculaResultadoDataNascimento\">" + linhasDaTabela[0].dataNascimento + "</td><td><button id=\"" + local + "\" onclick=\"javascript:retirarMatricula(this);\" class=\"ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all\" style=\"float:left; margin-right:10px;\"><span class=\"ui-button-text\">Retirar Este</span></button></td></tr>";
        //$('#orcamento').val($('#orcamento').val()+html); 
        var newRowContent = html;
        $("#matriculaResultado").append(newRowContent);
        $("#dialog-buscaAlunos").dialog("close");

    }

    function retirarMatricula(posicao) {
        var i, linhasDaTabela = new Array();

        var tamanho = $('.matriculaResultado').length;
        var indice = 0;
        for (i = 0; i < $('.matriculaResultado').length; i++) {
            if (posicao.id != i) {
                linhasDaTabela[indice] = new Object();
                linhasDaTabela[indice].idAluno = $('.matriculaResultadoIdAluno')[i].innerHTML.replace(/<[^<>]+>/g, '');
                linhasDaTabela[indice].nome = $('.matriculaResultadoNome')[i].innerHTML.replace(/<[^<>]+>/g, '');
                linhasDaTabela[indice].cpf = $('.matriculaResultadoCpf')[i].innerHTML.replace(/<[^<>]+>/g, '');
                linhasDaTabela[indice].rg = $('.matriculaResultadoRg')[i].innerHTML.replace(/<[^<>]+>/g, '');
                linhasDaTabela[indice].dataNascimento = $('.matriculaResultadoDataNascimento')[i].innerHTML.replace(/<[^<>]+>/g, '');
                indice++;

            }
        }

        var tamanho2 = $('.matriculaResultado').length;
        for (i = 0; i < tamanho2; i++) {
            document.getElementById('matriculaResultado').deleteRow(0);
        }

        var local = 0;
        var html = "";
        for (i = 0; i < linhasDaTabela.length; i++) {
            var html = html + "<tr class=\"matriculaResultado\"><td class=\"matriculaResultadoIdAluno\">" + linhasDaTabela[i].idAluno + "</td><td class=\"matriculaResultadoNome\">" + linhasDaTabela[i].nome + "</td><td class=\"matriculaResultadoCpf\">" + linhasDaTabela[i].cpf + "</td><td class=\"matriculaResultadoRg\">" + linhasDaTabela[i].rg + "</td><td class=\"matriculaResultadoDataNascimento\">" + linhasDaTabela[i].dataNascimento + "</td><td><button id=\"" + local + "\" onclick=\"javascript:retirarMatricula(this);\" class=\"ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all\" style=\"float:left; margin-right:10px;\"><span class=\"ui-button-text\">Retirar Este</span></button></td></tr>";
            local++;
        }

        var newRowContent = html;
        $("#matriculaResultado").append(newRowContent);
    }
</script>