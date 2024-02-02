<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];
include("Lib/permisos.php");
include 'barcode.php';
$id_despacho=$_GET['ID'];
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
            barcode('codigos/'.$code.$talla.'.png', $code, 15, 'horizontal', 'code128', true,1);
            //$celdasuperior = "$".number_format($valor_unidad)." ".utf8_decode($detalle_ref);
            $celdasuperior = "Modasof  $" . number_format($valor_unidad);
            $celdasuperior=substr($celdasuperior,0,35);
            //$pdf->SetFontSize(7);//Tamaño de Fuente
            //$pdf->Cell(53.9,2,$celdasuperior,0,0,'C');
			$pdf->SetFontSize(9); //Tamaño de Fuente
			$pdf->Cell(53.9, 7, $celdasuperior, 0, 0, 'C');            
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
    echo "<script language='javascript'>window.open('listado_despachos.php','_parent','');</script>";
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

include("Lib/seguridad.php");
$Pagina='<a href="despachos_detalle.php?Despacho=';
$Pagina=$Pagina.$id_despacho.'">'.'VER DESPACHO </a>';
$Datos="Generados Codigos de Barra, para el codigo de despacho ".$id_despacho." ".$Pagina;
$Paginas= $_SERVER['PHP_SELF'];
$seguridad = AgregarLog($IdUser,$Datos,$Paginas);

        
$pdf->Output("Facturas/codigos_de_barras.pdf",'I');
echo "<script language='javascript'>window.open('Facturas/codigos_de_barras.pdf','_blank','');</script>";
echo "<script language='javascript'>window.open('listado_despachos.php','_parent','');</script>";
            
?>