<?php

 session_start();
    
    require '../../base_datos.php';
    require "../../vendor/autoload.php";

    use eftec\bladeone\BladeOne;

    $views = '../../views';
    $cache = '../../cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

$codigo_editorial = isset($_REQUEST['codigo_editorial']) ? $_REQUEST['codigo_editorial'] : null;
$nombre = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : null;



// Comprobamso si recibimos datos por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Prepara UPDATE
    $miUpdate = $miPDO->prepare('UPDATE editorial SET nombre = :nombre WHERE codigo_editorial = :codigo_editorial');
    // Ejecuta UPDATE con los datos
    $miUpdate->execute(
        [
            'codigo_editorial' => $codigo_editorial,
            'nombre' => $nombre
        ]
    );
    // Redireccionamos a Leer
    header('Location: index.php');
} else {
    // Prepara SELECT
    $miConsulta = $miPDO->prepare('SELECT * FROM editorial WHERE codigo_editorial = :codigo_editorial;');
    // Ejecuta consulta
    $miConsulta->execute(
        [
            'codigo_editorial' => $codigo_editorial
        ]
    );
}

// Obtiene un resultado
$editoriales = $miConsulta->fetchAll();
echo $blade->run("editoriales.modificar",
    [
        'codigo_editorial' => $codigo_editorial,
        'nombre' => $nombre,
        'editoriales' => $editoriales
    ]);
?>
