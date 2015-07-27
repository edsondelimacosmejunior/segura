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

<script>$("#statusInformacao").html("Voce está em: Turma >> Listar.");</script>

<script>
    $(function() {
        $( "#dialogTurma-confirmExclusao" ).dialog({
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
                    confirmarExclusaoTurma();
                }
            }
        });
    });
</script>

<div id="formulario" style="display: none">
    <form action="../extensions/dompdf/testeCertificadoTurma.php" method="post" id="certificadoTurma" target="_blank">
        <input type="text" id="idTurmaCertificadoPDF" name="idTurmaCertificadoPDF"/>
    </form>
</div>

<div id="dialogTurma-confirmExclusao" title="Confirma a exclusão desta turma?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Ao realizar a exclusão desta turma, ela não estará mais disponível. Tem certeza que deseja excluir?</p>
</div>

<input type="text" id="auxDialogs" name="auxDialogs" style="display: none;" />


<div id="resultado-contain">
    <table id="resultado">
        <thead class="ui-widget-header ">
            <tr>
                <th>Código da Turma</th>
                <th>Curso</th>
                <th>Nome</th>
                <th>Período</th>
                <th>Status</th>
                <th>Opções</th>
            </tr>
        </thead>
        <tbody id="conteudoResultado">
            {{foreach from=$turmas item=turmas}}
            <tr>
                <td>{{$turmas.idTurma}}</td>
                <td>{{$turmas.curso}}</td>
                <td>{{$turmas.turma}}</td>                
                <td>{{$turmas.periodo}}</td>
                <td>{{$turmas.status}}</td>
                <td>
                    <button id="{{$turmas.idTurma}}" onclick="matricular(this)" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Realizar Matrículas"><img src="{{$IMG}}../imgs/prematricular.png"></button>
                    <button id="{{$turmas.idTurma}}" onclick="visualizar(this)" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Visualizar"><img src="{{$IMG}}../imgs/visualizar.png"></button>
                    <button id="{{$turmas.idTurma}}" onclick="atualizar(this)" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Atualizar"><img src="{{$IMG}}../imgs/atualizar.png"></button>
                    <button id="{{$turmas.idTurma}}" onclick="abrirExcluir(this)" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Excluir"><img src="{{$IMG}}../imgs/excluir.png"></button>
                    <button id="{{$turmas.idTurma}}" onclick="concluir(this)" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Concluir Turma"><img src="{{$IMG}}../imgs/concluirTurma.png"></button>
                    <button id="{{$turmas.idTurma}}" onclick="gerarCertificado(this)" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Gerar Certificado"><img src="{{$IMG}}../imgs/certificado.png"></button>
                </td>
            </tr>
            {{/foreach}}
        </tbody>
    </table>
</div>

<script>
    var oTable = $('#resultado').dataTable({
        "sScrollY": "600px",
        "sScrollX": "1350px",
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

    function matricular(botao) {
        variavel = botao.id;
        openlink('{{$BASE_PATH}}interno/modulo/turma/mostrarRealizarMatricula/' + variavel);
    }
    
    function visualizar(botao) {
        variavel = botao.id;
        openlink('{{$BASE_PATH}}interno/modulo/turma/visualizar/' + variavel);
    }
    
    idTurma="";
    
    function abrirExcluir(botao){
        idTurma = botao.id;
        $("#auxDialogs").val(botao.id);
        $("#dialogTurma-confirmExclusao").dialog("open");            
    }
    
    function confirmarExclusaoTurma() {
        $.ajax({
                url: "{{$BASE_PATH}}interno/modulo/turma/excluir",
                data: {
                    "idTurma": idTurma
                },
                cache: false,
                success: function(data){
                    respostaDoControlador = eval(data);
                    mensagem = respostaDoControlador.message;
            
                    if(mensagem === "Turma excluída com sucesso."){
                    
                        $().message(respostaDoControlador.message);
                        openlink("{{$BASE_PATH}}interno/modulo/turma/listarTurmas/");
                    }
                },
                error: function(data){
                    respostaDoControlador = eval(data);
                    $().message(respostaDoControlador.message);
                    openlink("{{$BASE_PATH}}interno/modulo/turma/listarTurmas/");
                },
                dataType: "json"
            });
    }
    
    function atualizar(botao) {
        variavel = botao.id;
        openlink('{{$BASE_PATH}}interno/modulo/turma/enviarAtualizar/' + variavel);
    }
    
    function concluir(botao) {
        variavel = botao.id;
        $.ajax({
            url: "{{$BASE_PATH}}interno/modulo/turma/concluirTurma",
            data: {
                "idTurma": variavel
            },
            cache: false,
            success: function(data) {
                $().message(data.message);
                openlink('{{$BASE_PATH}}interno/modulo/turma/listarTurmas/' + $("#idTurma").val());
            },
            error: function(data) {
                $().message("Problemas ao acessar o servidor.");

            },
            dataType: "json"

        });
    }
    
    function gerarCertificado(botao){
        $("#idTurmaCertificadoPDF").val(botao.id);
        document.getElementById("certificadoTurma").submit();
    }
</script>