<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Tabla</title>
 </head>
 <body>
 	<table>
 		<tr>
 			<td>
 				<a href="Sticker_CodigosInve.php">Ver Códigos</a>
 				<?php 

 				 $sql ="SELECT  Ref_Completa,Id_Registro_Inv FROM t_inventario_ref"; 
    //Echo($sql); 
$result = $conexion->query($sql);
$numregistros = $result->num_rows;


$x = $numregistros/4;

Echo($x);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    $Ref_Completa=$row['Id_Registro_Inv']; 
    //$Id_Registro_Inv=$row['Id_Registro_Inv']; 

   		
   }
    }
 				 ?>
 			</td>
 			
 		</tr>
 	</table>
 </body>
 </html>