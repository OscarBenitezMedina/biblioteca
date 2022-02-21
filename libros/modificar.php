<?php
session_start();
    
require '../base_datos.php';
require "../vendor/autoload.php";

use eftec\bladeone\BladeOne;

$views = '../views';
$cache = '../cache';

$blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

$codigo = isset($_REQUEST['codigo']) ? $_REQUEST['codigo'] : null;
$titulo = isset($_REQUEST['titulo']) ? $_REQUEST['titulo'] : null;
$autor = isset($_REQUEST['autor']) ? $_REQUEST['autor'] : null;
$disponible = isset($_REQUEST['disponible']) ? $_REQUEST['disponible'] : null;



// Comprobamso si recibimos datos por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Prepara UPDATE
    $miUpdate = $miPDO->prepare('UPDATE libros SET titulo = :titulo, autor = :autor, disponible = :disponible WHERE codigo = :codigo');
    // Ejecuta UPDATE con los datos
    $miUpdate->execute(
        [
            'codigo' => $codigo,
            'titulo' => $titulo,
            'autor' => $autor,
            'disponible' => $disponible
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
$categorias = $miPDO->prepare('SELECT * FROM categorias;');
$categorias->execute();
$autores = $miPDO->prepare('SELECT * FROM autores;');
$autores->execute();
$editoriales = $miPDO->prepare('SELECT * FROM editorial;');
$editoriales->execute();
// Obtiene un resultado
$libros = $miConsulta->fetch();
echo $blade->run("libros.modificar", [
        'libros' => $libros,
        'codigo' => $codigo,
        'titulo' => $titulo,
        'autor' => $autor,
        'disponible' => $disponible
    ]);

?>
