<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];
include("Lib/permisos.php");
include 'barcode.php';

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

        $TOT_SubTotal=$row['SubTotal'];
        $TOT_Fecha_Ing=$row['Fecha_Ing'];
        $TOT_Fecha_Out=$row['Fecha_Out'];
        


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



        $pdf = new FPDF('P','mm','letter');



        $pdf->AddPage();
/* seleccionamos el tipo, estilo y tamaño de la letra a utilizar */











		{



        $pdf->SetFont('Arial','', 11);



        //Logo



        }

        {
        //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',30,10,41,30);
        }
        // Label IdCotización

        $code="CMCHO1022TL119-L";
        
       
        $pdf->SetXY(0, 0  );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53,25,utf8_decode(''),1,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 8);
         $pdf->SetXY(2,2  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode('CAMISA MANGA LARGA EN LINO'),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',2,8,48,13,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(3, 19  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_decode('$ 24.030.000'),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(35,19  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');

                    
        

        //$pdf->SetXY(130, 25  );//Ubicación en PDF
        //$pdf->SetFontSize(12);//Tamaño de Fuente
        //$pdf->Cell(68,70,utf8_decode('FOTO DE DISEÑO'),1,1,'C'); //Ancho, Alto, texto,borde,?,centrado


        //$pdf->SetFont('Arial','B', 10);
        //$pdf->SetXY(97,37  );//Ubicación en PDF
        //$pdf->Cell(30,3,utf8_decode($Tb_MiFechaIngreso),0,1,'L');
        

        //$pdf->SetFont('Arial','B', 6);
        //$pdf->SetXY(30,27  );//Ubicación en PDF
        //$pdf->Cell(30,3,utf8_decode('NIT 12646038'),0,1,'C');


        //$pdf->SetFont('Arial','B', 6);
        //$pdf->SetXY(30,30  );//Ubicación en PDF
        //$pdf->Cell(30,3,'Valledupar (Cesar)',0,1,'C');


        //$pdf->SetFont('Arial','B', 6);
        //$pdf->SetXY(30,33  );//Ubicación en PDF
        //$pdf->Cell(30,3,'Alexander Baute Agamez',0,1,'C');      

        //$pdf->SetFont('Arial','B', 7);
        //$pdf->SetXY(90,23  );//Ubicación en PDF
        //$pdf->Cell(92,3,utf8_decode('No somos Grandes contribuyentes - IVA Régimen Común'),0,1,'C');

        //$pdf->SetFont('Arial','B', 7);
        //$pdf->SetXY(90,26  );//Ubicación en PDF
        //$pdf->Cell(92,3,utf8_decode('Actividad Económica Principal 4771 Act. ICA - Principal 4771 tarifa ICA 10 * 1000'),0,1,'C');

        //$pdf->SetFont('Arial','B', 7);
        //$pdf->SetXY(100,29  );//Ubicación en PDF
        //$pdf->Cell(92,3,utf8_decode('Resolución DIAN No. 240000037455 del 2016/02/29    '),0,1,'L'); 

        //$pdf->SetFont('Arial','B', 7);
        //$pdf->SetXY(92,32  );//Ubicación en PDF
        //$pdf->Cell(92,3,utf8_decode('Autoriza Impresión por Computador Del No. 0001 hasta el No. 1000'),0,1,'L'); 

           
        //$pdf->SetXY(20,42  );//Ubicación en PDF
        
        //$pdf->Cell(178,20,'',1,1,'C'); //Caja para datos de Cliente y Factura //Ancho, Alto, texto,borde,?,centrado
        //$pdf->Line(114,42,114,62);  //linea que divide la caja

        //datos Cliente

