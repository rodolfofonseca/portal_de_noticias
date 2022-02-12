<div class="container-fluid py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                            <h3 class="m-0">Popular</h3>
                            <a class="text-secondary font-weight-medium text-decoration-none" href="">Ver Todos</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="position-relative mb-3">
                            <img class="img-fluid w-100" src="img/materias/1.jpg" style="object-fit: cover;">
                            <div class="overlay position-relative bg-light">
                                <div class="mb-2" style="font-size: 14px;">
                                    <a href="#">Aviação</a>
                                    <span class="px-1">/</span>
                                    <span>
                                        <?php
                                        echo $dataSistema->dia(true) . ', ' . $dataSistema->mes(false) . ' de ' . $dataSistema->ano(true);
                                        ?>
                                    </span>
                                </div>
                                <a class="h4" href="materia.php">Boeing compra 7,5 milhões de litros...</a>
                                <p class="m-0">A Boeing anunciou hoje, 7 de fevereiro, um acordo com a EPIC Fuels para a compra de dois milhões de galões </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="position-relative mb-3">
                            <img class="img-fluid w-100" src="img/materias/2.jpg" style="object-fit: cover;">
                            <div class="overlay position-relative bg-light">
                                <div class="mb-2" style="font-size: 14px;">
                                    <a href="">Tecnologia</a>
                                    <span class="px-1">/</span>
                                    <span><?php
                                            echo $dataSistema->dia(true) . ', ' . $dataSistema->mes(false) . ' de ' . $dataSistema->ano(true);
                                            ?></span>
                                </div>
                                <a class="h4" href="">Cientistas do MIT criam plástico 2 vezes mais...</a>
                                <p class="m-0">Rebum dolore duo et vero ipsum clita, est ea sed duo diam ipsum, clita at justo, lorem amet vero eos sed sit...</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3 pb-3">
                    <a href=""><img class="img-fluid w-100" src="img/anunciante700x70.jpg" alt=""></a>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="position-relative mb-3">
                            <img class="img-fluid w-100" src="img/news-500x280-5.jpg" style="object-fit: cover;">
                            <div class="overlay position-relative bg-light">
                                <div class="mb-2" style="font-size: 14px;">
                                    <a href="">Tecnologia</a>
                                    <span class="px-1">/</span>
                                    <span><?php
                                            echo $dataSistema->dia(true) . ', ' . $dataSistema->mes(false) . ' de ' . $dataSistema->ano(true);
                                            ?></span>
                                </div>
                                <a class="h4" href="">Est stet amet ipsum stet clita rebum duo</a>
                                <p class="m-0">Rebum dolore duo et vero ipsum clita, est ea sed duo diam ipsum, clita at justo, lorem amet vero eos sed sit...</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="position-relative mb-3">
                            <img class="img-fluid w-100" src="img/news-500x280-6.jpg" style="object-fit: cover;">
                            <div class="overlay position-relative bg-light">
                                <div class="mb-2" style="font-size: 14px;">
                                    <a href="">Tecnologia</a>
                                    <span class="px-1">/</span>
                                    <span><?php
                                            echo $dataSistema->dia(true) . ', ' . $dataSistema->mes(false) . ' de ' . $dataSistema->ano(true);
                                            ?></span>
                                </div>
                                <a class="h4" href="">Est stet amet ipsum stet clita rebum duo</a>
                                <p class="m-0">Rebum dolore duo et vero ipsum clita, est ea sed duo diam ipsum, clita at justo, lorem amet vero eos sed sit...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php require_once './includes/redesSociais.php'; ?>
        </div>
    </div>
</div>
</div>
</div>