<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];
// Variables de  CrearVenta.php 
date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');

$RefSel=$_GET['RefSel'];

$ForVenta=$_GET['ForVenta'];

if ($ForVenta==1) {
	// Variables de  


$TxtDocumento = $_POST['TxtDocumento'];
$TxtNombre = htmlentities(strtoupper($_POST['TxtNombre']));
$TxtApellido = htmlentities(strtoupper($_POST['TxtApellido']));
$TxtCiudad = htmlentities(strtoupper($_POST['TxtCiudad']));
$TxtCorreo = strtoupper($_POST['TxtCorreo']);
$TxtTel = strtoupper($_POST['TxtTel']);
$TxtCelular = strtoupper($_POST['TxtCelular']);
$TxtWhp = strtoupper($_POST['TxtWhp']);
$TxtDireccion= strtoupper($_POST['TxtDireccion']);
$target_file="images/Perfiles/7287-User-Default.jpg";
$EstadoTekMaster=1;

$Fechadia=$_POST['Fechadia'];
$Fechames=$_POST['Fechames'];
$Fechaano=$_POST['Fechaano'];


	$sql ="SELECT Documento_Cliente FROM t_clientes WHERE Documento_Cliente='".$TxtDocumento."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $QrDocumento=$row['Documento_Cliente'];
  }
}
	if ($QrDocumento!="") {
		header("location:CrearVenta.php?Mensaje=555");
	}
	else
	{
//Crear Cliente

$sql=("INSERT INTO t_clientes (Documento_Cliente,Avatar_Cliente, Nom_Cliente, Ape_Cliente, Ciudad_Id_Ciudad, Correo_Cliente, Tel_Cliente, Cel1_Cliente, Cel2_Cliente, Tipo_Cliente,Ingresado_Por, Fecha_Ingreso,Fechadia,Fechames,Fechaano,Dir_Cliente) VALUES ('".utf8_decode($TxtDocumento)."','".utf8_decode($target_file)."','".utf8_decode($TxtNombre)."','".utf8_decode($TxtApellido)."','".utf8_decode($TxtCiudad)."','".utf8_decode($TxtCorreo)."','".utf8_decode($TxtTel)."','".utf8_decode($TxtCelular)."','".utf8_decode($TxtWhp)."','".utf8_decode($EstadoTekMaster)."','".utf8_decode($IdUser)."','".$TiempoActual."','".$Fechadia."','".$Fechames."','".$Fechaano."','".$TxtDireccion."')");
//echo($sql);
$result = $conexion->query($sql);

header("location:CrearVenta.php?Mensaje=4");
	}
}
elseif ($ForVenta==6) {
	// Variables de  

$TxtDocumento = $_POST['TxtDocumento'];
$TxtNombre = htmlentities(strtoupper($_POST['TxtNombre']));
$TxtApellido = htmlentities(strtoupper($_POST['TxtApellido']));
$TxtCiudad = htmlentities(strtoupper($_POST['TxtCiudad']));
$TxtCorreo = strtoupper($_POST['TxtCorreo']);
$TxtTel = strtoupper($_POST['TxtTel']);
$TxtCelular = strtoupper($_POST['TxtCelular']);
$TxtWhp = strtoupper($_POST['TxtWhp']);
$TxtDireccion= strtoupper($_POST['TxtDireccion']);
$target_file="images/Perfiles/7287-User-Default.jpg";
$EstadoTekMaster=1;
$Fechadia=$_POST['Fechadia'];
$Fechames=$_POST['Fechames'];
$Fechaano=$_POST['Fechaano'];

	$sql ="SELECT Documento_Cliente FROM t_clientes WHERE Documento_Cliente='".$TxtDocumento."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $QrDocumento=$row['Documento_Cliente'];
  }
}
	if ($QrDocumento!="") {
		header("location:CrearPlanSepare.php?Mensaje=555");
	}
	else
	{
//Crear Cliente

$sql=("INSERT INTO t_clientes (Documento_Cliente,Avatar_Cliente, Nom_Cliente, Ape_Cliente, Ciudad_Id_Ciudad, Correo_Cliente, Tel_Cliente, Cel1_Cliente, Cel2_Cliente, Tipo_Cliente,Ingresado_Por, Fecha_Ingreso,Fechadia,Fechames,Fechaano,Dir_Cliente) VALUES ('".utf8_decode($TxtDocumento)."','".utf8_decode($target_file)."','".utf8_decode($TxtNombre)."','".utf8_decode($TxtApellido)."','".utf8_decode($TxtCiudad)."','".utf8_decode($TxtCorreo)."','".utf8_decode($TxtTel)."','".utf8_decode($TxtCelular)."','".utf8_decode($TxtWhp)."','".utf8_decode($EstadoTekMaster)."','".utf8_decode($IdUser)."','".$TiempoActual."','".$Fechadia."','".$Fechames."','".$Fechaano."','".utf8_decode($TxtDireccion)."')");
//echo($sql);
$result = $conexion->query($sql);

header("location:CrearPlanSepare.php?Mensaje=4");
	}
}
elseif ($ForVenta==3) {

$TxtDocumento = $_POST['TxtDocumento'];
$TxtNombre = htmlentities(strtoupper($_POST['TxtNombre']));
$TxtApellido = htmlentities(strtoupper($_POST['TxtApellido']));
$TxtCiudad = htmlentities(strtoupper($_POST['TxtCiudad']));
$TxtCorreo = strtoupper($_POST['TxtCorreo']);
$TxtTel = strtoupper($_POST['TxtTel']);
$TxtCelular = strtoupper($_POST['TxtCelular']);
$TxtWhp = strtoupper($_POST['TxtWhp']);
$TxtDireccion= strtoupper($_POST['TxtDireccion']);
$target_file="images/Perfiles/7287-User-Default.jpg";
$EstadoTekMaster=1;

$Fechadia=$_POST['Fechadia'];
$Fechames=$_POST['Fechames'];
$Fechaano=$_POST['Fechaano'];

//Crear Cliente

$sql ="SELECT Documento_Cliente FROM t_clientes WHERE Documento_Cliente='".$TxtDocumento."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $QrDocumento=$row['Documento_Cliente'];
  }
}
	if ($QrDocumento!="") {
		header("location:Clientes.php?Mensaje=555");
	}
	else
	{

$sql=("INSERT INTO t_clientes (Documento_Cliente,Avatar_Cliente, Nom_Cliente, Ape_Cliente, Ciudad_Id_Ciudad, Correo_Cliente, Tel_Cliente, Cel1_Cliente, Cel2_Cliente, Tipo_Cliente,Ingresado_Por, Fecha_Ingreso,Fechadia,Fechames,Fechaano,Dir_Cliente) VALUES ('".utf8_decode($TxtDocumento)."','".utf8_decode($target_file)."','".utf8_decode($TxtNombre)."','".utf8_decode($TxtApellido)."','".utf8_decode($TxtCiudad)."','".utf8_decode($TxtCorreo)."','".utf8_decode($TxtTel)."','".utf8_decode($TxtCelular)."','".utf8_decode($TxtWhp)."','".utf8_decode($EstadoTekMaster)."','".utf8_decode($IdUser)."','".$TiempoActual."','".$Fechadia."','".$Fechames."','".$Fechaano."','".$TxtDireccion."')");
//echo($sql);
$result = $conexion->query($sql);

header("location:Clientes.php?Mensaje=1");
	}
	
}

