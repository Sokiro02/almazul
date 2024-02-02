<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");

$IdUser=$_SESSION['IdUser'];
include("Lib/seguridad.php");
    

//Echo($Publicado);

//Arreglo de cadena ID_COMENTARIO
$sql ="SELECT Id_Atributo_Categoria FROM t_atributos_categoria_ins";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$ListaRubros=$ListaRubros.$row['Id_Atributo_Categoria'].",";                  
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
      		$sql = "UPDATE t_atributos_categoria_ins SET Nom_Atributo_Categoria='".utf8_decode($SplitNombre[0])."' WHERE Id_Atributo_Categoria='".$CadenaLista[$i]."'";
            $Datos="Actualización del Atributo Categoria: ".$SplitNombre[0];
            $Paginas= $_SERVER['PHP_SELF'];
            $seguridad = AgregarLog($IdUser,$Datos,$Paginas);            
      	//echo $sql;
	$result = $conexion->query($sql);
      	}	
      }
      header("location:insumos.php?Mensaje=16&TAB=tabs-4");
?>