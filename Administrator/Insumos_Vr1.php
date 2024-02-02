<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];
include("Lib/permisos.php");

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
		<title>Insumos Modasof</title>

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

<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/magnific-popup.css">
<script type="text/javascript">
	$(document).ready(function() {
  $('.image-link').magnificPopup({type:'image'});
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
    if ($Valide==13) {
        echo "<script>jQuery(function(){swal(\"¡ Nombre Categoria Actualizado!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==14) {
        echo "<script>jQuery(function(){swal(\"¡ Nombre Sub-Categoria Actualizado!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==15) {
        echo "<script>jQuery(function(){swal(\"¡ Estado Categoria Actualizado!\", \"Correctamente \", \"success\");});</script>";
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
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="index.php">Inicio</a>
							</li>
							<li>
								<i class="ace-icon fa fa-industry"></i>
								<a href="Panel-Produccion.php">Área de Producción</a>
							</li>
							<li>
								<i class="ace-icon fa fa-cubes"></i>
								<a href="insumos.php">Insumos</a>
							</li>
						</ul><!-- /.breadcrumb -->

						
					</div>

					<div class="page-content">
				<?php 
					//include("Lib/colors.php");
				?>
						<div class="row">
								<div class="col-xs-12 col-sm-12 center">
							<a  href="Panel-Produccion.php">
							<div class="infobox" id="botonoculto">
											
											<div class="infobox-data" >

												<span class="infobox-data-number"><i class="ace-icon fa fa-dashboard"></i> REPORTE</span>
												<!-- <div class="infobox-content"><a href="Entradas.php">Total Entradas</a></div> -->
											</div>

											<!-- <div class="stat stat-success">8%</div> -->
							</div>
							</a>
							<a href="Produccion.php">
							<div class="infobox" id="botonoculto">
									
											<div class="infobox-data">
												<span class="infobox-data-number"> PRODUCCIÓN</span>
												<!-- <div class="infobox-content"><a href="Entradas.php">Total Gastos</a></div> -->
											</div>

											<!-- <div class="stat stat-success">8%</div> -->
							</div>
							</a>
							<a href="Proveedores.php">
							<div class="infobox" id="botonoculto">
									
											<div class="infobox-data">
												<span class="infobox-data-number"> PROVEEDORES</span>
												<!-- <div class="infobox-content"><a href="Entradas.php">Total Gastos</a></div> -->
											</div>

											<!-- <div class="stat stat-success">8%</div> -->
							</div>
							</a>
							<a href="insumos.php">
							<div class="infobox" id="botonactivo">
										
											<div class="infobox-data">
												<span class="infobox-data-number"><i class="ace-icon fa fa-cubes"></i> INSUMOS</span>
												<!-- <div class="infobox-content"><a href="Entradas.php">Hab. Disponibles</a></div> -->
							</div>

											<!-- <div class="stat stat-success">8%</div> -->
							</div>
						</a>
							<a href="Compras.php">
							<div class="infobox" id="botonoculto">
									
											<div class="infobox-data">
												<span class="infobox-data-number"><i class="ace-icon fa fa-cart-arrow-down"></i> COMPRAS</span>
												<!-- <div class="infobox-content"><a href="Entradas.php">Total Gastos</a></div> -->
											</div>

											<!-- <div class="stat stat-success">8%</div> -->
							</div>
							</a>
							<div class="space-4"></div>
						
						<div class="col-xs-12 col-sm-3 widget-container-col" id="widget-container-col-5">
											<div class="widget-box" id="widget-box-5">
												<div class="widget-header">
													<h5 class="widget-title smaller">Por Atender</h5>

													<div class="widget-toolbar">
														<span class="label label-success">
															33%
															<i class="ace-icon fa fa-arrow-up"></i>
														</span>
													</div>
												</div>

												<div class="widget-body">
													<div class="widget-main padding-6">
														<div class="alert alert-info"><strong><a href="">12 ITEMS</a></strong></div>
													</div>
												</div>
											</div>
										</div>

						<div class="col-xs-12 col-sm-3 widget-container-col" id="widget-container-col-5">
											<div class="widget-box" id="widget-box-5">
												<div class="widget-header">
													<h5 class="widget-title smaller">Mayor Frecuencia</h5>

													<div class="widget-toolbar">
														
													</div>
												</div>

												<div class="widget-body">
													<div class="widget-main padding-6">
														<div class="alert alert-info"><strong>45 ITEMS</strong></div>
													</div>
												</div>
											</div>
										</div>
					<div class="col-xs-12 col-sm-3 widget-container-col" id="widget-container-col-5">
											<div class="widget-box" id="widget-box-5">
												<div class="widget-header">
													<h5 class="widget-title smaller">Inventario </h5>

													<div class="widget-toolbar">
														<span class="label label-danger">
															50%
															<i class="ace-icon fa fa-arrow-down"></i>
														</span>
													</div>
												</div>

												<div class="widget-body">
													<div class="widget-main padding-6">
														<div class="alert alert-info"> <strong>$4.500.000</strong></div>
													</div>
												</div>
											</div>
										</div>
					<div class="col-xs-12 col-sm-3 widget-container-col" id="widget-container-col-5">
											<div class="widget-box" id="widget-box-5">
												<div class="widget-header">
													<h5 class="widget-title smaller">Comprado</h5>

													<div class="widget-toolbar">
														
													</div>
												</div>

												<div class="widget-body">
													<div class="widget-main padding-6">
														<div class="alert alert-info"> <strong>$9.500.000</strong></div>
													</div>
												</div>
											</div>
										</div>
								
						
						</div>
						
						


						
							<div class="col-xs-12">
							<!-- Inicio Formulario Editar -->
					
							<!-- Inicio Modal -->
					<?php 
					$EditTask = $_GET['EditTask'];
						if ($EditTask!="") {
					 ?>
								<div id="DivEditar">
						<?php 
	
		$sql ="SELECT Id_Proveedor, Nom_Prov, Nit_Prov, Dir_Prov, Tel_Prov, Cel1_Prov, Whp_Prov, Email_Prov, Contacto_Prov, Nom_Ciudad, Tipo_Insumo FROM t_proveedores as A, t_ciudades as B WHERE A.Ciudad_Id_Ciudad=B.Id_Ciudad and Id_Proveedor='".$EditTask."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Qr_Id_Proveedor=$row['Id_Proveedor'];
        $Qr_Nom_Prov=$row['Nom_Prov'];
        $Qr_Nit_Prov=$row['Nit_Prov'];
        $Qr_Dir_Prov=$row['Dir_Prov'];
        $Qr_Tel_Prov=$row['Tel_Prov'];
        $Qr_Cel1_Prov=$row['Cel1_Prov'];
        $Qr_Whp_Prov=$row['Whp_Prov'];
        $Qr_Email_Prov=$row['Email_Prov'];
        $Qr_Contacto_Prov=$row['Contacto_Prov'];
        $Qr_Nom_Ciudad=$row['Nom_Ciudad'];
		$Qr_Tipo_Insumo=$row['Tipo_Insumo'];
 }
}
						
						 ?>


					<form action="Proveedor-ActualizarProveedor.php" method="post" id="FormUpdateProveedor">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												
												<h4 class="blue bigger">Editar Cliente Natural</h4>
											</div>

											<div class="modal-body">
												<div class="row">
										<div class="col-xs-12 col-sm-6 ">

													
										</div>

											<div class="col-xs-12 col-sm-6 ">

														

											<div class="form-group">
															<label for="form-field-select-3">Celular</label>

															<div class="input-group">
																<span class="input-group-addon">
																	<i class="ace-icon fa fa-mobile-phone"></i>
																</span>

								<input name="UpTxtCelular" class="form-control input-mask-phone" type="text" id="form-field-mask-2" value="<?php Echo utf8_encode($Qr_Cel1_Prov) ?>" />
															</div>
														
														</div>
											<div class="form-group">
															<label for="form-field-select-3">What's App</label>

															<div class="input-group">
																<span class="input-group-addon">
																	<i class="ace-icon fa fa-whatsapp"></i>
																</span>

								<input name="UpTxtWhp" class="form-control input-mask-phone" type="text" id="form-field-mask-2" value="<?php Echo utf8_encode($Qr_Whp_Prov) ?>"/>
															</div>
														
												</div>
											<div class="form-group">
															<label for="form-field-select-3">Teléfono</label>

															<div class="input-group">
																<span class="input-group-addon">
																	<i class="ace-icon fa fa-phone"></i>
																</span>

								<input name="UpTxtTel" class="form-control input-mask-phone" type="text" id="form-field-mask-2" value="<?php Echo utf8_encode($Qr_Tel_Prov) ?>" />
															</div>
														
												</div>
											<div class="form-group">
															<label for="form-field-select-3">E-mail</label>

															<div class="input-group">
																<span class="input-group-addon">
																	<i class="ace-icon fa fa-envelope"></i>
																</span>
							<input type="email" name="UpTxtCorreo" class="input-large" placeholder="Dirección de Proveedor" style="text-transform:uppercase;" value="<?php Echo utf8_encode($Qr_Email_Prov) ?>">
															</div>
														
														</div>
											
													</div>

													
												</div>
											</div>

													
												</div>
												<div class="modal-footer">
												<a href="Proveedores.php" class="btn btn-sm" data-dismiss="modal">
													<i class="ace-icon fa fa-times"></i>
													Cancelar
												</a>

												<button class="btn btn-sm btn-primary">
													<i class="ace-icon fa fa-refresh"></i>
													Actualizar
												</button>
											</div>
											</div>

											
										</div>
									</div>
								</form>
								</div><!-- PAGE CONTENT ENDS -->
						<!-- FINAL MODAL -->


						</div>
					<?php 
				}
					 ?>

								<!-- PAGE CONTENT BEGINS -->
									<!-- <a href="#modal-form" role="button" class="blue" data-toggle="modal"> Form Inside a Modal Box </a> -->

						<!-- Inicio botones de acceso rápido -->
						<div class="col-sm-12 col-xs-12">
							<a  data-toggle="modal" data-target="#modal-form" href="#"><span class="btn btn-danger pull-right"><i class="fa fa-plus-square"> </i> Crear Insumo</span></a>
						<!-- Inicio Modal -->
								<div id="modal-form" class="modal" tabindex="-1">

							<form action="Insumo-CrearInsumo.php" method="post" id="FormNuevoInsumo" enctype="multipart/form-data">
									<div class="modal-dialog">
										<div class="modal-content ">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="black bigger">Nuevo Insumo</h4>
											</div>

											<div class="modal-body">
												<div class="row">
													<div class="col-xs-12 col-sm-6 ">
														<div class="form-group">
															<label for="form-field-select-3">Categoria del Insumo</label>

															<div>
												<select class="chosen-select input-xxlarge" name="TxtCategoria" data-placeholder="Seleccionar...">
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
															<label for="form-field-select-3">Código de Insumo</label>

															<div class="input-group">
																<span class="input-group-addon">
																	<i class="ace-icon fa fa-key"></i>
																</span>
												<input type="text" name="TxtCodigo" class="input-large" placeholder="Cód. Contacto" style="text-transform:uppercase;" value="<?php Echo utf8_encode($Qr_Contacto_Prov) ?>">
															</div>
														
														</div>
												<div class="form-group">
															<label for="form-field-select-3">Nombre de Insumo</label>

															<div class="input-group">
																<span class="input-group-addon">
																	<i class="ace-icon fa fa-pencil"></i>
																</span>
												<input type="text" name="TxtNomInsumo" class="input-large" placeholder="Nombre Insumo" style="text-transform:uppercase;" value="<?php Echo utf8_encode($Qr_Contacto_Prov) ?>">
															</div>
														
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
														<option value="Pq">Paquete</option>		
																	
												</select>
															</div>
														
												</div>

												
									<div class="form-group">
										<label for="form-field-select-3">Imagen</label>
										<div >
											<input name="fotoportada"  type="file" id="id-input-file-1" class="col-xs-10 col-sm-5"" />
										</div>
									</div>

									<div>
											<label for="form-field-9">Características</label>

									<textarea class="form-control limited" name="TxtDetalle" id="form-field-9" rows="4" maxlength="300"></textarea>
									</div>
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
													<input type="text" name="TxtCodProv1" class="input-sm" placeholder="Cód. Proveedor 1">
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
													<input type="text" name="TxtCodProv2" class="input-sm" placeholder="Cód. Proveedor 2">
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
													<input type="text" name="TxtCodProv3" class="input-sm" placeholder="Cód. Proveedor 3">
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
										<hr>

											

													</div>

													
												</div>
											</div>

											<div class="modal-footer">
												<button class="btn btn-sm" data-dismiss="modal">
													<i class="ace-icon fa fa-times"></i>
													Cancelar
												</button>

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
$sql ="SELECT Distinct(Cod_Insumo) FROM t_insumos order by Cod_Insumo ASC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$ListaInsumos=$ListaInsumos.$row['Cod_Insumo'].",";                  
 }
}
$CadenaInsumos=explode(",", $ListaInsumos);
//Split al Arreglo
$longitud = count($CadenaInsumos);
$min=$longitud-1;
//Recorro todos los elementos
//for($i=0; $i<$min; $i++)
//{
?>
							
							
				
				<div class="col-sm-12"><!-- Inicio Panel 12 -->
										<div class="tabbable">
											<ul class="nav nav-tabs" id="myTab">
												<li class="active">
													<a data-toggle="tab" href="#tabs-1">
														<i class="green ace-icon fa fa-cubes bigger-120"></i>
														Total Insumos
													</a>
												</li>

												<li>
													<a data-toggle="tab" href="#tabs-2">
												<i class="blue ace-icon fa fa-list bigger-120"></i>
														Movimiento Insumos
													</a>
												</li>
												<li>
													<a data-toggle="tab" href="#tabs-3">
												<i class="red ace-icon fa fa-gear bigger-120"></i>
														Categoria Insumos
													</a>
												</li>
												
												<!-- 	<li>
													<a data-toggle="tab" href="#tabs-4">
														Solicitudes
														<span class="badge badge-danger">4</span>
													</a>
												</li> -->

												
											</ul>

											<div class="tab-content">
												<div id="tabs-1" class="tab-pane fade in active"><!-- Inicio Tab Número Uno -->
													<div class="clearfix">
											<div class="pull-left tableTools-container"></div>
										</div>
										<div class="table-header">
											Lista de Insumos
										</div>
										
										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
											<table style="font-size: 12px;" id="dynamic-table"  class="table table-responsive table-striped table-bordered table-hover">
												<thead>

													<tr class="warning">
														<th class="tdcustom" style="width: 5%;">Cód.</th>
														<th class="tdcustom" style="width: 5%;">Img</th>
														<th class="tdcustom" style="width: 5%;">Categoria</th>
														<th class="tdcustom" style="width: 10%;">Nombre</th>
														
														<th class="tdcustom" style="width: 5%;">Disp. Valledupar</th>
														<th class="tdcustom" style="width: 5%;">Disp. Barranquilla</th>
														<th class="tdcustom" style="width: 5%;">T. Inventario</th>
														<th class="tdcustom" style="width: 5%;">Mejor Precio</th>
														<th class="tdcustom" style="width: 10%;">Acciones</th>
													</tr>
													<tr>
														<th class="tdcustom" style="width: 5%;">Cód.</th>
														<th class="tdcustom" style="width: 5%;">Img</th>
														<th class="tdcustom" style="width: 5%;">Categoria</th>
														<th class="tdcustom" style="width: 10%;">Nombre</th>
														
														<th class="tdcustom" style="width: 5%;">Disp. Valledupar</th>
														<th class="tdcustom" style="width: 5%;">Disp. Barranquilla</th>
														<th class="tdcustom" style="width: 5%;">T. Inventario</th>
														<th class="tdcustom" style="width: 5%;">Mejor Precio</th>
														<th class="tdcustom" style="width: 10%;">Acciones</th>
													</tr>
												</thead>

												<tbody>
