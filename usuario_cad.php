<?php
require_once 'includes/headerUsuario.php';
require_once 'controller/modelos/Usuario.php';
require_once 'controller/UsuarioCtr.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST)) {
        $model = new Usuario();
        $model->setNomeUsuario(strtoupper($_POST['nome_usuario']));
        $model->setEmailUsuario($_POST['email_usuario']);
        $model->setSenhaUsuario($_POST['senha_usuario']);
        $model->setStatusUsuario($_POST['status']);
        $model->setTipoUsuario($_POST['tipo_usuario']);
        $controller = new UsuarioCtr();
        $retorno = $controller->Salvar($model);
        if ($retorno == true) {
            ?><script>Swal.fire({icon:'success', title:'Sucesso', Text:'Operação realizada com sucesso!'});</script><?php
        } else {
            ?><script>Swal.fire({icon:'error', title:'Atenção', text:'Erro durante a operação', footer:'Tente novamente mais tarde'});</script><?php
        }
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
                    <form method="POST" accept="usuario_cad.php">
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="control-group">
                                    <label for="nome_usuario">Nome usuário</label>
                                    <input type="text" class="form-control px-4" id="nome_usuario" name="nome_usuario" placeholder="Nome do Usuário" required="required" data-validation-required-message="Informe o nome do usuário" />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="control-group">
                                    <label for="email">E-mail</label>
                                    <input type="email" class="form-control px-4" id="email" name="email_usuario" placeholder="email do usuário" required="required" data-validation-required-message="Informe o email do usuário" />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="control-group">
                                    <label for="senha_usuario">Senha</label>
                                    <input type="password" class="form-control px-4" id="senha_usuario" name="senha_usuario" placeholder="Senha do usuário" required="required" data-validation-required-message="Digite a senha do usuário" />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="control-group">
                                    <label for="tipo_usuario">Tipo usuario</label>
                                    <select name="tipo_usuario" id="tipo_usuario" class="form-control">
                                        <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                                        <option value="EDITOR" selected>EDITOR</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="control-group">
                                    <label for="status">Status usuário</label>
                                    <select name="status" id="status" class="form-control">
                                    <option value="ATIVO" selected>ATIVO</option>
                                    <option value="INATIVO">INATIVO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="control-group">
                                    <input type="submit" class="btn btn-primary font-weight-semi-bold px-4"  value="Cadastrar" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="reset" class="btn btn-danger font-weight-semi-bold px4" value="Cancelar"/>
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
require_once 'includes/footerUsuario.php';
?>