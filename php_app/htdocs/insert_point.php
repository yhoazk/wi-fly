<?php
/**
 * Insertar una nueva meta en la base de datos
 */
//http://localhost:8080/wifly/insert_point.php?&mac48=221133664455&ssid=wifiToolBar&coord_lat=20.700616&coord_lon=20.700616&accesible=med&date_detec=2016-05-20&id_point=5

require 'wifi_point.php';
ini_set('display_errors', 'On');
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);
    print("SSID");
    print($body['ssid'].$body['ssid']);
    // Insertar meta
    $retorno = wifi_point::insert(
        $body['mac48'],
        $body['ssid'],
        $body['coord_lat'],
        $body['coord_lon'],
        $body['accesible'],
        $body['date_detec'],
        $body['id_point']   );

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
?>