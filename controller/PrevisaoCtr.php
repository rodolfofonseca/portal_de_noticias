<?php
require_once 'controller/modelos/Previsao.php';
require_once 'controller/modelos/CidadePrevisao.php';
require_once 'controller/utilidades/LogDoSistema.php';
require_once 'controller/utilidades/DAO.php';
class PrevisaoCtr{
    private $logDoSistema;
    private $dao;
    public function __construct()
    {
        $this->logDoSistema = new LogDoSistema();
        $this->dao = new DAO();
    }
    public function Salvar($model){
        try{
            $dados = array($model->getCidadePrevisao()->getIdCidadePrevisao(), $model->getTempo(), $model->getNascerDoSol(), $model->getPorDoSol(), $model->getVelocidadeDoVento(), $model->getImagem(), $model->getUmidade(), $model->getTemperatura());
            return $this->dao->Salvar('previsao', 'id_cidade_previsao, tempo, nascer_sol, por_sol, velocidade_vento, imagem, umidade, temperatura', $dados);
        }catch(Exception $ex){
            $this->logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
            return false;
        }
    }
    public function Alterar($model){
        try{
            $dados = array($model->getCidadePrevisao()->getIdCidadePrevisao(), $model->getTempo(), $model->getNascerDoSol(), $model->getPorDoSol(), $model->getVelocidadeDoVento(), $model->getImagem(), $model->getUmidade(),$model->getTemperatura(), $model->getIdPrevisao());
            $campos = array('id_cidade_previsao', 'tempo', 'nascer_sol', 'por_sol', 'velocidade_vento', 'imagem', 'umidade', 'temperatura');
            return $this->dao->Alterar('previsao', $campos, $dados, 'id_previsao');
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