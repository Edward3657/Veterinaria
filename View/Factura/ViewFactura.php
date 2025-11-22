<div class="container-fluid px-4">
    <h1 class="mt-4">FACTURA DE VENTA</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Crear</li>
    </ol>

    <div class="row">
        <form id="frmfactura" method="POST" action="<?php echo getUrl('Factura', 'Factura', 'postNew') ?>">
            <div class="row">
                <div class="col-lg-2">
                    <label>No factura</label>
                    <input type="text" name="nofact" id="nofact" class="form-control" readonly>
                </div>
                <div class="col-lg-2">
                    <label>Fecha factura</label>
                    <input type="date" name="datefact" id="datefact" class="form-control" required>
                </div>
                <div class="col-lg-2">
                    <label>Cliente</label>
                    <select name="cliente" id="cliente" class="form-control" required>
                        <option value="0">Seleccione !!!!</option>
                        <?php
                        $objCliente = new CtrlCliente();
                        $objCliente->getOption();
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-2">
                <input type="submit" name="btnAddFact" id="btnAddFact" class="btn btn-success" value="Registrar">
            </div>
            <div class="row">
                <div class="col-lg-10">
                    <label>Observaciones</label>
                    <input type="text" name="observaciones" id="observaciones" class="form-control">
                </div>
            </div>
            <table id="dt_factura" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>PRODUCTO</th>
                        <th>PRECIO</th>
                        <th>CANTIDAD</th>
                        <th>SUBTOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>
                            <select name="producto[]" class="form-control" required>
                                <option value="0">Seleccione</option>
                                <?php
                                $objProducto = new CtrlProducto();
                                $objProducto->getOption();
                                ?>
                            </select>
                        </th>
                        <th>
                            <input name="listPrecio[]" type="number" class="form-control" readonly>
                        </th>
                        <th>
                            <input name="listCantidad[]" type="number" class="form-control" min="1" value="1">
                        </th>
                        <th>
                            <input name="listSubtotal[]" type="number" class="form-control" readonly>
                        </th>
                        <td class="text-center">
                            <input type="button" class="btn btn-danger delete-tr" value="-">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row mt-3">
                <div class="col-lg-2">
                    <button type="button" id="btnAddRow" class="btn btn-primary">Agregar Producto</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="../View/Factura/factura.js"></script>