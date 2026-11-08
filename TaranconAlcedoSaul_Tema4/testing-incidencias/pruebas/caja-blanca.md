# Pruebas de Caja Blanca

## 1. Función `validarLogin()`
- Si el usuario no existe en la lista -> devuelve `false`.
- Si la contraseña no coincide -> devuelve `false`.
- Si todo es correcto -> devuelve los datos del usuario.

## 2. Función `comprobarRolPermitido()`
- Si no hay sesión iniciada -> redirige a `login.php`.
- Si el rol no está permitido -> saca cabecera HTTP 403 y detiene la página.
- Si el rol tiene permiso -> deja cargar el resto del archivo.
