@extends('layouts.plantilla')
@section('content')
<h1>Libros</h1>
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
                <th>Imagen</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Editorial</th>
                <th>Categoría</th>
                <th>¿Disponible?</th>
                <th colspan="2">Opciones</th>
            </tr>
            <?php foreach ($libros as $clave => $valor): ?>
                <tr>
                    <td><?= $valor['codigo']; ?></td>
                    <td><?= $valor['imagen']; ?></td>
                    <td><?= $valor['titulo']; ?></td>
                    <td><?= $valor['autor']; ?></td>
                    <td><?= $valor['editorial']; ?></td>               
                    <td><?= $valor['categoria']; ?></td>
                    <td><?= $valor['disponible'] ? 'Si' : 'No'; ?></td>
                    <!-- Se utilizará más adelante para indicar si se quiere modificar o eliminar el registro -->
                    <td><a  class="btn btn-primary btn-sm" href="modificar.php?codigo=<?= $valor['codigo'] ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                    <td><a  class="btn btn-danger btn-sm" return confirm('¿ Desea borrar el libro ?')" href="borrar.php?codigo=<?= $valor['codigo'] ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?= "Numero de registros: ".count($libros) ?> <br>
        <a  class="btn btn-primary btn-sm" href="../index.php"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
        </div>
@endsection