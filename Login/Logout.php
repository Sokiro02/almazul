<?php
include ("../Administrator/Lib/conexion.php");
session_start();
$IdUser=$_SESSION['IdUser'];

$sql="DELETE FROM ingreso_temporal_usuario WHERE Usuario_Ingreso='".$IdUser."';";
$result = $conexion->query($sql);


$sql="SELECT * FROM t_usuarios_activos WHERE Id_Usuario = '".$IdUser."'";
$result=$conexion->query($sql) or die('Error:'.mysqli_error($conexion));
if ($result->num_rows > 0) {
    $sql2 = "DELETE FROM t_usuarios_activos WHERE Id_Usuario = '".$IdUser."'";
    $resultado = $conexion->query($sql2);
    if ($resultado){
        unset ($SESSION['username']);
        unset ($_SESSION['loggedin']);
        unset ($_SESSION['username']);
        unset ($_SESSION['start']);
        unset ($_SESSION['IdUser']);
        unset ($_SESSION['IdRol']);
        unset ($_SESSION['expire']);
        session_destroy();
        header("location:index.php");
    }
}

unset ($SESSION['username']);
session_destroy();

header("location:index.php");
?>