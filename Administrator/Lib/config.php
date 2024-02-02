<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];
?>
<?php 
$sql ="SELECT Nom_App, Horas_Laborales, Footer_App, Correo_App, Tiempo, Url_Web, Url_Facebook, Url_Instagram, Url_Twitter, Terminos, Consecutivo,Num_Factura FROM t_config WHERE Desarrollador='TEKSYSTEM S.A.S'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Qr_NomApp=$row['Nom_App'];
        $Qr_Horas_Laborales=$row['Horas_Laborales'];
        $Qr_FooterApp=$row['Footer_App'];
        $Qr_Correo_App=$row['Correo_App'];
         $Qr_Tiempo=$row['Tiempo'];
          $Url_Web=$row['Url_Web'];
          $Url_Facebook=$row['Url_Facebook'];
          $Url_Instagram=$row['Url_Instagram'];
          $Url_Twitter=$row['Url_Twitter'];
          $Qr_Terminos=$row['Terminos'];
          $Qr_Consecutivo=$row['Consecutivo'];
          $Qr_Factura=$row['Num_Factura'];
 }
}

$ValEstado=$_GET['ValEstado'];
$RubroEstado=$_GET['RubroEstado'];
$AreaEstado=$_GET['AreaEstado'];

if ($RubroEstado!="") {
	$sql ="UPDATE t_rubros SET Rubro_Publicado='".utf8_decode($ValEstado)."' WHERE Id_rubro='".$RubroEstado."'";  
$result = $conexion->query($sql);
header("location:config.php?Mensaje=14&TAB=tabs-3");
}

