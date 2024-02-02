<?php
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');
$id = $_POST['Eliminar'];

$sql = "UPDATE t_traslados_detalle SET aprobado='SI' WHERE id='".$id."'";
//$sql = "DELETE FROM t_traslados_detalle WHERE id='".$id."'";
$result = $conexion->query($sql) or die('Error:'.$sql." ".mysqli_error($conexion));
if ($result){
    include("Lib/seguridad.php");
    $Datos="Se aprobo el traslado con registro numero: ".$id." De la tabla t_traslados_detalle";
    $Paginas= $_SERVER['PHP_SELF'];
    $seguridad = AgregarLog($IdUser,$Datos,$Paginas);        
    echo "true";
}else{
    echo "Error al ejecutar: ".$sql." ".mysqli_error($conexion);
}

    

?>