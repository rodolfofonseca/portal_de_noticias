<?php
class Locais{
    private $idLocais;
    private $descricao;
    private $observacoes;
    public function __autoload(){}
    public function setIdLcais($idLocais){
        $this->idLocais = $idLocais;
    }
    public function getIdLocais(){
        return $this->idLocais;
    }
    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }
    public function getDescricao(){
        return $this->descricao;
    }
    public function setObservacoes($observacoes){
        $this->observacoes = $observacoes;
    }
    public function getObservacoes(){
        return $this->observacoes;
    }
}
?>