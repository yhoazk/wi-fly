<?php
/**
 * Actualiza una meta especificada por su identificador
 */

require 'wifi_point.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);

    // Actualizar meta
    $retorno = Meta::update(
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
                'mensaje' => 'Actualización exitosa')
        );
    } else {
        // Código de falla
        print json_encode(
            array(
                'estado' => '2',
                'mensaje' => 'Actualización fallida')
        );
    }
}
