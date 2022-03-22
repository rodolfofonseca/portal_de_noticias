<?php
class Pais{
    private $idPais;
    private $nomePais;
    private $sigla;
    public function __construct()
    {
    }
    public function setIdPais($idPais){
        $this->idPais = $idPais;
    }
    public function getIdPais(){
        return $this->idPais;
    }
    public function setNomePais($nomePais){
        $this->nomePais = $nomePais;
    }
    public function getNomePais(){
        return $this->nomePais;
    }
    public function setSigla($sigla){
        $this->sigla = $sigla;
    }
    public function getSigla(){
        return $this->sigla;
    }
}
?>