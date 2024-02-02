<?php 
function Email_Personalizado($enviadoa,$copiadoa,$tipocorreo,$dato1,$dato2,$dato3,$dato4)
{

include("conexion.php");
$sql ="SELECT Correo_App,Nom_App, Url_Web FROM t_config WHERE Desarrollador='TEKSYSTEM S.A.S'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Correo_App=$row['Correo_App'];
        $Nombre_App=$row['Nom_App']; 
        $LinkApp=$row['Url_Web'];      
 }
}
 //$copiadoa="josedanielmeza@hotmail.com";
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
	$asunto = "Recuperación Contraseña ".$Nombre_App.""; 
	$cuerpo = ' 
<html> 
<head> 
   <title>Recuperación Contraseña</title> 
</head> 
<body style="margin: 10; padding: 10;text-align:center"> 
<div style="text-align:center;font-family:Helvetica;font-size:14px;color:#7F8C8D;">
<img src="http://financorp.diconingenieria.com/PerfilFace.png" style="width:70%;">
'.utf8_decode("<h1 style='color:black;'>Recuperación de Contraseña</h1>").' 
<p style="font-family:Helvetica;font-size:14px;color:#7F8C8D;"> 
Gracias por escribirnos, has solicitado los datos de ingreso a la plataforma '.$Nombre_App.' <br>
Por favor ingresar al siguiente link con los siguientes datos:
</p> 
<br>
<b>Usuario:</b>'.utf8_decode($dato1).'
<br>
<b>Password:</b>'.utf8_decode($dato2).'
<br>
<br>
<hr style="color: #0056b2;margin:15px;" />
<img src="http://financorp.diconingenieria.com/PerfilWebMaster.jpg" style="width:15%;text-align:center;"><br>
'.utf8_decode("<b>Fredy González,</b>Web Master <br>").'
'.utf8_decode("<b>E-mail:</b>".$Correo_App." <br>").'

<br>

</div>
</body> 
</html> 
'; 
}

if ($tipocorreo==3) {
	$asunto = "Nueva Tarea Asignada ".$Nombre_App.""; 
	$cuerpo = ' 
<html> 
<head> 
   <title>Tarea Asignada</title> 
</head> 
<body style="margin: 10; padding: 10;text-align:center"> 
<div style="text-align:center;font-family:Helvetica;font-size:14px;color:#7F8C8D;">
<img src="http://financorp.diconingenieria.com/PerfilFace.png" style="width:70%;">
'.utf8_decode("<h1 style='color:black;'>Tarea Asignada desde  ".utf8_decode($Nombre_App)."</h1>").' 
<p style="font-family:Helvetica;font-size:15px;color:#7F8C8D;text-align:left;"> 
Cordial Saludo, a '.utf8_decode("continuación encontrará").' los detalles de la actividad asignada desde  '.utf8_decode($Nombre_App).' <br>
</p> 
<p style="text-align:left;font-family:Helvetica;font-size:15px;">
<br>
<b>Actividad:</b>'.utf8_decode($dato1).'
<br>
<b>Detalles:</b>'.utf8_decode($dato2).'
<br>
'.utf8_decode("<b>Fecha y Hora de Asignación:</b>").utf8_decode($dato3).'
<br>
<br>
<b style="color:black;">Recuerde que cuenta con un lapso de 12 Horas para aceptar la actividad a '.utf8_decode("través").' de la plataforma on-line </b><a href="'.utf8_decode($LinkApp).'">'.utf8_decode($Nombre_App).'</a>
</p>
<hr style="color: #0056b2;margin:15px;" />
<img src="http://financorp.diconingenieria.com/PerfilWebMaster.jpg" style="width:10%;text-align:center;"><br>
'.utf8_decode("<b>Fredy González,</b>Web Master <br>").'
'.utf8_decode("<b>E-mail:</b>".utf8_decode($Correo_App)." <br>").'
<hr style="color: #0056b2;margin:15px;" />
<small>Para asegurarte de que te lleguen nuestros correos '.utf8_decode("electrónicos, añade").'"'.utf8_decode($Correo_App).'" a tus contactos.</small>

<br>

</div>
</body> 
</html> 
'; 
}

