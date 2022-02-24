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
    $sql = $miPDO->prepare("SELECT count(id_usuario) as numero FROM prestamos where id_usuario = {$_REQUEST['id_usuario']};");
    $sql->execute();
    $n = $sql->fetchAll();
    foreach ($n as $numero) {
        $n_usuarios = $numero['numero'];
    }

    $sql = $miPDO->prepare("SELECT activo FROM usuarios where id = {$_REQUEST['id_usuario']};");
    $sql->execute();
    $u = $sql->fetchAll();
    foreach ($u as $usu) {
        $activo = $usu['activo'];
    }

    if ($n_usuarios >= 2 || $activo == 0) {
        $_SESSION['mensaje'] = "A este usuario no se le pueden prestar más libros";
        echo $_SESSION['mensaje'];
    } else {
        $libro = isset($_REQUEST['id_libro']) ? $_REQUEST['id_libro'] : null;
        $fecha_salida = isset($_REQUEST['fecha_salida']) ? $_REQUEST['fecha_salida'] : null;
        $fecha_prevista = isset($_REQUEST['fecha_prevista']) ? $_REQUEST['fecha_prevista'] : null;
        $fecha_devolucion = null;
        $sancion = 0;

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

        $disponible = 0;
        
        $miUpdate = $miPDO->prepare('UPDATE libros SET disponible = :disponible where codigo = :id_libro');
        $miUpdate->execute(
            [
                'disponible' => $disponible,
                'id_libro' => $libro
            ]
            );
        header('Location: index.php');
        
    }
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
