<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];


$Aleaotorio=rand(0,9999);
$TxtNombreUser=$_POST['TxtNombreUser'];

$TxtApellidos=$_POST['TxtApellidos'];

$TxtCelular=$_POST['TxtCelular'];

$TxtFijo=$_POST['TxtFijo'];

$Fotoperfil=$_POST['Fotoperfil'];

$TxtRol=$_POST['TxtRol'];

$TxtCorreo=$_POST['TxtCorreo'];

$TxtPass=$_POST['TxtPass'];

//////////////////////////////////////////////
//AGREGAR SEGURIDAD A LA  CONTRASEÑA
$Password_encriptado = md5($TxtPass);
//////////////////////////////////////////////

$target_file="images/Perfiles/7287-User-Default.jpg";
$EstadoUsuario=1;

$sql ="SELECT user_name  FROM t_usuarios WHERE user_name='".$TxtCorreo."' ";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Valida_email=$row['user_name'];
    }
}

if ($Valida_email==$TxtCorreo) {
    $Valida=header("location:Usuarios.php?Mensaje=10");
}
else
{

// Guardar Usuario 
//***************************************************************************************************
$sql = "INSERT INTO t_usuarios (Nombres, Apellidos, user_name, pass, Img_Perfil, Rol_id_rol, Estado_id_estado_usuario)
VALUES ('".utf8_decode($TxtNombreUser)."', '".utf8_decode($TxtApellidos)."', '".utf8_decode($TxtCorreo)."','".$Password_encriptado."','".utf8_decode($target_file)."','".utf8_decode($TxtRol)."','".utf8_decode($EstadoUsuario)."')";
//echo($sql);
$result = $conexion->query($sql);

// Recuperación Id Usuario Creado
//***************************************************************************************************

$sql ="SELECT Id_Usuario  FROM t_usuarios WHERE user_name='".$TxtCorreo."' ";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Id_UsuarioCreado=$row['Id_Usuario'];
    }
}

//Guardar Datos de Contacto
//***************************************************************************************************

$sql = "INSERT INTO t_contacto_usuario (Correo,Cel, Tel, Usuario_id_usuario)
VALUES ('".utf8_decode($TxtCorreo)."', '".utf8_decode($TxtCelular)."', '".utf8_decode($TxtFijo)."','".utf8_decode($Id_UsuarioCreado)."')";
//echo($sql);
$result = $conexion->query($sql);

// Envio de correo 
//***************************************************************************************************
include("Lib/funciones.php");   
//$copiacorreo="josedanielmeza@hotmail.com";
//Email_Personalizado($TxtCorreo,$copiacorreo,5,$TxtCorreo,$TxtPass,0,0);
//Correo Enviado

header("location:Usuarios.php?Mensaje=6");

}

?>