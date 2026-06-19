
<?php
//coneccion a mysql 
$servidor = "localhost";
$usuario = "root";
$clave = ""; // En XAMPP viene vacío por defecto
$base_datos = "zyrox_sport"; // El nombre exacto que se ve en tu phpMyAdmin

$conexion = new mysqli($servidor, $usuario, $clave, $base_datos);

// Para que se muestren bien las tildes y las Ñs
$conexion->set_charset("utf8");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>