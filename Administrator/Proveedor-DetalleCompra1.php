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


$NumeroOrden=$_GET['NumeroOrden'];
					
//Id 
$sql ="SELECT Bodega_Id_Bodega,Proveedor_Id_Proveedor FROM t_orden_compra_insumos WHERE Cod_Orden_Prov='".$NumeroOrden."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Query_IdBodega=$row['Bodega_Id_Bodega'];
        $Query_IdProveedor=$row['Proveedor_Id_Proveedor'];
    }
}

//Nombre de Bodega Recuperada
$sql ="SELECT Nom_Bodega FROM t_bodegas WHERE Id_Bodega='".$Query_IdBodega."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Recovery_NomBodega=$row['Nom_Bodega'];
    }
}
// Proveedor Seleccionado
$sql ="SELECT Nom_Prov FROM t_proveedores WHERE Id_Proveedor='".$Query_IdProveedor."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Qr_Nom_Prov=$row['Nom_Prov'];
    }
}
// Datos de la compra
$sql ="SELECT date_format(Fecha_Solicitud,CONCAT(CONCAT(ELT(WEEKDAY(Fecha_Solicitud) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(Fecha_Solicitud), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS FechaSolicitud,date_format(Fecha_Est_Llegada,CONCAT(CONCAT(ELT(WEEKDAY(Fecha_Est_Llegada) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(Fecha_Est_Llegada), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS FechaEstimada, Forma_Pago,Nombres,Apellidos, Usuario_Responsable FROM t_orden_compra_insumos as A, t_usuarios as B  WHERE Cod_Orden_Prov='".$NumeroOrden."' and A.Usuario_Responsable=B.Id_Usuario"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Qy_FechaSolicitud=$row['FechaSolicitud'];
        $Qy_FechaLlegada=$row['FechaEstimada'];
        $Qy_NomResponsable=$row['Nombres'];
        $Qy_ApeResponsable=$row['Apellidos'];
        $Qy_Pago=$row['Forma_Pago'];
    }
}

// Total Orden
$sql ="SELECT IFNULL(sum(Valor_Subtotal),0) as Valor_Subtotal FROM t_orden_compra_insumos WHERE Cod_Orden_Prov='".$NumeroOrden."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Qy_Valor_Subtotal=$row['Valor_Subtotal'];
    }
}

// Total Orden
$sql ="SELECT count(Valor_Subtotal) as CantidadItems FROM t_orden_compra_insumos WHERE Cod_Orden_Prov='".$NumeroOrden."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Qy_TotalItem=$row['CantidadItems'];
    }
}


// $DeleteItem=$_GET['Delete'];

// if ($DeleteItem!="") {
// 	$sql ="DELETE FROM t_orden_compra_insumos  WHERE Id_Orden_Compra='".$DeleteItem."'";  
// $result = $conexion->query($sql);
// header("location:Proveedor-CrearOrden.php?Mensaje=2&DocSel=".$DocSel."&CodEst=".$CodOrdenRecuperado."&NumeroOrden=".$NumeroOrden."&F1=".$Recovery_F1."&F2=".$Recovery_F2."&Bod=".$Recovery_Bod."");
// }

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Orden de Compra Modasof</title>

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

	

    <?php include("Lib/Favicon.php") ?>

   
<!--/Inicio Alertas-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link href="https://modasof.com/espejo/assets/css/sweetalert.css" rel="stylesheet">
    <!-- Custom functions file -->
    <script src="https://modasof.com/espejo/assets/js/functions.js"></script>
    <!-- Sweet Alert Script -->
    <script src="https://modasof.com/espejo/assets/js/sweetalert.min.js"></script>
    <!--/Fin Alertas-->

    <link rel="stylesheet" href="https://modasof.com/espejo/assets/css/magnific-popup.css">
