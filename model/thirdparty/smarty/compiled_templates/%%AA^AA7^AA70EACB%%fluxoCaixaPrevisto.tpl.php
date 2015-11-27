<?php /* Smarty version 2.6.18, created on 29-09-2015 15:08:05
         compiled from pages/interno/modulo/financeiro/relatorios/fluxoCaixaPrevisto.tpl */ ?>
<script type="text/javascript">
    $(function() {
        $("#tabs_fluxoCaixa").tabs();
    });
    $(function() {
        $("#tabs_resultadoFluxoCaixa").tabs();
    });
    $(function() {
        $("#tabs_despesasFluxoCaixa").tabs();
    });
    $(function() {
        $("#tabs_receitasFluxoCaixa").tabs();
    });

    function filtrar() {
        $().message("O seu filtro está sendo processado, por favor aguarde!");

        $.ajax({
            url: "<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/financeiro/relatorios/fluxocaixaprevisto/filtrar/",
            data: {
                "mes": $("#mes").val(),
                "ano": $("#ano").val()
            },
            cache: false,
            success: function(data) {

                selected_tab().html(data);
                $("#status span").html("");
                reset_buttons();
            },
            error: function(data) {
                $().message("Problemas ao acessar o servidor");
            }

        });
    }

    function limpar() {
        openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/financeiro/relatorios/fluxocaixaprevisto/mostrar/");
    }

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

    #conteudoResultado tr:hover td {
        background:#F7B64B;
    }

    h1 {
        font-size: 1.2em;
        margin: .6em 0;
    }
    div#relatorio-contain {
        width: 500px;
        margin: 20px 0;
    }
    div#relatorio-contain table { 
        margin: 1em 0;
        border-collapse: collapse;
        width: 100%;
    }
    div#relatorio-contain table td, div#relatorio-contain table th { 
        border: 1px solid #eee;
        padding: .6em 10px;
        text-align: left;
    }
    div.resultado-contain table td, div.resultado-contain table th { 
        border: 1px solid #eee;
        padding: .6em 10px;
        text-align: left;
        font-size: 90.5%;
    }

    div.resultado-contain tr:hover td {
        background:#F7B64B;
    }

    #dialog-detalharHoras_eventos tr:hover td {
        background:#F7B64B;
    }

    .over {
        background: #03c;	
    }

    .tabelaScroll tbody, table thead
    {
        display: block;
    }

    .tabelaScroll tbody 
    {
        overflow: auto;
        height: 200px;
    }

</style>
<script>
    $(function() {
        // a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
        $("#dialog:ui-dialog").dialog("destroy");

        $("#dialog-filtroFluxoCaixa").dialog({
            autoOpen: false,
            resizable: false,
            height: 180,
            modal: true
        });
    });
</script>

