<?php
include 'funciones.php';
$pdo = conectarBaseDatos();
$filmID = $_GET["id"];
$pelicula = peliculaSeleccionada($pdo, $filmID);

// Procesar la adición de una nueva película
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['title'];
    $descripcion = $_POST['description'];
    $publicacion = $_POST['release_year'];
    $idioma = $_POST['language_id'];    
    $tiempoAlquilado = $_POST['rental_duration'];
    $rangoPublicacion = $_POST['rental_rate'];
    $duracion = $_POST['length'];  
   
    actualizarPelicula($pdo, $filmID, $titulo, $descripcion, $publicacion, $idioma, 
        $tiempoAlquilado, $rangoPublicacion, $duracion);
    header("Location:editar-pelicula.php");
    exit;
    
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/sakila/recursos/estilos.css"> 
</head>

<body>
    <div class="contenedor">

        <h1>Editar película</h1>
       
        <form method="post" action="editar-pelicula.php?id=<?=$filmID?>">
            <p> <strong>Título película:</strong> <input type="text" name="title" value="<?= htmlspecialchars($pelicula['title']) ?>"> </p>
            <p> <strong>Descripción:</strong> <input type="text" name="description" value="<?= htmlspecialchars($pelicula['description']) ?>">
            </p>
            <p> <strong>Año publicación:</strong> <input type="number" name="release_year" value="<?= htmlspecialchars($pelicula['release_year']) ?>">
            </p>
            <p> <strong>ID Idioma:</strong> <input type="number" name="language_id" required value="<?= htmlspecialchars($pelicula['language_id']) ?>">
            </p>
            
            <p> <strong>Tiempo alquiler:</strong> <input type="decimal" name="rental_duration" value="<?= htmlspecialchars($pelicula['rental_duration']) ?>">
            </p>
            <p> <strong>Rango_publicacion:</strong> <input type="number" name="rental_rate" value="<?= htmlspecialchars($pelicula['rental_rate']) ?>">
            </p>
            <p> <strong>Duración:</strong> <input type="number" name="length" value="<?= htmlspecialchars($pelicula['length']) ?>">
            </p>
            
            <button type="submit">Modificar Película</button>
        </form>
        
        <p><a href="peliculas.php">Regresar al listado</a></p>
    </div>
</body>

</html>