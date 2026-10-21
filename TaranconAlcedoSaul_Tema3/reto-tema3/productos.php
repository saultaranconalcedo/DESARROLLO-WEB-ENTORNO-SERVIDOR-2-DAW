<?php
require_once 'datos.php';
require_once 'funciones.php';

// Recojo parametros del buscador GET
$nombre = trim($_GET['nombre'] ?? '');
$categoria = trim($_GET['categoria'] ?? '');
$precio_max = trim($_GET['precio_max'] ?? '');

// Filtro la lista
$lista = filtrarProductos($productos, $nombre, $categoria, $precio_max);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body class="bg-light p-4">

<div class="container" style="max-width: 900px;">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Catálogo de Productos</h2>
        <div>
            <a href="nuevo.php" class="btn btn-success btn-sm">+ Nuevo Producto</a>
            <a href="index.php" class="btn btn-secondary btn-sm">Inicio</a>
        </div>
    </div>

    <!-- BUSCADOR CON GET -->
    <div class="card p-3 mb-4 shadow-sm">
        <h5 class="card-title mb-3">Buscador de Productos</h5>
        <form method="GET" action="productos.php" class="row g-2">
            <div class="col-md-4">
                <input type="text" name="nombre" class="form-control" placeholder="Nombre..." value="<?= htmlspecialchars($nombre) ?>">
            </div>
            <div class="col-md-3">
                <select name="categoria" class="form-select">
                    <option value="">Todas las Categorías</option>
                    <option value="Portátiles" <?= $categoria === 'Portátiles' ? 'selected' : '' ?>>Portátiles</option>
                    <option value="Monitores" <?= $categoria === 'Monitores' ? 'selected' : '' ?>>Monitores</option>
                    <option value="Periféricos" <?= $categoria === 'Periféricos' ? 'selected' : '' ?>>Periféricos</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="number" step="any" name="precio_max" class="form-control" placeholder="Precio Máx (€)" value="<?= htmlspecialchars($precio_max) ?>">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Buscar</button>
            </div>
        </form>
        <div class="mt-2">
            <a href="productos.php" class="text-decoration-none small text-muted">Limpiar filtros</a>
        </div>
    </div>

    <!-- TABLA DE PRODUCTOS -->
    <?php if (!empty($lista)): ?>
        <table class="table table-bordered table-hover bg-white shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>PRODUCTO</th>
                    <th>CATEGORÍA</th>
                    <th>PRECIO</th>
                    <th>STOCK</th>
                    <th>ACCIÓN</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lista as $p): ?>
                    <tr>
                        <td><?= $p['id'] ?></td>
                        <td><strong><?= htmlspecialchars($p['nombre']) ?></strong></td>
                        <td><?= htmlspecialchars($p['categoria']) ?></td>
                        <td><?= number_format($p['precio'], 2) ?> €</td>
                        <td><?= $p['stock'] ?></td>
                        <td>
                            <a href="detalle.php?id=<?= $p['id'] ?>" class="btn btn-info btn-sm text-white">Ver detalle</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-warning">No se han encontrado productos que coincidan con la búsqueda.</div>
    <?php endif; ?>
</div>

</body>
</html>