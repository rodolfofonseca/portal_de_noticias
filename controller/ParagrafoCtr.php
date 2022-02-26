<?php
require_once 'controller/utilidades/DAO.php';
require_once 'controller/utilidades/LogDoSistema.php';
require_once 'controller/modelos/Paragrafos.php';
class ParagrafoCtr{
    private $dao;
    private $logDoSistema;
    public function __construct()
    {
        $this->dao = new DAO();
        $this->logDoSistema = new LogDoSistema();
    }
    public function Salvar($model){
        try{
            $dados = array($model->getNoticia()->getIdNoticia(), $model->getImagem(), $model->getTexto(), $model->getLocalImagem());
            return $this->dao->Salvar('paragrafos', 'id_noticia, imagem, paragrafo, antes_depois', $dados);
        }catch(Exception $ex){
            $this->logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
            return false;
        }
    }
    public function Alterar($model){
        try{
            $dados = array($model->getNoticia()->getIdNoticia(), $model->getImagem(), $model->getTexto(), $model->getLocalImagem(), $model->getIdParagrafo());
            $campos = array('id_noticia', 'imagem', 'paragrafo', 'antes_depois');
            return $this->dao->Alterar('paragrafos', $campos, $dados, 'id_paragrafo');
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
        }
    }
}
?>