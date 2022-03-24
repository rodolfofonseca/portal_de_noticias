<?php
require_once 'controller/modelos/Rua.php';
require_once 'controller/utilidades/DAO.php';
require_once 'controller/utilidades/LogDoSistema.php';
class RuaCtr
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
            $dados = array($model->getBairro()->getIdBairro(), $model->getNomeRua());
            return $this->dao->Salvar('rua', 'id_bairro, nome_rua', $dados);
        } catch (Exception $ex) {
            $this->logNoSistema->EscreverArquivo('logNoSistema.txt', $ex->getMessage());
            return false;
        }
    }
    public function Alterar($model)
    {
        try {
            $dados = array($model->getBairro()->getIdBairro(), $model->getNomeRua(), $model->getIdRua());
            $campos = array('id_bairro', 'nome_rua');
            return $this->dao->Alterar('rua', $campos, $dados, 'id_rua');
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
