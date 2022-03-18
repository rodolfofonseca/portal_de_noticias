<?php
require_once 'controller/modelos/EmailContato.php';
require_once 'controller/utilidades/DAO.php';
require_once 'controller/utilidades/LogDoSistema.php';
class EmailContatoCtr{
    private $dao;
    private $logDoSistema;
    public function __construct()
    {
        $this->dao = new DAO();
        $this->logDoSistema = new LogDoSistema();
    }
    public function Salvar($model){
        try{
            $dados = array($model->getEmail(), $model->getStatus());
            return $this->dao->Salvar('contato', 'email_contato, status', $dados);
        }catch(Exception $ex){
            $this->logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
        }
    }
}
?>