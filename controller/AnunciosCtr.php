<?php
require_once 'controller/modelos/Anuncios.php';
require_once 'controller/utilidades/DAO.php';
require_once 'controller/utilidades/LogDoSistema.php';
class AnunciosCtr{
    private $dao;
    private $logDoSistema;
    public function __construct()
    {
        $this->dao = new DAO();
        $this->logDoSistema = new LogDoSistema();
    }
    public function Salvar($model){
        try{
            $dados = array($model->getEmpresa()->getIdEmpresa(), $model->getLocais()->getIdLocais(), $model->getContrato()->getIdContrato(), $model->getDataInicio(), $model->getHoraInicio(), $model->getDataFim(), $model->getHoraFim(), $model->getStatus(), $model->getLocalImagem());
            return $this->dao->Salvar('anuncios', 'id_empresa, id_locais, id_contrato, data_inicio, hora_inicio, data_fim, hora_fim, status, local_imagem', $dados);
        }catch(Exception $ex){
            $this->logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
            return false;
        }
    }
    public function Alterar($model){
        try{
            $dados = array($model->getEmpresa()->getIdEmpresa(), $model->getLocais()->getIdLocais(), $model->getContrato()->getIdContrato(), $model->getDataInicio(), $model->getHoraInicio(), $model->getDataFim(), $model->getHoraFim(), $model->getStatus(), $model->getLocalImagem(),$model->getIdAnuncio());
            $campos = array('id_empresa', 'id_locais', 'id_contrato', 'data_inicio', 'hora_inicio', 'data_fim', 'hora_fim', 'status', 'local_imagem');
            return $this->dao->Alterar('anuncios', $campos, $dados, 'id_anuncio');
        }catch(Exception $ex){
            return $this->logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
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