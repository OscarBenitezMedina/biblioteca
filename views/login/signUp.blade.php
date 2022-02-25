@extends('layouts.plantilla')
@section('content')
<h1>Añadir usuario</h1>

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
        <input class="btn btn-primary btn-sm" type="submit" value="Guardar">
        <a class="btn btn-secondary btn-sm" href="../index.php">Cancelar</a>
    </p>
</form>
@endsection