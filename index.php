<?php 
// Incluimos la conexión a la base de datos
include 'includes/db.php'; 

// Hacemos la consulta para traer los productos
$sql = "SELECT * FROM productos";
$resultado = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zyrox Sport - Inventario</title>
    
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
                <a href="#" class="menu-item">
                    <span class="material-icons-outlined">dashboard</span> Dashboard
                </a>
                <div class="menu-group active">
                    <a href="#" class="menu-item main-group">
                        <span class="material-icons-outlined">inventory_2</span> Inventario
                        <span class="material-icons-outlined arrow">expand_more</span>
                    </a>
                    <div class="submenu">
                        <a href="#" class="submenu-item active">Productos</a>
                        <a href="agregar_producto.php" class="submenu-item">Agregar productos</a>
                        <a href="#" class="submenu-item">Ventas</a>
                    </div>
                </div>
                <a href="#" class="menu-item">
                    <span class="material-icons-outlined">settings</span> Configuración
                </a>
                <a href="#" class="menu-item">
                    <span class="material-icons-outlined">calendar_today</span> Agenda
                </a>
            </nav>
        </aside>

        <main class="main-content">
            
            <header class="top-header">
                <span class="material-icons-outlined menu-toggle">menu</span>
                <div class="header-actions">
                    <span class="material-icons-outlined">help_outline</span>
                    <span class="material-icons-outlined">notifications</span>
                    <div class="user-avatar"></div>
                </div>
            </header>

            <section class="cards-grid">
                <div class="card">
                    <div class="card-info">
                        <p class="card-title">Total Productos</p>
                        <h3 class="card-value"><?php echo $resultado->num_rows; ?></h3>
                    </div>
                    <div class="card-icon blue">
                        <span class="material-icons-outlined">description</span>
                    </div>
                </div>
                <div class="card">
                    <div class="card-info">
                        <p class="card-title">Entradas Mes.</p>
                        <h3 class="card-value green">+450</h3>
                    </div>
                    <div class="card-icon green">
                        <span class="material-icons-outlined">file_upload</span>
                    </div>
                </div>
                <div class="card alert-card">
                    <div class="card-info">
                        <p class="card-title">Alertas Stock Bajo</p>
                        <h3 class="card-value red">3</h3>
                    </div>
                    <div class="card-icon red">
                        <span class="material-icons-outlined">warning</span>
                    </div>
                </div>
            </section>

            <section class="product-management">
                <div class="section-header">
                    <h3>Product Management</h3>
                    <div class="search-box">
                        <input type="text" placeholder="Buscar...">
                        <span class="material-icons-outlined">search</span>
                    </div>
                </div>

                <div class="table-container">
                    <table class="product-table">
                        <thead>
                            <tr>
                                <th><input type="checkbox"></th>
                                <th>Product</th>
                                <th>Nombre</th>
                                <th>Categoría</th>
                                <th>Talla</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            // Renderizado dinámico desde MySQL
                            if ($resultado->num_rows > 0) {
                                while($row = $resultado->fetch_assoc()) {
                                    // Asignar color dinámico al placeholder según el color guardado
                                    $color_producto = isset($row['color']) ? $row['color'] : 'No especificado';
                                    $bg_color = ($color_producto == 'Negro') ? 'black-bg' : 'teal-bg';
                            ?>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>
                                    <span class="text-muted">Color: <?php echo $color_producto; ?></span>
                                    <div class="product-img-placeholder <?php echo $bg_color; ?>"></div>
                                </td>
                                <td>
                                    <strong><?php echo $row['nombre']; ?></strong><br>
                                </td>
                                <td>
    <?php echo $row['categoria']; ?><br>
    <span class="text-muted">
        <?php echo isset($row['detalle_categoria']) ? $row['detalle_categoria'] : ''; ?>
    </span>
</td>
                                <td><?php echo strtoupper($row['talla']); ?></td>
                                <td><?php echo $row['stock']; ?></td>
                                <td>
                                    <span class="material-icons-outlined action-icon edit btn-editar">edit</span>
                                    <a href="eliminar_producto.php?id=<?php echo $row['id']; ?>" onclick="return confirm('¿Seguro que deseas eliminar este producto de Zyrox Sport?');" style="color: inherit; text-decoration: none;">
                                    <span class="material-icons-outlined action-icon delete">delete</span>
                                    </a>
                                </td>
                            </tr>
                            <?php 
                                }
                            } else {
                                echo "<tr><td colspan='7' style='text-align:center;'>No hay productos registrados</td></tr>";
                            }
                            ?>
                        </tbody>    
                    </table>
                </div>
            </section>

            <div class="sale-modal" style="display:none;"> <div class="modal-header">
                    <h4>Registrar Venta</h4>
                    <span class="material-icons-outlined close-icon btn-cerrar">close</span>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Producto ID</label>
                        <input type="text" value="Jogger Deportivo Zyrox 1000169559" readonly>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Talla</label>
                            <select>
                                <option>M</option>
                                <option>L</option>
                                <option>S</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Cantidad</label>
                            <input type="number" value="3">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span class="stock-preview">Stock Actualizado: 42</span>
                    </div>
                </div>
            </div>

        </main>
    </div>

</body>
<script src="assets/js/script.js"></script>
</html>
<?php $conexion->close(); // Cerramos la conexión ?>