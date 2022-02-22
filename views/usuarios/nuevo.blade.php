@extends('layouts.plantilla')
@section('content')
<h1>Añadir usuarios</h1>

<form action="" method="post">
    <p>
        <label for="nombre">Nombre de usuario</label>
        <input class="form-control" id="usuario" type="text" name="usuario">
    </p>
    <p>
        <label for="nombre">Nombre</label>
        <input class="form-control" id="nombre" type="text" name="nombre">
    </p>
    <p>
        <label for="apellidos">Apellidos</label>
        <input class="form-control" id="apellidos" type="text" name="apellidos">
    </p>
    <p>
        <label for="passwd">Contraseña</label>
        <input class="form-control" id="passwd" type="password" name="passwd">
    </p>
    <p>
        <label for="email">Email</label>
        <input class="form-control" id="email" type="text" name="email">
    </p>
    <p>
        <div class="btn-group col" role="group" aria-label="Basic checkbox toggle button group">
            <input type="checkbox" name ="perfil" class="btn-check" id="alumno" autocomplete="off" value="alumno">
            <label class="btn btn-outline-dark border-2" for="alumno">Alumno</label>

            <input type="checkbox" name ="perfil" class="btn-check" id="bibliotecario" autocomplete="off" value="bibliotecario">
            <label class="btn btn-outline-dark border-2" for="bibliotecario">Bibliotecario</label>
        </div>
    </p>
    <p>
    <div>Activo</div>

    <input id="si-activo" type="radio" name="activo" value="1" checked> <label for="si-activo">Si</label>
    <input id="no-activo" type="radio" name="activo" value="0"> <label for="no-activo">No</label>
    </p>
    <p>
        <input class="btn btn-primary btn-sm" type="submit" value="Guardar">
        <a class="btn btn-secondary btn-sm" href="index.php">Cancelar</a>
    </p>
</form>
@endsection