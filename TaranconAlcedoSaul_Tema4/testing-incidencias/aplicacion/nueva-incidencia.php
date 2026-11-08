<?php
require_once 'funciones.php';
comprobarRolPermitido(['Cliente', 'Administrador']);

$errores = [];
$usuarios = obtenerUsuariosPrueba();
$clientes = array_filter($usuarios, function ($usuario) {
    return $usuario['rol'] === 'Cliente';
});
$tecnicos = array_filter($usuarios, function ($usuario) {
    return $usuario['rol'] === 'Técnico';
});
$valores = ['titulo' => '', 'descripcion' => '', 'prioridad' => 'Media'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $valores['titulo'] = trim($_POST['titulo'] ?? '');
    $valores['descripcion'] = trim($_POST['descripcion'] ?? '');
    $valores['prioridad'] = $_POST['prioridad'] ?? '';
    $cliente = $_SESSION['rol'] === 'Cliente' ? $_SESSION['usuario'] : ($_POST['cliente'] ?? '');
    $tecnico = $_POST['tecnico'] ?? '';

    if ($valores['titulo'] === '') {
        $errores[] = 'El título es obligatorio.';
    }
    if ($valores['descripcion'] === '') {
        $errores[] = 'La descripción es obligatoria.';
    }
    if (!in_array($valores['prioridad'], ['Baja', 'Media', 'Alta'], true)) {
        $errores[] = 'Selecciona una prioridad válida.';
    }
    if (!isset($usuarios[$cliente]) || $usuarios[$cliente]['rol'] !== 'Cliente') {
        $errores[] = 'Selecciona un cliente válido.';
    }
    if ($tecnico !== '' && (!isset($usuarios[$tecnico]) || $usuarios[$tecnico]['rol'] !== 'Técnico')) {
        $errores[] = 'Selecciona un técnico válido.';
    }

    if ($errores === []) {
        $ids = array_column($_SESSION['incidencias'], 'id');
        $_SESSION['incidencias'][] = [
            'id' => $ids === [] ? 1 : max($ids) + 1,
            'titulo' => $valores['titulo'],
            'descripcion' => $valores['descripcion'],
            'cliente' => $cliente,
            'tecnico' => $tecnico,
            'prioridad' => $valores['prioridad'],
            'estado' => 'Abierta',
            'fecha' => date('Y-m-d'),
            'observaciones' => '',
        ];
        header('Location: incidencias.php');
        exit;
    }
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nueva incidencia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<main class="container py-4">
    <div class="card shadow-sm mx-auto" style="max-width: 760px">
        <div class="card-header"><h1 class="h4 mb-0">Registrar incidencia</h1></div>
        <div class="card-body">
            <?php if ($errores !== []): ?>
                <div class="alert alert-danger"><ul class="mb-0"><?php foreach ($errores as $error): ?><li><?= escapar($error) ?></li><?php endforeach; ?></ul></div>
            <?php endif; ?>
            <form method="post">
                <div class="mb-3">
                    <label class="form-label" for="titulo">Título</label>
                    <input class="form-control" id="titulo" name="titulo" value="<?= escapar($valores['titulo']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="descripcion">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required><?= escapar($valores['descripcion']) ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="prioridad">Prioridad</label>
                    <select class="form-select" id="prioridad" name="prioridad">
                        <?php foreach (['Baja', 'Media', 'Alta'] as $prioridad): ?>
                            <option value="<?= $prioridad ?>" <?= $valores['prioridad'] === $prioridad ? 'selected' : '' ?>><?= $prioridad ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <?php if ($_SESSION['rol'] === 'Administrador'): ?>
                    <div class="mb-3">
                        <label class="form-label" for="cliente">Cliente</label>
                        <select class="form-select" id="cliente" name="cliente" required>
                            <?php foreach ($clientes as $usuario => $datos): ?>
                                <option value="<?= escapar($usuario) ?>" <?= ($_POST['cliente'] ?? '') === $usuario ? 'selected' : '' ?>><?= escapar($datos['nombre']) ?> (<?= escapar($usuario) ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="tecnico">Técnico (opcional)</label>
                        <select class="form-select" id="tecnico" name="tecnico">
                            <option value="">Sin asignar</option>
                            <?php foreach ($tecnicos as $usuario => $datos): ?>
                                <option value="<?= escapar($usuario) ?>" <?= ($_POST['tecnico'] ?? '') === $usuario ? 'selected' : '' ?>><?= escapar($datos['nombre']) ?> (<?= escapar($usuario) ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php endif; ?>
                <button class="btn btn-success" type="submit">Guardar incidencia</button>
                <a class="btn btn-outline-secondary" href="incidencias.php">Cancelar</a>
            </form>
        </div>
    </div>
</main>
</body>
</html>
