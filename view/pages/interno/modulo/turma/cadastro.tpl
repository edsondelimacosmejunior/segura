<script type="text/javascript">
    $(function() {
    $("#tabs_cadastroTurma").tabs();
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
    div#tabs_cadastroTurma-contain {
        width: 350px;
        margin: 20px 0;
        font-size: 90.5%;
    }
    div#tabs_cadastroTurma-contain table {
        margin: 1em 0;
        border-collapse: collapse;
        width: 100%;
    }
    div#tabs_cadastroTurma-contain table td, div#romaneio-contain table th {
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
</script>
    
<script>$("#statusInformacao").html("Vocé está em: Turma >> Cadastro de Turma.");</script>

<div id="tabs_cadastroTurma">
    <ul>
        <li><a href="#tabs-1">Dados</a></li>
    </ul>

    <div id="tabs-1">
        <fieldset style="background-color: whitesmoke;">
            <legend>Informações da Turma</legend>
            <table> 
                <tr>
                    <td><label for="formTurma_Curso">Curso:</label></td>
                    <td>
                        <select id="formTurma_Curso" class="text ui-widget-content ui-corner-all">
                            <option value="">Selecione o Curso</option>
                            {{foreach from=$cursos item=cursos}}
                            <option value='{{$cursos.idCurso}}'>{{$cursos.nome}}</option>
                            {{/foreach}}
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="formTurma_Instrutor1">Instrutor 1:</label></td>
                    <td>
                        <select id="formTurma_Instrutor1" class="text ui-widget-content ui-corner-all">
                            <option value="">Selecione o Instrutor 1</option>
                            {{foreach from=$instrutores1 item=instrutores1}}
                            <option value='{{$instrutores1.idInstrutor}}'>{{$instrutores1.nome}}</option>
                            {{/foreach}}
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="formTurma_Instrutor2">Instrutor 2:</label></td>
                    <td>
                        <select id="formTurma_Instrutor2" class="text ui-widget-content ui-corner-all">
                            <option value="">Selecione o Instrutor 2</option>
                            {{foreach from=$instrutores2 item=instrutores2}}
                            <option value='{{$instrutores2.idInstrutor}}'>{{$instrutores2.nome}}</option>
                            {{/foreach}}
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="formTurma_Instrutor3">Instrutor 3:</label></td>
                    <td>
                        <select id="formTurma_Instrutor3" class="text ui-widget-content ui-corner-all">
                            <option value="">Selecione o Instrutor 3</option>
                            {{foreach from=$instrutores3 item=instrutores3}}
                            <option value='{{$instrutores3.idInstrutor}}'>{{$instrutores3.nome}}</option>
                            {{/foreach}}
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="formTurma_Instrutor4">Instrutor 4:</label></td>
                    <td>
                        <select id="formTurma_Instrutor4" class="text ui-widget-content ui-corner-all">
                            <option value="">Selecione o Instrutor 4</option>
                            {{foreach from=$instrutores4 item=instrutores4}}
                            <option value='{{$instrutores4.idInstrutor}}'>{{$instrutores4.nome}}</option>
                            {{/foreach}}
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="formTurma_Nome">Nome da Turma(Apelido):</label></td>
                    <td><input type="text" id="formTurma_Nome" size="70" maxlength="255"/></td>
                </tr>
                <tr>
                    <td><label for="formTurma_Periodo">Período:</label></td>
                    <td><input type="text" id="formTurma_Periodo" size="70" maxlength="255"/></td>
                </tr>
                <tr>
                    <td><label for="formTurma_Local">Local:</label></td>
                    <td><input type="text" id="formTurma_Local" size="70" maxlength="255"/></td>
                </tr>
                <tr>
                    <td><label for="formTurma_Data">Data de Conclusão:</label></td>
                    <td><input type="text" id="formTurma_Data" size="70" maxlength="10" onKeyDown="Mascara(this,Data);" onKeyPress="Mascara(this,Data);" onKeyUp="Mascara(this,Data);"/></td>
                </tr>
                <tr>
                    <td><label for="formTurma_Valor">Valor: R$</label></td>
                    <td><input type="text" id="formTurma_Valor" size="70" maxlength="255"/></td>
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
        openlink("{{$BASE_PATH}}interno/modulo/turma/listarTurmasAtivas/");
    }
    
    function limpar(){
        $("#formTurma_Nome",selected_tab()).val("");
        $("#formTurma_Curso",selected_tab()).val("");
        $("#formTurma_Periodo",selected_tab()).val("");
        $("#formTurma_Local",selected_tab()).val("");
        $("#formTurma_Data",selected_tab()).val("");
        $("#formTurma_Valor",selected_tab()).val("");
        $("#formTurma_Instrutor1",selected_tab()).val("");
        $("#formTurma_Instrutor2",selected_tab()).val("");
        $("#formTurma_Instrutor3",selected_tab()).val("");
        $("#formTurma_Instrutor4",selected_tab()).val("");                
    }
    
    // Verifica campos obrigatórios preenchidos e envia os dados preenchidos para a respectiva classe de controle em php
    function cadastrar(){
        campos = new Array(2);
        contador = 0;
  
        if($("#formTurma_Curso").val()==""){
            campos[contador]="formTurma_Curso";
            contador=contador+1;
        }
        
        if($("#formTurma_Data").val()!=""){
            if(!VerificaData($("#formTurma_Data").val())){
                campos[contador]="#formTurma_Data";
                contador=contador+1;
            }
        }
        
        if(contador == 0){
      
      $.ajax({
                url: "{{$BASE_PATH}}interno/modulo/turma/cadastrar",
                data: {
                    "nome": $("#formTurma_Nome").val(),
                    "curso": $("#formTurma_Curso").val(),
                    "periodo": $("#formTurma_Periodo").val(),
                    "local": $("#formTurma_Local").val(),
                    "idInstrutor1": $("#formTurma_Instrutor1").val(),
                    "idInstrutor2": $("#formTurma_Instrutor2").val(),
                    "idInstrutor3": $("#formTurma_Instrutor3").val(),
                    "idInstrutor4": $("#formTurma_Instrutor4").val(),
                    "dataTurma": $("#formTurma_Data").val(),
                    "valor": $("#formTurma_Valor").val()
                },
                cache: false,
                success: function(data){
                    respostaDoControlador = eval(data);
                    mensagem = respostaDoControlador.message;
            
                    if(mensagem == "Turma cadastrada com sucesso."){
                    
                        $().message(respostaDoControlador.message);
                        //openlink("{{$BASE_PATH}}interno/modulo/turma/listarTurmas/");
                    }
                },
                error: function(data){
                    respostaDoControlador = eval(data);
                    $().message(respostaDoControlador.message);
                    //openlink("{{$BASE_PATH}}interno/modulo/turma/listarTurmas/");
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