<!DOCTYPE html>

<html>
<head>
    <title>Panel de Proyectos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">

    <h2>Panel de Gestión de Proyectos</h2>

    <!-- En action pongo /proyectos para que envie el GET a la ruta que configure en Routes.php -->
    <form method="GET" action="/proyectos" class="my-3">
        <label>Filtrar por estado:</label>
        <select name="estado">
            <option value="Todos" <?php if($estadoFiltro == 'Todos') echo 'selected'; ?>>Todos</option>
            <option value="Planificado" <?php if($estadoFiltro == 'Planificado') echo 'selected'; ?>>Planificado</option>
            <option value="En desarrollo" <?php if($estadoFiltro == 'En desarrollo') echo 'selected'; ?>>En desarrollo</option>
            <option value="En pruebas" <?php if($estadoFiltro == 'En pruebas') echo 'selected'; ?>>En pruebas</option>
            <option value="Finalizado" <?php if($estadoFiltro == 'Finalizado') echo 'selected'; ?>>Finalizado</option>
        </select>

        <button type="submit">Filtrar</button>
    </form>

    <!-- Tabla principal de proyectos (aqui solo pinto datos, la logica ya viene hecha del controlador) -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>PROYECTO</th>
                <th>CLIENTE</th>
                <th>ESTADO</th>
                <th>PROGRESO</th>
                <th>ACCIÓN</th>
            </tr>
        </thead>

        <tbody>
            <?php if (empty($proyectosFiltrados)): ?>

                <tr>
                    <td colspan="6">No hay proyectos en este estado.</td>
                </tr>
                
            <?php else: ?>
                <?php foreach ($proyectosFiltrados as $p): ?>
                    <tr>
                        <td><?= $p['id'] ?></td>
                        <td><?= $p['nombre'] ?></td>
                        <td><?= $p['cliente'] ?></td>
                        <td><?= $p['estado'] ?></td>
                        <td>
                            <!-- Imprimo directamente $p['progreso'] porque ya lo calcule en el controlador -->
                            <?= $p['progreso'] ?>%
                            <?php if ($p['horas_realizadas'] > $p['horas_estimadas']): ?>
                                <span class="text-danger">(Excedido)</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <!-- Enlace limpio a la ruta /proyectos/ID para abrir la vista de detalle -->
                            <a href="/proyectos/<?= $p['id'] ?>">Ver detalle</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>