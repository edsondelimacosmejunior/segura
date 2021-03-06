<?php

/**
 * BaseLancamentofinanceiro
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idLancamentoFinanceiro
 * @property string $nome
 * @property string $descricao
 * @property integer $origemNotaFiscal
 * @property integer $pagarReceber
 * @property string $status
 * @property date $dataEmissao
 * @property date $dataVencimento
 * @property date $dataBaixa
 * @property float $valorOriginal
 * @property float $desconto
 * @property float $juros
 * @property float $cartorio
 * @property float $valorLiquido
 * @property float $valorBaixado
 * @property timestamp $dataCriacao
 * @property integer $usuarioCriacao
 * @property integer $idEmpresa
 * @property integer $idCentroCusto
 * @property integer $idFormaPagamento
 * @property integer $idTipoLancamento
 * @property Centrocusto $Centrocusto
 * @property Empresa $Empresa
 * @property Formapagamento $Formapagamento
 * @property Tipolancamento $Tipolancamento
 * @property Usuario $Usuario
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5441 2009-01-30 22:58:43Z jwage $
 */
abstract class BaseLancamentofinanceiro extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('lancamentofinanceiro');
        $this->hasColumn('idLancamentoFinanceiro', 'integer', 4, array('type' => 'integer', 'length' => 4, 'primary' => true, 'autoincrement' => true));
        $this->hasColumn('nome', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('descricao', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('origemNotaFiscal', 'integer', 4, array('type' => 'integer', 'length' => 4, 'default' => '0'));
        $this->hasColumn('pagarReceber', 'integer', 4, array('type' => 'integer', 'length' => 4));
        $this->hasColumn('status', 'string', 45, array('type' => 'string', 'length' => 45));
        $this->hasColumn('dataEmissao', 'date', null, array('type' => 'date'));
        $this->hasColumn('dataVencimento', 'date', null, array('type' => 'date'));
        $this->hasColumn('dataBaixa', 'date', null, array('type' => 'date'));
        $this->hasColumn('valorOriginal', 'float', null, array('type' => 'float'));
        $this->hasColumn('desconto', 'float', null, array('type' => 'float', 'notnull' => true));
        $this->hasColumn('juros', 'float', null, array('type' => 'float', 'notnull' => true));
        $this->hasColumn('cartorio', 'float', null, array('type' => 'float', 'notnull' => true));
        $this->hasColumn('valorLiquido', 'float', null, array('type' => 'float', 'notnull' => true));
        $this->hasColumn('valorBaixado', 'float', null, array('type' => 'float'));
        $this->hasColumn('dataCriacao', 'timestamp', null, array('type' => 'timestamp'));
        $this->hasColumn('usuarioCriacao', 'integer', 4, array('type' => 'integer', 'length' => 4, 'notnull' => true));
        $this->hasColumn('idEmpresa', 'integer', 4, array('type' => 'integer', 'length' => 4, 'notnull' => true));
        $this->hasColumn('idCentroCusto', 'integer', 4, array('type' => 'integer', 'length' => 4, 'notnull' => true));
        $this->hasColumn('idFormaPagamento', 'integer', 4, array('type' => 'integer', 'length' => 4, 'notnull' => true));
        $this->hasColumn('idTipoLancamento', 'integer', 4, array('type' => 'integer', 'length' => 4, 'notnull' => true));
    }

    public function setUp()
    {
        $this->hasOne('Centrocusto', array('local' => 'idCentroCusto',
                                           'foreign' => 'idCentroCusto'));

        $this->hasOne('Empresa', array('local' => 'idEmpresa',
                                       'foreign' => 'idEmpresa'));

        $this->hasOne('Formapagamento', array('local' => 'idFormaPagamento',
                                              'foreign' => 'idFormaPagamento'));

        $this->hasOne('Tipolancamento', array('local' => 'idTipoLancamento',
                                              'foreign' => 'idTipoLancamento'));

        $this->hasOne('Usuario', array('local' => 'usuarioCriacao',
                                       'foreign' => 'idUsuario'));
    }
}