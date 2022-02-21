<?php
    session_start();
    
    require '../base_datos.php';
    require "../vendor/autoload.php";

    use eftec\bladeone\BladeOne;

    $views = '../views';
    $cache = '../cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

    // Obtiene codigo del libro a borrar
    $codigo_autor = isset($_REQUEST['codigo_autor']) ? $_REQUEST['codigo_autor'] : null;
    // Prepara DELETE
    $miConsulta = $miPDO->prepare('DELETE FROM autores WHERE codigo_autor = :codigo_autor');
    // Ejecuta la sentencia SQL
    $miConsulta->execute([
    "codigo_autor" => $codigo_autor
    ]);
    // Redireccionamos al PHP con todos los datos
    header('Location: index.php');
?>