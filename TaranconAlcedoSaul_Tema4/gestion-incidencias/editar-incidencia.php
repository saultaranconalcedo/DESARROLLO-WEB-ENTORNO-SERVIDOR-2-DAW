<?php
require_once 'funciones.php';
comprobarRolPermitido(['Administrador', 'Técnico', 'Cliente']);

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$incidencia = $id ? buscarIncidencia($id) : null;
if ($incidencia === null) {
    http_response_code(404);
    exit('Incidencia no encontrada.');
}

$rol = $_SESSION['rol'];
$usuario = $_SESSION['usuario'];
if (($rol === 'Cliente' && $incidencia['cliente'] !== $usuario)
    || ($rol === 'Técnico' && $incidencia['tecnico'] !== $usuario)) {
    mostrarError403();
}

$estados = ['Abierta', 'En proceso', 'Resuelta', 'Cerrada'];
$prioridades = ['Baja', 'Media', 'Alta'];
$errores = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $estado = $_POST['estado'] ?? '';
    $prioridad = $_POST['prioridad'] ?? '';
    $observaciones = trim($_POST['observaciones'] ?? '');

    if (!in_array($estado, $estados, true)) {
        $errores[] = 'Selecciona un estado válido.';
    }
    if (!in_array($prioridad, $prioridades, true)) {
        $errores[] = 'Selecciona una prioridad válida.';
    }

    if ($errores === []) {
        foreach ($_SESSION['incidencias'] as &$registro) {
            if ((int) $registro['id'] === $id) {
                $registro['estado'] = $estado;
                $registro['prioridad'] = $prioridad;
                $registro['observaciones'] = $observaciones;
                break;
            }
        }
        unset($registro);
        header('Location: detalle-incidencia.php?id=' . $id);
        exit;
    }
    $incidencia['estado'] = $estado;
    $incidencia['prioridad'] = $prioridad;
    $incidencia['observaciones'] = $observaciones;
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar incidencia #<?= (int) $id ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<main class="container py-4">
    <div class="card shadow-sm mx-auto" style="max-width: 760px">
        <div class="card-header"><h1 class="h4 mb-0">Editar incidencia #<?= (int) $id ?></h1></div>
        <div class="card-body">
            <?php if ($errores !== []): ?><div class="alert alert-danger"><?= escapar(implode(' ', $errores)) ?></div><?php endif; ?>
            <p><strong><?= escapar($incidencia['titulo']) ?></strong></p>
            <form method="post" action="editar-incidencia.php?id=<?= (int) $id ?>">
                <div class="mb-3">
                    <label class="form-label" for="estado">Estado</label>
                    <select class="form-select" id="estado" name="estado">
                        <?php foreach ($estados as $estado): ?>
                            <option value="<?= escapar($estado) ?>" <?= $incidencia['estado'] === $estado ? 'selected' : '' ?>><?= escapar($estado) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="prioridad">Prioridad</label>
                    <select class="form-select" id="prioridad" name="prioridad">
                        <?php foreach ($prioridades as $prioridad): ?>
                            <option value="<?= escapar($prioridad) ?>" <?= $incidencia['prioridad'] === $prioridad ? 'selected' : '' ?>><?= escapar($prioridad) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="observaciones">Observaciones</label>
                    <textarea class="form-control" id="observaciones" name="observaciones" rows="4"><?= escapar($incidencia['observaciones']) ?></textarea>
                </div>
                <button class="btn btn-primary" type="submit">Guardar cambios</button>
                <a class="btn btn-outline-secondary" href="detalle-incidencia.php?id=<?= (int) $id ?>">Cancelar</a>
            </form>
        </div>
    </div>
</main>
</body>
</html>
