<?php
require_once 'controller/utilidades/LogDoSistema.php';
require_once 'controller/UsuarioCtr.php';
require_once 'controller/modelos/Usuario.php';
$email = (string) '';
$retorno = (bool) false;
if (isset($_GET['email']) == true) {
    $email = $_GET['email'];
    $logDoSistema = new LogDoSistema();
    $usuario = new UsuarioCtr();
    $model = new Usuario();
    $model->setEmailUsuario($email);
    $model->setStatusUsuario('A');
    $retorno = $usuario->SalvarContato($model);
} else {
    $retorno = false;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>ASSPOL - Associação Polícial</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Asspol associação polícial" name="keywords">
    <meta content="Asspol associação polícial" name="description">
    <link rel="shortcut icon" href="img/icone/favicon.ico" type="image/x-icon">
    <link href="css/alerta_css.css" rel="stylesheet">
    <script src="js/alerta.js"></script>
</head>

<body>
    <?php
    if ($retorno == true) {
    ?>
        <script>
            let timerInterval
            Swal.fire({
                title: 'Auto close alert!',
                html: 'I will close in <b></b> milliseconds.',
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    window.open('index.php');
                }
            })
        </script>
    <?php
    } else {
    ?>
        <script>
            let timerInterval
            Swal.fire({
                title: 'erro!',
                html: 'I will close in <b></b> milliseconds.',
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    window.open('index.php');
                }
            })
        </script>
    <?php
    }
    ?>
</body>

</html>