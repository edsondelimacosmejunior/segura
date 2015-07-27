<?php /* Smarty version 2.6.18, created on 09-07-2015 10:05:25
         compiled from pages/interno/modulo/aluno/cadastro.tpl */ ?>
<script type="text/javascript">
    $(function() {
    $("#tabs_cadastroAluno").tabs();
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

<script>$("#statusInformacao").html("Vocé está em: Aluno >> Cadastro de Aluno.");</script>

<div id="tabs_cadastroAluno">
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
                    <td><label for="formAluno_Nome">Nome:</label></td>
                    <td><input type="text" id="formAluno_Nome" size="70" maxlength="255"/></td>
                </tr>
                <tr>
                    <td><label for="formAluno_Sexo">Sexo:</label></td>
                    <td>
                        <select id="formAluno_Sexo">
                            <option value="">Selecione o Sexo</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Feminino">Feminino</option>
                            <option value="Outro">Outro</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="formAluno_Cpf">CPF:</label></td>
                    <td><input type="text" id="formAluno_Cpf" size="70" maxlength="14" onKeyDown="Mascara(this,Cpf);" onKeyPress="Mascara(this,Cpf);" onKeyUp="Mascara(this,Cpf);"/></td>
                </tr>
                <tr>
                    <td><label for="formAluno_Matricula">Matrícula:</label></td>
                    <td><input type="text" id="formAluno_Matricula" size="70" maxlength="7" onKeyDown="Mascara(this,Inteiro);" onKeyPress="Mascara(this,Inteiro);" onKeyUp="Mascara(this,Inteiro);"/></td>
                </tr>
                <tr>
                    <td><label for="formAluno_Rg">RG:</label></td>
                    <td><input type="text" id="formAluno_Rg" size="70" maxlength="45" onKeyDown="Mascara(this,Inteiro);" onKeyPress="Mascara(this,Inteiro);" onKeyUp="Mascara(this,Inteiro);"/></td>
                </tr>
                <tr>
                    <td><label for="formAluno_DataNascimento">Data de Nascimento:</label></td>
                    <td><input type="text" id="formAluno_DataNascimento" size="70" maxlength="10" onKeyDown="Mascara(this,Data);" onKeyPress="Mascara(this,Data);" onKeyUp="Mascara(this,Data);"/></td>
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
                    <td><input type="text" id="formAluno_Rua" size="70" maxlength="255"/></td>
                </tr>
                <tr>
                    <td><label for="formAluno_Numero">Número:</label></td>
                    <td><input type="text" id="formAluno_Numero" size="70" maxlength="255" onKeyDown="Mascara(this,Inteiro);" onKeyPress="Mascara(this,Inteiro);" onKeyUp="Mascara(this,Inteiro);"/></td>
                </tr>
                <tr>
                    <td><label for="formAluno_Bairro">Bairro:</label></td>
                    <td><input type="text" id="formAluno_Bairro" size="70" maxlength="255"/></td>
                </tr>
                <tr>
                    <td><label for="formAluno_Cep">CEP:</label></td>
                    <td><input type="text" id="formAluno_Cep" size="70" maxlength="9" onKeyDown="Mascara(this,Cep);" onKeyPress="Mascara(this,Cep);" onKeyUp="Mascara(this,Cep);"/></td>
                </tr>
                <tr>
                    <td><label for="formAluno_Cidade">Cidade:</label></td>
                    <td><input type="text" id="formAluno_Cidade" size="70" maxlength="255"/></td>
                </tr>
                <tr>
                    <td><label for="formAluno_UF">UF:</label></td>
                    <td>
                        <select id="formAluno_Uf">
                            <option value="">Selecione o Estado</option>
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
            <legend>Contato do Aluno</legend>
            <table> 
                <tr>
                    <td><label for="formAluno_Email">Email:</label></td>
                    <td><input type="text" id="formAluno_Email" size="70" maxlength="255"/></td>
                </tr>
                <tr>
                    <td><label for="formAluno_Telefone1">Telefone Principal:</label></td>
                    <td><input type="text" id="formAluno_Telefone1" size="70" maxlength="14" onKeyDown="Mascara(this,Telefone);" onKeyPress="Mascara(this,Telefone);" onKeyUp="Mascara(this,Telefone);"/></td>
                </tr>
                <tr>
                    <td><label for="formAluno_Telefone2">Telefone Secundário:</label></td>
                    <td><input type="text" id="formAluno_Telefone2" size="70" maxlength="14" onKeyDown="Mascara(this,Telefone);" onKeyPress="Mascara(this,Telefone);" onKeyUp="Mascara(this,Telefone);"/></td>
                </tr>
                <tr>
                    <td><label for="formAluno_Escolaridade">Escolaridade:</label></td>
                    <td>
                        <select id="formAluno_Escolaridade">
                            <option value="">Selecione a Escolaridade</option>
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
                    <td><label for="formAluno_Vinculo">Vínculo:</label></td>
                    <td>
                        <select id="formAluno_Vinculo" class="text ui-widget-content ui-corner-all">
                            <option value="">Selecione o Vínculo</option>
                            <option value="1">Particular</option>
                            <?php $_from = $this->_tpl_vars['empresas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['empresas']):
?>
                            <option value='<?php echo $this->_tpl_vars['empresas']['idEmpresa']; ?>
'><?php echo $this->_tpl_vars['empresas']['nomeFantasia']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                        </select>
                    </td>
                </tr>
            </table>
        </fieldset>
    </div>
</div>

<table>
    <tr>
        <td><button onclick="cadastrar()" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" >Cadastrar</button></td>
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
interno/modulo/aluno/mostrarPesquisa/");
    }
    
    function limpar(){
        $("#formAluno_Nome",selected_tab()).val("");
        $("#formAluno_Sexo",selected_tab()).val("");
        $("#formAluno_Cpf",selected_tab()).val("");
        $("#formAluno_Matricula",selected_tab()).val("");        
        $("#formAluno_Rg",selected_tab()).val("");
        $("#formAluno_DataNascimento",selected_tab()).val("");
        $("#formAluno_Rua",selected_tab()).val("");
        $("#formAluno_Numero",selected_tab()).val("");
        $("#formAluno_Bairro",selected_tab()).val("");
        $("#formAluno_Cep",selected_tab()).val("");
        $("#formAluno_Cidade",selected_tab()).val("");
        $("#formAluno_Uf",selected_tab()).val("");
        $("#formAluno_Email",selected_tab()).val("");
        $("#formAluno_Telefone1",selected_tab()).val("");
        $("#formAluno_Telefone2",selected_tab()).val("");
        $("#formAluno_Escolaridade",selected_tab()).val("");
        $("#formAluno_Vinculo",selected_tab()).val("");
    }
    
    // Verifica campos obrigatórios preenchidos e envia os dados preenchidos para a respectiva classe de controle em php
    function cadastrar(){
        campos = new Array(5);
        contador = 0;
  
        if($("#formAluno_Nome").val()==""){
            campos[contador]="formAluno_Nome";
            contador=contador+1;
        }
/*  
        if($("#formAluno_Cpf").val()==""){
            campos[contador]="formAluno_Cpf";
            contador = contador+1;
        }
  
        if($("#formAluno_Telefone1").val()==""){
            campos[contador]="formAluno_Telefone1";
            contador = contador+1;
        }
  
        if($("#formAluno_Vinculo").val()==""){
            campos[contador]="formAluno_Vinculo";
            contador=contador+1;
        }
*/  
        if($("#formAluno_DataNascimento").val()!=""){
            if(!VerificaData($("#formAluno_DataNascimento").val())){
                campos[contador]="#formAluno_DataNascimento";
                contador=contador+1;
            }
        }
  
        if($("#formAluno_Email").val()!=""){
            if(!Email($("#formAluno_Email").val())){
                campos[contador]="#formAluno_Email";
                contador=contador+1;
            }
        }
  
        if(contador == 0){
      
      $.ajax({
                url: "<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/aluno/cadastrar",
                data: {
                    "nome": $("#formAluno_Nome").val(),
                    "sexo": $("#formAluno_Sexo").val(),
                    "cpf": $("#formAluno_Cpf").val(),
                    "matricula": $("#formAluno_Matricula").val(),                    
                    "rg": $("#formAluno_Rg").val(),
                    "dataNascimento": $("#formAluno_DataNascimento").val(),
                    "rua": $("#formAluno_Rua").val(),
                    "numero": $("#formAluno_Numero").val(),
                    "bairro": $("#formAluno_Bairro").val(),
                    "cep": $("#formAluno_Cep").val(),
                    "cidade": $("#formAluno_Cidade").val(),
                    "uf": $("#formAluno_Uf").val(),
                    "email": $("#formAluno_Email").val(),
                    "telefone1": $("#formAluno_Telefone1").val(),
                    "telefone2": $("#formAluno_Telefone2").val(),
                    "escolaridade": $("#formAluno_Escolaridade").val(),
                    "vinculo": $("#formAluno_Vinculo").val()
                },
                cache: false,
                success: function(data){
                    respostaDoControlador = eval(data);
                    mensagem = respostaDoControlador.message;
            
                    if(mensagem == "Aluno cadastrado com sucesso."){
                        $().message(respostaDoControlador.message);
                        //openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/aluno/listarAlunos/");
                    }
                    
                    else if(mensagem == "CPF já cadastrado."){
                        $().message(respostaDoControlador.message);
                    }
                },
                error: function(data){
                    respostaDoControlador = eval(data);
                    $().message(respostaDoControlador.message);
                    //openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/aluno/listarAlunos/");
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