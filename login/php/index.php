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
    $passsword = $_POST['passsword'];

    // Preparar la consulta para obtener el nombre del usuario
    $sql = "SELECT nombre, email FROM usuario WHERE email='$email' AND passsword='$passsword'";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        session_start();
        $_SESSION['usuario'] = $row['nombre']; // Almacena el nombre en la sesión
        header("Location: /proyecto_malekith_3/pruebainterfaz/carrito/interfaz.php");
        exit();
    } else {
        $error = "Credenciales incorrectas. Inténtalo de nuevo.";
    }

    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>
    <section class="form-main">
        <div class="form-content">
            <div class="box">
                <h3>Bienvenido</h3>
                <form action="index.php" method="POST" id="form">
                    <div class="input-box">
                        <input type="text" placeholder="Correo" id="email" name="email" class="input-control" required>
                    </div>
                    <div class="input-box">
                        <input type="password" placeholder="Contraseña" id="passsword" name="passsword" class="input-control" required>
                        <div class="input-link">
                            <a href="/proyecto_malekith_3/login/php/olvido.php" class="gradient-text">Olvidaste tu contraseña</a>
                        </div>
                    </div>
                    <button type="submit" class="btn">Iniciar Sesion</button>
                    <div id="error-message" class="gradient-text">
                        <?php if (isset($error)) echo $error; ?>
                    </div>
                </form>
                <p>No tienes cuenta? <a href="../php/register.php" class="gradient-text">Crear cuenta</a></p>
            </div>
        </div>
    </section>
</body>
</html>