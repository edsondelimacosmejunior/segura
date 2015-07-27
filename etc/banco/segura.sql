-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.5.32 - MySQL Community Server (GPL)
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura do banco de dados para segura
CREATE DATABASE IF NOT EXISTS `segura` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `segura`;


-- Copiando estrutura para tabela segura.aluno
CREATE TABLE IF NOT EXISTS `aluno` (
  `idAluno` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `sexo` varchar(255) NOT NULL,
  `cpf` varchar(255) NOT NULL,
  `rg` varchar(255) NOT NULL,
  `dataNascimento` varchar(255) NOT NULL,
  `rua` varchar(255) NOT NULL,
  `numero` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `cep` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone1` varchar(255) NOT NULL,
  `telefone2` varchar(255) NOT NULL,
  `escolaridade` varchar(255) NOT NULL,
  `vinculo` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `usuarioResponsavel` varchar(255) NOT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idAluno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela segura.curso
CREATE TABLE IF NOT EXISTS `curso` (
  `idCurso` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `cargaHoraria` varchar(255) NOT NULL,
  `conteudo` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `usuarioResponsavel` varchar(255) NOT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idCurso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela segura.empresa
CREATE TABLE IF NOT EXISTS `empresa` (
  `idEmpresa` int(11) NOT NULL AUTO_INCREMENT,
  `nomeFantasia` varchar(255) NOT NULL,
  `razaoSocial` varchar(255) NOT NULL,
  `cnpj` varchar(255) NOT NULL,
  `rua` varchar(255) NOT NULL,
  `numero` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `cep` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `contato` varchar(255) NOT NULL,
  `telefone1` varchar(255) NOT NULL,
  `telefone2` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `inscricaoEstadual` varchar(255) NOT NULL,
  `inscricaoMunicipal` varchar(255) NOT NULL,
  `observacao` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `usuarioResponsavel` varchar(255) NOT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idEmpresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela segura.instrutor
CREATE TABLE IF NOT EXISTS `instrutor` (
  `idInstrutor` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `sexo` varchar(255) NOT NULL,
  `cpf` varchar(255) NOT NULL,
  `rg` varchar(255) NOT NULL,
  `dataNascimento` varchar(255) NOT NULL,
  `rua` varchar(255) NOT NULL,
  `numero` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `cep` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone1` varchar(255) NOT NULL,
  `telefone2` varchar(255) NOT NULL,
  `escolaridade` varchar(255) NOT NULL,
  `formacao` varchar(255) NOT NULL,
  `numeroRegistro` varchar(255) NOT NULL,
  `patchCurriculum` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `usuarioResponsavel` varchar(255) NOT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idInstrutor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela segura.matricula
CREATE TABLE IF NOT EXISTS `matricula` (
  `idMatricula` int(11) NOT NULL AUTO_INCREMENT,
  `idTurma` int(11) NOT NULL DEFAULT '0',
  `idAluno` int(11) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL,
  `pagamento` varchar(255) NOT NULL,
  `usuarioResponsavel` varchar(255) NOT NULL DEFAULT '0',
  `dataCadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idMatricula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela segura.turma
CREATE TABLE IF NOT EXISTS `turma` (
  `idTurma` int(11) NOT NULL AUTO_INCREMENT,
  `idCurso` int(11) NOT NULL,
  `periodo` varchar(255) NOT NULL,
  `local` varchar(255) NOT NULL,
  `idInstrutor` int(11) NOT NULL,
  `dataTurma` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `usuarioResponsavel` varchar(255) NOT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idTurma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela segura.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `nivel` varchar(255) NOT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