<?php 
for($i=0; $i<$min; $i++)
{
$sql ="SELECT Id_Insumo, Cod_Insumo, Nom_Insumo, Unidad_Insumo, Url_Insumo, Detalle_Insumo,Nom_CategoriaIns FROM t_insumos as A, t_categorias_insumos as B WHERE Cod_Insumo='".$CadenaInsumos[$i]."' and A.Categoria_Id_Categoria_Insumo=B.Id_Categoria_Insumo and B.CategoriaIns_Publicada='1'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Tb_Id_Insumo=$row['Id_Insumo'];
        $Tb_Cod_Insumo=$row['Cod_Insumo'];
        $Tb_Nom_Insumo=$row['Nom_Insumo'];
        $Tb_Unidad_Insumo=$row['Unidad_Insumo'];
        $Tb_Url_Insumo=$row['Url_Insumo'];
        $Tb_Nom_CategoriaIns=$row['Nom_CategoriaIns'];
	}
}
													 ?>

														<tr>
														<td>
													
														<a href="insumos.php?EditTask=<?php echo($Tb_Id_Insumo);?>" class="tooltip-primary blue" data-rel="tooltip" data-placement="top" title="Editar Insumo">
																	<?php echo utf8_encode($Tb_Cod_Insumo); ?>	<i class="fa fa-pencil"></i>
														</a>
														</td>
														<td class="center">

													<a class="image-link" href="<?php echo utf8_encode($Tb_Url_Insumo); ?>"><img src="<?php echo utf8_encode($Tb_Url_Insumo); ?>" width="40px" height="40px"></a>
														</td>
														<td class="tdcustom">
															<?php Echo utf8_encode($Tb_Nom_CategoriaIns) ?>
																
															</td>
														<td class="tdcustom">
															<?php Echo utf8_encode($Tb_Nom_Insumo) ?>
																
															</td>
														<td class="center danger">
										<?php  
										$Valledupar=(DisponibilidadBodega(5,$Tb_Cod_Insumo)." ".$Tb_Unidad_Insumo);
										Echo($Valledupar);
										?>
																
														</td>
														<td class="center info">
										<?php  
										$Barranquilla=(DisponibilidadBodega(6,$Tb_Cod_Insumo)." ".$Tb_Unidad_Insumo);
										Echo($Barranquilla);
										?>
																
														</td>
														<td class="center success">
										<?php 
										Echo($Barranquilla+$Valledupar." ".$Tb_Unidad_Insumo);
										?>
																
														</td>

														<td class="center">
										<?php 
	$sql ="SELECT Cod_Insumo, Proveedor_Id_Proveedor,Nom_Prov,MIN(Costo_Insumo) as MinCosto FROM t_insumos as A, t_proveedores as B WHERE Cod_Insumo='".$CadenaInsumos[$i]."' and A.Proveedor_Id_Proveedor=B.Id_Proveedor  order by Costo_Insumo asc"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        
        $Min_Cod_Insumo=$row['Cod_Insumo'];
        $Min_Nom_Prov=$row['Nom_Prov'];
        $Min_Costo_Insumo=$row['MinCosto'];
       }
   }
								 ?>	
								 <a href="" class="tooltip-primary blue" data-rel="tooltip" data-placement="top" title="Mejor Precio en el Mercado">
																	<?php echo (Formatomoneda($Min_Costo_Insumo)); ?>
														</a>

														</td>

														
														<td >
															<div class="hidden-sm hidden-xs action-buttons">

												
															<div class="btn-group">
												<button data-toggle="dropdown" class="tooltip-primary dropdown-toggle">
													Crear Pedido a:
													<i class="ace-icon fa fa-angle-down icon-on-right"></i>
												</button>

												<ul class="dropdown-menu tooltip-primary">
								<?php 
	$sql ="SELECT Cod_Insumo, Proveedor_Id_Proveedor,Nom_Prov,Costo_Insumo FROM t_insumos as A, t_proveedores as B WHERE Cod_Insumo='".$CadenaInsumos[$i]."' and A.Proveedor_Id_Proveedor=B.Id_Proveedor  order by Costo_Insumo asc"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Tb_Id_Proveedor=$row['Proveedor_Id_Proveedor'];
        $Tb_Cod_Insumo=$row['Cod_Insumo'];
        $Tb_Nom_Prov=$row['Nom_Prov'];
        $Tb_Costo_Insumo=$row['Costo_Insumo'];
       
								 ?>

													<li>
														<a href="Proveedor-CrearOrden.php?NomProv=<?php Echo utf8_encode($Tb_Nom_Prov) ?>&DocSel=<?php Echo utf8_encode($Tb_Id_Proveedor) ?>"><?php Echo utf8_encode($Tb_Nom_Prov) ?> <strong>(<?php Echo(Formatomoneda($Tb_Costo_Insumo)) ?>)</strong></a>
													</li>

													
									<?php 
								}
									}
									 ?>

													<!-- <li class="divider"></li>

													<li>
														<a href="#">Separated link</a>
													</li> -->
												</ul>
											</div><!-- /.btn-group -->
														<?php 
											if ($Valledupar==0 and $Barranquilla==0) {
												?>

											 <a href="insumos.php?DeleteInsumo=<?php echo($Tb_Cod_Insumo);?>" class="tooltip-danger red" data-rel="tooltip" data-placement="top" title="Eliminar Insumo">
															<i class="fa fa-trash-o bigger-150"></i>
												</a>
												<?php
											}
											 ?>		

											 <!--  <a href="Proveedores.php?EditTask=<?php echo($Tb_Id_Insumo);?>" class="tooltip-danger red" data-rel="tooltip" data-placement="top" title="Transferir Insumos">
															<i class="fa fa-exchange bigger-150"></i>
												</a>
 -->
															</div>


															<div class="hidden-md hidden-lg">
																<div class="inline pos-rel">
																	<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
																		<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
																	</button>

																	<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
																<li>
																
																		</li>




																		<li>
																			<?php 
															if ($Val_Eliminar==1) {
																?>
																<a href="Usuarios.php?Delete=<?php echo($Tb_IdUsuario);?>" class="tooltip-error red" data-rel="tooltip" title="Desvincular Usuario">
																	<i class="ace-icon fa fa-trash-o bigger-130"></i>
																</a>
															<?php
															}
															 ?>
																		</li>

																		
																	</ul>
																</div>
															</div>
														</td>
													</tr>
													<?php 
													
}
													 ?>
												</tbody>
											</table>
										</div>

													
												</div><!-- Fin Tab Número Uno -->

												<div id="tabs-2" class="tab-pane fade"><!-- Inicio Tab Número Dos -->