elseif ($ForVenta==4) {

$TxtDocumento = $_POST['TxtDocumento'];
$TxtNombre = htmlentities(strtoupper($_POST['TxtNombre']));
$TxtApellido = htmlentities(strtoupper($_POST['TxtApellido']));
$TxtCiudad = strtoupper($_POST['TxtCiudad']);
$TxtCorreo = strtoupper($_POST['TxtCorreo']);
$TxtTel = strtoupper($_POST['TxtTel']);
$TxtCelular = strtoupper($_POST['TxtCelular']);
$TxtWhp = strtoupper($_POST['TxtWhp']);
$TxtDireccion= strtoupper($_POST['TxtDireccion']);
$target_file="images/Perfiles/7287-User-Default.jpg";
$EstadoTekMaster=1;
$Fechadia=$_POST['Fechadia'];
$Fechames=$_POST['Fechames'];
$Fechaano=$_POST['Fechaano'];


//Crear Cliente

$sql ="SELECT Documento_Cliente FROM t_clientes WHERE Documento_Cliente='".$TxtDocumento."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $QrDocumento=$row['Documento_Cliente'];
  }
}
	if ($QrDocumento!="") {
		header("location:CrearRemisionTienda.php?Mensaje=555");
	}
	else
	{

$sql=("INSERT INTO t_clientes (Documento_Cliente,Avatar_Cliente, Nom_Cliente, Ape_Cliente, Ciudad_Id_Ciudad, Correo_Cliente, Tel_Cliente, Cel1_Cliente, Cel2_Cliente, Tipo_Cliente,Ingresado_Por, Fecha_Ingreso,Fechadia,Fechames,Fechaano,Dir_Cliente) VALUES ('".utf8_decode($TxtDocumento)."','".utf8_decode($target_file)."','".utf8_decode($TxtNombre)."','".utf8_decode($TxtApellido)."','".utf8_decode($TxtCiudad)."','".utf8_decode($TxtCorreo)."','".utf8_decode($TxtTel)."','".utf8_decode($TxtCelular)."','".utf8_decode($TxtWhp)."','".utf8_decode($EstadoTekMaster)."','".utf8_decode($IdUser)."','".$TiempoActual."','".$Fechadia."','".$Fechames."','".$Fechaano."','".$TxtDireccion."')");
//echo($sql);
$result = $conexion->query($sql);

header("location:CrearRemisionTienda.php?Mensaje=4");
	}
	
}
elseif ($ForVenta==5) {

$TxtDocumento = $_POST['TxtDocumento'];
$TxtNombre = htmlentities(strtoupper($_POST['TxtNombre']));
$TxtApellido = htmlentities(strtoupper($_POST['TxtApellido']));
$TxtCiudad = strtoupper($_POST['TxtCiudad']);
$TxtCorreo = strtoupper($_POST['TxtCorreo']);
$TxtTel = strtoupper($_POST['TxtTel']);
$TxtCelular = strtoupper($_POST['TxtCelular']);
$TxtWhp = strtoupper($_POST['TxtWhp']);
$TxtDireccion= strtoupper($_POST['TxtDireccion']);

//Echo ("la dirección: ".$TxtDireccion);
$target_file="images/Perfiles/7287-User-Default.jpg";
$EstadoTekMaster=1;
$Fechadia=$_POST['Fechadia'];
$Fechames=$_POST['Fechames'];
$Fechaano=$_POST['Fechaano'];



//Crear Cliente

$sql ="SELECT Documento_Cliente FROM t_clientes WHERE Documento_Cliente='".$TxtDocumento."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $QrDocumento=$row['Documento_Cliente'];
  }
}
	if ($QrDocumento!="") {
		header("location:index-ventas.php?Mensaje=555");
	}
	else
	{

$sql=("INSERT INTO t_clientes (Documento_Cliente,Avatar_Cliente, Nom_Cliente, Ape_Cliente, Ciudad_Id_Ciudad, Correo_Cliente, Tel_Cliente, Cel1_Cliente, Cel2_Cliente, Tipo_Cliente,Ingresado_Por, Fecha_Ingreso,Fechadia,Fechames,Fechaano,Dir_Cliente) VALUES ('".utf8_decode($TxtDocumento)."','".utf8_decode($target_file)."','".utf8_decode($TxtNombre)."','".utf8_decode($TxtApellido)."','".utf8_decode($TxtCiudad)."','".utf8_decode($TxtCorreo)."','".utf8_decode($TxtTel)."','".utf8_decode($TxtCelular)."','".utf8_decode($TxtWhp)."','".utf8_decode($EstadoTekMaster)."','".utf8_decode($IdUser)."','".$TiempoActual."','".$Fechadia."','".$Fechames."','".$Fechaano."','".$TxtDireccion."')");
//echo($sql);
$result = $conexion->query($sql);

header("location:index-ventas.php?Mensaje=1");
	}
	
}
elseif ($ForVenta==8) {

$TxtDocumento = $_POST['TxtDocumento'];
$TxtNombre = htmlentities(strtoupper($_POST['TxtNombre']));
$TxtApellido = htmlentities(strtoupper($_POST['TxtApellido']));
$TxtCiudad = strtoupper($_POST['TxtCiudad']);
$TxtCorreo = strtoupper($_POST['TxtCorreo']);
$TxtTel = strtoupper($_POST['TxtTel']);
$TxtCelular = strtoupper($_POST['TxtCelular']);
$TxtWhp = strtoupper($_POST['TxtWhp']);
$TxtDireccion= strtoupper($_POST['TxtDireccion']);
$target_file="images/Perfiles/7287-User-Default.jpg";
$EstadoTekMaster=1;
$Fechadia=$_POST['Fechadia'];
$Fechames=$_POST['Fechames'];
$Fechaano=$_POST['Fechaano'];


//Crear Cliente

$sql ="SELECT Documento_Cliente FROM t_clientes WHERE Documento_Cliente='".$TxtDocumento."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $QrDocumento=$row['Documento_Cliente'];
  }
}
	if ($QrDocumento!="") {
		header("location:cc_crearsalida.php?Mensaje=555");
	}
	else
	{

$sql=("INSERT INTO t_clientes (Documento_Cliente,Avatar_Cliente, Nom_Cliente, Ape_Cliente, Ciudad_Id_Ciudad, Correo_Cliente, Tel_Cliente, Cel1_Cliente, Cel2_Cliente, Tipo_Cliente,Ingresado_Por, Fecha_Ingreso,Fechadia,Fechames,Fechaano,Dir_Cliente) VALUES ('".utf8_decode($TxtDocumento)."','".utf8_decode($target_file)."','".utf8_decode($TxtNombre)."','".utf8_decode($TxtApellido)."','".utf8_decode($TxtCiudad)."','".utf8_decode($TxtCorreo)."','".utf8_decode($TxtTel)."','".utf8_decode($TxtCelular)."','".utf8_decode($TxtWhp)."','".utf8_decode($EstadoTekMaster)."','".utf8_decode($IdUser)."','".$TiempoActual."','".$Fechadia."','".$Fechames."','".$Fechaano."','".$TxtDireccion."')");
//echo($sql);
$result = $conexion->query($sql);

header("location:cc_crearsalida.php?Mensaje=4");
	}
	
}
else
{
	// Variables de  Admin-Habitación.php

$TxtDocumento = $_POST['TxtDocumento'];
$TxtNombre = htmlentities(strtoupper($_POST['TxtNombre']));
$TxtApellido = htmlentities(strtoupper($_POST['TxtApellido']));
$TxtCiudad = strtoupper($_POST['TxtCiudad']);
$TxtCorreo = strtoupper($_POST['TxtCorreo']);
$TxtTel = strtoupper($_POST['TxtTel']);
$TxtCelular = strtoupper($_POST['TxtCelular']);
$TxtWhp = strtoupper($_POST['TxtWhp']);
$TxtDireccion= strtoupper($_POST['TxtDireccion']);
$target_file="images/Perfiles/7287-User-Default.jpg";

$EstadoTekMaster=1;

$Fechadia=$_POST['Fechadia'];
$Fechames=$_POST['Fechames'];
$Fechaano=$_POST['Fechaano'];

//Crear Cliente

$sql ="SELECT Documento_Cliente FROM t_clientes WHERE Documento_Cliente='".$TxtDocumento."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $QrDocumento=$row['Documento_Cliente'];
  }
}
	if ($QrDocumento!="") {
		header("location:OrdenCliente.php?Mensaje=555");
	}
	else
	{

$sql=("INSERT INTO t_clientes (Documento_Cliente,Avatar_Cliente, Nom_Cliente, Ape_Cliente, Ciudad_Id_Ciudad, Correo_Cliente, Tel_Cliente, Cel1_Cliente, Cel2_Cliente, Tipo_Cliente,Ingresado_Por, Fecha_Ingreso,Fechadia,Fechames,Fechaano,Dir_Cliente) VALUES ('".utf8_decode($TxtDocumento)."','".utf8_decode($target_file)."','".utf8_decode($TxtNombre)."','".utf8_decode($TxtApellido)."','".utf8_decode($TxtCiudad)."','".utf8_decode($TxtCorreo)."','".utf8_decode($TxtTel)."','".utf8_decode($TxtCelular)."','".utf8_decode($TxtWhp)."','".utf8_decode($EstadoTekMaster)."','".utf8_decode($IdUser)."','".$TiempoActual."','".$Fechadia."','".$Fechames."','".$Fechaano."','".$TxtDireccion."')");
//echo($sql);
$result = $conexion->query($sql);

header("location:OrdenCliente.php?Mensaje=111");
	}
}



 ?>