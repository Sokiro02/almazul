<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');



$Id_Referencia = $_POST['TxtInsumoSel'];
$Talla_Id = $_POST['TxtTalla'];
$TxtCantidad = $_POST['TxtCantidad'];
$IdTiendaOrigen = $_POST['IdTiendaOrigen'];
$IdTiendaDestino = $_POST['IdTiendaDestino'];

if (is_null($Id_Referencia)){
    echo "false id_referencia";
    exit;
}
if (is_null($Talla_Id)){
    echo "false talla_id";
    exit;
}
if (is_null($IdTiendaOrigen)){
    echo "false tienda origen";
    exit;
}
if ($TxtCantidad==0){
    echo "false cantidad";
    exit;
}
if (is_null($IdTiendaDestino)){
    echo "false tienda destino";
    exit;
}



$var1  = $Id_Referencia;
$porciones = explode("-", $var1);
$Codigo_Referencia=$porciones[0]; // Codigo_Referencia
$Id_Referencia = $porciones[1]; // Id de la Referencia
$Nombre_Talla = $porciones[2]; // Nombre de la Talla
$Talla_Id= $porciones[3]; // Nombre de la Talla
$Cantidads= $porciones[4]; // Cantidad en Existencia
$Referencia_Completa = $Codigo_Referencia."-".$Nombre_Talla; 

$aprobado = "";
$status = "PROCESANDO";

$sqlbuscarreferencia="SELECT * FROM t_referencias WHERE Cod_Referencia = '".$Codigo_Referencia."'";
$Resulta = $conexion->query($sqlbuscarreferencia);
$row = $Resulta->fetch_assoc();
    $Cod_Referencia=$row['Cod_Referencia'];
    $Img_Referencia=$row['Img_Referencia'];

if($_POST){
    $sqlinsertar = "INSERT INTO t_traslados_detalle 
    (id,imagen,cod_referencia,cod_ref_completa,talla_id,cantidad,id_traslado,
    aprobado,status,id_tienda_desde,id_tienda_hasta,id_user) 
    VALUES 
    ('','".$Img_Referencia."','".$Codigo_Referencia."','".$Referencia_Completa."','".$Talla_Id."','".$TxtCantidad."','0','".$aprobado."',
    '".$status."','".$IdTiendaOrigen."','".$IdTiendaDestino."','".$IdUser."')"; 
    $resultados = $conexion->query($sqlinsertar) or die('Error al insertar datos:'.mysqli_error($conexion));;
     if ($resultados){
        echo "true";  
        include("Lib/seguridad.php");
        $Datos="Se agrego una referencia al traslado con ID ".$Codigo_Referencia;
        $Paginas= $_SERVER['PHP_SELF'];
        $seguridad = AgregarLog($IdUser,$Datos,$Paginas);        
          
     }else{
        echo "false";
     }
}

