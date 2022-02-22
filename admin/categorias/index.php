<?php
    session_start();
    
    require '../../base_datos.php';
    require "../../vendor/autoload.php";

    use eftec\bladeone\BladeOne;

    $views = '../../views';
    $cache = '../../cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

    // Prepara SELECT
    $miConsulta = $miPDO->prepare('SELECT * FROM categorias;');
    // Ejecuta consulta
    $miConsulta->execute();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $titulo = isset($_REQUEST['buscar']) ? $_REQUEST['buscar'] : null;
        $miConsulta = $miPDO->prepare('SELECT * FROM categorias WHERE nombre like CONCAT("%", :nombre, "%")');
        $miConsulta->execute(['nombre' => $titulo]);
    } else {
        $miConsulta = $miPDO->prepare('SELECT * FROM categorias;');
        $miConsulta->execute();
    }
    $categorias = $miConsulta->fetchAll();
    echo $blade->run("categorias.index", [
        "categorias" => $categorias
    ]);
?>
