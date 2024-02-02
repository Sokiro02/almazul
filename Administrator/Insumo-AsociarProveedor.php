<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$Aleaotorio=rand(0,9999);

// Variables de modal  insumos.php
$TxtCodigo = $_POST['TxtCodigo'];

$TxtProveedor1 = $_POST['TxtProveedor1'];
$TxtProveedor2 = $_POST['TxtProveedor2'];
$TxtProveedor3 = $_POST['TxtProveedor3'];
$TxtCodProv1 = $_POST['TxtCodProv1'];
$TxtCodProv2 = $_POST['TxtCodProv2'];
$TxtCodProv3 = $_POST['TxtCodProv3'];
$TxtCategoria =$_POST['TxtCategoria'];
$TxtUrl=$_POST['TxtUrl'];

$Valor1=$_POST['demo1'];
$For_Costo1=FormatoMascara($Valor1);

$Valor2=$_POST['demo2'];
$For_Costo2=FormatoMascara($Valor2);

$Valor3=$_POST['demo3'];
$For_Costo3=FormatoMascara($Valor3);


//**************************************************************************************************************
//Ingresar Proveedor 1
//**************************************************************************************************************

	
//**************************************************************************************************************
//Ingresar Proveedor 1 Sin Imagen
//**************************************************************************************************************

	if ($TxtProveedor1!="" & $Valor1!="") {
		
		$sql=("INSERT INTO t_insumos (Url_Insumo,Cod_Insumo,Cod_Proveedor, Proveedor_Id_Proveedor, Costo_Insumo,Categoria_Id_Categoria_Insumo) VALUES ('".utf8_decode($TxtUrl)."','".utf8_decode($TxtCodigo)."','".utf8_decode($TxtCodProv1)."','".utf8_decode($TxtProveedor1)."','".utf8_decode($For_Costo1)."','".utf8_decode($TxtCategoria)."')");
		echo($sql);
		$result = $conexion->query($sql);
	}

//**************************************************************************************************************
//Ingresar Proveedor 2 Sin Imagen
//**************************************************************************************************************

	if ($TxtProveedor2!="" & $Valor2!="") {
		$sql=("INSERT INTO t_insumos (Url_Insumo,Cod_Insumo,Cod_Proveedor, Proveedor_Id_Proveedor, Costo_Insumo,Categoria_Id_Categoria_Insumo) VALUES ('".utf8_decode($TxtUrl)."','".utf8_decode($TxtCodigo)."','".utf8_decode($TxtCodProv2)."','".utf8_decode($TxtProveedor2)."','".utf8_decode($For_Costo2)."','".utf8_decode($TxtCategoria)."')");
		//echo($sql);
		$result = $conexion->query($sql);
	}

//**************************************************************************************************************
//Ingresar Proveedor 3 Sin Imagen
//**************************************************************************************************************

	if ($TxtProveedor3!="" & $Valor3!="") {
		$sql=("INSERT INTO t_insumos (Url_Insumo,Cod_Insumo,Cod_Proveedor, Proveedor_Id_Proveedor, Costo_Insumo,Categoria_Id_Categoria_Insumo) VALUES ('".utf8_decode($TxtUrl)."','".utf8_decode($TxtCodigo)."','".utf8_decode($TxtCodProv3)."','".utf8_decode($TxtProveedor3)."','".utf8_decode($For_Costo3)."','".utf8_decode($TxtCategoria)."')");
		//echo($sql);
		$result = $conexion->query($sql);
	}

		header("location:insumos.php?Mensaje=1");




 ?>