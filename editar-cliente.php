<?php
include 'funciones.php';
$pdo = conectarBaseDatos();
$id = $_GET["id"];
$cliente = clienteSeleccionado($pdo, $id);

// Procesar la adición de un nuevo cliente
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $store_id = $_POST['store_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];    
    $address_id = $_POST['address_id'];
    $active = $_POST['active'];
    
    actualizarCliente($pdo, $id,$store_id, $first_name, $last_name, $email, $address_id, $active);
    header("Location:editar-cliente.php");
    exit;   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/sakila/recursos/estilos.css"> 
</head>
<body>
    <div class=contenedor>        
        <h1> Editar datos del Cliente </h1>
        <form method='POST' action="editar-cliente.php?id=<?=$id?>">
            <p><strong>store_id</strong> <input type="number" name = "store_id" value="<?= htmlspecialchars($cliente['store_id']) ?>"></p>
            <p> <strong>first_name:</strong>  <input type="text" name = "first_name" value="<?= htmlspecialchars($cliente['first_name']) ?>"> </p>
            <p><strong>last_name:</strong> <input type="text" name = "last_name" value="<?= htmlspecialchars($cliente['last_name']) ?>"> </p>
            <p><strong>email:</strong> <input type="text" name = "email" value="<?= htmlspecialchars($cliente['email']) ?>">  </p>
            <p><strong>address_id:</strong> <input type="text" name = "address_id" value="<?= htmlspecialchars($cliente['address_id']) ?>">  </p>
            <p><strong>active:</strong> <input type="text" name = "active" value="<?= htmlspecialchars($cliente['active']) ?>">   </p> 
            <button type="submit">Modificar Cliente</button>           
        </form>
        <p><a href="clientes.php">Regresar al listado</a></p>
    </div>
</body>
</html>