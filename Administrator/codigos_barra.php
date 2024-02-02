<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];
include("Lib/permisos.php");
include 'barcode.php';
$id_despacho=$_POST['ID'];
$TxtTienda = $_GET['TxtTienda'];
$TxtNomTienda = $_GET['TxtNomTienda'];
 
$nuevalinea = 0; //VARIABLE PARA SABER CUANDO HAY NUEVA LINEA
$Impresos = 0; //VARIABLE PARA SABER LOS CODIGOS IMPRESOS
$arreglo = 0; //VARIABLE PARA CREAR EL ARREGLO DE LOS CODIGOS DE REFERENCIAS

$consulta_inventario ="SELECT * FROM t_temporal_inventario WHERE id_despacho='".$id_despacho."'";
$resultados = $conexion->query($consulta_inventario);
if($resultados->num_rows>0){
    ////////////////////////////////////////////////////
    //DEFINIMOS EL INICIO DEL PDF /////////////////////
    ///////////////////////////////////////////////////
    include ('fpdf/fpdf.php');
    $pdf = new FPDF('P','mm','letter');
    $pdf->SetMargins(1,2,1,0);
    $pdf->SetAutoPageBreak(true,0);
    $pdf->AddPage();
		{
            $pdf->SetFont('Arial','', 11);
        }
        {
        //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',30,10,41,30);
        }
    ////////////////////////////////////////////////////

    while ($row = $resultados->fetch_assoc()) {
        $imagen = $row['img_ref'];
		$codigo_ref = $row['cod_ref'];
		$detalle_ref = $row['detalle_ref'];
		$talla =  $row['talla_id'];
		$Nomtalla =  $row['talla'];
		$cantidad = $row['cantidad'];
        $cantidad= intval($cantidad);
		$valor_unidad = $row['valor_unidad'];
		$valor_total = $row['valor_total'];
		$codigo_ref = $row['cod_ref'];
		//$codigo_ref = substr($codigo_ref, 0, 9);
		
        $code=$codigo_ref;
        for ($can=1;$can<=$cantidad;$can++){
            $nuevalinea = $nuevalinea+1;
            $arreglo = $arreglo +1;
            /////////////////////////////////////////////////////////////////////////////////
            //PDF
            ///////////////////////////////////////////////////////////////////////////////// 
            barcode('codigos/'.$code.$talla.'.png', $code, 15, 'horizontal', 'code128', true);
			$celdasuperior = "Modasof  $" . number_format($valor_unidad);
			$celdasuperior = substr($celdasuperior, 0, 35);
            $pdf->SetFontSize(9);//Tamaño de Fuente
            $pdf->Cell(53.9,7.1,$celdasuperior,0,0,'C');
            /////////////////////////////////////////////////////////////////////////////////
            
            
            //echo $codigo_ref."/ "; //REEMPLAZADO POR EL PRECIO Y DETALLE DE REFERENCIA
            
            $codref[$arreglo]=$codigo_ref;
			$tallaref[$arreglo] = $talla;

            //PARA AGREGAR NUEVA LINEA CADA 4 REGISTROS
            if ($nuevalinea%4==0){
                $pdf->Ln();
                //echo "<br>"; //REEMPLAZAMOS LOS <BR> POR $pdf->Ln();
                for ($i=1;$i<=4;$i++){
                    //echo "COD-".$codref[$i]." "; // REEMPLAZADO POR LA IMAGEN DEL COD DE BARRAS
                    $code= $codref[$i];
					$tallan=$tallaref[$i];
                    //$pdf->Cell(53.9,18, $pdf->Image('codigos/'.$code.$tallan.'.png',$pdf->GetX(),$pdf->GetY()+1,45,18),0,0,'C');
					$pdf->Cell(53.8,17.9, $pdf->Image('codigos/'.$code.$tallan.'.png',$pdf->GetX(),$pdf->GetY()+1,45, 18), 0, 0, 'C');					
                    $Impresos = $Impresos+1;
                }
                $pdf->Ln();
                //echo "<br>"; //REEMPLAZAMOS LOS <BR> POR $pdf->Ln();
                $arreglo=0;
            }
            if ($nuevalinea % 44 == 0){
                $pdf->AddPage();    
            }  

        }
	}
 }
$faltanimprimir = $nuevalinea-$Impresos;

if ($faltanimprimir>0){
    $pdf->Ln();
    //echo "<br>"; //REEMPLAZAMOS LOS <BR> POR $pdf->Ln();
    for ($i=1;$i<=$faltanimprimir;$i++){
        //echo "COD-".$codref[$i]." "; // REEMPLAZADO POR LA IMAGEN DEL COD DE BARRAS
        $code= $codref[$i];
		$tallan=$tallaref[$i];
        $pdf->Cell(53.8,17.9, $pdf->Image('codigos/'.$code.$tallan.'.png',$pdf->GetX(),$pdf->GetY()+1,45,18),0,0,'C');
    }
} 
echo "<br> <br> Cantidad de productos ".$nuevalinea;
echo "<br> <br> Cantidad de Impresos ".$Impresos;
echo "<br> <br> Valor de variable arreglo ".$arreglo;
        
$pdf->Output("Facturas/codigos_de_barras.pdf",'F');
echo "<script language='javascript'>window.open('Facturas/codigos_de_barras.pdf','_blank','');</script>";
echo "<script language='javascript'>window.open('listados_envios.php','_parent','');</script>";
            
?>


