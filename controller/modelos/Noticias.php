<?php
class Noticias{
    private $idNoticia = 0;
    private $usuario = NULL;
    private $categoria = NULL;
    private $nomeNoticia = '';
    private $dataPostagem = '';
    private $status = '';
    private $linkNoticia = '';
    private $imagem = '';
    public function __construct(){}
    public function setIdNoticia($idNoticia){
        $this->idNoticia = $idNoticia;
    }
    public function getIdNoticia(){
        return $this->idNoticia;
    }
    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }
    public function getUsuario(){
        return $this->usuario;
    }
    public function setCategoria($categoria){
        $this->categoria = $categoria;
    }
    public function getCategoria(){
        return $this->categoria;
    }
    public function setNomeNoticia($nomeNoticia){
        $this->nomeNoticia = $nomeNoticia;
    }
    public function getNomeNoticia(){
        return $this->nomeNoticia;
    }
    public function setDataPostagem($dataPostagem){
        $this->dataPostagem = $dataPostagem;
    }
    public function getDataPostagem(){
        return $this->dataPostagem;
    }
    public function setStatus($status){
        $this->status = $status;
    }
    public function getStatus(){
        return $this->status;
    }
    public function setLinkMateria($linkMateria){
        $this->linkNoticia = $linkMateria;
    }
    public function getLinkMateria(){
        return  $this->linkNoticia;
    }
    public function setImagem($urlImagem){
        $this->imagem = $urlImagem;
    }
    public function getImagem(){
        return $this->imagem;
    }
}
