<?php
session_start();
    
require '../../base_datos.php';
require "../../vendor/autoload.php";

use eftec\bladeone\BladeOne;

$views = '../../views';
$cache = '../../cache';

$blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

$codigo = isset($_REQUEST['codigo']) ? $_REQUEST['codigo'] : null;
$titulo = isset($_REQUEST['titulo']) ? $_REQUEST['titulo'] : null;
$autor = isset($_REQUEST['autor']) ? $_REQUEST['autor'] : null;
$categoria = isset($_REQUEST['categoria']) ? $_REQUEST['categoria'] : null;
$editorial = isset($_REQUEST['editorial']) ? $_REQUEST['editorial'] : null;
$disponible = isset($_REQUEST['disponible']) ? $_REQUEST['disponible'] : null;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_imagen =$_FILES["imagen"]["name"];
    $dir = "../../img";
    $tmp_name = $_FILES["imagen"]["tmp_name"];
    move_uploaded_file($tmp_name, "$dir/$nombre_imagen");
    // Prepara UPDATE
    $miUpdate = $miPDO->prepare('UPDATE libros SET titulo = :titulo, imagen = :nombre_imagen, autor = :autor, disponible = :disponible, editorial = :editorial, categoria = :categoria WHERE codigo = :codigo');
    // Ejecuta UPDATE con los datos
    $miUpdate->execute(
        [
            'codigo' => $codigo,
            'titulo' => $titulo,
            'nombre_imagen' => $nombre_imagen,
            'autor' => $autor,
            'disponible' => $disponible,
            'editorial' => $editorial,
            'categoria' => $categoria
        ]
    );
    // Redireccionamos a Leer
    header('Location: index.php');
}

$miConsulta = $miPDO->prepare('SELECT * FROM categorias;');
$miConsulta->execute();
$categorias = $miConsulta->fetchAll();
$miConsulta = $miPDO->prepare('SELECT * FROM autores;');
$miConsulta->execute();
$autores = $miConsulta->fetchAll();
$miConsulta = $miPDO->prepare('SELECT * FROM editorial;');
$miConsulta->execute();
$editoriales = $miConsulta->fetchAll();
// Obtiene un resultado
$libros = $miConsulta->fetchAll();
echo $blade->run("libros.modificar", [
        'codigo' => $codigo,
        'titulo' => $titulo,
        'autores' => $autores,
        'categorias' => $categorias,
        'editoriales' => $editoriales,
        'disponible' => $disponible
    ]);

?>
