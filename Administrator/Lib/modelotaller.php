<?php 

//****************************************************************************************************
//****************************************************************************************************
							// INGRESOS AL TALLER DE EGRESOS DE TIENDA
//****************************************************************************************************
//****************************************************************************************************

	function totalingresostaller($cuenta)
{
  include("conexion.php");
$sql="SELECT IFNULL(SUM(Valor_Transferido),0) as total FROM t_mov_cuentas WHERE Id_Cuenta_Entra='".$cuenta."'";
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

//****************************************************************************************************
//****************************************************************************************************
							// GASTOS AL TALLER DE EGRESOS DE TIENDA
//****************************************************************************************************
//****************************************************************************************************

function totalGastosTaller($taller)
{
  include("conexion.php");
$sql="SELECT IFNULL(sum(Valor_gasto),0) as total From t_gastos where Area_Id_Area='".$taller."'";
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

//****************************************************************************************************
//****************************************************************************************************
							// COMPRAS TALLER ÚLTIMO MES
//****************************************************************************************************
//****************************************************************************************************

function totalComprasMes($mes,$taller)
{
  include("conexion.php");

$sql="SELECT IFNULL(SUM(Cantidad_Solicitada*Costo_Insumo),0) as total FROM `t_orden_compra_insumos` WHERE MONTH(Fecha_Solicitud)='".$mes."' and bodega_id_bodega='".$taller."'";
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

//****************************************************************************************************
//****************************************************************************************************
							// OBTENER NOMBRE DEL TALLER
//****************************************************************************************************
//****************************************************************************************************

function NomTaller($taller)
{
    include("conexion.php");
$sql="SELECT Nom_Bodega From t_bodegas where  Id_Bodega='".$taller."'";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Nom_Bodega=$row['Nom_Bodega'];
    }
    mysqli_free_result($result);
}
return $Nom_Bodega;
 } 

 ?>