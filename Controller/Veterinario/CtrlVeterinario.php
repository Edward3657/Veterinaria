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
include_once '../DAO/VeterinarioDAO.php';

class CtrlVeterinario extends VeterinarioDAO
{
    public function read()
    {
        include_once '../View/Veterinario/ViewVeterinario.php';
        include_once '../View/Veterinario/ModalsVeterinario.php';
        ViewVeterinario::getread();
    }

    public function data()
    {
        $listVeterinario = $this->getAll(); // Corregido: usar $this en lugar de VeterinarioDAO::
        $array = [];
        foreach ($listVeterinario as $key => $rowVeterinario) {
            $array['data'][$key]['id'] = $rowVeterinario['vet_id'];
            $array['data'][$key]['nombre'] = $rowVeterinario['vet_nombre'];
            $array['data'][$key]['email'] = $rowVeterinario['vet_email'];
            $array['data'][$key]['telefono'] = $rowVeterinario['vet_tel'];
            $array['data'][$key]['veterinaria'] = $rowVeterinario['vet_veterinaria'];
            $array['data'][$key]['direccion'] = $rowVeterinario['vet_direccion'];
            $array['data'][$key]['estado'] = $rowVeterinario['vet_estado'];
            $array['data'][$key]['buttons']  = '<div class="btn-group">
                <a class="btn btn-sm btn-primary btnShowEdit" href="#!" data-bs-toggle="modal" data-bs-target="#modalEditVeterinario" data-url="' . getUrl('Veterinario', 'Veterinario', 'getData', array('idVeterinario' => $rowVeterinario['vet_id']), 'ajax') . '">Editar</a>
            </div>';
        }
        echo json_encode($array);
    }

public function postNew()
{
    // Obtener y limpiar datos
    $nombre = isset($_POST['vet_nombre']) ? trim($_POST['vet_nombre']) : '';
    $email = isset($_POST['vet_email']) ? trim($_POST['vet_email']) : '';
    $tel = isset($_POST['vet_tel']) ? trim($_POST['vet_tel']) : '';
    $veterinaria = isset($_POST['vet_veterinaria']) ? trim($_POST['vet_veterinaria']) : '';
    $direccion = isset($_POST['vet_direccion']) ? trim($_POST['vet_direccion']) : '';
    $estado = isset($_POST['vet_estado']) ? trim($_POST['vet_estado']) : 'Activo';
    
    // Validar campos obligatorios
    if (empty($nombre) || empty($email)) {
        messageSweetAlert("Advertencia!", "Nombre y email son campos obligatorios", "warning", "#f7060d", getUrl('Veterinario', 'Veterinario', 'read'));
        return;
    }
    
    // Validar formato de email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        messageSweetAlert("Advertencia!", "El formato del email no es válido", "warning", "#f7060d", getUrl('Veterinario', 'Veterinario', 'read'));
        return;
    }
    
    // Verificar si el veterinario ya existe (por email)
    if ($this->checkByEmail($email)) {
        messageSweetAlert("Advertencia!", "Ya existe un veterinario registrado con este email: " . $email, "warning", "#f7060d", getUrl('Veterinario', 'Veterinario', 'read'));
        return;
    }
    
    // Verificar si el teléfono ya existe (opcional)
    if (!empty($tel) && $this->checkByTelefono($tel)) {
        messageSweetAlert("Advertencia!", "Ya existe un veterinario registrado con este teléfono: " . $tel, "warning", "#f7060d", getUrl('Veterinario', 'Veterinario', 'read'));
        return;
    }
    
    // Si pasa todas las validaciones, crear el veterinario
    $rs = $this->add($nombre, $email, $tel, $veterinaria, $direccion, $estado);
    
    if ($rs == 1) {
        messageSweetAlert("¡Éxito!", "Veterinario creado correctamente.", "success", "#4CAF50", getUrl('Veterinario', 'Veterinario', 'read'));
    } else {
        messageSweetAlert("Advertencia!", "No fue posible crear el veterinario", "warning", "#f7060d", getUrl('Veterinario', 'Veterinario', 'read'));
    }
}
    public function getData()
    {
        $id = isset($_GET['idVeterinario']) ? $_GET['idVeterinario'] : 0;
        $array = [];
        $rs = $this->findById($id); // Corregido: usar $this en lugar de VeterinarioDAO::getInstance()
        
        if (!empty($rs)) {
            foreach ($rs as $key => $rowVeterinario) {
                $array['id'] = $rowVeterinario['vet_id'];
                $array['nombre'] = $rowVeterinario['vet_nombre'];
                $array['email'] = $rowVeterinario['vet_email'];
                $array['telefono'] = $rowVeterinario['vet_tel'];
                $array['veterinaria'] = $rowVeterinario['vet_veterinaria'];
                $array['direccion'] = $rowVeterinario['vet_direccion'];
            }
        }
        echo json_encode($array);
    }

public function postUpdate()
{
    // Validar datos
    $id = isset($_POST['idVeterinarioEdit']) ? $_POST['idVeterinarioEdit'] : 0;
    $nombre = isset($_POST['vet_nombreEdit']) ? trim($_POST['vet_nombreEdit']) : '';
    $email = isset($_POST['vet_emailEdit']) ? trim($_POST['vet_emailEdit']) : '';
    $tel = isset($_POST['vet_telEdit']) ? trim($_POST['vet_telEdit']) : '';
    $veterinaria = isset($_POST['vet_veterinariaEdit']) ? trim($_POST['vet_veterinariaEdit']) : '';
    $direccion = isset($_POST['vet_direccionEdit']) ? trim($_POST['vet_direccionEdit']) : '';
    
    // Validar campos obligatorios
    if (empty($id) || empty($nombre) || empty($email)) {
        messageSweetAlert("Advertencia!", "ID, nombre y email son campos obligatorios", "warning", "#f7060d", getUrl('Veterinario', 'Veterinario', 'read'));
        return;
    }
    
    // Validar formato de email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        messageSweetAlert("Advertencia!", "El formato del email no es válido", "warning", "#f7060d", getUrl('Veterinario', 'Veterinario', 'read'));
        return;
    }
    
    // Verificar si el email ya existe en otro veterinario (excluyendo el actual)
    $existingByEmail = $this->checkEmailExistsForOtherVet($id, $email);
    if ($existingByEmail) {
        messageSweetAlert("Advertencia!", "Ya existe otro veterinario registrado con este email: " . $email, "warning", "#f7060d", getUrl('Veterinario', 'Veterinario', 'read'));
        return;
    }
    
    // Verificar si el teléfono ya existe en otro veterinario (excluyendo el actual)
    if (!empty($tel)) {
        $existingByTel = $this->checkTelefonoExistsForOtherVet($id, $tel);
        if ($existingByTel) {
            messageSweetAlert("Advertencia!", "Ya existe otro veterinario registrado con este teléfono: " . $tel, "warning", "#f7060d", getUrl('Veterinario', 'Veterinario', 'read'));
            return;
        }
    }
    
    $rs = $this->update($id, $nombre, $email, $tel, $veterinaria, $direccion);
    
    if ($rs == 1) {
        messageSweetAlert("¡Éxito!", "Veterinario actualizado correctamente.", "success", "#4CAF50", getUrl('Veterinario', 'Veterinario', 'read'));
    } else {
        messageSweetAlert("Advertencia!", "No fue posible actualizar el veterinario", "warning", "#f7060d", getUrl('Veterinario', 'Veterinario', 'read'));
    }
}
}