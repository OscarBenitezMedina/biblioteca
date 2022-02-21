@extends('layouts.plantilla')
@section('content')
<h1>Autores</h1>
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
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Fecha de nacimiento</th>
                <th>Fecha de fallecimiento</th>
                <th>Lugar de nacimiento</th>
                <th>Biografía</th>
                <th>Foto</th>
                <th colspan="2">Opciones</th>
            </tr>
            <?php foreach ($autores as $clave => $valor): ?>
                <tr>
                    <td><?= $valor['codigo_autor']; ?></td>
                    <td><?= $valor['nombre']; ?></td>
                    <td><?= $valor['apellidos']; ?></td>
                    <td><?= $valor['fecha_nacimiento']; ?></td>
                    <td><?= $valor['fecha_fallecimiento']; ?></td>
                    <td><?= $valor['lugar_nacimiento']; ?></td>
                    <td><?= $valor['biografia']; ?></td>
                    <td><?= $valor['foto']; ?></td>
                    <td><a  class="btn btn-primary btn-sm" href="modificar.php?codigo_autor=<?= $valor['codigo_autor'] ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                    <td><a  class="btn btn-danger btn-sm" return confirm('¿ Desea borrar el libro ?')" href="borrar.php?codigo_autor=<?= $valor['codigo_autor'] ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?= "Numero de registros: ".count($autores) ?> <br>
        <a  class="btn btn-primary btn-sm" href="../index.php"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
        </div>
@endsection