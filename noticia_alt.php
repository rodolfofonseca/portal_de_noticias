<?php
require_once 'includes/headerUsuario.php';
require_once 'controller/modelos/Noticias.php';
require_once 'controller/modelos/Usuario.php';
require_once 'controller/modelos/Categoria.php';
require_once 'controller/modelos/TituloDestaque.php';
require_once 'controller/NoticiasCtr.php';
require_once 'controller/CategoriaCtr.php';
require_once 'controller/UsuarioCtr.php';
require_once 'controller/TituloDestaqueCtr.php';
require_once 'controller/ParagrafoCtr.php';
require_once 'controller/utilidades/LogDoSistema.php';
require_once 'controller/utilidades/Data.php';
$id_noticia = (int) 0;
$model = new Noticias();
$usuario = new Usuario();
$categoria = new Categoria();
$tituloDestaque = new TituloDestaque();
$logDoSistema = new LogDoSistema();
$data = new Data();
$controller = new NoticiasCtr();
$usuarioCtr = new UsuarioCtr();
$categoriaCtr = new CategoriaCtr();
$tituloDestaqueCtr = new tituloDestaqueCtr();
$paragrafos = new ParagrafoCtr();
$quantidadeParagrafo = (int) 0;
if (!empty($_GET['id_noticia'])) {
    try {
        $id_noticia = (int) $_REQUEST['id_noticia'];
        $model->setIdNoticia($id_noticia);
    } catch (Exception $ex) {
        $logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST)) {
        try {
            $model->setNomeNoticia((string) strtoupper($_POST['titulo']));
            $usuario->setIdUsuario((int) $_POST['usuario']);
            $model->setUsuario($usuario);
            $categoria->setIdCategoria((int) $_POST['categoria']);
            $model->setCategoria($categoria);
            $tituloDestaque->setDataInicio((string) $_POST['data_inicio']);
            $tituloDestaque->setHoraInicio((int) $_POST['hora_inicio']);
            /*$tituloDestaque->setDataFim((string) $_POST['data_fim']);
            $tituloDestaque->setHoraFim((int) $_POST['hora_fim']);*/
            $tituloDestaque->setMateria($model);
            $model->setLinkMateria((string) strtolower($_POST['link_materia']));
            $model->setStatus($_POST['status']);
            $quantidadeParagrafo = $_POST['quantidade_paragrafo'];
            $retorno = $tituloDestaqueCtr->Pesquisar("select * from titulo_destaque where id_materia = '" . $model->getIdNoticia() . "';");
            foreach ($retorno as $destaque) {
                $tituloDestaque->setStatus((string) $destaque['status']);
                $tituloDestaque->setIdTituloDestaque((int) $destaque['id_titulo']);
            }
            if(isset($_FILES["imagem"]['name']) && $_FILES["imagem"]['error'] == 0){
                $nomeImagem = 'img/materias/'.$model->getLinkMateria();
                $nomeImagem = $nomeImagem;
                $arquivo_tmp = $_FILES["imagem"]['tmp_name'];
                $nomeAtual = $_FILES["imagem"]['name'];
                $extensao = strrchr($nomeAtual, '.');
                $extensao = strtolower($extensao);
                if(strstr('.jpg;.jpeg;.gif;.png', $extensao)){
                    $nomeImagem = $nomeImagem.$extensao;
                    if(@move_uploaded_file($arquivo_tmp, $nomeImagem)){
                        $model->setImagem((string) $nomeImagem);
                    }
                }
            }
            if ($tituloDestaque->getStatus() == 'I') {
?>
                <script>
                    Swal.fire({
                        title: 'Selecione o que deseja fazer',
                        text: 'O título de destaque se encontra inativo, deseja ativar novamente!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sim, ativar novamente!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            <?php
                            $tituloDestaque->setStatus((string) 'A');
                            ?>
                        }
                    });
                </script>
                <?php
            }
            $ret = $tituloDestaqueCtr->Alterar($tituloDestaque);
            if ($ret == true) {
                $ret = $controller->Alterar($model);
                if ($ret == true) {
                    $paragrafo = $paragrafos->Pesquisar("select count(*) as quantidade from paragrafos where id_noticia = '" . $model->getIdNoticia() . "';");
                    $qtd = (int) 0;
                    foreach ($paragrafo as $para) {
                        $qtd = (int) $para['quantidade'];
                    }
                    if ($qtd > $quantidadeParagrafo) {
                ?>
                        <script>
                            Swal.fire({
                                title: 'Opção de parágrafos',
                                text: 'A quantidade de parágrafos atual é menor que a quantidade anterior, deseja apagar alguns parágrafos? antes de apagar tenha certeza de ter a matéria escrita pois a ação não pode ser desfeita!',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Sim, apagar!'
                            }).then((result) => {
                                if(result.isConfirmed){
                                    <?php
                                    $paragrafos->ExecutarComando("delete from paragrafos where id_noticia = '".$model->getIdNoticia()."';");
                                    $_SESSION['noticia'] = $noticiasModel->getIdNoticia();
                                    $_SESSION['quantidade_paragafos'] = $quantidadeParagrafo;
                                    ?>
                                    window.location.href = "paragrafos_cad.php";
                                }
                            });
                        </script>
<?php
                    }else{
                        $_SESSION['noticia'] = $model->getIdNoticia();
                        $_SESSION['quantidade_paragafos'] = $quantidadeParagrafo;
                        ?>
                        <script>
                            window.location.href = "paragrafos_alt.php";
                        </script>
                        <?php
                    }
                }
            }
        } catch (Exception $ex) {
            $logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
        }
    }
} else {
    try {
        $retorno = $controller->Pesquisar("select * from noticias where id_noticias = '" . $model->getIdNoticia() . "';");
        $retornoDestaque = $tituloDestaqueCtr->Pesquisar("select * from titulo_destaque where id_materia = '" . $model->getIdNoticia() . "';");
        foreach ($retorno as $not) {
            $usuario->setIdUsuario((int) $not['id_usuario']);
            $model->setUsuario($usuario);
            $categoria->setIdCategoria((int) $not['id_categoria']);
            $model->setCategoria($categoria);
            $model->setNomeNoticia((string) $not['titulo_noticias']);
            $model->setDataPostagem((string) $not['data_postagem']);
            $model->setStatus((string) $not['status']);
            $model->setLinkMateria((string) $not['link_materia']);
            $model->setImagem((string) $not['imagem']);
        }
        foreach ($retornoDestaque as $destaque) {
            $tituloDestaque->setIdTituloDestaque((int) $destaque['id_titulo']);
            $tituloDestaque->setDataInicio((string) $destaque['data_inicio']);
            $tituloDestaque->setHoraInicio((int) $destaque['hora_inicio']);
            $tituloDestaque->setDataFim((string) $destaque['data_fim']);
            $tituloDestaque->setHoraFim((int) $destaque['hora_fim']);
        }
        $paragrafo = $paragrafos->Pesquisar("select count(*) as quantidade from paragrafos where id_noticia = '" . $model->getIdNoticia() . "';");
        foreach ($paragrafo as $para) {
            $quantidadeParagrafo = (int) $para['quantidade'];
        }
    } catch (Exception $ex) {
        $logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
    }
}
?>
<script type="text/javascript">
    function ajuda() {
        Swal.fire(
            'O que são esses campos?',
            'Os campos DATA INÍCIO, DATA FIM, HORA INÍCIO, HORA FIM serve para informar o sistema até quando a matéria deve ter o seu título destacado!',
            'question'
        );
    }

    function linkMateria() {
        let link = document.getElementById('titulo').value;
        link = link.replaceAll(' ', '_');
        document.getElementById('link_materia').value = link;
    }

    function imagem() {
        Swal.fire({
            imageUrl: '<?php echo $model->getImagem(); ?>',
            imageWidth: 400,
            imageHeight: 200
        });
    }
