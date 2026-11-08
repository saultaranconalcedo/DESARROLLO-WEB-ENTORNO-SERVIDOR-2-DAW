<?php
require_once 'funciones.php';
requerirLogin();

// Uso la cookie para guardar cuantos registros ver
if (isset($_POST['limite'])) {
    $limite = $_POST['limite'];
    setcookie('pref_limite', $limite, time() + 3600 * 24 * 30, '/');
} else {
    $limite = $_COOKIE['pref_limite'] ?? '10';
}

$todas = cargarIncidencias();
$rol = $_SESSION['rol'];
$user = $_SESSION['usuario'];

// Filtro simple para saber cuales le enseño a cada uno
$misIncidencias = [];
foreach ($todas as $i) {
    if ($rol === 'Administrador') {
        $misIncidencias[] = $i;
    } elseif ($rol === 'Técnico' && $i['tecnico'] === $user) {
        $misIncidencias[] = $i;
    } elseif ($rol === 'Cliente' && $i['cliente'] === $user) {
        $misIncidencias[] = $i;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Incidencias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">

<div class="container" style="max-width: 800px;">
    <div class="d-flex justify-content-between mb-3">
        <h3>Lista de Incidencias</h3>
        <a href="panel.php" class="btn btn-secondary btn-sm">Volver al panel</a>
    </div>

    <!-- Cambiar limite guardando en cookie -->
    <form method="POST" class="mb-3">
        <label>Mostrar elementos (Cookie):</label>
        <select name="limite" onchange="this.form.submit()">
            <option value="5" <?= $limite == '5' ? 'selected' : '' ?>>5</option>
            <option value="10" <?= $limite == '10' ? 'selected' : '' ?>>10</option>
        </select>
    </form>

    <table class="table table-bordered bg-white">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Prioridad</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($misIncidencias)): ?>
                <tr><td colspan="5" class="text-center">No hay incidencias.</td></tr>
            <?php else: ?>
                <?php foreach (array_slice($misIncidencias, 0, (int)$limite) as $inc): ?>
                    <tr>
                        <td><?= $inc['id'] ?></td>
                        <td><?= htmlspecialchars($inc['titulo']) ?></td>
                        <td><?= $inc['prioridad'] ?></td>
                        <td><?= $inc['estado'] ?></td>
                        <td>
                            <a href="detalle-incidencia.php?id=<?= $inc['id'] ?>" class="btn btn-info btn-sm text-white">Ver</a>
                            <a href="editar-incidencia.php?id=<?= $inc['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
