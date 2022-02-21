<?php
require_once 'includes/headerUsuario.php';
require_once 'controller/MenuCtr.php';
?>
<div class="container-fluid py-3">
    <div class="container">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Pesquisa de Menu</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="contact-form bg-light mb-3" style="padding: 30px;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>DESCRIÇÃO</th>
                            <th>APARECE MENU</th>
                            <th>AÇÃO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $controller = new MenuCtr();
                        $retorno = $controller->Pesquisar();
                        foreach($retorno as $menu){
                            ?>
                            <tr>
                                <td><?php echo $menu['id_menu']; ?></td>
                                <td><?php echo $menu['descricao_menu']; ?></td>
                                <td><?php if($menu['aparece_menu_menu']=='S'){echo 'SIM';}else{echo 'NÃO';} ?></td>
                                <td><a href="menu_alt.php?id_menu=<?php echo $menu['id_menu']; ?>" class="btn btn-secondary font-weight-semi-bold px-4" style="height: 50px;">Alterar</a></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once 'includes/footerUsuario.php';
?>