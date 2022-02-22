<?php
    session_start();
    
    require '../base_datos.php';
    require "../vendor/autoload.php";

    use eftec\bladeone\BladeOne;

    $views = '../views';
    $cache = '../cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

    $sql = "SELECT * FROM usuarios";
    $miConsulta = $miPDO->prepare($sql);
    $miConsulta->execute();
    $usuarios = $miConsulta->fetchAll();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $usuario = isset($_REQUEST['usuario']) ? $_REQUEST['usuario'] : null;
        $passwd = isset($_REQUEST['passwd']) ? $_REQUEST['passwd'] : null;

        foreach ($usuarios as $clave => $valor) {
            if ($usuario == $valor['usuario'] &&  md5($passwd) == $valor['passwd']) {
                if ($valor ['perfil'] == 'bibliotecario') {
                    $_SESSION ['usuario'] = $valor ['perfil'];
                    header('Location: ../admin');
                } else {
                    $_SESSION ['usuario'] = 'alumno';
                    echo $_SESSION ['usuario'];
                    echo ('Es un usuario perroooooo');
                    header('Location: ../admin');
                }
            }  
        }
    }

    echo $blade->run("login.login");

?>