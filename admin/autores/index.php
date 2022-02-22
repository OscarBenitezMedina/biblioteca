<?php
    session_start();
    
    require '../../base_datos.php';
    require "../../vendor/autoload.php";

    use eftec\bladeone\BladeOne;

    $views = '../../views';
    $cache = '../../cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);


    $miConsulta = $miPDO->prepare('SELECT * FROM autores;');
    $miConsulta->execute();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $titulo = isset($_REQUEST['buscar']) ? $_REQUEST['buscar'] : null;
        $miConsulta = $miPDO->prepare('SELECT * FROM autores WHERE nombre like CONCAT("%", :nombre, "%")');
        $miConsulta->execute(['nombre' => $titulo]);
    } else {
        $miConsulta = $miPDO->prepare('SELECT * FROM autores;');
        $miConsulta->execute();
    }
    $autores = $miConsulta->fetchAll();

    echo $blade->run("autores.index", [
        "autores" => $autores
    ]);
?>

    