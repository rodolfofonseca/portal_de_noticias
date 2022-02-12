<?php
class Data{  
    /**
     * Função que retorna a data de hoje se a opção que for passada por parâmetro for true retorna o dia em número se for false retorna o dia da semana ex quarta.
     * @param opc true ou false
     * @return data de hoje ex 08
     */
    public function dia($opc){
        $timeZone = new DateTimeZone('America/Sao_Paulo');
        $data = new DateTime('now', $timeZone);
        if($opc == true){
            return $data->format('d');
        }
        else{
            $diasSemana = array( 0=>'Domingo', 1=>'Segunda-Feira', 2=>'Terça-Feira', 3=>'Quarta-Feira', 4=>'Quinta-Feira', 5=>'Sexta-Feira', 6=>'Sábado');
            $hoje = getdate();
            return $diasSemana[$hoje['wday']];
        }
    }
    /**
     * Função que retorna o mês atual em número caso o parametro seja true ou o mês escrito caso seja false.
     * @return mês ex 02
     */
    public function mes($opc){
        $timeZone = new DateTimeZone('America/Sao_Paulo');
        $data = new DateTime('now', $timeZone);
        if($opc == true){{}
            return $data->format('m');
        }
        else{
            $meses = array(1=>'Janeiro', 2=>'Fevereiro', 3=>'Março', 4=>'Abril', 5=>'Maio', 6 =>'Junho', 7=>'Julho', 8=>'Agosto', 9=>'Setembro', 10 =>'Outubro', 11=>'Novembro', 12 => 'Dezembro');
            $mes = getdate();
            return $meses[$mes['mon']];
        }
    }
    /**
     * return o ano com dois digitos ou com 4 digitos, depende do parâmetro que é passado se for true retorna com 4 digitos, se for false, retorna apenas com 2 digitos.
     * @param $opc boolean
     * @return ano.
     */
    public function ano($opc){
        $timeZone = new DateTimeZone('America/Sao_Paulo');
        $data = new DateTime('now', $timeZone);
        if($opc == true){
            return $data->format('Y');
        }else{
            return $data->format('y');
        }
    }
    /**
     * Função que retorna a hora completa atual.
     * @return horaCompleta ex 17:24:17;
     */
    public function horaCompleta(){
        $timeZone = new DateTimeZone('America/Sao_Paulo');
        $data = new DateTime('now', $timeZone);
        return $data->format('H:i:s');
    }
}
