<?php
    session_start();
    
    require '../../base_datos.php';
    require "../../vendor/autoload.php";

    use eftec\bladeone\BladeOne;

    $views = '../../views';
    $cache = '../../cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

    // Prepara SELECT
    
    $sql = "SELECT * FROM usuarios";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = isset($_REQUEST['buscar']) ? $_REQUEST['buscar'] : null;
        $miConsulta = $miPDO->prepare('SELECT * FROM usuarios WHERE titulo like CONCAT("%", :nombre, "%")');
        $miConsulta->execute(['nombre' => $nombre]);
    } else {
        $miConsulta = $miPDO->prepare($sql);
        $miConsulta->execute();
    }

    $usuarios = $miConsulta->fetchAll();
   
    echo $blade->run("usuarios.index", [
        "usuarios" => $usuarios
    ]);
?>

