<?php
class Categoria{
    private $idCategoria = 0;
    private $descricaoCategoria = '';
    private $apareceMenu = '';
    function __construct()
    {
    }
    public function setIdCategoria($idCategoria){
        $this->idCategoria = $idCategoria;
    }
    public function getIdCategoria(){
        return $this->idCategoria;
    }
    public function setDescricaoCategoria($descricaoCategoria){
        $this->descricaoCategoria = $descricaoCategoria;
    }
    public function getDescricaoCategoria(){
        return $this->descricaoCategoria;
    }
    public function setApareceMenu($apareceMenu){
        $this->apareceMenu = $apareceMenu;
    }
    public function getApareceMenu(){
        return $this->apareceMenu;
    }
}
?>