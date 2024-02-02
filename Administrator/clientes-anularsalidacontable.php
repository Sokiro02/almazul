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


$NumeroFactura=$_GET['NumeroFactura'];

$MiVenta=$_GET['MiVenta'];

if ($MiVenta!='') { // Verificamos el Id de la Venta

// Consulta datos de la venta
$sql ="SELECT * FROM t_ventas as A, t_referencias as B WHERE Id_Venta='".$MiVenta."' and A.Referencia_Id_Referencia=B.Cod_Referencia"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Id_Venta=$row['Id_Venta'];
        $Cant_Solicitada=$row['Cant_Solicitada'];
        $Ref_Vendida=$row['Ref_Vendida'];
        $Valor_Final=$row['Valor_Final'];
        $Valor_Prenda=$row['Valor_Prenda'];
        $Tienda_Id_Tienda=$row['Tienda_Id_Tienda'];
        $Factura_Id_Factura=$row['Factura_Id_Factura'];
        $consecutivosc_id_consecutivosc=$row['consecutivosc_id_consecutivosc'];
    }
}

// Pasamos a negativo los valores
	$Valor_FinalNegativo=$Valor_Final*-1;
	$Valor_PrendaNegativo=$Valor_Prenda*-1;

// Actualizar Estado Anulado a la Venta
$SqlActualizar ="UPDATE t_ventas SET Estado_Anulado='1', Valor_Final='".$Valor_FinalNegativo."', Valor_Prenda='".$Valor_PrendaNegativo."' WHERE Id_Venta='".$MiVenta."'"; //ACTUALIZAMOS EL INVENTARIO
        $ResultActualizar = $conexion->query($SqlActualizar)or die (mysqli_error($conexion));

// Actualizar Inventario
 $SqlActualizar ="UPDATE t_inventario SET Cantidad=Cantidad+'".$Cant_Solicitada."' WHERE Id_Tienda='".$Tienda_Id_Tienda."' and Referencia_Completa='".$Ref_Vendida."'"; //ACTUALIZAMOS EL INVENTARIO
        $ResultActualizar = $conexion->query($SqlActualizar)or die (mysqli_error($conexion));


header("location:clientes-anularsalidacontable.php?Mensaje=111&NumeroFactura=".$consecutivosc_id_consecutivosc."");



}

$sql ="SELECT * FROM t_facturas as A, t_clientes as B, t_usuarios as C WHERE num_consecutivo_sc='".$NumeroFactura."' and A.Cliente_Id_Cliente=B.Id_Cliente and A.Usuario_Vendedor=C.Id_Usuario";
	//Echo($sql);
	$result = $conexion->query($sql);
	if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
	$Fecha_Factura=$row['Fecha_Factura'];                  
	$Num_Factura=$row['Num_Factura'];   
	$Cliente_Id_Cliente=$row['Cliente_Id_Cliente'];   
	$Usuario_Vendedor=$row['Usuario_Vendedor'];   
	$Tienda_Id_Tienda=$row['Tienda_Id_Tienda'];   
	$Nom_Vendedor=$row['Nombres'];   
	$Ape_Vendedor=$row['Apellidos'];   
	$Nom_Cliente=$row['Nom_Cliente'];   
	$Ape_Cliente=$row['Ape_Cliente'];
	$Img_PerfilVendedor=$row['Img_Perfil'];   
	$Total_Factura=$row['Total_Factura']; 
	$Factura_Paga=$row['Factura_Paga']; 

	$Observa_Factura=$row['Observa_Factura']; 
	$Fecha_Anula=$row['Fecha_Anula']; 

	if ($Factura_Paga==1) {
	  	$Pagode="Contado";
	  } 
	  elseif($Factura_Paga==2) {
	  	$Pagode="Crédito";
	  } 
	  else
	  {
	  	$Pagode="Anulada";
	  }
 }
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Anular Nota Entrega</title>

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
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/ImageSelect.css" />

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

<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/magnific-popup.css">
<script type="text/javascript">
	$(document).ready(function() {
  $('.image-link').magnificPopup({type:'image'});
});
</script>
    <script src="https://modasof.com/espejo/assets/js/chosen.jquery.js"></script>