<script>

    function moeda(valor, casas, separdor_decimal, separador_milhar) {

        var valor_total = parseInt(valor * (Math.pow(10, casas)));
        var inteiros = parseInt(parseInt(valor * (Math.pow(10, casas))) / parseFloat(Math.pow(10, casas)));
        var centavos = parseInt(parseInt(valor * (Math.pow(10, casas))) % parseFloat(Math.pow(10, casas)));

        if (centavos % 10 == 0 && centavos + "".length < 2) {
            centavos = centavos + "0";
        } else if (centavos < 10) {
            centavos = "0" + centavos;
        }

        var milhares = parseInt(inteiros / 1000);
        inteiros = inteiros % 1000;

        var retorno = "";

        if (milhares > 0) {
            retorno = milhares + "" + separador_milhar + "" + retorno
            if (inteiros == 0) {
                inteiros = "000";
            } else if (inteiros < 10) {
                inteiros = "00" + inteiros;
            } else if (inteiros < 100) {
                inteiros = "0" + inteiros;
            }
        }
        retorno += inteiros + "" + separdor_decimal + "" + centavos;

        return retorno;

    }
    
    function getReceitas(idTipoLancamento, dia, mes, ano) {
        //alert(dia + "" + mes + "" + ano);
        //alert("receitas" + dia + "-" + fornecedor);
        var div = document.getElementById("receitas" + dia + "-" + idTipoLancamento);

        $.ajax({
            url: "<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/financeiro/relatorios/fluxocaixaprevisto/getReceitas",
            data: {
                "idTipoLancamento": idTipoLancamento,
                "dia": dia,
                "mes": mes,
                "ano": ano
            },
            cache: false,
            success: function(data) {
                if (data > 0) {
                    div.innerHTML = data;
                } else {
                    div.innerHTML = "-";
                }
            },
            error: function(data) {
                $().message("Problemas ao acessar o servidor.");
            },
            dataType: "json"

        });
    }
    
    function getDespesas(idTipoLancamento, dia, mes, ano) {
        //alert(dia + "" + mes + "" + ano);
        //alert("receitas" + dia + "-" + fornecedor);
        var div = document.getElementById("despesas" + dia + "-" + idTipoLancamento);

        $.ajax({
            url: "<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/financeiro/relatorios/fluxocaixaprevisto/getDespesas",
            data: {
                "idTipoLancamento": idTipoLancamento,
                "dia": dia,
                "mes": mes,
                "ano": ano
            },
            cache: false,
            success: function(data) {
                if (data > 0) {
                    div.innerHTML = data;
                } else {
                    div.innerHTML = "-";
                }
            },
            error: function(data) {
                $().message("Problemas ao acessar o servidor.");
            },
            dataType: "json"

        });
    }

    function getReceitasTotal(idTipoLancamento, mes, ano) {
        //alert(dia + "" + mes + "" + ano);
        //alert("receitas" + dia + "-" + fornecedor);
        var div = document.getElementById("receitasTotal-" + idTipoLancamento);

        $.ajax({
            url: "<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/financeiro/relatorios/fluxocaixaprevisto/getReceitasTotal",
            data: {
                "idTipoLancamento": idTipoLancamento,
                "mes": mes,
                "ano": ano
            },
            cache: false,
            success: function(data) {
                if (data > 0) {
                    div.innerHTML = data;
                } else {
                    div.innerHTML = "-";
                }
            },
            error: function(data) {
                $().message("Problemas ao acessar o servidor.");
            },
            dataType: "json"

        });
    }
    
    function getDespesasTotal(idTipoLancamento, mes, ano) {
        //alert(dia + "" + mes + "" + ano);
        //alert("receitas" + dia + "-" + fornecedor);
        var div = document.getElementById("despesasTotal-" + idTipoLancamento);

        $.ajax({
            url: "<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/financeiro/relatorios/fluxocaixaprevisto/getDespesasTotal",
            data: {
                "idTipoLancamento": idTipoLancamento,
                "mes": mes,
                "ano": ano
            },
            cache: false,
            success: function(data) {
                if (data > 0) {
                    div.innerHTML = data;
                } else {
                    div.innerHTML = "-";
                }
            },
            error: function(data) {
                $().message("Problemas ao acessar o servidor.");
            },
            dataType: "json"

        });
    }


</script>

<script>$("#statusInformacao").html("Você está em: Financeiro >> Caixa >> Fluxo de Caixa Previsto.");</script>

<input type="text" value="<?php echo $this->_tpl_vars['centroCusto']; ?>
" id="formFluxoCaixa_centroCustoParametro" style="display: none;" readonly/></td>

