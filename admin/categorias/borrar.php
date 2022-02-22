<?php
    session_start();
    
    require '../../base_datos.php';
    require "../../vendor/autoload.php";

    use eftec\bladeone\BladeOne;

    $views = '../../views';
    $cache = '../../cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

    // Obtiene codigo del libro a borrar
    $codigo_categoria = isset($_REQUEST['codigo_categoria']) ? $_REQUEST['codigo_categoria'] : null;
    // Prepara DELETE
    $miConsulta = $miPDO->prepare('DELETE FROM categorias WHERE codigo_categoria = :codigo_categoria');
    // Ejecuta la sentencia SQL
    $miConsulta->execute([
    "codigo_categoria" => $codigo_categoria
    ]);
    // Redireccionamos al PHP con todos los datos
    header('Location: index.php');
?>