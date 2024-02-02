<?php if (substr_count($_SERVER

[‘HTTP_ACCEPT_ENCODING’], ‘gzip’)) ob_start(“ob_gzhandler”); else ob_start(); ?>
<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];
include("Lib/permisos.php");
date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');

$Confirmation=$_GET['Confirmation'];

if ($Confirmation!="") {
	$sql ="DELETE FROM t_insumos WHERE Cod_Insumo='".$Confirmation."'";  
//echo($sql);
$result = $conexion->query($sql);

header("location:insumos.php?Mensaje=18");
}
$ValEstado=$_GET['ValEstado'];
$RubroEstado=$_GET['RubroEstado'];
$AreaEstado=$_GET['AreaEstado'];

if ($RubroEstado!="") {
	$sql ="UPDATE t_categorias_insumos SET CategoriaIns_Publicada='".utf8_decode($ValEstado)."' WHERE Id_Categoria_Insumo='".$RubroEstado."'";  
$result = $conexion->query($sql);
header("location:insumos.php?Mensaje=15&TAB=tabs-3");
}


?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Nuevo Insumo Modasof</title>

		<meta name="description" content="Common form elements and layouts" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		 <!-- Notificaciones Push -->
		<script src="https://modasof.com/espejo/assets/js/push.min.js"></script>
		

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/chosen.min.css" />
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/bootstrap-datepicker3.min.css" />
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/bootstrap-timepicker.min.css" />
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/daterangepicker.min.css" />
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/bootstrap-datetimepicker.min.css" />
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/bootstrap-colorpicker.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="https://modasof.com/espejo/assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="https://modasof.com/espejo/assets/js/ace-extra.min.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="https://modasof.com/espejo/assets/js/html5shiv.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/respond.min.js"></script>
		<![endif]-->
	<!--/Inicio Alertas-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link href="https://modasof.com/espejo/assets/css/sweetalert.css" rel="stylesheet">
    <!-- Custom functions file -->
    <script src="../https://modasof.com/espejo/assets/js/functions.js"></script>
    <!-- Sweet Alert Script -->
    <script src="https://modasof.com/espejo/assets/js/sweetalert.min.js"></script>
    <!--/Fin Alertas-->

     <!-- Inicio Libreria formato moneda -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
<script src="https://modasof.com/espejo/assets/js/jquery.maskMoney.js" type="text/javascript"></script>

<!-- <link rel="stylesheet" href="https://modasof.com/espejo/assets/css/magnific-popup.css">
<script type="text/javascript">
	$(document).ready(function() {
  $('.image-link').magnificPopup({type:'image'});
});
</script> -->

 <script>
$(document).ready(function(){
   $("#TxtCategoria").change(function () {
           $("#TxtCategoria option:selected").each(function () {
            Select1 = $(this).val();
            //var Select2 = $("#TxtCantidad option:selected").val();
            //alert(Select1)
            $.post("SelectCategoriaIns.php", { Select1: Select1}, function(data){
                $("#info").html(data); 
            });            
        });
   })
});
</script>

    <?php include("Lib/Favicon.php") ?>

	</head>

	<body class="skin-1">

	<?php 
  $Valide=$_GET['Mensaje'];

    if ($Valide==2) {
        echo "<script>jQuery(function(){swal(\"¡Lo Sentimos!\", \"Datos Incorrectos\", \"error\");});</script>";
    };
    if ($Valide==1) {
        echo "<script>jQuery(function(){swal(\"¡ Insumo Creado!\", \"Correctamente \", \"success\");});</script>";
    };
     if ($Valide==111) {
        echo "<script>jQuery(function(){swal(\"¡ Insumo Actualizado!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==18) {
        echo "<script>jQuery(function(){swal(\"¡ Insumo Eliminado!\", \"Correctamente \", \"success\");});</script>";
    };
     if ($Valide==2) {
        echo "<script>jQuery(function(){swal(\"¡ Proveedor Actualizado!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==22) {
        echo "<script>jQuery(function(){swal(\"¡ Extra Cargada a Cliente!\", \"".$ClienteSel." \", \"success\");});</script>";
    };
     if ($Valide==11) {
        echo "<script>jQuery(function(){swal(\"¡ Categoria de Insumo Creada!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==12) {
        echo "<script>jQuery(function(){swal(\"¡ Sub-Categoria de Insumo Creada!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==122) {
        echo "<script>jQuery(function(){swal(\"¡ Atributo Creado!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==13) {
        echo "<script>jQuery(function(){swal(\"¡ Nombre Categoria Actualizado!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==14) {
        echo "<script>jQuery(function(){swal(\"¡ Nombre Sub-Categoria Actualizado!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==15) {
        echo "<script>jQuery(function(){swal(\"¡ Estado Categoria Actualizado!\", \"Correctamente \", \"success\");});</script>";
    };
     if ($Valide==16) {
        echo "<script>jQuery(function(){swal(\"¡ Nombre Atributo Actualizado!\", \"Correctamente \", \"success\");});</script>";
    };
   ?>


   <?php 

if (isset($_GET['DeleteInsumo'])) {
	 $DeleteInsumo=$_GET['DeleteInsumo'];

    if ($DeleteInsumo!="") {
    	?>
    	<script>jQuery(function(){
    	swal({
  title: "¿Está seguro de eliminar este Insumo?",
  //text: "<a href='negocios.php'><b>Cerrar Ventana</b></a>",
  html: true,
  //type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#C00000",
  confirmButtonText: "Sí",
  cancelButtonText: "No",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
  if (isConfirm) {
    window.location.href = 'insumos.php?Confirmation=<?php Echo($DeleteInsumo); ?>';
  } else {
    window.location.href = 'insumos.php';
  }
});
// swal({
//   title: "¿Qué transacción desea realizar?",
//   text: "<a href='negocios.php?valido=1'>Retiro </a>-<a href='negocios.php?valido=1'>Aporte</a>",
//   html: true,
//   showCancelButton: true,
//   closeOnConfirm: false,
//   showLoaderOnConfirm: false,
// });


   //swal("Good job!", "You clicked the button!", "success");
    });
    	</script>;
    	<?php
    };
}

   ?>

	<?php 
	include("Lib/Alertas.php")
	 ?>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<?php 
	include("Lib/links.php");
	include("Lib/menuleft.php");
