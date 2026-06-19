<?php
// 1. Conectamos a la base de datos
include 'includes/db.php';

// 2. Verificamos si recibimos el ID del producto por la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 3. Ejecutamos la orden de eliminación en MySQL
    $sql = "DELETE FROM productos WHERE id = $id";

    if ($conexion->query($sql) === TRUE) {
        // 4. Si se borra con éxito, regresamos al panel automáticamente
        header("Location: index.php");
        exit();
    } else {
        echo "Error al eliminar el producto: " . $conexion->error;
    }
} else {
    // Si no hay ID, volvemos al inicio por seguridad
    header("Location: index.php");
    exit();
}
?>