<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];
include("Lib/permisos.php");


// Insertar Comentario

$ValNota=$_GET['ValNota'];
if ($ValNota==1) {

date_default_timezone_set("America/Bogota");
$MarcaTemporal = date('Y-m-d H:i:s');

  $MiComentario=htmlentities($_POST['MiNota']);
  $OrdenNumero=$_POST['OrdenNumero'];
$sql = "INSERT INTO t_comentarios_produccion(Usuario_id_usuario, Fecha_Comentario, Comentario_Prod, Solicitud_Cod_Orden) VALUES ('".utf8_decode($IdUser)."','".utf8_decode($MarcaTemporal)."','".utf8_decode($MiComentario)."','".utf8_decode($OrdenNumero)."')";
//echo($sql);
$result = $conexion->query($sql);

$Valida=header("location:Panel-Produccion.php?Solicitud=".$OrdenNumero."&Mensaje=1&Propietario=".$Propietario."");
}
// Fin Insertar Comentario


// Actualizar Estado a Producción
$CambioEstado=$_GET['CambioEstado'];

if ($CambioEstado==7) {
$TxtSastre=$_POST['TxtSastre'];
$TxtOrdenNumero=$_POST['TxtOrdenNumero'];
$TxtCantidad=$_POST['TxtCantidad'];
$TxtTipoPrenda=$_POST['TxtTipoPrenda'];
$TxtRef=$_POST['TxtRef'];
$TxtBodega=$_POST['TxtBodega'];


$EstadoProd=2; // Primer Estado después de Asignado (Producción)

$sql="UPDATE t_solicitudes_prod SET Estado_Solicitud_Prod='".$EstadoProd."', Existencias_Ref='".$TxtCantidad."' WHERE Cod_Solicitud_Prod='".$TxtOrdenNumero."'";
$result = $conexion->query($sql);


// Insertar trazabilidad
date_default_timezone_set("America/Bogota");
$DiaActual = date('Y-m-d H:i:s');
// Consulta de Fecha Estado Anterior
 $sql="SELECT Fecha_Solicitud FROM t_solicitudes_prod WHERE Cod_Solicitud_Prod='".$TxtOrdenNumero."'";
$result=$conexion->query($sql);
    if ($result->num_rows > 0) {
       while ($row = $result->fetch_assoc()) { 
             $Fecha_Inicial=$row['Fecha_Solicitud'];
      }
    }
// Fin Consulta de Fecha Estado Anterior

$DiasEstado1=dias_transcurridos($Fecha_Inicial,$DiaActual);

$EstadoTraz=utf8_decode("Asignado");
// 1º Registro de trazabilidad
$sql="INSERT INTO t_trazabilidad_prod (Solicitud_Cod_Solicitud_Prod, Fecha_Cambio_Estado, Estado_Reportado, Dias_Transcurridos,Num_Prendas,Tipo_Prenda, Usuario_Id_Usuario,Sastre_Asignado) VALUES ('".$TxtOrdenNumero."','".$Fecha_Inicial."','".$EstadoTraz."','".$DiasEstado1."','".$TxtCantidad."','".$TxtTipoPrenda."','".$IdUser."','".$TxtSastre."')";
$result = $conexion->query($sql);


$DiasEstado1=dias_transcurridos($Fecha_Inicial,$DiaActual);
$EstadoProduccion=utf8_decode("Producción");
// 2º Registro de trazabilidad
$sql="INSERT INTO t_trazabilidad_prod (Solicitud_Cod_Solicitud_Prod, Fecha_Cambio_Estado, Estado_Reportado, Dias_Transcurridos,Num_Prendas,Tipo_Prenda, Usuario_Id_Usuario,Sastre_Asignado) VALUES ('".$TxtOrdenNumero."','".$DiaActual."','".$EstadoProduccion."','".$DiasEstado1."','".$TxtCantidad."','".$TxtTipoPrenda."','".$IdUser."','".$TxtSastre."')";
$result = $conexion->query($sql);


// Primera Notificación de Producción
$ComentarioAutomatico=utf8_decode("Orden cambia a estado producción en Taller");

$sql=("INSERT INTO t_comentarios_produccion (Usuario_id_usuario, Fecha_Comentario, Comentario_Prod, Solicitud_Cod_Orden) VALUES ('".$IdUser."','".$DiaActual."','".$ComentarioAutomatico."','".$TxtOrdenNumero."')");
$result = $conexion->query($sql);




$Valida=header("location:Panel-Produccion.php?Solicitud=".$TxtOrdenNumero."&Mensaje=3&Propietario=".$Propietario."");

}


