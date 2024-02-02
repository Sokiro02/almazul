<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");

$IdUser=$_SESSION['IdUser'];


//Echo($Publicado);

//Arreglo de cadena ID_COMENTARIO
$sql ="SELECT Id_SubCategoria_Insumo FROM t_subcategorias_insumos";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$ListaRubros=$ListaRubros.$row['Id_SubCategoria_Insumo'].",";                  
 }
}
$CadenaLista=explode(",", $ListaRubros);
//Split al Arreglo
$longitud = count($CadenaLista);
$min=$longitud-1;
//Recorro todos los elementos
for($i=0; $i<$min; $i++)
      {
      	$NomUpdate=$_POST['NomUpdate-'.$CadenaLista[$i]];
      	$SplitNombre=explode("-", $NomUpdate);

      	$EstadoUpdate=$_POST['EstadoUpdate-'.$CadenaLista[$i]];
      	$SplitEstado=explode("-", $EstadoUpdate);

      	if ($SplitNombre[0]!="") {
      		$sql = "UPDATE t_subcategorias_insumos SET Nom_SubCategoriaIns='".utf8_decode($SplitNombre[0])."' WHERE Id_SubCategoria_Insumo='".$CadenaLista[$i]."'";
      	//echo $sql;
	$result = $conexion->query($sql);
      	}	
      }
      header("location:insumos.php?Mensaje=14&TAB=tabs-3");
?>