<?php
session_start();
$connect = mysqli_connect("localhost", "root", "juanses23", "malekith");

// Obtener el ID de la categoría seleccionada
$categoriaSeleccionada = isset($_GET['categoria']) ? (int)$_GET['categoria'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Maxiaseo</title>
    <link rel="stylesheet" href="../css/estilo-interfaz.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <h1>Maxiaseo</h1>
            </ul>
            <ul class="right">
                <li><a href="carrito.php">Carrito <img src="../icon/carrito-de-compras.png" alt="Carrito" class="icono"></a></li>
                <?php if(isset($_SESSION['usuario'])): ?>
                    <li><a href="#"><?php echo htmlspecialchars($_SESSION['usuario']); ?> <img src="../icon/iniciosesion.png" alt="icono foto" class="icono"></a></li>
                    <li><a href="/proyecto_malekith_3/login/php/logout.php">Cerrar sesión</a></li>
                <?php else: ?>
                    <li><a href="/proyecto_malekith_3/login/php/index.php">Iniciar sesión <img src="../icon/iniciosesion.png" alt="icono foto" class="icono"></a></li>
                <?php endif; ?>
            </ul>

        </nav>
        <nav>
            <ul>
                <li><a href="../html/pagina-inicio.html">Inicio</a></li>
                <li><a href="/html/error-404.html">Contacto</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <section class="filter-buttons">
            <form method="get" action="">
                <button type="submit" name="categoria" value="0">Todas</button>
                <?php
                // Obtener categorías desde la base de datos
                $catQuery = "SELECT * FROM categoria";
                $catResult = mysqli_query($connect, $catQuery);
                while ($catRow = mysqli_fetch_array($catResult)) {
                    echo '<button type="submit" name="categoria" value="' . $catRow['id_categoria'] . '">' . $catRow['nombre_categoria'] . '</button>';
                }
                ?>
            </form>
        </section>
        <section class="product-list">
            <?php
            // Filtrar productos por categoría
            $query = "SELECT * FROM producto";
            if ($categoriaSeleccionada > 0) {
                $query .= " WHERE id_categoria = $categoriaSeleccionada";
            }
            $result = mysqli_query($connect, $query);

            // Mostrar productos
            while ($row = mysqli_fetch_array($result)) { ?>
                <form method="post" action="carrito.php?id=<?= $row['id_producto'] ?>" class="product">
                    <img src="../img/<?= $row['imagen'] ?>" alt="">
                    <h2><?= $row['descripcion_producto']; ?></h2>
                    <span>$<?= number_format($row['valor_producto'], 2); ?></span>
                    <div class="input-box">
                        <select name="cantidad" class="quantity" required>
                            <?php
                                $maxCantidad = $row['cantidad_producto']; // Valor máximo de cantidad
                                for ($i = 1; $i <= $maxCantidad; $i++) {
                                    echo "<option value='$i'>$i</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <input type="hidden" name="nombre" value="<?= $row['descripcion_producto']; ?>">
                    <input type="hidden" name="precio" value="<?= $row['valor_producto']; ?>">
                    <input type="submit" name="add_to_cart" class="btn" value="Añadir al carrito">
                    <p>.</p>
                    <p>.</p>
                    <p>.</p>
                    <p>.</p>
                    <p>.</p>
                </form>
            <?php } ?>
        </section>
    </main>
    <footer>
        <h2>Sobre Nosotros</h2>
        <p>Maxiaseo es una empresa que distribuye productos de aseo para que tú y tu casa siempre mantengan aseados.</p>
        <p>Síguenos en nuestras redes sociales:</p>
        <div class="social-media">
            <a href="https://www.instagram.com"><img src="../icon/logotipo-de-instagram.png" alt="Instagram" class="icono"></a>
            <a href="https://www.facebook.com"><img src="../icon/facebook.png" alt="Facebook" class="icono"></a>
            <a href="https://www.twitter.com"><img src="../icon/gorjeo.png" alt="Twitter" class="icono"></a>
        </div>
        <p>Contacto: +57 123 456 7890</p>
        <p>&copy; 2024 Maxiaseo. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
