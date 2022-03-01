<?php
class ContratoPublicidade{
    private $id_contrato;
    private $usuario_cadastro;
    private $usuario_assinatura_contrato;
    private $empresa;
    private $data_assinatura;
    private $valor_contratado;
    private $tipo_pagamento;
    private $observacoes;
    private $data_inicio;
    private $data_fim;
    public function __construct(){}
    public function setIdContrato($id_contrato){
        $this->id_contrato = $id_contrato;
    }
    public function getIdContrato(){
        return $this->id_contrato;
    }
    public function setUsuarioCadastro($usuario_cadastro){
        $this->usuario_cadastro = $usuario_cadastro;
    }
    public function getUsuarioCadastro(){
        return $this->usuario_cadastro;
    }
    public function setUsuarioAssinaturaContrato($usuario_assinatura_contrato){
        $this->usuario_assinatura_contrato = $usuario_assinatura_contrato;
    }
    public function getUsuarioAssinaturaContrato(){
        return $this->usuario_assinatura_contrato;
    }
    public function setEmpresa($empresa){
        $this->empresa = $empresa;
    }
    public function getEmpresa(){
        return $this->empresa;
    }
    public function setDataAssinatura($data_assinatura){
        $this->data_assinatura = $data_assinatura;
    }
    public function getDataAssinatura(){
        return $this->data_assinatura;
    }
    public function setValorContrato($valor_contrato){
        $this->valor_contratado = $valor_contrato;
    }
    public function getValorContrato(){
        return $this->valor_contratado;
    }
    public function setTipoPagamento($tipo_pagamento){
        $this->tipo_pagamento = $tipo_pagamento;
    }
    public function getTipoPagamento(){
        return $this->tipo_pagamento;
    }
    public function setObservacoes($observacoes){
        $this->observacoes = $observacoes;
    }
    public function getObservacoes(){
        return $this->observacoes;
    }
    public function setDataInicio($data_inicio){
        $this->data_inicio = $data_inicio;
    }
    public function getDataInicio(){
        return $this->data_inicio;
    }
    public function setDataFim($data_fim){
        $this->data_fim = $data_fim;
    }
    public function getDataFim(){
        return $this->data_fim;
    }
}
?>