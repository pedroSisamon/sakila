<?php
// Incluir el archivo de funciones de búsqueda
include 'funciones.php';

// Conexión a la base de datos
$pdo = conectarBaseDatos();


// Inicializar variables
$peliculas = [];
$pelicula = '';
$film_id = '';

// Procesar el filtrado de una pelicula

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cadena = $_POST['cadena'];
    
    $peliculas = filtrarPelicula($pdo, $cadena);
   
} else {    
    $peliculas = devolverPeliculas($pdo);
}


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Películas</title>
    <link rel="stylesheet" href="/sakila/recursos/estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        function confirmarBorrado(id, titulo) {
            if (confirm('¿Estás seguro de que quieres eliminar la pelicula "' + titulo + '"?')) {
                window.location.href = 'borrar-pelicula.php?id=' + id;
            }
        }
    </script>
</head>

<body>

    <div class="contenedor">
        <h1>Películas del Video Club Sakila</h1>
        <a href="/sakila/index.php" style="margin-right: 10px; ">Volver inicio </a>
        <a href="/sakila/agregar-pelicula.php">Agregar película</a>
        <br>

        <form method="post" action="peliculas.php" >
            <p><strong>Filtrar por nombre película</strong> <input type="text" name="cadena"/> </p>
            <button type="submit">Filtrar</button>
        </form>
    
        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Lanzamiento</th>
                    <th>Categoría</th>
                    <th>Duración</th>
                    <th>Tarifa</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($peliculas as $pelicula): ?>
                    <tr>
                        <td><?= $pelicula['title'] ?></td>
                        <td><?= $pelicula['description'] ?></td>
                        <td><?= $pelicula['release_year'] ?></td>
                        <?php $categoria = consultaCategoria($pdo, $pelicula['film_id']);?>
                        <td><?= $categoria['categoria']?></td>
                        <td><?= $pelicula['length'] ?></td>
                        <td><?=$pelicula['rental_rate']?></td>
                        <td class="acciones">
                            <a href="editar-pelicula.php?id=<?= $pelicula['film_id'] ?>" title="Editar"><i class="fas fa-edit"></i></a>
                            <a href="#" title="Eliminar" onclick="confirmarBorrado(<?= $pelicula['film_id'] ?>, '<?= htmlspecialchars($pelicula['title'], ENT_QUOTES) ?>')"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>


    </div>

</body>

</html>