// Fin Actualizar
if ($CambioEstado==1) {
$TxtSastre=$_POST['TxtSastre'];
$TxtOrdenNumero=$_POST['TxtOrdenNumero'];
$TxtCantidad=$_POST['TxtCantidad'];
$TxtTipoPrenda=$_POST['TxtTipoPrenda'];

if ($TxtSastre==1) {
 
$EstadoProd=5; // Primer Estado después de Asignado (Producción)

$sql="UPDATE t_solicitudes_prod SET  Estado_Solicitud_Prod='".$EstadoProd."' WHERE Cod_Solicitud_Prod='".$TxtOrdenNumero."'";
$result = $conexion->query($sql);


// Insertar trazabilidad
date_default_timezone_set("America/Bogota");
$DiaActual = date('Y-m-d H:i:s');
// Consulta de Fecha Estado Anterior
 $sql="SELECT Fecha_Solicitud FROM t_solicitudes_prod WHERE Cod_Solicitud_Prod='".$TxtOrdenNumero."'";
$result=$conexion->query($sql);
    if ($result->num_rows > 0) {
       while ($row = $result->fetch_assoc()) { 
             $Fecha_Inicial=$row['Fecha_Solicitud'];
      }
    }
// Fin Consulta de Fecha Estado Anterior

$DiasEstado1=dias_transcurridos($Fecha_Inicial,$DiaActual);

$EstadoTraz=utf8_decode("Asignado");
// 1º Registro de trazabilidad
$sql="INSERT INTO t_trazabilidad_prod (Solicitud_Cod_Solicitud_Prod, Fecha_Cambio_Estado, Estado_Reportado, Dias_Transcurridos,Num_Prendas,Tipo_Prenda, Usuario_Id_Usuario,Sastre_Asignado) VALUES ('".$TxtOrdenNumero."','".$Fecha_Inicial."','".$EstadoTraz."','".$DiasEstado1."','".$TxtCantidad."','".$TxtTipoPrenda."','".$IdUser."','".$TxtSastre."')";
$result = $conexion->query($sql);


$DiasEstado1=dias_transcurridos($Fecha_Inicial,$DiaActual);
$EstadoProduccion=utf8_decode("Producción");
// 2º Registro de trazabilidad
$sql="INSERT INTO t_trazabilidad_prod (Solicitud_Cod_Solicitud_Prod, Fecha_Cambio_Estado, Estado_Reportado, Dias_Transcurridos,Num_Prendas,Tipo_Prenda, Usuario_Id_Usuario,Sastre_Asignado) VALUES ('".$TxtOrdenNumero."','".$DiaActual."','".$EstadoProduccion."','".$DiasEstado1."','".$TxtCantidad."','".$TxtTipoPrenda."','".$IdUser."','".$TxtSastre."')";
$result = $conexion->query($sql);


// Primera Notificación de Producción
$ComentarioAutomatico=utf8_decode("Orden cambia a estado producción en Taller");

$sql=("INSERT INTO t_comentarios_produccion (Usuario_id_usuario, Fecha_Comentario, Comentario_Prod, Solicitud_Cod_Orden) VALUES ('".$IdUser."','".$DiaActual."','".$ComentarioAutomatico."','".$TxtOrdenNumero."')");
$result = $conexion->query($sql);


$Valida=header("location:Panel-Produccion.php?Solicitud=".$TxtOrdenNumero."&Mensaje=3&Propietario=".$Propietario."");
   } // Hasta aquí se ejecuta todo lo de sastre

   else 
   {
    $TxtSastre=$_POST['TxtSastre'];
$TxtOrdenNumero=$_POST['TxtOrdenNumero'];
$TxtCantidad=$_POST['TxtCantidad'];
$TxtTipoPrenda=$_POST['TxtTipoPrenda'];
$TxtSastreAsignado=$_POST['TxtSastreAsignado'];

$EstadoCentro=7; // Tercer Estado después de Producción (Centro de Distribución)
$sql="UPDATE t_solicitudes_prod SET Estado_Solicitud_Prod='".$EstadoCentro."', Existencias_Ref='".$TxtCantidad."' WHERE Cod_Solicitud_Prod='".$TxtOrdenNumero."'";
$result = $conexion->query($sql);

// Insertar trazabilidad
date_default_timezone_set("America/Bogota");
$DiaActual = date('Y-m-d H:i:s');

// Consulta de Fecha Estado Anterior
 $sql="SELECT Fecha_Cambio_Estado FROM t_trazabilidad_prod WHERE Solicitud_Cod_Solicitud_Prod='".$TxtOrdenNumero."' and Estado_Reportado='Acabados'";
$result=$conexion->query($sql);
    if ($result->num_rows > 0) {
       while ($row = $result->fetch_assoc()) { 
             $Fecha_Inicial=$row['Fecha_Cambio_Estado'];
      }
    }
// Fin Consulta de Fecha Estado Anterior
$DiasEstado4=dias_transcurridos($Fecha_Inicial,$DiaActual);
$EstadoDistribu=utf8_decode("Centro de Distribución");


$sql="INSERT INTO t_trazabilidad_prod (Solicitud_Cod_Solicitud_Prod, Fecha_Cambio_Estado, Estado_Reportado, Dias_Transcurridos,Num_Prendas,Tipo_Prenda, Usuario_Id_Usuario,Sastre_Asignado) VALUES ('".$TxtOrdenNumero."','".$DiaActual."','".$EstadoDistribu."','".$DiasEstado4."','".$TxtCantidad."','".$TxtTipoPrenda."','".$IdUser."','".$TxtSastreAsignado."')";
$result = $conexion->query($sql);

// Primera Notificación de Producción
$ComentarioAutomatico=htmlentities("Orden de Producción enviada al centro de Distribución");

$sql=("INSERT INTO t_comentarios_produccion (Usuario_id_usuario, Fecha_Comentario, Comentario_Prod, Solicitud_Cod_Orden) VALUES ('".$IdUser."','".$DiaActual."','".$ComentarioAutomatico."','".$TxtOrdenNumero."')");
$result = $conexion->query($sql);


$Valida=header("location:Panel-Produccion.php?Solicitud=".$TxtOrdenNumero."&Mensaje=5&Propietario=".$Propietario."");

   }
}
// Fin Actualizar

// Actualizar Estado a Acabados
if ($CambioEstado==3) {


$TxtSastre=$_POST['TxtSastre'];
$TxtOrdenNumero=$_POST['TxtOrdenNumero'];
$TxtCantidad=$_POST['TxtCantidad'];
$TxtTipoPrenda=$_POST['TxtTipoPrenda'];
$TxtSastreAsignado=$_POST['TxtSastreAsignado'];


$EstadoAcabados=6; // Tercer Estado después de Producción (Acabados)
$sql="UPDATE t_solicitudes_prod SET Estado_Solicitud_Prod='".$EstadoAcabados."' WHERE Cod_Solicitud_Prod='".$TxtOrdenNumero."'";
$result = $conexion->query($sql);


// Insertar trazabilidad
date_default_timezone_set("America/Bogota");
$DiaActual = date('Y-m-d H:i:s');
// Consulta de Fecha Estado Anterior
 $sql="SELECT Fecha_Cambio_Estado FROM t_trazabilidad_prod WHERE Solicitud_Cod_Solicitud_Prod='".$TxtOrdenNumero."' and Estado_Reportado='Producción'";
$result=$conexion->query($sql);
    if ($result->num_rows > 0) {
       while ($row = $result->fetch_assoc()) { 
             $Fecha_Inicial=$row['Fecha_Cambio_Estado'];
      }
    }
// Fin Consulta de Fecha Estado Anterior
$DiasEstado3=dias_transcurridos($Fecha_Inicial,$DiaActual);
$EstadoProduccion=utf8_decode("Acabados");

$sql="INSERT INTO t_trazabilidad_prod (Solicitud_Cod_Solicitud_Prod, Fecha_Cambio_Estado, Estado_Reportado, Dias_Transcurridos,Num_Prendas,Tipo_Prenda, Usuario_Id_Usuario,Sastre_Asignado) VALUES ('".$TxtOrdenNumero."','".$DiaActual."','".$EstadoProduccion."','".$DiasEstado3."','".$TxtCantidad."','".$TxtTipoPrenda."','".$IdUser."','".$TxtSastreAsignado."')";
$result = $conexion->query($sql);

// Primera Notificación de Producción
$ComentarioAutomatico=utf8_decode("Orden terminada en estado Acabados");

$sql=("INSERT INTO t_comentarios_produccion (Usuario_id_usuario, Fecha_Comentario, Comentario_Prod, Solicitud_Cod_Orden) VALUES ('".$IdUser."','".$DiaActual."','".$ComentarioAutomatico."','".$TxtOrdenNumero."')");
$result = $conexion->query($sql);


$Valida=header("location:Panel-Produccion.php?Solicitud=".$TxtOrdenNumero."&Mensaje=4&Propietario=".$Propietario."");

}
// Fin Actualizar


// Actualizar Estado a Acabados
if ($CambioEstado==4) {

$TxtSastre=$_POST['TxtSastre'];
$TxtOrdenNumero=$_POST['TxtOrdenNumero'];
$TxtCantidad=$_POST['TxtCantidad'];
$TxtTipoPrenda=$_POST['TxtTipoPrenda'];
$TxtSastreAsignado=$_POST['TxtSastreAsignado'];

$EstadoCentro=7; // Tercer Estado después de Producción (Centro de Distribución)
$sql="UPDATE t_solicitudes_prod SET Estado_Solicitud_Prod='".$EstadoCentro."', Existencias_Ref='".$TxtCantidad."' WHERE Cod_Solicitud_Prod='".$TxtOrdenNumero."'";
$result = $conexion->query($sql);

// Insertar trazabilidad
date_default_timezone_set("America/Bogota");
$DiaActual = date('Y-m-d H:i:s');

// Consulta de Fecha Estado Anterior
 $sql="SELECT Fecha_Cambio_Estado FROM t_trazabilidad_prod WHERE Solicitud_Cod_Solicitud_Prod='".$TxtOrdenNumero."' and Estado_Reportado='Acabados'";
$result=$conexion->query($sql);
    if ($result->num_rows > 0) {
       while ($row = $result->fetch_assoc()) { 
             $Fecha_Inicial=$row['Fecha_Cambio_Estado'];
      }
    }
// Fin Consulta de Fecha Estado Anterior
$DiasEstado4=dias_transcurridos($Fecha_Inicial,$DiaActual);
$EstadoDistribu=utf8_decode("Centro de Distribución");


$sql="INSERT INTO t_trazabilidad_prod (Solicitud_Cod_Solicitud_Prod, Fecha_Cambio_Estado, Estado_Reportado, Dias_Transcurridos,Num_Prendas,Tipo_Prenda, Usuario_Id_Usuario,Sastre_Asignado) VALUES ('".$TxtOrdenNumero."','".$DiaActual."','".$EstadoDistribu."','".$DiasEstado4."','".$TxtCantidad."','".$TxtTipoPrenda."','".$IdUser."','".$TxtSastreAsignado."')";
$result = $conexion->query($sql);

// Primera Notificación de Producción
$ComentarioAutomatico=utf8_decode("Orden de Producción enviada al centro de Distribución");

$sql=("INSERT INTO t_comentarios_produccion (Usuario_id_usuario, Fecha_Comentario, Comentario_Prod, Solicitud_Cod_Orden) VALUES ('".$IdUser."','".$DiaActual."','".$ComentarioAutomatico."','".$TxtOrdenNumero."')");
$result = $conexion->query($sql);


$Valida=header("location:Panel-Produccion.php?Solicitud=".$TxtOrdenNumero."&Mensaje=5&Propietario=".$Propietario."");

}
// Fin Actualizar

