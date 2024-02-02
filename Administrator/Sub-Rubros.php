<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");

$IdUser=$_SESSION['IdUser'];
$Dato=$_POST['Select1'];

?>

<div>
	<label for="form-field-select-3">Seleccionar Sub-Rubro</label>
		<br />
			<select class="chosen-select form-control" id="form-field-select-2" name="SelSubrubro" data-placeholder="Seleccionar Sub-Rubro...">
		<option value="">Seleccionar Sub-Rubro</option>
																	<?php
$sql ="SELECT Id_Subrubro, Nom_Subrubro FROM t_subrubros WHERE Rubro_id_rubro='".$Dato."' and Subrubro_publicado=1 order by Nom_Subrubro asc";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
    	$SelectIdSubrubro=$row['Id_Subrubro'];
    	$SelectNombreSubrubro=$row['Nom_Subrubro'];             
    	echo ("<option value='".$SelectIdSubrubro."'>".utf8_encode($SelectNombreSubrubro)."</option>");
 }
}
            
?>
															</select>
														</div>

														<hr />
