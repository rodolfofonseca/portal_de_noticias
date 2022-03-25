<?php
require_once 'includes/headerUsuario.php';
require_once 'controller/utilidades/LogDoSistema.php';
require_once 'controller/BairroCtr.php';
require_once 'controller/modelos/Bairros.php';
require_once 'controller/modelos/Cidade.php';
$controller = new BairroCtr();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST)) {
        try {
            $model = new Bairros();
            $model->setNomeBairro((strtoupper($_POST['nome_bairro'])));
            $cidade = new Cidade();
            $cidade->setIdCidade((intval($_POST['cidade'])));
            $model->setCidade($cidade);
            if ($controller->Salvar($model)) {
?><script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso',
                        Text: 'Operação realizada com sucesso!'
                    });
                </script><?php
                        } else {
                            ?><script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Atenção',
                        text: 'Erro durante a operação',
                        footer: 'Tente novamente mais tarde'
                    });
                </script><?php
                        }
                    } catch (Exception $ex) {
                        $logDoSistema = new LogDoSistema();
                        $logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
                    }
                }
            }
                            ?>
<script type="text/javascript">
    function pesquisaEstado() {
        let estado = document.querySelector('#estado_selected').innerHTML;
        let select = document.querySelector('#pais');
        let valor = select.options[select.selectedIndex].value;
        document.cookie = 'pais=' + valor;
        <?php
        $campo = (string) '';
        if (empty($_COOKIE['pais']) == false) {
            $identificador = $_COOKIE['pais'];
            $retorno = $controller->Pesquisar("select * from estado where id_pais = '" . $identificador . "';");
            foreach ($retorno as $ret) {
                $campo = $campo . "<option value='" . $ret['id_estado'] . "'>" . $ret['nome_estado'] . "</option>";
            }
        }
        ?>
        estado = "<?php echo $campo; ?>";
        document.querySelector('#estado_selected').innerHTML = estado;
    }

    function pesquisaCidade() {
        let cidade = document.querySelector('#cidade_selected').innerHTML;
        let select = document.querySelector('#estado_selected');
        let valor = select.options[select.selectedIndex].value;
        document.cookie = 'estado='+ valor;
        <?php
        $campo = (string) '';
        if(empty($_COOKIE['estado']) == false){
            $identificador = $_COOKIE['estado'];
            $retorno = $controller->Pesquisar("select * from cidade where id_estado = '".$identificador."';");
            if(empty($retorno) == false){
                foreach($retorno as $ret){
                    $campo = $campo . "<option value='" . $ret['id_cidade'] . "'>" . $ret['nome_cidade'] . "</option>";
                }
            }
        }
        ?>
        cidade = "<?php echo $campo; ?>";
        document.querySelector('#cidade_selected').innerHTML = cidade;
    }
</script>
<div class="container-fluid py-3">
    <div class="container">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Cadastro de Bairros</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="contact-form bg-light mb-3" style="padding:30px;">
                    <form method="POST" accept="cidade_cad.php">
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nome_bairro">Nome Bairro</label>
                                    <input type="text" name="nome_bairro" id="nome_bairro" placeholder="Nome do Bairro" required data-validation-required-message="Informe o nome da cidade" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="estado">Pais</label>
                                    <select name="pais" id="pais" class="form-control" onblur="pesquisaEstado();">
                                        <?php
                                        $retorno_pesquisa = $controller->Pesquisar("select * from pais order by nome_pais");
                                        if (empty($retorno_pesquisa) == false) {
                                            foreach ($retorno_pesquisa as $retorno) {
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
                                <div class="form-group">
                                    <label for="estado">Estado</label>
                                    <select name="estado" id="estado_selected" class="form-control" onblur="pesquisaCidade();">
                                        <option id="0">ESTADO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cidade">Cidade</label>
                                    <select name="cidade" id="cidade_selected" class="form-control">
                                        <option id="0">CIDADE</option>
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