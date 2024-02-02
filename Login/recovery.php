<?php 
$verificar_email = $_POST['TxtEmail'];
if ($verificar_email!="") {
include("../Include/conexion.php");

$sql ="SELECT User_Name,Pass FROM T_Usuarios WHERE User_Name='".$verificar_email."' ";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $email_recuperado=$row['User_Name'];
        $pass_recuperado=$row['Pass'];
    }
}

if ($email_recuperado!="") {
    include("../Include/funciones.php");  
//$copiacorreo="mediosdigitales@ofigas.com";
Email_Personalizado($email_recuperado,$copiacorreo,2,$email_recuperado,$pass_recuperado,0,0);
$Valida=header("location:index.php?Mensaje=13");
}
else
{
	$Valida=header("location:index.php?Mensaje=14");
}

}

?>