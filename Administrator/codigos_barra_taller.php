<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];
include("Lib/permisos.php");
include 'barcode.php';
$MyIdTaller=$_POST['MyIdTaller'];

 
$nuevalinea = 0; //VARIABLE PARA SABER CUANDO HAY NUEVA LINEA
$Impresos = 0; //VARIABLE PARA SABER LOS CODIGOS IMPRESOS
$arreglo = 0; //VARIABLE PARA CREAR EL ARREGLO DE LOS CODIGOS DE REFERENCIAS

$consulta_inventario ="SELECT Id_Temporal_Sol, Bodega_Id_Bodega, Cant_Solicitada, Talla_Solicitada, A.Tienda_Id_Tienda, Referencia_Id_Referencia, Fecha_Solicitud, Fecha_Observacion, Observa_Id_Usuario, Solicitud_Id_Usuari, Sastre_Id_Usuario, Vendedor_Id_Usuario, Valor_Prenda, Valor_Final, Valor_Adicional, Observa_Cliente, Dispon_Insumo, A.Cliente_Id_Cliente, Pedido_Id_Pedido, A.Fecha_Entrega, A.Fecha_EntregaCliente, Estado_Solicitud_Cliente, Valida_Estado_Sol, Estado_Depacho, Recibido_Despacho, Entregado_Despacho, Solicitud_Facturada, A.Factura_Num_Factura, B.Cod_Pedido, B.Id_Pedido,C.Nom_Cliente,C.Ape_Cliente, D.Nom_Tienda, E.Nombres, E.Apellidos,E.Img_perfil FROM t_temporal_sol as A, t_pedido as B, t_clientes as C, t_tiendas as D, t_usuarios as E Where A.Pedido_Id_Pedido=B.Cod_Pedido and A.Cliente_Id_Cliente=C.Id_Cliente and A.Tienda_Id_Tienda=D.Id_Tienda and A.Vendedor_Id_Usuario=E.Id_Usuario and Estado_Solicitud_Cliente='1' and Bodega_Id_Bodega='".$MyIdTaller."' ORDER BY Id_Temporal_Sol Desc";
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

        $Cod_Pedido=$row['Cod_Pedido'];
        $Nom_Cliente=$row['Nom_Cliente'];
        $Ape_Cliente=$row['Ape_Cliente'];
        $Observa_Cliente=$row['Observa_Cliente'];
        $cantidad = $row['Cant_Solicitada'];
        $cantidad= intval($cantidad);
        $codigo_ref = $row['Referencia_Id_Referencia'];
        $codigo_ref = substr($codigo_ref, 0, 9);  
    //    $imagen = $row['img_ref'];
	//	$detalle_ref = $row['detalle_ref'];
	$talla =  $row['Talla_Solicitada'];
	//	$Nomtalla =  $row['talla'];
	//	$cantidad = $row['cantidad'];
    //    $cantidad= intval($cantidad);
	//	$valor_unidad = $row['valor_unidad'];
	//	$valor_total = $row['valor_total'];
	//	$codigo_ref = $row['cod_ref'];
	//	$codigo_ref = substr($codigo_ref, 0, 9);        
    $code=$codigo_ref;
        for ($can=1;$can<=$cantidad;$can++){
            $nuevalinea = $nuevalinea+1;
            $arreglo = $arreglo +1;
            /////////////////////////////////////////////////////////////////////////////////
            //PDF
            ///////////////////////////////////////////////////////////////////////////////// 
            //barcode('codigos/'.$code.$talla.'.png', $code.$talla, 20, 'horizontal', 'code128', true,2);
           // $celdasuperior = "".utf8_decode($Observa_Cliente)"";

            $celdasuperior = "PED." . utf8_decode($Cod_Pedido) . " Cliente:" . utf8_decode($Nom_Cliente." ".$Ape_Cliente);
            $celdasuperior=substr($celdasuperior,0,75);
            //$pdf->SetFontSize(7);//Tamaño de Fuente
            //$pdf->Cell(53.9,2,$celdasuperior,0,0,'C');
			$pdf->SetFontSize(9); //Tamaño de Fuente
             $detalle = utf8_decode($Observa_Cliente);
                    $cadenalimpia = preg_replace("[\n|\r|\n\r]", "", $detalle);
			$pdf->Cell(106.9, 12, $celdasuperior, 1, 0, 'L'); 
            $pdf->MultiCell(106.9, 12, $cadenalimpia,0, 'L'); 
            /////////////////////////////////////////////////////////////////////////////////
            
            
            //echo $codigo_ref."/ "; //REEMPLAZADO POR EL PRECIO Y DETALLE DE REFERENCIA
            
            $codref[$arreglo]=$codigo_ref;
            $tallaref[$arreglo] = $talla;
            //PARA AGREGAR NUEVA LINEA CADA 4 REGISTROS
            if ($nuevalinea%2==0){
                $pdf->Ln();
                //echo "<br>"; //REEMPLAZAMOS LOS <BR> POR $pdf->Ln();
                for ($i=1;$i<=2;$i++){
                    //echo "COD-".$codref[$i]." "; // REEMPLAZADO POR LA IMAGEN DEL COD DE BARRAS
                    $detalle = utf8_decode($Observa_Cliente);
                    $cadenalimpia = preg_replace("[\n|\r|\n\r]", "", $detalle);
                    $pdf->Cell(106.9,18,$cadenalimpia,1,0,'L'); 
                    $Impresos = $Impresos+1;
                }
                $pdf->Ln();
                //echo "<br>"; //REEMPLAZAMOS LOS <BR> POR $pdf->Ln();
                $arreglo=0;
            }
            if ($nuevalinea % 22 == 0){
                $pdf->AddPage();    
            }  

        }
	}
 }else{
    //echo "<script language='javascript'>window.open('vista-solicitudespendientes.php','_parent','');</script>";
 }
$faltanimprimir = $nuevalinea-$Impresos;

if ($faltanimprimir>0){
    $pdf->Ln();
    //echo "<br>"; //REEMPLAZAMOS LOS <BR> POR $pdf->Ln();
    for ($i=1;$i<=$faltanimprimir;$i++){
        //echo "COD-".$codref[$i]." "; // REEMPLAZADO POR LA IMAGEN DEL COD DE BARRAS
        $code= $codref[$i];
        $tallan=$tallaref[$i];
        $pdf->Cell(53.9,18, $pdf->Image('codigos/'.$code.$tallan.'.png',$pdf->GetX(),$pdf->GetY()+1,45,18),0,0,'C');
    }
} 
echo "<br> <br> Cantidad de productos ".$nuevalinea;
echo "<br> <br> Cantidad de Impresos ".$Impresos;
echo "<br> <br> Valor de variable arreglo ".$arreglo;

include("Lib/seguridad.php");
$Pagina='<a href="vista-solicitudespendientes.php?Despacho=';
$Pagina=$Pagina.$id_despacho.'">'.'VER DESPACHO </a>';
$Datos="Generados Codigos de Barra, para el codigo de despacho ".$id_despacho." ".$Pagina;
$Paginas= $_SERVER['PHP_SELF'];
$seguridad = AgregarLog($IdUser,$Datos,$Paginas);

        
$pdf->Output("Facturas/codigos_de_barras_taller.pdf",'F');
echo "<script language='javascript'>window.open('Facturas/codigos_de_barras_taller.pdf','_blank','');</script>";
echo "<script language='javascript'>window.open('vista-solicitudespendientes.php','_parent','');</script>";
            
?>