<?php 
$sql ="SELECT Id_Mov_Insumos FROM t_mov_insumos order by Id_Mov_Insumos ASC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$ListaMovInsumos=$ListaMovInsumos.$row['Id_Mov_Insumos'].",";                  
 }
}
 ?>		
													<div class="clearfix">
											<div class="pull-left tableTools-container2"></div>
										</div>
										<div class="table-header">
											Movimientos Insumos
										</div>
										
										
										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
											<table style="font-size: 12px;" id="dynamic-table2"  class="table table-responsive table-striped table-bordered table-hover">
												<thead>

													<tr class="warning">
														<th class="tdcustom" style="width: 5%;">Id.</th>
														<th class="tdcustom" style="width: 5%;">Tipo Mov.</th>
 														<th class="tdcustom" style="width: 5%;">Cod. Trans</th>
														<th class="tdcustom" style="width: 5%;">Orden Compra</th>
														<th class="tdcustom" style="width: 5%;">Insumo</th>
														<th class="tdcustom" style="width: 5%;">Cantidad</th>
														<th class="tdcustom" style="width: 5%;">Fecha</th>
														<th class="tdcustom" style="width: 5%;">Reponsable</th>
														<th class="tdcustom" style="width: 10%;">Bodega Recibe</th>
														<th class="tdcustom" style="width: 10%;">Bodega Retira</th>
														
													</tr>
													<tr>
														<th class="tdcustom" style="width: 5%;">Id.</th>
														<th class="tdcustom" style="width: 5%;">Tipo Mov.</th>
 														<th class="tdcustom" style="width: 5%;">Cod. Trans</th>
														<th class="tdcustom" style="width: 5%;">Orden Compra</th>
														<th class="tdcustom" style="width: 5%;">Insumo</th>
														<th class="tdcustom" style="width: 5%;">Cantidad</th>
														<th class="tdcustom" style="width: 5%;">Fecha</th>
														<th class="tdcustom" style="width: 5%;">Reponsable</th>
														<th class="tdcustom" style="width: 10%;">Bodega Recibe</th>
														<th class="tdcustom" style="width: 10%;">Bodega Retira</th>
														
													</tr>
												</thead>

												<tbody>


