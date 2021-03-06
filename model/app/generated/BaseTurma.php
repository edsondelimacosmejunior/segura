<?php

/**
 * BaseTurma
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idTurma
 * @property integer $idCurso
 * @property string $nome
 * @property string $periodo
 * @property string $local
 * @property string $dataTurma
 * @property string $valor
 * @property integer $idInstrutor1
 * @property integer $idInstrutor2
 * @property integer $idInstrutor3
 * @property integer $idInstrutor4
 * @property string $status
 * @property string $usuarioResponsavel
 * @property timestamp $dataCadastro
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5441 2009-01-30 22:58:43Z jwage $
 */
abstract class BaseTurma extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('turma');
        $this->hasColumn('idTurma', 'integer', 4, array('type' => 'integer', 'length' => 4, 'primary' => true, 'autoincrement' => true));
        $this->hasColumn('idCurso', 'integer', 4, array('type' => 'integer', 'length' => 4, 'notnull' => true));
        $this->hasColumn('nome', 'string', 255, array('type' => 'string', 'length' => 255, 'notnull' => true));
        $this->hasColumn('periodo', 'string', 255, array('type' => 'string', 'length' => 255, 'notnull' => true));
        $this->hasColumn('local', 'string', 255, array('type' => 'string', 'length' => 255, 'notnull' => true));
        $this->hasColumn('dataTurma', 'string', 255, array('type' => 'string', 'length' => 255, 'notnull' => true));
        $this->hasColumn('valor', 'string', 255, array('type' => 'string', 'length' => 255, 'notnull' => true));
        $this->hasColumn('idInstrutor1', 'integer', 4, array('type' => 'integer', 'length' => 4, 'notnull' => true));
        $this->hasColumn('idInstrutor2', 'integer', 4, array('type' => 'integer', 'length' => 4, 'notnull' => true));
        $this->hasColumn('idInstrutor3', 'integer', 4, array('type' => 'integer', 'length' => 4, 'notnull' => true));
        $this->hasColumn('idInstrutor4', 'integer', 4, array('type' => 'integer', 'length' => 4, 'notnull' => true));
        $this->hasColumn('status', 'string', 255, array('type' => 'string', 'length' => 255, 'notnull' => true));
        $this->hasColumn('usuarioResponsavel', 'string', 255, array('type' => 'string', 'length' => 255, 'notnull' => true));
        $this->hasColumn('dataCadastro', 'timestamp', null, array('type' => 'timestamp', 'notnull' => true));
    }

}