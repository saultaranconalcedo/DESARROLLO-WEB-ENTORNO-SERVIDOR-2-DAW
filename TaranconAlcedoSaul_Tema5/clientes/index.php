<?php
// Cargo primero los datos y luego las funciones para que se procesen

require_once 'datos.php';
require_once 'funciones.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de clientes</title>
    <!-- Enlaze-->
    <link rel="stylesheet" href="estilos.css">
</head>

<body>

<h1>Listado de clientes</h1>
<!-- Muestro el mensaje calculado en funciones.php -->
<div class="mensaje">
    <?php echo $mensaje; ?>
</div>

<?php
// Si hay clientes dibujo la tabla sino muestro el aviso

if ($totalClientes > 0) {

    echo "<table>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>CLIENTE</th>";
    echo "<th>EMPRESA</th>";
    echo "<th>EMAIL</th>";
    echo "</tr>";


    foreach ($clientesOrdenados as $cliente) {

        echo "<tr>";

        echo "<td>";
        echo $cliente["id"];
        echo "</td>";

        echo "<td>";
        echo $cliente["cliente"];
        echo "</td>";

        echo "<td>";
        echo $cliente["empresa"];
        echo "</td>";

        echo "<td>";
        echo $cliente["email"];
        echo "</td>";

        echo "</tr>";
    }

    echo "</table>";

} else {
    echo "<p> No existen clientes para mostrar.</p>";
}
?>

<br>
<p>
    Total de clientes:
    <?php echo $totalClientes; ?>
</p>

</body>
</html>