if ($tipocorreo==4) {
	$asunto = "Tarea Reasignada ".$Nombre_App.""; 
	$cuerpo = ' 
<html> 
<head> 
   <title>Tarea Reasignada</title> 
</head> 
<body style="margin: 10; padding: 10;text-align:center"> 
<div style="text-align:center;font-family:Helvetica;font-size:14px;color:#7F8C8D;">
<img src="http://financorp.diconingenieria.com/PerfilFace.png" style="width:70%;">
'.utf8_decode("<h1 style='color:black;'>Tarea Reasignada desde  ".utf8_decode($Nombre_App)."</h1>").' 
<p style="font-family:Helvetica;font-size:15px;color:#7F8C8D;text-align:left;"> 
Cordial Saludo, a '.utf8_decode("continuación encontrará").' los detalles de la actividad que fue Reasignada desde  '.utf8_decode($Nombre_App).' <br>
</p> 
<p style="text-align:left;font-family:Helvetica;font-size:15px;">
<br>
<b>Nota:</b>'.utf8_decode($dato4).'
<br>
<b>Actividad:</b>'.utf8_decode($dato1).'
<br>
<b>Detalles:</b>'.utf8_decode($dato2).'
<br>
'.utf8_decode("<b>Fecha y Hora de la Edición:</b>").utf8_decode($dato3).'
<br>
<br>
<b style="color:black;">Recuerde que cuenta con un lapso de 12 Horas para aceptar la actividad  '.utf8_decode("través").' de la plataforma on-line </b><a href="'.utf8_decode($LinkApp).'">'.utf8_decode($Nombre_App).'</a>
</p>
<hr style="color: #0056b2;margin:15px;" />
<img src="http://financorp.diconingenieria.com/PerfilWebMaster.jpg" style="width:10%;text-align:center;"><br>
'.utf8_decode("<b>Fredy González,</b>Web Master <br>").'
'.utf8_decode("<b>E-mail:</b>".utf8_decode($Correo_App)." <br>").'
<hr style="color: #0056b2;margin:15px;" />
<small>Para asegurarte de que te lleguen nuestros correos '.utf8_decode("electrónicos, añade").'"'.utf8_decode($Correo_App).'" a tus contactos.</small>

<br>

</div>
</body> 
</html> 
'; 
}

if ($tipocorreo==5) {
	$asunto = "Credenciales de Acceso ".$Nombre_App.""; 
	$cuerpo = ' 
<html> 
<head> 
   <title>Credenciales</title> 
</head> 
<body style="margin: 10; padding: 10;text-align:center"> 
<div style="text-align:center;font-family:Helvetica;font-size:14px;color:#7F8C8D;">
<img src="http://financorp.diconingenieria.com/PerfilFace.png" style="width:70%;">
'.utf8_decode("<h1 style='color:black;'>Cuenta de Usuario ".utf8_decode($Nombre_App)."</h1>").' 
<p style="font-family:Helvetica;font-size:15px;color:#7F8C8D;text-align:left;"> 
Cordial Saludo, a '.utf8_decode("continuación encontrará").' sus credenciales de acceso a '.utf8_decode($Nombre_App).' <br>
</p> 
<p style="text-align:left;font-family:Helvetica;font-size:15px;">
<br>
<b>Usuario:</b>'.utf8_decode($dato1).'
<br>
<b>Password:</b>'.utf8_decode($dato2).'
<br>
<b style="color:black;">En el siguiente link Puede ingresar a nuestra plataforma on-line </b><a href="'.utf8_decode($LinkApp).'">'.utf8_decode($Nombre_App).'</a>
</p>
<hr style="color: #0056b2;margin:15px;" />
<img src="http://financorp.diconingenieria.com/PerfilWebMaster.jpg" style="width:10%;text-align:center;"><br>
'.utf8_decode("<b>Fredy González,</b>Web Master <br>").'
'.utf8_decode("<b>E-mail:</b>".utf8_decode($Correo_App)." <br>").'
<hr style="color: #0056b2;margin:15px;" />
<small>Para asegurarte de que te lleguen nuestros correos '.utf8_decode("electrónicos, añade").'"'.utf8_decode($Correo_App).'" a tus contactos.</small>

<br>

</div>
</body> 
</html> 
'; 
}


//para el envío en formato HTML 
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

//dirección del remitente 
$headers .= "From: ".$Nombre_App." <".$Correo_App.">\r\n"; 

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

