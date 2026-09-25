<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<?php
$fichero = 'clientes.json';
$clientes = file_exists($fichero) ? json_decode(file_get_contents($fichero), true) : [];

$Nombre = trim($_POST['Nombre'] ?? '');
$Empresa = trim($_POST['Empresa'] ?? '');
$Correo = trim($_POST['Correo'] ?? '');
$Telefono = trim($_POST['Telefono'] ?? '');

$error = "";
$envio = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($Nombre)) {
        $error .= "El nombre es obligatorio <br>";
    }
    if (empty($Empresa)) {
        $error .= "La empresa es obligatoria <br>";
    }

    if (empty($Correo)) {
        $error .= "El correo es obligatorio <br>";
    } elseif (strpos($Correo, '@') === false || substr(strtolower($Correo), -4) !== '.com') {
        $error .= "El formato del correo no es valido <br>";
    }

    if (empty($Telefono)) {
        $error .= "El telefono es obligatorio <br>";
    } elseif (!ctype_digit($Telefono) || strlen($Telefono) !== 9) {
        $error .= "El telefono debe tener 9 numeros <br>";
    }

    if (empty($error)) {
        $nuevoId = count($clientes) + 1;
        $clientes[] = [
            'id' => $nuevoId,
            'Nombre' => $Nombre,
            'Empresa' => $Empresa,
            'Correo' => $Correo,
            'Telefono' => $Telefono
        ];
        file_put_contents($fichero, json_encode($clientes));
        $envio = "Cliente guardado correctamente";
        $Nombre = "";
        $Empresa = "";
        $Correo = "";
        $Telefono = "";
    }
}
?>

<div class="container-sm mt-5">

<h2>CLIENTES</h2>
<p>
    1. <a href="clientes.php">Listado de clientes</a> | 
    2. <a href="nuevo.php">Nuevo cliente</a>
</p>

<br>

<?php
if (!empty($error)) {
    echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
}
if (!empty($envio)) {
    echo '<div class="alert alert-success" role="alert">' . $envio . '</div>';
}
?>

<h3>Nuevo Cliente</h3>

<form method="POST">
  <div class="mb-3">
    <label for="Nombre" class="form-label">Nombre<span>*</span></label>
    <input type="text" class="form-control" id="Nombre" name="Nombre" value="<?php echo htmlspecialchars($Nombre); ?>">
  </div>

  <div class="mb-3">
    <label for="Empresa" class="form-label">Empresa<span>*</span></label>
    <input type="text" class="form-control" id="Empresa" name="Empresa" value="<?php echo htmlspecialchars($Empresa); ?>">
  </div>

  <div class="mb-3">
    <label for="Correo" class="form-label">Email <span>*</span></label>
    <input type="text" class="form-control" id="Correo" name="Correo" value="<?php echo htmlspecialchars($Correo); ?>">
  </div>

  <div class="mb-3">
    <label for="Telefono" class="form-label">Teléfono<span>*</span></label>
    <input type="text" class="form-control" id="Telefono" name="Telefono" value="<?php echo htmlspecialchars($Telefono); ?>">
  </div>
  
  <button type="submit" class="btn btn-primary">Guardar</button> 
</form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>