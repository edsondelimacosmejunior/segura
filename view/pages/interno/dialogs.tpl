<script>
    $(function() {
        $("#dialog-formularioTipoLancamento").dialog({
            height: 250,
            width: 600,
            modal: true,
            autoOpen: false
        });
    });

    $(function() {
        $("#dialog-formularioEditaTipoLancamento").dialog({
            height: 250,
            width: 600,
            modal: true,
            autoOpen: false
        });
    });

    $(function() {
        $("#dialog-formularioFormaPagamento").dialog({
            height: 250,
            width: 600,
            modal: true,
            autoOpen: false
        });
    });

    $(function() {
        $("#dialog-formularioEditaFormaPagamento").dialog({
            height: 250,
            width: 600,
            modal: true,
            autoOpen: false
        });
    });
    
    $(function() {
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