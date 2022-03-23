<?php
require_once 'controller/modelos/Cidade.php';
require_once 'controller/utilidades/DAO.php';
require_once 'controller/utilidades/LogDoSistema.php';
class CidadeCtr
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
            $dados = array($model->getEstado()->getIdEstado(), $model->getNomeCidade());
            return $this->dao->Salvar('cidade', 'id_estado, nome_cidade', $dados);
        } catch (Exception $ex) {
            $this->logNoSistema->EscreverArquivo('logNoSistema.txt', $ex->getMessage());
            return false;
        }
    }
    public function Alterar($model)
    {
        try {
            $dados = array($model->getEstado()->getIdEstado(), $model->getNomeCidade(), $model->getIdCidade());
            $campos = array('id_estado', 'nome_cidade');
            return $this->dao->Alterar('cidade', $campos, $dados, 'id_cidade');
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