// Actualizar Estado a Acabados
if ($CambioEstado==8) {

$TxtSastre=$_POST['TxtSastre'];
$TxtOrdenNumero=$_POST['TxtOrdenNumero'];
$TxtCantidad=$_POST['TxtCantidad'];
$TxtTipoPrenda=$_POST['TxtTipoPrenda'];
$TxtSastreAsignado=$_POST['TxtSastreAsignado'];
$TxtBodega=$_POST['TxtBodega'];
$TxtRef=$_POST['TxtRef'];

$EstadoCentro=7; // Tercer Estado después de Producción (Centro de Distribución)
$sql="UPDATE t_solicitudes_prod SET Estado_Solicitud_Prod='".$EstadoCentro."' WHERE Cod_Solicitud_Prod='".$TxtOrdenNumero."'";
$result = $conexion->query($sql);

// Insertar trazabilidad
date_default_timezone_set("America/Bogota");
$DiaActual = date('Y-m-d H:i:s');

// Consulta de Fecha Estado Anterior
 $sql="SELECT Fecha_Cambio_Estado FROM t_trazabilidad_prod WHERE Solicitud_Cod_Solicitud_Prod='".$TxtOrdenNumero."' and Estado_Reportado='Acabados'";
$result=$conexion->query($sql);
    if ($result->num_rows > 0) {
       while ($row = $result->fetch_assoc()) { 
             $Fecha_Inicial=$row['Fecha_Cambio_Estado'];
      }
    }
// Fin Consulta de Fecha Estado Anterior
$DiasEstado4=dias_transcurridos($Fecha_Inicial,$DiaActual);
$EstadoDistribu=utf8_decode("Centro de Distribución");


$sql="INSERT INTO t_trazabilidad_prod (Solicitud_Cod_Solicitud_Prod, Fecha_Cambio_Estado, Estado_Reportado, Dias_Transcurridos,Num_Prendas,Tipo_Prenda, Usuario_Id_Usuario,Sastre_Asignado) VALUES ('".$TxtOrdenNumero."','".$DiaActual."','".$EstadoDistribu."','".$DiasEstado4."','".$TxtCantidad."','".$TxtTipoPrenda."','".$IdUser."','".$TxtSastreAsignado."')";
$result = $conexion->query($sql);


// Primera Notificación de Producción
$ComentarioAutomatico=utf8_decode("Orden de Producción enviada al centro de Distribución");

$sql=("INSERT INTO t_comentarios_produccion (Usuario_id_usuario, Fecha_Comentario, Comentario_Prod, Solicitud_Cod_Orden) VALUES ('".$IdUser."','".$DiaActual."','".$ComentarioAutomatico."','".$TxtOrdenNumero."')");
$result = $conexion->query($sql);


// Primera Notificación de Producción
$ComentarioAutomatico2=utf8_decode("Producto descontado de inventario de Insumos Correctamente");

$sql=("INSERT INTO t_comentarios_produccion (Usuario_id_usuario, Fecha_Comentario, Comentario_Prod, Solicitud_Cod_Orden) VALUES ('".$IdUser."','".$DiaActual."','".$ComentarioAutomatico2."','".$TxtOrdenNumero."')");
$result = $conexion->query($sql);


$Valida=header("location:Panel-Produccion.php?Solicitud=".$TxtOrdenNumero."&Mensaje=5&Propietario=".$Propietario."");

}
// Fin Actualizar

if ($CambioEstado==5) {

$TxtSastre=$_POST['TxtSastre'];
$TxtOrdenNumero=$_POST['TxtOrdenNumero'];
$TxtCantidad=$_POST['TxtCantidad'];
$TxtTipoPrenda=$_POST['TxtTipoPrenda'];
$TxtSastreAsignado=$_POST['TxtSastreAsignado'];


// Insertar trazabilidad
date_default_timezone_set("America/Bogota");
$DiaActual = date('Y-m-d H:i:s');

$EstadoProd=5; // Primer Estado después de Asignado (Producción)

$sql="UPDATE t_solicitudes_prod SET Sastre_Id_Usuario='".$TxtSastre."', Estado_Solicitud_Prod='".$EstadoProd."' WHERE Cod_Solicitud_Prod='".$TxtOrdenNumero."'";
$result = $conexion->query($sql);

// Primera Notificación de Producción
$ComentarioAutomatico=utf8_decode("Producto solicitado a proveedor, en espera a su llegada.");

$sql=("INSERT INTO t_comentarios_produccion (Usuario_id_usuario, Fecha_Comentario, Comentario_Prod, Solicitud_Cod_Orden) VALUES ('".$IdUser."','".$DiaActual."','".$ComentarioAutomatico."','".$TxtOrdenNumero."')");
$result = $conexion->query($sql);


$Valida=header("location:Panel-Produccion.php?Solicitud=".$TxtOrdenNumero."&Mensaje=6&Propietario=".$Propietario."");


}




?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Modasof</title>

		<meta name="description" content="Common form elements and layouts" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		 <!-- Notificaciones Push -->
		<script src="https://modasof.com/espejo/assets/js/push.min.js"></script>
		
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/fonts.googleapis.com.css" />
        <link rel="stylesheet" href="https://modasof.com/espejo/assets/css/AdminLTE.css">
        <link rel="stylesheet" href="https://modasof.com/espejo/assets/css/_all-skins.min.css">

		<!-- ace styles -->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="https://modasof.com/espejo/assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="https://modasof.com/espejo/assets/js/ace-extra.min.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="https://modasof.com/espejo/assets/js/html5shiv.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/respond.min.js"></script>
		<![endif]-->
	<!--/Inicio Alertas-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link href="https://modasof.com/espejo/assets/css/sweetalert.css" rel="stylesheet">
    <!-- Custom functions file -->
    <script src="https://modasof.com/espejo/assets/js/functions.js"></script>
    <!-- Sweet Alert Script -->
    <script src="https://modasof.com/espejo/assets/js/sweetalert.min.js"></script>
    <!--/Fin Alertas-->

    <link rel="stylesheet" href="https://modasof.com/espejo/assets/css/magnific-popup.css">
<script type="text/javascript">
  $(document).ready(function() {
  $('.image-link').magnificPopup({type:'image'});
});
</script>

 <script type="text/javascript">
