<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];
include("Lib/permisos.php");

$OrdenCompraNum=$_GET['OrdenProv'];
$ProveedorSel=$_GET['Pro'];
$BodegaSel=$_GET['Bod'];


// Consulta Proveedor
$sql ="SELECT Id_Proveedor, Nom_Prov, Nit_Prov, Dir_Prov, Tel_Prov, Cel1_Prov, Whp_Prov, Email_Prov, Contacto_Prov, Nom_Ciudad, Tipo_Insumo FROM t_proveedores as A, t_ciudades as B WHERE A.Ciudad_Id_Ciudad=B.Id_Ciudad and Id_Proveedor='".$ProveedorSel."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Qr_Id_Proveedor=$row['Id_Proveedor'];
        $Qr_Nom_Prov=$row['Nom_Prov'];
        $Qr_Nit_Prov=$row['Nit_Prov'];
        $Qr_Dir_Prov=$row['Dir_Prov'];
        $Qr_Tel_Prov=$row['Tel_Prov'];
        $Qr_Cel1_Prov=$row['Cel1_Prov'];
        $Qr_Whp_Prov=$row['Whp_Prov'];
        $Qr_Email_Prov=$row['Email_Prov'];
        $Qr_Contacto_Prov=$row['Contacto_Prov'];
        $Qr_Nom_Ciudad_Proveedor=$row['Nom_Ciudad'];
        $Qr_Tipo_Insumo=$row['Tipo_Insumo'];
 }
}

// Consulta Bodega

$sql ="SELECT Nom_Ciudad,Id_Bodega, Cod_Bodega, Nom_Bodega, Usuario_Encargado, Dir_Bodega, Tel_Bodega,Cel_Bodega, Correo_Bodega, Ciudad_Id_Ciudad,Nombres,Apellidos FROM t_bodegas as A, t_ciudades as B, t_usuarios as C WHERE A.Ciudad_Id_Ciudad=B.Id_Ciudad and A.Usuario_Encargado=C.Id_Usuario and Id_Bodega='".$BodegaSel."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Qr_Id_Bodega=$row['Id_Bodega'];
        $Qr_Cod_Bodega=$row['Cod_Bodega'];
        $Qr_Nom_Bodega=$row['Nom_Bodega'];
        $Qr_Dir_Bodega=$row['Dir_Bodega'];
        $Qr_Tel_Bodega=$row['Tel_Bodega'];
        $Qr_Cel_Bodega=$row['Cel_Bodega'];
        $Qr_Correo_Bodega=$row['Correo_Bodega'];
        $Qr_Nom_Ciudad_Bodega=$row['Nom_Ciudad'];

 }
}

// Solicitud de Orden de Compra

$sql ="SELECT  date_format(Fecha_Solicitud,CONCAT(CONCAT(ELT(WEEKDAY(Fecha_Solicitud) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(Fecha_Solicitud), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS FechaSolicitud,date_format(Fecha_Est_Llegada,CONCAT(CONCAT(ELT(WEEKDAY(Fecha_Est_Llegada) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(Fecha_Est_Llegada), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS FechaEstimada,Cod_Orden_Prov,B.Nombres,B.Apellidos FROM t_orden_compra_insumos AS A, t_usuarios as B WHERE Cod_Orden_Prov='".$OrdenCompraNum."' and A.Usuario_Responsable=B.Id_Usuario"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Tb_FechaSolicitud=$row['FechaSolicitud'];
        $Tb_FechaEstimada=$row['FechaEstimada'];
        $Tb_Cod_Orden_Prov=$row['Cod_Orden_Prov'];
        $Tb_Nombres=$row['Nombres'];
        $Tb_Apellidos=$row['Apellidos'];
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
        $pdf-> Image('images/IconosFactura/Logo.jpg',30,10,34,31);
        }
        // Label IdCotización

        

        $pdf->SetXY(94, 20  );//Ubicación en PDF
        $pdf->SetFontSize(17);//Tamaño de Fuente
        $pdf->Cell(96,10,utf8_decode('ORDEN DE COMPRA N°'.$OrdenCompraNum),1,1,'C'); //Ancho, Alto, texto,borde,?,centrado


        //$pdf->SetFont('Arial','B', 10);
        //$pdf->SetXY(97,37  );//Ubicación en PDF
        //$pdf->Cell(30,3,utf8_decode($Tb_MiFechaIngreso),0,1,'L');
        

        //$pdf->SetFont('Arial','B', 6);
        //$pdf->SetXY(27,37  );//Ubicación en PDF
        //$pdf->Cell(30,3,utf8_decode('NIT 40.797.862-8'),0,1,'C');


        //$pdf->SetFont('Arial','B', 6);
        //$pdf->SetXY(27,40  );//Ubicación en PDF
        //$pdf->Cell(30,3,'Riohacha (la Guajira)',0,1,'C');


        //$pdf->SetFont('Arial','B', 6);
        //$pdf->SetXY(27,43  );//Ubicación en PDF
        //$pdf->Cell(30,3,'Nidia Zabaleta Morales',0,1,'C');       

           
        $pdf->SetXY(20,50  );//Ubicación en PDF
        
        $pdf->Cell(178,35,'',1,1,'C'); //Caja para datos de Cliente y Factura //Ancho, Alto, texto,borde,?,centrado
        $pdf->Line(114,50,114,85);  //linea que divide la caja

        //datos Cliente

