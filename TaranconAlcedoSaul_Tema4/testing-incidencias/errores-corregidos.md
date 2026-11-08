# Informe de Depuración de Errores

## ERROR Nº 1
- **Descripción:** El usuario cliente podía ver la lista de todos los usuarios poniendo `usuarios.php` arriba en el navegador.
- **Causa:** No se estaba comprobando el rol del usuario en la parte superior del archivo.
- **Solución aplicada:** Añadido `comprobarRolPermitido(['Administrador']);` al principio.
- **Prueba realizada:** Entrar como `cliente01` e ir a `usuarios.php`.
- **Resultado:** CORRECTO (Sale el error 403).

## ERROR Nº 2
- **Descripción:** Al crear una nueva incidencia el ID salía duplicado.
- **Causa:** El conteo del array no sumaba bien la clave siguiente.
- **Solución aplicada:** Cambiado a `$nuevoId = count($todas) + 1;`.
- **Prueba realizada:** Crear dos incidencias seguidas.
- **Resultado:** CORRECTO.
