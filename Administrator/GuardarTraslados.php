<?php
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');

$Acccion = $_POST['Accion'];
$Codigo = $_POST['Codigo'];

include("Lib/seguridad.php");
$Datos="Ejecuto la acción ".$Acccion." Para el Codigo de Traslado: ".$Codigo;
$Paginas= $_SERVER['PHP_SELF'];
$seguridad = AgregarLog($IdUser,$Datos,$Paginas);

if ($Acccion=='GUARDAR'){
    $SqlGuardarTraslado ="UPDATE t_traslados 
                    SET fecha_despacho='".$TiempoActual."',
                        status='ENVIADO' 
                        WHERE id_traslado='".$Codigo."'";
    if ($conexion->query($SqlGuardarTraslado) === TRUE) {
        $SqlGuardarDetalle = "UPDATE t_traslados_detalle SET status='ACEPTADO',aprobado='SI' 
                WHERE id_traslado='".$Codigo."' and 
                    aprobado='SI' or aprobado=''";
        if ($conexion->query($SqlGuardarDetalle) === TRUE) {
            $SqlGuardarDetalle2 = "UPDATE t_traslados_detalle SET status='RECHAZADO',aprobado='NO' 
                WHERE id_traslado='".$Codigo."' and 
                    aprobado='NO'";
                    $Resultado = $conexion->query($SqlGuardarDetalle2);
            echo "true";
        } else {
            echo "Error actualizando el traslado: " . $conexion->error;
        }
    } else {
        echo "Error actualizando el traslado: " . $conexion->error;
    }
}else{
    $SqlGuardarTraslado ="UPDATE t_traslados 
                    SET fecha_despacho='".$TiempoActual."',
                        status='RECHAZADO' 
                        WHERE id_traslado='".$Codigo."'";
    if ($conexion->query($SqlGuardarTraslado) === TRUE) {
        $SqlGuardarDetalle = "UPDATE t_traslados_detalle SET status='RECHAZADO' 
                WHERE id_traslado='".$Codigo."'";
        $res = $conexion->query($SqlGuardarDetalle) or die ('Error: '.$SqlGuardarDetalle.mysqli_error($conexion));
        if ($res){
            echo "true";
        }else{
            echo "Error Actualizando los t_traslados a status RECHAZADO";
        }
    } else {
        echo "Error actualizando el traslado: " . $conexion->error;
    }    
}
?>