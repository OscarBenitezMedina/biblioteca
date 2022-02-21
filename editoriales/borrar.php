<?php
    session_start();
    
    require '../base_datos.php';
    require "../vendor/autoload.php";

    use eftec\bladeone\BladeOne;

    $views = '../views';
    $cache = '../cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

    // Obtiene codigo del libro a borrar
    $codigo_editorial = isset($_REQUEST['codigo_editorial']) ? $_REQUEST['codigo_editorial'] : null;
    // Prepara DELETE
    $miConsulta = $miPDO->prepare('DELETE FROM editorial WHERE codigo_editorial = :codigo_editorial');
    // Ejecuta la sentencia SQL
    $miConsulta->execute([
    "codigo_editorial" => $codigo_editorial
    ]);
    // Redireccionamos al PHP con todos los datos
    header('Location: index.php');
?>