if ($AreaEstado!="") {
	$sql ="UPDATE t_areas SET Area_Publicada='".utf8_decode($ValEstado)."' WHERE Id_area='".$AreaEstado."'";  
$result = $conexion->query($sql);
header("location:config.php?Mensaje=15&TAB=tabs-6");
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Configuración</title>

		<meta name="description" content="Static &amp; Dynamic Tables" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/bootstrap-colorpicker.min.css" />
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
    <script src="https://modasof.com/espejo/assets/js/functions.js"></script>
    <!-- Sweet Alert Script -->
    <script src="https://modasof.com/espejo/assets/js/sweetalert.min.js"></script>
    <!--/Fin Alertas-->

    <style type="text/css">
    	.TextoVertical {
    writing-mode: vertical-lr;
    transform: rotate(180deg);
}
.Encabezado
{
	padding: 0px;
}
    </style>
	</head>

	<body class="skin-1">

	<?php 
  $Valide=$_GET['Mensaje'];

    if ($Valide==2) {
        echo "<script>jQuery(function(){swal(\"¡Lo Sentimos!\", \"Datos Incorrectos\", \"error\");});</script>";
    };
    if ($Valide==1) {
        echo "<script>jQuery(function(){swal(\"¡ Datos Actualizados!\", \"Correctamente \", \"success\");});</script>";
    };
     if ($Valide==9) {
        echo "<script>jQuery(function(){swal(\"¡ Estado Eliminado!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==10) {
        echo "<script>jQuery(function(){swal(\"¡ Estado Creado!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==11) {
        echo "<script>jQuery(function(){swal(\"¡ Rol Creado!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==12) {
        echo "<script>jQuery(function(){swal(\"¡ Rol Actualizado!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==13) {
        echo "<script>jQuery(function(){swal(\"¡ Estado Actualizado!\", \"Correctamente \", \"success\");});</script>";
    };
     if ($Valide==15) {
        echo "<script>jQuery(function(){swal(\"¡ Vistas Actualizadas!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==16) {
        echo "<script>jQuery(function(){swal(\"¡ Permisos Actualizados!\", \"Correctamente \", \"success\");});</script>";
    };
     if ($Valide==14) {
        echo "<script>jQuery(function(){swal(\"¡Lo Sentimos Usuario no registrado!\", \"Ponte en contacto con el Web Master: fredy.gonzalez@tekstem.co\", \"error\");});</script>";
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
								<a href="index.php">Home</a>
							</li>

							<li>
								<a class="active" href="config.php">Configuración</a>
							</li>
						
						</ul><!-- /.breadcrumb -->

						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->
					</div>

					<div class="page-content">
						<?php 
	//include("Lib/colors.php");
				?>
						
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="row">
									<div class="col-sm-12">
										<div class="tabbable tabs-left" id="tabs">
											<ul class="nav nav-tabs" id="myTab3">
												<li class="active">
													<a data-toggle="tab" href="#tabs-1">
														<i class="pink ace-icon fa fa-tachometer bigger-110"></i>
														Aplicación
													</a>
												</li>

												<li>
													<a data-toggle="tab" href="#tabs-2">
														<i class="blue ace-icon fa fa-user bigger-110"></i>
														Rol Usuarios
													</a>
												</li>

												<li>
													<a data-toggle="tab" href="#tabs-3">
														<i class="ace-icon fa fa-rocket"></i>
														Rubros
													</a>
												</li>
												<li>
													<a data-toggle="tab" href="#tabs-4">
														<i class="ace-icon fa fa-eye"></i>
														Menús
													</a>
												</li>
												<li>
													<a data-toggle="tab" href="#tabs-5">
														<i class="ace-icon fa fa-eye"></i>
														Permisos
													</a>
												</li>
												<li>
													<a data-toggle="tab" href="#tabs-6">
														<i class="ace-icon fa fa-eye"></i>
														Áreas
													</a>
												</li>
											</ul>

											<div class="tab-content">
												<div id="tabs-1" class="tab-pane in active">
					<!-- Inicio Formulario App -->
							<form class="form-horizontal" id="validation-form" role="form" method="post" action="ActualizarApp.php">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nombre Aplicación </label>
										<div class="col-sm-9">
											<input required="true" type="text" id="form-field-1" name="txtNombre" class="col-xs-10 col-sm-5" value="<?php echo utf8_encode($Qr_NomApp);?>" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Pie de Página </label>
										<div class="col-sm-9">
											<input required="true" type="text" name="TxtFooter" id="form-field-1" class="col-xs-10 col-sm-5" value="<?php echo utf8_encode($Qr_FooterApp);?>" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"  for="form-field-1"> Correo Aplicación </label>
										<div class="col-sm-9">
											<input required="true" type="Email" id="form-field-1" class="col-xs-10 col-sm-5" name="TxtEmail" value="<?php echo utf8_encode($Qr_Correo_App);?>" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tiempo de Sesión (Minutos)</label>
										<div class="col-sm-9">
											<input required="true" type="number" id="form-field-1" class="col-xs-10 col-sm-5" name="TxtTiempo" value="<?php echo utf8_encode($Qr_Tiempo);?>" />
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Consecutivo Ordenes de Compra</label>
										<div class="col-sm-9">
											<input required="true" type="number" id="form-field-1" class="col-xs-10 col-sm-5" name="TxtConsecutivo" value="<?php echo utf8_encode($Qr_Consecutivo);?>" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Consecutivo Facturas</label>
										<div class="col-sm-9">
											<input required="true" type="number" id="form-field-1" class="col-xs-10 col-sm-5" name="TxtFactura" value="<?php echo utf8_encode($Qr_Factura);?>" />
										</div>
									</div>

									
									<div class="space-14"></div>
									<hr />

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Url WebSite <i class="ace-icon fa fa-chrome light-red bigger-150"></i></label>
										<div class="col-sm-9">
										<input required="true" type="text" id="form-field-1" class="col-xs-10 col-sm-5" name="UrlSite" value="<?php echo utf8_encode($Url_Web);?>" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Url Facebook <i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i></label>
										<div class="col-sm-9">
										<input required="true" type="text" id="form-field-1" class="col-xs-10 col-sm-5" name="UrlFacebook" value="<?php echo utf8_encode($Url_Facebook);?>" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Url Instagram <i class="ace-icon fa fa-instagram light-orange bigger-150"></i></label>
										<div class="col-sm-9">
										<input required="true" type="text" id="form-field-1" class="col-xs-10 col-sm-5" name="UrlInstagram" value="<?php echo utf8_encode($Url_Instagram);?>" />
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Url Twitter <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i></label>
										<div class="col-sm-9">
										<input required="true" type="text" id="form-field-1" class="col-xs-10 col-sm-5" name="UrlTwitter" value="<?php echo utf8_encode($Url_Twitter);?>" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Términos y Condiciones</label>
										<div class="col-sm-9">
										<input required="true" type="textarea" id="form-field-1" class="col-xs-10 col-sm-5" name="TxtTerminos" value="<?php echo utf8_encode($Qr_Terminos);?>" />
										</div>
									</div>

									<div class="clearfix">
									<button type="submit" class="width-35 pull-right btn btn-sm btn-danger">
									<i class="ace-icon fa fa-refresh"></i>
									<span class="bigger-110">Actualizar Datos</span>
										</button>
											</div>
								</form>
						<!-- Fin Formulario App -->
												</div>

								<div id="tabs-2" class="tab-pane">
									<a  data-toggle="modal" data-target="#myModal" href="#"><span class="btn btn-danger pull-right"><i class="fa fa-plus-square"> Crear Rol </i></span></a>
									<div class="col-xs-12">
									

				<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear Nuevo Rol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form class="form-horizontal" action="CrearRol.php" id="validation-form" method="post" enctype="multipart/form-data">
         	<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nuevo Rol</label>
					<div class="col-sm-9">
						<input required="true" type="text" id="form-field-1" name="txtNombreRol" class="col-xs-10 col-sm-5" value="" />
					</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Descripción</label>
					<div class="col-sm-9">
						<input required="true" type="text" id="form-field-1" name="txtDescri" class="col-xs-10 col-sm-5" value="" />
					</div>
			</div>

			<div class="form-group">
							<label class="control-label col-xs-12 col-sm-3">Actualizar</label>
										<div class="controls col-xs-12 col-sm-9">
											<div class="row">
												<div class="col-xs-3">
													<label>
														<input value="1" name="ChecActualizar" class="ace ace-switch ace-switch-2" type="checkbox" />
														<span class="lbl"></span>
													</label>
												</div>
											</div>	
										</div>
							</div>

			<div class="form-group">
							<label class="control-label col-xs-12 col-sm-3">Editar</label>
										<div class="controls col-xs-12 col-sm-9">
											<div class="row">
												<div class="col-xs-3">
													<label>
														<input value="1" name="ChecEditar" class="ace ace-switch ace-switch-2" type="checkbox" />
														<span class="lbl"></span>
													</label>
												</div>
											</div>	
										</div>
							</div>

			<div class="form-group">
							<label class="control-label col-xs-12 col-sm-3">Eliminar</label>
										<div class="controls col-xs-12 col-sm-9">
											<div class="row">
												<div class="col-xs-3">
													<label>
														<input value="1" name="ChecEliminar" class="ace ace-switch ace-switch-2" type="checkbox" />
														<span class="lbl"></span>
													</label>
												</div>
											</div>	
										</div>
			</div>

			<div class="form-group">
							<label class="control-label col-xs-12 col-sm-3">Insertar</label>
										<div class="controls col-xs-12 col-sm-9">
											<div class="row">
												<div class="col-xs-3">
													<label>
														<input value="1" name="ChecInsertar" class="ace ace-switch ace-switch-2" type="checkbox" />
														<span class="lbl"></span>
													</label>
												</div>
											</div>	
										</div>
			</div>

			<div class="form-group">
							<label class="control-label col-xs-12 col-sm-3">Ver</label>
										<div class="controls col-xs-12 col-sm-9">
											<div class="row">
												<div class="col-xs-3">
													<label>
														<input value="1" name="ChecVer" class="ace ace-switch ace-switch-2" type="checkbox" />
														<span class="lbl"></span>
													</label>
												</div>
											</div>	
										</div>
			</div>


        
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Crear Rol</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>
<!-- FIN MODAL -->
												<div class="space-4"></div>

					<table id="simple-table" class="table  table-bordered table-hover">
											<thead>
												<tr class="blue">
													<th class="center">Id</th>
													<th class="center">Rol</th>
													<th>Descripción</th>
													<th>
														<i class="ace-icon fa fa-refresh bigger-110 hidden-480"></i>
														Actualizar
													</th>
													<th>
														<i class="ace-icon fa fa-pencil bigger-110 hidden-480"></i>
														Editar
													</th>
													<th>
														<i class="ace-icon fa fa-trash-o bigger-110 hidden-480"></i>
														Eliminar
													</th>
													<th>
														<i class="ace-icon fa fa-plus-square bigger-110 hidden-480"></i>
														Insertar
													</th>
													<th>
														<i class="ace-icon fa fa-search bigger-110 hidden-480"></i>
														Ver
													</th>
													<th class="hidden-480">Acción</th>

							
												</tr>
											</thead>
											<tbody>

										<?php 
$sql ="SELECT Id_Rol, Descrip_Rol, Nombre_Rol, Estado_TekMaster_Rol, Actualizar_TekMaster ,Editar_TekMaster, Eliminar_TekMaster, Insertar_TekMaster, Ver_TekMaster FROM t_rol_usuario";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Qr_IdRol=$row['Id_Rol'];
        $Qr_Descrip_Rol=$row['Descrip_Rol'];
        $Qr_Nombre_Rol=$row['Nombre_Rol'];
        $Actualizar_TekMaster=$row['Actualizar_TekMaster'];
         $Editar_TekMaster=$row['Editar_TekMaster'];
          $Eliminar_TekMaster=$row['Eliminar_TekMaster'];
          $Insertar_TekMaster=$row['Insertar_TekMaster'];
          $Ver_TekMaster=$row['Ver_TekMaster'];
         ?>
         		<form method="post" action="ActualizarRol.php">
						<tr>

										<td class="center">
											<?php echo($Qr_IdRol); ?>
										</td>
										<td class="center">
											<input type="text" name="TxtNomRol" required="true" value="<?php echo($Qr_Nombre_Rol); ?>">
											</td>
										<td class="center">
											<input type="text" class="input-xlarge" name="TxtDescRol" required="true" value="<?php echo($Qr_Descrip_Rol) ?>">
											</td>
										<input type="text" name="TxtIdRol" value="<?php echo($Qr_IdRol); ?>" style="display: none;" >
													
									<?php 
									if ($Actualizar_TekMaster==1) {
									?>
									<td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtActualizar" checked="true" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>

									<?php
										}
										else {
									 ?>
									 <td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtActualizar" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>
									<?php 
								}
									 ?>


									<?php 
									if ($Editar_TekMaster==1) {
									?>
									<td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtEditar" checked="true" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>

									<?php
										}
										else {
									 ?>
									 <td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtEditar" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>
									<?php 
								}
									 ?>


													
								<?php 
									if ($Eliminar_TekMaster==1) {
									?>
									<td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtEliminar" checked="true" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>

									<?php
										}
										else {
									 ?>
									 <td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtEliminar" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>
									<?php 
								}
									 ?>



									<?php 
									if ($Insertar_TekMaster==1) {
									?>
									<td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtInsertar" checked="true" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>

									<?php
										}
										else {
									 ?>
									 <td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtInsertar" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>
									<?php 
								}
									 ?>


												<?php 
									if ($Ver_TekMaster==1) {
									?>
									<td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtVer" checked="true" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>

									<?php
										}
										else {
									 ?>
									 <td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtVer" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>
									<?php 
								}
									 ?>

													<td>
														<div class="hidden-sm hidden-xs btn-group">
															<button type="submit" class="btn btn-xs btn-success">
																<i class="ace-icon fa fa-refresh bigger-120"></i>
															</button>

														
															
														</div>


													
													</td>
												</tr>
					</form>
								
							<?php
 }
}

