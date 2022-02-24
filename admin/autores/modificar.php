<?php

session_start();

require "../../base_datos.php";

require "../../vendor/autoload.php";

use eftec\bladeone\BladeOne;

$views = '../../views';
$cache = '../../cache';

$blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

$codigo_autor = isset($_REQUEST['codigo_autor']) ? $_REQUEST['codigo_autor'] : null;
$nombre = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : null;
$apellidos = isset($_REQUEST['apellidos']) ? $_REQUEST['apellidos'] : null;
$fecha_nacimiento = isset($_REQUEST['fecha_nacimiento']) ? $_REQUEST['fecha_nacimiento'] : null;
$fecha_fallecimiento = isset($_REQUEST['fecha_fallecimiento']) ? $_REQUEST['fecha_fallecimiento'] : null;
$lugar_nacimiento = isset($_REQUEST['lugar_nacimiento']) ? $_REQUEST['lugar_nacimiento'] : null;
$biografia = isset($_REQUEST['biografia']) ? $_REQUEST['biografia'] : null;
$foto = isset($_REQUEST['foto']) ? $_REQUEST['foto'] : null;



// Comprobamso si recibimos datos por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_imagen =$_FILES["foto"]["name"];
    $dir = "fotos";
    $tmp_name = $_FILES["foto"]["tmp_name"];
    move_uploaded_file($tmp_name, "$dir/$nombre_imagen");
    // Prepara UPDATE
    $miUpdate = $miPDO->prepare('UPDATE autores SET nombre = :nombre, apellidos = :apellidos, fecha_nacimiento = :fecha_nacimiento, fecha_fallecimiento = :fecha_fallecimiento, lugar_nacimiento = :lugar_nacimiento, biografia = :biografia, foto = :nombre_imagen WHERE codigo_autor = :codigo_autor');
    // Ejecuta UPDATE con los datos
    $miUpdate->execute(
        [
            'codigo_autor' => $codigo_autor,
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'fecha_nacimiento' => $fecha_nacimiento,
            'fecha_fallecimiento' => $fecha_fallecimiento,
            'lugar_nacimiento' => $lugar_nacimiento,
            'biografia' => $biografia,
            'nombre_imagen' => $nombre_imagen
        ]
    );
    // Redireccionamos a Leer
    header('Location: index.php');
} else {
    // Prepara SELECT
    $miConsulta = $miPDO->prepare('SELECT * FROM autores WHERE codigo_autor = :codigo_autor;');
    // Ejecuta consulta
    $miConsulta->execute(
        [
            'codigo_autor' => $codigo_autor,
        ]
    );
}
    
// Obtiene un resultado
$autores = $miConsulta->fetchAll();
echo $blade->run("autores.modificar",
    [
        'codigo_autor' => $codigo_autor,
        'nombre' => $nombre,
        'apellidos' => $apellidos,
        'fecha_nacimiento' => $fecha_nacimiento,
        'fecha_fallecimiento' => $fecha_fallecimiento,
        'lugar_nacimiento' => $lugar_nacimiento,
        'biografia' => $biografia,
        'autores' => $autores
    ]);
?>
