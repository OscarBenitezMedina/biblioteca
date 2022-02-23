@extends('layouts.plantilla')
@section('content')
<div class="d-flex justify-content-between">
    <h1>Biblioteca</h1>
    <a class="btn btn-secondary btn-sm pt-3" href="login/login.php">Login</a>
</div>
<div class="d-flex justify-content-center mt-5">
    <?php foreach ($libros as $clave => $valor): ?>
        <div>
            <img src= <?= $valor['imagen']; ?> alt="imagen">
            <h4><?= $valor['titulo']; ?></h4>
            <p><?= $valor['disponible'] ? 'Si' : 'No'; ?> está disponible</p>
        </div>
    <?php endforeach; ?>

</div>
@endsection