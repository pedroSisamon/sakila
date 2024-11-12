<?php
// Incluir el archivo de funciones de búsqueda
include 'funciones.php';

// Conexión a la base de datos
$pdo = conectarBaseDatos();
$alquileres = alquileres($pdo);


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link rel="stylesheet" href="/sakila/recursos/estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

    
    <div class="contenedor">
    <a href="/sakila/index.php">Volver inicio</a>
        <h1>Gestión de Alquileres</h1>
        <table>
            <thead>
                <tr>
                    <th>Película</th>
                    <th>Cliente</th>
                    <th>Fecha alquiler</th>
                    <th>Fecha devolución</th>
                    <th>Empleado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alquileres as $alquiler): ?>
                    <tr>
                    <?php $nombrePelicula = nombrePelicula($pdo, $alquiler['pelicula']); ?>
                    <?php $nombreCliente = nombreCliente($pdo, $alquiler['cliente']); ?>
                        <td> <?= $alquiler['pelicula'] . ": " . $nombrePelicula['title'] ?> </td>
                        <td> <?= $alquiler['cliente']  . ": " . $nombreCliente['first_name'] . " " . $nombreCliente['last_name']?> </td>
                        <td> <?= $alquiler['fecha_alquiler'] ?> </td>
                        <td> <?= $alquiler['fecha_devolucion'] ?> </td>
                        <td> <?= $alquiler['empleado'] ?> </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>



    </div>
</body>

</html>