?>
											</tbody>
										</table>
									</div><!-- /.span -->
												</div>

						<div id="tabs-3" class="tab-pane">
									<a  data-toggle="modal" data-target="#myModalSubRubro" href="#"><span class="btn btn-info pull-right"><i class="fa fa-plus-square"> Crear Sub-Rubro </i></span></a>
									<a  data-toggle="modal" data-target="#myModalRubro" href="#"><span class="btn btn-danger pull-right"><i class="fa fa-plus-square"> Crear Rubro </i></span></a>

									<div class="col-xs-12">
									

				<!-- Modal -->
<div class="modal fade" id="myModalRubro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear Nuevo Rubro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form class="form-horizontal" action="Config-CrearRubro.php" id="FormNuevoRubro" method="post" enctype="multipart/form-data">

         	<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Código Rubro</label>
					<div class="col-sm-9">
						<input required="true" type="number" id="form-field-1" name="txtCodRubro" class="col-xs-10 col-sm-5" value="" />
					</div>
			</div>
         	<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nuevo Rubro</label>
					<div class="col-sm-9">
						<input required="true" type="text" id="form-field-1" name="txtNombreRubro" class="col-xs-10 col-sm-5" value="" />
					</div>
			</div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Crear Rubro</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Crear Nuevo Sub-Rubro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form class="form-horizontal" action="Config-CrearSubRubro.php" id="FormNuevoSubRubro" method="post" enctype="multipart/form-data">
         	
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Seleccionar Rubro</label>
					<div class="col-sm-9">
						<select class="col-xs-10 col-sm-5" name="txtSelRubro">
							<option value="">Seleccionar</option>
																	<?php
