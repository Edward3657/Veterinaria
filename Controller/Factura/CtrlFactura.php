<?php

class CtrlFactura
{

    public function read()
    {

        include_once '../Controller/Producto/CtrlProducto.php';

        include_once '../Controller/Cliente/CtrlCliente.php';

        include_once '../View/Factura/ViewFactura.php';

    }


    public function postNew()
    {
        dd($_POST);
        $numFact = $_POST['nofact'];
        $datefact = $_POST['datefact'];
        $cliente = $_POST['cliente'];
        $observaciones = $_POST['observaciones'];
        $producto = $_POST['producto'];
        $listPrecio = $_POST['listPrecio'];
        $listCantidad = $_POST['listCantidad'];
        $listSubtotal = $_POST['listSubtotal'];
        $total = array_sum($listSubtotal);

        $res = FacturaDAO::getInstance()->addCabecera($numFact, $datefact, $cliente, $observaciones, "123", $total);

        if ($res == 1) {
            for ($i = 0; $i < count($producto); $i++) {
                FacturaDAO::getInstance()->addDetalleFactura($numFact, $producto[$i], $listPrecio[$i], $listCantidad[$i], $listSubtotal[$i]);
            }
            FacturaDAO::getInstance()->getUpdateFacturaId();
            messageSweetAlert("¡Atención!", "Registro Exitoso !!!", "success", getUrl('Factura', 'Factura', 'read'));
        } else {
            messageSweetAlert("¡Atención!", "Error al registrar !!!", "error", getUrl('Factura', 'Factura', 'read'));
        }
    }
}