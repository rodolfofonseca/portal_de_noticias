<?php
require_once 'controller/modelos/Locais.php';
require_once 'controller/utilidades/LogDoSistema.php';
require_once 'controller/utilidades/DAO.php';
class LocaisCtr{
    private $dao;
    private $logDoSistema;
    public function __construct()
    {
        $this->dao = new DAO();
        $this->logDoSistema = new LogDoSistema();
    }
    public function Salvar($model){
        try{
            $dados = array($model->getDescricao(), $model->getObservacoes());
            return $this->dao->Salvar('locais', 'descricao, observacao', $dados);
        }catch(Exception $ex){
            $this->logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
            return false;
        }
    }
    public function Alterar($model){
        try{
            $dados = array($model->getDescricao(), $model->getObservacoes(), $model->getIdLocais());
            $campos = array('descricao', 'observacao');
            return $this->dao->Alterar('locais', $campos, $dados, 'id_local');
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