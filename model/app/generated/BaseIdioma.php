<?php

/**
 * BaseIdioma
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $IdIdioma
 * @property integer $IdProduto
 * @property string $nome
 * @property string $descricao
 * @property string $ingredientes
 * @property string $nomeIdioma
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5441 2009-01-30 22:58:43Z jwage $
 */
abstract class BaseIdioma extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('idioma');
        $this->hasColumn('IdIdioma', 'integer', 4, array('type' => 'integer', 'length' => 4, 'primary' => true, 'autoincrement' => true));
        $this->hasColumn('IdProduto', 'integer', 4, array('type' => 'integer', 'length' => 4));
        $this->hasColumn('nome', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('descricao', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('ingredientes', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('nomeIdioma', 'string', 255, array('type' => 'string', 'length' => 255));
    }

}