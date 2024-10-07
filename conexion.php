<?php

$server = "localhost";
$user = "root";
$pass = "";
$db = "malekith";


$conexion = new mysqli($server, $user, $pass, $db);

if ($conexion->connect_errno){
    die("Conexion Fallida" . $conexion_errno);
}else{
    echo"Conectado";
}
?>