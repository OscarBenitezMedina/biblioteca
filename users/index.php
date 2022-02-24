<?php
    session_start();
    
    require '../base_datos.php';
    require "../vendor/autoload.php";

    use eftec\bladeone\BladeOne;

    $views = '../views';
    $cache = '../cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);
    if (isset($_SESSION['usuario'])) {
        $sql = $miPDO->prepare("SELECT libros.titulo as libro, libros.imagen as imagen, p.sancion as sancion
                            FROM prestamos p
                            LEFT JOIN libros ON p.id_libro = libros.codigo 
                            LEFT JOIN usuarios ON p.id_usuario = usuarios.id 
                            where usuarios.id  = (select id from usuarios where usuario = '{$_SESSION['usuario']}')");
        $sql->execute();
        $libros = $sql->fetchAll();

        $sql = $miPDO->prepare("SELECT * from usuarios where usuario = '{$_SESSION['usuario']}'");
        $sql->execute();
        $datos = $sql->fetchAll();

        echo $blade->run("index_u", [
            'libros' => $libros,
            'datos' => $datos
        ]);
    } else { echo 'Debe iniciar sesión para ver su perfil';}
    
?>