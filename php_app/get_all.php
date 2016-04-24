<?php
/**
 * Obtiene todas las metas de la base de datos
 */

require 'wifi_point.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Manejar petición GET
    $points = wifi_point::getAll();

    if ($points) {

        $datos["estado"] = 1;
        $datos["metas"] = $points;

        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}
