<?php
require_once 'funciones.php';
requerirLogin();

//Uso una cookie para recordar cuántas filas quiere ver el usuario
if (isset($_POST['limite'])) {
    $limite = $_POST['limite'];
    // Guardo la preferencia en cookie durante 30 dias
    setcookie('pref_limite', $limite, time() + (30 * 86400), '/');
} else {
    // Si no ha seleccionado nada uso la cookie guardada o 10 por defecto
    $limite = $_COOKIE['pref_limite'] ?? '10';
}

$todas = cargarIncidencias();
$rol = $_SESSION['rol'];
$user = $_SESSION['usuario'];

// Filtro simple para que cada perfil vea solo sus incidencias correspondientes
$misIncidencias = [];
foreach ($todas as $i) {
    if ($rol === 'Administrador') {
        $misIncidencias[] = $i; // El admin lo ve todo
    } elseif ($rol === 'Técnico' && $i['tecnico'] === $user) {
        $misIncidencias[] = $i; // El tecnico solo ve las asignadas a él
    } elseif ($rol === 'Cliente' && $i['cliente'] === $user) {
        $misIncidencias[] = $i; // El cliente solo ve sus propios tickets
    }
}
?>
<!DOCTYPE html>
<head>
    <title>Incidencias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">

<div class="container" style="max-width: 800px;">
    <div class="d-flex justify-content-between mb-3">
        <h3>Lista de Incidencias</h3>
        <a href="panel.php" class="btn btn-secondary btn-sm">Volver al panel</a>
    </div>

    <!-- Formulario para cambiar la cookie de limite -->
    <form method="POST" class="mb-3">
        <label>Mostrar elementos (Preferencia guardada en Cookie):</label>
        <select name="limite" onchange="this.form.submit()">
            <option value="5" <?= $limite == '5' ? 'selected' : '' ?>>5</option>
            <option value="10" <?= $limite == '10' ? 'selected' : '' ?>>10</option>
        </select>
    </form>

    <table class="table table-bordered bg-white">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Prioridad</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($misIncidencias)): ?>
                <tr><td colspan="5" class="text-center">No hay incidencias que mostrar.</td></tr>
            <?php else: ?>

                <!-- Corto el array con array_slice usando el numero guardado en la cookie -->
                 
                <?php foreach (array_slice($misIncidencias, 0, (int)$limite) as $inc): ?>
                    <tr>
                        <td><?= $inc['id'] ?></td>
                        <td><?= htmlspecialchars($inc['titulo']) ?></td>
                        <td><?= $inc['prioridad'] ?></td>
                        <td><?= $inc['estado'] ?></td>
                        <td>
                            <a href="detalle-incidencia.php?id=<?= $inc['id'] ?>" class="btn btn-info btn-sm text-white">Ver</a>
                            <a href="editar-incidencia.php?id=<?= $inc['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
