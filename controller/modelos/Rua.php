<?php
class Rua{
    private $idRua;
    private $nomeRua;
    private $bairro;
    public function __construct()
    {   
    }
    public function setIdRua($idRua){
        $this->idRua = $idRua;
    }
    public function getIdRua(){
        return $this->idRua;
    }
    public function setNomeRua($nomeRua){
        $this->nomeRua = $nomeRua;
    }
    public function getNomeRua(){
        return $this->nomeRua;
    }
    public function setBairro($bairro){
        $this->bairro = $bairro;
    }
    public function getBairro(){
        return $this->bairro;
    }
}
?>