?>

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<!-- <li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="index.php">Inicio</a>
							</li> -->
							
							<li>
								<i class="ace-icon fa fa-users"></i>
								<a href="Lista-Insumos.php">Insumos</a>
							</li>
						</ul><!-- /.breadcrumb -->

						
					</div>

					<div class="page-content">
				<?php 
					//include("Lib/colors.php");
				?>
						<div class="row">

							<div class="col-xs-12 col-sm-12">
						

							<div class="space-7"></div>

<div class="col-sm-12 col-xs-12"><!-- Inicio Panel Inferior-->
<hr>

		<!-- Inicio Modal -->
								<div >

	<form action="Insumo-CrearInsumo.php" method="post" id="FormNuevoInsumo" enctype="multipart/form-data">
									<div class="modal-dialog">
										<div class="modal-content ">
											<div class="modal-header">
												<a href="insumos.php" type="button" class="close" data-dismiss="modal">&times;</a>
												<h4 class="black bigger">Nuevo Insumo</h4>
											</div>

											<div class="modal-body">
												<div class="row">
													<div class="col-xs-12 col-sm-6 ">
														<div class="form-group">
															<label for="form-field-select-3">Categoria del Insumo</label>

															<div>
												<select class="chosen-select input-xxlarge" name="TxtCategoria" id="TxtCategoria" data-placeholder="Seleccionar...">
														<option value="">Seleccionar...</option>
									<?php
$sql ="SELECT Id_Categoria_Insumo, Nom_CategoriaIns FROM t_categorias_insumos WHERE CategoriaIns_Publicada='1' order by Nom_CategoriaIns ASC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
    	$SelectId_CategoriaIns=$row['Id_Categoria_Insumo'];
    	$SelectNom_CategoriaIns=$row['Nom_CategoriaIns'];             
    	echo ("<option value='".$SelectId_CategoriaIns."'>".utf8_encode($SelectNom_CategoriaIns)."</option>");
 }
}
        
?>			
																	
												</select>
															</div>
														
												</div>
												<div class="form-group" id="info">
															
														
												</div>	
											<div class="form-group">
															<label for="form-field-select-3">Unidad de Medida</label>

															<div>
												<select class="chosen-select input-xxlarge" name="TxtUnidad" data-placeholder="Seleccionar...">
														<option value="">Seleccionar...</option>
														<option value="Un.">Unidad</option>
														<option value="Mt">Metro</option>
														<option value="Kl">Kilo</option>
														<option value="Bolsa">Bolsa</option>	
														<option value="Yarda">Yarda</option>		
																	
												</select>
															</div>
														
											</div>

												
									<div class="form-group">
										<label for="form-field-select-3">Imagen</label>
										<div >
											<input name="fotoportada"  type="file" id="id-input-file-1" class="col-xs-10 col-sm-5"" />
										</div>
									</div>
									<div class="form-group">
															<label for="form-field-select-3">Color Principal</label>

															<div>
												<select class="chosen-select input-xxlarge" name="TxtColor" data-placeholder="Seleccionar...">
														<option value="">Seleccionar...</option>
														<?php
$sql ="SELECT Id_Color,Nom_Color FROM t_colores order by Nom_Color ASC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
    	$Nom_Color=$row['Nom_Color'];  
    	$Id_Color=$row['Id_Color'];             
    	echo ("<option value='".$Id_Color."'>".utf8_encode($Nom_Color)."</option>");
 }
}
        
?>				
																	
												</select>
															</div>
														
									</div>



									<!-- <div>
											<label for="form-field-9">Características</label>

									<textarea class="form-control limited" name="TxtDetalle" id="form-field-9" rows="4" maxlength="300"></textarea>
									</div> -->

									<hr>


													</div>

											<div class="col-xs-12 col-sm-6 ">

														

										<div class="form-group">
										<label for="form-field-select-3">Proveedor 1</label>

															<div>
												<select class="chosen-select input-xxlarge" name="TxtProveedor1" data-placeholder="Seleccionar...">
														<option value="">Seleccionar...</option>
											<?php
$sql ="SELECT Id_Proveedor, Nom_Prov FROM t_proveedores order by Nom_Prov ASC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
    	$SelectId_Prov=$row['Id_Proveedor'];
    	$SelectNom_Prov=$row['Nom_Prov'];             
    	echo ("<option value='".$SelectId_Prov."'>".utf8_encode($SelectNom_Prov)."</option>");
 }
}
        
?>	
																	
												</select>
															</div>	
								</div>
								
								<div class="form-group">

															<div>
													<input class="input-sm" type="text" id="demo1" placeholder="Costo Proveedor 1" name="demo1"  required="true" />
													<input type="text" name="TxtCodProv1" class="input-sm" placeholder="Cód. Insumo Prov. 1">
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
										<hr>
										

										<div class="form-group">
										<label for="form-field-select-3">Proveedor 2</label>

															<div>
												<select class="chosen-select input-xxlarge" name="TxtProveedor2" data-placeholder="Seleccionar...">
														<option value="">Seleccionar...</option>
											<?php
$sql ="SELECT Id_Proveedor, Nom_Prov FROM t_proveedores order by Nom_Prov ASC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
    	$SelectId_Prov=$row['Id_Proveedor'];
    	$SelectNom_Prov=$row['Nom_Prov'];             
    	echo ("<option value='".$SelectId_Prov."'>".utf8_encode($SelectNom_Prov)."</option>");
 }
}
        
?>	
																	
												</select>
															</div>	
								</div>
									<div class="form-group">

															<div>
													<input class="input-sm" type="text" id="demo2" placeholder="Costo Proveedor 2" name="demo2"  />
													<input type="text" name="TxtCodProv2" class="input-sm" placeholder="Cód. Insumo Prov. 2">
																</div>
																<script type="text/javascript">			
