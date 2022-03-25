<?php
require_once 'includes/headerUsuario.php';
require_once 'controller/CidadeCtr.php';
?>
<div class="container-fluid py-3">
    <div class="container">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Pesquisa de Cidades</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="contact-form bg-light mb-3" style="padding:30px;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">NOME</th>
                                <th class="text-center">ESTADO</th>
                                <th class="text-center">VISUALIZAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $controller = new CidadeCtr();
                            $retorno = $controller->Pesquisar('select cidade.id_cidade, cidade.nome_cidade, estado.nome_estado from cidade, estado where cidade.id_estado = estado.id_estado order by cidade.nome_cidade');
                            foreach ($retorno as $cidade) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $cidade['id_cidade']; ?></td>
                                    <td><?php echo $cidade['nome_cidade']; ?></th>
                                    <td class="text-center"><?php echo $cidade['nome_estado']; ?></td>
                                    <td><a href="cidade_alt.php?id_cidade=<?php echo $cidade['id_cidade']; ?>" class="btn btn-secondary font-weight-semi-bold px-4">Alterar</a></td>
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