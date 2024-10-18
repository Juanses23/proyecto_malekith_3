<?php

$server = "localhost";
$user = "root";
$pass = "juanses23";
$db = "malekith";


$conexion = new mysqli($server, $user, $pass, $db);
$conexion->set_charset("utf8");
?>