<?php
require_once 'controller/modelos/CidadePrevisao.php';
require_once 'controller/modelos/Cidade.php';
require_once 'controller/utilidades/LogDoSistema.php';
require_once 'controller/utilidades/DAO.php';
class CidadePrevisaoCtr{
    private $logDoSistema;
    private $dao;
    public function __construct()
    {
        $this->logDoSistema = new LogDoSistema();
        $this->dao = new DAO();
    }
    public function Salvar($model){
        try{
            $dados = array($model->getCidade()->getIdCidade(), $model->getCodigo());
            return $this->dao->Salvar('cidade_previsao', 'id_cidade, codigo', $dados);
        }catch(Exception $ex){
            $this->logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
            return false;
        }
    }
    public function Alterar($model){
        try{
            $dados = array($model->getCidade()->getIdCidade(), $model->getCodigo(), $model->getIdCidadePrevisao());
            $campos = array('id_cidade', 'codigo');
            return $this->dao->Alterar('cidade_previsao', $campos, $dados, 'id_cidade_previsao');
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