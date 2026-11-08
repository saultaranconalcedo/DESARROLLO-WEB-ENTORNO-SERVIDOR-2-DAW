# Pruebas funcionales

- **Login:** comprobar el acceso válido con cada perfil, el rechazo de credenciales incorrectas y el cierre de sesión.
- **Formularios:** probar el alta con campos completos y vacíos; comprobar que el servidor rechaza valores obligatorios vacíos. Editar estado, prioridad y observaciones con el técnico asignado, y verificar que no se permite modificar incidencias ajenas.
- **Acceso por rol:** abrir directamente `usuarios.php` como técnico y cliente. La respuesta debe ser HTTP 403, aunque se escriba la URL manualmente.
- **Cookie:** seleccionar 5, 10 o 20 registros; confirmar que `inc_limite` queda guardada por 30 días y mantiene la selección al volver a cargar la lista.

Se pueden ejecutar los escenarios con el servidor local y las cuentas de prueba indicadas en `aplicacion/README.md`.
