<?php
require_once 'includes/headerUsuario.php';
require_once 'controller/CategoriaCtr.php';
require_once 'controller/modelos/Categoria.php';
require_once 'controller/modelos/Menu.php';
$controller = new CategoriaCtr();
$retorno = $controller->Pesquisar('select * from menu order by descricao_menu;');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST)) {
        $model = new Categoria();
        $menu = new Menu();
        $menu->setIdMenu((int) $_POST['menu']);
        $model->setDescricaoCategoria((string)$_POST['descricao']);
        $model->setApareceMenu((string)$_POST['aparece_menu']);
        $model->setMenu($menu);
        if ($controller->Salvar($model) == true) {
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
                }
            }
                        ?>
<div class="container-fluid py-3">
    <div class="container">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Cadastro de categorias</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="contact-form bg-light mb-3" style="padding: 30px;">
                    <form method="POST" accept="categoria_cad.php">
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="descricao">Descrição</label>
                                    <input type="text" class="form-control" name="descricao" id="descricao" placeholder="Descrição" required data-validation-required-message="Informe a descrição" />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="aparece_menu">Aparece no menu</label>
                                <select name="aparece_menu" id="aparece_menu" class="form-control">
                                    <option value="S" selected>SIM</option>
                                    <option value="N">NÃO</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="menu">Menu</label>
                                <select name="menu" id="menu" class="form-control">
                                    <?php
                                    foreach ($retorno as $ret) {
                                    ?>
                                        <option value="<?php echo $ret['id_menu']; ?>"><?php echo $ret['descricao_menu']; ?></option>
                                    <?php
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