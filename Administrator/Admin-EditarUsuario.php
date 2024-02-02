<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

$TxtEdNombreUser=$_POST['TxtEdNombreUser'];

$TxtEdApellidos=$_POST['TxtEdApellidos'];

$TxtEdCelular=$_POST['TxtEdCelular'];

$TxEdtFijo=$_POST['TxEdtFijo'];

$TxtEdUserName=$_POST['TxtEdUserName'];

$TxtEdRol=$_POST['TxtEdRol'];

$TxtEdCorreo=$_POST['TxtEdCorreo'];

$TxtEdPass=$_POST['TxtEdPass'];
$TxtEdPass=md5($TxtEdPass);

$TxtEdIdUsuario=$_POST['TxtEdIdUsuario'];


if ($TxtEdIdUsuario!="") {

// Actualización de la Actividad

$sql ="UPDATE t_usuarios SET Nombres='".utf8_decode($TxtEdNombreUser)."', Apellidos='".utf8_decode($TxtEdApellidos)."', User_Name='".utf8_decode($TxtEdUserName)."' , Pass='".utf8_decode($TxtEdPass)."' , Rol_id_Rol='".utf8_decode($TxtEdRol)."' WHERE Id_Usuario='".$TxtEdIdUsuario."'";  
//echo($sql);
$result = $conexion->query($sql);

$sql ="UPDATE t_contacto_usuario SET Correo='".utf8_decode($TxtEdCorreo)."', Cel='".utf8_decode($TxtEdCelular)."', Tel='".utf8_decode($TxEdtFijo)."' WHERE Usuario_Id_Usuario='".$TxtEdIdUsuario."'";  
//echo($sql);
$result = $conexion->query($sql);

header("location:Usuarios.php?Mensaje=18");


}

?>