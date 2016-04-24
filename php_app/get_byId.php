<?php
/**
 * Obtiene el detalle de una meta especificada por
 * su identificador "idMeta"
 */

require 'wifi_point.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['id_point'])) {

        // Obtener parámetro id_point
        $parametro = $_GET['id_point'];

        // Tratar retorno
        $retorno = wifi_point::getById($parametro);


        if ($retorno) {

            $meta["estado"] = "1";
            $meta["meta"] = $retorno;
            // Enviar objeto json de la meta
            print json_encode($meta);
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro'
                )
            );
        }

    } else {
        // Enviar respuesta de error
        print json_encode(
            array(
                'estado' => '3',
                'mensaje' => 'Se necesita un identificador'
            )
        );
    }
}
