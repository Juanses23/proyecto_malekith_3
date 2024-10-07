<?php
session_start();
$connect = mysqli_connect("localhost", "root", "juanses23", "malekith");

if (isset($_POST['pagar'])) {
    if (!empty($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $producto) {
            $id_producto = $producto['id'];
            $cantidad_comprada = $producto['cantidad'];

            // Obtener la cantidad actual en inventario
            $query = "SELECT cantidad_producto FROM producto WHERE id_producto = $id_producto";
            $result = mysqli_query($connect, $query);
            $row = mysqli_fetch_assoc($result);
            $cantidad_actual = $row['cantidad_producto'];

            // Actualizar la cantidad en inventario
            $nueva_cantidad = $cantidad_actual + $cantidad_comprada;
            if ($nueva_cantidad >= 0) {
                $update_query = "UPDATE producto SET cantidad_producto = $nueva_cantidad WHERE id_producto = $id_producto";
                mysqli_query($connect, $update_query);
            } else {
                echo "<p class='error-message'>No hay suficiente stock para el producto: " . $producto['nombre'] . "</p>";
            }
        }

        // Limpiar el carrito después de pagar
        $_SESSION['carrito'] = array();
        echo "<p class='message'>Compra realizada con éxito.</p>";
    } else {
        echo "<p class='error-message'>El carrito está vacío.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagar</title>
    <link rel="stylesheet" href="../css/estilo-carrito.css">
</head>
<body>
    <h1>Proceso de Pago</h1>

    <?php if (!empty($_SESSION['carrito'])): ?>
        <p class="message">Gracias por tu compra. Los productos han sido descontados del inventario.</p>
    <?php else: ?>
        <p class="error-message">No hay productos en tu carrito.</p>
    <?php endif; ?>

    <a href="agregar.php" class="btn">Volver a la Tienda</a>
</body>
</html>


