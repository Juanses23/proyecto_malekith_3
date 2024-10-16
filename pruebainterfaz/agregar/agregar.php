<?php
$connect = mysqli_connect("localhost", "root", "juanses23", "malekith");

// Verifica la conexión
if (!$connect) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Consulta para obtener las categorías
$categoryQuery = "SELECT id_categoria, nombre_categoria FROM categoria";
$categoryResult = mysqli_query($connect, $categoryQuery);
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
                <h1>Maxiaseo Admin</h1>
            </ul>
            <ul class="right">
                <li><a href="carrito.php">Elementos</a></li>
                <li><a href="../agregar/crear_categoria.php">Categorias</a></li>
                <li><a href="../agregar/listar_usuarios.php">ModificarUsuarios</a></li>
                <?php if(isset($_SESSION['usuario'])): ?>
                    <li><a href="#"><?php echo htmlspecialchars($_SESSION['usuario']); ?> <img src="../icon/iniciosesion.png" alt="icono foto" class="icono"></a></li>
                    <li><a href="/proyecto_malekith_3/login/php/logout.php">Cerrar sesión</a></li>
                <?php else: ?>
                    <li><a href="/proyecto_malekith_3/login/php/index.php">Iniciar sesión <img src="../icon/iniciosesion.png" alt="icono foto" class="icono"></a></li>
                <?php endif; ?>
            </ul>
            
        </nav>
    </header>
    <main>
        <section class="add-product">
            <h2>Agregar Nuevo Producto</h2>
            <form action="agregar_producto.php" method="post" enctype="multipart/form-data">
                <label for="descripcion">Descripción:</label>
                <input type="text" name="descripcion" id="descripcion" required>
        
                <label for="cantidad">Cantidad:</label>
                <input type="number" name="cantidad" id="cantidad" required>
        
                <label for="precio">Precio:</label>
                <input type="number" name="precio" id="precio" required>

                <label for="imagen">Imagen:</label>
                <input type="file" name="imagen" id="imagen" accept="image/*" required>

                <label for="categoria">Categoría:</label>
                <select name="categoria" id="categoria" required>
                    <option value="">Selecciona una categoría</option>
                    <?php
                    // Iterar a través de los resultados de las categorías y agregarlos al menú desplegable
                    while ($row = mysqli_fetch_assoc($categoryResult)) {
                        echo "<option value='" . $row['id_categoria'] . "'>" . $row['nombre_categoria'] . "</option>";
                    }
                    ?>
                </select>

                <input type="submit" name="submit" value="Agregar Producto">
            </form>

        </section>
        <section class="product-list">
            <?php
            $query = "SELECT * FROM producto";
            $result = mysqli_query($connect, $query);

            while ($row = mysqli_fetch_array($result)) { ?>
                <form method="post" action="carrito.php?id=<?= $row['id_producto'] ?>" class="product">
                    <img src="../img/<?= $row['imagen'] ?>" alt="">
                    <h2><?= $row['descripcion_producto']; ?></h2>
                    <h2 class="canti">Cantidad: <?= $row['cantidad_producto']; ?></h2>
                    <input type="number" name="cantidad" value="1" class="quantity" min="1" max="<?= $row['cantidad_producto']; ?>">
                    <input type="hidden" name="nombre" value="<?= $row['descripcion_producto']; ?>">
                    <input type="hidden" name="precio" value="<?= $row['valor_producto']; ?>">
                    <input type="submit" name="add_to_cart" class="btn" value="Agregar elementos">
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
