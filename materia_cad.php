<?php
require_once 'includes/headerUsuario.php';
?>
<div class="container-fluid py-3">
    <div class="container">
        <div class="gb-light py-2 px-4 mb-3">
            <h3>Cadastro de Matérias</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="contact-form bg-light mb-3" style="padding: 30px;">
                    <form method="POST" accept="materia_cad.php">
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="control-group">
                                    <input type="text" name="nome_noticia" id="nome_noticia" class="form-control p-12" placeholder="Nome da notícia" require="required" />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select name="categoria" id="categoria" class="form-control p-4">
                                        <option value=""></option>
                                    </select>
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