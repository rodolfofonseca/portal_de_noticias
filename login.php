<?php
require_once 'controller/modelos/Usuario.php';
require_once 'controller/UsuarioCtr.php';
require_once 'controller/utilidades/LogDoSistema.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(!empty($_POST)){
        try{
            $model = new Usuario();
        $controller = new UsuarioCtr();
        if(isset($_POST['login_usuario'])){
            $model->setNomeUsuario((string)strtoupper($_POST['login_usuario']));
        }
        if(isset($_POST['senha'])){
            $model->setSenhaUsuario((string) md5($_POST['senha']));
        }
        $retorno = $controller->Pesquisar("select * from usuario where nome_usuario = '".$model->getNomeUsuario()."' and senha_usuario = '".$model->getSenhaUsuario()."';");
        if($retorno != NULL){
            foreach($retorno as $usuario){
                if($usuario['status'] == 'ATIVO'){    
                    session_start();
                    $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];
                    $_SESSION['id_usuario'] = $usuario['id_usuario'];
                    $_SESSION['nome_usuario'] = $usuario['nome_usuario'];
                    header('Location: dashboard.php');
                }else{
                    ?>
                    <script>
                        Swal.fire('O que aconteceu?', 'Também estamos confusos, não sabemos porque não deu certo! \n Mas por favor converse com um de nosssos administradores', 'question');
                    </script>
                    <?php
                }
            }
        }else{
            ?>
            <script>
                Swal.fire({
                    title:'Atenção!',
                    text: 'Usuário ou senha incorretos!\n O que deseja fazer?',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Tentar novamente',
                    cancelButtonText: 'Conversar com ADM'
                }).then((result) =>{
                    if(result.isConfirmed){

                    }else{
                        window.location.replace('contato.php');
                    }
                });
            </script>
            <?php
        }
        }catch(Exception $ex){
            $logDoSistema = new LogDoSistema();
            $logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
        }        
    }
}
require_once 'includes/header.php';
?>
<div class="container-fluid py-3">
    <div class="container">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Login no sistema</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="contact-form bg-light mb-3" style="padding: 30px;">
                <form method="POST" acept="login.php">
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="login_usuario" id="login_usuario" class="form-control" required data-validation-required-message = "Informe o login para continuar" placeholder="Login do usuário"/>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="password" name="senha" id="senha" class="form-control" required placeholder="Senha do usuário" data-validation-required-message="Informe a senha para continuar com o login"/>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="submit" value="Entrar no sistema" class="btn btn-secondary font-weight-semi-bold px-4"/>
                            </div>
                        </div>
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