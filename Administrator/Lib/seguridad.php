<?php

function AgregarLog($usuario,$accion,$observacion){
    include("conexion.php");
    $id_usuario = $usuario;
    $consultas="INSERT INTO t_usuarios_log(Id_Usuario,accion,observacion) VALUES ('".$id_usuario."','".$accion."','".$observacion."')";
    $resultado = $conexion->query($consultas) or die('Error:'.mysqli_error($conexion));        
}
?>