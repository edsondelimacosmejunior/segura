<?php

/**
 * BaseCurso
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idCurso
 * @property string $nome
 * @property string $cargaHoraria
 * @property string $conteudo
 * @property string $patchConteudo
 * @property string $validade
 * @property string $valor
 * @property string $corFundo
 * @property string $corFonte
 * @property string $tamanhoFonte
 * @property string $status
 * @property string $usuarioResponsavel
 * @property timestamp $dataCadastro
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5441 2009-01-30 22:58:43Z jwage $
 */
abstract class BaseCurso extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('curso');
        $this->hasColumn('idCurso', 'integer', 4, array('type' => 'integer', 'length' => 4, 'primary' => true, 'autoincrement' => true));
        $this->hasColumn('nome', 'string', 255, array('type' => 'string', 'length' => 255, 'notnull' => true));
        $this->hasColumn('cargaHoraria', 'string', 255, array('type' => 'string', 'length' => 255, 'notnull' => true));
        $this->hasColumn('conteudo', 'string', null, array('type' => 'string', 'notnull' => true));
        $this->hasColumn('patchConteudo', 'string', 255, array('type' => 'string', 'length' => 255, 'notnull' => true));
        $this->hasColumn('validade', 'string', 255, array('type' => 'string', 'length' => 255, 'notnull' => true));
        $this->hasColumn('valor', 'string', 255, array('type' => 'string', 'length' => 255, 'notnull' => true));
        $this->hasColumn('corFundo', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('corFonte', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('tamanhoFonte', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('status', 'string', 255, array('type' => 'string', 'length' => 255, 'notnull' => true));
        $this->hasColumn('usuarioResponsavel', 'string', 255, array('type' => 'string', 'length' => 255, 'notnull' => true));
        $this->hasColumn('dataCadastro', 'timestamp', null, array('type' => 'timestamp', 'notnull' => true));
    }

}