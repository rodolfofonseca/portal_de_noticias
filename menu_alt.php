<?php
require_once 'includes/headerUsuario.php';
require_once 'controller/modelos/Menu.php';
require_once 'controller/MenuCtr.php';
require_once 'controller/utilidades/LogDoSistema.php';
$id_menu = NULL;
$model = new Menu();
$logDoSistema = new LogDoSistema();
$controller = new MenuCtr();
if (!empty($_GET['id_menu'])) {
    try {
        $id_menu = $_REQUEST['id_menu'];
        $model->setIdMenu(intval($id_menu));
    } catch (Exception $ex) {
        $logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
    }
}
if (NULL == $id_menu) {
    header('Location:dashboard.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST)) {
        try {
            $model->setDescricaoMenu((string) $_POST['descricao_menu']);
            $model->setApareceMenu((string) $_POST['aparece_menu_menu']);
            if ($controller->Alterar($model)) {

?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso',
                        text: 'Menu alterado com sucesso!'
                    });
                </script>
            <?php
            } else {
            ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Atenção',
                        text: 'Erro ao alterar o menu!',
                        footer: 'Tente novamente mais tarde'
                    });
                </script>
<?php
            }
        } catch (Exception $ex) {
            $logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
        }
    }
} else {
    try {
        $retorno = $controller->Pesquisar('select * from menu where id_menu = ' . $id_menu . ';');
        foreach ($retorno as $menu) {
            $model->setIdMenu((int) $menu['id_menu']);
            $model->setDescricaoMenu((string) $menu['descricao_menu']);
            $model->setApareceMenu((string) $menu['aparece_menu_menu']);
        }
    } catch (Exception $ex) {
        $logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
    }
}
?>
<div class="container-fluid py-3">
    <div class="container">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Alteração de Menu</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="contact-form bg-light mb-3" style="padding: 30px;">
                    <form method="POST" accept="menu_alt.php?id_menu=<?php echo $model->getIdMenu(); ?>">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="descricao_menu">Descrição Menu</label>
                                <input type="text" name="descricao_menu" id="descricao_menu" value="<?php echo $model->getDescricaoMenu(); ?>" class="form-control px-4" placeholder="Descrição do menu" required data-validation-required-messagem="Informe a descrição do menu" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="aparece_menu_menu" class="text-center">Aparece menu</label>
                                <select name="aparece_menu_menu" id="aparece_menu_menu" class="form-control px-4">
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
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="control-group">
                                    <input type="submit" class="btn btn-primary font-weight-semi-bold px-4" value="Cadastrar" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="control-group">
                                    <input type="reset" class="btn btn-danger font-weight-semi-bold px-4" value="Cancelar" />
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