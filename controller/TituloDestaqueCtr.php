<?php
require_once 'controller/utilidades/DAO.php';
require_once 'controller/utilidades/LogDoSistema.php';
require_once 'controller/modelos/TituloDestaque.php';
class tituloDestaqueCtr{
    private $dao = NULL;
    private $logDoSistema = NULL;
    public function __construct()
    {
        $this->dao = new DAO();
        $this->logDoSistema = new LogDoSistema();
    }
    public function Salvar($model){
        try{
            $dados = array($model->getMateria()->getIdNoticia(), $model->getDataInicio(), $model->getDataFim(), $model->getHoraInicio(), $model->getHoraFim());
            return $this->dao->Salvar('titulo_destaque', 'id_materia, data_inicio, data_fim, hora_inicio, hora_fim', $dados);
        }catch(Exception $ex){
            $this->logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
            return false;
        }
    }
    public function Alterar($model){
        try{
            $dados = array($model->getMateria()->getIdNoticia(), $model->getDataInicio(), $model->getDataFim(), $model->getHoraInicio(), $model->getHoraFim(), $model->getIdTituloDestaque());
            $campos = array('id_materia', 'data_inicio', 'data_fim', 'hora_inicio', 'hora_fim');
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