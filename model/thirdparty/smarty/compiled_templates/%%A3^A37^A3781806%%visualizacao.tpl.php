<?php /* Smarty version 2.6.18, created on 27-01-2015 21:11:14
         compiled from pages/interno/modulo/empresa/visualizacao.tpl */ ?>
<script type="text/javascript">
    $(function() {
    $("#tabs_visualizaEmpresa").tabs();
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
    div#tabs_cadastroEmpresa-contain {
        width: 350px;
        margin: 20px 0;
        font-size: 90.5%;
    }
    div#tabs_cadastroEmpresa-contain table {
        margin: 1em 0;
        border-collapse: collapse;
        width: 100%;
    }
    div#tabs_cadastroEmpresa-contain table td, div#romaneio-contain table th {
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

<script>$("#statusInformacao").html("Vocé está em: Empresa >> Listar Empresas >> Visualizar Cadastro de Empresa.");</script>

<div id="tabs_visualizaEmpresa">
    <ul>
        <li><a href="#tabs-1">Informações Principais</a></li>
        <li><a href="#tabs-2">Endereço</a></li>
        <li><a href="#tabs-3">Contato</a></li>
        <li><a href="#tabs-4">Informações Gerais</a></li>
        <li><a href="#tabs-5">Sobre o Cadastro</a></li>
    </ul>

    <div id="tabs-1">
        <fieldset style="background-color: whitesmoke;">
            <legend>Identificação</legend>
            <table> 
                <tr>
                    <td><label for="formEmpresa_NomeFantasia">Nome Fantasia:</label></td>
                    <td><input type="text" id="formEmpresa_NomeFantasia" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['empresa']['nomeFantasia']; ?>
" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formEmpresa_RazaoSocial">Razão Social:</label></td>
                    <td><input type="text" id="formEmpresa_RazaoSocial" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['empresa']['razaoSocial']; ?>
" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formEmpresa_Cnpj">CNPJ:</label></td>
                    <td><input type="text" id="formEmpresa_Cnpj" size="70" maxlength="18" onKeyDown="Mascara(this,Cnpj);" onKeyPress="Mascara(this,Cnpj);" onKeyUp="Mascara(this,Cnpj);" value="<?php echo $this->_tpl_vars['empresa']['cnpj']; ?>
" readonly=""/></td>
                </tr>
            </table>
        </fieldset>
    </div>

    <div id="tabs-2">
        <fieldset style="background-color: whitesmoke;">
            <legend>Endereço da Empresa</legend>
            <table> 
                <tr>
                    <td><label for="formEmpresa_Rua">Rua:</label></td>
                    <td><input type="text" id="formEmpresa_Rua" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['empresa']['rua']; ?>
" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formEmpresa_Numero">Número:</label></td>
                    <td><input type="text" id="formEmpresa_Numero" size="70" maxlength="10" onKeyDown="Mascara(this,Inteiro);" onKeyPress="Mascara(this,Inteiro);" onKeyUp="Mascara(this,Inteiro);" value="<?php echo $this->_tpl_vars['empresa']['numero']; ?>
" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formEmpresa_Bairro">Bairro:</label></td>
                    <td><input type="text" id="formEmpresa_Bairro" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['empresa']['bairro']; ?>
" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formEmpresa_Cep">CEP:</label></td>
                    <td><input type="text" id="formEmpresa_Cep" size="70" maxlength="9" onKeyDown="Mascara(this,Cep);" onKeyPress="Mascara(this,Cep);" onKeyUp="Mascara(this,Cep);" value="<?php echo $this->_tpl_vars['empresa']['cep']; ?>
" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formEmpresa_Cidade">Cidade:</label></td>
                    <td><input type="text" id="formEmpresa_Cidade" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['empresa']['cidade']; ?>
" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formEmpresa_UF">UF:</label></td>
                    <td>
                        <select id="formEmpresa_Uf">
                            <option value="" readonly=""><?php echo $this->_tpl_vars['empresa']['uf']; ?>
</option>
                        </select>
                    </td>
                </tr>
            </table>
        </fieldset>
    </div>

    <div id="tabs-3">
        <fieldset style="background-color: whitesmoke;">
            <legend>Informações sobre Contato da Empresa</legend>
            <table> 
                <tr>
                    <td><label for="formEmpresa_Contato">Nome do Contato Comercial:</label></td>
                    <td><input type="text" id="formEmpresa_Contato" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['empresa']['contato']; ?>
" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formEmpresa_Email">Email:</label></td>
                    <td><input type="text" id="formEmpresa_Email" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['empresa']['email']; ?>
" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formEmpresa_Telefone1">Telefone Principal:</label></td>
                    <td><input type="text" id="formEmpresa_Telefone1" size="70" maxlength="14" onKeyDown="Mascara(this,Telefone);" onKeyPress="Mascara(this,Telefone);" onKeyUp="Mascara(this,Telefone);" value="<?php echo $this->_tpl_vars['empresa']['telefone1']; ?>
" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formEmpresa_Telefone2">Telefone Secundário:</label></td>
                    <td><input type="text" id="formEmpresa_Telefone2" size="70" maxlength="14" onKeyDown="Mascara(this,Telefone);" onKeyPress="Mascara(this,Telefone);" onKeyUp="Mascara(this,Telefone);" value="<?php echo $this->_tpl_vars['empresa']['telefone2']; ?>
" readonly=""/></td>
                </tr>
            </table>
        </fieldset>
    </div>

    <div id="tabs-4">
        <fieldset style="background-color: whitesmoke;">
            <legend>Informações Adicionais</legend>
            <table> 
                <tr>
                    <td><label for="formEmpresa_InscricaoEstadual">Incrição Estadual:</label></td>
                    <td><input type="text" id="formEmpresa_InscricaoEstadual" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['empresa']['inscricaoEstadual']; ?>
" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formEmpresa_InscricaoMunicipal">Incrição Municipal:</label></td>
                    <td><input type="text" id="formEmpresa_InscricaoMunicipal" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['empresa']['inscricaoMunicipal']; ?>
" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formEmpresa_Observacao">Observações:</label></td>
                    <td><input type="text" id="formEmpresa_Observacao" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['empresa']['observacao']; ?>
" readonly=""/></td>
                </tr>           
            </table>
        </fieldset>
    </div>    
    
    <div id="tabs-5">
        <fieldset style="background-color: whitesmoke;">
            <legend>Informações de Cadastro da Empresa</legend>
            <table> 
                <tr>
                    <td><label for="formEmpresa_Status">Status:</label></td>
                    <td><input type="text" id="formEmpresa_Status" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['empresa']['status']; ?>
" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formEmpresa_UsuarioResponsavel">Usuário Responsável:</label></td>
                    <td><input type="text" id="formEmpresa_UsuarioResponsavel" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['empresa']['usuarioResponsavel']; ?>
" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formEmpresa_DataCadastro">Data de Cadastro:</label></td>
                    <td><input type="text" id="formEmpresa_DataCadastro" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['empresa']['dataCadastro']; ?>
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
interno/modulo/empresa/listarEmpresas/");
    }
        
</script>