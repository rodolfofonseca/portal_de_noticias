<?php
class Estado{
    private $idEstado;
    private $nomeEstado;
    private $siglaEstado;
    private $pais;
    public function __construct()
    {
        
    }
    public function setIdEstado($idEstado){
        $this->idEstado = $idEstado;
    }
    public function getIdEstado(){
        return $this->idEstado;
    }
    public function setNomeEstado($nomeEstado){
        $this->nomeEstado = $nomeEstado;
    }
    public function getNomeEstado(){
        return $this->nomeEstado;
    }
    public function setSiglaEstado($siglaEstado){
        $this->siglaEstado = $siglaEstado;
    }
    public function getSiglaEstado(){
        return $this->siglaEstado;
    }
    public function setPais($pais)
    {
        $this->pais = $pais;
    }
    public function getPais(){
        return $this->pais;
    }
}
?>