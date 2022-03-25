<?php
require_once 'includes/headerUsuario.php';
require_once 'controller/BairroCtr.php';
?>
<div class="container-fluid py-3">
    <div class="container">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Pesquisa de Bairros</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="contact-form bg-light mb-3" style="padding:30px;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">NOME</th>
                                <th class="text-center">Cidade</th>
                                <th class="text-center">VISUALIZAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $controller = new BairroCtr();
                            $retorno = $controller->Pesquisar('select bairros.id_bairros, bairros.nome_bairro, cidade.nome_cidade from bairros, cidade where cidade.id_cidade = bairros.id_cidade order by bairros.nome_bairro');
                            foreach ($retorno as $bairro) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $bairro['id_bairros']; ?></td>
                                    <td><?php echo $bairro['nome_bairro']; ?></th>
                                    <td class="text-center"><?php echo $bairro['nome_cidade']; ?></td>
                                    <td><a href="bairro_alt.php?id_bairro=<?php echo $bairro['id_bairros']; ?>" class="btn btn-secondary font-weight-semi-bold px-4">Alterar</a></td>
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