<?php
require_once 'controller/modelos/ContratoPublicidade.php';
require_once 'controller/utilidades/DAO.php';
require_once 'controller/utilidades/LogDoSistema.php';
class ContratoPublicidadeCtr{
    private $dao;
    private $logDoSistema;
    public function __construct()
    {
        $this->dao = new DAO();
        $this->logDoSistema = new LogDoSistema();
    }
    public function Salvar($model){
        try{
            $dados = array($model->getUsuarioCadastro()->getIdUsuario(), $model->getUsuarioAssinaturaContrato()->getIdUsuario(), $model->getEmpresa()->getIdEmpresa(), $model->getDataAssinatura(), $model->getValorContrato(), $model->getTipoPagamento(), $model->getDataInicio(), $model->getDataFim(),$model->getObservacoes());
            return $this->dao->Salvar('contrato_publicidade', 'id_usuario_cadastro, id_usuario_assinatura_contrato, id_empresa, data_assinatura, valor_contrato, tipo_pagamento, data_inicio, data_fim, observacoes', $dados);
        }catch(Exception $ex){
            $this->logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
            return false;
        }
    }
    public function Alterar($model){
        try{
            $dados = array($model->getUsuarioCadastro()->getIdUsuario(), $model->getUsuarioAssinaturaContrato()->getIdUsuario(), $model->getEmpresa()->getIdEmpresa(), $model->getDataAssinatura(), $model->getValorContrato(), $model->getTipoPagamento(), $model->getDataInicio(), $model->getDataFim(),$model->getObservacoes(), $model->getIdContrato());
            $campos = array('id_usuario_cadastro', 'id_usuario_assinatura_contrato', 'id_empresa', 'data_assinatura', 'valor_contrato', 'tipo_pagamento', 'data_inicio', 'data_fim', 'observacoes');
            return $this->dao->Alterar('contrato_publicidade', $campos, $dados, 'id_contrato');
        }catch(Exception $ex){
            $this->logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
            return false;
        }
    }
    public function Pesquisar($comando){
        try{
            return $this->dao->Pesquisar($comando);
        }catch(Exception $ex){
            $this->logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
            return array();
        }
    }
}
?>