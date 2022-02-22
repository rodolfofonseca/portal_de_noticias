<?php
require_once 'utilidades/DAO.php';
require_once 'utilidades/LogDoSistema.php';
require_once 'modelos/Categoria.php';
class CategoriaCtr{
    private $dao = NULL;
    private $logDoSistema = NULL;
    public function __construct()
    {
        $this->dao = new DAO();
        $this->logDoSistema = new LogDoSistema();
    }
    public function Salvar($model){
        try{
            $dados = array($model->getMenu()->getIdMenu() ,$model->getDescricaoCategoria(), $model->getApareceMenu());
            $retorno = $this->dao->Salvar('categoria', 'id_menu_categoria, descricao_categoria, aparece_menu', $dados);
            return $retorno;
        }catch(Exception $ex){
            $this->logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
            return false;
        }
    }
    public function Alterar($model){
        try{
            $dados = array($model->getMenu()->getIdMenu(), $model->getDescricaoCategoria(), $model->getApareceMenu(), $model->getIdCategoria());
            $campos = array('id_menu_categoria', 'descricao_categoria', 'aparece_menu');
            return $this->dao->Alterar('categoria', $campos, $dados, 'id_categoria');
        }catch(Exception $ex){
            $this->logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
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
?>