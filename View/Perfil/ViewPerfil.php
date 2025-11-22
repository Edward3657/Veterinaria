<?php
class ViewPerfil
{
    public static function getRead()
    {
        ?>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Perfil</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Listar</li>
            </ol>
            <div class="row">
                <div class="lg-6 mb-2 sm-12">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#modalCreatePerfil">CREAR</button>
                </div>
            </div>
            <div class="row">
                <div class="table-responsive">
                    <table id="dt_perfil" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>DESCRIPCIÓN</th>
                                <th>ESTADO</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php
        // Llamar a los modales después del contenido principal
        ModalsPerfil::modalCreate();
        ModalsPerfil::modalEdit();
    }
}
?>
<script type="text/javascript" src="../View/Perfil/perfil.js"></script>