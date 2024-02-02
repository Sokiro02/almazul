<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
include("Lib/seguridad.php");
$IdUser=$_SESSION['IdUser'];
$Aleaotorio=rand(0,9999);

// Variables de modal  Lista-Insumos.php
$TxtCodigo = $_POST['TxtCodigo'];
$TxtIdInsumo=$_POST['TxtIdInsumo'];
$FotoOriginal=$_POST['FotoOriginal'];
//$TxtNomInsumo = strtoupper($_POST['TxtNomInsumo']);
$TxtUnidad = $_POST['TxtUnidad'];
$TxtDetalle = strtoupper($_POST['TxtDetalle']);
$TxtProveedor1 = $_POST['TxtProveedor1'];
$TxtTipoInsumo = $_POST['TxtTipoInsumo'];
$TxtProveedor2 = $_POST['TxtProveedor2'];
$TxtProveedor3 = $_POST['TxtProveedor3'];
$TxtCodProv1 = $_POST['TxtCodProv1'];
$TxtCodProv2 = $_POST['TxtCodProv2'];
$TxtCodProv3 = $_POST['TxtCodProv3'];
$TxtCategoria =$_POST['TxtCategoria'];
$TxtSubCategoria =$_POST['TxtSubCategoria'];
$TxtColor =$_POST['TxtColor'];
$TxtConsecutivo =$_POST['TxtConsecutivo'];
$Txtportada=$_FILES['fotoportada']['name'];
$TxtTemporal=$_FILES['fotoportada']['tmp_name'];

$InventarioValle=$_POST['InventarioValle'];
$InventarioBarranquilla=$_POST['InventarioBarranquilla'];
$Qr_Cod_Insumo=$_POST['Qr_Cod_Insumo'];



if ($InventarioValle!=0) {

$IdValledupar=5;
date_default_timezone_set("America/Bogota");
$DiaActual = date('Y-m-d H:i:s');

// Movimiento en inventario de Insumos 
$TipoMovimiento="Ingreso Inicial.";

$sql=("INSERT INTO t_mov_insumos(Insumo_Cod_Insumo, Bodega_Id_Bodega_Recibe, Cant_Mov, Tipo_Mov_Insumo,  Usuario_Id_Usuario, Fecha_Solicitud, Fecha_Realizado) VALUES('".$Qr_Cod_Insumo."','".$IdValledupar."','".$InventarioValle."','".$TipoMovimiento."','".$IdUser."','".$DiaActual."','".$DiaActual."');");
//Echo($sql);
$result = $conexion->query($sql);

}


if ($InventarioBarranquilla!=0) {

$IdBarranquilla=6;
date_default_timezone_set("America/Bogota");
$DiaActual = date('Y-m-d H:i:s');

// Movimiento en inventario de Insumos 
$TipoMovimiento="Ingreso Inicial.";

$sql=("INSERT INTO t_mov_insumos(Insumo_Cod_Insumo, Bodega_Id_Bodega_Recibe, Cant_Mov, Tipo_Mov_Insumo,  Usuario_Id_Usuario, Fecha_Solicitud, Fecha_Realizado) VALUES('".$Qr_Cod_Insumo."','".$IdBarranquilla."','".$InventarioValle."','".$TipoMovimiento."','".$IdUser."','".$DiaActual."','".$DiaActual."');");
//Echo($sql);
$result = $conexion->query($sql);

}


$sql ="SELECT Nom_CategoriaIns FROM t_categorias_insumos WHERE Id_Categoria_Insumo='".$TxtCategoria."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $NomCategoriaPpal=$row['Nom_CategoriaIns'];
       }
   } 
$sql ="SELECT Nom_SubCategoriaIns FROM t_subcategorias_insumos WHERE Id_SubCategoria_Insumo='".$TxtSubCategoria."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $NomSubCategoriaPpal=$row['Nom_SubCategoriaIns'];
       }
   } 
