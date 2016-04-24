<?php
/**
 * Insertar una nueva meta en la base de datos
 */

require 'wifi_point.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);

    // Insertar meta
    $retorno = wifi_point::insert(
        $body['mac48'],
        $body['ssid'],
        $body['coord_lat'],
        $body['coord_lon'],
        $body['accesible'],
        $body['date_detec'],
        $body['id_point']);

    if ($retorno) {
        // Código de éxito
        print json_encode(
            array(
                'estado' => '1',
                'mensaje' => 'Creación exitosa')
        );
    } else {
        // Código de falla
        print json_encode(
            array(
                'estado' => '2',
                'mensaje' => 'Creación fallida')
        );
    }
}
