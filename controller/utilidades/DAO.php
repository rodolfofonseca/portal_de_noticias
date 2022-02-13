<?php
require_once 'Connection.php';
class DAO
{
    function __construct()
    {
    }
    /**
     * Função responsável por inserir na base de dados um novo registro.
     * @param (string) $tabela a tabela que onde será incluido esse novo registro.
     * @param (string) $campos, os campos que serão inseridos, deve estar no seguinte formato ex nome, sobrenome...
     * @param (array) $dados, deve ser do tipo array.
     * @return true sucesso false erro.
     */
    public function Salvar($tabela, $campos, $dados)
    {
        try {
            $conexao = Connection::Conectar();
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $tamanho = count($dados);
            $concatena = (string) '';
            $controle = (int) 0;
            $comando = (string) '';
            for ($cont = 0; $cont < $tamanho; $cont++) {
                $controle++;
                if ($controle == $tamanho) {
                    $concatena = $concatena . '?';
                } else {
                    $concatena = $concatena . '?, ';
                }
            }
            $comando = 'insert into ' . $tabela . '(' . $campos . ') values(' . $concatena . ');';
            $executa = $conexao->prepare($comando);
            $executa->execute($dados);
            Connection::Desconectar();
            return true;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            Connection::Desconectar();
            return false;
        }
    }
    /**
     * Função que altera os dados que o usuário deseja, o campo id tem que ser sempre o último dos arrays.
     * @param (string) $tabela, a tabela que o usuário deseja alterar.
     * @param (array) $campos, os campos que serão alterados.
     * @param (array) $dados os dados novos.
     * @param (string) $identificador o nome do campo ID na tabela.
     * @return true or false de acordo com o que aconteceu.
     */
    public function Alterar($tabela, $campos, $dados, $identificador)
    {
        try {
            $conexao = Connection::Conectar();
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $contador = count($campos);
            $concatena = 'update ' . $tabela . ' set ';
            $controle = 0;
            for ($cont = 0; $cont < $contador; $cont++) {
                $controle++;
                if ($controle == $contador) {
                    $concatena = $concatena.$campos[$cont] . ' = ? WHERE ' . $identificador . ' = ?;';
                } else {
                    $concatena = $concatena.$campos[$cont] . ' = ?, ';
                }
            }
            $executa = $conexao->prepare($concatena);
            $executa->execute($dados);
            Connection::Desconectar();
            return true;
        } catch (Exception $ex) {
            Connection::Desconectar();
            return false;
        }
    }
    /**
     * Função que pesquisa as informações na base de dados.
     * @return (array) com as informações retornadas do banco de dados.
     */
    public function Pesquisar($comando){
        try{
            $conexao = Connection::Conectar();
            return $conexao->query($comando);
        }catch(Exception $ex){
            echo $ex->getMessage();
            Connection::Desconectar();
        }
    }
}
