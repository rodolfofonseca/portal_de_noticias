<?php
require_once 'includes/headerUsuario.php';
require_once 'controller/modelos/Menu.php';
require_once 'controller/MenuCtr.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST)) {
        $model = new Menu();
        $controller = new MenuCtr();
        $model->setDescricaoMenu((string) $_POST['descricao_menu']);
        $model->setApareceMenu((string) $_POST['aparece_menu_menu']);
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
            <h3 class="m-0">Cadastro de Menu</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="contact-form bg-light mb-3" style="padding: 30px;">
                    <form method="POST" accept="menu_cad.php">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="descricao_menu">Descrição</label>
                                    <input type="text" name="descricao_menu" id="descricao_menu" placeholder="Descrição do menu" required data-validation-required-message="Informe a descrição do menu" class="form-control"/>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="aparece_menu_menu">Aparece no menu?</label>
                                    <select name="aparece_menu_menu" id="aparece_menu_menu" class="form-control">
                                        <option value="S">SIM</option>
                                        <option value="N">NÃO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="control-group">
                                    <input type="submit" class="btn btn-primary font-weight-semi-bold px-4"  value="Cadastrar" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="reset" class="btn btn-danger forn-weight-semi-bold px4 expanded" value="Cancelar"/>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once 'includes/footerUsuario.php'; ?>