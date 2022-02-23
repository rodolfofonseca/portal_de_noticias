<?php
class paragrafos{
    private $idParagrafos = 0;
    private $noticia = NULL;
    private $imagem = '';
    private $texto = '';
    private $localImagem = '';
    public function __construct(){}
    public function setIdParagrafos($idParagrafos){
        $this->idParagrafos = $idParagrafos;
    }
    public function getIdParagrafos(){
        return $this->idParagrafos;
    }
    public function setNoticia($noticia){
        $this->noticia = $noticia;
    }
    public function getNoticia(){
        return $this->noticia;
    }
    public function setImagem($imagem){
        $this->imagem = $imagem;
    }
    public function getImagem(){
        return $this->imagem;
    }
    public function setTexto($texto){
        $this->texto = $texto;
    }
    public function getTexto(){
        return $this->texto;
    }
    public function setLocalImagem($localImagem){
        $this->localImagem = $localImagem;
    }
    public function getLocalImagem(){
        return $this->localImagem;
    }
}
?>