<?php
require_once 'includes/headerUsuario.php';
require_once 'controller/CategoriaCtr.php';
require_once 'controller/UsuarioCtr.php';
require_once 'controller/NoticiasCtr.php';
require_once 'controller/TituloDestaqueCtr.php';
require_once 'controller/modelos/Noticias.php';
require_once 'controller/modelos/TituloDestaque.php';
require_once 'controller/modelos/Usuario.php';
require_once 'controller/modelos/Categoria.php';
require_once 'controller/utilidades/Data.php';
require_once 'controller/utilidades/LogDoSistema.php';
$link_materia = (string) '';
$usuarioCtr = new UsuarioCtr();
$categoriaCtr = new CategoriaCtr();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST)) {
        $noticiasModel = new Noticias();
        $noticiasModel->setNomeNoticia((string) strtoupper($_POST['titulo']));
        $usuarioModel = new Usuario();
        $usuarioModel->setIdUsuario((int) $_POST['usuario']);
        $noticiasModel->setUsuario($usuarioModel);
        $categoriaModel = new Categoria();
        $categoriaModel->setIdCategoria((int) $_POST['categoria']);
        $noticiasModel->setCategoria($categoriaModel);
        $tituloDestaqueModel = new TituloDestaque();
        $tituloDestaqueModel->setDataInicio((string) $_POST['data_inicio']);
        $tituloDestaqueModel->setDataFim((string) $_POST['data_fim']);
        $tituloDestaqueModel->setHoraFim((int) $_POST['hora_fim']);
        $tituloDestaqueModel->setHoraInicio((int) $_POST['hora_inicio']);
        $noticiasModel->setLinkMateria((string) strtolower($_POST['link_materia']));
        $noticiasModel->setStatus($_POST['status']);
        $quantidadeParagrafo = $_POST['quantidade_paragrafo'];
        $noticiasModel->setDataPostagem($dataSistema->dia(true).'/'.$dataSistema->mes(true).'/'.$dataSistema->ano(true));
        $noticiasCtr = new NoticiasCtr();
        if(isset($_FILES["imagem"]['name']) && $_FILES["imagem"]['error'] == 0){
            $nomeImagem = 'img/materias/'.$noticiasModel->getLinkMateria();
            $nomeImagem = $nomeImagem;
            $arquivo_tmp = $_FILES["imagem"]['tmp_name'];
            $nomeAtual = $_FILES["imagem"]['name'];
            $extensao = strrchr($nomeAtual, '.');
            $extensao = strtolower($extensao);
            if(strstr('.jpg;.jpeg;.gif;.png', $extensao)){
                $nomeImagem = $nomeImagem.$extensao;
                if(@move_uploaded_file($arquivo_tmp, $nomeImagem)){
                    $noticiasModel->setImagem((string) $nomeImagem);
                }
            }
        }
        if($noticiasCtr->Salvar($noticiasModel) == true){
            $retorno = $noticiasCtr->Pesquisar("select * from noticias where link_materia = '".$noticiasModel->getLinkMateria()."';");
            foreach($retorno as $retornos){
                $noticiasModel->setIdNoticia((int) $retornos['id_noticias']);
            }
            $tituloDestaqueCtr = new tituloDestaqueCtr();
            $tituloDestaqueModel->setMateria($noticiasModel);
            if($tituloDestaqueCtr->Salvar($tituloDestaqueModel) == true){
                $_SESSION['noticia'] = $noticiasModel->getIdNoticia();
                $_SESSION['quantidade_paragafos'] = $quantidadeParagrafo;
                ?>
                <script>
                    window.location.href = "paragrafos_cad.php";
                </script>
                <?php
            }else{
                ?>
                <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Atenção',
                    text: 'Erro durante a operação',
                    footer: 'Tente novamente mais tarde'
                });
            </script>
                <?php
            }
        }else{
            ?>
                <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Atenção',
                    text: 'Erro durante a operação',
                    footer: 'Tente novamente mais tarde'
                });
            </script>
                <?php
        }
    }
}
?>
<script type="text/javascript">
function ajuda(){
    Swal.fire(
    'O que são esses campos?',
    'Os campos DATA INÍCIO, DATA FIM, HORA INÍCIO, HORA FIM serve para informar o sistema até quando a matéria deve ter o seu título destacado!',
    'question'
);
}
function linkMateria(){
    let link = document.getElementById('titulo').value;
    link = link.replaceAll(' ', '_');
    document.getElementById('link_materia').value = link;
} 
</script>
<div class="container-fluid py-3">
    <div class="container">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Cadastro de notícias</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="contact-form bg-light mb-3" style="padding: 30px;">
                <form method="POST" accept="noticias_cad.php" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="col-md-12">
                            <label for="titulo">Título</label>
                            <input type="text" name="titulo" id="titulo" placeholder="TÍTULO DA MATERIA" required data-validation-required-message="Informe o título da matéria" class="form-control"onblur="linkMateria();"/>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="usuario">Escrita por</label>
                            <select name="usuario" id="usuario" class="form-control">
                                <?php
                                $retorno = $usuarioCtr->Pesquisar("select * from usuario where status = 'ATIVO'order by nome_usuario;");
                                foreach($retorno as $usuario_retorno){
                                    ?>
                                    <option value="<?php echo $usuario_retorno['id_usuario']; ?>"><?php echo $usuario_retorno['nome_usuario']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="categoria">Categoria</label>
                            <select name="categoria" id="categoria" class="form-control">
                                <?php
                                $retorno_categoria = $categoriaCtr->Pesquisar("select * from categoria where aparece_menu = 'S' order by descricao_categoria;");
                                foreach($retorno_categoria as $categoria_retorno){
                                    ?>
                                    <option value="<?php echo $categoria_retorno['id_categoria']; ?>"><?php echo $categoria_retorno['descricao_categoria']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <br/>
                    <div class="form-row">
                        <div class="col-md-3">
                            <label for="data_inicio">Data início</label>
                            <input type="date" name="data_inicio" id="data_inicio" class="form-control" required/>
                        </div>
                        <div class="col-md-2">
                            <label for="hora_inicio">Hora de início</label>
                            <input type="number" name="hora_inicio" id="hora_inicio" class="form-control"  placeholder="00" required/>
                        </div>
                        <div class="col-md-3">
                            <label for="data_fim">Data Fim</label>
                            <input type="date" name="data_fim" id="data_fim" class="form-control" required/>
                        </div>
                        <div class="col-md-2">
                            <label for="hora_fim">Hora fim</label>
                            <input type="number" name="hora_fim" id="hora_fim" class="form-control" required placeholder="00"/>
                        </div>
                        <div class="col-md-2">
                            <label>Precisa de ajuda?</label>
                            <a href="#" class="btn btn-secondary font-weight-semi-bold px-4 expanded" onclick="ajuda();">Ajuda</a>
                        </div>
                    </div>
                    <br/>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="control-group">
                                <label for="imagem">Imagem</label>
                                <input type="file" name="imagem" id="imagem" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="control-group">
                                <label for="quantidade_paragrafo">Qtd. Parágrafos</label>
                                <input type="number" name="quantidade_paragrafo" id="quantidade_paragrafo" value="1" placeholder="QUANTIDADE PARÁGRAFO" required class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="control-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="A" selected>ATIVO</option>
                                    <option value="I">INATIVO</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="control-group">
                                <label for="link_materia">Link da matéria</label>
                                <input type="text" name="link_materia" id="link_materia" value="" class="form-control" placeholder="LINK DA MATÉRIA" readonly/>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div class="form-row">
                            <div class="col-md-6">
                                <div class="control-group">
                                    <input type="submit" class="btn btn-primary font-weight-semi-bold px-4"  value="Cadastrar" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="reset" class="btn btn-danger forn-weight-semi-bold px4 expanded" value="Cancelar"/>
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