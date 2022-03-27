<?php
require_once 'includes/headerUsuario.php';
require_once 'controller/modelos/Empresa.php';
require_once 'controller/modelos/Rua.php';
require_once 'controller/EmpresaCtr.php';
require_once 'controller/utilidades/LogDoSistema.php';
$id_empresa = NULL;
$model = new Empresa();
$rua = new Rua();
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
            $rua->setIdRua((int) $_POST['rua']);
            $model->setRua($rua);
            $model->setNumero((string) $_POST['numero']);
            $model->setFacebook((string) $_POST['facebook']);
            $model->setInstagram((string) $_POST['instagram']);
            $model->setEmail((string) $_POST['email']);
            $model->setLocalizacao((string) $_POST['localizacao']);
            $model->setSite((string) $_POST['site']);
            if(isset($_FILES['arquivo']['name']) && $_FILES["arquivo"]["error"] == 0){
                $nome_imagem =(string) 'img/empresas/'.$model->getNomeEmpresa();
                $arquivo_tmp = $_FILES['arquivo']['tmp_name'];
                $nome_atual = $_FILES['arquivo']['name'];
                $extensao = strchr($nome_atual, '.');
                $extensao = strtolower($extensao);
                if(strstr('.jpg;.jpeg;.gif;.png', $extensao)){
                    $nome_imagem = $nome_imagem.$extensao;
                    if(@move_uploaded_file($arquivo_tmp, $nome_imagem)){
                        $model->setImagem($nome_imagem);
                    }
                }
            }
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
            $rua->setIdRua((int) $empresa['id_rua']);
            $model->setNumero((string) $empresa['numero']);
            $model->setFacebook((string) $empresa['facebook']);
            $model->setInstagram((string) $empresa['instagram']);
            $model->setEmail((string) $empresa['email']);
            $model->setLocalizacao((string) $empresa['localizacao']);
            $model->setSite((string) $empresa['site']);
            $model->setRua($rua);
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
}
    function pesquisaEstado(){
        console.log('aqui');
        let estado = document.querySelector('#estado').innerHTML;
        let select = document.querySelector('#pais');
        let valor = select.options[select.selectedIndex].value;
        document.cookie = 'pais='+valor;
        <?php
        $campo = (string) '';
        if(empty($_COOKIE['pais']) == false){
            $identificador = $_COOKIE['pais'];
            $retorno = $controller->Pesquisar("select * from estado where id_pais = '".$identificador."';");
            if(empty($retorno) == false){
                foreach($retorno as $estado){
                    $campo = $campo."<option value='".$estado['id_estado']."'>".$estado['nome_estado']."</option>";
                }
            }
        }
        ?>
        estado = "<?php echo $campo; ?>";
        document.querySelector('#estado').innerHTML = estado;
    }
    function pesquisaCidade(){
        let cidade = document.querySelector('#cidade').innerHTML;
        let select = document.querySelector('#estado');
        let valor = select.options[select.selectedIndex].value;
        document.cookie = 'estado='+valor;
        <?php
        $campo = (string) '';
        if(empty($_COOKIE['estado']) == false){
            $identificador = $_COOKIE['estado'];
            $retorno = $controller->Pesquisar("select * from cidade where id_estado = '".$identificador."';");
            if(empty($retorno) == false){
                foreach($retorno as $cidade){
                    $campo = $campo."<option value='".$cidade['id_cidade']."'>".$cidade['nome_cidade']."</option>";
                }
            }
        }
        ?>
        cidade = "<?php echo $campo; ?>";
        document.querySelector('#cidade').innerHTML = cidade;
    }
    function pesquisaBairro(){
        let bairro = document.querySelector('#bairro').innerHTML;
        let select = document.querySelector('#cidade');
        let valor = select.options[select.selectedIndex].value;
        document.cookie = 'cidade='+valor;
        <?php
        $campo = (string) '';
        if(empty($_COOKIE['cidade']) == false){
            $identificador = (string) $_COOKIE['cidade'];
            $retorno = $controller->Pesquisar("select * from bairros where id_cidade = '".$identificador."';");
            if(empty($retorno) == false){
                foreach($retorno as $bairro){
                    $campo = $campo."<option value='".$bairro['id_bairros']."'>".$bairro['nome_bairro']."</option>";
                }
            }
        }
        ?>
        bairro = "<?php echo $campo; ?>";
        document.querySelector('#bairro').innerHTML = bairro;
    }
    function pesquisaRua(){
        let rua = document.querySelector('#cidade').innerHTML;
        let select = document.querySelector('#bairro');
        let valor = select.options[select.selectedIndex].value;
        document.cookie = 'bairro='+valor;
        <?php
        $campo = (string) '';
        if(empty($_COOKIE['bairro']) == false){
            $identificador = (string) $_COOKIE['bairro'];
            $retorno = $controller->Pesquisar("select * from rua where id_bairro = '".$identificador."' order by nome_rua;");
            if(empty($retorno) == false){
                foreach($retorno as $rua){
                    $campo = $campo."<option value='".$rua['id_rua']."'>".$rua['nome_rua']."</option>";
                }
            }
        }
        ?>
        rua = "<?php echo $campo; ?>";
        document.querySelector('#rua').innerHTML = rua;
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
                    <form method="POST" accept="empresa_alt.php?id_empresa<?php echo $model->getIdEmpresa(); ?>"enctype="multipart/form-data" >
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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="imagem">Imagem</label>
                                    <input type="file" name="arquivo" id="imagem" placeholder="imagem" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="from-group">
                                    <label for="pais">Pais</label>
                                    <select name="pais" id="pais" class="form-control" onblur="pesquisaEstado();">
                                        <?php
                                        $pesquisa = $controller->Pesquisar("select * from pais order by nome_pais;");
                                        if(empty($pesquisa) == false){
                                            foreach($pesquisa as $retorno){
                                                ?>
                                                <option value="<?php echo $retorno['id_pais']; ?>"><?php echo $retorno['nome_pais']; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="from-group">
                                    <label for="estado">Estado</label>
                                    <select name="estado" id="estado" class="form-control" onblur="pesquisaCidade();">
                                        <option value="0">ESTADO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="from-group">
                                    <label for="cidade">Cidade</label>
                                    <select name="cidade" id="cidade" class="form-control" onblur="pesquisaBairro();">
                                        <option value="0">CIDADE</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="from-group">
                                    <label for="bairro">Bairro</label>
                                    <select name="bairro" id="bairro" class="form-control" onblur="pesquisaRua();">
                                        <option value="0">BAIRRO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="from-group">
                                    <label for="rua">Rua</label>
                                    <select name="rua" id="rua" class="form-control">
                                        <?php
                                        $retorno = $controller->Pesquisar("select * from rua where id_rua = '".$model->getRua()->getIdRua()."';");
                                        if(empty($retorno) == false){
                                            foreach($retorno as $ret){
                                                ?>
                                                <option value="<?php echo $ret['id_rua']; ?>"><?php echo $ret['nome_rua']; ?></option>
                                                <?php
                                            }
                                        }else{
                                            ?>
                                            <option value="0">RUA</option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="from-group">
                                    <label for="numero">Número</label>
                                    <input type="text" name="numero" id="numero" placeholder="38A" class="form-control" value="<?php echo $model->getNumero(); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="coltrol-group">
                                    <label for="facebook">Facebook</label>
                                    <input type="text" name="facebook" id="facebook" placeholder="Facebook" class="form-control" value="<?php echo $model->getFacebook(); ?>"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="coltrol-group">
                                    <label for="instagram">Instagram</label>
                                    <input type="text" name="instagram" id="instagram" placeholder="Instagram" class="form-control" value="<?php echo $model->getInstagram(); ?>"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="coltrol-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" placeholder="Email" class="form-control" value="<?php echo $model->getEmail(); ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="coltrol-group">
                                    <label for="localizacao">Localização</label>
                                    <input type="text" name="localizacao" id="localizacao" placeholder="Localizacao" class="form-control" value="<?php echo $model->getLocalizacao(); ?>"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="coltrol-group">
                                    <label for="site">Site</label>
                                    <input type="text" name="site" id="site" placeholder="Site" class="form-control" value="<?php echo $model->getSite(); ?>"/>
                                </div>
                            </div>
                        </div>
                        <br/>
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