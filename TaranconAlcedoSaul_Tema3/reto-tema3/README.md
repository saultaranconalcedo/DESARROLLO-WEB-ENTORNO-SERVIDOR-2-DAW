# Reto Tema 3: Gestión y Catálogo de Productos Informáticos

## Objetivo
Aplicación interna básica desarrollada en PHP para administrar un catálogo de productos informáticos.

## Estructura del proyecto
- `index.php`: Página de inicio con accesos principales.
- `productos.php`: Listado completo con buscador por método GET.
- `nuevo.php`: Formulario para dar de alta un producto por método POST.
- `detalle.php`: Vista individual detallada de un producto por ID.
- `funciones.php`: Funciones para validar, filtrar y consultar productos.
- `datos.php`: Array inicial con la base de datos simulada.
- `estilos.css`: Ajustes CSS adicionales.

## Diferencias entre GET y POST
- **GET (`productos.php` / `detalle.php`)**: Envía los datos visibles en la propia URL. Se usa para búsquedas y consultas para poder compartir enlaces directos.
- **POST (`nuevo.php`)**: Envía los datos ocultos en la petición HTTP. Se utiliza para enviar formularios con información que se va a procesar en el servidor.

## Validaciones
- **En cliente**: Realizadas con los atributos `required`, `type`, `min` y `step` de HTML5.
- **En servidor**: Comprobadas en PHP asegurando campos no vacíos, precio numérico mayor que 0 y stock mayor o igual a 0.

## Tareas pendientes
- TODO: Conectar la aplicación con una base de datos MySQL mediante PDO.
- TODO: Permitir la opción de editar y borrar productos existentes.