<?php
require_once 'includes/headerUsuario.php';
require_once 'controller/CategoriaCtr.php';
?>
<div class="container-fluid py-3">
    <div class="container">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Pesquisa de Categorias</h3>
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
                        $controller = new CategoriaCtr();
                        $retorno = $controller->Pesquisar();
                        foreach($retorno as $categoria){
                            ?>
                            <tr>
                                <td><?php echo $categoria['id_categoria']; ?></td>
                                <td><?php echo $categoria['descricao_categoria']; ?></td>
                                <td><?php echo $categoria['aparece_menu']; ?></td>
                                <td><a href="categoria_alt.php?id_categoria=<?php echo $categoria['id_categoria']; ?>" class="btn btn-secondary font-weight-semi-bold px-4" style="height: 50px;">Alterar</a></td>
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