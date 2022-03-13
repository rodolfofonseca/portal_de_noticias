<?php
require_once 'includes/header.php';
$materiaCtr = new NoticiasCtr();
$link_materia = (string) '';
if (empty($_GET['link_materia']) == false) {
    $link_materia = $_GET['link_materia'];
}
$contador = (int) 0;
$retorno_noticias = $materiaCtr->Pesquisar("select * from noticias where link_materia = '" . $link_materia . "';");
if (empty($retorno_noticias) == false) {
    foreach ($retorno_noticias as $noticia) {
        $descricao_categoria = (string) '';
        $id_categoria = (int) 0;
        $categoria_retorno = $materiaCtr->Pesquisar("select * from categoria where id_categoria = '" . $noticia['id_categoria'] . "';");
        if (empty($categoria_retorno) == false) {
            foreach ($categoria_retorno as $categoria) {
                $id_categoria = (int) $categoria['id_menu_categoria'];
                $descricao_categoria = (string) $categoria['descricao_categoria'];
            }
        }
        $menu_retorno = $materiaCtr->Pesquisar("select * from menu where id_menu = '" . $id_categoria . "';");
        $descricao_menu = (string) '';
        if (empty($menu_retorno) == false) {
            foreach ($menu_retorno as $menu) {
                $descricao_menu = $menu['descricao_menu'];
            }
        }
?>
        <div class="container-fluid">
            <div class="container">
                <nav class="breadcrumb bg-transparent m-0 p-0">
                    <a class="breadcrumb-item" href="index.php">HOME</a>
                    <a class="breadcrumb-item" href="#"><?php echo $descricao_menu; ?></a>
                    <a class="breadcrumb-item" href="#"><?php echo $descricao_categoria ?></a>
                    <span class="breadcrumb-item active" href="#"><?php echo $noticia['titulo_noticias']; ?></span>
                </nav>
            </div>
        </div>
        <div class="container-fluid py-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="position-relative mb-3">
                            <img class="img-fluid w-100" src="<?php echo $noticia['imagem']; ?>" style="object-fit: cover;">
                            <div class="overlay position-relative bg-light">
                                <div class="mb-3">
                                    <a href=""><?php echo $descricao_categoria; ?></a>
                                    <span class="px-1">/</span>
                                    <span><?php echo $dataSistema->RetornarDataCompleta($noticia['data_postagem']); ?></span>
                                </div>
                                <div>
                                    <h3 class="mb-3"><?php echo $noticia['titulo_noticias']; ?></h3>
                                    <?php
                                    $paragrafos_retorno = $materiaCtr->Pesquisar("select * from paragrafos where id_noticia = '".$noticia['id_noticias']."' order by id_paragrafo asc;");
                                    if(empty($paragrafos_retorno) == false){
                                        foreach($paragrafos_retorno as $paragrafos){
                                            if($contador%2!=0){
                                                if($paragrafos['antes_depois'] == '-'){
                                                    ?>
                                                <p><?php echo $paragrafos['paragrafo']; ?></p>
                                                <?php
                                                }
                                                if($paragrafos['antes_depois'] == 'A'){
                                                    ?>
                                                <div class="mb-3 pb-3">
                                                    <a href=""><img class="img-fluid w-100" src="img/anunciante700x70.jpg" alt=""/></a>
                                                </div>
                                                <img class="img-fluid w-50 float-left mr-4 mb-2" src="<?php echo $paragrafos['imagem'] ?>">
                                                <p><?php echo $paragrafos['paragrafo']; ?></p>
                                                <?php
                                                }
                                                if($paragrafos['antes_depois'] == 'D'){
                                                    ?>
                                                <div class="mb-3 pb-3">
                                                    <a href=""><img class="img-fluid w-100" src="img/anunciante700x70.jpg" alt=""/></a>
                                                </div>
                                                <p><?php echo $paragrafos['paragrafo']; ?></p>
                                                <img class="img-fluid w-50 float-left mr-4 mb-2" src="<?php echo $paragrafos['imagem'] ?>">
                                                <?php
                                                }
                                            }else{
                                                if($contador%2==0){
                                                    if($paragrafos['antes_depois'] == '-'){
                                                        ?>
                                                    <p><?php echo $paragrafos['paragrafo']; ?></p>
                                                    <?php
                                                    }
                                                    if($paragrafos['antes_depois'] == 'A'){
                                                        ?>
                                                    <div class="mb-3 pb-3">
                                                        <a href=""><img class="img-fluid w-100" src="img/anunciante700x70.jpg" alt=""/></a>
                                                    </div>
                                                    <img class="img-fluid w-50 float-right mr-4 mb-2" src="<?php echo $paragrafos['imagem'] ?>">
                                                    <p><?php echo $paragrafos['paragrafo']; ?></p>
                                                    <?php
                                                    }
                                                    if($paragrafos['antes_depois'] == 'D'){
                                                        ?>
                                                    <div class="mb-3 pb-3">
                                                        <a href=""><img class="img-fluid w-100" src="img/anunciante700x70.jpg" alt=""/></a>
                                                    </div>
                                                    <p><?php echo $paragrafos['paragrafo']; ?></p>
                                                    <img class="img-fluid w-50 float-left ml-4 mb-2" src="<?php echo $paragrafos['imagem'] ?>">
                                                    <?php
                                                    }
                                                }
                                            }
                                            $contador++;
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php
    }
}
require_once 'includes/footer.php';
?>