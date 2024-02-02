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
		<title>PRODUCCIÓN Modasof</title>

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
    <script src="https://modasof.com/espejo/assets/js/functions.js"></script>
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
        echo "<script>jQuery(function(){swal(\"¡ Orden de Compra Guardada!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==2) {
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
								<a href="Panel-Produccion.php">Área de Producción</a>
							</li>

							
						
						</ul><!-- /.breadcrumb -->

						
					</div>

					<div class="page-content">
				<?php 
					//include("Lib/colors.php");
				?>
						<div class="row">

						


						
							<div class="col-xs-12 col-sm-12">
								<!-- Inicio Menú Secundario -->
							<a class="btn btn-white btn-inverse btn-bold" href="Panel-Produccion.php">
								<span class="infobox-data-number"><i class="ace-icon fa fa-dashboard"></i> REPORTE</span>
							</a>
							<a class="btn  btn-inverse btn-bold" href="Produccion.php">
								<span class="infobox-data-number"><i class="ace-icon fa fa-dashboard"></i> PRODUCCIÓN</span>
							</a>
							<a class="btn btn-white btn-inverse btn-bold" href="Proveedores.php">
								<span class="infobox-data-number"><i class="ace-icon fa fa-dashboard"></i> PROVEEDORES</span>
							</a>
							<a class="btn btn-white btn-inverse btn-bold" href="insumos.php">
								<span class="infobox-data-number"><i class="ace-icon fa fa-dashboard"></i> INSUMOS</span>
							</a>
							<a class="btn btn-white btn-inverse btn-bold" href="Compras.php">
								<span class="infobox-data-number"><i class="ace-icon fa fa-dashboard"></i> COMPRAS</span>
							</a>
								<!-- Fin Menú Secundario -->

							<!-- Inicio Indicadores -->
							<div class="space-4"></div>
						<div class="col-xs-12 col-sm-3 widget-container-col" id="widget-container-col-5">
											<div class="widget-box" id="widget-box-5">
												<div class="widget-header">
													<h5 class="widget-title smaller">Viernes, 13 Sep </h5>

													<div class="widget-toolbar">
														<span class="label label-danger">
															23%
															<i class="ace-icon fa fa-arrow-down"></i>
														</span>
													</div>
												</div>

												<div class="widget-body">
													<div class="widget-main padding-6">
														<div class="alert degrade-azul"> <strong>5 PRENDAS</strong></div>
													</div>
												</div>
											</div>
										</div>
						<a href="">
					<div class="col-xs-12 col-sm-3 widget-container-col" id="widget-container-col-5">
											<div class="widget-box" id="widget-box-5">
												<div class="widget-header">
													<h5 class="widget-title smaller">Mes Actual </h5>

													<div class="widget-toolbar">
														<span class="label label-success">
															33%
															<i class="ace-icon fa fa-arrow-up"></i>
														</span>
													</div>
												</div>

												<div class="widget-body">
													<div class="widget-main padding-6">
														<div class="alert degrade-azul"><strong>45 PRENDAS</strong></div>
													</div>
												</div>
											</div>
										</div>
						</a>
						<div class="col-xs-12 col-sm-3 widget-container-col" id="widget-container-col-5">
											<div class="widget-box" id="widget-box-5">
												<div class="widget-header">
													<h5 class="widget-title smaller">Mes Anterior</h5>

													<div class="widget-toolbar">
															<span class="label label-success">
															33%
															<i class="ace-icon fa fa-arrow-up"></i>
														</span>
													</div>
												</div>

												<div class="widget-body">
													<div class="widget-main padding-6">
														<div class="alert degrade-azul"> <strong>58 PRENDAS</strong></div>
													</div>
												</div>
											</div>
										</div>
						<div class="col-xs-12 col-sm-3 widget-container-col" id="widget-container-col-5">
											<div class="widget-box" id="widget-box-5">
												<div class="widget-header">
													<h5 class="widget-title smaller">Total Producción</h5>

													<div class="widget-toolbar">
													
													</div>
												</div>

												<div class="widget-body">
													<div class="widget-main padding-6">
														<div class="alert degrade-azul"> <strong>450 PRENDAS</strong></div>
													</div>
												</div>
											</div>
										</div>						
					</div>
				<!-- Fin Indicadores  -->

				<div class="col-sm-12 col-xs-12"><!-- Inicio Panel Inferior-->
					<div class="col-xs-12 col-sm-12">
								<hr>
								<div class="col-sm-12">
										<div class="tabbable">
											<ul class="nav nav-tabs" id="myTab">
												<li class="active">
													<a data-toggle="tab" href="#home">
														<i class="green ace-icon fa fa-user bigger-120"></i>
														Ordenes de Corte
													</a>
												</li>
												<li>
													<a data-toggle="tab" href="#vista">
														<i class="black ace-icon fa fa-eye bigger-120"></i>
														Vista Orden
													</a>
												</li>

												<li>
													<a data-toggle="tab" href="#messages">
														Sastres
														<span class="badge badge-danger">4</span>
													</a>
												</li>

												<li class="dropdown">
													<a data-toggle="dropdown" class="dropdown-toggle" href="#">
														Gráficas &nbsp;
														<i class="ace-icon fa fa-caret-down bigger-110 width-auto"></i>
													</a>

													<ul class="dropdown-menu dropdown-info">
														<li>
															<a data-toggle="tab" href="#dropdown1">Hoy</a>
														</li>

														<li>
															<a data-toggle="tab" href="#dropdown2">Últimos 7 Días</a>
														</li>
													</ul>
												</li>
											</ul>

											<div class="tab-content">
												<div id="home" class="tab-pane fade in active">
													<!-- Inicio Panel Producción -->
													
				<div class="dataTable_wrapper"><!-- INICIO TABLA -->
						<div class="clearfix">
							<div class="pull-left tableTools-container"></div>
						</div>
						<table style="font-size: 12px;" id="dynamic-table"  class="table table-responsive table-striped table-bordered table-hover" width="100%" >
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
													
														<a href="Proveedores.php?EditTask=<?php echo($Tb_Id_Proveedor);?>" class="tooltip-primary blue" data-rel="tooltip" data-placement="top" title="Editar Proveedor">
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
				</div><!-- FIN TABLA -->

						
							
													<!-- Fin Panel Producción -->
													
												</div>
												<div id="vista" class="tab-pane fade">
						
												<div class="col-xs-12 col-sm-4"><!-- INICIO PERFIL DEL CLIENTE -->
											<div class="widget-box">
												<div class="widget-header">
													<h4 class="widget-title"><i class="fa fa-user"> </i> José Daniel Meza Olmos</h4>

													<div class="widget-toolbar">
														<a href="#" data-action="collapse">
															<i class="ace-icon fa fa-chevron-up"></i>
														</a>
													</div>
												</div>

												<div class="widget-body">
													<div class="widget-main">
									
										<div class="center">
										<img width="120px" height="120px" src="http://localhost/Modasof/Administrator/Images/Perfiles/4503-logoTek.png">
										</div>
										<div class="widget-main no-padding ">
											<table class="table table-bordered table-striped">
														
														<tbody>
															<tr>
																<td>Registrado:</td>

																<td>
																	Viernes, 1 de Feb del 2018
																</td>

																
															</tr>

															<tr>
																<td>Última Visita</td>

																<td>
																	Sábado, 10 de Feb del 2018
																</td>

																
															</tr>

															<tr>
																<td>Cumpleaños</td>

																<td>
																	Viernes, 13 de Jun del 2018
																</td>

																
															</tr>

															<tr>
																<td>Boletín de Noticias</td>

																<td>
																	<span class="label label-success arrowed-in arrowed-in-right">Activo</span>
																</td>

																
															</tr>

															<tr>
																<td>Total Facturado</td>

																<td>
																	<b class="blue">$12.000.000</b>
																</td>

															
															</tr>
															<tr>
																<td colspan="2" class="center">
																	<button class="btn btn-xs btn-danger">Agregar Observación</button>
																</td>
															</tr>
														</tbody>
													</table>
										</div>


													</div>

												</div>

											</div>
										</div><!-- /.span --><!-- FIN PERFIL DEL CLIENTE -->
										<div class="col-xs-12 col-sm-8"> <!-- ORDENES DE CORTE  -->
										<div class="widget-box transparent">
											<div class="widget-header widget-header-flat">
												<h4 class="widget-title lighter warning">
													<i class="ace-icon fa fa-star orange"></i>
													Ordenes de Corte <i class="fa fa-cubes"></i>
												</h4>

												<div class="widget-toolbar">
													<span class="label label-warning arrowed-in arrowed-in-right">$395.000</span>
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>

											<div class="widget-body">
												<div class="widget-main no-padding">
													<table class="table table-bordered table-striped">
														<thead class="thin-border-bottom">
															<tr>
																<th>
																	<i class="ace-icon fa fa-caret-right blue"></i>name
																</th>

																<th>
																	<i class="ace-icon fa fa-caret-right blue"></i>price
																</th>

																<th class="hidden-480">
																	<i class="ace-icon fa fa-caret-right blue"></i>status
																</th>
															</tr>
														</thead>

														<tbody>
															<tr>
																<td>internet.com</td>

																<td>
																	<small>
																		<s class="red">$29.99</s>
																	</small>
																	<b class="green">$19.99</b>
																</td>

																<td class="hidden-480">
																	<span class="label label-info arrowed-right arrowed-in">on sale</span>
																</td>
															</tr>

															<tr>
																<td>online.com</td>

																<td>
																	<b class="blue">$16.45</b>
																</td>

																<td class="hidden-480">
																	<span class="label label-success arrowed-in arrowed-in-right">approved</span>
																</td>
															</tr>

															<tr>
																<td>newnet.com</td>

																<td>
																	<b class="blue">$15.00</b>
																</td>

																<td class="hidden-480">
																	<span class="label label-danger arrowed">pending</span>
																</td>
															</tr>

															<tr>
																<td>web.com</td>

																<td>
																	<small>
																		<s class="red">$24.99</s>
																	</small>
																	<b class="green">$19.95</b>
																</td>

																<td class="hidden-480">
																	<span class="label arrowed">
																		<s>out of stock</s>
																	</span>
																</td>
															</tr>

															<tr>
																<td>domain.com</td>

																<td>
																	<b class="blue">$12.00</b>
																</td>

																<td class="hidden-480">
																	<span class="label label-warning arrowed arrowed-right">SOLD</span>
																</td>
															</tr>
															
														</tbody>
													</table>
												</div><!-- /.widget-main -->
											</div><!-- /.widget-body -->
										</div><!-- /.widget-box -->
							</div><!-- /FIN ORDENES DE CORTE -->

									<div class="space-7"></div>
									<hr class="red">

							
