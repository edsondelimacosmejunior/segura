<?php /* Smarty version 2.6.18, created on 29-01-2015 18:30:53
         compiled from pages/interno/modulo/instrutor/atualizacao.tpl */ ?>
<script type="text/javascript">
    $(function() {
    $("#tabs_atualizacaoInstrutor").tabs();
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

<script>
 
    /*Função Pai de Mascaras*/
    function Mascara(o,f){
        v_obj=o
        v_fun=f
        setTimeout("execmascara()",1)
    }

    /*Função que Executa os objetos*/
    function execmascara(){
        v_obj.value=v_fun(v_obj.value)
    }

    /*Função que permite apenas numeros*/
    function Inteiro(v){
        return v.replace(/\D/g,"")
    }

    function Rg(v){
        v=v.replace(/\D/g,"")
        //v=v.replace(/(\d{3})(\d)/,"$1.$2")
        //v=v.replace(/(\d{3})(\d)/,"$1.$2")
        return v;
    }

    function Cpf(v){
        v=v.replace(/\D/g,"")
        v=v.replace(/(\d{3})(\d)/,"$1.$2")
        v=v.replace(/(\d{3})(\d)/,"$1.$2")
        v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
        return v
    }
    
    /*Função que padroniza telefone (11) 4184-1241*/
    function Telefone(v){
        v=v.replace(/\D/g,"")
        v=v.replace(/^(\d\d)(\d)/g,"($1) $2")
        v=v.replace(/(\d{4})(\d)/,"$1-$2")
    return v
    }

    /*Função que padroniza CEP*/
    function Cep(v){
        v=v.replace(/\D/g,"")
        v=v.replace(/^(\d{5})(\d)/,"$1-$2")
        return v
    }

    /*Função que padroniza CNPJ*/
    function Cnpj(v){
        v=v.replace(/\D/g,"")
        v=v.replace(/^(\d{2})(\d)/,"$1.$2")
        v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")
        v=v.replace(/\.(\d{3})(\d)/,".$1/$2")
        v=v.replace(/(\d{4})(\d)/,"$1-$2")
        return v
    }

    /*Função que padroniza DATA*/
    function Data(v){
        v=v.replace(/\D/g,"")
        v=v.replace(/(\d{2})(\d)/,"$1/$2")
        v=v.replace(/(\d{2})(\d)/,"$1/$2")
        return v;
    }

    function VerificaData(digData){
        var bissexto = 0;
        var data = digData;
        var tam = data.length;
        if (tam == 10){
            var dia = data.substr(0,2)
            var mes = data.substr(3,2)
            var ano = data.substr(6,4)
            if ((ano > 1900)||(ano < 2100)){
                switch (mes){
                    case '01':
                    case '03':
                    case '05':
                    case '07':
                    case '08':
                    case '10':
                    case '12':
                if  (dia <= 31){
                    return true;
                }
                break

                case '04':
                case '06':
                case '09':
                case '11':
                if  (dia <= 30){
                    return true;
                }
                break
                case '02':
                /* Validando ano Bissexto / fevereiro / dia */
                if ((ano % 4 == 0) || (ano % 100 == 0) || (ano % 400 == 0)){
                    bissexto = 1;
                }
                if ((bissexto == 1) && (dia <= 29)){
                    return true;
                }
                if ((bissexto != 1) && (dia <= 28)){
                    return true;
                }
                break
                }
            }
        }
        return false;
    }

    function Email(email){
        er = /^[a-zA-Z0-9][a-zA-Z0-9\._-]+@([a-zA-Z0-9\._-]+\.)[a-zA-Z-0-9]{2}/;

        if(er.exec(email)){
            return true;
        } else {
            return false;
        }
    }

</script>

<script>$("#statusInformacao").html("Vocé está em: Instrutor >> Listar Instrutores >> Atualizar Cadastro de Instrutor.");</script>

<div id="tabs_atualizacaoInstrutor">
    <ul>
        <li><a href="#tabs-1">Dados Pessoais</a></li>
        <li><a href="#tabs-2">Endereço</a></li>
        <li><a href="#tabs-3">Dados Profissionais</a></li>
    </ul>

    <div id="tabs-1">
        <fieldset style="background-color: whitesmoke;">
            <legend>Identificação</legend>
            <table> 
                <tr>
                    <td><label for="formInstrutor_Nome">Nome:</label></td>
                    <td><input type="text" id="formInstrutor_Nome" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['instrutor']['nome']; ?>
"/></td>
                </tr>
                <tr>
                    <td><label for="formInstrutor_Sexo">Sexo:</label></td>
                    <td>
                        <select id="formInstrutor_Sexo">
                            <option value="<?php echo $this->_tpl_vars['instrutor']['sexo']; ?>
"><?php echo $this->_tpl_vars['instrutor']['sexo']; ?>
</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Feminino">Feminino</option>
                            <option value="Outro">Outro</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="formInstrutor_Cpf">CPF:</label></td>
                    <td><input type="text" id="formInstrutor_Cpf" size="70" maxlength="14" onKeyDown="Mascara(this,Cpf);" onKeyPress="Mascara(this,Cpf);" onKeyUp="Mascara(this,Cpf);" value="<?php echo $this->_tpl_vars['instrutor']['cpf']; ?>
"/></td>
                </tr>
                <tr>
                    <td><label for="formInstrutor_Rg">RG:</label></td>
                    <td><input type="text" id="formInstrutor_Rg" size="70" maxlength="45" onKeyDown="Mascara(this,Inteiro);" onKeyPress="Mascara(this,Inteiro);" onKeyUp="Mascara(this,Inteiro);" value="<?php echo $this->_tpl_vars['instrutor']['rg']; ?>
"/></td>
                </tr>
                <tr>
                    <td><label for="formInstrutor_DataNascimento">Data de Nascimento:</label></td>
                    <td><input type="text" id="formInstrutor_DataNascimento" size="70" maxlength="10" onKeyDown="Mascara(this,Data);" onKeyPress="Mascara(this,Data);" onKeyUp="Mascara(this,Data);" value="<?php echo $this->_tpl_vars['instrutor']['dataNascimento']; ?>
"/></td>
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
"/></td>
                </tr>
                <tr>
                    <td><label for="formInstrutor_Numero">Número:</label></td>
                    <td><input type="text" id="formInstrutor_Numero" size="70" maxlength="10" onKeyDown="Mascara(this,Inteiro);" onKeyPress="Mascara(this,Inteiro);" onKeyUp="Mascara(this,Inteiro);" value="<?php echo $this->_tpl_vars['instrutor']['numero']; ?>
"/></td>
                </tr>
                <tr>
                    <td><label for="formInstrutor_Bairro">Bairro:</label></td>
                    <td><input type="text" id="formInstrutor_Bairro" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['instrutor']['bairro']; ?>
"/></td>
                </tr>
                <tr>
                    <td><label for="formInstrutor_Cep">CEP:</label></td>
                    <td><input type="text" id="formInstrutor_Cep" size="70" maxlength="9" onKeyDown="Mascara(this,Cep);" onKeyPress="Mascara(this,Cep);" onKeyUp="Mascara(this,Cep);" value="<?php echo $this->_tpl_vars['instrutor']['cep']; ?>
"/></td>
                </tr>
                <tr>
                    <td><label for="formInstrutor_Cidade">Cidade:</label></td>
                    <td><input type="text" id="formInstrutor_Cidade" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['instrutor']['cidade']; ?>
"/></td>
                </tr>
                <tr>
                    <td><label for="formInstrutor_Uf">UF:</label></td>
                    <td>
                        <select id="formInstrutor_Uf">
                            <option value="<?php echo $this->_tpl_vars['instrutor']['uf']; ?>
"><?php echo $this->_tpl_vars['instrutor']['uf']; ?>
</option>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
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
"/></td>
                </tr>
                <tr>
                    <td><label for="formInstrutor_Telefone1">Telefone Principal:</label></td>
                    <td><input type="text" id="formInstrutor_Telefone1" size="70" maxlength="14" onKeyDown="Mascara(this,Telefone);" onKeyPress="Mascara(this,Telefone);" onKeyUp="Mascara(this,Telefone);" value="<?php echo $this->_tpl_vars['instrutor']['telefone1']; ?>
"/></td>
                </tr>
                <tr>
                    <td><label for="formInstrutor_Telefone2">Telefone Secundário:</label></td>
                    <td><input type="text" id="formInstrutor_Telefone2" size="70" maxlength="14" onKeyDown="Mascara(this,Telefone);" onKeyPress="Mascara(this,Telefone);" onKeyUp="Mascara(this,Telefone);" value="<?php echo $this->_tpl_vars['instrutor']['telefone2']; ?>
"/></td>
                </tr>
                <tr>
                    <td><label for="formInstrutor_Escolaridade">Escolaridade:</label></td>
                    <td>
                        <select id="formInstrutor_Escolaridade">
                            <option value="<?php echo $this->_tpl_vars['instrutor']['escolaridade']; ?>
"><?php echo $this->_tpl_vars['instrutor']['escolaridade']; ?>
</option>
                            <option value="Analfabeto">Analfabeto</option>
                            <option value="Ensino Fundamental Incompleto">Ensino Fundamental Incompleto</option>
                            <option value="Ensino Fundamental Completo">Ensino Fundamental Completo</option>
                            <option value="Ensino Médio Incompleto">Ensino Médio Incompleto</option>
                            <option value="Ensino Médio Completo">Ensino Médio Completo</option>
                            <option value="Curso Técnico Incompleto">Técnico Incompleto</option>
                            <option value="Curso Técnico Completo">Técnico Completo</option>
                            <option value="Curso Superior Incompleto">Superior Incompleto</option>
                            <option value="Curso Superior Completo">Superior Completo</option>
                            <option value="Curso Superior com Especialização">Superior Completo com Especialização</option>
                            <option value="Curso Superior com Mestrado">Superior Completo com Mestrado</option>
                            <option value="Outro">Outro</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="formInstrutor_Formacao">Formação:</label></td>
                    <td><input type="text" id="formInstrutor_Formacao" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['instrutor']['formacao']; ?>
"/></td>
                </tr>
                <tr>
                    <td><label for="formInstrutor_NumeroRegistro">Número do Registro:</label></td>
                    <td><input type="text" id="formInstrutor_NumeroRegistro" size="70" maxlength="255" value="<?php echo $this->_tpl_vars['instrutor']['numeroRegistro']; ?>
"/></td>
                </tr>
            </table>
        </fieldset>
    </div>
</div>
<table>
    <tr>
        <td><button id="<?php echo $this->_tpl_vars['instrutor']['idInstrutor']; ?>
" onclick="atualizar(id)" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all">Atualizar</button></td>
        <td><button onclick="limpar()" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" >Limpar</button></td>
        <td><button onclick="cancelar()" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" >Cancelar</button></td>
    </tr>
</table>

<script>

    function alertaVazio(campos,contador){
        for(i=0;i<contador;i = i+1){
            document.getElementById(campos[i]).style.borderColor = '#FF3300';
            document.getElementById(campos[i]).style.backgroundColor = '#FFEDBF';
        }
    }
       
    function cancelar(){
        openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/instrutor/listarInstrutores/");
    }
    
    function limpar(){
        $("#formInstrutor_Nome",selected_tab()).val("");
        $("#formInstrutor_Sexo",selected_tab()).val("");
        $("#formInstrutor_Cpf",selected_tab()).val("");
        $("#formInstrutor_Rg",selected_tab()).val("");
        $("#formInstrutor_DataNascimento",selected_tab()).val("");
        $("#formInstrutor_Rua",selected_tab()).val("");
        $("#formInstrutor_Numero",selected_tab()).val("");
        $("#formInstrutor_Bairro",selected_tab()).val("");
        $("#formInstrutor_Cep",selected_tab()).val("");
        $("#formInstrutor_Cidade",selected_tab()).val("");
        $("#formInstrutor_Uf",selected_tab()).val("");
        $("#formInstrutor_Email",selected_tab()).val("");
        $("#formInstrutor_Telefone1",selected_tab()).val("");
        $("#formInstrutor_Telefone2",selected_tab()).val("");
        $("#formInstrutor_Escolaridade",selected_tab()).val("");
        $("#formInstrutor_Formacao",selected_tab()).val("");
        $("#formInstrutor_NumeroRegistro",selected_tab()).val("");
    }
    
    // Verifica campos obrigatórios preenchidos e envia os dados preenchidos para a respectiva classe de controle em php
    function atualizar(idInstrutor){
        campos = new Array(5);
        contador = 0;
  
        if($("#formInstrutor_Nome").val()==""){
            campos[contador]="formInstrutor_Nome";
            contador=contador+1;
        }
  
        if($("#formInstrutor_Cpf").val()==""){
            campos[contador]="formInstrutor_Cpf";
            contador = contador+1;
        }
  
        if($("#formInstrutor_Telefone1").val()==""){
            campos[contador]="formInstrutor_Telefone1";
            contador = contador+1;
        }
  
        if($("#formInstrutor_Formacao").val()==""){
            campos[contador]="formInstrutor_Formacao";
            contador=contador+1;
        }
  
        if($("#formInstrutor_DataNascimento").val()!=""){
            if(!VerificaData($("#formInstrutor_DataNascimento").val())){
                campos[contador]="#formInstrutor_DataNascimento";
                contador=contador+1;
            }
        }
  
        if($("#formInstrutor_Email").val()!=""){
            if(!Email($("#formInstrutor_Email").val())){
                campos[contador]="#formInstrutor_Email";
                contador=contador+1;
            }
        }
  
        if(contador == 0){
      
        $.ajax({
                url: "<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/instrutor/atualizar",
                data: {
                    "idInstrutor": idInstrutor,
                    "nome": $("#formInstrutor_Nome").val(),
                    "sexo": $("#formInstrutor_Sexo").val(),
                    "cpf": $("#formInstrutor_Cpf").val(),
                    "rg": $("#formInstrutor_Rg").val(),
                    "dataNascimento": $("#formInstrutor_DataNascimento").val(),
                    "rua": $("#formInstrutor_Rua").val(),
                    "numero": $("#formInstrutor_Numero").val(),
                    "bairro": $("#formInstrutor_Bairro").val(),
                    "cep": $("#formInstrutor_Cep").val(),
                    "cidade": $("#formInstrutor_Cidade").val(),
                    "uf": $("#formInstrutor_Uf").val(),
                    "email": $("#formInstrutor_Email").val(),
                    "telefone1": $("#formInstrutor_Telefone1").val(),
                    "telefone2": $("#formInstrutor_Telefone2").val(),
                    "escolaridade": $("#formInstrutor_Escolaridade").val(),
                    "formacao": $("#formInstrutor_Formacao").val(),
                    "numeroRegistro": $("#formInstrutor_NumeroRegistro").val()
                },
                cache: false,
                success: function(data){
                    respostaDoControlador = eval(data);
                    mensagem = respostaDoControlador.message;
            
                    if(mensagem == "Dados atualizados com sucesso."){
                        $().message(respostaDoControlador.message);
                        openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/instrutor/listarInstrutores/");
                    }
                },
                error: function(data){
                    respostaDoControlador = eval(data);
                    $().message(respostaDoControlador.message);
                    openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/instrutor/listarInstrutores/");
                },
                dataType: "json"
            });
        }
        else{
            $().message("Os campos obrigatórios não foram preenchidos.");
            alertaVazio(campos,contador);
        }
    }
</script>