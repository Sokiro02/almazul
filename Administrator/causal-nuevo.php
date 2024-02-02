<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];


// Variables de  Admin-Habitación.php
$TxtNombre = strtoupper($_POST['TxtNombre']);
$EstadoTekMaster=1;

//Crear Habitación

$sql=("INSERT INTO t_causales(nombre_causal, estado) VALUES ('".utf8_decode($TxtNombre)."','".utf8_decode($EstadoTekMaster)."')");
//echo($sql);
$result = $conexion->query($sql);
if ($result){
    include("Lib/seguridad.php");
    $Datos = "Se ha creado un nuevo causal: ".$TxtNit." ".$TxtNombre;
    $seguridad = AgregarLog($IdUser,$Datos,"causal-nuevo.php");
}

header("location:causales.php?Mensaje=1");


 ?>