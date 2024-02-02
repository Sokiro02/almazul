<?php 
//*********************************************************************************************************
function Salidascontablesporfecha($Tienda,$fechastar,$fechaend)
{

include("conexion.php");
$sql="SELECT IFNULL(sum(Total_Factura),0) as Totales FROM t_facturas WHERE Fecha_Factura>='".$fechastar."' and Fecha_Factura <='".$fechaend."' and estado_sc='1' and num_consecutivo_sc<>'0' and Tienda_Id_Tienda='".$Tienda."'";

$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Totales=$row['Totales'];
        }
        mysqli_free_result($result);
    }
    return $Totales;
}

function ContarSalidascontablesporfecha($Tienda,$fechastar,$fechaend)
{

include("conexion.php");
$sql="SELECT COUNT(Total_Factura) as Totales FROM t_facturas WHERE Fecha_Factura>='".$fechastar."' and Fecha_Factura <='".$fechaend."' and estado_sc='1' and num_consecutivo_sc<>'0' and Tienda_Id_Tienda='".$Tienda."'";

$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Totales=$row['Totales'];
        }
        mysqli_free_result($result);
    }
    return $Totales;
}


// 2. TOTAL PRENDAS POR SALIDA CONTABLE 

function TotalPrendasporfecha($Tienda,$fechastar,$fechaend)
{

include("conexion.php");
$sql="SELECT IFNULL(sum(Cant_solicitada),0) as Totales FROM t_ventas WHERE consecutivosc_id_consecutivosc<>'0' and Tienda_Id_Tienda='".$Tienda."' and Fecha_Solicitud>='".$fechastar."' and Fecha_Solicitud <='".$fechaend."'";

$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Totales=$row['Totales'];
        }
        mysqli_free_result($result);
    }
    return $Totales;
}

// 3. TOTAL VALOR PEDIDOS  
function ValorPedidosporfecha($Tienda,$fechastar,$fechaend)
{

include("conexion.php");
$sql="SELECT IFNULL(sum(Total_Pedido),0) as Totales FROM t_pedido WHERE Fecha_Pedido>='".$fechastar."' and Fecha_Pedido <='".$fechaend."' and Tienda_Id_Tienda='".$Tienda."'";

$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Totales=$row['Totales'];
        }
        mysqli_free_result($result);
    }
    return $Totales;
}

// 4. TOTAL NÚMERO PEDIDOS   t_temporal_sol
function ContarPedidosporfecha($Tienda,$fechastar,$fechaend)
{

include("conexion.php");
$sql="SELECT COUNT(Total_Pedido) as Totales FROM t_pedido WHERE Fecha_Pedido>='".$fechastar."' and Fecha_Pedido <='".$fechaend."' and Tienda_Id_Tienda='".$Tienda."'";

$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Totales=$row['Totales'];
        }
        mysqli_free_result($result);
    }
    return $Totales;
}

// 4. TOTAL NÚMERO PRENDAS   t_temporal_sol
function ContarPrendasPedidosporfecha($Tienda,$fechastar,$fechaend)
{

include("conexion.php");
$sql="SELECT IFNULL(sum(Cant_Solicitada),0) as Totales FROM t_temporal_sol WHERE Fecha_Solicitud>='".$fechastar."' and Fecha_Solicitud <='".$fechaend."' and Tienda_Id_Tienda='".$Tienda."'";

$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Totales=$row['Totales'];
        }
        mysqli_free_result($result);
    }
    return $Totales;
}

// 4. TOTAL NÚMERO PRENDAS   t_temporal_sol
function PrendasanualesVModasofar($anoactual,$Id_Estado_Pedido)
{

include("conexion.php");
$sql="SELECT IFNULL(sum(Cant_Solicitada),0) as Totales FROM t_temporal_sol WHERE Tienda_Id_Tienda<>'2' AND Tienda_Id_Tienda<>'3'AND Tienda_Id_Tienda<>'4'AND Tienda_Id_Tienda<>'5'AND Tienda_Id_Tienda<>'6' AND Tienda_Id_Tienda<>'7' AND Tienda_Id_Tienda<>'8' AND Tienda_Id_Tienda<>'9' AND Tienda_Id_Tienda<>'10' and YEAR(Fecha_Solicitud)='".$anoactual."' and Estado_Solicitud_Cliente ='".$Id_Estado_Pedido."'";

$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Totales=$row['Totales'];
        }
        mysqli_free_result($result);
    }
    return $Totales;
}


// 4. TOTAL NÚMERO PRENDAS   t_temporal_sol
function DespachosanualesVModasofar($anoactual,$tienda)
{

include("conexion.php");
$sql="SELECT IFNULL(sum(cantidad),0) as Totales FROM t_temporal_inventario WHERE id_tienda='".$tienda."' and YEAR(fecha_ingreso)='".$anoactual."'";

$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Totales=$row['Totales'];
        }
        mysqli_free_result($result);
    }
    return $Totales;
}