$("#demo2").maskMoney({
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
										<hr>
										<div class="form-group">
										<label for="form-field-select-3">Proveedor 3</label>

															<div>
												<select class="chosen-select input-xxlarge" name="TxtProveedor3" data-placeholder="Seleccionar...">
														<option value="">Seleccionar...</option>
											<?php
$sql ="SELECT Id_Proveedor, Nom_Prov FROM t_proveedores order by Nom_Prov ASC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
    	$SelectId_Prov=$row['Id_Proveedor'];
    	$SelectNom_Prov=$row['Nom_Prov'];             
    	echo ("<option value='".$SelectId_Prov."'>".utf8_encode($SelectNom_Prov)."</option>");
 }
}
        
?>	
																	
												</select>
															</div>	
								</div>
							<div class="form-group">

															<div>
													<input class="input-sm" type="text" id="demo3" placeholder="Costo Proveedor 3" name="demo3"   />
													<input type="text" name="TxtCodProv3" class="input-sm" placeholder="Cód. Insumo Prov. 3">
																</div>
																<script type="text/javascript">			
$("#demo3").maskMoney({
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

															<div class="form-group">
															<label for="form-field-select-3">Tipo de Insumo</label>

															<div>
												
												<select class="chosen-select input-xxlarge" name="TxtTipoInsumo" data-placeholder="Seleccionar...">
														<option value="">Seleccionar...</option>
														<option value="2">PRODUCTO TERMINADO</option>
														<option value="1">PRODUCCIÓN</option>
														
												</select>
															</div>
														
											</div>
										<hr> 

											

													</div>

													
												</div>
											</div>

											<div class="modal-footer">
												<a href="insumos.php" class="btn btn-sm" data-dismiss="modal">
													<i class="ace-icon fa fa-times"></i>
													Cancelar
												</a>

												<button class="btn btn-sm btn-primary">
													<i class="ace-icon fa fa-check"></i>
													Guardar
												</button>
											</div>
										</div>
									</div>
								</form>
								</div><!-- PAGE CONTENT ENDS -->
						<!-- FINAL MODAL -->
		
	<?php 
$EditTask = $_GET['EditTask']; // Variable tomada de Tabla parte inferior
if ($EditTask!="") { // Validación si está vacia
?>

<div id='DivEditar'>
<?php
// Consulta de Proveedor a Editar
$sql ="SELECT Id_Insumo,Nom_CategoriaIns, A.Categoria_Id_Categoria_Insumo,SubCategoria_Id_SubCategoria_Insumo,Nom_SubCategoriaIns, Cod_Insumo, Cod_Proveedor, Nom_Insumo, Unidad_Insumo, A.Tipo_Insumo, Url_Insumo, Detalle_Insumo, Color_Ppal, Proveedor_Id_Proveedor,Nom_Prov, Costo_Insumo, Concatenar_Bus, Nom_Color FROM t_insumos as A, t_categorias_insumos as B, t_subcategorias_insumos as C, t_colores as D, t_proveedores as E WHERE Id_Insumo='".$EditTask."' and A.Categoria_Id_Categoria_Insumo=B.Id_Categoria_Insumo and A.SubCategoria_Id_SubCategoria_Insumo=C.Id_SubCategoria_Insumo and A.Color_Ppal=D.Id_Color and A.Proveedor_Id_Proveedor=E.Id_Proveedor"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Qr_Id_Insumo=$row['Id_Insumo'];
        $Qr_Cod_Insumo=$row['Cod_Insumo'];
        $Qr_Nom_Insumo=$row['Nom_Insumo'];
        $Qr_Tipo_Insumo=$row['Tipo_Insumo'];

        if ($Qr_Tipo_Insumo==1) {
        	$Qr_Tipo_InsumoNom="PRODUCCIÓN";
        }
        if ($Qr_Tipo_Insumo==2) {
        	$Qr_Tipo_InsumoNom="MAQUILA";
        }

        $Qr_Costo_Insumo=$row['Costo_Insumo'];
        $Qr_Cod_Proveedor=$row['Cod_Proveedor'];
        $Qr_Unidad_Insumo=$row['Unidad_Insumo'];
        $Qr_Url_Insumo=$row['Url_Insumo'];
        $Qr_Color_Ppal=$row['Nom_Color'];
        $Qr_Id_Color=$row['Color_Ppal'];
        $Qr_Nom_CategoriaIns=$row['Nom_CategoriaIns'];
        $Qr_Id_CategoriaIns=$row['Categoria_Id_Categoria_Insumo'];
        $Qr_Nom_SubCategoriaIns=$row['Nom_SubCategoriaIns'];
        $Qr_Id_SubCategoriaIns=$row['SubCategoria_Id_SubCategoria_Insumo'];
        $Qr_Nom_Prov=$row['Nom_Prov'];
        $Qr_Id_Proveedor=$row['Proveedor_Id_Proveedor'];
	}
}
?>
							<div >

		<form action="Insumo-ActualizarInsumo.php" method="post" id="FormActualizarInsumo" enctype="multipart/form-data">
								<input type="text" style="display: none;" name="TxtIdInsumo" value="<?php Echo($EditTask); ?>">

									<div class="modal-dialog">
										<div class="modal-content ">
											<div class="modal-header">
												<a href="insumos.php" type="button" class="close" data-dismiss="modal">&times;</a>
												<h4 class="black bigger">Editar Insumo Código: <?php Echo($Qr_Cod_Insumo) ?></h4>
											</div>

											<div class="modal-body">
												<div class="row">
													<div class="col-xs-12 col-sm-6 ">
														<div class="form-group center">

															<img class="responsive" width="140" height="140" src="<?php Echo($Qr_Url_Insumo); ?>">
														</div>
														<div class="form-group">
										<label for="form-field-select-3">Cambiar Imagen de Insumo</label>
										<div >
									<input name="fotoportada"  type="file" id="id-input-file-1" class="col-xs-10 col-sm-5"" />
									<input type="text" style="display: none;" name="FotoOriginal" value="<?php Echo($Qr_Url_Insumo) ?>" >
										</div>
									</div>

														<div class="form-group">
												<input type="text" name="TxtCategoria" style="display: none;" value="<?php Echo($Qr_Id_CategoriaIns) ?>">
															<label for="form-field-select-3">Categoria del Insumo</label>

															<div>
												<select disabled="true" class="chosen-select input-xxlarge" name="TxtCategoriaDis" id="TxtCategoria" data-placeholder="Seleccionar...">
														<option selected="true" value="<?php Echo($Qr_Id_CategoriaIns); ?>"><?php Echo utf8_encode($Qr_Nom_CategoriaIns); ?></option>
									<?php
$sql ="SELECT Id_Categoria_Insumo, Nom_CategoriaIns FROM t_categorias_insumos WHERE CategoriaIns_Publicada='1' order by Nom_CategoriaIns ASC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
    	$SelectId_CategoriaIns=$row['Id_Categoria_Insumo'];
    	$SelectNom_CategoriaIns=$row['Nom_CategoriaIns'];             
    	echo ("<option value='".$SelectId_CategoriaIns."'>".utf8_encode($SelectNom_CategoriaIns)."</option>");
 }
}
        
