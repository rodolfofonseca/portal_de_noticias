<?php
require_once 'includes/headerUsuario.php';
require_once 'controller/modelos/Paragrafos.php';
require_once 'controller/modelos/Noticias.php';
require_once 'controller/ParagrafoCtr.php';
require_once 'controller/utilidades/LogDoSistema.php';
$controller = new ParagrafoCtr();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST)) {
        try {
            $model = new Paragrafos();
            $materias = new Noticias();
            $controller->ExecutarComando("delete from paragrafos where id_noticia = '" . $_SESSION['noticia'] . "';");
            for ($contador = (int) 1; $contador <= $_SESSION['quantidade_paragafos']; $contador++) {
                $materias->setIdNoticia((int) $_SESSION['noticia']);
                $model->setNoticia($materias);
                $model->setTexto($_POST["paragrafo_$contador"]);
                $model->setLocalImagem($_POST["posicao_imagem_$contador"]);
                if (isset($_FILES["imagem_$contador"]['name']) && $_FILES["imagem_$contador"]['error'] == 0) {
                    $nomeImagem = 'img/paragrafos/' . $_SESSION['noticia'];
                    $nomeImagem = $nomeImagem . $contador;
                    $arquivo_tmp = $_FILES["imagem_$contador"]['tmp_name'];
                    $nomeAtual = $_FILES["imagem_$contador"]['name'];
                    $extensao = strrchr($nomeAtual, '.');
                    $extensao = strtolower($extensao);
                    if (strstr('.jpg;.jpeg;.gif;.png', $extensao)) {
                        $nomeImagem = $nomeImagem . $extensao;
                        if (@move_uploaded_file($arquivo_tmp, $nomeImagem)) {
                            $model->setImagem((string) $nomeImagem);
                        }
                    }
                }
                $retorno = $controller->Salvar($model);
                $model->setLocalImagem((string) '');
                $model->setImagem((string)'');
?>
                <script type="text/javascript">
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso',
                        Text: 'Opera????o realizada com sucesso!'
                    });
                </script>
            <?php
            }
        } catch (Exception $ex) {
            $logDoSistema = new LogDoSistema();
            $logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
            ?>
            <script type="text/javascript">
                Swal.fire({
                    icon: 'error',
                    title: 'Aten????o',
                    text: 'Erro durante a opera????o',
                    footer: 'Tente novamente mais tarde'
                });
            </script>
<?php
        }
    }
}
?>
<div class="container-fluid py-3">
    <div class="container">
        <div class="bg-light py-2 px4 mb-3">
            <h3 class="m-0">Altera????o de par??grafos</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="contact-form bg-light mb-3" style="padding: 30px;">
                    <form method="POST" accept="paragrados_alt.php" enctype="multipart/form-data">
                        <?php
                        $retorno = $controller->Pesquisar("select * from paragrafos where id_noticia = '" . $_SESSION['noticia'] . "';");
                        $retorno2 = $controller->Pesquisar("select count(*) as quantidade from paragrafos where id_noticia = '" . $_SESSION['noticia'] . "';");
                        $quantidade = (int) 0;
                        foreach ($retorno2 as $re) {
                            $quantidade = (int) $re['quantidade'];
                        }
                        if ($quantidade <= $_SESSION['quantidade_paragafos']) {
                            $contador = 1;
                            foreach ($retorno as $paragrafo) {
                        ?>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="control-group">
                                            <label for="paragrafo_<?php echo $contador; ?>" class="text-center">Par??grafo</label>
                                            <textarea id="paragrafo_<?php echo $contador; ?>" name="paragrafo_<?php echo $contador; ?>" class="form-control" required><?php echo $paragrafo['paragrafo']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="control-group">
                                            <label for="imagem_<?php echo $contador; ?>">Imagem</label>
                                            <input type="file" name="imagem_<?php echo $contador; ?>" id="imagem_<?php echo $contador; ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="control-group">
                                            <label for="posicao_imagem_<?php echo $contador; ?>">Posi????o da imagem</label>
                                            <select name="posicao_imagem_<?php echo $contador; ?>" id="posicao_imagem_<?php echo $contador; ?>" class="form-control">
                                                <?php
                                                if ($paragrafo['antes_depois'] == '-') {
                                                ?>
                                                    <option value="-" selected>----</option>
                                                    <option value="A">ANTES</option>
                                                    <option value="D">DEPOIS</option>
                                                    <?php
                                                } else {
                                                    if ($paragrafo['antes_depois'] == 'A') {
                                                    ?>
                                                        <option value="-">----</option>
                                                        <option value="A" selected>ANTES</option>
                                                        <option value="D">DEPOIS</option>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <option value="-">----</option>
                                                        <option value="A">ANTES</option>
                                                        <option value="D" selected>DEPOIS</option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <br />
                            <?php
                                $contador++;
                            }
                        }
                        if ($quantidade != $_SESSION['quantidade_paragafos']) {
                            $quantidade++;
                            for ($contador = (int) $quantidade; $contador <= $_SESSION['quantidade_paragafos']; $contador++) {
                            ?>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="control-group">
                                            <label for="paragrafo_<?php echo $contador; ?>" class="text-center">Par??grafo</label>
                                            <textarea id="paragrafo_<?php echo $contador; ?>" name="paragrafo_<?php echo $contador; ?>" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="control-group">
                                            <label for="imagem_<?php echo $contador; ?>">Imagem</label>
                                            <input type="file" name="imagem_<?php echo $contador; ?>" id="imagem_<?php echo $contador; ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="control-group">
                                            <label for="posicao_imagem_<?php echo $contador; ?>">Posi????o da imagem</label>
                                            <select name="posicao_imagem_<?php echo $contador; ?>" id="posicao_imagem_<?php echo $contador; ?>" class="form-control">
                                                <option value="-" selected>----</option>
                                                <option value="A">ANTES</option>
                                                <option value="D">DEPOIS</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <br />
                        <?php
                            }
                        }
                        ?>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="control-group">
                                    <input type="submit" class="btn btn-primary font-weight-semi-bold px-4" value="Cadastrar" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="reset" class="btn btn-danger font-weight-semi-bold px4" value="Cancelar" />
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