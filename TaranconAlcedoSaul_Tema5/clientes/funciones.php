<?php

//Aqui se procesan los datos
//Cuenta cuantos clientes hay y devuelve el mensaje

$totalClientes = count($clientes);

$mensaje = "";

if ($totalClientes > 0) {
    $mensaje = "Se han encontrado " . $totalClientes . " clientes.";
} else {
    $mensaje = "No hay clientes registrados.";
}

//Ordena la lista de clientes alfabeticamentE
$clientesOrdenados = $clientes;

usort($clientesOrdenados, function ($a, $b) {
    return strcmp($a["cliente"], $b["cliente"]);
});