@extends('layouts.plantilla')
@section('content')
<div class="d-flex justify-content-between">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Bienvenido/a <?php echo ($_SESSION['usuario']) ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../login/logout.php">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active"  href= ../index.php>Biblioteca</a>
                    </li>
                    <li class="nav-item">
                        <?php foreach ($datos as $dato): ?>
                            <a class="nav-link active" href="modificar_u.php?id=<?= $dato['id'] ?>">Modificar perfil</a>
                        <?php endforeach; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
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