// 4. TOTAL NÚMERO PRENDAS   t_temporal_sol
function PrendasmesanualVModasofar($mes,$anoactual,$Id_Estado_Pedido)
{

include("conexion.php");
$sql="SELECT IFNULL(sum(Cant_Solicitada),0) as Totales FROM t_temporal_sol WHERE Tienda_Id_Tienda<>'2' AND Tienda_Id_Tienda<>'3'AND Tienda_Id_Tienda<>'4'AND Tienda_Id_Tienda<>'5'AND Tienda_Id_Tienda<>'6' AND Tienda_Id_Tienda<>'7' AND Tienda_Id_Tienda<>'8' AND Tienda_Id_Tienda<>'9' AND Tienda_Id_Tienda<>'10' and YEAR(Fecha_Solicitud)='".$anoactual."' and MONTH(Fecha_Solicitud)='".$mes."' and Estado_Solicitud_Cliente ='".$Id_Estado_Pedido."'";
//echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Totales=$row['Totales'];
        }
        mysqli_free_result($result);
    }
    return $Totales;
}

// 4. TOTAL NÚMERO PRENDAS   t_temporal_sol
function DespachosmesanualVModasofarcl($mes,$anoactual,$tienda,$cl)
{
include("conexion.php");
$sql="SELECT IFNULL(sum(cantidad),0) as Totales FROM t_temporal_inventario WHERE id_tienda='".$tienda."' and YEAR(fecha_ingreso)='".$anoactual."' and MONTH(fecha_ingreso)='".$mes."' and cliente<>'".$cl."'";
//echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Totales=$row['Totales'];
        }
        mysqli_free_result($result);
    }
    return $Totales;
}





// 4. TOTAL NÚMERO PRENDAS   t_temporal_sol
function DespachosmesanualVModasofar($mes,$anoactual,$tienda,$cl)
{
include("conexion.php");
$sql="SELECT IFNULL(sum(cantidad),0) as Totales FROM t_temporal_inventario WHERE id_tienda='".$tienda."' and YEAR(fecha_ingreso)='".$anoactual."' and MONTH(fecha_ingreso)='".$mes."' and cliente='".$cl."'";
//echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Totales=$row['Totales'];
        }
        mysqli_free_result($result);
    }
    return $Totales;
}

// 4. TOTAL NÚMERO PRENDAS   t_temporal_sol
function Despachosmesanual($mes,$anoactual,$cl)
{
include("conexion.php");
$sql="SELECT IFNULL(sum(cantidad),0) as Totales FROM t_temporal_inventario WHERE YEAR(fecha_ingreso)='".$anoactual."' and MONTH(fecha_ingreso)='".$mes."' and cliente='".$cl."'";
//echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Totales=$row['Totales'];
        }
        mysqli_free_result($result);
    }
    return $Totales;
}

// 4. TOTAL NÚMERO PRENDAS   t_temporal_sol
function Despachosmesanualpvp($mes,$anoactual)
{
include("conexion.php");
$sql="SELECT IFNULL(sum(valor_unidad*cantidad),0) as Totales FROM t_temporal_inventario WHERE YEAR(fecha_ingreso)='".$anoactual."' and MONTH(fecha_ingreso)='".$mes."'";
//echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Totales=$row['Totales'];
        }
        mysqli_free_result($result);
    }
    return $Totales;
}


// 4. TOTAL NÚMERO PRENDAS   t_temporal_sol
function Despachosmesanualcl($mes,$anoactual,$cl)
{
include("conexion.php");
$sql="SELECT IFNULL(sum(cantidad),0) as Totales FROM t_temporal_inventario WHERE YEAR(fecha_ingreso)='".$anoactual."' and MONTH(fecha_ingreso)='".$mes."' and cliente<>'".$cl."'";
//echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Totales=$row['Totales'];
        }
        mysqli_free_result($result);
    }
    return $Totales;
}




// 5. TOTAL NÚMERO PRENDAS   t_temporal_sol

function PrendasmensualesVModasofar($mes,$anoactual)
{

include("conexion.php");
$sql="SELECT IFNULL(sum(Cant_Solicitada),0) as Totales FROM t_temporal_sol WHERE Tienda_Id_Tienda<>'2' AND Tienda_Id_Tienda<>'3'AND Tienda_Id_Tienda<>'4'AND Tienda_Id_Tienda<>'5'AND Tienda_Id_Tienda<>'6' AND Tienda_Id_Tienda<>'7' AND Tienda_Id_Tienda<>'8' AND Tienda_Id_Tienda<>'9' AND Tienda_Id_Tienda<>'10' and YEAR(Fecha_Solicitud)='".$anoactual."' and MONTH(Fecha_Solicitud)='".$mes."' ";

$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Totales=$row['Totales'];
        }
        mysqli_free_result($result);
    }
    return $Totales;
}

// 5. TOTAL NÚMERO PRENDAS   t_temporal_sol

function DespachosmensualesVModasofar($mes,$anoactual)
{

include("conexion.php");
$sql="SELECT IFNULL(sum(cantidad),0) as Totales FROM t_temporal_inventario WHERE YEAR(fecha_ingreso)='".$anoactual."' and MONTH(fecha_ingreso)='".$mes."' ";

$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Totales=$row['Totales'];
        }
        mysqli_free_result($result);
    }
    return $Totales;
}



