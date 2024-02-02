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


$AbonoCliente=$_GET['AbonoCliente'];
$AbonosFactura=$_GET['AbonosFactura'];

$sql ="SELECT Id_Ingreso,Cod_Recibo_Caja, A.Fecha_Ingreso,Nombres,Apellidos,Nom_Tienda, Dir_Tienda,Cel_Tienda,Nom_Cliente,Ape_Cliente, Documento_Cliente,Nom_Ciudad,Cel1_Cliente FROM t_ingresos as A, t_separados as B, t_clientes as C, t_tiendas as D, t_ciudades as E, t_usuarios as F WHERE Id_Ingreso='".$AbonoCliente."' and A.Separe_Cod_Separe=B.Num_Separe and A.Tienda_Id_Tienda=D.Id_Tienda and A.Cliente_Id_Cliente=C.Id_Cliente and A.Ingreso_Id_Usuario=F.Id_Usuario and C.Ciudad_Id_Ciudad=E.Id_Ciudad"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Cod_Recibo_Caja=$row['Id_Ingreso'];
        $Consecutivo=$row['Cod_Recibo_Caja'];
        $FechaIngreso=$row['Fecha_Ingreso'];
        $Nombres=$row['Nombres'];
        $Apellidos=$row['Apellidos'];
        $Nom_Tienda=$row['Nom_Tienda'];
        $Dir_Tienda=$row['Dir_Tienda'];
        $Cel_Tienda=$row['Cel_Tienda'];
        $Nom_Cliente=$row['Nom_Cliente'];
        $Ape_Cliente=$row['Ape_Cliente'];
        $Documento_Cliente=$row['Documento_Cliente'];
        $Nom_Ciudad=$row['Nom_Ciudad'];
        $Cel1_Cliente=$row['Cel1_Cliente'];
    }
}

$sql ="SELECT Total_Separe FROM t_separados WHERE Num_Separe='".$AbonosFactura."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Total_Separado=$row['Total_Separe'];
    }
}

$sql ="SELECT SUM(Valor_Ingreso) AbonosSepare FROM t_ingresos WHERE Separe_Cod_Separe='".$AbonosFactura."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $AbonosSepare=$row['AbonosSepare'];
    }
}

