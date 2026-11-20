<?php
function sonAnagramas($palabra1, $palabra2)
{
    $palabra1 = strtolower($palabra1);
    $palabra2 = strtolower($palabra2);

    if (strlen($palabra1) != strlen($palabra2)) {
        return false;
    }

    for ($i = 0; $i < strlen($palabra1); $i++) {
        $cont1 = 0;
        $cont2 = 0;

        for ($j = 0; $j < strlen($palabra1); $j++) {
            if ($palabra1[$i] == $palabra1[$j]) {
                $cont1++;
            }
            if ($palabra1[$i] == $palabra2[$j]) {
                $cont2++;
            }
        }

        if ($cont1 != $cont2) {
            return false;
        }
    }

    return true;
}

$palabra1 = "roma";
$palabra2 = "amor";
if (sonAnagramas($palabra1, $palabra2)) {
    echo "Son anagramas.<br>";
} else {
    echo "No son anagramas.<br>";
}
?>
