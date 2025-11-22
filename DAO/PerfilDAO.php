<?php
include_once '../Lib/Config/conexionSqli.php';

class PerfilDAO extends Connection
{
    private static $instance = NULL;

    public static function getInstance()
    {
        if (self::$instance == NULL)
            self::$instance = new PerfilDAO();
        return self::$instance;
    }

    public function getAll()
    {
        try {
            $sql = "SELECT * FROM perfil";
            $result = $this->execute($sql);
            return $result;
        } catch (Exception $exc) {
            error_log('Error getAll() PerfilDAO: ' . $exc->getMessage());
            return [];
        }
    }

    public function add($descripcion, $estado)
    {
        $rs = "";
        try {
            $sql = "INSERT INTO perfil(per_descripcion, per_estado) VALUES ('" . $descripcion . "', '" . $estado . "')";
            $result = $this->execute($sql);
            $rs = 1;
        } catch (Exception $exc) {
            error_log('Error add() PerfilDAO: ' . $exc->getMessage());
            $rs = 0;
        }
        return $rs;
    }

    public function findById($id)
    {
        try {
            $sql = "SELECT * FROM perfil WHERE per_id = " . $id;
            $result = $this->execute($sql);
            return $result;
        } catch (Exception $exc) {
            error_log('Error findById() PerfilDAO: ' . $exc->getMessage());
            return [];
        }
    }

    public function update($id, $descripcion, $estado)
    {
        $rs = "";
        try {
            $sql = "UPDATE perfil SET per_descripcion = '" . $descripcion . "', per_estado = '" . $estado . "' WHERE per_id = " . $id;
            $result = $this->execute($sql);
            $rs = 1;
        } catch (Exception $exc) {
            error_log('Error update() PerfilDAO: ' . $exc->getMessage());
            $rs = 0;
        }
        return $rs;
    }

    // Método para verificar si el perfil ya existe
    public function checkIfExists($descripcion)
    {
        try {
            $sql = "SELECT COUNT(*) as count FROM perfil WHERE per_descripcion = '" . $descripcion . "'";
            $result = $this->execute($sql);
            return ($result && $result[0]['count'] > 0) ? true : false;
        } catch (Exception $exc) {
            error_log('Error checkIfExists() PerfilDAO: ' . $exc->getMessage());
            return false;
        }
    }

    // Método para verificar si el perfil existe en otro registro (para actualización)
    public function checkDescripcionExistsForOtherPerfil($currentId, $descripcion)
    {
        try {
            $sql = "SELECT COUNT(*) as count FROM perfil WHERE per_descripcion = '" . $descripcion . "' AND per_id != " . $currentId;
            $result = $this->execute($sql);
            return ($result && $result[0]['count'] > 0) ? true : false;
        } catch (Exception $exc) {
            error_log('Error checkDescripcionExistsForOtherPerfil() PerfilDAO: ' . $exc->getMessage());
            return false;
        }
    }
}
?>