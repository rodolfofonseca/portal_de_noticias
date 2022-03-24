<?php
require_once 'includes/headerUsuario.php';
require_once 'controller/utilidades/LogDoSistema.php';
require_once 'controller/EstadoCtr.php';
require_once 'controller/modelos/Estado.php';
require_once 'controller/modelos/Pais.php';
$controller = new EstadoCtr();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST)) {
        try{
            $model = new Estado();
            $pais = new Pais();
            $model->setNomeEstado((strtoupper($_POST['nome_estado'])));
            $model->setSigla(strtoupper($_POST['sigla']));
            $pais->setIdPais((int) $_POST['id_pais']);
            $model->setPais($pais);
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
            <h3 class="m-0">Cadastro de Estado</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="contact-form bg-light mb-3" style="padding:30px;">
                    <form method="POST" accept="estado_cad.php">
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nome_estado">Nome Estado</label>
                                    <input type="text" name="nome_estado" id="nome_estado" placeholder="Nome do Estado" required data-validation-required-message="Informe o nome do Estado" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sigla">Sigla do Estado</label>
                                    <input type="text" name="sigla" id="sigla" placeholder="Sigla do Estado" required data-validation-required-message="Informe a sigla do Estado" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="id_pais">Selecione o País</label>
                                    <select name="id_pais" class="form-control" id="id_pais">
                                        <?php
                                        $retorno_pais = $controller->Pesquisar('select * from pais order by nome_pais');
                                        if(empty($retorno_pais) == false){
                                            foreach($retorno_pais as $pais){
                                                if($pais['id_pais'] == 1){
                                                    ?>
                                                    <option value="<?php echo $pais['id_pais']; ?>" selected><?php echo $pais['nome_pais'].' / '.$pais['sigla']; ?></option>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <option value="<?php echo $pais['id_pais']; ?>"><?php echo $pais['nome_pais'].' / '.$pais['sigla']; ?></option>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
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