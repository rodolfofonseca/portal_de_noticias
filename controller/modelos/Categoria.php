<?php
class Categoria{
    private $idCategoria = 0;
    private $descricaoCategoria = '';
    private $apareceMenu = '';
    private $menu = NULL;
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
    public function setMenu($menu){
        $this->menu = $menu;
    }
    public function getMenu(){
        return $this->menu;
    }
}
?>