$(document).ready(function(){
$(".busca").keyup(function(){ //se crea la funcioin keyup
var texto = $(this).val();//se recupera el valor de la caja de texto y se guarda en la variable texto
var dataString = 'palabra='+ texto;//se guarda en una variable nueva para posteriormente pasarla a busqueda.php

if(texto==''){//si no tiene ningun valor la caja de texto no realiza ninguna accion
    var AllProd='AllProd';
        var miUser = 'AllProd='+ AllProd;
        $.ajax({
            type:"Post",
            url:"FiltroOrdenesProd.php",
            data:miUser,
            success: function(html){//funcion que se activa al recibir un dato
$("#Referencias").html(html).show();// funcion jquery que muestra el div con identificador display, como formato html, tambien puede ser .text
}
        });
}else{

//pero si tiene valor entonces
$.ajax({//metodo ajax
type: "POST",//aqui puede  ser get o post
url: "FiltroOrdenesProd.php",//la url adonde se va a mandar la cadena a buscar
data: dataString,
//cache: false,
success: function(html){//funcion que se activa al recibir un dato
$("#Referencias").html(html).show();// funcion jquery que muestra el div con identificador display, como formato html, tambien puede ser .text
}
});

}
return false;    
});
});
</script>

  <script type="text/javascript">
    $(document).ready(function(){
        var AllProd='AllProd';
        var miUser = 'AllProd='+ AllProd;
        $.ajax({
            type:"Post",
            url:"FiltroOrdenesProd.php",
            data:miUser,
            success: function(html){//funcion que se activa al recibir un dato
$("#Referencias").html(html).show();// funcion jquery que muestra el div con identificador display, como formato html, tambien puede ser .text
}
        });
    });
</script>


 <script>
$(document).ready(function(){
    $("#AjaxPendiente").click(function(){
       var ValPendiente='1';
       var miUser2 = 'ValPendiente='+ ValPendiente;
      //alert (ValPendiente);
      $.ajax({
            type:"Post",
            url:"FiltroOrdenesProd.php",
            data:miUser2,
            success: function(html){//funcion que se activa al recibir un dato
$("#Referencias").html(html).show();// funcion jquery que muestra el div con identificador display, como formato html, tambien puede ser .text
}
        });
        return false;
    });
});
</script>

<script>
$(document).ready(function(){
    $("#AjaxProduccion").click(function(){
       var ValPendiente='2';
       var miUser2 = 'ValPendiente='+ ValPendiente;
      //alert (ValPendiente);
      $.ajax({
            type:"Post",
            url:"FiltroOrdenesProd.php",
            data:miUser2,
            success: function(html){//funcion que se activa al recibir un dato
$("#Referencias").html(html).show();// funcion jquery que muestra el div con identificador display, como formato html, tambien puede ser .text
}
        });
        return false;
    });
});
</script>

<script>
$(document).ready(function(){
    $("#AjaxAcabados").click(function(){
       var ValPendiente='3';
       var miUser2 = 'ValPendiente='+ ValPendiente;
      //alert (ValPendiente);
      $.ajax({
            type:"Post",
            url:"FiltroOrdenesProd.php",
            data:miUser2,
            success: function(html){//funcion que se activa al recibir un dato
$("#Referencias").html(html).show();// funcion jquery que muestra el div con identificador display, como formato html, tambien puede ser .text
}
        });
        return false;
    });
});
</script>

<script>
$(document).ready(function(){
    $("#AjaxEspera").click(function(){
       var ValPendiente='0';
       var miUser2 = 'ValPendiente='+ ValPendiente;
      //alert (ValPendiente);
      $.ajax({
            type:"Post",
            url:"FiltroOrdenesProd.php",
            data:miUser2,
            success: function(html){//funcion que se activa al recibir un dato
$("#Referencias").html(html).show();// funcion jquery que muestra el div con identificador display, como formato html, tambien puede ser .text
}
        });
        return false;
    });
});
</script>

 
<script type="text/javascript">
    $("#Impresion").click(function(){
    // var ValorCod = $("#ValorCod<?php echo $Id_Insumo;?>").val();
    // var Nombre = $("#NombreInsumo<?php echo $Id_Insumo;?>").val();
    // var ImgInsumo = $("#UrlInsumo<?php echo $Id_Insumo;?>").val();
    // var PromInsumo = $("#Promedio<?php echo $Id_Insumo;?>").val();
    // var UnidadInsumo = $("#Unidad<?php echo $Id_Insumo;?>").val();

    sweetAlert({
  title: "Oops!", 
    text: "Something went wrong on the page!", 
    type: "error"
});
     });
</script>



<style>  
    
   #caja_busqueda /*estilos para la caja principal de busqueda*/
{
width:400px;
height:25px;
border:solid 2px #979DAE;
font-size:16px;
}
#display /*estilos para la caja principal en donde se puestran los resultados de la busqueda en forma de lista*/
{
width:300px;
display:none;
overflow:hidden;
z-index:10;
border: solid 1px #666;
}
.display_box /*estilos para cada caja unitaria de cada usuario que se muestra*/
{
padding:2px;
padding-left:6px; 
font-size:18px;
height:63px;
text-decoration:none;
color:#3b5999; 
}

.display_box:hover /*estilos para cada caja unitaria de cada usuario que se muestra. cuando el mause se pocisiona sobre el area*/
{
background: #415AB5;
color: #FFF;
}
.desc
{
color:#666;
font-size:16;
}
.desc:hover
{
color:#FFF;
}
           </style> 

    <?php include("Lib/Favicon.php") ?>
    <?php 

    $sql="SELECT Id_Not_Push, Usuario_Id_Usuario_Envia, Usuario_Id_Usuario_Recibe, Mensaje_Push, Fecha_Mensaje_Push, Estado_Mensaje_Push, Leido_Mensaje_Push FROM t_notificaciones_push WHERE Usuario_Id_Usuario_Recibe='".$IdUser."'";
    $result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    $Id_Not_Push=$row['Id_Not_Push']; 
    $Mensaje_Push=$row['Mensaje_Push']; 
    $Fecha_Mensaje_Push=$row['Fecha_Mensaje_Push']; 
   
    $tem='<script type="text/javascript">
        Push.create("Notificación Modasof",{
            body:"'.$Mensaje_Push.'",
            icon:"../Administrator/Images/favicon/favicon-96x96.png",
            timeout: 500000,
            requireInteraction:true,
            vibrate:[400,200],
            onClick: function(){
                window.location="perfil.php?TAB=tabs-2"
               this.close();
            }
        });
    </script>
    '  ;
   //Echo($tem); 
    }
}

     ?>

	</head>

	<body class="skin-1">

	<?php 
  $Valide=$_GET['Mensaje'];

    if ($Valide==232) {
        echo "<script>jQuery(function(){swal(\"¡Lo Sentimos!\", \"Datos Incorrectos\", \"error\");});</script>";
    };
    if ($Valide==1) {
        echo "<script>jQuery(function(){swal(\"¡ Comentario Agregado!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==2) {
        echo "<script>jQuery(function(){swal(\"¡ Comentario Actualizado!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==3) {
        echo "<script>jQuery(function(){swal(\"¡ Orden Asignada a Sastre!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==4) {
        echo "<script>jQuery(function(){swal(\"¡ Orden en estado acabados!\", \"Correctamente \", \"success\");});</script>";
    };
     if ($Valide==5) {
        echo "<script>jQuery(function(){swal(\"¡ Orden enviada al centro de Distribución!\", \"Correctamente \", \"success\");});</script>";
    };
     if ($Valide==6) {
        echo "<script>jQuery(function(){swal(\"¡ Solicitud Actualizada!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==23) {
        echo "<script>jQuery(function(){swal(\"¡ Comentario Actualizado!\", \"".$ClienteSel." \", \"success\");});</script>";
    };
   ?>

	<?php 
	include("Lib/Alertas.php")
	 ?>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<?php 
	include("Lib/links.php");
	include("Lib/menuleft.php");
