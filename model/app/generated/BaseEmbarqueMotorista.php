<?php

/**
 * BaseEmbarquemotorista
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idEmbarquemotorista
 * @property integer $idEmbarque
 * @property integer $idMotorista
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5441 2009-01-30 22:58:43Z jwage $
 */
abstract class BaseEmbarquemotorista extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('embarquemotorista');
        $this->hasColumn('idEmbarquemotorista', 'integer', 4, array('type' => 'integer', 'length' => 4, 'primary' => true, 'autoincrement' => true));
        $this->hasColumn('idEmbarque', 'integer', 4, array('type' => 'integer', 'length' => 4, 'notnull' => true));
        $this->hasColumn('idMotorista', 'integer', 4, array('type' => 'integer', 'length' => 4, 'notnull' => true));
    }

}