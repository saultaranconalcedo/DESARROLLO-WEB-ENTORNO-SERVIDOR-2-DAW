<?php

function invertirPalabra($palabra)
{
  $palabra_a_letras=str_split($palabra);
  $palabra_invertida = "";
  for ($i=0; $i < strlen($palabra); $i++) {
    $palabra_invertida .= $palabra_a_letras[strlen($palabra) -1 -$i];
  }
  return $palabra_invertida;
}

$palabra = "onu";

echo "Palabra original: " . $palabra . "<br>";
echo "Palabra invertida: " . invertirPalabra($palabra);

?>