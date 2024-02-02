<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");

$IdUser=$_SESSION['IdUser'];


//Echo($Publicado);
include("Lib/seguridad.php");
$Paginas= $_SERVER['PHP_SELF'];


//Arreglo de cadena ID_COMENTARIO
$sql ="SELECT Id_subrubro FROM t_subrubros";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$ListaRubros=$ListaRubros.$row['Id_subrubro'].",";                  
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
      		$sql = "UPDATE t_subrubros SET Nom_Subrubro='".utf8_decode($SplitNombre[0])."' WHERE Id_subrubro='".$CadenaLista[$i]."'";
	        $result = $conexion->query($sql);
            if ($result){
                $Datos="Se actualizo el Sub Rubros: ".$SplitNombre[0];
                $seguridad = AgregarLog($IdUser,$Datos,$Paginas);
            }
            
      	}
      	if ($SplitEstado[0]!="") {
      
	$sql = "UPDATE t_subrubros SET Subrubro_publicado='1' WHERE Id_subrubro='".$CadenaLista[$i]."'";
      	//echo $sql;
		$result = $conexion->query($sql);
	
      	}
      	
      	
      	
      }
      header("location:config.php?Mensaje=1&TAB=tabs-3");
?>