<?php
class Menu{
    private $idMenu = 0;
    private $descricaoMenu = '';
    private $apareceMenuMenu = '';
    private $temSubMenu = '';
    public function setIdMenu($idMenu){
        $this->idMenu = $idMenu;
    }
    public function getIdMenu(){
        return $this->idMenu;
    }
    public function setDescricaoMenu($descricaoMenu){
        $this->descricaoMenu = $descricaoMenu;
    }
    public function getDescricaoMenu(){
        return $this->descricaoMenu;
    }
    public function setApareceMenu($apareceMenuMenu){
        $this->apareceMenuMenu = $apareceMenuMenu;
    }
    public function getApareceMenu(){
        return $this->apareceMenuMenu;
    }
    public function setTemSubMenu($temSubMenu){
        $this->temSubMenu = $temSubMenu;
    }
    public function getTemSubMenu(){
        return $this->temSubMenu;
    }
}
?>