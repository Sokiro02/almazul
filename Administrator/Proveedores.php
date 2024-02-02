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
	$sql ="DELETE FROM t_proveedores WHERE Id_Proveedor='".$Confirmation."'";  
//echo($sql);
$result = $conexion->query($sql);
header("location:Proveedores.php?Mensaje=18");
}

// ********* Función Pedidos Mes Actual - Mes Anterior *****************//
//$TotalActual=(SumaporFechas("Costo_Insumo","t_orden_compra_insumos","Actual","Fecha_Solicitud","Cantidad_Solicitada"));
//$TotalAnterior=(SumaporFechas("Costo_Insumo","t_orden_compra_insumos","Anterior","Fecha_Solicitud","Cantidad_Solicitada"));

	// if ($TotalActual!="0") {
	// 	$V1=round($TotalAnterior/$TotalActual,3);
	// 	$V2=round($V1*100,3);
	// }
// ********* Función Pedidos Mes Actual - Mes Anterior *****************//

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Proveedores Modasof</title>

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

     <script type="text/javascript">
$(document).ready(function(){
$("#TxtNombre").keyup(function(){ //se crea la funcioin keyup
var texto = $(this).val();//se recupera el valor de la caja de texto y se guarda en la variable texto
var dataString = 'ValProveedor='+ texto;//se guarda en una variable nueva para posteriormente pasarla a busqueda.php

if(texto==''){//si no tiene ningun valor la caja de texto no realiza ninguna accion
    // Ninguna Acción
}else{

//pero si tiene valor entonces
$.ajax({//metodo ajax
type: "POST",//aqui puede  ser get o post
url: "Valida-Duplicados.php",//la url adonde se va a mandar la cadena a buscar
data: dataString,
//cache: false,
success: function(html){//funcion que se activa al recibir un dato
$("#MsjError").html(html).show();// funcion jquery que muestra el div con identificador display, como formato html, tambien puede ser .text
}
});

}
return false;    
});
});
</script>

	</head>

	<body class="skin-1">

	<?php 
  $Valide=$_GET['Mensaje'];

    if ($Valide==2) {
        echo "<script>jQuery(function(){swal(\"¡Lo Sentimos!\", \"Datos Incorrectos\", \"error\");});</script>";
    };
    if ($Valide==1) {
        echo "<script>jQuery(function(){swal(\"¡ Proveedor Creado!\", \"Correctamente \", \"success\");});</script>";
    };
     if ($Valide==18) {
        echo "<script>jQuery(function(){swal(\"¡ Proveedor Eliminado!\", \"Correctamente \", \"success\");});</script>";
    };
     if ($Valide==2) {
        echo "<script>jQuery(function(){swal(\"¡ Proveedor Actualizado!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==22) {
        echo "<script>jQuery(function(){swal(\"¡ Extra Cargada a Cliente!\", \"".$ClienteSel." \", \"success\");});</script>";
    };
   ?>

  <?php 

