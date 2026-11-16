<?php
// Cargo los datos y las funciones
require_once 'datos.php';
require_once 'funciones.php';

// Pido todos los proyectos
$proyectos = obtenerProyectos();

// Miro si han filtrado por algun estado en el formulario GET
$estadoFiltro = $_GET['estado'] ?? 'Todos';
$proyectosFiltrados = filtrarPorEstado($proyectos, $estadoFiltro);

// Miro si han pinchado en Ver detalle de algun proyecto
$idVer = $_GET['id'] ?? null;
$proyectoDetalle = null;

if ($idVer !== null) {
    $proyectoDetalle = obtenerProyecto($proyectos, $idVer);
}
?>

<!DOCTYPE html>
<head>
    <title>Panel de Proyectos</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">  <!-- Cargo Bootstrap por CDN -->
    <link rel="stylesheet" href="estilos.css">  <!-- Cargo mi hoja de estilos propia -->
</head>

<body class="p-4">

<div class="container contenedor-principal">
    <h2 class="mb-4">Panel de Gestión de Proyectos</h2>

    <!-- Filtro por estado usando GET -->
    <form method="GET" action="index.php" class="row g-2 mb-4 align-items-center bg-white p-3 border rounded">
        <div class="col-auto">
            <label class="col-form-label fw-bold">Filtrar por estado:</label>
        </div>

        <div class="col-auto">
            <select name="estado" class="form-select">
                <option value="Todos" <?= $estadoFiltro === 'Todos' ? 'selected' : '' ?>>Todos</option>
                <option value="Planificado" <?= $estadoFiltro === 'Planificado' ? 'selected' : '' ?>>Planificado</option>
                <option value="En desarrollo" <?= $estadoFiltro === 'En desarrollo' ? 'selected' : '' ?>>En desarrollo</option>
                <option value="En pruebas" <?= $estadoFiltro === 'En pruebas' ? 'selected' : '' ?>>En pruebas</option>
                <option value="Finalizado" <?= $estadoFiltro === 'Finalizado' ? 'selected' : '' ?>>Finalizado</option>
            </select>
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </div>
    </form>

    <!-- Si han pulsado en ver detalle muestro la tarjeta con la info completa -->
    <?php if ($proyectoDetalle !== null): ?>
        <?php 
            $progreso = calcularProgreso($proyectoDetalle['horas_estimadas'], $proyectoDetalle['horas_realizadas']); 
        ?>

        <div class="card mb-4 tarjeta-detalle">
            <div class="card-header bg-primary text-white d-flex justify-content-between">
                <span>Detalle del Proyecto #<?= $proyectoDetalle['id'] ?></span>
                <a href="index.php?estado=<?= urlencode($estadoFiltro) ?>" class="btn btn-sm btn-light">Cerrar</a>
            </div>

            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($proyectoDetalle['nombre']) ?></h5>
                <p class="mb-1"><b>Cliente:</b> <?= htmlspecialchars($proyectoDetalle['cliente']) ?></p>
                <p class="mb-1"><b>Estado:</b> <?= $proyectoDetalle['estado'] ?></p>
                <p class="mb-1"><b>Horas estimadas:</b> <?= $proyectoDetalle['horas_estimadas'] ?> h</p>
                <p class="mb-1"><b>Horas realizadas:</b> <?= $proyectoDetalle['horas_realizadas'] ?> h</p>
                <p class="mb-2"><b>Porcentaje de ejecución:</b> <?= $progreso ?>%</p>

                <!-- Alerta en rojo si se pasan de las horas previstas -->
                <?php if ($proyectoDetalle['horas_realizadas'] > $proyectoDetalle['horas_estimadas']): ?>
                    <div class="alert alert-danger mb-0">
                        Las horas realizadas superan a las horas previstas.
                    </div>
                    
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Tabla principal de proyectos -->
    <table class="table table-bordered table-hover bg-white">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>PROYECTO</th>
                <th>CLIENTE</th>
                <th>ESTADO</th>
                <th>EJECUCIÓN</th>
                <th>ACCIÓN</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($proyectosFiltrados)): ?>
                <tr>
                    <td colspan="6" class="text-center">No hay proyectos en este estado.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($proyectosFiltrados as $p): ?>
                    <?php $porcentaje = calcularProgreso($p['horas_estimadas'], $p['horas_realizadas']); ?>
                    <tr>
                        <td><?= $p['id'] ?></td>
                        <td><?= htmlspecialchars($p['nombre']) ?></td>
                        <td><?= htmlspecialchars($p['cliente']) ?></td>
                        <td><?= $p['estado'] ?></td>
                        <td>
                            <?= $porcentaje ?>%
                            <?php if ($p['horas_realizadas'] > $p['horas_estimadas']): ?>
                                <span class="badge bg-danger">Excedido</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="index.php?id=<?= $p['id'] ?>&estado=<?= urlencode($estadoFiltro) ?>" class="btn btn-sm btn-info text-white">Ver detalle</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>