<script type="text/javascript">
	$(document).ready(function() {
  $('.image-link').magnificPopup({type:'image'});
});
</script>

   

	</head>

	<body class="skin-1">

	<?php 
  $Valide=$_GET['Mensaje'];

    if ($Valide==14) {
        echo "<script>jQuery(function(){swal(\"¡No ha subido!\", \"Soporte\", \"error\");});</script>";
    };
    if ($Valide==1) {
        echo "<script>jQuery(function(){swal(\"¡ Insumo  Agregado!\", \"Correctamente \", \"success\");});</script>";
    };
     if ($Valide==2) {
        echo "<script>jQuery(function(){swal(\"¡ Insumo Recibido!\", \"Correctamente \", \"success\");});</script>";
    };
     if ($Valide==13) {
        echo "<script>jQuery(function(){swal(\"¡ Soporte Cargado a compra!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==23) {
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
								<i class="ace-icon fa fa-cart-arrow-down"></i>
								<a href="Compras.php">Compras</a>
							</li>
							
							<li>
								<i class="ace-icon fa fa-cloud-download"></i>
								<a href="">Recibir Orden de Compra Nº<?php Echo($NumeroOrden) ?></a>
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

						


						
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
									<!-- <a href="#modal-form" role="button" class="blue" data-toggle="modal"> Form Inside a Modal Box </a> -->
								
					

						<!-- Inicio botones de acceso rápido -->
						<div class="col-sm-12 col-xs-12">

			<div class="col-sm-4 col-xs-12 ">
											<div class="widget-box">
												<div class="widget-body degrade-verdeligth">
													<div class="widget-main">
<h5><i class="fa fa-info-circle"></i>  Orden de Compra Número:   <strong><?php Echo utf8_encode($NumeroOrden) ?></strong>  </h5>
<h5><i class="fa fa-calendar"></i>  Fecha Solicitud:    <?php Echo ($Qy_FechaSolicitud) ?> </h5>
<h5><i class="fa fa-calendar"></i>  Fecha Llegada:    <?php Echo ($Qy_FechaLlegada) ?> </h5>
<h5><i class="fa fa-user"></i>  Proveedor:    <?php Echo utf8_encode($Qr_Nom_Prov) ?> </h5>
<h5><i class="fa fa-user"></i>  Solicitada por:    <?php Echo utf8_encode($Qy_NomResponsable." ".$Qy_ApeResponsable) ?> </h5>


													
													</div>
												</div>
											</div>
										</div>
				<div class="col-sm-5 col-xs-12">
											<div class="widget-box">
												<div class="widget-body degrade-verdeligth">
													<div class="widget-main">
<h5><i class="fa fa-info-circle"></i>  Recibe:    <?php Echo utf8_decode($Recovery_NomBodega) ?> </h5>
<h5><i class="fa fa-info-circle"></i>  Estado:    <?php Echo utf8_encode($Qr_Nom_Prov) ?> </h5>
<h5>
	<i class="fa fa-dollar"></i>
	  Tipo de Pago:    
	  <?php 
	  if ($Qy_Pago==1) {
	  	Echo ("CRÉDITO");
	  }
	  elseif ($Qy_Pago==2) {
	  	Echo("PAGO DE INMEDIATO");
	  }
	  ?> 
	</h5>
<h5><i class="fa fa-user"></i>  Valor Total:    <?php Echo Formatomoneda($Qy_Valor_Subtotal) ?> </h5>
<h5><i class="fa fa-user"></i>  Total Items solicitados:    <?php Echo utf8_encode($Qy_TotalItem) ?> </h5>



													
													</div>
												</div>
											</div>
										</div>
					<div class="col-sm-3 col-xs-12 center ">
											<div class="widget-box">
												<div class="widget-body degrade-azul">
													<div class="widget-main">
<?php 
					//Nombre de Bodega Recuperada
$sql ="SELECT Soporte_Compra FROM t_orden_compra_insumos WHERE Cod_Orden_Prov='".$NumeroOrden."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Qr_Soporte_Compra=$row['Soporte_Compra'];
    }
}

					 ?>

