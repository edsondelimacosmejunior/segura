<?php

/**
 * BaseLocalizacao
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idLocalizacao
 * @property integer $idBde
 * @property string $latitude
 * @property string $longitude
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5441 2009-01-30 22:58:43Z jwage $
 */
abstract class BaseLocalizacao extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('localizacao');
        $this->hasColumn('idLocalizacao', 'integer', 4, array('type' => 'integer', 'length' => 4, 'primary' => true, 'autoincrement' => true));
        $this->hasColumn('idBde', 'integer', 4, array('type' => 'integer', 'length' => 4));
        $this->hasColumn('latitude', 'string', 80, array('type' => 'string', 'length' => 80));
        $this->hasColumn('longitude', 'string', 80, array('type' => 'string', 'length' => 80));
    }

}