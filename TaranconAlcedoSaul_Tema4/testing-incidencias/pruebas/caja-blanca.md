# Pruebas de caja blanca

## `validarLogin($usuario, $contrasena)`

1. Obtiene el array de cuentas.
2. Si el usuario existe y la contraseña coincide exactamente, devuelve los datos del usuario (camino válido).
3. Si el usuario no existe o la contraseña no coincide, devuelve `false` (camino no válido).

Casos revisados: usuario existente con `1234` devuelve su perfil; usuario inexistente y contraseña incorrecta devuelven `false`.

## `comprobarRolPermitido($roles)`

1. Llama a `requerirLogin()`. Si no hay usuario autenticado, redirige a `login.php` y detiene la ejecución.
2. Si el rol de la sesión aparece en la lista permitida, continúa con la página solicitada.
3. Si el rol no está permitido, responde con HTTP 403, muestra la pantalla de error y ejecuta `exit`.

Casos revisados: un administrador accede a `usuarios.php`; un técnico o cliente recibe 403 en esa ruta; un usuario anónimo vuelve al login.

## `obtenerIncidenciasPorUsuario()`

1. Si el rol es Administrador, devuelve la lista completa.
2. Si el rol es Técnico, devuelve únicamente incidencias cuyo campo `tecnico` coincide con su usuario.
3. Si el rol es Cliente, devuelve únicamente incidencias cuyo campo `cliente` coincide con su usuario.
4. Para cualquier otro estado de sesión, devuelve una lista vacía.

Casos revisados: el administrador ve dos incidencias de ejemplo; `tecnico01` recibe la #1; `cliente02` recibe la #2; un rol no reconocido no obtiene resultados.
