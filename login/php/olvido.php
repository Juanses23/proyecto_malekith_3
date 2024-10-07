<?php
// Código PHP para la conexión y verificación del inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $server = "localhost";
    $user = "root";
    $pass = "juanses23";
    $db = "malekith";

    $conexion = new mysqli($server, $user, $pass, $db);

    if ($conexion->connect_errno){
        die("Conexión Fallida: " . $conexion->connect_error);
    }

    $email = $_POST['email'];

    // Preparar la consulta
    $sql = "SELECT * FROM usuario WHERE email='$email'";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        session_start();
        $_SESSION['usuario'] = $email;
        header("Location: ../php/cod-recuperar-contra.html");
        exit();
    } else {
        $error = "Correo no registrado. Inténtalo de nuevo.";
    }

    $conexion->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Correo recuperación</title>
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>
    <section class="form-main">
        <div class="form-content">
            <div class="box">
                <h3>¿Olvido su contraseña?</h3>
                <form action="olvido.php" method="POST">
                    <div class="input-box">
                        <input type="text" placeholder="Correo de recuperacion" id="email" name="email" class="input-control" required>
                    </div>
                    <button type="submit" class="btn">Enviar</button>
                    <div id="error-message" class="gradient-text">
                        <?php if (isset($error)) echo $error; ?>
                    </div>
                </form>
                
                <p>¿No tienes  cuenta? <a href="../php/register.php" class="gradient-text">Crear cuenta</a></p>
            </div>
        </div>
    </section>
</body>
</html>