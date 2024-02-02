<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

// Variables de  Config.php 

$IdEstado = $_POST['IdEstado'];
$ColorSel = $_POST['ColorSel'];
$EditNomEstado=$_POST['EditNomEstado'];
$EditDesEstado=$_POST['EditDesEstado'];
//Actualización de Datos App


$sql ="UPDATE T_Estado_Tarea SET Color_Estado='".utf8_decode($ColorSel)."',Descrip_Estado_Tarea='".utf8_decode($EditDesEstado)."', Nom_Estado_Tarea='".utf8_decode($EditNomEstado)."' WHERE Id_Estado_Tarea='".$IdEstado."'";  
$result = $conexion->query($sql);

header("location:config.php?Mensaje=13&TAB=tabs-3");
 ?>