$DeudaPendiente=$Total_Separado-$AbonosSepare;

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



        //Logo



        }

        {
        $pdf-> Image('Images/Logos/logo-blanco.png',30,5,31,15);
        }
        // Label IdCotización

        

        $pdf->SetXY(94, 12  );//Ubicación en PDF
        $pdf->SetFontSize(16);//Tamaño de Fuente
        $pdf->Cell(96,8,utf8_decode('RECIBO DE CAJA N°'.$Consecutivo),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


        
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
        
        $pdf->Cell(178,20,'',1,1,'C'); //Caja para datos de Cliente y Factura //Ancho, Alto, texto,borde,?,centrado
        $pdf->Line(114,32,114,52);  //linea que divide la caja

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
        $pdf->Cell(20,3,'Cliente:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(42,33  );//Ubicación en PDF
                $pdf->Cell(20,3,utf8_decode($Nom_Cliente." ".$Ape_Cliente),0,1,'L');


        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(23,37  );//Ubicación en PDF
        $pdf->Cell(20,3,'Nit - C.C:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(42,37  );//Ubicación en PDF
                $pdf->Cell(20,3,utf8_decode($Documento_Cliente),0,1,'L');

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(23,41  );//Ubicación en PDF
        $pdf->Cell(20,3,utf8_decode('Dirección:'),0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(42,41  );//Ubicación en PDF
                $pdf->Cell(20,3,utf8_decode($Direccion),0,1,'L');

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(23,45  );//Ubicación en PDF
        $pdf->Cell(20,3,'Ciudad:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(42,45  );//Ubicación en PDF
                $pdf->Cell(20,3,utf8_decode($Nom_Ciudad),0,1,'L');

     
        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(23,49  );//Ubicación en PDF
        $pdf->Cell(20,3,utf8_decode('Teléfono:'),0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(42,49  );//Ubicación en PDF
                $pdf->Cell(20,3,utf8_decode($Cel1_Cliente),0,1,'L');



        //Datos Factura

        //$pdf->SetFont('Arial','B', 8);
        //$pdf->SetXY(117,33  );//Ubicación en PDF
        //$pdf->Cell(20,3,utf8_decode('Fecha Factura:'),0,1,'L');

                //$pdf->SetFont('Arial','', 8);
                //$pdf->SetXY(147,33  );//Ubicación en PDF
                //$pdf->Cell(20,3,utf8_decode($Tb_MiFechaSalida),0,1,'L');


        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(117,33  );//Ubicación en PDF
        $pdf->Cell(20,3,'Fecha documento:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(147,33  );//Ubicación en PDF
                $pdf->Cell(20,3,utf8_decode(FechaSql($FechaIngreso)),0,1,'L');


        $pdf->SetFont('Arial','B'   , 8);
        $pdf->SetXY(117,37  );//Ubicación en PDF
        $pdf->Cell(20,3,'Fecha Vencimiento:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(147,37  );//Ubicación en PDF
                $pdf->Cell(20,3,utf8_decode(FechaSql($FechaIngreso)),0,1,'L');

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(117,41  );//Ubicación en PDF
        $pdf->Cell(20,3,utf8_decode('Elaborado por:'),0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(147,41  );//Ubicación en PDF
                $pdf->Cell(20,3,utf8_decode($Nombres." ".$Apellidos),0,1,'L');


        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(117,45  );//Ubicación en PDF
        $pdf->Cell(20,3,'Concepto:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(147,45  );//Ubicación en PDF
                $pdf->Cell(20,3, strtoupper("ABONO"),0,1,'L');


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
$pdf->SetXY(20,53  );//Ubicación en PDF 
$pdf->SetFont('Arial','B',9);
$pdf->Cell(25,6,utf8_decode('Ref.'),1,0,'C',1);
$pdf->Cell(77,6,utf8_decode('Concepto'),1,0,'C',1);
$pdf->Cell(36,6,'Medio de pago',1,0,'C',1);
$pdf->Cell(20,6,'Confir.',1,0,'C',1);
$pdf->Cell(20,6,utf8_decode('Valor'),1,0,'C',1);

    
    $EjeInicial=54;
          
$sql ="SELECT Id_Ingreso, Concepto_Ingreso, Medio_Pago,Num_Transaccion,Valor_Ingreso,Nom_MedioPago FROM t_ingresos as A, t_medios_pago as B WHERE Id_Ingreso='".$Cod_Recibo_Caja."' and A.Medio_Pago=B.Id_Medio_Pago";  

$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Id_Ingreso=$row['Id_Ingreso'];
        $Concepto_Ingreso=$row['Concepto_Ingreso'];
        $Medio_Pago=$row['Medio_Pago'];
        $Num_Transaccion=$row['Num_Transaccion'];
        $Valor_Ingreso=$row['Valor_Ingreso'];
        $FormaPago=$row['Nom_MedioPago'];

       

        $EjeInicial=$EjeInicial+5;
    

        $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','', 8);
        $pdf->SetXY(20,$EjeInicial  );//Ubicación en PDF 
        $pdf->Cell(25,5,utf8_encode("RCI".$Id_Ingreso),1,0,'C',1);


        $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(45,$EjeInicial  );//Ubicación en PDF 
        $pdf->Cell(77,5,utf8_encode($Concepto_Ingreso),1,0,'L',1);

        $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(122,$EjeInicial  );//Ubicación en PDF 
        $pdf->Cell(36,5,utf8_encode($FormaPago),1,0,'C',1);

        $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(158,$EjeInicial  );//Ubicación en PDF 
        $pdf->Cell(20,5,utf8_encode($Num_Transaccion),1,0,'C',1);

        $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(178,$EjeInicial  );//Ubicación en PDF 
        $pdf->Cell(20,5,utf8_encode("$ ".number_format($Valor_Ingreso)),1,0,'R',1);
 }
}


$pdf->SetXY(20,59  );//Ubicación en PDF
$pdf->Cell(178,28,'',1,1,'C'); //Caja para productos a facturar //Ancho, Alto, texto,borde,?,centrado
        //$pdf->Line(114,50,114,85);  //linea que divide la caja

$pdf->SetXY(178,87  );//Ubicación en PDF
//$pdf->Cell(20,4,$SumaRecibo,1,1,'R'); //Caja para datos de factura totales //Ancho, Alto, texto,borde,?,centrado
$pdf->Cell(20,5,utf8_encode("$ ".number_format($Valor_Ingreso)),1,1,'R',1);
//$pdf->Line(178,87,178,91);  //linea que divide la caja

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(147,88  );//Ubicación en PDF
        $pdf->Cell(20,3,utf8_decode('Total Abono:'),0,1,'L');
        

        
        //******************************************************************************************************************************
                //firma cliente
        //*************************************************************************************************************************

        //$pdf->SetXY(20,108  );//Ubicación en PDF
        //$pdf->Cell(80,10,'',1,1,'C'); //Caja para firma cliente //Ancho, Alto, texto,borde,?,centrado

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(22,99  );//Ubicación en PDF
        $pdf->Cell(20,3 ,utf8_decode('Revisado por: '),0,1,'L');
        $pdf->Line(50,101,100,101);  //linea para firma

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(22,107  );//Ubicación en PDF
        $pdf->Cell(20,3 ,utf8_decode('Aprobado por: '),0,1,'L');
        $pdf->Line(50,109,100,109);  //linea para firma

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(137,95  );//Ubicación en PDF
        $pdf->Cell(20,3 ,utf8_decode("VALOR SEPARADO: $ ".number_format($Total_Separado)),0,1,'L');
        $pdf->SetXY(137,100  );//Ubicación en PDF
        $pdf->Cell(20,3 ,utf8_decode("TOTAL ABONOS: $ ".number_format($AbonosSepare)),0,1,'L');
         $pdf->SetXY(137,105  );//Ubicación en PDF
        $pdf->Cell(20,3 ,utf8_decode("DEUDA: $ ".number_format($DeudaPendiente)),0,1,'L');

        $pdf->SetXY(136,93  );//Ubicación en PDF
        $pdf->Cell(62,20,'',1,1,'C'); //Caja para datos de factura totales //Ancho, Alto, texto,borde,?,centrado

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(22,119  );//Ubicación en PDF
        $pdf->Cell(20,3 ,utf8_decode('Este abono tiene una vigencia de 45 días a partir de la fecha que se genero, se debe presentar el recibo al momento de la redención '),0,1,'L');
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

        $ValorLetras=convertir($Valor_Ingreso);

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(22,87  );//Ubicación en PDF
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
                $pdf->Output("Facturas/ReciboCajaSepare.pdf",'F');




        echo "<script language='javascript'>window.open('Facturas/ReciboCajaSepare.pdf','_blank','');</script>";

        echo "<script language='javascript'>window.open('Clientes-AbonosSepare.php?AbonosFactura=".$AbonosFactura."','_parent','');</script>";//para ver el archivo pdf generado





        //exit;

        //header('Location: http://www.estrenarcarro.com.co/desarrollo/index.php?option=com_wrapper&view=wrapper&Itemid=1320&lang=en');





    ?>









<!--fin seccion pdf-->







