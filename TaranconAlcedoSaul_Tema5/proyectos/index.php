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

if ($idVer != null) {
    $proyectoDetalle = obtenerProyecto($proyectos, $idVer);
}
?>

<!DOCTYPE html>
<head>
    <title>Panel de Proyectos</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">  <!-- Cargo Bootstrap por CDN -->
    <link rel="stylesheet" href="estilos.css">  <!-- Cargo mi hoja de estilos propia -->
</head>

<body>

<div class="caja-principal">
    <h2>Panel de Gestión de Proyectos</h2>
    <hr>

    <!-- Filtro por estado usando GET -->
    <form method="GET" action="index.php" class="mb-4">
        <label><b>Filtrar por estado:</b></label>

        <select name="estado">
            <option value="Todos" <?php if($estadoFiltro == 'Todos') echo 'selected'; ?>>Todos</option>
            <option value="Planificado" <?php if($estadoFiltro == 'Planificado') echo 'selected'; ?>>Planificado</option>
            <option value="En desarrollo" <?php if($estadoFiltro == 'En desarrollo') echo 'selected'; ?>>En desarrollo</option>
            <option value="En pruebas" <?php if($estadoFiltro == 'En pruebas') echo 'selected'; ?>>En pruebas</option>
            <option value="Finalizado" <?php if($estadoFiltro == 'Finalizado') echo 'selected'; ?>>Finalizado</option>
        </select>

        <button type="submit" class="btn btn-primary btn-sm">Filtrar</button>
    </form>

    <!-- Si han pulsado en ver detalle muestro la tarjeta con la info completa -->
    <?php if ($proyectoDetalle != null): ?>
        <?php 
            $progreso = calcularProgreso($proyectoDetalle['horas_estimadas'], $proyectoDetalle['horas_realizadas']); 
        ?>

        <div class="ficha-detalle">
            <h4>Detalle del Proyecto #<?= $proyectoDetalle['id'] ?></h4>
            <p><b>Nombre:</b> <?= $proyectoDetalle['nombre'] ?></p>
            <p><b>Cliente:</b> <?= $proyectoDetalle['cliente'] ?></p>
            <p><b>Estado:</b> <?= $proyectoDetalle['estado'] ?></p>
            <p><b>Horas estimadas:</b> <?= $proyectoDetalle['horas_estimadas'] ?> h</p>
            <p><b>Horas realizadas:</b> <?= $proyectoDetalle['horas_realizadas'] ?> h</p>
            <p><b>Porcentaje de ejecución:</b> <?= $progreso ?>%</p>

            <!-- Alerta en rojo si se pasan de las horas previstas -->
            <?php if ($proyectoDetalle['horas_realizadas'] > $proyectoDetalle['horas_estimadas']): ?>
                <div class="alert alert-danger">
                    Las horas realizadas superan a las horas previstas.
                </div>
            <?php endif; ?>

            <a href="index.php?estado=<?= $estadoFiltro ?>" class="btn btn-secondary btn-sm">Cerrar</a>
        </div>
    <?php endif; ?>

    <!-- Tabla principal de proyectos -->
    <table class="table table-bordered">
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
                                <span class="text-danger"><b>(Excedido)</b></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="index.php?id=<?= $p['id'] ?>&estado=<?= $estadoFiltro ?>" class="btn btn-info btn-sm">Ver detalle</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>