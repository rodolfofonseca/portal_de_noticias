<?php
require_once 'includes/headerUsuario.php';
require_once 'controller/CategoriaCtr.php';
require_once 'controller/UsuarioCtr.php';
$usuarioCtr = new UsuarioCtr();
$categoriaCtr = new CategoriaCtr();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST)) {

    }
}
?>
<div class="container-fluid py-3">
    <div class="container">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Cadastro de notícias</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="contact-form bg-light mb-3" style="padding: 30px;">
                <form method="POST" accept="noticias_cad.php" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="col-md-12">
                            <label for="titulo">Título</label>
                            <input type="text" name="titulo" id="titulo" placeholder="TÍTULO DA MATERIA" required data-validation-required-message="Informe o título da matéria" class="form-control"/>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="usuario">Escrita por</label>
                            <select name="usuario" id="usuario" class="form-control">
                                <?php
                                $retorno = $usuarioCtr->Pesquisar("select * from usuario where status = 'ATIVO'order by nome_usuario;");
                                foreach($retorno as $usuario_retorno){
                                    ?>
                                    <option value="<?php echo $usuario_retorno['id_usuario']; ?>"><?php echo $usuario_retorno['nome_usuario']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="categoria">Categoria</label>
                            <select name="categoria" id="categoria" class="form-control">
                                <?php
                                $retorno_categoria = $categoriaCtr->Pesquisar("select * from categoria where aparece_menu = 'S' order by descricao_categoria;");
                                foreach($retorno_categoria as $categoria_retorno){
                                    ?>
                                    <option value="<?php echo $categoria_retorno['id_categoria']; ?>"><?php echo $categoria_retorno['descricao_categoria']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3">

                        </div>
                        <div class="col-md-3">
                            
                        </div>
                        <div class="col-md-3">
                            
                        </div>
                        <div class="col-md-3">
                            
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
                                    <input type="reset" class="btn btn-danger forn-weight-semi-bold px4 expanded" value="Cancelar"/>
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