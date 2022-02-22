<?php
    session_start();
    
    require '../../base_datos.php';
    require "../../vendor/autoload.php";

    use eftec\bladeone\BladeOne;

    $views = '../../views';
    $cache = '../../cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

    // Prepara SELECT
    
    $sql = "SELECT l.*, 
        categorias.nombre as categoria,
        editorial.nombre as editorial,
        autores.nombre as autor
        FROM libros l
        LEFT JOIN categorias ON l.categoria = categorias.codigo_categoria
        LEFT JOIN editorial ON l.editorial = editorial.codigo_editorial
        LEFT JOIN autores ON l.autor = autores.codigo_autor";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $titulo = isset($_REQUEST['buscar']) ? $_REQUEST['buscar'] : null;
        $miConsulta = $miPDO->prepare('SELECT * FROM libros WHERE titulo like CONCAT("%", :titulo, "%")');
        $miConsulta->execute(['titulo' => $titulo]);
    } else {
        $miConsulta = $miPDO->prepare($sql);
        $miConsulta->execute();
    }

    $libros = $miConsulta->fetchAll();
   
    echo $blade->run("libros.index", [
        "libros" => $libros
    ]);
?>