$sql ="SELECT Id_Rubro, Nom_Rubro FROM t_rubros";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
    	$SelectIdRubro=$row['Id_Rubro'];
    	$SelectNombreRubro=$row['Nom_Rubro'];             
    	echo ("<option value='".$SelectIdRubro."'>".utf8_encode($SelectNombreRubro)."</option>");
 }
}
            
?>
						</select>
						
					</div>
			</div>

         	<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Código Sub-Rubro</label>
					<div class="col-sm-9">
						<input required="true" type="number" id="form-field-1" name="txtCodSubRubro" class="col-xs-10 col-sm-5" value="" />
					</div>
			</div>
         	<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nuevo Sub-Rubro</label>
					<div class="col-sm-9">
						<input required="true" type="text" id="form-field-1" name="txtNombreSubRubro" class="col-xs-10 col-sm-5" value="" />
					</div>
			</div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Crear Sub-Rubro</button>
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
													<th>Cód. Rubro</th>
													<th>Rubro</th>
													
													
													<th class="hidden-480">Status</th>

													<th></th>
												</tr>
											</thead>

											<tbody>
							<?php 

					//Arreglo de cadena ID_COMENTARIO
$sql ="SELECT Id_rubro FROM t_rubros";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$ListaRubros=$ListaRubros.$row['Id_rubro'].",";                  
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
			$sql ="SELECT Id_rubro, Cod_Rubro, Nom_rubro,Rubro_Publicado FROM t_rubros WHERE Id_rubro='".$CadenaLista[$i]."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Tb_IdRubro=$row['Id_rubro'];
        $Tb_CodRubro=$row['Cod_Rubro'];
        $Tb_NomRubro=$row['Nom_rubro'];
        $Tb_EstadoRubro=$row['Rubro_Publicado'];
        
   
							 ?>