?>			
																	
												</select>
															</div>
														
												</div>
												<div class="form-group">
															<label for="form-field-select-3">SubCategoria del Insumo</label>

															<div>
												<select  class="chosen-select input-xxlarge" name="TxtSubCategoria" id="TxtSubCategoria" data-placeholder="Seleccionar...">
														<option selected="true" value="<?php Echo utf8_encode($Qr_Id_SubCategoriaIns); ?>"><?php Echo utf8_encode($Qr_Nom_SubCategoriaIns); ?></option>
									<?php
$sql ="SELECT Id_SubCategoria_Insumo, Nom_SubCategoriaIns FROM t_subcategorias_insumos WHERE Subcategoria_Insumo_Publicada='1' and Categoria_Id_Categoria_Insumo='".$Qr_Id_CategoriaIns."' order by Nom_SubCategoriaIns ASC";  
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
														
												</div>
												<div class="form-group" id="info">
															
														
												</div>	

									<hr>


													</div>

											<div class="col-xs-12 col-sm-6 ">
									<div class="form-group">
															<label for="form-field-select-3">Unidad de Medida</label>

															<div>
												<select class="chosen-select input-xxlarge" name="TxtUnidad" data-placeholder="Seleccionar...">
														<option selected="true" value="<?php Echo($Qr_Unidad_Insumo) ?>"><?php Echo utf8_encode($Qr_Unidad_Insumo) ?></option>
														<option value="Un.">Unidad</option>
														<option value="Mt">Metro</option>
														<option value="Kl">Kilo</option>
														<option value="Bolsa">Bolsa</option>
														<option value="Yarda">Yarda</option>			
												</select>
															</div>
														
											</div>

												
									
									<div class="form-group">
															<label for="form-field-select-3">Color Principal</label>

															<div>
												<select class="chosen-select input-xxlarge" name="TxtColor" data-placeholder="Seleccionar...">
														<option selected="true" value="<?php Echo($Qr_Id_Color) ?>"><?php Echo utf8_encode($Qr_Color_Ppal) ?></option>
														<?php
$sql ="SELECT Id_Color,Nom_Color FROM t_colores order by Nom_Color ASC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
    	$Nom_Color=$row['Nom_Color'];  
    	$Id_Color=$row['Id_Color'];             
    	echo ("<option value='".$Id_Color."'>".utf8_encode($Nom_Color)."</option>");
 }
}
        
?>				
																	
												</select>
															</div>
														
									</div>
														

										<div class="form-group">
										<label for="form-field-select-3">Proveedor 1</label>

															<div>
												<select class="chosen-select input-xxlarge" name="TxtProveedor1" data-placeholder="Seleccionar...">
														<option selected="true" value="<?php Echo($Qr_Id_Proveedor) ?>"><?php Echo utf8_encode($Qr_Nom_Prov) ?></option>
											<?php
$sql ="SELECT Id_Proveedor, Nom_Prov FROM t_proveedores order by Nom_Prov ASC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
    	$SelectId_Prov=$row['Id_Proveedor'];
    	$SelectNom_Prov=$row['Nom_Prov'];             
    	echo ("<option value='".$SelectId_Prov."'>".utf8_encode($SelectNom_Prov)."</option>");
 }
}
        
?>	
																	
												</select>
															</div>	
								</div>
								
								<div class="form-group">

															<div>
													<input class="input-sm" type="text" id="demo1" placeholder="Costo Proveedor 1" name="demo1"  value="<?php Echo($Qr_Costo_Insumo) ?>" required="true" />
													<input type="text" name="TxtCodProv1" class="input-sm" placeholder="Cód. Insumo Prov. 1" value="<?php Echo($Qr_Cod_Proveedor) ?>">
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
										
										<div class="form-group">
															<label for="form-field-select-3">Tipo de Insumo</label>

															<div>
												<select class="chosen-select input-xxlarge" name="TxtTipoInsumo" data-placeholder="Seleccionar...">
												<option selected="true" value="<?php Echo ($Qr_Tipo_Insumo); ?>"><?php Echo ($Qr_Tipo_InsumoNom) ?></option>

												
														<option value="2">MAQUILA</option>
														<option value="1">PRODUCCIÓN</option>
														
												</select>
															</div>
														
											</div>
										

											<hr>							

													</div>
												<div class="col-sm-12 col-xs-12">
										<div class="form-group col-sm-6">
															<label for="form-field-select-3">Ingresar Inventario Valledupar</label>

															<div>
	<input style="display: none;" type="text" name="Qr_Cod_Insumo" name="Qr_Cod_Insumo" value="<?php Echo($Qr_Cod_Insumo)?>">
												<input type="number" name="InventarioValle" class="input-lg" value="0">
															</div>

														
											</div>
											<div class="form-group col-sm-6">
															<label for="form-field-select-3">Ingresar Inventario Barranquilla</label>

															<div>
												<input type="number" name="InventarioBarranquilla" class="input-lg" value="0">
															</div>
															
														
											</div>
										
												</div>
													
												</div>
											</div>

											<div class="modal-footer">
												<a href="insumos.php" class="btn btn-sm" data-dismiss="modal">
													<i class="ace-icon fa fa-times"></i>
													Cancelar
												</a>

												<button class="btn btn-sm btn-primary">
													<i class="ace-icon fa fa-check"></i>
													Actualizar
												</button>
											</div>
										</div>
									</div>
								</form>
								</div><!-- PAGE CONTENT ENDS -->
						<!-- FINAL MODAL -->
</div>

