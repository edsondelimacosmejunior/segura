<script>
    /*LancamentoFinanceiro Pai de Mascaras*/
    function Mascara(o, f) {
        v_obj = o;
        v_fun = f;
        setTimeout("execmascara()", 1);
    }

    /*LancamentoFinanceiro que Executa os objetos*/
    function execmascara() {
        v_obj.value = v_fun(v_obj.value);
    }
    
    function Moeda(v) {
        //v = z.value;
        v = v.replace(/\D/g, "");  //permite digitar apenas números
        //v=v.replace(/[0-9]{12}/,"inválido")   //limita pra máximo 999.999.999,99
        //v=v.replace(/(\d{1})(\d{8})$/,"$1.$2")  //coloca ponto antes dos últimos 8 digitos
        //v=v.replace(/(\d{1})(\d{5})$/,"$1.$2")  //coloca ponto antes dos últimos 5 digitos
        v = v.replace(/(\d{1})(\d{1,2})$/, "$1.$2");        //coloca virgula antes dos últimos 2 digitos
        return v;
    }   
    
</script>

<script>
    $(function () {
        $("#dialog-formularioTipoLancamento").dialog({
            height: 250,
            width: 600,
            modal: true,
            autoOpen: false
        });
    });

    $(function () {
        $("#dialog-formularioEditaTipoLancamento").dialog({
            height: 250,
            width: 600,
            modal: true,
            autoOpen: false
        });
    });

    $(function () {
        $("#dialog-formularioCentroCusto").dialog({
            height: 250,
            width: 600,
            modal: true,
            autoOpen: false
        });
    });

    $(function () {
        $("#dialog-formularioEditaCentroCusto").dialog({
            height: 250,
            width: 600,
            modal: true,
            autoOpen: false
        });
    });

    $(function () {
        $("#dialog-formularioFormaPagamento").dialog({
            height: 250,
            width: 600,
            modal: true,
            autoOpen: false
        });
    });

    $(function () {
        $("#dialog-formularioEditaFormaPagamento").dialog({
            height: 250,
            width: 600,
            modal: true,
            autoOpen: false
        });
    });

    $(function () {
        $("#dialog-formularioBaixaLancamento").dialog({
            height: 250,
            width: 600,
            modal: true,
            autoOpen: false
        });
    });


</script>

<div id="dialog-buscaAlunos" title="Alunos">
    <table id="dialog-buscaAlunos" style="width: 100%; text-align: center;">
        <thead class="ui-widget-header ">
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>RG</th>
                <th>Data de Nascimento</th>
                <th>Escolha</th>
            </tr>
        </thead>
        <tbody id="dialog-buscaAlunos_alunosResultado">

        </tbody>
    </table>
</div>

<div id="dialog-addObservacao" title="Adicionar Observação">
    <p><input type="text" id="observacao" size="45" maxlength="255"/></p>
</div>

<div id="dialog-addFormaPagamento" title="Adicionar Forma de Pagamento">
    <table>
        <tr>
            <td><label for="dialog-formaPagamento">Forma de Pagamento:</label></td>
            <td>
                <select id="dialog-addFormaPagamento_formaPagamento">
                    <option value="13">À VISTA</option>                    
                    {{foreach from=$formasPagamentos item=formasPagamentos}}
                    <option value="{{$formasPagamentos.idFormaPagamento}}">{{$formasPagamentos.nome}}</option>
                    {{/foreach}}
                </select> 
            </td>
        </tr>
        <tr>
            <td><label for="dialog-addFormaPagamento_valorBaixado">Valor Baixado:</label></td>
            <td><input type="text" id="dialog-addFormaPagamento_valorBaixado" size="50" onKeyDown="Mascara(this, Moeda);" onKeyPress="Mascara(this, Moeda);" onKeyUp="Mascara(this, Moeda);"/></td>
        </tr>
        
    </table>
</div>

<div id="dialog-formularioTipoLancamento" title="Novo Tipo de Lançamento">
    <table>
        <tr>
            <td><label for="dialog-formularioTipoLancamento_nome">Tipo de Lançamento:</label></td>
            <td><input type="text" id="dialog-formularioTipoLancamento_nome" size="50" maxlength="50" /></td>
        </tr>
        <tr>
            <td><label for="dialog-formularioTipoLancamento_descricao">Descrição:</label></td>
            <td><input type="text" id="dialog-formularioTipoLancamento_descricao" size="50" maxlength="50" /></td>
        </tr>
        <tr>
            <td><button onclick="gravarTipoLancamento()" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" >Gravar</button></td>
        </tr>
    </table>
</div>


<div id="dialog-formularioEditaTipoLancamento" title="Editar Tipo de Lançamento">
    <table>
        <tr>
            <td><input type="text" id="dialog-formularioEditaTipoLancamento_id" size="10" style="display: none" readonly /></td>
        </tr>
        <tr>
            <td><label for="dialog-formularioEditaTipoLancamento_nome">Tipo de Lançamento:</label></td>
            <td><input type="text" id="dialog-formularioEditaTipoLancamento_nome" size="50" maxlength="50" /></td>
        </tr>
        <tr>
            <td><label for="dialog-formularioEditaTipoLancamento_descricao">Descrição:</label></td>
            <td><input type="text" id="dialog-formularioEditaTipoLancamento_descricao" size="50" maxlength="50" /></td>
        </tr>
        <tr>
            <td><button onclick="editarTipoLancamento()" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" >Gravar</button></td>
        </tr>
    </table>
</div>

