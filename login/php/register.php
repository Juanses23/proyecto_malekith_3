<?php
// Código PHP para el registro de usuario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $server = "localhost";
    $user = "root";
    $pass = "juanses23";
    $db = "malekith";

    $conexion = new mysqli($server, $user, $pass, $db);

    if ($conexion->connect_errno) {
        die("Conexión Fallida: " . $conexion->connect_error);
    }

    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $cedula = $_POST['cedula'];
    $ciudad = $_POST['ciudad'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $passsword = $_POST['passsword'];
    $reppassword = $_POST['repppasssword'];

    // Validar que las contraseñas coincidan
    if ($passsword !== $reppassword) {
        $error = "Las contraseñas no coinciden. Inténtalo de nuevo.";
    } else {
        // Preparar la consulta SQL
        $sql = "INSERT INTO usuario (nombre, apellido, fecha_nacimiento, cedula, ciudad, email, direccion, telefono, passsword) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sssssssss", $nombre, $apellido, $fecha_nacimiento, $cedula, $ciudad, $email, $direccion, $telefono, $passsword);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            header("Location: ../php/login.php");
            exit();
        } else {
            $error = "Error al registrar. Inténtalo de nuevo.";
        }

        $stmt->close();
    }

    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear cuenta</title>
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>
    <section class="form-main">
        <div class="form-content">
            <div class="box">
                <h3>Crea tu cuenta</h3>
                <form action="register.php" method="POST">
                    <div class="input-box">
                        <input type="text" name="nombre" placeholder="Nombres" class="input-control" required>
                    </div>
                    <div class="input-box">
                        <input type="text" name="apellido" placeholder="Apellidos" class="input-control" required>
                    </div>
                    <div class="input-box">
                        <input type="date" name="fecha_nacimiento" placeholder="Fecha de nacimiento" class="input-control" required>
                    </div>
                    <div class="input-box">
                        <input type="number" name="cedula" placeholder="Cedula" class="input-control" required>
                    </div>
                    <div class="input-box">
                        <input type="text" name="ciudad" placeholder="Ciudad" class="input-control" required>
                    </div>
                    <div class="input-box">
                        <input type="text" name="email" placeholder="Correo" class="input-control" required>
                    </div>
                    <div class="input-box">
                        <input type="text" name="direccion" placeholder="Dirección" class="input-control" required>
                    </div>
                    <div class="input-box">
                        <input type="number" name="telefono" placeholder="Celular" class="input-control" required>
                    </div>
                    <div class="input-box">
                        <input type="password" name="passsword" placeholder="Contraseña" class="input-control" required>
                    </div>
                    <div class="input-box">
                        <input type="password" name="repppasssword" placeholder="Repite la Contraseña" class="input-control" required>
                    </div>
                    <button type="submit" class="btn">Crear cuenta</button>
                    <?php if (isset($error)) : ?>
                        <p class="error-message"><?php echo $error; ?></p>
                    <?php endif; ?>
                </form>                
            </div>
        </div>
    </section>
</body>
</html>
