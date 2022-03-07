<?php
require_once 'includes/headerUsuario.php';
require_once 'controller/EmpresaCtr.php';
require_once 'controller/UsuarioCtr.php';
require_once 'controller/LocaisCtr.php';
require_once 'controller/ParcelasCtr.php';
require_once 'controller/ContratoPublicidadeCtr.php';
require_once 'controller/AnunciosCtr.php';
require_once 'controller/modelos/Empresa.php';
require_once 'controller/modelos/Usuario.php';
require_once 'controller/modelos/ContratoPublicidade.php';
require_once 'controller/modelos/Parcelas.php';
require_once 'controller/modelos/Locais.php';
require_once 'controller/modelos/Anuncios.php';
require_once 'controller/utilidades/LogDoSistema.php';
require_once 'controller/utilidades/Data.php';
$empresaCtr = new EmpresaCtr();
$usuarioCtr = new UsuarioCtr();
$locaisCtr = new LocaisCtr();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST)) {
        try {
            $contratoDePublicidade = new ContratoPublicidade();
            $usuario_cadastro = new Usuario();
            $usuario_assinatura = new Usuario();
            $empresa_contrato = new Empresa();
            $locais = new Locais();
            $parcelas = new Parcelas();
            $anuncios = new Anuncios();
            $contratoDePublicidadeCtr = new ContratoPublicidadeCtr();
            $parcelasCtr = new ParcelasCtr();
            $anunciosCtr = new AnunciosCtr();
            $data = new Data();
            $empresa_contrato->setIdEmpresa((int) $_POST['empresa']);
            $usuario_cadastro->setIdUsuario((int) $_POST['usuario_cadastro']);
            $usuario_assinatura->setIdUsuario((int) $_POST['usuario_assinatura']);
            $contratoDePublicidade->setDataAssinatura((string)$data->ano(true) . '-' . $data->mes(true) . '-' . $data->dia(true));
            $contratoDePublicidade->setUsuarioCadastro($usuario_cadastro);
            $contratoDePublicidade->setUsuarioAssinaturaContrato($usuario_assinatura);
            $contratoDePublicidade->setEmpresa($empresa_contrato);
            $contratoDePublicidade->setValorContrato((float)$_POST['valor_contrato']);
            $contratoDePublicidade->setTipoPagamento((string) $_POST['tipo_pagamento']);
            $contratoDePublicidade->setDataInicio((string) $_POST['data_inicio']);
            $contratoDePublicidade->setDataFim((string)$_POST['data_fim']);
            $contratoDePublicidade->setObservacoes((string) $_POST['observacoes']);
            $quantidade_parcelas = (int) $_POST['parcela'];
            $retorno_parcelas = false;
            $retorno_anuncios = false;
            if ($contratoDePublicidadeCtr->Salvar($contratoDePublicidade)) {
                $retorno = $contratoDePublicidadeCtr->Pesquisar('select max(id_contrato) as id_contrato from contrato_publicidade;');
                foreach ($retorno as $ret) {
                    $contratoDePublicidade->setIdContrato((int) $ret['id_contrato']);
                }
                if ($quantidade_parcelas <= 1) {
                    $parcelas->setContrato($contratoDePublicidade);
                    $parcelas->setValor($contratoDePublicidade->getValorContrato());
                    $parcelas->setDataVencimento($contratoDePublicidade->getDataAssinatura());
                    $parcelas->setStatus((string) 'P');
                    $retorno_parcelas = $parcelasCtr->Salvar($parcelas);
                } else {
                    $parcelas->setContrato($contratoDePublicidade);
                    $valor_parcelas = $contratoDePublicidade->getValorContrato() / $quantidade_parcelas;
                    $parcelas->setValor($valor_parcelas);
                    for ($contador = 0; $contador < $quantidade_parcelas; $contador++) {
                        $mes_atual = (int) $data->mes(true);
                        $ano_atual = (int) $data->ano(true);
                        if ($mes_atual == 12) {
                            $mes_atual = 1;
                            $ano_atual = $ano_atual + 1;
                        } else {
                            $mes_atual = $mes_atual + 1;
                        }
                        $parcelas->setDataVencimento((string)$ano_atual . '-' . $mes_atual . '-10');
                        $parcelas->setStatus('A');
                        $retorno_parcelas = $parcelasCtr->Salvar($parcelas);
                    }
                }
                if ($retorno_parcelas == true) {
                    $retorno = $locaisCtr->Pesquisar('select * from locais order by descricao;');
                    $imagem_contador = 1;
                    foreach ($retorno as $loca) {
                        if (isset($_FILES["imagem_$imagem_contador"]['name']) && $_FILES["imagem_$imagem_contador"]['error'] == 0) {
                            $nome_imagem = 'img/publicidade/' . $loca['id_local'] . '_' . $contratoDePublicidade->getIdContrato() . '_' . $empresa_contrato->getIdEmpresa();
                            $arquivo_tmp = $_FILES["imagem_$imagem_contador"]['tmp_name'];
                            $nome_atual = $_FILES["imagem_$imagem_contador"]['name'];
                            $extensao = strchr($nome_atual, '.');
                            $extensao = strtolower($extensao);
                            if (strstr('.jpg;.jpeg;.gif;.png', $extensao)) {
                                $nome_imagem = $nome_imagem . $extensao;
                                if (@move_uploaded_file($arquivo_tmp, $nome_imagem)) {
                                    $anuncios->setEmpresa($empresa_contrato);
                                    $locais->setIdLcais((int) $loca['id_local']);
                                    $anuncios->setLocais($locais);
                                    $anuncios->setContrato($contratoDePublicidade);
                                    $anuncios->setDataInicio((string) $contratoDePublicidade->getDataInicio());
                                    $anuncios->setDataFim((string) $contratoDePublicidade->getDataFim());
                                    $anuncios->setHoraInicio((int) 0);
                                    $anuncios->setHoraFim((int) 0);
                                    $anuncios->setStatus((string) 'A');
                                    $anuncios->setLocalImagem((string) $nome_imagem);
                                    $retorno_anuncios = $anunciosCtr->Salvar($anuncios);
                                }
                            }
                            $imagem_contador = $imagem_contador + 1;
                        }
                    }
                    if ($retorno_anuncios == true) {
?>
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Sucesso',
                                text: 'Contrato cadastrado com sucesso!'
                            });
                        </script>
                    <?php
                    } else {
                    ?>
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Atenção',
                                text: 'Erro ao cadastrar contrato.',
                                footer: 'Tente novamente mais tarde!'
                            });
                        </script>
                    <?php
                    }
                } else {
                    ?>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Atenção',
                            text: 'Erro ao cadastrar contrato.',
                            footer: 'Tente novamente mais tarde!'
                        });
                    </script>
                <?php
                }
            } else {
                ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Atenção',
                        text: 'Erro ao cadastrar contrato.',
                        footer: 'Tente novamente mais tarde!'
                    });
                </script>
