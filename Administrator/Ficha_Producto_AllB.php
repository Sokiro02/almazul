<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];
include("Lib/permisos.php");

$Referencia=$_GET['Ref'];
$Solicitud=$_GET['Solicitud'];


include("Lib/seguridad.php");
$Datos="Creada la ficha del producto: ".$Referencia;
$Paginas= $_SERVER['PHP_SELF'];
$seguridad = AgregarLog($IdUser,$Datos,$Paginas);

// Tips 

$sql ="SELECT date_format(Fecha_Creacion,CONCAT(CONCAT(ELT(WEEKDAY(Fecha_Creacion) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(Fecha_Creacion), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS CreadaFecha,Id_Referencia, Cod_Referencia, Img_Referencia, Fecha_Creacion,Estado_Ref, Costo_Proyectado_Pref, V_Mano_Obra_Ref, PVP_Ref, P_Mayor, Ref_Publicada,Coleccion_Nom_Coleccion,Insumo_Ppal,Nom_SubCat_Producto,Nom_Cat_Producto,Tipo_Tela,Detalle_Referencia  FROM t_referencias AS A, t_subcategoria_producto AS B, t_categoria_producto as C WHERE Cod_Referencia='".$Referencia."' and A.SubCategoria_Id_Subcategoria_Prod=B.Id_SubCat_Producto and A.Categoria_Id_Categoria_Prod=C.Id_Cat_Producto";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$Id_Referencia=$row['Id_Referencia'];
$Cod_Referencia=$row['Cod_Referencia'];
$Img_Referencia=$row['Img_Referencia'];
$Fecha_Creacion=$row['Fecha_Creacion'];
$Coleccion_Nom_Coleccion=$row['Coleccion_Nom_Coleccion'];
$CreadaFecha=$row['CreadaFecha'];
$Estado_Ref=$row['Estado_Ref'];
$Costo_Proyectado_Pref=$row['Costo_Proyectado_Pref'];
$PVP_Ref=$row['PVP_Ref'];
$P_Mayor=$row['P_Mayor'];
$Detalle_Referencia=$row['Detalle_Referencia'];
$Insumo_Ppal=$row['Insumo_Ppal'];
$Nom_SubCat_Producto=$row['Nom_SubCat_Producto'];
$Nom_Cat_Producto=$row['Nom_Cat_Producto'];
$Tipo_Tela=$row['Tipo_Tela'];

