<?php
require_once 'controller/modelos/Empresa.php';
require_once 'controller/utilidades/DAO.php';
require_once 'controller/utilidades/LogDoSistema.php';
class EmpresaCtr{
    private $dao;
    private $logDoSistema;
    public function __construct()
    {
        $this->dao = new DAO();
        $this->LogDoSistema = new LogDoSistema();
    }
    public function Salvar($model){
        try{
            $dados = array($model->getNomeEmpresa(), $model->getTelefoneContato(), $model->getWhatsapp(), $model->getObservacao(), $model->getStatus());
            return $this->dao->Salvar('empresa', 'nome_empresa, telefone_contato, whatsapp, observacoes, status', $dados);
        }catch(Exception $ex){
            $this->logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
            return false;
        }
    }
    public function Alterar($model){
        try{
            $dados = array($model->getNomeEmpresa(), $model->getTelefoneContato(), $model->getWhatsapp(), $model->getObservacao(), $model->getStatus(), $model->getIdEmpresa());
            $campos = array('nome_empresa', 'telefone_contato', 'whatsapp', 'observacoes', 'status');
            return $this->dao->Alterar('empresa', $campos, $dados, 'id_empresa');
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