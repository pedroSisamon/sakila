<?php
include 'funciones.php';
$pdo = conectarBaseDatos();

// Procesar la adición de una nueva película
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['title'];
    $descripcion = $_POST['description'];
    $publicacion = $_POST['release_year'];
    $idioma = $_POST['language_id'];    
    $tiempoAlquilado = $_POST['rental_duration'];
    $rangoPublicacion = $_POST['rental_rate'];
    $duracion = $_POST['length'];

    agregarPelicula( $pdo, $titulo, $descripcion, $publicacion, $idioma, 
        $tiempoAlquilado, $rangoPublicacion, $duracion);
    header("Location: peliculas.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar película</title>
    <link rel="stylesheet" href="/sakila/recursos/estilos.css">
</head>
<body>
    <div class="contenedor">
        <h1>Agregar película</h1>
        <form method="post" action="agregar-pelicula.php">
            <p> <strong>Título película:</strong> <input type="text" name="title" > </p>
            <p> <strong>Descripción:</strong> <input type="text" name="description"> 
            </p>
           <p> <strong>Año publicación:</strong> <input type="number" name="release_year">
            </p>
            <p> <strong>ID Idioma:</strong> <input type="number" name="language_id" required>
            </p>            
            <p> <strong>Tiempo alquiler:</strong> <input type="number" name="rental_duration" >
            </p>
            <p> <strong>Rango_publicacion:</strong> <input type="number" name="rental_rate" >
            </p>
            <p> <strong>Duración:</strong> <input type="number" name="length" >
            </p>            
            <button type="submit">Agregar Película</button>
        </form>
        <p><a href="peliculas.php">Regresar al listado</a></p>
    </div>

</body>

</html>