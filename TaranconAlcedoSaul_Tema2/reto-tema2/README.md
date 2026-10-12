# Panel de Control de Empresa de Desarrollo

## Nombre del proyecto
Panel de Control - Reto Tema 2

## Objetivo
Herramienta interna desarrollada en PHP para gestionar, calcular y consultar indicadores dinámicos sobre el estado, horas y costes de los proyectos de la empresa.

## Cómo ejecutar la aplicación
1. Copiar la carpeta del proyecto en la ruta raíz del servidor local (ej. `htdocs` en XAMPP).
2. Iniciar el servidor Apache.
3. Acceder en el navegador a `http://localhost/TaranconAlcedoSaul_Tema2/reto-tema2/index.php`.

## Estructura de archivos
- `index.php`: Vista del panel principal, buscador por ID y tabla de proyectos.
- `datos.php`: Contiene el array asociativo con los datos iniciales de los proyectos.
- `funciones.php`: Lógica de negocio (cálculo de costes, porcentajes, búsqueda y estadísticas).
- `estilos.css`: Estilos CSS auxiliares.
- `README.md`: Documentación de la entrega.

## Funciones implementadas
- `calcularCosteProyecto()`: Multiplica horas realizadas por precio por hora.
- `calcularPorcentajeEjecucion()`: Calcula el porcentaje de horas consumidas frente a las estimadas.
- `tieneDesviacion()`: Comprueba si el coste actual supera el presupuesto máximo.
- `obtenerProyectosExcedidosHoras()`: Identifica qué proyectos han gastado más horas de las previstas.
- `buscarProyectoPorId()`: Filtra y devuelve los datos de un proyecto específico según su ID.
- `obtenerEstadisticas()`: Calcula los indicadores globales del panel de control.

## Tipos de datos utilizados
- **Cadenas de texto (`string`):** Nombres de proyectos, clientes y estados.
- **Enteros (`int`):** IDs de proyectos y recuento de activos/totales.
- **Decimales (`float`):** Horas estimadas/realizadas, precios por hora y presupuestos.
- **Booleanos (`bool`):** Comprobación de desviación presupuestaria (`true`/`false`).
- **Arrays (`array`):** Listado asociativo de proyectos e indicadores globales.

## Conversiones realizadas
- Conversión explícita de `$_GET['id_consulta']` a entero `(int)` para realizar búsquedas seguras en el array.
- Formateo de flotantes a cadenas de texto formateadas en moneda mediante `number_format()`.

## Ejemplo de funcionamiento
Al cargar la página se muestran las métricas generales acumuladas de todos los proyectos activos, las alertas si algún proyecto supera las horas estimadas y la tabla completa detallando el estado de cada uno.