<?php
require_once 'includes/headerUsuario.php';
require_once 'controller/utilidades/LogDoSistema.php';
require_once 'controller/PaisCtr.php';
require_once 'controller/modelos/Pais.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST)) {
        try{
            $model = new Pais();
            $controller = new PaisCtr();
            $model->setNomePais((strtoupper($_POST['nome_pais'])));
            $model->setSigla(strtoupper($_POST['sigla']));
            if($controller->Salvar($model)){
                ?><script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso',
                    Text: 'Operação realizada com sucesso!'
                });
            </script><?php
            }else{
                ?><script>
                Swal.fire({
                    icon: 'error',
                    title: 'Atenção',
                    text: 'Erro durante a operação',
                    footer: 'Tente novamente mais tarde'
                });
            </script><?php
            }
        }catch(Exception $ex){
            $logDoSistema = new LogDoSistema();
            $logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
        }
    }
}
?>
<div class="container-fluid py-3">
    <div class="container">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Cadastro de País</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="contact-form bg-light mb-3" style="padding:30px;">
                    <form method="POST" accept="pais_cad.php">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nome_pais">Nome país</label>
                                    <input type="text" name="nome_pais" id="nome_pais" placeholder="Nome do País" required data-validation-required-message="Informe o nome do País" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sigla">Sigla do País</label>
                                    <input type="text" name="sigla" id="sigla" placeholder="Sigla do País" required data-validation-required-message="Informe a sigla do País" class="form-control"/>
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