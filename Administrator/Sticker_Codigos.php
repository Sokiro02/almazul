<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];
include("Lib/permisos.php");
include 'barcode.php';


?>
<!--seccion que genera el pdf-->
<?php

/* http://programarenphp.wordpress.com */



/* incluimos primeramente el archivo que contiene la clase fpdf */



include ('fpdf/fpdf.php');



/* tenemos que generar una instancia de la clase */



        $pdf = new FPDF('P','mm','letter');
        $pdf->SetMargins(0,0,0,0);
        $pdf->SetAutoPageBreak(true,0);



        $pdf->AddPage();
/* seleccionamos el tipo, estilo y tamaño de la letra a utilizar */


		{

        $pdf->SetFont('Arial','', 11);

        }

        {
        //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',30,10,41,30);
        }

        $OrdenNumero=$_POST['OrdenNumero'];

        $sql ="SELECT  PVP_Ref,Referencia_Id_Referencia, Nom_Talla,Nom_Cat_Producto FROM t_solicitudes_prod AS A, t_tallas as B,t_referencias as C, t_categoria_producto as D WHERE A.Talla_Solicitada=B.Id_Talla and A.Referencia_Id_Referencia=C.Cod_Referencia and C.Categoria_Id_Categoria_Prod=D.Id_Cat_Producto and Cod_Solicitud_Prod='".$OrdenNumero."'"; 
    //Echo($sql); 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    $PVP_Ref=$row['PVP_Ref']; 
    $Referencia_Id_Referencia=$row['Referencia_Id_Referencia']; 
    $Nom_Talla=$row['Nom_Talla']; 
    $Nom_Cat_Producto=$row['Nom_Cat_Producto']; 

        $ReferenciaFinal=$Referencia_Id_Referencia."-".$Nom_Talla;
    
      }
    }



        $TxtNumSticker=$_POST['TxtNumSticker'];
            
            $ubicacion=$_POST['TxtUbicacion']; // Inicio de Impresión

         $final=$ubicacion+$TxtNumSticker;

        for ($i=$ubicacion; $i < $final ; $i++) { 
           
        

      
        
  
        if ($i==1) {
           
//*******************************************************************************************************************************
                                    /////////////////////POSICION 1-////////////////
//****************************************************************************************************************************** 

        $code=$ReferenciaFinal;
        $price=$PVP_Ref;
        $pdf->SetXY(0, 0  );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(2,2  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code39', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',2,8,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(3, 19  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(35,19  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');

        }

      elseif ($i==2) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 2-////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(53.9, 0  );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(55.9,2  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',55.9,8,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(56.9, 19  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(88.9,19  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');
                            



                        }                
 elseif ($i==3) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 3-////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(107.8, 0  );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(109.8,2  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',109.8,8,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(110.8, 19  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(142.8,19  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');
                            



                        }         
    elseif ($i==4) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 4-////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(161.7, 0  );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(163.7,2  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',163.7,8,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(164.7, 19  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(196.7,19  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');
                            



                        }  

 elseif ($i==5) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 5  -////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(0, 25.4  );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(2,27.4  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',2,33.4,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(3, 44.4  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(35,44.4  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');

        }

        elseif ($i==6) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 6  -////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(53.9, 25.4  );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(55.9,27.4  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',55.9,33.4,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(56.9, 44.4  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(88.9,44.4  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');

        }

        elseif ($i==7) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 7-////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(107.8, 25.4  );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(109.8,27.4  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',109.8,33.4,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(110.8, 44.4  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(142.8,44.4  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');
                            

                        }  

                        elseif ($i==8) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 8-////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(161.7, 25.4  );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(163.7,27.4  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',163.7,33.4,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(164.7, 44.4  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(196.7,44.4  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');
                            

                        }   

