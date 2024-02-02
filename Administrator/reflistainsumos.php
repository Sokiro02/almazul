<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

$IdConsulta=$_POST['IdConsulta'];
?>
<script>
$(document).ready(function(){
   $("#TxtInsumo1").change(function () {
           $("#TxtInsumo1 option:selected").each(function () {
            Select1 = $(this).val();
           // var Select2 = $("#TxtSubCategoria option:selected").val();
            //var Select3 = $("#TxtInsumoSel option:selected").val();
            //alert(Select1)
            $.post("reftela.php", { Select1: Select1}, function(data){
                $("#TelaSel").html(data); 
            });            
        });
   })
});
</script>
<label for="form-field-select-3">Insumo  Principal</label>

                              <div>
                <select class="chosen-select input-xxlarge" id="TxtInsumo1" name="TxtInsumo1" data-placeholder="Seleccionar...">
                            <option value="">Seleccionar...</option>
                             <?php

$sql ="SELECT Id_Insumo,Cod_Temporal,Nom_Temporal from t_temporal_ref as A, t_insumos as B WHERE Orden_Temporal='".$IdConsulta."' and A.Cod_Temporal=B.Cod_Insumo"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Sel_Id_Insumo=$row['Id_Insumo'];
        $Sel_Cod_Temporal=$row['Cod_Temporal'];
        $Sel_Nom_Temporal=$row['Nom_Temporal'];
       ?>
       <option value="<?php Echo($Sel_Id_Insumo); ?>"><?php Echo($Sel_Cod_Temporal." - ".$Sel_Nom_Temporal); ?></option>
       <?php
    }
}
//header("location:index.php");
 ?>
                        </select>
                              </div>

