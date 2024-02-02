<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

$ID=$_POST['Select1'];
$var1  = $ID;
$porciones = explode("-", $var1);
$Id_Produccion=$porciones[0]; // Id de Produccion
$Id_Referencia = $porciones[1]; // Id de la Referencia
$Nombre_Talla = $porciones[2]; // Nombre de la Talla
$Talla_Id= $porciones[3]; // Nombre de la Talla

?>
<label for="form-field-select-3">Talla</label>
<div>
    <select style="text-transform:uppercase;" required="true" class="chosen-select input-xxlarge" id="TxtTalla"  name="TxtTalla" data-placeholder="Seleccionar...">
    <option style="text-transform:uppercase;" value="<?php echo $Talla_Id;?>"><?php echo $Nombre_Talla;?></option>
    </select>			
</div>
