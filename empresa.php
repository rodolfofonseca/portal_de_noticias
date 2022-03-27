<?php
require_once 'includes/header.php';
require_once 'controller/EmpresaCtr.php';
if (empty($_GET['id_empresa']) == false) {
    $id_empresa = (string)$_GET['id_empresa'];
?>
    <div class="container-fluid py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                                <h3 class="m-0">Empresas</h3>
                            </div>
                        </div>
                        <?php
                        $controller = new EmpresaCtr();
                        $retorno = $controller->Pesquisar("select * from empresa where id_empresa = '" . $id_empresa . "';");
                        if (empty($retorno) == false) {
                            foreach ($retorno as $empresa) {
                                //https://hgbrasil.com/status/weather
                        ?>
                                <div class="col-lg-12">
                                    <div class="position-relative mb-3">
                                        <img class="img-fluid w-100" src="<?php echo $empresa['imagem']; ?>" style="object-fit: cover;">
                                        <div class="overlay position-relative bg-light">
                                            <a class="h6" href="empresa.php?id_empresa=<?php echo $empresa['id_empresa']; ?>"><?php echo $empresa['nome_empresa']; ?></a>
                                            <p class="m-0"><?php echo $empresa['observacoes'] ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="position-relative mb-3">
                                        <div class="overlay position-relative bg-light">
                                            <p>
                                            <h4 class="text-center">Contato</h4>
                                            </p>
                                            <p>Telefone: <?php echo $empresa['telefone_contato']; ?>     <img src="img/icone/telefone.png" width="25px" height="25px" /></p>
                                            <p>Whatsapp: <?php echo $empresa['whatsapp']; ?>     <img src="img/icone/whatsapp.png" width="25px" height="25px" /></p>
                                            <p>Site: <?php echo $empresa['site']; ?>     <img src="img/icone/site.png" width="25px" height="25px"/></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="position-relative mb-3">
                                        <div class="overlay position-relative bg-light">
                                            <h4 class="text-center">Redes sociais:</h4>
                                            <p>Facebook: <?php echo $empresa['facebook']; ?>     <img src="img/icone/facebook.png" width="25px" height="25px" /></p>
                                            <p>Instagram: <?php echo $empresa['instagram']; ?>     <img src="img/icone/instagram.png" width="25px" height="25px"/></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="position-relative mb-3">
                                        <div class="overlay position-relative bg-light">
                                            <h4 class="text-center">Endereço</h4>
                                            <p>
                                                <?php
                                                $descricao = (string) '';
                                                $identificador = (int) 0;
                                                $retorno = $controller->Pesquisar("select * from rua where id_rua = '".$empresa['id_rua']."';");
                                                if(empty($retorno) == false){
                                                    foreach($retorno as $rua){
                                                        $descricao = (string) $rua['nome_rua'];
                                                        $identificador = (int) $rua['id_bairro'];
                                                    }
                                                }
                                                $descricao = $descricao.' Nº: '.$empresa['numero'];
                                                $retorno = $controller->Pesquisar("select * from bairros where id_bairros = '".$identificador."';");
                                                if(empty($retorno) == false){
                                                    foreach($retorno as $bairro){
                                                        $descricao = (string) $descricao.', '.$bairro['nome_bairro'];
                                                        $identificador = (int) $bairro['id_cidade'];
                                                    }
                                                }
                                                $retorno = $controller->Pesquisar("select * from cidade where id_cidade = '".$identificador."';");
                                                if(empty($retorno) == false){
                                                    foreach($retorno as $cidade){
                                                        $descricao = (string) $descricao.', '.$cidade['nome_cidade'];
                                                        $identificador = (int) $cidade['id_estado'];
                                                    }
                                                }
                                                $retorno = $controller->Pesquisar("select * from estado where id_estado = '".$identificador."';");
                                                if(empty($retorno) == false){
                                                    foreach($retorno as $bairro){
                                                        $descricao = (string) $descricao.', '.$bairro['nome_estado'].' / '.$bairro['sigla'];
                                                    }
                                                }
                                                echo $descricao;
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="position-relative-mb-3">
                                        <div class="overlay position-relative bg-light">
                                            <h4>Localização</h4>
                                            <iframe src="<?php echo $empresa['localizacao']; ?>" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" width="100%" height="400px"></iframe>
                                        </div>
                                    </div>
                                </div>
                        <?php
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
<?php
}
require_once 'includes/footer.php';
?>