//*************************************************************************************************************************************
// Campo Número de Cliente //**************************************************************************************************************************************
        $pdf->SetFont('Arial','B', 10);
        $pdf->SetXY(23,43  );//Ubicación en PDF
        $pdf->Cell(20,5,utf8_decode('Colección:'),0,1,'L');


                $pdf->SetFont('Arial','', 10);
                $pdf->SetXY(42,43  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode("C000".$Cl_Id_Cliente),0,1,'L');


        $pdf->SetFont('Arial','B', 10);
        $pdf->SetXY(23,48  );//Ubicación en PDF
        $pdf->Cell(20,5,utf8_decode('Diseñador:'),0,1,'L');

                $pdf->SetFont('Arial','', 10);
                $pdf->SetXY(42,48  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode($Cl_Nom_Cliente." ".$Cl_Ape_Cliente),0,1,'L');


        $pdf->SetFont('Arial','B', 10);
        $pdf->SetXY(23,53  );//Ubicación en PDF
        $pdf->Cell(20,5,'Fecha:',0,1,'L');

                $pdf->SetFont('Arial','', 10);
                $pdf->SetXY(42,53  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode($Cl_Documento_Cliente),0,1,'L');

        $pdf->SetFont('Arial','B', 10);
        $pdf->SetXY(23,58  );//Ubicación en PDF
        $pdf->Cell(20,5,utf8_decode('Código:'),0,1,'L');

                $pdf->SetFont('Arial','', 10);
                $pdf->SetXY(42,58  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode($Cl_Direccion),0,1,'L');

        $pdf->SetFont('Arial','B', 10);
        $pdf->SetXY(23,63  );//Ubicación en PDF
        $pdf->Cell(20,5,'Producto:',0,1,'L');

                $pdf->SetFont('Arial','', 10);
                $pdf->SetXY(42,63  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode($Cl_Ciudad_Cliente." - ".$Cl_Pais_Cliente),0,1,'L');

     
        $pdf->SetFont('Arial','B', 10);
        $pdf->SetXY(23,68  );//Ubicación en PDF
        $pdf->Cell(20,5,utf8_decode('Género:'),0,1,'L');

                $pdf->SetFont('Arial','', 10);
                $pdf->SetXY(42,68  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode($Cl_Tel_Cliente),0,1,'L');


        $pdf->SetFont('Arial','B', 10);
        $pdf->SetXY(23,73  );//Ubicación en PDF
        $pdf->Cell(20,5,utf8_decode('Tallas:'),0,1,'L');

                $pdf->SetFont('Arial','', 10);
                $pdf->SetXY(42,73  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode($Cl_Tel_Cliente),0,1,'L');


        //Datos Factura

        //$pdf->SetFont('Arial','B', 8);
        //$pdf->SetXY(117,43  );//Ubicación en PDF
        //$pdf->Cell(20,3,utf8_decode('Fecha Factura:'),0,1,'L');

                //$pdf->SetFont('Arial','', 8);
                //$pdf->SetXY(147,43  );//Ubicación en PDF
                //$pdf->Cell(20,3,utf8_decode($Tb_MiFechaSalida),0,1,'L');


        //$pdf->SetFont('Arial','B', 8);
        //$pdf->SetXY(117,46  );//Ubicación en PDF
        //$pdf->Cell(20,3,'Fecha Vencimiento:',0,1,'L');

                //$pdf->SetFont('Arial','', 8);
                //$pdf->SetXY(147,46  );//Ubicación en PDF
                //$pdf->Cell(20,3,utf8_decode($Tb_MiFechaSalida),0,1,'L');


        //$pdf->SetFont('Arial','B', 8);
        //$pdf->SetXY(117,49  );//Ubicación en PDF
        //$pdf->Cell(20,3,'Vendedor:',0,1,'L');

                //$pdf->SetFont('Arial','', 8);
                //$pdf->SetXY(147,49  );//Ubicación en PDF
                //$pdf->Cell(20,3,utf8_decode(m),0,1,'L');

        //$pdf->SetFont('Arial','B', 8);
        //$pdf->SetXY(117,52  );//Ubicación en PDF
        //$pdf->Cell(20,3,utf8_decode('Almacen:'),0,1,'L');

                //$pdf->SetFont('Arial','', 8);
                //$pdf->SetXY(147,52  );//Ubicación en PDF
                //$pdf->Cell(20,3,utf8_decode(m),0,1,'L');


        //$pdf->SetFont('Arial','B', 8);
        //$pdf->SetXY(117,55  );//Ubicación en PDF
        //$pdf->Cell(20,3,'Forma de Pago:',0,1,'L');

                //$pdf->SetFont('Arial','', 8);
                //$pdf->SetXY(147,55  );//Ubicación en PDF
                //$pdf->Cell(20,3, strtoupper(m),0,1,'L');


        //$pdf->SetFont('Arial','B', 8);
        //$pdf->SetXY(117,58  );//Ubicación en PDF
        //$pdf->Cell(20,3,utf8_decode('Medio de Pago:'),0,1,'L');

                //$pdf->SetFont('Arial','', 8);
                //$pdf->SetXY(147,58  );//Ubicación en PDF
                //$pdf->Cell(20,3,utf8_decode(m),0,1,'L');


        $pdf->SetXY(20, 96  );//Ubicación en PDF
        $pdf->SetFontSize(9);//Tamaño de Fuente
        $pdf->MultiCell(178,4,utf8_decode('DESCRIPCIÓN DEL PRODUCTO Descripción del producto Descripción del producto Descripción del producto Descripción del producto Descripción del producto Descripción del producto Descripción del producto Descripción del producto Descripción del producto Descripción del producto Descripción del producto Descripción del producto Descripción del producto Descripción del producto Descripción del producto Descripción del producto Descripción del producto Descripción del producto Descripción del producto Descripción del producto Descripción del producto Descripción del producto Descripción del producto Descripción del producto Descripción del producto Descripción del producto Descripción del producto Descripción del producto Descripción del producto Descripción del producto Descripción del producto Descripción del producto '),1,"J",false); //Ancho, Alto, texto,borde,?,centrado

