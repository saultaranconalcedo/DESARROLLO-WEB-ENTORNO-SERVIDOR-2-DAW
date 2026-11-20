<?php
function cifraMayorYMenor($numero)
{
    $cifra_mayor = 0;
    $cifra_menor = 9;

    do {
        $ultima_cifra = $numero % 10;
        if ($ultima_cifra > $cifra_mayor) {
            $cifra_mayor = $ultima_cifra;
        }
        if ($ultima_cifra < $cifra_menor) {
            $cifra_menor = $ultima_cifra;
        }
        $numero = (int) ($numero / 10);
    } while ($numero > 0);

    return array("mayor" => $cifra_mayor, "menor" => $cifra_menor);
}

$numero = 583214;
$cifras = cifraMayorYMenor($numero);
echo "Mayor: " . $cifras["mayor"] . ", Menor: " . $cifras["menor"] . "<br>";
?>
