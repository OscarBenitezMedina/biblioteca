<?php
    session_start();
    
    require '../../base_datos.php';
    require "../../vendor/autoload.php";

    use eftec\bladeone\BladeOne;

    $views = '../../views';
    $cache = '../../cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

    $sql = "SELECT p.*, 
        usuarios.usuario as usuario,
        libros.titulo as libro
        FROM prestamos p
        LEFT JOIN usuarios ON p.id_usuario = usuarios.id
        LEFT JOIN libros ON p.id_libro = libros.codigo";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = isset($_REQUEST['buscar']) ? $_REQUEST['buscar'] : null;
        $miConsulta = $miPDO->prepare('SELECT * FROM prestamos WHERE id like CONCAT("%", :id, "%")');
        $miConsulta->execute(['id' => $id]);
    } else {
        $miConsulta = $miPDO->prepare($sql);
        $miConsulta->execute();
    }

    $prestamos = $miConsulta->fetchAll();

    if (isset($_REQUEST['id'])) {
        $fecha_devolucion = date("Y-m-d");
        $id = $_REQUEST['id'];
        $disponible = 1;
        $miSelect = $miPDO->prepare("SELECT id_libro from prestamos where id = :id");
        $miSelect->execute(
            [
                'id' => $id
            ]
        );
        $libros = $miSelect->fetchAll();
        foreach ($libros as $libro) {
            $id_libro = $libro ['id_libro'];
        }

        $miUpdate = $miPDO->prepare('UPDATE libros SET disponible = :disponible where codigo = :id_libro');
        $miUpdate->execute(
            [
                'disponible' => $disponible,
                'id_libro' => $id_libro
            ]
            );

        $select = $miPDO->prepare("SELECT fecha_prevista FROM prestamos where id = :id;");
        $select -> execute(
            [
                'id' => $id
            ]
        );
        $fecha = $select->fetchAll();
        foreach ($fecha as $key => $valor){
            $fecha_prevista = $valor ['fecha_prevista'];
        }

        if ($fecha_devolucion > $fecha_prevista) {
            $sancion = 1;
            $devuelto = 1;
            $activo = 0;

            $miUpdate = $miPDO->prepare("UPDATE prestamos SET sancion = :sancion, fecha_devolucion = :fecha_devolucion, devuelto = :devuelto WHERE id = :id;");
            $miUpdate->execute(
                [
                    'id' => $id,
                    'sancion' => $sancion,
                    'devuelto' => $devuelto,
                    'fecha_devolucion' => $fecha_devolucion
                ]
            );

            $miSelect = $miPDO->prepare("SELECT id_usuario from prestamos where id = :id");
             $miSelect->execute(
            [
                'id' => $id
            ]
            );
            $usuarios = $miSelect->fetchAll();
            foreach ($usuarios as $usuario) {
                $id_usuario = $usuario ['id_usuario'];
            }

            $miUpdate = $miPDO->prepare("UPDATE usuarios SET activo = :activo WHERE id = :id;");
            $miUpdate->execute(
                [
                    'id' => $id_usuario,
                    'activo' => $activo
                ]
            );

        } else {
            $devuelto = 1;
            $miUpdate = $miPDO->prepare("UPDATE prestamos SET fecha_devolucion = :fecha_devolucion, devuelto = :devuelto WHERE id = :id;");
            $miUpdate->execute(
                [
                    'id' => $id,
                    'devuelto' => $devuelto,
                    'fecha_devolucion' => $fecha_devolucion
                ]
            );
        }            
    }
   
    echo $blade->run("prestamos.index", [
        "prestamos" => $prestamos,
    ]);
?>