<div id="tabs_fluxoCaixa">
    <ul>
        <li><a href="#tabs-1">Fluxo de Caixa</a></li>
    </ul>
    <div id="tabs-1">
        <fieldset style="background-color: whitesmoke;">
            <legend>Filtros</legend>
            <table style="width: 250px;">
                <tr>
                    <td>
                        Mês
                        <select name="mes" id="mes" class="text ui-widget-content ui-corner-all">
                            <option value='1'>Jan</option>
                            <option value='2'>Fev</option>
                            <option value='3'>Mar</option>
                            <option value='4'>Abr</option>
                            <option value='5'>Mai</option>
                            <option value='6'>Jun</option>
                            <option value='7'>Jul</option>
                            <option value='8'>Ago</option>
                            <option value='9'>Set</option>
                            <option value='10'>Out</option>
                            <option value='11'>Nov</option>
                            <option value='12'>Dez</option>
                        </select>
                    </td>
                    <td>
                        Ano
                        <select name="ano" id="ano" class="text ui-widget-content ui-corner-all">
                            <option value='2015'>2015</option>
                            <option value='2015'>2016</option>
                        </select>
                    </td>
                </tr>
            </table>
        </fieldset>
        <fieldset style="background-color: whitesmoke;">
            <legend>Ação</legend>
            <button id="cadastrar" onclick="filtrar()" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="float:left; margin:10px; display: inline-block;">
                <span class="ui-button-text">Filtrar</span>
            </button>

            <button id="limpar" onclick="limpar()" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="float:left; margin:10px; display: inline-block;">
                <span class="ui-button-text">Limpar</span>
            </button>
        </fieldset>
    </div>

</div>

<div id="tabs_resultadoFluxoCaixa">
    <ul>
        <?php $_from = $this->_tpl_vars['semanas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['semanas']):
?>
        <li><a href="#tabsResult-<?php echo $this->_tpl_vars['semanas']['SEMANA']; ?>
"><?php echo $this->_tpl_vars['semanas']['DATAINICIAL']; ?>
 - <?php echo $this->_tpl_vars['semanas']['DATAFINAL']; ?>
</a></li>
            <?php endforeach; endif; unset($_from); ?>
    </ul>
    <?php $_from = $this->_tpl_vars['semanas2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['semanas2']):
?>
    <div id="tabsResult-<?php echo $this->_tpl_vars['semanas2']['SEMANA']; ?>
" style="margin-bottom: 30px;">
        <div class="resultado-contain">
            <table id="resultado-<?php echo $this->_tpl_vars['semanas2']['SEMANA']; ?>
" class="tabelaScroll">
                <thead class="ui-widget-header ">
                    <tr>
                        <th style="width: 150px;"></th>
                            <?php $_from = $this->_tpl_vars['calendario']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['cal']):
        $this->_foreach['foo']['iteration']++;
?>
                            <?php if ($this->_tpl_vars['cal']['SEMANA'] == $this->_tpl_vars['semanas2']['SEMANA']): ?>
                        <th style="width: 100px;"><?php echo $this->_tpl_vars['cal']['DIASEMANA']; ?>
 (<?php echo $this->_tpl_vars['cal']['DIA']; ?>
)</th>
                            <?php if (($this->_foreach['foo']['iteration'] == $this->_foreach['foo']['total'])): ?>
                        <th style="width: 100px;">Resumo Final</th>
                            <?php endif; ?> 
                            <?php endif; ?>
                            <?php endforeach; endif; unset($_from); ?>
                    </tr>
                </thead>
                <tbody id="conteudoResultado-<?php echo $this->_tpl_vars['semanas2']['SEMANA']; ?>
">
                    <tr>
                        <td style="width: 150px;">Saldo Anterior</td>
                        <?php $_from = $this->_tpl_vars['calendario']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['cal']):
        $this->_foreach['foo']['iteration']++;
?>
                        <?php if ($this->_tpl_vars['cal']['SEMANA'] == $this->_tpl_vars['semanas2']['SEMANA']): ?>
                        <td style="width: 100px;"><?php echo $this->_tpl_vars['cal']['SALDOANTERIOR']; ?>
</td>
                        <?php if (($this->_foreach['foo']['iteration'] == $this->_foreach['foo']['total'])): ?>
                        <td style="width: 100px;"><?php echo $this->_tpl_vars['saldoInicial']; ?>
</td>
                            <?php endif; ?> 
                        <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?>
                    </tr>
                    <tr>
                        <td style="width: 150px;">Despesas</td>
                        <?php $_from = $this->_tpl_vars['calendario']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['cal']):
        $this->_foreach['foo']['iteration']++;
