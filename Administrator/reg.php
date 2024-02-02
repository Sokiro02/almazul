<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];
include("Lib/permisos.php");

$EstanciaNum=$_POST['CodEst'];

// Tips 
// Todos los que comienzan por B. son de la tabla t_clientes
// Todos los que comienzan por A. son de la tabla T_Estancias
// Todos los que comienzan por C. son de la tabla t_usuarios

$sql ="SELECT date_format(A.Fecha_Ing,CONCAT(CONCAT(ELT(WEEKDAY(A.Fecha_Ing) + 1, 'LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO', 'DOMINGO')),', %d - ',CONCAT(ELT(MONTH(A.Fecha_Ing), 'ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGOS', 'SEP', 'OCT', 'NOV', 'DIC')),'- %Y')) AS MiFechaIngreso ,date_format(A.Fecha_Out,CONCAT(CONCAT(ELT(WEEKDAY(A.Fecha_Out) + 1, 'LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO', 'DOMINGO')),', %d - ',CONCAT(ELT(MONTH(A.Fecha_Out), 'ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGOS', 'SEP', 'OCT', 'NOV', 'DIC')),'- %Y')) AS MiFechaSalida,B.Id_Cliente, B.Tipo_Cliente, B.Documento_Cliente, B.Nom_Cliente, B.Ape_Cliente, B.Pais_Cliente, B.Ciudad_Cliente, B.Correo_Cliente, B.Tel_Cliente, B.Cel1_Cliente, B.Cel2_Cliente, B.Sector,A.Id_Estancia, A.Cod_Estancia, A.Tipo_Id_Tipo_Habitacion, A.Habitacion_Id_Habitacion, A.Valor_Unitario, A.Cantidad, A.Cliente_Id_Cliente, A.Tipo_Estancia, A.Estado_Estancia, A.Porcentaje_Descuento, A.Valor_Descuento, A.Iva_Aplicado, A.Valor_Iva, A.SubTotal, A.Tipo_Recibo, A.Factura_Num, A.Usuario_Id_Usuario, A.Hotel_Id_Hotel, A.Marca_Termporal, A.Fecha_Ing, A.Fecha_Out, A.Fecha_Solicitud, C.Nombres, C.Apellidos FROM T_Estancias as A, t_clientes as B, t_usuarios as C  WHERE  A.Cliente_Id_Cliente=B.Id_Cliente and A.Usuario_Id_Usuario=C.Id_Usuario and  Cod_Estancia='".$EstanciaNum."'"; 


$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Tb_MiFechaIngreso=$row['MiFechaIngreso'];
        $Tb_MiFechaSalida=$row['MiFechaSalida'];
        // Variables de la tabla Clientes

        $Cl_Id_Cliente=$row['Id_Cliente'];
        $Cl_Tipo_Cliente=$row['Tipo_Cliente'];
        $Cl_Documento_Cliente=$row['Documento_Cliente'];
        $Cl_Nom_Cliente=$row['Nom_Cliente'];
        $Cl_Ape_Cliente=$row['Ape_Cliente'];
        $Cl_Pais_Cliente=$row['Pais_Cliente'];
        $Cl_Ciudad_Cliente=$row['Ciudad_Cliente'];
        $Cl_Correo_Cliente=$row['Correo_Cliente'];
        $Cl_Tel_Cliente=$row['Tel_Cliente'];

        // Variables de la tabla Datos Factura

        $EST_Cod_Estancia=$row['Cod_Estancia'];
        $EST_Fecha_Ing=$row['Fecha_Ing'];
        $EST_Fecha_Out=$row['Fecha_Out'];
        $EST_Nombres=$row['Nombres'];
        $EST_Apellidos=$row['Apellidos'];
        $Inicial=substr($EST_Apellidos, 0,1);
        


        //

        $Tb_Valor_Unitario=$row['Valor_Unitario'];
        $Tb_Iva_Aplicado=$row['Iva_Aplicado'];
        $V1=round((($Tb_Valor_Unitario*$Tb_Iva_Aplicado)/100),1);
        $V2=round(($V1+$Tb_Valor_Unitario),1);

 }
}



?>
<!--seccion que genera el pdf-->
<?php

