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
$Cantidad= $porciones[4]; // Cantidad
?>
<label for="form-field-select-3">Cantidad</label>
<div>
    <select style="text-transform:uppercase;" required="true" class="chosen-select input-xxlarge" id="TxtCantidad"  name="TxtCantidad" data-placeholder="Seleccionar...">
    <?php 
        for ($i=1;$i<=$Cantidad;$i++){
            ?>
            <option style="text-transform:uppercase;" value="<?php echo $i;?>"><?php echo $i;?></option>
            <?php            
        }
    ?>
    </select>			
</div>