<?php 
} // Fin Validación de Variable Vacia
 ?>

</div><!-- Fin Panel Inferior -->



							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->



<!-- Inicio Modal -->
		<div id="modal-form2" class="modal" tabindex="-1">
							<div class="modal-dialog ">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="black bigger"><i class="fa fa-pie-chart"> Proveedores</i></h4>
											</div>

											<div class="modal-body">
												<!-- <div class="row col-xs-12 col-sm-12"> -->
												
						<div class="row">
							
							<div class="col-sm-10 col-xs-12 center">
								
							
								<div class="center " id="grafica">
									<img src="http://localhost/Modasof/Administrator/Images/Perfiles/7160-logoTek.png">
								</div>
								</div>
						</div>
												<!-- </div> -->
											<div class="modal-footer">
												<button class="btn btn-sm btn-danger" data-dismiss="modal">
													<i class="ace-icon fa fa-times"></i>
													Cerrar
												</button>
											</div>
										</div>
									</div>
								</div>
							</div>		
			</div>
									
						<!-- FINAL MODAL -->
		<?php 
	include("Lib/footer.php")
	 ?>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="https://modasof.com/espejo/assets/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="https://modasof.com/espejo/assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='https://modasof.com/espejo/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="https://modasof.com/espejo/assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="https://modasof.com/espejo/assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="https://modasof.com/espejo/assets/js/jquery-ui.custom.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/chosen.jquery.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/spinbox.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/bootstrap-datepicker.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/bootstrap-timepicker.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/moment.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/daterangepicker.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/bootstrap-datetimepicker.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/bootstrap-colorpicker.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.knob.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/autosize.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.inputlimiter.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.maskedinput.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/bootstrap-tag.min.js"></script>
		<!-- ace scripts -->
		<script src="https://modasof.com/espejo/assets/js/ace-elements.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/ace.min.js"></script>

		<script src="https://modasof.com/espejo/assets/js/echarts.min.js"></script>
		
		<script src="https://modasof.com/espejo/assets/js/jquery.dataTables.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/dataTables.buttons.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/buttons.flash.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/buttons.html5.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/buttons.print.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/buttons.colVis.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/dataTables.select.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/pdfmake.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/vfs_fonts.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jszip.min.js"></script>
		
		<script src="https://modasof.com/espejo/assets/js/jquery.validate.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery-additional-methods.min.js"></script>

		<script src="https://modasof.com/espejo/assets/js/dataTables.responsive.min.js"></script>
		<!-- 		<script src="dist/js/demo.js"></script> -->
		<!-- <script src="https://modasof.com/espejo/assets/js/jquery.magnific-popup.js"></script> -->
		<script src="https://modasof.com/espejo/assets/js/jquery.magnific-popup.min.js"></script>


		<?php 
	$TabActive=$_GET['TAB'];
 ?>


<script type="text/javascript">
  function activaTab(tab){
    $('.nav-tabs a[href="#' + tab + '"]').tab('show');
};

