<?php 
//ob_start();
$IdUser=$_SESSION['IdUser'];
if (empty($IdUser)){
    session_start();
}
error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors", 1); 
//include("Lib/sesion.php");
//include("Lib/display_error.php");
include("Lib/conexion.php");
//include("Lib/formulas.php");
require "conversor.php";
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];
include("Lib/permisos.php");

date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');

//$ReciboCajaImp=$_GET['FacturaImp'];
$FacturaImp =$_GET['FacturaImp'];
$mitienda   =$_GET['mitienda'];
$getcliente =$_GET['cliente'];

$sql ="SELECT Distinct(Factura_Id_Factura), date_format(Fecha_Solicitud,CONCAT(CONCAT(ELT(WEEKDAY(Fecha_Solicitud) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(Fecha_Solicitud), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS FechaRemision, B.Nombres,B.Apellidos, D.Nom_Tienda, D.Dir_Tienda, D.Cel_Tienda,D.Tel_Tienda,C.Nom_Cliente,C.Id_Cliente,C.Correo_Cliente, C.Ape_Cliente,C.Documento_Cliente, E.Nom_Ciudad, C.Cel1_Cliente FROM t_salidas_remisiones as A, t_usuarios as B, t_clientes as C, t_tiendas as D, t_ciudades as E WHERE Factura_Id_Factura='".$FacturaImp."' and Tienda_Id_Tienda='".$mitienda."' and A.Vendedor_Id_Usuario=B.Id_Usuario and A.Tienda_Id_Tienda=D.Id_Tienda and A.Cliente_Id_Cliente=C.Id_Cliente and C.Ciudad_Id_Ciudad=E.Id_Ciudad"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $FechaRemision=$row['FechaRemision'];
        $Nombres=$row['Nombres'];
        $Apellidos=$row['Apellidos'];
        $Nom_Tienda=$row['Nom_Tienda'];
        $Dir_Tienda=$row['Dir_Tienda'];
        $Cel_Tienda=$row['Cel_Tienda'];
        $Tel_Tienda=$row['Tel_Tienda'];
        $Nom_Cliente=$row['Nom_Cliente'];
        $Ape_Cliente=$row['Ape_Cliente'];
        $Documento_Cliente=$row['Documento_Cliente'];
        $Nom_Ciudad=$row['Nom_Ciudad'];
        $Cel1_Cliente=$row['Cel1_Cliente'];
        $Id_Cliente=$row['Id_Cliente'];
         $Correo_Cliente=$row['Correo_Cliente'];
        
    }
}

$sql="SELECT IFNULL(sum(Valor_Final),0) as SumaRecibo From t_salidas_remisiones where Factura_Id_Factura='".$FacturaImp."' and Tienda_Id_Tienda='".$mitienda."' and Cliente_Id_Cliente='".$getcliente."'";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $SumaRecibo=$row['SumaRecibo'];
    }
}

$sql="SELECT Observa_Remision From t_remisiones where Num_Remision='".$FacturaImp."'";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Observa_Remision=$row['Observa_Remision'];
    }
}

?>
<!--seccion que genera el pdf-->
<?php





/* incluimos primeramente el archivo que contiene la clase fpdf */



require ('pdf_js.php');

//require('pdf_js.php');

class PDF_AutoPrint extends PDF_JavaScript
{
    function AutoPrint($printer='')
    {
        // Open the print dialog
        if($printer)
        {
            $printer = str_replace('\\', '\\\\', $printer);
            $script = "var pp = getPrintParams();";
            $script .= "pp.interactive = pp.constants.interactionLevel.full;";
            $script .= "pp.printerName = '$printer'";
            $script .= "print(pp);";
        }
        else
            $script = 'print(true);';
        $this->IncludeJS($script);
    }
}

$pdf = new PDF_AutoPrint('P','mm','a4');
 //$pdf = new FPDF('P','mm','mediacarta'); Para mostrar PDF Normal sin imprimir.


        $pdf->AddPage();
