<?php
require_once 'includes/headerUsuario.php';
require_once 'controller/modelos/Empresa.php';
require_once 'controller/EmpresaCtr.php';
require_once 'controller/utilidades/LogDoSistema.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST)) {
        $logDoSistema = new LogDoSistema();
        try {
            $model = new Empresa();
            $controller = new EmpresaCtr();
            $model->setNomeEmpresa((string) strtoupper($_POST['nome_empresa']));
            $model->setObservacao((string) $_POST['observacao']);
            $model->setTelefoneContato((string) $_POST['telefone']);
            $model->setWhatsapp((string) $_POST['whatsapp']);
            $model->setStatus((string) $_POST['status']);
            if ($controller->Salvar($model)) {
?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso',
                        text: 'Empresa cadastrada com sucesso!'
                    });
                </script>
            <?php
            } else {
            ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Atenção',
                        text: 'Erro ao cadastrar o empresa!',
                        footer: 'Tente novamente mais tarde'
                    });
                </script>
<?php
            }
        } catch (Exception $ex) {
            $logDoSistema->EscreverArquivo('LogDoSistema.txt', $ex->getMessage());
        }
    }
}
?>
<script type="text/javascript">
    function validarWhatsapp() {
        let numero = document.getElementById('whatsapp').value;
        let retorno = validarTelefone(numero);
        if (retorno == false) {
            Swal.fire({
                icon: 'error',
                title: 'Atenção',
                text: 'Número do whatsapp inválido!',
                footer: 'Arrume por favor!'
            });
        }

        function validarTelefoneFixo() {
            let numero = document.getElementById('telefone').value;
            let retorno = validarTelefone(numero);
            if (retorno == false) {
                Swal.fire({
                    icon: 'error',
                    title: 'Atenção',
                    text: 'Número do telefone inválido!',
                    footer: 'Arrume por favor!'
                });
            }
        }
    }
</script>
<div class="container-fluid py-3">
    <div class="container">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Cadastro de Empresas</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="contact-form bg-light mb-3" style="padding: 30px;">
                    <form method="POST" accept="empresa_cad.php">
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nome_empresa">Nome Empresa</label>
                                    <input type="text" name="nome_empresa" id="nome_empresa" class="form-control" required data-validation-required-message="Informe a descrição dos locais" placeholder="NOME DA EMPRESA" />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="observacao">Descrição</label>
                                    <textarea name="observacao" id="observacao" class="form-control" placeholder="OBSERVAÇÕES"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="telefone">Telefone</label>
                                    <input type="tel" name="telefone" id="telefone" class="form-control" placeholder="(##)####-####" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="whatsapp">Whatsapp</label>
                                    <input type="tel" name="whatsapp" id="whatsapp" class="form-control" required data-validation-required-message="Inform o whatsapp" placeholder="(##)#####-####" onblur="validarWhatsapp();" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="A" selected>ATIVO</option>
                                        <option value="I">INATIVO</option>
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