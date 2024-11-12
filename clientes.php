<?php
// Incluir el archivo de funciones de búsqueda
include 'funciones.php';

// Conexión a la base de datos
$pdo = conectarBaseDatos();
$clientes = clientes($pdo);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link rel="stylesheet" href="/sakila/recursos/estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        function confirmarBorrado(id, cliente) {
            if (confirm('¿Estás seguro de que quieres eliminar el cliente "' + cliente + '"?')) {
                window.location.href = 'borrar-cliente.php?id=' + id;
            }
        }
    </script>
</head>

<body>

    <div class="contenedor">
        <h1>Clientes del Video Club Sakila</h1>
        <a href="/sakila/index.php" style="margin-right: 10px;">Volver inicio    </a>
        <a href="/sakila/agregar-cliente.php">Agregar cliente</a>

        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Direccion</th>
                    <th>Actividad</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($clientes as $cliente): ?>
                    <tr>
                        <td><?=$cliente['first_name'] ?> <?= $cliente['last_name']?> </td>
                        <td><?=$cliente['email']?></td>
                        <td>Pendiente</td>
                        <td><?= $cliente['active'] ?></td>
                        <td class="acciones">
                            <a href="editar-cliente.php?id=<?= $cliente['customer_id'] ?>" title="Editar"><i class="fas fa-edit"></i></a>
                            <a href="#" title="Eliminar" onclick="confirmarBorrado(<?= $cliente['customer_id'] ?>, '<?= htmlspecialchars($cliente['last_name']  , ENT_QUOTES) ?>')"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                <?php endforeach;?>
            </tbody>

        </table>

    </div>

</body>

</html>