<div class="col-sm-8 col-xs-12"><!-- INICIO COMENTARIOS -->

								<div id="timeline-<?php Echo($Id_Timeline) ?>">
									<div class="row">
										<div class="col-xs-12 col-sm-10 col-sm-offset-1">
											<div class="timeline-container">
												<div class="timeline-label">
													<span class="label label-primary arrowed-in-right label-lg">
														<b><?php echo("$FechaNota"); ?></b>
													</span>
												</div>

												<div class="timeline-items">
													<div class="timeline-item clearfix">
														<div class="timeline-info">
															<img alt="Susan't Avatar" src="http://localhost/Modasof/Administrator/Images/Perfiles/8868-WebMaster.jpg" />
															<span class="label label-info label-sm"><?php Echo($Hora_Timeline); ?></span>
														</div>
														<div class="widget-box transparent">
															<div class="widget-header widget-header-small">
																<h5 class="widget-title smaller">
																	<a href="#" class="blue"><?php Echo utf8_encode($Timeline_Nombres." ".$Timeline_Apellidos) ?></a>
																	<!-- <span class="grey">reviewed a product</span> -->
																</h5>
																<span class="widget-toolbar no-border">
																	<i class="ace-icon fa fa-clock-o bigger-110"></i>
																	<?php Echo($Hora_Timeline); ?>
																</span>

																<span class="widget-toolbar">
																	<a href="#" data-action="collapse">
																		<i class="ace-icon fa fa-chevron-up"></i>
																	</a>
																</span>
														</div>

															<div class="widget-body">
																<div class="widget-main">
																	<?php Echo utf8_encode($InfoTimeline); ?>
																	
																	<div class="space-6"></div>

																	<div class="widget-toolbox clearfix">
																		<!-- <div class="pull-left">
																			<i class="ace-icon fa fa-hand-o-right grey bigger-125"></i>
																			<a href="#" class="bigger-110">Click to read &hellip;</a>
																		</div> -->

																		<div class="pull-right action-buttons">
																			<?php 
																			if ($EditNote==1) {
																				?>

																			<a href="Task-Timeline.php?View=<?php echo($IdView);?>&Propietario=<?php echo($Propietario);?>" class="tooltip-success green" data-rel="tooltip" data-placement="top" title="Cancelar Edición">
																				<i class="ace-icon fa fa-close red bigger-130"></i>
																			</a>
																			<?php
																			}
																			 ?>

																			<a href="Task-Timeline.php?View=<?php Echo($IdView);?>&EditNote=1&Propietario=<?php Echo($Propietario);?>">
																				<i class="ace-icon fa fa-pencil blue bigger-125"></i>
																			</a>

																			<?php 
																			if ($Val_Editar==1) {
																				?>
																				<a href="Task-Timeline.php?View=<?php Echo($IdView);?>&DeleteNote=1&NoteDel=<?php Echo($Id_Timeline);?>&Propietario=<?php echo($Propietario);?>">
																				<i class="ace-icon fa fa-trash-o red bigger-125"></i>
																			</a>
																			<?php
																			}
																			 ?>

																			
																		</div>
																	</div>
																</div>
															</div>
							
								
											
									
														</div>
													</div>

												</div><!-- /.timeline-items -->
											</div><!-- /.timeline-container -->
										</div>

									</div>
								</div>
