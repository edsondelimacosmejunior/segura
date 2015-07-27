<?php /* Smarty version 2.6.18, created on 08-07-2015 21:35:21
         compiled from pages/interno/menu2.tpl */ ?>
<input type="text" value="<?php echo $_SESSION['nivel']; ?>
" id="menu_nivelAcesso" style="display: none;" readonly/></td>
<input type="text" value="<?php echo $_SESSION['os']; ?>
" id="menu_os" style="display: none;" readonly/></td>

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
            openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/aluno/mostrarCadastro/");
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }
    
    function menu_listarAluno() {
        if ($("#menu_nivelAcesso").val() === "Admin" || $("#menu_nivelAcesso").val() === "Coord") {
            openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/aluno/listarAlunos/");
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }
    
    function menu_pesquisarAluno() {
        if ($("#menu_nivelAcesso").val() == "Admin" || $("#menu_nivelAcesso").val() == "Coord") {
            openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/aluno/mostrarPesquisa/")
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }
    
    function menu_cadastrarCurso() {
        if ($("#menu_nivelAcesso").val() === "Admin" || $("#menu_nivelAcesso").val() === "Coord") {
            openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/curso/mostrarCadastro/");
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }
    
    function menu_listarCurso() {
        if ($("#menu_nivelAcesso").val() === "Admin" || $("#menu_nivelAcesso").val() === "Coord") {
            openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/curso/listarCursos/");
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }
    
    function menu_cadastrarEmpresa() {
        if ($("#menu_nivelAcesso").val() == "Admin" || $("#menu_nivelAcesso").val() == "Coord") {
            openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/empresa/mostrarCadastro/")
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }
    
    function menu_listarEmpresa() {
        if ($("#menu_nivelAcesso").val() === "Admin" || $("#menu_nivelAcesso").val() === "Coord") {
            openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/empresa/listarEmpresas/");
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }
    
    function menu_cadastrarInstrutor() {
        if ($("#menu_nivelAcesso").val() === "Admin" || $("#menu_nivelAcesso").val() === "Coord") {
            openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/instrutor/mostrarCadastro/");
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }
    
    function menu_listarInstrutor() {
        if ($("#menu_nivelAcesso").val() === "Admin" || $("#menu_nivelAcesso").val() === "Coord") {
            openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/instrutor/listarInstrutores/");
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }
    
    function menu_cadastrarTurma() {
        if ($("#menu_nivelAcesso").val() === "Admin" || $("#menu_nivelAcesso").val() === "Coord") {
            openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/turma/mostrarCadastro/");
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }
    
    function menu_listarTurma() {
        if ($("#menu_nivelAcesso").val() === "Admin" || $("#menu_nivelAcesso").val() === "Coord") {
            openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/turma/listarTurmas/");
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }
    
    function menu_listarTurmaAtiva() {
        if ($("#menu_nivelAcesso").val() === "Admin" || $("#menu_nivelAcesso").val() === "Coord") {
            openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/turma/listarTurmasAtivas/");
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }
    
    function menu_listarTurmaConcluida() {
        if ($("#menu_nivelAcesso").val() === "Admin" || $("#menu_nivelAcesso").val() === "Coord") {
            openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/turma/listarTurmasConcluidas/");
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }
    
    function menu_realizarMatricula() {
        if ($("#menu_nivelAcesso").val() === "Admin" || $("#menu_nivelAcesso").val() === "Coord") {
            openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/turma/mostrarRealizarMatricula/");
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }
    
    function menu_cadastrarUsuario() {
        if ($("#menu_nivelAcesso").val() === "Admin") {
            openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/usuario/mostrarCadastro/");
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }
    
    function menu_listarUsuario() {
        if ($("#menu_nivelAcesso").val() === "Admin" || $("#menu_nivelAcesso").val() === "Coord") {
            openlink("<?php echo $this->_tpl_vars['BASE_PATH']; ?>
interno/modulo/usuario/listarUsuarios/");
        } else {
            $().message("Você não tem acesso a essa funcionalidade. Caso necessite, entre em contato com o departamento de Tecnologia da Informação.");
        }
    }
    

</script>