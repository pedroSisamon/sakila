<?php
// Incluir el archivo de funciones de búsqueda
include 'funciones.php';

// Conexión a la base de datos
$pdo = conectarBaseDatos();

// Obtener el ID de la pelicula desde la URL
$clienteID = $_GET['id'];

// Borrar la ciudad y redirigir
if (borrarCliente($pdo, $clienteID)) {
    header("Location: clientes.php");
    exit;
} else {
    echo "<h1>Error al borrar el cliente.</h1>";
}

?>