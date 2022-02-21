@extends('layouts.plantilla')
@section('content')
        <h1>Añadir autor</h1>

        <form action="" method="post">
            <p>
                <label for="nombre">Nombre</label>
                <input class="form-control" id="nombre" type="text" name="nombre">
            </p>
            <p>
                <label for="apellidos">Apellidos</label>
                <input class="form-control" id="apellidos" type="text" name="apellidos">
            </p>
            <p>
                <label for="fecha_nacimiento">Fecha de nacimiento</label>
                <input class="form-control" id="fecha_nacimiento" type="date" name="fecha_nacimiento">
            </p>
            <p>
                <label for="fecha_fallecimiento">Fecha de fallecimiento</label>
                <input class="form-control" id="fecha_fallecimiento" type="date" name="fecha_fallecimiento">
            </p>
            <p>
                <label for="lugar_nacimiento">Lugar de nacimiento</label>
                <input class="form-control" id="lugar_nacimiento" type="text" name="lugar_nacimiento">
            </p>
            <p>
                <label for="biografia">Biografía</label>
                <input class="form-control" id="biografia" type="text" name="biografia">
            </p>
            <p>
                <label for="foto">Foto</label>
                <input class="form-control" id="foto" type="text" name="foto">
            </p>
            <p>
                <input class="btn btn-primary btn-sm" type="submit" value="Guardar">
                <a class="btn btn-secondary btn-sm" href="index.php">Cancelar</a>
            </p>
        </form>
    </div>
@endsection