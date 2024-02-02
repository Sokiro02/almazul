<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];
include("Lib/permisos.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Talleres Modasof</title>

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

    <?php include("Lib/Favicon.php") ?>

	</head>

	<body class="skin-1">

	<?php 
  $Valide=$_GET['Mensaje'];

    if ($Valide==2) {
        echo "<script>jQuery(function(){swal(\"¡Lo Sentimos!\", \"Datos Incorrectos\", \"error\");});</script>";
    };
    if ($Valide==1) {
        echo "<script>jQuery(function(){swal(\"¡ Taller Creado!\", \"Correctamente \", \"success\");});</script>";
    };
     if ($Valide==2) {
        echo "<script>jQuery(function(){swal(\"¡ Taller Actualizado!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==22) {
        echo "<script>jQuery(function(){swal(\"¡ Extra Cargada a Cliente!\", \"".$ClienteSel." \", \"success\");});</script>";
    };
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
								<a href="Talleres.php">Talleres</a>
							</li>

							
						
						</ul><!-- /.breadcrumb -->

						
					</div>

					<div class="page-content">
				<?php 
					//include("Lib/colors.php");
				?>
						<div class="row">

						


						
							<div class="col-xs-12">

							<!-- Inicio Formulario Editar -->
						<div>
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
												
												<h4 class="blue bigger">Editar Taller</h4>
											</div>

											<div class="modal-body">
												<div class="row">
										<div class="col-xs-12 col-sm-6 ">

														<div class="form-group">
															<label for="form-field-select-3">Nombre Taller</label>

															<div class="input-group">
																<span class="input-group-addon">
																	<i class="ace-icon fa fa-user"></i>
																</span>
												<input type="text" name="UpTxtNombre" class="input-large" placeholder="Nombre del Proveedor" style="text-transform:uppercase;" value="<?php Echo utf8_encode($Qr_Nom_Prov) ?>">
							<input style="display: none;" type="text" name="TxtEditProv" value="<?php Echo utf8_encode($EditTask) ?>">

															</div>
														
														</div>
														
														<div class="form-group">
															<label for="form-field-select-3">Nit/Documento</label>

															<div class="input-group">
																<span class="input-group-addon">
																	<i class="ace-icon fa fa-bank"></i>
																</span>
												<input type="text" name="UpTxtNit" class="input-large" placeholder="Nit/Documento" style="text-transform:uppercase;" value="<?php Echo utf8_encode($Qr_Nit_Prov) ?>">
															</div>
														
														</div>
														<div class="form-group">
															<label for="form-field-select-3">Contacto</label>

															<div class="input-group">
																<span class="input-group-addon">
																	<i class="ace-icon fa fa-user"></i>
																</span>
												<input type="text" name="UpTxtContacto" class="input-large" placeholder="Persona de Contacto" style="text-transform:uppercase;" value="<?php Echo utf8_encode($Qr_Contacto_Prov) ?>">
															</div>
														
														</div>
														
														

												<div class="form-group">
															<label for="form-field-select-3">Dirección</label>

															<div class="input-group">
																<span class="input-group-addon">
																	<i class="ace-icon fa fa-map-marker"></i>
																</span>
							<input type="text" name="UpTxtDir" class="input-large" placeholder="Dirección de Proveedor" style="text-transform:uppercase;" value="<?php Echo utf8_encode($Qr_Dir_Prov) ?>">
															</div>
														
														</div>
														

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
												<a href="Talleres.php" class="btn btn-sm" data-dismiss="modal">
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
							<a  data-toggle="modal" data-target="#modal-form" href="#"><span class="btn btn-danger pull-right"><i class="fa fa-plus-square"> </i> Crear Taller</span></a>
						<!-- Inicio Modal -->
								<div id="modal-form" class="modal" tabindex="-1">
							<form action="Proveedor-CrearProveedor.php" method="post" id="FormNuevoProveedor">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="blue bigger">Nuevo Taller</h4>
											</div>

											<div class="modal-body">
												<div class="row">
													<div class="col-xs-12 col-sm-6 ">

														<div class="form-group">
															<label for="form-field-select-3">Nombre Proveedor</label>

															<div class="input-group">
																<span class="input-group-addon">
																	<i class="ace-icon fa fa-user"></i>
																</span>
												<input type="text" name="TxtNombre" class="input-large" placeholder="Nombre del Proveedor" style="text-transform:uppercase;">
															</div>
														
														</div>
														
														<div class="form-group">
															<label for="form-field-select-3">Nit/Documento</label>

															<div class="input-group">
																<span class="input-group-addon">
																	<i class="ace-icon fa fa-bank"></i>
																</span>
												<input type="text" name="TxtNit" class="input-large" placeholder="Nit/Documento" style="text-transform:uppercase;">
															</div>
														
														</div>
														<div class="form-group">
															<label for="form-field-select-3">Contacto</label>

															<div class="input-group">
																<span class="input-group-addon">
																	<i class="ace-icon fa fa-user"></i>
																</span>
												<input type="text" name="TxtContacto" class="input-large" placeholder="Persona de Contacto" style="text-transform:uppercase;">
															</div>
														
														</div>
														
														<div class="form-group">
															<label for="form-field-select-3">Ciudad</label>

															<div>
												<select class="chosen-select input-xxlarge" name="TxtCiudad" data-placeholder="Seleccionar...">
																<option value="">Seleccionar...</option>
																<?php
$sql ="SELECT Id_Ciudad, Nom_Ciudad FROM t_ciudades order by Nom_Ciudad ASC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
    	$SelectId_Ciudad=$row['Id_Ciudad'];
    	$SelectNom_Ciudado=$row['Nom_Ciudad'];             
    	echo ("<option value='".$SelectId_Ciudad."'>".utf8_encode($SelectNom_Ciudado)."</option>");
 }
}
        
