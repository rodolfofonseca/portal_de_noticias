<?php
require_once 'includes/headerUsuario.php';
require_once 'controller/modelos/Locais.php';
require_once 'controller/LocaisCtr.php';
require_once 'controller/utilidades/LogDoSistema.php';
$id_local = NULL;
$model = new Locais();
$controller = new LocaisCtr();
$logDoSistema = new LogDoSistema();
if (!empty($_GET['id_local'])) {
    try {
        $id_local = (int) $_REQUEST['id_local'];
        $model->setIdLcais((int) $id_local);
    } catch (Exception $ex) {
        $logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
    }
}
if (NULL == $id_local) {
    header('Location:dashboard.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST)) {
        try {
            $model->setDescricao((string) $_POST['descricao']);
            $model->setObservacoes((string) $_POST['observacoes']);
            if ($controller->Alterar($model)) {
?><script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso',
                        Text: 'Operação realizada com sucesso!'
                    });
                </script><?php
                        } else {
                            ?><script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Atenção',
                        text: 'Erro durante a operação',
                        footer: 'Tente novamente mais tarde'
                    });
                </script><?php
                        }
                    } catch (Exception $ex) {
                        $logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
                    }
                }
            } else {
                try {
                    $retorno = $controller->Pesquisar("select * from locais where id_local = '" . $model->getIdLocais() . "';");
                    foreach ($retorno as $local) {
                        $model->setDescricao((string) $local['descricao']);
                        $model->setObservacoes((string) $local['observacao']);
                    }
                } catch (Exception $ex) {
                    $logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
                }
            }
                            ?>
<div class="container-fluid py-3">
    <div class="container">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Cadastro de locais</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="contact-form bg-light mb-" style="padding:30px;">
                    <form method="POST" accept="locais_cad.php?id_local=<?php echo $model->getIdLocais(); ?>">
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="descricao">Descrição</label>
                                    <input type="text" name="descricao" id="descricao" placeholder="Descrição dos locais" required data-validation-required-message="Informe a descrição dos locais" class="form-control" value="<?php echo $model->getDescricao(); ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="observacoes">Observações</label>
                                    <textarea name="observacoes" id="observacoes" class="form-control"><?php echo $model->getObservacoes(); ?></textarea>
                                </div>
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
                                    <input type="reset" class="btn btn-danger forn-weight-semi-bold px4 expanded" value="Cancelar" />
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