<form id="FormRubro" method="post" action="Config-ActualizarNomRubro.php">
												<tr>
													<td class="center">
														<div class="action-buttons">
															<a href="#" class="green bigger-140 show-details-btn" title="Ver Subrubros">
																<i class="ace-icon fa fa-angle-double-down"></i>
																<span class="sr-only">Subrubros</span>
															</a>
														</div>
													</td>

													<td>
														<?php Echo utf8_encode($Tb_CodRubro) ?>
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
															echo "<a href='config.php?ValEstado=0&RubroEstado=".$Tb_IdRubro."' class='btn btn-xs btn-danger' data-placement='top' title='Cambiar Estado'>
																<i class='ace-icon fa fa-close bigger-120'></i>
															</a>";
															}
															else
															{
															echo "<a href='config.php?ValEstado=1&RubroEstado=".$Tb_IdRubro."' class='btn btn-xs btn-success' data-placement='top' title='Cambiar Estado'>
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
						
	<form method="post" action="Config-PublicarSubRubro.php">
													<?php 
						$sql ="SELECT Id_subrubro, Cod_Subrubro, Rubro_id_rubro, Nom_Subrubro, Subrubro_publicado FROM t_subrubros WHERE Rubro_id_rubro='".$CadenaLista[$i]."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Tb_IdSubRubro=$row['Id_subrubro'];
        $Tb_CodSubRubro=$row['Cod_Subrubro'];
        $Tb_NomSubRubro=$row['Nom_Subrubro'];
        $Tb_SubRubroPublicado=$row['Subrubro_publicado'];

						 ?>
																<div class="col-xs-12 col-sm-9">
																	<div class="space visible-xs"></div>

																	<div class="profile-user-info profile-user-info-striped">
																		<div class="profile-info-row">
																			<div class="profile-info-name"> <?php Echo utf8_encode($Tb_CodSubRubro) ?> </div>

																			<div class="profile-info-value">
																			
																				<input  required="true" class="input-xxlarge" type="text" name="NomUpdate-<?php Echo utf8_encode($Tb_IdSubRubro) ?>" value="<?php Echo utf8_encode($Tb_NomSubRubro); ?>">

																				
																				
																			</div>
																			<div class="profile-info-value">
																				<label class="pos-rel">
														<?php 
														if ($Tb_SubRubroPublicado==1) {
															Echo("<input type='checkbox' class='ace' name='EstadoUpdate-".$Tb_IdSubRubro."' checked='true' value='1'/>");
														}
														else
														{
															Echo("<input type='checkbox' class='ace' name='EstadoUpdate-".$Tb_IdSubRubro."'  value='0'/>");
														}

														 ?>
															
															<span class="lbl"></span>
														</label>
																			</div>
																			
																		</div>
																		
																	</div>
																</div>
																<div class="col-xs-12 col-sm-3">
																	
																	
																		

																		<div class="clearfix">
																			
																			<button class="pull-right btn btn-sm btn-primary btn-white btn-round" type="submit">
																				Actualizar Subrubros
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


								<div id="tabs-4" class="tab-pane">
									
				
												<div class="space-4"></div>

					<table id="simple-table" class="table  table-bordered table-hover">
											<thead>
												<tr class="blue">
													<th class="center">Id</th>
													<th class="center">Rol</th>
													
													<th class="Encabezado">
														<p class="TextoVertical">Producción</p>
													</th>
													<th class="Encabezado">
														<p class="TextoVertical">Clientes</p>
													</th>
													<th class="Encabezado">
														<p class="TextoVertical">Proveedores</p>
													</th>
													<th class="Encabezado">
														<p class="TextoVertical">Insumos</p>
													</th>
													<th class="Encabezado">
														<p class="TextoVertical">Compras</p>
													</th>
													<th class="Encabezado">
														<p class="TextoVertical">Sastres</p>
													</th>
													<th class="Encabezado">
														<p class="TextoVertical">Prod. Configuración</p>
													</th>
													<th class="Encabezado">
														<p class="TextoVertical">Prod. Coleciones</p>
													</th>
													<th class="Encabezado">
														<p class="TextoVertical">Crear Productos</p>
													</th>
													<th class="Encabezado">
														<p class="TextoVertical">Galeria</p>
													</th>
													<th class="Encabezado">
														<p class="TextoVertical">Centro Dist</p>
													</th>
													<th class="Encabezado">
														<p class="TextoVertical">Remisisones</p>
													</th>
													<th class="Encabezado">
														<p class="TextoVertical">Tiendas</p>
													</th>
													<th class="Encabezado">
														<p class="TextoVertical">Bodegas</p>
													</th>

													<th class="hidden-480">Acción</th>

							
												</tr>
											</thead>
											<tbody>

										<?php 
$sql ="SELECT Id_Rol, Descrip_Rol, Nombre_Rol, Estado_TekMaster_Rol, Menu_Clientes,Menu_Produccion, Menu_Proveedores, Menu_Insumos, Menu_Compras, Menu_Sastres, Menu_Prod_Config, Menu_Prod_Colecciones, Menu_Prod_Crear, Menu_Galeria, Menu_CentroDist, Menu_Remisiones, Menu_Tiendas, Menu_Bodegas FROM t_rol_usuario";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Vista_IdRol=$row['Id_Rol'];
        $Vista_Descrip_Rol=$row['Descrip_Rol'];
        $Vista_Nombre_Rol=$row['Nombre_Rol'];
        $Menu_Produccion=$row['Menu_Produccion'];
        $Menu_Clientes=$row['Menu_Clientes'];
        $Menu_Proveedores=$row['Menu_Proveedores'];
        $Menu_Insumos=$row['Menu_Insumos'];
        $Menu_Compras=$row['Menu_Compras'];
        $Menu_Sastres=$row['Menu_Sastres'];
        $Menu_Prod_Config=$row['Menu_Prod_Config'];
        $Menu_Prod_Colecciones=$row['Menu_Prod_Colecciones'];
        $Menu_Prod_Crear=$row['Menu_Prod_Crear'];
        $Menu_Galeria=$row['Menu_Galeria'];
        $Menu_CentroDist=$row['Menu_CentroDist'];
        $Menu_Remisiones=$row['Menu_Remisiones'];
        $Menu_Tiendas=$row['Menu_Tiendas'];
        $Menu_Bodegas=$row['Menu_Bodegas'];
        
         ?>
         		<form method="post" action="ActualizarVistas.php">
						<tr>

										<td class="center">
											<?php echo($Vista_IdRol); ?>
										</td>
										<td class="center"><?php echo($Vista_Nombre_Rol); ?></td>
										<input type="text" name="TxtIdRol" value="<?php echo($Vista_IdRol); ?>" style="display: none;" >
													
									<?php 
									if ($Menu_Produccion==1) {
									?>
									<td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtProduccion" checked="true" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>

									<?php
										}
										else {
									 ?>
									 <td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtProduccion" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>
									<?php 
								}
									 ?>

									 <?php 
									if ($Menu_Clientes==1) {
									?>
									<td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtClientes" checked="true" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>

									<?php
										}
										else {
									 ?>
									 <td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtClientes" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>
									<?php 
								}
									 ?>



									<?php 
									if ($Menu_Proveedores==1) {
									?>
									<td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtProveedores" checked="true" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>

									<?php
										}
										else {
									 ?>
									 <td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtProveedores" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>
									<?php 
								}
									 ?>

									 <?php 
									if ($Menu_Insumos==1) {
									?>
									<td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtInsumos" checked="true" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>

									<?php
										}
										else {
									 ?>
									 <td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtInsumos" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>
									<?php 
								}
									 ?>
									 <?php 
									if ($Menu_Compras==1) {
									?>
									<td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtCompras" checked="true" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>

									<?php
										}
										else {
									 ?>
									 <td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtCompras" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>
									<?php 
								}
									 ?>

									 <?php 
									if ($Menu_Sastres==1) {
									?>
									<td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtSastres" checked="true" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>

									<?php
										}
										else {
									 ?>
									 <td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtSastres" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>
									<?php 
								}
									 ?>

									 <?php 
									if ($Menu_Prod_Config==1) {
									?>
									<td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtProdConfig" checked="true" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>

									<?php
										}
										else {
									 ?>
									 <td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtProdConfig" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>
									<?php 
								}
									 ?>


									  <?php 
									if ($Menu_Prod_Colecciones==1) {
									?>
									<td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtColecciones" checked="true" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>

									<?php
										}
										else {
									 ?>
									 <td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtColecciones" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>
									<?php 
								}
									 ?>



									 <?php 
									if ($Menu_Prod_Crear==1) {
									?>
									<td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtProdCrear" checked="true" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>

									<?php
										}
										else {
									 ?>
									 <td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtProdCrear" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>
									<?php 
								}
									 ?>

									 <?php 
									if ($Menu_Galeria==1) {
									?>
									<td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtGaleria" checked="true" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>

									<?php
										}
										else {
									 ?>
									 <td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtGaleria" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>
									<?php 
								}
									 ?>


									 <?php 
									if ($Menu_CentroDist==1) {
									?>
									<td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtCentro" checked="true" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>

									<?php
										}
										else {
									 ?>
									 <td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtCentro" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>
									<?php 
								}
									 ?>

									 <?php 
									if ($Menu_Remisiones==1) {
									?>
									<td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtRemisiones" checked="true" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>

									<?php
										}
										else {
									 ?>
									 <td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtRemisiones" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>
									<?php 
								}
									 ?>

									 <?php 
									if ($Menu_Tiendas==1) {
									?>
									<td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtTiendas" checked="true" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>

									<?php
										}
										else {
									 ?>
									 <td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtTiendas" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>
									<?php 
								}
									 ?>

									 <?php 
									if ($Menu_Bodegas==1) {
									?>
									<td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtBodegas" checked="true" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>

									<?php
										}
										else {
									 ?>
									 <td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtBodegas" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>
									<?php 
								}
									 ?>

									<td>
										<div class="hidden-sm hidden-xs btn-group">
												<button type="submit" class="btn btn-xs btn-success">
													<i class="ace-icon fa fa-refresh bigger-120"></i>
												</button>
	
														</div>


													
													</td>
												</tr>
					</form>
								
							<?php
 }
}

