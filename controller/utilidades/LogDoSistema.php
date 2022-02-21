<?php
require_once 'Data.php';
class LogDoSistema{
    private $arquivo = 'log_do_sistema.txt';
    private $texto = '';
    private $data = NULL;
    public function __construct()
    {
        $this->data = new Data();
    }
    /**
     * Método responsável por escrever no arquivo de log do sistema as informações de erros do sistema de forma a se saber o que foi feito.
     * @param (objeto Exception) $informacoes com a mensagem
     */
    public function EscreverArquivo($informacoes){
        $f_open = fopen($this->arquivo, 'a+');
        $this->texto = $this->data->dia(true).'/'.$this->data->mes(true).'/'.$this->data->ano(true).'-'.$this->data->horaCompleta();
        $this->texto = $this->texto.'--'.$informacoes->getMessage();
        fwrite($f_open, $this->texto);
        fclose($f_open);
    }
    public function LerArquivo(){
       $f_open = fopen($this->arquivo, 'r');
       $retorno = (string) '';
       while(!feof($f_open)){
           $retorno = $retorno."\n".fgets($f_open, 4096);
       }
       fclose($f_open);
       return $retorno;
    }
}
?>