<?php
require_once 'includes/headerUsuario.php';
require_once 'controller/LocaisCtr.php';
?>
<div class="container-fluid py-3">
    <div class="container">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Cadastro de locais</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="contact-form bg-light mb-" style="padding:30px;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>DESCRIÇÃO</th>
                                <th>OBSERVAÇÕES</th>
                                <th>AÇÃO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $controller = new LocaisCtr();
                            $retorno = $controller->Pesquisar('select * from locais order by descricao;');
                            foreach($retorno as $local){
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $local['id_local']; ?></td>
                                    <td><?php echo $local['descricao']; ?></td>
                                    <td><?php echo $local['observacao']; ?></td>
                                    <td class="text-center"><a href="locais_alt.php?id_local=<?php echo $local['id_local']; ?>" class="btn btn-secondary font-weight-semi-bold px-4" style="height: 50px;">Alterar</a></td>
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