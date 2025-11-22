<?php
class ViewVeterinario
{
    public static function getRead()
    {
        ?>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Veterinario</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Listar</li>
            </ol>
            <div class="row">
                <div class="lg-6 mb-2 sm-12">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#modalCreateVeterinario">CREAR</button>
                </div>
            </div>
            <div class="row">
                <div class="table-responsive">
                    <table id="dt_veterinario" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NOMBRE</th>
                                <th>EMAIL</th>
                                <th>TELÉFONO</th>
                                <th>VETERINARIA</th>
                                <th>DIRECCIÓN</th>
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
        ModalsVeterinario::modalCreate();
        ModalsVeterinario::modalEdit();
    }
}
?>
<script type="text/javascript" src="../View/Veterinario/veterinario.js"></script>