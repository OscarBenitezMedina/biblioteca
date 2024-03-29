@extends('layouts.plantilla')
@section('content')
<h1>Índice</h1>
        <div class="list-group container">
            <a class="list-group-item list-group-item-action" href="autores/index.php">Autores</a>
            <a class="list-group-item list-group-item-action" href="categorias/index.php">Categorias</a>
            <a class="list-group-item list-group-item-action" href="editoriales/index.php">Editoriales</a>
            <a class="list-group-item list-group-item-action" href="libros/index.php">Libros</a>
            <a class="list-group-item list-group-item-action" href="prestamos/index.php">Prestamos</a>
            <a class="list-group-item list-group-item-action" href="usuarios/index.php">Usuarios</a>
        </div>
        <div class="container">
            <a class="nav-link active" aria-current="page" href="../login/logout.php"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
        </div>
    </div>
@endsection