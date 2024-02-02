<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

$TxtTitulo=$_POST['TxtEdTitulo'];

$TxtHoras=$_POST['TxtEdHoras'];

$TxtTiempoDia=$_POST['TxtEdTiempoDia'];

$TxtTiempoHora=$_POST['TxtEdTiempoHora'];

$TxtTiempoMinuto=$_POST['TxtEdTiempoMinuto'];

$TxtDetalle=$_POST['TxtEdDetalle'];

$TxtDificultad = $_POST['TxtEdDificultad'];

$IdActividad=$_POST['IdActividad'];

$TiempoTotal=ConversorTiempo($TxtHoras,$TxtTiempoDia,$TxtTiempoHora,$TxtTiempoMinuto);
date_default_timezone_set("America/Bogota");
$MarcaTemporal = date('Y-m-d H:i:s');


if ($IdActividad!="") {
	
// Actualización de la Actividad

$sql ="UPDATE T_Tareas SET Titulo='".utf8_decode($TxtTitulo)."', Detalle_Tarea='".utf8_decode($TxtDetalle)."', Tiempo_Destinado='".utf8_decode($TiempoTotal)."' , DIficultad_id_dificultad='".utf8_decode($TxtDificultad)."' WHERE Cod_Tarea='".$IdActividad."'";  
//echo($sql);
$result = $conexion->query($sql);

// Nota y notificación de E-mail

//Ingresar Nueva Notas

$Nota1="Actividad".$TxtTitulo."ha sido editada";

$sql = "INSERT INTO T_Timeline_Tareas (Tareas_Cod_Tarea, Usuario_id_usuario, Fecha_Timeline, Datos_Timeline) VALUES ('".utf8_decode($IdActividad)."','".utf8_decode($IdUser)."','".utf8_decode($MarcaTemporal)."','".utf8_decode($Nota1)."');";
//echo($sql);
$result = $conexion->query($sql);

include("Lib/funciones.php");  
//$copiacorreo="mediosdigitales@ofigas.com";
//Email_Personalizado($CorreoUser,$copiacorreo,4,$TxtTitulo,$TxtDetalle,$MarcaTemporal);

header("location:Task.php?Mensaje=4");


}

?>