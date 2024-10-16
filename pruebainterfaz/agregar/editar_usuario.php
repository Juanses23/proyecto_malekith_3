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

// Verificar si se envió el formulario para actualizar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    
    // Verificar si el campo id_administrador está vacío
    $id_administrador = empty($_POST['id_administrador']) ? NULL : $_POST['id_administrador'];

    // Preparar la consulta de actualización
    $sql = "UPDATE usuario SET nombre=?, apellido=?, email=?, telefono=?, id_administrador=? WHERE cedula=?";
    $stmt = $conexion->prepare($sql);

    // Usar 'i' para el tipo de dato de id_administrador si no es NULL, de lo contrario es 's'
    if (is_null($id_administrador)) {
        $stmt->bind_param("ssssis", $nombre, $apellido, $email, $telefono, $id_administrador, $cedula);
    } else {
        $stmt->bind_param("ssssii", $nombre, $apellido, $email, $telefono, $id_administrador, $cedula);
    }

    if ($stmt->execute()) {
        echo "Datos del usuario actualizados correctamente.";
    } else {
        echo "Error al actualizar los datos del usuario: " . $stmt->error;
    }

    $stmt->close();
    header("Location: listar_usuarios.php");
    exit();
} elseif (isset($_GET['cedula'])) {
    // Obtener datos del usuario para mostrar en el formulario
    $cedula = $_GET['cedula'];
    $sql = "SELECT * FROM usuario WHERE cedula = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $cedula);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die("Usuario no encontrado.");
    }

    $usuario = $result->fetch_assoc();
    $stmt->close();
} else {
    die("ID de usuario no especificado.");
}

$conexion->close();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="../css/ag_usuarios.css">
</head>
<body>
    <h2>Editar Usuario</h2>
    <form action="editar_usuario.php" method="POST">
        <input type="hidden" name="cedula" value="<?= $usuario['cedula'] ?>">

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?= $usuario['nombre'] ?>" required>
        <br>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" value="<?= $usuario['apellido'] ?>" required>
        <br>

        <label for="email">Correo:</label>
        <input type="email" id="email" name="email" value="<?= $usuario['email'] ?>" required>
        <br>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" value="<?= $usuario['telefono'] ?>" required>
        <br>

        <label for="id_administrador">ID Administrador:</label>
        <input type="number" id="id_administrador" name="id_administrador" value="<?= $usuario['id_administrador'] ?>">
        <br><br>

        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>
