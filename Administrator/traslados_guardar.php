<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');

$IdTiendaOrigen = $_POST['IdTiendaOrigen'];
$IdTiendaDestino = $_POST['IdTiendaDestino'];
//status = Solicitado,Rechazado,Enviado,Recibido,(En el status recibido, ya guarda el movimiento en t_inventario_ref)
$status = "SOLICITADO";

if ($IdTiendaOrigen=='undefined' or $IdTiendaOrigen==''){
    echo "false IdTiendaOrigen";
    exit;
}
if ($IdTiendaDestino=='undefined' or $IdTiendaDestino==''){
    echo "false IdTiendaDestino";
    exit;
}
$sqlbuscartraslados="SELECT * FROM t_traslados_detalle 
                        WHERE 
                        id_user='".$IdUser."' and 
                        id_tienda_desde='".$IdTiendaOrigen."' and
                        id_tienda_hasta='".$IdTiendaDestino."' and
                        status = 'PROCESANDO'
                        ";
$resultado = $conexion->query($sqlbuscartraslados) or die('Error:'.$sqlbuscartraslados." ".mysqli_error($conexion));
if ($resultado->num_rows>0){
    $sqlinsertartraslado = "SELECT MAX(id_traslado) as id FROM t_traslados";
    $res = $conexion->query($sqlinsertartraslado ) or die('Error:'.$sqlinsertartraslado." ".mysqli_error($conexion));
    $row = $res->fetch_assoc();
    $id_traslado = $row['id'];
    $id_traslado = $id_traslado +1;
    //ACTUALIZA LOS REGISTROS DE t_traslados_detalle
    while ($fila = $resultado->fetch_assoc()){
        $sqlactualizar = "UPDATE t_traslados_detalle SET status='".$status."',
                                                        id_traslado = '".$id_traslado."'
                        WHERE 
                        id_user='".$IdUser."' and 
                        id_tienda_desde='".$IdTiendaOrigen."' and
                        id_tienda_hasta='".$IdTiendaDestino."' and
                        status = 'PROCESANDO'";
        $resultactualizar = $conexion->query($sqlactualizar) or die('Error:'.$sqlactualizar." ".mysqli_error($conexion));
        if (!$resultactualizar){
            echo "false, error al actualizar";
            exit;
        }        
    }
    //AGREGA EL REGISTRO A t_traslados
    $sql = "INSERT INTO t_traslados (status,id_tienda_desde,id_tienda_hasta,id_user) 
            VALUES ('".$status."','".$IdTiendaOrigen."','".$IdTiendaDestino."','".$IdUser."')";
    $ejecutar = $conexion->query($sql) or die('Error:'.$sql." ".mysqli_error($conexion));
    if ($ejecutar){
        include("Lib/seguridad.php");
        $Datos="Se guardo con exito el traslado con ID ".$id_traslado;
        $Paginas= $_SERVER['PHP_SELF'];
        $seguridad = AgregarLog($IdUser,$Datos,$Paginas);        
        echo "true";
    }
}else{
    echo "false no hay datos que guardar";
    exit;
}
?>