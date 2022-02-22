<?php
//borrar??
    session_start();
    
    require '../../base_datos.php';
    require "../../vendor/autoload.php";

    use eftec\bladeone\BladeOne;

    $views = '../../views';
    $cache = '../../cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

    // Prepara SELECT
    
    $sql = "SELECT *, 
        usuarios.nombre as usuario
        FROM sanciones s
        LEFT JOIN usuarios ON s.id_usuario = usuarios.nombre";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $usuario = isset($_REQUEST['buscar']) ? $_REQUEST['buscar'] : null;
        $miConsulta = $miPDO->prepare('SELECT * FROM sanciones WHERE id_usuario like CONCAT("%", :id_usuario, "%")');
        $miConsulta->execute(['id_usuario' => $usuario]);
    } else {
        $miConsulta = $miPDO->prepare($sql);
        $miConsulta->execute();
    }

    $sanciones = $miConsulta->fetchAll();
   
    echo $blade->run("sanciones.index", [
        "sanciones" => $sanciones
    ]);
?>

