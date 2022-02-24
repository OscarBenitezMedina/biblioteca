@extends('layouts.plantilla')
@section('content')
<h1>Modificar editorial</h1>
<form method="post">
    <?php foreach ($editoriales as $key => $value){ ?>
    <p>
        <label for="nombre">Nombre</label>
        <input  class="form-control" id="nombre" type="text" name="nombre" value= "<?= $value['nombre'] ?>">
    </p>
    <?php } ?>
    <p>
        <input type="hidden" name="codigo" value="<?= $codigo_editorial ?>">
        <a  class="btn btn-primary btn-sm" href="index.php"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
        <input class="btn btn-secondary btn-sm" type="submit" value="Modificar">
    </p>
</form>
@endsection