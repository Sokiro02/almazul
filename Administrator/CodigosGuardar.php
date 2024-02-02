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
//RECOGER INFORMACIÒN DE DESPACHOSM.PHP
//$id_tienda = $_POST['TxtIdTienda'];
//$Nombre_Tienda = $_POST['TxtNomTienda'];
$Id_Referencia = $_POST['TxtInsumoSel'];
$Cantidad = $_POST['TxtCantidad'];
$Talla = $_POST['TxtTalla'];
$Codigo_Generado = $_POST['TxtICodigoGenerado'];
$Estatus = $_POST['TxtStatus']; //ESTATUS = PROCESANDO
//echo "SE ESTAN MOSTRANDO VALORES?";
//echo "ERRORES <br>";
//echo "el numero id de referencia es: ".$Id_Referencia;
/*
while ($post = each($_POST))
{
echo "<br>".$post[0] . " = " . $post[1];
}
*/
$ConsultarTallas="SELECT Nom_Talla FROM t_tallas WHERE Id_Talla ='".$Talla."'";
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
	header("location:Generar-CodigosBarra.php?Mensaje=60");
	//echo "ERROR NO SE SELCCIONO NINGUNA REFERENCIA";
}

$Valor_Total = $Valor_Unidad * $Cantidad;
    $sql=("INSERT INTO t_temporal_codigos
    (id_ref,img_ref,cod_ref,detalle_ref,talla_id,cantidad,
    valor_unidad,id_user,talla,status_recibido,codigo_generado) 
    VALUES ('".utf8_decode($Id_Referencia)."','".utf8_decode($Imagen_Referencia)."','".utf8_decode($Codigo_Referencia)."',
    '".utf8_decode($Nombre_Referencia)."','".utf8_decode($Talla)."','".utf8_decode($Cantidad)."','".utf8_decode($Valor_Unidad)."',
    '".utf8_decode($IdUser)."','".utf8_decode($tallanom)."','".utf8_decode($Estatus)."',
    '".utf8_decode($Codigo_Generado)."')");
    //echo "<br>".$sql;
$result = $conexion->query($sql) or die('Error:'.mysqli_error($conexion));
if ($result){
	//DATOS GUARDADOS CON EXITO
        header("location:Generar-CodigosBarra.php?Mensaje=62");
	} else {
	//DATOS NO GUARDADOS
        header("location:Generar-CodigosBarra.php?Mensaje=61");
		//echo "ERROR NO SE GUARDO EN LA BASE DE DATOS";
}

?>
