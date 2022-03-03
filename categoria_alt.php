<?php
require_once 'includes/headerUsuario.php';
require_once 'controller/modelos/Categoria.php';
require_once 'controller/modelos/Menu.php';
require_once 'controller/CategoriaCtr.php';
$id_categoria = NULL;
$model = new Categoria();
$menu = new Menu();
$controller = new CategoriaCtr();
$logDoSistema = new LogDoSistema();
if (!empty($_GET['id_categoria'])) {
    try {
        $id_categoria = $_REQUEST['id_categoria'];
        $model->setIdCategoria(intval($id_categoria));
    } catch (Exception $ex) {
        $logDoSistema->EscreverArquivo('logDoSistema', $ex->getMessage());
    }
}
if (NULL == $id_categoria) {
    header('Location:dashboard.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST)) {
        try {
            $model->setDescricaoCategoria((string)$_POST['descricao']);
            $model->setApareceMenu((string)$_POST['aparece_menu']);
            $menu->setIdMenu((int) $_POST['menu']);
            $model->setMenu($menu);
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
                    $retorno = $controller->Pesquisar('select categoria.id_categoria, categoria.id_menu_categoria, categoria.descricao_categoria, categoria.aparece_menu, menu.descricao_menu from categoria, menu where menu.id_menu = categoria.id_menu_categoria and categoria.id_categoria = ' . $id_categoria . ';');
                    foreach ($retorno as $ret) {
                        $model->setIdCategoria((int) $ret['id_categoria']);
                        $menu->setIdMenu((int) $ret['id_menu_categoria']);
                        $menu->setDescricaoMenu((string) $ret['descricao_menu']);
                        $model->setMenu($menu);
                        $model->setDescricaoCategoria((string) $ret['descricao_categoria']);
                        $model->setApareceMenu((string) $ret['aparece_menu']);
                    }
                } catch (Exception $ex) {
                    $logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
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
                    <form method="POST" accept="categoria_alt.php?id_menu=<?php echo $model->getIdCategoria(); ?>">
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="descricao">Descrição</label>
                                    <input type="text" class="form-control" name="descricao" id="descricao" placeholder="Descrição" required data-validation-required-message="Informe a descrição" value="<?php echo $model->getDescricaoCategoria(); ?>" />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="aparece_menu">Aparece no menu</label>
                                <select name="aparece_menu" id="aparece_menu" class="form-control">
                                    <?php
                                    if ($model->getApareceMenu() == 'S') {
                                    ?>
                                        <option value="S" selected>SIM</option>
                                        <option value="N">NÃO</option>
                                    <?php
                                    } else {
                                    ?>
                                        <option value="S">SIM</option>
                                        <option value="N" selected>NÃO</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="menu">Menu</label>
                                <select name="menu" id="menu" class="form-control">
                                    <?php
                                    $pesquisa = $controller->Pesquisar('select * from menu order by descricao_menu');
                                    foreach ($pesquisa as $reto) {
                                        if ($rete['id_menu'] == $model->getMenu()->getIdMenu()) {
                                    ?>
                                            <option value="<?php echo $reto['id_menu']; ?>" selected><?php echo $reto['descricao_menu']; ?></option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="<?php echo $reto['id_menu']; ?>"><?php echo $reto['descricao_menu']; ?></option>
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