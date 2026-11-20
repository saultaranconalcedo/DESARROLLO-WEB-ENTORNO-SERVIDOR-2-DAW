<?php
function sumarCifras($numero)
{
    $suma_cifras = 0;

    while ($numero > 0) {
        $ultima_cifra = $numero % 10;
        $suma_cifras += $ultima_cifra;
        $numero = (int) ($numero / 10);
    }

    return $suma_cifras;
}

$numero = 58321;
echo sumarCifras($numero) . "<br>";
?>