<?php 
$CadenaMovInsumos=explode(",", $ListaMovInsumos);
//Split al Arreglo
$longitud2 = count($CadenaMovInsumos);
$min2=$longitud2-1;
for($x=0; $x<$min2; $x++)
{
	//Datos de los Movimientos
$sql ="SELECT date_format(Fecha_Solicitud,CONCAT(CONCAT(ELT(WEEKDAY(Fecha_Solicitud) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(Fecha_Solicitud), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS FechaSolicitado,date_format(Fecha_Realizado,CONCAT(CONCAT(ELT(WEEKDAY(Fecha_Realizado) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(Fecha_Realizado), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS FechaRealizado, Id_Mov_Insumos, Cant_Mov, Tipo_Mov_Insumo, Cod_Orden_Transf, OrdenCompra, Usuario_Id_Usuario, Fecha_Solicitud, Fecha_Realizado,B.Nombres,B.Apellidos FROM t_mov_insumos as A, t_usuarios as B WHERE Id_Mov_Insumos='".$CadenaMovInsumos[$x]."' and A.Usuario_Id_Usuario=B.Id_Usuario"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Tb2_FechaSolicitado=$row['FechaSolicitado'];
        $Tb2_FechaRealizado=$row['FechaRealizado'];
        $Tb2_Id_Mov_Insumos=$row['Id_Mov_Insumos'];
        $Tb2_Cant_Mov=$row['Cant_Mov'];
        $Tb2_Tipo_Mov_Insumo=$row['Tipo_Mov_Insumo'];
        $Tb2_Cod_Orden_Transf=$row['Cod_Orden_Transf'];
        $Tb2_OrdenCompra=$row['OrdenCompra'];
        $Tb2_Fecha_Solicitud=$row['Fecha_Solicitud'];
        $Tb2_Fecha_Realizado=$row['Fecha_Realizado'];
        $Tb2_NomResponsable=$row['Nombres'];
        $Tb2_ApeResponsable=$row['Apellidos'];

	}
}

