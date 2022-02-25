<?php
session_start();
    
    require '../base_datos.php';
    require "../vendor/autoload.php";

    use eftec\bladeone\BladeOne;

    $views = '../views';
    $cache = '../cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

// Comprobamos si recibimos datos por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recogemos variables
    $usuario = isset($_REQUEST['usuario']) ? $_REQUEST['usuario'] : null;
    $nombre = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : null;
    $apellidos = isset($_REQUEST['apellidos']) ? $_REQUEST['apellidos'] : null;
    $passwd = isset($_REQUEST['passwd']) ? $_REQUEST['passwd'] : null;
    $passwd_e = md5($passwd);
    $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
    $perfil = "alumno";
    $activo = 1;
    // Prepara INSERT
    $miSelect =  $miPDO->prepare("SELECT usuario from usuarios where usuario = :usuario;");
    $n_registros = $miSelect-> execute(['usuario' => $usuario]);
    
    if ($n_registros) {
        $_SESSION["mensajes"] = "El usuario ya existe.";
        echo $_SESSION["mensajes"];
    } else {
        $miInsert = $miPDO->prepare('INSERT INTO usuarios ( usuario, nombre, apellidos, passwd, email, perfil, activo) VALUES (:usuario, :nombre, :apellidos, :passwd, :email, :perfil, :activo)');
    // Ejecuta INSERT con los datos
    $miInsert->execute(
        array(
            'usuario' => $usuario,
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'passwd' => $passwd_e,
            'email' => $email,
            'perfil' => $perfil,
            'activo' => $activo
        )
    );

    $_SESSION["mensajes"] = "Registro añadido correctamente.";

    // Redireccionamos a Leer
    header('Location: ../index.php');
    }
}
    
    
    echo $blade->run("login.signUp");
?>