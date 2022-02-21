@extends('layouts.plantilla')
@section('content')
<h1>Añadir libro</h1>

<form action="" method="post">
    <p>
        <label for="titulo">Titulo</label>
        <input class="form-control" id="titulo" type="text" name="titulo">
    </p>
    <p>
        <label for="autor">Autor</label>
        <select name="autor" class="form-select">
            <option>Seleccione autor</option>
            <?php foreach ($autores as $autor){ ?>
                <option value="<?= $autor['nombre']; ?>"> <?= $autor['nombre']; ?></option>
            <?php } ?>
        </select>
    </p>
    <p>
        <label for="categoria">Categoría</label>
        <select name="categoria" class="form-select">
            <option>Seleccione categoría</option>
            <?php foreach ($categorias as $categoria){ ?>
                <option value="<?= $categoria['nombre']; ?>"> <?= $categoria['nombre']; ?></option>
            <?php } ?>
        </select>
    </p>
    <p>
        <label for="editorial">Editorial</label>
        <select name="editorial" class="form-select">
            <option>Seleccione editorial</option>
            <?php foreach ($editoriales as $editorial){ ?>
                <option value="<?= $editorial['nombre']; ?>"> <?= $editorial['nombre']; ?></option>
            <?php } ?>
        </select>
    </p>
    <p>
    <div>¿Disponible?</div>

    <input id="si-disponible" type="radio" name="disponible" value="1" checked> <label for="si-disponible">Si</label>
    <input id="no-disponible" type="radio" name="disponible" value="0"> <label for="no-disponible">No</label>
    </p>
    <p>
        <input class="btn btn-primary btn-sm" type="submit" value="Guardar">
        <a class="btn btn-secondary btn-sm" href="index.php">Cancelar</a>
    </p>
</form>
@endsection