$TxtNomInsumo=utf8_decode($NomCategoriaPpal)." ".utf8_decode($NomSubCategoriaPpal);
$FotoDefault="images/Insumos/no-image.jpg";
$EstadoTekMaster=1;

$Valor1=$_POST['demo1'];
$For_Costo1=FormatoMascara($Valor1);


//**************************************************************************************************************
//Ingresar Proveedor 1
//**************************************************************************************************************

	if ($Txtportada=="") { //Primera  Condición

//**************************************************************************************************************
//Ingresar Proveedor 1 Sin Imagen
//**************************************************************************************************************

	if ($TxtProveedor1!="" & $Valor1!="") {
$sql=("UPDATE t_insumos SET SubCategoria_Id_SubCategoria_Insumo='".$TxtSubCategoria."',Cod_Proveedor='".$TxtCodProv1."',Nom_Insumo='".$TxtNomInsumo."',Unidad_Insumo='".$TxtUnidad."',Tipo_Insumo='".$TxtTipoInsumo."',Url_Insumo='".$FotoOriginal."',Color_Ppal='".$TxtColor."',Proveedor_Id_Proveedor='".$TxtProveedor1."',Costo_Insumo='".$For_Costo1."' WHERE Id_Insumo='".$TxtIdInsumo."'");
		//echo($sql);
		$result = $conexion->query($sql);
	}

		header("location:Lista-Insumos.php?Mensaje=111");

	}
	else
	{

$target = "Images/Insumos/";
$target = $target.$Aleaotorio."-". basename( $_FILES['fotoportada']['name']);
if ($_FILES['fotoportada']['type']=='image/jpeg') {
	$img_origen=imagecreatefromjpeg($TxtTemporal);
}
elseif ($_FILES['fotoportada']['type']=='image/png') {
	$img_origen=imagecreatefrompng($TxtTemporal);
}
elseif ($_FILES['fotoportada']['type']=='image/gif') {
	$img_origen=imagecreatefromgif($TxtTemporal);
}

$ancho_origen=imagesx($img_origen);
$alto_origen=imagesy($img_origen);
$ancho_limite=800;

if ($ancho_origen>$alto_origen) {
	$ancho_origen=$ancho_limite;
	$alto_origen=$ancho_limite*imagesy($img_origen)/imagesx($img_origen);
}
else{
	$alto_origen=$ancho_limite;
	$ancho_origen=$ancho_limite*imagesx($img_origen)/imagesy($img_origen);
}
$img_destino=imagecreatetruecolor($ancho_origen, $alto_origen);
imagecopyresized($img_destino, $img_origen, 0, 0, 0, 0, $ancho_origen, $alto_origen, imagesx($img_origen), imagesy($img_origen));

imagejpeg($img_destino,$target,100);


//**************************************************************************************************************
//Ingresar Proveedor 1 Con Imagen
//**************************************************************************************************************
if ($TxtProveedor1!="" & $Valor1!="") {
$sql=("UPDATE t_insumos SET SubCategoria_Id_SubCategoria_Insumo='".$TxtSubCategoria."',Cod_Proveedor='".$TxtCodProv1."',Nom_Insumo='".$TxtNomInsumo."',Unidad_Insumo='".$TxtUnidad."',Tipo_Insumo='".$TxtTipoInsumo."',Url_Insumo='".$target."',Color_Ppal='".$TxtColor."',Proveedor_Id_Proveedor='".$TxtProveedor1."',Costo_Insumo='".$For_Costo1."' WHERE Id_Insumo='".$TxtIdInsumo."'");

$Datos="Se modifico el insumo con el codigo: ".$TxtIdInsumo;
$Paginas= $_SERVER['PHP_SELF'];
$seguridad = AgregarLog($IdUser,$Datos,$Paginas);
//echo($sql);
$result = $conexion->query($sql);
}

		header("location:Lista-Lista-Insumos.php?Mensaje=111");
		
	}



 ?>