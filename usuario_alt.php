<?php
require_once 'includes/headerUsuario.php';
require_once 'controller/modelos/Usuario.php';
require_once 'controller/UsuarioCtr.php';
$id_usuario = null;
$usuario = new Usuario();
if(!empty($_GET['id_usuario'])){
    $id_usuario = $_REQUEST['id_usuario'];
    $usuario->setIdUsuario((int)$id_usuario);
}
if(null == $id_usuario){
    header('Location:dashboard.php');
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST)) {
        $usuario->setNomeUsuario((string)strtoupper($_POST['nome_usuario']));
        $usuario->setEmailUsuario((string)$_POST['email_usuario']);
        $usuario->setSenhaUsuario((string)$_POST['senha_usuario']);
        $controller = new UsuarioCtr();
        $retorno = $controller->Alterar($usuario);
        if ($retorno == true) {
?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso',
                    text: 'Usuário alterado com sucesso!'
                });
            </script>
        <?php
        } else {
        ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Atenção',
                    text: 'Erro ao alterar o usuário!',
                    footer: 'Tente novamente mais tarde'
                });
            </script>
<?php
        }
    }
}else{
    $pesquisa = new UsuarioCtr();
    $retorno = $pesquisa->Pesquisar('select * from usuario where id_usuario = '.$id_usuario.';');
    foreach($retorno as $ret){
        $usuario->setIdUsuario((int) $ret['id_usuario']);
        $usuario->setNomeUsuario((string) $ret['nome_usuario']);
        $usuario->setEmailUsuario((string) $ret['email_usuario']);
    }
}
?>
<div class="container-fluid py-3">
    <div class="container">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Cadastro de usuários</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="contact-form bg-light mb-3" style="padding: 30px;">
                    <div id="success"></div>
                    <form method="POST" accept="usuario_alt.php?id_usuario=<?php echo $usuario->getIdUsuario(); ?>">
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="control-group">
                                    <input type="text" class="form-control p-4" id="nome_usuario" name="nome_usuario" value="<?php echo $usuario->getNomeUsuario(); ?>" placeholder="Nome do Usuário" required="required" data-validation-required-message="Informe o nome do usuário" />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="control-group">
                                    <input type="email" class="form-control p-4" id="email" name="email_usuario" value="<?php echo $usuario->getEmailUsuario(); ?>" placeholder="email do usuário" required="required" data-validation-required-message="Informe o email do usuário" />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="control-group">
                                    <input type="password" class="form-control p-4" id="senha_usuario" name="senha_usuario" placeholder="Senha do usuário" required="required" data-validation-required-message="Digite a senha do usuário" />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <input type="submit" class="btn btn-primary font-weight-semi-bold px-4" style="height: 50px;" value="Alterar" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once 'includes/footer.php';
?>