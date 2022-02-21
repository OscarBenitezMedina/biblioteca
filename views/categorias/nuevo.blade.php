@extends('layouts.plantilla')
@section('content')
    <h1>Añadir categoría</h1>

    <form action="" method="post">
        <p>
            <label for="nombre">Nombre</label>
            <input class="form-control" id="nombre" type="text" name="nombre">
        </p>
        <p>
            <input class="btn btn-primary btn-sm" type="submit" value="Guardar">
            <a class="btn btn-secondary btn-sm" href="index.php">Cancelar</a>
        </p>
    </form>
</div>
@endsection