<?php

class ModalsUsuario
{
    public static function modalCreate()
    {
        ?>
        <div class="modal" tabindex="-1" id="modalCreateUsuario">
            <div class="modal-dialog modal-xs">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Registro Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form name="frmCreateUsuario" action="<?php echo getUrl('Usuario', 'Usuario', 'postNew'); ?>"
                            method="post">
                            <div class="mb-3">
                                <label for="usu_identificacion" class="form-label">Identificación</label>
                                <input type="text" name="usu_identificacion" id="usu_identificacion" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="usu_login" class="form-label">Login</label>
                                <input type="text" name="usu_login" id="usu_login" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="usu_pass" class="form-label">Contraseña</label>
                                <input type="password" name="usu_pass" id="usu_pass" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="usu_nombre" class="form-label">Nombre</label>
                                <input type="text" name="usu_nombre" id="usu_nombre" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="usu_apellido" class="form-label">Apellido</label>
                                <input type="text" name="usu_apellido" id="usu_apellido" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="usu_email" class="form-label">Email</label>
                                <input type="email" name="usu_email" id="usu_email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="usu_dir" class="form-label">Dirección</label>
                                <input type="text" name="usu_dir" id="usu_dir" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="usu_tel" class="form-label">Teléfono</label>
                                <input type="text" name="usu_tel" id="usu_tel" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="usu_estado" class="form-label">Estado</label>
                                <select name="usu_estado" id="usu_estado" class="form-control" required>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="per_id" class="form-label">Perfil</label>
                                <select name="per_id" id="per_id" class="form-control" required>
                                    <option value="1">Gerente</option>
                                    <option value="2">Admin</option>
                                    <option value="3">Aux</option>
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
        <div class="modal" tabindex="-1" id="modalEditUsuario">
            <div class="modal-dialog modal-xs">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form name="frmEditUsuario" action="<?php echo getUrl('Usuario', 'Usuario', 'postUpdate'); ?>"
                            method="post">
                            <input type="hidden" name="idUsuarioEdit" id="idUsuarioEdit">
                            <div class="mb-3">
                                <label for="usu_identificacionEdit" class="form-label">Identificación</label>
                                <input type="text" name="usu_identificacionEdit" id="usu_identificacionEdit" class="form-control" required readonly>
                            </div>
                            <div class="mb-3">
                                <label for="usu_loginEdit" class="form-label">Login</label>
                                <input type="text" name="usu_loginEdit" id="usu_loginEdit" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="usu_nombreEdit" class="form-label">Nombre</label>
                                <input type="text" name="usu_nombreEdit" id="usu_nombreEdit" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="usu_apellidoEdit" class="form-label">Apellido</label>
                                <input type="text" name="usu_apellidoEdit" id="usu_apellidoEdit" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="usu_emailEdit" class="form-label">Email</label>
                                <input type="email" name="usu_emailEdit" id="usu_emailEdit" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="usu_dirEdit" class="form-label">Dirección</label>
                                <input type="text" name="usu_dirEdit" id="usu_dirEdit" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="usu_telEdit" class="form-label">Teléfono</label>
                                <input type="text" name="usu_telEdit" id="usu_telEdit" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="usu_estadoEdit" class="form-label">Estado</label>
                                <select name="usu_estadoEdit" id="usu_estadoEdit" class="form-control" required>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="per_idEdit" class="form-label">Perfil</label>
                                <select name="per_idEdit" id="per_idEdit" class="form-control" required>
                                    <option value="1">Gerente</option>
                                    <option value="2">Admin</option>
                                    <option value="3">Aux</option>
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