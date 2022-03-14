<?php
require_once 'controller/utilidades/Data.php';
include_once 'controller/TituloDestaqueCtr.php';
include_once 'controller/MenuCtr.php';
include_once 'controller/CategoriaCtr.php';
include_once 'controller/NoticiasCtr.php';
include_once 'controller/ParagrafoCtr.php';
$dataSistema = new Data();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>ASSPOL - Associação Polícial</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Asspol associação polícial" name="keywords">
    <meta content="Asspol associação polícial" name="description">
    <link rel="shortcut icon" href="img/icone/favicon.ico" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="css/carousel.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/alerta_css.css" rel="stylesheet">
    <script defer src="js/jQuery.js"></script>
    <script defer src="js/bundle.js"></script>
    <script defer src="js/easing.js"></script>
    <script defer src="js/carousel.js"></script>
    <script defer src="js/emailValidator.js"></script>
    <script defer src="js/contato.js"></script>
    <script defer src="js/main.js"></script>
    <script src="js/alerta.js"></script>
    <script type="text/javascript">
        /**
         * Função que se repete a cada segundo e adiciona na tela o tempo de hoje.
         */
        function iniciar_hora() {
            var data_e_hora = new Date();
            semana = new Array("Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado");
            mes = new Array("Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");
            var hora = data_e_hora.getHours();
            var minutos = data_e_hora.getMinutes();
            var segundos = data_e_hora.getSeconds();
            hora = adicionar_zero(hora);
            minutos = adicionar_zero(minutos);
            segundos = adicionar_zero(segundos);
            var tempo = semana[data_e_hora.getDay()] + ", " + data_e_hora.getDate() + " de " + mes[data_e_hora.getMonth()] + " de " + data_e_hora.getFullYear() + " " + hora + ":" + minutos + ":" + segundos;
            document.getElementById('hora_div').innerHTML = tempo;
            t = setTimeout('iniciar_hora()', 500);
        }
        /**
         * Função responsável por verificar se o tempo é < 10 e adicionar um zero na frente para facilitar a visualização do mes,p
         */
        function adicionar_zero(tempo) {
            if (tempo < 10) {
                tempo = "0" + tempo;
            }
            return tempo;
        }
    </script>
</head>

<body onload="iniciar_hora()">
    <div class="container-fluid">
        <div class="row align-items-center bg-light px-lg-5">
            <div class="col-12 col-md-8">
                <div class="d-flex justify-content-between">
                    <div class="bg-primary text-white text-center py-2" style="width: 100px;">Notícias</div>
                    <div class="owl-carousel owl-carousel-1 tranding-carousel position-relative d-inline-flex align-items-center ml-3" style="width: calc(100% - 100px); padding-left: 90px;">
                        <?php
                        $tituloDestaque = new tituloDestaqueCtr();
                        $retorno = $tituloDestaque->Pesquisar("select noticias.titulo_noticias, noticias.link_materia from titulo_destaque, noticias where titulo_destaque.id_materia = noticias.id_noticias and titulo_destaque.status = 'A' order by noticias.titulo_noticias;");
                        foreach ($retorno as $destaques) {
                        ?>
                            <div class="text-truncate"><a class="text-secondary" href="materia.php?link_materia=<?php echo $destaques['link_materia']; ?>"><?php echo $destaques['titulo_noticias']; ?></a></div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-right d-none d-md-block" id="hora_div"></div>
        </div>
        <div class="row align-items-center py-2 px-lg-5">
            <div class="col-lg-12 text-center">
                <a href="" class="navbar-brand d-lg-block">
                    <img class="img-fluid" src="img/Logo450x180.png" alt="" srcset="">
                </a>
            </div>
        </div>
    </div>
    <div class="container-fluid p-0 mb-3">
        <nav class="navbar navbar-expand-lg bg-light navbar-light py-2 py-lg-0 px-lg-5">
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-0 px-lg-3" id="navbarCollapse">
                <div class="navbar-nav mr-auto py-0">
                    <a href="index.php" class="nav-item nav-link active">Home</a>
                    <?php
                    $menu = new MenuCtr();
                    $menu_retorno = $menu->Pesquisar("select * from menu where aparece_menu = 'S' order by descricao_menu;");
                    $categoria = new CategoriaCtr();
                    foreach ($menu_retorno as $menuRetorno) {
                        if ($menuRetorno['tem_sub_menu'] == 'S') {
                            $retorno_categoria = $categoria->Pesquisar("select * from categoria, menu where categoria.id_menu_categoria = menu.id_menu and categoria.aparece_menu = 'S' and categoria.id_menu_categoria = '" . $menuRetorno['id_menu'] . "' order by categoria.descricao_categoria;");
                    ?>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><?php echo $menuRetorno['descricao_menu'] ?></a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <?php
                                    foreach ($retorno_categoria as $categoriaRetorno) {
                                    ?>
                                        <a href="categorias.php?categoria=<?php echo $categoriaRetorno['id_categoria']; ?>" class="dropdown-item"><?php echo $categoriaRetorno['descricao_categoria']; ?></a>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <a href="categorias.php?categoria=<?php echo $categoriaRetorno['id_categoria']; ?>" class="nav-item nav-link"><?php echo $menuRetorno['descricao_menu']; ?></a>
                    <?php
                        }
                    }
                    ?>
                </div>
                <div class="input-group ml-auto" style="width: 100%; max-width: 300px;">
                    <input type="text" class="form-control" placeholder="Pesquisar">
                    <div class="input-group-append">
                        <button class="input-group-text text-secondary"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </nav>
    </div>