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
                            <th class="text-center">#</th>
                            <th class="text-center">DESCRIÇÃO CATEGORIA</th>
                            <th class="text-center">APARECE MENU</th>
                            <th class="text-center">MENU</th>
                            <th class="text-center">AÇÃO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $controller = new CategoriaCtr();
                        $retorno = $controller->Pesquisar('select categoria.id_categoria, categoria.descricao_categoria, categoria.aparece_menu, menu.descricao_menu from categoria, menu where menu.id_menu = categoria.id_menu_categoria order by descricao_categoria;');
                        foreach($retorno as $categoria){
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $categoria['id_categoria']; ?></td>
                                <td class="text-center"><?php echo $categoria['descricao_categoria']; ?></td>
                                <td class="text-center"><?php if($categoria['aparece_menu'] == 'S'){
                                    echo 'SIM';
                                }else{
                                    echo 'NÃO';
                                } ?></td>
                                <td class="text-center"><?php echo $categoria['descricao_menu']; ?></td>
                                <td class="text-center"><a href="categoria_alt.php?id_categoria=<?php echo $categoria['id_categoria']; ?>" class="btn btn-secondary font-weight-semi-bold px-4" style="height: 50px;">Alterar</a></td>
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