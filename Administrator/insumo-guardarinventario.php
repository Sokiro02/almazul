<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
include("Lib/seguridad.php");
$IdUser=$_SESSION['IdUser'];
$Aleaotorio=rand(0,9999);

// Variables de insumos-cargar.php
$TxtIdInsumo=$_POST['TxtIdInsumo'];
$Qr_Cod_Insumo=$_POST['Qr_Cod_Insumo'];
$Qr_Unidad_Insumo=$_POST['Qr_Unidad_Insumo'];
$CantidadInventario=$_POST['CantidadInventario'];
$IdValledupar=5;
date_default_timezone_set("America/Bogota");
$DiaActual = date('Y-m-d H:i:s');

if ($CantidadInventario==0) {
	header("location:insumo-cargar.php?Mensaje=2");
}
else
{

$sql ="SELECT Cod_Insumo_Cod FROM t_inventario_telas WHERE Cod_Insumo_Cod='".$Qr_Cod_Insumo."'";  
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
		
		$SqlActualizar ="UPDATE t_inventario_telas SET Cantidad_Inv=Cantidad_Inv+'".$CantidadInventario."' WHERE Cod_Insumo_Cod='".$Qr_Cod_Insumo."'"; //ACTUALIZAMOS EL INVENTARIO
        $ResultActualizar = $conexion->query($SqlActualizar)or die (mysqli_error($conexion));


        $SqlActualizar ="UPDATE t_inventario_telas_res SET Cantidad_Inv=Cantidad_Inv+'".$CantidadInventario."' WHERE Cod_Insumo_Cod='".$Qr_Cod_Insumo."'"; //ACTUALIZAMOS EL INVENTARIO
        $ResultActualizar = $conexion->query($SqlActualizar)or die (mysqli_error($conexion));

        //Echo($SqlActualizar);
        header("location:insumos-cargar.php?Mensaje=111");

	}
	else
	{
		$sql=("INSERT INTO t_inventario_telas(taller_id_taller, Insumo_Id_Insumo, Cod_Insumo_Cod, Cantidad_Inv, Medida_Inv, Fecha_Ingreso, Responsable_Id_Usuario) VALUES('".$IdValledupar."','".$TxtIdInsumo."','".$Qr_Cod_Insumo."','".$CantidadInventario."','".$Qr_Unidad_Insumo."','".$DiaActual."','".$IdUser."');");
//Echo($sql);
$result = $conexion->query($sql);

$sql=("INSERT INTO t_inventario_telas_res (taller_id_taller, Insumo_Id_Insumo, Cod_Insumo_Cod, Cantidad_Inv, Medida_Inv, Fecha_Ingreso, Responsable_Id_Usuario) VALUES('".$IdValledupar."','".$TxtIdInsumo."','".$Qr_Cod_Insumo."','".$CantidadInventario."','".$Qr_Unidad_Insumo."','".$DiaActual."','".$IdUser."');");
//Echo($sql);
$result = $conexion->query($sql);

			header("location:insumos-cargar.php?Mensaje=111");
	}

	

}



		
 ?>