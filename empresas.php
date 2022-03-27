<?php
require_once 'includes/header.php';
require_once 'controller/EmpresaCtr.php';
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
                    $retorno = $controller->Pesquisar("select * from empresa order by nome_empresa");
                    if(empty($retorno) == false){
                        foreach($retorno as $empresa){
                            ?>
                            <div class="col-lg-12">
                            <div class="position-relative mb-3">
                                    <img class="img-fluid w-100" src="<?php echo $empresa['imagem']; ?>" style="object-fit: cover;">
                                    <div class="overlay position-relative bg-light">
                                        <div class="mb-2" style="font-size: 14px;">
                                            <a href="<?php echo $empresa['imagem']; ?>"><?php echo $empresa['nome_empresa']; ?></a>
                                        </div>
                                        <a class="h6" href="empresa.php?id_empresa=<?php echo $empresa['id_empresa']; ?>"><?php echo $empresa['nome_empresa']; ?></a>
                                        <p class="m-0"><?php echo $empresa['observacoes'] ?></p>
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
require_once 'includes/footer.php';
?>