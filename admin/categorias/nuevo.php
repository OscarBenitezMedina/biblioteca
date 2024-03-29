<?php
session_start();

require "../../base_datos.php";

require "../../vendor/autoload.php";

use eftec\bladeone\BladeOne;

$views = '../../views';
$cache = '../../cache';

$blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

// Comprobamso si recibimos datos por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recogemos variables
    $nombre = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : null;

    // Prepara INSERT
    $miInsert = $miPDO->prepare('INSERT INTO categorias (nombre) VALUES (:nombre)');
    // Ejecuta INSERT con los datos
    $miInsert->execute(
        array(
            'nombre' => $nombre,
        )
    );

    $_SESSION["mensajes"] = "Registro añadido correctamente.";

    // Redireccionamos a Leer
    header('Location: index.php');
}
echo $blade->run("categorias.nuevo");
?>

