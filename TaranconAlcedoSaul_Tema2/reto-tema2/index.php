<?php
require_once 'datos.php';
require_once 'funciones.php';
// Calculo las estadisticas globales
$st = obtenerEstadisticas($proyectos);
$horasSuperadas = obtenerProyectosExcedidosHoras($proyectos);

// Logica para consultar un proyecto por ID
$proyectoBuscado = null;
if (isset($_GET['id_consulta']) && $_GET['id_consulta'] != "") {
    $proyectoBuscado = buscarProyectoPorId($proyectos, (int)$_GET['id_consulta']);
}
?>
<!DOCTYPE html>

<head>

    <title>Reto Tema 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">
<div class="container">
    <h2 class="text-center">Panel de Control</h2>

    <pre class="bg-dark text-white p-3">
========================================
       PANEL DE CONTROL
========================================

Proyectos activos: <?= $st['activos'] ?>

Horas estimadas: <?= $st['hEst'] ?>
Horas realizadas: <?= $st['hReal'] ?>

Coste previsto: <?= number_format($st['cPrev'], 2) ?> €
Coste actual: <?= number_format($st['cAct'], 2) ?> €

Proyectos dentro de presupuesto: <?= $st['dentro'] ?>
Proyectos con desviación: <?= $st['desviados'] ?>
    </pre>

    <!-- Buscador sencillo de proyecto por ID -->
    <div class="card p-3 mb-4">
        <h5>Consultar un proyecto</h5>
        <form method="GET" class="row g-2">
            <div class="col-auto">
                <input type="number" name="id_consulta" placeholder="ID Proyecto" class="form-control" required>
            </div>
            <div class="col-auto">
                <button class="btn btn-secondary">Buscar</button>
            </div>
        </form>
        <?php if ($proyectoBuscado): ?>
            <div class="alert alert-success mt-2 mb-0">
                <strong>Encontrado:</strong> <?= $proyectoBuscado['nombre'] ?> | Cliente: <?= $proyectoBuscado['cliente'] ?> | Estado: <?= $proyectoBuscado['estado'] ?>
            </div>
        <?php elseif (isset($_GET['id_consulta'])): ?>
            <div class="alert alert-warning mt-2 mb-0">No se encontró ningún proyecto con ese ID.</div>
        <?php endif; ?>
    </div>

    <!-- Proyectos con horas superadas -->
    <?php if (count($horasSuperadas) > 0): ?>

    <div class="alert alert-danger">

        <strong>Atención: Proyectos que han superado las horas previstas:</strong>

        <ul class="mb-0">
            <?php foreach ($horasSuperadas as $ex): ?>
                <li><?= $ex['nombre'] ?> (Horas real: <?= $ex['horas_realizadas'] ?> / Est: <?= $ex['horas_estimadas'] ?>)</li>
            <?php endforeach; ?>
            
        </ul>


    </div>
    <?php endif; ?>

    <!-- Tabla general de proyectos -->
    <h5>Listado de todos los proyectos</h5>
    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th>ID</th><th>Nombre</th><th>Cliente</th><th>Horas</th><th>Coste</th><th>Presupuesto</th><th>Estado</th>
            </tr>
        </thead>


        <tbody>
            <?php foreach ($proyectos as $p): ?>
            <tr>

                <td><?= $p['id'] ?></td>
                <td><?= $p['nombre'] ?></td>
                <td><?= $p['cliente'] ?></td>
                <td><?= $p['horas_realizadas'] ?> / <?= $p['horas_estimadas'] ?></td>
                <td><?= calcularCosteProyecto($p['horas_realizadas'], $p['precio_hora']) ?> €</td>
                <td><?= $p['presupuesto'] ?> €</td>
                <td><?= tieneDesviacion($p) ? 'Desviado' : $p['estado'] ?></td>
            </tr>

            <?php endforeach; ?>
        </tbody>

    </table>

</div>

</body>

</html>