function numeroclientesFecha($tienda,$fechastar,$fechaend)
{
  include("conexion.php");
   $anoactual = date('Y');
$sql="SELECT COUNT(DISTINCT cliente_id_cliente) as total FROM `t_facturas` WHERE Fecha_Factura>='".$fechastar."' and Fecha_Factura <='".$fechaend."' and tienda_id_tienda='".$tienda."'";
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $total=$row['total'];
    }
    mysqli_free_result($result);
}
    return $total;  
}

function numeroclientesNuevosFecha($fechastar,$fechaend)
{
  include("conexion.php");
   $anoactual = date('Y');
$sql="SELECT COUNT(DISTINCT Id_cliente) as total FROM `t_clientes` WHERE Fecha_Ingreso>='".$fechastar."' and Fecha_Ingreso <='".$fechaend."'";
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $total=$row['total'];
    }
    mysqli_free_result($result);
}
    return $total;  
}



function promediofechacompratienda($tienda,$fechastar,$fechaend)
{
  include("conexion.php");
  $anoactual = date('Y');
$sql="SELECT AVG(Subtotal_Factura) as total FROM `t_facturas` WHERE Fecha_Factura>='".$fechastar."' and Fecha_Factura <='".$fechaend."' and Tienda_Id_Tienda='".$tienda."'";
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $total=$row['total'];
    }
    mysqli_free_result($result);
}
    return $total;  
}

// 4. TOTAL INGRESOS   t_temporal_sol
function Ingresosporfecha($fechastar,$fechaend)
{

include("conexion.php");
$sql="SELECT IFNULL(sum(Valor_Ingreso),0) as Totales FROM t_ingresos WHERE Fecha_Ingreso>='".$fechastar."' and Fecha_Ingreso <='".$fechaend."'";

$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Totales=$row['Totales'];
        }
        mysqli_free_result($result);
    }
    return $Totales;
}

// 4. TOTAL INGRESOS   t_temporal_sol
function graficacontarprendasentregadas($ANO,$MESsql,$DIA,$estado,$tienda)
{

include("conexion.php");
$sql="SELECT IFNULL(sum(Cant_Solicitada),0) as totales FROM t_temporal_sol WHERE Tienda_Id_Tienda='".$tienda."' AND Estado_Solicitud_Cliente='".$estado."' AND YEAR(Fecha_Solicitud)='".$ANO."' AND MONTH(Fecha_Solicitud)='".$MESsql."' AND DAY(Fecha_Solicitud)='".$DIA."'";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Totales=$row['totales'];
        }
        mysqli_free_result($result);
    }
    return $Totales;
}

function totalcostosprodmes($mes,$ano)
{
  include("conexion.php");


$sql="SELECT IFNULL(SUM(A.Costo_Insumo_Ref*A.Cant_Solicitada),0) AS total 
FROM t_insumos_ref as A FORCE INDEX (indexinsumos)
JOIN t_referencias as B  ON A.Referencia_Cod_Referencia=B.Cod_Referencia
JOIN t_temporal_inventario AS C FORCE INDEX (sqlcostos) ON C.id_ref=B.Id_Referencia 
WHERE MONTH(C.fecha_ingreso)='".$mes."' and YEAR(C.fecha_ingreso)='".$ano."'";
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $total=$row['total'];
    }
    mysqli_free_result($result);
}
    return $total;  
}


// TOTAL INGRESOS   t_temporal_sol
function IngresosmediospagoPor($anoactual,$mediopago)
{

include("conexion.php");
$sql="SELECT IFNULL(sum(Valor_Ingreso),0) as Totales FROM t_ingresos WHERE Medio_Pago='".$mediopago."' and YEAR(fecha_ingreso)='".$anoactual."'";

$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Totales=$row['Totales'];
        }
        mysqli_free_result($result);
    }
    return $Totales;
}


// 4. TOTAL NÚMERO PRENDAS   t_temporal_sol
function IngresosmesanualVModasofar($mes,$anoactual,$mediopago)
{
include("conexion.php");
$sql="SELECT IFNULL(sum(Valor_Ingreso),0) as Totales FROM t_ingresos WHERE YEAR(fecha_ingreso)='".$anoactual."' and MONTH(fecha_ingreso)='".$mes."' and Medio_Pago='".$mediopago."'";
//echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Totales=$row['Totales'];
        }
        mysqli_free_result($result);
    }
    return $Totales;
}


function IngresosmensualesVModasofar($mes,$anoactual)
{

include("conexion.php");
$sql="SELECT IFNULL(sum(Valor_Ingreso),0) as Totales FROM t_ingresos WHERE YEAR(fecha_ingreso)='".$anoactual."' and MONTH(fecha_ingreso)='".$mes."' ";

$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Totales=$row['Totales'];
        }
        mysqli_free_result($result);
    }
    return $Totales;
}



 ?>
















