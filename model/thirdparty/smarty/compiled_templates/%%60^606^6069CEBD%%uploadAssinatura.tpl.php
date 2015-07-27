<?php /* Smarty version 2.6.18, created on 03-02-2015 01:56:33
         compiled from pages/interno/modulo/instrutor/uploadAssinatura.tpl */ ?>
<script type="text/javascript">
    function valida() {
        extensoes_permitidas = new Array(".gif", ".jpg", ".png", ".pdf");
        meuerro = "";
        //recupero a extensão deste nome de arquivo
        extensao = ($("#userfile").val().substring($("#userfile").val().lastIndexOf("."))).toLowerCase();

        //comprovo se a extensão está entre as permitidas
        permitida = false;
        for (var i = 0; i < extensoes_permitidas.length; i++) {
            if (extensoes_permitidas[i] == extensao) {
                permitida = true;
                break;
            }
        }

        if (!permitida) {
            meuerro = "Só se pode enviar arquivos com extensões: " + extensoes_permitidas.join();
            var oCampo = document.getElementById("userfile");
            var oNovoCampo = oCampo.cloneNode(true);
            oCampo.parentNode.replaceChild(oNovoCampo, oCampo);
            $("#userfile").val("");
            alert(meuerro);

        } else {
            //tudo ok!
            return extensao;
        }

    }


    $(function() {
        $("#tabs_nf").tabs();
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
    div#users-contain {
        width: 350px;
        margin: 20px 0;
    }
    div#users-contain table { 
        margin: 1em 0;
        border-collapse: collapse;
        width: 100%;
    }
    div#users-contain table td, div#users-contain table th { 
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

    $('#form').ajaxForm({
        uploadProgress: function(event, position, total, percentComplete) {
            $('progress').attr('value', percentComplete);
            $('#porcentagem').html(percentComplete + '%');
        },
        success: function(data) {
            $('progress').attr('value', '100');
            $('#porcentagem').html('100%');
            $('pre').html(data);
        }

    });

</script>

<script>
    $(function() {
        $("input:submit, a, button", ".demo").button();
        $("a", ".demo").click(function() {
            return false;
        });
    });

</script>

<script>$("#statusInformacao").html("Você está em: Instrutores >> Listar >> Upload de Assinatura.");</script>

<input type="text" id="idInstrutor" name="idInstrutor" value="<?php echo $this->_tpl_vars['instrutor']['idInstrutor']; ?>
" style="display: none;" />

<div id="users-contain" class="ui-widget" style="margin:20px auto;">
    <table id="users" class="ui-widget ui-widget-content">
        <thead>
            <tr class="ui-widget-header ">
                <th>Upload de Assinatura</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <fieldset style="background-color: whitesmoke;">
                        <legend>Associar a:  
                            <?php echo $this->_tpl_vars['instrutor']['nome']; ?>

                        </legend>
                    </fieldset>
                    <fieldset style="background-color: whitesmoke;">
                        <legend>Assinatura</legend>
                        <form enctype="multipart/form-data" id="form" action="<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/instrutor/uploadAssinatura" method="post">
                            <input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
                            <input type="hidden" id="uploadAssinaturaInstrutor_nomeUpload" name="uploadAssinaturaInstrutor_nomeUpload" />
                            Arquivo do Assinatura: <input name="userfile" type="file" id="userfile" onchange="valida();" />
                            <progress value="0" max="100"></progress><span id="porcentagem">0%</span>
                        </form>
                    </fieldset>

                    <button id="cadastrar" onclick="cadastrar()" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="float:right; margin-right:10px;">
                        <span class="ui-button-text">Cadastrar</span>
                    </button>
                    <button id="limpar" onclick="limpar()" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="float:right; margin-right:10px;">
                        <span class="ui-button-text">Cancelar</span>
                    </button>

                </td>
            </tr>
        </tbody>
    </table>
</div>

<script type="text/javascript" charset="utf-8">

    function limpar() {
         openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/instrutor/listarInstrutores/");
    }

    function alertaVazio(campos, contador) {
        document.getElementById("formDetalheControleHoras_observacao").style.borderColor = '#F8F8F8';
        document.getElementById("userfile").style.borderColor = '#F8F8F8';

        for (i = 0; i < contador; i = i + 1) {
            document.getElementById(campos[i]).style.borderColor = '#FF3300';
            document.getElementById(campos[i]).style.backgroundColor = '#FFEDBF';
        }

    }

    function cadastrar() {
        campos = new Array(5);
        contador = 0;

        if ($("#userfile").val() == "") {
            campos[contador] = "userfile";
            contador = contador + 1;
        }

        if (contador == 0) {
            $('progress').attr('value', '20');
            $('#porcentagem').html('20%');
            $().message("Enviando os dados! Este processo pode levar alguns minutos!");
            //ESTA FUNÇÃO
            $.ajax({
                url: "<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/instrutor/armazenarAssinatura",
                data: {
                    "idInstrutor": $("#idInstrutor").val(),
                    "extensao": ($("#userfile").val().substring($("#userfile").val().lastIndexOf("."))).toLowerCase()
                },
                cache: false,
                success: function(data) {
                    respostaDoControlador = eval(data);
                    $().message("Detalhes cadastrados com sucesso. Realizando o upload do arquivo, este processo pode demorar alguns minutos.");
                    $('progress').attr('value', '80');
                    $('#porcentagem').html('80%');
                    $('#uploadAssinaturaInstrutor_nomeUpload').val(respostaDoControlador.message);
                    document.getElementById("form").submit();
                },
                error: function(data) {
                    respostaDoControlador = eval(data);
                    $().message(respostaDoControlador.message);
                },
                dataType: "json"

            });


        } else {
            $().message("Campos obrigatórios não foram preenchidos.");
            alertaVazio(campos, contador);
        }
    }
</script>