<?php

namespace App\Controllers;

use App\Models\ProyectoModel;

class Proyectos extends BaseController {

    // Muestra el listado de proyectos
    public function index() {
        $modelo = new ProyectoModel();

        // Pido todos los proyectos
        $proyectos = $modelo->obtenerProyectos();

        // Miro si han filtrado por algun estado en el formulario GET
        $estadoFiltro = $this->request->getGet('estado') ?? 'Todos';
        $proyectosFiltrados = $modelo->filtrarPorEstado($proyectos, $estadoFiltro);

        // Calculo el porcentaje de ejecucion de cada proyecto para pasarlo a la vista
        foreach ($proyectosFiltrados as &$p) {
            $p['progreso'] = $modelo->calcularProgreso($p['horas_estimadas'], $p['horas_realizadas']);
        }

        // Cargo la vista del listado pasandole los datos
        return view('proyectos/listado', [
            'proyectosFiltrados' => $proyectosFiltrados,
            'estadoFiltro' => $estadoFiltro
        ]);
    }

    // Muestra la informacion de un proyecto concreto
    public function detalle($id) {
        $modelo = new ProyectoModel();

        // Pido todos los proyectos y busco el que coincide con el ID
        $proyectos = $modelo->obtenerProyectos();
        $proyectoDetalle = $modelo->obtenerProyecto($proyectos, $id);

        // Si no existe el proyecto vuelvo al listado
        if ($proyectoDetalle == null) {
            return redirect()->to('/proyectos');
        }

        // Calculo el porcentaje de ejecucion
        $progreso = $modelo->calcularProgreso($proyectoDetalle['horas_estimadas'], $proyectoDetalle['horas_realizadas']);

        // Cargo la vista de detalle
        return view('proyectos/detalle', [
            'proyectoDetalle' => $proyectoDetalle,
            'progreso' => $progreso
        ]);
    }
}