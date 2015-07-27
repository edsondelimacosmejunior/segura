<script type="text/javascript">
    $(function() {
    $("#tabs_visualizaUsuario").tabs();
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
    div#tabs_cadastroUsuario-contain {
        width: 350px;
        margin: 20px 0;
        font-size: 90.5%;
    }
    div#tabs_cadastroUsuario-contain table {
        margin: 1em 0;
        border-collapse: collapse;
        width: 100%;
    }
    div#tabs_cadastroUsuario-contain table td, div#romaneio-contain table th {
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

<script>$("#statusInformacao").html("Vocé está em: Usuário >> Listar Usuários >> Visualizar Cadastro de Usuário.");</script>

<div id="tabs_visualizaUsuario">
    <ul>
        <li><a href="#tabs-1">Dados Pessoais</a></li>
        <li><a href="#tabs-2">Sobre o Cadastro</a></li>
    </ul>

    <div id="tabs-1">
        <fieldset style="background-color: whitesmoke;">
            <legend>Identificação</legend>
            <table> 
                <tr>
                    <td><label for="formUsuario_Nome">Nome:</label></td>
                    <td><input type="text" id="formUsuario_Nome" size="70" maxlength="255" value="{{$usuario.nome}}" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formUsuario_Login">Login:</label></td>
                    <td><input type="text" id="formUsuario_Login" size="70" maxlength="255" value="{{$usuario.login}}" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formUsuario_Email">Email:</label></td>
                    <td><input type="text" id="formUsuario_Email" size="70" maxlength="255" value="{{$usuario.email}}" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formUsuario_Nivel">Nível:</label></td>
                    <td>
                        <select id="formUsuario_Nivel">
                            <option value="" readonly="">{{$usuario.nivel}}</option>
                        </select>
                    </td>
                </tr>
            </table>
        </fieldset>
    </div>
    
    <div id="tabs-2">
        <fieldset style="background-color: whitesmoke;">
            <legend>Informações de Cadastro do Usuário</legend>
            <table> 
                <tr>
                    <td><label for="formUsuario_Status">Status:</label></td>
                    <td><input type="text" id="formUsuario_Status" size="70" maxlength="255" value="{{$usuario.status}}" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formUsuario_DataCadastro">Data de Cadastro:</label></td>
                    <td><input type="text" id="formUsuario_DataCadastro" size="70" maxlength="255" value="{{$usuario.dataCadastro}}" readonly=""/></td>
                </tr>
            </table>
        </fieldset>
    </div>
</div>
<table>
    <tr>
        <td><button onclick="cancelar()" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all">Voltar</button></td>
    </tr>
</table>

<script>

    function cancelar(){
        openlink("{{$BASE_PATH}}interno/modulo/usuario/listarUsuarios/");
    }
    
</script>