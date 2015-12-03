<?php

/**
 * BaseEmpresa
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idEmpresa
 * @property string $nomeFantasia
 * @property string $razaoSocial
 * @property string $cnpj
 * @property string $rua
 * @property string $numero
 * @property string $bairro
 * @property string $cep
 * @property string $cidade
 * @property string $uf
 * @property string $contato
 * @property string $telefone1
 * @property string $telefone2
 * @property string $email
 * @property string $inscricaoEstadual
 * @property string $inscricaoMunicipal
 * @property string $observacao
 * @property string $status
 * @property string $usuarioResponsavel
 * @property timestamp $dataCadastro
 * @property Doctrine_Collection $Lancamentofinanceiro
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5441 2009-01-30 22:58:43Z jwage $
 */
abstract class BaseEmpresa extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('empresa');
        $this->hasColumn('idEmpresa', 'integer', 4, array('type' => 'integer', 'length' => 4, 'primary' => true, 'autoincrement' => true));
        $this->hasColumn('nomeFantasia', 'string', 255, array('type' => 'string', 'length' => 255, 'notnull' => true));
        $this->hasColumn('razaoSocial', 'string', 255, array('type' => 'string', 'length' => 255, 'notnull' => true));
        $this->hasColumn('cnpj', 'string', 255, array('type' => 'string', 'length' => 255, 'notnull' => true));
        $this->hasColumn('rua', 'string', 255, array('type' => 'string', 'length' => 255, 'notnull' => true));
        $this->hasColumn('numero', 'string', 255, array('type' => 'string', 'length' => 255, 'notnull' => true));
        $this->hasColumn('bairro', 'string', 255, array('type' => 'string', 'length' => 255, 'notnull' => true));
        $this->hasColumn('cep', 'string', 255, array('type' => 'string', 'length' => 255, 'notnull' => true));
        $this->hasColumn('cidade', 'string', 255, array('type' => 'string', 'length' => 255, 'notnull' => true));
        $this->hasColumn('uf', 'string', 2, array('type' => 'string', 'length' => 2, 'notnull' => true));
        $this->hasColumn('contato', 'string', 255, array('type' => 'string', 'length' => 255, 'notnull' => true));
        $this->hasColumn('telefone1', 'string', 255, array('type' => 'string', 'length' => 255, 'notnull' => true));
        $this->hasColumn('telefone2', 'string', 255, array('type' => 'string', 'length' => 255, 'notnull' => true));
        $this->hasColumn('email', 'string', 255, array('type' => 'string', 'length' => 255, 'notnull' => true));
        $this->hasColumn('inscricaoEstadual', 'string', 255, array('type' => 'string', 'length' => 255, 'notnull' => true));
        $this->hasColumn('inscricaoMunicipal', 'string', 255, array('type' => 'string', 'length' => 255, 'notnull' => true));
        $this->hasColumn('observacao', 'string', 255, array('type' => 'string', 'length' => 255, 'notnull' => true));
        $this->hasColumn('status', 'string', 255, array('type' => 'string', 'length' => 255, 'notnull' => true));
        $this->hasColumn('usuarioResponsavel', 'string', 255, array('type' => 'string', 'length' => 255, 'notnull' => true));
        $this->hasColumn('dataCadastro', 'timestamp', null, array('type' => 'timestamp', 'notnull' => true));
    }

    public function setUp()
    {
        $this->hasMany('Lancamentofinanceiro', array('local' => 'idEmpresa',
                                                     'foreign' => 'idEmpresa'));
    }
}