@extends('layouts.plantilla')
@section('content')
<h1>Catálogo</h1>
<div class="d-flex justify-content-center">
    <?php foreach ($libros as $clave => $valor): ?>
        <div>
            <img src="<?= $valor['imagen']; ?>" alt="">
            <h4><?= $valor['titulo']; ?></h4>
            <p><?= $valor['disponible']; ?> está disponible</p>
        </div>
    <?php endforeach; ?>

</div>
<div>
<a class="btn btn-secondary btn-sm" href="login/login.php">Login</a>
</div>

@endsection