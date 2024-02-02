<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');
$Aleaotorio=rand(0,99999);
$Id_Referencia=$_SESSION['Id_Referencia'];

  $query = mysqli_query($conexion, "SELECT * FROM t_referencias WHERE Id_Referencia='$Id_Referencia'")
                                  or die('error '.mysqli_error($mysqli));
  $data = mysqli_fetch_assoc($query);
    $imagen_traida = $_FILES['fotoportada']['name'];
  $imagen_traida = basename('$imagen_traida ');

if (isset($_POST['modificar'])){  //si se envio modificar

  $query = mysqli_query($conexion, "SELECT * FROM t_referencias WHERE Id_Referencia='$Id_Referencia'")
                                  or die('error '.mysqli_error($mysqli));
  $data = mysqli_fetch_assoc($query);

//VER LAS VARIABLES RECIBIDAS, no borrar, activar en caso dado que no guarde

var_dump ($_POST);
if($_POST)
	{
	echo "Variables recibidas <b>";
	foreach ($_POST as $clave=>$valor)
   		{
   		echo "El valor de $clave es: $valor <br>";
   		}
     exit;
	}
$fotoportada=$_POST['fotoportada'];
//$Txtportada=basename( $_FILES['fotoportada']['name']);
$Txtportada=$_FILES['fotoportada']['name'];
$TxtTemporal=$_FILES['fotoportada']['tmp_name'];
$TxtCategoria=$_POST['TxtCategoria'];
$TxtSubCategoria=$_POST['TxtSubCategoria'];
$TxtInsumo1=$_POST['TxtInsumo1']; // De archivo reflistainsumos.php
$TxtInsumo2=$_POST['TxtInsumo2']; // De archivo reflistainsumos.php
$TxtTotalCosto=$_POST['TxtTotalCosto']; // De archivo refcost.php
$TxtManodeObra=$_POST['TxtManodeObra']; 
$TxtColor1=$_POST['TxtColor1'];
$TxtColor2=$_POST['TxtColor2'];
$TxtColor3=$_POST['TxtColor3'];
$TxtColeccion=$_POST['TxtColeccion'];
$PVP=$_POST['demo2']; // 
$PMayor=$_POST['demo3'];
$TxtDetalle=$_POST['TxtDetalle'];
$Consecutivo_Prod=$_POST['Consecutivo_Prod'];
$TipoReferencia=$_POST['TipoReferencia'];
$TxtNomAnterior=$_POST['TxtNomAnterior'];
$TxtDetalleAnterior=$_POST['TxtDetalleAnterior'];
$TipoReferencia="1";
$Valor1=$_POST['demo2'];
$PrecioVenta=FormatoMascara($Valor1);

$Valor2=$_POST['demo3'];
$PrecioMayor=FormatoMascara($Valor2);
$PMayor1 =$_POST['demo3'];



//OBTENER EL CODIGO DEL INSUMO PRINCIPAL
  $query = mysqli_query($conexion, "SELECT Cod_Insumo,Nom_Insumo FROM t_insumos WHERE Id_Insumo='$TxtInsumo1'")
                                  or die('error '.mysqli_error($mysqli));
  $data = mysqli_fetch_assoc($query);
  $Insumo1 = $data['Cod_Insumo'];
  
//OBTENER EL CODIGO DEL INSUMO SECUNDARIO
  $query = mysqli_query($conexion, "SELECT Cod_Insumo,Nom_Insumo FROM t_insumos WHERE Id_Insumo='$TxtInsumo2'")
                                  or die('error '.mysqli_error($mysqli));
  $data = mysqli_fetch_assoc($query);
  $Insumo2 = $data['Cod_Insumo'];


$max=1500000; //(1.5Mb)
$filesize = $_FILES['fotoportada']['size'];
if($filesize > $max){
    header("location:Producto-Crear.php?Mensaje=5"); // Categoria de Producto
}
 // Guardar Imagen
$target = "Images/Galeria-Produccion/";
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


    if(move_uploaded_file($_FILES['fotoportada']['tmp_name'], $target))
{
  $uploadRes=true;// Si la imagen se guarda se ejecuta el guardar la referencia


// Generación del Codigo 1. Parte de 3 Dígitos la Categoria

$sql ="SELECT Cod_Cat_Producto,Nom_Cat_Producto FROM t_categoria_producto WHERE Id_Cat_Producto='".$TxtCategoria."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Ref1=$row['Nom_Cat_Producto'];            
 }
}
// Generación del Codigo 2. Parte de 2 Dígitos la SubCategoria

$sql ="SELECT Cod_SubCat_Producto FROM t_subcategoria_producto WHERE Id_SubCat_Producto='".$TxtSubCategoria."'";  
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Ref2=$row['Cod_SubCat_Producto'];         
 }
}

