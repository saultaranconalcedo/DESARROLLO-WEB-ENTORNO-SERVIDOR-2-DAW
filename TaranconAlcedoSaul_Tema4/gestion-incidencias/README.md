# Ejercicio 3: Gestión de incidencias

Aplicación sencilla en PHP para gestionar tickets usando sesiones y perfiles. La interfaz utiliza Bootstrap desde CDN y los datos de las incidencias se guardan en la sesión.

## Usuarios de prueba

La contraseña de todos los usuarios es `1234`.

| Usuario | Perfil |
|---|---|
| `admin` | Administrador |
| `tecnico01`, `tecnico02` | Técnico |
| `cliente01`, `cliente02` | Cliente |

El administrador puede consultar todos los tickets y gestionar usuarios. Cada técnico consulta y edita los tickets que tiene asignados. Cada cliente consulta sus incidencias y puede registrar y editar las propias.

## Ejecución y cookie

Guarda la carpeta en el servidor local (por ejemplo, XAMPP) y abre `index.php` desde el navegador. La página de incidencias guarda en la cookie `inc_limite` la cantidad de registros elegida (5, 10 o 20); la preferencia dura 30 días.

Los usuarios y contraseñas están en memoria y solo sirven para practicar. La sesión contiene los datos de incidencias, por lo que estos se reinician al comenzar una sesión nueva.
