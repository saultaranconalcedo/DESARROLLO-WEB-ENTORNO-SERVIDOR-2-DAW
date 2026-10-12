<?php
require_once "funciones.php";
require_once "datos.php";

$estadisticas = obtenerEstadisticas($proyectos);
$proyectosConHorasSuperadas = obtenerProyectosConHorasSuperadas($proyectos);
$totalProyectos = count($proyectos);
$idConsultado = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
$proyectoConsultado = $idConsultado === false || $idConsultado === null ? null : buscarProyecto($proyectos, $idConsultado);
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel de control de proyectos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <main class="container py-5">
        <a href="../index.php" class="link-secondary text-decoration-none">&larr; Volver a las actividades</a>
        <header class="mt-3 mb-4">
            <h1 class="display-6 fw-semibold">Panel de control</h1>
            <p class="text-secondary mb-0">Resumen económico de los proyectos de la empresa.</p>
        </header>

        <section class="row g-3 mb-4" aria-label="Estadísticas generales">
            <div class="col-6 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <p class="metric-label">Proyectos activos</p>
                        <p class="metric-value mb-0"><?php echo (int) $estadisticas["cantidad_activos"]; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <p class="metric-label">Horas estimadas</p>
                        <p class="metric-value mb-0"><?php echo number_format($estadisticas["horas_estimadas"], 0, ",", "."); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <p class="metric-label">Horas realizadas</p>
                        <p class="metric-value mb-0"><?php echo number_format($estadisticas["horas_realizadas"], 0, ",", "."); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <p class="metric-label">Proyectos totales</p>
                        <p class="metric-value mb-0"><?php echo (int) $totalProyectos; ?></p>
                    </div>
                </div>
            </div>
        </section>

        <section class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h2 class="h6 text-secondary">Coste previsto</h2>
                        <p class="h4 mb-0"><?php echo formatoEuros($estadisticas["coste_previsto"]); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h2 class="h6 text-secondary">Coste actual</h2>
                        <p class="h4 mb-0"><?php echo formatoEuros($estadisticas["coste_actual"]); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h2 class="h6 text-secondary">Situación del presupuesto</h2>
                        <p class="mb-1">Dentro del presupuesto: <strong><?php echo (int) $estadisticas["dentro_presupuesto"]; ?></strong></p>
                        <p class="mb-0">Con desviación: <strong><?php echo (int) $estadisticas["con_desviacion"]; ?></strong></p>
                    </div>
                </div>
            </div>
        </section>

        <?php if (isset($_GET["id"]) && $proyectoConsultado === null) { ?>
            <div class="alert alert-warning" role="alert">No se ha encontrado un proyecto con ese identificador.</div>
        <?php } ?>

        <?php if ($proyectoConsultado !== null) { ?>
            <?php
            $costeConsultado = calcularCoste($proyectoConsultado["horas_realizadas"], $proyectoConsultado["precio_hora"]);
            $porcentajeConsultado = calcularPorcentaje($proyectoConsultado["horas_estimadas"], $proyectoConsultado["horas_realizadas"]);
            ?>
            <section class="card shadow-sm mb-4" aria-labelledby="detalle-proyecto">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-primary fw-semibold mb-1">DETALLE DEL PROYECTO #<?php echo (int) $proyectoConsultado["id"]; ?></p>
                            <h2 id="detalle-proyecto" class="h4"><?php echo escapar($proyectoConsultado["nombre"]); ?></h2>
                        </div>
                        <a href="index.php" class="btn btn-outline-secondary btn-sm">Cerrar detalle</a>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Cliente:</strong> <?php echo escapar($proyectoConsultado["cliente"]); ?></p>
                            <p><strong>Estado:</strong> <?php echo escapar($proyectoConsultado["estado"]); ?></p>
                            <p><strong>Precio por hora:</strong> <?php echo formatoEuros($proyectoConsultado["precio_hora"]); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Horas estimadas:</strong> <?php echo number_format($proyectoConsultado["horas_estimadas"], 0, ",", "."); ?></p>
                            <p><strong>Horas realizadas:</strong> <?php echo number_format($proyectoConsultado["horas_realizadas"], 0, ",", "."); ?></p>
                            <p><strong>Presupuesto:</strong> <?php echo formatoEuros($proyectoConsultado["presupuesto"]); ?></p>
                        </div>
                    </div>
                    <p class="mb-2"><strong>Coste actual:</strong> <?php echo formatoEuros($costeConsultado); ?>
                        <span class="badge <?php echo comprobarPresupuesto($proyectoConsultado) ? "text-bg-success" : "text-bg-danger"; ?>">
                            <?php echo comprobarPresupuesto($proyectoConsultado) ? "Dentro del presupuesto" : "Con desviación"; ?>
                        </span>
                    </p>
                    <p class="mb-2"><strong>Ejecución:</strong> <?php echo number_format($porcentajeConsultado, 1, ",", "."); ?>%</p>
                    <div class="progress" role="progressbar" aria-label="Porcentaje de ejecución" aria-valuenow="<?php echo min(100, (int) $porcentajeConsultado); ?>" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar <?php echo $porcentajeConsultado > 100 ? "bg-warning" : ""; ?>" style="width: <?php echo min(100, max(0, $porcentajeConsultado)); ?>%"></div>
                    </div>
                    <?php if ($proyectoConsultado["horas_realizadas"] > $proyectoConsultado["horas_estimadas"]) { ?>
                        <div class="alert alert-warning mt-3 mb-0">Este proyecto ha superado las horas previstas.</div>
                    <?php } ?>
                </div>
            </section>
        <?php } ?>

        <section class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="h4">Todos los proyectos</h2>
                <p class="text-secondary">Selecciona “Consultar” para ver el detalle de un proyecto.</p>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Proyecto / cliente</th>
                                <th>Estado</th>
                                <th>Coste actual</th>
                                <th>Ejecución</th>
                                <th>Presupuesto</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($proyectos as $proyecto) { ?>
                                <?php
                                $costeActualProyecto = calcularCoste($proyecto["horas_realizadas"], $proyecto["precio_hora"]);
                                $porcentajeProyecto = calcularPorcentaje($proyecto["horas_estimadas"], $proyecto["horas_realizadas"]);
                                ?>
                                <tr>
                                    <td><?php echo (int) $proyecto["id"]; ?></td>
                                    <td>
                                        <strong><?php echo escapar($proyecto["nombre"]); ?></strong><br>
                                        <span class="text-secondary small"><?php echo escapar($proyecto["cliente"]); ?></span>
                                    </td>
                                    <td><?php echo escapar($proyecto["estado"]); ?></td>
                                    <td><?php echo formatoEuros($costeActualProyecto); ?></td>
                                    <td><?php echo number_format($porcentajeProyecto, 1, ",", "."); ?>%</td>
                                    <td>
                                        <span class="badge <?php echo comprobarPresupuesto($proyecto) ? "text-bg-success" : "text-bg-danger"; ?>">
                                            <?php echo comprobarPresupuesto($proyecto) ? "Dentro" : "Desviado"; ?>
                                        </span>
                                    </td>
                                    <td><a class="btn btn-outline-primary btn-sm" href="index.php?id=<?php echo (int) $proyecto["id"]; ?>">Consultar</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section class="card shadow-sm">
            <div class="card-body">
                <h2 class="h4">Proyectos que han superado las horas previstas</h2>
                <?php if (count($proyectosConHorasSuperadas) === 0) { ?>
                    <div class="alert alert-success mb-0">Ningún proyecto ha superado las horas previstas.</div>
                <?php } else { ?>
                    <ul class="mb-0">
                        <?php foreach ($proyectosConHorasSuperadas as $proyecto) { ?>
                            <li>
                                <a href="index.php?id=<?php echo (int) $proyecto["id"]; ?>"><?php echo escapar($proyecto["nombre"]); ?></a>:
                                <?php echo number_format($proyecto["horas_realizadas"], 0, ",", "."); ?> realizadas de
                                <?php echo number_format($proyecto["horas_estimadas"], 0, ",", "."); ?> estimadas.
                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </div>
        </section>
    </main>
</body>
</html>