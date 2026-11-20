<?php
function invertirCifras($numero)
{
    $numero_invertido = 0;
    $numero_original = $numero;
    $numero = abs($numero);

    while ($numero > 0) {
        $ultima_cifra = $numero % 10;
        $numero_invertido = $numero_invertido * 10 + $ultima_cifra;
        $numero = (int) ($numero / 10);
    }

    if ($numero_original < 0) {
        $numero_invertido = -$numero_invertido;
    }

    return $numero_invertido;
}

$numero = 123456;
echo invertirCifras($numero) . "<br>";
?>
