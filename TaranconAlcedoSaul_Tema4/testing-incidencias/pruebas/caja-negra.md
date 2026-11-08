# Tabla de Pruebas de Caja Negra

| ID | Entrada | Resultado esperado | Resultado obtenido | Estado |
|---|---|---|---|---|
| T01 | Login correcto (`admin` / `1234`) | Acceder al panel | Accede al panel | OK |
| T02 | Contraseña mal (`admin` / `0000`) | Error "Usuario o contraseña incorrectos" | Muestra mensaje de error | OK |
| T03 | Cliente entra a `usuarios.php` | Error 403 de servidor | Sale el cartel 403 | OK |
| T04 | Cambiar limite a 5 en la tabla | Guardar cookie | Cookie creada | OK |
