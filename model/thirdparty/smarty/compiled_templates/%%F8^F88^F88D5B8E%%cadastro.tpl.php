<?php /* Smarty version 2.6.18, created on 03-03-2015 14:13:18
         compiled from pages/interno/modulo/usuario/cadastro.tpl */ ?>
<script type="text/javascript">
    $(function() {
    $("#tabs_cadastroUsuario").tabs();
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

    function Email(email){
        er = /^[a-zA-Z0-9][a-zA-Z0-9\._-]+@([a-zA-Z0-9\._-]+\.)[a-zA-Z-0-9]{2}/;

        if(er.exec(email)){
            return true;
        } else {
            return false;
        }
    }
</script>

<script>$("#statusInformacao").html("Vocé está em: Usuário >> Cadastro de Usuário.");</script>

<div id="tabs_cadastroUsuario">
    <ul>
        <li><a href="#tabs-1">Dados Pessoais</a></li>
    </ul>

    <div id="tabs-1">
        <fieldset style="background-color: whitesmoke;">
            <legend>Identificação</legend>
            <table> 
                <tr>
                    <td><label for="formUsuario_Nome">Nome:</label></td>
                    <td><input type="text" id="formUsuario_Nome" size="70" maxlength="255"/></td>
                </tr>
                <tr>
                    <td><label for="formUsuario_Login">Login:</label></td>
                    <td><input type="text" id="formUsuario_Login" size="70" maxlength="255"/></td>
                </tr>
                <tr>
                    <td><label for="formUsuario_Senha">Senha:</label></td>
                    <td><input type="password" id="formUsuario_Senha" size="70" maxlength="255"/></td>
                </tr>
                <tr>
                    <td><label for="formUsuario_Senha2">Confirmar Senha:</label></td>
                    <td><input type="password" id="formUsuario_Senha2" size="70" maxlength="255"/></td>
                </tr>
                <tr>
                    <td><label for="formUsuario_Email">Email:</label></td>
                    <td><input type="text" id="formUsuario_Email" size="70" maxlength="255"/></td>
                </tr>
                <tr>
                    <td><label for="formUsuario_Nivel">Nível:</label></td>
                    <td>
                        <select id="formUsuario_Nivel">
                            <option value="">Selecione o nível</option>
                            <option value="Admin">Administrador</option>
                            <option value="Coord">Coordenador</option>
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
interno/modulo/usuario/listarUsuarios/");
    }
    
    function limpar(){
        $("#formUsuario_Nome",selected_tab()).val("");
        $("#formUsuario_Login",selected_tab()).val("");
        $("#formUsuario_Senha",selected_tab()).val("");
        $("#formUsuario_Senha2",selected_tab()).val("");
        $("#formUsuario_Email",selected_tab()).val("");
        $("#formUsuario_Nivel",selected_tab()).val("");
    }
    
    // Verifica campos obrigatórios preenchidos e envia os dados preenchidos para a respectiva classe de controle em php
    function cadastrar(){
        campos = new Array(5);
        contador = 0;
  
        if($("#formUsuario_Nome").val()==""){
            campos[contador]="formUsuario_Nome";
            contador=contador+1;
        }
        
        if($("#formUsuario_Nivel").val()==""){
            campos[contador]="formUsuario_Nivel";
            contador=contador+1;
        }

        if($("#formUsuario_Login").val()==""){
            campos[contador]="formUsuario_Login";
            contador=contador+1;
        }
        
        if($("#formUsuario_Email").val()!=""){
            if(!Email($("#formUsuario_Email").val())){
                campos[contador]="#formUsuario_Email";
                contador=contador+1;
            }
        }

        if($("#formUsuario_Senha").val()==""){
            campos[contador]="formUsuario_Senha";
            contador = contador+1;
        }

        if($("#formUsuario_Senha2").val()!=$("#formUsuario_Senha").val()){
            campos[contador]="formUsuario_Senha2";
            contador = contador+50;
            campos[contador]="formUsuario_Senha";
            contador = contador+50;
        }
        if(contador == 0){
      
      $.ajax({
                url: "<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/usuario/cadastrar",
                data: {
                    "nome": $("#formUsuario_Nome").val(),
                    "login": $("#formUsuario_Login").val(),
                    "senha": $("#formUsuario_Senha").val(),
                    "email": $("#formUsuario_Email").val(),
                    "nivel": $("#formUsuario_Nivel").val()
                },
                cache: false,
                success: function(data){
                    respostaDoControlador = eval(data);
                    mensagem = respostaDoControlador.message;
                    
		    if(mensagem === "Usuario cadastrado com sucesso."){
                    	$().message(respostaDoControlador.message);
                        openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/usuario/listarUsuarios/");
                    }
                    
                    else if(mensagem === "Login já cadastrado."){
                        $().message(respostaDoControlador.message);
                    }
                },
                error: function(data){
                    respostaDoControlador = eval(data);
                    $().message(respostaDoControlador.message);
                    openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/usuario/listarUsuarios/");
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