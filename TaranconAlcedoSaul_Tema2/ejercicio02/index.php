<?php
require_once "funciones.php";

function leerCampoFormulario($nombreCampo)
{
    if (!isset($_POST[$nombreCampo]) || !is_scalar($_POST[$nombreCampo])) {
        return "";
    }

    return trim((string) $_POST[$nombreCampo]);
}

$nombre = leerCampoFormulario("nombre");
$categoria = leerCampoFormulario("categoria");
$brutoAnual = leerCampoFormulario("bruto_anual");
$numeroPagas = leerCampoFormulario("pagas");
$porcentajeRetencion = leerCampoFormulario("retencion");
$complementos = leerCampoFormulario("complementos");
$errores = array();
$nomina = null;
$categorias = array("Desarrollador Junior", "Desarrollador", "Analista", "Responsable de equipo");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($nombre === "") {
        $errores[] = "El nombre y los apellidos son obligatorios.";
    }
    if (!in_array($categoria, $categorias, true)) {
        $errores[] = "Selecciona una categoría profesional válida.";
    }
    if (!is_numeric($brutoAnual) || (float) $brutoAnual <= 0) {
        $errores[] = "El salario bruto anual debe ser mayor que 0.";
    }
    if (!in_array((string) $numeroPagas, array("12", "14"), true)) {
        $errores[] = "El número de pagas debe ser 12 o 14.";
    }
    if (!is_numeric($porcentajeRetencion) || (float) $porcentajeRetencion < 0 || (float) $porcentajeRetencion > 100) {
        $errores[] = "La retención debe ser un porcentaje entre 0 y 100.";
    }
    if (!is_numeric($complementos) || (float) $complementos < 0) {
        $errores[] = "Los complementos mensuales deben ser iguales o superiores a 0.";
    }

    if (count($errores) === 0) {
        // Convertimos las cadenas del formulario al tipo de dato que necesitan las operaciones.
        $brutoAnualNumero = (float) $brutoAnual;
        $pagasNumero = (int) $numeroPagas;
        $retencionNumero = (float) $porcentajeRetencion;
        $complementosNumero = (float) $complementos;

        $brutoPorPaga = calcularBrutoPorPaga($brutoAnualNumero, $pagasNumero);
        $importeRetencion = calcularRetencion($brutoPorPaga, $retencionNumero);
        $netoPorPaga = calcularNeto($brutoPorPaga, $retencionNumero, $complementosNumero);
        $netoMensual = calcularNetoMensual($brutoAnualNumero, $retencionNumero, $complementosNumero);

        $nomina = array(
            "bruto_anual" => $brutoAnualNumero,
            "pagas" => $pagasNumero,
            "bruto_por_paga" => $brutoPorPaga,
            "retencion" => $importeRetencion,
            "complementos" => $complementosNumero,
            "neto_por_paga" => $netoPorPaga,
            "neto_mensual" => $netoMensual,
            "porcentaje_retencion" => $retencionNumero
        );
    }
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Estimación de nómina</title>
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
                        <h1 class="h2 mb-1">Estimación de nómina</h1>
                        <p class="text-secondary mb-4">Rellena los datos para calcular una estimación salarial.</p>

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
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre y apellidos</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo escapar($nombre); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="categoria" class="form-label">Categoría profesional</label>
                                <select class="form-select" id="categoria" name="categoria" required>
                                    <option value="">Selecciona una categoría</option>
                                    <?php foreach ($categorias as $opcionCategoria) { ?>
                                        <option value="<?php echo escapar($opcionCategoria); ?>" <?php echo $categoria === $opcionCategoria ? "selected" : ""; ?>>
                                            <?php echo escapar($opcionCategoria); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="bruto_anual" class="form-label">Salario bruto anual (€)</label>
                                    <input type="number" min="0.01" step="any" class="form-control" id="bruto_anual" name="bruto_anual" value="<?php echo escapar($brutoAnual); ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="pagas" class="form-label">Número de pagas</label>
                                    <select class="form-select" id="pagas" name="pagas" required>
                                        <option value="">Selecciona</option>
                                        <option value="12" <?php echo $numeroPagas === "12" ? "selected" : ""; ?>>12 pagas</option>
                                        <option value="14" <?php echo $numeroPagas === "14" ? "selected" : ""; ?>>14 pagas</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="retencion" class="form-label">Porcentaje de retención (%)</label>
                                    <input type="number" min="0" max="100" step="any" class="form-control" id="retencion" name="retencion" value="<?php echo escapar($porcentajeRetencion); ?>" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="complementos" class="form-label">Complementos mensuales (€)</label>
                                    <input type="number" min="0" step="any" class="form-control" id="complementos" name="complementos" value="<?php echo escapar($complementos); ?>" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Calcular nómina</button>
                        </form>
                    </div>
                </section>

                <?php if ($nomina !== null) { ?>
                    <section class="card shadow-sm mt-4">
                        <div class="card-body p-4">
                            <h2 class="h3">Resumen salarial</h2>
                            <p><strong>Trabajador:</strong> <?php echo escapar($nombre); ?></p>
                            <p><strong>Categoría:</strong> <?php echo escapar($categoria); ?></p>
                            <hr>
                            <dl class="row mb-0">
                                <dt class="col-7">Bruto anual</dt>
                                <dd class="col-5 text-end"><?php echo formatoEuros($nomina["bruto_anual"]); ?></dd>
                                <dt class="col-7">Número de pagas</dt>
                                <dd class="col-5 text-end"><?php echo escapar($nomina["pagas"]); ?></dd>
                                <dt class="col-7">Bruto por paga</dt>
                                <dd class="col-5 text-end"><?php echo formatoEuros($nomina["bruto_por_paga"]); ?></dd>
                                <dt class="col-7">Retención (<?php echo escapar($nomina["porcentaje_retencion"]); ?>%)</dt>
                                <dd class="col-5 text-end"><?php echo formatoEuros($nomina["retencion"]); ?></dd>
                                <dt class="col-7">Complementos mensuales</dt>
                                <dd class="col-5 text-end"><?php echo formatoEuros($nomina["complementos"]); ?></dd>
                                <dt class="col-7">Neto estimado por paga</dt>
                                <dd class="col-5 text-end"><?php echo formatoEuros($nomina["neto_por_paga"]); ?></dd>
                            </dl>
                            <div class="neto-mensual mt-3 p-3 rounded d-flex justify-content-between">
                                <strong>Neto mensual estimado</strong>
                                <strong><?php echo formatoEuros($nomina["neto_mensual"]); ?></strong>
                            </div>
                            <p class="form-text mt-3 mb-0">El neto mensual se estima sobre 12 meses; el neto por paga usa el número de pagas seleccionado.</p>
                        </div>
                    </section>
                <?php } ?>
            </div>
        </div>
    </main>
</body>
</html>