activaTab('<?php Echo($TabActive); ?>');
</script>

		<script type="text/javascript">
        $(document).ready(function()
        {
             $("#FormNuevoInsumo").validate({
             	errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
                 rules: {
                     "TxtCodigo": { required:true },
                     "TxtCategoria": { required:true },
                     "TxtSubCategoria": { required:true }, 
                     "TxtUnidad": { required:true }, 
                     "TxtTipoInsumo": { required:true }, 
                     "TxtAtributo": { required:true }, 
                     "TxtColor": { required:true }, 
                     "TxtDetalle": { required:true }, 
                     "TxtProveedor1": { required:true },
                     "demo1": { required:true},
                    
                 },
                 
             });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function()
        {
             $("#FormUpdateProveedor").validate({
             	errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
                 rules: {
                     "UpTxtNombre": { required:true },
                     "UpTxtNit": { required:true }, 
                     "UpTxtContacto": { required:true }, 
                    
                     "UpTxtDir": { required:true },
                     "UpTxtCorreo": { required:true, mail:true},
                     "UpTxtTel": { required:true },
                     "UpTxtCelular": { required:true },
                     "UpTxtWhp": { required:true },
                     
                 },
                 
             });
        });
    </script>
		

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				$('#id-disable-check').on('click', function() {
					var inp = $('#form-input-readonly').get(0);
					if(inp.hasAttribute('disabled')) {
						inp.setAttribute('readonly' , 'true');
						inp.removeAttribute('disabled');
						inp.value="This text field is readonly!";
					}
					else {
						inp.setAttribute('disabled' , 'disabled');
						inp.removeAttribute('readonly');
						inp.value="This text field is disabled!";
					}
				});
			
			
				if(!ace.vars['touch']) {
					$('.chosen-select').chosen({allow_single_deselect:true}); 
					//resize the chosen on window resize
			
					$(window)
					.off('resize.chosen')
					.on('resize.chosen', function() {
						$('.chosen-select').each(function() {
							 var $this = $(this);
							 $this.next().css({'width': $this.parent().width()});
						})
					}).trigger('resize.chosen');
					//resize chosen on sidebar collapse/expand
					$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
						if(event_name != 'sidebar_collapsed') return;
						$('.chosen-select').each(function() {
							 var $this = $(this);
							 $this.next().css({'width': $this.parent().width()});
						})
					});
			
			
					$('#chosen-multiple-style .btn').on('click', function(e){
						var target = $(this).find('input[type=radio]');
						var which = parseInt(target.val());
						if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
						 else $('#form-field-select-4').removeClass('tag-input-style');
					});
				}
			
			
				$('[data-rel=tooltip]').tooltip({container:'body'});
				$('[data-rel=popover]').popover({container:'body'});
			
				autosize($('textarea[class*=autosize]'));
				
				$('textarea.limited').inputlimiter({
					remText: '%n carácteres%s restantes...',
					limitText: 'Máx permitidos : %n.'
				});
			
				$.mask.definitions['~']='[+-]';
				$('.input-mask-date').mask('99/99/9999');
				$('.input-mask-phone').mask('(999) 999-9999');
				$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
				$(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});
			
			
			
				$( "#input-size-slider" ).css('width','200px').slider({
					value:1,
					range: "min",
					min: 1,
					max: 8,
					step: 1,
					slide: function( event, ui ) {
						var sizing = ['', 'input-sm', 'input-lg', 'input-mini', 'input-small', 'input-medium', 'input-large', 'input-xlarge', 'input-xxlarge'];
						var val = parseInt(ui.value);
						$('#form-field-4').attr('class', sizing[val]).attr('placeholder', '.'+sizing[val]);
					}
				});
			
				$( "#input-span-slider" ).slider({
					value:1,
					range: "min",
					min: 1,
					max: 12,
					step: 1,
					slide: function( event, ui ) {
						var val = parseInt(ui.value);
						$('#form-field-5').attr('class', 'col-xs-'+val).val('.col-xs-'+val);
					}
				});
			
			
				
				//"jQuery UI Slider"
				//range slider tooltip example
				$( "#slider-range" ).css('height','200px').slider({
					orientation: "vertical",
					range: true,
					min: 0,
					max: 100,
					values: [ 17, 67 ],
					slide: function( event, ui ) {
						var val = ui.values[$(ui.handle).index()-1] + "";
			
						if( !ui.handle.firstChild ) {
							$("<div class='tooltip right in' style='display:none;left:16px;top:-6px;'><div class='tooltip-arrow'></div><div class='tooltip-inner'></div></div>")
							.prependTo(ui.handle);
						}
						$(ui.handle.firstChild).show().children().eq(1).text(val);
					}
				}).find('span.ui-slider-handle').on('blur', function(){
					$(this.firstChild).hide();
				});
				
				
				$( "#slider-range-max" ).slider({
					range: "max",
					min: 1,
					max: 10,
					value: 2
				});
				
				$( "#slider-eq > span" ).css({width:'90%', 'float':'left', margin:'15px'}).each(function() {
					// read initial values from markup and remove that
					var value = parseInt( $( this ).text(), 10 );
					$( this ).empty().slider({
						value: value,
						range: "min",
						animate: true
						
					});
				});
				
				$("#slider-eq > span.ui-slider-purple").slider('disable');//disable third item
			
				
				$('#id-input-file-1 , #id-input-file-2').ace_file_input({
					no_file:'Sin Archivo ...',
					btn_choose:'Seleccionar',
					btn_change:'Cambiar',
					droppable:false,
					onchange:null,
					thumbnail:false //| true | large
					//whitelist:'gif|png|jpg|jpeg'
					//blacklist:'exe|php'
					//onchange:''
					//
				});
				//pre-show a file name, for example a previously selected file
				//$('#id-input-file-1').ace_file_input('show_file_list', ['myfile.txt'])
			
			
				$('#id-input-file-3').ace_file_input({
					style: 'well',
					btn_choose: 'Drop files here or click to choose',
					btn_change: null,
					no_icon: 'ace-icon fa fa-cloud-upload',
					droppable: true,
					thumbnail: 'small'//large | fit
					//,icon_remove:null//set null, to hide remove/reset button
					/**,before_change:function(files, dropped) {
						//Check an example below
						//or examples/file-upload.html
						return true;
					}*/
					/**,before_remove : function() {
						return true;
					}*/
					,
					preview_error : function(filename, error_code) {
						//name of the file that failed
						//error_code values
						//1 = 'FILE_LOAD_FAILED',
						//2 = 'IMAGE_LOAD_FAILED',
						//3 = 'THUMBNAIL_FAILED'
						//alert(error_code);
					}
			
				}).on('change', function(){
					//console.log($(this).data('ace_input_files'));
					//console.log($(this).data('ace_input_method'));
				});
				
				
				//$('#id-input-file-3')
				//.ace_file_input('show_file_list', [
					//{type: 'image', name: 'name of image', path: 'http://path/to/image/for/preview'},
					//{type: 'file', name: 'hello.txt'}
				//]);
			
				
				
			
				//dynamically change allowed formats by changing allowExt && allowMime function
				$('#id-file-format').removeAttr('checked').on('change', function() {
					var whitelist_ext, whitelist_mime;
					var btn_choose
					var no_icon
					if(this.checked) {
						btn_choose = "Drop images here or click to choose";
						no_icon = "ace-icon fa fa-picture-o";
			
						whitelist_ext = ["jpeg", "jpg", "png", "gif" , "bmp"];
						whitelist_mime = ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"];
					}
					else {
						btn_choose = "Drop files here or click to choose";
						no_icon = "ace-icon fa fa-cloud-upload";
						
						whitelist_ext = null;//all extensions are acceptable
						whitelist_mime = null;//all mimes are acceptable
					}
					var file_input = $('#id-input-file-3');
					file_input
					.ace_file_input('update_settings',
					{
						'btn_choose': btn_choose,
						'no_icon': no_icon,
						'allowExt': whitelist_ext,
						'allowMime': whitelist_mime
					})
					file_input.ace_file_input('reset_input');
					
					file_input
					.off('file.error.ace')
					.on('file.error.ace', function(e, info) {
						//console.log(info.file_count);//number of selected files
						//console.log(info.invalid_count);//number of invalid files
						//console.log(info.error_list);//a list of errors in the following format
						
						//info.error_count['ext']
						//info.error_count['mime']
						//info.error_count['size']
						
						//info.error_list['ext']  = [list of file names with invalid extension]
						//info.error_list['mime'] = [list of file names with invalid mimetype]
						//info.error_list['size'] = [list of file names with invalid size]
						
						
						/**
						if( !info.dropped ) {
							//perhapse reset file field if files have been selected, and there are invalid files among them
							//when files are dropped, only valid files will be added to our file array
							e.preventDefault();//it will rest input
						}
						*/
						
						
						//if files have been selected (not dropped), you can choose to reset input
						//because browser keeps all selected files anyway and this cannot be changed
						//we can only reset file field to become empty again
						//on any case you still should check files with your server side script
						//because any arbitrary file can be uploaded by user and it's not safe to rely on browser-side measures
					});
					
					
					/**
					file_input
					.off('file.preview.ace')
					.on('file.preview.ace', function(e, info) {
						console.log(info.file.width);
						console.log(info.file.height);
						e.preventDefault();//to prevent preview
					});
					*/
				
				});
			
				$('#spinner1').ace_spinner({value:0,min:0,max:200,step:10, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
				.closest('.ace-spinner')
				.on('changed.fu.spinbox', function(){
					//console.log($('#spinner1').val())
				}); 
				$('#spinner2').ace_spinner({value:0,min:0,max:10000,step:100, touch_spinner: true, icon_up:'ace-icon fa fa-caret-up bigger-110', icon_down:'ace-icon fa fa-caret-down bigger-110'});
				$('#spinner3').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
				$('#spinner4').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus', icon_down:'ace-icon fa fa-minus', btn_up_class:'btn-purple' , btn_down_class:'btn-purple'});
			
				//$('#spinner1').ace_spinner('disable').ace_spinner('value', 11);
				//or
				//$('#spinner1').closest('.ace-spinner').spinner('disable').spinner('enable').spinner('value', 11);//disable, enable or change value
				//$('#spinner1').closest('.ace-spinner').spinner('value', 0);//reset to 0
			
			
				//datepicker plugin
				//link
				$('.date-picker').datepicker({
					autoclose: true,
					todayHighlight: true
				})
				//show datepicker when clicking on the icon
				.next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
			
				//or change it into a date range picker
				$('.input-daterange').datepicker({autoclose:true});
			
			
				//to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
				$('input[name=date-range-picker]').daterangepicker({
					'applyClass' : 'btn-sm btn-success',
					'cancelClass' : 'btn-sm btn-default',
					locale: {
						applyLabel: 'Apply',
						cancelLabel: 'Cancel',
					}
				})
				.prev().on(ace.click_event, function(){
					$(this).next().focus();
				});
			
			
				$('#timepicker1').timepicker({
					minuteStep: 1,
					showSeconds: true,
					showMeridian: false,
					disableFocus: true,
					icons: {
						up: 'fa fa-chevron-up',
						down: 'fa fa-chevron-down'
					}
				}).on('focus', function() {
					$('#timepicker1').timepicker('showWidget');
				}).next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
				
				
			
				
				if(!ace.vars['old_ie']) $('#date-timepicker1').datetimepicker({
				 //format: 'MM/DD/YYYY h:mm:ss A',//use this option to display seconds
				 icons: {
					time: 'fa fa-clock-o',
					date: 'fa fa-calendar',
					up: 'fa fa-chevron-up',
					down: 'fa fa-chevron-down',
					previous: 'fa fa-chevron-left',
					next: 'fa fa-chevron-right',
					today: 'fa fa-arrows ',
					clear: 'fa fa-trash',
					close: 'fa fa-times'
				 }
				}).next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
				
			
				$('#colorpicker1').colorpicker();
				//$('.colorpicker').last().css('z-index', 2000);//if colorpicker is inside a modal, its z-index should be higher than modal'safe
			
				$('#simple-colorpicker-1').ace_colorpicker();
				//$('#simple-colorpicker-1').ace_colorpicker('pick', 2);//select 2nd color
				//$('#simple-colorpicker-1').ace_colorpicker('pick', '#fbe983');//select #fbe983 color
				//var picker = $('#simple-colorpicker-1').data('ace_colorpicker')
				//picker.pick('red', true);//insert the color if it doesn't exist
			
			
				$(".knob").knob();
				
				
				var tag_input = $('#form-field-tags');
				try{
					tag_input.tag(
					  {
						placeholder:tag_input.attr('placeholder'),
						//enable typeahead by specifying the source array
						source: ace.vars['US_STATES'],//defined in ace.js >> ace.enable_search_ahead
						/**
						//or fetch data from database, fetch those that match "query"
						source: function(query, process) {
						  $.ajax({url: 'remote_source.php?q='+encodeURIComponent(query)})
						  .done(function(result_items){
							process(result_items);
						  });
						}
						*/
					  }
					)
			
					//programmatically add/remove a tag
					var $tag_obj = $('#form-field-tags').data('tag');
					$tag_obj.add('Programmatically Added');
					
					var index = $tag_obj.inValues('some tag');
					$tag_obj.remove(index);
				}
				catch(e) {
					//display a textarea for old IE, because it doesn't support this plugin or another one I tried!
					tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
					//autosize($('#form-field-tags'));
				}
				
				
				/////////
				$('#modal-form input[type=file]').ace_file_input({
					style:'well',
					btn_choose:'Drop files here or click to choose',
					btn_change:null,
					no_icon:'ace-icon fa fa-cloud-upload',
					droppable:true,
					thumbnail:'large'
				})
				
				//chosen plugin inside a modal will have a zero width because the select element is originally hidden
				//and its width cannot be determined.
				//so we set the width after modal is show
				$('#modal-form').on('shown.bs.modal', function () {
					if(!ace.vars['touch']) {
						$(this).find('.chosen-container').each(function(){
							$(this).find('a:first-child').css('width' , '210px');
							$(this).find('.chosen-drop').css('width' , '210px');
							$(this).find('.chosen-search input').css('width' , '200px');
						});
					}
				})
				/**
				//or you can activate the chosen plugin after modal is shown
				//this way select element becomes visible with dimensions and chosen works as expected
				$('#modal-form').on('shown', function () {
					$(this).find('.modal-chosen').chosen();
				})
				*/
			
				
				
				$(document).one('ajaxloadstart.page', function(e) {
					autosize.destroy('textarea[class*=autosize]')
					
					$('.limiterBox,.autosizejs').remove();
					$('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
				});
			
			});
		</script>

		<?php 
	include("Lib/ScriptTablas.php");
	 ?>
	 <script type="text/javascript">
			jQuery(function($) {
				//initiate dataTables plugin
				var myTable = 
				$('#dynamic-table7')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				//And for the first simple table, which doesn't have TableTools or dataTables
				//select/deselect all rows according to table header checkbox
				var active_class = 'active';
				$('#simple-table1 > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$(this).closest('table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
						else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#simple-table1').on('click', 'td input[type=checkbox]' , function(){
					var $row = $(this).closest('tr');
					if($row.is('.detail-row ')) return;
					if(this.checked) $row.addClass(active_class);
					else $row.removeClass(active_class);
				});
			
				
			
				/********************************/
				//add tooltip for small view action buttons in dropdown menu
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				
				//tooltip placement on right or left
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
				
				
				
				
				/***************/
				$('.show-details-btn').on('click', function(e) {
					e.preventDefault();
					$(this).closest('tr').next().toggleClass('open');
					$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
				});
				/***************/
				
				
				
				
				
				/**
				//add horizontal scrollbars to a simple table
				$('#simple-table').css({'width':'2000px', 'max-width': 'none'}).wrap('<div style="width: 1000px;" />').parent().ace_scroll(
				  {
					horizontal: true,
					styleClass: 'scroll-top scroll-dark scroll-visible',//show the scrollbars on top(default is bottom)
					size: 2000,
					mouseWheelLock: true
				  }
				).css('padding-top', '12px');
				*/
			
			
			})
