<script type="text/javascript">
    $(function () {
        $("#tabs_cadastroCurso").tabs();
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

<script>$("#statusInformacao").html("Vocé está em: Curso >> Cadastro de Curso.");</script>

<div id="tabs_cadastroCurso">
    <ul>
        <li><a href="#tabs-1">Informações</a></li>
        <li><a href="#tabs-2">Certificado</a></li>
    </ul>

    <div id="tabs-1">
        <fieldset style="background-color: whitesmoke;">
            <legend>Informações do Curso</legend>
            <table> 
                <tr>
                    <td><label for="formCurso_Nome">Nome:</label></td>
                    <td><input type="text" id="formCurso_Nome" size="70" maxlength="255"/></td>
                </tr>
                <tr>
                    <td><label for="formCurso_CargaHoraria">Carga Horária:</label></td>
                    <td><input type="text" id="formCurso_CargaHoraria" size="70" maxlength="255"/></td>
                </tr>
                <tr>
                    <td><label for="formCurso_Conteudo">Conteúdo:</label></td>
                    <td><input type="text" id="formCurso_Conteudo" size="70"/></td>
                </tr>
                <tr>
                    <td><label for="formCurso_Validade">Validade:</label></td>
                    <td><input type="text" id="formCurso_Validade" size="70" maxlength="255"/></td>
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
                    <td><input type="color" id="formCurso_CorFundo" size="70" value="#FFFFFF"/></td>
                </tr>
                <tr>
                    <td><label for="formCurso_CorFonte">Cor da Fonte do Título:</label></td>
                    <td><input type="color" id="formCurso_CorFonte" size="70" value="#000000"/></td>
                </tr>
                <tr>
                    <td><label for="formCurso_TamanhoFonte">Tamanho da Fonte do Título:</label></td>
                    <td>
                        <select id="formCurso_TamanhoFonte">
                            <option value="14">Selecione o Tamanho</option>
                            <option value="07">07 px</option>
                            <option value="08">08 px</option>
                            <option value="09">09 px</option>
                            <option value="10">10 px</option>
                            <option value="11">11 px</option>
                            <option value="12">12 px</option>
                            <option value="13">13 px</option>
                            <option value="14">14 px</option>
                            <option value="15">15 px</option>
                            <option value="16">16 px</option>
                            <option value="17">17 px</option>
                            <option value="18">18 px</option>
                            <option value="19">19 px</option>
                            <option value="20">20 px</option>
                            <option value="21">21 px</option>
                            <option value="22">22 px</option>
                            <option value="23">23 px</option>
                            <option value="24">24 px</option>
                            <option value="25">25 px</option>
                            <option value="26">26 px</option>
                            <option value="27">27 px</option>
                            <option value="28">28 px</option>
                            <option value="29">29 px</option>
                            <option value="30">30 px</option>
                        </select>
                    </td>
                </tr>
            </table>
        </fieldset>
    </div>
</div>
<table>
    <tr>
        <td><button onclick="cadastrar();" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" >Cadastrar</button></td>
        <td><button onclick="limpar();" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" >Limpar</button></td>
        <td><button onclick="cancelar();" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" >Cancelar</button></td>
    </tr>
</table>

<script>

    function alertaVazio(campos, contador) {
        for (i = 0; i < contador; i = i + 1) {
            document.getElementById(campos[i]).style.borderColor = '#FF3300';
            document.getElementById(campos[i]).style.backgroundColor = '#FFEDBF';
        }
    }

    function cancelar() {
        openlink("{{$BASE_PATH}}interno/modulo/curso/listarCursos/");
    }

    function limpar() {
        $("#formCurso_Nome", selected_tab()).val("");
        $("#formCurso_CargaHoraria", selected_tab()).val("");
        $("#formCurso_Conteudo", selected_tab()).val("");
        $("#formCurso_Validade", selected_tab()).val("");
        $("#formCurso_CorFundo", selected_tab()).val("#FFFFFF");
        $("#formCurso_CorFonte", selected_tab()).val("#000000");
        $("#formCurso_TamanhoFonte", selected_tab()).val("14");
    }

    // Verifica campos obrigatórios preenchidos e envia os dados preenchidos para a respectiva classe de controle em php
    function cadastrar() {
        campos = new Array(3);
        contador = 0;

        if ($("#formCurso_Nome").val() === "") {
            campos[contador] = "formCurso_Nome";
            contador = contador + 1;
        }

        if ($("#formCurso_CargaHoraria").val() === "") {
            campos[contador] = "formCurso_CargaHoraria";
            contador = contador + 1;
        }

        if ($("#formCurso_Conteudo").val() === "") {
            campos[contador] = "formCurso_Conteudo";
            contador = contador + 1;
        }

        if (contador === 0) {

            $.ajax({
                url: "{{$BASE_PATH}}interno/modulo/curso/cadastrar",
                data: {
                    "nome": $("#formCurso_Nome").val(),
                    "cargaHoraria": $("#formCurso_CargaHoraria").val(),
                    "conteudo": $("#formCurso_Conteudo").val(),
                    "validade": $("#formCurso_Validade").val(),
                    "corFundo": $("#formCurso_CorFundo").val(),
                    "corFonte": $("#formCurso_CorFonte").val(),
                    "tamanhoFonte": $("#formCurso_TamanhoFonte").val()
                },
                cache: false,
                success: function (data) {
                    respostaDoControlador = eval(data);
                    mensagem = respostaDoControlador.message;

                    if (mensagem === "Curso cadastrado com sucesso.") {

                        $().message(respostaDoControlador.message);
                        //openlink("{{$BASE_PATH}}interno/modulo/curso/listarCursos/");
                    }
                }
                ,
                error: function (data) {
                    respostaDoControlador = eval(data);
                    $().message(respostaDoControlador.message);
                    //openlink("{{$BASE_PATH}}interno/modulo/curso/listarCursos/");
                },
                dataType: "json"
            });
        }
        else {
            $().message("Os campos obrigatórios não foram preenchidos.");
            alertaVazio(campos, contador);
        }
    }
</script>