# Reto Tema 3: Gestión y Catálogo de Productos Informáticos

## Objetivo de la aplicación
Aplicación web interna para la administración de un catálogo de productos informáticos. Permite dar de alta nuevos productos y realizar búsquedas filtradas sobre la lista existente.

## Estructura del proyecto
- `index.php`: Portada principal del sistema.
- `productos.php`: Listado general con buscador por GET.
- `nuevo.php`: Formulario de alta mediante POST.
- `detalle.php`: Ficha detallada de un producto individual por ID.
- `funciones.php`: Funciones de validación, filtrado y búsqueda.
- `datos.php`: Array inicial con la base de datos simulada.
- `estilos.css`: Estilos visuales complementarios.
- `README.md`: Documentación del proyecto.

## Diferencias entre peticiones GET y POST
- **GET (`productos.php` / `detalle.php`)**: Se utiliza para enviar datos de consulta visibles en la URL (ej. `productos.php?categoria=Monitores`). Permite compartir la URL con filtros activos o marcadores.
- **POST (`nuevo.php`)**: Se utiliza para enviar datos de formulario de manera oculta en el cuerpo de la petición. Ideal para la creación de registros sin exponer datos en la URL.

## Validaciones realizadas
- **Cliente (HTML5)**: Uso de atributos `required`, `type="number"`, `min` y `step`.
- **Servidor (PHP)**: Comprobación de campos no vacíos, precio numérico mayor que cero y stock entero mayor o igual que cero.

## Mejoras futuras
- TODO: Conectar con una base de datos MySQL mediante PDO.
- TODO: Permitir la subida e inclusión de imágenes para cada producto.