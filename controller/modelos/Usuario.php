<?php
/**
 * Classe responsável por modelar o objeto Usuario.
 */
class Usuario{
    private $idUsuario = 0;
    private $nomeUsuario = '';
    private $emailUsuario = '';
    private $senhaUsuario = '';
    private $statusUsuario = '';
    private $tipoUsuario = '';
    public function __construct()
    {
    }
    public function setIdUsuario($id){
        $this->idUsuario = $id;
    }
    public function getIdUsuario(){
        return $this->idUsuario;
    }
    public function setNomeUsuario($nome){
        $this->nomeUsuario = $nome;
    }
    public function getNomeUsuario(){
        return $this->nomeUsuario;
    }
    public function setEmailUsuario($email){
        $this->emailUsuario = $email;
    }
    public function getEmailUsuario(){
        return $this->emailUsuario;
    }
    public function setSenhaUsuario($senha){
        $this->senhaUsuario = $senha;
    }
    public function getSenhaUsuario(){
        return $this->senhaUsuario;
    }
    public function setTipoUsuario($tipoUsuario){
        $this->tipoUsuario = $tipoUsuario;
    }
    public function getTipoUsuario(){
        return $this->tipoUsuario;
    }
    public function setStatusUsuario($statusUsuario){
        $this->statusUsuario = $statusUsuario;
    }
    public function getStatusUsuario(){
        return $this->statusUsuario;
    }
}
?>