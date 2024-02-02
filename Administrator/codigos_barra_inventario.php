<?php
include "Lib/sesion.php";
include "Lib/display_error.php";
include "Lib/conexion.php";
include "Lib/formulas.php";
$IdUser = $_SESSION['IdUser'];
$IdRol = $_SESSION['IdRol'];
include "Lib/permisos.php";
include 'barcode.php';

if (isset($_POST['enviar'])) {
	if (is_array($_POST['codigo'])) {
		$selected = '';
		$num_codigo = count($_POST['codigo']);
		$current = 0;
		foreach ($_POST['codigo'] as $key => $value) {
			$sql = "SELECT * FROM t_inventario_ref WHERE Id_Registro_Inv='" . $value . "'";
			//echo $sql."<br>";
			$result = $conexion->query($sql);
			$fila1 = $result->fetch_assoc();
			$referencia = $fila1['Inv_Ref'];
			$referencia_c = $fila1['Ref_Completa'];
			$talla_id = $fila1['Talla_Id_Talla'];
			$cantida_imp = $fila1['Cantidad_Inv'];
			//CONSULTAR LA TALLA
			$ConsultarTallas = "SELECT Nom_Talla FROM t_tallas WHERE Id_Talla ='" . $talla_id . "'";
			$resultadotalla = $conexion->query($ConsultarTallas) or die('Error:' . mysqli_error($conexion));
			if ($resultadotalla->num_rows > 0) {
				$fila = $resultadotalla->fetch_assoc();
				$tallanom = $fila['Nom_Talla'];
			} else {
				$tallanom = "NA";
			}
			//CONSULTAR PRECIO DE LA REFERENCIA
			$consultarprecio = "";
			$consulta = "SELECT * FROM `t_referencias` WHERE Cod_Referencia = '" . $referencia . "'";
			//echo "<br>".$consulta."<br>";
			$resultado = $conexion->query($consulta) or die('Error:' . mysqli_error($conexion));
			if ($resultado->num_rows > 0) {
				while ($row = $resultado->fetch_assoc()) {
					$Codigo_Referencia = $row['Cod_Referencia'] . "-" . $tallanom;
					$Imagen_Referencia = $row['Img_Referencia'];
					$Nombre_Referencia = $row['Detalle_Referencia'];
					$Valor_Unidad = $row['PVP_Ref'];
					//echo "ENTRO A t_referencias";
				}
			}
			echo $sql . "<br>";
			echo $referencia . " " . $referencia_c . " " . $tallanom . " " . $Nombre_Referencia . " " . $Valor_Unidad . " " . $cantida_imp . "<br>";

			$guardar_codigos = "INSERT INTO t_temporal_codigos (id_ref,cod_ref,talla_id,cantidad,
    valor_unidad,id_user,talla) VALUES ('','" . $referencia . "','" . $talla_id . "','" . $cantida_imp . "','" . $Valor_Unidad . "','" . $IdUser . "','" . $tallanom . "')";
			echo $guardar_codigos . "<br>";
			$guardar_datos = $conexion->query($guardar_codigos);

		}
	} else {
		$selected = 'Debes seleccionar un item al menos';
	}
}
//exit;

$nuevalinea = 0; //VARIABLE PARA SABER CUANDO HAY NUEVA LINEA
$Impresos = 0; //VARIABLE PARA SABER LOS CODIGOS IMPRESOS
$arreglo = 0; //VARIABLE PARA CREAR EL ARREGLO DE LOS CODIGOS DE REFERENCIAS

