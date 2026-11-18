<!DOCTYPE html>
<html>
<head>
    <title>Detalle del Proyecto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">

    <!-- Vista independiente solo para enseñar la ficha de un proyecto concreto -->
    <h3>Detalle del Proyecto #<?= $proyectoDetalle['id'] ?></h3>
    <hr>

    <p><b>Nombre:</b> <?= $proyectoDetalle['nombre'] ?></p>
    <p><b>Cliente:</b> <?= $proyectoDetalle['cliente'] ?></p>
    <p><b>Estado:</b> <?= $proyectoDetalle['estado'] ?></p>
    <p><b>Horas estimadas:</b> <?= $proyectoDetalle['horas_estimadas'] ?> h</p>
    <p><b>Horas realizadas:</b> <?= $proyectoDetalle['horas_realizadas'] ?> h</p>
    <p><b>Progreso:</b> <?= $progreso ?>%</p>

    <!-- Aviso en rojo si se pasan de las horas previstas -->

    <?php if ($proyectoDetalle['horas_realizadas'] > $proyectoDetalle['horas_estimadas']): ?>
        <p class="text-danger"><b>Aviso: Las horas realizadas superan a las previstas.</b></p>
    <?php endif; ?>

    <!-- Vuelvo a la ruta principal del listado -->
     
    <a href="/proyectos">Volver</a>

</body>
</html>