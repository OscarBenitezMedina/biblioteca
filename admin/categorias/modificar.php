<?php

session_start();

require "../../base_datos.php";

require "../../vendor/autoload.php";

use eftec\bladeone\BladeOne;

$views = '../../views';
$cache = '../../cache';

$blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

$codigo_categoria = isset($_REQUEST['codigo_categoria']) ? $_REQUEST['codigo_categoria'] : null;
$nombre = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : null;



// Comprobamso si recibimos datos por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Prepara UPDATE
    $miUpdate = $miPDO->prepare('UPDATE categorias SET nombre = :nombre WHERE codigo_categoria = :codigo_categoria');
    // Ejecuta UPDATE con los datos
    $miUpdate->execute(
        [
            'codigo_categoria' => $codigo_categoria,
            'nombre' => $nombre
        ]
    );
    // Redireccionamos a Leer
    header('Location: index.php');
} else {
    // Prepara SELECT
    $miConsulta = $miPDO->prepare('SELECT * FROM categorias WHERE codigo_categoria = :codigo_categoria;');
    // Ejecuta consulta
    $miConsulta->execute(
        [
            'codigo_categoria' => $codigo_categoria
        ]
    );
}

// Obtiene un resultado
$categorias = $miConsulta->fetchAll();

echo $blade->run("categorias.modificar",
    [
        'codigo_categoria' => $codigo_categoria,
        'nombre' => $nombre,
        'categorias' => $categorias
    ]);
?>
