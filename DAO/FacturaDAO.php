<?php
include_once '../Lib/Config/conexionSqli.php';// para usar todo lo de conexionSqli.php
class FacturaDAO extends Connection {
    private static $instance = NULL;
    public static function getInstance(){
        if(self::$instance == NULL)
            self::$instance = new FacturaDAO();
        return self::$instance;
    }

    public function findById($id){
        try{
       $sql = "SELECT * FROM factura WHERE id = '".$id."'";
         $result = $this->execute($sql);
         return $result;
        }catch(PDOException $exc) {
            error_log('Error findById() FacturaDAO:<br/>' . $exc->getMessage());
            $rs=0;
        }
    }
    public function getLastFacturaId() {
        $sql = "SELECT doc_consecutivo AS last_id FROM consecutivo_doc where doc_codigo = '1'";
        $result = $this->execute($sql);
        $row = $result->fetch_assoc();
        return $row['last_id'] ?? 0;
    }


     public function addCabecera($id, $fecha, $cliente, $observaciones, $usuario, $total){
    try {
        $sql = "INSERT INTO factura(`fact_id`, `fact_fecha`, `cli_nit`, `fact_observaciones`, `usu_crea`, `fact_total`, `fact_estado`)
        VALUES ($id, '".$fecha."', '".$cliente."', '".$observaciones."', '".$usuario."', $total, 'Activo' )";
        $result = $this->execute($sql);
        $rs=1;
    }catch (PDOException $exc) {
        error_log('Error AddCabecera() FacturaDAO:<br/>' . $exc->getMessage());
        $rs=0;
    }
    return $rs;
    }
    public function addDetalleFactura($idFactura, $idPro, $proPrecio, $cantidad, $subtotal ) {
        $rs="";
        try {
            $sql = "INSERT INTO detalle_factura(`fact_id`, `pro_id`, `pro_precio`, `drres_cantidad`, `drres_subtotal`)
            VALUES ('".$idFactura."', '".$idPro."', '".$proPrecio."','".$cantidad."', '".$subtotal."')";
            $result = $this->execute($sql);
            $rs=1;
        }catch (PDOException $exc) {
            error_log('Error addDetalleFactura() FacturaDAO:<br/>' . $exc->getMessage());
            $rs=0;
        }
        return $rs;
    }

    public function getUpdateFacturaId() {
        $sql = "UPDATE consecutivo_doc SET doc_consecutivo = doc_consecutivo + 1 WHERE doc_codigo = '1'";
        $result = $this->execute($sql);
    }
}