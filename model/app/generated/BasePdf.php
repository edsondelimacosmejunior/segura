<?php

/**
 * BasePdf
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idPdf
 * @property string $nomeMotorista
 * @property string $cpfMotorista
 * @property string $dataNascimentoMotorista
 * @property string $enderecoMotorista
 * @property string $bairroMotorista
 * @property string $cepMotorista
 * @property string $cidadeMotorista
 * @property string $ufMotorista
 * @property string $telefoneMotorista
 * @property string $celularMotorista
 * @property string $paiMotorista
 * @property string $maeMotorista
 * @property string $rgMotorista
 * @property string $expedicaoRgMotorista
 * @property string $OrgaoMotorista
 * @property string $habilitacaoMotorista
 * @property string $expedicaoHabilitacaoMotorista
 * @property string $validadeHabilitacaoMotorista
 * @property string $registroHabilitacaoMotorista
 * @property string $placaVeiculo
 * @property string $marcaVeiculo
 * @property string $cidadeVeiculo
 * @property string $ufVeiculo
 * @property string $renavamVeiculo
 * @property string $chassiVeiculo
 * @property string $registroVeiculo
 * @property string $capacidadeVeiculo
 * @property string $corVeiculo
 * @property string $anoVeiculo
 * @property string $nomeProprietario
 * @property string $telefoneProprietario
 * @property string $celularProprietario
 * @property string $cpf_cnpjProprietario
 * @property string $inscricaoEstadualProprietario
 * @property string $enderecoProprietario
 * @property string $bairroProprietario
 * @property string $cepProprietario
 * @property string $cidadeProprietario
 * @property string $ufProprietario
 * @property string $rgProprietario
 * @property string $expedicaoRgProprietario
 * @property string $orgaoProprietario
 * @property string $dataNascimentoProprietario
 * @property string $paiProprietario
 * @property string $maeProprietario
 * @property string $nitProprietario
 * @property string $contaProprietario
 * @property string $agenciaProprietario
 * @property string $bancoProprietario
 * @property string $destinoCarga
 * @property string $valorFreteCarga
 * @property string $pesoCarga
 * @property string $localCarregamentoCarga
 * @property string $naturezaFreteCarga
 * @property string $adiantamentoCarga
 * @property string $icmsCarga
 * @property string $descargaCarga
 * @property string $notaFiscalCarga
 * @property string $ctrcCarga
 * @property string $nomeUsuario
 * @property string $idEmbarque
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5441 2009-01-30 22:58:43Z jwage $
 */
abstract class BasePdf extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('pdf');
        $this->hasColumn('idPdf', 'integer', 4, array('type' => 'integer', 'length' => 4, 'primary' => true, 'autoincrement' => true));
        $this->hasColumn('nomeMotorista', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('cpfMotorista', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('dataNascimentoMotorista', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('enderecoMotorista', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('bairroMotorista', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('cepMotorista', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('cidadeMotorista', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('ufMotorista', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('telefoneMotorista', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('celularMotorista', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('paiMotorista', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('maeMotorista', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('rgMotorista', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('expedicaoRgMotorista', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('OrgaoMotorista', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('habilitacaoMotorista', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('expedicaoHabilitacaoMotorista', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('validadeHabilitacaoMotorista', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('registroHabilitacaoMotorista', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('placaVeiculo', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('marcaVeiculo', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('cidadeVeiculo', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('ufVeiculo', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('renavamVeiculo', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('chassiVeiculo', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('registroVeiculo', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('capacidadeVeiculo', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('corVeiculo', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('anoVeiculo', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('nomeProprietario', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('telefoneProprietario', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('celularProprietario', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('cpf_cnpjProprietario', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('inscricaoEstadualProprietario', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('enderecoProprietario', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('bairroProprietario', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('cepProprietario', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('cidadeProprietario', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('ufProprietario', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('rgProprietario', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('expedicaoRgProprietario', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('orgaoProprietario', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('dataNascimentoProprietario', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('paiProprietario', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('maeProprietario', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('nitProprietario', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('contaProprietario', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('agenciaProprietario', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('bancoProprietario', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('destinoCarga', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('valorFreteCarga', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('pesoCarga', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('localCarregamentoCarga', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('naturezaFreteCarga', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('adiantamentoCarga', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('icmsCarga', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('descargaCarga', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('notaFiscalCarga', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('ctrcCarga', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('nomeUsuario', 'string', 255, array('type' => 'string', 'length' => 255));
        $this->hasColumn('idEmbarque', 'string', 255, array('type' => 'string', 'length' => 255));
    }

}