elseif ($i==9) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 9  -////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(0, 50.8  );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(2,52.8  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',2,58.8,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(3, 69.8  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(35,69.8  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');

        }

        elseif ($i==10) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 10  -////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(53.9, 50.8  );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(55.9,52.8  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',55.9,58.8,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(56.9, 69.8  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(88.9,69.8  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');

        }

        elseif ($i==11) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 11-////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(107.8, 50.8  );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(109.8,52.8  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',109.8,58.8,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(110.8, 69.8  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(142.8,69.8  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');
                            

                        }  

                        elseif ($i==12) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 12-////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(161.7, 50.8  );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(163.7,52.8  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',163.7,58.8,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(164.7, 69.8  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(196.7,69.8  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');
                            

                        }   

elseif ($i==13) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 13  -////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(0, 76.2  );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(2,78.2  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',2,84.2,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(3, 95.2  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(35,95.2  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');

        }

        elseif ($i==14) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 14  -////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(53.9, 76.2  );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(55.9,78.2  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',55.9,84.2,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(56.9, 95.2  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(88.9,95.2  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');

        }

        elseif ($i==15) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 15-////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(107.8, 76.2 );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(109.8,78.2  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',109.8,84.2,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(110.8, 95.2  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(142.8,95.2  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');
                            

                        }  

                        elseif ($i==16) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 16-////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(161.7, 76.2  );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(163.7,78.2  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',163.7,84.2,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(164.7, 95.2  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(196.7,95.2  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');
                            

                        } 

elseif ($i==17) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 17  -////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(0, 101.6  );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(2,103.6  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',2,109.6,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(3, 120.6  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(35,120.6  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');

        }

        elseif ($i==18) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 18  -////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(53.9, 101.6  );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(55.9,103.6  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',55.9,109.6,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(56.9, 120.6  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(88.9,120.6  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');

        }

        elseif ($i==19) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 19-////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(107.8, 101.6 );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(109.8,103.6  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',109.8,109.6,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(110.8, 120.6  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(142.8,120.6  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');
                            

                        }  

                        elseif ($i==20) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 20-////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(161.7, 101.6  );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(163.7,103.6  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',163.7,109.6,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(164.7, 120.6  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(196.7,120.6  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');
                            

                        } 

elseif ($i==21) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 21  -////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(0, 127  );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(2,129  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',2,135,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(3, 146  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(35,146  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');

        }

        elseif ($i==22) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 22  -////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(53.9, 127  );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(55.9,129  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',55.9,135,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(56.9, 146  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(88.9,146  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');

        }

        elseif ($i==23) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 23-////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(107.8, 127 );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(109.8,129  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',109.8,135,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(110.8, 146  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(142.8,146  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');
                            

                        }  

                        elseif ($i==24) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 24-////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(161.7, 127  );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(163.7,129  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',163.7,135,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(164.7, 146  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(196.7,146  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');
                            

                        }

elseif ($i==25) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 25  -////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(0, 152.4  );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(2,154.4  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',2,160.4,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(3, 171.4  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(35,171.4  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');

        }

        elseif ($i==26) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 26  -////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(53.9, 152.4  );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(55.9,154.4  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',55.9,160.4,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(56.9, 171.4  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(88.9,171.4  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');

        }

        elseif ($i==27) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 27-////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(107.8, 152.4 );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(109.8,154.4  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',109.8,160.4,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(110.8, 171.4  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(142.8,171.4  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');
                            

                        }  

                        elseif ($i==28) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 28-////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(161.7, 152.4  );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(163.7,154.4  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',163.7,160.4,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(164.7, 171.4  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(196.7,171.4  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');
                            

                        }


elseif ($i==29) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 29  -////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(0, 177.8  );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(2,179.8  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',2,185.8,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(3, 196.8  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(35,196.8  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');

        }

        elseif ($i==30) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 30  -////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(53.9, 177.8  );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(55.9,179.8  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',55.9,185.8,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(56.9, 196.8  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(88.9,196.8  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');

        }

        elseif ($i==31) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 31-////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(107.8, 177.8 );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(109.8,179.8  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',109.8,185.8,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(110.8, 196.8  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(142.8,196.8  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');
                            

                        }  

                        elseif ($i==32) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 32-////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(161.7, 177.8  );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(163.7,179.8  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',163.7,185.8,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(164.7, 196.8  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(196.7,196.8  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');
                            

                        }

