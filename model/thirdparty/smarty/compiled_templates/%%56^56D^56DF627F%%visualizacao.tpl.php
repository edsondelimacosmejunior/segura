<?php /* Smarty version 2.6.18, created on 03-02-2015 02:24:28
         compiled from pages/interno/modulo/instrutor/visualizacao.tpl */ ?>
<script type="text/javascript">
    $(function() {
    $("#tabs_visualizaInstrutor").tabs();
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
    div#tabs_cadastroInstrutor-contain {
        width: 350px;
        margin: 20px 0;
        font-size: 90.5%;
    }
    div#tabs_cadastroInstrutor-contain table {
        margin: 1em 0;
        border-collapse: collapse;
        width: 100%;
    }
    div#tabs_cadastroInstrutor-contain table td, div#romaneio-contain table th {
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

<script>$("#statusInformacao").html("Vocé está em: Instrutor >> Listar Instrutores >> Visualizar Cadastro de Instrutor.");</script>

<div id="tabs_visualizaInstrutor">
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
                    <td><label for="formInstrutor_Nome">Nome:</label></td>
                    <td><input type="text" id="formInstrutor_Nome" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['instrutor']['nome']; ?>
" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formInstrutor_Sexo">Sexo:</label></td>
                    <td>
                        <select id="formInstrutor_Sexo">
                            <option value="" readonly=""><?php echo $this->_tpl_vars['instrutor']['sexo']; ?>
</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="formInstrutor_Cpf">CPF:</label></td>
                    <td><input type="text" id="formInstrutor_Cpf" size="70" maxlength="14" onKeyDown="Mascara(this,Cpf);" onKeyPress="Mascara(this,Cpf);" onKeyUp="Mascara(this,Cpf);" value="<?php echo $this->_tpl_vars['instrutor']['cpf']; ?>
" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formInstrutor_Rg">RG:</label></td>
                    <td><input type="text" id="formInstrutor_Rg" size="70" maxlength="45" onKeyDown="Mascara(this,Inteiro);" onKeyPress="Mascara(this,Inteiro);" onKeyUp="Mascara(this,Inteiro);" value="<?php echo $this->_tpl_vars['instrutor']['rg']; ?>
" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formInstrutor_DataNascimento">Data de Nascimento:</label></td>
                    <td><input type="text" id="formInstrutor_DataNascimento" size="70" maxlength="10" onKeyDown="Mascara(this,Data);" onKeyPress="Mascara(this,Data);" onKeyUp="Mascara(this,Data);" value="<?php echo $this->_tpl_vars['instrutor']['dataNascimento']; ?>
" readonly=""/></td>
                </tr>
            </table>
        </fieldset>
    </div>

    <div id="tabs-2">
        <fieldset style="background-color: whitesmoke;">
            <legend>Endereço Pessoal do Instrutor</legend>
            <table> 
                <tr>
                    <td><label for="formInstrutor_Rua">Rua:</label></td>
                    <td><input type="text" id="formInstrutor_Rua" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['instrutor']['rua']; ?>
" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formInstrutor_Numero">Número:</label></td>
                    <td><input type="text" id="formInstrutor_Numero" size="70" maxlength="10" onKeyDown="Mascara(this,Inteiro);" onKeyPress="Mascara(this,Inteiro);" onKeyUp="Mascara(this,Inteiro);" value="<?php echo $this->_tpl_vars['instrutor']['numero']; ?>
" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formInstrutor_Bairro">Bairro:</label></td>
                    <td><input type="text" id="formInstrutor_Bairro" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['instrutor']['bairro']; ?>
" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formInstrutor_Cep">CEP:</label></td>
                    <td><input type="text" id="formInstrutor_Cep" size="70" maxlength="9" onKeyDown="Mascara(this,Cep);" onKeyPress="Mascara(this,Cep);" onKeyUp="Mascara(this,Cep);" value="<?php echo $this->_tpl_vars['instrutor']['cep']; ?>
" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formInstrutor_Cidade">Cidade:</label></td>
                    <td><input type="text" id="formInstrutor_Cidade" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['instrutor']['cidade']; ?>
" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formInstrutor_Uf">UF:</label></td>
                    <td>
                        <select id="formInstrutor_Uf">
                            <option value="" readonly=""><?php echo $this->_tpl_vars['instrutor']['uf']; ?>
</option>
                        </select>
                    </td>
                </tr>
            </table>
        </fieldset>
    </div>

    <div id="tabs-3">
        <fieldset style="background-color: whitesmoke;">
            <legend>Contato do Instrutor</legend>
            <table> 
                <tr>
                    <td><label for="formInstrutor_Email">Email:</label></td>
                    <td><input type="text" id="formInstrutor_Email" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['instrutor']['email']; ?>
" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formInstrutor_Telefone1">Telefone Principal:</label></td>
                    <td><input type="text" id="formInstrutor_Telefone1" size="70" maxlength="14" onKeyDown="Mascara(this,Telefone);" onKeyPress="Mascara(this,Telefone);" onKeyUp="Mascara(this,Telefone);" value="<?php echo $this->_tpl_vars['instrutor']['telefone1']; ?>
" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formInstrutor_Telefone2">Telefone Secundário:</label></td>
                    <td><input type="text" id="formInstrutor_Telefone2" size="70" maxlength="14" onKeyDown="Mascara(this,Telefone);" onKeyPress="Mascara(this,Telefone);" onKeyUp="Mascara(this,Telefone);" value="<?php echo $this->_tpl_vars['instrutor']['telefone2']; ?>
" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formInstrutor_Escolaridade">Escolaridade:</label></td>
                    <td>
                        <select id="formInstrutor_Escolaridade">
                            <option value=""><?php echo $this->_tpl_vars['instrutor']['escolaridade']; ?>
</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="formInstrutor_Formacao">Formação:</label></td>
                    <td><input type="text" id="formInstrutor_Formacao" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['instrutor']['formacao']; ?>
" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formInstrutor_NumeroRegistro">Número do Registro:</label></td>
                    <td><input type="text" id="formInstrutor_NumeroRegistro" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['instrutor']['numeroRegistro']; ?>
" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formInstrutor_PatchAssinatura">Número do Registro:</label></td>
                    <td><input type="text" id="formInstrutor_PatchAssinatura" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['instrutor']['patchAssinatura']; ?>
" readonly=""/></td>
                </tr>
            </table>
        </fieldset>
    </div>
    
    <div id="tabs-4">
        <fieldset style="background-color: whitesmoke;">
            <legend>Informações de Cadastro do Instrutor</legend>
            <table> 
                <tr>
                    <td><label for="formInstrutor_Status">Status:</label></td>
                    <td><input type="text" id="formInstrutor_Status" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['instrutor']['status']; ?>
" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formInstrutor_UsuarioResponsavel">Usuário Responsável:</label></td>
                    <td><input type="text" id="formInstrutor_UsuarioResponsavel" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['instrutor']['usuarioResponsavel']; ?>
" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formInstrutor_DataCadastro">Data de Cadastro:</label></td>
                    <td><input type="text" id="formInstrutor_DataCadastro" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['instrutor']['dataCadastro']; ?>
" readonly=""/></td>
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
        openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/instrutor/listarInstrutores/");
    }
       
</script>