<?php
class Connection{
    private static $cont = null;
    public function __construct()
    {
        die('A função Init não é permitida!');
    }
    /**
     * Função responsável por realizar a conexão com a base de dados.
     */
    public static function Conectar(){
        if(null == self::$cont){
            try{
                self::$cont = new PDO("pgsql:host=localhost; port=5434; dbname=portal_de_noticias;user=postgres;password=crydo879");
            }catch(PDOException $ex){
                die($ex->getMessage());
            }
        }
        return self::$cont;
    }
    /**
     * Função responsável por desconectar da base de dados.
     */
    public static function Desconectar(){
        self::$cont = null;
    }
}
?>