<?php
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
include("Lib/seguridad.php");

//RECOGER INFORMACIÒN DE DESPACHOSM.PHP
$IdUser=$_SESSION['IdUser'];
$id_tienda = $_GET['IDTIENDA'];
$NomTienda = $_GET['NomTienda'];
$status = "DESPACHADO";  //ESTE ESTATUS DEBE CAMBIAR A RECIBIDO CUANDO EN LA TIENDA LES LLEGUE LA MERCANCIA


if (empty($id_tienda)){
    header("location:DespachosM.php?TxtTienda=".$id_tienda."&Mensaje=66&TxtNomTienda=".$NomTienda);
}

if (empty($$NomTienda)){
    header("location:DespachosM.php?TxtTienda=".$id_tienda."&Mensaje=66&TxtNomTienda=".$NomTienda);
}

$sql="INSERT INTO t_temporal_inventario_despachos(id_user,id_tienda,Nom_tienda,status_despacho)
    VALUES
    ('".$IdUser."','".$id_tienda."','".utf8_decode($NomTienda)."','".$status."')";
$resultado = $conexion->query($sql) or die('Error:'.mysqli_error($conexion));
if ($resultado){
    $consultar = "SELECT MAX(`id_despacho`) as ultimo FROM `t_temporal_inventario_despachos` WHERE id_user='".$IdUser."' ";
    $resultados = $conexion->query($consultar) or die('Error:'.mysqli_error($conexion));
    if($resultados->num_rows>0){
    	while ($row = $resultados->fetch_assoc()) {
    	   $COD_DESPACHO = $row['ultimo'];
        }
     }    
    $consulta = "UPDATE t_temporal_inventario SET status_recibido='ENVIADO',id_despacho='".$COD_DESPACHO."' 
        WHERE 
        id_user='".$IdUser."' and status_recibido='PROCESANDO' and id_tienda='".$id_tienda."'";
    $result = $conexion->query($consulta) or die('Error:'.mysqli_error($conexion));
    
    $Pagina= $_SERVER['PHP_SELF'];
    $Datos="Se guardo el despacho a la tienda ".$NomTienda." y se cambio el Status a Despachado";
    $seguridad = AgregarLog($IdUser,$Datos,$Pagina);

    header("location:DespachosM.php?TxtTienda=".$id_tienda."&Mensaje=65&TxtNomTienda=".$NomTienda);
}else{
    header("location:DespachosM.php?TxtTienda=".$id_tienda."&Mensaje=66&TxtNomTienda=".$NomTienda);
}
?>