</script>
<div class="container-fluid py-3">
    <div class="container">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Alteração de Matérias</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="contact-form bg-light mb-3" style="padding: 30px;">
                    <form method="POST" accept="noticia_alt?id_noticia=<?php echo $model->getIdNoticia(); ?>" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="col-md-12">
                                <label for="titulo">Título</label>
                                <input type="text" name="titulo" id="titulo" placeholder="TÍTULO DA MATÉRIA" required data-validation-required-message="Informe o título da matéria" class="form-control" onblur="linkMateria();" value="<?php echo $model->getNomeNoticia(); ?>" />
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="usuario">Escrita por</label>
                                <select name="usuario" id="usuario" class="form-control">
                                    <?php
                                    $retorno = $usuarioCtr->Pesquisar("select * from usuario where status = 'ATIVO'order by nome_usuario;");
                                    foreach ($retorno as $usuario_retorno) {
                                        if ($model->getUsuario()->getIdUsuario() == $usuario_retorno['id_usuario']) {
                                    ?>
                                            <option value="<?php echo $usuario_retorno['id_usuario']; ?>" selected><?php echo $usuario_retorno['nome_usuario']; ?></option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="<?php echo $usuario_retorno['id_usuario']; ?>"><?php echo $usuario_retorno['nome_usuario']; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="categoria">Categoria</label>
                                <select name="categoria" id="categoria" class="form-control">
                                    <?php
                                    $retorno_categoria = $categoriaCtr->Pesquisar("select categoria.id_categoria, categoria.descricao_categoria, menu.descricao_menu from categoria, menu where aparece_menu = 'S' and categoria.id_menu_categoria = menu.id_menu order by descricao_categoria;");
                                    foreach ($retorno_categoria as $categoria_retorno) {
                                        if ($model->getCategoria()->getIdCategoria() == $categoria_retorno['id_categoria']) {
                                    ?>
                                            <option value="<?php echo $categoria_retorno['id_categoria']; ?>" selected><?php echo $categoria_retorno['descricao_menu'].' / '.$categoria_retorno['descricao_categoria']; ?></option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="<?php echo $categoria_retorno['id_categoria']; ?>"><?php echo $categoria_retorno['descricao_menu'].' / '.$categoria_retorno['descricao_categoria']; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <br />
                        <div class="form-row">
                            <div class="col-md-3">
                                <label for="data_inicio">Data início</label>
                                <input type="date" name="data_inicio" id="data_inicio" class="form-control" required value="<?php echo $tituloDestaque->getDataInicio(); ?>" />
                            </div>
                            <div class="col-md-2">
                                <label for="hora_inicio">Hora de início</label>
                                <input type="number" name="hora_inicio" id="hora_inicio" class="form-control" placeholder="00" required value="<?php echo $tituloDestaque->getHoraInicio(); ?>" />
                            </div>
                            <div class="col-md-3">
                                <label for="data_fim">Data Fim</label>
                                <input type="date" name="data_fim" id="data_fim" class="form-control" required value="<?php echo $tituloDestaque->getDataFim(); ?>" />
                            </div>
                            <div class="col-md-2">
                                <label for="hora_fim">Hora fim</label>
                                <input type="number" name="hora_fim" id="hora_fim" class="form-control" required placeholder="00" value="<?php echo $tituloDestaque->getHoraFim(); ?>" />
                            </div>
                            <div class="col-md-2">
                                <label>Precisa de ajuda?</label>
                                <a href="#" class="btn btn-secondary font-weight-semi-bold px-4 expanded" onclick="ajuda();">Ajuda</a>
                            </div>
                        </div>
                        <br />
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="control-group">
                                    <label for="link_materia">Link da matéria</label>
                                    <input type="text" name="link_materia" id="link_materia" value="<?php echo $model->getLinkMateria(); ?>" class="form-control" placeholder="LINK DA MATÉRIA" readonly />
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="form-row">
                            <div class="col-md-3">
                                <div class="control-group">
                                    <label for="imagem">Imagem</label>
                                    <input type="file" name="imagem" id="imagem" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="control-group">
                                    <label for="quantidade_paragrafo">Qtd. Parágrafos</label>
                                    <input type="number" name="quantidade_paragrafo" id="quantidade_paragrafo" value="<?php echo $quantidadeParagrafo; ?>" placeholder="QUANTIDADE PARÁGRAFO" required class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="control-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <?php
                                        if ($model->getStatus() == 'A') {
                                        ?>
                                            <option value="A" selected>ATIVO</option>
                                            <option value="I">INATIVO</option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="A">ATIVO</option>
                                            <option value="I" selected>INATIVO</option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="control-group">
                                    <label>Visualizar Imagem</label>
                                    <a href="#" class="btn btn-secondary font-weight-semi-bold px-4 expanded" onclick="imagem();">Visualizar Imagem</a>
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="control-group">
                                    <input type="submit" class="btn btn-primary font-weight-semi-bold px-4" value="Cadastrar" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="reset" class="btn btn-danger forn-weight-semi-bold px4 expanded" value="Cancelar" />
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