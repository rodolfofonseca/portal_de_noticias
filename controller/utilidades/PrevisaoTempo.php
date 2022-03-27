<?php
class PrevisaoTempo{
    private $chave = 'cd082846';
    public function __construct()
    {
    }
    private function Pesquisar($parametros, $chave, $api){
        $url = 'https://api.hgbrasil.com/weather?woeid='.$parametros.'&format=json';
        $retorno = file_get_contents(substr($url, 0, -1));
        return json_decode($retorno, true);
        /*$url = 'http://api.hgbrasil.com/'.$api.'/?format=json&';
        if(is_array($parametros)){
            if(!empty($chave)){
                $parametros = array_merge($parametros, array('key' => $chave));
            }
            foreach($parametros as $key => $valor){
                if(empty($valor)){
                    continue;
                }
                $url .= $key.'='.urlencode($valor).'&';
            }
            $retorno = file_get_contents(substr($url, 0, -1));
            return json_decode($retorno, true);
        }else{
            return false;
        }*/
    }
    /**
     * @param cidade Informa a cidade que deseja saber o tempo.
     * @return dados retorna um array com as informações.
     */
    public function Tempo($cidade){
        return $this->Pesquisar($cidade, $this->chave, 'weather');
    }
}
/*
oi cristiane eu te amo muito você é o amor da minha vida.
*/
?>