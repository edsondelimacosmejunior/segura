<script type="text/javascript">
    $(function() {
    $("#tabs_cadastroEmpresa").tabs();
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

<script>$("#statusInformacao").html("Vocé está em: Empresa >> Cadastro de Empresa.");</script>

<div id="tabs_cadastroEmpresa">
    <ul>
        <li><a href="#tabs-1">Informações Principais</a></li>
        <li><a href="#tabs-2">Endereço</a></li>
        <li><a href="#tabs-3">Contato</a></li>
        <li><a href="#tabs-4">Informações Gerais</a></li>
    </ul>

    <div id="tabs-1">
        <fieldset style="background-color: whitesmoke;">
            <legend>Identificação</legend>
            <table> 
                <tr>
                    <td><label for="formEmpresa_NomeFantasia">Nome Fantasia:</label></td>
                    <td><input type="text" id="formEmpresa_NomeFantasia" size="70" maxlength="255"/></td>
                </tr>
                <tr>
                    <td><label for="formEmpresa_RazaoSocial">Razão Social:</label></td>
                    <td><input type="text" id="formEmpresa_RazaoSocial" size="70" maxlength="255"/></td>
                </tr>
                <tr>
                    <td><label for="formEmpresa_Cnpj">CNPJ:</label></td>
                    <td><input type="text" id="formEmpresa_Cnpj" size="70" maxlength="18" onKeyDown="Mascara(this,Cnpj);" onKeyPress="Mascara(this,Cnpj);" onKeyUp="Mascara(this,Cnpj);"/></td>
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
                    <td><input type="text" id="formEmpresa_Rua" size="70" maxlength="255"/></td>
                </tr>
                <tr>
                    <td><label for="formEmpresa_Numero">Número:</label></td>
                    <td><input type="text" id="formEmpresa_Numero" size="70" maxlength="10" onKeyDown="Mascara(this,Inteiro);" onKeyPress="Mascara(this,Inteiro);" onKeyUp="Mascara(this,Inteiro);"/></td>
                </tr>
                <tr>
                    <td><label for="formEmpresa_Bairro">Bairro:</label></td>
                    <td><input type="text" id="formEmpresa_Bairro" size="70" maxlength="255"/></td>
                </tr>
                <tr>
                    <td><label for="formEmpresa_Cep">CEP:</label></td>
                    <td><input type="text" id="formEmpresa_Cep" size="70" maxlength="9" onKeyDown="Mascara(this,Cep);" onKeyPress="Mascara(this,Cep);" onKeyUp="Mascara(this,Cep);"/></td>
                </tr>
                <tr>
                    <td><label for="formEmpresa_Cidade">Cidade:</label></td>
                    <td><input type="text" id="formEmpresa_Cidade" size="70" maxlength="255"/></td>
                </tr>
                <tr>
                    <td><label for="formEmpresa_UF">UF:</label></td>
                    <td>
                        <select id="formEmpresa_Uf">
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
            <legend>Informações sobre Contato da Empresa</legend>
            <table> 
                <tr>
                    <td><label for="formEmpresa_Contato">Nome do Contato Comercial:</label></td>
                    <td><input type="text" id="formEmpresa_Contato" size="70" maxlength="255"/></td>
                </tr>
                <tr>
                    <td><label for="formEmpresa_Email">Email:</label></td>
                    <td><input type="text" id="formEmpresa_Email" size="70" maxlength="255"/></td>
                </tr>
                <tr>
                    <td><label for="formEmpresa_Telefone1">Telefone Principal:</label></td>
                    <td><input type="text" id="formEmpresa_Telefone1" size="70" maxlength="14" onKeyDown="Mascara(this,Telefone);" onKeyPress="Mascara(this,Telefone);" onKeyUp="Mascara(this,Telefone);"/></td>
                </tr>
                <tr>
                    <td><label for="formEmpresa_Telefone2">Telefone Secundário:</label></td>
                    <td><input type="text" id="formEmpresa_Telefone2" size="70" maxlength="14" onKeyDown="Mascara(this,Telefone);" onKeyPress="Mascara(this,Telefone);" onKeyUp="Mascara(this,Telefone);"/></td>
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
                    <td><input type="text" id="formEmpresa_InscricaoEstadual" size="70" maxlength="255"/></td>
                </tr>
                <tr>
                    <td><label for="formEmpresa_InscricaoMunicipal">Incrição Municipal:</label></td>
                    <td><input type="text" id="formEmpresa_InscricaoMunicipal" size="70" maxlength="255"/></td>
                </tr>
                <tr>
                    <td><label for="formEmpresa_Observacao">Observações:</label></td>
                    <td><input type="text" id="formEmpresa_Observacao" size="70" maxlength="255"/></td>
                </tr>           
            </table>
        </fieldset>
    </div>    
    <br><br>
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
        openlink("{{$BASE_PATH}}interno/modulo/empresa/listarEmpresas/");
    }
    
    function limpar(){
        $("#formEmpresa_NomeFantasia",selected_tab()).val("");
        $("#formEmpresa_RazaoSocial",selected_tab()).val("");
        $("#formEmpresa_Cnpj",selected_tab()).val("");
        $("#formEmpresa_Rua",selected_tab()).val("");
        $("#formEmpresa_Numero",selected_tab()).val("");
        $("#formEmpresa_Bairro",selected_tab()).val("");
        $("#formEmpresa_Cep",selected_tab()).val("");
        $("#formEmpresa_Cidade",selected_tab()).val("");
        $("#formEmpresa_Uf",selected_tab()).val("");
        $("#formEmpresa_Contato",selected_tab()).val("");
        $("#formEmpresa_Telefone1",selected_tab()).val("");
        $("#formEmpresa_Telefone2",selected_tab()).val("");
        $("#formEmpresa_Email",selected_tab()).val("");
        $("#formEmpresa_InscricaoEstadual",selected_tab()).val("");
        $("#formEmpresa_InscricaoMunicipal",selected_tab()).val("");
        $("#formEmpresa_Observacao",selected_tab()).val("");       
    }
    
    // Verifica campos obrigatórios preenchidos e envia os dados preenchidos para a respectiva classe de controle em php
    function cadastrar(){
        campos = new Array(5);
        contador = 0;
  
        if($("#formEmpresa_NomeFantasia").val()==""){
            campos[contador]="formEmpresa_NomeFantasia";
            contador=contador+1;
        }
        
        if($("#formEmpresa_RazaoSocial").val()==""){
            campos[contador]="formEmpresa_RazaoSocial";
            contador=contador+1;
        }
        
        if($("#formEmpresa_Cnpj").val()==""){
            campos[contador]="formEmpresa_Cnpj";
            contador=contador+1;
        }
        
        if($("#formEmpresa_Contato").val()==""){
            campos[contador]="formEmpresa_Contato";
            contador=contador+1;
        }
        
        if($("#formEmpresa_Telefone1").val()==""){
            campos[contador]="formEmpresa_Telefone1";
            contador=contador+1;
        }
        if($("#formEmpresa_Email").val()!=""){
            if(!Email($("#formEmpresa_Email").val())){
                campos[contador]="#formEmpresa_Email";
                contador=contador+1;
            }
        }
        if(contador == 0){
      
      $.ajax({
                url: "{{$BASE_PATH}}interno/modulo/empresa/cadastrar",
                data: {
                    "nomeFantasia": $("#formEmpresa_NomeFantasia").val(),
                    "razaoSocial": $("#formEmpresa_RazaoSocial").val(),
                    "cnpj": $("#formEmpresa_Cnpj").val(),
                    "rua": $("#formEmpresa_Rua").val(),
                    "numero": $("#formEmpresa_Numero").val(),
                    "bairro": $("#formEmpresa_Bairro").val(),
                    "cep": $("#formEmpresa_Cep").val(),
                    "cidade": $("#formEmpresa_Cidade").val(),
                    "uf": $("#formEmpresa_Uf").val(),
                    "contato": $("#formEmpresa_Contato").val(),
                    "telefone1": $("#formEmpresa_Telefone1").val(),
                    "telefone2": $("#formEmpresa_Telefone2").val(),
                    "email": $("#formEmpresa_Email").val(),
                    "inscricaoEstadual": $("#formEmpresa_InscricaoEstadual").val(),
                    "inscricaoMunicipal": $("#formEmpresa_InscricaoMunicipal").val(),
                    "observacao": $("#formEmpresa_Observacao").val()                    
                },
                cache: false,
                success: function(data){
                    respostaDoControlador = eval(data);
                    mensagem = respostaDoControlador.message;
            
                    if(mensagem == "Empresa cadastrada com sucesso."){
                    
                        $().message(respostaDoControlador.message);
                        //openlink("{{$BASE_PATH}}interno/modulo/empresa/listarEmpresas/");
                    }
                },
                error: function(data){
                    respostaDoControlador = eval(data);
                    $().message(respostaDoControlador.message);
                    //openlink("{{$BASE_PATH}}interno/modulo/empresa/listarEmpresas/");
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