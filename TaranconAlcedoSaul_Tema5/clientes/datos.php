<?php
// se guardan los registros de los clientes

function obtenerClientes() {
    return [
        [
            "id" => 1,
            "cliente" => "Juan García",
            "empresa" => "Tecnologías del Sur",
            "email" => "juan@tecsur.com"
        ],
        [
            "id" => 2,
            "cliente" => "María López",
            "empresa" => "Soluciones Web SL",
            "email" => "maria@solucionesweb.com"
        ],
        [
            "id" => 3,
            "cliente" => "Pedro Neto",
            "empresa" => "Informática Cádiz",
            "email" => "pedro@informaticacadiz.com"
        ],
        [
            "id" => 4,
            "cliente" => "Ana Martínez",
            "empresa" => "Digital Andalucía",
            "email" => "ana@digitalandalucia.com"
        ]
    ];
}