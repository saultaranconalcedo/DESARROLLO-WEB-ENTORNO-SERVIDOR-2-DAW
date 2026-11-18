<!DOCTYPE html>
<head>
    <title>Panel de Proyectos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color: #f4f4f4; padding: 30px;">

<div style="max-width: 850px; margin: auto; background-color: white; padding: 25px; border: 1px solid #ddd;">
    <h2>Panel de Gestión de Proyectos</h2>
    <hr>

    <!-- Filtro por estado usando GET -->
    <form method="GET" action="<?= base_url('proyectos') ?>" class="mb-4">
        <label><b>Filtrar por estado:</b></label>

        <select name="estado">
            <option value="Todos" <?php if($estadoFiltro == 'Todos') echo 'selected'; ?>>Todos</option>
            <option value="Planificado" <?php if($estadoFiltro == 'Planificado') echo 'selected'; ?>>Planificado</option>
            <option value="En desarrollo" <?php if($estadoFiltro == 'En desarrollo') echo 'selected'; ?>>En desarrollo</option>
            <option value="En pruebas" <?php if($estadoFiltro == 'En pruebas') echo 'selected'; ?>>En pruebas</option>
            <option value="Finalizado" <?php if($estadoFiltro == 'Finalizado') echo 'selected'; ?>>Finalizado</option>
        </select>

        <button type="submit" class="btn btn-primary btn-sm">Filtrar</button>
    </form>

    <!-- Tabla principal de proyectos -->
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>PROYECTO</th>
                <th>CLIENTE</th>
                <th>ESTADO</th>
                <th>EJECUCIÓN</th>
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
                            <?= $p['progreso'] ?>%
                            <?php if ($p['horas_realizadas'] > $p['horas_estimadas']): ?>
                                <span class="text-danger"><b>(Excedido)</b></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= base_url('proyectos/' . $p['id']) ?>" class="btn btn-info btn-sm">Ver detalle</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>