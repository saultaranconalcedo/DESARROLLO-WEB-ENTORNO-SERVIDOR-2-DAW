<?php
// LEER COOKIES (Si existen las uso, si no, pongo valores por defecto)
$usuario = $_COOKIE['pref_usuario'] ?? 'Invitado';
$idioma = $_COOKIE['pref_idioma'] ?? 'es';
$registros = $_COOKIE['pref_registros'] ?? '10';
$vista = $_COOKIE['pref_vista'] ?? 'tarjetas';

// Variable para saber si hay cookies guardadas activas
$tienecookies = isset($_COOKIE['pref_usuario']);

// Mensajes de confirmacion
$msg = $_GET['msg'] ?? '';
?>
<!DOCTYPE html>
<html lang="<?= $idioma ?>">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 1 - Preferencias de Usuario y Cookies</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body class="bg-light p-4">

<div class="container" style="max-width: 700px;">
    
    <!-- AVISOS DE CONFIRMACION -->
    <?php if ($msg === 'guardado'): ?>
        <div class="alert alert-success alert-dismissible fade show">
            ¡Preferencias guardadas en cookies correctamente!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php elseif ($msg === 'borrado'): ?>
        <div class="alert alert-warning alert-dismissible fade show">
            Preferencias restablecidas y cookies eliminadas.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- TARJETA RESUMEN CON PREFERENCIAS ACTUALES -->
    <div class="card shadow-sm mb-4 border-primary">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Preferencias Actuales (Leídas de $_COOKIE)</h4>
        </div>
        <div class="card-body">
            <p><strong>Usuario:</strong> <?= htmlspecialchars($usuario) ?></p>
            <p><strong>Idioma:</strong> <?= $idioma === 'es' ? 'Español 🇪🇸' : 'English 🇬🇧' ?></p>
            <p><strong>Registros a mostrar:</strong> <?= htmlspecialchars($registros) ?> elementos</p>
            <p><strong>Tipo de vista:</strong> <?= $vista === 'tarjetas' ? 'Grid / Tarjetas 🎴' : 'Lista 📜' ?></p>
            <p class="mb-0 text-muted small">
                Estado: <?= $tienecookies ? '🟢 Cookies activas en tu navegador' : '⚪ Usando valores por defecto (sin cookies)' ?>
            </p>
        </div>
    </div>

    <!-- FORMULARIO DE CONFIGURACIÓN -->
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Configurar Preferencias</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="preferencias.php">
                <input type="hidden" name="accion" value="guardar">

                <div class="mb-3">
                    <label class="form-label">Nombre de usuario</label>
                    <input type="text" name="usuario" class="form-control" value="<?= htmlspecialchars($usuario) ?>" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Idioma</label>
                        <select name="idioma" class="form-select">
                            <option value="es" <?= $idioma === 'es' ? 'selected' : '' ?>>Español</option>
                            <option value="en" <?= $idioma === 'en' ? 'selected' : '' ?>>English</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Número de registros</label>
                        <select name="registros" class="form-select">
                            <option value="5" <?= $registros == '5' ? 'selected' : '' ?>>5 registros</option>
                            <option value="10" <?= $registros == '10' ? 'selected' : '' ?>>10 registros</option>
                            <option value="20" <?= $registros == '20' ? 'selected' : '' ?>>20 registros</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Tipo de visualización</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="vista" value="tarjetas" id="v1" <?= $vista === 'tarjetas' ? 'checked' : '' ?>>
                        <label class="form-check-input-label" for="v1">Tarjetas</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="vista" value="lista" id="v2" <?= $vista === 'lista' ? 'checked' : '' ?>>
                        <label class="form-check-input-label" for="v2">Lista</label>
                    </div>
                </div>

                <div class="d-flex justify-content-between pt-2">
                    <button type="submit" class="btn btn-success fw-bold">Guardar Preferencias</button>
                </div>
            </form>

            <!-- Boton aparte para restablecer / borrar -->
            <?php if ($tienecookies): ?>
                <hr>
                <form method="POST" action="preferencias.php">
                    <input type="hidden" name="accion" value="restablecer">
                    <button type="submit" class="btn btn-outline-danger btn-sm w-100">Restablecer / Borrar Cookies</button>
                </form>
            <?php endif; ?>
        </div>
    </div>

</div>

<!-- Bootstrap JS para cerrar las alertas -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>