//**************************************************************************************************************************************
    //Productos a Facturar
//*************************************************************************************************************************************

        //Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
$pdf->SetFillColor(210,204,203);
$pdf->SetTextColor(2,2,2);
$pdf->SetXY(20,127  );//Ubicación en PDF 
$pdf->SetFont('Arial','B',9);
$pdf->Cell(15,6,utf8_decode('No'),1,0,'C',1);
$pdf->Cell(42,6,utf8_decode('Código'),1,0,'C',1);
$pdf->Cell(86,6,'Nombre Insumo',1,0,'C',1);
$pdf->Cell(35,6,'Cantidad X prenda',1,0,'C',1);
//$pdf->Cell(19,6,'Vr. Unitario',1,0,'C',1); 
//$pdf->Cell(13,6,'IVA',1,0,'C',1);
//$pdf->Cell(27,6,'Total',1,0,'C',1);


$pdf->SetXY(20,133  );//Ubicación en PDF
$pdf->Cell(178,60,'',1,1,'C'); //Caja para productos a facturar //Ancho, Alto, texto,borde,?,centrado
        //$pdf->Line(114,50,114,85);  //linea que divide la caja

//$pdf->SetXY(138,189  );//Ubicación en PDF
//$pdf->Cell(60,16,'',1,1,'C'); //Caja para datos de factura totales //Ancho, Alto, texto,borde,?,centrado
//$pdf->Line(172,189,172,205);  //linea que divide la caja

        //$pdf->SetFont('Arial','B', 8);
        //$pdf->SetXY(139,190  );//Ubicación en PDF
        //$pdf->Cell(20,3,utf8_decode('SUBTOTAL'),0,1,'L');
        //$pdf->Line(138,193,198,193);  //linea que divide la caja

        //$pdf->SetFont('Arial','B', 8);
        //$pdf->SetXY(139,194  );//Ubicación en PDF
        //$pdf->Cell(20,3,utf8_decode('DESCUENTO'),0,1,'L');
        //$pdf->Line(138,197,198,197);  //linea que divide la caja

        //$pdf->SetFont('Arial','B', 8);
        //$pdf->SetXY(139,198  );//Ubicación en PDF
        //$pdf->Cell(20,3,utf8_decode('IVA'),0,1,'L');
        //$pdf->Line(138,201,198,201);  //linea que divide la caja

        //$pdf->SetFont('Arial','B', 8);
        //$pdf->SetXY(139,202  );//Ubicación en PDF
        //$pdf->Cell(20,3 ,utf8_decode('TOTAL FACTURA'),0,1,'L');

        //******************************************************************************************************************************
                //firma cliente
        //*************************************************************************************************************************

        //$pdf->SetXY(20,108  );//Ubicación en PDF
        //$pdf->Cell(80,10,'',1,1,'C'); //Caja para firma cliente //Ancho, Alto, texto,borde,?,centrado

        //$pdf->SetFont('Arial','B', 8);
        //$pdf->SetXY(22,238  );//Ubicación en PDF
        //$pdf->Cell(20,3 ,utf8_decode('Firma de Recibido - C.C: '),0,1,'L');
        //$pdf->Line(57,243,95,243);  //linea para firma

        //$pdf->SetFont('Arial','B', 8);
        //$pdf->SetXY(103,238  );//Ubicación en PDF
        //$pdf->Cell(20,3 ,utf8_decode('Firma Responsable - C.C: '),0,1,'L');
        //$pdf->Line(138,243,193,243);  //linea para firma

 //******************************************************************************************************************************
                //Valor en letras
        //*************************************************************************************************************************

        //$pdf->SetXY(30,93  );//Ubicación en PDF
        //$pdf->Cell(100,10,'',1,1,'C'); //Caja para valor en letras //Ancho, Alto, texto,borde,?,centrado

        //$pdf->SetFont('Arial','B', 8);
        //$pdf->SetXY(22,190  );//Ubicación en PDF
        //$pdf->Cell(20,6 ,utf8_decode('Valor en letras:'),0,1,'L');

                //$pdf->SetFont('Arial','', 8);
                //$pdf->SetXY(25,195  );//Ubicación en PDF
                //$pdf->Cell(20,6,utf8_decode('CUATRO MILLONES QUINIENTOS OCHENTA Y CINCO MIL SEISCIENTOS PESOS'),0,1,'L');



        $pdf->SetXY(20, 204  );//Ubicación en PDF
        $pdf->SetFontSize(9);//Tamaño de Fuente
        $pdf->SetFont('Arial','',9);
        $pdf->MultiCell(178,4,utf8_decode('OBSERVACIONES: Observaciones, Observaciones, Observaciones, Observaciones, Observaciones, Observaciones, Observaciones, observaciones, Observaciones, Observaciones, Observaciones, Observaciones, Observaciones ,Observaciones , Observaciones, Observaciones, Observaciones Observaciones Observaciones Observaciones Observaciones Observaciones Observaciones Observaciones Observaciones Observaciones Observaciones Observaciones'),1,"J",false); //Ancho, Alto, texto,borde,?,centrado
         //******************************************************************************************************************************
                //observacion factura
        //*************************************************************************************************************************

        
        //$pdf->SetXY(20,210  );//Ubicación en PDF
        //$pdf->Cell(100,25,'',1,1,'C'); //Caja para firma cliente //Ancho, Alto, texto,borde,?,centrado

        //$pdf->SetFont('Arial','B', 7);
        //$pdf->SetXY(22,208  );//Ubicación en PDF
        //$pdf->Cell(20,5 ,utf8_decode('Esta factura de venta se asimila en todos sus efectos a la Letra de Cambio según art. 774 '),0,1,'L');
        //$pdf->SetFont('Arial','B', 7);
        //$pdf->SetXY(22,213  );//Ubicación en PDF
        //$pdf->Cell(20,5 ,utf8_decode('Cod. Comercio. Es exigible a su vencimiento y causa un interes de mora mensual liquidado'),0,1,'L');
        //$pdf->SetFont('Arial','B', 7);
        //$pdf->SetXY(22,218  );//Ubicación en PDF
        //$pdf->Cell(20,5 ,utf8_decode('a la tasa máxima permitida de conformidad con los art. 883 y 884 Cód.'),0,1,'L');


                // $pdf->SetFont('Arial','', 8);
                // $pdf->SetXY(147,77  );//Ubicación en PDF
                // $pdf->Cell(20,5,utf8_decode($Tb_MiFechaSalida),0,1,'L');





		



		





        $pdf->SetXY(40,250 );

        $pdf->SetTextColor(40,72,119);

        $pdf->SetFont('Arial','B',8);

        $pdf->Cell(260,2, utf8_decode(' Cr. 9 No. 7C-33 (Valledupar) Barrio Novalito Tels: 5838943 - 300-2886406 Email Modasofaute@hotmail.com '), 0, 'L');

       
       
		        $pdf->Output("Facturas/Factura-HotelArenas.pdf",'F');

















		echo "<script language='javascript'>window.open('Facturas/Factura-HotelArenas.pdf','_blank','');</script>";

		echo "<script language='javascript'>window.open('index.php','_parent','');</script>";//para ver el archivo pdf generado





		//exit;

        //header('Location: http://www.estrenarcarro.com.co/desarrollo/index.php?option=com_wrapper&view=wrapper&Itemid=1320&lang=en');





	?>









<!--fin seccion pdf-->