?>
                        <?php if ($this->_tpl_vars['cal']['SEMANA'] == $this->_tpl_vars['semanas2']['SEMANA']): ?>
                        <td style="width: 100px;"><?php echo $this->_tpl_vars['cal']['DESPESAS']; ?>
</td>
                        <?php if (($this->_foreach['foo']['iteration'] == $this->_foreach['foo']['total'])): ?>
                        <td style="width: 100px;"><?php echo $this->_tpl_vars['totalDespesas']; ?>
</td>
                            <?php endif; ?> 
                        <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?>
                    </tr>
                    <tr>
                        <td style="width: 150px;">Receitas</td>
                        <?php $_from = $this->_tpl_vars['calendario']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['cal']):
        $this->_foreach['foo']['iteration']++;
?>
                        <?php if ($this->_tpl_vars['cal']['SEMANA'] == $this->_tpl_vars['semanas2']['SEMANA']): ?>
                        <td style="width: 100px;"><?php echo $this->_tpl_vars['cal']['RECEITAS']; ?>
</td>
                        <?php if (($this->_foreach['foo']['iteration'] == $this->_foreach['foo']['total'])): ?>
                        <td style="width: 100px;"><?php echo $this->_tpl_vars['totalReceitas']; ?>
</td>
                            <?php endif; ?> 
                        <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?>
                    </tr>
                    <tr>
                        <td style="width: 150px;">Saldo</td>
                        <?php $_from = $this->_tpl_vars['calendario']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['cal']):
        $this->_foreach['foo']['iteration']++;
?>
                        <?php if ($this->_tpl_vars['cal']['SEMANA'] == $this->_tpl_vars['semanas2']['SEMANA']): ?>
                        <td style="width: 100px;"><?php echo $this->_tpl_vars['cal']['SALDO']; ?>
</td>
                        <?php if (($this->_foreach['foo']['iteration'] == $this->_foreach['foo']['total'])): ?>
                        <td style="width: 100px;"><?php echo $this->_tpl_vars['saldoFinal']; ?>
</td>
                            <?php endif; ?> 
                        <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?>
                    </tr>
                </tbody>
                <thead class="ui-widget-header ">
                    <tr>
                        <th style="width: 150px;">Receitas</th>
                            <?php $_from = $this->_tpl_vars['calendario']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['cal']):
        $this->_foreach['foo']['iteration']++;
?>
                            <?php if ($this->_tpl_vars['cal']['SEMANA'] == $this->_tpl_vars['semanas2']['SEMANA']): ?>
                        <th style="width: 100px;"><?php echo $this->_tpl_vars['cal']['DIASEMANA']; ?>
 (<?php echo $this->_tpl_vars['cal']['DIA']; ?>
)</th>
                            <?php if (($this->_foreach['foo']['iteration'] == $this->_foreach['foo']['total'])): ?>
                        <th style="width: 100px;">Total do Mês</th>
                            <?php endif; ?> 
                            <?php endif; ?>
                            <?php endforeach; endif; unset($_from); ?>
                    </tr>
                </thead>
                <tbody style="margin-bottom: 30px;">
                    <?php $_from = $this->_tpl_vars['tiposLancamentos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tip']):
?>
                    <tr>
                        <td style="width: 150px;"><?php echo $this->_tpl_vars['tip']['nome']; ?>
</td>
                        <?php $_from = $this->_tpl_vars['calendario']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['cal']):
        $this->_foreach['foo']['iteration']++;
?>
                        <?php if ($this->_tpl_vars['cal']['SEMANA'] == $this->_tpl_vars['semanas2']['SEMANA']): ?>
                        <td style="width: 100px;" id="receitas<?php echo $this->_tpl_vars['cal']['DIA']; ?>