/* seleccionamos el tipo, estilo y tamaño de la letra a utilizar */

        {

        $pdf->SetFont('Arial','', 11);


        }

        {
        $pdf-> Image('Images/Logos/logo-blanco.png',30,5,31,15);
        }
        // Label IdCotización

        

        
        $pdf->SetXY(94, 8  );//Ubicación en PDF
        $pdf->SetFontSize(12);//Tamaño de Fuente
        $pdf->Cell(96,8,utf8_decode('REMSIÓN N° REM.'.$FacturaImp),1,1,'C'); //Ancho, Alto, texto,borde,?,centrado


        //$pdf->SetFont('Arial','B', 10);
        //$pdf->SetXY(97,37  );//Ubicación en PDF
        //$pdf->Cell(30,3,utf8_decode($Tb_MiFechaIngreso),0,1,'L');
        

        $pdf->SetFont('Arial','B', 6);
        $pdf->SetXY(30,22  );//Ubicación en PDF
        $pdf->Cell(30,3,utf8_decode('NIT 12646038'),0,1,'C');


        $pdf->SetFont('Arial','B', 6);
        $pdf->SetXY(30,25  );//Ubicación en PDF
        $pdf->Cell(30,3,'Valledupar (Cesar)',0,1,'C');


        $pdf->SetFont('Arial','B', 6);
        $pdf->SetXY(30,28  );//Ubicación en PDF
        $pdf->Cell(30,3,'Alexander Baute Agamez',0,1,'C');      

       
        $pdf->SetXY(10,32  );//Ubicación en PDF
        
        $pdf->Cell(178,20,'',1,1,'C'); //Caja para datos de Cliente y Factura //Ancho, Alto, texto,borde,?,centrado
        $pdf->Line(114,32,114,52);  //linea que divide la caja

        //datos Cliente

