<?php
$hostDB = '127.0.0.1';
$nombreDB = 'biblioteca';
$usuarioDB = 'root';
$contrasenyaDB = '';

try {
    $hostPDO = "mysql:host=$hostDB;dbname=$nombreDB;";
    $miPDO = new PDO($hostPDO, $usuarioDB, $contrasenyaDB);
} catch (PDOException $e) {
    echo "Error: ".$e->getMessage();
}
?>