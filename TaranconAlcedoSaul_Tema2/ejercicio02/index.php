<?php
require_once 'funciones.php';
$res = null;

if ($_POST) {
    $nombre = $_POST['nombre'];
    $cat = $_POST['cat'];
    // Convierto valores a numeros
    $bruto = (float)$_POST['bruto'];
    $pagas = (int)$_POST['pagas'];
    $ret = (float)$_POST['ret'];
    $comp = (float)$_POST['comp'];
// Evito dividir entre cero si ponen 0 pagas
    if ($pagas > 0) {
        $calc = calcularNeto($bruto, $pagas, $ret, $comp);
        // Junto los datos introducidos con los calculados
        $res = array_merge(['nombre' => $nombre, 'cat' => $cat, 'bruto' => $bruto, 'pagas' => $pagas, 'comp' => $comp], $calc);
    }
}
?>
<!DOCTYPE html>

<head>

    <title>Ejercicio 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="p-4 bg-light">

<div class="container" style="max-width: 500px;">
    <h2>Calcular Nómina</h2>

    <form method="POST">

        <div class="mb-2"><label>Nombre:</label><input type="text" name="nombre" class="form-control" required></div>
        <div class="mb-2"><label>Categoría:</label><input type="text" name="cat" class="form-control" required></div>
        <div class="mb-2"><label>Bruto Anual:</label><input type="number" step="any" name="bruto" class="form-control" required></div>
        <div class="mb-2"><label>Pagas:</label><input type="number" name="pagas" value="12" class="form-control" required></div>
        <div class="mb-2"><label>% Retención:</label><input type="number" step="any" name="ret" class="form-control" required></div>
        <div class="mb-2"><label>Complementos:</label><input type="number" step="any" name="comp" value="0" class="form-control"></div>
        <button class="btn btn-success w-100 my-2">Calcular</button>
        
    </form>


    <?php if ($res): ?>
    <pre class="bg-dark text-white p-3">
----------------------------------------
          RESUMEN SALARIAL
----------------------------------------

Trabajador: <?= $res['nombre'] ?>

Categoría: <?= $res['cat'] ?>


Bruto anual:    <?= number_format($res['bruto'], 2) ?> €
Número de pagas: <?= $res['pagas'] ?>

Bruto mensual:  <?= number_format($res['b_mensual'], 2) ?> €

Retención:      <?= number_format($res['retencion'], 2) ?> €
Complementos:   <?= number_format($res['comp'], 2) ?> €

Neto estimado:  <?= number_format($res['neto'], 2) ?> €
    </pre>
    <?php endif; ?>

</div>
</body>


</html>