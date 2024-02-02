<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
include("Lib/seguridad.php");
$IdUser=$_SESSION['IdUser'];
$Aleaotorio=rand(0,9999);
$TxtEdNombreUser=$_POST['TxtEdNombreUser'];
$TxtEdApellidos=$_POST['TxtEdApellidos'];
$TxtEdCelular=$_POST['TxtEdCelular'];
$TxEdtFijo=$_POST['TxEdtFijo'];
$TxtEdUserName=$_POST['TxtEdUserName'];
$TxtEdRol=$_POST['TxtEdRol'];
$TxtEdCorreo=$_POST['TxtEdCorreo'];
$TxtEdPass=$_POST['TxtEdPass'];
$TxtEdPassA=$_POST['TxtEdPassA']; //PASSWORD ANTIGUO
$TxtEdIdUsuario=$_POST['TxtEdIdUsuario'];
$Fotoperfil=$_POST['Fotoperfil'];
$seguridad = AgregarLog($IdUser,"Modifico el perfil del usuario: '".$TxtEdUserName."'","Edicion de Perfil");

if ($TxtEdPass=="" and $TxtEdIdUsuario!=""){
        $sql ="UPDATE t_usuarios SET Nombres='".utf8_decode($TxtEdNombreUser)."', Apellidos='".utf8_decode($TxtEdApellidos)."' WHERE Id_Usuario='".$TxtEdIdUsuario."'";  
        $result = $conexion->query($sql);
        $sql ="UPDATE t_contacto_usuario SET Correo='".utf8_decode($TxtEdCorreo)."', Cel='".utf8_decode($TxtEdCelular)."', Tel='".utf8_decode($TxEdtFijo)."' WHERE Usuario_Id_Usuario='".$TxtEdIdUsuario."'";  
        $result = $conexion->query($sql);
        header("location:Perfil.php?Mensaje=1&TAB=tabs-3");
        exit();
}

if ($TxtEdIdUsuario!="") {
        $TxtEdPass=md5($TxtEdPass);
        
        // Actualización de la Actividad
        $sql ="UPDATE t_usuarios SET Nombres='".utf8_decode($TxtEdNombreUser)."', Apellidos='".utf8_decode($TxtEdApellidos)."', Pass='".$TxtEdPass."' WHERE Id_Usuario='".$TxtEdIdUsuario."'";  
        $result = $conexion->query($sql);
        $sql ="UPDATE t_contacto_usuario SET Correo='".utf8_decode($TxtEdCorreo)."', Cel='".utf8_decode($TxtEdCelular)."', Tel='".utf8_decode($TxEdtFijo)."' WHERE Usuario_Id_Usuario='".$TxtEdIdUsuario."'";  
        $result = $conexion->query($sql);
        header("location:Perfil.php?Mensaje=1&TAB=tabs-3");
}

?>