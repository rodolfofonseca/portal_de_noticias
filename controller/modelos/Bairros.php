<?php
class Bairros{
    private $idBairro;
    private $nomeBairro;
    private $cidade;
    public function __construct()
    {
    }
    public function setIdBairro($idBairro){
        $this->idBairro = $idBairro;
    }
    public function getIdBairro(){
        return $this->idBairro;
    }
    public function setNomeBairro($nomeBairro){
        $this->nomeBairro = $nomeBairro;
    }
    public function getNomeBairro(){
        return $this->nomeBairro;
    }
    public function setCidade($cidade){
        $this->cidade = $cidade;
    }
    public function getCidade(){
        return $this->cidade;
    }
}
?>