?>

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
						
							<li>
								<i class="ace-icon fa fa-industry"></i>
								<a href="SolicitudesProduccion.php">Solicitudes</a>
							</li>
            </ul><!-- /.breadcrumb -->

						
					</div>

					<div class="page-content">
				<?php 
					//include("Lib/colors.php");
				?>
						<div class="row">

						
							<div class="col-xs-12 col-sm-12">


				<div class="col-sm-12 col-xs-12"><!-- Inicio Panel Inferior-->
					<hr>
					<div class="row">
					<!-- <div class="col-sm-4 col-xs-12" >
					
                    <div class="card earning-widget">
                        <div class="card-body">
                            <div class="card-title">
                             <div >
     <input type="text" class="busca nav-search-input input-sm"   id="caja_busqueda nav-search-input" name="clave" placeholder="Buscar Solicitud"/>
    
      
  </div>
 
                                    
                                <div class="d-flex">
                                    <span>
                                <h4 class="card-title m-b-0">Ordenes de Producción</h4>
                              </span>
                                    
                                </div>
                            </div>
                        </div>
                <div class="row" id="Referencias">    
                </div>
                      
                    </div>
					</div> -->

                    <div class="col-sm-12 col-xs-12" style="border: 1px dotted black;">
                <?php 
                $SolicitudSelect=$_GET['Solicitud'];

    //***************************************************************************************************
   $sql ="SELECT date_format(Fecha_Solicitud,CONCAT(CONCAT(ELT(WEEKDAY(Fecha_Solicitud) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(Fecha_Solicitud), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS CreadaFecha,B.Nombres,B.Apellidos,B.Img_Perfil,Id_Solicitud_Prod, C.Id_Bodega,C.Nom_Bodega, Cant_Solicitada, D.Nom_Talla,  Referencia_Id_Referencia, Estado_Solicitud_Prod, Fecha_Solicitud,Sastre_Id_Usuario, F.Tipo_Referencia FROM t_solicitudes_prod AS A, t_usuarios as B, t_bodegas as C, t_tallas as D, t_referencias as F WHERE Cod_Solicitud_Prod='".$SolicitudSelect."' AND A.Solicitud_Id_Usuario=B.Id_Usuario and A.Bodega_Id_Bodega=C.Id_Bodega and A.Talla_Solicitada=D.Id_Talla  and A.Referencia_Id_Referencia=F.Cod_Referencia  ORDER BY UNIX_TIMESTAMP(Fecha_Solicitud) DESC"; 
    //Echo($sql); 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    $CreadaFecha=$row['CreadaFecha']; 
    $Fecha_Solicitud=$row['Fecha_Solicitud']; 
    $Nombres=$row['Nombres']; 
    $Apellidos=$row['Apellidos']; 
    $Img_Perfil=$row['Img_Perfil']; 
    $Id_Solicitud_Prod=$row['Id_Solicitud_Prod'];   
    $Nom_Bodega=$row['Nom_Bodega'];
     $Id_Bodega=$row['Id_Bodega'];
    $Cant_Solicitada=$row['Cant_Solicitada'];
    $NumeroPrendas=$row['Cant_Solicitada'];
    $Nom_Talla=$row['Nom_Talla'];
     
    $Referencia_Id_Referencia=$row['Referencia_Id_Referencia'];
    $Estado_Solicitud_Prod=$row['Estado_Solicitud_Prod'];
    $Sastre=$row['Sastre_Id_Usuario'];
    $Tipo_Referencia=$row['Tipo_Referencia'];

   

    $date = new DateTime($Fecha_Solicitud);
      }
    }

  //***************************************************************************************************
   $sql ="SELECT Img_Referencia,Coleccion_Nom_Coleccion,Insumo_Ppal,Cod_Referencia FROM t_referencias  WHERE Cod_Referencia='".$Referencia_Id_Referencia."'"; 
    //Echo($sql); 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    $Img_Referencia=$row['Img_Referencia'];
    $Coleccion_Nom_Coleccion=$row['Coleccion_Nom_Coleccion'];
    $Insumo_Ppal=$row['Insumo_Ppal']; 
    $Cod_Referencia=$row['Cod_Referencia'];
    
      }
    }


  //***************************************************************************************************
    // Seleccionar el tipo de prenda que se está elaborando
  //***************************************************************************************************
   $sql ="SELECT Categoria_Id_Categoria_Prod  FROM t_referencias  WHERE Cod_Referencia='".$Referencia_Id_Referencia."'"; 
    //Echo($sql); 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    $Categoria_Id_Categoria_Prod=$row['Categoria_Id_Categoria_Prod'];  
      }
    }




