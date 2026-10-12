<?php
const MONEDA = "€";

function calcularCoste($horas, $precioHora)
{
    return $horas * $precioHora;
}

function calcularPorcentaje($horasEstimadas, $horasRealizadas)
{
    if ($horasEstimadas <= 0) {
        return 0;
    }

    return $horasRealizadas / $horasEstimadas * 100;
}

function comprobarPresupuesto($proyecto)
{
    $costeActual = calcularCoste($proyecto["horas_realizadas"], $proyecto["precio_hora"]);

    return $costeActual <= $proyecto["presupuesto"];
}

function obtenerProyectosActivos($proyectos)
{
    $proyectosActivos = array();

    foreach ($proyectos as $proyecto) {
        if ($proyecto["estado"] !== "Finalizado") {
            $proyectosActivos[] = $proyecto;
        }
    }

    return $proyectosActivos;
}

function obtenerEstadisticas($proyectos)
{
    $estadisticas = array(
        "cantidad_activos" => 0,
        "horas_estimadas" => 0,
        "horas_realizadas" => 0,
        "coste_previsto" => 0,
        "coste_actual" => 0,
        "dentro_presupuesto" => 0,
        "con_desviacion" => 0
    );

    // Las cifras del panel se calculan solo para proyectos que todavía no están finalizados.
    foreach (obtenerProyectosActivos($proyectos) as $proyecto) {
        $estadisticas["cantidad_activos"]++;
        $estadisticas["horas_estimadas"] += (float) $proyecto["horas_estimadas"];
        $estadisticas["horas_realizadas"] += (float) $proyecto["horas_realizadas"];
        $estadisticas["coste_previsto"] += calcularCoste($proyecto["horas_estimadas"], $proyecto["precio_hora"]);
        $estadisticas["coste_actual"] += calcularCoste($proyecto["horas_realizadas"], $proyecto["precio_hora"]);

        if (comprobarPresupuesto($proyecto)) {
            $estadisticas["dentro_presupuesto"]++;
        } else {
            $estadisticas["con_desviacion"]++;
        }
    }

    return $estadisticas;
}

function buscarProyecto($proyectos, $id)
{
    foreach ($proyectos as $proyecto) {
        if ($proyecto["id"] === $id) {
            return $proyecto;
        }
    }

    return null;
}

function obtenerProyectosConHorasSuperadas($proyectos)
{
    $proyectosConHorasSuperadas = array();

    foreach ($proyectos as $proyecto) {
        if ($proyecto["horas_realizadas"] > $proyecto["horas_estimadas"]) {
            $proyectosConHorasSuperadas[] = $proyecto;
        }
    }

    return $proyectosConHorasSuperadas;
}

function escapar($texto)
{
    return htmlspecialchars((string) $texto, ENT_QUOTES, "UTF-8");
}

function formatoEuros($cantidad)
{
    return number_format($cantidad, 2, ",", ".") . " " . MONEDA;
}
?>