<div id="dialog-formularioCentroCusto" title="Novo Centro de Custo">
    <table>
        <tr>
            <td><label for="dialog-formularioCentroCusto_nome">Centro de Custo:</label></td>
            <td><input type="text" id="dialog-formularioCentroCusto_nome" size="50" maxlength="50" /></td>
        </tr>
        <tr>
            <td><label for="dialog-formularioCentroCusto_descricao">Descrição:</label></td>
            <td><input type="text" id="dialog-formularioCentroCusto_descricao" size="50" maxlength="50" /></td>
        </tr>
        <tr>
            <td><button onclick="gravarCentroCusto()" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" >Gravar</button></td>
        </tr>
    </table>
</div>


<div id="dialog-formularioEditaCentroCusto" title="Editar Centro de Custo">
    <table>
        <tr>
            <td><input type="text" id="dialog-formularioEditaCentroCusto_id" size="10" style="display: none" readonly /></td>
        </tr>
        <tr>
            <td><label for="dialog-formularioEditaCentroCusto_nome">Centro de Custo:</label></td>
            <td><input type="text" id="dialog-formularioEditaCentroCusto_nome" size="50" maxlength="50" /></td>
        </tr>
        <tr>
            <td><label for="dialog-formularioEditaCentroCusto_descricao">Descrição:</label></td>
            <td><input type="text" id="dialog-formularioEditaCentroCusto_descricao" size="50" maxlength="50" /></td>
        </tr>
        <tr>
            <td><button onclick="editarCentroCusto()" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" >Gravar</button></td>
        </tr>
    </table>
</div>


<div id="dialog-formularioFormaPagamento" title="Nova Forma de Pagamento">
    <table>
        <tr>
            <td><label for="dialog-formularioFormaPagamento_nome">Forma de Pagamento:</label></td>
            <td><input type="text" id="dialog-formularioFormaPagamento_nome" size="50" maxlength="50" /></td>
        </tr>
        <tr>
            <td><label for="dialog-formularioFormaPagamento_descricao">Descrição:</label></td>
            <td><input type="text" id="dialog-formularioFormaPagamento_descricao" size="50" maxlength="50" /></td>
        </tr>
        <tr>
            <td><button onclick="gravarFormaPagamento()" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" >Gravar</button></td>
        </tr>
    </table>
</div>              

<div id="dialog-formularioEditaFormaPagamento" title="Editar Forma de Pagamento">
    <table>
        <tr>
            <td><input type="text" id="dialog-formularioEditaFormaPagamento_id" size="10" style="display: none" readonly /></td>
        </tr>
        <tr>
            <td><label for="dialog-formularioEditaFormaPagamento_nome">Forma de Pagamento:</label></td>
            <td><input type="text" id="dialog-formularioEditaFormaPagamento_nome" size="50" maxlength="50" /></td>
        </tr>
        <tr>
            <td><label for="dialog-formularioEditaFormaPagamento_descricao">Descrição:</label></td>
            <td><input type="text" id="dialog-formularioEditaFormaPagamento_descricao" size="50" maxlength="50" /></td>
        </tr>
        <tr>
            <td><button onclick="editarFormaPagamento()" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" >Gravar</button></td>
        </tr>
    </table>
</div>

<div id="dialog-formularioBaixaLancamento" title="Baixar Lançamento">
    <table>
        <tr>
            <td><input type="text" id="dialog-formularioBaixaLancamento_id" size="10" style="display: none" readonly /></td>
        </tr>
        <tr>
            <td><label for="dialog-formularioBaixaLancamento_valorOriginal">Valor Original:</label></td>
            <td><input type="text" id="dialog-formularioBaixaLancamento_valorOriginal" size="50" maxlength="50" readonly="" /></td>
        </tr>
        <tr>
            <td><label for="dialog-formularioBaixaLancamento_desconto">Desconto:</label></td>
            <td><input type="text" id="dialog-formularioBaixaLancamento_desconto" size="50" maxlength="50" readonly="" /></td>
        </tr>
        <tr>
            <td><label for="dialog-formularioBaixaLancamento_juros">Juros:</label></td>
            <td><input type="text" id="dialog-formularioBaixaLancamento_juros" size="50" maxlength="50" readonly="" /></td>
        </tr>
        <tr>
            <td><label for="dialog-formularioBaixaLancamento_cartorio">Cartório:</label></td>
            <td><input type="text" id="dialog-formularioBaixaLancamento_cartorio" size="50" maxlength="50" readonly="" /></td>
        </tr>
        <tr>
            <td><label for="dialog-formularioBaixaLancamento_valorLiquido">Valor Líquido:</label></td>
            <td><input type="text" id="dialog-formularioBaixaLancamento_valorLiquido" size="50" maxlength="50" readonly="" /></td>
        </tr>
        <tr>
            <td><label for="dialog-formularioBaixaLancamento_valorBaixado">Valor Baixado:</label></td>
            <td><input type="text" id="dialog-formularioBaixaLancamento_valorBaixado" size="50" maxlength="50" onKeyDown="Mascara(this, Moeda);" /></td>
        </tr>
        <tr>
            <td><label for="dialog-formularioBaixaLancamento_dataBaixa">Data de Baixa:</label></td>
            <td><input type="text" id="dialog-formularioBaixaLancamento_dataBaixa" size="50" maxlength="50" onKeyDown="Mascara(this, Data);" /></td>
        </tr>
        <tr>
            <td><button onclick="efetuarBaixa()" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" >Gravar</button></td>
        </tr>
    </table>
</div>