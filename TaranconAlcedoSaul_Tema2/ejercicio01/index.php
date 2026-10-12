<?php
const MONEDA = "€";

function leerCampoFormulario($nombreCampo)
{
    if (!isset($_POST[$nombreCampo]) || !is_scalar($_POST[$nombreCampo])) {
        return "";
    }

    return trim((string) $_POST[$nombreCampo]);
}

$cliente = leerCampoFormulario("cliente");
$horas = leerCampoFormulario("horas");
$precioHora = leerCampoFormulario("precio_hora");
$paginas = leerCampoFormulario("paginas");
$alojamiento = leerCampoFormulario("alojamiento");
$porcentajeIva = leerCampoFormulario("iva");
$errores = array();
$presupuesto = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($cliente === "") {
        $errores[] = "El nombre del cliente es obligatorio.";
    }
    if (!is_numeric($horas) || (float) $horas < 0) {
        $errores[] = "Las horas deben ser un número igual o superior a 0.";
    }
    if (!is_numeric($precioHora) || (float) $precioHora < 0) {
        $errores[] = "El precio por hora debe ser un número igual o superior a 0.";
    }
    if (filter_var($paginas, FILTER_VALIDATE_INT) === false || (int) $paginas < 1) {
        $errores[] = "El número de páginas debe ser un entero mayor que 0.";
    }
    if (!is_numeric($alojamiento) || (float) $alojamiento < 0) {
        $errores[] = "El alojamiento debe ser un número igual o superior a 0.";
    }
    if (!is_numeric($porcentajeIva) || (float) $porcentajeIva < 0 || (float) $porcentajeIva > 100) {
        $errores[] = "El IVA debe ser un porcentaje entre 0 y 100.";
    }

    if (count($errores) === 0) {
        // Los valores de un formulario llegan como texto, por eso los convertimos antes de calcular.
        $horasNumero = (float) $horas;
        $precioHoraNumero = (float) $precioHora;
        $paginasNumero = (int) $paginas;
        $alojamientoNumero = (float) $alojamiento;
        $ivaNumero = (float) $porcentajeIva;

        $costeDesarrollo = $horasNumero * $precioHoraNumero;
        $subtotal = $costeDesarrollo + $alojamientoNumero;
        $importeIva = $subtotal * $ivaNumero / 100;
        $total = $subtotal + $importeIva;

        $presupuesto = array(
            "coste_desarrollo" => $costeDesarrollo,
            "subtotal" => $subtotal,
            "iva" => $importeIva,
            "total" => $total,
            "paginas" => $paginasNumero,
            "horas" => $horasNumero,
            "precio_hora" => $precioHoraNumero,
            "alojamiento" => $alojamientoNumero,
            "porcentaje_iva" => $ivaNumero
        );
    }
}

function escapar($texto)
{
    return htmlspecialchars((string) $texto, ENT_QUOTES, "UTF-8");
}

function formatoEuros($cantidad)
{
    return number_format($cantidad, 2, ",", ".") . " " . MONEDA;
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Calculadora de presupuestos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <main class="container py-5">
        <a href="../index.php" class="link-secondary text-decoration-none">&larr; Volver a las actividades</a>
        <div class="row justify-content-center mt-3">
            <div class="col-lg-8">
                <section class="card shadow-sm">
                    <div class="card-body p-4">
                        <h1 class="h2 mb-1">Calculadora de presupuestos</h1>
                        <p class="text-secondary mb-4">Introduce los datos del proyecto para calcular el presupuesto.</p>

                        <?php if (count($errores) > 0) { ?>
                            <div class="alert alert-danger" role="alert">
                                <p class="fw-semibold mb-1">Revisa estos datos:</p>
                                <ul class="mb-0">
                                    <?php foreach ($errores as $error) { ?>
                                        <li><?php echo escapar($error); ?></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?php } ?>

                        <form method="POST">
                            <div class="mb-3">
                                <label for="cliente" class="form-label">Nombre del cliente</label>
                                <input type="text" class="form-control" id="cliente" name="cliente" value="<?php echo escapar($cliente); ?>" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="horas" class="form-label">Horas de desarrollo</label>
                                    <input type="number" min="0" step="any" class="form-control" id="horas" name="horas" value="<?php echo escapar($horas); ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="precio_hora" class="form-label">Precio por hora (€)</label>
                                    <input type="number" min="0" step="any" class="form-control" id="precio_hora" name="precio_hora" value="<?php echo escapar($precioHora); ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="paginas" class="form-label">Número de páginas</label>
                                    <input type="number" min="1" step="1" class="form-control" id="paginas" name="paginas" value="<?php echo escapar($paginas); ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="alojamiento" class="form-label">Coste de alojamiento (€)</label>
                                    <input type="number" min="0" step="any" class="form-control" id="alojamiento" name="alojamiento" value="<?php echo escapar($alojamiento); ?>" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="iva" class="form-label">Porcentaje de IVA (%)</label>
                                    <input type="number" min="0" max="100" step="any" class="form-control" id="iva" name="iva" value="<?php echo escapar($porcentajeIva); ?>" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Calcular presupuesto</button>
                        </form>
                    </div>
                </section>

                <?php if ($presupuesto !== null) { ?>
                    <section class="card shadow-sm mt-4" aria-labelledby="titulo-presupuesto">
                        <div class="card-body p-4">
                            <h2 id="titulo-presupuesto" class="h3">Presupuesto de proyecto</h2>
                            <p><strong>Cliente:</strong> <?php echo escapar($cliente); ?></p>
                            <p><?php echo escapar($presupuesto["horas"]); ?> horas a <?php echo formatoEuros($presupuesto["precio_hora"]); ?> por hora</p>
                            <p><strong>Páginas del sitio:</strong> <?php echo escapar($presupuesto["paginas"]); ?></p>
                            <hr>
                            <dl class="row mb-0">
                                <dt class="col-7">Coste de desarrollo</dt>
                                <dd class="col-5 text-end"><?php echo formatoEuros($presupuesto["coste_desarrollo"]); ?></dd>
                                <dt class="col-7">Alojamiento</dt>
                                <dd class="col-5 text-end"><?php echo formatoEuros($presupuesto["alojamiento"]); ?></dd>
                                <dt class="col-7">Subtotal</dt>
                                <dd class="col-5 text-end"><?php echo formatoEuros($presupuesto["subtotal"]); ?></dd>
                                <dt class="col-7">IVA (<?php echo escapar($presupuesto["porcentaje_iva"]); ?>%)</dt>
                                <dd class="col-5 text-end"><?php echo formatoEuros($presupuesto["iva"]); ?></dd>
                            </dl>
                            <div class="total-presupuesto mt-3 p-3 rounded d-flex justify-content-between">
                                <strong>TOTAL</strong>
                                <strong><?php echo formatoEuros($presupuesto["total"]); ?></strong>
                            </div>
                        </div>
                    </section>
                <?php } ?>
            </div>
        </div>
    </main>
</body>
</html>