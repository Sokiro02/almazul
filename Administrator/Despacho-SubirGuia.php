<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$Aleaotorio=rand(0,9999);

// Variables de modal  insumos.php
$TxtGuia = $_POST['TxtGuia'];
$TxtDespacho = $_POST['TxtDespacho'];


$fotoportada=$_POST['fotoportada'];
$Txtportada=basename( $_FILES['fotoportada']['name']);

 // Guardar Imagen
$target = "Images/Remisiones/";
$target = $target.$Aleaotorio."-". basename( $_FILES['fotoportada']['name']);
		if(move_uploaded_file($_FILES['fotoportada']['tmp_name'], $target))
{
	$uploadRes=true;// Si la imagen se guarda se ejecuta el guardar la referencia

		// Guardar la Referencia
$sql=("UPDATE t_detalle_despachos SET Num_Guia='".$TxtGuia."',Url_Despacho='".$target."' WHERE Despacho_Cod_Despacho='".$TxtDespacho."'");
//Echo($sql);
	$result=$conexion->query($sql);
    include("Lib/seguridad.php");
    $Datos="Se subio una guia de despacho, Nro de Guia: ".$TxtGuia." Codigo de Despacho: ".$TxtDespacho;
    $Paginas= $_SERVER['PHP_SELF'];
    $seguridad = AgregarLog($IdUser,$Datos,$Paginas);
        
header("location:Despachos.php?Mensaje=22&OrdenDespacho=".$TxtGuia.""); 
}


 ?>