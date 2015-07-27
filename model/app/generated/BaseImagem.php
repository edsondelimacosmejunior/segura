<?php

/**
 * BaseImagem
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idImagem
 * @property integer $idProduto
 * @property string $nome
 * @property timestamp $dataInsercao
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5441 2009-01-30 22:58:43Z jwage $
 */
abstract class BaseImagem extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('imagem');
        $this->hasColumn('idImagem', 'integer', 4, array('type' => 'integer', 'length' => 4, 'primary' => true, 'autoincrement' => true));
        $this->hasColumn('idProduto', 'integer', 4, array('type' => 'integer', 'length' => 4, 'notnull' => true));
        $this->hasColumn('nome', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('dataInsercao', 'timestamp', null, array('type' => 'timestamp'));
    }

}