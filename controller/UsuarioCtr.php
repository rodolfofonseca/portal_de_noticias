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
            $dados = array($model->getNomeUsuario(), $model->getEmailUsuario(), md5($model->getSenhaUsuario()), $model->getStatusUsuario(), $model->getTipoUsuario());
            $retorno = $this->dao->Salvar('usuario', 'nome_usuario, email_usuario, senha_usuario, status, tipo_usuario', $dados);
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
            $dados = array($model->getNomeUsuario(),$model->getEmailUsuario(),md5( $model->getSenhaUsuario()), $model->getStatusUsuario(), $model->getTipoUsuario(), $model->getIdUsuario());
            $campos = array('nome_usuario', 'email_usuario', 'senha_usuario', 'status', 'tipo_usuario');
            $retorno = $this->dao->Alterar('usuario', $campos, $dados, 'id_usuario');
            if($retorno == true){
                return true;
            }else{
                return false;
            }
        }catch(Exception $ex){
            echo $ex->getMessage();
            return false;
        }
    }
    public function Pesquisar($pesquisar){
        try{
            $retorno = $this->dao->Pesquisar($pesquisar);
            return $retorno;
        }catch(Exception $ex){
            echo $ex->getMessage();
            return '';
        }
    }
    /**
     * Método responsável por salvar os dados para contato por email, sempre que é realizado o cadastro de novas matérias.
     */
    public function SalvarContato($model){
        try{
            $dados = array($model->getEmailUsuario(), $model->getStatusUsuario());
            return $this->dao->Salvar('contato', 'email_contato, status', $dados);
        }catch(Exception $ex){
            echo $ex->getMessage();
            return false;
        }
    }
}
?>