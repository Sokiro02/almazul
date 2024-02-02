<?php
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
include("Lib/modelotaller.php");
$IdUser = $_SESSION['IdUser'];
$IdRol = $_SESSION['IdRol'];
include("Lib/permisos.php");
$MyIdTienda = $_SESSION['IdTienda'];
$MiTienda = $_SESSION['nicktienda'];
date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');
$FechaActual = date('Y-m-d');

$TxtConsultaVen = $MyIdTienda;




?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="utf-8" />
	<title>Consulta Pedidos</title>

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
	<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/AdminLTE.css">

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



	<?php include("Lib/Favicon.php") ?>

</head>

<body class="skin-1">

	<?php
	$Valide = $_GET['Mensaje'];

	if ($Valide == 2) {
		echo "<script>jQuery(function(){swal(\"¡Lo Sentimos!\", \"Datos Incorrectos\", \"error\");});</script>";
	};
	if ($Valide == 1) {
		echo "<script>jQuery(function(){swal(\"¡ Insumo Creado!\", \"Correctamente \", \"success\");});</script>";
	};
	if ($Valide == 27) {
		echo "<script>jQuery(function(){swal(\" Informe " . utf8_encode($ConSeleccionado) . "\", \"Taller Seleccionado\", \"success\");});</script>";
	};

	?>




	<?php
	include("Lib/Alertas.php")
	?>

	<div class="main-container ace-save-state" id="main-container">
		<script type="text/javascript">
			try {
				ace.settings.loadState('main-container')
			} catch (e) {}
		</script>

		<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
			<script type="text/javascript">
				try {
					ace.settings.loadState('sidebar')
				} catch (e) {}
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
							<i class="ace-icon fa fa-line-chart"></i>
							<a href="Informe-RemisionesTienda.php">Informe Remisiones</a>
						</li>

					</ul><!-- /.breadcrumb -->


				</div>

				<div class="page-content">

					<div class="row">

						<div class="col-xs-12 col-sm-12">


							<div class="space-7"></div>

							<div class="col-sm-12 col-xs-12">
								<!-- Inicio Panel Inferior-->
								<hr>



							</div><!-- Fin Panel Inferior -->
							<div class="widget-body">
								<h4 class="widget-title lighter">
									<i class="ace-icon fa fa-search blue"></i>
									Realizar consulta por cliente
								</h4>

								<div class="row">
									<div class="col-sm-6">
										<form action="buscador_pedidos.php" method="post" id="FormFechas" autocomplete="off">
											<div style="display: none;" class="col-xs-12 col-sm-12">
												<div class="input-daterange input-group">
													<input type="text" class="input-sm form-control" name="start" />
													<span class="input-group-addon">
														<i class="fa fa-exchange"></i>
													</span>
													<input type="text" class="input-sm form-control" name="end" />
												</div>
											</div>
											<div style="display: none;" class="col-xs-12 col-sm-6">
												<select class="chosen-select input-xxlarge" name="post_taller" id="post_taller" data-placeholder="Seleccionar...">
													<option value="" selected>Seleccionar Taller... </option>
													<option value="Todos">Todos</option>
													<?php
													$sql = "SELECT Id_Bodega, Nom_Bodega FROM t_bodegas  order by Nom_Bodega ASC";
													$result = $conexion->query($sql);
													if ($result->num_rows > 0) {
														while ($row = $result->fetch_assoc()) {
															$Id_Bodega = $row['Id_Bodega'];
															$Nom_Bodega = $row['Nom_Bodega'];
															echo ("<option value='" . $Id_Bodega . "'>" . utf8_encode($Nom_Bodega) . "</option>");
														}
													}

													?>

												</select>
											</div>
											<div style="display: none;" class="col-xs-12 col-sm-6">
												<select class="chosen-select input-xxlarge" name="post_tienda" id="post_tienda" data-placeholder="Seleccionar...">
													<option value="" selected>Seleccionar Tienda... </option>
													<option value="Todos">Todas </option>
													<?php
													$sql = "SELECT Id_Tienda, Nom_Tienda FROM t_tiendas WHERE Estado_Tienda='1' and vista_tienda='0' order by Nom_Tienda ASC";
													$result = $conexion->query($sql);
													if ($result->num_rows > 0) {
														while ($row = $result->fetch_assoc()) {
															$Id_Tienda = $row['Id_Tienda'];
															$Nom_Tienda = $row['Nom_Tienda'];

															echo ("<option value='" . $Id_Tienda . "'>" . utf8_encode($Nom_Tienda) . "</option>");
														}
													}

													?>

												</select>
											</div>
											<div style="display: none;" class="col-xs-12 col-sm-6">
												<select class="chosen-select input-xxlarge" name="post_estado" id="post_estado" data-placeholder="Seleccionar...">
													<option value="" selected>Seleccionar Estado... </option>
													<option value="Todos">Todos </option>
													<?php
													$sql = "SELECT Id_Estado_Pedido,Nom_Estado_Pedido FROM t_estado_pedidos order by Nom_Estado_Pedido ASC";
													$result = $conexion->query($sql);
													if ($result->num_rows > 0) {
														while ($row = $result->fetch_assoc()) {
															$Id_Estado_Pedido = $row['Id_Estado_Pedido'];
															$Nom_Estado_Pedido = $row['Nom_Estado_Pedido'];
															echo ("<option value='" . $Id_Estado_Pedido . "'>" . utf8_encode($Nom_Estado_Pedido) . "</option>");
														}
													}

													?>

												</select>
											</div>
											<div class="col-xs-12 col-sm-12">
												<select class="chosen-select input-xxlarge" name="post_cliente" id="post_cliente" data-placeholder="Seleccionar...">
													<option value="" selected>Seleccionar Cliente </option>
													<option value="Todos">Todos</option>
													<?php
													$sql = "SELECT DISTINCT(A.Cliente_Id_Cliente), B.Documento_Cliente,B.Nom_Cliente,B.Ape_Cliente FROM t_pedido as A, t_clientes as B WHERE A.Cliente_Id_Cliente=B.Id_Cliente ORDER BY B.Nom_Cliente ASC";
													$result = $conexion->query($sql);
													if ($result->num_rows > 0) {
														while ($row = $result->fetch_assoc()) {
															$SelectId_Cliente = $row['Cliente_Id_Cliente'];
															$SelectDocumento_Cliente = $row['Documento_Cliente'];
															$Nom_Cliente = $row['Nom_Cliente'];
															$Ape_Cliente = $row['Ape_Cliente'];
															echo ("<option value='" . $SelectId_Cliente . "'>" . utf8_encode($SelectDocumento_Cliente . " - " . $Nom_Cliente . " " . $Ape_Cliente) . "</option>");
														}
													}

													?>

												</select>
											</div>
											<div class="form-group">
												<div class="col-xs-12 col-sm-6">
													<button class="btn btn-primary btn-sm" type="Submit">Realizar Consulta</button>
												</div>
											</div>
										</form>

									</div>
									<div class="col-sm-6">


									</div>

								</div>
							</div>
							<hr>

							<?php
							date_default_timezone_set("America/Bogota");
							$MarcaTemporal = date('Y-m-d');
							$FechaInicioDia = ($MarcaTemporal . " 00:00:000");
							$FechaFinalDia = ($MarcaTemporal . " 23:59:000");
							$FechaUno = $_POST['start'];
							$FechaDos = $_POST['end'];

							$post_taller = $_POST['post_taller'];
							$post_tienda = $_POST['post_tienda'];
							$post_estado = $_POST['post_estado'];
							$post_cliente = $_POST['post_cliente'];

							// Validación de la fecha en que inicia el Día

							if ($FechaUno == "") {
								$FechaStart = $FechaInicioDia;
							} else {
								$FechaStart = ($FechaUno . " 00:00:000");
							}
							// Validación de la fecha en que Termina el Día
							if ($FechaDos == "") {
								$FechaEnd = $FechaFinalDia;
							} else {
								$FechaEnd = ($FechaDos . " 23:59:000");
							}
							?>

							<div class="col-sm-12">
								<!-- Inicio Panel 12 -->
								<div class="tabbable">
									<!-- <ul class="nav nav-tabs" id="myTab">
												<li class="active">
													<a data-toggle="tab" href="#tabs-1">
														<i class="green ace-icon fa fa-shopping-cart bigger-120"></i>
														Compra de Insumos
													</a>
												</li>

											</ul> -->

									<div class="tab-content">
										<div id="tabs-1" class="tab-pane fade in active">
											<!-- Inicio Tab Número Uno -->
											<div class="clearfix">
												<div class="pull-left tableTools-container"></div>
											</div>
											<div class="table-header" style="background-color: #000;">
												Pedidos Modasof
												<?php echo ($MiTienda); ?>
												<?php
												if ($FechaUno == "") {
													echo (fechasql($FechaActual));
												} else {
													echo ("Ventas del " . fechaSql($FechaUno) . " al " . fechaSql($FechaDos));
												}
												?>
											</div>

											<!-- div.table-responsive -->

											<!-- div.dataTables_borderWrap -->
											<div>
												<?php
												if (empty($post_taller) and empty($post_tienda) and empty($post_estado) and empty($post_cliente)) {
												} elseif ($post_taller != "" and empty($post_tienda) and empty($post_estado) and empty($post_cliente)) {

													$sql = "SELECT distinct(Id_Pedido) FROM t_pedido WHERE Fecha_Pedido >='" . $FechaStart . "' and Fecha_Pedido <='" . $FechaEnd . "' and taller_id_taller='" . $post_taller . "' order by Id_Pedido  DESC";
													$result = $conexion->query($sql);
													//echo ($sql);
													if ($result->num_rows > 0) {
														while ($row = $result->fetch_assoc()) {
															$Lista = $Lista . $row['Id_Pedido'] . ",";
														}
													}
												} elseif (empty($post_taller) and $post_tienda != "" and empty($post_estado) and empty($post_cliente)) {

													$sql = "SELECT distinct(Id_Pedido) FROM t_pedido WHERE Fecha_Pedido >='" . $FechaStart . "' and Fecha_Pedido <='" . $FechaEnd . "' and Tienda_Id_Tienda='" . $post_tienda . "' order by Id_Pedido  DESC";
													$result = $conexion->query($sql);
													//echo ($sql);
													if ($result->num_rows > 0) {
														while ($row = $result->fetch_assoc()) {
															$Lista = $Lista . $row['Id_Pedido'] . ",";
														}
													}
												} elseif (empty($post_taller) and empty($post_tienda) and $post_estado != "" and empty($post_cliente)) {

													$sql = "SELECT distinct(Id_Pedido) FROM t_pedido WHERE Fecha_Pedido >='" . $FechaStart . "' and Fecha_Pedido <='" . $FechaEnd . "' and Estado_Pedido='" . $post_estado . "' order by Id_Pedido  DESC";
													$result = $conexion->query($sql);
													//echo ($sql);
													if ($result->num_rows > 0) {
														while ($row = $result->fetch_assoc()) {
															$Lista = $Lista . $row['Id_Pedido'] . ",";
														}
													}
												} elseif (empty($post_taller) and empty($post_tienda) and empty($post_estado) and $post_cliente != "") {

													$sql = "SELECT distinct(Id_Pedido) FROM t_pedido WHERE  Cliente_Id_Cliente='" . $post_cliente . "' order by Id_Pedido  DESC";
													$result = $conexion->query($sql);
													//echo ($sql);
													if ($result->num_rows > 0) {
														while ($row = $result->fetch_assoc()) {
															$Lista = $Lista . $row['Id_Pedido'] . ",";
														}
													}
												} elseif ($post_taller != "" and $post_tienda != "" and empty($post_estado) and empty($post_cliente)) {

													$sql = "SELECT distinct(Id_Pedido) FROM t_pedido WHERE Fecha_Pedido >='" . $FechaStart . "' and Fecha_Pedido <='" . $FechaEnd . "' and taller_id_taller='" . $post_taller . "' and Tienda_Id_Tienda='" . $post_tienda . "' order by Id_Pedido  DESC";
													$result = $conexion->query($sql);
													//echo ($sql);
													if ($result->num_rows > 0) {
														while ($row = $result->fetch_assoc()) {
															$Lista = $Lista . $row['Id_Pedido'] . ",";
														}
													}
												} elseif ($post_taller != "" and $post_tienda != "" and $post_estado != "" and empty($post_cliente)) {

													$sql = "SELECT distinct(Id_Pedido) FROM t_pedido WHERE Fecha_Pedido >='" . $FechaStart . "' and Fecha_Pedido <='" . $FechaEnd . "' and taller_id_taller='" . $post_taller . "' and Tienda_Id_Tienda='" . $post_tienda . "' and Estado_Pedido='" . $post_estado . "' order by Id_Pedido  DESC";
													$result = $conexion->query($sql);
													//echo ($sql);
													if ($result->num_rows > 0) {
														while ($row = $result->fetch_assoc()) {
															$Lista = $Lista . $row['Id_Pedido'] . ",";
														}
													}
												} elseif ($post_taller != "" and $post_tienda != "" and $post_estado != "" and $post_cliente != "") {

													$sql = "SELECT distinct(Id_Pedido) FROM t_pedido WHERE Fecha_Pedido >='" . $FechaStart . "' and Fecha_Pedido <='" . $FechaEnd . "' and taller_id_taller='" . $post_taller . "' and Tienda_Id_Tienda='" . $post_tienda . "' and Estado_Pedido='" . $post_estado . "' and Cliente_Id_Cliente='" . $post_cliente . "' order by Id_Pedido  DESC";
													$result = $conexion->query($sql);
													//echo ($sql);
													if ($result->num_rows > 0) {
														while ($row = $result->fetch_assoc()) {
															$Lista = $Lista . $row['Id_Pedido'] . ",";
														}
													}
												} elseif ($post_taller != "" and empty($post_tienda) and $post_estado != "" and empty($post_cliente)) {

													$sql = "SELECT distinct(Id_Pedido) FROM t_pedido WHERE Fecha_Pedido >='" . $FechaStart . "' and Fecha_Pedido <='" . $FechaEnd . "' and taller_id_taller='" . $post_taller . "'  and Estado_Pedido='" . $post_estado . "'  order by Id_Pedido  DESC";
													$result = $conexion->query($sql);
													//echo ($sql);
													if ($result->num_rows > 0) {
														while ($row = $result->fetch_assoc()) {
															$Lista = $Lista . $row['Id_Pedido'] . ",";
														}
													}
												} elseif (empty($post_taller) and $post_tienda != "" and $post_estado != "" and empty($post_cliente)) {

													$sql = "SELECT distinct(Id_Pedido) FROM t_pedido WHERE Fecha_Pedido >='" . $FechaStart . "' and Fecha_Pedido <='" . $FechaEnd . "' and Tienda_Id_Tienda='" . $post_tienda . "'  and Estado_Pedido='" . $post_estado . "'  order by Id_Pedido  DESC";
													$result = $conexion->query($sql);
													//echo ($sql);
													if ($result->num_rows > 0) {
														while ($row = $result->fetch_assoc()) {
															$Lista = $Lista . $row['Id_Pedido'] . ",";
														}
													}
												} elseif (empty($post_taller) and empty($post_tienda) and $post_estado != "" and $post_cliente != "") {

													$sql = "SELECT distinct(Id_Pedido) FROM t_pedido WHERE  Cliente_Id_Cliente='" . $post_cliente . "'  and Estado_Pedido='" . $post_estado . "'  order by Id_Pedido  DESC";
													$result = $conexion->query($sql);
													//echo ($sql);
													if ($result->num_rows > 0) {
														while ($row = $result->fetch_assoc()) {
															$Lista = $Lista . $row['Id_Pedido'] . ",";
														}
													}
												}


												$Cadena = explode(",", $Lista);
												//Split al Arreglo
												$longitud = count($Cadena);
												$min = $longitud - 1;
												// ************** Arreglo Total Insumos ***************//
												?>
												<table style="font-size: 12px;" id="dynamic-table" class="table table-responsive table-striped table-bordered table-hover" width="100%">
													<tfoot style="display: table-header-group;">
														<th class="success"></th>
														<th class="success"></th>
														<th class="success"></th>
														<th class="success"></th>
														<th class="success"></th>
														<th class="success"></th>
														<th class="success"></th>
														<th class="success"></th>
														<th class="success"></th>
														<th class="success"></th>
														<th class="success"></th>
														<th class="success"></th>
														<th class="success"></th>
													</tfoot>
													<thead>

														<tr class="warning">
															<th class="tdcustom" style="width: 5%;">Vendedor</th>
															<th class="tdcustom" style="width: 5%;">Pedido Nº</th>
															<th class="tdcustom" style="width: 5%;">Estado</th>
															<th class="tdcustom" style="width: 10%;">Cliente</th>
															<th class="tdcustom" style="width: 20%;">Detalle</th>
															<th class="tdcustom" style="width: 10%;">Fecha Pedido</th>
															<th class="tdcustom" style="width: 10%;">Referencias</th>
															<th class="tdcustom" style="width: 7%;">Fecha Entrega</th>
															<th class="tdcustom" style="width: 7%;">Tiempo Transcurrido</th>
															<th class="tdcustom" style="width: 10%;">Valor Pedido</th>
															<th class="tdcustom" style="width: 10%;">Abonos</th>
															<th class="tdcustom" style="width: 10%;">Saldo</th>
															<th class="tdcustom" style="width: 20%;">Acción</th>
														</tr>
														<tr>
															<th class="tdcustom" style="width: 5%;">Vendedor</th>
															<th class="tdcustom" style="width: 5%;">Pedido Nº</th>
															<th class="tdcustom" style="width: 5%;">Estado</th>
															<th class="tdcustom" style="width: 10%;">Cliente</th>
															<th class="tdcustom" style="width: 20%;">Detalle</th>
															<th class="tdcustom" style="width: 10%;">Fecha Pedido</th>
															<th class="tdcustom" style="width: 10%;">Referencias</th>
															<th class="tdcustom" style="width: 7%;">Fecha Entrega</th>
															<th class="tdcustom" style="width: 7%;">Tiempo Transcurrido</th>
															<th class="tdcustom" style="width: 10%;">Valor Pedido</th>
															<th class="tdcustom" style="width: 10%;">Abonos</th>
															<th class="tdcustom" style="width: 10%;">Saldo</th>
															<th class="tdcustom" style="width: 20%;">Acción</th>
														</tr>
													</thead>

													<tbody>
														<?php
														for ($i = 0; $i < $min; $i++) {
															$sql = "SELECT date_format(Fecha_Pedido,CONCAT(CONCAT(ELT(WEEKDAY(Fecha_Pedido) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(Fecha_Pedido), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS FechaPedido,date_format(Fecha_Entrega,CONCAT(CONCAT(ELT(WEEKDAY(Fecha_Entrega) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(Fecha_Entrega), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS FechaEntrega, Id_Pedido, Cod_Pedido, Cliente_Id_Cliente, Fecha_Pedido, Total_Pedido, Descuento, Estado_Pedido, Saldo_Abonado, Pedido_Id_Usuario, Fecha_Entrega,taller_id_taller FROM t_pedido  WHERE Id_Pedido='" . $Cadena[$i] . "'";
															//Echo($sql);
															$result = $conexion->query($sql);
															if ($result->num_rows > 0) {
																while ($row = $result->fetch_assoc()) {
																	$FechaPedido = $row['FechaPedido'];
																	$FechaEntrega = $row['FechaEntrega'];
																	$Id_Pedido = $row['Id_Pedido'];
																	$Cod_Pedido = $row['Cod_Pedido'];
																	$Cliente_Id_Cliente = $row['Cliente_Id_Cliente'];
																	$Fecha_Pedido = $row['Fecha_Pedido'];
																	$Total_Pedido = $row['Total_Pedido'];
																	$Descuento = $row['Descuento'];
																	$Estado_Pedido = $row['Estado_Pedido'];
																	$Saldo_Abonado = $row['Saldo_Abonado'];
																	$Fecha_Entrega = $row['Fecha_Entrega'];
																	$taller_id_taller = $row['taller_id_taller'];
																	$Pedido_Id_Usuario = $row['Pedido_Id_Usuario'];
																	$dateSol = new DateTime($Fecha_Pedido);
																	$HoraSol = $dateSol->format('H:i:s a');
																	$FechaSol = $dateSol->format('Y-m-d');
																}
															}

															$sql = "SELECT Nom_Tienda FROM t_pedido as A,t_tiendas as B WHERE Cod_Pedido='" . $Cod_Pedido . "' and A.Tienda_Id_Tienda=B.Id_Tienda";
															//Echo($sql);
															$result = $conexion->query($sql);
															if ($result->num_rows > 0) {
																while ($row = $result->fetch_assoc()) {
																	$Nom_TiendaPedido = $row['Nom_Tienda'];
																}
															}

															$sql = "SELECT Nombres,Apellidos,Img_perfil FROM t_pedido as A,t_usuarios as B WHERE Cod_Pedido='" . $Cod_Pedido . "' and A.Pedido_Id_Usuario=B.Id_Usuario";
															//Echo($sql);
															$result = $conexion->query($sql);
															if ($result->num_rows > 0) {
																while ($row = $result->fetch_assoc()) {
																	$Nombres = $row['Nombres'];
																	$Apellidos = $row['Apellidos'];
																	$AvatarVendedor = $row['Img_perfil'];
																}
															}

															$sql = "SELECT Avatar_Cliente,Nom_Cliente,Ape_Cliente FROM t_pedido as A, t_clientes as B WHERE Cod_Pedido='" . $Cod_Pedido . "' and A.Cliente_Id_Cliente=B.Id_Cliente";
															//Echo($sql);
															$result = $conexion->query($sql);
															if ($result->num_rows > 0) {
																while ($row = $result->fetch_assoc()) {
																	$AvatarCliente = $row['Avatar_Cliente'];
																	$Nom_Cliente = $row['Nom_Cliente'];
																	$Ape_Cliente = $row['Ape_Cliente'];
																}
															}


															$sql = "SELECT IFNULL(sum(Valor_Ingreso),0) AS TotalAbonos FROM t_ingresos WHERE Pedido_Id_Pedido='" . $Cod_Pedido . "'";
															//Echo($sql);
															$result = $conexion->query($sql);
															if ($result->num_rows > 0) {
																while ($row = $result->fetch_assoc()) {
																	$TotalAbonos = $row['TotalAbonos'];
																}
															}

															if ($TotalAbonos != 0) {
																$CalculoAbono = 1 - ($TotalAbonos / $Total_Pedido);
															} else {
																$CalculoAbono = 0;
															}



															$PorcentajeAbonado = $CalculoAbono * 100;
															$Saldo_Pendiente = $Total_Pedido - $TotalAbonos;

														?>
															<?php



															$DiasTotales = dias_transcurridos($FechaSol, $Fecha_Entrega);


															$DiasTranscurridos = dias_transcurridos($FechaSol, $FechaActual);
															$DiasPasados = dias_transcurridos($FechaActual, $Fecha_Entrega);

															if ($DiasTotales != 0) {
																$CalculoDias = $DiasPasados / $DiasTotales;
															} else {
																$CalculoDias = 0;
															}
															$PorcentajeDias = round($CalculoDias * 100, 1);
															//Echo ("Dias pedido".$DiasTotales."<br> han pasado:".$DiasPasados); 

															?>

															<tr>
																<?php
																if ($areapedido == 2) {
																	echo ("<td>" . $Nombres . " " . $Apellidos . "</td>");
																} else {

																?>
																	<td class="center">


																		<img data-rel="tooltip" data-placement="top" title="<?php echo ($Nombres . " " . $Apellidos . "\r\n" . $FechaPedido . " " . $HoraSol) ?>" class="img-circle" src="<?php echo utf8_encode($AvatarVendedor); ?>" width="45px" height="45px">
																	</td>
																<?php
																}
																?>
																<td>
																	<a data-rel="tooltip" data-placement="top" title="Detalles Pedido" href="Pedido-Ver.php?PedidoCliente=<?php echo ($Cod_Pedido); ?>">
																		<?php echo utf8_encode($Cod_Pedido); ?> <br>
																		TIENDA <?php echo utf8_encode($Nom_TiendaPedido); ?>


																	</a>
																</td>
																<td>
																	<?php
																	$sql = "SELECT `Id_Estado_Pedido`,Nom_Estado_Pedido, `Color_Estado`, `Desc_Estado`, `Rol_Id_Rol` FROM `t_estado_pedidos` WHERE Id_Estado_Pedido='" . $Estado_Pedido . "'";
																	//Echo($sql); 
																	$result = $conexion->query($sql);
																	if ($result->num_rows > 0) {
																		while ($row = $result->fetch_assoc()) {
																			$Id_Estado_Pedido = $row['Id_Estado_Pedido'];
																			$Nom_Estado_Pedido = $row['Nom_Estado_Pedido'];
																			$Color_Estado = $row['Color_Estado'];
																			echo ("<span class='label' style='background-color:" . $Color_Estado . "'>" . utf8_encode($Nom_Estado_Pedido) . "</span> <span class='action-icons'></span>");
																		}
																	}
																	?>
																	<?php echo (NomTaller($taller_id_taller)); ?>

																</td>



																<td class="tdcustom" style="text-transform:uppercase;"><?php echo utf8_encode($Nom_Cliente . " " . $Ape_Cliente); ?></td>
																<?php
																if ($areapedido == 2) {
																	echo ("<td></td>");
																} else {

																?>
																	<td>
																		<?php

																		$sql = "SELECT F.Img_Referencia, Estado_Solicitud_Cliente, G.Nom_Estado_Pedido,A.Referencia_Id_Referencia,D.Nom_Talla FROM t_temporal_sol AS A, t_tallas as D,t_referencias as F,t_estado_pedidos as G WHERE  A.Talla_Solicitada=D.Id_Talla and A.Referencia_Id_Referencia=F.Cod_Referencia and Pedido_Id_Pedido='" . $Cod_Pedido . "' and A.Estado_Solicitud_Cliente=G.Id_Estado_Pedido ORDER BY UNIX_TIMESTAMP(Fecha_Solicitud) DESC";
																		//Echo($sql); 
																		$result = $conexion->query($sql);
																		if ($result->num_rows > 0) {
																			while ($row = $result->fetch_assoc()) {

																				$Img_Referencia = $row['Img_Referencia'];
																				$Referencia_Id_Referencia = $row['Referencia_Id_Referencia'];
																				$Nom_Talla = $row['Nom_Talla'];
																				$ReferenciaCompleta = $Referencia_Id_Referencia . "-" . $Nom_Talla;
																				$Estado_Solicitud_Cliente = $row['Estado_Solicitud_Cliente'];
																				$Nom_Estado_Pedido = $row['Nom_Estado_Pedido'];


																		?>


																				<a style="position: relative;" data-rel="tooltip" data-placement="top" title="<?php echo utf8_encode($Nom_Estado_Pedido . " " . $ReferenciaCompleta); ?>" class="image-link" href="<?php echo utf8_encode($Img_Referencia); ?>"><img src="<?php echo utf8_encode($Img_Referencia); ?>" width="45px" height="45px">

																					<?php
																					if ($Estado_Solicitud_Cliente <= 5) {
																					?>
																						<div style="position: absolute; left: 10px; top: 2px;"><i class="fa  fa-times red fa-2x"></i></div>
																					<?php
																					} else {
																					?>
																						<div style="position: absolute; left: 10px; top: 2px;"><i class="fa  fa-check green fa-2x"></i></div>
																					<?php
																					}

																					?>


																				</a>

																		<?php
																			}
																		}
																		?>
																	</td>
																<?php } ?>
																<td class="center">
																	<?php echo ($FechaPedido); ?>
																</td>
																<td>
																	<?php
																	$sql = "SELECT F.Img_Referencia, Estado_Solicitud_Cliente, G.Nom_Estado_Pedido,A.Referencia_Id_Referencia,D.Nom_Talla FROM t_temporal_sol AS A, t_tallas as D,t_referencias as F,t_estado_pedidos as G WHERE  A.Talla_Solicitada=D.Id_Talla and A.Referencia_Id_Referencia=F.Cod_Referencia and Pedido_Id_Pedido='" . $Cod_Pedido . "' and A.Estado_Solicitud_Cliente=G.Id_Estado_Pedido ORDER BY UNIX_TIMESTAMP(Fecha_Solicitud) DESC";
																	//Echo($sql); 
																	$result = $conexion->query($sql);
																	if ($result->num_rows > 0) {
																		while ($row = $result->fetch_assoc()) {

																			$Img_Referencia = $row['Img_Referencia'];
																			$Referencia_Id_Referencia = $row['Referencia_Id_Referencia'];
																			$Nom_Talla = $row['Nom_Talla'];
																			$ReferenciaCompleta = $Referencia_Id_Referencia . "-" . $Nom_Talla;
																			$Estado_Solicitud_Cliente = $row['Estado_Solicitud_Cliente'];
																			$Nom_Estado_Pedido = $row['Nom_Estado_Pedido'];


																	?>

																			<?php echo ($ReferenciaCompleta); ?>

																			</a>

																	<?php
																		}
																	}
																	?>
																</td>

																<td>
																	<?php echo ($FechaEntrega); ?>
																</td>
																<td>
																	<?php echo ($DiasTranscurridos) ?> Días <br>
																	<?php
																	if ($PorcentajeDias >= 80 & $PorcentajeDias <= 100) {
																	?>
																		<div class="progress-bar progress-bar-success" style="width: <?php echo ($PorcentajeDias); ?>%">
																			<?php echo ($PorcentajeDias); ?>%
																		</div>
																	<?php
																	} else if ($PorcentajeDias < 79 & $PorcentajeDias > 50) {
																	?>
																		<div class="progress-bar progress-bar-warning" style="width: <?php echo ($PorcentajeDias); ?>%">
																			<?php echo ($PorcentajeDias); ?>%
																		</div>
																	<?php
																	} else if ($PorcentajeDias <= 50 & $PorcentajeDias > 1) {
																	?>
																		<div class="progress-bar progress-bar-danger" style="width: <?php echo ($PorcentajeDias); ?>%">
																			<?php echo ($PorcentajeDias); ?>%
																		</div>
																	<?php
																	} else if ($PorcentajeDias <= 0) {
																	?>
																		<span class="badge bg-red">
																			T. Superado
																		</span>
																	<?php
																	} else if ($PorcentajeDias > 100) {
																	?>
																		<span class="badge bg-red">
																			T. Superado
																		</span>
																	<?php
																	}
																	?>
																</td>

																<td class="center">
																	<?php echo utf8_encode("$ " . number_format($Total_Pedido));  ?>
																</td>
																<td class="center">

																	<?php echo utf8_encode("$ " . number_format($TotalAbonos));  ?>
																</td>

																<!-- <td class="center">
															<span class="badge bg-red">
																<?php echo (round($PorcentajeAbonado, 0)); ?>%
															</span>
														</td> -->
																<td class="center">
																	<?php echo utf8_encode("$ " . number_format($Saldo_Pendiente));  ?>
																</td>
																<td class="center">
																	<div class="btn-group">
																		<button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">
																			Acción
																			<span class="ace-icon fa fa-caret-down icon-on-right"></span>
																		</button>

																		<ul class="dropdown-menu dropdown-info dropdown-menu-right">
																			<li>
																				<a style="position: relative;" data-rel="tooltip" data-placement="top" title="Ver Pedido" href="Pedido-Ver.php?PedidoCliente=<?php echo ($Cod_Pedido); ?>"><i class="fa fa-search blue "></i> Ver Pedido</a>
																			</li>
																			<?php
																			if ($Estado_Solicitud_Cliente == 9) {
																			?>
																				<li>
																					<a style="position: relative;" data-rel="tooltip" data-placement="top" title="Entregar Pedido" href="OrdenCliente-Salida.php?Salida=<?php echo utf8_encode($Cod_Pedido); ?>"><i class="fa fa-file-pdf-o "></i> Salida Contable</a>
																				</li>
																			<?php
																			}
																			?>

																			<li>
																				<a style="position: relative;" data-rel="tooltip" data-placement="top" title="Ver/Agregar Abonos" href="Clientes-AbonosOrdenes.php?NumPedido=<?php echo utf8_encode($Cod_Pedido); ?>"><i class="fa fa-dollar green"></i> Agregar Abono</a>
																			</li>
																			<?php
																			if ($Estado_Solicitud_Cliente == 9) {
																			?>
																				<li>
																					<a style="position: relative;" data-rel="tooltip" data-placement="top" title="Pedido no Entregado" href="Pedidos.php?NumPedidoBaja=<?php echo utf8_encode($Cod_Pedido); ?>"><i class="fa fa-download green"></i> Pedido No Entregado</a>
																				</li>
																			<?php
																			}
																			?>

																			<?php
																			if ($Estado_Solicitud_Cliente == 1) {
																			?>
																				<li class="divider"></li>

																				<li>
																					<a style="position: relative;" data-rel="tooltip" data-placement="top" title="Eliminar Pedido" href="Pedidos.php?NumPedidoDel=<?php echo utf8_encode($Cod_Pedido); ?>&ValorAbonos=<?php echo ($TotalAbonos); ?>"><i class="fa fa-close red "></i> Eliminar Pedido</a>
																				</li>
																			<?php
																			}
																			?>

																		</ul>
																	</div><!-- /.btn-group -->






																</td>





															</tr>
														<?php

														}
														?>
													</tbody>
												</table>
											</div>


										</div><!-- Fin Tab Número Uno -->



									</div>
								</div>
							</div><!-- Fin Panel 12 -->



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
		if ('ontouchstart' in document.documentElement) document.write("<script src='https://modasof.com/espejo/assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
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
	<script src="https://modasof.com/espejo/assets/js/jquery.magnific-popup.js"></script>
	<script src="https://modasof.com/espejo/assets/js/jquery.magnific-popup.min.js"></script>


	<?php
	$TabActive = $_GET['TAB'];
	?>


	<script type="text/javascript">
		function activaTab(tab) {
			$('.nav-tabs a[href="#' + tab + '"]').tab('show');
		};

		activaTab('<?php echo ($TabActive); ?>');
	</script>





	<!-- inline scripts related to this page -->
	<script type="text/javascript">
		jQuery(function($) {
			$('#id-disable-check').on('click', function() {
				var inp = $('#form-input-readonly').get(0);
				if (inp.hasAttribute('disabled')) {
					inp.setAttribute('readonly', 'true');
					inp.removeAttribute('disabled');
					inp.value = "This text field is readonly!";
				} else {
					inp.setAttribute('disabled', 'disabled');
					inp.removeAttribute('readonly');
					inp.value = "This text field is disabled!";
				}
			});


			if (!ace.vars['touch']) {
				$('.chosen-select').chosen({
					allow_single_deselect: true
				});
				//resize the chosen on window resize

				$(window)
					.off('resize.chosen')
					.on('resize.chosen', function() {
						$('.chosen-select').each(function() {
							var $this = $(this);
							$this.next().css({
								'width': $this.parent().width()
							});
						})
					}).trigger('resize.chosen');
				//resize chosen on sidebar collapse/expand
				$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
					if (event_name != 'sidebar_collapsed') return;
					$('.chosen-select').each(function() {
						var $this = $(this);
						$this.next().css({
							'width': $this.parent().width()
						});
					})
				});


				$('#chosen-multiple-style .btn').on('click', function(e) {
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if (which == 2) $('#form-field-select-4').addClass('tag-input-style');
					else $('#form-field-select-4').removeClass('tag-input-style');
				});
			}


			$('[data-rel=tooltip]').tooltip({
				container: 'body'
			});
			$('[data-rel=popover]').popover({
				container: 'body'
			});

			autosize($('textarea[class*=autosize]'));

			$('textarea.limited').inputlimiter({
				remText: '%n carácteres%s restantes...',
				limitText: 'Máx permitidos : %n.'
			});

			$.mask.definitions['~'] = '[+-]';
			$('.input-mask-date').mask('99/99/9999');
			$('.input-mask-phone').mask('(999) 999-9999');
			$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
			$(".input-mask-product").mask("a*-999-a999", {
				placeholder: " ",
				completed: function() {
					alert("You typed the following: " + this.val());
				}
			});



			$("#input-size-slider").css('width', '200px').slider({
				value: 1,
				range: "min",
				min: 1,
				max: 8,
				step: 1,
				slide: function(event, ui) {
					var sizing = ['', 'input-sm', 'input-lg', 'input-mini', 'input-small', 'input-medium', 'input-large', 'input-xlarge', 'input-xxlarge'];
					var val = parseInt(ui.value);
					$('#form-field-4').attr('class', sizing[val]).attr('placeholder', '.' + sizing[val]);
				}
			});

			$("#input-span-slider").slider({
				value: 1,
				range: "min",
				min: 1,
				max: 12,
				step: 1,
				slide: function(event, ui) {
					var val = parseInt(ui.value);
					$('#form-field-5').attr('class', 'col-xs-' + val).val('.col-xs-' + val);
				}
			});



			//"jQuery UI Slider"
			//range slider tooltip example
			$("#slider-range").css('height', '200px').slider({
				orientation: "vertical",
				range: true,
				min: 0,
				max: 100,
				values: [17, 67],
				slide: function(event, ui) {
					var val = ui.values[$(ui.handle).index() - 1] + "";

					if (!ui.handle.firstChild) {
						$("<div class='tooltip right in' style='display:none;left:16px;top:-6px;'><div class='tooltip-arrow'></div><div class='tooltip-inner'></div></div>")
							.prependTo(ui.handle);
					}
					$(ui.handle.firstChild).show().children().eq(1).text(val);
				}
			}).find('span.ui-slider-handle').on('blur', function() {
				$(this.firstChild).hide();
			});


			$("#slider-range-max").slider({
				range: "max",
				min: 1,
				max: 10,
				value: 2
			});

			$("#slider-eq > span").css({
				width: '90%',
				'float': 'left',
				margin: '15px'
			}).each(function() {
				// read initial values from markup and remove that
				var value = parseInt($(this).text(), 10);
				$(this).empty().slider({
					value: value,
					range: "min",
					animate: true

				});
			});

			$("#slider-eq > span.ui-slider-purple").slider('disable'); //disable third item


			$('#id-input-file-1 , #id-input-file-2').ace_file_input({
				no_file: 'Sin Archivo ...',
				btn_choose: 'Seleccionar',
				btn_change: 'Cambiar',
				droppable: false,
				onchange: null,
				thumbnail: false //| true | large
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
				thumbnail: 'small' //large | fit
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
				preview_error: function(filename, error_code) {
					//name of the file that failed
					//error_code values
					//1 = 'FILE_LOAD_FAILED',
					//2 = 'IMAGE_LOAD_FAILED',
					//3 = 'THUMBNAIL_FAILED'
					//alert(error_code);
				}

			}).on('change', function() {
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
				if (this.checked) {
					btn_choose = "Drop images here or click to choose";
					no_icon = "ace-icon fa fa-picture-o";

					whitelist_ext = ["jpeg", "jpg", "png", "gif", "bmp"];
					whitelist_mime = ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"];
				} else {
					btn_choose = "Drop files here or click to choose";
					no_icon = "ace-icon fa fa-cloud-upload";

					whitelist_ext = null; //all extensions are acceptable
					whitelist_mime = null; //all mimes are acceptable
				}
				var file_input = $('#id-input-file-3');
				file_input
					.ace_file_input('update_settings', {
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

			$('#spinner1').ace_spinner({
					value: 0,
					min: 0,
					max: 200,
					step: 10,
					btn_up_class: 'btn-info',
					btn_down_class: 'btn-info'
				})
				.closest('.ace-spinner')
				.on('changed.fu.spinbox', function() {
					//console.log($('#spinner1').val())
				});
			$('#spinner2').ace_spinner({
				value: 0,
				min: 0,
				max: 10000,
				step: 100,
				touch_spinner: true,
				icon_up: 'ace-icon fa fa-caret-up bigger-110',
				icon_down: 'ace-icon fa fa-caret-down bigger-110'
			});
			$('#spinner3').ace_spinner({
				value: 0,
				min: -100,
				max: 100,
				step: 10,
				on_sides: true,
				icon_up: 'ace-icon fa fa-plus bigger-110',
				icon_down: 'ace-icon fa fa-minus bigger-110',
				btn_up_class: 'btn-success',
				btn_down_class: 'btn-danger'
			});
			$('#spinner4').ace_spinner({
				value: 0,
				min: -100,
				max: 100,
				step: 10,
				on_sides: true,
				icon_up: 'ace-icon fa fa-plus',
				icon_down: 'ace-icon fa fa-minus',
				btn_up_class: 'btn-purple',
				btn_down_class: 'btn-purple'
			});

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
				.next().on(ace.click_event, function() {
					$(this).prev().focus();
				});

			//or change it into a date range picker
			//or change it into a date range picker
			$('.input-daterange').datepicker({
				todayHighlight: true,
				autoclose: true,
				format: 'yyyy-mm-dd',

			});


			//to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
			$('input[name=date-range-picker]').daterangepicker({
					'applyClass': 'btn-sm btn-success',
					'cancelClass': 'btn-sm btn-default',
					locale: {
						applyLabel: 'Apply',
						cancelLabel: 'Cancel',
					}
				})
				.prev().on(ace.click_event, function() {
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
			}).next().on(ace.click_event, function() {
				$(this).prev().focus();
			});




			if (!ace.vars['old_ie']) $('#date-timepicker1').datetimepicker({
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
			}).next().on(ace.click_event, function() {
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
			try {
				tag_input.tag({
					placeholder: tag_input.attr('placeholder'),
					//enable typeahead by specifying the source array
					source: ace.vars['US_STATES'], //defined in ace.js >> ace.enable_search_ahead
					/**
					//or fetch data from database, fetch those that match "query"
					source: function(query, process) {
					  $.ajax({url: 'remote_source.php?q='+encodeURIComponent(query)})
					  .done(function(result_items){
						process(result_items);
					  });
					}
					*/
				})

				//programmatically add/remove a tag
				var $tag_obj = $('#form-field-tags').data('tag');
				$tag_obj.add('Programmatically Added');

				var index = $tag_obj.inValues('some tag');
				$tag_obj.remove(index);
			} catch (e) {
				//display a textarea for old IE, because it doesn't support this plugin or another one I tried!
				tag_input.after('<textarea id="' + tag_input.attr('id') + '" name="' + tag_input.attr('name') + '" rows="3">' + tag_input.val() + '</textarea>').remove();
				//autosize($('#form-field-tags'));
			}


			/////////
			$('#modal-form input[type=file]').ace_file_input({
				style: 'well',
				btn_choose: 'Drop files here or click to choose',
				btn_change: null,
				no_icon: 'ace-icon fa fa-cloud-upload',
				droppable: true,
				thumbnail: 'large'
			})

			//chosen plugin inside a modal will have a zero width because the select element is originally hidden
			//and its width cannot be determined.
			//so we set the width after modal is show
			$('#modal-form').on('shown.bs.modal', function() {
				if (!ace.vars['touch']) {
					$(this).find('.chosen-container').each(function() {
						$(this).find('a:first-child').css('width', '210px');
						$(this).find('.chosen-drop').css('width', '210px');
						$(this).find('.chosen-search input').css('width', '200px');
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

	<script>
		function format2(n, currency) {
			return currency + " " + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
		}
		$(document).ready(function() {
			$('#example').DataTable({
				"searching": true,
				"ordering": true,
				"paging": true,
				"info": true,
				"aLengthMenu": [
					[100, 200, 300, -1],
					[100, 200, 300, "Todas"]
				],
				"pageLength": 100,


			});
		});
	</script>


	<script type="text/javascript">
		jQuery(function($) {

			$('#dynamic-table thead tr:eq(1) th').each(function() {
				var title = $('#dynamic-table thead tr:eq(0) th').eq($(this).index()).text();
				$(this).html('<input style="width:100%;border:black solid 1px;" type="text" placeholder="Buscar ' + title + '" />');
			});

			var table = $('#dynamic-table').DataTable({
				responsive: true,
				"order": [
					[1, "Desc"]
				],
				orderCellsTop: true,
				"language": {
					"lengthMenu": "Mostrar _MENU_ registros por página",
					"zeroRecords": "No se ha encontrado nada - Lo sentimos",
					"info": "Mostrar página _PAGE_ de _PAGES_",
					"infoEmpty": "No hay registros disponibles",
				},

				"lengthMenu": [
					[500, 700, 1000, -1],
					[500, 700, 1000, "All"]
				],

				select: {
					style: 'multi'
				},
				"footerCModasofack": function(row, data, start, end, display) {
					var api = this.api(),
						data;

					// Remove the formatting to get integer data for summation
					var intVal = function(i) {
						return typeof i === 'string' ?
							i.replace(/[\$,]/g, '') * 1 :
							typeof i === 'number' ?
							i : 0;
					};


					// Total over all pages

					// Total over this page
					pageTotal9 = api
						.column(9, {
							page: 'current'
						})
						.data()
						.reduce(function(a, b) {
							return intVal(a) + intVal(b);
						}, 0);

					pageTotal10 = api
						.column(10, {
							page: 'current'
						})
						.data()
						.reduce(function(a, b) {
							return intVal(a) + intVal(b);
						}, 0);
					pageTotal11 = api
						.column(11, {
							page: 'current'
						})
						.data()
						.reduce(function(a, b) {
							return intVal(a) + intVal(b);
						}, 0);
					// Total over this page

					// Update footer
					$(api.column(9).footer()).html(
						'$' + format2(pageTotal9, '')
					);
					$(api.column(10).footer()).html(
						'$' + format2(pageTotal10, '')
					);
					$(api.column(11).footer()).html(
						'$' + format2(pageTotal11, '')
					);
					// Update footer

				},

			});

			// Apply the search
			table.columns().every(function(index) {
				$('#dynamic-table thead tr:eq(1) th:eq(' + index + ') input').on('keyup change', function() {
					table.column($(this).parent().index() + ':visible')
						.search(this.value)
						.draw();
				});
			});

			var myTable =
				$('#dynamic-table')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.DataTable({
					retrieve: true,


					"aoColumns": [{
							"bSortable": false
						},
						null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null,
						{
							"bSortable": false
						}
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


				});





			$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';

			new $.fn.dataTable.Buttons(myTable, {
				buttons: [{
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
			});
			myTable.buttons().container().appendTo($('.tableTools-container'));

			//style the message box
			var defaultCopyAction = myTable.button(1).action();
			myTable.button(1).action(function(e, dt, button, config) {
				defaultCopyAction(e, dt, button, config);
				$('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
			});




			var defaultColvisAction = myTable.button(0).action();
			myTable.button(0).action(function(e, dt, button, config) {

				defaultColvisAction(e, dt, button, config);


				if ($('.dt-button-collection > .dropdown-menu').length == 0) {
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
					if (div.length == 1) div.tooltip({
						container: 'body',
						title: div.parent().text()
					});
					else $(this).tooltip({
						container: 'body',
						title: $(this).text()
					});
				});
			}, 500);





			myTable.on('select', function(e, dt, type, index) {
				if (type === 'row') {
					$(myTable.row(index).node()).find('input:checkbox').prop('checked', true);
				}
			});
			myTable.on('deselect', function(e, dt, type, index) {
				if (type === 'row') {
					$(myTable.row(index).node()).find('input:checkbox').prop('checked', false);
				}
			});






			/////////////////////////////////
			//table checkboxes
			$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);

			//select/deselect all rows according to table header checkbox
			$('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function() {
				var th_checked = this.checked; //checkbox inside "TH" table header

				$('#dynamic-table').find('tbody > tr').each(function() {
					var row = this;
					if (th_checked) myTable.row(row).select();
					else myTable.row(row).deselect();
				});
			});

			//select/deselect a row when the checkbox is checked/unchecked
			$('#dynamic-table').on('click', 'td input[type=checkbox]', function() {
				var row = $(this).closest('tr').get(0);
				if (this.checked) myTable.row(row).deselect();
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
			$('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function() {
				var th_checked = this.checked; //checkbox inside "TH" table header

				$(this).closest('table').find('tbody > tr').each(function() {
					var row = this;
					if (th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
					else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
				});
			});

			//select/deselect a row when the checkbox is checked/unchecked
			$('#simple-table').on('click', 'td input[type=checkbox]', function() {
				var $row = $(this).closest('tr');
				if ($row.is('.detail-row ')) return;
				if (this.checked) $row.addClass(active_class);
				else $row.removeClass(active_class);
			});



			/********************************/
			//add tooltip for small view action buttons in dropdown menu
			$('[data-rel="tooltip"]').tooltip({
				placement: tooltip_placement
			});

			//tooltip placement on right or left
			function tooltip_placement(context, source) {
				var $source = $(source);
				var $parent = $source.closest('table')
				var off1 = $parent.offset();
				var w1 = $parent.width();

				var off2 = $source.offset();
				//var w2 = $source.width();

				if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2)) return 'right';
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
	<!-- Final Scripts Tablas -->

	<script type="text/javascript">
		jQuery(function($) {
			//initiate dataTables plugin
			var myTable =
				$('#dynamic-table7')
			//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
			//And for the first simple table, which doesn't have TableTools or dataTables
			//select/deselect all rows according to table header checkbox
			var active_class = 'active';
			$('#simple-table1 > thead > tr > th input[type=checkbox]').eq(0).on('click', function() {
				var th_checked = this.checked; //checkbox inside "TH" table header

				$(this).closest('table').find('tbody > tr').each(function() {
					var row = this;
					if (th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
					else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
				});
			});

			//select/deselect a row when the checkbox is checked/unchecked
			$('#simple-table1').on('click', 'td input[type=checkbox]', function() {
				var $row = $(this).closest('tr');
				if ($row.is('.detail-row ')) return;
				if (this.checked) $row.addClass(active_class);
				else $row.removeClass(active_class);
			});



			/********************************/
			//add tooltip for small view action buttons in dropdown menu
			$('[data-rel="tooltip"]').tooltip({
				placement: tooltip_placement
			});

			//tooltip placement on right or left
			function tooltip_placement(context, source) {
				var $source = $(source);
				var $parent = $source.closest('table')
				var off1 = $parent.offset();
				var w1 = $parent.width();

				var off2 = $source.offset();
				//var w2 = $source.width();

				if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2)) return 'right';
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

			$('#dynamic-table2 thead tr:eq(1) th').each(function() {
				var title = $('#dynamic-table2 thead tr:eq(0) th').eq($(this).index()).text();
				$(this).html('<input style="width:100%;border:black solid 1px;" type="text" placeholder="Buscar ' + title + '" />');
			});

			var table = $('#dynamic-table2').DataTable({
				responsive: true,
				"order": false,
				orderCellsTop: true,
				"language": {
					"lengthMenu": "Mostrar _MENU_ registros por página",
					"zeroRecords": "No se ha encontrado nada - Lo sentimos",
					"info": "Mostrar página _PAGE_ de _PAGES_",
					"infoEmpty": "No hay registros disponibles",
				},

				"lengthMenu": [
					[500, 700, 1000, -1],
					[500, 700, 1000, "All"]
				],

				select: {
					style: 'multi'
				},

			});

			// Apply the search
			table.columns().every(function(index) {
				$('#dynamic-table2 thead tr:eq(1) th:eq(' + index + ') input').on('keyup change', function() {
					table.column($(this).parent().index() + ':visible')
						.search(this.value)
						.draw();
				});
			});

			var myTable =
				$('#dynamic-table2')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.DataTable({
					retrieve: true,


					"aoColumns": [{
							"bSortable": false
						},
						null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null,
						{
							"bSortable": false
						}
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


				});





			$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';

			new $.fn.dataTable.Buttons(myTable, {
				buttons: [{
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
			});
			myTable.buttons().container().appendTo($('.tableTools-container2'));

			//style the message box
			var defaultCopyAction = myTable.button(1).action();
			myTable.button(1).action(function(e, dt, button, config) {
				defaultCopyAction(e, dt, button, config);
				$('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
			});




			var defaultColvisAction = myTable.button(0).action();
			myTable.button(0).action(function(e, dt, button, config) {

				defaultColvisAction(e, dt, button, config);


				if ($('.dt-button-collection > .dropdown-menu').length == 0) {
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
					if (div.length == 1) div.tooltip({
						container: 'body',
						title: div.parent().text()
					});
					else $(this).tooltip({
						container: 'body',
						title: $(this).text()
					});
				});
			}, 500);





			myTable.on('select', function(e, dt, type, index) {
				if (type === 'row') {
					$(myTable.row(index).node()).find('input:checkbox').prop('checked', true);
				}
			});
			myTable.on('deselect', function(e, dt, type, index) {
				if (type === 'row') {
					$(myTable.row(index).node()).find('input:checkbox').prop('checked', false);
				}
			});






			/////////////////////////////////
			//table checkboxes
			$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);

			//select/deselect all rows according to table header checkbox
			$('#dynamic-table2 > thead > tr > th input[type=checkbox], #dynamic-table2_wrapper input[type=checkbox]').eq(0).on('click', function() {
				var th_checked = this.checked; //checkbox inside "TH" table header

				$('#dynamic-table2').find('tbody > tr').each(function() {
					var row = this;
					if (th_checked) myTable.row(row).select();
					else myTable.row(row).deselect();
				});
			});

			//select/deselect a row when the checkbox is checked/unchecked
			$('#dynamic-table2').on('click', 'td input[type=checkbox]', function() {
				var row = $(this).closest('tr').get(0);
				if (this.checked) myTable.row(row).deselect();
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
			$('#simple-table55 > thead > tr > th input[type=checkbox]').eq(0).on('click', function() {
				var th_checked = this.checked; //checkbox inside "TH" table header

				$(this).closest('table').find('tbody > tr').each(function() {
					var row = this;
					if (th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
					else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
				});
			});

			//select/deselect a row when the checkbox is checked/unchecked
			$('#simple-table55').on('click', 'td input[type=checkbox]', function() {
				var $row = $(this).closest('tr');
				if ($row.is('.detail-row ')) return;
				if (this.checked) $row.addClass(active_class);
				else $row.removeClass(active_class);
			});



			/********************************/
			//add tooltip for small view action buttons in dropdown menu
			$('[data-rel="tooltip"]').tooltip({
				placement: tooltip_placement
			});

			//tooltip placement on right or left
			function tooltip_placement(context, source) {
				var $source = $(source);
				var $parent = $source.closest('table')
				var off1 = $parent.offset();
				var w1 = $parent.width();

				var off2 = $source.offset();
				//var w2 = $source.width();

				if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2)) return 'right';
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