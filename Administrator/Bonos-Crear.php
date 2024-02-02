<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];

// Variables de  Informe-Bonos.php
$TxtNumBono = $_POST['TxtNumBono'];
$TxtNuevaFecha = $_POST['TxtNuevaFecha'];
$TxtTienda = $_POST['TxtTienda'];
$TxtEstado = "Sin Vender";


$sql ="SELECT Num_Bono FROM t_bonos Where Num_Bono='".$TxtNumBono."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Num_Bono_Base=$row['Num_Bono'];  
    }
  }

if ($Num_Bono_Base==$TxtNumBono) {
	header("location:Informe-Bonos.php?Mensaje=332");
}
else
{
	$sql=("INSERT INTO t_bonos (Num_Bono,Tienda_Id_Tienda, Fecha_Bono, Estado_Bono,Usuario_Crea) VALUES ('".$TxtNumBono."','".$TxtTienda."','".($TxtNuevaFecha)."','".($TxtEstado)."','".$IdUser."')");
	//echo($sql);
	$result = $conexion->query($sql);

	header("location:Informe-Bonos.php?Mensaje=333");
}






 ?>