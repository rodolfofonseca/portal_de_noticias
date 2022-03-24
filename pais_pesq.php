<?php
require_once 'includes/headerUsuario.php';
require_once 'controller/PaisCtr.php';
?>
<div class="container-fluid py-3">
    <div class="container">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Pesquisa de Países</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="contact-form bg-light mb-3" style="padding:30px;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">NOME</th>
                                <th class="text-center">SIGLA</th>
                                <th class="text-center">VISUALIZAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $controller = new PaisCtr();
                            $retorno = $controller->Pesquisar('select * from pais order by nome_pais');
                            foreach ($retorno as $pais) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $pais['id_pais']; ?></td>
                                    <td><?php echo $pais['nome_pais']; ?></th>
                                    <td class="text-center"><?php echo $pais['sigla']; ?></td>
                                    <td><a href="pais_alt.php?id_pais=<?php echo $pais['id_pais']; ?>" class="btn btn-secondary font-weight-semi-bold px-4">Alterar</a></td>
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