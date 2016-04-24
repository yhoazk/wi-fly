<?php

/**
 * Representa el la estructura de las metas
 * almacenadas en la base de datos
 */
require 'Database.php';

class wifly_point
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'meta'
     *
     * @param $idMeta Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT * FROM wifly_points";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();

            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Obtiene los campos de una meta con un identificador
     * determinado
     *
     * @param $idMeta Identificador de la meta
     * @return mixed
     */
    public static function getById($idPoint)
    {
        // Consulta de la meta
        $consulta = "SELECT mac48,
                            ssid,
                            coord_lat,
                            coord_lon,
                            accesible,
                            date_detec,
                            id_point
                            FROM wifly_points
                            WHERE id_point = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idPoint));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

    /**
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *
     * @param $idMeta      identificador
     * @param $titulo      nuevo titulo
     * @param $descripcion nueva descripcion
     * @param $fechaLim    nueva fecha limite de cumplimiento
     * @param $categoria   nueva categoria
     * @param $prioridad   nueva prioridad
     */
    public static function update(
        $mac48,
        $ssid,
        $coord_lat,
        $coord_lon,
        $accesible,
        $date_detec,
        $id_point
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE wifly_points" .
            " SET mac48=?, ssid=?, coord_lat=?, coord_lon=?, accesible=?, date_detec=?,  id_point=?" .
            "WHERE id_point=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($mac48, $ssid, $coord_lat, $coord_lon, $accesible, $date_detec, $id_point));
        return $cmd;
    }

    /**
     * Insertar una nueva meta
     *
     * @param $titulo      titulo del nuevo registro
     * @param $descripcion descripción del nuevo registro
     * @param $fechaLim    fecha limite del nuevo registro
     * @param $categoria   categoria del nuevo registro
     * @param $prioridad   prioridad del nuevo registro
     * @return PDOStatement
     */
    public static function insert(
      $mac48,
      $ssid,
      $coord_lat,
      $coord_lon,
      $accesible,
      $date_detec,
      $id_point
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO wifly_points ( " .
        "mac48,".
        "ssid,".
        "coord_lat,".
        "coord_lon,".
        "accesible,".
        "date_detec,".
        "id_point)".
        " VALUES( ?,?,?,?,?,?,?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
              $mac48,
              $ssid,
              $coord_lat,
              $coord_lon,
              $accesible,
              $date_detec,
              $id_point
            )
        );

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idMeta identificador de la meta
     * @return bool Respuesta de la eliminación
     */
    public static function delete($id_point)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM wifly_points WHERE $id_point=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($id_point));
    }
}

?>
