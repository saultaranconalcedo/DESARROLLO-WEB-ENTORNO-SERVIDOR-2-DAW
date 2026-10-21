# Ejercicio 3: Registro de Incidencias de Soporte Técnico

## Descripción
Aplicación web desarrollada en PHP para el registro y procesamiento de incidencias de soporte técnico.

## Funcionalidades
- Formulario interactivo con campos validados en cliente (HTML5) y servidor (PHP).
- Generación automática de identificador de incidencia (`INC-AÑO-NUMERO`).
- Asignación de fecha/hora automática y estado por defecto ("Pendiente").
- Control de prioridades y categorías.

## Estructura
- `index.php`: Interfaz gráfica con el formulario y muestra de resultados.
- `funciones.php`: Lógica de validación y generación de incidencias.
- `estilos.css`: Personalización visual complementaria.
- `README.md`: Documentación del ejercicio.

## Tareas Futuras
- TODO: Conectar con una base de datos MySQL para persistir los tickets registrados.
- TODO: Enviar una notificación por correo electrónico al cliente tras registrar la incidencia.