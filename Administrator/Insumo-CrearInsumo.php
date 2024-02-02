<?php 
include("Lib/sesion.php");
error_reporting(E_ALL);
ini_set('display_errors', '1');
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$Aleaotorio=rand(0,9999);

// Variables de modal  insumos.php
$TxtCodigo = $_POST['TxtCodigo'];
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
$dos ='';
if (isset($_POST['TxtAtributo'])){
    $TxtAtributo=$_POST['TxtAtributo'];
    foreach ($TxtAtributo as $datos=>$uno) {
    	//$V1=($V1.",".$datos);
    	$dos=$dos.$uno.",";
    }    
}

include("Lib/seguridad.php");
//$Pagina='<a href="despachos_detalle.php?Despacho=';
//$Pagina=$Pagina.$id_despacho.'">'.'VER DESPACHO </a>';
$Datos="Guardo un nuevo insumo con el codigo: ".$TxtCodigo;
$Paginas= $_SERVER['PHP_SELF'];
$seguridad = AgregarLog($IdUser,$Datos,$Paginas);


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

$Valor2=$_POST['demo2'];
$For_Costo2=FormatoMascara($Valor2);

$Valor3=$_POST['demo3'];
$For_Costo3=FormatoMascara($Valor3);

$Concatenar=$TxtCodigo." ".$TxtDetalle." ".$TxtColor." ".$TxtNomInsumo." ".$dos;
//**************************************************************************************************************
//Ingresar Proveedor 1
//**************************************************************************************************************

	if ($Txtportada=="") { //Primera  Condición

//**************************************************************************************************************
//Ingresar Proveedor 1 Sin Imagen
//**************************************************************************************************************

	if ($TxtProveedor1!="" & $Valor1!="") {
		Echo($TxtCategoria);
		$sql=("INSERT INTO t_insumos (Categoria_Id_Categoria_Insumo,SubCategoria_Id_SubCategoria_Insumo,Cod_Insumo,Cod_Proveedor,Nom_Insumo, Unidad_Insumo,Tipo_Insumo, Url_Insumo, Detalle_Insumo,Color_Ppal, Proveedor_Id_Proveedor, Costo_Insumo,Concatenar_Bus) VALUES ('".utf8_decode($TxtCategoria)."','".utf8_decode($TxtSubCategoria)."','".utf8_decode($TxtCodigo)."','".utf8_decode($TxtCodProv1)."','".utf8_decode($TxtNomInsumo)."','".utf8_decode($TxtUnidad)."','".utf8_decode($TxtTipoInsumo)."','".utf8_encode($FotoDefault)."','".utf8_decode($dos)."','".utf8_decode($TxtColor)."','".utf8_decode($TxtProveedor1)."','".utf8_decode($For_Costo1)."','".utf8_decode($Concatenar)."')");
		//echo($sql);
		$result = $conexion->query($sql);
	}

//**************************************************************************************************************
//Ingresar Proveedor 2 Sin Imagen
//**************************************************************************************************************

	if ($TxtProveedor2!="" & $Valor2!="") {
		$sql=("INSERT INTO t_insumos (Categoria_Id_Categoria_Insumo,SubCategoria_Id_SubCategoria_Insumo,Cod_Insumo,Cod_Proveedor,Nom_Insumo, Unidad_Insumo,Tipo_Insumo, Url_Insumo, Detalle_Insumo,Color_Ppal, Proveedor_Id_Proveedor, Costo_Insumo,Concatenar_Bus) VALUES ('".utf8_decode($TxtCategoria)."','".utf8_decode($TxtSubCategoria)."','".utf8_decode($TxtCodigo)."','".utf8_decode($TxtCodProv2)."','".utf8_decode($TxtNomInsumo)."','".utf8_decode($TxtUnidad)."','".utf8_decode($TxtTipoInsumo)."','".utf8_encode($FotoDefault)."','".utf8_decode($dos)."','".utf8_decode($TxtColor)."','".utf8_decode($TxtProveedor2)."','".utf8_decode($For_Costo2)."','".utf8_decode($Concatenar)."')");
		//echo($sql);
		$result = $conexion->query($sql);
	}

//**************************************************************************************************************
//Ingresar Proveedor 3 Sin Imagen
//**************************************************************************************************************

	if ($TxtProveedor3!="" & $Valor3!="") {
		$sql=("INSERT INTO t_insumos (Categoria_Id_Categoria_Insumo,SubCategoria_Id_SubCategoria_Insumo,Cod_Insumo,Cod_Proveedor,Nom_Insumo, Unidad_Insumo,Tipo_Insumo, Url_Insumo, Detalle_Insumo,Color_Ppal, Proveedor_Id_Proveedor, Costo_Insumo,Concatenar_Bus) VALUES ('".utf8_decode($TxtCategoria)."','".utf8_decode($TxtSubCategoria)."','".utf8_decode($TxtCodigo)."','".utf8_decode($TxtCodProv3)."','".utf8_decode($TxtNomInsumo)."','".utf8_decode($TxtUnidad)."','".utf8_decode($TxtTipoInsumo)."','".utf8_encode($FotoDefault)."','".utf8_decode($dos)."','".utf8_decode($TxtColor)."','".utf8_decode($TxtProveedor3)."','".utf8_decode($For_Costo3)."','".utf8_decode($Concatenar)."')");
		//echo($sql);
		$result = $conexion->query($sql);
	}

		header("location:insumos.php?Mensaje=1");

		$sql=("UPDATE t_categorias_insumos SET Consecutivo_Categoria='".$TxtConsecutivo."' WHERE Id_Categoria_Insumo='".$TxtCategoria."'");
//echo($sql);
$result = $conexion->query($sql);

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
$ancho_limite=1024;

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

		//if(move_uploaded_file($TxtTemporal, $target))
//{//Segunda Condición
			//$uploadRes=true;


//**************************************************************************************************************
//Ingresar Proveedor 1 Con Imagen
//**************************************************************************************************************
if ($TxtProveedor1!="" & $Valor1!="") {
$sql=("INSERT INTO t_insumos (Categoria_Id_Categoria_Insumo,SubCategoria_Id_SubCategoria_Insumo,Cod_Insumo,Cod_Proveedor,Nom_Insumo, Unidad_Insumo,Tipo_Insumo, Url_Insumo, Detalle_Insumo,Color_Ppal, Proveedor_Id_Proveedor, Costo_Insumo,Concatenar_Bus) VALUES ('".utf8_decode($TxtCategoria)."','".utf8_decode($TxtSubCategoria)."','".utf8_decode($TxtCodigo)."','".utf8_decode($TxtCodProv1)."','".utf8_decode($TxtNomInsumo)."','".utf8_decode($TxtUnidad)."','".utf8_decode($TxtTipoInsumo)."','".utf8_encode($target)."','".utf8_decode($dos)."','".utf8_decode($TxtColor)."','".utf8_decode($TxtProveedor1)."','".utf8_decode($For_Costo1)."','".utf8_decode($Concatenar)."')");
//echo($sql);
//echo "<br>";	
$result = $conexion->query($sql);
	if ($result==false){
		echo "Error: ".mysql_error(); 
		echo "<br> Se ha producido un error al guardar los datos<br>";
		echo $target;
		
	} 
		
}

//**************************************************************************************************************
//Ingresar Proveedor 2 Con Imagen
//**************************************************************************************************************

if ($TxtProveedor2!="" & $Valor2!="") {
$sql=("INSERT INTO t_insumos (Categoria_Id_Categoria_Insumo,SubCategoria_Id_SubCategoria_Insumo,Cod_Insumo,Cod_Proveedor,Nom_Insumo, Unidad_Insumo,Tipo_Insumo, Url_Insumo, Detalle_Insumo,Color_Ppal, Proveedor_Id_Proveedor, Costo_Insumo,Concatenar_Bus) VALUES ('".utf8_decode($TxtCategoria)."','".utf8_decode($TxtSubCategoria)."','".utf8_decode($TxtCodigo)."','".utf8_decode($TxtCodProv2)."','".utf8_decode($TxtNomInsumo)."','".utf8_decode($TxtUnidad)."','".utf8_decode($TxtTipoInsumo)."','".utf8_encode($target)."','".utf8_decode($dos)."','".utf8_decode($TxtColor)."','".utf8_decode($TxtProveedor2)."','".utf8_decode($For_Costo2)."','".utf8_decode($Concatenar)."')");
//echo($sql);
$result = $conexion->query($sql);
}

//**************************************************************************************************************
//Ingresar Proveedor 3 Con Imagen
//**************************************************************************************************************

if ($TxtProveedor3!="" & $Valor3!="") {
$sql=("INSERT INTO t_insumos (Categoria_Id_Categoria_Insumo,SubCategoria_Id_SubCategoria_Insumo,Cod_Insumo,Cod_Proveedor,Nom_Insumo, Unidad_Insumo,Tipo_Insumo, Url_Insumo, Detalle_Insumo,Color_Ppal, Proveedor_Id_Proveedor, Costo_Insumo,Concatenar_Bus) VALUES ('".utf8_decode($TxtCategoria)."','".utf8_decode($TxtSubCategoria)."','".utf8_decode($TxtCodigo)."','".utf8_decode($TxtCodProv3)."','".utf8_decode($TxtNomInsumo)."','".utf8_decode($TxtUnidad)."','".utf8_decode($TxtTipoInsumo)."','".utf8_encode($target)."','".utf8_decode($dos)."','".utf8_decode($TxtColor)."','".utf8_decode($TxtProveedor3)."','".utf8_decode($For_Costo3)."','".utf8_decode($Concatenar)."')");
//echo($sql);
$result = $conexion->query($sql);
}

$sql=("UPDATE t_categorias_insumos SET Consecutivo_Categoria='".$TxtConsecutivo."' WHERE Id_Categoria_Insumo='".$TxtCategoria."'");
//echo($sql);
$result = $conexion->query($sql);


		header("location:Lista-Insumos.php?Mensaje=1");
		//}
		//else
		//{
			//   $uploadRes=false;
//Echo("Hola mundo");
//   //header("location:NuevoNegocio.php?Mensaje=10");
		//}
	}



 ?>