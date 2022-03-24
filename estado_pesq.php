<?php
require_once 'includes/headerUsuario.php';
require_once 'controller/EstadoCtr.php';
?>
<div class="container-fluid py-3">
    <div class="container">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Pesquisa de Estado</h3>
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
                                <th class="text-center">PAIS</th>
                                <th class="text-center">VISUALIZAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $controller = new EstadoCtr();
                            $retorno = $controller->Pesquisar('select estado.id_estado, estado.nome_estado, estado.sigla, pais.nome_pais from pais, estado where estado.id_pais = pais.id_pais order by nome_estado');
                            foreach ($retorno as $estado) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $estado['id_estado']; ?></td>
                                    <td><?php echo $estado['nome_estado']; ?></th>
                                    <td class="text-center"><?php echo $estado['sigla']; ?></td>
                                    <td class="text-center"><?php echo $estado['nome_pais']; ?></td>
                                    <td><a href="estado_alt.php?id_estado=<?php echo $estado['id_estado']; ?>" class="btn btn-secondary font-weight-semi-bold px-4">Alterar</a></td>
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