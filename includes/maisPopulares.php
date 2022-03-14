<div class="container-fluid py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                            <h3 class="m-0">Popular</h3>
                            <a class="text-secondary font-weight-medium text-decoration-none" href="index.php">Ver Todos</a>
                        </div>
                    </div>
                    <?php
                    $materiaCtr = new NoticiasCtr();
                    $id_categoria = (int) 0;
                    if(isset($_GET['categoria'])){
                        $id_categoria = $_GET['categoria'];
                    }
                    $contador = (int) 0;
                    $retorno_ancuncios_internos = $materiaCtr->Pesquisar("select * from anuncios where status = 'A' and id_locais = '1' order by id_anuncio asc limit 5;");
                    $anuncios = array();
                    $contadorAnuncios = (int) 0;
                    $tamanhoAnuncios = (int) 0;
                    if(empty($retorno_ancuncios_internos) == false){
                        foreach($retorno_ancuncios_internos as $retorno_ancuncios_interno){
                            $anuncios[$contadorAnuncios]['local_imagem'] = $retorno_ancuncios_interno['local_imagem'];
                            $contadorAnuncios++;
                        }
                        $tamanhoAnuncios = count($anuncios);
                    }
                    $contadorAnuncios = 0;
                    $pesquisa = array();
                    if($id_categoria == 0){
                        $pesquisa = $materiaCtr->Pesquisar("select * from noticias where status = 'A' order by id_noticias desc limit 20;");
                    }else{
                        $pesquisa = $materiaCtr->Pesquisar("select * from noticias where status = 'A' and id_categoria = '".$id_categoria."' order by id_noticias desc limit 20;");
                    }
                    if (empty($pesquisa) == false) {
                        foreach ($pesquisa as $retorno) {
                            $contador++;
                            $retorno_categoria = $materiaCtr->Pesquisar("select * from categoria where id_categoria = '" . $retorno['id_categoria'] . "'");
                            $descricao_categoria = (string) '';
                            $descricao_paragrafo = (string) '';
                            if (empty($retorno_categoria) == false) {
                                foreach ($retorno_categoria as $categoria) {
                                    $descricao_categoria = $categoria['descricao_categoria'];
                                }
                            }
                            $retorno_paragrado = $materiaCtr->Pesquisar("select * from paragrafos where id_noticia = '" . $retorno['id_noticias'] . "' limit 1;");
                            if (empty($retorno_paragrado) == false) {
                                foreach ($retorno_paragrado as $paragrafo) {
                                    $descricao_paragrafo = substr($paragrafo['paragrafo'], 0, 150);
                                }
                            }
                    ?>
                            <div class="col-lg-6">
                                <div class="position-relative mb-3">
                                    <img class="img-fluid w-100" src="<?php echo $retorno['imagem']; ?>" style="object-fit: cover;">
                                    <div class="overlay position-relative bg-light">
                                        <div class="mb-2" style="font-size: 14px;">
                                            <a href="#"><?php echo $descricao_categoria; ?></a>
                                            <span class="px-1">/</span>
                                            <span>
                                                <?php
                                                echo $retorno['data_postagem'];
                                                ?>
                                            </span>
                                        </div>
                                        <a class="h6" href="materia.php?link_materia=<?php echo $retorno['link_materia']; ?>"><?php echo substr($retorno['titulo_noticias'], 0, 80); ?></a>
                                        <p class="m-0"><?php echo $descricao_paragrafo; ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if ($contador % 2 == 0) {
                                    if($tamanhoAnuncios==1){
                                        ?>
                                    </div>
                                        <div class="mb-3 pb-3">
                                            <a href=""><img class="imagem_anuncio_central w-100" src="<?php echo $anuncios[0]['local_imagem']; ?>" alt=""></a>
                                        </div>
                                    <div class="row">
                                    <?php
                                    }
                                    if($tamanhoAnuncios == 2){
                                        if($contadorAnuncios < 2){
                                            ?>
                                            </div>
                                            <div class="mb-3 pb-3">
                                                <a href=""><img class="imagem_anuncio_central w-100" src="<?php echo $anuncios[$contadorAnuncios]['local_imagem']; ?>"/></a>
                                            </div>
                                            <div class="row">
                                            <?php
                                            $contadorAnuncios++;
                                            if($contadorAnuncios == 2){
                                                $contadorAnuncios = 0;
                                            }
                                        }
                                    }
                                    if($tamanhoAnuncios == 3){
                                        if($contadorAnuncios < 3){
                                            ?>
                                            </div>
                                            <div class="mb-3 pb-3">
                                                <a href=""><img class="imagem_anuncio_central w-100" src="<?php echo $anuncios[$contadorAnuncios]['local_imagem']; ?>"/></a>
                                            </div>
                                            <div class="row">
                                            <?php
                                            $contadorAnuncios++;
                                            if($contadorAnuncios == 3){
                                                $contadorAnuncios = 0;
                                            }
                                        }
                                    }
                                    if($tamanhoAnuncios == 4){
                                        if($contadorAnuncios < 4){
                                            ?>
                                            </div>
                                            <div class="mb-3 pb-3">
                                                <a href=""><img class="imagem_anuncio_central w-100" src="<?php echo $anuncios[$contadorAnuncios]['local_imagem']; ?>"/></a>
                                            </div>
                                            <div class="row">
                                            <?php
                                            $contadorAnuncios++;
                                            if($contadorAnuncios == 2){
                                                $contadorAnuncios = 0;
                                            }
                                        }
                                    }
                                    if($tamanhoAnuncios == 5){
                                            ?>
                                            </div>
                                            <div class="mb-3 pb-3">
                                                <a href=""><img class="imagem_anuncio_central w-100" src="<?php echo $anuncios[$contadorAnuncios]['local_imagem']; ?>"/></a>
                                            </div>
                                            <div class="row">
                                            <?php
                                            $contadorAnuncios++;
                                        }                               
                                }
                            }
                        }
                    ?>
                </div>
            </div>
            <?php require_once './includes/redesSociais.php'; ?>
        </div>
    </div>
</div>
</div>
</div>