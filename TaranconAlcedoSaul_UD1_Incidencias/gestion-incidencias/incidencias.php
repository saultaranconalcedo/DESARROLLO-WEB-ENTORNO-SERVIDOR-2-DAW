<?php

function leerIncidencias()
{
    if (!isset($_SESSION["incidencias"])) {
        $_SESSION["incidencias"] = array();
    }

    return $_SESSION["incidencias"];
}

function guardarIncidencias($incidencias)
{
    $_SESSION["incidencias"] = $incidencias;
}

function buscarIncidencia($id)
{
    $incidencias = leerIncidencias();

    foreach ($incidencias as $incidencia) {

        if ($incidencia["id"] == $id) {
            return $incidencia;
        }
    }

    return null;
}

function siguienteId()
{
    $incidencias = leerIncidencias();

    if (count($incidencias) == 0) {
        return 1;
    }

    $ultima = end($incidencias);

    return $ultima["id"] + 1;
}

?>
