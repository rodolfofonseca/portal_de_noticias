<?php
require_once 'utilidades/DAO.php';
require_once 'modelos/Categoria.php';
class CategoriaCtr{
    public $dao;
    public function __construct()
    {
        $this->dao = new DAO();
    }
    public function Salvar($model){
        try{
            $dados = array($model->getDescricaoCategoria(), $model->getApareceMenu());
            $retorno = $this->dao->Salvar('categoria', 'descricao_categoria, aparece_menu', $dados);
            return $retorno;
        }catch(Exception $ex){
            return false;
        }
    }
    public function Alterar($model){
        
    }
    public function Pesquisar(){
        try{
            $comando = 'select * from categoria order by descricao_categoria';
            return $this->dao->Pesquisar($comando);
        }catch(Exception $ex){
            return '';
        }
    }
}
?>