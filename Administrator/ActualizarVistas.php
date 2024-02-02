<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

// Variables de  Config.php 

$TxtIdRol = $_POST['TxtIdRol'];
$TxtProduccion = $_POST['TxtProduccion'];
$TxtClientes = $_POST['TxtClientes'];
$TxtProveedores = $_POST['TxtProveedores'];
$TxtInsumos = $_POST['TxtInsumos'];
$TxtCompras = $_POST['TxtCompras'];
$TxtSastres = $_POST['TxtSastres'];
$TxtProdConfig = $_POST['TxtProdConfig'];
$TxtColecciones = $_POST['TxtColecciones'];
$TxtProdCrear = $_POST['TxtProdCrear'];
$TxtGaleria = $_POST['TxtGaleria'];
$TxtCentro = $_POST['TxtCentro'];
$TxtRemisiones = $_POST['TxtRemisiones'];
$TxtTiendas = $_POST['TxtTiendas'];
$TxtBodegas = $_POST['TxtBodegas'];


//Validación de Checkbox ////////////////////////
if ($TxtProduccion==1) {
	$ValorTxtProduccion=1;
}
else
{
	$ValorTxtProduccion=0;
}
//Validación de Checkbox ////////////////////////
if ($TxtClientes==1) {
	$ValorTxtClientes=1;
}
else
{
	$ValorTxtProduccion=0;
}
//Validación de Checkbox /////////////////////////
if ($TxtProveedores==1) {
	$ValorTxtProveedores=1;
}
else
{
	$ValorTxtProveedores=0;
}
//Validación de Checkbox /////////////////////////
if ($TxtInsumos==1) {
	$ValorTxtInsumos=1;
}
else
{
	$ValorTxtInsumos=0;
}
//Validación de Checkbox /////////////////////////
if ($TxtCompras==1) {
	$ValorTxtCompras=1;
}
else
{
	$ValorTxtCompras=0;
}

//Validación de Checkbox /////////////////////////
if ($TxtSastres==1) {
	$ValorTxtSastres=1;
}
else
{
	$ValorTxtSastres=0;
}

//Validación de Checkbox /////////////////////////
if ($TxtProdConfig==1) {
	$ValorTxtProdConfig=1;
}
else
{
	$ValorTxtProdConfig=0;
}


//Validación de Checkbox /////////////////////////
if ($TxtColecciones==1) {
	$ValorTxtColecciones=1;
}
else
{
	$ValorTxtColecciones=0;
}


//Validación de Checkbox /////////////////////////
if ($TxtProdCrear==1) {
	$ValorTxtProdCrear=1;
}
else
{
	$ValorTxtProdCrear=0;
}


//Validación de Checkbox /////////////////////////
if ($TxtGaleria==1) {
	$ValorTxtGaleria=1;
}
else
{
	$ValorTxtGaleria=0;
}


//Validación de Checkbox /////////////////////////
if ($TxtCentro==1) {
	$ValorTxtCentro=1;
}
else
{
	$ValorTxtCentro=0;
}


//Validación de Checkbox /////////////////////////
if ($TxtRemisiones==1) {
	$ValorTxtRemisiones=1;
}
else
{
	$ValorTxtRemisiones=0;
}


//Validación de Checkbox /////////////////////////
if ($TxtTiendas==1) {
	$ValorTxtTiendas=1;
}
else
{
	$ValorTxtTiendas=0;
}

//Validación de Checkbox /////////////////////////
if ($TxtBodegas==1) {
	$ValorTxtBodegas=1;
}
else
{
	$ValorTxtBodegas=0;
}


//Actualización de Datos App

$sql ="UPDATE t_rol_usuario SET Menu_Produccion='".utf8_decode($ValorTxtProduccion)."',Menu_Clientes='".utf8_decode($ValorTxtClientes)."', Menu_Proveedores='".utf8_decode($ValorTxtProveedores)."', Menu_Insumos='".utf8_decode($ValorTxtInsumos)."', Menu_Compras='".utf8_decode($ValorTxtCompras)."', Menu_Sastres='".utf8_decode($ValorTxtSastres)."', Menu_Prod_Config='".utf8_decode($ValorTxtProdConfig)."', Menu_Prod_Colecciones='".utf8_decode($ValorTxtColecciones)."', Menu_Prod_Crear='".utf8_decode($ValorTxtProdCrear)."', Menu_Galeria='".utf8_decode($ValorTxtGaleria)."', Menu_CentroDist='".utf8_decode($ValorTxtCentro)."', Menu_Remisiones='".utf8_decode($ValorTxtRemisiones)."', Menu_Tiendas='".utf8_decode($ValorTxtTiendas)."', Menu_Bodegas='".utf8_decode($ValorTxtBodegas)."' WHERE Id_Rol='".$TxtIdRol."'";  
$result = $conexion->query($sql);

header("location:config.php?Mensaje=15&TAB=tabs-4");
 ?>