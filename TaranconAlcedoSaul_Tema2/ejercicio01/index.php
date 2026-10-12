<?php
define("IVA", 21);
// Variables iniciales vacias para evitar avisos
$nombre = "";
$horas = $precio = $paginas = $alojamiento = 0;
$calculado = false;
// Solo calculo si me han enviado el formulario
if ($_POST) {
    $nombre = $_POST['nombre'];
    // Convierto los textos que vienen del formulario a numeros
    $horas = (float)$_POST['horas'];
    $precio = (float)$_POST['precio'];
    $paginas = (int)$_POST['paginas']; 
    $alojamiento = (float)$_POST['alojamiento'];

   
    $cDesarrollo = $horas * $precio;
    $subtotal = $cDesarrollo + $alojamiento;
    $totalIva = $subtotal * (IVA / 100);
    $total = $subtotal + $totalIva;
// Para saber si muestro la caja del resumen
    $calculado = true;
}
?>
<!DOCTYPE html>

<head>

    <title>Ejercicio 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="p-4 bg-light">

<div class="container" style="max-width: 500px;">
    <h2>Calculadora Presupuesto</h2>



    <form method="POST">
        <div class="mb-2"><label>Cliente:</label><input type="text" name="nombre" class="form-control" required></div>
        <div class="mb-2"><label>Horas de desarrollo:</label><input type="number" name="horas" class="form-control" required></div>
        <div class="mb-2"><label>Precio/Hora (€):</label><input type="number" step="any" name="precio" class="form-control" required></div>
        <div class="mb-2"><label>Número de páginas:</label><input type="number" name="paginas" class="form-control" required></div>
        <div class="mb-2"><label>Alojamiento (€):</label><input type="number" step="any" name="alojamiento" class="form-control" required></div>

        <button class="btn btn-primary w-100 my-2">Calcular</button>

    </form>

    <?php if ($calculado): ?>
    <pre class="bg-dark text-white p-3">
========================================
        PRESUPUESTO DE PROYECTO
========================================

Cliente: <?= $nombre ?>

Horas de desarrollo: <?= $horas ?>
Precio/hora: <?= $precio ?> €
Páginas del sitio: <?= $paginas ?>

Coste desarrollo: <?= number_format($cDesarrollo, 2) ?> €
Alojamiento: <?= number_format($alojamiento, 2) ?> €

Subtotal: <?= number_format($subtotal, 2) ?> €
IVA (21%): <?= number_format($totalIva, 2) ?> €

TOTAL: <?= number_format($total, 2) ?> €
    </pre>
    <?php endif; ?>

    
</div>

</body>


</html>