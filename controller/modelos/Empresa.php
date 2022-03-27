<?php
class Empresa{
    private $id_empresa;
    private $nome_empresa;
    private $telefone_contato;
    private $whatsapp;
    private $observacoes;
    private $status;
    private $rua;
    private $numero;
    private $facebook;
    private $instagram;
    private $email;
    private $locaizacao;
    private $site;
    private $imagem;
    public function __construct(){}
    public function setIdEmpresa($id_empresa){
        $this->id_empresa = $id_empresa;
    }
    public function getIdEmpresa(){
        return $this->id_empresa;
    }
    public function setNomeEmpresa($nome_empresa){
        $this->nome_empresa = $nome_empresa;
    }
    public function getNomeEmpresa(){
        return $this->nome_empresa;
    }
    public function setTelefoneContato($telefone_contato){
        $this->telefone_contato = $telefone_contato;
    }
    public function getTelefoneContato(){
        return $this->telefone_contato;
    }
    public function setWhatsapp($whatsapp){
        $this->whatsapp = $whatsapp;
    }
    public function getWhatsapp(){
        return $this->whatsapp;
    }
    public function setStatus($status){
        $this->status = $status;
    }
    public function getStatus(){
        return $this->status;
    }
    public function setObservacao($observacoes){
        $this->observacoes = $observacoes;
    }
    public function getObservacao(){
        return $this->observacoes;
    }
    public function setRua($rua){
        $this->rua = $rua;
    }
    public function getRua(){
        return $this->rua;
    }
    public function setNumero($numero){
        $this->numero = $numero;
    }
    public function getNumero(){
        return $this->numero;
    }
    public function setFacebook($facebook){
        $this->facebook = $facebook;
    }
    public function getFacebook(){
        return $this->facebook;
    }
    public function setInstagram($instagram){
        $this->instagram = $instagram;
    }
    public function getInstagram(){
        return $this->instagram;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function getEmail(){
        return $this->email;
    }
    public function setLocalizacao($localizacao){
        $this->locaizacao = $localizacao;
    }
    public function getLocalizacao(){
        return $this->locaizacao;
    }
    public function setSite($site){
        $this->site = $site;
    }
    public function getSite(){
        return $this->site;
    }
    public function setImagem($imagem){
        $this->imagem = $imagem;
    }
    public function getImagem(){
        return $this->imagem;
    }
}
?>