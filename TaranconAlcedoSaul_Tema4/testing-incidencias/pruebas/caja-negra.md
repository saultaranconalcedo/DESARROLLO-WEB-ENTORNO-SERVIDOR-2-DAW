# Pruebas de caja negra

Los resultados se comprueban en el servidor local, usando las cuentas de prueba y empezando cada escenario con una sesión válida o nueva según se indica.

| ID | Entrada | Resultado esperado | Resultado obtenido | Estado |
|---|---|---|---|---|
| T01 | Iniciar sesión con `admin` y contraseña `1234`. | Redirección al panel con opciones de administrador. | El panel muestra el rol Administrador y los enlaces de incidencias, alta y usuarios. | CORRECTO |
| T02 | Enviar `cliente01` con contraseña incorrecta. | El acceso no se concede y aparece `Usuario o contraseña incorrectos.` | Se mantiene el formulario y aparece el mensaje exacto; no se crea la sesión autenticada. | CORRECTO |
| T03 | Iniciar sesión como `tecnico01` y solicitar `usuarios.php`. | Respuesta HTTP 403 y pantalla de acceso prohibido. | El servidor responde 403 y muestra la pantalla Error 403. | CORRECTO |
| T04 | Iniciar sesión como `tecnico01`, editar la incidencia asignada #1 y guardar estado, prioridad y observaciones. Como `cliente02`, probar la edición de #1. | El técnico guarda los cambios; el cliente ajeno recibe 403. | Los cambios se guardan en la sesión y la petición del cliente ajeno finaliza con HTTP 403. | CORRECTO |
| T05 | En incidencias, elegir 10 registros por página y volver a cargar la lista. | Se crea `inc_limite` y se conserva la selección. | La cookie tiene valor `10` y el selector sigue mostrando 10 tras la redirección. | CORRECTO |
