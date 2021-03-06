<?php
require_once 'modelos/Menu.php';
require_once 'utilidades/DAO.php';
require_once 'utilidades/LogDoSistema.php';
class MenuCtr{
    private $dao;
    private $log;
    public function __construct()
    {
        $this->dao = new DAO();
        $this->log = new LogDoSistema();
    }
    public function Salvar($model){
        try{
            $dados = array($model->getDescricaoMenu(), $model->getApareceMenu(), $model->getTemSubMenu());
            return $this->dao->Salvar('menu', 'descricao_menu, aparece_menu_menu, tem_sub_menu', $dados);
        }catch(Exception $ex){
            $this->log->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
            return false;
        }
    }
    public function Alterar($model){
        try{
            $dados = array($model->getDescricaoMenu(), $model->getApareceMenu(), $model->getTemSubMenu(),$model->getIdMenu());
            $campos = array('descricao_menu', 'aparece_menu_menu', 'tem_sub_menu');
            return $this->dao->Alterar('menu', $campos, $dados, 'id_menu');
        }catch(Exception $ex){
            $this->logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
            return false;
        }
    }
    public function Pesquisar(){
        try{
            return $this->dao->Pesquisar('select * from menu order by descricao_menu');
        }catch(Exception $ex){
            $this->logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
            return array();
        }
    }
    public function ExcutarComando($comando){
        try{
            $this->dao->ExecutarComando($comando);
        }catch(Exception $ex){
            $this->logDoSistema->EscreverArquivo($ex->getMessage());
        }
    }
}
?>