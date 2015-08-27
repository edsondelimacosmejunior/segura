<input type="text" value="{{$smarty.session.nivel}}" id="menu_nivelAcesso" style="display: none;" readonly/></td>
<input type="text" value="{{$smarty.session.os}}" id="menu_os" style="display: none;" readonly/></td>

<div id="caixaMenu">
    <div id="menu">
        <ul class="menu">
            <li><a href=""><span>Início</span></a></li>
            <li><a class="parent"><span>Aluno</span></a>
                <ul>
                    <li><a href="javascript:menu_cadastrarAluno();"><span>Cadastrar</span></a></li>
                    <li><a href="javascript:menu_listarAluno();"><span>Listar</span></a></li>
                    <li><a href="javascript:menu_pesquisarAluno();"><span>Pesquisar</span></a></li>
                </ul>
            </li>
            <li><a><span>Curso</span></a>
                <ul>
                    <li><a href="javascript:menu_cadastrarCurso();"><span>Cadastrar</span></a></li>
                    <li><a href="javascript:menu_listarCurso();"><span>Listar</span></a></li>
                </ul>
            </li>

            <li><a><span>Empresa</span></a>
                <ul>
                    <li><a href="javascript:menu_cadastrarEmpresa();"><span>Cadastrar</span></a></li>
                    <li><a href="javascript:menu_listarEmpresa();"><span>Listar</span></a></li>
                </ul>
            </li>
            <li><a><span>Financeiro</span></a>
                <ul>
                    <li>
                        <a href="javascript:menu_listarTipoLancamento();"><span>Tipo de Lançamento</span></a>
                    </li>
                    <li>
                        <a href="javascript:menu_listarFormaPagamento();"><span>Forma de Pagamento</span></a>
                    </li>
                    <li>
                        <a href="javascript:menu_listarCentroCusto();"><span>Centro de Custo</span></a>
                    </li>
                    <li><a class="parent"><span>Lançamentos</span></a>
                        <ul>
                            <li><a href="javascript:menu_cadastrarLancamentoFinanceiro();"><span>Cadastrar</span></a></li>
                            <li><a href="javascript:menu_listarLancamentoFinanceiro();"><span>Listar</span></a></li>
                        </ul>
                    </li>
                    <li><a class="parent"><span>Relatórios</span></a>
                        <ul>
                            <li><a href="javascript:menu_mostrarRelatorioDespesa();"><span>Despesas</span></a></li>
                            <li><a href="javascript:menu_mostrarRelatorioReceita();"><span>Receita</span></a></li>
                            <li><a href="javascript:menu_mostrarRelatorioFluxoCaixa();"><span>Fluxo de Caixa</span></a></li>
                            <li><a href="javascript:menu_mostrarRelatorioFluxoCaixaPrevisto();"><span>Fluxo de Caixa Previsto</span></a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a><span>Instrutor</span></a>
                <ul>
                    <li><a href="javascript:menu_cadastrarInstrutor();"><span>Cadastrar</span></a></li>
                    <li><a href="javascript:menu_listarInstrutor();"><span>Listar</span></a></li>
                </ul>
            </li>

            <li><a><span>Turma</span></a>
                <ul>
                    <li><a href="javascript:menu_cadastrarTurma();"><span>Cadastrar</span></a></li>
                    <li><a href="javascript:menu_listarTurma();"><span>Listar Todas</span></a></li>
                    <li><a href="javascript:menu_listarTurmaAtiva();"><span>Listar em Aberto</span></a></li>
                    <li><a href="javascript:menu_listarTurmaConcluida();"><span>Listar Concluídas</span></a></li>
                </ul>
            </li>

            <li><a><span>Usuário</span></a>
                <ul>
                    <li><a href="javascript:menu_cadastrarUsuario();"><span>Cadastrar</span></a></li>
                    <li><a href="javascript:menu_listarUsuario();"><span>Listar</span></a></li>
                </ul>
            </li>

            <li class="last"><a href="logout"><span>Sair</span></a></li>
        </ul>
    </div>

</div>


