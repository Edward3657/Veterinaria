<?php

class ModalsPerfil
{
    public static function modalCreate()
    {
        ?>
        <div class="modal" tabindex="-1" id="modalCreatePerfil">
            <div class="modal-dialog modal-xs">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Registro Perfil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form name="frmCreatePerfil" action="<?php echo getUrl('Perfil', 'Perfil', 'postNew'); ?>" method="post">
                            <div class="mb-3">
                                <label for="per_descripcion" class="form-label">Descripción</label>
                                <input type="text" name="per_descripcion" id="per_descripcion" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="per_estado" class="form-label">Estado</label>
                                <select name="per_estado" id="per_estado" class="form-control" required>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public static function modalEdit()
    {
        ?>
        <div class="modal" tabindex="-1" id="modalEditPerfil">
            <div class="modal-dialog modal-xs">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Perfil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form name="frmUpdatePerfil" action="<?php echo getUrl('Perfil', 'Perfil', 'postUpdate'); ?>" method="post">
                            <input type="hidden" name="idPerfilEdit" id="idPerfilEdit">
                            <div class="mb-3">
                                <label for="per_descripcionEdit" class="form-label">Descripción</label>
                                <input type="text" name="per_descripcionEdit" id="per_descripcionEdit" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="per_estadoEdit" class="form-label">Estado</label>
                                <select name="per_estadoEdit" id="per_estadoEdit" class="form-control" required>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>