//Nombre Bodega que Reciba
$sql ="SELECT Nom_Bodega FROM t_mov_insumos as A, t_bodegas as B WHERE Id_Mov_Insumos='".$CadenaMovInsumos[$x]."' and A.Bodega_Id_Bodega_Recibe=B.Id_Bodega"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Tb2_Nom_Bodega_Recibe=$row['Nom_Bodega'];
	}
}

//Nombre Bodega que Retira
$sql ="SELECT Nom_Bodega FROM t_mov_insumos as A, t_bodegas as B WHERE Id_Mov_Insumos='".$CadenaMovInsumos[$x]."' and A.Bodega_Id_Bodega_Retira=B.Id_Bodega"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Tb2_Nom_Bodega_Retira=$row['Nom_Bodega'];
	}
}

//Nombre, Unidad Insumo
$sql ="SELECT Nom_Insumo,Unidad_Insumo FROM t_mov_insumos as A, t_insumos as B WHERE Id_Mov_Insumos='".$CadenaMovInsumos[$x]."' and A.Insumo_Cod_Insumo=B.Cod_Insumo"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Tb2_Nom_Insumo=$row['Nom_Insumo'];
        $Tb2_Unidad_Insumo=$row['Unidad_Insumo'];
	}
}
													 ?>

														<tr>
														<td>
														<?php echo utf8_encode("MOVIN00".$Tb2_Id_Mov_Insumos); ?>	
														</td>
														<td class="">
										
								<?php Echo utf8_encode($Tb2_Tipo_Mov_Insumo) ?>
														</td>
															<td class="">
										
								<?php Echo utf8_encode($Tb2_Cod_Orden_Transf) ?>
														</td>
														<td class="">
							<a href="Proveedor-DetalleCompra.php?NumeroOrden=<?php Echo utf8_encode($Tb2_OrdenCompra) ?>" class="tooltip-primary blue" data-rel="tooltip" data-placement="top" title="Ver Orden de Compra">
								<?php Echo utf8_encode($Tb2_OrdenCompra) ?>
							</a>
														</td>
														<td class="tdcustom">
															<?php Echo utf8_encode($Tb2_Nom_Insumo) ?>
																
														</td>
														<td class="tdcustom">
															<?php Echo utf8_encode($Tb2_Cant_Mov." ".$Tb2_Unidad_Insumo) ?>
																
															</td>
														<td class="center">
										<?php Echo ($Tb2_FechaRealizado) ?>
																
														</td>
														<td class="center">
									 <a href="" class="tooltip-primary blue" data-rel="tooltip" data-placement="top" title="<?php Echo utf8_encode($Tb2_Fecha_Realizado) ?>">
												<?php echo utf8_encode($Tb2_NomResponsable." ".$Tb2_ApeResponsable); ?>
														</a>
														</td>

														<td class="">
										
								<?php Echo utf8_decode($Tb2_Nom_Bodega_Recibe) ?>
														</td>
														<td class="">
										
								<?php Echo utf8_decode($Tb2_Nom_Bodega_Retira) ?>
														</td>
														
													</tr>
													<?php 
													
}
													 ?>
												</tbody>
											</table>
										</div>

												</div><!-- Fin Tab Número Dos -->

							<div id="tabs-3" class="tab-pane fade"><!-- Inicio Tab Número Tres -->
					<a  data-toggle="modal" data-target="#myModalSubRubro" href="#"><span class="btn btn-info pull-right"><i class="fa fa-plus-square"> Crear Sub-Categoria </i></span></a>
					<a  data-toggle="modal" data-target="#myModalRubro" href="#"><span class="btn btn-danger pull-right"><i class="fa fa-plus-square"> Crear Categoria </i></span></a>

				<!-- Modal -->
