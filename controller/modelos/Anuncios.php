<?php
class Anuncios{
    private $idAnuncios;
    private $empresa;
    private $locais;
    private $contrato;
    private $data_inicio;
    private $hora_inicio;
    private $data_fim;
    private $hora_fim;
    private $status;
    private $localImagem;
    public function __construct(){}
    public function setIdAnuncios($idAnuncios){
        $this->idAnuncios = $idAnuncios;
    }
    public function getIdAnuncios(){
        return $this->idAnuncios;
    }
    public function setEmpresa($empresa){
        $this->empresa = $empresa;
    }
    public function getEmpresa(){
        return $this->empresa;
    }
    public function setLocais($locais){
        $this->locais = $locais;
    }
    public function getLocais(){
        return $this->locais;
    }
    public function setContrato($contrato){
        $this->contrato = $contrato;
    }
    public function getContrato(){
        return $this->contrato;
    }
    public function setDataInicio($dataInicio){
        $this->data_inicio = $dataInicio;
    }
    public function getDataInicio(){
        return $this->data_inicio;
    }
    public function setHoraInicio($horaInicio){
        $this->hora_inicio = $horaInicio;
    }
    public function getHoraInicio(){
        return $this->hora_inicio;
    }
    public function setDataFim($dataFim){
        $this->data_fim = $dataFim;
    }
    public function getDataFim(){
        return $this->data_fim;
    }
    public function setHoraFim($horaFim){
        $this->hora_fim = $horaFim;
    }
    public function getHoraFim(){
        return $this->hora_fim;
    }
    public function setStatus($status){
        $this->status = $status;
    }
    public function getStatus(){
        return $this->status;
    }
    public function setLocalImagem($localImagem){
        $this->localImagem = $localImagem;
    }
    public function getLocalImagem(){
        return $this->localImagem;
    }
}
?>