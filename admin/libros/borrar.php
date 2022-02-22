<?php
session_start();
    
    require '../../base_datos.php';
    require "../../vendor/autoload.php";

    use eftec\bladeone\BladeOne;

    $views = '../../views';
    $cache = '../../cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

    // Obtiene codigo del libro a borrar
    $codigo = isset($_REQUEST['codigo']) ? $_REQUEST['codigo'] : null;
    // Prepara DELETE
    $miConsulta = $miPDO->prepare('DELETE FROM libros WHERE codigo = :codigo');
    // Ejecuta la sentencia SQL
    $miConsulta->execute([
    "codigo" => $codigo
    ]);
    // Redireccionamos al PHP con todos los datos
    header('Location: index.php');
?>