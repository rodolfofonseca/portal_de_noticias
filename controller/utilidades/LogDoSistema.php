<?php
require_once 'Data.php';
class LogDoSistema{
    private $texto = '';
    private $data = NULL;
    public function __construct()
    {
        $this->data = new Data();
    }
    /**
     * Método responsável por escrever no arquivo de log do sistema as informações de erros do sistema de forma a se saber o que foi feito.
     * @param (string) $arquivo Nome do arquivo que será realizado a escrita, juntamente com as informações que desejam ser escritas.
     * @param (objeto Exception) $informacoes com a mensagem
     */
    public function EscreverArquivo($arquivo, $informacoes){
        $f_open = fopen($arquivo, 'a+');
        $this->texto = "\n".$this->data->dia(true).'/'.$this->data->mes(true).'/'.$this->data->ano(true).'-'.$this->data->horaCompleta();
        $this->texto = $this->texto.'--'.$informacoes;
        fwrite($f_open, $this->texto);
        fclose($f_open);
    }
    /**
     * Método que retorno os dados do arquivo.
     * @param (string) $arquivo Nome do arquivo que deseja realizar a leitura.
     */
    public function LerArquivo($arquivo){
       $f_open = fopen($arquivo, 'r');
       $retorno = (string) '';
       while(!feof($f_open)){
           $retorno = $retorno."\n".fgets($f_open, 4096);
       }
       fclose($f_open);
       return $retorno;
    }
}
?>