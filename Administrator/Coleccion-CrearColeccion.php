<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];


// Variables de  Admin-Habitación.php
$TxtNombre = strtoupper($_POST['TxtNombre']);
$TxtFechaInicio = $_POST['TxtFechaInicio'];
$EstadoTekMaster=1;

//Crear Habitación

$sql=("INSERT INTO t_colecciones(Nom_Coleccion, Fecha_Inicio) VALUES ('".utf8_decode($TxtNombre)."','".utf8_decode($TxtFechaInicio)."')");
//echo($sql);
$result = $conexion->query($sql);
if ($result){
    include("Lib/seguridad.php");
    $Datos="Se agrego una nueva coleccion con el nombre: ".$TxtNombre;
    $Paginas= $_SERVER['PHP_SELF'];
    $seguridad = AgregarLog($IdUser,$Datos,$Paginas);  
}
header("location:Productos-Coleccion.php?Mensaje=1");


 ?>