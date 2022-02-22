@extends('layouts.plantilla')
@section('content')
<h1>Modificar préstamo</h1>
<form method="post">
    <p>
        <label for="id_usuario">Usuario</label>
        <select name="id_usuario" class="form-select">
            <option>Seleccione usuario</option>
            <?php foreach ($usuarios as $usuario){ ?>
                <option value="<?= $usuario['id']; ?>"> <?= $usuario['nombre']; ?></option>
            <?php } ?>
        </select>
    </p>
    <p>
        <label for="id_libro">Libro</label>
        <select name="id_libro" class="form-select">
            <option>Seleccione libro</option>
            <?php foreach ($libros as $libro){ ?>
                <option value="<?= $libro['codigo']; ?>"> <?= $libro['titulo']; ?></option>
            <?php } ?>
        </select>
    </p>
    <p>
        <label for="fecha_salida">Fecha de salida</label>
        <input class="form-control" id="fecha_salida" type="date" name="fecha_salida">
    </p>
    <p>
        <label for="fecha_prevista">Fecha prevista de devolución</label>
        <input class="form-control" id="fecha_prevista" type="date" name="fecha_prevista">
    </p>
    <p>
        <label for="fecha_devolucion">Fecha de devolución</label>
        <input class="form-control" id="fecha_devolucion" type="date" name="fecha_devolucion">
    </p>
    <p>
    <div>Sanción</div>

    <input id="si-sancion" type="radio" name="sancion" value="1" checked> <label for="si-disponible">Si</label>
    <input id="no-sancion" type="radio" name="sancion" value="0"> <label for="no-disponible">No</label>
    </p>
    <p>
        <input type="hidden" name="codigo" value="<?= $codigo ?>">
        <a  class="btn btn-primary btn-sm" href="index.php"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
        <input class="btn btn-secondary btn-sm" type="submit" value="Modificar">
    </p>
</form>
@endsection