<?php
/*
include ('fpdf/fpdf.php');
        $pdf = new FPDF('P','mm','letter');
        $pdf->SetMargins(1,2,1,0);
        $pdf->SetAutoPageBreak(true,0);
        $pdf->AddPage();
		{
        $pdf->SetFont('Arial','', 11);
        }
        {
        //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',30,10,41,30);
        }

$EjeInicial=0;
$EjeY = 0;
$EjeNombre=-50.9;
$EjeCodigo=-51.9;

$var = array();
$contador = 0;
$bandera = 0;
		   $celdasuperior=substr("No ha Entrado a la consulta",0,35);
           $pdf->SetFontSize(7);//Tamaño de Fuente
           $pdf->Cell(53.9,2,$celdasuperior,0,0,'L');


$consulta_inventario ="SELECT * FROM t_temporal_inventario WHERE id_despacho='".$id_despacho."'";
	$resultados = $conexion->query($consulta_inventario);
	if($resultados->num_rows>0){
		while ($row = $resultados->fetch_assoc()) {
		   $celdasuperior=substr("Entro a la consulta",0,35);
           $pdf->SetFontSize(7);//Tamaño de Fuente
           $pdf->Cell(53.9,2,$celdasuperior,0,0,'L');
			$id = $row['id'];
			$imagen = $row['img_ref'];
			$codigo_ref = $row['cod_ref'];
			$detalle_ref = $row['detalle_ref'];
			$talla =  $row['talla_id'];
			$Nomtalla =  $row['Nom_Talla'];
			$cantidad = $row['cantidad'];
            $cantidad= intval($cantidad);
			$valor_unidad = $row['valor_unidad'];
			$valor_total = $row['valor_total'];
            for ($can=1;$cant<=$cantidad;$can++){
                $bandera = $bandera+1;
                $code=$row['cod_ref'];
                $Detalle_Referencia=$row['detalle_ref'];
                $PVP_Ref=$row['valor_unidad'];
                barcode('codigos/'.$code.'.png', $code, 22, 'horizontal', 'code128', true);
                $celdasuperior = "$".number_format($PVP_Ref)." ".utf8_decode($Detalle_Referencia);
                $celdasuperior=substr($celdasuperior,0,35);
                $pdf->SetFontSize(7);//Tamaño de Fuente
                $pdf->Cell(53.9,2,$celdasuperior,0,0,'L');
                if ($bandera % 4 == 0){
                    $pdf->Ln(); 
                    for ($i=0;$i<=3;$i++){
                        $code = $var[$i][1];
                        barcode('codigos/'.$code.'.png', $code, 23, 'horizontal', 'code128', true);
                        $pdf->Cell(53.9,23, $pdf->Image('codigos/'.$code.'.png',$pdf->GetX(),$pdf->GetY()+1,53.9,23),0,0,'C');
                    }
                    $pdf->Ln();
                    $contador=0;
                }
                if ($bandera % 44 == 0){
                    $pdf->AddPage();    
                }  
                $contador = $contador + 1;
                
            }
        }
   }
*/


/*
//Ref_Completa
$sql = "SELECT DISTINCT(Ref_Completa),Inv_Ref FROM t_inventario_ref";
//  $sql ="SELECT Id_Color, Nom_Color, Valor_Color FROM t_colores"; 
    //Echo($sql); 
$result = $conexion->query($sql);
$numregistros = $result->num_rows;
$bandera = 0;
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
    $bandera=$bandera+1;
        $code=$row['Ref_Completa']; 
        $Inv_Ref = $row['Inv_Ref']; 
        $var[$contador][1]=$code;
        $var[$contador][2]=$Inv_Ref; 
        $contador = $contador + 1;
         barcode('codigos/'.$code.'.png', $code, 22, 'horizontal', 'code128', true);
         $sql2="SELECT * FROM t_referencias WHERE Cod_Referencia = '".$Inv_Ref."'";
         $resultado = $conexion->query($sql2);
         $fila = $resultado->fetch_assoc();
         $Detalle_Referencia=$fila['Detalle_Referencia'];
         $PVP_Ref[$contador]=$fila['PVP_Ref'];
         $celdasuperior = "$".number_format($PVP_Ref[$contador])." ".utf8_decode($Detalle_Referencia);
         $celdasuperior=substr($celdasuperior,0,35);
         $pdf->SetFontSize(7);//Tamaño de Fuente
         $pdf->Cell(53.9,2,$celdasuperior,0,0,'L');
        if ($bandera % 4 == 0){
            $pdf->Ln(); 
            for ($i=0;$i<=3;$i++){
                $code = $var[$i][1];
                barcode('codigos/'.$code.'.png', $code, 23, 'horizontal', 'code128', true);
                $pdf->Cell(53.9,23, $pdf->Image('codigos/'.$code.'.png',$pdf->GetX(),$pdf->GetY()+1,53.9,23),0,0,'C');
            }
            $pdf->Ln();
            $contador=0;
        }
        if ($bandera % 44 == 0){
            $pdf->AddPage();    
        }  
      }
   }*/
	
    //	$pdf->Output("Facturas/Factura-HotelArenas.pdf",'F');
	//	echo "<script language='javascript'>window.open('Facturas/Factura-HotelArenas.pdf','_blank','');</script>";
	//	echo "<script language='javascript'>window.open('DespachosM.php?TxtTienda=".$TxtTienda.'TxtNomTienda&'.$TxtNomTienda."','_parent','');</script>";
	?>