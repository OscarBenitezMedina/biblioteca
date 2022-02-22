<?php
session_start();
    
require '../../base_datos.php';
require "../../vendor/autoload.php";

use eftec\bladeone\BladeOne;

$views = '../../views';
$cache = '../../cache';

$blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
$usuario = isset($_REQUEST['id_usuario']) ? $_REQUEST['id_usuario'] : null;
$libro = isset($_REQUEST['id_libro']) ? $_REQUEST['id_libro'] : null;
$fecha_salida = isset($_REQUEST['fecha_salida']) ? $_REQUEST['fecha_salida'] : null;
$fecha_prevista = isset($_REQUEST['fecha_prevista']) ? $_REQUEST['fecha_prevista'] : null;
$fecha_devolucion = isset($_REQUEST['fecha_devolucion']) ? $_REQUEST['fecha_devolucion'] : null;
$sancion = isset($_REQUEST['sancion']) ? $_REQUEST['sancion'] : null;

// Comprobamso si recibimos datos por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Prepara UPDATE
    $miUpdate = $miPDO->prepare('UPDATE prestamos SET id_usuario = :id_usuario, id_libro = :id_libro, fecha_salida = :fecha_salida, fecha_prevista = :fecha_prevista, fecha_devolucion = :fecha_devolucion, sancion = :sancion WHERE id = :id');
    // Ejecuta UPDATE con los datos
    $miUpdate->execute(
        [
            'id' => $id,
            'id_usuario' => $usuario,
            'id_libro' => $libro,
            'fecha_salida' => $fecha_salida,
            'fecha_prevista' => $fecha_prevista,
            'fecha_devolucion' => $fecha_devolucion,
            'sancion' => $sancion
        ]
    );
    // Redireccionamos a Leer
    header('Location: index.php');
} else {
    // Prepara SELECT
    $miConsulta = $miPDO->prepare('SELECT * FROM prestamos WHERE id = :id;');
    // Ejecuta consulta
    $miConsulta->execute(
        [
            "id" => $id
        ]
    );
}
$miConsulta = $miPDO->prepare('SELECT * from libros;');
$miConsulta->execute();
$libros = $miConsulta->fetchAll();
$miConsulta = $miPDO->prepare('SELECT * from usuarios;');
$miConsulta->execute();
$usuarios = $miConsulta->fetchAll();
// Obtiene un resultado
$libros = $miConsulta->fetch();
echo $blade->run("prestamos.modificar", [
        'id' => $id,
        'id_usuario' => $usuario,
        'id_libro' => $libro,
        'fecha_salida' => $fecha_salida,
        'fecha_prevista' => $fecha_prevista,
        'fecha_devolucion' => $fecha_devolucion,
        'sancion' => $sancion,
        'libros' => $libros,
        'usuarios' => $usuarios
    ]);

?>
