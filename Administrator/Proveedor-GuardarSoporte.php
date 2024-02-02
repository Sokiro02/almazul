<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$Aleaotorio=rand(0,9999);

// Variables de modal  insumos.php
$TxtDetalle = strtoupper($_POST['TxtDetalle']);
$Txt_NumeroOrden =$_POST['Txt_NumeroOrden'];
$Txtportada=basename( $_FILES['fotoportada']['name']);
$EstadoTekMaster=1;

//**************************************************************************************************************
//Ingresar Proveedor 1
//**************************************************************************************************************

	if ($Txtportada=="") { //Primera  Condición
			header("location:Proveedor-DetalleCompra.php?Mensaje=14");
	}
	else
	{
$target = "Images/Compras-Insumos/";
$target = $target.$Aleaotorio."-". basename( $_FILES['fotoportada']['name']);
//Writes the file to the server
//Echo($target);
		if(move_uploaded_file($_FILES['fotoportada']['tmp_name'], $target))
{//Segunda Condición
	$uploadRes=true;

	$sql=("UPDATE t_orden_compra_insumos SET Soporte_Compra='".utf8_decode($target)."', Observa_Soporte='".$TxtDetalle."' WHERE Cod_Orden_Prov='".$Txt_NumeroOrden."'");
//echo($sql);
$result = $conexion->query($sql);

header("location:Proveedor-DetalleCompra.php?Mensaje=13&NumeroOrden=".$Txt_NumeroOrden."");

		}
		else
		{
			//   $uploadRes=false;
Echo("Hola mundo");
//   //header("location:NuevoNegocio.php?Mensaje=10");
		}
	}



 ?>