<?php 
	if ($Qr_Soporte_Compra!="") {
		?>
		<h5>Ver Soporte Recibido</h5>
		<a target="_blank" href="<?php echo utf8_encode($Qr_Soporte_Compra); ?>"><i class="fa fa-eye fa-4x success"></i><i class="fa fa-eye fa-4x success"></i></a>
		<?php
	}
	else 
	{
 ?>
				<form action="Proveedor-GuardarSoporte.php" method="post" id="FormFactura" enctype="multipart/form-data">
								<div class="form-group">
										<label for="form-field-select-3">Soporte de Recibido</label>
										<div >
											<input name="fotoportada"  type="file" id="id-input-file-1" class="col-xs-10 col-sm-5"" />
						<input style="display: none;" type="text" name="Txt_NumeroOrden" value="<?php Echo($NumeroOrden); ?>">
										</div>
									</div>

									<div>
											<label for="form-field-9">Observaciones</label>

									<textarea class="form-control limited" name="TxtDetalle" id="form-field-9" rows="1" maxlength="300"></textarea>
									</div>
									<button class="btn btn-danger btn-sm">
										<i class="fa fa-cloud-upload"> Cargar Soporte</i>
									</button>

									</form>	
				<?php 
			}
				 ?>			
													</div>
												</div>
											</div>
								</div>
				
						</div>

							<div class="col-sm-12 col-xs-12">
							
							<!-- INICIO TABLA -->
						<div class="clearfix">
											<div class="pull-left tableTools-container"></div>
										</div>
										<div class="table-header">
											Orden de Compra Nº: <?php Echo($NumeroOrden); ?>
										</div>
										
										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
											<table id="dynamic-table"  class="table table-responsive table-striped table-bordered table-hover">
												<thead>
													<tr class="warning">
														<th class="tdcustom" style="width: 5%;">Orden Nº</th>
														<th class="tdcustom" style="width: 5%;">Foto</th>
														<th class="tdcustom" style="width: 5%;">Cód Modasof</th>
														<th class="tdcustom" style="width: 5%;">Cód Prov</th>
														<th class="tdcustom" style="width: 5%;">Insumo</th>
														<th class="tdcustom" style="width: 5%;">Fecha Solicitud</th>
														
														<th class="tdcustom" style="width: 5%;">Fecha Llegada</th>
														<th class="tdcustom" style="width: 5%;">Fecha Recibido</th>
														
														<th class="tdcustom" style="width: 5%;">Vr. Unitario</th>
														<th class="tdcustom" style="width: 12%;">Cant.</th>
														<th class="tdcustom" style="width: 5%;">Vr. Total</th>
													<th class="tdcustom" style="width: 20%;">Descargar Insumo</th>
														<!-- <th class="tdcustom" style="width: 5%;">Acciones</th> -->
													</tr>
													<tr>
														<th class="tdcustom" style="width: 5%;">Orden Nº</th>
														<th class="tdcustom" style="width: 5%;">Foto</th>
														<th class="tdcustom" style="width: 5%;">Cód Modasof</th>
														<th class="tdcustom" style="width: 5%;">Cód Prov</th>
														<th class="tdcustom" style="width: 5%;">Insumo</th>
														<th class="tdcustom" style="width: 5%;">Fecha Solicitud</th>
														
														<th class="tdcustom" style="width: 5%;">Fecha Llegada</th>
														<th class="tdcustom" style="width: 5%;">Llega en</th>
														
														<th class="tdcustom" style="width: 5%;">Vr. Unitario</th>
														<th class="tdcustom" style="width: 12%;">Cant.</th>
														<th class="tdcustom" style="width: 5%;">Vr. Total</th>
													<th class="tdcustom" style="width: 20%;">Observaciones</th>
														<!-- <th class="tdcustom" style="width: 5%;">Acciones</th> -->
													</tr>
												</thead>

												<tbody>
			
