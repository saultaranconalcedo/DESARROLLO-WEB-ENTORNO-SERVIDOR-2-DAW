<?php
require_once 'funciones.php';

$datos = [
    'nombre' => '',
    'categoria' => '',
    'precio' => '',
    'stock' => '',
    'descripcion' => ''
];
$errores = [];
$exito = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = $_POST;
    
    // Validar en servidor mediante PHP
    $errores = validarProducto($datos);

    if (empty($errores)) {
        $exito = true;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alta de Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body class="bg-light p-4">

<div class="container" style="max-width: 650px;">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Alta de Nuevo Producto</h4>
        </div>
        <div class="card-body">

            <!-- ERROR DE VALIDACIÓN (CAPTURA 2) -->
            <?php if (!empty($errores)): ?>
                <div class="alert alert-danger">
                    <h5 class="alert-heading">Revisa los siguientes errores:</h5>
                    <ul class="mb-0">
                        <?php foreach ($errores as $err): ?>
                            <li><?= htmlspecialchars($err) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- ALTA CORRECTA (CAPTURA 3) -->
            <?php if ($exito): ?>
                <div class="alert alert-success">
                    <h4 class="alert-heading">PRODUCTO REGISTRADO CORRECTAMENTE</h4>
                    <hr>
                    <p class="mb-1"><strong>Nombre:</strong> <?= htmlspecialchars($datos['nombre']) ?></p>
                    <p class="mb-1"><strong>Categoría:</strong> <?= htmlspecialchars($datos['categoria']) ?></p>
                    <p class="mb-1"><strong>Precio:</strong> <?= number_format($datos['precio'], 2) ?> €</p>
                    <p class="mb-1"><strong>Stock:</strong> <?= $datos['stock'] ?> unidades</p>
                    <p class="mb-0"><strong>Descripción:</strong> <?= htmlspecialchars($datos['descripcion']) ?></p>
                </div>
            <?php endif; ?>

            <!-- FORMULARIO DE ALTA (POST) -->
            <form method="POST" action="nuevo.php">
                <div class="mb-3">
                    <label class="form-label">Nombre del producto *</label>
                    <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($datos['nombre']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Categoría *</label>
                    <select name="categoria" class="form-select" required>
                        <option value="">Selecciona una categoría</option>
                        <option value="Portátiles" <?= $datos['categoria'] === 'Portátiles' ? 'selected' : '' ?>>Portátiles</option>
                        <option value="Monitores" <?= $datos['categoria'] === 'Monitores' ? 'selected' : '' ?>>Monitores</option>
                        <option value="Periféricos" <?= $datos['categoria'] === 'Periféricos' ? 'selected' : '' ?>>Periféricos</option>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Precio (€) *</label>
                        <input type="number" step="0.01" min="0.01" name="precio" class="form-control" value="<?= htmlspecialchars($datos['precio']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stock *</label>
                        <input type="number" min="0" name="stock" class="form-control" value="<?= htmlspecialchars($datos['stock']) ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Descripción *</label>
                    <textarea name="descripcion" class="form-control" rows="3" required><?= htmlspecialchars($datos['descripcion']) ?></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="productos.php" class="btn btn-secondary">Volver al catálogo</a>
                    <button type="submit" class="btn btn-success fw-bold">Guardar Producto</button>
                </div>
            </form>

        </div>
    </div>
</div>

</body>
</html>