</script>
<script type="text/javascript">
			jQuery(function($) {
			
$('#dynamic-table2 thead tr:eq(1) th').each( function () {
        var title = $('#dynamic-table2 thead tr:eq(0) th').eq( $(this).index() ).text();
        $(this).html( '<input style="width:100%;border:black solid 1px;" type="text" placeholder="Buscar '+title+'" />' );
    } ); 
  
    var table = $('#dynamic-table2').DataTable({
    	responsive:true,
    	"order": false,
        orderCellsTop: true,
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se ha encontrado nada - Lo sentimos",
            "info": "Mostrar página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
       		 },
			
    "lengthMenu": [[500, 700, 1000, -1], [500, 700, 1000, "All"]],

					select: {
						style: 'multi'
					},

    });
  
    // Apply the search
    table.columns().every(function (index) {
        $('#dynamic-table2 thead tr:eq(1) th:eq(' + index + ') input').on('keyup change', function () {
            table.column($(this).parent().index() + ':visible')
                .search(this.value)
                .draw();    
        });
    });

				var myTable = 
				$('#dynamic-table2')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.DataTable( {
retrieve: true,

					
					"aoColumns": [
					  { "bSortable": false },
					  null, null,null, null,null,null,null,null, null,null, null,null,null,null,null, null,null, null,null,null,null,
					  { "bSortable": false }
					],
					"aaSorting": [],
					"scrollX": true,
					
					//"bProcessing": true,
			        //"bServerSide": true,
			        //"sAjaxSource": "http://127.0.0.1/table.php"	,
			
					//,
					
					//"sScrollXInner": "120%",
					//"bScrollCollapse": true,
					//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
					//you may want to wrap the table inside a "div.dataTables_borderWrap" element
			
					//"iDisplayLength": 50

			
			    } );
			
				
    

				
				$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
				
				new $.fn.dataTable.Buttons( myTable, {
					buttons: [
					  {
						"extend": "colvis",
						"text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Ver/Ocultar columnas</span>",
						"className": "btn btn-white btn-primary btn-bold",
						columns: ':gt(0)'
					  },
					  {
						"extend": "copy",
						"text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copiar Tabla</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "csv",
						"text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Exportar a CSV</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {

						"extend": "excelHtml5",
						"text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Exportar a Excel</span>",
						"className": "btn btn-white btn-primary btn-bold"

					  },
					  {

						"extend": "pdf",
						"text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Exportar a PDF</span>",
						"className": "btn btn-white btn-primary btn-bold",
						orientation: 'landscape',
               			 pageSize: 'LEGAL',
					  },
					  {
						"extend": "print",
						"text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Imprimir</span>",
						"className": "btn btn-white btn-primary btn-bold",
						autoPrint: true,
						message: 'Está impresión se produjo desde la App'
					  }		  
					]
				} );
				myTable.buttons().container().appendTo( $('.tableTools-container2') );
				
				//style the message box
				var defaultCopyAction = myTable.button(1).action();
				myTable.button(1).action(function (e, dt, button, config) {
					defaultCopyAction(e, dt, button, config);
					$('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
				});
				


				
				var defaultColvisAction = myTable.button(0).action();
				myTable.button(0).action(function (e, dt, button, config) {
					
					defaultColvisAction(e, dt, button, config);
					
					
					if($('.dt-button-collection > .dropdown-menu').length == 0) {
						$('.dt-button-collection')
						.wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
						.find('a').attr('href', '#').wrap("<li />")
					}
					$('.dt-button-collection').appendTo('.tableTools-container2 .dt-buttons')
				});
			
				////
			
				setTimeout(function() {
					$($('.tableTools-container2')).find('a.dt-button').each(function() {
						var div = $(this).find(' > div').first();
						if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
						else $(this).tooltip({container: 'body', title: $(this).text()});
					});
				}, 500);
				
				
				
				
				
				myTable.on( 'select', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
					}
				} );
				myTable.on( 'deselect', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
					}
				} );
			
			
			
			
			
			
				/////////////////////////////////
				//table checkboxes
				$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
				
				//select/deselect all rows according to table header checkbox
				$('#dynamic-table2 > thead > tr > th input[type=checkbox], #dynamic-table2_wrapper input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$('#dynamic-table2').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) myTable.row(row).select();
						else  myTable.row(row).deselect();
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#dynamic-table2').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(this.checked) myTable.row(row).deselect();
					else myTable.row(row).select();
				});
			
			
			
				$(document).on('click', '#dynamic-table2 .dropdown-toggle', function(e) {
					e.stopImmediatePropagation();
					e.stopPropagation();
					e.preventDefault();
				});
				
				
				
				//And for the first simple table, which doesn't have TableTools or dataTables
				//select/deselect all rows according to table header checkbox
				var active_class = 'active';
				$('#simple-table55 > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$(this).closest('table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
						else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#simple-table55').on('click', 'td input[type=checkbox]' , function(){
					var $row = $(this).closest('tr');
					if($row.is('.detail-row ')) return;
					if(this.checked) $row.addClass(active_class);
					else $row.removeClass(active_class);
				});
			
				
			
				/********************************/
				//add tooltip for small view action buttons in dropdown menu
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				
				//tooltip placement on right or left
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
				
				
				
				
				/***************/
				$('.show-details-btn').on('click', function(e) {
					e.preventDefault();
					$(this).closest('tr').next().toggleClass('open');
					$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
				});
				/***************/
		
			
			})
		</script>


	
	</body>
</html>
