<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
require "conversor.php";
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];
include("Lib/permisos.php");

date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');

$DespachoId=$_GET['DespachoId'];
//$PedidoImp=$_GET['PedidoImp'];

$sql ="SELECT DISTINCT(nom_tienda) FROM t_temporal_inventario WHERE id_despacho='".$DespachoId."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $nom_tienda=$row['nom_tienda'];
    }
}

$sql ="SELECT DISTINCT(fecha_ingreso) FROM t_temporal_inventario WHERE id_despacho='".$DespachoId."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $fecha_ingreso=$row['fecha_ingreso'];
    }
}

$sql ="SELECT DISTINCT(id_tienda) FROM t_temporal_inventario WHERE id_despacho='".$DespachoId."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $TiendaSel=$row['id_tienda'];
    }
}

$sql ="SELECT Nom_Tienda, Dir_Tienda, Cel_Tienda FROM t_tiendas WHERE id_tienda='".$TiendaSel."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Nom_Tienda=$row['Nom_Tienda'];
        $Dir_Tienda=$row['Dir_Tienda'];
        $Cel_Tienda=$row['Cel_Tienda'];
    }
}




$sql ="SELECT Nombres,Apellidos FROM t_temporal_inventario as A, t_usuarios as B WHERE id_despacho='".$DespachoId."' and A.id_user=B.Id_Usuario"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $nombredespacha=$row['Nombres'];
         $ApeDespacha=$row['Apellidos'];
    }
}

$sql="SELECT IFNULL(sum(valor_total),0) as SumaRecibo From t_temporal_inventario where id_despacho='".$DespachoId."'";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $SumaRecibo=$row['SumaRecibo'];
    }
}

?>
<!--seccion que genera el pdf-->
<?php

/* http://programarenphp.wordpress.com */



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
// $pdf = new FPDF('P','mm','mediacarta'); Para mostrar PDF Normal sin imprimir.


        $pdf->AddPage();
