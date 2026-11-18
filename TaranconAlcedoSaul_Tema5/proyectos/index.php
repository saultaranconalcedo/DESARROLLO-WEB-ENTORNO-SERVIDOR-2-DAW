<?php

// Cargo los datos y las funciones
require_once 'datos.php';
require_once 'funciones.php';

// Pido todos los proyectos
$proyectos = obtenerProyectos();

// Miro si han filtrado por algun estado en el formulario GET
$estadoFiltro = $_GET['estado'] ?? 'Todos';
$proyectosFiltrados = filtrarPorEstado($proyectos, $estadoFiltro);

// Miro si han pinchado en ver detalle de algun proyecto
$idVer = $_GET['id'] ?? null;
$proyectoDetalle = null;

if ($idVer != null) {
    $proyectoDetalle = obtenerProyecto($proyectos, $idVer);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Panel de Proyectos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

    <h2>Panel de Gestión de Proyectos</h2>

    <!-- Filtro por estado usando GET -->
    <form method="GET" action="index.php" class="my-3">
        <label>Filtrar por estado:</label>
        <select name="estado">
            <option value="Todos" <?php if($estadoFiltro == 'Todos') echo 'selected'; ?>>Todos</option>
            <option value="Planificado" <?php if($estadoFiltro == 'Planificado') echo 'selected'; ?>>Planificado</option>
            <option value="En desarrollo" <?php if($estadoFiltro == 'En desarrollo') echo 'selected'; ?>>En desarrollo</option>
            <option value="En pruebas" <?php if($estadoFiltro == 'En pruebas') echo 'selected'; ?>>En pruebas</option>
            <option value="Finalizado" <?php if($estadoFiltro == 'Finalizado') echo 'selected'; ?>>Finalizado</option>
        </select>

        <button type="submit">Filtrar</button>
    </form>

    <!-- Si han pulsado en ver detalle muestro la info -->

    <?php if ($proyectoDetalle != null): ?>
        <?php $progreso = calcularProgreso($proyectoDetalle['horas_estimadas'], $proyectoDetalle['horas_realizadas']); ?>
        <div class="border p-3 mb-3">
            <h4>Detalle del Proyecto #<?= $proyectoDetalle['id'] ?></h4>
            <p><b>Nombre:</b> <?= $proyectoDetalle['nombre'] ?></p>
            <p><b>Cliente:</b> <?= $proyectoDetalle['cliente'] ?></p>
            <p><b>Estado:</b> <?= $proyectoDetalle['estado'] ?></p>
            <p><b>Horas estimadas:</b> <?= $proyectoDetalle['horas_estimadas'] ?> h</p>
            <p><b>Horas realizadas:</b> <?= $proyectoDetalle['horas_realizadas'] ?> h</p>
            <p><b>Progreso:</b> <?= $progreso ?>%</p>

            <?php if ($proyectoDetalle['horas_realizadas'] > $proyectoDetalle['horas_estimadas']): ?>
                <p class="text-danger"><b>Aviso: Las horas realizadas superan a las previstas.</b></p>
            <?php endif; ?>

            <a href="index.php?estado=<?= $estadoFiltro ?>">Cerrar</a>
        </div>

    <?php endif; ?>

    <!-- Tabla principal de proyectos -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>PROYECTO</th>
                <th>CLIENTE</th>
                <th>ESTADO</th>
                <th>PROGRESO</th>
                <th>ACCIÓN</th>
            </tr>
        </thead>

        <tbody>
            <?php if (empty($proyectosFiltrados)): ?>
                
                <tr>
                    <td colspan="6">No hay proyectos en este estado.</td>
                </tr>

            <?php else: ?>
                <?php foreach ($proyectosFiltrados as $p): ?>
                    <?php $porcentaje = calcularProgreso($p['horas_estimadas'], $p['horas_realizadas']); ?>

                    <tr>
                        <td><?= $p['id'] ?></td>
                        <td><?= $p['nombre'] ?></td>
                        <td><?= $p['cliente'] ?></td>
                        <td><?= $p['estado'] ?></td>
                        <td>
                            <?= $porcentaje ?>%
                            <?php if ($p['horas_realizadas'] > $p['horas_estimadas']): ?>
                                <span class="text-danger">(Excedido)</span>
                            <?php endif; ?>
                        </td>

                        <td>
                            <a href="index.php?id=<?= $p['id'] ?>&estado=<?= $estadoFiltro ?>">Ver detalle</a>
                        </td>
                        
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>