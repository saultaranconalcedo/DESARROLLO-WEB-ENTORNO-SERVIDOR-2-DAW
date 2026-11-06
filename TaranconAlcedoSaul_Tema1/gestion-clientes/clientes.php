<?php

$array_clientes = json_decode(file_get_contents('clientes.json'), true);

$txAccion = $_POST['txAccion'] ?? '';

switch ($txAccion) {

    case 'crearNuevo':

        $txNombre = $_POST['txNombre'];
        $txEmpresa = $_POST['txEmpresa'];
        $txEmail = $_POST['txEmail'];
        $txTelefono = $_POST['txTelefono'];

        agregarCliente(
            $array_clientes,
            $txNombre,
            $txEmpresa,
            $txEmail,
            $txTelefono
        );

        header("Location: index.php?mensaje=Cliente agregado correctamente");
        break;


    case 'eliminar':

        $idCliente = $_POST['idCliente'];

        eliminarCliente($array_clientes, $idCliente);

        header("Location: index.php?mensaje=Cliente eliminado correctamente");
        break;

    default:

        echo "";

}


function agregarCliente($array_clientes, $nombre, $empresa, $email, $telefono)
{

    $nuevoCliente = [

        'id' => $array_clientes != NULL ? count($array_clientes) + 1 : 1,

        'nombre' => $nombre,

        'empresa' => $empresa,

        'email' => $email,

        'telefono' => $telefono

    ];

    $array_clientes[] = $nuevoCliente;

    file_put_contents(
        'clientes.json',
        json_encode($array_clientes)
    );
}


function eliminarCliente($array_clientes, $id)
{

    foreach ($array_clientes as $key => $cliente) {

        if ($cliente['id'] == $id) {

            unset($array_clientes[$key]);

            break;
        }
    }

    $array_clientes = array_values($array_clientes);

    file_put_contents(
        'clientes.json',
        json_encode($array_clientes)
    );
}

?>