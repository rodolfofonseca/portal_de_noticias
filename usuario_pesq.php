<?php
require_once 'includes/headerUsuario.php';
require_once 'controller/UsuarioCtr.php';
?>
<div class="container-fluid py-3">
    <div class="container">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Pesquisa de Usuários</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="contact-form bg-light mb-3" style="padding: 30px;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NOME</th>
                            <th>E-MAIL</th>
                            <th>AÇÃO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $comando = "select * from usuario order by nome_usuario;";
                        $controller = new UsuarioCtr();
                        $retorno = $controller->Pesquisar($comando);
                        foreach($retorno as $usuario){
                            ?>
                            <tr>
                                <td><?php echo $usuario['id_usuario']; ?></td>
                                <td><?php echo $usuario['nome_usuario']; ?></td>
                                <td><?php echo $usuario['email_usuario']; ?></td>
                                <td><a href="usuario_alt.php?id_usuario=<?php echo $usuario['id_usuario']; ?>" class="btn btn-secondary font-weight-semi-bold px-4" style="height: 50px;">Alterar</a></td>
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