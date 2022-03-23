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
            $dados = array();
            return $this->dao->Salvar('', '', $dados);
        } catch (Exception $ex) {
            $this->logNoSistema->EscreverArquivo('logNoSistema.txt', $ex->getMessage());
            return false;
        }
    }
    public function Alterar($model)
    {
        try {
            $dados = array();
            $campos = array();
            return $this->dao->Alterar('', $campos, $dados, '');
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
