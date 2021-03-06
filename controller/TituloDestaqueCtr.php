<?php
require_once 'controller/utilidades/DAO.php';
require_once 'controller/utilidades/LogDoSistema.php';
require_once 'controller/modelos/TituloDestaque.php';
class TituloDestaqueCtr{
    private $dao = NULL;
    private $logDoSistema = NULL;
    public function __construct()
    {
        $this->dao = new DAO();
        $this->logDoSistema = new LogDoSistema();
    }
    public function Salvar($model){
        try{
            $dados = array($model->getMateria()->getIdNoticia(), $model->getDataInicio(), $model->getDataFim(), $model->getStatus());
            return $this->dao->Salvar('titulo_destaque', 'id_materia, data_inicio, data_fim, status', $dados);
        }catch(Exception $ex){
            $this->logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
            return false;
        }
    }
    public function Alterar($model){
        try{
            $dados = array($model->getMateria()->getIdNoticia(), $model->getDataInicio(), $model->getDataFim(), $model->getStatus(),$model->getIdTituloDestaque());
            $campos = array('id_materia', 'data_inicio', 'data_fim', 'status');
            return $this->dao->Alterar('titulo_destaque', $campos, $dados, 'id_titulo');
        }catch(Exception $ex){
            $this->logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
            return false;
        }
    }
    public function Pesquisar($comando){
        try{
            return $this->dao->Pesquisar($comando);
        }catch(Exception $ex){
            $this->logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
            return array();
        }
    }
}
?>