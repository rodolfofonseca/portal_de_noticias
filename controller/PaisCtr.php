<?php
require_once 'controller/modelos/Pais.php';
require_once 'controller/utilidades/DAO.php';
require_once 'controller/utilidades/LogDoSistema.php';
class PaisCtr
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
            $dados = array($model->getNomePais(), $model->getSigla());
            return $this->dao->Salvar('pais', 'nome_pais, sigla', $dados);
        } catch (Exception $ex) {
            $this->logNoSistema->EscreverArquivo('logNoSistema.txt', $ex->getMessage());
            return false;
        }
    }
    public function Alterar($model)
    {
        try {
            $dados = array($model->getNomePais(), $model->getSigla(), $model->getIdPais());
            $campos = array('nome_pais', 'sigla');
            return $this->dao->Alterar('pais', $campos, $dados, 'id_pais');
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
