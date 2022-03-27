<?php
class CidadePrevisao{
    private $idCidadePrevisao;
    private $cidade;
    private $codigo;
    public function __construct()
    {
        
    }
    public function setIdCidadePrevisao($idCidadePrevisao){
        $this->idCidadePrevisao = $idCidadePrevisao;
    }
    public function getIdCidadePrevisao(){
        return $this->idCidadePrevisao;
    }
    public function setCidade($cidade){
        $this->cidade = $cidade;
    }
    public function getCidade(){
        return $this->cidade;
    }
    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }
    public function getCodigo(){
        return $this->codigo;
    }
}
?>