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

// Enlace para añadir nuevos proveedores
echo "<h1>Lista de Proveedores</h1>";
echo '<a href="agregar_proveedor.php" style="display: inline-block; margin-bottom: 20px; padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">Añadir Nuevo Proveedor</a>';
echo '<a href="agregar.php" style="display: inline-block; margin-bottom: 20px; padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">Volver</a>';

// Consulta para obtener todos los proveedores
$sql = "SELECT * FROM Proveedor";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Crear una tabla HTML para mostrar los resultados
    echo "<table border='1'>";
    echo "<tr><th>ID Proveedor</th><th>Nombre</th><th>Email</th><th>Razón Social</th><th>NIT</th><th>Teléfono</th></tr>";
    
    // Recorrer los resultados
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id_proveedor"] . "</td>";
        echo "<td>" . $row["nombre_proveedor"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["razon_social"] . "</td>";
        echo "<td>" . $row["nit"] . "</td>";
        echo "<td>" . $row["telefono"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No hay proveedores disponibles.";
}

// Cerrar conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/ag_usuarios.css">
</head>
<body>
    
</body>
</html>