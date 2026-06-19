<?php
// 1. Incluimos la conexión a la base de datos
include 'includes/db.php';

// 2. Procesamos los datos cuando el usuario presiona "Guardar"
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_COGNIZANT_AQUI_PROTECT = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $talla = $_POST['talla'];
    $stock = $_POST['stock'];

    // Insertamos los datos de forma limpia adaptada a tus columnas de phpMyAdmin
    $sql = "INSERT INTO productos (nombre, categoria, talla, stock) VALUES ('$nombre', '$categoria', '$talla', '$stock')";

    if ($conexion->query($sql) === TRUE) {
        // Si se guarda con éxito, nos redirige automáticamente a la tabla principal
        header("Location: index.php");
        exit();
    } else {
        echo "Error al guardar el producto: " . $conexion->error;
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zyrox Sport - Agregar Producto</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
</head>

<body>

    <div class="container">
        <aside class="sidebar">
            <div class="logo-container">
                <div class="logo-icon">▲</div>
                <h2>ZYROX SPORT</h2>
            </div>
            <nav class="menu">
                <a href="index.php" class="menu-item"><span class="material-icons-outlined">dashboard</span>
                    Dashboard</a>
                <div class="menu-group active">
                    <a href="#" class="menu-item main-group">
                        <span class="material-icons-outlined">inventory_2</span> Inventario
                    </a>
                    <div class="submenu">
                        <a href="index.php" class="submenu-item">Productos</a>
                        <a href="#" class="submenu-item active">Agregar Producto</a>
                    </div>
                </div>
            </nav>
        </aside>

        <main class="main-content">
            <section class="product-management" style="margin-top: 40px; max-width: 600px;">
                <div class="section-header">
                    <h3>Agregar Nuevo Producto</h3>
                    <a href="index.php" class="btn-volver" style="color: #00b4d8; text-decoration: none;">← Volver</a>
                </div>

                <form action="agregar_producto.php" method="POST" style="margin-top: 20px;">

                    <div class="form-group" style="margin-bottom: 15px;">
                        <label style="display:block; margin-bottom:5px; color:#a0aec0;">Nombre del Producto</label>
                        <input type="text" name="nombre" placeholder="Ej: Jogger Deportivo" required
                            style="width:100%; padding:10px; background:#1a202c; border:1px solid #2d3748; color:#fff; border-radius:5px;">
                    </div>

                    <div class="form-group" style="margin-bottom: 15px;">
                        <label style="display:block; margin-bottom:5px; color:#a0aec0;">Categoría</label>
                        <input type="text" name="categoria" placeholder="Ej: Pantalones" required
                            style="width:100%; padding:10px; background:#1a202c; border:1px solid #2d3748; color:#fff; border-radius:5px;">
                    </div>

                    <div class="form-row" style="display: flex; gap: 15px; margin-bottom: 20px;">
                        <div class="form-group" style="flex: 1;">
                            <label style="display:block; margin-bottom:5px; color:#a0aec0;">Talla</label>
                            <select name="talla"
                                style="width:100%; padding:10px; background:#1a202c; border:1px solid #2d3748; color:#fff; border-radius:5px;">
                                <option value="S">S</option>
                                <option value="M" selected>M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                            </select>
                        </div>
                        <div class="form-group" style="flex: 1;">
                            <label style="display:block; margin-bottom:5px; color:#a0aec0;">Stock Inicial</label>
                            <input type="number" name="stock" placeholder="Ej: 10" required
                                style="width:100%; padding:10px; background:#1a202c; border:1px solid #2d3748; color:#fff; border-radius:5px;">
                        </div>
                    </div>

                    <button type="submit" class="card-icon green"
                        style="border:none; width:100%; padding:12px; color:#fff; font-weight:bold; border-radius:5px; cursor:pointer;">
                        Guardar Producto en Inventario
                    </button>
                </form>
            </section>
        </main>
    </div>

</body>

</html>