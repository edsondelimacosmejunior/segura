<?php /* Smarty version 2.6.18, created on 03-12-2015 21:47:32
         compiled from pages/interno/modulo/financeiro/lancamentos/edita.tpl */ ?>
<script type="text/javascript">
    $(function () {
        $("#tabs_lancamento").tabs();
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
    .ui-dialog .ui-state-error {
        padding: .3em;
    }
    .validateTips {
        border: 1px solid transparent;
        padding: 0.3em;
    }

</style>
<script>
    $("#formLancamento_dataEmissao").datepicker({
        changeMonth: true,
        numberOfMonths: 1,
        dateFormat: 'dd/mm/yy',
        monthNames: ['Janeiro', 'Fevereiro', 'Mar&ccedil;o', 'Abril', 'Maio', 'Junho',
            'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        dayNamesMin: ['Do', 'Se', 'Te', 'Qa', 'Qi', 'Se', 'Sa'],
        prevText: 'Anterior',
        nextText: 'Pr&oacute;ximo',
        monthNamesShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"]
    });
    $("#formLancamento_dataVencimento").datepicker({
        changeMonth: true,
        numberOfMonths: 1,
        dateFormat: 'dd/mm/yy',
        monthNames: ['Janeiro', 'Fevereiro', 'Mar&ccedil;o', 'Abril', 'Maio', 'Junho',
            'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        dayNamesMin: ['Do', 'Se', 'Te', 'Qa', 'Qi', 'Se', 'Sa'],
        prevText: 'Anterior',
        nextText: 'Pr&oacute;ximo',
        monthNamesShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"]
    });
    $("#formLancamento_dataBaixa").datepicker({
        changeMonth: true,
        numberOfMonths: 1,
        dateFormat: 'dd/mm/yy',
        monthNames: ['Janeiro', 'Fevereiro', 'Mar&ccedil;o', 'Abril', 'Maio', 'Junho',
            'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        dayNamesMin: ['Do', 'Se', 'Te', 'Qa', 'Qi', 'Se', 'Sa'],
        prevText: 'Anterior',
        nextText: 'Pr&oacute;ximo',
        monthNamesShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"]
    });
</script>

<script>
    $(function () {
        $("input:submit, a, button", ".demo").button();
        $("a", ".demo").click(function () {
            return false;
        });
    });

    /*Função Pai de Mascaras*/
    function Mascara(o, f) {
        v_obj = o
        v_fun = f
        setTimeout("execmascara()", 1)
    }

    /*Função que Executa os objetos*/
    function execmascara() {
        v_obj.value = v_fun(v_obj.value)
    }

    /*Função que permite apenas numeros*/
    function Inteiro(v) {
        return v.replace(/\D/g, "")
    }

    function Rg(v) {
        v = v.replace(/\D/g, "")
        v = v.replace(/(\d{3})(\d)/, "$1.$2")
        v = v.replace(/(\d{3})(\d)/, "$1.$2")
        return v;
    }

    function Cpf(v) {
        v = v.replace(/\D/g, "")
        v = v.replace(/(\d{3})(\d)/, "$1.$2")
        v = v.replace(/(\d{3})(\d)/, "$1.$2")
        v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2")
        return v
    }
    /*Função que padroniza telefone (11) 4184-1241*/
    function Telefone(v) {
        v = v.replace(/\D/g, "")
        v = v.replace(/^(\d\d)(\d)/g, "($1) $2")
        v = v.replace(/(\d{4})(\d)/, "$1-$2")
        return v
    }

    /*Função que padroniza CEP*/
    function Cep(v) {
        v = v.replace(/\D/g, "")
        v = v.replace(/^(\d{5})(\d)/, "$1-$2")
        return v
    }

    /*Função que padroniza CNPJ*/
    function Cnpj(v) {
        v = v.replace(/\D/g, "")
        v = v.replace(/^(\d{2})(\d)/, "$1.$2")
        v = v.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3")
        v = v.replace(/\.(\d{3})(\d)/, ".$1/$2")
        v = v.replace(/(\d{4})(\d)/, "$1-$2")
        return v
    }

    function Email(email)
    {
        er = /^[a-zA-Z0-9][a-zA-Z0-9\._-]+@([a-zA-Z0-9\._-]+\.)[a-zA-Z-0-9]{2}/;

        if (er.exec(email))
        {
            return true;
        } else {
            return false;
        }
    }


    /*Função que padroniza DATA*/
    function Data(v) {
        v = v.replace(/\D/g, "")
        v = v.replace(/(\d{2})(\d)/, "$1/$2")
        v = v.replace(/(\d{2})(\d)/, "$1/$2")
        return v
    }

    function Moeda(v) {
        //v = z.value;
        v = v.replace(/\D/g, "")  //permite digitar apenas números
        //v=v.replace(/[0-9]{12}/,"inválido")   //limita pra máximo 999.999.999,99
        //v=v.replace(/(\d{1})(\d{8})$/,"$1.$2")  //coloca ponto antes dos últimos 8 digitos
        //v=v.replace(/(\d{1})(\d{5})$/,"$1.$2")  //coloca ponto antes dos últimos 5 digitos
        v = v.replace(/(\d{1})(\d{1,2})$/, "$1.$2")        //coloca virgula antes dos últimos 2 digitos
        return v
    }

    function VerificaData(digData)
    {
        var bissexto = 0;
        var data = digData;
        var tam = data.length;
        if (tam == 10)
        {
            var dia = data.substr(0, 2)
            var mes = data.substr(3, 2)
            var ano = data.substr(6, 4)
            if ((ano > 1900) || (ano < 2100))
            {
                switch (mes)
                {
                    case '01':
                    case '03':
                    case '05':
                    case '07':
                    case '08':
                    case '10':
                    case '12':
                        if (dia <= 31)
                        {
                            return true;
                        }
                        break

                    case '04':
                    case '06':
                    case '09':
                    case '11':
                        if (dia <= 30)
                        {
                            return true;
                        }
                        break
                    case '02':
                        /* Validando ano Bissexto / fevereiro / dia */
                        if ((ano % 4 == 0) || (ano % 100 == 0) || (ano % 400 == 0))
                        {
                            bissexto = 1;
                        }
                        if ((bissexto == 1) && (dia <= 29))
                        {
                            return true;
                        }
                        if ((bissexto != 1) && (dia <= 28))
                        {
                            return true;
                        }
                        break
                }
            }
        }
        return false;
    }

</script>

<script>$("#statusInformacao").html("Você está em: Financeiro >> Lançamentos >> Listar >> Editar.");</script>

<input type="text" id="formLancamento_idLancamentoFinanceiro" size="70" value="<?php echo $this->_tpl_vars['lancamento']['idLancamentoFinanceiro']; ?>
" style="display: none;" />

<div id="tabs_lancamento">
    <ul>
        <li><a href="#tabs-1">Identificação</a></li>
        <li><a href="#tabs-2">Valores</a></li>
    </ul>
    <div id="tabs-1">
        <fieldset style="background-color: whitesmoke;">
            <legend>Fornecedor</legend>
            <table> 
                <tr>
                    <td><label for="formLancamento_empresa">Empresa:</label></td>
                    <td>
                        <select id="formLancamento_empresa">
                            <option value="<?php echo $this->_tpl_vars['lancamento']['idEmpresa']; ?>
"><?php echo $this->_tpl_vars['lancamento']['nomeFantasia']; ?>
</option>
                            <?php $_from = $this->_tpl_vars['empresas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['empresas']):
?>
                            <option value="<?php echo $this->_tpl_vars['empresas']['idEmpresa']; ?>
"><?php echo $this->_tpl_vars['empresas']['nomeFantasia']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                        </select> 
                    </td>
                </tr>
            </table>
        </fieldset>
        <fieldset style="background-color: whitesmoke;">
            <legend>Dados do Lançamento</legend>
            <table> 
                <tr>
                    <td><label for="formLancamento_nome">Nome:</label></td>
                    <td><input type="text" id="formLancamento_nome" size="70" value="<?php echo $this->_tpl_vars['lancamento']['nome']; ?>
" /></td>
                </tr>
                <tr>
                    <td><label for="formLancamento_descricao">Descrição:</label></td>
                    <td><input type="text" id="formLancamento_descricao" size="70" value="<?php echo $this->_tpl_vars['lancamento']['descricao']; ?>
"/></td>
                </tr>
                <tr>
                    <td><label for="formLancamento_OrigemNotaFiscal">Nota Fiscal:</label></td>
                    <td>
                        <select id="formLancamento_OrigemNotaFiscal">
                            <option value="<?php echo $this->_tpl_vars['lancamento']['origemNotaFiscal']; ?>
"><?php echo $this->_tpl_vars['lancamento']['origemNotaFiscalNome']; ?>
</option>
                            <option value="0">Não</option>
                            <option value="1">Sim</option>
                        </select> 
                    </td>
                </tr>
                <tr>
                    <td><label for="formLancamento_pagarReceber">Pagar/Receber:</label></td>
                    <td>
                        <select id="formLancamento_pagarReceber">
                            <option value="<?php echo $this->_tpl_vars['lancamento']['pagarReceber']; ?>
"><?php echo $this->_tpl_vars['lancamento']['pagarReceberNome']; ?>
</option>
                            <option value="0">Pagar</option>
                            <option value="1">Receber</option>
                        </select> 
                    </td>
                </tr>
                <tr>
                    <td><label for="formLancamento_centroCusto">Centro de Custo:</label></td>
                    <td>
                        <select id="formLancamento_centroCusto">
                            <option value="<?php echo $this->_tpl_vars['lancamento']['idCentroCusto']; ?>
"><?php echo $this->_tpl_vars['lancamento']['centroCusto']; ?>
</option>
                            <?php $_from = $this->_tpl_vars['centroCustos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['centroCustos']):
?>
                            <option value="<?php echo $this->_tpl_vars['centroCustos']['idCentroCusto']; ?>
"><?php echo $this->_tpl_vars['centroCustos']['nome']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                        </select> 
                    </td>
                </tr>
                <tr>
                    <td><label for="formLancamento_tipoLancamento">Tipo de Lançamento:</label></td>
                    <td>
                        <select id="formLancamento_tipoLancamento">
                            <option value="<?php echo $this->_tpl_vars['lancamento']['idTipoLancamento']; ?>
"><?php echo $this->_tpl_vars['lancamento']['tipoLancamento']; ?>
</option>
                            <?php $_from = $this->_tpl_vars['tiposLancamentos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tiposLancamentos']):
?>
                            <option value="<?php echo $this->_tpl_vars['tiposLancamentos']['idTipoLancamento']; ?>
"><?php echo $this->_tpl_vars['tiposLancamentos']['nome']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                        </select> 
                    </td>
                </tr>
                <tr>
                    <td><label for="formLancamento_formaPagamento">Forma de Pagamento:</label></td>
                    <td>
                        <select id="formLancamento_formaPagamento">
                            <option value="<?php echo $this->_tpl_vars['lancamento']['idFormaPagamento']; ?>
"><?php echo $this->_tpl_vars['lancamento']['formaPagamento']; ?>
</option>
                            <?php $_from = $this->_tpl_vars['formasPagamentos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['formasPagamentos']):
?>
                            <option value="<?php echo $this->_tpl_vars['formasPagamentos']['idFormaPagamento']; ?>
"><?php echo $this->_tpl_vars['formasPagamentos']['nome']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                        </select> 
                    </td>
                </tr>

            </table>
        </fieldset>

    </div>
    <div id="tabs-2">
        <fieldset style="background-color: whitesmoke;">
            <legend>Valores do Lançamento</legend>
            <table> 
                <tr>
                    <td><label for="formLancamento_valorOriginal">Valor Original:</label></td>
                    <td><input type="text" id="formLancamento_valorOriginal" size="70" onKeyDown="Mascara(this, Moeda);" value="<?php echo $this->_tpl_vars['lancamento']['valorOriginal']; ?>
"/></td>
                </tr>
                <tr>
                    <td><label for="formLancamento_desconto">Desconto:</label></td>
                    <td><input type="text" id="formLancamento_desconto" size="70" onKeyDown="Mascara(this, Moeda);" value="<?php echo $this->_tpl_vars['lancamento']['desconto']; ?>
"/></td>
                </tr>
                <tr>
                    <td><label for="formLancamento_juros">Juros:</label></td>
                    <td><input type="text" id="formLancamento_juros" size="70" onKeyDown="Mascara(this, Moeda);" value="<?php echo $this->_tpl_vars['lancamento']['juros']; ?>
"/></td>
                </tr>
                <tr>
                    <td><label for="formLancamento_cartorio">Cartório:</label></td>
                    <td><input type="text" id="formLancamento_cartorio" size="70" onKeyDown="Mascara(this, Moeda);" value="<?php echo $this->_tpl_vars['lancamento']['cartorio']; ?>
"/></td>
                </tr>
            </table>
        </fieldset>
        <fieldset style="background-color: whitesmoke;">
            <legend>Datas do Lançamento</legend>
            <table> 
                <tr>
                    <td><label for="formLancamento_dataEmissao">Data de Emissão:</label></td>
                    <td><input type="text" id="formLancamento_dataEmissao" size="70" onKeyDown="Mascara(this, Data);" value="<?php echo $this->_tpl_vars['lancamento']['dataEmissao']; ?>
"/></td>
                </tr>
                <tr>
                    <td><label for="formLancamento_dataVencimento">Data de Vencimento:</label></td>
                    <td><input type="text" id="formLancamento_dataVencimento" size="70" onKeyDown="Mascara(this, Data);" value="<?php echo $this->_tpl_vars['lancamento']['dataVencimento']; ?>
"/></td>
                </tr>
            </table>
        </fieldset>
    </div>
</div>

<!--
<button id="cadastrar" onclick="cadastrar()" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="float:right; margin:10px;">
    <span class="ui-button-text">Editar</span>
</button>
<button id="limpar" onclick="limpar()" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="float:right; margin:10px;">
    <span class="ui-button-text">Cancelar</span>
</button>
-->

<table>
    <tr>
        <td><button onclick="cadastrar();" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" >Cadastrar</button></td>
        <td><button onclick="limpar();" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" >Cancelar</button></td>
    </tr>
</table>                

<script type="text/javascript" charset="utf-8">
    function alertaVazio(campos, contador) {

        for (i = 0; i < contador; i = i + 1) {
            document.getElementById(campos[i]).style.borderColor = '#FF3300';
            document.getElementById(campos[i]).style.backgroundColor = '#FFEDBF';
        }

    }

    function cadastrar() {
        campos = new Array(10);
        contador = 0;


        if ($("#formLancamento_nome").val() == "") {
            campos[contador] = "formLancamento_nome";
            contador = contador + 1;
        }
        
        if ($("#formLancamento_origemNotaFiscal").val() == "") {
            campos[contador] = "formLancamento_origemNotaFiscal";
            contador = contador + 1;
        }

        if ($("#formLancamento_pagarReceber").val() == "") {
            campos[contador] = "formLancamento_pagarReceber";
            contador = contador + 1;
        }

        if ($("#formLancamento_empresa").val() == "") {
            campos[contador] = "formLancamento_empresa";
            contador = contador + 1;
        }

        if ($("#formLancamento_dataEmissao").val() == "") {
            campos[contador] = "formLancamento_dataEmissao";
            contador = contador + 1;
        }

        if ($("#formLancamento_dataVencimento").val() == "") {
            campos[contador] = "formLancamento_dataVencimento";
            contador = contador + 1;
        }

        if ($("#formLancamento_valorOriginal").val() == "") {
            campos[contador] = "formLancamento_valorOriginal";
            contador = contador + 1;
        }

        if ($("#formLancamento_formaPagamento").val() == "") {
            campos[contador] = "formLancamento_formaPagamento";
            contador = contador + 1;
        }

        if ($("#formLancamento_tipoLancamento").val() == "") {
            campos[contador] = "formLancamento_tipoLancamento";
            contador = contador + 1;
        }

        if ($("#formLancamento_centroCusto").val() == "") {
            campos[contador] = "formLancamento_centroCusto";
            contador = contador + 1;
        }

        if (contador == 0) {
            $.ajax({
                url: "<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/financeiro/lancamentofinanceiro/editar",
                data: {
                    "idLancamentoFinanceiro": $("#formLancamento_idLancamentoFinanceiro").val(),
                    "nome": $("#formLancamento_nome").val(),
                    "descricao": $("#formLancamento_descricao").val(),
                    "origemNotaFiscal": $("#formLancamento_origemNotaFiscal").val(),
                    "pagarReceber": $("#formLancamento_pagarReceber").val(),
                    "dataEmissao": $("#formLancamento_dataEmissao").val(),
                    "dataVencimento": $("#formLancamento_dataVencimento").val(),
                    "valorOriginal": $("#formLancamento_valorOriginal").val(),
                    "desconto": $("#formLancamento_desconto").val(),
                    "juros": $("#formLancamento_juros").val(),
                    "cartorio": $("#formLancamento_cartorio").val(),
                    "idFormaPagamento": $("#formLancamento_formaPagamento").val(),
                    "idTipoLancamento": $("#formLancamento_tipoLancamento").val(),
                    "idCentroCusto": $("#formLancamento_centroCusto").val(),
                    "idEmpresa": $("#formLancamento_empresa").val()
                },
                cache: false,
                success: function (data) {
                    respostaDoControlador = eval(data);
                    $().message("Lançamento editado com sucesso!");
                    openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/financeiro/lancamentofinanceiro/listar/");
                },
                error: function (data) {
                    respostaDoControlador = eval(data);
                    $().message(respostaDoControlador.message);
                },
                dataType: "json"

            });


        } else {
            $().message("Campos obrigatórios não foram preenchidos!");
            alertaVazio(campos, contador);
        }
    }
</script>