<?php
class Cidade{
    private $idCidade;
    private $nomeCidade;
    private $estado;
    public function __construct()
    {
    }
    public function setIdCidade($idCidade){
        $this->idCidade = $idCidade;
    }
    public function getIdCidade(){
        return $this->idCidade;
    }
    public function setNomeCidade($nomeCidade){
        $this->nomeCidade = $nomeCidade;
    }
    public function getNomeCidade(){
        return $this->nomeCidade;
    }
    public function setEstado($estado){
        $this->estado = $estado;
    }
    public function getEstado(){
        return $this->estado;
    }
}
?>