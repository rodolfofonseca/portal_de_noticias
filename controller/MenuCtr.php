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
            $dados = array($model->getDescricaoMenu(), $model->getApareceMenu());
            return $this->dao->Salvar('menu', 'descricao_menu, aparece_menu_menu', $dados);
        }catch(Exception $ex){
            $this->log->EscreverArquivo($ex);
            return false;
        }
    }
    public function Alterar($model){
        try{
            $dados = array($model->getDescricaoMenu(), $model->getApareceMenu(), $model->getIdMenu());
            $campos = array('descricao_categoria', 'aparece_menu_menu');
            return $this->dao->Alterar('menu', $campos, $dados, 'id_menu');
        }catch(Exception $ex){
            $this->log->EscreverArquivo($ex);
            return false;
        }
    }
    public function Pesquisar(){
        try{
            return $this->dao->Pesquisar('select * from menu order by descricao_menu');
        }catch(Exception $ex){
            $this->log->EscreverArquivo($ex);
            return array();
        }
    }
}
?>