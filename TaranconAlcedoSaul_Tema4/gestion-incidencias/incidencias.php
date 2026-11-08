<?php
require_once 'funciones.php';
requerirLogin();

// La cookie recuerda durante 30 días cuántos resultados se muestran por página.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $limiteSolicitado = (int) ($_POST['limite'] ?? 5);
    $limite = in_array($limiteSolicitado, [5, 10, 20], true) ? $limiteSolicitado : 5;
    setcookie('inc_limite', (string) $limite, time() + (30 * 86400), '/');
    header('Location: incidencias.php');
    exit;
}

$limiteCookie = (int) ($_COOKIE['inc_limite'] ?? 5);
$limite = in_array($limiteCookie, [5, 10, 20], true) ? $limiteCookie : 5;
$incidencias = obtenerIncidenciasPorUsuario();
$totalPaginas = max(1, (int) ceil(count($incidencias) / $limite));
$pagina = max(1, min((int) ($_GET['pagina'] ?? 1), $totalPaginas));
$incidenciasPagina = array_slice($incidencias, ($pagina - 1) * $limite, $limite);
$rol = $_SESSION['rol'];
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Incidencias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<main class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h2">Incidencias</h1>
        <a class="btn btn-outline-secondary" href="panel.php">Volver al panel</a>
    </div>
    <form class="row g-2 align-items-end mb-3" method="post">
        <div class="col-auto">
            <label class="form-label" for="limite">Registros por página</label>
            <select class="form-select" id="limite" name="limite">
                <?php foreach ([5, 10, 20] as $opcion): ?>
                    <option value="<?= $opcion ?>" <?= $limite === $opcion ? 'selected' : '' ?>><?= $opcion ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-auto"><button class="btn btn-primary" type="submit">Guardar preferencia</button></div>
    </form>
    <?php if ($rol === 'Cliente' || $rol === 'Administrador'): ?>
        <p><a class="btn btn-success" href="nueva-incidencia.php">Nueva incidencia</a></p>
    <?php endif; ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
            <tr><th>ID</th><th>Título</th><th>Cliente</th><th>Técnico</th><th>Prioridad</th><th>Estado</th><th>Fecha</th><th>Acciones</th></tr>
            </thead>
            <tbody>
            <?php foreach ($incidenciasPagina as $incidencia): ?>
                <tr>
                    <td><?= escapar($incidencia['id']) ?></td>
                    <td><?= escapar($incidencia['titulo']) ?></td>
                    <td><?= escapar($incidencia['cliente']) ?></td>
                    <td><?= escapar($incidencia['tecnico'] ?: 'Sin asignar') ?></td>
                    <td><?= escapar($incidencia['prioridad']) ?></td>
                    <td><?= escapar($incidencia['estado']) ?></td>
                    <td><?= escapar($incidencia['fecha']) ?></td>
                    <td class="text-nowrap">
                        <a class="btn btn-sm btn-outline-primary" href="detalle-incidencia.php?id=<?= (int) $incidencia['id'] ?>">Ver</a>
                        <?php if ($rol === 'Administrador' || $rol === 'Técnico' || $incidencia['cliente'] === $_SESSION['usuario']): ?>
                            <a class="btn btn-sm btn-outline-secondary" href="editar-incidencia.php?id=<?= (int) $incidencia['id'] ?>">Editar</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if ($incidenciasPagina === []): ?>
                <tr><td colspan="8" class="text-center">No hay incidencias para mostrar.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if ($totalPaginas > 1): ?>
        <nav aria-label="Paginación"><ul class="pagination">
            <?php for ($numero = 1; $numero <= $totalPaginas; $numero++): ?>
                <li class="page-item <?= $numero === $pagina ? 'active' : '' ?>">
                    <a class="page-link" href="?pagina=<?= $numero ?>"><?= $numero ?></a>
                </li>
            <?php endfor; ?>
        </ul></nav>
    <?php endif; ?>
</main>
</body>
</html>
