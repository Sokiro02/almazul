<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');
$Aleaotorio=rand(0,99999);

$fotoportada=$_POST['fotoportada'];
$Txtportada=basename( $_FILES['fotoportada']['name']);
$TxtCategoria=$_POST['TxtCategoria'];
$TxtSubCategoria=$_POST['TxtSubCategoria'];
$TxtInsumo1=$_POST['TxtInsumo1']; // De archivo reflistainsumos.php
$TxtInsumo2=$_POST['TxtInsumo2']; // De archivo reflistainsumos.php
$TxtTotalCosto=$_POST['TxtTotalCosto']; // De archivo refcost.php
$TxtManodeObra=$_POST['TxtManodeObra']; 
$TxtColor1=$_POST['TxtColor1'];
$TxtColor2=$_POST['TxtColor2'];
$TxtColor3=$_POST['TxtColor3'];
$PVP=$_POST['demo2']; // 
$PMayor=$_POST['demo3'];
$TxtDetalle=$_POST['TxtDetalle'];
$Consecutivo_Prod=$_POST['Consecutivo_Prod'];

$Valor1=$_POST['demo2'];
$PrecioVenta=FormatoMascara($Valor1);

$Valor2=$_POST['demo3'];
$PrecioMayor=FormatoMascara($Valor2);

// Generación del Codigo 1. Parte de 3 Dígitos la Categoria

$sql ="SELECT Cod_Cat_Producto FROM t_categoria_producto WHERE Id_Cat_Producto='".$TxtCategoria."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Ref1=$row['Cod_Cat_Producto'];            
 }
}
// Generación del Codigo 2. Parte de 2 Dígitos la SubCategoria

$sql ="SELECT Cod_SubCat_Producto FROM t_subcategoria_producto WHERE Id_SubCat_Producto='".$TxtSubCategoria."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Ref2=$row['Cod_SubCat_Producto'];            
 }
}
// Generación del Codigo 3ra Parte de 2 Dígitos la SubCategoria
$sql ="SELECT Cod_Insumo FROM t_insumos WHERE Id_Insumo='".$TxtInsumo1."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Ref3=$row['Cod_Insumo'];            
 }
}

$sql ="SELECT Cod_Insumo FROM t_insumos WHERE Id_Insumo='".$TxtInsumo2."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Ref4=$row['Cod_Insumo'];            
 }
}

$NuevaReferencia=$Ref1.$Ref2.$Ref3.$Consecutivo_Prod;
$EstadoReferencia="Nueva";
$EstadoTek=1;

 // Guardar Imagen
$target = "Images/Galeria-Produccion/";
$target = $target.$Aleaotorio."-". basename( $_FILES['fotoportada']['name']);
		if(move_uploaded_file($_FILES['fotoportada']['tmp_name'], $target))
{
	$uploadRes=true;// Si la imagen se guarda se ejecuta el guardar la referencia

		// Guardar la Referencia
$sql=("INSERT INTO t_referencias(Cod_Referencia, Img_Referencia, Fecha_Creacion, Categoria_Id_Categoria_Prod, SubCategoria_Id_Subcategoria_Prod, Insumo_Ppal, Insumo_Sec, Estado_Ref, Costo_Proyectado_Pref, V_Mano_Obra_Ref, PVP_Ref, P_Mayor, Ref_Publicada) VALUES ('".$NuevaReferencia."','".$target."','".$TiempoActual."','".$TxtCategoria."','".$TxtSubCategoria."','".$Ref3."','".$Ref4."','".$EstadoReferencia."','".$TxtTotalCosto."','".$TxtManodeObra."','".$PrecioVenta."','".$PrecioMayor."','".$EstadoTek."')");
	
	$result=$conexion->query($sql);

	// Actualizar el Consecutivo 
	$sql=("UPDATE t_config SET Consecutivo_Prod='".$Consecutivo_Prod."' WHERE Desarrollador='TEKSYSTEM S.A.S'");
	$result=$conexion->query($sql);
	// Guardar Colores Disponibles

	$sql=("INSERT INTO t_colores_ref(Color_Id_Color, Referencia_Cod_Referencia, Color_Ref_Publicado) VALUES ('".$TxtColor1."','".$NuevaReferencia."','".$EstadoTek."')");
	$result=$conexion->query($sql);
	$sql=("INSERT INTO t_colores_ref(Color_Id_Color, Referencia_Cod_Referencia, Color_Ref_Publicado) VALUES ('".$TxtColor2."','".$NuevaReferencia."','".$EstadoTek."')");
	$result=$conexion->query($sql);
	$sql=("INSERT INTO t_colores_ref(Color_Id_Color, Referencia_Cod_Referencia, Color_Ref_Publicado) VALUES ('".$TxtColor3."','".$NuevaReferencia."','".$EstadoTek."')");
	$result=$conexion->query($sql);
}

//Guardar Insumos Ref 
foreach($_POST['TxtCod'] as $index => $nf) {
    $Codigo=$nf;
    $Cantidad=($_POST['TxtCant'][$index]);
  
    //Echo($Cantidad." ".$Codigo."<br>");
    // Consulta del insumo
    $sql ="SELECT Costo_Insumo FROM t_insumos WHERE Cod_Insumo='".$Codigo."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Costo_Insumo=$row['Costo_Insumo'];            
 }
}
// Guardar Insumos
	$sql=("INSERT INTO t_insumos_ref(Cod_Insumo, Costo_Insumo_Ref, Cant_Solicitada, Referencia_Cod_Referencia) VALUES('".$Codigo."','".$Costo_Insumo."','".$Cantidad."','".$NuevaReferencia."')");
	//Echo($sql);
	$result=$conexion->query($sql);
}

// Eliminar Diseño en Tabla Temporal 
	$sql ="DELETE FROM t_temporal_ref WHERE Orden_Temporal='".$IdUser."'";  
	$result = $conexion->query($sql);

header("location:Lista-Referencias.php");
 ?>
