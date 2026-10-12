<?php
require_once "funciones.php";

function leerCampoFormulario($nombreCampo)
{
    if (!isset($_POST[$nombreCampo]) || !is_scalar($_POST[$nombreCampo])) {
        return "";
    }

    return trim((string) $_POST[$nombreCampo]);
}

$nombreProyecto = leerCampoFormulario("proyecto");
$cliente = leerCampoFormulario("cliente");
$desarrolladores = leerCampoFormulario("desarrolladores");
$horasEstimadas = leerCampoFormulario("horas_estimadas");
$horasRealizadas = leerCampoFormulario("horas_realizadas");
$precioHora = leerCampoFormulario("precio_hora");
$presupuestoMaximo = leerCampoFormulario("presupuesto");
$estado = leerCampoFormulario("estado");
$estados = array("Planificado", "En desarrollo", "En pruebas", "Finalizado");
$errores = array();
$resultado = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($nombreProyecto === "" || $cliente === "") {
        $errores[] = "El nombre del proyecto y el cliente son obligatorios.";
    }
    if (filter_var($desarrolladores, FILTER_VALIDATE_INT) === false || (int) $desarrolladores < 1) {
        $errores[] = "Debe haber al menos un desarrollador.";
    }
    if (!is_numeric($horasEstimadas) || (float) $horasEstimadas <= 0) {
        $errores[] = "Las horas estimadas deben ser mayores que 0.";
    }
    if (!is_numeric($horasRealizadas) || (float) $horasRealizadas < 0) {
        $errores[] = "Las horas realizadas deben ser iguales o superiores a 0.";
    }
    if (!is_numeric($precioHora) || (float) $precioHora < 0) {
        $errores[] = "El precio por hora debe ser igual o superior a 0.";
    }
    if (!is_numeric($presupuestoMaximo) || (float) $presupuestoMaximo < 0) {
        $errores[] = "El presupuesto máximo debe ser igual o superior a 0.";
    }
    if (!in_array($estado, $estados, true)) {
        $errores[] = "Selecciona un estado válido.";
    }

    if (count($errores) === 0) {
        // Las entradas numéricas se convierten aquí y se pasan como parámetros a las funciones.
        $desarrolladoresNumero = (int) $desarrolladores;
        $horasEstimadasNumero = (float) $horasEstimadas;
        $horasRealizadasNumero = (float) $horasRealizadas;
        $precioHoraNumero = (float) $precioHora;
        $presupuestoNumero = (float) $presupuestoMaximo;

        $costeEstimado = calcularCoste($horasEstimadasNumero, $precioHoraNumero);
        $costeActual = calcularCoste($horasRealizadasNumero, $precioHoraNumero);
        $horasRestantes = calcularHorasRestantes($horasEstimadasNumero, $horasRealizadasNumero);
        $porcentajeEjecucion = calcularPorcentaje($horasEstimadasNumero, $horasRealizadasNumero);
        $dentroPresupuesto = comprobarPresupuesto($costeActual, $presupuestoNumero);

        $resultado = array(
            "desarrolladores" => $desarrolladoresNumero,
            "horas_estimadas" => $horasEstimadasNumero,
            "horas_realizadas" => $horasRealizadasNumero,
            "coste_estimado" => $costeEstimado,
            "coste_actual" => $costeActual,
            "horas_restantes" => $horasRestantes,
            "porcentaje" => $porcentajeEjecucion,
            "presupuesto" => $presupuestoNumero,
            "dentro_presupuesto" => $dentroPresupuesto
        );
    }
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión económica de proyectos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <main class="container py-5">
        <a href="../index.php" class="link-secondary text-decoration-none">&larr; Volver a las actividades</a>
        <div class="row justify-content-center mt-3">
            <div class="col-lg-9">
                <section class="card shadow-sm">
                    <div class="card-body p-4">
                        <h1 class="h2 mb-1">Gestión económica de proyectos</h1>
                        <p class="text-secondary mb-4">Comprueba costes, horas y presupuesto de un proyecto.</p>

                        <?php if (count($errores) > 0) { ?>
                            <div class="alert alert-danger" role="alert">
                                <ul class="mb-0">
                                    <?php foreach ($errores as $error) { ?>
                                        <li><?php echo escapar($error); ?></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?php } ?>

                        <form method="POST">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="proyecto" class="form-label">Nombre del proyecto</label>
                                    <input type="text" class="form-control" id="proyecto" name="proyecto" value="<?php echo escapar($nombreProyecto); ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cliente" class="form-label">Cliente</label>
                                    <input type="text" class="form-control" id="cliente" name="cliente" value="<?php echo escapar($cliente); ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="desarrolladores" class="form-label">Número de desarrolladores</label>
                                    <input type="number" min="1" step="1" class="form-control" id="desarrolladores" name="desarrolladores" value="<?php echo escapar($desarrolladores); ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="estado" class="form-label">Estado del proyecto</label>
                                    <select class="form-select" id="estado" name="estado" required>
                                        <option value="">Selecciona el estado</option>
                                        <?php foreach ($estados as $opcionEstado) { ?>
                                            <option value="<?php echo escapar($opcionEstado); ?>" <?php echo $estado === $opcionEstado ? "selected" : ""; ?>>
                                                <?php echo escapar($opcionEstado); ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="horas_estimadas" class="form-label">Horas estimadas</label>
                                    <input type="number" min="0.01" step="any" class="form-control" id="horas_estimadas" name="horas_estimadas" value="<?php echo escapar($horasEstimadas); ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="horas_realizadas" class="form-label">Horas realizadas</label>
                                    <input type="number" min="0" step="any" class="form-control" id="horas_realizadas" name="horas_realizadas" value="<?php echo escapar($horasRealizadas); ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="precio_hora" class="form-label">Precio por hora (€)</label>
                                    <input type="number" min="0" step="any" class="form-control" id="precio_hora" name="precio_hora" value="<?php echo escapar($precioHora); ?>" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="presupuesto" class="form-label">Presupuesto máximo (€)</label>
                                    <input type="number" min="0" step="any" class="form-control" id="presupuesto" name="presupuesto" value="<?php echo escapar($presupuestoMaximo); ?>" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Calcular indicadores</button>
                        </form>
                    </div>
                </section>

                <?php if ($resultado !== null) { ?>
                    <section class="card shadow-sm mt-4">
                        <div class="card-body p-4">
                            <h2 class="h3">Resumen del proyecto</h2>
                            <p><strong>Proyecto:</strong> <?php echo escapar($nombreProyecto); ?></p>
                            <p><strong>Cliente:</strong> <?php echo escapar($cliente); ?></p>
                            <p><strong>Desarrolladores:</strong> <?php echo escapar($resultado["desarrolladores"]); ?> &middot; <strong>Estado:</strong> <?php echo escapar($estado); ?></p>
                            <hr>
                            <dl class="row mb-0">
                                <dt class="col-7">Coste estimado</dt>
                                <dd class="col-5 text-end"><?php echo formatoEuros($resultado["coste_estimado"]); ?></dd>
                                <dt class="col-7">Coste actual</dt>
                                <dd class="col-5 text-end"><?php echo formatoEuros($resultado["coste_actual"]); ?></dd>
                                <dt class="col-7">Presupuesto máximo</dt>
                                <dd class="col-5 text-end"><?php echo formatoEuros($resultado["presupuesto"]); ?></dd>
                                <dt class="col-7">Horas restantes</dt>
                                <dd class="col-5 text-end"><?php echo number_format($resultado["horas_restantes"], 2, ",", "."); ?></dd>
                                <dt class="col-7">Porcentaje de ejecución</dt>
                                <dd class="col-5 text-end"><?php echo number_format($resultado["porcentaje"], 2, ",", "."); ?>%</dd>
                            </dl>
                            <div class="alert <?php echo $resultado["dentro_presupuesto"] ? "alert-success" : "alert-danger"; ?> mt-3 mb-0">
                                <?php if ($resultado["dentro_presupuesto"]) { ?>
                                    PROYECTO DENTRO DEL PRESUPUESTO
                                <?php } else { ?>
                                    ATENCIÓN: EL PROYECTO HA SUPERADO EL PRESUPUESTO
                                <?php } ?>
                            </div>
                            <?php if ($resultado["horas_realizadas"] > $resultado["horas_estimadas"]) { ?>
                                <div class="alert alert-warning mt-3 mb-0">
                                    ATENCIÓN: las horas realizadas superan las horas estimadas.
                                </div>
                            <?php } ?>
                        </div>
                    </section>
                <?php } ?>
            </div>
        </div>
    </main>
</body>
</html>