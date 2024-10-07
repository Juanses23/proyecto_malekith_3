<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $server = "localhost";
    $user = "root";
    $pass = "juanses23";
    $db = "malekith";

    $conexion = new mysqli($server, $user, $pass, $db);

    if ($conexion->connect_errno) {
        die("Conexión Fallida: " . $conexion->connect_error);
    }

    $contra1 = isset($_POST['contra1']) ? $_POST['contra1'] : '';
    $contra2 = isset($_POST['contra2']) ? $_POST['contra2'] : '';
    $email = $_SESSION['usuario'];

    if ($contra1 && $contra1 === $contra2) {
        // Almacena la contraseña directamente, sin encriptación
        $sql = "UPDATE usuario SET passsword='$contra1' WHERE email='$email'";
        
        if ($conexion->query($sql) === TRUE) {
            $success = "Contraseña actualizada con éxito.";
        } else {
            $error = "Error al actualizar la contraseña: " . $conexion->error;
        }
    } else {
        $error = "Las contraseñas no coinciden o no se han enviado. Inténtalo de nuevo.";
    }

    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva contraseña</title>
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>
    <section class="form-main">
        <div class="form-content">
            <div class="box">
                <h3>Escribe tu nueva contraseña</h3>
                <form action="" method="POST" id="form">
                    <div class="input-box">
                        <input type="password" placeholder="Contraseña" id="contra1" name="contra1" class="input-control" required>
                    </div>
                    <div class="input-box">
                        <input type="password" placeholder="Repetir Contraseña" id="contra2" name="contra2" class="input-control" required>
                    </div>
                    <button type="submit" class="btn">Enviar</button>
                    <?php if (isset($error) || isset($success)) : ?>
                        <div id="message" class="gradient-text">
                            <?php 
                            if (isset($error)) echo $error;
                            if (isset($success)) echo $success;
                            ?>
                        </div>
                    <?php endif; ?>
                    
                </form>
                <form action="index.php">
                    <button type="submit" class="btn">Volver al inicio</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>