date_default_timezone_set("America/Bogota");
$MarcaTemporal = date('Y-m-d H:i:s');


                if ($SolicitudSelect=="") {
                Echo("<h1 class='center' style='color:#8E8B8A;''>Seleccione la orden que desea ver <i class='fa fa-search'></i></h1>");
                }
                else
                {
        Echo("<h2 style='color:#8E8B8A;''> Orden de Producción Nº SLP".$SolicitudSelect."<span class='pull-right badge bg-green'>Días Transcurridos ".dias_transcurridos($Fecha_Solicitud,$MarcaTemporal)."</span></h2><h4>".$Referencia_Id_Referencia."-".$Nom_Talla."<span class='red'> ".$Cant_Solicitada." Und.</span></h4>");   
                
                 ?>
                        
                        <!-- Column -->
                    <div class="col-lg-3 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">

            <center class="m-t-30"> <img src="<?php Echo($Img_Referencia); ?>" class="img-circle" width="150" />
                                  <?php 
          if ($Tipo_Referencia==2) {

            if ($Estado_Solicitud_Prod==6) {
              ?>
               <span class='label' style='background-color:"#00a65a"'>Acabados</span> <span class='action-icons'></span>
                                  <hr>
                    <form method="post" action="Panel-Produccion.php?CambioEstado=8" id="FormSastre" >
                       <input type="text" name="TxtRef" value="<?php Echo($Referencia_Id_Referencia); ?>" style="display: none;">
   <input type="text" name="TxtBodega" value="<?php Echo($Id_Bodega); ?>" style="display: none;">
                    <input type="text" name="TxtOrdenNumero" value="<?php Echo($SolicitudSelect); ?>" style="display: none;">
                     <input type="text" name="TxtCantidad" value="<?php Echo($Cant_Solicitada); ?>" style="display: none;">
   <input type="text" name="TxtTipoPrenda" value="<?php Echo($Categoria_Id_Categoria_Prod); ?>" style="display: none;">
     <input type="text" name="TxtSastreAsignado" value="<?php Echo($Sastre); ?>" style="display: none;">

                                 <select required="true" name="TxtSastre">
                                   <option value="">Cambiar Estado</option>
                                  <option value="4">Centro de Distribucción</option>
                                 </select>
                                 <div>
                                 <button type="submit" class="btn btn-xs btn-success"><i class="fa fa-refresh"></i></button>
                                 </div>
                                 </form>


              <?php
            }
            else if ($Estado_Solicitud_Prod==4)
            {

            }
            else
            {

            ?>

                      <span class="label label-danger">Estado <?php Echo($NomEstado); ?></span> <span class="action-icons"></span>
                                  <hr>
  <form method="post" action="Panel-Produccion.php?CambioEstado=5" id="FormProveedor" >
   <input type="text" name="TxtOrdenNumero" value="<?php Echo($SolicitudSelect); ?>" style="display: none;">
   <input type="text" name="TxtCantidad" value="<?php Echo($Cant_Solicitada); ?>" style="display: none;">
   <input type="text" name="TxtTipoPrenda" value="<?php Echo($Categoria_Id_Categoria_Prod); ?>" style="display: none;">


                                 <select required="true" name="TxtSastre">
                                   <option value="">Verificar Insumo</option>
                                   <option value="5">Solicitado a Proveedor</option>
                                 </select>
                                 <div>
                                 <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-refresh"></i></button>
                                 </div>
                                 </form>
                                    <?php
                                     }
          }
          else
          {
      //*******************************************************************************************************************
      //****        Estados de Solicitud (Lista de Espera==0 pasa a Selección Sastre y descuenta de Inventario)     *******
      //*******************************************************************************************************************
                            if ($Estado_Solicitud_Prod==0) {
                                    ?>
                      <span class="label label-danger">Estado <?php Echo($NomEstado); ?></span> <span class="action-icons"></span>
                                  <hr>
  <form method="post" action="Panel-Produccion.php?CambioEstado=7" id="FormSastre" >
   <input type="text" name="TxtOrdenNumero" value="<?php Echo($SolicitudSelect); ?>" style="display: none;">
   <input type="text" name="TxtCantidad" value="<?php Echo($Cant_Solicitada); ?>" style="display: none;">
   <input type="text" name="TxtTipoPrenda" value="<?php Echo($Categoria_Id_Categoria_Prod); ?>" style="display: none;">
   <input type="text" name="TxtRef" value="<?php Echo($Referencia_Id_Referencia); ?>" style="display: none;">
   <input type="text" name="TxtBodega" value="<?php Echo($Id_Bodega); ?>" style="display: none;">



                                 <select required="true" name="TxtSastre">
                                   <option value="">Seleccionar Estado...</option>
                                   <option value="1">Asignar a Sastres</option>

                                 </select>
                                 <div>
                                 <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-refresh"></i></button>
                                 </div>
                                 </form>
                                    <?php
                                  }
    //*******************************************************************************************************************
    //****************          Estados de Solicitud (Pendiente==1 pasa a Sastre Seleccionado =2)       *****************
    //******************************************************************************************************************* 
                                  else if ($Estado_Solicitud_Prod==1) {
                                    ?>
                                     <span class="label label-danger">Estado <?php Echo($NomEstado); ?></span> <span class="action-icons"></span>
                                  <hr>
  <form method="post" action="Panel-Produccion.php?CambioEstado=1" id="FormSastre" >
   <input type="text" name="TxtOrdenNumero" value="<?php Echo($SolicitudSelect); ?>" style="display: none;">
   <input type="text" name="TxtCantidad" value="<?php Echo($Cant_Solicitada); ?>" style="display: none;">
   <input type="text" name="TxtTipoPrenda" value="<?php Echo($Categoria_Id_Categoria_Prod); ?>" style="display: none;">


                                 <select required="true" name="TxtSastre">
                                   <option value="">Seleccionar...</option>
                                   <option value="1"> Asignar Sastres</option>
                                    <option value="7"> Centro de Distribución</option>
                                  

                                 </select>
                                 <div>
                                 <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-refresh"></i></button>
                                 </div>
                                 </form>
                                
                                  <?php
    //*******************************************************************************************************************
    //****************          Estados de Solicitud (Sastre=2  pasa Acabados=3)         ********************************
    //******************************************************************************************************************* 
                                  }
                                  elseif($Estado_Solicitud_Prod==5)
                                  {
                                   ?>
                                   
                                   <span class="label label-warning">Estado <?php Echo($NomEstado); ?></span>
                                   <a href="Sastres.php?SastreSelect=<?php Echo($Sastre)?>">
                                    <span class="label label-info">
                                      
<?php 
$sql ="SELECT Nombres,Apellidos FROM t_usuarios as A, t_solicitudes_prod as B  WHERE B.Sastre_Id_Usuario=A.Id_Usuario and Cod_Solicitud_Prod='".$SolicitudSelect."'"; 
    //Echo($sql); 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
   
    $NombreSastre=$row['Nombres'];
    $ApellidoSastre=$row['Apellidos']; 
   Echo($NombreSastre." ".$ApellidoSastre);    
      }
    }
?>
                                    </span> 
                                    </a> 
                                  <hr>
                    <form method="post" action="Panel-Produccion.php?CambioEstado=3" id="FormSastre" >

              <input type="text" name="TxtOrdenNumero" value="<?php Echo($SolicitudSelect); ?>" style="display: none;">
               <input type="text" name="TxtCantidad" value="<?php Echo($Cant_Solicitada); ?>" style="display: none;">
   <input type="text" name="TxtTipoPrenda" value="<?php Echo($Categoria_Id_Categoria_Prod); ?>" style="display: none;">
     <input type="text" name="TxtSastreAsignado" value="<?php Echo($Sastre); ?>" style="display: none;">

                                 <select required="true" name="TxtSastre">
                                   <option value="">Cambiar Estado</option>
                                  <option value="3">Enviar a Acabados</option>
                                 </select>
                                 <div>
                                 <button type="submit" class="btn btn-xs btn-warning"><i class="fa fa-refresh"></i></button>
                                 </div>
                                 </form>


                                  <?php
    //*******************************************************************************************************************
    //****************          Estados de Solicitud (Acabados==3 pasa a Centro de Distribucción==4)        ****************
    //*******************************************************************************************************************  
                                }
                            
                                  elseif($Estado_Solicitud_Prod==6)
                                  {
                                   ?>
                                   
                                   <span class='label' style='background-color:"#00a65a;"'>En Acabados</span> <span class='action-icons'></span>
                                  <hr>
                    <form method="post" action="Panel-Produccion.php?CambioEstado=4" id="FormSastre" >


                    <input type="text" name="TxtOrdenNumero" value="<?php Echo($SolicitudSelect); ?>" style="display: none;">
                     <input type="text" name="TxtCantidad" value="<?php Echo($Cant_Solicitada); ?>" style="display: none;">
   <input type="text" name="TxtTipoPrenda" value="<?php Echo($Categoria_Id_Categoria_Prod); ?>" style="display: none;">
    

                                 <select required="true" name="TxtSastre">
                                   <option value="">Cambiar Estado</option>
                                  <option value="7">Centro de Distribucción</option>
                                 </select>
                                 <div>
                                 <button type="submit" class="btn btn-xs btn-success"><i class="fa fa-refresh"></i></button>
                                 </div>
                                 </form>


                                  <?php 
                                }
    //*******************************************************************************************************************
    //****************          Estados de Solicitud (Fin de los Estados)         ************************************************
    //******************************************************************************************************************* 
                                }
                                   ?>



                                    
                                </center>
                            </div>
                            <div>
                                 </div>
                            <div class="card-body"> <small class="text-muted">Solicitado por:</small>
                                <h6><?php Echo utf8_encode($Nombres." ".$Apellidos) ?></h6> <small class="text-muted p-t-30 db">Solicitado a Taller</small>
                                <h6><?php Echo utf8_encode($Nom_Bodega) ?></h6> 
                                 
                                <br/>
                                
                                
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-9 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Observaciones</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Detalles</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Adjuntos</a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                    <div class="card-body">

                  <form action="Panel-Produccion.php?Solicitud=<?php Echo($SolicitudSelect);?>&ValNota=1&Propietario=<?php Echo($Propietario);?>" method="post" id="validation-form">
                <div>
                      <div class="widget-box">
                        <div class="widget-header">
                          <h4 class="widget-title red">Agregar Comentario</h4>

                          <div class="widget-toolbar">
                            <a href="#" data-action="collapse">
                              <i class="ace-icon fa fa-chevron-up"></i>
                            </a>
                          </div>
                        </div>

                        <div class="widget-body">
                          <div class="widget-main">
                           <!--  <div>
                              <label for="form-field-8">Seleccionar Estado</label>
                              <select name="SelEstado">
                                <option value="">Seleccionar</option>
                                <option value="6">Aplazada</option>
                                <option value="7">En curso</option>
                                <option value="8">No Iniciada</option>
                                <option value="9">Esperando por un Tercero</option>
                                
                              </select>
                            </div> -->
                            <div>
                      
                              <!-- <label for="form-field-8">Descripción</label> -->

                              <textarea  name="MiNota" class="form-control" id="form-field-8" placeholder="Indique aquí su Comentario"></textarea>

                              <input style="display: none;" type="text" name="OrdenNumero" value="<?php Echo($SolicitudSelect)?>">
                            </div>
                            <div>
                              <button type="submit" class="btn btn-sm btn-success">
                          <i class="ace-icon fa fa-comment"></i>
                          Guardar Comentario
                        </button>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                    </div><!-- /.span -->
              </form>
                  <?php 
        $EditNote=$_GET['EditNote'];

