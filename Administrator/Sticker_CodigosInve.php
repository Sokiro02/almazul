<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];
include("Lib/permisos.php");
include 'barcode.php';

function myTruncate($string, $limit, $break=".", $pad="…") {
    // return with no change if string is shorter than $limit
    if(strlen($string) <= $limit)
     return $string;
    // is $break present between $limit and the end of the string?
    if(false !== ($breakpoint = strpos($string, $break, $limit))) {
        if($breakpoint < strlen($string) - 1) {
            $string = substr($string, 0, $breakpoint) . $pad;
        }
    }
    return $string;
}
//myTruncate($cadena, $long_min, $cadena_corte, $coletilla)

?>
<!--seccion que genera el pdf-->
<?php

/* http://programarenphp.wordpress.com */



/* incluimos primeramente el archivo que contiene la clase fpdf */



include ('fpdf/fpdf.php');


/* tenemos que generar una instancia de la clase */



        $pdf = new FPDF('P','mm','letter');
        $pdf->SetMargins(1,2,1,0);
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

$EjeInicial=0;
$EjeY = 0;
$EjeNombre=-50.9;
$EjeCodigo=-51.9;

$var = array();
$contador = 0;
//Ref_Completa
$sql = "SELECT DISTINCT(Ref_Completa),Inv_Ref FROM t_inventario_ref";
//  $sql ="SELECT Id_Color, Nom_Color, Valor_Color FROM t_colores"; 
    //Echo($sql); 
$result = $conexion->query($sql);
$numregistros = $result->num_rows;
$bandera = 0;
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
    $bandera=$bandera+1;
    //$ReferenciaFinal=$row['Id_Color']; 
        $code=$row['Ref_Completa']; 
        $Inv_Ref = $row['Inv_Ref']; 

    //$Id_Registro_Inv=$row['Id_Registro_Inv']; 
   
        $var[$contador][1]=$code;
        $var[$contador][2]=$Inv_Ref; 
        $contador = $contador + 1;

    //$pdf->SetXY($EjeInicial, 0 );//Ubicación en PDF
   //$pdf->Cell(53.9,25.4,utf8_decode($Nom_Cat_Producto),1,0,'C');
    //$pdf->Ln(); 


         //$pdf->SetFont('Arial','', 7);
         //$pdf->SetXY($EjeNombre,1  );//Ubicación en PDF
         //$pdf->Cell(49,5,utf8_decode($Nom_Cat_Producto),0,0,'L');


         barcode('codigos/'.$code.'.png', $code, 22, 'horizontal', 'code128', true);
        
        //ESTE SIRVE
        //$pdf->Cell(53.9,25.4,utf8_decode($code),1,0,'C');
        //$pdf->Cell(53.9,25.4, $pdf->Image('codigos/'.$code.'.png',$EjeCodigo,8,48,12,'PNG'),1,0,'C');

        
            //$pdf->SetXY($EjeNombre, 2  );//Ubicación en PDF
            //$pdf->Image('codigos/'.$code.'.png',$EjeCodigo,8,48,12,'PNG');
            //$pdf-> Image('images/IconosFactura/Logo_Modasof.jpg',2,8,48,10);
        //$price=$EjeInicial;
             //   $pdf->SetXY($EjeNombre, 19  );//Ubicación en PDF
         //$pdf->SetFontSize(9);//Tamaño de Fuente
         //$pdf->Cell(22,5,utf8_encode("$ ".number_format($price)),0,0,'C'); //Ancho, Alto, texto,borde,?,centrado

                    //$pdf->Ln();      
          //$pdf->Image('codigos/'.$code.'.png',$EjeInicial,$EjeY,53.9,25.4);          
          // $EjeY =$EjeY+25.4;          
          // $EjeInicial=$EjeInicial+53.9;
           
           //$EjeNombre=$EjeNombre+53.9;
           //$EjeCodigo=$EjeCodigo+53.9;

         
         //OJO----SIRVE...           
         $sql2="SELECT * FROM t_referencias WHERE Cod_Referencia = '".$Inv_Ref."'";
         $resultado = $conexion->query($sql2);
         $fila = $resultado->fetch_assoc();
         $Detalle_Referencia=$fila['Detalle_Referencia'];
         $PVP_Ref[$contador]=$fila['PVP_Ref'];
         
         //$pdf->SetXY(2, 2  );//Ubicación en PDF
         $celdasuperior = "$".number_format($PVP_Ref[$contador])." ".utf8_decode($Detalle_Referencia);
         $celdasuperior=substr($celdasuperior,0,35);
         //$mostrar = myTruncate($celdasuperior, 20,'','..');
         $pdf->SetFontSize(7);//Tamaño de Fuente
         $pdf->Cell(53.9,2,$celdasuperior,0,0,'L');

        if ($bandera % 4 == 0){
            $pdf->Ln(); 
            for ($i=0;$i<=3;$i++){
                $code = $var[$i][1];
                //barcode('codigos/'.$code.'.png', $code, 22, 'horizontal', 'code128', true);
                barcode('codigos/'.$code.'.png', $code, 23, 'horizontal', 'code128', true);
                $pdf->Cell(53.9,23, $pdf->Image('codigos/'.$code.'.png',$pdf->GetX(),$pdf->GetY()+1,53.9,23),0,0,'C');
            }
            $pdf->Ln();
            /*
            for ($j=0;$j<=3;$j++){
                $pdf->Cell(53.9,2,$PVP_Ref[$j]." Modasof",0,0,'L');
            }
            $pdf->Ln();
            */
            $contador=0;
        }
        
                
        if ($bandera % 44 == 0){
            $pdf->AddPage();    
        }  

      }
     
   
   }
    



       
		        $pdf->Output("Facturas/Factura-HotelArenas.pdf",'F');



		echo "<script language='javascript'>window.open('Facturas/Factura-HotelArenas.pdf','_blank','');</script>";

		echo "<script language='javascript'>window.open('SaltoLinea.php?Solicitud=".$OrdenNumero."','_parent','');</script>";//para ver el archivo pdf generado





		//exit;

        //header('Location: http://www.estrenarcarro.com.co/desarrollo/index.php?option=com_wrapper&view=wrapper&Itemid=1320&lang=en');





	?>










<!--fin seccion pdf-->







