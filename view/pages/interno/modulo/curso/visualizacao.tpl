<script type="text/javascript">
    $(function() {
    $("#tabs_visualizaCurso").tabs();
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
    div#tabs_cadastroCurso-contain {
        width: 350px;
        margin: 20px 0;
        font-size: 90.5%;
    }
    div#tabs_cadastroCurso-contain table {
        margin: 1em 0;
        border-collapse: collapse;
        width: 100%;
    }
    div#tabs_cadastroCurso-contain table td, div#romaneio-contain table th {
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

<script>$("#statusInformacao").html("Vocé está em: Curso >> Listar Cursos >> Visualizar Cadastro de Curso.");</script>

<div id="tabs_visualizaCurso">
    <ul>
        <li><a href="#tabs-1">Informações</a></li>
        <li><a href="#tabs-2">Certificado</a></li>
        <li><a href="#tabs-3">Sobre o Cadastro</a></li>
    </ul>

    <div id="tabs-1">
        <fieldset style="background-color: whitesmoke;">
            <legend>Informações do Curso</legend>
            <table> 
                <tr>
                    <td><label for="formCurso_Nome">Nome:</label></td>
                    <td><input type="text" id="formCurso_Nome" size="70" maxlength="255" value="{{$curso.nome}}" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formCurso_CargaHoraria">Carga Horária:</label></td>
                    <td><input type="text" id="formCurso_CargaHoraria" size="70" maxlength="255" value="{{$curso.cargaHoraria}}" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formCurso_Conteudo">Conteúdo:</label></td>
                    <td><input type="text" id="formCurso_Conteudo" size="70" value="{{$curso.conteudo}}" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formCurso_PatchConteudo">Conteúdo (Imagem):</label></td>
                    <td><input type="text" id="formCurso_PatchConteudo" size="70" value="{{$curso.patchConteudo}}" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formCurso_Validade">Validade:</label></td>
                    <td><input type="text" id="formCurso_Validade" size="70" maxlength="255" value="{{$curso.validade}}" readonly=""/></td>
                </tr>                
            </table>
        </fieldset>
    </div> 
    
    <div id="tabs-2">
        <fieldset style="background-color: whitesmoke;">
            <legend>Informações do Layout do Certificado</legend>
            <table>    
                <tr>
                    <td><label for="formCurso_CorFundo">Cor do Background do Título:</label></td>
                    <td><input type="color" id="formCurso_CorFundo" size="70" value="{{$curso.corFundo}}" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formCurso_CorFonte">Cor da Fonte do Título:</label></td>
                    <td><input type="color" id="formCurso_CorFonte" size="70" value="{{$curso.corFonte}}" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formCurso_TamanhoFonte">Tamanho da Fonte do Título:</label></td>
                    <td><input type="text" id="formCurso_TamanhoFonte" size="70" value="{{$curso.tamanhoFonte}}" readonly=""/></td>
                </tr>
            </table>
        </fieldset>
    </div>
    
    <div id="tabs-3">
        <fieldset style="background-color: whitesmoke;">
            <legend>Informações de Cadastro do Curso</legend>
            <table> 
                <tr>
                    <td><label for="formCurso_Status">Status:</label></td>
                    <td><input type="text" id="formCurso_Status" size="70" maxlength="255" value="{{$curso.status}}" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formCurso_UsuarioResponsavel">Usuário Responsável:</label></td>
                    <td><input type="text" id="formCurso_UsuarioResponsavel" size="70" maxlength="255" value="{{$curso.usuarioResponsavel}}" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formCurso_DataCadastro">Data de Cadastro:</label></td>
                    <td><input type="text" id="formCurso_DataCadastro" size="70" maxlength="255" value="{{$curso.dataCadastro}}" readonly=""/></td>
                </tr>
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

    function cancelar(){
        openlink("{{$BASE_PATH}}interno/modulo/curso/listarCursos/");
    }
  
</script>