<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];


$ValNote=$_GET['ValNote'];
$Propietario=$_GET['Propietario'];


		$EditMiNota=$_POST['EditMiNota'];
		$IdTimeline=$_POST['IdTimeline'];
		$IdTareaSel=$_POST['IdTareaSel'];

$sql ="UPDATE T_Timeline_Tareas SET Datos_Timeline='".utf8_decode($EditMiNota)."' WHERE Id_Timeline='".$IdTimeline."'";  
			echo($sql);
			//Echo("<br>");
			$result = $conexion->query($sql);
			$Valida=header("location:Task-Timeline.php?View=".$IdTareaSel."&Mensaje=3&Propietario=".$Propietario."");
			
//echo($IdTareaSel);
 ?>