<div class="modal fade" id="myModalRubro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear Nueva Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form class="form-horizontal" action="Insumo-CrearCategoriaIns.php" id="FormNuevoRubro" method="post" enctype="multipart/form-data">
         	<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nueva Categoria</label>
					<div class="col-sm-9">
						<input required="true" type="text" id="form-field-1" name="txtNombreRubro" class="col-xs-10 col-sm-5" value="" />
					</div>
			</div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Guardar Categoria</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>
<!-- FIN MODAL -->

<!-- Modal Subrubro-->
<div class="modal fade" id="myModalSubRubro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear Nueva Sub-Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form class="form-horizontal" action="Insumo-CrearSubCategoriaIns.php" id="FormNuevoSubRubro" method="post" enctype="multipart/form-data">
         	
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Seleccionar Categoria</label>
					<div class="col-sm-9">
						<select class="col-xs-10 col-sm-5" name="txtSelRubro">
							<option value="">Seleccionar</option>
																	<?php
$sql ="SELECT Id_Categoria_Insumo, Nom_CategoriaIns FROM t_categorias_insumos";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
    	$SelectIdCategoria=$row['Id_Categoria_Insumo'];
    	$SelectNombreCategoria=$row['Nom_CategoriaIns'];             
    	echo ("<option value='".$SelectIdCategoria."'>".utf8_encode($SelectNombreCategoria)."</option>");
 }
}
            
