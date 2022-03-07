<?php
class Empresa{
    private $id_empresa;
    private $nome_empresa;
    private $telefone_contato;
    private $whatsapp;
    private $observacoes;
    private $status;
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
}
?>