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
$Datos="Recibio el traslado, Para el Codigo de Traslado: ".$Codigo;
$Paginas= $_SERVER['PHP_SELF'];
$seguridad = AgregarLog($IdUser,$Datos,$Paginas);

if ($Acccion=='GUARDAR'){
    $SqlGuardarTraslado ="UPDATE t_traslados 
                    SET status='RECIBIDO',
                        fecha_recibido='".$TiempoActual."' 
                        WHERE id_traslado='".$Codigo."'";
                        
    if ($conexion->query($SqlGuardarTraslado) === TRUE) {
        $SqlGuardarDetalle = "UPDATE t_traslados_detalle SET status='RECIBIDO',aprobado='SI' 
                WHERE id_traslado='".$Codigo."' and 
                    aprobado='SI' or aprobado=''";
        $resultados = $conexion->query($SqlGuardarDetalle) or die ('Error: '.mysqli_error($conexion));;
        
        $sqla = "SELECT * FROM t_traslados_detalle WHERE id_traslado='".$Codigo."' and status='RECIBIDO'";
        $resultados2 = $conexion->query($sqla) or die ('Error: '.mysqli_error($conexion));
        if ($resultados2->num_rows>0) {
            while ($fila = $resultados2->fetch_assoc()){
                $tiendadesde = $fila['id_tienda_desde'];
                $tiendahasta = $fila['id_tienda_hasta'];
                $codigo_referencia = $fila['cod_ref_completa'];
                $cantidad = $fila['cantidad'];
                $talla_id = $fila['talla_id'];
                $referencia = $fila['cod_referencia'];
                //RESTAR EN LA TIENDA DESDE               
                $sqlinventario = "UPDATE t_inventario 
                        SET  Cantidad=Cantidad-'".$cantidad."'
                        WHERE 
                        Referencia_Completa = '".$codigo_referencia."' and
                        Id_Tienda='".$tiendadesde."'";
                $sqlrestar = $conexion->query($sqlinventario) or die('Error: '.$sqlinventario.mysqli_error($conexion));
                
                //echo $tiendadesde." ".$tiendahasta." ".$codigo_referencia." ".$cantidad." ".$referencia;
                //SUMAR EN LA TIENDA HASTA, PRIMERO VERIFICO QUE EXISTA LA REFERENCIA.
                $sql1 ="SELECT Id_Tienda,Referencia_Completa FROM t_inventario WHERE Id_Tienda='".$tiendahasta."' and Referencia_Completa='".$codigo_referencia."'" ;
                $resultados3 = $conexion->query($sql1) or die (mysqli_error($conexion));
                if ($resultados3->num_rows>0){ //SI LA REFERENCIA YA ESTA CARGADA EN EL INVENTARIO.
                    $SqlActualizar ="UPDATE t_inventario SET Cantidad=Cantidad+'".$cantidad."' WHERE Id_Tienda='".$tiendahasta."' and Referencia_Completa='".$codigo_referencia."'"; //ACTUALIZAMOS EL INVENTARIO
                    $ResultActualizar = $conexion->query($SqlActualizar)or die (mysqli_error($conexion));
                }else{ //SI LA REFERENCIA NO ESTA CARGADA EN EL INVENTARIO
                    $SqlAgregar ="INSERT INTO t_inventario(Id,Id_Tienda,Referencia,Referencia_Completa,Cantidad,Id_Talla) VALUES ('','".$tiendahasta."','".$referencia."','".$codigo_referencia."','".$cantidad."','".$talla_id."')"; //AGREGAMOS LA NUEVA REFERENCIA AL INVENTARIO
                    $ResultInsertar = $conexion->query($SqlAgregar) or die('Error: '.mysqli_error($conexion));
                }                
            }
            echo "true";
        } else {
            echo "Error actualizando el traslado: " . $conexion->error;
        }
    } else {
        echo "Error actualizando el traslado: " . $conexion->error;
    }
}else{
    echo "Error, no ingreso correctamente";
}
?>