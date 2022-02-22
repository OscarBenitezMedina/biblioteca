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
    // Recogemos variables
    $usuario = isset($_REQUEST['id_usuario']) ? $_REQUEST['id_usuario'] : null;
    $libro = isset($_REQUEST['id_libro']) ? $_REQUEST['id_libro'] : null;
    $fecha_salida = isset($_REQUEST['fecha_salida']) ? $_REQUEST['fecha_salida'] : null;
    $fecha_prevista = isset($_REQUEST['fecha_prevista']) ? $_REQUEST['fecha_prevista'] : null;
    $fecha_devolucion = isset($_REQUEST['fecha_devolucion']) ? $_REQUEST['fecha_devolucion'] : null;
    $sancion = isset($_REQUEST['sancion']) ? $_REQUEST['sancion'] : null;

    $miInsert = $miPDO->prepare('INSERT INTO prestamos (id_usuario, id_libro, fecha_salida, fecha_prevista, fecha_devolucion, sancion) VALUES (:id_usuario, :id_libro, :fecha_salida, :fecha_prevista, :fecha_devolucion, :sancion)');

    $miInsert->execute(
        array(
            'id_usuario' => $usuario,
            'id_libro' => $libro,
            'fecha_salida' => $fecha_salida,
            'fecha_prevista' => $fecha_prevista,
            'fecha_devolucion' => $fecha_devolucion,
            'sancion' => $sancion
        )
    );

    $_SESSION["mensajes"] = "Registro añadido correctamente.";

    // Redireccionamos a Leer
    header('Location: index.php');
}
    $miConsulta = $miPDO->prepare('SELECT * from libros;');
    $miConsulta->execute();
    $libros = $miConsulta->fetchAll();
    $miConsulta = $miPDO->prepare('SELECT * from usuarios;');
    $miConsulta->execute();
    $usuarios = $miConsulta->fetchAll();

    echo $blade->run("prestamos.nuevo", [
        'libros' => $libros,
        'usuarios' => $usuarios
    ]);
?>
