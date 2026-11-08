# Errores corregidos durante la depuración

## Error 1: se podía abrir una página restringida conociendo su URL

- **Descripción:** ocultar el enlace de usuarios no impedía que un técnico o cliente accediera escribiendo `usuarios.php` en el navegador.
- **Causa:** la protección estaba únicamente en la interfaz.
- **Solución aplicada:** `usuarios.php` llama a `comprobarRolPermitido(['Administrador'])`; la función responde con HTTP 403 y detiene la ejecución cuando el rol no está autorizado.
- **Prueba realizada:** sesión de técnico solicitando directamente `usuarios.php`; respuesta HTTP 403 y pantalla de error. **Resultado: CORRECTO**.

## Error 2: un cliente podía editar la incidencia de otro cliente

- **Descripción:** modificar el identificador de la incidencia en la URL permitía intentar editar un ticket ajeno.
- **Causa:** no se contrastaba el propietario del ticket con el usuario autenticado en el servidor.
- **Solución aplicada:** antes de mostrar o procesar el formulario, `editar-incidencia.php` comprueba la propiedad de la incidencia y devuelve HTTP 403 si el cliente no es su propietario.
- **Prueba realizada:** sesión de `cliente02` intentando abrir la incidencia #1, asignada a `cliente01`; respuesta HTTP 403 y ningún dato modificado. **Resultado: CORRECTO**.
