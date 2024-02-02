<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];

date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');

$TxtConsecutivonotas=$_POST['TxtConsecutivonotas'];
$TxtNumFactura=$_POST['TxtNumFactura'];
$TxtTienda=$_POST['TxtTienda'];


$SqlActualizar ="UPDATE t_devoluciones SET notacredito_num='".$TxtConsecutivonotas."',fecha_guardada='".$TiempoActual."' WHERE Num_Factura='".$TxtNumFactura."' and Tienda_Id_Tienda='".$TxtTienda."'"; //ACTUALIZAMOS EL CONSECUTIVO DE NOTA CRÉDITO
        $ResultActualizar = $conexion->query($SqlActualizar)or die (mysqli_error($conexion));


$SqlActualizar2 ="UPDATE t_config_tienda SET Consecutivo_Notas='".$TxtConsecutivonotas."' WHERE Tienda_Id_Tienda='1'"; //ACTUALIZAMOS EL CONSECUTIVO DE NOTA CRÉDITO
$ResultActualizar2 = $conexion->query($SqlActualizar2)or die (mysqli_error($conexion));


$SqlActualizar3 ="UPDATE t_config_tienda SET Consecutivo_Notas='".$TxtConsecutivonotas."' WHERE Tienda_Id_Tienda='11'"; //ACTUALIZAMOS EL CONSECUTIVO DE NOTA CRÉDITO
$ResultActualizar3 = $conexion->query($SqlActualizar3)or die (mysqli_error($conexion));

$SqlActualizar4 ="UPDATE t_config_tienda SET Consecutivo_Notas='".$TxtConsecutivonotas."' WHERE Tienda_Id_Tienda='17'"; //ACTUALIZAMOS EL CONSECUTIVO DE NOTA CRÉDITO
$ResultActualizar4 = $conexion->query($SqlActualizar4)or die (mysqli_error($conexion));


header("location:Informe-NotasCredito.php?Mensaje=352");


 ?>