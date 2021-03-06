<?php

/**
 * BaseProprietario
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idProprietario
 * @property string $cpf
 * @property string $nome
 * @property string $rg
 * @property date $dataNascimento
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5441 2009-01-30 22:58:43Z jwage $
 */
abstract class BaseProprietario extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('proprietario');
        $this->hasColumn('idProprietario', 'integer', 4, array('type' => 'integer', 'length' => 4, 'primary' => true, 'autoincrement' => true));
        $this->hasColumn('cpf', 'string', 30, array('type' => 'string', 'length' => 30));
        $this->hasColumn('nome', 'string', 80, array('type' => 'string', 'length' => 80));
        $this->hasColumn('rg', 'string', 30, array('type' => 'string', 'length' => 30));
        $this->hasColumn('dataNascimento', 'date', null, array('type' => 'date'));
    }

}