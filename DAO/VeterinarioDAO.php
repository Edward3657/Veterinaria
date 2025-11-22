<?php
include_once '../Lib/Config/conexionSqli.php';

class VeterinarioDAO extends Connection
{
    private static $instance = NULL;
    
    public static function getInstance()
    {
        if (self::$instance == NULL)
            self::$instance = new VeterinarioDAO();
        return self::$instance;
    }
    
    public function getAll()
    {
        try {
            $sql = "SELECT * FROM veterinario";
            $result = $this->execute($sql);
            return $result;
        } catch (PDOException $exc) {
            error_log('Error getAll() VeterinarioDAO:<br/>' . $exc->getMessage());
            return [];
        }
    }

    public function add($nombre, $email, $tel, $veterinaria, $direccion, $estado)
    {
        $rs = "";
        try {
            $sql = "INSERT INTO veterinario (vet_nombre, vet_email, vet_tel, vet_veterinaria, vet_direccion, vet_estado, fecha_crea) 
                    VALUES ('" . $nombre . "', '" . $email . "', '" . $tel . "', '" . $veterinaria . "', '" . $direccion . "', '" . $estado . "', NOW())";
            $result = $this->execute($sql);
            $rs = 1;
        } catch (PDOException $exc) {
            error_log('Error add() VeterinarioDAO:<br/>' . $exc->getMessage());
            $rs = 0;
        }
        return $rs;
    }

    public function findById($id)
    {
        try {
            $sql = "SELECT * FROM veterinario WHERE vet_id = " . $id;
            $result = $this->execute($sql);
            return $result;
        } catch (PDOException $exc) {
            error_log('Error findById() VeterinarioDAO:<br/>' . $exc->getMessage());
            return [];
        }
    }

    public function update($id, $nombre, $email, $tel, $veterinaria, $direccion)
    {
        $rs = "";
        try {
            $sql = "UPDATE veterinario SET 
                    vet_nombre = '" . $nombre . "', 
                    vet_email = '" . $email . "', 
                    vet_tel = '" . $tel . "', 
                    vet_veterinaria = '" . $veterinaria . "', 
                    vet_direccion = '" . $direccion . "' 
                    WHERE vet_id = " . $id;
            $result = $this->execute($sql);
            $rs = 1;
        } catch (PDOException $exc) {
            error_log('Error update() VeterinarioDAO:<br/>' . $exc->getMessage());
            $rs = 0;
        }
        return $rs;
    }
}
?>