<?php
class EmailContato{
    private $id_email;
    private $email_contato;
    private $status;
    function __construct()
    {
    }
    function setIdEmail($idEmail){
        $this->id_email = $idEmail;
    }
    function getIdEmail(){
        return $this->id_email;
    }
    function setEmail($emailContato){
        $this->email_contato = $emailContato;
    }
    function getEmail(){
        return $this->email_contato;
    }
    public function setStatus($status){
        $this->status = $status;
    }
    public function getStatus(){
        return $this->status;
    }
}
?>