?>
						</select>
						
					</div>
			</div>

         	<!-- <div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Código Sub-Rubro</label>
					<div class="col-sm-9">
						<input required="true" type="number" id="form-field-1" name="txtCodSubRubro" class="col-xs-10 col-sm-5" value="" />
					</div>
			</div> -->
         	<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nuevo Sub-Categoria</label>
					<div class="col-sm-9">
						<input required="true" type="text" id="form-field-1" name="txtNombreSubRubro" class="col-xs-10 col-sm-5" value="" />
					</div>
			</div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Guardar Sub-Categoria</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>
<!-- FIN MODAL Subrubro-->
												<div class="space-4"></div>

					<table id="simple-table1" class="table  table-bordered table-hover">
											<thead>
												<tr>
													
													<th class="detail-col">Ver +</th>
													<th>Cód. Categoria</th>
													<th>Categoria</th>
													<th class="hidden-480">Status</th>

													<th></th>
												</tr>
											</thead>

											<tbody>
							<?php 

					//Arreglo de cadena ID_COMENTARIO
$sql ="SELECT Id_Categoria_Insumo FROM t_categorias_insumos";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$ListaRubros=$ListaRubros.$row['Id_Categoria_Insumo'].",";                  
 }
}
?>
<?php 
$CadenaLista=explode(",", $ListaRubros);
//Split al Arreglo
$longitud = count($CadenaLista);
$min=$longitud-1;
//Recorro todos los elementos
for($i=0; $i<$min; $i++)
      {
			$sql ="SELECT Id_Categoria_Insumo, Cod_Categoria_Insumo, Nom_CategoriaIns,CategoriaIns_Publicada FROM t_categorias_insumos WHERE Id_Categoria_Insumo='".$CadenaLista[$i]."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Tb_IdRubro=$row['Id_Categoria_Insumo'];
        $Tb_CodRubro=$row['Id_Categoria_Insumo'];
        $Tb_NomRubro=$row['Nom_CategoriaIns'];
        $Tb_EstadoRubro=$row['CategoriaIns_Publicada'];
       $resultado = substr($Tb_NomRubro, 0, 2);
   
							 ?>
<form id="FormRubro" method="post" action="Insumo-ActualizarNomCategoria.php">
												<tr>
													<td class="center">
														<div class="action-buttons">
															<a href="#" class="green bigger-140 show-details-btn" title="Ver Subrubros">
																<i class="ace-icon fa fa-angle-double-down"></i>
																<span class="sr-only">Subrubros</span>
															</a>
														</div>
													</td>

													<td class="center">
														<?php Echo utf8_encode($resultado) ?>
													</td>
													<td>
														<input type="text" required="true" class="input-xxlarge" name="EditNomRubro" value="<?php Echo utf8_encode($Tb_NomRubro) ?>">

														<input style="display: none;" type="text" name="IdRubroEdit" value="<?php Echo utf8_encode($Tb_IdRubro) ?>">
													</td>
													

													<td class="hidden-480">
														
															<?php 
															if ($Tb_EstadoRubro==1) {
																Echo("<span class='label label-sm label-success'>Activo</span>");
															}
															else
															{
																Echo("<span class='label label-sm label-danger'>Inactivo</span>");
															}
															 ?>
															
														</span>
													</td>

													<td>
														<div class="hidden-sm hidden-xs btn-group">
															<button class="btn btn-xs btn-info" type="submit">
																<i class="ace-icon fa fa-refresh bigger-120"></i>
															</button>
															<?php 
															if ($Tb_EstadoRubro==1) {
															echo "<a href='insumos.php?ValEstado=0&RubroEstado=".$Tb_IdRubro."' class='btn btn-xs btn-danger' data-placement='top' title='Cambiar Estado'>
																<i class='ace-icon fa fa-close bigger-120'></i>
															</a>";
															}
															else
															{
															echo "<a href='insumos.php?ValEstado=1&RubroEstado=".$Tb_IdRubro."' class='btn btn-xs btn-success' data-placement='top' title='Cambiar Estado'>
																<i class='ace-icon fa fa-check bigger-120'></i>
															</a>";
															}

															 ?>

															
														</div>

														
													</td>
												</tr>
			</form>

												<?php 
}
}
												 ?>
												


												<tr class="detail-row">
													
													<td colspan="8">
														<div class="table-detail">
															<div class="row">
						
	<form method="post" action="Insumo-ActualizarNomSubCategoria.php">
													<?php 
						$sql ="SELECT Id_SubCategoria_Insumo, Categoria_Id_Categoria_Insumo, Nom_SubCategoriaIns, Subcategoria_Insumo_Publicada FROM t_subcategorias_insumos WHERE Categoria_Id_Categoria_Insumo='".$CadenaLista[$i]."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Tb_IdSubRubro=$row['Id_SubCategoria_Insumo'];
        $Tb_CodSubRubro=$row['Id_SubCategoria_Insumo'];
        $Tb_NomSubRubro=$row['Nom_SubCategoriaIns'];
        $Tb_SubRubroPublicado=$row['Subcategoria_Insumo_Publicada'];

						 ?>
																<div class="col-xs-12 col-sm-9">
																	<div class="space visible-xs"></div>

																	<div class="profile-user-info profile-user-info-striped">
																		<div class="profile-info-row">
																			<div class="profile-info-name"> <?php Echo utf8_encode($Tb_CodSubRubro) ?> </div>

																			<div class="profile-info-value">
																			
													<input  required="true" class="input-xxlarge" type="text" name="NomUpdate-<?php Echo utf8_encode($Tb_IdSubRubro) ?>" value="<?php Echo utf8_encode($Tb_NomSubRubro); ?>">

																				
																				
																			</div>
																			
																		</div>
																		
																	</div>
																</div>
																<div class="col-xs-12 col-sm-3">
																	
																	
																		

																		<div class="clearfix">
																			
																			<button class="pull-right btn btn-sm btn-primary btn-white btn-round" type="submit">
																				Actualizar Sub-Categoria Insumo
																				<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
																			</button>
																		</div>
																	
																</div>
<?php 
}
}
 ?>
																


																

																
															</div>
														</div>
													</td>
													</form>
												
												</tr>




<?php 
}
 ?>

											
											</tbody>
										</table>
									</div><!-- /.span -->
												</div>

										
							</div><!-- Fin Tab Número Tres -->
												<div id="tabs-4" class="tab-pane fade"><!-- Inicio Tab Número Cuatro -->
													Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
													tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
													quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
													consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
													cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
													proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

												</div><!-- Fin Tab Número Cuatro -->


												
											</div>
										</div>
									</div><!-- Fin Panel 12 -->

						</div>
						<!-- Fin botones de acceso rápido -->
													</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

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

		<!-- Inicio scripts Tablas -->
		<!-- page specific plugin scripts -->
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



<!-- 		<script src="dist/js/demo.js"></script> -->
		<script src="https://modasof.com/espejo/assets/js/jquery.magnific-popup.js"></script>
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
                     "TxtNomInsumo": { required:true }, 
                     "TxtUnidad": { required:true }, 
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
	</body>
</html>
