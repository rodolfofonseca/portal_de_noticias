<?php
if (isset($_GET['rota'])) {
    $rota = (string) $_GET['rota'];
    if ($rota == 'insert') {
        require_once 'usuario_cad.php';
    } else if ($rota == 'update') {
        require_once 'usuario_alt.php';
    }else if($rota == 'search'){
        require_once 'usuario_pesq.php';
    }
}
?>