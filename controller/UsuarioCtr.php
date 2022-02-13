<?php
require_once 'utilidades/DAO.php';
require_once 'modelos/Usuario.php';
class UsuarioCtr{
    public $dao;
    public function __construct()
    {
        $this->dao = new DAO();
    }
    public function Salvar($model){
        try{
            $dados = array($model->getNomeUsuario(), $model->getEmailUsuario(), md5($model->getSenhaUsuario()));
            $retorno = $this->dao->Salvar('usuario', 'nome_usuario, email_usuario, senha_usuario', $dados);
            if($retorno == true){
                return true;
            }else{
                return false;
            }
        }catch(Exception $ex){
            return false;
        }
    }
    public function Alterar($model){
        try{
            $dados = array($model->getNomeUsuario(),$model->getEmailUsuario(),md5( $model->getSenhaUsuario()), $model->getIdUsuario());
            $campos = array('nome_usuario', 'email_usuario', 'senha_usuario');
            $retorno = $this->dao->Alterar('usuario', $campos, $dados, 'id_usuario');
            if($retorno == true){
                return true;
            }else{
                return false;
            }
        }catch(Exception $ex){
            return false;
        }
    }
    public function Pesquisar($pesquisar){
        try{
            $retorno = $this->dao->Pesquisar($pesquisar);
            return $retorno;
        }catch(Exception $ex){
            return '';
        }
    }
}
?>