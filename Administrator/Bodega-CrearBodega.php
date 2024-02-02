<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];



// Variables de  Admin-Habitación.php
$TxtNombre = strtoupper($_POST['TxtNombre']);
$TxtCod = strtoupper($_POST['TxtCod']);
$TxtUsuario = strtoupper($_POST['TxtUsuario']);
$TxtCiudad = strtoupper($_POST['TxtCiudad']);
$TxtDir = strtoupper($_POST['TxtDir']);
$TxtCorreo = strtoupper($_POST['TxtCorreo']);
$TxtTel = strtoupper($_POST['TxtTel']);
$TxtCelular = strtoupper($_POST['TxtCelular']);


$EstadoTekMaster=1;

//Crear Habitación

$sql=("INSERT INTO t_bodegas (Cod_Bodega, Nom_Bodega, Usuario_Encargado, Dir_Bodega, Tel_Bodega, Cel_Bodega, Correo_Bodega, Ciudad_Id_Ciudad) VALUES ('".utf8_encode($TxtCod)."','".utf8_encode($TxtNombre)."','".utf8_encode($TxtUsuario)."','".utf8_encode($TxtDir)."','".utf8_encode($TxtTel)."','".utf8_encode($TxtCelular)."','".utf8_encode($TxtCorreo)."','".utf8_encode($TxtCiudad)."')");
//echo($sql);
$result = $conexion->query($sql);
if ($result){
    include("Lib/seguridad.php");
    $Datos="Se creo el Taller con el codigo: ".$TxtCod." y el nombre ".$TxtNombre;
    $Paginas= $_SERVER['PHP_SELF'];
    $seguridad = AgregarLog($IdUser,$Datos,$Paginas);
}
header("location:Bodegas.php?Mensaje=1");


 ?>