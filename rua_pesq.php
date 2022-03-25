<?php
require_once 'includes/headerUsuario.php';
require_once 'controller/RuaCtr.php';
?>
<div class="container-fluid py-3">
    <div class="container">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Pesquisa de Ruas</h3>
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
                            $controller = new RuaCtr();
                            $retorno = $controller->Pesquisar('select rua.id_rua, rua.nome_rua, bairros.nome_bairro from rua, bairros where bairros.id_bairros = rua.id_bairro order by rua.nome_rua;');
                            foreach ($retorno as $rua) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $rua['id_rua']; ?></td>
                                    <td><?php echo $rua['nome_rua']; ?></th>
                                    <td class="text-center"><?php echo $rua['nome_bairro']; ?></td>
                                    <td><a href="rua_alt.php?id_rua=<?php echo $rua['id_rua']; ?>" class="btn btn-secondary font-weight-semi-bold px-4">Alterar</a></td>
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