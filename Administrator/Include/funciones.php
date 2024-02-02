<?php 
include("conexion.php");
$sql ="SELECT Correo_App FROM t_config WHERE Desarrollador='TEKSYSTEM S.A.S'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Correo_App=$row['Correo_App'];     
 }
}
?>	


<?php 
function Email_Personalizado($enviadoa,$copiadoa,$tipocorreo,$dato1,$dato2,$dato3)
{
 
// Correo Nº1
// Case 1 = Correo suscriptor nuevo usuario
	$destinatario = $enviadoa;

if ($tipocorreo==1) {
	$asunto = "Registro Financorp"; 
	$cuerpo = ' 
<html> 
<head> 
   <title>Bienvenido a Financorp</title> 
</head> 
<body style="margin: 10; padding: 10;"> 
<h1>Bienvenido a Financorp!</h1> 
<p> 
<b>Hemos recibido tus Datos</b>. Ya puedes ingresar en el siguiente link.
</p> 
<br>
<b>Usuario:</b>'.$dato1.'
<b>Password:</b>'.$dato2.'
</body> 
</html> 
'; 
}
if ($tipocorreo==2) {
	$asunto = "Recuperación Credenciales Financorp"; 
	$cuerpo = ' 
<html> 
<head> 
   <title>Gracias por Escribirnos</title> 
</head> 
<body style="margin: 10; padding: 10;"> 
<h1>Bienvenido a Financorp!</h1> 
<p> 
<b>Hemos recibido tus Datos</b>. Ya puedes ingresar en el siguiente link.
</p> 
<br>
<b>Usuario:</b>'.$dato1.'
<b>Password:</b>'.$dato2.'
</body> 
</html> 
'; 
}



//para el envío en formato HTML 
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

//dirección del remitente 
$headers .= "From: Financorp <".$Correo_App.">\r\n"; 

//dirección de respuesta, si queremos que sea distinta que la del remitente 
// $headers .= "Reply-To: mariano@desarrolloweb.com\r\n"; 

//ruta del mensaje desde origen a destino 
//$headers .= "Return-path: holahola@desarrolloweb.com\r\n"; 

//direcciones que recibián copia 
$headers .= "Cc: ".$copiadoa."\r\n"; 


if (mail($destinatario,$asunto,$cuerpo,$headers)) {
echo "<script language='javascript'>
alert('Datos enviados a Financorp.com, muchas gracias. Puede cerrar este mensaje');
window.location.href = 'http://financorp.diconingenieria.com';
</script>";
} else {
echo 'Falló el envio';
}


}


?>

