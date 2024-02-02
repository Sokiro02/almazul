<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];
include("Lib/permisos.php");
 $MyIdTienda=$_SESSION['IdTienda'];
 $MiTienda=$_SESSION['nicktienda'];
$Aleaotorio=rand(0,9999);
//======================================================================
// Datos de Formulario Gastos
$TxtTienda=$_POST['ProyectoGasto'];
$Txtfuente=strtoupper($_POST['fuente']);
$TxtFecha=$_POST['TxtFecha'];
$SelRubro=$_POST['SelRubro'];
$SelSubrubro=$_POST['SelSubrubro'];
$TipoInversion=$_POST['TipoInversion'];
$TxtDetalle=$_POST['TxtDetalle'];
$Valor1=$_POST['demo1'];


$For_gastos=FormatoMascara($Valor1);

date_default_timezone_set("America/Bogota");
$MarcaTemporal = date('Y-m-d H:i:s');
$AreaGasto=2;


//$target = "Images/Gastos/";
//$target = $target.$Aleaotorio."-". basename( $_FILES['fotoportada']['name']);
//Writes the file to the server
//Echo($target);



$sql=("INSERT INTO t_ingreso_dinero(Fecha_ingreso,fuente,Descripcion, Valor_ingresodinero, Marca_temporal, Usuario_id_usuario,Tienda_Id_Tienda,Area_Id_Area) VALUES ('".utf8_decode($TxtFecha)."','".utf8_decode($Txtfuente)."','".utf8_decode($TxtDetalle)."','".utf8_decode($For_gastos)."','".utf8_decode($MarcaTemporal)."','".utf8_decode($IdUser)."','".utf8_decode($TxtTienda)."','".utf8_decode($AreaGasto)."')");
echo($sql);
$result = $conexion->query($sql);

header("location:ingresodinero-tienda.php?Mensaje=1");


?>

