<?php
session_start();
$connect = mysqli_connect("localhost", "root", "juanses23", "malekith");

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el nombre de la categoría
    $nombre_categoria = mysqli_real_escape_string($connect, $_POST['nombre_categoria']);
    
    // Validar que el campo no esté vacío
    if (!empty($nombre_categoria)) {
        // Insertar la nueva categoría en la base de datos
        $query = "INSERT INTO categoria (nombre_categoria) VALUES ('$nombre_categoria')";
        if (mysqli_query($connect, $query)) {
            echo "<p style='color: green;'>Categoría agregada exitosamente.</p>";
        } else {
            echo "<p style='color: red;'>Error: No se pudo agregar la categoría.</p>";
        }
    } else {
        echo "<p style='color: red;'>Por favor ingresa un nombre para la categoría.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nueva Categoría</title>
    <link rel="stylesheet" href="../css/estilo-interfaz.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="../agregar/agregar.php">Inicio</a></li>
                <li><a href="../html/crear_categoria.php">Crear Categoría</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="add-product">
            <h2>Agregar Nueva Categoría</h2>
            <form method="post" action="">
                <label for="nombre_categoria">Nombre de la Categoría:</label>
                <input type="text" name="nombre_categoria" id="nombre_categoria" required>
                <input type="submit" value="Agregar Categoría">
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Maxiaseo. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