/* seleccionamos el tipo, estilo y tamaño de la letra a utilizar */

        {
        $pdf->SetFont('Arial','', 11);
        }

        {
        $pdf-> Image('Images/Logos/logo-blanco.png',30,5,31,15);
        }
        // Label IdCotización

        

        $pdf->SetXY(94, 12  );//Ubicación en PDF
        $pdf->SetFontSize(16);//Tamaño de Fuente
        $pdf->Cell(96,8,utf8_decode('DESPACHO PRODUCCIÓN N°'.$DespachoId),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


        
        $pdf->SetFont('Arial','B', 6);
        $pdf->SetXY(30,22  );//Ubicación en PDF
        $pdf->Cell(30,3,utf8_decode('NIT 12646038'),0,1,'C');


        $pdf->SetFont('Arial','B', 6);
        $pdf->SetXY(30,25  );//Ubicación en PDF
        $pdf->Cell(30,3,'Valledupar (Cesar)',0,1,'C');


        $pdf->SetFont('Arial','B', 6);
        $pdf->SetXY(30,28  );//Ubicación en PDF
        $pdf->Cell(30,3,'Alexander Baute Agamez',0,1,'C');      

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
           
        $pdf->SetXY(20,32  );//Ubicación en PDF
        
        $pdf->Cell(178,10,'',1,1,'C'); //Caja para datos de Cliente y Factura //Ancho, Alto, texto,borde,?,centrado
        $pdf->Line(114,32,114,42);  //linea que divide la caja

        //datos Cliente

//*************************************************************************************************************************************
// Campo Número de Cliente //**************************************************************************************************************************************
        //$pdf->SetFont('Arial','B', 8);
        //$pdf->SetXY(23,33  );//Ubicación en PDF
        //$pdf->Cell(20,3,utf8_decode('Nº Cliente:'),0,1,'L');


                //$pdf->SetFont('Arial','', 8);
                //$pdf->SetXY(42,33  );//Ubicación en PDF
                //$pdf->Cell(20,3,utf8_decode("C000".$Cl_Id_Cliente),0,1,'L');


        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(23,33  );//Ubicación en PDF
        $pdf->Cell(20,3,'Enviado por:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(42,33  );//Ubicación en PDF
                $pdf->Cell(20,3,utf8_decode($nombredespacha." ".$ApeDespacha),0,1,'L');


        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(23,37  );//Ubicación en PDF
        $pdf->Cell(20,3,'Enviado a:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(42,37  );//Ubicación en PDF
                $pdf->Cell(20,3,utf8_decode($Nom_Tienda),0,1,'L');

      

     
     

        //Datos Factura

        //$pdf->SetFont('Arial','B', 8);
        //$pdf->SetXY(117,33  );//Ubicación en PDF
        //$pdf->Cell(20,3,utf8_decode('Fecha Factura:'),0,1,'L');

                //$pdf->SetFont('Arial','', 8);
                //$pdf->SetXY(147,33  );//Ubicación en PDF
                //$pdf->Cell(20,3,utf8_decode($Tb_MiFechaSalida),0,1,'L');


        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(117,33  );//Ubicación en PDF
        $pdf->Cell(20,3,'Enviado el:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(147,33  );//Ubicación en PDF
                $pdf->Cell(20,3,utf8_decode($fecha_ingreso),0,1,'L');


        $pdf->SetFont('Arial','B'   , 8);
        $pdf->SetXY(117,37  );//Ubicación en PDF
        $pdf->Cell(20,3,'Concepto:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(147,37  );//Ubicación en PDF
                $pdf->Cell(20,3, strtoupper("DESPACHO A TIENDA"),0,1,'L');

       

     


        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(117,49  );//Ubicación en PDF
        //$pdf->Cell(20,3,utf8_decode('Cheque No:'),0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(147,49  );//Ubicación en PDF
                //$pdf->Cell(20,3,utf8_decode(m),0,1,'L');

//**************************************************************************************************************************************
    //Productos a Facturar
//*************************************************************************************************************************************

        //Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
$pdf->SetFillColor(210,204,203);
$pdf->SetTextColor(2,2,2);
$pdf->SetXY(20,43  );//Ubicación en PDF 
$pdf->SetFont('Arial','B',9);
$pdf->Cell(25,6,utf8_decode('Id.'),1,0,'C',1);
$pdf->Cell(57,6,utf8_decode('Cliente/Producción'),1,0,'C',1);
$pdf->Cell(36,6,'Ref',1,0,'C',1);
$pdf->Cell(20,6,utf8_decode('Cantidad'),1,0,'C',1);
$pdf->Cell(20,6,'Vr. Un',1,0,'C',1);
$pdf->Cell(20,6,utf8_decode('Valor'),1,0,'C',1);

    
    $EjeInicial=44;
          
$sql ="SELECT id,cod_ref,valor_unidad,valor_total,cliente,cantidad FROM t_temporal_inventario WHERE id_despacho='".$DespachoId."'";  

$result = $conexion->query($sql);
$bandera = 0;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    $bandera=$bandera+1;               
        $id=$row['id'];
        $cod_referencia=$row['cod_ref'];
        $valor_unidad=$row['valor_unidad'];
        $valor_total=$row['valor_total'];
        $cliente=$row['cliente'];
         $cantidad=$row['cantidad'];
        //$Valor_Ingreso=$row['Valor_Ingreso'];
        
    

        $EjeInicial=$EjeInicial+5;
    

        $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','', 8);
        $pdf->SetXY(20,$EjeInicial  );//Ubicación en PDF 
        $pdf->Cell(25,5,utf8_encode("R-".$id),1,0,'C',1);


        $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(45,$EjeInicial  );//Ubicación en PDF 
        $pdf->Cell(57,5,utf8_encode($cliente),1,0,'L',1);

        $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(102,$EjeInicial  );//Ubicación en PDF 
        $pdf->Cell(36,5,utf8_encode($cod_referencia),1,0,'C',1);

        $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(138,$EjeInicial  );//Ubicación en PDF 
         $pdf->Cell(20,5,utf8_encode($cantidad),1,0,'C',1);

        $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(158,$EjeInicial  );//Ubicación en PDF 
        $pdf->Cell(20,5,utf8_encode("$ ".number_format($valor_unidad)),1,0,'R',1);

        $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(178,$EjeInicial  );//Ubicación en PDF 
        $pdf->Cell(20,5,utf8_encode("$ ".number_format($valor_total)),1,0,'R',1);


        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(117,110  );//Ubicación en PDF
        $pdf->Cell(20,3 ,utf8_decode('Recibido por: '),0,1,'L');
        //$pdf->Line(184,109,10,109);  //linea para firma

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(22,110  );//Ubicación en PDF
        $pdf->Cell(20,3 ,utf8_decode('Enviado por: '),0,1,'L');
        //$pdf->Line(50,109,100,109);  //linea para firma

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(22,119  );//Ubicación en PDF
        $pdf->Cell(20,3 ,utf8_decode('Este recibo se emitió desde Modasof a las'.$TiempoActual),0,1,'L');
            


 //******************************************************************************************************************************
                //Valor en letras
        //*************************************************************************************************************************

        //$pdf->SetXY(30,93  );//Ubicación en PDF
        //$pdf->Cell(100,10,'',1,1,'C'); //Caja para valor en letras //Ancho, Alto, texto,borde,?,centrado

        $ValorLetras=convertir($SumaRecibo);

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(22,99  );//Ubicación en PDF
        //$pdf->Cell(20,6 ,utf8_decode('Valor en letras:'.$ValorLetras),0,1,'L');


         //******************************************************************************************************************************
                //observacion factura
        //*************************************************************************************************************************

        
        


                // $pdf->SetFont('Arial','', 8);
                // $pdf->SetXY(147,77  );//Ubicación en PDF
                // $pdf->Cell(20,5,utf8_decode($Tb_MiFechaSalida),0,1,'L');




        $pdf->SetXY(55,128 );

        $pdf->SetTextColor(2,2,2);

        $pdf->SetFont('Arial','B',7);

        $pdf->Cell(129,2, utf8_decode($Nom_Tienda."   Dirección:  ".$Dir_Tienda."   Tels:  ".$Cel_Tienda."    E-mail: Modasofaute@hotmail.com"), 0, 'L');



         if ($bandera % 9 == 0){
            $pdf->AddPage(); 
             {
        $pdf->SetFont('Arial','', 11);
        }

        {
        $pdf-> Image('Images/Logos/logo-blanco.png',30,5,31,15);
        }
        // Label IdCotización

        

        $pdf->SetXY(94, 12  );//Ubicación en PDF
        $pdf->SetFontSize(16);//Tamaño de Fuente
        $pdf->Cell(96,8,utf8_decode('DESPACHO PRODUCCIÓN N°'.$DespachoId),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado
        
        $pdf->SetFont('Arial','B', 6);
        $pdf->SetXY(30,22  );//Ubicación en PDF
        $pdf->Cell(30,3,utf8_decode('NIT 12646038'),0,1,'C');

        $pdf->SetFont('Arial','B', 6);
        $pdf->SetXY(30,25  );//Ubicación en PDF
        $pdf->Cell(30,3,'Valledupar (Cesar)',0,1,'C');


        $pdf->SetFont('Arial','B', 6);
        $pdf->SetXY(30,28  );//Ubicación en PDF
        $pdf->Cell(30,3,'Alexander Baute Agamez',0,1,'C');      

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
           
        $pdf->SetXY(20,32  );//Ubicación en PDF
        
        $pdf->Cell(178,10,'',1,1,'C'); //Caja para datos de Cliente y Factura //Ancho, Alto, texto,borde,?,centrado
        $pdf->Line(114,32,114,42);  //linea que divide la caja

        //datos Cliente

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(23,33  );//Ubicación en PDF
        $pdf->Cell(20,3,'Enviado por:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(42,33  );//Ubicación en PDF
                $pdf->Cell(20,3,utf8_decode($nombredespacha." ".$ApeDespacha),0,1,'L');


        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(23,37  );//Ubicación en PDF
        $pdf->Cell(20,3,'Enviado a:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(42,37  );//Ubicación en PDF
                $pdf->Cell(20,3,utf8_decode($Nom_Tienda),0,1,'L');



        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(117,33  );//Ubicación en PDF
        $pdf->Cell(20,3,'Enviado el:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(147,33  );//Ubicación en PDF
                $pdf->Cell(20,3,utf8_decode($fecha_ingreso),0,1,'L');


        $pdf->SetFont('Arial','B'   , 8);
        $pdf->SetXY(117,37  );//Ubicación en PDF
        $pdf->Cell(20,3,'Concepto:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(147,37  );//Ubicación en PDF
                $pdf->Cell(20,3, strtoupper("DESPACHO A TIENDA"),0,1,'L');

       

     


        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(117,49  );//Ubicación en PDF
        //$pdf->Cell(20,3,utf8_decode('Cheque No:'),0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(147,49  );//Ubicación en PDF
                //$pdf->Cell(20,3,utf8_decode(m),0,1,'L'); 
        $pdf->SetFillColor(210,204,203);
$pdf->SetTextColor(2,2,2);
$pdf->SetXY(20,43  );//Ubicación en PDF 
$pdf->SetFont('Arial','B',9);
$pdf->Cell(25,6,utf8_decode('Id.'),1,0,'C',1);
$pdf->Cell(57,6,utf8_decode('Cliente/Producción'),1,0,'C',1);
$pdf->Cell(36,6,'Ref',1,0,'C',1);
$pdf->Cell(20,6,utf8_decode('Cantidad'),1,0,'C',1);
$pdf->Cell(20,6,'Vr. Un',1,0,'C',1);
$pdf->Cell(20,6,utf8_decode('Valor'),1,0,'C',1);
        
        
        $EjeInicial=39;
        $EjeInicial=$EjeInicial+5;
    

        } 
 }
}


$pdf->SetXY(20,59  );//Ubicación en PDF
$pdf->Cell(178,38,'',1,1,'C'); //Caja para productos a facturar //Ancho, Alto, texto,borde,?,centrado
        //$pdf->Line(114,50,114,85);  //linea que divide la caja

$pdf->SetXY(178,97  );//Ubicación en PDF
//$pdf->Cell(20,4,$SumaRecibo,1,1,'R'); //Caja para datos de factura totales //Ancho, Alto, texto,borde,?,centrado
$pdf->Cell(20,5,utf8_encode("$ ".number_format($SumaRecibo)),1,1,'R',1);
//$pdf->Line(178,87,178,91);  //linea que divide la caja

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(147,98  );//Ubicación en PDF
        $pdf->Cell(20,3,utf8_decode('Total Documento'),0,1,'L');
        

        
        //******************************************************************************************************************************
                //firma cliente
        //*************************************************************************************************************************

        //$pdf->SetXY(20,108  );//Ubicación en PDF
        //$pdf->Cell(80,10,'',1,1,'C'); //Caja para firma cliente //Ancho, Alto, texto,borde,?,centrado

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(117,110  );//Ubicación en PDF
        $pdf->Cell(20,3 ,utf8_decode('Recibido por: '),0,1,'L');
        //$pdf->Line(184,109,10,109);  //linea para firma

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(22,110  );//Ubicación en PDF
        $pdf->Cell(20,3 ,utf8_decode('Enviado por: '),0,1,'L');
        //$pdf->Line(50,109,100,109);  //linea para firma

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(22,119  );//Ubicación en PDF
        $pdf->Cell(20,3 ,utf8_decode('Este recibo se emitió desde Modasof a las'.$TiempoActual),0,1,'L');
                // $pdf->SetFont('Arial','B', 8);
                // $pdf->SetXY(45,119  );//Ubicación en PDF
                // $pdf->Cell(20,3,utf8_decode(Efectivo),0,1,'L');
                // $pdf->Line(57,121,61,121);  //linea para firma

                // $pdf->SetFont('Arial','B', 8);
                // $pdf->SetXY(63,119  );//Ubicación en PDF
                // $pdf->Cell(20,3,utf8_decode(Tarjeta),0,1,'L');
                // $pdf->Line(74,121,78,121);  //linea para firma

                // $pdf->SetFont('Arial','B', 8);
                // $pdf->SetXY(80,119  );//Ubicación en PDF
                // $pdf->Cell(20,3,utf8_decode(Transferencia),0,1,'L');
                // $pdf->Line(100,121,104,121);  //linea para firma

                // $pdf->SetFont('Arial','B', 8);
                // $pdf->SetXY(106,119  );//Ubicación en PDF
                // $pdf->Cell(20,3,utf8_decode(Efecty_Baloto),0,1,'L');
                // $pdf->Line(128,121,132,121);  //linea para firma


 //******************************************************************************************************************************
                //Valor en letras
        //*************************************************************************************************************************

        //$pdf->SetXY(30,93  );//Ubicación en PDF
        //$pdf->Cell(100,10,'',1,1,'C'); //Caja para valor en letras //Ancho, Alto, texto,borde,?,centrado

        $ValorLetras=convertir($SumaRecibo);

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(22,99  );//Ubicación en PDF
        $pdf->Cell(20,6 ,utf8_decode('Valor en letras:'.$ValorLetras),0,1,'L');


         //******************************************************************************************************************************
                //observacion factura
        //*************************************************************************************************************************

        
        


                // $pdf->SetFont('Arial','', 8);
                // $pdf->SetXY(147,77  );//Ubicación en PDF
                // $pdf->Cell(20,5,utf8_decode($Tb_MiFechaSalida),0,1,'L');




        $pdf->SetXY(55,128 );

        $pdf->SetTextColor(2,2,2);

        $pdf->SetFont('Arial','B',7);

        $pdf->Cell(129,2, utf8_decode($Nom_Tienda."   Dirección:  ".$Dir_Tienda."   Tels:  ".$Cel_Tienda."    E-mail: Modasofaute@hotmail.com"), 0, 'L');

        
$pdf->AutoPrint();
                $pdf->Output("Facturas/ReciboCaja.pdf",'I');
               




        echo "<script language='javascript'>window.open('Facturas/ReciboCaja.pdf','_blank','');</script>";

        echo "<script language='javascript'>window.open('listado_despachos.php?Mensaje=333','_parent','');</script>";//para ver el archivo pdf generado





        //exit;

        //header('Location: http://www.estrenarcarro.com.co/desarrollo/index.php?option=com_wrapper&view=wrapper&Itemid=1320&lang=en');





    ?>









<!--fin seccion pdf-->







