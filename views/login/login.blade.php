@extends('layouts.plantilla')
@section('content')
<h1>Login</h1>         
<div class="card-body">
    <form id="basic-form" action="login.php" method="POST">
        <div class="input-group form-group mb-3">
            <input id="usuario" name="usuario" type="text" class="form-control" placeholder = "Usuario">
        </div>
        <div class="input-group form-group mt-3">
            <input id="passwd" type="password" name="passwd" class="form-control" placeholder = "Contraseña">
        </div>
        <div class="form-group mt-3 p-5">
            <button  type="submit" name="login" class="btn btn-outline-dark border-2 me-3">Login</button>
                <!-- <button onclick="location.href='registro.php'" class="btn btn-outline-light border-2">Registrarse</button> -->
        </div>
    </form>
</div>
</div>
@endsection