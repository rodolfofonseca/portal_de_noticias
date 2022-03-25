<?php
require_once 'includes/headerUsuario.php';
require_once 'controller/utilidades/LogDoSistema.php';
require_once 'controller/CidadeCtr.php';
require_once 'controller/modelos/Cidade.php';
require_once 'controller/modelos/Estado.php';
$controller = new CidadeCtr();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST)) {
        try{
            $model = new Cidade();
            $model->setNomeCidade((strtoupper($_POST['nome_cidade'])));
            $estado = new Estado();
            $estado->setIdEstado((intval($_POST['estado'])));
            $model->setEstado($estado);
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
            <h3 class="m-0">Cadastro de Cidade</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="contact-form bg-light mb-3" style="padding:30px;">
                    <form method="POST" accept="cidade_cad.php">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nome_cidade">Nome cidade</label>
                                    <input type="text" name="nome_cidade" id="nome_cidade" placeholder="Nome do Cidade" required data-validation-required-message="Informe o nome da cidade" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="estado">Estado</label>
                                    <select name="estado" id="estado" class="form-control">
                                        <?php
                                            $retorno_pesquisa = $controller->Pesquisar("select estado.id_estado, estado.nome_estado, estado.sigla, pais.nome_pais from estado, pais where estado.id_pais = pais.id_pais order by nome_estado;");
                                            if(empty($retorno_pesquisa) == false){
                                                foreach($retorno_pesquisa as $retorno){
                                                    ?>
                                                    <option value="<?php echo $retorno['id_estado']; ?>"><?php echo $retorno['nome_pais'].'/'.$retorno['nome_estado'].'/'.$retorno['sigla']; ?></option>
                                                    <?php
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