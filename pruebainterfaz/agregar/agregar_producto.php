<?php
$connect = mysqli_connect("localhost", "root", "juanses23", "malekith");

if (isset($_POST['submit'])) {
    $descripcion = mysqli_real_escape_string($connect, $_POST['descripcion']);
    $cantidad = (int)$_POST['cantidad'];
    $precio = (float)$_POST['precio'];
    
    $imagen = $_FILES['imagen']['name'];
    $target = "../img/" . basename($imagen);

    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target)) {
        $query = "INSERT INTO producto (descripcion_producto, cantidad_producto, valor_producto, imagen) 
                  VALUES ('$descripcion', '$cantidad', '$precio', '$imagen')";

        if (mysqli_query($connect, $query)) {
            echo "Producto agregado con éxito.";
        } else {
            echo "Error al agregar el producto: " . mysqli_error($connect);
        }
    } else {
        echo "Error al cargar la imagen.";
    }
}

mysqli_close($connect);
?>

