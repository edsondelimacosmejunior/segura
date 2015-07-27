<script type="text/javascript">
    $(function() {
    $("#tabs_visualizaAluno").tabs();
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
    div#tabs_cadastroAluno-contain {
        width: 350px;
        margin: 20px 0;
        font-size: 90.5%;
    }
    div#tabs_cadastroAluno-contain table {
        margin: 1em 0;
        border-collapse: collapse;
        width: 100%;
    }
    div#tabs_cadastroAluno-contain table td, div#romaneio-contain table th {
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

<script>$("#statusInformacao").html("Vocé está em: Aluno >> Listar Alunos >> Visualizar Cadastro de Aluno.");</script>

<div id="tabs_visualizaAluno">
    <ul>
        <li><a href="#tabs-1">Dados Pessoais</a></li>
        <li><a href="#tabs-2">Endereço</a></li>
        <li><a href="#tabs-3">Dados Profissionais</a></li>
        <li><a href="#tabs-4">Sobre o Cadastro</a></li>
    </ul>
    
    <div id="tabs-1">
        <fieldset style="background-color: whitesmoke;">
            <legend>Identificação</legend>
            <table> 
                <tr>
                    <td><label for="formAluno_Nome">Nome:</label></td>
                    <td><input type="text" id="formAluno_Nome" size="70" maxlength="255" value="{{$aluno.nome}}" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formAluno_Sexo">Sexo:</label></td>
                    <td><input type="text" id="formAluno_Sexo" size="70" maxlength="255" value="{{$aluno.sexo}}" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formAluno_Cpf">CPF:</label></td>
                    <td><input type="text" id="formAluno_Cpf" size="70" maxlength="255" value="{{$aluno.cpf}}" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formAluno_Matricula">Matrícula:</label></td>
                    <td><input type="text" id="formAluno_Matricula" size="70" maxlength="255" value="{{$aluno.matricula}}" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formAluno_Rg">RG:</label></td>
                    <td><input type="text" id="formAluno_Rg" size="70" maxlength="255" value="{{$aluno.rg}}" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formAluno_DataNascimento">Data de Nascimento:</label></td>
                    <td><input type="text" id="formAluno_DataNascimento" size="70" maxlength="255" value="{{$aluno.dataNascimento}}" readonly=""/></td>
                </tr>
            </table>
        </fieldset>
    </div>

    <div id="tabs-2">
        <fieldset style="background-color: whitesmoke;">
            <legend>Endereço Pessoal do Aluno</legend>
            <table> 
                <tr>
                    <td><label for="formAluno_Rua">Rua:</label></td>
                    <td><input type="text" id="formAluno_Rua" size="70" maxlength="255" value="{{$aluno.rua}}" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formAluno_Numero">Número:</label></td>
                    <td><input type="text" id="formAluno_Numero" size="70" maxlength="255" value="{{$aluno.numero}}" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formAluno_Bairro">Bairro:</label></td>
                    <td><input type="text" id="formAluno_Bairro" size="70" maxlength="255" value="{{$aluno.bairro}}" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formAluno_Cep">CEP:</label></td>
                    <td><input type="text" id="formAluno_Cep" size="70" maxlength="255" value="{{$aluno.cep}}" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formAluno_Cidade">Cidade:</label></td>
                    <td><input type="text" id="formAluno_Cidade" size="70" maxlength="255" value="{{$aluno.cidade}}" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formAluno_UF">UF:</label></td>
                    <td>
                        <select id="formAluno_Uf">
                            <option value="">{{$aluno.uf}}</option>
                        </select>
                    </td>
                </tr>
            </table>
        </fieldset>
    </div>

    <div id="tabs-3">
        <fieldset style="background-color: whitesmoke;">
            <legend>Contato do Aluno</legend>
            <table> 
                <tr>
                    <td><label for="formAluno_Email">Email:</label></td>
                    <td><input type="text" id="formAluno_Email" size="70" maxlength="255" value="{{$aluno.email}}" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formAluno_Telefone1">Telefone Principal:</label></td>
                    <td><input type="text" id="formAluno_Telefone1" size="70" maxlength="255" value="{{$aluno.telefone1}}" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formAluno_Telefone2">Telefone Secundário:</label></td>
                    <td><input type="text" id="formAluno_Telefone2" size="70" maxlength="255" value="{{$aluno.telefone2}}" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formAluno_Escolaridade">Escolaridade:</label></td>
                    <td>
                        <select id="formAluno_Escolaridade">
                            <option value="">{{$aluno.escolaridade}}</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="formAluno_Vinculo">Vínculo:</label></td>
                    <td>
                        <select id="formAluno_Vinculo" class="text ui-widget-content ui-corner-all">
                            <option value="">{{$aluno.nomeFantasia}}</option>
                        </select>
                    </td>
                </tr>
            </table>
        </fieldset>
    </div>
                        
    <div id="tabs-4">
        <fieldset style="background-color: whitesmoke;">
            <legend>Informações de Cadastro do Aluno</legend>
            <table> 
                <tr>
                    <td><label for="formAluno_Status">Status:</label></td>
                    <td><input type="text" id="formAluno_Status" size="70" maxlength="255" value="{{$aluno.status}}" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formAluno_UsuarioResponsavel">Usuário Responsável:</label></td>
                    <td><input type="text" id="formAluno_UsuarioResponsavel" size="70" maxlength="255" value="{{$aluno.usuarioResponsavel}}" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formAluno_DataCadastro">Data de Cadastro:</label></td>
                    <td><input type="text" id="formAluno_DataCadastro" size="70" maxlength="255" value="{{$aluno.dataCadastro}}" readonly=""/></td>
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
        openlink("{{$BASE_PATH}}interno/modulo/aluno/mostrarPesquisa/");
    }
</script>