<?php
require_once 'funciones.php';
$info = null;

if ($_POST) {
    $p = $_POST['p'];
    $cli = $_POST['cli'];
    $hEst = (float)$_POST['hEst'];
    $hReal = (float)$_POST['hReal'];
    $precio = (float)$_POST['precio'];
    $pMax = (float)$_POST['pMax'];
    $estado = $_POST['estado'];

    // Uso las funciones de funciones.php
    $cEstimado = calcularCoste($hEst, $precio);
    $cActual = calcularCoste($hReal, $precio);
    $hRest = calcularHorasRestantes($hEst, $hReal);
    $pct = calcularPorcentaje($hReal, $hEst);
    $msgPresu = comprobarPresupuesto($cActual, $pMax);

    // Aviso si me paso de horas
    $msgHoras = "";
    if ($hReal > $hEst) {
        $msgHoras = "ADVERTENCIA: Horas superadas";
    }
// Guardo todo en un array para mostrarlo abajo
    $info = compact('p', 'cli', 'estado', 'cEstimado', 'cActual', 'hRest', 'pct', 'msgPresu', 'msgHoras');
}


?>
<!DOCTYPE html>

<head>
    <title>Ejercicio 3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4 bg-light">
<div class="container" style="max-width: 600px;">
    <h2>Gestión de Proyecto</h2>

    <form method="POST">

        <div class="row">
            <div class="col"><input type="text" name="p" placeholder="Proyecto" class="form-control mb-2" required></div>
            <div class="col"><input type="text" name="cli" placeholder="Cliente" class="form-control mb-2" required></div>
        </div>

        <div class="row">
            <div class="col"><input type="number" name="hEst" placeholder="Horas Estimadas" class="form-control mb-2" required></div>
            <div class="col"><input type="number" name="hReal" placeholder="Horas Realizadas" class="form-control mb-2" required></div>
        </div>

        <div class="row">
            <div class="col"><input type="number" step="any" name="precio" placeholder="Precio/Hora" class="form-control mb-2" required></div>
            <div class="col"><input type="number" step="any" name="pMax" placeholder="Presupuesto Max" class="form-control mb-2" required></div>
        </div>

        <select name="estado" class="form-select mb-2">
            <option>Planificado</option>
            <option>En desarrollo</option>
            <option>En pruebas</option>
            <option>Finalizado</option>
        </select>

        <button class="btn btn-warning w-100 my-2">Comprobar</button>

    </form>

    <?php if ($info): ?>

    <div class="alert alert-info mt-3">
        <p><strong><?= $info['msgPresu'] ?></strong></p>
        <?php if ($info['msgHoras']): ?><p><?= $info['msgHoras'] ?></p><?php endif; ?>

        <ul>
            <li>Coste Estimado: <?= $info['cEstimado'] ?> €</li>
            <li>Coste Actual: <?= $info['cActual'] ?> €</li>
            <li>Horas Restantes: <?= $info['hRest'] ?> h</li>
            <li>Porcentaje: <?= number_format($info['pct'], 1) ?>%</li>

        </ul>
    </div>

    <?php endif; ?>
</div>

</body>


</html>