?>
																	
												</select>
															</div>
														
														</div>

												<div class="form-group">
															<label for="form-field-select-3">Dirección</label>

															<div class="input-group">
																<span class="input-group-addon">
																	<i class="ace-icon fa fa-map-marker"></i>
																</span>
							<input type="text" name="TxtDir" class="input-large" placeholder="Dirección de Proveedor" style="text-transform:uppercase;">
															</div>
														
														</div>
														

													</div>

											<div class="col-xs-12 col-sm-6 ">

														

											<div class="form-group">
															<label for="form-field-select-3">Celular</label>

															<div class="input-group">
																<span class="input-group-addon">
																	<i class="ace-icon fa fa-mobile-phone"></i>
																</span>

								<input name="TxtCelular" class="form-control input-mask-phone" type="text" id="form-field-mask-2" />
															</div>
														
														</div>
											<div class="form-group">
															<label for="form-field-select-3">What's App</label>

															<div class="input-group">
																<span class="input-group-addon">
																	<i class="ace-icon fa fa-whatsapp"></i>
																</span>

								<input name="TxtWhp" class="form-control input-mask-phone" type="text" id="form-field-mask-2" />
															</div>
														
												</div>
											<div class="form-group">
															<label for="form-field-select-3">Teléfono</label>

															<div class="input-group">
																<span class="input-group-addon">
																	<i class="ace-icon fa fa-phone"></i>
																</span>

								<input name="TxtTel" class="form-control input-mask-phone" type="text" id="form-field-mask-2" />
															</div>
														
												</div>
											<div class="form-group">
															<label for="form-field-select-3">E-mail</label>

															<div class="input-group">
																<span class="input-group-addon">
																	<i class="ace-icon fa fa-envelope"></i>
																</span>
							<input type="email" name="TxtCorreo" class="input-large" placeholder="Dirección de Proveedor" style="text-transform:uppercase;">
															</div>
														
														</div>
											<div class="form-group">
															<label for="form-field-select-3">Tipo de Insumo</label>

															<div>
												<select class="chosen-select input-xxlarge" name="TxtTipoInsumo" data-placeholder="Seleccionar...">
														<option value="">Seleccionar...</option>
														<option value="INSUMOS">INSUMOS</option>
														<option value="INSUMO TERMINADO">INSUMO TERMINADO</option>		
																	
												</select>
															</div>
														
														</div>
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
							
							<!-- INICIO TABLA -->
						<div class="clearfix">
											<div class="pull-left tableTools-container"></div>
										</div>
										<div class="table-header">
											Lista de Proveedores
										</div>
										
										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
											<table style="font-size: 12px;" id="dynamic-table"  class="table table-responsive table-striped table-bordered table-hover">
												<thead>
											
													<tr class="warning">
														<th class="tdcustom" style="width: 5%;">Id</th>
														<th class="tdcustom" style="width: 10%;">Nombre</th>
														<th class="tdcustom" style="width: 10%;">Nit</th>
														<th class="tdcustom" style="width: 30%;">Dir</th>
														<th class="tdcustom" style="width: 10%;">Tipo Insumo</th>
														<th class="tdcustom" style="width: 5%;">Contacto</th>
														<th class="tdcustom" style="width: 5%;">E-mail</th>
														
														<th class="tdcustom" style="width: 15%;">Teléfonos</th>
														

													
														<th class="tdcustom" style="width: 10%;">Acciones</th>
													</tr>
													<tr>
														<th class="tdcustom" style="width: 5%;">Id</th>
														<th class="tdcustom" style="width: 10%;">Nombre</th>
														<th class="tdcustom" style="width: 10%;">Nit</th>
														<th class="tdcustom" style="width: 30%;">Dir</th>
														<th class="tdcustom" style="width: 10%;">Tipo Insumo</th>
														<th class="tdcustom" style="width: 5%;">Contacto</th>
														<th class="tdcustom" style="width: 5%;">E-mail</th>
														
														<th class="tdcustom" style="width: 15%;">Teléfonos</th>
														
													
														<th class="tdcustom" style="width: 10%;">Acciones</th>
													</tr>
												</thead>

												<tbody>
