<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

require('wifi_point.php');
//print "<p>popopopo</p>"

//      if (isset($_SERVER['HTTP_ORIGIN'])) {
//        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
//        header('Access-Control-Allow-Credentials: true');
//        header('Access-Control-Max-Age: 86400'); 
//        header('Content-Type: application/json;charset=utf-8');
//      }

// print "Error"
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
?>