/* http://programarenphp.wordpress.com */



/* incluimos primeramente el archivo que contiene la clase fpdf */



include ('fpdf/fpdf.php');



/* tenemos que generar una instancia de la clase */



        $pdf = new FPDF();



        $pdf->AddPage();
/* seleccionamos el tipo, estilo y tamaño de la letra a utilizar */











		{



        $pdf->SetFont('Arial','', 11);



        //Logo



        }

        {
        $pdf-> Image('images/IconosFactura/Logo_Hotel_Arenas.jpg',24,10,34,31);
        }
        // Label IdCotización

        

        $pdf->SetXY(94, 20  );//Ubicación en PDF
        $pdf->SetFontSize(17);//Tamaño de Fuente
        $pdf->Cell(96,10,utf8_decode('FACTURA DE VENTA N°'.$EstanciaNum),1,1,'C'); //Ancho, Alto, texto,borde,?,centrado
        

        $pdf->SetFont('Arial','B', 6);
        $pdf->SetXY(27,37  );//Ubicación en PDF
        $pdf->Cell(30,3,utf8_decode('NIT 40.797.862-8'),0,1,'C');


        $pdf->SetFont('Arial','B', 6);
        $pdf->SetXY(27,40  );//Ubicación en PDF
        $pdf->Cell(30,3,'Riohacha (la Guajira)',0,1,'C');


        $pdf->SetFont('Arial','B', 6);
        $pdf->SetXY(27,43  );//Ubicación en PDF
        $pdf->Cell(30,3,'Nidia Zabaleta Morales',0,1,'C');       

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(90,37  );//Ubicación en PDF
        $pdf->Cell(92,3,utf8_decode('Régimen Común *Res. Facturación No 18762000190236* 2016/08/22 '),0,1,'L');

        $pdf->SetFont('Arial','B', 8);
        $pdf->SetXY(115,40  );//Ubicación en PDF
        $pdf->Cell(92,3,utf8_decode('Num Autorizada 6501 al 7000'),0,1,'L'); 

    
        $pdf->SetXY(20,50  );//Ubicación en PDF
        
        $pdf->Cell(178,35,'',1,1,'C'); //Caja para datos de Cliente y Factura //Ancho, Alto, texto,borde,?,centrado
        $pdf->Line(114,50,114,85);  //linea que divide la caja

        //datos Cliente

