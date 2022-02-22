@extends('layouts.plantilla')
@section('content')
<h1>Usuarios</h1>
        <?php if (isset($_SESSION["mensaje"])) { ?>
            <div class="alert alert-warning alert-dsmissible fade show" role="alert" aria-label="close">
                <?= $_SESSION["mensaje"] ?>
            </div>
        <?php
            unset($_SESSION["mensaje"] );
        }
        ?>
        <div class="d-flex justify-content-between mb-2">
            <form action="index.php" method="post">
                <div class="input-group">
                    <input class="form-control" name="buscar">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>

            </form>
            <p><a  class="btn btn-success btn-sm" href="nuevo.php"><i class="fa fa-plus-circle" aria-hidden="true"></i>Crear</a></p>
        </div>
        <table class="table table-striped table-bordered">
            <tr>
                <th>Código</th>
                <th>Nombre de usuario</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Contraseña</th>
                <th>Email</th>
                <th>Perfil</th>
                <th>Activo</th>
                <th colspan="2">Opciones</th>
            </tr>
            <?php foreach ($usuarios as $clave => $valor): ?>
                <tr>
                    <td><?= $valor['id']; ?></td>
                    <td><?= $valor['usuario']; ?></td>
                    <td><?= $valor['nombre']; ?></td>
                    <td><?= $valor['apellidos']; ?></td>
                    <td><?= $valor['passwd']; ?></td>
                    <td><?= $valor['email']; ?></td>               
                    <td><?= $valor['perfil']; ?></td>
                    <td><?= $valor['activo'] ? 'Si' : 'No'; ?></td>
                    <!-- Se utilizará más adelante para indicar si se quiere modificar o eliminar el registro -->
                    <td><a  class="btn btn-primary btn-sm" href="modificar.php?id=<?= $valor['id'] ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                    <td><a  class="btn btn-danger btn-sm" return confirm('¿ Desea borrar el usuario ?')" href="borrar.php?id=<?= $valor['id'] ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?= "Numero de registros: ".count($usuarios) ?> <br>
        <a  class="btn btn-primary btn-sm" href="../index.php"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
        </div>
@endsection