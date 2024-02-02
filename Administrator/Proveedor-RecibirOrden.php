<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];

//Actualizar Información del Insumo
// Datos extraídos de Proveedor-DetalleCompra.php

$Txt_ObservaItem = strtoupper($_POST['Txt_ObservaItem']);
$Txt_Cant_Recibida = strtoupper($_POST['Txt_Cant_Recibida']);
$Txt_IdOrdenCompra = $_POST['Txt_IdOrdenCompra'];
$TxtIdInsumo = $_POST['TxtIdInsumo'];
$Txt_CantSolicitada = $_POST['Txt_CantSolicitada'];
$Txt_NumeroOrden = $_POST['Txt_NumeroOrden'];
$Txt_Insumo_Cod_Insumo = $_POST['Txt_Insumo_Cod_Insumo'];
$Txt_Bodega_Id_Bodega= $_POST['Txt_Bodega_Id_Bodega'];
$Tb_Unidad_Insumo = $_POST['Tb_Unidad_Insumo'];




date_default_timezone_set("America/Bogota");
$MarcaTemporal = date('Y-m-d H:i:s');
$EstadoTek=0;


$IdValledupar=5;
date_default_timezone_set("America/Bogota");
$DiaActual = date('Y-m-d H:i:s');




// Actualizar información en Orden de Compra
$sql=("UPDATE t_orden_compra_insumos SET Cant_Recibida=Cant_Recibida+'".utf8_decode($Txt_Cant_Recibida)."', Observa_Compra='".$Txt_ObservaItem."', Fecha_Recibido='".$MarcaTemporal."' WHERE Id_Orden_Compra='".$Txt_IdOrdenCompra."'");
//echo($sql);
$result = $conexion->query($sql);





$sql ="SELECT Cod_Insumo_Cod FROM t_inventario_telas WHERE Cod_Insumo_Cod='".$Txt_Insumo_Cod_Insumo."'";  
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$VerificarInsumo=$row['Cod_Insumo_Cod']; 
echo($sql);
Echo("<br>");
Echo($VerificarInsumo);
 }
}

	if ($VerificarInsumo!="") {
		
		$SqlActualizar ="UPDATE t_inventario_telas SET Cantidad_Inv=Cantidad_Inv+'".$Txt_Cant_Recibida."' WHERE Cod_Insumo_Cod='".$Txt_Insumo_Cod_Insumo."'"; //ACTUALIZAMOS EL INVENTARIO
        $ResultActualizar = $conexion->query($SqlActualizar)or die (mysqli_error($conexion));
        header("location:Proveedor-DetalleCompra.php?Mensaje=2&NumeroOrden=".$Txt_NumeroOrden."");

	}
	else
	{
		$sql=("INSERT INTO t_inventario_telas(taller_id_taller, Insumo_Id_Insumo, Cod_Insumo_Cod, Cantidad_Inv, Medida_Inv, Fecha_Ingreso, Responsable_Id_Usuario) VALUES('".$IdValledupar."','".$TxtIdInsumo."','".$Txt_Insumo_Cod_Insumo."','".$Txt_Cant_Recibida."','".$Tb_Unidad_Insumo."','".$DiaActual."','".$IdUser."');");
//Echo($sql);
$result = $conexion->query($sql);
			header("location:Proveedor-DetalleCompra.php?Mensaje=2&NumeroOrden=".$Txt_NumeroOrden."");
	}




















 ?>