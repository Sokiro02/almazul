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
$SelectCategoria = $_POST['Select1'];
    
          ?>
           <?php
$sql ="SELECT Nom_CategoriaIns,Consecutivo_Categoria+1 as NuevoCodigo FROM t_categorias_insumos WHERE`Id_Categoria_Insumo`='".$SelectCategoria."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $NuevoCodigo=$row['NuevoCodigo'];
        $CategoriaPpal=$row['Nom_CategoriaIns'];
        $Inicial = substr($CategoriaPpal, 0, 1);
       $TercerLetra = substr($CategoriaPpal, 2, 1);
       }
   } 
				 ?>
		<strong class="blue"><h5>Nuevo Cód Modasof:  <?php Echo($Inicial.$TercerLetra.$NuevoCodigo); ?> </h5></strong>
<input type="text" name="TxtCodigo" class="input-large" style="text-transform:uppercase;display: none;" value="<?php Echo($Inicial.$TercerLetra.$NuevoCodigo); ?>">
<input type="text" name="TxtConsecutivo" class="input-large" style="display: none;" value="<?php Echo($NuevoCodigo); ?>">
<input type="text" name="TxtSelCategoria" class="input-large" style="display: none;" value="<?php Echo($SelectCategoria); ?>">
		 <label for="form-field-select-3">Sub-Categoria Insumo</label>

															<div>
												<select class="chosen-select input-xxlarge" name="TxtSubCategoria"  data-placeholder="Seleccionar...">
														<option value="">Seleccionar...</option>
									<?php
$sql ="SELECT Id_SubCategoria_Insumo, Nom_SubCategoriaIns FROM t_subcategorias_insumos WHERE Categoria_Id_Categoria_Insumo='".$SelectCategoria."' order by Nom_SubCategoriaIns ASC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
    	$SelectId_SubCategoriaIns=$row['Id_SubCategoria_Insumo'];
    	$SelectNom_SubCategoriaIns=$row['Nom_SubCategoriaIns'];             
    	echo ("<option value='".$SelectId_SubCategoriaIns."'>".utf8_encode($SelectNom_SubCategoriaIns)."</option>");
 }
}
        
?>			
																	
												</select>
															</div>
				
					<div class="col-xs-12 col-sm-12">
						<?php
$sql ="SELECT Nom_Atributo_Categoria FROM t_atributos_categoria_ins WHERE Categoria_Id_Categoria_Insumo='".$SelectCategoria."' order by Nom_Atributo_Categoria ASC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
    	$SelectNom_Atributo=$row['Nom_Atributo_Categoria'];                     
?>			
										<div class="col-xs-12 col-sm-6">
											<div class="control-group">
												
												<div class="checkbox">
													<label>
														<input name="TxtAtributo[]" type="checkbox" class="ace" value="<?php Echo($SelectNom_Atributo); ?>" />
														<span style="font-size: 10px;" class="lbl"><strong> <?php Echo($SelectNom_Atributo); ?></strong></span>
													</label>
												</div>
											</div>
										</div>
						<?php 
					}
				}
						 ?>	
						
					</div>
							
        

											
															