?>
											</tbody>
										</table>
									</div><!-- /.span -->



				<div id="tabs-5" class="tab-pane">
									
				
												<div class="space-4"></div>

					<table id="simple-table" class="table  table-bordered table-hover">
											<thead>
												<tr class="blue">
													<th class="center">Id</th>
													<th class="center">Rol</th>
													
													<th>
														<i class="ace-icon fa fa-cogs bigger-110 hidden-480"></i>
														Permiso Mod. Actividades
													</th>
													<!-- <th>
														<i class="ace-icon fa fa-users bigger-110 hidden-480"></i>
														Menú Usuarios
													</th>
													<th>
														<i class="ace-icon fa fa-tachometer bigger-110 hidden-480"></i>
														Menú Reportes
													</th> -->
													<th class="hidden-480">Acción</th>

							
												</tr>
											</thead>
											<tbody>

										<?php 
$sql ="SELECT Id_Rol, Descrip_Rol, Nombre_Rol, Estado_TekMaster_Rol,Per_Actividades FROM t_rol_usuario";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Per_IdRol=$row['Id_Rol'];
        $Per_Descrip_Rol=$row['Descrip_Rol'];
        $Per_Nombre_Rol=$row['Nombre_Rol'];
        $Per_Actividades=$row['Per_Actividades'];
        
        
         ?>
         		<form method="post" action="ActualizarPermisos.php">
						<tr>

										<td class="center">
											<?php echo($Per_IdRol); ?>
										</td>
										<td class="center"><?php echo($Per_Nombre_Rol); ?></td>
										<input type="text" name="TxtIdRol" value="<?php echo($Per_IdRol); ?>" style="display: none;" >
													
									<?php 
									if ($Per_Actividades==1) {
									?>
									<td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtPerActividades" checked="true" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>

									<?php
										}
										else {
									 ?>
									 <td class="center">
										<label class="pos-rel">
											<input type="checkbox" name="TxtPerActividades" class="ace" value="1" />
												<span class="lbl"></span>
										</label>
									</td>
									<?php 
								}
									 ?>


								


													
								
									<td>
										<div class="hidden-sm hidden-xs btn-group">
												<button type="submit" class="btn btn-xs btn-success">
													<i class="ace-icon fa fa-refresh bigger-120"></i>
												</button>
	
														</div>


													
													</td>
												</tr>
					</form>
								
							<?php
 }
}