// Generación del Codigo 3ra Parte de 2 Dígitos la SubCategoria
$sql ="SELECT Cod_Insumo,Nom_Insumo FROM t_insumos WHERE Id_Insumo='".$TxtInsumo1."'";  
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Ref3=$row['Cod_Insumo']; 
      $TipoTelaIns=$row['Nom_Insumo'];
      //Echo(" Ref3".$Ref3);           
 }
}

$sql ="SELECT Cod_Insumo FROM t_insumos WHERE Id_Insumo='".$TxtInsumo2."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Ref4=$row['Cod_Insumo'];            
 }
}


$sql ="SELECT Nom_Coleccion FROM t_colecciones WHERE Id_Coleccion='".$TxtColeccion."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Nom_Coleccion=$row['Nom_Coleccion'];            
 }
}



$NuevaReferencia=$Ref1.$Ref2.$Consecutivo_Prod.$Ref3;
$EstadoReferencia="Nueva";
$EstadoTek=1;

if ($Ref1="") { 
  header("location:Lista-Referencias.php?Mensaje=551"); // Categoria de Producto
}
elseif ($Ref2="") {
  header("location:Lista-Referencias.php?Mensaje=552"); // SubCategoria de Producto
}
elseif ($Ref3="") {
  header("location:Lista-Referencias.php?Mensaje=553"); // Cod de Insumo
}
elseif ($Ref4="") {
  header("location:Lista-Referencias.php?Mensaje=554"); // Cod de Insumo
}

    // Guardar la Referencia
$sql=("INSERT INTO t_referencias(Cod_Referencia, Img_Referencia, Fecha_Creacion,Coleccion_Id_Coleccion,
Coleccion_Nom_Coleccion, Categoria_Id_Categoria_Prod, SubCategoria_Id_Subcategoria_Prod, Insumo_Ppal,
Tipo_Tela,Color_Insumo_Ppal, Insumo_Sec, Estado_Ref, Costo_Proyectado_Pref, V_Mano_Obra_Ref, PVP_Ref, 
P_Mayor,Detalle_Referencia, Ref_Publicada,Tipo_Referencia,Ref_Antigua,Detalle_Antiguo,Creado_Por) VALUES 
('".$NuevaReferencia."','".$target."','".$TiempoActual."','".$TxtColeccion."','".$Nom_Coleccion."','".$TxtCategoria."',
'".$TxtSubCategoria."','".$Insumo1."','".$TipoTelaIns."','".$ColorIns."','".$Insumo2."','".$EstadoReferencia."',
'".$TxtTotalCosto."','".$TxtManodeObra."','".$PrecioVenta."','".$PrecioMayor."','".$TxtDetalle."','".$EstadoTek."',
'".$TipoReferencia."','".$TxtNomAnterior."','".$TxtDetalleAnterior."','$IdUser')");
  //Echo($sql);
  $result=$conexion->query($sql);
  // Actualizar el Consecutivo 
  $sql=("UPDATE t_config SET Consecutivo_Prod='".$Consecutivo_Prod."' WHERE Desarrollador='TEKSYSTEM S.A.S'");
  $result=$conexion->query($sql);
  // Guardar Colores Disponibles

//Guardar Insumos Ref 

$sql ="SELECT Id_Temporal FROM t_temporal_ref2 WHERE Orden_Temporal='".$IdUser."'"; 
Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $ListaInsumos=$ListaInsumos.$row['Id_Temporal'].","; 
    }
  }
$CadenaInsumos=explode(",", $ListaInsumos);
//Split al Arreglo
$longitud = count($CadenaInsumos);
$min=$longitud-1;
for($i=0; $i<$min; $i++)

{
  // Consulta del código 

   $sql ="SELECT Cod_Temporal FROM t_temporal_ref WHERE Id_Temporal='".$CadenaInsumos[$i]."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Tb_Cod_Temporal=$row['Cod_Temporal'];            
 }
}

 $sql ="SELECT Cant_Temporal FROM t_temporal_ref WHERE Id_Temporal='".$CadenaInsumos[$i]."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
       $Tb_Cant_Temporal=$row['Cant_Temporal'];           
 }
}


 $sql ="SELECT Costo_Insumo FROM t_insumos WHERE Cod_Insumo='".$Tb_Cod_Temporal."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Costo_Insumo=$row['Costo_Insumo'];            
 }
}

// Guardar Insumos
  $sql=("INSERT INTO t_insumos_ref(Cod_Insumo, Costo_Insumo_Ref, Cant_Solicitada, Referencia_Cod_Referencia) VALUES('".$Tb_Cod_Temporal."','".$Costo_Insumo."','".$Tb_Cant_Temporal."','".$NuevaReferencia."')");
  //Echo($sql);
  $result=$conexion->query($sql);



}
// Eliminar Diseño en Tabla Temporal 
  $sql ="DELETE FROM t_temporal_ref WHERE Orden_Temporal='".$IdUser."'";
  //Echo($sql);  
  $result = $conexion->query($sql);

header("location:Lista-Referencias.php?Mensaje=1");
  

}
else
{
  header("location:Lista-Referencias.php?Mensaje=111");
}

}  
 ?>