//*************************************************************************************************************************************
// Campo Número de Cliente //**************************************************************************************************************************************
        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(13,33  );//Ubicación en PDF
        $pdf->Cell(10,3,utf8_decode('Nº Cliente:'),0,1,'L');


                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(32,33  );//Ubicación en PDF
                $pdf->Cell(10,3,utf8_decode("C000".$Id_Cliente),0,1,'L');


        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(13,36  );//Ubicación en PDF
        $pdf->Cell(10,3,'Cliente:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(32,36  );//Ubicación en PDF
                $pdf->Cell(10,3,utf8_decode($Nom_Cliente." ".$Ape_Cliente),0,1,'L');


        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(13,39  );//Ubicación en PDF
        $pdf->Cell(10,3,'Nit - C.C:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(32,39  );//Ubicación en PDF
                $pdf->Cell(20,3,utf8_decode($Documento_Cliente),0,1,'L');

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(13,42  );//Ubicación en PDF
        $pdf->Cell(10,3,utf8_decode('E-mail:'),0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(32,42  );//Ubicación en PDF
                $pdf->Cell(10,3,utf8_decode($Correo_Cliente),0,1,'L');

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(13,45  );//Ubicación en PDF
        $pdf->Cell(10,3,'Ciudad:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(32,45  );//Ubicación en PDF
                $pdf->Cell(10,3,utf8_decode($Nom_Ciudad),0,1,'L');

     
        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(13,48  );//Ubicación en PDF
        $pdf->Cell(10,3,utf8_decode('Teléfono:'),0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(32,48  );//Ubicación en PDF
                $pdf->Cell(10,3,utf8_decode($Cel1_Cliente),0,1,'L');



        //Datos Factura

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(117,33  );//Ubicación en PDF
        $pdf->Cell(20,3,utf8_decode('Fecha Remisión:'),0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(147,33  );//Ubicación en PDF
                $pdf->Cell(20,3,utf8_decode($FechaRemision),0,1,'L');


        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(117,36  );//Ubicación en PDF
        $pdf->Cell(20,3,'Fecha Vencimiento:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(147,36  );//Ubicación en PDF
                $pdf->Cell(20,3,utf8_decode($FechaRemision),0,1,'L');


        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(117,39  );//Ubicación en PDF
        $pdf->Cell(20,3,'Vendedor:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(147,39  );//Ubicación en PDF
                $pdf->Cell(20,3,utf8_decode(utf8_decode($Nombres." ".$Apellidos)),0,1,'L');

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(117,42  );//Ubicación en PDF
        $pdf->Cell(20,3,utf8_decode('Almacen:'),0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(147,42  );//Ubicación en PDF
                $pdf->Cell(20,3,utf8_decode(utf8_decode($Nom_Tienda)),0,1,'L');


       

//**************************************************************************************************************************************
    //Productos a Facturar
//*************************************************************************************************************************************

        //Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
$pdf->SetFillColor(210,204,203);
$pdf->SetTextColor(2,2,2);
$pdf->SetXY(10,53  );//Ubicación en PDF 
$pdf->SetFont('Arial','B',9);
$pdf->Cell(33,6,utf8_decode('Código'),1,0,'C',1);
$pdf->Cell(72,6,utf8_decode('Descripción'),1,0,'C',1);
$pdf->Cell(16,6,'Cantidad',1,0,'C',1);
$pdf->Cell(16,6,'U.Med',1,0,'C',1);
$pdf->Cell(19,6,'Vr. Unitario',1,0,'C',1); 
$pdf->Cell(13,6,'Salida',1,0,'C',1);
$pdf->Cell(27,6,'Total',1,0,'C',1);

         $EjeInicial=54;
          
$sql ="SELECT Ref_Vendida,Referencia_Id_Referencia,Cant_Solicitada,Detalle_Antiguo, Valor_Final FROM t_salidas_remisiones as A, t_referencias as B WHERE Factura_Id_Factura='".$FacturaImp."' and Tienda_Id_Tienda='".$mitienda."' and Cliente_Id_Cliente='".$getcliente."'  and A.Referencia_Id_Referencia=B.Cod_Referencia";  


$result = $conexion->query($sql);
//echo($sql);
$bandera=0;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {  
    $bandera=$bandera+1;              
        $Ref_Vendida=$row['Ref_Vendida'];
        $Referencia_Id_Referencia=$row['Referencia_Id_Referencia'];
        $Cant_Solicitada=$row['Cant_Solicitada'];
        $Valor_Final=$row['Valor_Final'];
        $Detalle_Antiguo=$row['Detalle_Antiguo'];
        
        $PrendaIvA="-";
        $PrendaSubtotal=$Valor_Final*$Cant_Solicitada;

        $EjeInicial=$EjeInicial+4;
        $caracteres=35;
        $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','', 8);
        $pdf->SetXY(10,$EjeInicial  );//Ubicación en PDF 
        $pdf->Cell(33,5,utf8_encode($Ref_Vendida),1,0,'L',1);

        $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(43,$EjeInicial  );//Ubicación en PDF 
        //$pdf->Cell(72,5,utf8_decode($Detalle_Antiguo),1,0,'L',1);
        $pdf->Cell(72,5,substr($Detalle_Antiguo, 0, $caracteres.'...'),1,0,'L',1);

        $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(115,$EjeInicial  );//Ubicación en PDF 
        $pdf->Cell(16,5,utf8_encode($Cant_Solicitada),1,0,'C',1);

        $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(131,$EjeInicial  );//Ubicación en PDF 
        $pdf->Cell(16,5,utf8_encode("Un."),1,0,'C',1);

        $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(147,$EjeInicial  );//Ubicación en PDF 
        $pdf->Cell(19,5,utf8_encode("$ ".number_format($Valor_Final)),1,0,'C',1);

        $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(166,$EjeInicial  );//Ubicación en PDF 
        $pdf->Cell(13,5,utf8_encode("ok"),1,0,'C',1);

        $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(179,$EjeInicial  );//Ubicación en PDF 
        $pdf->Cell(27,5,utf8_encode("$ ".number_format($PrendaSubtotal)),1,0,'R',1);

        if ($bandera % 8 == 0){ // Inicio Pie de Página 



  //******************************************************************************************************************************
                //firma cliente
        //*************************************************************************************************************************

        //$pdf->SetXY(20,108  );//Ubicación en PDF
        //$pdf->Cell(80,10,'',1,1,'C'); //Caja para firma cliente //Ancho, Alto, texto,borde,?,centrado

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(22,117  );//Ubicación en PDF
        $pdf->Cell(20,3 ,utf8_decode('Firma de Recibido - C.C: '),0,1,'L');
        $pdf->Line(57,119,105,119);  //linea para firma

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(103,117  );//Ubicación en PDF
        $pdf->Cell(20,3 ,utf8_decode('Firma Responsable - C.C: '),0,1,'L');
        $pdf->Line(138,119,193,119);  //linea para firma

 //******************************************************************************************************************************
                //Valor en letras
        //*************************************************************************************************************************

        $pdf->SetXY(40,95  );//Ubicación en PDF
        $pdf->Cell(150,13,utf8_decode($Observa_Remision),0,0,'L'); //Caja para valor en letras //Ancho, Alto, texto,borde,?,centrado

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(17,95  );//Ubicación en PDF
        $pdf->Cell(10,6 ,utf8_decode('Observaciones:'),0,0,'L');

         //******************************************************************************************************************************


        $pdf->SetXY(55,127 );

        $pdf->SetTextColor(40,72,119);

        $pdf->SetFont('Arial','B',7);

         $pdf->Cell(127,2, utf8_decode($Nom_Tienda.' '.$Dir_Tienda.' '.$Cel_Tienda.'-'.$Tel_Tienda.' Email Modasofaute@hotmail.com '), 0, 'L');

         $pdf->AddPage(); 
             {
        $pdf->SetFont('Arial','', 11);
        }
        {
         $pdf-> Image('Images/Logos/logo-blanco.png',30,5,31,15);
        }


         $pdf->SetXY(94, 8  );//Ubicación en PDF
        $pdf->SetFontSize(12);//Tamaño de Fuente
        $pdf->Cell(96,8,utf8_decode('REMSIÓN N° REM'.$FacturaImp),1,1,'C'); //Ancho, Alto, texto,borde,?,centrado

         //$pdf->SetFont('Arial','B', 10);
        //$pdf->SetXY(97,37  );//Ubicación en PDF
        //$pdf->Cell(30,3,utf8_decode($Tb_MiFechaIngreso),0,1,'L');
        

        $pdf->SetFont('Arial','B', 6);
        $pdf->SetXY(30,22  );//Ubicación en PDF
        $pdf->Cell(30,3,utf8_decode('NIT 12646038'),0,1,'C');


        $pdf->SetFont('Arial','B', 6);
        $pdf->SetXY(30,25  );//Ubicación en PDF
        $pdf->Cell(30,3,'Valledupar (Cesar)',0,1,'C');


        $pdf->SetFont('Arial','B', 6);
        $pdf->SetXY(30,28  );//Ubicación en PDF
        $pdf->Cell(30,3,'Alexander Baute Agamez',0,1,'C');      

       
        $pdf->SetXY(10,32  );//Ubicación en PDF
        
        $pdf->Cell(178,20,'',1,1,'C'); //Caja para datos de Cliente y Factura //Ancho, Alto, texto,borde,?,centrado
        $pdf->Line(114,32,114,52);  //linea que divide la caja

        //datos Cliente

//*************************************************************************************************************************************
// Campo Número de Cliente //**************************************************************************************************************************************
        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(13,33  );//Ubicación en PDF
        $pdf->Cell(10,3,utf8_decode('Nº Cliente:'),0,1,'L');


                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(32,33  );//Ubicación en PDF
                $pdf->Cell(10,3,utf8_decode("C000".$Id_Cliente),0,1,'L');


        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(13,36  );//Ubicación en PDF
        $pdf->Cell(10,3,'Cliente:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(32,36  );//Ubicación en PDF
                $pdf->Cell(10,3,utf8_decode($Nom_Cliente." ".$Ape_Cliente),0,1,'L');


        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(13,39  );//Ubicación en PDF
        $pdf->Cell(10,3,'Nit - C.C:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(32,39  );//Ubicación en PDF
                $pdf->Cell(20,3,utf8_decode($Documento_Cliente),0,1,'L');

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(13,42  );//Ubicación en PDF
        $pdf->Cell(10,3,utf8_decode('E-mail:'),0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(32,42  );//Ubicación en PDF
                $pdf->Cell(10,3,utf8_decode($Correo_Cliente),0,1,'L');

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(13,45  );//Ubicación en PDF
        $pdf->Cell(10,3,'Ciudad:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(32,45  );//Ubicación en PDF
                $pdf->Cell(10,3,utf8_decode($Nom_Ciudad),0,1,'L');

     
        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(13,48  );//Ubicación en PDF
        $pdf->Cell(10,3,utf8_decode('Teléfono:'),0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(32,48  );//Ubicación en PDF
                $pdf->Cell(10,3,utf8_decode($Cel1_Cliente),0,1,'L');



        //Datos Factura

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(117,33  );//Ubicación en PDF
        $pdf->Cell(20,3,utf8_decode('Fecha Remisión:'),0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(147,33  );//Ubicación en PDF
                $pdf->Cell(20,3,utf8_decode($FechaRemision),0,1,'L');


        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(117,36  );//Ubicación en PDF
        $pdf->Cell(20,3,'Fecha Vencimiento:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(147,36  );//Ubicación en PDF
                $pdf->Cell(20,3,utf8_decode($FechaRemision),0,1,'L');


        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(117,39  );//Ubicación en PDF
        $pdf->Cell(20,3,'Vendedor:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(147,39  );//Ubicación en PDF
                $pdf->Cell(20,3,utf8_decode(utf8_decode($Nombres." ".$Apellidos)),0,1,'L');

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(117,42  );//Ubicación en PDF
        $pdf->Cell(20,3,utf8_decode('Almacen:'),0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(147,42  );//Ubicación en PDF
                $pdf->Cell(20,3,utf8_decode(utf8_decode($Nom_Tienda)),0,1,'L');

  //Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
$pdf->SetFillColor(210,204,203);
$pdf->SetTextColor(2,2,2);
$pdf->SetXY(10,53  );//Ubicación en PDF 
$pdf->SetFont('Arial','B',9);
$pdf->Cell(33,6,utf8_decode('Código'),1,0,'C',1);
$pdf->Cell(72,6,utf8_decode('Descripción'),1,0,'C',1);
$pdf->Cell(16,6,'Cantidad',1,0,'C',1);
$pdf->Cell(16,6,'U.Med',1,0,'C',1);
$pdf->Cell(19,6,'Vr. Unitario',1,0,'C',1); 
$pdf->Cell(13,6,'Salida',1,0,'C',1);
$pdf->Cell(27,6,'Total',1,0,'C',1);

         $EjeInicial=54;

}
// Final Pie de Página
 }




}


//******************************************************************************************************************************
                //firma cliente
        //*************************************************************************************************************************

        //$pdf->SetXY(20,108  );//Ubicación en PDF
        //$pdf->Cell(80,10,'',1,1,'C'); //Caja para firma cliente //Ancho, Alto, texto,borde,?,centrado

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(22,117  );//Ubicación en PDF
        $pdf->Cell(20,3 ,utf8_decode('Firma de Recibido - C.C: '),0,1,'L');
        $pdf->Line(57,119,105,119);  //linea para firma

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(103,117  );//Ubicación en PDF
        $pdf->Cell(20,3 ,utf8_decode('Firma Responsable - C.C: '),0,1,'L');
        $pdf->Line(138,119,193,119);  //linea para firma

 //******************************************************************************************************************************
                //Valor en letras
        //*************************************************************************************************************************

         $pdf->SetXY(45,95  );//Ubicación en PDF
        $pdf->Cell(150,13,utf8_decode($Observa_Remision),0,0,'L'); //Caja para valor en letras //Ancho, Alto, texto,borde,?,centrado

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(17,95  );//Ubicación en PDF
        $pdf->Cell(10,6 ,utf8_decode('Observaciones:'),0,0,'L');



$pdf->SetXY(10,59  );//Ubicación en PDF
$pdf->Cell(196,35,'',1,1,'C'); //Caja para productos a facturar //Ancho, Alto, texto,borde,?,centrado
        //$pdf->Line(114,50,114,85);  //linea que divide la caja

$pdf->SetXY(146,94  );//Ubicación en PDF
$pdf->Cell(60,4,'',1,1,'C'); //Caja para datos de factura totales //Ancho, Alto, texto,borde,?,centrado
//$pdf->Line(180,94,180,110);  //linea que divide la caja

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(160,95  );//Ubicación en PDF
        $pdf->Cell(20,3,utf8_decode('SUBTOTAL'),0,1,'R');
        $pdf->Line(147,98,206,98);  //linea que divide la caja

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(180,94 );//Ubicación en PDF
        $pdf->Cell(26,4,utf8_encode("$ ".number_format($SumaRecibo)),1,1,'R');


        
$pdf->AutoPrint();
//header('Content-type: application/pdf');
//$pdf->Close();
$pdf->Output('Facturas/Remision-Modasof.pdf','I');

        echo "<script language='javascript'>window.open('Facturas/Remision-Modasof.pdf','_blank','');</script>";


        echo "<script language='javascript'>window.open('Informe-RemisionesTienda.php?Mensaje=333','_parent','');</script>";//para ver el archivo pdf generado


//ob_end_clean();


        //exit;

        //header('Location: http://www.estrenarcarro.com.co/desarrollo/index.php?option=com_wrapper&view=wrapper&Itemid=1320&lang=en');



    ?>









<!--fin seccion pdf-->







