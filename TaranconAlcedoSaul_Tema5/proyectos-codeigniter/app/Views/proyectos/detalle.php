<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle del Proyecto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f4f4f4; padding: 30px;">

<div style="max-width: 650px; margin: auto; background-color: white; padding: 25px; border: 1px solid #ddd;">
    <h3>Detalle del Proyecto #<?= $proyectoDetalle['id'] ?></h3>
    <hr>

    <div style="background-color: #eef6ff; padding: 15px; border: 1px solid #b6d4fe; margin-bottom: 20px;">
        <p><b>Nombre:</b> <?= $proyectoDetalle['nombre'] ?></p>
        <p><b>Cliente:</b> <?= $proyectoDetalle['cliente'] ?></p>
        <p><b>Estado:</b> <?= $proyectoDetalle['estado'] ?></p>
        <p><b>Horas estimadas:</b> <?= $proyectoDetalle['horas_estimadas'] ?> h</p>
        <p><b>Horas realizadas:</b> <?= $proyectoDetalle['horas_realizadas'] ?> h</p>
        <p><b>Porcentaje de ejecución:</b> <?= $progreso ?>%</p>

        <!-- Alerta en rojo si se pasan de las horas previstas -->
        <?php if ($proyectoDetalle['horas_realizadas'] > $proyectoDetalle['horas_estimadas']): ?>
            <div class="alert alert-danger mb-0">
                Las horas realizadas superan a las horas previstas.
            </div>
        <?php endif; ?>
    </div>

    <a href="<?= base_url('proyectos') ?>" class="btn btn-secondary btn-sm">Cerrar</a>
</div>

</body>
</html>