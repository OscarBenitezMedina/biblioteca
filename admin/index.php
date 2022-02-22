<?php
    session_start();
    
    require '../base_datos.php';
    require "../vendor/autoload.php";

    use eftec\bladeone\BladeOne;

    $views = '../views';
    $cache = '../cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);
    if ($_SESSION['usuario'] == 'bibliotecario') {
        echo $blade->run("index_a");
    } else {
        echo ('Esta página es solo para administradores');
    }
        

?>