//*************************************************************************************************************************************
// Campo Número de Cliente //**************************************************************************************************************************************
        $pdf->SetFont('Arial','B', 9);
        $pdf->SetXY(23,52  );//Ubicación en PDF
        $pdf->Cell(20,5,utf8_decode('Nº Proveedor:'),0,1,'L');


                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(45,52  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode("P000".$Qr_Id_Proveedor),0,1,'L');


        $pdf->SetFont('Arial','B', 9);
        $pdf->SetXY(23,57  );//Ubicación en PDF
        $pdf->Cell(20,5,'Proveedor:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(45,57  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode($Qr_Nom_Prov),0,1,'L');


        $pdf->SetFont('Arial','B', 9);
        $pdf->SetXY(23,62  );//Ubicación en PDF
        $pdf->Cell(20,5,'Nit - C.C:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(45,62  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode($Qr_Nit_Prov),0,1,'L');


        $pdf->SetFont('Arial','B', 9);
        $pdf->SetXY(23,67  );//Ubicación en PDF
        $pdf->Cell(20,5,'Ciudad:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(45,67  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode($Qr_Nom_Ciudad_Proveedor),0,1,'L');


        $pdf->SetFont('Arial','B', 9);
        $pdf->SetXY(23,72  );//Ubicación en PDF
        $pdf->Cell(20,5,'Email:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(45,72  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode($Qr_Email_Prov),0,1,'L');

        $pdf->SetFont('Arial','B', 9);
        $pdf->SetXY(23,77  );//Ubicación en PDF
        $pdf->Cell(20,5,utf8_decode('Teléfono:'),0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(45,77  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode($Qr_Cel1_Prov."//".$Qr_Whp_Prov),0,1,'L');

        //Datos Orden de compra

        $pdf->SetFont('Arial','B', 9);
        $pdf->SetXY(117,52  );//Ubicación en PDF
        $pdf->Cell(20,5,utf8_decode('Fecha Solicitud:'),0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(147,52  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode($Tb_FechaSolicitud),0,1,'L');


        $pdf->SetFont('Arial','B', 9);
        $pdf->SetXY(117,57  );//Ubicación en PDF
        $pdf->Cell(20,5,'Solicitado Por:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(147,57  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode($Tb_Nombres." ".$Tb_Apellidos),0,1,'L');


        $pdf->SetFont('Arial','B', 9);
        $pdf->SetXY(117,62  );//Ubicación en PDF
        $pdf->Cell(20,5,'Enviar a:',0,1,'L');

                $pdf->SetFont('Arial','', 6);
                $pdf->SetXY(147,62  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode($Qr_Nom_Bodega),0,1,'L');

        $pdf->SetFont('Arial','B', 9);
        $pdf->SetXY(117,67  );//Ubicación en PDF
        $pdf->Cell(20,5,utf8_decode('Dirección:'),0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(147,67  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode($Qr_Dir_Bodega),0,1,'L');


        $pdf->SetFont('Arial','B', 9);
        $pdf->SetXY(117,72  );//Ubicación en PDF
        $pdf->Cell(20,5,'Ciudad:',0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(147,72  );//Ubicación en PDF
                $pdf->Cell(20,5, strtoupper($Qr_Nom_Ciudad_Bodega),0,1,'L');


        $pdf->SetFont('Arial','B', 9);
        $pdf->SetXY(117,77  );//Ubicación en PDF
        $pdf->Cell(20,5,utf8_decode('Fecha LLegada:'),0,1,'L');

                $pdf->SetFont('Arial','', 8);
                $pdf->SetXY(147,77  );//Ubicación en PDF
                $pdf->Cell(20,5,($Tb_FechaEstimada),0,1,'L');

//**************************************************************************************************************************************
    //Productos a Facturar
//*************************************************************************************************************************************

        //Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
$pdf->SetFillColor(128,128,128);
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(20,88  );//Ubicación en PDF 
$pdf->SetFont('Arial','B',9);
$pdf->Cell(20,6,utf8_decode('Cód Insumo'),1,0,'C',1);
$pdf->Cell(72,6,utf8_decode('Nombre Insumo'),1,0,'C',1);
$pdf->Cell(16,6,'Categoria',1,0,'C',1);
$pdf->Cell(13,6,'Lote',1,0,'C',1);
$pdf->Cell(15,6,'Costo',1,0,'C',1); 
$pdf->Cell(15,6,'Cantidad',1,0,'C',1);
$pdf->Cell(27,6,'Subtotal',1,0,'C',1);


$EjeInicial=90;
          
$sql ="SELECT Cantidad_Solicitada,Lote_Insumo,Insumo_Cod_Insumo,A.Costo_Insumo,B.Cod_Insumo,B.Nom_Insumo,B.Unidad_Insumo FROM t_orden_compra_insumos as A, t_insumos as B WHERE A.Insumo_Cod_Insumo=B.Id_Insumo and Cod_Orden_Prov='".$OrdenCompraNum."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Orden_Insumo_Cod_Insumo=$row['Insumo_Cod_Insumo'];
        $Orden_Costo_Insumo=$row['Costo_Insumo'];
        $Orden_Cod_Insumo=$row['Cod_Insumo'];
        $Orden_Nom_Insumo=$row['Nom_Insumo'];
        $Orden_Lote_Insumo=$row['Lote_Insumo'];
        $Orden_Unidad_Insumo=$row['Unidad_Insumo'];
        $Orden_Cantidad_Solicitada=$row['Cantidad_Solicitada'];
        $Orden_Subtotal=$Orden_Cantidad_Solicitada*$Orden_Costo_Insumo;
        $CodFinal=$Orden_Cod_Insumo."-".$Orden_Insumo_Cod_Insumo;
        $IvaAplicado=19/100+1;

       $TarifaSinIva=round(($Orden_Costo_Insumo/$IvaAplicado),1);
        $SubTotal=round((($TarifaSinIva*$Orden_Cantidad_Solicitada)),1);
//$ValorIva=round((($SubTotal*$IvaFinal)/100),1);
//$SumaTotal=$SubTotal+$ValorIva;

        setlocale(LC_MONETARY,"en_US");

        $EjeInicial=$EjeInicial+4;

        $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','', 8);
        $pdf->SetXY(20,$EjeInicial  );//Ubicación en PDF 
        $pdf->Cell(27,4,utf8_encode($CodFinal),1,0,'L',1);


        $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(0,0,0);

        $pdf->SetXY(40,$EjeInicial  );//Ubicación en PDF 
        $pdf->Cell(72,4,utf8_encode($Orden_Nom_Insumo),1,0,'L',1);

        $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(112,$EjeInicial  );//Ubicación en PDF 
        $pdf->Cell(16,4,utf8_encode($CodFinal),1,0,'L',1);

         $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(128,$EjeInicial  );//Ubicación en PDF 
        $pdf->Cell(13,4,utf8_encode($Orden_Lote_Insumo),1,0,'C',1);

         $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(141,$EjeInicial  );//Ubicación en PDF 
        $pdf->Cell(15,4,utf8_encode("$ ".number_format($TarifaSinIva)),1,0,'C',1);

         $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(156,$EjeInicial  );//Ubicación en PDF 
        $pdf->Cell(15,4,utf8_encode($Orden_Cantidad_Solicitada." ".$Orden_Unidad_Insumo),1,0,'C',1);

         $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(171,$EjeInicial  );//Ubicación en PDF 
        $pdf->Cell(27,4,utf8_encode("$ ".number_format($SubTotal)),1,0,'R',1);
        

 }
}


$pdf->SetXY(20,94  );//Ubicación en PDF
$pdf->Cell(178,113,'',1,1,'C'); //Caja para datos a facturar //Ancho, Alto, texto,borde,?,centrado
        //$pdf->Line(114,50,114,85);  //linea que divide la caja

$pdf->SetXY(138,207  );//Ubicación en PDF
$pdf->Cell(60,25,'',1,1,'C'); //Caja para datos a facturar totales //Ancho, Alto, texto,borde,?,centrado
$pdf->Line(172,207,172,232);  //linea que divide la caja

        $pdf->SetFont('Arial','B', 9);
        $pdf->SetXY(139,209  );//Ubicación en PDF
        $pdf->Cell(20,5,utf8_decode('SubTotal'),0,1,'L');
        $pdf->Line(138,214,198,214);  //linea que divide la caja

        $pdf->SetFont('Arial','B', 9);
        $pdf->SetXY(139,215  );//Ubicación en PDF
        $pdf->Cell(20,6,utf8_decode('IVA'),0,1,'L');
        $pdf->Line(138,220,198,220);  //linea que divide la caja

        $pdf->SetFont('Arial','B', 9);
        $pdf->SetXY(139,220  );//Ubicación en PDF
        $pdf->Cell(20,6,utf8_decode('Retención'),0,1,'L');
        $pdf->Line(138,226,198,226);  //linea que divide la caja

        $pdf->SetFont('Arial','B', 9);
        $pdf->SetXY(139,226  );//Ubicación en PDF
        $pdf->Cell(20,6 ,utf8_decode('Valor Total'),0,1,'L');

        //******************************************************************************************************************************
                //firma cliente
        //*************************************************************************************************************************

        $pdf->SetXY(30,240  );//Ubicación en PDF
        $pdf->Cell(80,20,'',1,1,'C'); //Caja para firma cliente //Ancho, Alto, texto,borde,?,centrado

        $pdf->SetFont('Arial','B', 9);
        $pdf->SetXY(32,254  );//Ubicación en PDF
        $pdf->Cell(20,6 ,utf8_decode('Firma de Recibido - C.C'),0,1,'L');

         //******************************************************************************************************************************
                //Valor en letras
        //*************************************************************************************************************************

        
        $pdf->SetXY(20,210  );//Ubicación en PDF
        $pdf->Cell(100,25,'',1,1,'C'); //Caja para firma cliente //Ancho, Alto, texto,borde,?,centrado

        $pdf->SetFont('Arial','B', 9);
        $pdf->SetXY(22,212  );//Ubicación en PDF
        $pdf->Cell(20,6 ,utf8_decode('Observaciones de recibido:'),0,1,'L');


                // $pdf->SetFont('Arial','', 8);
                // $pdf->SetXY(147,77  );//Ubicación en PDF
                // $pdf->Cell(20,5,utf8_decode($Tb_MiFechaSalida),0,1,'L');




        $pdf->SetXY(20, 265);

        $pdf->SetTextColor(40,72,119);

        $pdf->SetFont('Arial','B',8);

        $pdf->MultiCell(175,3, utf8_decode('               A L L-B A U T E by ALEX BAUTE Tél: 57 3002886406
            V/PAR cra 9 # 7C-33 - BQUILLA cra 51B # 84-121. - MONTERÍA C.C Alamedas loc 1-24'), 0, 'C');

        


		        $pdf->Output("Facturas/Orden_De_Compra.pdf",'F');















		echo "<script language='javascript'>window.open('Facturas/Orden_De_Compra.pdf','_blank','');</script>";

		echo "<script language='javascript'>window.open('compras.php','_parent','');</script>";//para ver el archivo pdf generado





		//exit;

        //header('Location: http://www.estrenarcarro.com.co/desarrollo/index.php?option=com_wrapper&view=wrapper&Itemid=1320&lang=en');





	?>









<!--fin seccion pdf-->







