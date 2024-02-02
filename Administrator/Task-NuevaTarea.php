<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

$TxtTitulo=$_POST['TxtTitulo'];

$TxtUser=$_POST['TxtUser'];

$TxtHoras=$_POST['TxtHoras'];

$TxtTiempoDia=$_POST['TxtTiempoDia'];

$TxtTiempoHora=$_POST['TxtTiempoHora'];

$TxtTiempoMinuto=$_POST['TxtTiempoMinuto'];

$TxtDetalle=$_POST['TxtDetalle'];

$TxtUsuario = $_POST['TxtUsuario'];

$TxtDificultad = $_POST['TxtDificultad'];


date_default_timezone_set("America/Bogota");
$MarcaTemporal = date('Y-m-d H:i:s');

$FechaArranque=$_POST['FechaArranque'];

$Asignada=1;

$TiempoTotal=ConversorTiempo($TxtHoras,$TxtTiempoDia,$TxtTiempoHora,$TxtTiempoMinuto);


$sql ="SELECT Consecutivo FROM t_config WHERE Desarrollador='TEKSYSTEM S.A.S'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Consecutivo=$row['Consecutivo'];
 }
}

$Cod_Tarea=$Consecutivo+1;

foreach ($TxtUsuario as $a){
    //echo $a.";";
    //Ingresar Nueva Tarea
	$sql = "INSERT INTO T_Tareas (Cod_Tarea,Titulo, Detalle_Tarea, Tiempo_Destinado, Fecha_Asignada,  Horas_Dia_App, Usuario_Jefe, Usuario_Id_Usuario, Dificultad_Id_Dificultad, Estado_Id_Estado_Tarea) VALUES ('".utf8_decode($Cod_Tarea)."','".utf8_decode($TxtTitulo)."','".utf8_decode($TxtDetalle)."','".utf8_decode($TiempoTotal)."','".utf8_decode($FechaArranque)."','".(int) utf8_decode($TxtHoras)."','".utf8_decode($IdUser)."','".utf8_decode($a)."','".utf8_decode($TxtDificultad)."','".utf8_decode($Asignada)."');";
//echo($sql);
$result = $conexion->query($sql);

// Ingreso la notificación 

$EstadoNotifica=1;
$NotiPublicada=1;
$NotaNuevaAct="Nueva Actividad Asignada";
$sql = "INSERT INTO t_notificaciones (Not_Cod_Tarea, Usuario_Envia, Usuario_Recibe, Datos_Notifica, Fecha_Notifica, Estado_Notifica, Publicado) VALUES ('".utf8_decode($Cod_Tarea)."','".utf8_decode($IdUser)."','".utf8_decode($a)."','".utf8_decode($NotaNuevaAct)."','".utf8_decode($MarcaTemporal)."','".utf8_decode($EstadoNotifica)."','".utf8_decode($NotiPublicada)."')";
//echo($sql);
$result = $conexion->query($sql);


$sql ="SELECT Correo FROM t_contacto_usuario WHERE Usuario_Id_Usuario='".$a."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $CorreoUser=$CorreoUser.$row['Correo'].",";
 }
}

}

///// Verificar Id
$sql ="SELECT Id_Tarea FROM T_Tareas WHERE Titulo='".$TxtTitulo."' and Detalle_Tarea='".$TxtDetalle."' and Dificultad_Id_Dificultad='".$TxtDificultad."'";  
//echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Qr_IdTarea=$row['Id_Tarea'];
        //echo($Qr_IdTarea);
 }
}
//// Fin Verificar Id

//Ingresar Nueva Notas

$Nota1="Nueva Actividad Asignada";

	$sql = "INSERT INTO T_Timeline_Tareas (Tarea_id_tarea,Tareas_Cod_Tarea, Usuario_id_usuario, Fecha_Timeline, Datos_Timeline) VALUES ('".utf8_decode($Qr_IdTarea)."','".utf8_decode($Cod_Tarea)."','".utf8_decode($IdUser)."','".utf8_decode($MarcaTemporal)."','".utf8_decode($Nota1)."');";
//echo($sql);
$result = $conexion->query($sql);




//Actualizo el consecutivo

$sql ="UPDATE t_config SET Consecutivo='".utf8_decode($Cod_Tarea)."' WHERE Desarrollador='TEKSYSTEM S.A.S'"; 
			//echo($sql);
$result = $conexion->query($sql);


include("Lib/funciones.php");  
//$copiacorreo="josedanielmeza@hotmail.com";
Email_Personalizado($CorreoUser,$copiacorreo,3,$TxtTitulo,$TxtDetalle,$MarcaTemporal,0);

$Valida=header("location:Task.php?Mensaje=1&TipoNot=1");

?>