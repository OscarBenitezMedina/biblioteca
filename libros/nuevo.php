<?php
session_start();
    
    require '../base_datos.php';
    require "../vendor/autoload.php";

    use eftec\bladeone\BladeOne;

    $views = '../views';
    $cache = '../cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

// Comprobamos si recibimos datos por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recogemos variables
    $titulo = isset($_REQUEST['titulo']) ? $_REQUEST['titulo'] : null;
    $autor = isset($_REQUEST['autor']) ? $_REQUEST['autor'] : null;
    $disponible = isset($_REQUEST['disponible']) ? $_REQUEST['disponible'] : null;
    $categoria = isset($_REQUEST['categoria']) ? $_REQUEST['categoria'] : null;
    $editorial = isset($_REQUEST['editorial']) ? $_REQUEST['editorial'] : null;
    // Prepara INSERT
    $miInsert = $miPDO->prepare('INSERT INTO libros (titulo, autor, disponible, categoria, editorial) VALUES (:titulo, :autor, :disponible, :categoria, :editorial)');
    // Ejecuta INSERT con los datos
    $miInsert->execute(
        array(
            'titulo' => $titulo,
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
    $miConsulta = $miPDO->prepare('SELECT * FROM libros L LEFT JOIN categorias C on L.categoria = C.codigo_categoria;');
    $miConsulta->execute();
    $categorias = $miConsulta->fetchAll();
    $miConsulta = $miPDO->prepare('SELECT * FROM autores;');
    $miConsulta->execute();
    $autores = $miConsulta->fetchAll();
    $miConsulta = $miPDO->prepare('SELECT * FROM editorial;');
    $miConsulta->execute();
    $editoriales = $miConsulta->fetchAll();


    echo $blade->run("libros.nuevo", [
        'categorias' => $categorias
    ]);
?>
