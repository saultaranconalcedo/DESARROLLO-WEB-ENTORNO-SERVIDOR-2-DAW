<?php
// Necesito la lista de datos y las funciones
require_once 'datos.php';
require_once 'funciones.php';

// Cojo el ID que viene en la URL por GET (ejemplo: detalle.php?id=2)
$id = $_GET['id'] ?? null;

// Busco el producto especifico en la lista con mi funcion
$producto = obtenerProductoPorId($productos, $id);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ficha del Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body class="bg-light p-4">

<div class="container" style="max-width: 600px;">
    <!-- Si encontre el producto muestro su ficha -->
    <?php if ($producto): ?>
        <div class="card shadow-sm border-primary">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Ficha del Producto #<?= $producto['id'] ?></h4>
            </div>
            <div class="card-body">
                <h3 class="card-title text-primary mb-3"><?= htmlspecialchars($producto['nombre']) ?></h3>
                <p><strong>Categoría:</strong> <span class="badge bg-secondary"><?= htmlspecialchars($producto['categoria']) ?></span></p>
                <p><strong>Precio:</strong> <span class="fs-4 text-success fw-bold"><?= number_format($producto['precio'], 2) ?> €</span></p>
                <p><strong>Stock disponible:</strong> <?= $producto['stock'] ?> unidades</p>
                <hr>
                <h5>Descripción</h5>
                <p class="card-text text-muted"><?= htmlspecialchars($producto['descripcion']) ?></p>
            </div>
            <div class="card-footer text-end">
                <a href="productos.php" class="btn btn-secondary btn-sm">Volver al listado</a>
            </div>
        </div>
    <?php else: ?>
        <!-- Si han puesto un ID inventado muestro alerta de error -->
        <div class="alert alert-danger">
            <h4>Producto no encontrado</h4>
            <p>El producto especificado no existe.</p>
            <a href="productos.php" class="btn btn-secondary">Volver al catálogo</a>
        </div>
    <?php endif; ?>
</div>

</body>
</html>