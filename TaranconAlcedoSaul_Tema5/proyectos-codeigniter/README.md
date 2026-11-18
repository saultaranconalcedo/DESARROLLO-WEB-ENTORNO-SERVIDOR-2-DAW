# Ejercicio 3 - Panel de Gestión de Proyectos en CodeIgniter 4

## 1. Problema que resuelve
Migración del panel de gestión de proyectos desarrollado en PHP estructurado al patrón Modelo-Vista-Controlador (MVC) mediante CodeIgniter 4, separando los datos, la lógica de negocio y las vistas para facilitar el mantenimiento del código.

## 2. Estructura MVC utilizada
- **Modelo (`app/Models/ProyectoModel.php`)**: Contiene los datos de los proyectos y las funciones para buscar, filtrar y calcular el progreso.
- **Controlador (`app/Controllers/Proyectos.php`)**: Recibe las peticiones del usuario, solicita los datos al modelo y carga las vistas correspondientes.
- **Vistas (`app/Views/proyectos/`)**: Archivos HTML/PHP encargados de mostrar la interfaz (`listado.php` y `detalle.php`) sin realizar cálculos ni consultas.

## 3. Funciones del Controlador (`Proyectos.php`)
- `index()`: Recoge el filtro `estado` por GET, solicita los proyectos filtrados al modelo, calcula el progreso de cada uno y carga la vista `proyectos/listado`.
- `detalle($id)`: Recibe el ID del proyecto desde la URL, lo busca a través del modelo, calcula su progreso y carga la vista `proyectos/detalle`.

## 4. Funciones del Modelo (`ProyectoModel.php`)
- `obtenerProyectos()`: Devuelve el array con todos los proyectos de la empresa.
- `obtenerProyecto($proyectos, $id)`: Busca un proyecto concreto por su ID para ver los detalles.
- `filtrarPorEstado($proyectos, $estado)`: Filtra la lista según el estado que elija el usuario.
- `calcularProgreso($estimadas, $realizadas)`: Calcula el porcentaje de ejecución del proyecto.

## 5. Vistas creadas
- `app/Views/proyectos/listado.php`: Muestra el desplegable para filtrar por estado y la tabla principal de proyectos con su porcentaje y enlace al detalle.
- `app/Views/proyectos/detalle.php`: Muestra la ficha completa de un proyecto y la alerta en rojo si las horas realizadas superan las previstas.

## 6. Rutas configuradas (`app/Config/Routes.php`)
- `GET /proyectos` -> `Proyectos::index`
- `GET /proyectos/(:num)` -> `Proyectos::detalle/$1`

## 7. Cómo ejecutar el proyecto
1. Abrir una terminal dentro de la carpeta `proyectos-codeigniter/`.
2. Arrancar el servidor integrado de CodeIgniter:
   ```bash
   php spark serve