<div class="container-fluid bg-light pt-5 px-sm-3 px-md-5">
    <div class="row">
        <?php
        $noticiaCtr = new NoticiasCtr();
        $retornoFooter = $noticiaCtr->Pesquisar("select * from anuncios where status = 'A' and id_locais = '3' order by id_anuncio asc limit 2;");
        if(empty($retornoFooter) == false){
            foreach($retornoFooter as $retorno){
                ?>
            <div class="col-lg-3 col-md-6 mb-5">
            <h4 class="font-weight-bold mb-4">Patrocinador</h4>
            <div class="d-flex flex-wrap m-n1">
            <img src="<?php echo $retorno['local_imagem']; ?>" />
            </div>
        </div>
                <?php
            }
        }
        ?>
        </div>
        <div class="col-lg-3 col-md-6 mb-5">
            <h4 class="font-weight-bold mb-4">Links Rápidos</h4>
            <div class="d-flex flex-column justify-content-start">
                <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right text-dark mr-2"></i>Sobre</a>
                <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right text-dark mr-2"></i>Política de privacidade</a>
                <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right text-dark mr-2"></i>Termos & condições</a>
                <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right text-dark mr-2"></i>Contatos</a>
                <a class="text-secondary" href="login.php"><i class="fa fa-angle-right text-dark mr-2"></i>Login</a>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid py-4 px-sm-3 px-md-5">
    <p class="m-0 text-center">
        &copy; <?php echo $dataSistema->ano(true); ?> Asspol. Todos os direitos reservados.
    </p>
</div>
<a href="#" class="btn btn-dark back-to-top"><i class="fa fa-angle-up"></i></a>

</body>

</html>