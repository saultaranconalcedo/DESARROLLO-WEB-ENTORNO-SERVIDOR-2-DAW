<?php

namespace App\Models;

use CodeIgniter\Model;

class ProyectoModel extends Model {

    // Aqui tenemos guardados los proyectos de la empresa
    public function obtenerProyectos() {
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

    // Aqui van las funciones para procesar los proyectos

    // Busca un proyecto concreto por su ID para ver los detalles
    public function obtenerProyecto($proyectos, $id) {
        foreach ($proyectos as $p) {
            if ($p["id"] == $id) {
                return $p;
            }
        }
        return null;
    }

    // Filtra la lista segun el estado que elija el usuario
    public function filtrarPorEstado($proyectos, $estado) {
        if ($estado == "" || $estado == "Todos") {
            return $proyectos;
        }

        $resultado = [];
        foreach ($proyectos as $p) {
            if ($p["estado"] == $estado) {
                $resultado[] = $p;
            }
        }
        return $resultado;
    }

    // Calcula el porcentaje de ejecucion del proyecto
    public function calcularProgreso($estimadas, $realizadas) {
        if ($estimadas <= 0) {
            return 0;
        }
        $porcentaje = ($realizadas / $estimadas) * 100;
        return round($porcentaje);
    }
}