$sql ="SELECT date_format(Fecha_Comentario,CONCAT(CONCAT(ELT(WEEKDAY(Fecha_Comentario) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(Fecha_Comentario), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS fecha,time(Fecha_Comentario) AS Mihora,Id_Comentario_Produccion, Usuario_id_usuario, Fecha_Comentario, Comentario_Prod,Nombres,Apellidos,Img_Perfil FROM t_comentarios_produccion as A, t_usuarios as B WHERE Solicitud_Cod_Orden='".$SolicitudSelect."' and A.Usuario_id_usuario=B.Id_Usuario ORDER BY UNIX_TIMESTAMP(Fecha_Comentario) DESC";  
//echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $FechaNota=$row['fecha'];
        $Hora_Timeline=$row['Mihora'];
        $InfoTimeline=$row['Comentario_Prod'];
        $Id_Timeline=$row['Id_Comentario_Produccion'];
        $Timeline_Nombres=$row['Nombres'];
        $Timeline_Apellidos=$row['Apellidos'];
        $Timeline_Imagen=$row['Img_Perfil'];


?>
                                <div id="timeline-<?php Echo($Id_Timeline) ?>">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-11 ">
                                            <div class="timeline-container">
                                                <div class="timeline-label">
                                                    <span class="label label-primary arrowed-in-right label-lg">
                                                        <b><?php echo("$FechaNota"); ?></b>
                                                    </span>
                                                </div>

                                                <div class="timeline-items">
                                                    <div class="timeline-item clearfix">
                                                        <div class="timeline-info">
                                                            <img alt="<?php Echo($Timeline_Nombres); ?>" src="../Administrator/<?php Echo($Timeline_Imagen) ?>" />
                                                            <span class="label label-info label-sm"><?php Echo($Hora_Timeline); ?></span>
                                                        </div>
                                                        <div class="widget-box transparent">
                                                            <div class="widget-header widget-header-small">
                                                                <h5 class="widget-title smaller">
                                                                    <a href="#" class="blue"><?php Echo utf8_encode($Timeline_Nombres." ".$Timeline_Apellidos) ?></a>
                                                                    <!-- <span class="grey">reviewed a product</span> -->
                                                                </h5>
                                                                <span class="widget-toolbar no-border">
                                                                    <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                                                    <?php Echo($Hora_Timeline); ?>
                                                                </span>

                                                                <span class="widget-toolbar">
                                                                    <a href="#" data-action="collapse">
                                                                        <i class="ace-icon fa fa-chevron-up"></i>
                                                                    </a>
                                                                </span>
                                                        </div>

                                                            <div class="widget-body">
                                                                <div class="widget-main">
                                                                    <?php Echo utf8_encode($InfoTimeline); ?>
                                                                    
                                                                    <div class="space-6"></div>

                                                                    <div class="widget-toolbox clearfix">
                                                                        <!-- <div class="pull-left">
                                                                            <i class="ace-icon fa fa-hand-o-right grey bigger-125"></i>
                                                                            <a href="#" class="bigger-110">Click to read &hellip;</a>
                                                                        </div> -->

                                                                        <div class="pull-right action-buttons">
                                                                            <?php 
                                                                            if ($EditNote==1) {
                                                                                ?>

                                                                            <a href="Panel-Produccion.php?Solicitud=<?php echo($SolicitudSelect);?>&Propietario=<?php echo($Propietario);?>" class="tooltip-success green" data-rel="tooltip" data-placement="top" title="Cancelar Edición">
                                                                                <i class="ace-icon fa fa-close red bigger-130"></i>
                                                                            </a>
                                                                            <?php
                                                                            }
                                                                             ?>

                                                                            <a href="Panel-Produccion.php?Solicitud=<?php echo($SolicitudSelect);?>&EditNote=1&Propietario=<?php Echo($Propietario);?>">
                                                                                <i class="ace-icon fa fa-pencil blue bigger-125"></i>
                                                                            </a>

                                                                            <?php 
                                                                            if ($Val_Editar==1) {
                                                                                ?>
                                                                                <a href="Panel-Produccion.php?Solicitud=<?php echo($SolicitudSelect);?>&DeleteNote=1&NoteDel=<?php Echo($Id_Timeline);?>&Propietario=<?php echo($Propietario);?>">
                                                                                <i class="ace-icon fa fa-trash-o red bigger-125"></i>
                                                                            </a>
                                                                            <?php
                                                                            }
                                                                             ?>

                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <?php 

              if ($EditNote==1) {
                ?>

                  <form  action="Produccion-UpdateComentario.php?Solicitud=<?php Echo($SolicitudSelect); ?>" method="post">
                        <div class="widget-body">
                  
                          <div class="widget-main">
                            <div>

                        <textarea  name="EditMiNota" class="form-control" id="form-field-8" placeholder="Indicar observaciones acerca de la actividad asignada"><?php Echo utf8_encode($InfoTimeline); ?></textarea>
                        <input style="display: none;" type="text" name="IdTimeline" value="<?php Echo($Id_Timeline); ?>">
                          <input style="display: none;" type="text" name="IdTareaSel" value="<?php Echo($SolicitudSelect); ?>">

                            </div>
                            <div>
                            </div>
                            
                          </div>
                          <button type="submit" class="btn btn-sm btn-success">
                          <i class="ace-icon fa fa-check"></i>
                          Actualizar Comentario
                        </button>
                    
                        </div>
                  </form>
              <?php
              }
               ?>
                
                            
                                
                                            
                                    
                                                        </div>
                                                    </div>

                                                </div><!-- /.timeline-items -->
                                            </div><!-- /.timeline-container -->
                                        </div>

                                    </div>
                                </div>
                              <?php 
                            }
                          }

                               ?>
                                    </div>
                                </div>
                                <!--second tab-->
                                <?php 


                                 ?>
                                <div class="tab-pane" id="profile" role="tabpanel">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-5 col-xs-6 b-r"> <strong>Nombre Colección</strong>
                                                <br>
                                                <p class="text-muted"><?php Echo($Coleccion_Nom_Coleccion); ?></p>
                                            </div>
                                           
                                            <div class="col-md-3 col-xs-6 b-r"> <strong>Insumo Ppal</strong>
                                                <br>
                                                <p class="text-muted">Cód: <?php Echo($Insumo_Ppal); ?></p>
                                            </div>
                                            <div class="col-md-3 col-xs-6"> <strong>Ref:</strong>
                                                <br>
                                                <p class="text-muted"><?php Echo($Cod_Referencia); ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                  <h3>Detalle Insumos x 1 Prenda</h3>  
                <div class="table-responsive">  
                     <table class="table table-bordered"> 
                     <thead> 
                          <tr class="info">  
                              <th width="10%">Img.</th>
                               <th width="10%">Código</th>
                                <th width="25%">Nombre Insumo </th>  
                               <th class="center" width="8%">Cantidad</th> 
                                
                          </tr> 
                       </thead>
                       <tbody id="tablainsumos">
                        <?php 
              $sql="SELECT A.Cod_Insumo,B.Unidad_Insumo, Cant_Solicitada,B.Url_Insumo,B.Nom_Insumo FROM t_insumos_ref as A, t_insumos as B WHERE Referencia_Cod_Referencia='".$Cod_Referencia."' and A.Cod_Insumo=B.Cod_Insumo";
              $result=$conexion->query($sql);
              if ($result->num_rows > 0 ) {
               while ($row = $result->fetch_assoc()) {
                 $Url_Insumo=$row['Url_Insumo'];
                 $Cod_Insumo=$row['Cod_Insumo'];
                 $Nom_Insumo=$row['Nom_Insumo'];
                 $Cant_Solicitada=$row['Cant_Solicitada'];
                 $Unidad_Insumo=$row['Unidad_Insumo'];
                         ?>
                        <tr>
                          <td><a class="image-link" href="<?php echo utf8_encode($Url_Insumo); ?>"><img src="<?php echo utf8_encode($Url_Insumo); ?>" width="40px" height="40px"></a></td>
                          <td><?php Echo($Cod_Insumo) ?></td>
                          <td><?php Echo($Nom_Insumo) ?></td>
                          <td><?php Echo($Cant_Solicitada." ".$Unidad_Insumo) ?></td>
                        </tr>
                    <?php 
                  }
                }
                     ?>
                          
                     </tbody> 
              
                
           </table>  
       </div>
                                        
                                    </div>
                                </div>
                                <div class="tab-pane" id="settings" role="tabpanel">
                                    <div class="card-body">
                                       <a href="Ficha_Producto_Modasof.php?Ref=<?php Echo($Referencia_Id_Referencia); ?>&Solicitud=<?php Echo($SolicitudSelect); ?>" class="btn btn-xlarge btn-white"><i class="fa fa-file-pdf-o red">  </i> Descargar Ficha Técnica</a>
                                       
                                      
                                       <!--  <a href="barcode.php?text=<?php Echo($Referencia_Id_Referencia."-".$Nom_Talla) ?>&size=50&orientation=horizontal&codetype=Code128&print=true" class="btn btn-xlarge btn-white"><i class="fa fa-barcode red">  </i> Imprimir Código de Barras </a> -->
                                    </div>
                                    <hr>
                                     <div id="CodigoBarras">
                                      <form action="Sticker_Codigos.php" method="post">

                                <input type="text" name="TxtNumSticker" value="<?php Echo($NumeroPrendas)?>" style="display: none;" >
                                 <input type="text" name="OrdenNumero" value="<?php Echo($SolicitudSelect)?>" style="display: none;">
                                  <button id="Impresion" class="btn btn-xlarge btn-white"><i class="fa fa-barcode red">  </i> Imprimir Etiquetas</button>
                                     <div class="form-group">
                              <label for="form-field-select-3">Seleccione la ubicación en la hoja</label>

                              <div>

                        <select class="chosen-select input-xlarge" required="true" name="TxtUbicacion" data-placeholder="Seleccionar...">
                            <option value="">Seleccionar...</option>
                            <?php 
                            for ($i=1; $i <45 ; $i++) { 
                              Echo("<option value='".$i."'>".$i."</option>");
                            }
                             ?>
                                  
                        </select>
                         <img src="images/IconosFactura/codigos.jpg">
                              </div>
                            
                      </div>
                                     
                                      </form>
                                      </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
        <?php 
}
         ?>
                    </div>
				
					<!-- <div class="col-sm-12 col-xs-12">
						
								<div id="grafica" style="width: 100%; height: 450px;">
									
								</div>
								 
					</div> -->
