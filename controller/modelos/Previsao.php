<?php
class Previsao{
    private $idPrevisao;
    private $cidadePrevisao;
    private $tempo;
    private $nascerSol;
    private $porSol;
    private $velocidadeVento;
    private $imagem;
    private $umidade;
    private $temperatura;
    public function __construct()
    {
        
    }
    public function setIdPrevisao($idPrevisao){
        $this->idPrevisao = $idPrevisao;
    }
    public function getIdPrevisao(){
        return $this->idPrevisao;
    }
    public function setCidadePrevisao($cidadePrevisao){
        $this->cidadePrevisao = $cidadePrevisao;
    }
    public function getCidadePrevisao(){
        return $this->cidadePrevisao;
    }
    public function setTempo($tempo){
        $this->tempo = $tempo;
    }
    public function getTempo(){
        return $this->tempo;
    }
    public function setNascerDoSol($nascerSol){
        $this->nascerSol = $nascerSol;
    }
    public function getNascerDoSol(){
        return $this->nascerSol;
    }
    public function setPorDoSol($porSol){
        $this->porSol = $porSol;
    }
    public function getPorDoSol(){
        return $this->porSol;
    }
    public function setVelocidadeDoVento($velocidadeVento){
        $this->velocidadeVento = $velocidadeVento;
    }
    public function getVelocidadeDoVento(){
        return $this->velocidadeVento;
    }
    public function setImagem($imagem){
        $this->imagem = $imagem;
    }
    public function getImagem(){
        return $this->imagem;
    }
    public function setUmidade($umidade){
        $this->umidade = $umidade;
    }
    public function getUmidade(){
        return $this->umidade;
    }
    public function setTemperatura($temperatura){
        $this->temperatura = $temperatura;
    }
    public function getTemperatura(){
        return $this->temperatura;
    }
}
?>