if (isset($_GET['DeleteTask'])) {
	 $DeleteTask=$_GET['DeleteTask'];

    if ($DeleteTask!="") {
    	?>
    	<script>jQuery(function(){
    	swal({
  title: "¿Está seguro de eliminar este Proveedor?",
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
    window.location.href = 'Proveedores.php?Confirmation=<?php Echo($DeleteTask); ?>';
  } else {
    window.location.href = 'Proveedores.php';
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
								<a href="Proveedores.php">Proveedores</a>
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
	<?php $New=$_GET['New'];
if ($New==1) {
	?>
	<!-- Inicio Modal -->
		<div >
							<form action="Proveedor-CrearProveedor.php" method="post" id="FormNuevoProveedor">
									<div class="modal-dialog ">
										<div class="modal-content">
											<div class="modal-header">
												<a href="Proveedores.php" type="button" class="close" data-dismiss="modal">&times;</a>
												<h4 class="black bigger">Nuevo Proveedor</h4>
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
												<input type="text" autocomplete="off" name="TxtNombre" id="TxtNombre" class="input-large" placeholder="Nombre del Proveedor" style="text-transform:uppercase;">
															</div>
														
														</div>
														<div id="MsjError"></div>
														
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
												<a href="Proveedores.php" class="btn btn-sm btn-danger" data-dismiss="modal">
													<i class="ace-icon fa fa-times"></i>
													Cancelar
												</a>

												<button class="btn btn-sm btn-success">
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
}
	?>
<hr>
	<?php 
$EditTask = $_GET['EditTask']; // Variable tomada de Tabla parte inferior
if ($EditTask!="") { // Validación si está vacia
?>

<div id='DivEditar'>
<?php
// Consulta de Proveedor a Editar
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
												
												<h4 class="blue bigger">Editar Proveedor</h4>
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
</form>
</div>

<?php 
} // Fin Validación de Variable Vacia
 ?>
<!-- Link Ventana Modal -->
<a  href="Proveedores.php?New=1"><span class="btn btn-info pull-right"><i class="fa fa-plus-square"> </i> Crear Proveedor</span></a> 
<!-- Link Ventana Modal -->	
<!-- Link Ventana Modal -->
<a  data-toggle="modal" data-target="#modal-form2" href="#"><span class="btn  btn-danger pull-right"><i class="fa fa-pie-chart"> </i></span></a> 
<!-- Link Ventana Modal -->	

<!-- INICIO TABLA -->
						<div class="clearfix">
											<div class="pull-left tableTools-container"></div>
											
										</div>
										<div class="table-header" style="background-color: #000;">
											Lista de Proveedores
										</div>
										
										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
											<table style="font-size: 12px;" id="dynamic-table"  class="table table-responsive table-striped table-bordered table-hover" width="100%">
												<thead>
											
													<tr class="warning">
														<th class="tdcustom">Nombre</th>
														<th class="tdcustom" >Tels</th>
														<th class="tdcustom">Ciudad</th>
														<th class="tdcustom" >Nit</th>
														<th class="tdcustom" >Dirección</th>
														<th class="tdcustom" >E-mail</th>
														<th class="tdcustom">A Crédito</th>
														<th class="tdcustom">De Contado</th>
														<th class="tdcustom">Nº</th>
														<th class="tdcustom">T.Pedidos</th>
														<th class="tdcustom" >Acciones</th>
													</tr>
													<tr>
														<th class="tdcustom">Nombre</th>
														<th class="tdcustom" >Tels</th>
														<th class="tdcustom">Ciudad</th>
														<th class="tdcustom" >Nit</th>
														<th class="tdcustom" >Dirección</th>
														<th class="tdcustom" >E-mail</th>
														<th class="tdcustom">A Crédito</th>
														<th class="tdcustom">De Contado</th>
														<th class="tdcustom">Nº</th>
														<th class="tdcustom">T.Pedidos</th>
														<th class="tdcustom" >Acciones</th>
													</tr>
												</thead>

												<tbody>
	<?php 
$sql ="SELECT Id_Proveedor FROM t_proveedores order by Id_Proveedor ASC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$ListaProveedores=$ListaProveedores.$row['Id_Proveedor'].",";                  
 }
}
$CadenaProveedores=explode(",", $ListaProveedores);
//Split al Arreglo
$longitud = count($CadenaProveedores);
$min=$longitud-1;
//Recorro todos los elementos
//for($i=0; $i<$min; $i++)
//{
?>

<?php 
for($i=0; $i<$min; $i++)
{
	$sql ="SELECT Id_Proveedor, Nom_Prov, Nit_Prov, Dir_Prov, Tel_Prov, Cel1_Prov, Whp_Prov, Email_Prov, Contacto_Prov, Nom_Ciudad, Tipo_Insumo FROM t_proveedores as A, t_ciudades as B WHERE A.Ciudad_Id_Ciudad=B.Id_Ciudad and Id_Proveedor='".$CadenaProveedores[$i]."'"; 
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

}
}

//****************************************************************
// Suma a Crédito
//****************************************************************
$sql="SELECT IFNULL(sum(Cantidad_Solicitada*Costo_Insumo),0) as SumaCredito From t_orden_compra_insumos where  Proveedor_Id_Proveedor='".$CadenaProveedores[$i]."' and Forma_Pago=1"; 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $SumaCredito=$row['SumaCredito'];
    }
}
//****************************************************************
// Suma de Contado
//****************************************************************
$sql="SELECT IFNULL(sum(Cantidad_Solicitada*Costo_Insumo),0) as SumaContado From t_orden_compra_insumos where  Proveedor_Id_Proveedor='".$CadenaProveedores[$i]."' and Forma_Pago=2"; 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $SumaContado=$row['SumaContado'];
    }
}
//****************************************************************
// Suma Total
//****************************************************************