$consulta_inventario = "SELECT * FROM t_temporal_codigos WHERE id_user='" . $IdUser . "'";
$resultados = $conexion->query($consulta_inventario);
if ($resultados->num_rows > 0) {
	////////////////////////////////////////////////////
	//DEFINIMOS EL INICIO DEL PDF /////////////////////
	///////////////////////////////////////////////////
	include 'fpdf/fpdf.php';
	$pdf = new FPDF('P', 'mm', 'letter');
	$pdf->SetMargins(1, 4, 1, 0);
	$pdf->SetAutoPageBreak(true, 0);
	$pdf->AddPage();
	{
		$pdf->SetFont('Arial', '', 11);
	}
	{
		//$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',30,10,41,30);
	}
	////////////////////////////////////////////////////

	while ($row = $resultados->fetch_assoc()) {
		$detalle_ref = $row['detalle_ref'];
		$talla = $row['talla_id'];
		$Nomtalla = $row['talla'];
		$imagen = $row['img_ref'];
		$codigo_ref = $row['cod_ref'];
		$codigo_ref = substr($codigo_ref, 0, 9);
		$cantidad = $row['cantidad'];
		$cantidad = intval($cantidad);
		$valor_unidad = $row['valor_unidad'];
		$valor_total = $row['valor_total'];
		$code = $codigo_ref;

		for ($can = 1; $can <= $cantidad; $can++) {
			$nuevalinea = $nuevalinea + 1;
			$arreglo = $arreglo + 1;
			/////////////////////////////////////////////////////////////////////////////////
			//PDF
			/////////////////////////////////////////////////////////////////////////////////

			barcode('codigos/' . $code .$talla. '.png', $code . $talla, 20, 'horizontal', 'code128', true, 2);
			$celdasuperior = "Modasof  $" . number_format($valor_unidad) . " Talla:" . utf8_decode($Nomtalla);
			$celdasuperior = substr($celdasuperior, 0, 35);
			$pdf->SetFontSize(9); //Tamaño de Fuente
			$pdf->Cell(53.9, 7, $celdasuperior, 0, 0, 'C');

			/////////////////////////////////////////////////////////////////////////////////

			//echo $codigo_ref."/ "; //REEMPLAZADO POR EL PRECIO Y DETALLE DE REFERENCIA

			$codref[$arreglo] = $codigo_ref;
			$tallaref[$arreglo] = $talla;

			//PARA AGREGAR NUEVA LINEA CADA 4 REGISTROS
			if ($nuevalinea % 4 == 0) {
				$pdf->Ln();
				//echo "<br>"; //REEMPLAZAMOS LOS <BR> POR $pdf->Ln();
				for ($i = 1; $i <= 4; $i++) {
					//echo "COD-".$codref[$i]." "; // REEMPLAZADO POR LA IMAGEN DEL COD DE BARRAS
					$code = $codref[$i];
					$tallan=$tallaref[$i];
					$pdf->Cell(53.9, 18, $pdf->Image('codigos/' . $code .$tallan. '.png', $pdf->GetX(), $pdf->GetY() + 1, 45, 18), 0, 0, 'C');
					//$pdf->Cell(53.9,23, $pdf->Image('codigos/'.$code.'.png',2,8,48,12,'PNG'),0,0,'C');
					//$pdf->Image('codigos/'.$code.'.png',2,8,48,12,'PNG');
					$Impresos = $Impresos + 1;
				}
				$pdf->Ln();
				//echo "<br>"; //REEMPLAZAMOS LOS <BR> POR $pdf->Ln();
				$arreglo = 0;
			}
			if ($nuevalinea % 44 == 0) {
				$pdf->AddPage();
			}

		}
	}
} else {
	echo "<script language='javascript'>window.open('Inventario-Tienda.php','_parent','');</script>";
}
$faltanimprimir = $nuevalinea - $Impresos;

if ($faltanimprimir > 0) {
	$pdf->Ln();
	//echo "<br>"; //REEMPLAZAMOS LOS <BR> POR $pdf->Ln();
	for ($i = 1; $i <= $faltanimprimir; $i++) {
		//echo "COD-".$codref[$i]." "; // REEMPLAZADO POR LA IMAGEN DEL COD DE BARRAS
		$tallan=$tallaref[$i];
		$code = $codref[$i];
		$pdf->Cell(53.9, 18, $pdf->Image('codigos/' . $code .$tallan. '.png', $pdf->GetX(), $pdf->GetY() + 1, 45, 18), 0, 0, 'C');
	}
}
//echo "<br> <br> Cantidad de productos ".$nuevalinea;
//echo "<br> <br> Cantidad de Impresos ".$Impresos;
//echo "<br> <br> Valor de variable arreglo ".$arreglo;

$pdf->Output("Facturas/codigos_de_barras4.pdf", 'F');

$sql = "DELETE FROM t_temporal_codigos WHERE id_user='" . $IdUser . "'";
$result = $conexion->query($sql) or die('Error:' . mysqli_error($conexion));

include "Lib/seguridad.php";
$Datos = "Generados Codigos de Barra";
$Pagina = $_SERVER['PHP_SELF'];
$seguridad = AgregarLog($IdUser, $Datos, $Pagina);

echo "<script language='javascript'>window.open('Facturas/codigos_de_barras4.pdf','_blank','');</script>";
echo "<script language='javascript'>window.open('Inventario-Tienda.php','_parent','');</script>";

?>