?>
											</tbody>
										</table>
									</div><!-- /.span -->

							<div id="tabs-6" class="tab-pane">
									<a  data-toggle="modal" data-target="#myModalArea" href="#"><span class="btn btn-danger pull-right"><i class="fa fa-plus-square"> Crear Área </i></span></a>

									<div class="space-4"></div>

									<!-- Modal -->
<div class="modal fade" id="myModalArea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear Nuevo Área</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form class="form-horizontal" action="Config-CrearArea.php" id="FormNuevoArea" method="post" enctype="multipart/form-data">

         	<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Descripción Área</label>
					<div class="col-sm-9">
						<input required="true" type="text" id="form-field-1" name="txtDescArea" class="col-xs-10 col-sm-5" value="" />
					</div>
			</div>
         	<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nombre Área</label>
					<div class="col-sm-9">
						<input required="true" type="text" id="form-field-1" name="txtNombreArea" class="col-xs-10 col-sm-5" value="" />
					</div>
			</div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Crear Área</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>
<!-- FIN MODAL -->

										<table id="simple-table" class="table  table-bordered table-hover">
											<thead>
												<tr class="blue">
													<th class="center">Id</th>
													<th class="center">Descripción</th>
													<th>Nombre Área</th>
													<th>Status</th>
													<th class="hidden-480">Acción</th>
												</tr>
											</thead>
											<tbody>

										<?php 