$sql="SELECT IFNULL(sum(Cantidad_Solicitada*Costo_Insumo),0) as SumaPedidos From t_orden_compra_insumos where  Proveedor_Id_Proveedor='".$CadenaProveedores[$i]."'"; 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $SumaPedidos=$row['SumaPedidos'];
    }
}

//****************************************************************
// Suma Pedidos
//****************************************************************

$sql="SELECT COUNT(Cod_Orden_Prov) as NumPedidos FROM t_orden_compra_insumos WHERE Proveedor_Id_Proveedor='".$CadenaProveedores[$i]."'"; 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $NumPedidos=$row['NumPedidos'];
    }
}
				 ?>

														<tr>
															<td class="tdcustom">
															<?php Echo utf8_encode($Tb_Nom_Prov) ?>
																
															</td>
														
														
														
														
														
														
														<td class="tdcustom">
															<?php 
									$CadenaCel="<i class='fa fa-mobile-phone'> </i> ".$Tb_Cel1_Prov;
									$CadenaWhp="<i class='fa fa-whatsapp green'> </i> ".$Tb_Whp_Prov;
									$CadenaTel="<i class='fa fa-phone'> </i> ".$Tb_Tel_Prov;

$cadena = "".$CadenaCel."\r\n".$CadenaWhp."\n\r".$CadenaTel."\n\r";
echo nl2br($cadena);
									 ?>

														</td>
														<td class="tdcustom"><?php echo utf8_encode($Tb_Nom_Ciudad); ?></td>
														<td class="tdcustom"><?php echo utf8_encode($Tb_Nit_Prov); ?></td>
															<td class="tdcustom"><?php echo utf8_encode($Tb_Dir_Prov); ?></td>
														
														<td class="tdcustom"><a href="mailto:<?php echo utf8_encode($Tb_Email_Prov); ?>"><?php echo utf8_encode($Tb_Email_Prov); ?></a> </td>
														
														<td class="tdcustom center">
													<!-- <a href="Proveedor-EstadoCuenta.php?DocSel=<?php echo($Tb_Id_Proveedor);?>" class="tooltip-primary blue" data-rel="tooltip" data-placement="top" title="Estado de Cuenta Proveedor"> -->
															<b class="red"><?php Echo(formatomoneda($SumaCredito)) ?></b>
														<!-- </a> -->
														</td>
														<td class="tdcustom center"><b class="green"><?php Echo(formatomoneda($SumaContado)) ?></b></td>
														<td class="tdcustom center"><b class="blue"><?php Echo($NumPedidos) ?></b></td>
														<td class="tdcustom center"><b class="blue"><?php Echo(formatomoneda($SumaPedidos)) ?></b></td>
														
														
														
														<td class="center">
															<div class=" action-buttons">
																<a href="Proveedores.php?EditTask=<?php echo($Tb_Id_Proveedor);?>" class="tooltip-primary blue" data-rel="tooltip" data-placement="top" title="Editar Proveedor">
																	 <i class="fa fa-pencil bigger-150"></i>
														</a>
																
																<?php 
											if ($SumaPedidos==0) {
												?>

											 <a href="Proveedores.php?DeleteTask=<?php echo($Tb_Id_Proveedor);?>" class="tooltip-danger red" data-rel="tooltip" data-placement="top" title="Eliminar Proveedor">
															<i class="fa fa-trash-o bigger-150"></i>
												</a>
												<?php
											}
											 ?>		
															
																<a href="Proveedor-CrearOrden.php?ApeCliente=<?php echo($Tb_Nom_Prov);?>&DocSel=<?php echo($Tb_Id_Proveedor);?>&NomCliente=<?php echo($Tb_Contacto_Prov);?>" class="tooltip-danger green" data-rel="tooltip" data-placement="top" title="Crear Orden de Compra">
																	<i class="ace-icon fa fa-plus-square bigger-120"> </i> Crear Orden
																</a>


															
															

															</div>

															
														</td>
													</tr>
													<?php 
													
}
													 ?>
												</tbody>
											</table>
										</div>
						<!-- FIN TABLA -->

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
                      // "TxtCelular": { required:true }, 
                      //  "TxtWhp": { required:true }, 
                      //   "TxtTel": { required:true }, 
                     "TxtCorreo": { required:true, email:true },  
                     "TxtTipoInsumo": { required:true }, 

                 },
                 messages: {
                     
                    	"TxtCorreo": { required:"Por favor incluir un E-mail válido",email: "Por favor incluir un E-mail válido" },
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
             $("#FormUpdateProveedor").validate({
             	errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
                 rules: {
                     "UpTxtNombre": { required:true },
                     "UpTxtNit": { required:true }, 
                     "UpTxtContacto": { required:true }, 
                     "UpTxtCiudad": { required:true },
                     "UpTxtDir": { required:true }, 
                     // "UpTxtCelular": { required:true }, 
                     // "UpTxtWhp": { required:true }, 
                     // "UpTxtTel": { required:true }, 
                     "UpTxtCorreo": { required:true, email:true },  
                     "UpTxtTipoInsumo": { required:true }, 

                 },
                 messages: {
                     
                    	"TxtCorreo": { required:"Por favor incluir un E-mail válido",email: "Por favor incluir un E-mail válido" },
                 },

                 // submitHandler: function(form){
                 //     alert("Los datos son correctos");
                 // }

             });
        });
    </script>
		<script type="text/javascript">
        // based on prepared DOM, initialize echarts instanc

        var myChart = echarts.init(document.getElementById('grafica'));
        
        // specify chart configuration item and data
   option = {

   	
    title : {

        text: 'Pedidos Proveedores',
        subtext: 'Marzo',
        x:'center',
        fontFamily: "The time new Román",
    },

    tooltip : {
        trigger: 'item',
        // formatter: "{a} <br/>{b} : {c} ({d}%)",
        formatter: function (params) {
                    var value = (params.value + '').split('.');
                    value = value[0].replace(/(\d{1,3})(?=(?:\d{3})+(?!\d))/g, '$1,');
                    return params.seriesName + '<br/>' + params.name + ' :$ ' + value;
                }
    },

    legend: {
        orient: 'horizontal',
        //left: 'center',
        bottom: 10,
        left: 'center',
        data: ['Pago a Crédito','Pago Inmediato'],
        
    },

            calculable: true,
    series : [

        {
            name: 'Pedidos con',
            type: 'pie',
            radius : '65%',
            center: ['55%', '50%'],
            label: {
                normal: {
                    show: true,
                    position: 'inside',
                    formatter: "({d}%)",
                }
            },
            data:[
                {value:3351231, name:'Pago a Crédito'},
                {value:3101212, name:'Pago Inmediato'},
               
            ],
            itemStyle: {
                emphasis: {
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            }
        }

    ]
};

        // use configuration item and data specified to show chart
        myChart.setOption(option);

       
    </script>
		<!-- inline scripts related to this page -->
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
				$('.input-daterange').datepicker({
					autoclose:true,
					format: 'yyyy-mm-dd',

				});
			
			
				//to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
				$('input[name=date-range-picker]').daterangepicker({
					'applyClass' : 'btn-sm btn-success',
					'cancelClass' : 'btn-sm btn-default',
					locale: {
						applyLabel: 'Aplicar',
						cancelLabel: 'Cancelar',
					}
				})
				.prev().on(ace.click_event, function(){
					$(this).next().focus();
				});
			
			
				$('#timepicker1').timepicker({
					autoclose:true,
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
					
				 format: 'YYYY-MM-DD H:mm:ss',//use this option to display seconds
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
