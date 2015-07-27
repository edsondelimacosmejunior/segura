<?php

/**
 * BaseAgenciador
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idAgenciador
 * @property string $tipo
 * @property string $cpf
 * @property string $nome
 * @property string $rg
 * @property date $dataNascimento
 * @property string $apelido
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5441 2009-01-30 22:58:43Z jwage $
 */
abstract class BaseAgenciador extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('agenciador');
        $this->hasColumn('idAgenciador', 'integer', 4, array('type' => 'integer', 'length' => 4, 'primary' => true, 'autoincrement' => true));
        $this->hasColumn('tipo', 'string', 45, array('type' => 'string', 'length' => 45));
        $this->hasColumn('cpf', 'string', 30, array('type' => 'string', 'length' => 30));
        $this->hasColumn('nome', 'string', 80, array('type' => 'string', 'length' => 80));
        $this->hasColumn('rg', 'string', 30, array('type' => 'string', 'length' => 30));
        $this->hasColumn('dataNascimento', 'date', null, array('type' => 'date'));
        $this->hasColumn('apelido', 'string', 45, array('type' => 'string', 'length' => 45));
    }

}