//*************************************************************************************************************************************
// Campo Número de Cliente //**************************************************************************************************************************************
        $pdf->SetFont('Arial','B', 9);
        $pdf->SetXY(23,52  );//Ubicación en PDF
        $pdf->Cell(20,5,utf8_decode('Nº Cliente:'),0,1,'L');


                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(42,52  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode("C000".$Cl_Id_Cliente),0,1,'L');


        $pdf->SetFont('Arial','B', 9);
        $pdf->SetXY(23,57  );//Ubicación en PDF
        $pdf->Cell(20,5,'Cliente:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(42,57  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode($Cl_Nom_Cliente." ".$Cl_Ape_Cliente),0,1,'L');


        $pdf->SetFont('Arial','B', 9);
        $pdf->SetXY(23,62  );//Ubicación en PDF
        $pdf->Cell(20,5,'Nit - C.C:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(42,62  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode($Cl_Documento_Cliente),0,1,'L');


        $pdf->SetFont('Arial','B', 9);
        $pdf->SetXY(23,67  );//Ubicación en PDF
        $pdf->Cell(20,5,'Ciudad:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(42,67  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode($Cl_Ciudad_Cliente." - ".$Cl_Pais_Cliente),0,1,'L');


        $pdf->SetFont('Arial','B', 9);
        $pdf->SetXY(23,72  );//Ubicación en PDF
        $pdf->Cell(20,5,'Email:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(42,72  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode($Cl_Correo_Cliente),0,1,'L');

        $pdf->SetFont('Arial','B', 9);
        $pdf->SetXY(23,77  );//Ubicación en PDF
        $pdf->Cell(20,5,utf8_decode('Teléfono:'),0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(42,77  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode($Cl_Tel_Cliente),0,1,'L');

        //Datos factura

        $pdf->SetFont('Arial','B', 9);
        $pdf->SetXY(117,52  );//Ubicación en PDF
        $pdf->Cell(20,5,utf8_decode('Nº de Estancia:'),0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(147,52  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode($EST_Cod_Estancia),0,1,'L');


        $pdf->SetFont('Arial','B', 9);
        $pdf->SetXY(117,57  );//Ubicación en PDF
        $pdf->Cell(20,5,'Fecha de Ingreso:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(147,57  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode($Tb_MiFechaIngreso),0,1,'L');


        $pdf->SetFont('Arial','B', 9);
        $pdf->SetXY(117,62  );//Ubicación en PDF
        $pdf->Cell(20,5,'Fecha de salida:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(147,62  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode($Tb_MiFechaSalida),0,1,'L');

        $pdf->SetFont('Arial','B', 9);
        $pdf->SetXY(117,67  );//Ubicación en PDF
        $pdf->Cell(20,5,'Forma de Pago:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(147,67  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode(),0,1,'L');


        $pdf->SetFont('Arial','B', 9);
        $pdf->SetXY(117,72  );//Ubicación en PDF
        $pdf->Cell(20,5,'Atendido por:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(147,72  );//Ubicación en PDF
                $pdf->Cell(20,5, strtoupper($EST_Nombres." ".$Inicial."."),0,1,'L');


        $pdf->SetFont('Arial','B', 9);
        $pdf->SetXY(117,77  );//Ubicación en PDF
        $pdf->Cell(20,5,utf8_decode('Fecha Factura:'),0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(147,77  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode($Tb_MiFechaSalida),0,1,'L');



        //Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
$pdf->SetFillColor(250,174,96);
$pdf->SetTextColor(40,72,119);
$pdf->SetXY(20,90  );//Ubicación en PDF 
$pdf->SetFont('Arial','B',9);
$pdf->Cell(10,6,'Item',1,0,'C',1);
$pdf->Cell(75,6,utf8_decode('Descripción'),1,0,'C',1);
$pdf->Cell(17,6,'Cantidad',1,0,'C',1);
$pdf->Cell(29,6,'Valor Unidad',1,0,'C',1);
$pdf->Cell(10,6,'Dcto.',1,0,'C',1); 
$pdf->Cell(10,6,'IVA',1,0,'C',1);
$pdf->Cell(27,6,'Subtotal',1,0,'C',1);

$EjeInicial=92;
		  
$sql ="SELECT Num_Habitacion,Precio_Noche FROM T_Habitaciones order by Num_Habitacion asc";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $FA_Num_Habitacion=$row['Num_Habitacion'];
        $FA_Nom_Habitacion=$row['Precio_Noche'];



        $EjeInicial=$EjeInicial+5;

        $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(20,$EjeInicial  );//Ubicación en PDF 
        $pdf->Cell(27,4,utf8_encode($FA_Num_Habitacion),0,0,'L',1);


        $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(60,$EjeInicial  );//Ubicación en PDF 
        $pdf->Cell(27,4,utf8_encode($FA_Nom_Habitacion),1,0,'C',1);
        

 }
}







        $pdf->SetXY(12, 242);

        $pdf->SetTextColor(40,40,40);

        $pdf->MultiCell(175,4, utf8_decode('¡ADVERTENCIA!  Esta cotización es confidencial, contiene información privilegiada. Todas las condiciones, especificaciones e información que pudieren ser suministradas por EstrenarCarro.com SAS En relación a esta negociación, serán confidenciales y solamente podrán ser utilizadas, para el cumplimiento de la orden de compra. Precios plazos y condiciones pueden tener variación sin previo aviso.'), 0, 'J');


		        $pdf->Output("Facturas/Factura-HotelArenas.pdf",'F');















		echo "<script language='javascript'>window.open('Facturas/Factura-HotelArenas.pdf','_blank','');</script>";

		echo "<script language='javascript'>window.open('index.php','_parent','');</script>";//para ver el archivo pdf generado





		//exit;

        //header('Location: http://www.estrenarcarro.com.co/desarrollo/index.php?option=com_wrapper&view=wrapper&Itemid=1320&lang=en');





	?>









<!--fin seccion pdf-->







