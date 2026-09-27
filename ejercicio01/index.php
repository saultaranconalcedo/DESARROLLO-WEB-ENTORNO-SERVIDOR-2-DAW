<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>

<body>

<?php
$Nombre = trim($_POST['Nombre'] ?? '');
$Empresa = trim($_POST['Empresa'] ?? '');
$Correo = trim($_POST['Correo'] ?? '');
$Telefono = trim($_POST['Telefono'] ?? '');
$Motivo = trim($_POST['Motivo'] ?? '');
$Mensaje = trim($_POST['Mensaje'] ?? '');

$error = "";
$envio = "";
$mensajeresum = "";

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

    if (empty($Motivo)) {
        $error .= "El motivo de la consulta es obligatorio <br>";
    }
    if (empty($Mensaje)) {
        $error .= "El mensaje es obligatorio <br>";
    }

    if (empty($error)) {
        $envio = "Todos los campos son correctos";
        $mensajeresum = "Resumen de los datos:<br>"; 
        $mensajeresum .= "Nombre: " . $Nombre . "<br>"; 
        $mensajeresum .= "Empresa: " . $Empresa . "<br>"; 
        $mensajeresum .= "Correo: " . $Correo . "<br>";
        $mensajeresum .= "Telefono: " . $Telefono . "<br>";
        $mensajeresum .= "Motivo: " . $Motivo . "<br>";
        $mensajeresum .= "Mensaje: " . $Mensaje . "<br>";
    }
}
?>




<div class="container-sm mt-5">
    
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

  <div class="mb-3">
    <label for="Motivo" class="form-label">Motivo de la consulta<span>*</span></label>
    <input type="text" class="form-control" id="Motivo" name="Motivo" value="<?php echo htmlspecialchars($Motivo); ?>">
  </div>

  <div class="mb-3">
    <label for="Mensaje" class="form-label">Mensaje<span>*</span></label>
    <input type="text" class="form-control" id="Mensaje" name="Mensaje" value="<?php echo htmlspecialchars($Mensaje); ?>">
  </div>
  
  <button type="submit" class="btn btn-primary">Enviar</button> 

</form>

<br>
<br>

<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($error)) {
        echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
        } else {
        echo '<div class="alert alert-success" role="alert">' . $envio . '</div>';
        echo '<div class="alert alert-success" role="alert">' . $mensajeresum . '</div>';
    }
}
?>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>