</div><!-- FIN COMENTARIOS -->

												</div>
												<div id="messages" class="tab-pane fade">
													<p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.</p>
												</div>

												<div id="dropdown1" class="tab-pane fade">
													<div id="grafica" style="width: 700px;height: 450px;"></div>
												</div>

												<div id="dropdown2" class="tab-pane fade">
													<p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin.</p>
												</div>
											</div>
										</div>
									</div><!-- /.col -->
								
							</div><!-- /.col -->
				</div><!-- Fin Panel Inferior -->
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
		<!-- inline scripts related to this page -->
		
		
		
	<script type="text/javascript">
        // based on prepared DOM, initialize echarts instance
        var myChart = echarts.init(document.getElementById('grafica'));

       data = [["2000-06-05",116],["2000-06-06",129],["2000-06-07",135],["2000-06-08",86],["2000-06-09",73],["2000-06-10",85],["2000-06-11",73],["2000-06-12",68],["2000-06-13",92],["2000-06-14",130],["2000-06-15",245],["2000-06-16",139],["2000-06-17",115],["2000-06-18",111],["2000-06-19",309],["2000-06-20",206],["2000-06-21",137],["2000-06-22",128],["2000-06-23",85],["2000-06-24",94],["2000-06-25",71],["2000-06-26",106],["2000-06-27",84],["2000-06-28",93],["2000-06-29",85],["2000-06-30",73],["2000-07-01",83],["2000-07-02",125],["2000-07-03",107],["2000-07-04",82],["2000-07-05",44],["2000-07-06",72],["2000-07-07",106],["2000-07-08",107],["2000-07-09",66],["2000-07-10",91],["2000-07-11",92],["2000-07-12",113],["2000-07-13",107],["2000-07-14",131],["2000-07-15",111],["2000-07-16",64],["2000-07-17",69],["2000-07-18",88],["2000-07-19",77],["2000-07-20",83],["2000-07-21",111],["2000-07-22",57],["2000-07-23",55],["2000-07-24",60]];

