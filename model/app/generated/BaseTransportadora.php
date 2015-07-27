<?php

/**
 * BaseTransportadora
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idTransportadora
 * @property string $cnpj
 * @property string $razaoSocial
 * @property string $inscricaoEstadual
 * @property date $dataFundacao
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5441 2009-01-30 22:58:43Z jwage $
 */
abstract class BaseTransportadora extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('transportadora');
        $this->hasColumn('idTransportadora', 'integer', 4, array('type' => 'integer', 'length' => 4, 'primary' => true, 'autoincrement' => true));
        $this->hasColumn('cnpj', 'string', 80, array('type' => 'string', 'length' => 80));
        $this->hasColumn('razaoSocial', 'string', 80, array('type' => 'string', 'length' => 80));
        $this->hasColumn('inscricaoEstadual', 'string', 80, array('type' => 'string', 'length' => 80));
        $this->hasColumn('dataFundacao', 'date', null, array('type' => 'date'));
    }

}