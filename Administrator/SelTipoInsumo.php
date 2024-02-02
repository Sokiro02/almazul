<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Insumos Modasof</title>

	
     <!-- Inicio Libreria formato moneda -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
<script src="https://modasof.com/espejo/assets/js/jquery.maskMoney.js" type="text/javascript"></script>


    <?php include("Lib/Favicon.php") ?>

	</head>
<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$CodProv = $_POST['Select1'];
$Cantidad = $_POST['Select2'];      
$sql ="SELECT DISTINCT Costo_Insumo,Unidad_Insumo from t_insumos WHERE Id_Insumo='".$CodProv."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Costo_Insumo=$row['Costo_Insumo'];
        $Unidad_Insumo=$row['Unidad_Insumo'];
        
         }
}
$ValorPedido=$Costo_Insumo*$Cantidad;
          ?>
          <div class="col-xs-12 col-sm-2">
								<label>Costo X  (1<?php Echo($Unidad_Insumo); ?>)</label>
											<div class="input-group">
										<input class="form-control" type="text" id="demo1" name="TxtCostoInsumo" value="<?php Echo(formatomoneda($Costo_Insumo)); ?>" />
											</div>
											<script type="text/javascript">			
$("#demo1").maskMoney({
prefix:'$ ', // The symbol to be displayed before the value entered by the user
allowZero:false, // Prevent users from inputing zero
allowNegative:true, // Prevent users from inputing negative values
defaultZero:false, // when the user enters the field, it sets a default mask using zero
thousands: '.', // The thousands separator
decimal: '.' , // The decimal separator
precision: 0, // How many decimal places are allowed
affixesStay : true, // set if the symbol will stay in the field after the user exits the field. 
symbolPosition : 'left' // use this setting to position the symbol at the left or right side of the value. default 'left'
}); //
		</script>
								</div>
		 <div class="col-xs-12 col-sm-2">
								<label>Valor Pedido</label>
											<div class="input-group">
						<input class="form-control" type="text" disabled="true" name="TxtTotal2"  value="<?php Echo(formatomoneda($ValorPedido)) ?>" />
						<input style="display: none;" class="form-control" type="text" name="TxtTotal"  value="<?php Echo(formatomoneda($ValorPedido)) ?>" />
											</div>
								</div>
								<hr>

									
							
        
</div> <!-- Final módulo fotos de Insumos -->
											
															
