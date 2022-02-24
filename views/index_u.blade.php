@extends('layouts.plantilla')
@section('content')
<div class="d-flex justify-content-between">
    <h1>Bienvenido/a <?php echo ($_SESSION['usuario']) ?></h1>
    <a class="btn btn-secondary btn-sm pt-3" href="../login/logout.php">Logout</a>
</div>
<div class="mt-5">
    <h4>Datos:</h4>
    <ul>
        <?php foreach ($datos as $dato): ?>
            <li>Usuario: <?= $dato['usuario']?></li>
            <li>Nombre: <?= $dato['nombre']?></li>
            <li>Apellidos: <?= $dato['apellidos']?></li>
            <li>Contraseña: <?= $dato['passwd']?></li>
            <li>Email: <?= $dato['email']?></li>
            <li>Perfil: <?= $dato['perfil']?></li>
        <?php endforeach; ?>
        </ul>
</div>
<div class="d-flex justify-content-center mt-5">
    <?php foreach ($libros as $libro): ?>
        <div class="me-5">
            <img src= "../img/<?= $libro['imagen']; ?>" alt="imagen" width=200 height=300>
            <h4><?= $libro ['libro']; ?></h4>
            <p><?= $libro ['sancion'] ? 'Sí' : 'No' ; ?> hay sanción</p>
        </div>
    <?php endforeach; ?>
    
</div>
<a href= ../index.php><i class= "fa fa-arrow-left" aria-hidden="true"></i></a>
@endsection