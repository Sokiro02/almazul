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
//$Cantidad = $_POST['Select2'];
?>
<div class="col-xs-12 col-sm-6"><!-- Inicio módulo fotos de Insumos -->
                	<div style="cursor:move;">
									<ul class="ace-thumbnails clearfix">
						<?php 
$TipoConsulta = $_POST['Select1'];
if ($TipoConsulta=="Todas") {
$sql ="SELECT DISTINCT(Cod_Insumo),Id_Insumo, Categoria_Id_Categoria_Insumo,  Cod_Proveedor, Nom_Insumo, Unidad_Insumo, Url_Insumo, Detalle_Insumo, Proveedor_Id_Proveedor, Costo_Insumo from t_insumos"; 
}
else{
	$sql ="SELECT DISTINCT(Cod_Insumo),Id_Insumo, Categoria_Id_Categoria_Insumo,  Cod_Proveedor, Nom_Insumo, Unidad_Insumo, Url_Insumo, Detalle_Insumo, Proveedor_Id_Proveedor, Costo_Insumo from t_insumos WHERE Categoria_Id_Categoria_Insumo='".$TipoConsulta."'"; 
}

//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Id_Insumo=$row['Id_Insumo'];
        $Categoria_Id_Categoria_Insumo=$row['Categoria_Id_Categoria_Insumo'];
        $Cod_Insumo=$row['Cod_Insumo'];
        $Cod_Proveedor=$row['Cod_Proveedor'];
        $Nom_Insumo=$row['Nom_Insumo'];
        $Url_Insumo=$row['Url_Insumo'];
        $Costo_Insumo=$row['Costo_Insumo'];
 ?>
										<li>
											
							<img width="130" height="130" alt="150x150" src="<?php echo ($Url_Insumo); ?>" data-id="<?php echo $Id_Insumo; ?>" data-name="<?php echo $Nom_Insumo; ?>" data-price="<?php echo $Costo_Insumo; ?>" class="img-responsive product_drag" />			
												
												<div class="tags">
													<span class="label-holder">
														<a class="image-link" href="<?php echo utf8_encode($Url_Insumo); ?>">
															<span class="label label-success arrowed"><i class="fa fa-eye"></i></span>
														</a>
															
													</span>
													<span class="label-holder">
														<span class="label label-info">Cód:<?php echo $Cod_Insumo; ?></span>
													</span>

													<span class="label-holder">
														<span class="label label-info"><?php echo $Nom_Insumo; ?></span>
													</span>
												</div>
											
										</li>
									 <?php 
         }
}
else
{
	Echo("<h5>Lo sentimos no se encontraron resultados en su búsqueda</h5>");
}
          ?>
									</ul>
		</div>
        
</div> <!-- Final módulo fotos de Insumos -->	

															
