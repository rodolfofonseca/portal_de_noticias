<?php
require_once 'controller/modelos/Bairros.php';
require_once 'controller/utilidades/DAO.php';
require_once 'controller/utilidades/LogDoSistema.php';
class BairroCtr
{
    private $dao;
    private $logNoSistema;
    public function __construct()
    {
        $this->dao = new DAO();
        $this->logNoSistema = new LogDoSistema();
    }
    public function Salvar($model)
    {
        try {
            $dados = array($model->getCidade()->getIdCidade(), $model->getNomeBairro());
            return $this->dao->Salvar('bairros', 'id_cidade, nome_bairro', $dados);
        } catch (Exception $ex) {
            $this->logNoSistema->EscreverArquivo('logNoSistema.txt', $ex->getMessage());
            return false;
        }
    }
    public function Alterar($model)
    {
        try {
            $dados = array($model->getCidade()->getIdCidade(), $model->getNomeBairro(), $model->getIdBairro());
            $campos = array('id_cidade', 'nome_bairro');
            return $this->dao->Alterar('bairros', $campos, $dados, 'id_bairros');
        } catch (Exception $ex) {
            $this->logNoSistema->EscreverArquivo('logNoSistema.txt', $ex->getMessage());
            return false;
        }
    }
    public function Pesquisar($comando){
        try{
            return $this->dao->Pesquisar($comando);
        }catch(Exception $ex){
            $this->logDoSistema->EscreverArquivo('logDoSistema', $ex->getMessage());
            return array();
        }
    }
}