$sql ="SELECT Id_area, Desc_Area, Nom_Area, Area_Publicada FROM t_areas";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Qr_IdArea=$row['Id_area'];
        $Qr_Descrip_Area=$row['Desc_Area'];
        $Qr_Nombre_Area=$row['Nom_Area'];
        $Qr_Estado_Area=$row['Area_Publicada'];

         
       
         ?>
         		<form method="post" action="Config-ActualizarAreas.php" id="FormAreas">
						<tr>

										<td class="center">
							<?php echo($Qr_IdArea); ?>
										</td>
										<td class="center">
									<input type="text" class="input-xlarge" name="EditDesArea" value="<?php echo utf8_encode($Qr_Descrip_Area); ?>">	
											</td>
										<td class="center">
									<input type="text" class="input-xlarge" name="EditNomArea" value="<?php echo utf8_encode($Qr_Nombre_Area); ?>">	
									<input type="text" name="IdEditArea" value="<?php echo utf8_encode($Qr_IdArea); ?>" style="display: none;">
												
											</td>
											<td>
												<?php 
															if ($Qr_Estado_Area==1) {
																Echo("<span class='label label-sm label-success'>Activo</span>");
															}
															else
															{
																Echo("<span class='label label-sm label-danger'>Inactivo</span>");
															}
															 ?>
											</td>
										
													<td>
														<div class="hidden-sm hidden-xs btn-group">

															<button type="submit" class="btn btn-xs btn-success">
																<i class="ace-icon fa fa-refresh bigger-120"></i>
															</button>	
															<?php 
															if ($Qr_Estado_Area==1) {
															echo "<a href='config.php?ValEstado=0&AreaEstado=".$Qr_IdArea."' class='btn btn-xs btn-danger' data-placement='top' title='Cambiar Estado'>
																<i class='ace-icon fa fa-close bigger-120'></i>
															</a>";
															}
															else
															{
															echo "<a href='config.php?ValEstado=1&AreaEstado=".$Qr_IdArea."' class='btn btn-xs btn-success' data-placement='top' title='Cambiar Estado'>
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
											</tbody>
										</table>
					
									</div><!-- /.span -->
												</div>



										</div>
									</div><!-- /.col -->
									
								</div><!-- /.row -->

								<!-- PAGE CONTENT ENDS -->
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
		<script src="https://modasof.com/espejo/assets/js/jquery.validate.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery-additional-methods.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="https://modasof.com/espejo/assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='https://modasof.com/espejo/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="https://modasof.com/espejo/assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->
		<script src="https://modasof.com/espejo/assets/js/jquery.dataTables.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/dataTables.buttons.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/buttons.flash.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/buttons.html5.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/buttons.print.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/buttons.colVis.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/dataTables.select.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/bootstrap-colorpicker.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery-ui.custom.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/chosen.jquery.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/spinbox.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/bootstrap-datepicker.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/bootstrap-timepicker.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/moment.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/daterangepicker.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/bootstrap-datetimepicker.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.knob.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/autosize.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.inputlimiter.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.maskedinput.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/bootstrap-tag.min.js"></script>

		<!-- ace scripts -->
		<script src="https://modasof.com/espejo/assets/js/ace-elements.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/ace.min.js"></script>

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
			jQuery(function($) {
				//initiate dataTables plugin
				var myTable = 
				$('#dynamic-table')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.DataTable( {
					bAutoWidth: false,
					"aoColumns": [
					  { "bSortable": false },
					  null, null,null, null, null,
					  { "bSortable": false }
					],
					"aaSorting": [],
					
					
					//"bProcessing": true,
			        //"bServerSide": true,
			        //"sAjaxSource": "http://127.0.0.1/table.php"	,
			
					//,
					//"sScrollY": "200px",
					//"bPaginate": false,
			
					//"sScrollX": "100%",
					//"sScrollXInner": "120%",
					//"bScrollCollapse": true,
					//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
					//you may want to wrap the table inside a "div.dataTables_borderWrap" element
			
					//"iDisplayLength": 50
			
			
					select: {
						style: 'multi'
					}
			    } );
			
				
				
				
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
					$('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
				});
			
				////
			
				setTimeout(function() {
					$($('.tableTools-container')).find('a.dt-button').each(function() {
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
				//$('th input[type=checkbox], td input[type=checkbox]').prop('checked', true);
				
				//select/deselect all rows according to table header checkbox
				$('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$('#dynamic-table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) myTable.row(row).select();
						else  myTable.row(row).deselect();
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(this.checked) myTable.row(row).deselect();
					else myTable.row(row).select();
				});
			
			
			
				$(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
					e.stopImmediatePropagation();
					e.stopPropagation();
					e.preventDefault();
				});
				
				
				
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
        $(document).ready(function()
        {
             $("#FormNuevoRubro").validate({
             	errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
                 rules: {
                     "txtNombreRubro": { required:true },
                     "txtCodRubro": { required:true }, 


                 },

             });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function()
        {
             $("#FormNuevoArea").validate({
             	errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
                 rules: {
                     "txtNombreArea": { required:true },
                     "txtDescArea": { required:true }, 


                 },

             });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function()
        {
             $("#FormRubro").validate({
             	errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
                 rules: {
                     "EditNomRubro": { required:true },
                     "IdRubroEdit": { required:true }, 
                 },
                
             });
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function()
        {
             $("#FormNuevoSubRubro").validate({
             	errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
                 rules: {
                     "txtSelRubro": { required:true },
                      "txtNombreSubRubro": { required:true },
                     "txtCodSubRubro": { required:true },  
                 },
                
             });
        });
    </script>

     <script type="text/javascript">
        $(document).ready(function()
        {
             $("#FormAreas").validate({
             	errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
                 rules: {
                     "EditNomArea": { required:true },
                     "EditDesArea": { required:true }, 
                 },
                
             });
        });
    </script>

		<script type="text/javascript">
        $(document).ready(function()
        {
             $("#validation-form").validate({
             	errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
                 rules: {
                     "txtNombre": { required:true },
                     "TxtEmail": { required:true, email:true }, 
                     "TxtFooter": { required:true },
                     "TxtTiempo": { required:true },
                     "TxtConsecutivo": { required:true },
                     "TxtHorasLaborales": { required:true },
                     "UrlSite": { required:true, url:true },
                     "UrlFacebook": { required:true, url:true},
                     "UrlInstagram": { required:true, url:true },
                     "UrlTwitter": { required:true, url:true },



                 },
                 messages: {
                     "txtNombre": { required:"Debes incluir el nombre de la Aplicación",},
                     "TxtHorasLaborales": { required:"El número de horas equivale a un día laborado",},
                     "UrlSite": { url:"Debe incluir htpps/",},
                     "TxtEmail": { required:"Por favor incluir un E-mail válido",email: "Por favor incluir un E-mail válido" },
                 },

                 // submitHandler: function(form){
                 //     alert("Los datos son correctos");
                 // }

             });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function()
        {
             $("#FormColor").validate({
             	errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
                 rules: {
                     "ColorSel": { required:true }, 
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
				$('#colorpicker2').colorpicker();
				$('#colorpicker3').colorpicker();
				$('#colorpicker4').colorpicker();
				$('#colorpicker5').colorpicker();
				$('#colorpicker6').colorpicker();
				$('#colorpicker7').colorpicker();
				$('#colorpicker8').colorpicker();
				$('#colorpicker9').colorpicker();
				$('#colorpicker10').colorpicker();
				$('#colorpicker11').colorpicker();
				$('#colorpicker12').colorpicker();
				$('#colorpicker13').colorpicker();
				$('#colorpicker14').colorpicker();
				$('#colorpicker15').colorpicker();
				$('#colorpicker16').colorpicker();
				$('#colorpicker17').colorpicker();
				$('#colorpicker18').colorpicker();
				$('#colorpicker19').colorpicker();
				$('#colorpicker20').colorpicker();
				$('#colorpicker21').colorpicker();

				//$('.colorpicker').last().css('z-index', 2000);//if colorpicker is inside a modal, its z-index should be higher than modal'safe
			
				$('#simple-colorpicker-1').ace_colorpicker();
				//$('#simple-colorpicker-1').ace_colorpicker('pick', 2);//select 2nd color
				//$('#simple-colorpicker-1').ace_colorpicker('pick', '#fbe983');//select #fbe983 color
				//var picker = $('#simple-colorpicker-1').data('ace_colorpicker')
				//picker.pick('red', true);//insert the color if it doesn't exist
					$('#simple-colorpicker-2').ace_colorpicker();
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
	</body>
</html>
