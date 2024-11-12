<?php
// Incluir el archivo de funciones de búsqueda
include 'funciones.php';

// Conexión a la base de datos
$pdo = conectarBaseDatos();

// Obtener el ID de la pelicula desde la URL
$tituloID = $_GET['id'];

// Borrar la ciudad y redirigir
if (borrarPelicula($pdo, $tituloID)) {
    header("Location: peliculas.php");
    exit;
} else {
    echo "<h1>Error al borrar la ciudad.</h1>";
}

?>