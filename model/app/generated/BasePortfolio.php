<?php

/**
 * BasePortfolio
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idPortfolio
 * @property string $nome
 * @property string $logo
 * @property string $descricaoServico
 * @property string $link
 * @property timestamp $data
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5441 2009-01-30 22:58:43Z jwage $
 */
abstract class BasePortfolio extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('portfolio');
        $this->hasColumn('idPortfolio', 'integer', 4, array('type' => 'integer', 'length' => 4, 'primary' => true, 'autoincrement' => true));
        $this->hasColumn('nome', 'string', 80, array('type' => 'string', 'length' => 80, 'notnull' => true));
        $this->hasColumn('logo', 'string', 255, array('type' => 'string', 'length' => 255, 'notnull' => true));
        $this->hasColumn('descricaoServico', 'string', null, array('type' => 'string', 'notnull' => true));
        $this->hasColumn('link', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('data', 'timestamp', null, array('type' => 'timestamp'));
    }

}