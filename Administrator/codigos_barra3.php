<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];
include("Lib/permisos.php");
include 'barcode.php';

$TxtTienda = $_GET['TxtTienda'];
$TxtNomTienda = $_GET['TxtNomTienda'];
 
$nuevalinea = 0; //VARIABLE PARA SABER CUANDO HAY NUEVA LINEA
$Impresos = 0; //VARIABLE PARA SABER LOS CODIGOS IMPRESOS
$arreglo = 0; //VARIABLE PARA CREAR EL ARREGLO DE LOS CODIGOS DE REFERENCIAS

$consulta_inventario ="SELECT * FROM t_temporal_codigos WHERE id_user='".$IdUser."'";
$resultados = $conexion->query($consulta_inventario);
if($resultados->num_rows>0){
    ////////////////////////////////////////////////////
    //DEFINIMOS EL INICIO DEL PDF /////////////////////
    ///////////////////////////////////////////////////
    include ('fpdf/fpdf.php');
    $pdf = new FPDF('P','mm','letter');
    $pdf->SetMargins(1, 4, 1, 0);
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
        $detalle_ref = $row['detalle_ref'];
        $talla =  $row['talla_id'];
        $Nomtalla =  $row['talla'];
        $imagen = $row['img_ref'];
		$codigo_ref = $row['cod_ref'];
        $codigo_ref=substr($codigo_ref,0,9);
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

            barcode('codigos/'.$code.$talla.'.png', $code, 15, 'horizontal', 'code128', true,1);
            $celdasuperior = "Modasof  $".number_format($valor_unidad);
            $celdasuperior=substr($celdasuperior,0,35);
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
                    
                    $pdf->Cell(53.8,17.9, $pdf->Image('codigos/'.$code.$tallan.'.png',$pdf->GetX(),$pdf->GetY()+1,45,18),0,0,'C');
                    //$pdf->Cell(53.9,23, $pdf->Image('codigos/'.$code.'.png',2,8,48,12,'PNG'),0,0,'C');
                    //$pdf->Image('codigos/'.$code.'.png',2,8,48,12,'PNG');
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
 }else{
    echo "<script language='javascript'>window.open('Generar-CodigosBarra.php','_parent','');</script>";
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
//echo "<br> <br> Cantidad de productos ".$nuevalinea;
//echo "<br> <br> Cantidad de Impresos ".$Impresos;
//echo "<br> <br> Valor de variable arreglo ".$arreglo;
        
$pdf->Output("Facturas/codigos_de_barras2.pdf",'I');

$sql ="DELETE FROM t_temporal_codigos WHERE id_user='".$IdUser."'";  
$result = $conexion->query($sql) or die('Error:'.mysqli_error($conexion));

include("Lib/seguridad.php");
$Datos="Generados Codigos de Barra";
$Pagina= $_SERVER['PHP_SELF'];
$seguridad = AgregarLog($IdUser,$Datos,$Pagina);

echo "<script language='javascript'>window.open('Facturas/codigos_de_barras2.pdf','_blank','');</script>";
echo "<script language='javascript'>window.open('Generar-CodigosBarra.php','_parent','');</script>";
            
?>