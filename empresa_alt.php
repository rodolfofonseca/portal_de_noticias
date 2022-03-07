<?php
require_once 'includes/headerUsuario.php';
require_once 'controller/modelos/Empresa.php';
require_once 'controller/EmpresaCtr.php';
require_once 'controller/utilidades/LogDoSistema.php';
$id_empresa = NULL;
$model = new Empresa();
$controller = new EmpresaCtr();
$logDoSistema = new LogDoSistema();
if(!empty($_GET['id_empresa'])){
    try{
        $id_empresa = $_REQUEST['id_empresa'];
        $model->setIdEmpresa(intval($id_empresa));
    }catch(Exception $ex){
        $logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
    }
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(!empty($_POST)){
        try{
            $model->setNomeEmpresa((string) strtoupper($_POST['nome_empresa']));
            $model->setObservacao((string) $_POST['descricao']);
            $model->setTelefoneContato((string) $_POST['telefone']);
            $model->setWhatsapp((string) $_POST['whatsapp']);
            $model->setStatus((string) $_POST['status']);
            if($controller->Alterar($model)){
                ?>
                <script>
                    Swal.fire({ icon: 'success', title: 'Sucesso', text: 'Empresa alterada com sucesso!' });
                </script>
            <?php
            }else{
                ?>
                <script>
                    Swal.fire({ icon: 'error', title: 'Atenção', text: 'Erro ao alterar o menu!', footer: 'Tente novamente mais tarde' });
                </script>
                <?php 
            }
        }catch(Exception $ex){
            $logDoSistema->EscreverArquivo('LogDoSistema.txt', $ex->getMessage());
        }
    }
}else{
    try{
        $retorno = $controller->Pesquisar("select * from empresa where id_empresa = '".$model->getIdEmpresa()."';");
        foreach($retorno as $empresa){
            $model->setIdEmpresa((int) $empresa['id_empresa']);
            $model->setNomeEmpresa((string)$empresa['nome_empresa']);
            $model->setObservacao((string)$empresa['observacoes']);
            $model->setTelefoneContato((string)$empresa['telefone_contato']);
            $model->setWhatsapp((string)$empresa['whatsapp']);
            $model->setStatus((string)$empresa['status']);
        }
    }catch(Exception $ex){
        $logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
    }
}
?>
<script type="text/javascript">
    function validarWhatsapp () {
    let numero = document.getElementById('whatsapp').value;
    let retorno = validarTelefone(numero);
    if(retorno == false){
        Swal.fire({icon: 'error',title: 'Atenção',text: 'Número do whatsapp inválido!',footer: 'Arrume por favor!'});
    }
    function validarTelefoneFixo(){
        let numero = document.getElementById('telefone').value;
        let retorno = validarTelefone(numero);
        if(retorno == false){
            Swal.fire({icon: 'error',title: 'Atenção',text: 'Número do telefone inválido!',footer: 'Arrume por favor!'});
        }
    }
}
</script>
<div class="container-fluid py-3">
    <div class="container">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Alteração de Empresas</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="contact-form bg-light mb-3" style="padding: 30px;">
                    <form method="POST" accept="empresa_alt.php?id_empresa<?php echo $model->getIdEmpresa(); ?>">
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nome_empresa">Nome Empresa</label>
                                    <input type="text" name="nome_empresa" id="nome_empresa" class="form-control" required data-validation-required-message="Informe a descrição dos locais" placeholder="NOME DA EMPRESA" value="<?php echo $model->getNomeEmpresa(); ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="descricao">Descrição</label>
                                    <textarea name="descricao" id="descricao" class="form-control" placeholder="OBSERVAÇÕES"><?php echo $model->getObservacao(); ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="telefone">Telefone</label>
                                    <input type="tel" name="telefone" id="telefone" class="form-control" placeholder="(##)####-####" value="<?php echo $model->getTelefoneContato(); ?>"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="whatsapp">Whatsapp</label>
                                    <input type="tel" name="whatsapp" id="whatsapp" class="form-control" required data-validation-required-message="Inform o whatsapp" placeholder="(##)#####-####" onblur="validarWhatsapp();" value="<?php echo $model->getWhatsapp(); ?>"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <?php
                                        if($model->getStatus() == 'A'){
                                            ?>
                                            <option value="A" selected>ATIVO</option>
                                            <option value="I">INATIVO</option>
                                            <?php
                                        }else{
                                            ?>
                                            <option value="A">ATIVO</option>
                                            <option value="I" selected>INATIVO</option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
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