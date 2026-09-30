<?php
$jsonFile = 'clientes.json';
$array_clientes = file_exists($jsonFile) ? json_decode(file_get_contents($jsonFile), true) : [];

// Procesamiento de acciones enviadas mediante GET o POST
$txAccion = $_REQUEST['txAccion'] ?? '';

switch ($txAccion) {
    case 'crearNuevo':
        $txNombre = $_POST['txNombre'] ?? '';
        $txEmpresa = $_POST['txEmpresa'] ?? '';
        $txEmail = $_POST['txEmail'] ?? '';
        $txTelefono = $_POST['txTelefono'] ?? '';

        if (!empty($txNombre) && !empty($txEmpresa) && !empty($txEmail) && !empty($txTelefono)) {
            agregarCliente($array_clientes, $txNombre, $txEmpresa, $txEmail, $txTelefono, $jsonFile);
            header("Location: index.php?mensaje=Cliente agregado correctamente");
            exit;
        }
        break;

    case 'eliminar':
        $idCliente = $_POST['idCliente'] ?? '';
        if (!empty($idCliente)) {
            $array_clientes = eliminarCliente($array_clientes, $idCliente, $jsonFile);
            header("Location: index.php?mensaje=Cliente eliminado correctamente");
            exit;
        }
        break;

    case 'accionBuscar':
        $txBuscar = $_GET['txBuscar'] ?? '';
        $array_clientes = consultarClientes($array_clientes, $txBuscar);
        break;
}

function agregarCliente($array_clientes, $nombre, $empresa, $email, $telefono, $jsonFile) {
    $nuevoId = !empty($array_clientes) ? max(array_column($array_clientes, 'id')) + 1 : 1;
    
    $nuevoCliente = [
        'id' => $nuevoId,
        'nombre' => $nombre,
        'empresa' => $empresa,
        'email' => $email,
        'telefono' => $telefono
    ];

    $array_clientes[] = $nuevoCliente;
    file_put_contents($jsonFile, json_encode(array_values($array_clientes), JSON_PRETTY_PRINT));
}

function eliminarCliente($array_clientes, $id, $jsonFile) {
    foreach ($array_clientes as $key => $cliente) {
        if ((string)$cliente['id'] === (string)$id) {
            unset($array_clientes[$key]);
            break;
        }
    }
    file_put_contents($jsonFile, json_encode(array_values($array_clientes), JSON_PRETTY_PRINT));
    return array_values($array_clientes);
}

function consultarClientes($array_clientes, $txBuscar) {
    if (empty($txBuscar)) {
        return $array_clientes;
    }

    $clientesEncontrados = [];
    foreach ($array_clientes as $cliente) {
        if (
            stripos($cliente['nombre'], $txBuscar) !== false || 
            stripos($cliente['empresa'], $txBuscar) !== false || 
            stripos($cliente['email'], $txBuscar) !== false || 
            stripos($cliente['telefono'], $txBuscar) !== false
        ) {
            $clientesEncontrados[] = $cliente;
        }
    }
    return $clientesEncontrados;
}