</div>

				
							
				</div><!-- Fin Panel Inferior -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<?php 
	include("Lib/footer.php")
	 ?>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!--[if !IE]> -->
		<script src="https://modasof.com/espejo/assets/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="https://modasof.com/espejo/assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='https://modasof.com/espejo/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="https://modasof.com/espejo/assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="https://modasof.com/espejo/assets/js/excanvas.min.js"></script>
		<![endif]-->
		
		<!-- ace scripts -->
		<script src="https://modasof.com/espejo/assets/js/ace-elements.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/ace.min.js"></script>

		<script src="https://modasof.com/espejo/assets/js/echarts.min.js"></script>
		
		<script src="https://modasof.com/espejo/assets/js/jquery.dataTables.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/dataTables.buttons.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/buttons.flash.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/buttons.html5.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/buttons.print.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/buttons.colVis.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/dataTables.select.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/pdfmake.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/vfs_fonts.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jszip.min.js"></script>
		
		<script src="https://modasof.com/espejo/assets/js/jquery.validate.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery-additional-methods.min.js"></script>

		<script src="https://modasof.com/espejo/assets/js/dataTables.responsive.min.js"></script>
  
		<!--    <script src="dist/js/demo.js"></script> -->
    <script src="https://modasof.com/espejo/assets/js/jquery.magnific-popup.js"></script>
    <script src="https://modasof.com/espejo/assets/js/jquery.magnific-popup.min.js"></script>

	<script type="text/javascript">
        // based on prepared DOM, initialize echarts instance
        var myChart = echarts.init(document.getElementById('grafica'));

        // specify chart configuration item and data
      option = {
    title: {
        text: ''
    },
    tooltip : {
        trigger: 'axis',
        axisPointer: {
            type: 'cross',
            label: {
                backgroundColor: '#6a7985'
            }
        }
    },
    legend: {
        data:['Camisas','Pantalones','Bermudas','Camisetas','Producción']
    },
    toolbox: {
        feature: {
            saveAsImage: {}
        }
    },
    grid: {
        left: '3%',
        right: '4%',
        bottom: '3%',
        containLabel: true
    },
    xAxis : [
        {
            type : 'category',
            boundaryGap : false,
            data : ['Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto']
        }
    ],
    yAxis : [
        {
            type : 'value'
        }
    ],
    series : [
        {
            name:'Camisas',
            type:'line',
            stack: '总量',
            areaStyle: {normal: {}},
            data:[120, 132, 101, 134, 90, 230, 210]
        },
        {
            name:'Pantalones',
            type:'line',
            stack: '总量',
            areaStyle: {normal: {}},
            data:[220, 182, 191, 234, 290, 330, 310]
        },
        {
            name:'Bermudas',
            type:'line',
            stack: '总量',
            areaStyle: {normal: {}},
            data:[150, 232, 201, 154, 190, 330, 410]
        },
        {
            name:'Camisetas',
            type:'line',
            stack: '总量',
            areaStyle: {normal: {}},
            data:[320, 332, 301, 334, 390, 330, 320]
        },
        {
            name:'Producción',
            type:'line',
            stack: '总量',
            label: {
                normal: {

                    show: true,
                    color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                        offset: 0,
                        color: '#3023AE'
                    }, {
                        offset: 1,
                        color: '#C96DD8'
                    }]),
                    position: 'top'
                },
            },
            areaStyle: {normal: {
            	color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                        offset: 0,
                        color: '#3023AE'
                    }, {
                        offset: 1,
                        color: '#C96DD8'
                    }]),
            }},
            data:[820, 932, 901, 934, 1290, 1330, 1320]
        }
    ]
};


        // use configuration item and data specified to show chart
        myChart.setOption(option);
    </script>

	
	</body>
</html>
