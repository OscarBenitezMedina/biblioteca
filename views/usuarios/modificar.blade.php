@extends('layouts.plantilla')
@section('content')
<h1>Modificar usuario</h1>

<form method="post">
    <?php foreach ($usuarios as $key => $value){ ?>
    <p>
        <label for="usuario">Nombre de usuario</label>
        <input class="form-control" id="usuario" type="text" name="usuario" value= "<?= $value['usuario'] ?>">
    </p>
    <p>
        <label for="nombre">Nombre</label>
        <input class="form-control" id="nombre" type="text" name="nombre" value= "<?= $value['nombre'] ?>">
    </p>
    <p>
        <label for="apellidos">Apellidos</label>
        <input class="form-control" id="apellidos" type="text" name="apellidos" value= "<?= $value['apellidos'] ?>">
    </p>
    <p>
        <label for="passwd">Contraseña</label>
        <input class="form-control" id="passwd" type="password" name="passwd" value= "<?= $value['passwd'] ?>">
    </p>
    <p>
        <label for="email">Email</label>
        <input class="form-control" id="email" type="text" name="email" value= "<?= $value['email'] ?>">
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
        <input type="hidden" name="codigo" value="<?= $codigo ?>">
        <a  class="btn btn-primary btn-sm" href="index.php"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
        <input class="btn btn-secondary btn-sm" type="submit" value="Modificar">
    </p>
    <?php } ?>
</form>
@endsection