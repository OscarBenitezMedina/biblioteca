<?php
    session_start();
    
    require 'base_datos.php';
    require "vendor/autoload.php";

    use eftec\bladeone\BladeOne;

    $views = 'views';
    $cache = 'cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

    $sql = $miPDO->prepare('SELECT * FROM libros where disponible = 1;');
    $sql->execute();
    $libros = $sql->fetchAll();

    echo $blade->run("index", [
        "libros" => $libros
    ]);
?>