<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];

// Variables de  Informe-Bonos.php
$TxtIdBono = $_POST['TxtIdBono'];
$TxtNumBono = $_POST['TxtNumBono'];
$TxtNuevaFecha = $_POST['TxtNuevaFecha'];
$TxtTienda = $_POST['TxtTienda'];

$Valor1=$_POST['demo1'];
$For_Costo1=FormatoMascara($Valor1);



$sql=("UPDATE t_bonos SET Num_Bono='".$TxtNumBono."',Fecha_Bono='".$TxtNuevaFecha."', Tienda_Id_Tienda='".$TxtTienda."', Valor_Comercial='".$For_Costo1."', Usuario_Crea='".$IdUser."'  WHERE Id_Bono='".$TxtIdBono."'");
echo($sql);
$result = $conexion->query($sql);

header("location:Informe-Bonos.php?Mensaje=334");






 ?>