<?php 

	$sql ="SELECT date_format(Fecha_Solicitud,CONCAT(CONCAT(ELT(WEEKDAY(Fecha_Solicitud) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(Fecha_Solicitud), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS FechaSolicitud,date_format(Fecha_Est_Llegada,CONCAT(CONCAT(ELT(WEEKDAY(Fecha_Est_Llegada) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(Fecha_Est_Llegada), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS FechaEstimada,date_format(Fecha_Recibido,CONCAT(CONCAT(ELT(WEEKDAY(Fecha_Recibido) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(Fecha_Recibido), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS FechaRecibido,Id_Orden_Compra, Cod_Orden_Prov, Cod_Orden_Modasof, Fecha_Solicitud, Marca_Temporal, Insumo_Cod_Insumo, Lote_Insumo, Cantidad_Solicitada, A.Costo_Insumo, Fecha_Est_Llegada, Estado_Insumo,B.Cod_Proveedor, B.Cod_Insumo,B.Url_Insumo, B.Nom_Insumo, B.Unidad_Insumo,C.Nombres,C.Apellidos,A.Fecha_Recibido, A.Observa_Compra, A.Cant_Recibida FROM t_orden_compra_insumos as A, t_insumos as B, t_usuarios as C WHERE  A.Insumo_Cod_Insumo=B.Id_Insumo and A.Usuario_Responsable=C.Id_Usuario and Cod_Orden_Prov='".$NumeroOrden."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Tb_FechaSolicitud=$row['FechaSolicitud'];
        $Tb_FechaEstimada=$row['FechaEstimada'];
        $Tb_Id_Orden_Compra=$row['Id_Orden_Compra'];
        $Tb_Cod_Orden_Prov=$row['Cod_Orden_Prov'];
        $Tb_Cod_Orden_Modasof=$row['Cod_Orden_Modasof'];
        $Tb_Fecha_Solicitud=$row['Fecha_Solicitud'];
        $Tb_Marca_Temporal=$row['Marca_Temporal'];
        $Tb_Insumo_Cod_Insumo=$row['Insumo_Cod_Insumo'];
        $Tb_Lote_Insumo=$row['Lote_Insumo'];
        $Tb_Cantidad_Solicitada=$row['Cantidad_Solicitada'];
        $Tb_Costo_Insumo=$row['Costo_Insumo'];
        $Tb_Fecha_Est_Llegada=$row['Fecha_Est_Llegada'];
        $Tb_Estado_Insumo=$row['Estado_Insumo'];
        $Tb_Url_Insumo=$row['Url_Insumo'];
        $Tb_Nom_Insumo=$row['Nom_Insumo'];
        $Tb_Unidad_Insumo=$row['Unidad_Insumo'];
        $Tb_Nombres=$row['Nombres'];
        $Tb_Apellidos=$row['Apellidos'];
         $Tb_Cod_Proveedor=$row['Cod_Proveedor'];
          $Tb_Cod_Insumo=$row['Cod_Insumo'];
        $Tb_Fecha_Recibido=$row['FechaRecibido'];
         $Tb_FechaHora_Recibido=$row['Fecha_Recibido'];
        
        $Tb_Observa_Compra=$row['Observa_Compra'];
          $Tb_NombreCompleto=$Tb_Nombres." ".$Tb_Apellidos;
          $Tb_Cant_Recibida=CantidadRecibida($NumeroOrden,$Tb_Cod_Insumo);
													 ?>

													<tr>
														<td>
															<?php echo utf8_encode($Tb_Cod_Orden_Prov); ?>
														</td>
														<td>
														<a class="image-link" href="<?php echo utf8_encode($Tb_Url_Insumo); ?>"><img src="<?php echo utf8_encode($Tb_Url_Insumo); ?>" width="45px" height="45px"></a>
														</td>
														<td>
															<?php echo utf8_encode($Tb_Cod_Insumo); ?>
														</td>
														<td>
															<?php echo utf8_encode($Tb_Cod_Proveedor); ?>
														</td>
														<td>
															<?php echo utf8_encode($Tb_Nom_Insumo); ?>
														</td>
														<td>
															<a href="" class="tooltip-primary blue" data-rel="tooltip" data-placement="top" title="<?php echo utf8_encode($Tb_NombreCompleto." ".$Tb_Marca_Temporal); ?>">
																	<?php echo ($Tb_FechaSolicitud); ?>
																</a>
														</td>
														<td>
															<?php echo ($Tb_FechaEstimada); ?>
														</td>
														<td class="tdcustom center">
															<a href="" class="tooltip-primary " data-rel="tooltip" data-placement="top" title="<?php echo utf8_encode($Tb_FechaHora_Recibido); ?>">
															<?php echo ($Tb_Fecha_Recibido); ?>
																
															</td>
														
														<td class="tdcustom center"><?php echo utf8_encode(Formatomoneda($Tb_Costo_Insumo)); ?></td>
														<td>

													<?php 
$CadenaSol="<i class='fa fa-user'> </i> <b class='blue'>Solicitados: ".$Tb_Cantidad_Solicitada." ".$Tb_Unidad_Insumo."</b>";
$CadenaRec="<i class='fa fa-check-circle-o green'> </i> <b class='green'>Recibidos: ".$Tb_Cant_Recibida." ".$Tb_Unidad_Insumo."</b>";
$CadenaPen="<i class='fa fa-clock-o red'> </i> <b class='red'>Pendientes: ".($Tb_Cantidad_Solicitada-$Tb_Cant_Recibida)." ".$Tb_Unidad_Insumo."</b>";