$Operacion1=((int)$Costo_Proyectado_Pref/(int) $PVP_Ref);
$Operacion2=(1-$Operacion1);
$Operacion3=$Operacion2*100;
$UtilidadBruta=$Operacion3;
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

        $pdf->SetXY(70, 10  );//Ubicación en PDF
        $pdf->SetFontSize(12);//Tamaño de Fuente
        $pdf->Cell(78,10,utf8_decode("FICHA TÉCNICA REF.".$Cod_Referencia),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado
        

        $pdf->SetXY(130, 25  );//Ubicación en PDF
        $pdf->SetFontSize(12);//Tamaño de Fuente
        $pdf-> Image($Img_Referencia,138,25,60,65);
        //$pdf->Cell(68,70,utf8_decode($Img_Referencia),1,1,'C'); //Ancho, Alto, texto,borde,?,centrado


       
//*************************************************************************************************************************************
// Campo Número de Cliente //**************************************************************************************************************************************

         $pdf-> Image('images/Logos/Logo-blanco.png',20,20,40,20);

        $pdf->SetFont('Arial','B', 10);
        $pdf->SetXY(23,43  );//Ubicación en PDF
        $pdf->Cell(20,5,utf8_decode('Colección:'),0,1,'L');


                $pdf->SetFont('Arial','', 10);
                $pdf->SetXY(51,43  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode($Coleccion_Nom_Coleccion),0,1,'L');


        $pdf->SetFont('Arial','B', 10);
        $pdf->SetXY(23,48  );//Ubicación en PDF
        $pdf->Cell(20,5,utf8_decode('Diseñador:'),0,1,'L');

                $pdf->SetFont('Arial','', 10);
                $pdf->SetXY(51,48  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode("ALEX BAUTE"),0,1,'L');


        $pdf->SetFont('Arial','B', 10);
        $pdf->SetXY(23,53  );//Ubicación en PDF
        $pdf->Cell(20,5,utf8_decode('Fecha Diseño:'),0,1,'L');

                $pdf->SetFont('Arial','', 10);
                $pdf->SetXY(51,53  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode($CreadaFecha),0,1,'L');

        $pdf->SetFont('Arial','B', 10);
        $pdf->SetXY(23,58  );//Ubicación en PDF
        $pdf->Cell(20,5,utf8_decode('Código:'),0,1,'L');

                $pdf->SetFont('Arial','', 10);
                $pdf->SetXY(51,58  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode($Cod_Referencia),0,1,'L');

        $pdf->SetFont('Arial','B', 10);
        $pdf->SetXY(23,63  );//Ubicación en PDF
        $pdf->Cell(20,5,'Producto:',0,1,'L');

                $pdf->SetFont('Arial','', 10);
                $pdf->SetXY(51,63  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

     
        $pdf->SetFont('Arial','B', 10);
        $pdf->SetXY(23,68  );//Ubicación en PDF
        $pdf->Cell(20,5,utf8_decode('Género:'),0,1,'L');

                $pdf->SetFont('Arial','', 10);
                $pdf->SetXY(51,68  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode($Nom_SubCat_Producto),0,1,'L');


        $pdf->SetFont('Arial','B', 10);
        $pdf->SetXY(23,73  );//Ubicación en PDF
        $pdf->Cell(20,5,utf8_decode('Insumo Ppal.:'),0,1,'L');

                $pdf->SetFont('Arial','', 10);
                $pdf->SetXY(51,73  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode("Cód. ".$Insumo_Ppal." ".$Tipo_Tela),0,1,'L');

        $pdf->SetFont('Arial','B', 10);
        $pdf->SetXY(23,78  );//Ubicación en PDF
        $pdf->Cell(20,5,utf8_decode('P.V.P:'),0,1,'L');

                $pdf->SetFont('Arial','', 10);
                $pdf->SetXY(51,78  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode("$ ".number_format($PVP_Ref)),0,1,'L');

         $pdf->SetFont('Arial','B', 10);
        $pdf->SetXY(23,83  );//Ubicación en PDF
        $pdf->Cell(20,5,utf8_decode('V. X Mayor:'),0,1,'L');

                $pdf->SetFont('Arial','', 10);
                $pdf->SetXY(51,83  );//Ubicación en PDF
                $pdf->Cell(20,5,utf8_decode("$ ".number_format($P_Mayor)),0,1,'L');

        $pdf->SetXY(20, 96  );//Ubicación en PDF
        $pdf->SetFontSize(9);//Tamaño de Fuente
        $pdf->MultiCell(178,4,("DETALLES:  ".$Detalle_Referencia),0,"J",false); //Ancho, Alto, texto,borde,?,centrado

//**************************************************************************************************************************************
    //Productos a Facturar
//*************************************************************************************************************************************

        //Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra

                
                $pdf->SetXY(20,127  );//Ubicación en PDF
                $pdf->Cell(178,70,'',1,1,'L');

$pdf->SetFillColor(210,204,203);
$pdf->SetTextColor(2,2,2);
$pdf->SetXY(20,127  );//Ubicación en PDF 
$pdf->SetFont('Arial','B',9);
$pdf->Cell(15,6,utf8_decode('No'),1,0,'C',1);
$pdf->Cell(42,6,utf8_decode('Código Insumo'),1,0,'C',1);
$pdf->Cell(86,6,'Insumo',1,0,'C',1);
$pdf->Cell(35,6,'Cantidad X Prenda',1,0,'C',1);
//$pdf->Cell(19,6,'Vr. Unitario',1,0,'C',1); 
//$pdf->Cell(13,6,'IVA',1,0,'C',1);
//$pdf->Cell(27,6,'Total',1,0,'C',1);


$EjeInicial=129;
$Consecutivo=0;
          
$sql ="SELECT A.Cod_Insumo, Cant_Solicitada,Nom_Insumo,Unidad_Insumo FROM t_insumos_ref AS A, t_insumos as B WHERE Referencia_Cod_Referencia='".$Cod_Referencia."' and A.Cod_Insumo=B.Cod_Insumo";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Cod_Insumo=$row['Cod_Insumo'];
        $Cant_Solicitada=$row['Cant_Solicitada'];
        $Orden_Cod_Insumo=$row['Cod_Insumo'];
        $Nom_Insumo=$row['Nom_Insumo'];
        $Unidad_Insumo=$row['Unidad_Insumo'];
       


        $EjeInicial=$EjeInicial+4;
        $Consecutivo=$Consecutivo+1;

        $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','', 8);
        $pdf->SetXY(20,$EjeInicial  );//Ubicación en PDF 
        $pdf->Cell(15,4,utf8_encode($Consecutivo),1,0,'C',1);


        $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(35,$EjeInicial  );//Ubicación en PDF 
        $pdf->Cell(42,4,utf8_encode($Cod_Insumo),1,0,'L',1);

        $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(77,$EjeInicial  );//Ubicación en PDF 
        $pdf->Cell(86,4,utf8_encode($Nom_Insumo),1,0,'L',1);

         $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(163,$EjeInicial  );//Ubicación en PDF 
        $pdf->Cell(35,4,utf8_encode($Cant_Solicitada." ".$Unidad_Insumo),1,0,'C',1);
 }
}




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

		echo "<script language='javascript'>window.open('Panel-Produccion.php?Solicitud=".$Solicitud."','_parent','');</script>";//para ver el archivo pdf generado





		//exit;

        //header('Location: http://www.estrenarcarro.com.co/desarrollo/index.php?option=com_wrapper&view=wrapper&Itemid=1320&lang=en');





	?>









<!--fin seccion pdf-->







