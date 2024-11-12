<?php
include 'funciones.php';
$pdo = conectarBaseDatos();

// Procesar la adición de una nueva película
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $active = $_POST['active'];


    agregarCliente($pdo, $first_name, $last_name, $email, $address, $active);
    header("Location: clientes.php");
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
        <h1>Agregar Cliente</h1>
        <form method="post" action="agregar-cliente.php">
            <p> <strong>Nombre:</strong> <input type="text" name="first_name"> </p>
            <p> <strong>Apellido:</strong> <input type="text" name="last_name">
            </p>
            <p> <strong>Correo-e:</strong> <input type="text" name="email">
            </p>
            <p> <strong>Direccion:</strong> <input type="number" name="address" required>
            </p>
            <p><strong>Activo:</strong>
                <select name="active">
                    <option value="0">0</option>
                    <option value="1">1</option>
                </select>
            </p>

            <button type="submit">Agregar Cliente</button>
        </form>
        <p><a href="Clientes.php">Regresar al listado</a></p>
    </div>

</body>

</html>