<?php
            }
        } catch (Exception $ex) {
            $logDoSistema = new LogDoSistema();
            $logDoSistema->EscreverArquivo('logDoSistema.txt', $ex->getMessage());
        }
    }
}
?>
<div class="container-fluid py-3">
    <div class="container">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Cadastro de contratos</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="contact-form bg-light mb-3" style="padding: 30px;">
                    <form method="POST" accept="contrato_cad.php" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="empresa">Empresa</label>
                                    <select name="empresa" id="empresa" class="form-control" required>
                                        <?php
                                        $retorno = $empresaCtr->Pesquisar("select * from empresa where status = 'A'order by nome_empresa;");
                                        foreach ($retorno as $empresa) {
                                        ?>
                                            <option value="<?php echo $empresa['id_empresa']; ?>"><?php echo $empresa['nome_empresa']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="usuario_cadastro">Usuário de cadastro</label>
                                    <select name="usuario_cadastro" id="usuario_cadastro" class="form-control">
                                        <?php
                                        $retorno = $usuarioCtr->Pesquisar("select * from usuario where status = 'ATIVO' order by nome_usuario;");
                                        foreach ($retorno as $usuario) {
                                        ?>
                                            <option value="<?php echo $usuario['id_usuario']; ?>"><?php echo $usuario['nome_usuario']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="usuario_assinatura">Usuário de assinatura</label>
                                    <select name="usuario_assinatura" id="usuario_assinatura" class="form-control">
                                        <?php
                                        $retorno = $usuarioCtr->Pesquisar("select * from usuario where status = 'ATIVO' order by nome_usuario;");
                                        foreach ($retorno as $usuario) {
                                        ?>
                                            <option value="<?php echo $usuario['id_usuario']; ?>"><?php echo $usuario['nome_usuario']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-1">
                                <div class="control-group">
                                    <label for="valor_contrato">Valor</label>
                                    <input type="number" name="valor_contrato" id="valor_contrato" class="form-control" value="1">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="control-group">
                                    <label for="parcela">Parcelas</label>
                                    <input type="number" name="parcela" id="parcela" value="1" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="control-group">
                                    <label for="tipo_pagamento">Forma Pagamento</label>
                                    <select name="tipo_pagamento" id="tipo_pagamento" class="form-control">
                                        <option value="D" selected>DINHEIRO</option>
                                        <option value="C">CARTÃO</option>
                                        <option value="P">PIX</option>
                                        <option value="N">NOTA PROMISSÓRIA</option>
                                        <option value="X">CHEQUE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="control-group">
                                    <label for="data_inicio">Data Início</label>
                                    <input type="date" name="data_inicio" id="data_inicio" required class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="control-group">
                                    <label for="data_fim">Data Fim</label>
                                    <input type="date" name="data_fim" id="data_fim" required class="form-control" />
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="control-group">
                                    <label for="observacoes">Observações</label>
                                    <textarea name="observacoes" id="observacoes" class="form-control" placeholder="Observações"></textarea>
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="form-row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">LOCAL</th>
                                            <th class="text-center">IMAGEM</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $retorno = $locaisCtr->Pesquisar('select * from locais order by descricao;');
                                        foreach ($retorno as $locais) {
                                        ?>
                                            <tr>
                                                <td><?php echo $locais['descricao']; ?></td>
                                                <td><input type="file" name="imagem_<?php echo $locais['id_local']; ?>" placeholder="imagem" class="form-control"></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br />
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