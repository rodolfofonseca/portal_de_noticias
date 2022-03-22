<?php
class Estado{
    private $idEstado;
    private $nomeEstado;
    private $siglaEstado;
    private $pais;
    public function __construct()
    {
        
    }
    public function setIdEstado($idEstado){
        $this->idEstado = $idEstado;
    }
}
?>