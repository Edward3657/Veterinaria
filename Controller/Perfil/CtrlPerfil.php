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

class CtrlPerfil extends PerfilDAO
{
    public function read()
    {
        include_once '../View/Perfil/ViewPerfil.php';
        include_once '../View/Perfil/ModalsPerfil.php';
        ViewPerfil::getRead();
    }

    public function data()
    {
        $listPerfil = $this->getAll();
        $array = [];

        foreach ($listPerfil as $key => $rowPerfil) {
            $array['data'][$key]['id'] = $rowPerfil['per_id'];
            $array['data'][$key]['description'] = $rowPerfil['per_descripcion'];
            $array['data'][$key]['estado'] = $rowPerfil['per_estado'];
            $array['data'][$key]['buttons'] = '<div class="btn-group">
                <a class="btn btn-sm btn-primary btnShowEdit" href="#!" data-bs-toggle="modal" data-bs-target="#modalEditPerfil" data-url="' . getUrl('Perfil', 'Perfil', 'getData', array('idPerfil' => $rowPerfil['per_id']), 'ajax') . '">Editar</a>
            </div>';
        }

        echo json_encode($array);
    }

    public function postNew()
    {
        // Obtener y limpiar datos
        $descripcion = isset($_POST['per_descripcion']) ? trim($_POST['per_descripcion']) : '';
        $estado = isset($_POST['per_estado']) ? trim($_POST['per_estado']) : 'Activo';
        
        // Validar campos obligatorios
        if (empty($descripcion)) {
            messageSweetAlert("Advertencia!", "La descripción es un campo obligatorio", "warning", "#f7060d", getUrl('Perfil', 'Perfil', 'read'));
            return;
        }
        
        // Verificar si el perfil ya existe
        if ($this->checkIfExists($descripcion)) {
            messageSweetAlert("Advertencia!", "Ya existe un perfil registrado con esta descripción: " . $descripcion, "warning", "#f7060d", getUrl('Perfil', 'Perfil', 'read'));
            return;
        }
        
        // Si pasa todas las validaciones, crear el perfil
        $rs = $this->add($descripcion, $estado);
        
        if ($rs == 1) {
            messageSweetAlert("¡Éxito!", "Perfil creado correctamente.", "success", "#4CAF50", getUrl('Perfil', 'Perfil', 'read'));
        } else {
            messageSweetAlert("Advertencia!", "No fue posible crear el perfil", "warning", "#f7060d", getUrl('Perfil', 'Perfil', 'read'));
        }
    }

    public function getData()
    {
        $id = isset($_GET['idPerfil']) ? $_GET['idPerfil'] : 0;
        $array = [];
        $rs = $this->findById($id);
        
        if (!empty($rs)) {
            foreach ($rs as $key => $rowPerfil) {
                $array['id'] = $rowPerfil['per_id'];
                $array['description'] = $rowPerfil['per_descripcion'];
                $array['estado'] = $rowPerfil['per_estado'];
            }
        }
        echo json_encode($array);
    }

    public function postUpdate()
    {
        // Validar datos
        $id = isset($_POST['idPerfilEdit']) ? $_POST['idPerfilEdit'] : 0;
        $descripcion = isset($_POST['per_descripcionEdit']) ? trim($_POST['per_descripcionEdit']) : '';
        $estado = isset($_POST['per_estadoEdit']) ? trim($_POST['per_estadoEdit']) : 'Activo';
        
        // Validar campos obligatorios
        if (empty($id) || empty($descripcion)) {
            messageSweetAlert("Advertencia!", "ID y descripción son campos obligatorios", "warning", "#f7060d", getUrl('Perfil', 'Perfil', 'read'));
            return;
        }
        
        // Verificar si la descripción ya existe en otro perfil
        $existingByDescripcion = $this->checkDescripcionExistsForOtherPerfil($id, $descripcion);
        if ($existingByDescripcion) {
            messageSweetAlert("Advertencia!", "Ya existe otro perfil registrado con esta descripción: " . $descripcion, "warning", "#f7060d", getUrl('Perfil', 'Perfil', 'read'));
            return;
        }
        
        $rs = $this->update($id, $descripcion, $estado);
        
        if ($rs == 1) {
            messageSweetAlert("¡Éxito!", "Perfil actualizado correctamente.", "success", "#4CAF50", getUrl('Perfil', 'Perfil', 'read'));
        } else {
            messageSweetAlert("Advertencia!", "No fue posible actualizar el perfil", "warning", "#f7060d", getUrl('Perfil', 'Perfil', 'read'));
        }
    }
}
?>