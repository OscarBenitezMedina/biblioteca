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

// Comprobamso si recibimos datos por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Prepara UPDATE
    $miUpdate = $miPDO->prepare('UPDATE libros SET titulo = :titulo, autor = :autor, disponible = :disponible, editorial = :editorial, categoria = :categoria WHERE codigo = :codigo');
    // Ejecuta UPDATE con los datos
    $miUpdate->execute(
        [
            'codigo' => $codigo,
            'titulo' => $titulo,
            'autor' => $autor,
            'disponible' => $disponible,
            'editorial' => $editorial,
            'categoria' => $categoria
        ]
    );
    // Redireccionamos a Leer
    header('Location: index.php');
} else {
    // Prepara SELECT
    $miConsulta = $miPDO->prepare('SELECT * FROM libros WHERE codigo = :codigo;');
    // Ejecuta consulta
    $miConsulta->execute(
        [
            "codigo" => $codigo
        ]
    );
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
$libros = $miConsulta->fetch();
echo $blade->run("libros.modificar", [
        'codigo' => $codigo,
        'titulo' => $titulo,
        'autores' => $autores,
        'categorias' => $categorias,
        'editoriales' => $editoriales,
        'disponible' => $disponible
    ]);

?>
