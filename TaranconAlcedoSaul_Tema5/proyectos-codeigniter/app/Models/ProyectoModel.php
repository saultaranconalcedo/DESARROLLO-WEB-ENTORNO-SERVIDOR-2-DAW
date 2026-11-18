<?php

// Indico el namespace de la carpeta para que codeigniter encuentre esta clase
namespace App\Models;

// Importo la clase model para poder heredar de ella
use CodeIgniter\Model;

// En CodeIgniter el Modelo se encarga de los datos y de las funciones que los procesan 
class ProyectoModel extends Model {

    // Aqui tengo guardados los proyectos de la empresa (le pongo public porque ahora es un metodo de clase)
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