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

<script>$("#statusInformacao").html("Voce está em: Curso >> Listar.");</script>

<script>
    $(function() {
        $( "#dialogCurso-confirmExclusao" ).dialog({
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
                    confirmarExclusaoCurso();
                }
            }
        });
    });
</script>

<div id="dialogCurso-confirmExclusao" title="Confirma a exclusão deste curso?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Ao realizar a exclusão deste curso, ele não estará mais disponível. Tem certeza que deseja excluir?</p>
</div>

<input type="text" id="auxDialogs" name="auxDialogs" style="display: none;" />


<div id="resultado-contain">
    <table id="resultado">
        <thead class="ui-widget-header ">
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Carga Horária</th>
<!--                <th>Conteúdo</th>
                <th>Validade</th>
                <th>Valor</th>
                <th>Status</th>
-->
                <th>Opções</th>
            </tr>
        </thead>
        <tbody id="conteudoResultado">
            {{foreach from=$cursos item=cursos}}
            <tr>
                <td>{{$cursos.idCurso}}</td>
                <td>{{$cursos.nome}}</td>
                <td>{{$cursos.cargaHoraria}}</td>
<!--                <td>{{$cursos.conteudo}}</td>
                <td>{{$cursos.validade}}</td>
                <td>{{$cursos.valor}}</td>
                <td>{{$cursos.status}}</td>
-->
                <td>
                    <button id="{{$cursos.idCurso}}" onclick="uploadConteudo(this);;" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Anexar Conteúdo"><img src="{{$IMG}}../imgs/conteudo.png"></button>
                   <!-- <button id="{{$cursos.idCurso}}" onclick="certificados(this);" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Imprimir Certificados"><img src="{{$IMG}}../imgs/certificado.png"></button>-->
                    <button id="{{$cursos.idCurso}}" onclick="visualizar(this);" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Visualizar"><img src="{{$IMG}}../imgs/visualizar.png"></button>
                    <button id="{{$cursos.idCurso}}" onclick="atualizar(this);" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Atualizar"><img src="{{$IMG}}../imgs/atualizar.png"></button>
                    <button id="{{$cursos.idCurso}}" onclick="abrirExcluir(this);" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="cursor:pointer;" title="Excluir"><img src="{{$IMG}}../imgs/excluir.png"></button>
                </td>
            </tr>
            {{/foreach}}
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
        variavel = botao.id;
        openlink('{{$BASE_PATH}}interno/modulo/curso/visualizar/' + variavel);
    }
    
    idCurso="";
    
    function abrirExcluir(botao){
        idCurso = botao.id;
        $("#auxDialogs").val(botao.id);
        $("#dialogCurso-confirmExclusao").dialog("open");            
    }
    
    function confirmarExclusaoCurso() {
        $.ajax({
                url: "{{$BASE_PATH}}interno/modulo/curso/excluir",
                data: {
                    "idCurso": idCurso
                },
                cache: false,
                success: function(data){
                    respostaDoControlador = eval(data);
                    mensagem = respostaDoControlador.message;
            
                    if(mensagem === "Curso excluído com sucesso."){
                    
                        $().message(respostaDoControlador.message);
                        openlink("{{$BASE_PATH}}interno/modulo/curso/listarCursos/");
                    }
                },
                error: function(data){
                    respostaDoControlador = eval(data);
                    $().message(respostaDoControlador.message);
                    openlink("{{$BASE_PATH}}interno/modulo/aluno/listarAlunos/");
                },
                dataType: "json"
            });
    }
       
    function atualizar(botao) {
        variavel = botao.id;
        openlink('{{$BASE_PATH}}interno/modulo/curso/enviarAtualizar/' + variavel);
    }
    
    function uploadConteudo(botao) {
        variavel = botao.id;
        openlink('{{$BASE_PATH}}interno/modulo/curso/enviarFormularioUploadConteudo/' + variavel);
    }
    
    /*function certificados(botao) {
        variavel = botao.id;
        openlink('{{$BASE_PATH}}interno/modulo/curso/certificados/' + variavel);;
    }*/
</script>