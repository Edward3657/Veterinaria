<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of CtrlPerfil
 *
 * @author estudiante
 */
include_once '../DAO/PerfilDAO.php';
include_once '../DAO/UsuarioDAO.php';

class CtrlUsuario extends UsuarioDAO
{
    public function read()
    {
        include_once '../View/Usuario/ViewUsuario.php';
        include_once '../View/Usuario/ModalsUsuario.php';
        ViewUsuario::getRead();
    }

    public function data()
    {
        $listUsuario = $this->getAll();
        $array = [];
        foreach ($listUsuario as $key => $rowUsuario) {
            $array['data'][$key]['id'] = $rowUsuario['usu_id'];
            $array['data'][$key]['identificacion'] = $rowUsuario['usu_identificacion'];
            $array['data'][$key]['login'] = $rowUsuario['usu_login'];
            $array['data'][$key]['nombre'] = $rowUsuario['usu_nombre'];
            $array['data'][$key]['apellido'] = $rowUsuario['usu_apellido'];
            $array['data'][$key]['email'] = $rowUsuario['usu_email'];
            $array['data'][$key]['direccion'] = $rowUsuario['usu_dir'];
            $array['data'][$key]['telefono'] = $rowUsuario['usu_tel'];
            $array['data'][$key]['estado'] = $rowUsuario['usu_estado'];
            $array['data'][$key]['perfil'] = $rowUsuario['per_id'];
            $array['data'][$key]['buttons']  = '<div class="btn-group">
                <a class="btn btn-sm btn-primary btnShowEdit" href="#!" data-bs-toggle="modal" data-bs-target="#modalEditUsuario" data-url="' . getUrl('Usuario', 'Usuario', 'getData', array('idUsuario' => $rowUsuario['usu_id']), 'ajax') . '">Editar</a>
            </div>';
        }
        echo json_encode($array);
    }

    public function postNew()
    {
        // Obtener y limpiar datos
        $identificacion = isset($_POST['usu_identificacion']) ? trim($_POST['usu_identificacion']) : '';
        $login = isset($_POST['usu_login']) ? trim($_POST['usu_login']) : '';
        $pass = isset($_POST['usu_pass']) ? trim($_POST['usu_pass']) : '';
        $nombre = isset($_POST['usu_nombre']) ? trim($_POST['usu_nombre']) : '';
        $apellido = isset($_POST['usu_apellido']) ? trim($_POST['usu_apellido']) : '';
        $email = isset($_POST['usu_email']) ? trim($_POST['usu_email']) : '';
        $dir = isset($_POST['usu_dir']) ? trim($_POST['usu_dir']) : '';
        $tel = isset($_POST['usu_tel']) ? trim($_POST['usu_tel']) : '';
        $estado = isset($_POST['usu_estado']) ? trim($_POST['usu_estado']) : 'Activo';
        $perfil = isset($_POST['per_id']) ? $_POST['per_id'] : null;
        
        // Validar campos obligatorios
        if (empty($identificacion) || empty($login) || empty($pass) || empty($nombre) || empty($email) || empty($perfil)) {
            messageSweetAlert("Advertencia!", "Identificación, login, contraseña, nombre, email y perfil son campos obligatorios", "warning", "#f7060d", getUrl('Usuario', 'Usuario', 'read'));
            return;
        }
        
        // Validar formato de email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            messageSweetAlert("Advertencia!", "El formato del email no es válido", "warning", "#f7060d", getUrl('Usuario', 'Usuario', 'read'));
            return;
        }
        
        // Verificar si el usuario ya existe por identificación
        if ($this->checkByIdentificacion($identificacion)) {
            messageSweetAlert("Advertencia!", "Ya existe un usuario registrado con esta identificación: " . $identificacion, "warning", "#f7060d", getUrl('Usuario', 'Usuario', 'read'));
            return;
        }
        
        // Verificar si el login ya existe
        if ($this->checkByLogin($login)) {
            messageSweetAlert("Advertencia!", "Ya existe un usuario registrado con este login: " . $login, "warning", "#f7060d", getUrl('Usuario', 'Usuario', 'read'));
            return;
        }
        
        // Verificar si el email ya existe
        if ($this->checkByEmail($email)) {
            messageSweetAlert("Advertencia!", "Ya existe un usuario registrado con este email: " . $email, "warning", "#f7060d", getUrl('Usuario', 'Usuario', 'read'));
            return;
        }
        
        // Si pasa todas las validaciones, crear el usuario
        $rs = $this->add($identificacion, $login, $pass, $nombre, $apellido, $email, $dir, $tel, $estado, $perfil);
        