var dateList = data.map(function (item) {
    return item[0];
});
var valueList = data.map(function (item) {
    return item[1];
});

option = {

    // Make gradient line here
    visualMap: [{
        show: false,
        type: 'continuous',
        seriesIndex: 0,
        min: 0,
        max: 400
    }, {
        show: false,
        type: 'continuous',
        seriesIndex: 1,
        dimension: 0,
        min: 0,
        max: dateList.length - 1
    }],


    title: [{
        left: 'center',
        text: 'Taller Valledupar'
    }, {
        top: '55%',
        left: 'center',
        text: 'Taller Barranquilla'
    }],
    tooltip: {
        trigger: 'axis'
    },
    xAxis: [{
        data: dateList
    }, {
        data: dateList,
        gridIndex: 1
    }],
    yAxis: [{
        splitLine: {show: false}
    }, {
        splitLine: {show: false},
        gridIndex: 1
    }],
    grid: [{
        bottom: '60%'
    }, {
        top: '60%'
    }],
    series: [{
        type: 'line',
        showSymbol: false,
        data: valueList
    }, {
        type: 'line',
        showSymbol: false,
        data: valueList,
        xAxisIndex: 1,
        yAxisIndex: 1
    }]
};

        // use configuration item and data specified to show chart
        myChart.setOption(option);
    </script>
<?php 
		//include("Lib/ScriptTablas.php");
		 ?>
<script type="text/javascript">
			jQuery(function($) {
			
$('#dynamic-table thead tr:eq(1) th').each( function () {
        var title = $('#dynamic-table thead tr:eq(0) th').eq( $(this).index() ).text();
        $(this).html( '<input style="width:69%;" type="text" placeholder="Buscar '+title+'" />' );
    } ); 
  
    var table = $('#dynamic-table').DataTable({
    	//"responsive"="true",
    	"responsive":true,
    	//"scrollX": true,
    	"order": [[ 0, "Desc" ]],
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
     table.columns().every(function (index) {
        $('#dynamic-table thead tr:eq(1) th:eq(' + index + ') input').on('keyup change', function () {
            table.column($(this).parent().index() + ':visible')
                .search(this.value)
                .draw();    
        });
    });
  
    // Apply the search
   

				var myTable = 
				$('#dynamic-table')
				//.wrap("<div class='dataTable_wrapper' />")   //if you are applying horizontal scrolling (sScrollX)
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
				myTable.buttons().container().appendTo( $('.tableTools-container') );
				
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
				$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
				
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
				$('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$(this).closest('table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
						else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#simple-table').on('click', 'td input[type=checkbox]' , function(){
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
