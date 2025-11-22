<?php

class ModalsVeterinario
{
    public static function modalCreate()
    {
        ?>
        <div class="modal" tabindex="-1" id="modalCreateVeterinario">
            <div class="modal-dialog modal-xs">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Registro Veterinario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form name="frmCreateVeterinario" action="<?php echo getUrl('Veterinario', 'Veterinario', 'postNew'); ?>"
                            method="post">
                            <div class="mb-3">
                                <label for="vet_nombre" class="form-label">Nombre</label>
                                <input type="text" name="vet_nombre" id="vet_nombre" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="vet_email" class="form-label">Email</label>
                                <input type="email" name="vet_email" id="vet_email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="vet_tel" class="form-label">Teléfono</label>
                                <input type="text" name="vet_tel" id="vet_tel" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="vet_veterinaria" class="form-label">Veterinaria</label>
                                <input type="text" name="vet_veterinaria" id="vet_veterinaria" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="vet_direccion" class="form-label">Dirección</label>
                                <input type="text" name="vet_direccion" id="vet_direccion" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="vet_estado" class="form-label">Estado</label>
                                <select name="vet_estado" id="vet_estado" class="form-control" required>
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
        <div class="modal" tabindex="-1" id="modalEditVeterinario">
            <div class="modal-dialog modal-xs">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Veterinario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form name="frmEditVeterinario" action="<?php echo getUrl('Veterinario', 'Veterinario', 'postUpdate'); ?>"
                            method="post">
                            <input type="hidden" name="idVeterinarioEdit" id="idVeterinarioEdit">
                            <div class="mb-3">
                                <label for="vet_nombreEdit" class="form-label">Nombre</label>
                                <input type="text" name="vet_nombreEdit" id="vet_nombreEdit" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="vet_emailEdit" class="form-label">Email</label>
                                <input type="email" name="vet_emailEdit" id="vet_emailEdit" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="vet_telEdit" class="form-label">Teléfono</label>
                                <input type="text" name="vet_telEdit" id="vet_telEdit" class="form-control" required>
                            </div>
                            <div class="mb-3">
    <label for="idVeterinarioEdit" class="form-label">ID Veterinario</label>
    <input type="number" name="idVeterinarioEdit" id="idVeterinarioEdit" class="form-control" required readonly>
</div>
                            <div class="mb-3">
                                <label for="vet_direccionEdit" class="form-label">Dirección</label>
                                <input type="text" name="vet_direccionEdit" id="vet_direccionEdit" class="form-control" required>
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