<script src="https://modasof.com/espejo/assets/js/ImageSelect.jquery.js"></script>

    <?php include("Lib/Favicon.php") ?>
   

	</head>

	<body class="skin-1">

	<?php 
  $Valide=$_GET['Mensaje'];

    if ($Valide==21) {
        echo "<script>jQuery(function(){swal(\"¡Lo Sentimos!\", \"Datos Incorrectos\", \"error\");});</script>";
    };
    if ($Valide==1) {
        echo "<script>jQuery(function(){swal(\"¡ Insumo  Agregado!\", \"Correctamente \", \"success\");});</script>";
    };
     if ($Valide==2) {
        echo "<script>jQuery(function(){swal(\"¡ Insumo  Eliminado!\", \"Correctamente \", \"success\");});</script>";
    };
      if ($Valide==111) {
        echo "<script>jQuery(function(){swal(\"¡ Referencia Cargada a Inventario!\", \"Correctamente \", \"success\");});</script>";
    };
     if ($Valide==222) {
        echo "<script>jQuery(function(){swal(\"¡ Salida Anulada Correctamente!\", \"Correctamente \", \"success\");});</script>";
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
							<!-- <li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="index.php">Inicio</a>
							</li> -->
							
							<li>
								<i class="ace-icon fa fa-users"></i>
								<a href="Informe-salidacontable.php">Regresar</a>
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
<!-- Primer Fila  -->
<div class="col-sm-4 yellow">
	<div class="widget-box">
		<div class="widget-body">
			<div class="widget-main">
<h5>NOTA ENTREGA REALIZADA POR:</h5>
<h5><img style="width: 15%;height: 15%;" class="nav-user-photo" src="../Administrator/<?php Echo utf8_encode($Img_PerfilVendedor); ?>" alt="Jason's Photo" /> <?php Echo utf8_encode($Nom_Vendedor." ".$Ape_Vendedor); ?></h5>

			</div>
		</div>
	</div>
</div>
<div class="col-sm-4">
	<div class="widget-box">
		<div class="widget-body">
			<div class="widget-main">
<h5><i class="fa fa-user"></i>  Cliente:    <?php Echo utf8_encode($Nom_Cliente." ".$Ape_Cliente) ?> </h5>
<h5><i class="fa fa-dollar"></i> Nota Entrega Número: <?php Echo utf8_encode($Num_Factura) ?></h5>
<!-- <h5><i class="fa fa-phone"></i> <?php Echo utf8_encode($Qr_Cel1_Cliente."-".$Qr_Cel2_Cliente) ?></h5> -->
<h5><i class="fa fa-calendar"></i> Fecha Salida: <?php Echo (FechaSql($Fecha_Factura)) ?> </h5>
<h5><i class="fa fa-money"></i> Pago de: <?php Echo htmlentities($Pagode) ?> </h5>

			</div>
		</div>
	</div>
</div>
<div class="col-sm-4 center">
	<h5>Nota Entrega Número: <?php Echo utf8_encode($Num_Factura) ?></h5>
	<span><?php Echo($Pagode); ?></span>

								
<div class="infobox infobox-green">
	<div class="infobox-icon">
		<i class="ace-icon fa fa-dollar"></i>
	</div>

	<div class="infobox-data">
		<span class="infobox-data-number"><?php Formatomoneda($Total_Factura); ?></span>
		<div class="infobox-content">Total Salida</div>
	</div>
	

</div>
</div>
<!-- Fin de Primer Fila -->
							
							<div class="col-sm-12 col-xs-12">
				<form action="AnularFactura.php" method="post" id="FormAnular">
							<!-- INICIO TABLA -->
						<div class="clearfix">
							<h3 class="center">1. Regrese todas las prendas relacionadas a esta nota entrega al inventario </h3>
											<h3 class="center">2. Agregue el causal de la Anulación </h3>
											<h3 class="center">3. Guardar Movimiento en Nota Entrega </h3>
											<!-- <div class="pull-left tableTools-container"></div> -->
										</div>
										<div class="table-header">
											Detalle de Nota Entrega Nº: <?php Echo($Num_Factura); ?>
										</div>
										
										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
							<table style="font-size: 12px;" id="dynamic-table2"  class="table table-responsive table-striped table-bordered table-hover" width="100%">
												<thead>
													<tr class="warning">
														<th class="tdcustom" style="width: 5%;">Registro Nº</th>
														<th class="tdcustom" style="width: 5%;">Foto Ref</th>
														<th class="tdcustom" style="width: 5%;">Referencia</th>
														<th class="tdcustom" style="width: 5%;">Cantidad</th>
														<th class="tdcustom" style="width: 5%;">Valor Prenda</th>
														<th class="tdcustom" style="width: 5%;">Valor Vendido</th>
														<th class="tdcustom" style="width: 5%;">Descuento</th>
														<th class="tdcustom" style="width: 5%;">Selecionar</th>
													</tr>
													
												</thead>

												<tbody>
<?php 

	$sql ="SELECT * FROM t_ventas as A, t_referencias as B WHERE consecutivosc_id_consecutivosc='".$NumeroFactura."' and A.Referencia_Id_Referencia=B.Cod_Referencia"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Id_Venta=$row['Id_Venta'];
        $Cant_Solicitada=$row['Cant_Solicitada'];
        $Talla_Solicitada=$row['Talla_Solicitada'];
        $Tienda_Id_Tienda=$row['Tienda_Id_Tienda'];
        $Referencia_Id_Referencia=$row['Referencia_Id_Referencia'];
        $Ref_Vendida=$row['Ref_Vendida'];
        $Valor_Final=$row['Valor_Final'];
        $Valor_Prenda=$row['Valor_Prenda'];
        $Img_Referencia=$row['Img_Referencia'];
        $Estado_Anulado=$row['Estado_Anulado'];

        $TotalDescuento=$Valor_Prenda-$Valor_Final;
        $CalculoDescuento=1-($Valor_Final/$Valor_Prenda);
		$VrDescuento=$CalculoDescuento*100;
			?>

													<tr>
														<td>
															<?php echo utf8_encode($Id_Venta); ?>
														</td>
														<td>
														<a class="image-link" href="<?php echo utf8_encode($Img_Referencia); ?>"><img src="<?php echo utf8_encode($Img_Referencia); ?>" width="45px" height="45px"></a>
														</td>
														<td>
															<?php echo utf8_encode($Ref_Vendida); ?>
														</td>
														<td>
															<?php echo utf8_encode($Cant_Solicitada); ?>
														</td>
														<td>
															<?php echo utf8_encode(Formatomoneda($Valor_Prenda)); ?>
														</td>
														<td>
															<?php echo utf8_encode(Formatomoneda($Valor_Final)); ?>
														</td>
														<td>
															<?php echo utf8_encode(Formatomoneda($TotalDescuento)); ?>
														</td>
														
														

														

														<td>
														<?php 
														if ($Estado_Anulado==0) {
															?>
															<a style="position: relative;" data-rel="tooltip" data-placement="top" title="Cargar a Inventario"  href="clientes-anularsalidacontable.php?NumeroFactura=<?php Echo($NumeroFactura) ?>&MiVenta=<?php Echo($Id_Venta) ?>"><i class="fa fa-close red "></i> Regresar a Inventario</a>
															<?php
														}
														else
														{
															?>
															<a style="position: relative;" data-rel="tooltip" data-placement="top" title="Venta Anulada"  href="#"><i class="fa fa-check green "></i> Venta Anulada </a>

															<?php
														}



														 ?>
															
														</td>
													</tr>

													<?php 
													}
}
													 ?>
												</tbody>
											</table>
											
										</div>
										<div>

		<input style="display: none;" type="text" name="FacturaNumero" value="<?php Echo($NumeroFactura) ?>">
        <textarea  class="autosize-transition form-control col-sm-12 col-xs-12" name="TxtDetalle" id="form-field-9" rows="5" maxlength="2000" placeholder="Indicar causal de anulación de la nota entrega"><?php Echo($Observa_Factura."Nota entrega anulada el día:".$Fecha_Anula) ?></textarea>
       
											
											
										</div>
<?php 
	if ($Factura_Paga!=3) {
		?>
		<div class="center">
											<button class="btn btn-success ">
        	Guardar Movimiento en Nota Entrega
        </button>
										</div>
		<?php
	}
 ?>

										
					
						<!-- FIN TABLA -->
						</form>
					</div>



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
<script src="https://modasof.com/espejo/assets/js/dataTables.responsive.min.js"></script>
		<script type="text/javascript">
        $(document).ready(function()
        {
             $("#FormAnular").validate({
             	errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
                 rules: {
                     "TxtDetalle": { required:true },
                    
                 },
                 // messages: {
                 //     "txtNombre": { required:"Debes incluir al menos un Usuario",},   
                 // },

                 // submitHandler: function(form){
                 //     alert("Los datos son correctos");
                 // }

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