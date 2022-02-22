@extends('layouts.plantilla')
@section('content')
<h1>Añadir prestamo</h1>

<form action="" method="post">
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
        <input class="btn btn-primary btn-sm" type="submit" value="Guardar">
        <a class="btn btn-secondary btn-sm" href="index.php">Cancelar</a>
    </p>
</form>
@endsection