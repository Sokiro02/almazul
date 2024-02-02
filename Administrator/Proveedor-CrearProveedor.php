<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];


// Variables de  Admin-Habitación.php
$TxtNombre = strtoupper($_POST['TxtNombre']);
$TxtNit = strtoupper($_POST['TxtNit']);
$TxtContacto = strtoupper($_POST['TxtContacto']);
$TxtCiudad = strtoupper($_POST['TxtCiudad']);
$TxtDir = strtoupper($_POST['TxtDir']);
$TxtCorreo = strtoupper($_POST['TxtCorreo']);
$TxtTel = strtoupper($_POST['TxtTel']);
$TxtCelular = strtoupper($_POST['TxtCelular']);
$TxtWhp = strtoupper($_POST['TxtWhp']);
$TxtTipoInsumo = strtoupper($_POST['TxtTipoInsumo']);

$EstadoTekMaster=1;

//Crear Habitación

$sql=("INSERT INTO t_proveedores(Nom_Prov, Nit_Prov, Dir_Prov, Tel_Prov, Cel1_Prov, Whp_Prov, Email_Prov, Contacto_Prov, Ciudad_Id_Ciudad,Tipo_Insumo) VALUES ('".utf8_decode($TxtNombre)."','".utf8_decode($TxtNit)."','".utf8_decode($TxtDir)."','".utf8_decode($TxtTel)."','".utf8_decode($TxtCelular)."','".utf8_decode($TxtWhp)."','".utf8_decode($TxtCorreo)."','".utf8_decode($TxtContacto)."','".utf8_decode($TxtCiudad)."','".utf8_decode($TxtTipoInsumo)."')");
//echo($sql);
$result = $conexion->query($sql);
if ($result){
    include("Lib/seguridad.php");
    $Datos = "Se ha creado un nuevo proveedor: ".$TxtNit." ".$TxtNombre;
    $seguridad = AgregarLog($IdUser,$Datos,"Proveedor-CrearProveedor.php");
}

header("location:Proveedores.php?Mensaje=1");


 ?>