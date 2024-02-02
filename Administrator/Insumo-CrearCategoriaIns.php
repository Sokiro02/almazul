<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

// Variables de  Config.php 

$txtNombreRubro = $_POST['txtNombreRubro'];
//$txtCodRubro=$_POST['txtCodRubro'];

$EstadoTekMaster=1;

//Actualización de Datos App
$sql ="SELECT MAX(Cod_Categoria_Insumo)+100 as NuevoCodigo FROM t_categorias_insumos";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $NuevoCodigo=$row['NuevoCodigo'];
       }
   }

$sql=("INSERT INTO t_categorias_insumos(Nom_CategoriaIns,Cod_Categoria_Insumo,Consecutivo_Categoria, CategoriaIns_Publicada) VALUES ('".utf8_decode($txtNombreRubro)."','".utf8_decode($NuevoCodigo)."','".utf8_decode($NuevoCodigo)."','".utf8_decode($EstadoTekMaster)."')");
//echo($sql);
$result = $conexion->query($sql);

header("location:insumos.php?Mensaje=11&TAB=tabs-3");

 ?>