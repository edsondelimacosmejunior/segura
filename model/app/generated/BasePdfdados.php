<?php

/**
 * BasePdfdados
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idPdf
 * @property integer $idMotorista
 * @property integer $idVeiculo
 * @property integer $idProprietario
 * @property integer $idCarga
 * @property integer $idEmbarque
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5441 2009-01-30 22:58:43Z jwage $
 */
abstract class BasePdfdados extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('pdfdados');
        $this->hasColumn('idPdf', 'integer', 4, array('type' => 'integer', 'length' => 4, 'primary' => true, 'autoincrement' => true));
        $this->hasColumn('idMotorista', 'integer', 4, array('type' => 'integer', 'length' => 4));
        $this->hasColumn('idVeiculo', 'integer', 4, array('type' => 'integer', 'length' => 4));
        $this->hasColumn('idProprietario', 'integer', 4, array('type' => 'integer', 'length' => 4));
        $this->hasColumn('idCarga', 'integer', 4, array('type' => 'integer', 'length' => 4));
        $this->hasColumn('idEmbarque', 'integer', 4, array('type' => 'integer', 'length' => 4));
    }

}