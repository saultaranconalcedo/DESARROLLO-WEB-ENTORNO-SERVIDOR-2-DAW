<?php

namespace App\Controllers;

// Importo mi modelo para poder pedirle los datos y usar sus funciones
use App\Models\ProyectoModel;

// El controlador recibe lo que pide el usuario habla con el modelo y carga la vista
class Proyectos extends BaseController {

    // Metodo que se ejecuta al entrar en /proyectos
    public function index() {

        // Creo un objeto de mi modelo para acceder a sus metodos
        $modelo = new ProyectoModel();
        $proyectos = $modelo->obtenerProyectos();

        // Recojo el filtro por GET usando el objeto request de CodeIgniter (si no hay nada pongo 'Todos')
        $estadoFiltro = $this->request->getGet('estado') ?? 'Todos';
        $proyectosFiltrados = $modelo->filtrarPorEstado($proyectos, $estadoFiltro);

        // Calculo aqui el porcentaje de cada proyecto porque en MVC la vista no debe hacer calculos asi le mando el dato progreso ya listo para imprimir
        foreach ($proyectosFiltrados as $i => $p) {
            $proyectosFiltrados[$i]['progreso'] = $modelo->calcularProgreso($p['horas_estimadas'], $p['horas_realizadas']);
        }

        // Llamo a listado.php y le paso las variables que necesita para pintar la tabla y el filtro
        return view('proyectos/listado', [
            'proyectosFiltrados' => $proyectosFiltrados,
            'estadoFiltro' => $estadoFiltro
        ]);
    }

    // Metodo que se ejecuta al entrar en /proyectos/ID (recibe el numero de la URL)
    public function detalle($id) {
        $modelo = new ProyectoModel();
        $proyectos = $modelo->obtenerProyectos();
        $proyectoDetalle = $modelo->obtenerProyecto($proyectos, $id);

        // Si alguien escribe un ID que no existe en la barra del navegador lo mando de vuelta al listado
        if ($proyectoDetalle == null) {
            return redirect()->to('/proyectos');
        }

        // Calculo su porcentaje aqui antes de pasarselo a la vista
        $progreso = $modelo->calcularProgreso($proyectoDetalle['horas_estimadas'], $proyectoDetalle['horas_realizadas']);

        // Cargo la vista independiente de detalle con los datos de ese proyecto
        return view('proyectos/detalle', [
            'proyectoDetalle' => $proyectoDetalle,
            'progreso' => $progreso
        ]);
    }
}