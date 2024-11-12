<?php
// Incluir el archivo de funciones de búsqueda
include 'funciones.php';

// Conexión a la base de datos
$pdo = conectarBaseDatos();
$totalPeliculas = totalTabla($pdo, "film");
$totalClientes = totalTabla($pdo, "customer");
$peliculasAlquiladas = peliculasAlquiladas($pdo);
//var_dump($totalClientes);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Índice</title>
    <link rel="stylesheet" href="/sakila/recursos/estilos.css">
</head>

<body>
    <div class="contenedor">
        <h1>Video Club Sakila</h1>
        <h2>Donde la película s'alquila</h2>
        <img src="/sakila/recursos/gatito.jpg" alt="Gatito" width="400" height="400" text-align: center>
        <br>
        <p>Número de películas del catálogo: <?=$totalPeliculas[0]['total'] ?> </p>
        <p>Número de clientes: <?=$totalClientes[0]['total']?> </p>
        <p>Películas alquiladas: <?=$peliculasAlquiladas[0]['total']?> </p>

        <div class="enlinea">
            <ul>
                <li>
                    <a href="/sakila/peliculas.php">Películas</a>
                </li>
                <li>
                    <a href="/sakila/clientes.php">Clientes</a>
                </li>
                <li>
                    <a href="/sakila/gestion-alquileres.php">Alquileres</a>
                </li>
            </ul>
        </div>

    </div>
</body>


</html>