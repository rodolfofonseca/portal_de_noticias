<?php
 interface Controller{
     /**
      * Método utilizado para salvar dados na base de dados.
      */
     public function Salvar($model);
     /**
      * Método utilizado para alterar informações na base de dados.
      */
     public function Alterar($model);
     /**
      * Método utilizado para alterar dados na base de dados.
      */
     public function Pesquisar();
 }
?>