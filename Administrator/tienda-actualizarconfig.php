<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];

// Variables de  Bodegas.php
$Consecutivo_Factura = $_POST['Consecutivo_Factura'];
$Consecutivo_ReciboCaja = $_POST['Consecutivo_ReciboCaja'];
$Consecutivo_Salidas = $_POST['Consecutivo_Salidas'];
$Consecutivo_PlanSepare = $_POST['Consecutivo_PlanSepare'];
$condiciones = $_POST['condiciones'];
$articulo = $_POST['articulo'];
$aplica_iva = $_POST['aplica_iva'];
$pedidos_activos = $_POST['pedidos_activos'];
$anticipos_activo = $_POST['anticipos_activo'];
$linea_izquierda1 = $_POST['linea_izquierda1'];
$linea_izquierda2 = $_POST['linea_izquierda2'];
$linea_izquierda3 = $_POST['linea_izquierda3'];
$Updatetienda=$_POST['Updatetienda'];
$prefijo = $_POST['prefijo'];
$linea_derecha1 = $_POST['linea_derecha1'];
$linea_derecha2 = $_POST['linea_derecha2'];
$linea_derecha3 = $_POST['linea_derecha3'];
$linea_derecha4 = $_POST['linea_derecha4'];


//Actualizar Información de la Tienda
// Datos extraídos de tienda-configurar.php

$sql=("UPDATE t_config_tienda SET Consecutivo_Factura='".($Consecutivo_Factura)."', Consecutivo_ReciboCaja='".($Consecutivo_ReciboCaja)."', Consecutivo_Salidas='".($Consecutivo_Salidas)."', Consecutivo_PlanSepare='".($Consecutivo_PlanSepare)."', condiciones='".($condiciones)."', articulo='".($articulo)."',aplica_iva='".($aplica_iva)."',pedidos_activos='".($pedidos_activos)."',anticipos_activo='".$anticipos_activo."',linea_izquierda1='".($linea_izquierda1)."',linea_izquierda2='".($linea_izquierda2)."',linea_izquierda3='".($linea_izquierda3)."', prefijo='".($prefijo)."', linea_derecha1='".($linea_derecha1)."', linea_derecha2='".($linea_derecha2)."', linea_derecha3='".($linea_derecha3)."',linea_derecha4='".($linea_derecha4)."'  WHERE tienda_id_tienda='".$Updatetienda."'");
//echo($sql);
$result = $conexion->query($sql);

header("location:tienda-configurar.php?Mensaje=111&tiendasel=".$Updatetienda."");


 ?>