        if ($rs == 1) {
            messageSweetAlert("¡Éxito!", "Usuario creado correctamente.", "success", "#4CAF50", getUrl('Usuario', 'Usuario', 'read'));
        } else {
            messageSweetAlert("Advertencia!", "No fue posible crear el usuario", "warning", "#f7060d", getUrl('Usuario', 'Usuario', 'read'));
        }
    }

    public function getData()
    {
        $id = isset($_GET['idUsuario']) ? $_GET['idUsuario'] : 0;
        $array = [];
        $rs = $this->findById($id);
        
        if (!empty($rs)) {
            foreach ($rs as $key => $rowUsuario) {
                $array['id'] = $rowUsuario['usu_id'];
                $array['identificacion'] = $rowUsuario['usu_identificacion'];
                $array['login'] = $rowUsuario['usu_login'];
                $array['nombre'] = $rowUsuario['usu_nombre'];
                $array['apellido'] = $rowUsuario['usu_apellido'];
                $array['email'] = $rowUsuario['usu_email'];
                $array['direccion'] = $rowUsuario['usu_dir'];
                $array['telefono'] = $rowUsuario['usu_tel'];
                $array['estado'] = $rowUsuario['usu_estado'];
                $array['perfil_id'] = $rowUsuario['per_id'];
            }
        }
        echo json_encode($array);
    }

    public function postUpdate()
    {
        // Validar datos
        $id = isset($_POST['idUsuarioEdit']) ? $_POST['idUsuarioEdit'] : 0;
        $identificacion = isset($_POST['usu_identificacionEdit']) ? trim($_POST['usu_identificacionEdit']) : '';
        $login = isset($_POST['usu_loginEdit']) ? trim($_POST['usu_loginEdit']) : '';
        $nombre = isset($_POST['usu_nombreEdit']) ? trim($_POST['usu_nombreEdit']) : '';
        $apellido = isset($_POST['usu_apellidoEdit']) ? trim($_POST['usu_apellidoEdit']) : '';
        $email = isset($_POST['usu_emailEdit']) ? trim($_POST['usu_emailEdit']) : '';
        $dir = isset($_POST['usu_dirEdit']) ? trim($_POST['usu_dirEdit']) : '';
        $tel = isset($_POST['usu_telEdit']) ? trim($_POST['usu_telEdit']) : '';
        $estado = isset($_POST['usu_estadoEdit']) ? trim($_POST['usu_estadoEdit']) : 'Activo';
        $perfil = isset($_POST['per_idEdit']) ? $_POST['per_idEdit'] : null;
        
        // Validar campos obligatorios
        if (empty($id) || empty($identificacion) || empty($login) || empty($nombre) || empty($email) || empty($perfil)) {
            messageSweetAlert("Advertencia!", "ID, identificación, login, nombre, email y perfil son campos obligatorios", "warning", "#f7060d", getUrl('Usuario', 'Usuario', 'read'));
            return;
        }
        
        // Validar formato de email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            messageSweetAlert("Advertencia!", "El formato del email no es válido", "warning", "#f7060d", getUrl('Usuario', 'Usuario', 'read'));
            return;
        }
        
        // Verificar si la identificación ya existe en otro usuario
        $existingByIdentificacion = $this->checkIdentificacionExistsForOtherUser($id, $identificacion);
        if ($existingByIdentificacion) {
            messageSweetAlert("Advertencia!", "Ya existe otro usuario registrado con esta identificación: " . $identificacion, "warning", "#f7060d", getUrl('Usuario', 'Usuario', 'read'));
            return;
        }
        
        // Verificar si el login ya existe en otro usuario
        $existingByLogin = $this->checkLoginExistsForOtherUser($id, $login);
        if ($existingByLogin) {
            messageSweetAlert("Advertencia!", "Ya existe otro usuario registrado con este login: " . $login, "warning", "#f7060d", getUrl('Usuario', 'Usuario', 'read'));
            return;
        }
        
        // Verificar si el email ya existe en otro usuario
        $existingByEmail = $this->checkEmailExistsForOtherUser($id, $email);
        if ($existingByEmail) {
            messageSweetAlert("Advertencia!", "Ya existe otro usuario registrado con este email: " . $email, "warning", "#f7060d", getUrl('Usuario', 'Usuario', 'read'));
            return;
        }
        
        $rs = $this->update($id, $identificacion, $login, $nombre, $apellido, $email, $dir, $tel, $estado, $perfil);
        
        if ($rs == 1) {
            messageSweetAlert("¡Éxito!", "Usuario actualizado correctamente.", "success", "#4CAF50", getUrl('Usuario', 'Usuario', 'read'));
        } else {
            messageSweetAlert("Advertencia!", "No fue posible actualizar el usuario", "warning", "#f7060d", getUrl('Usuario', 'Usuario', 'read'));
        }
    }
}
?>