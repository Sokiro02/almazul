<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

date_default_timezone_set("America/Bogota");
$MarcaTemporal = date('Y-m-d H:i:s');

$ValNote=$_GET['ValNote'];
$Propietario=$_GET['Propietario'];


		$EditMiNota=$_POST['EditMiNota'];
		$IdTimeline=$_POST['IdTimeline'];
		$IdTareaSel=$_POST['IdTareaSel'];

$sql ="UPDATE t_comentarios_produccion SET Comentario_Prod='".utf8_decode($EditMiNota)."', Fecha_Comentario='".$MarcaTemporal."' WHERE Id_Comentario_Produccion='".$IdTimeline."'";  
			echo($sql);
			//Echo("<br>");
			$result = $conexion->query($sql);
			$Valida=header("location:Panel-Produccion.php?Solicitud=".$IdTareaSel."&Mensaje=2&Propietario=".$Propietario."");
			
//echo($IdTareaSel);
 ?>