elseif ($i==33) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 33  -////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(0, 203.2  );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(2,205.2  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',2,211.2,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(3, 222.2  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(35,222.2  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');

        }

        elseif ($i==34) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 34  -////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(53.9, 203.2  );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(55.9,205.2  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',55.9,211.2,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(56.9, 222.2  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(88.9,222.2  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');

        }

        elseif ($i==35) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 35-////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(107.8, 203.2 );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(109.8,205.2  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',109.8,211.2,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(110.8, 222.2  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(142.8,222.2  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');
                            

                        }  

                        elseif ($i==36) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 36-////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(161.7, 203.2  );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(163.7,205.2 );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',163.7,211.2,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(164.7, 222.2  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(196.7,222.2  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');
                            

                        }
elseif ($i==37) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 37  -////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(0, 228.6  );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(2,230.6  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',2,236.6,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(3, 247.6  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(35,247.6  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');

        }

        elseif ($i==38) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 38  -////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(53.9, 228.6  );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(55.9,230.6  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',55.9,236.6,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(56.9, 247.6  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(88.9,247.6  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');

        }

        elseif ($i==39) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 39-////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(107.8, 228.6 );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(109.8,230.6  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',109.8,236.6,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(110.8, 247.6  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(142.8,247.6  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');
                            

                        }  

                        elseif ($i==40) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 40-////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(161.7, 228.6  );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(163.7,230.6 );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',163.7,236.6,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(164.7, 247.6  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(196.7,247.6  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');
                            

                        }

elseif ($i==41) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 41  -////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(0, 254 );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(2,256  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',2,262,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(3, 273  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(35,273  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');

        }

        elseif ($i==42) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 42  -////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(53.9, 254 );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(55.9,256  );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',55.9,262,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(56.9, 273 );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(88.9,273  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');

        }

        elseif ($i==43) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 43-////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(107.8, 254 );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(109.8,256 );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',109.8,262,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(110.8, 273  );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(142.8,273  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');
                            

                        }  

                        elseif ($i==44) {

    //*******************************************************************************************************************************
                                   /////////////////////POSICION 44-////////////////
    //******************************************************************************************************************************
  
        $code=$ReferenciaFinal;
        $price=$PVP_Ref;

        $pdf->SetXY(161.7, 254 );//Ubicación en PDF
        $pdf->SetFontSize(8);//Tamaño de Fuente
        $pdf->Cell(53.9,25.4,utf8_decode(''),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado


         $pdf->SetFont('Arial','', 7);
         $pdf->SetXY(163.7,256 );//Ubicación en PDF
         $pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,1,'L');

         barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        
       

            //$pdf->SetXY(2, 2  );//Ubicación en PDF
            $pdf->Image('codigos/'.$code.'.png',163.7,262,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        
                $pdf->SetXY(164.7, 273 );//Ubicación en PDF
                $pdf->SetFontSize(9);//Tamaño de Fuente
                $pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,1,'C'); //Ancho, Alto, texto,borde,?,centrado

                    $pdf->SetFont('Arial','B', 9);
                    $pdf->SetXY(196.7,273  );//Ubicación en PDF
                    $pdf->Cell(20,5,utf8_decode('Modasof'),0,1,'L');
                            

                        }
                    }//final del Bucle

        
       
       
		        $pdf->Output("Facturas/Factura-HotelArenas.pdf",'F');

















		echo "<script language='javascript'>window.open('Facturas/Factura-HotelArenas.pdf','_blank','');</script>";

		echo "<script language='javascript'>window.open('panel-produccion.php?Solicitud=".$OrdenNumero."','_parent','');</script>";//para ver el archivo pdf generado





		//exit;

        //header('Location: http://www.estrenarcarro.com.co/desarrollo/index.php?option=com_wrapper&view=wrapper&Itemid=1320&lang=en');





	?>









<!--fin seccion pdf-->







