@extends('layouts.plantilla')
@section('content')
<h1>Modificar libro</h1>
<form method="post">
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
    <input id="si-disponible" type="radio" name="disponible" value="1"<?= $libros['disponible'] ? ' checked' : '' ?>> <label for="si-disponible">Si</label>
    <input id="no-disponible" type="radio" name="disponible" value="0"<?= !$libros['disponible'] ? ' checked' : '' ?>> <label for="no-disponible">No</label>
    </p>
    <p>
        <input type="hidden" name="codigo" value="<?= $codigo ?>">
        <a  class="btn btn-primary btn-sm" href="index.php"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
        <input class="btn btn-secondary btn-sm" type="submit" value="Modificar">
    </p>
</form>
@endsection