<script type="text/javascript" charset="utf-8">
    function menu_cadastrarAluno() {
        if ($("#menu_nivelAcesso").val() === "Admin" || $("#menu_nivelAcesso").val() === "Coord") {
            openlink("{{$BASE_PATH}}interno/modulo/aluno/mostrarCadastro/");
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }

    function menu_listarAluno() {
        if ($("#menu_nivelAcesso").val() === "Admin" || $("#menu_nivelAcesso").val() === "Coord") {
            openlink("{{$BASE_PATH}}interno/modulo/aluno/listarAlunos/");
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }

    function menu_pesquisarAluno() {
        if ($("#menu_nivelAcesso").val() == "Admin" || $("#menu_nivelAcesso").val() == "Coord") {
            openlink("{{$BASE_PATH}}interno/modulo/aluno/mostrarPesquisa/")
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }

    function menu_cadastrarCurso() {
        if ($("#menu_nivelAcesso").val() === "Admin" || $("#menu_nivelAcesso").val() === "Coord") {
            openlink("{{$BASE_PATH}}interno/modulo/curso/mostrarCadastro/");
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }

    function menu_listarCurso() {
        if ($("#menu_nivelAcesso").val() === "Admin" || $("#menu_nivelAcesso").val() === "Coord") {
            openlink("{{$BASE_PATH}}interno/modulo/curso/listarCursos/");
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }

    function menu_cadastrarEmpresa() {
        if ($("#menu_nivelAcesso").val() == "Admin" || $("#menu_nivelAcesso").val() == "Coord") {
            openlink("{{$BASE_PATH}}interno/modulo/empresa/mostrarCadastro/")
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }

    function menu_listarEmpresa() {
        if ($("#menu_nivelAcesso").val() === "Admin" || $("#menu_nivelAcesso").val() === "Coord") {
            openlink("{{$BASE_PATH}}interno/modulo/empresa/listarEmpresas/");
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }

    function menu_cadastrarTipoLancamento() {
        if ($("#menu_nivelAcesso").val() == "Admin") {
            openlink("{{$BASE_PATH}}interno/modulo/financeiro/tipolancamento/abrirFormulario/")
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }

    function menu_listarTipoLancamento() {
        if ($("#menu_nivelAcesso").val() == "Admin") {
            openlink("{{$BASE_PATH}}interno/modulo/financeiro/tipolancamento/listar/")
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }
    
    function menu_listarCentroCusto() {
        if ($("#menu_nivelAcesso").val() == "Admin") {
            openlink("{{$BASE_PATH}}interno/modulo/financeiro/centrocusto/listar/")
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }

    function menu_cadastrarFormaPagamento() {
        if ($("#menu_nivelAcesso").val() == "Admin") {
            openlink("{{$BASE_PATH}}interno/modulo/financeiro/formapagamento/abrirFormulario/")
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }

    function menu_listarFormaPagamento() {
        if ($("#menu_nivelAcesso").val() == "Admin") {
            openlink("{{$BASE_PATH}}interno/modulo/financeiro/formapagamento/listar/")
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }

    function menu_cadastrarLancamentoFinanceiro() {
        if ($("#menu_nivelAcesso").val() == "Admin") {
            openlink("{{$BASE_PATH}}interno/modulo/financeiro/lancamentofinanceiro/abrirFormulario/")
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }

    function menu_listarLancamentoFinanceiro() {
        if ($("#menu_nivelAcesso").val() == "Admin") {
            openlink("{{$BASE_PATH}}interno/modulo/financeiro/lancamentofinanceiro/listar/")
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }

    function menu_mostrarRelatorioDespesa() {
        if ($("#menu_nivelAcesso").val() == "Admin") {
            openlink("{{$BASE_PATH}}interno/modulo/financeiro/relatorios/despesa/mostrar/")
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }

    function menu_mostrarRelatorioReceita() {
        if ($("#menu_nivelAcesso").val() == "Admin") {
            openlink("{{$BASE_PATH}}interno/modulo/financeiro/relatorios/receita/mostrar/")
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }

    function menu_mostrarRelatorioFluxoCaixa() {
        if ($("#menu_nivelAcesso").val() == "Admin") {
            openlink("{{$BASE_PATH}}interno/modulo/financeiro/relatorios/fluxocaixa/mostrar/")
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }

    function menu_mostrarRelatorioFluxoCaixaPrevisto() {
        if ($("#menu_nivelAcesso").val() == "Admin") {
            openlink("{{$BASE_PATH}}interno/modulo/financeiro/relatorios/fluxocaixaprevisto/mostrar/")
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }

    function menu_cadastrarInstrutor() {
        if ($("#menu_nivelAcesso").val() === "Admin" || $("#menu_nivelAcesso").val() === "Coord") {
            openlink("{{$BASE_PATH}}interno/modulo/instrutor/mostrarCadastro/");
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }

    function menu_listarInstrutor() {
        if ($("#menu_nivelAcesso").val() === "Admin" || $("#menu_nivelAcesso").val() === "Coord") {
            openlink("{{$BASE_PATH}}interno/modulo/instrutor/listarInstrutores/");
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }

    function menu_cadastrarTurma() {
        if ($("#menu_nivelAcesso").val() === "Admin" || $("#menu_nivelAcesso").val() === "Coord") {
            openlink("{{$BASE_PATH}}interno/modulo/turma/mostrarCadastro/");
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }

    function menu_listarTurma() {
        if ($("#menu_nivelAcesso").val() === "Admin" || $("#menu_nivelAcesso").val() === "Coord") {
            openlink("{{$BASE_PATH}}interno/modulo/turma/listarTurmas/");
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }

    function menu_listarTurmaAtiva() {
        if ($("#menu_nivelAcesso").val() === "Admin" || $("#menu_nivelAcesso").val() === "Coord") {
            openlink("{{$BASE_PATH}}interno/modulo/turma/listarTurmasAtivas/");
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }

    function menu_listarTurmaConcluida() {
        if ($("#menu_nivelAcesso").val() === "Admin" || $("#menu_nivelAcesso").val() === "Coord") {
            openlink("{{$BASE_PATH}}interno/modulo/turma/listarTurmasConcluidas/");
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }

    function menu_realizarMatricula() {
        if ($("#menu_nivelAcesso").val() === "Admin" || $("#menu_nivelAcesso").val() === "Coord") {
            openlink("{{$BASE_PATH}}interno/modulo/turma/mostrarRealizarMatricula/");
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }

    function menu_cadastrarUsuario() {
        if ($("#menu_nivelAcesso").val() === "Admin") {
            openlink("{{$BASE_PATH}}interno/modulo/usuario/mostrarCadastro/");
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }

    function menu_listarUsuario() {
        if ($("#menu_nivelAcesso").val() === "Admin" || $("#menu_nivelAcesso").val() === "Coord") {
            openlink("{{$BASE_PATH}}interno/modulo/usuario/listarUsuarios/");
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }


</script>