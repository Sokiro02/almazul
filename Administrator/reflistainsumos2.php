<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

$IdConsulta=$_POST['IdConsulta'];
?>
<label for="form-field-select-3">Insumo  Secundario</label>

                              <div>
                <select class="chosen-select input-xxlarge" id="TxtInsumo2" name="TxtInsumo2" data-placeholder="Seleccionar...">
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

