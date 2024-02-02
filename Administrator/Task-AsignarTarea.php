<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

$TxtUsuario = $_POST['TxtUsuario_Asig'];
$Asig_Actividad=$_POST['Asig_Actividad'];

date_default_timezone_set("America/Bogota");

$MarcaTemporal = date('Y-m-d H:i:s');

$ReAsignada=3;


    //echo $a.";";
    //Ingresar Nueva Tarea

$sql ="UPDATE T_Tareas SET Usuario_Id_Usuario='".utf8_decode($TxtUsuario)."',Fecha_Asignada='".utf8_decode($MarcaTemporal)."', Estado_Id_Estado_Tarea='".utf8_decode($ReAsignada)."' WHERE Id_Tarea='".$Asig_Actividad."'";  

//echo($sql);
$result = $conexion->query($sql);

$sql ="SELECT Correo,Nombres,Apellidos FROM t_contacto_usuario as A, t_usuarios as B WHERE Usuario_Id_Usuario='".$TxtUsuario."' and A.Usuario_Id_Usuario=B.Id_Usuario";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $CorreoUser=$CorreoUser.$row['Correo'].",";
        $Nombres=$row['Nombres'];
        $Apellidos=$row['Apellidos'];
 }
}

$sql ="SELECT Titulo, Detalle_Tarea FROM T_Tareas  WHERE Id_Tarea='".$Asig_Actividad."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $TxtTitulo=$row['Titulo'];
        $TxtDetalle=$row['Detalle_Tarea'];
 }
}


//Ingresar Nueva Notas

$Nota1="Actividad Reasignada a :".utf8_decode($Nombres)." ".utf8_decode($Apellidos);

	$sql = "INSERT INTO T_Timeline_Tareas (Tarea_id_tarea, Usuario_id_usuario, Fecha_Timeline, Datos_Timeline) VALUES ('".utf8_decode($Asig_Actividad)."','".utf8_decode($IdUser)."','".utf8_decode($MarcaTemporal)."','".utf8_decode($Nota1)."');";
//echo($sql);
$result = $conexion->query($sql);


include("Lib/funciones.php");  
//$copiacorreo="josedanielmeza@hotmail.com";
Email_Personalizado($CorreoUser,$copiacorreo,4,$TxtTitulo,$TxtDetalle,$MarcaTemporal,$Nota1,0);

$Valida=header("location:Task.php?Mensaje=5");

?>