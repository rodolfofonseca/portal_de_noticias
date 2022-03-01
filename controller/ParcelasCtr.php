<?php
require_once 'controller/modelos/Parcelas.php';
require_once 'controller/utilidades/DAO.php';
require_once 'controller/utilidades/LogDoSistema.php';
class ParcelasCtr{
    private $dao;
    private $logDoSistema;
    public function __construct()
    {
        $this->dao = new DAO();
        $this->logDoSistema = new LogDoSistema();
    }
    public function Salvar($model){
        try{
            $dados = array($model->getContrato->getIdContrato(), $model->getValor(), $model->getDataVencimento(), $model->getStatus());
            return $this->dao->Salvar('parcelas', 'id_contrato, valor_parcela, data_vencimento, status', $dados);
        }catch(Exception $ex){
            $this->logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
            return false;
        }
    }
    public function Alterar($model){
        try{
            $dados = array($model->getContrato->getIdContrato(), $model->getValor(), $model->getDataVencimento(), $model->getStatus(), $model->getIdParcela());
            $campos = array('id_contrato', 'valor_parcela', 'data_vencimento', 'status');
            return $this->dao->Alterar('parcelas', $campos, $dados, 'id_parcela');
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