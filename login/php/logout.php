<?php
session_start();
session_unset(); // Elimina todas las variables de sesión
session_destroy(); // Destruye la sesión
header("Location: /proyecto_malekith_3/pruebainterfaz/carrito/interfaz.php"); // Redirige a la página de inicio de sesión
exit();
?>