$cadena = "".$CadenaSol."\r\n".$CadenaRec."\n\r".$CadenaPen."\n\r";
echo nl2br($cadena);
									 ?>
														</td>
														
														<td class="center">
															<?php 
															$TotalSolicitado=$Tb_Cantidad_Solicitada*$Tb_Costo_Insumo;
															echo utf8_encode(Formatomoneda($TotalSolicitado)); 

															?>
														</td>
													<?php 
													if ($Tb_Cant_Recibida<$Tb_Cantidad_Solicitada) {
														?>
														<td colspan="2">
										<form action="Proveedor-RecibirOrden.php" method="post" id="FormRecibido">
							<?php 
							if ($Tb_Cant_Recibida==0) {
								?>
	<input required="true" type="number" name="Txt_Cant_Recibida" class="input-xlarge" value="" placeholder="Ingresar Cant. Recibida">
	<input type="text" name="Txt_ObservaItem" class="input-sm" value="" placeholder="Agregar Observación">
								<?php
							}
							else 
							{
								?>
	<input required="true" type="number" name="Txt_Cant_Recibida" class="input-sm" value="<?php echo ($Tb_Cant_Recibida); ?>" >		
	<input type="text" name="Txt_ObservaItem" class="input-sm" value="<?php echo ($Tb_Observa_Compra); ?>">			
								<?php
							}

							 ?>
							
							
				<input style="display: none;" type="text" name="Txt_IdInsumo" value="<?php echo ($Tb_Id_Orden_Compra); ?>">
				<input style="display: none;" type="text" name="Txt_CantSolicitada" value="<?php echo ($Tb_Cantidad_Solicitada); ?>">
				<input style="display: none;" type="text" name="Txt_NumeroOrden" value="<?php echo ($NumeroOrden); ?>">
				<input style="display: none;" type="text" name="Txt_Insumo_Cod_Insumo" value="<?php echo ($Tb_Cod_Insumo); ?>">
																<button type="submit" class="btn btn-xs btn-danger tooltip-primary blue" data-rel="tooltip" data-placement="top" title="Verificar Pedido"><i class="fa fa-eye"></i></button>
															</form>
														</td>

														<?php
													}
													elseif ($Tb_Cant_Recibida==$Tb_Cantidad_Solicitada) {
												Echo("<td colspan='2' class='center'><span class='label label-sm label-success'> RECIBIDO OK</span></td>");
													}
													elseif ($Tb_Cant_Recibida>$Tb_Cantidad_Solicitada) {
														?>

														<td colspan="2">
										<form action="Proveedor-RecibirOrden.php" method="post" id="FormRecibido">
							<input required="true" type="number" name="Txt_Cant_Recibida" class="input-sm" value="<?php echo ($Tb_Cant_Recibida); ?>" >
							<input type="text" name="Txt_ObservaItem" class="input-sm" value="<?php echo ($Tb_Observa_Compra); ?>">
				<input style="display: none;" type="text" name="Txt_IdInsumo" value="<?php echo ($Tb_Id_Orden_Compra); ?>">
				<input style="display: none;" type="text" name="Txt_CantSolicitada" value="<?php echo ($Tb_Cantidad_Solicitada); ?>">
				<input style="display: none;" type="text" name="Txt_NumeroOrden" value="<?php echo ($NumeroOrden); ?>">
				<input style="display: none;" type="text" name="Txt_Insumo_Cod_Insumo" value="<?php echo ($Tb_Cod_Insumo); ?>">
					<button type="submit" class="btn btn-xs btn-danger tooltip-primary blue" data-rel="tooltip" data-placement="top" title="Verificar Pedido"><i class="fa fa-eye"></i></button>
															</form>
														</td>

														<?php
													}
													 ?>
														
														

														

														
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

		<script src="https://modasof.com/espejo/assets/js/jquery.magnific-popup.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.magnific-popup.min.js"></script>

		<script type="text/javascript">
        $(document).ready(function()
        {
             $("#FormRecibido").validate({
             	errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
                 rules: {
                     "Txt_Cant-Recibida": { required:true },
                     "Txt_ObservaItem": { required:true },
                    
                 },
              
             });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function()
        {
             $("#FormFactura").validate({
             	errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
                 rules: {
                     "fotoportada": { required:true },
                     "TxtDetalle": { required:true },
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
					remText: '%n cáractere%s restantes...',
					limitText: 'máximos Permitidos : %n.'
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
					thumbnail:true, //| true | large
					whitelist:'gif|png|jpg|jpeg',
					blacklist:'exe|php|pdf|docs|xls',
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