<?php 

	$sql ="SELECT Id_Proveedor, Nom_Prov, Nit_Prov, Dir_Prov, Tel_Prov, Cel1_Prov, Whp_Prov, Email_Prov, Contacto_Prov, Nom_Ciudad, Tipo_Insumo FROM t_proveedores as A, t_ciudades as B WHERE A.Ciudad_Id_Ciudad=B.Id_Ciudad"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Tb_Id_Proveedor=$row['Id_Proveedor'];
        $Tb_Nom_Prov=$row['Nom_Prov'];
        $Tb_Nit_Prov=$row['Nit_Prov'];
        $Tb_Dir_Prov=$row['Dir_Prov'];
        $Tb_Tel_Prov=$row['Tel_Prov'];
        $Tb_Cel1_Prov=$row['Cel1_Prov'];
        $Tb_Whp_Prov=$row['Whp_Prov'];
        $Tb_Email_Prov=$row['Email_Prov'];
        $Tb_Contacto_Prov=$row['Contacto_Prov'];
        $Tb_Nom_Ciudad=$row['Nom_Ciudad'];
		$Tb_Tipo_Insumo=$row['Tipo_Insumo'];

													 ?>

														<tr>
														<td>
													
														<a href="Talleres.php?EditTask=<?php echo($Tb_Id_Proveedor);?>" class="tooltip-primary blue" data-rel="tooltip" data-placement="top" title="Editar Proveedor">
																	<?php echo utf8_encode("PROV".$Tb_Id_Proveedor); ?>
														</a>
														</td>
														<td class="tdcustom">
															<?php Echo utf8_encode($Tb_Nom_Prov) ?>
																
															</td>
														<td class="tdcustom"><?php echo utf8_encode($Tb_Nit_Prov); ?></td>
														<td class="tdcustom"><?php echo utf8_encode($Tb_Dir_Prov."- (".$Tb_Nom_Ciudad).")"; ?></td>
														
														<td class="tdcustom"><?php echo utf8_encode($Tb_Tipo_Insumo); ?></td>
														<td class="tdcustom"><?php echo utf8_encode($Tb_Contacto_Prov); ?></td>
														<td class="tdcustom"><a href="mailto:<?php echo utf8_encode($Tb_Email_Prov); ?>"><?php echo utf8_encode($Tb_Email_Prov); ?></a> </td>
														
														<td class="tdcustom">
									
									<?php 
									$CadenaCel="<i class='fa fa-mobile-phone'> </i> ".$Tb_Cel1_Prov;
									$CadenaWhp="<i class='fa fa-whatsapp green'> </i> ".$Tb_Whp_Prov;
									$CadenaTel="<i class='fa fa-phone'> </i> ".$Tb_Tel_Prov;

$cadena = "".$CadenaCel."\r\n".$CadenaWhp."\n\r".$CadenaTel."\n\r";
echo nl2br($cadena);
									 ?>

															</td>
														
														
														
														
														<td class="center">
															<div class="hidden-sm hidden-xs action-buttons">
															
															
																<a href="Proveedor-CrearOrden.php?ApeCliente=<?php echo($Tb_Nom_Prov);?>&DocSel=<?php echo($Tb_Id_Proveedor);?>&NomCliente=<?php echo($Tb_Contacto_Prov);?>" class="tooltip-danger red" data-rel="tooltip" data-placement="top" title="Crear Orden de Compra">
																	<i class="ace-icon fa fa-plus-square bigger-120"> </i> Crear Orden
																</a>
															
															

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
}
													 ?>
												</tbody>
											</table>
										</div>
						<!-- FIN TABLA -->


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

		<script type="text/javascript">
        $(document).ready(function()
        {
             $("#FormNuevoProveedor").validate({
             	errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
                 rules: {
                     "TxtNombre": { required:true },
                     "TxtNit": { required:true }, 
                     "TxtContacto": { required:true }, 
                     "TxtCiudad": { required:true }, 
                     "TxtDir": { required:true },
                     "TxtCorreo": { required:true, mail:true},
                     "TxtTel": { required:true },
                     "TxtCelular": { required:true },
                     "TxtWhp": { required:true },
                     "TxtTipoInsumo": { required:true },
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
					remText: '%n character%s remaining...',
					limitText: 'max allowed : %n.'
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
					no_file:'No File ...',
					btn_choose:'Choose',
					btn_change:'Change',
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
	</body>
</html>
