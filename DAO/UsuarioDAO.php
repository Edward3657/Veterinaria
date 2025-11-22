<?php
include_once '../Lib/Config/conexionSqli.php';

class UsuarioDAO extends Connection
{
    private static $instance = NULL;
    
    public static function getInstance()
    {
        if (self::$instance == NULL)
            self::$instance = new UsuarioDAO();
        return self::$instance;
    }
    
    public function getAll()
    {
        try {
            $sql = "SELECT * FROM usuario";
            $result = $this->execute($sql);
            return $result;
        } catch (Exception $exc) {
            error_log('Error getAll() UsuarioDAO: ' . $exc->getMessage());
            return [];
        }
    }

    public function add($identificacion, $login, $pass, $nombre, $apellido, $email, $dir, $tel, $estado, $per_id)
    {
        $rs = "";
        try {
            $sql = "INSERT INTO usuario (usu_identificacion, usu_login, usu_pass, usu_nombre, usu_apellido, usu_email, usu_dir, usu_tel, usu_estado, per_id) 
                    VALUES ('" . $identificacion . "', '" . $login . "', '" . $pass . "', '" . $nombre . "', '" . $apellido . "', '" . $email . "', '" . $dir . "', '" . $tel . "', '" . $estado . "', " . $per_id . ")";
            $result = $this->execute($sql);
            $rs = 1;
        } catch (Exception $exc) {
            error_log('Error add() UsuarioDAO: ' . $exc->getMessage());
            $rs = 0;
        }
        return $rs;
    }

    public function findById($id)
    {
        try {
            $sql = "SELECT * FROM usuario WHERE usu_id = " . $id;
            $result = $this->execute($sql);
            return $result;
        } catch (Exception $exc) {
            error_log('Error findById() UsuarioDAO: ' . $exc->getMessage());
            return [];
        }
    }

    public function update($id, $identificacion, $login, $nombre, $apellido, $email, $dir, $tel, $estado, $per_id)
    {
        $rs = "";
        try {
            $sql = "UPDATE usuario SET 
                    usu_identificacion = '" . $identificacion . "', 
                    usu_login = '" . $login . "', 
                    usu_nombre = '" . $nombre . "', 
                    usu_apellido = '" . $apellido . "', 
                    usu_email = '" . $email . "', 
                    usu_dir = '" . $dir . "', 
                    usu_tel = '" . $tel . "', 
                    usu_estado = '" . $estado . "', 
                    per_id = " . $per_id . " 
                    WHERE usu_id = " . $id;
            $result = $this->execute($sql);
            $rs = 1;
        } catch (Exception $exc) {
            error_log('Error update() UsuarioDAO: ' . $exc->getMessage());
            $rs = 0;
        }
        return $rs;
    }

    // Método para verificar si el usuario ya existe por login
    public function checkByLogin($login)
    {
        try {
            $sql = "SELECT COUNT(*) as count FROM usuario WHERE usu_login = '" . $login . "'";
            $result = $this->execute($sql);
            return ($result && $result[0]['count'] > 0) ? true : false;
        } catch (Exception $exc) {
            error_log('Error checkByLogin() UsuarioDAO: ' . $exc->getMessage());
            return false;
        }
    }

    // Método para verificar si el email ya existe
    public function checkByEmail($email)
    {
        try {
            $sql = "SELECT COUNT(*) as count FROM usuario WHERE usu_email = '" . $email . "'";
            $result = $this->execute($sql);
            return ($result && $result[0]['count'] > 0) ? true : false;
        } catch (Exception $exc) {
            error_log('Error checkByEmail() UsuarioDAO: ' . $exc->getMessage());
            return false;
        }
    }

    // Método para verificar si la identificación ya existe
    public function checkByIdentificacion($identificacion)
    {
        try {
            $sql = "SELECT COUNT(*) as count FROM usuario WHERE usu_identificacion = '" . $identificacion . "'";
            $result = $this->execute($sql);
            return ($result && $result[0]['count'] > 0) ? true : false;
        } catch (Exception $exc) {
            error_log('Error checkByIdentificacion() UsuarioDAO: ' . $exc->getMessage());
            return false;
        }
    }

    // Métodos para verificar en actualización (excluyendo el registro actual)
    public function checkLoginExistsForOtherUser($currentId, $login)
    {
        try {
            $sql = "SELECT COUNT(*) as count FROM usuario WHERE usu_login = '" . $login . "' AND usu_id != " . $currentId;
            $result = $this->execute($sql);
            return ($result && $result[0]['count'] > 0) ? true : false;
        } catch (Exception $exc) {
            error_log('Error checkLoginExistsForOtherUser() UsuarioDAO: ' . $exc->getMessage());
            return false;
        }
    }

    public function checkEmailExistsForOtherUser($currentId, $email)
    {
        try {
            $sql = "SELECT COUNT(*) as count FROM usuario WHERE usu_email = '" . $email . "' AND usu_id != " . $currentId;
            $result = $this->execute($sql);
            return ($result && $result[0]['count'] > 0) ? true : false;
        } catch (Exception $exc) {
            error_log('Error checkEmailExistsForOtherUser() UsuarioDAO: ' . $exc->getMessage());
            return false;
        }
    }

    public function checkIdentificacionExistsForOtherUser($currentId, $identificacion)
    {
        try {
            $sql = "SELECT COUNT(*) as count FROM usuario WHERE usu_identificacion = '" . $identificacion . "' AND usu_id != " . $currentId;
            $result = $this->execute($sql);
            return ($result && $result[0]['count'] > 0) ? true : false;
        } catch (Exception $exc) {
            error_log('Error checkIdentificacionExistsForOtherUser() UsuarioDAO: ' . $exc->getMessage());
            return false;
        }
    }
}
?>