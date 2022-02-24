<?php
require_once 'controller/utilidades/DAO.php';
require_once 'controller/utilidades/LogDoSistema.php';
require_once 'controller/modelos/Noticias.php';
class NoticiasCtr{
    private $dao = NULL;
    private $logDoSistema = NULL;
    public function __construct()
    {
        $this->dao = new DAO();
        $this->logDoSistema = new LogDoSistema();
    }
    public function Salvar($model){
        try{
            $dados = array($model->getUsuario()->getIdUsuario(), $model->getCategoria()->getIdCategoria(), $model->getNomeNoticia(), $model->getDataPostagem(), $model->getStatus(), $model->getLinkNoticia(), $model->getImagem());
            return $this->dao->Salvar('noticias', 'id_usuario, id_categoria, titulo_noticias, data_postagem, status, link_materia, imagem', $dados);
        }catch(Exception $ex){
            $this->logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
            return false;
        }
    }
    public function Alterar($model){
        try{
            $dados = array($model->getUsuario()->getIdUsuario(), $model->getCategoria()->getIdCategoria(), $model->getNomeNoticia(), $model->getDataPostagem(), $model->getStatus(), $model->getLinkNoticia(), $model->getImagem(), $model->getIdNoticia());
            $campos = array('id_usuario', 'id_categoria', 'titulo_noticia', 'data_postagem', 'status', 'link_materia', 'imagem');
            return $this->dao->Alterar('noticias', $campos, $dados, 'id_noticias');
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