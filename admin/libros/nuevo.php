<?php
session_start();
    
    require '../../base_datos.php';
    require "../../vendor/autoload.php";

    use eftec\bladeone\BladeOne;

    $views = '../../views';
    $cache = '../../cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

// Comprobamos si recibimos datos por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_imagen = $_FILES['imagen']["name"];
    $dir = "../../img";
    $tmp_name = $_FILES["imagen"]["tmp_name"];
    move_uploaded_file($tmp_name, "$dir/$nombre_imagen");

    $titulo = isset($_REQUEST['titulo']) ? $_REQUEST['titulo'] : null;
    $imagen = isset($_REQUEST['imagen']) ? $nombre_imagen : null;
    $autor = isset($_REQUEST['autor']) ? $_REQUEST['autor'] : null;
    $disponible = isset($_REQUEST['disponible']) ? $_REQUEST['disponible'] : null;
    $categoria = isset($_REQUEST['categoria']) ? $_REQUEST['categoria'] : null;
    $editorial = isset($_REQUEST['editorial']) ? $_REQUEST['editorial'] : null;


    // Prepara INSERT
    $miInsert = $miPDO->prepare('INSERT INTO libros (titulo, imagen, autor, editorial, categoria, disponible) VALUES (:titulo, :imagen, :autor, :editorial, :categoria, :disponible)');
    // Ejecuta INSERT con los datos
    $miInsert->execute(
        array(
            'titulo' => $titulo,
            'imagen' => $imagen,
            'autor' => $autor,
            'disponible' => $disponible,
            'categoria' => $categoria,
            'editorial' => $editorial
        )
    );

    $_SESSION["mensajes"] = "Registro añadido correctamente.";

    // Redireccionamos a Leer
    header('Location: index.php');
}
    $miConsulta = $miPDO->prepare('SELECT * from categorias;');
    $miConsulta->execute();
    $categorias = $miConsulta->fetchAll();
    $miConsulta = $miPDO->prepare('SELECT * from autores;');
    $miConsulta->execute();
    $autores = $miConsulta->fetchAll();
    $miConsulta = $miPDO->prepare('SELECT * from editorial;');
    $miConsulta->execute();
    $editoriales = $miConsulta->fetchAll();


    echo $blade->run("libros.nuevo", [
        'categorias' => $categorias,
        'autores' => $autores,
        'editoriales' => $editoriales
    ]);
?>
