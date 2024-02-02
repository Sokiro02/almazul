<?php 
//ESTATUS DE LA INFORMACIÓN DE LA TABLA t_inventario_TEMPORAL
//1) PROCESANDO (CUANDO SE AGREGA DESDE DESPACHO)
//2) ENVIADO  (CUANDO SE LE DA GUARDAR Y SE ENVIA LA MERCANCIA)
//3) RECIBIDO (CUANDO ES RECIBIDO EN LA TIENDA LA MERCANCIA)
// SE CREA  UN CAMPO LLAMADO status_recepcion
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];


$cliente ="SI";

$id_tienda = $_POST['TxtIdTienda'];
$Nombre_Tienda = $_POST['TxtNomTienda'];
$Id_Referencia = $_POST['TxtInsumoSel'];

$var1  = $Id_Referencia;
$porciones = explode("-", $var1);
$Id_Produccion=$porciones[0]; // Id de Produccion Cliente
$Id_Referencia = $porciones[1]; // Id de la Referencia
$Nombre_Talla = $porciones[2]; // Nombre de la Talla
$Talla_Id= $porciones[3]; // Nombre de la Talla
$Cantidads= $porciones[4]; // Cantidad en Existencia
$Id_Cliente= $porciones[5]; // Id del cliente que hace la solicitud




// CONSULTAR EL NÚMERO DE PEDIDO
$sql ="SELECT Nom_Cliente,Ape_Cliente FROM t_clientes where Id_Cliente='".$Id_Cliente."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Nom_Cliente=$row['Nom_Cliente'];
       $Ape_Cliente=$row['Ape_Cliente'];

    $NombreCompleto=$Nom_Cliente." ".$Ape_Cliente;
 }
}



//$Cantidad = $_POST['TxtCantidad'];
//$Talla = $_POST['TxtTalla'];
$Codigo_Generado = $_POST['TxtICodigoGenerado'];
$Estatus = $_POST['TxtStatus']; //ESTATUS = PROCESANDO


$ConsultarTallas="SELECT Nom_Talla FROM t_tallas WHERE Id_Talla ='".$Talla_Id."'";

$resultadotalla = $conexion->query($ConsultarTallas) or die('Error:'.mysqli_error($conexion));
if ($resultadotalla->num_rows > 0) {
    $fila = $resultadotalla->fetch_assoc();
    $tallanom = $fila['Nom_Talla'];
} else {
    $tallanom = "NA";
}

$consulta = "SELECT * FROM `t_referencias` WHERE Id_Referencia = '".$Id_Referencia."'";
//echo "<br>".$consulta."<br>";
$resultado = $conexion->query($consulta) or die('Error:'.mysqli_error($conexion));
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {                
		$Codigo_Referencia = $row['Cod_Referencia']."-".$tallanom ;
		$Imagen_Referencia = $row['Img_Referencia'];
		$Nombre_Referencia = $row['Detalle_Referencia'];
		$Valor_Unidad = $row['PVP_Ref'];
        //echo "ENTRO A t_referencias";
	}
} else {
	//devolver a la pagina porque no se selecciono ninguna referencia
	header("location:DespachosM2.php?TxtTienda=".$id_tienda."&CodigoGen=".$Codigo_Generado."&Mensaje=60&TxtNomTienda=".$Nombre_Tienda);
	//echo "ERROR NO SE SELCCIONO NINGUNA REFERENCIA";
}

$Valor_Total = $Valor_Unidad * $Cantidads;
    $sql=("INSERT INTO t_temporal_inventario
    (id_tienda,nom_tienda,id_ref,img_ref,cod_ref,detalle_ref,talla_id,cantidad,
    valor_unidad,valor_total,id_user,talla,status_recibido,codigo_generado,cliente,id_solicitud_prod,id_cliente_sol) 
    VALUES ('".$id_tienda."','".utf8_decode($Nombre_Tienda)."','".utf8_decode($Id_Referencia)."','".utf8_decode($Imagen_Referencia)."','".utf8_decode($Codigo_Referencia)."',
    '".utf8_decode($Nombre_Referencia)."','".utf8_decode($Talla_Id)."','".utf8_decode($Cantidads)."','".utf8_decode($Valor_Unidad)."',
    '".utf8_decode($Valor_Total)."','".utf8_decode($IdUser)."','".utf8_decode($tallanom)."','".utf8_decode($Estatus)."',
    '".utf8_decode($Codigo_Generado)."','".$NombreCompleto."','".$Id_Produccion."','".$Id_Cliente."')");
    //echo "<br>".$sql;
$result = $conexion->query($sql) or die('Error:'.mysqli_error($conexion));

//ACTUALIZAR LA SOLICITUD A ESTADO 8 (ENVIADO)
$ssql="UPDATE t_temporal_sol SET Estado_Solicitud_Cliente='8' WHERE Id_Temporal_Sol='".$Id_Produccion."'";
$ssresult = $conexion->query($ssql) or die('Error:'.mysqli_error($conexion));


// CONSULTAR EL NÚMERO DE PEDIDO
$sql ="SELECT Pedido_Id_Pedido FROM t_temporal_sol where Id_Temporal_Sol='".$Id_Produccion."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Pedido_Id_Pedido=$row['Pedido_Id_Pedido'];
 }
}

//ACTUALIZAR PEDIDO A ESTADO 8 (ENVIADO)
$ssql="UPDATE t_pedido SET Estado_Pedido='8' WHERE Cod_Pedido='".$Pedido_Id_Pedido."'";
$ssresult = $conexion->query($ssql) or die('Error:'.mysqli_error($conexion));


if ($result){
	//DATOS GUARDADOS CON EXITO
        header("location:DespachosM2.php?TxtTienda=".$id_tienda."&CodigoGen=".$Codigo_Generado."&Mensaje=62&TxtNomTienda=".$Nombre_Tienda);
	} else {
	//DATOS NO GUARDADOS
        header("location:DespachosM2.php?TxtTienda=".$id_tienda."&CodigoGen=".$Codigo_Generado."&Mensaje=61&TxtNomTienda=".$Nombre_Tienda);
		//echo "ERROR NO SE GUARDO EN LA BASE DE DATOS";
}
?>
