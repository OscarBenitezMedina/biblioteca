<?php
session_start();
    
require '../base_datos.php';
require "../vendor/autoload.php";

use eftec\bladeone\BladeOne;

$views = '../views';
$cache = '../cache';

$blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
$usuario = isset($_REQUEST['usuario']) ? $_REQUEST['usuario'] : null;
$nombre = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : null;
$apellidos = isset($_REQUEST['apellidos']) ? $_REQUEST['apellidos'] : null;
$passwd = isset($_REQUEST['passwd']) ? $_REQUEST['passwd'] : null;
$passwd_e = md5($passwd);
$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
$perfil = "alumno";
$activo = isset($_REQUEST['activo']) ? $_REQUEST['activo'] : null;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $miUpdate = $miPDO->prepare('UPDATE usuarios SET usuario = :usuario, nombre = :nombre, apellidos = :apellidos, passwd = :passwd, email = :email, perfil = :perfil, activo = :activo WHERE id = :id');

    $miUpdate->execute(
        [
            'id' => $id,
            'usuario' => $usuario,
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'passwd' => $passwd_e,
            'email' => $email,
            'perfil' => $perfil,
            'activo' => $activo
        ]
    );

    header('Location: index.php');
} else {

    $miConsulta = $miPDO->prepare('SELECT * FROM usuarios WHERE id = :id;');

    $miConsulta->execute(
        [
            "id" => $id
        ]
    );
}

$usuarios = $miConsulta->fetchAll();
echo $blade->run("users.modificar_u", [
        'id' => $id,
        'usuario' => $usuario,
        'nombre' => $nombre,
        'apellidos' => $apellidos,
        'psswd' => $passwd_e,
        'email' => $email,
        'perfil' => $perfil,
        'activo' => $activo,
        'usuarios' => $usuarios
    ]);

?>