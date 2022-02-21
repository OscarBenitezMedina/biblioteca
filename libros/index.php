<?php
    session_start();
    
    require '../base_datos.php';
    require "../vendor/autoload.php";

    use eftec\bladeone\BladeOne;

    $views = '../views';
    $cache = '../cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

    // Prepara SELECT
    $miConsulta = $miPDO->prepare('SELECT * FROM libros;');
    // Ejecuta consulta
    $miConsulta->execute();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $titulo = isset($_REQUEST['buscar']) ? $_REQUEST['buscar'] : null;
        $miConsulta = $miPDO->prepare('SELECT * FROM libros WHERE titulo like CONCAT("%", :titulo, "%")');
        $miConsulta->execute(['titulo' => $titulo]);
    } else {
        $miConsulta = $miPDO->prepare('SELECT * FROM libros;');
        $miConsulta->execute();
    }
    $libros = $miConsulta->fetchAll();
    echo $blade->run("libros.index", [
        "libros" => $libros
    ]);
?>

