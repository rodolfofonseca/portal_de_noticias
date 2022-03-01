<?php
class pacelas{
    private $id_parcela;
    private $contrato;
    private $valor;
    private $data_vencimento;
    private $status;
    public function __construct(){}
    public function setIdParcela($id_parcela){
        $this->id_parcela = $id_parcela;
    }
    public function getIdParcela(){
        return $this->id_parcela;
    }
    public function setContrato($contrato){
        $this->contrato = $contrato;
    }
    public function getContrato(){
        return $this->contrato;
    }
    public function setDataVencimento($data_vencimento){
        $this->data_vencimento = $data_vencimento;
    }
    public function getDataVencimento(){
        return $this->data_vencimento;
    }
    public function setStatus($status){
        $this->status = $status;
    }
    public function getStatus(){
        return $this->status;
    }
    public function setValor($valor){
        $this->valor = $valor;
    }
    public function getValor(){
        return $this->valor;
    }
}
?>