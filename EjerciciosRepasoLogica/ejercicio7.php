<?php
function eliminarCaracteresRepetidos($palabra)
{
    $resultado = "";

    for ($i = 0; $i < strlen($palabra); $i++) {
        $existe = false;
        // comprobamos si ya esta
        for ($j = 0; $j < strlen($resultado); $j++) {
            if ($palabra[$i] == $resultado[$j]) {
                $existe = true;
            }
        }
        if ($existe == false) {
            $resultado .= $palabra[$i];
        }
    }

    return $resultado;
}

$palabra = "programacion";
echo eliminarCaracteresRepetidos($palabra) . "<br>";
?>
