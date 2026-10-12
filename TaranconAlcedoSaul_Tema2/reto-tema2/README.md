# TaranconAlcedoSaul_Tema2

## Objetivo

Este proyecto reúne cuatro ejercicios del tema 2 para practicar cómo PHP recibe datos de formularios, convierte tipos de datos y genera páginas HTML. El estilo es sencillo y utiliza Bootstrap 5.3.8 para los formularios, tablas, tarjetas y mensajes.

## Cómo ejecutar la aplicación

1. Copia la carpeta `TaranconAlcedoSaul_Tema2` dentro de la carpeta web de XAMPP, por ejemplo `C:\xampp\htdocs\`.
2. Inicia Apache desde el panel de XAMPP.
3. Abre `http://localhost/TaranconAlcedoSaul_Tema2/` en el navegador.
4. Selecciona uno de los ejercicios. Los ejercicios 1, 2 y 3 permiten introducir datos; el panel final utiliza proyectos de ejemplo guardados en un array PHP.

Se necesita conexión a Internet para cargar Bootstrap desde su CDN.

## Estructura de archivos

```text
TaranconAlcedoSaul_Tema2/
├── index.php
├── capturas/
│   ├── presupuesto-ejemplo.png
│   ├── nomina-ejemplo.png
│   ├── proyecto-ejemplo.png
│   └── panel-control.png
├── ejercicio01/
│   ├── index.php
│   └── estilos.css
├── ejercicio02/
│   ├── index.php
│   ├── funciones.php
│   └── estilos.css
├── ejercicio03/
│   ├── index.php
│   ├── funciones.php
│   └── estilos.css
└── reto-tema2/
    ├── index.php
    ├── funciones.php
    ├── datos.php
    ├── estilos.css
    └── README.md
```

## Funciones implementadas

### Ejercicio 2

- `calcularBrutoPorPaga($brutoAnual, $numeroPagas)`: divide el salario anual entre el número de pagas.
- `calcularRetencion($brutoPorPaga, $porcentajeRetencion)`: calcula la retención de una paga.
- `calcularNeto($brutoPorPaga, $porcentajeRetencion, $complementosMensuales)`: devuelve el neto estimado de una paga.
- `calcularNetoMensual($brutoAnual, $porcentajeRetencion, $complementosMensuales)`: calcula una estimación para un mes natural de 12 meses.

### Ejercicio 3

- `calcularCoste($horas, $precioHora)`: obtiene el coste multiplicando las horas por el precio.
- `calcularHorasRestantes($horasEstimadas, $horasRealizadas)`: devuelve la diferencia de horas.
- `calcularPorcentaje($horasEstimadas, $horasRealizadas)`: calcula el porcentaje de ejecución y evita dividir entre cero.
- `comprobarPresupuesto($costeActual, $presupuestoMaximo)`: devuelve `true` si el coste actual no supera el presupuesto.

### Reto final

- `calcularCoste($horas, $precioHora)`: calcula el coste de un proyecto.
- `calcularPorcentaje($horasEstimadas, $horasRealizadas)`: devuelve el porcentaje de ejecución.
- `comprobarPresupuesto($proyecto)`: indica si el coste actual está dentro del presupuesto.
- `obtenerProyectosActivos($proyectos)`: devuelve los proyectos no finalizados.
- `obtenerEstadisticas($proyectos)`: calcula totales y contadores para el panel.
- `buscarProyecto($proyectos, $id)`: devuelve el proyecto con el identificador indicado, o `null`.
- `obtenerProyectosConHorasSuperadas($proyectos)`: devuelve los proyectos que exceden las horas previstas.

## Tipos de datos y conversiones

- Cadenas de texto: nombres, clientes, categorías y estados.
- Enteros: número de páginas, pagas, desarrolladores e identificadores.
- Decimales (`float`): horas, porcentajes, precios, presupuestos y salarios.
- Booleanos: resultado de la comprobación del presupuesto.
- Arrays: errores de validación, estadísticas y proyectos.
- Los datos recibidos por `$_POST` son texto; se validan y luego se convierten con `(int)` o `(float)` antes de realizar operaciones.

## Ejemplo de funcionamiento

En la calculadora de presupuestos, al introducir 40 horas, 25 € por hora, 5 páginas, 100 € de alojamiento y un 21 % de IVA, se obtiene:

```text
Coste de desarrollo: 1.000,00 €
Subtotal: 1.100,00 €
IVA: 231,00 €
Total: 1.331,00 €
```

En el reto final, el panel obtiene los totales recorriendo los proyectos que no están finalizados y permite consultar cada proyecto con el botón “Consultar”.