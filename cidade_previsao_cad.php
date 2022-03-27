<?php
require_once 'includes/headerUsuario.php';
require_once 'controller/CidadePrevisaoCtr.php';
require_once 'controller/PrevisaoCtr.php';
require_once 'controller/modelos/CidadePrevisao.php';
require_once 'controller/modelos/Previsao.php';
require_once 'controller/modelos/Cidade.php';
require_once 'controller/utilidades/PrevisaoTempo.php';
require_once 'controller/utilidades/LogDoSistema.php';
$controller = new CidadePrevisaoCtr();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST)) {
        try {
            $model = new CidadePrevisao();
            $cidade = new Cidade();
            $previsao = new PrevisaoTempo();
            $cidade->setIdCidade((int) $_POST['cidade']);
            $model->setCidade($cidade);
            $model->setCodigo((string) $_POST['codigo']);
            if ($controller->Salvar($model) == true) {
                $previsaoModel = new Previsao();
                $previsaoController = new PrevisaoCtr();
                $retorno = $controller->Pesquisar("select * from cidade_previsao where codigo = '" . $model->getCodigo() . "';");
                if (empty($retorno) == false) {
                    foreach ($retorno as $ret) {
                        $model->setIdCidadePrevisao((int) $ret['id_cidade_previsao']);
                    }
                    $retornoPrevisao = $previsao->Tempo($model->getCodigo());
                    $previsaoModel->setCidadePrevisao($model);
                    $previsaoModel->setTempo((string)$retornoPrevisao['results']['description']);
                    $previsaoModel->setNascerDoSol((string)$retornoPrevisao['results']['sunrise']);
                    $previsaoModel->setPorDoSol((string)$retornoPrevisao['results']['sunset']);
                    $previsaoModel->setVelocidadeDoVento((float)$retornoPrevisao['results']['wind_speedy']);
                    $previsaoModel->setImagem((string)$retornoPrevisao['results']['img_id']);
                    $previsaoModel->setUmidade((int)$retornoPrevisao['results']['humidity']);
                    $previsaoModel->setTemperatura((string)$retornoPrevisao['results']['temp']);
                    if ($previsaoController->Salvar($previsaoModel)) {
?>
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Sucesso',
                                text: 'Operação realizada com sucesso!'
                            });
                        </script>
                    <?php
                    } else {
                    ?>
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Atenção',
                                text: 'Erro ao cadastrar!',
                                footer: 'Tente novamente mais tarde'
                            });
                        </script>
<?php
                    }
                }
            }
        } catch (Exception $ex) {
            $logDoSistema = new LogDoSistema();
            $logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
        }
    }
}
?>
<div class="container-fluid py-3">
    <div class="container">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Cadastro de Cidades Previsão do Tempo</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="contact-form bg-light mb-3" style="padding: 30px;">
                    <form method="POST" accept="cidade_previsao_cad.php">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="codigo">Código</label>
                                    <input type="text" class="form-control" name="codigo" id="codigo" placeholder="codigo" required data-validation-required-message="Informe o código" />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="cidade">Cidade</label>
                                <select name="cidade" id="cidade" class="form-control">
                                    <?php
                                    $retorno = $controller->Pesquisar("select cidade.id_cidade, cidade.nome_cidade, estado.sigla from cidade, estado where cidade.id_estado = estado.id_estado;");
                                    if (empty($retorno) == false) {
                                        foreach ($retorno as $cidade) {
                                    ?>
                                            <option value="<?php echo $cidade['id_cidade']; ?>"><?php echo $cidade['nome_cidade'] . '/' . $cidade['sigla']; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="control-group">
                                    <input type="submit" class="btn btn-primary font-weight-semi-bold px-4" value="Cadastrar" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="reset" class="btn btn-danger forn-weight-semi-bold px4" value="Cancelar" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once 'includes/footerUsuario.php';
?>