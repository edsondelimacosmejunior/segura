<script type="text/javascript">
    $(function() {
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

<script>$("#statusInformacao").html("Você está em: Financeiro >> Lançamentos >> Listar >> Visualizar.");</script>

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
                    <td><input type="text" id="formLancamento_empresa" size="70" value="{{$lancamento.nomeFantasia}}" readonly="" /></td>
                </tr>
            </table>
        </fieldset>
        <fieldset style="background-color: whitesmoke;">
            <legend>Dados do Lançamento</legend>
            <table> 
                <tr>
                    <td><label for="formLancamento_nome">Nome:</label></td>
                    <td><input type="text" id="formLancamento_nome" size="70" value="{{$lancamento.nome}}" readonly="" /></td>
                </tr>
                <tr>
                    <td><label for="formLancamento_descricao">Descrição:</label></td>
                    <td><input type="text" id="formLancamento_descricao" size="70" value="{{$lancamento.descricao}}" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formLancamento_pagarReceber">Pagar/Receber:</label></td>
                    <td><input type="text" id="formLancamento_pagarReceber" size="70" value="{{$lancamento.pagarReceberNome}}" readonly="" /></td>
                </tr>
                <tr>
                    <td><label for="formLancamento_centroCusto">Centro de Custo:</label></td>
                    <td><input type="text" id="formLancamento_centroCusto" size="70" value="{{$lancamento.centroCusto}}" readonly="" /></td>
                </tr>
                <tr>
                    <td><label for="formLancamento_tipoLancamento">Tipo de Lançamento:</label></td>
                    <td><input type="text" id="formLancamento_tipoLancamento" size="70" value="{{$lancamento.tipoLancamento}}" readonly="" /></td>
                </tr>
                <tr>
                    <td><label for="formLancamento_formaPagamento">Forma de Pagamento:</label></td>
                    <td><input type="text" id="formLancamento_nome" size="70" value="{{$lancamento.formaPagamento}}" readonly="" /></td>
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
                    <td><input type="text" id="formLancamento_valorOriginal" size="70" onKeyDown="Mascara(this, Moeda);" value="{{$lancamento.valorOriginal}}" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formLancamento_valorBaixado">Valor Baixado:</label></td>
                    <td><input type="text" id="formLancamento_valorBaixado" size="70" onKeyDown="Mascara(this, Moeda);" value="{{$lancamento.valorBaixado}}" readonly=""/></td>
                </tr>
            </table>
        </fieldset>
        <fieldset style="background-color: whitesmoke;">
            <legend>Datas do Lançamento</legend>
            <table> 
                <tr>
                    <td><label for="formLancamento_dataEmissao">Data de Emissão:</label></td>
                    <td><input type="text" id="formLancamento_dataEmissao" size="70" onKeyDown="Mascara(this, Data);" value="{{$lancamento.dataEmissao}}" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formLancamento_dataVencimento">Data de Vencimento:</label></td>
                    <td><input type="text" id="formLancamento_dataVencimento" size="70" onKeyDown="Mascara(this, Data);" value="{{$lancamento.dataVencimento}}" readonly=""/></td>
                </tr>
                <tr>
                    <td><label for="formLancamento_dataBaixa">Data de Baixa:</label></td>
                    <td><input type="text" id="formLancamento_dataBaixa" size="70" onKeyDown="Mascara(this, Data);" value="{{$lancamento.dataBaixa}}" readonly=""/></td>
                </tr>
            </table>
        </fieldset>
    </div>
</div>