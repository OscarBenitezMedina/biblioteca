<?php
    session_start();
    
    require '../../base_datos.php';
    require "../../vendor/autoload.php";

    use eftec\bladeone\BladeOne;

    $views = '../../views';
    $cache = '../../cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

    // Prepara SELECT
    
    $sql = "SELECT p.*, 
        usuarios.usuario as usuario,
        libros.titulo as libro
        FROM prestamos p
        LEFT JOIN usuarios ON p.id_usuario = usuarios.id
        LEFT JOIN libros ON p.id_libro = libros.codigo";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = isset($_REQUEST['buscar']) ? $_REQUEST['buscar'] : null;
        $miConsulta = $miPDO->prepare('SELECT * FROM prestamos WHERE id like CONCAT("%", :id, "%")');
        $miConsulta->execute(['id' => $id]);
    } else {
        $miConsulta = $miPDO->prepare($sql);
        $miConsulta->execute();
    }

    $prestamos = $miConsulta->fetchAll();
   
    echo $blade->run("prestamos.index", [
        "prestamos" => $prestamos
    ]);
?>

