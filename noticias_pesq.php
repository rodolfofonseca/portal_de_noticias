<?php
require_once 'includes/headerUsuario.php';
require_once 'controller/NoticiasCtr.php';
?>
<div class="container-fluid py-3">
    <div class="container">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Pesquisa de Notícias</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="contact-form bg-light mb-3" style="padding:30px;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">NOME</th>
                                <th class="text-center">DATA</th>
                                <th class="text-center">CATEGORIA</th>
                                <th class="text-center">STATUS</th>
                                <th class="text-center">VISUALIZAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $controller = new NoticiasCtr();
                            $retorno = $controller->Pesquisar('select noticias.id_noticias, noticias.titulo_noticias, noticias.data_postagem, categoria.descricao_categoria, noticias.status from noticias, categoria where categoria.id_categoria = noticias.id_categoria order by noticias.id_noticias desc limit 20;');
                            foreach ($retorno as $noticia) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $noticia['id_noticias']; ?></td>
                                    <td><?php echo $noticia['titulo_noticias']; ?></th>
                                    <td class="text-center"><?php echo $noticia['data_postagem']; ?></td>
                                    <td><?php echo $noticia['descricao_categoria']; ?></th>
                                    <td class="text-center"><?php 
                                    if($noticia['status'] == 'A'){
                                        echo 'ATIVO';
                                    }else{
                                        echo 'INATIVO';
                                    } ?>
                                    </td>
                                    <td><a href="noticia_alt.php?id_noticia=<?php echo $noticia['id_noticias']; ?>" class="btn btn-secondary font-weight-semi-bold px-4" style="height: 50px;">Alterar</a></td>
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