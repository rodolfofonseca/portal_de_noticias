<?php
require_once 'includes/headerUsuario.php';
require_once 'controller/EmpresaCtr.php';
?>
<div class="container-fluid py-3">
    <div class="container">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Pesquisa de Empresa</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="contact-form bg-light mb-3" style="padding: 30px;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NOME</th>
                            <th>OBSERVAÇÕES</th>
                            <th>WHATSAPP</th>
                            <th>AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $controller = new EmpresaCtr();
                        $retorno = $controller->Pesquisar('select * from empresa order by nome_empresa;');
                        foreach($retorno as $empresa){
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $empresa['id_empresa']; ?></td>
                                <td><?php echo $empresa['nome_empresa']; ?></td>
                                <td><?php echo $empresa['observacoes']; ?></td>
                                <td><?php echo $empresa['whatsapp']; ?></td>
                                <td class="text-center"><a href="empresa_alt.php?id_empresa=<?php echo $empresa['id_empresa'];?>" class="btn btn-secondary font-weight semi-bold px-4" style="height:50px;">Alterar</a></td>
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