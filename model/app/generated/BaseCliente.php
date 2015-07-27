<?php

/**
 * BaseCliente
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idCliente
 * @property string $nome
 * @property string $matricula
 * @property string $cpf
 * @property string $rg
 * @property date $dataEmissao
 * @property string $email
 * @property string $telefone
 * @property string $celular
 * @property string $sexo
 * @property date $dataNascimento
 * @property integer $idade
 * @property string $escolaridade
 * @property string $naturalidade
 * @property string $estadoNascimento
 * @property string $endereco
 * @property integer $numero
 * @property string $bairro
 * @property string $cidade
 * @property string $estado
 * @property string $cep
 * @property date $dataCadastro
 * @property string $observacao
 * @property string $status
 * @property string $nivel
 * @property string $login
 * @property string $senha
 * @property string $candidato
 * @property string $aluno
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5441 2009-01-30 22:58:43Z jwage $
 */
abstract class BaseCliente extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('cliente');
        $this->hasColumn('idCliente', 'integer', 4, array('type' => 'integer', 'length' => 4, 'primary' => true, 'autoincrement' => true));
        $this->hasColumn('nome', 'string', null, array('type' => 'string'));
        $this->hasColumn('matricula', 'string', null, array('type' => 'string'));
        $this->hasColumn('cpf', 'string', null, array('type' => 'string'));
        $this->hasColumn('rg', 'string', null, array('type' => 'string'));
        $this->hasColumn('dataEmissao', 'date', null, array('type' => 'date'));
        $this->hasColumn('email', 'string', null, array('type' => 'string'));
        $this->hasColumn('telefone', 'string', null, array('type' => 'string'));
        $this->hasColumn('celular', 'string', null, array('type' => 'string'));
        $this->hasColumn('sexo', 'string', null, array('type' => 'string'));
        $this->hasColumn('dataNascimento', 'date', null, array('type' => 'date'));
        $this->hasColumn('idade', 'integer', 4, array('type' => 'integer', 'length' => 4));
        $this->hasColumn('escolaridade', 'string', null, array('type' => 'string'));
        $this->hasColumn('naturalidade', 'string', null, array('type' => 'string'));
        $this->hasColumn('estadoNascimento', 'string', null, array('type' => 'string'));
        $this->hasColumn('endereco', 'string', null, array('type' => 'string'));
        $this->hasColumn('numero', 'integer', 4, array('type' => 'integer', 'length' => 4));
        $this->hasColumn('bairro', 'string', null, array('type' => 'string'));
        $this->hasColumn('cidade', 'string', null, array('type' => 'string'));
        $this->hasColumn('estado', 'string', null, array('type' => 'string'));
        $this->hasColumn('cep', 'string', null, array('type' => 'string'));
        $this->hasColumn('dataCadastro', 'date', null, array('type' => 'date'));
        $this->hasColumn('observacao', 'string', null, array('type' => 'string'));
        $this->hasColumn('status', 'string', null, array('type' => 'string'));
        $this->hasColumn('nivel', 'string', null, array('type' => 'string'));
        $this->hasColumn('login', 'string', null, array('type' => 'string'));
        $this->hasColumn('senha', 'string', null, array('type' => 'string'));
        $this->hasColumn('candidato', 'string', null, array('type' => 'string'));
        $this->hasColumn('aluno', 'string', null, array('type' => 'string'));
    }

}