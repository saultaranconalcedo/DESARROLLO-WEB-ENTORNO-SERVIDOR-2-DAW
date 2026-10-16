<?php
// Traigo la lista de clientes desde clientes.php
require_once 'clientes.php';

// Recojo lo que han escrito en el buscador por GET
// Si no han escrito nada, se queda en blanco
$termino = trim($_GET['termino'] ?? '');

// Lista donde guardaremos los clientes que coincidan
$resultados = [];

// Recorro todos los clientes para ver si coinciden con la busqueda
foreach ($clientes as $c) {
    if ($termino === "") {
        // Si no se ha escrito nada, mostramos todos los clientes
        $resultados[] = $c;
    } else {
        // Busco la coincidencia en Nombre, Empresa o Email (sin importar mayusculas/minusculas)
        if (
            stripos($c['nombre'], $termino) !== false ||
            stripos($c['empresa'], $termino) !== false ||
            stripos($c['email'], $termino) !== false
        ) {
            $resultados[] = $c;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 2 - Buscador de Clientes</title>
    <!-- Bootstrap CDN para los estilos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body class="bg-light p-4">

<div class="container" style="max-width: 800px;">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Buscador de Clientes</h4>
        </div>
        <div class="card-body">

            <!-- FORMULARIO DE BÚSQUEDA (Método GET) -->
            <form method="GET" action="index.php" class="row g-2 mb-3">
                <div class="col-sm-9">
                    <input type="text" name="termino" class="form-control" placeholder="Buscar por Nombre, Empresa o Email..." value="<?= htmlspecialchars($termino) ?>">
                </div>
                <div class="col-sm-3">
                    <button type="submit" class="btn btn-success w-100">Buscar</button>
                </div>
            </form>

            <!-- Enlace para "Ver todos los clientes" sin filtro -->
            <div class="mb-3">
                <a href="index.php" class="btn btn-outline-secondary btn-sm">Ver todos los clientes</a>
            </div>

            <!-- RESULTADOS -->
            <h5 class="mt-4">RESULTADOS DE BÚSQUEDA</h5>
            <?php if ($termino !== ""): ?>
                <p class="text-muted"><strong>Criterio de búsqueda:</strong> <?= htmlspecialchars($termino) ?></p>
            <?php else: ?>
                <p class="text-muted"><strong>Mostrando:</strong> Todos los clientes</p>
            <?php endif; ?>

            <?php if (!empty($resultados)): ?>
                <!-- Tabla con los resultados -->
                <table class="table table-bordered table-striped mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>CLIENTE</th>
                            <th>EMPRESA</th>
                            <th>EMAIL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resultados as $row): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= htmlspecialchars($row['nombre']) ?></td>
                                <td><?= htmlspecialchars($row['empresa']) ?></td>
                                <td><?= htmlspecialchars($row['email']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <!-- Si la busqueda no devuelve nada -->
                <div class="alert alert-warning mt-3">
                    No se han encontrado clientes.
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

</body>
</html>