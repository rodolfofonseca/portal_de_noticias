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
    <script defer src="js/jQuery.js"></script>
    <script defer src="js/bundle.js"></script>
    <script defer src="js/easing.js"></script>
    <script defer src="js/carousel.js"></script>
    <script defer src="js/emailValidator.js"></script>
    <script defer src="js/contato.js"></script>
    <script defer src="js/main.js"></script>
</head>

<body onload="">
    <div class="container-fluid">
        <div class="row align-items-center bg-light px-lg-5">
            <div class="col-12 col-md-8">
                <div class="d-flex justify-content-between">
                    <div class="bg-primary text-white text-center py-2" style="width: 100px;">Notícias</div>
                    <div class="owl-carousel owl-carousel-1 tranding-carousel position-relative d-inline-flex align-items-center ml-3" style="width: calc(100% - 100px); padding-left: 90px;">
                        <div class="text-truncate"><a class="text-secondary" href="">Avião venezuelano pousa em Campinas com toneladas de agrotóxicos.</a></div>
                        <div class="text-truncate"><a class="text-secondary" href="">Moody’s mantém nota de risco da Embraer e retira perspectiva negativa</a></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-right d-none d-md-block">
                <?php
                require_once('util/Data.php');
                $dataSistema = new Data();
                echo $dataSistema->dia(false) . ', ' . $dataSistema->mes(false) . ' ' . $dataSistema->dia(true) . ', ' . $dataSistema->ano(true);
                ?>
            </div>
        </div>
        <div class="row align-items-center py-2 px-lg-5">
            <div class="col-lg-12 text-center">
                <a href="" class="navbar-brand d-none d-lg-block">
                    <img class="img-fluid" src="img/Logo450x180.png" alt="" srcset="">
                </a>
            </div>
        </div>
    </div>
    <div class="container-fluid p-0 mb-3">
        <nav class="navbar navbar-expand-lg bg-light navbar-light py-2 py-lg-0 px-lg-5">
            <a href="" class="navbar-brand d-block d-lg-none">
                <h1 class="m-0 display-5 text-uppercase"><span class="text-primary">News</span>Room</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-0 px-lg-3" id="navbarCollapse">
                <div class="navbar-nav mr-auto py-0">
                    <a href="index.php" class="nav-item nav-link active">Home</a>
                    <a href="#" class="nav-item nav-link">Cidadania</a>
                    <a href="#" class="nav-item nav-link">Aviação</a>
                    <!--
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Dropdown</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="#" class="dropdown-item">Menu item 1</a>
                            <a href="#" class="dropdown-item">Menu item 2</a>
                            <a href="#" class="dropdown-item">Menu item 3</a>
                        </div>
                    </div>-->
                    <a href="$" class="nav-item nav-link">Contato</a>
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