-<?php echo $this->_tpl_vars['tip']['idTipoLancamento']; ?>
">
                            <script>
                                getReceitas("<?php echo $this->_tpl_vars['tip']['idTipoLancamento']; ?>
",<?php echo $this->_tpl_vars['cal']['DIA']; ?>
,<?php echo $this->_tpl_vars['cal']['MES']; ?>
,<?php echo $this->_tpl_vars['cal']['ANO']; ?>
);
                            </script>
                        </td>
                        <?php if (($this->_foreach['foo']['iteration'] == $this->_foreach['foo']['total'])): ?>
                        <td style="width: 100px;" id="receitasTotal-<?php echo $this->_tpl_vars['tip']['idTipoLancamento']; ?>
">
                            <script>
                                getReceitasTotal("<?php echo $this->_tpl_vars['tip']['idTipoLancamento']; ?>
",<?php echo $this->_tpl_vars['cal']['MES']; ?>
,<?php echo $this->_tpl_vars['cal']['ANO']; ?>
);
                            </script>
                        </td>
                        <?php endif; ?> 
                        <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?>
                    </tr>
                    <?php endforeach; endif; unset($_from); ?>
                </tbody>
                <thead class="ui-widget-header ">
                    <tr>
                        <th style="width: 150px;">Despesas</th>
                            <?php $_from = $this->_tpl_vars['calendario']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['cal']):
        $this->_foreach['foo']['iteration']++;
?>
                            <?php if ($this->_tpl_vars['cal']['SEMANA'] == $this->_tpl_vars['semanas2']['SEMANA']): ?>
                        <th style="width: 100px;"><?php echo $this->_tpl_vars['cal']['DIASEMANA']; ?>
 (<?php echo $this->_tpl_vars['cal']['DIA']; ?>
)</th>
                            <?php if (($this->_foreach['foo']['iteration'] == $this->_foreach['foo']['total'])): ?>
                        <th style="width: 100px;">Total do Mês</th>
                            <?php endif; ?> 
                            <?php endif; ?>
                            <?php endforeach; endif; unset($_from); ?>

                    </tr>
                </thead>
                <tbody style="margin-bottom: 30px;">
                    <?php $_from = $this->_tpl_vars['tiposLancamentos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tip']):
?>
                    <tr>
                        <td style="width: 150px;"><?php echo $this->_tpl_vars['tip']['nome']; ?>
</td>
                        <?php $_from = $this->_tpl_vars['calendario']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['cal']):
        $this->_foreach['foo']['iteration']++;
?>
                        <?php if ($this->_tpl_vars['cal']['SEMANA'] == $this->_tpl_vars['semanas2']['SEMANA']): ?>
                        <td style="width: 100px;" id="despesas<?php echo $this->_tpl_vars['cal']['DIA']; ?>
-<?php echo $this->_tpl_vars['tip']['idTipoLancamento']; ?>
">
                            <script>
                                getDespesas("<?php echo $this->_tpl_vars['tip']['idTipoLancamento']; ?>
",<?php echo $this->_tpl_vars['cal']['DIA']; ?>
,<?php echo $this->_tpl_vars['cal']['MES']; ?>
,<?php echo $this->_tpl_vars['cal']['ANO']; ?>
);
                            </script>
                        </td>
                        <?php if (($this->_foreach['foo']['iteration'] == $this->_foreach['foo']['total'])): ?>
                        <td style="width: 100px;" id="despesasTotal-<?php echo $this->_tpl_vars['tip']['idTipoLancamento']; ?>
">
                            <script>
                                getDespesasTotal("<?php echo $this->_tpl_vars['tip']['idTipoLancamento']; ?>
",<?php echo $this->_tpl_vars['cal']['MES']; ?>
,<?php echo $this->_tpl_vars['cal']['ANO']; ?>
);
                            </script>
                        </td>
                        <?php endif; ?> 
                        <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?>
                    </tr>
                    <?php endforeach; endif; unset($_from); ?>
                </tbody>

            </table>
        </div>
    </div>
    <?php endforeach; endif; unset($_from); ?>
</div>