<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$Talla=$_POST['Select1'];
$Tienda=$_POST['Select2'];
$RefSel=$_GET['ReferenciaAjax']; 
?>  
<?php

$Disponible=ArqueoInventarioTalla($RefSel,$Talla,$Tienda)+1;

?>
   <?php 
   if ($Disponible==1) {
     ?>
      <select class="col-lg-3 col-xs-12" name="TxtCantidad" id="TxtCantidad">
          <option value="">Talla No disponible en Tienda</option>
        </select>
     <?php
   }
   else{
    ?>
        <select class="col-lg-3 col-xs-12" name="TxtCantidad" id="TxtCantidad">
          <option value="">Indicar Cantidad</option>
                    <?php 
                     for ($i=1; $i <$Disponible ; $i++) { 
                        Echo("<option value='".$i."'>".$i." Un.</option>");
                    }
                    ?>
        </select> 
    <?php 
    }
     ?>
 
