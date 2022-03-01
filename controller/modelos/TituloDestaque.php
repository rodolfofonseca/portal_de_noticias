<?php
class TituloDestaque
{
    private $idTituloDestaque = 0;
    private $materia = NULL;
    private $dataInicio = '';
    private $dataFim = '';
    private $horaInicio = 0;
    private $horaFim = 0;
    private $status = '';
    public function __construct()
    {
    }
    public function setIdTituloDestaque($idTituloDestaque)
    {
        $this->idTituloDestaque = $idTituloDestaque;
    }
    public function getIdTituloDestaque()
    {
        return $this->idTituloDestaque;
    }
    public function setMateria($materia){
        $this->materia = $materia;
    }
    public function getMateria(){
        return $this->materia;
    }
    public function setDataInicio($dataInicio){
        $this->dataInicio = $dataInicio;
    }
    public function getDataInicio(){
        return $this->dataInicio;
    }
    public function setHoraInicio($horaInicio){
        $this->horaInicio = $horaInicio;
    }
    public function getHoraInicio(){
        return $this->horaInicio;
    }
    public function setDataFim($dataFim){
        $this->dataFim = $dataFim;
    }
    public function getDataFim(){
        return $this->dataFim;
    }
    public function setHoraFim($horaFim){
        $this->horaFim = $horaFim;
    }
    public function getHoraFim(){
        return $this->horaFim;
    }
    public function setStatus($status){
        $this->status = $status;
    }
    public function getStatus(){
        return $this->status;
    }
}
