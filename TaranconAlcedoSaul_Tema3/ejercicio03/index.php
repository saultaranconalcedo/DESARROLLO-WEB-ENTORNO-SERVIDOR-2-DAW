<?php
// Cargo las funciones
require_once 'funciones.php';

$datos = [
    'nombre' => '',
    'email' => '',
    'empresa' => '',
    'asunto' => '',
    'descripcion' => '',
    'prioridad' => 'Media',
    'categoria' => 'Aplicación web'
];
$errores = [];
$incidenciaRegistrada = null;

// Si envian el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = $_POST;

    // Valido todo usando la funcion de funciones.php
    $errores = validarFormulario($datos);

    // Si todo esta limpio creo la incidencia
    if (empty($errores)) {
        $incidenciaRegistrada = mostrarIncidencia($datos);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 3 - Registro de Incidencias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body class="bg-light p-4">

<div class="container" style="max-width: 750px;">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-warning text-dark fw-bold">
            <h4 class="mb-0">Registro de Incidencias</h4>
        </div>
        <div class="card-body">

            <!-- Lista de errores si algo falla -->
            <?php if (!empty($errores)): ?>
                <div class="alert alert-danger">
                    <h5 class="alert-heading">Errores detectados:</h5>
                    <ul class="mb-0">
                        <?php foreach ($errores as $err): ?>
                            <li><?= htmlspecialchars($err) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Resultado verde cuando todo esta bien -->
            <?php if ($incidenciaRegistrada): ?>
                <div class="alert alert-success">
                    <h4 class="alert-heading font-monospace fw-bold">INCIDENCIA REGISTRADA</h4>
                    <hr>
                    <p class="mb-1"><strong>ID:</strong> <?= $incidenciaRegistrada['id'] ?></p>
                    <p class="mb-1"><strong>Fecha:</strong> <?= $incidenciaRegistrada['fecha'] ?></p>
                    <p class="mb-1"><strong>Cliente:</strong> <?= htmlspecialchars($incidenciaRegistrada['cliente']) ?> (<?= htmlspecialchars($incidenciaRegistrada['empresa']) ?>)</p>
                    <p class="mb-1"><strong>Email:</strong> <?= htmlspecialchars($incidenciaRegistrada['email']) ?></p>
                    <p class="mb-1"><strong>Asunto:</strong> <?= htmlspecialchars($incidenciaRegistrada['asunto']) ?></p>
                    <p class="mb-1"><strong>Prioridad:</strong> <span class="badge bg-danger"><?= $incidenciaRegistrada['prioridad'] ?></span></p>
                    <p class="mb-1"><strong>Categoría:</strong> <?= $incidenciaRegistrada['categoria'] ?></p>
                    <p class="mb-1"><strong>Estado:</strong> <span class="badge bg-warning text-dark"><?= $incidenciaRegistrada['estado'] ?></span></p>
                    <hr>
                    <p class="mb-0"><strong>Descripción:</strong><br><?= nl2br(htmlspecialchars($incidenciaRegistrada['descripcion'])) ?></p>
                </div>
            <?php endif; ?>

            <!-- Formulario POST -->
            <form method="POST" action="index.php">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nombre del cliente *</label>
                        <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($datos['nombre'] ?? '') ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Correo electrónico *</label>
                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($datos['email'] ?? '') ?>" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Empresa *</label>
                        <input type="text" name="empresa" class="form-control" value="<?= htmlspecialchars($datos['empresa'] ?? '') ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Asunto *</label>
                        <input type="text" name="asunto" class="form-control" value="<?= htmlspecialchars($datos['asunto'] ?? '') ?>" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Prioridad *</label>
                        <select name="prioridad" class="form-select">
                            <?php foreach (['Baja', 'Media', 'Alta', 'Crítica'] as $p): ?>
                                <option value="<?= $p ?>" <?= ($datos['prioridad'] ?? '') === $p ? 'selected' : '' ?>><?= $p ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Categoría *</label>
                        <select name="categoria" class="form-select">
                            <?php foreach (['Aplicación web', 'Servidor', 'Base de datos', 'Red', 'Cuenta de usuario', 'Otra'] as $cat): ?>
                                <option value="<?= $cat ?>" <?= ($datos['categoria'] ?? '') === $cat ? 'selected' : '' ?>><?= $cat ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Descripción de la incidencia *</label>
                    <textarea name="descripcion" class="form-control" rows="4" required><?= htmlspecialchars($datos['descripcion'] ?? '') ?></textarea>
                </div>

                <button type="submit" class="btn btn-warning w-100 fw-bold">Registrar Incidencia</button>
            </form>

        </div>
    </div>
</div>

</body>
</html>