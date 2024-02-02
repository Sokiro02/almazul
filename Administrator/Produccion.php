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
		<title>Modasof</title>

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
							<li>
								<i class="ace-icon fa fa-cubes"></i>
								<a href="Produccion.php">Producción</a>
							</li>
						</ul><!-- /.breadcrumb -->

						
					</div>

					<div class="page-content">
				<?php 
					//include("Lib/colors.php");
				?>
						<div class="row">
							<div class="col-xs-12 col-sm-12 ">
						<!-- Inicio Menú Secundario -->
								<a class="btn btn-white btn-danger btn-bold" href="Panel-Produccion.php">
								<span class="infobox-data-number"><i class="ace-icon fa fa-dashboard"></i> REPORTE</span>
							</a>
							<a class="btn btn-white btn-info btn-bold" href="Produccion.php">
								<span class="infobox-data-number"><i class="ace-icon fa fa-dashboard"></i> PRODUCCIÓN</span>
							</a>
							<a class="btn btn-white btn-info btn-bold" href="Proveedores.php">
								<span class="infobox-data-number"><i class="ace-icon fa fa-dashboard"></i> PROVEEDORES</span>
							</a>
							<a class="btn btn-white btn-info btn-bold" href="insumos.php">
								<span class="infobox-data-number"><i class="ace-icon fa fa-dashboard"></i> INSUMOS</span>
							</a>
							<a class="btn btn-white btn-info btn-bold" href="Compras.php">
								<span class="infobox-data-number"><i class="ace-icon fa fa-dashboard"></i> COMPRAS</span>
							</a>
								<!-- Fin Menú Secundario -->
						
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
														<div class="alert degrade-verde"> <strong>5 PRENDAS</strong></div>
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
														<div class="alert degrade-amarillo"> <strong>58 PRENDAS</strong></div>
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
														<div class="alert degrade-rosa"> <strong>450 PRENDAS</strong></div>
													</div>
												</div>
											</div>
										</div>
					
					
								
						
						</div>
						<div class="space-7"></div>			
						
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
													<!-- INICIO TABLA -->
						<div class="clearfix">
											<div class="pull-left tableTools-container"></div>
											
										</div>
										<!-- <div class="table-header">
											Lista de Proveedores
										</div>
										 -->
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
										</div>
						<!-- FIN TABLA -->

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

		<script src="https://modasof.com/espejo/assets/js/echarts.min.js"></script>

			 <!-- Libreria Gráficas -->
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
