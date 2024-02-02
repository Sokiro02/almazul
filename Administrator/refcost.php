<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

$Select1=$_POST['Select1'];

$TotalInsumos=TotalInsumosAgregados($IdUser);

$TotalCosto=$Select1+$TotalInsumos;

 ?>
  <label for="form-field-select-3">Total Costo</label>
         <div>
            <input class="input-xlarge" type="text" style="font-weight: bold;" readonly="readonly" value="<?php Echo(formatomoneda($TotalCosto)) ?>" />
            <input style="display: none;" class="input-xlarge" type="text" id="TxtTotalCosto" name="TxtTotalCosto" value="<?php Echo($TotalCosto) ?>" />         
         </div>
 

