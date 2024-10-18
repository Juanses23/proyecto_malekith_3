<?php
// Conexión a la base de datos
$server = "localhost";
$user = "root";
$pass = "juanses23";
$db = "malekith";

$conexion = new mysqli($server, $user, $pass, $db);

if ($conexion->connect_errno) {
    die("Conexión Fallida: " . $conexion->connect_error);
}

// Obtener todos los usuarios
$sql = "SELECT * FROM usuario";
$result = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="../css/ag_usuarios.css">

</head>
<body>
    <h2>Lista de Usuarios</h2>
    
    <!-- Botón para ir a agregar.php -->
    <form action="agregar.php" method="GET" style="margin-bottom: 20px;">
        <button type="submit">Volver</button>
    </form>
    <form action="fpdf/pruebaV.php" target="_blank" method="GET" style="margin-bottom: 20px;">
        <button type="submit" >Reporte de usuarios</button>
    </form>

    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>ID Administrador</th>
            <th>Acciones</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['nombre'] ?></td>
                <td><?= $row['apellido'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['telefono'] ?></td>
                <td><?= $row['id_administrador'] ?></td>
                <td>
                    <form action="editar_usuario.php" method="GET" style="display: inline;">
                        <input type="hidden" name="cedula" value="<?= $row['cedula'] ?>">
                        <button type="submit">Editar</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php
$conexion->close();
?>
