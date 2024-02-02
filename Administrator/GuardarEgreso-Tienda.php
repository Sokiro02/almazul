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
$TipoEgreso=$_GET['Admin'];
$TxtTienda=$_POST['ProyectoGasto'];
$CuentaRecibe=$_POST['CuentaRecibe'];
$TxtFecha=$_POST['TxtFecha'];
$TipoInversion=$_POST['TipoInversion'];
$TxtDetalle=htmlentities($_POST['TxtDetalle']);
$Valor1=$_POST['demo1'];
$TxtMedio=$_POST['TxtMedio'];

$For_Egreso=FormatoMascara($Valor1);

date_default_timezone_set("America/Bogota");
$MarcaTemporal = date('Y-m-d H:i:s');


//$target = "Images/Egresos/";
//$target = $target.$Aleaotorio."-". basename( $_FILES['fotoportada']['name']);
//Writes the file to the server
//Echo($target);

  
// Guardar datos

$sql=("INSERT INTO t_mov_cuentas(Id_Cuenta_Sale, Id_Cuenta_Entra,Fecha_Transf, Valor_Transferido,  Url_Soporte_Trans, Detalle, Por_Medio_de, Marca_Temporal,Egreso_Id_Usuario) VALUES ('".$MyIdTienda."','".utf8_decode($CuentaRecibe)."','".utf8_decode($TxtFecha)."','".utf8_decode($For_Egreso)."','".utf8_decode($target)."','".utf8_decode($TxtDetalle)."','".utf8_decode($TxtMedio)."','".utf8_decode($MarcaTemporal)."','".utf8_decode($IdUser)."')");
//echo($sql);
$result = $conexion->query($sql);

//header("location:Egresos-tienda.php?Mensaje=1");


  if ($TipoEgreso=1) {
  	header("location:Egresos-tienda.php?Mensaje=2");
  }
  else
  {
  	header("location:Egresos-tienda.php?Mensaje=2");
  }
  


?>

