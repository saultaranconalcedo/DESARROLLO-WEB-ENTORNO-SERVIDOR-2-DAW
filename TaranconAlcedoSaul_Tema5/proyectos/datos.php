<?php
// Aqui tenemos guardados los proyectos de la empresa

function obtenerProyectos() {
    return [
        [
            "id" => 1,
            "nombre" => "Web corporativa",
            "cliente" => "Empresa A",
            "horas_estimadas" => 100,
            "horas_realizadas" => 65,
            "estado" => "En desarrollo"
        ],
        [
            "id" => 2,
            "nombre" => "App móvil",
            "cliente" => "Empresa B",
            "horas_estimadas" => 80,
            "horas_realizadas" => 95, // Este supera las horas previstas para probar la alerta
            "estado" => "En pruebas"
        ],
        [
            "id" => 3,
            "nombre" => "Intranet",
            "cliente" => "Empresa C",
            "horas_estimadas" => 120,
            "horas_realizadas" => 120,
            "estado" => "Finalizado"
        ],
        [
            "id" => 4,
            "nombre" => "Tienda Online",
            "cliente" => "Empresa D",
            "horas_estimadas" => 150,
            "horas_realizadas" => 0,
            "estado" => "Planificado"
        ]
    ];
}