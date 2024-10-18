<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "juanses23";
$database = "Malekith";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Si el formulario se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre_proveedor"];
    $email = $_POST["email"];
    $razon_social = $_POST["razon_social"];
    $nit = $_POST["nit"];
    $telefono = $_POST["telefono"];

    // Insertar proveedor en la base de datos
    $sql = "INSERT INTO Proveedor (nombre_proveedor, email, razon_social, nit, telefono) 
            VALUES ('$nombre', '$email', '$razon_social', '$nit', '$telefono')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo proveedor añadido correctamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Añadir Proveedor</title>
    <link rel="stylesheet" href="../css/proveedores.css">
</head>
<body>
    <h1>Añadir Nuevo Proveedor</h1>
    <form action="agregar_proveedor.php" method="POST">
        <label for="nombre_proveedor">Nombre Proveedor:</label><br>
        <input type="text" id="nombre_proveedor" name="nombre_proveedor" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br><br>

        <label for="razon_social">Razón Social:</label><br>
        <input type="text" id="razon_social" name="razon_social"><br><br>

        <label for="nit">NIT:</label><br>
        <input type="text" id="nit" name="nit"><br><br>

        <label for="telefono">Teléfono:</label><br>
        <input type="text" id="telefono" name="telefono"><br><br>

        <input type="submit" value="Añadir Proveedor">
    </form>
    <br>
    <a href="listar_proveedores.php">Volver a la lista de proveedores</a>
</body>
</html>
