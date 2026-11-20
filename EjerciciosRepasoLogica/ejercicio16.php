<?php
function numeroConMasCifrasPares($numeros)
{
    $numero_con_mas_pares = 0;
    $mayor_cantidad_pares = -1;

    for ($i = 0; $i < 5; $i++) {
        $numero_actual = abs($numeros[$i]);
        $cantidad_pares = 0;

        do {
            $ultima_cifra = $numero_actual % 10;
            if ($ultima_cifra % 2 == 0) {
                $cantidad_pares++;
            }
            $numero_actual = (int) ($numero_actual / 10);
        } while ($numero_actual > 0);

        if ($cantidad_pares > $mayor_cantidad_pares) {
            $mayor_cantidad_pares = $cantidad_pares;
            $numero_con_mas_pares = $numeros[$i];
        }
    }

    return $numero_con_mas_pares . " tiene " . $mayor_cantidad_pares . " cifras pares";
}

$numeros = array(12345, 2468, 13579, 22222, 987654);
echo numeroConMasCifrasPares($numeros) . "<br>";
?>
