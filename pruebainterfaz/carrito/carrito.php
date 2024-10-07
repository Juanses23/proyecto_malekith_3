<?php
session_start();
$connect = mysqli_connect("localhost", "root", "juanses23", "malekith");

// Agregar productos al carrito
if (isset($_POST['add_to_cart'])) {
    $id_producto = $_GET['id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }

    $producto_existente = false;
    foreach ($_SESSION['carrito'] as &$producto) {
        if ($producto['id'] == $id_producto) {
            $producto['cantidad'] += $cantidad;
            $producto_existente = true;
            break;
        }
    }

    if (!$producto_existente) {
        $_SESSION['carrito'][] = array(
            'id' => $id_producto,
            'nombre' => $nombre,
            'precio' => $precio,
            'cantidad' => $cantidad
        );
    }

    header("Location: carrito.php");
    exit();
}

// Eliminar producto del carrito
if (isset($_GET['action']) && $_GET['action'] == 'remove') {
    $id_producto = $_GET['id'];
    foreach ($_SESSION['carrito'] as $key => $producto) {
        if ($producto['id'] == $id_producto) {
            unset($_SESSION['carrito'][$key]);
            $_SESSION['carrito'] = array_values($_SESSION['carrito']);
            break;
        }
    }
    header("Location: carrito.php");
    exit();
}

// Vaciar todo el carrito
if (isset($_GET['action']) && $_GET['action'] == 'clear') {
    unset($_SESSION['carrito']);
    header("Location: carrito.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="../css/estilo-carrito.css">
</head>
<body>
    <h1>Carrito de Compras</h1>
    <table>
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
            <th>Acción</th>
        </tr>

        <?php
        $total = 0;

        if (!empty($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $producto) {
                $subtotal = $producto['precio'] * $producto['cantidad'];
                $total += $subtotal;
                ?>

                <tr>
                    <td><?= $producto['nombre']; ?></td>
                    <td>$<?= number_format($producto['precio'], 2); ?></td>
                    <td><?= $producto['cantidad']; ?></td>
                    <td>$<?= number_format($subtotal, 2); ?></td>
                    <td>
                        <a href="carrito.php?action=remove&id=<?= $producto['id']; ?>" class="btn">Eliminar</a>
                    </td>
                </tr>

                <?php
            }
        } else {
            echo "<tr><td colspan='5'>El carrito está vacío</td></tr>";
        }
        ?>
    </table>

    <?php if (!empty($_SESSION['carrito'])): ?>
        <h2>Total: $<?= number_format($total, 2); ?></h2>

        <form method="post" action="pagar.php">
            <input type="submit" name="pagar" value="Pagar" class="btn">
        </form>

        <a href="carrito.php?action=clear" class="btn">Vaciar Carrito</a> <!-- Botón para vaciar el carrito -->
    <?php endif; ?>

    <a href="interfaz.php" class="btn">Volver a la Tienda</a>
</body>
</html>


