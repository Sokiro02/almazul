<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];
include("Lib/permisos.php");
 $MyIdTienda=$_SESSION['IdTienda'];
 $MiTienda=$_SESSION['nicktienda'];
date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');
$FechaActual = date('Y-m-d');
//print_r(session_get_cookie_params());



$PagoTemporal=$_GET['PagoTemporal'];

if ($PagoTemporal!="") {
  $sql="DELETE FROM ingreso_temporal_usuario  WHERE Id_Ingreso_Tempora='".$PagoTemporal."'";
  $result=$conexion->query($sql);
  header("index-ventas.php");
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Modasof</title>

		<meta name="description" content="Common form elements and layouts" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		 <!-- Notificaciones Push -->
		<script src="https://modasof.com/espejo/assets/js/push.min.js"></script>
		

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		 <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/chosen.min.css" />
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/bootstrap-datepicker3.min.css" />
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/bootstrap-timepicker.min.css" />
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/daterangepicker.min.css" />
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/bootstrap-datetimepicker.min.css" />
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/bootstrap-colorpicker.min.css" />
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/tinycircleslider.css" type="text/css" media="screen"/>

		<!-- text fonts -->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/fonts.googleapis.com.css" />
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/AdminLTE.css">
		
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
 

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

    <!-- Inicio Libreria formato moneda -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
<script src="https://modasof.com/espejo/assets/js/jquery.maskMoney.js" type="text/javascript"></script>



    <link rel="stylesheet" href="https://modasof.com/espejo/assets/css/magnific-popup.css">
<script type="text/javascript">
	$(document).ready(function() {
  $('.image-link').magnificPopup({type:'image'});
});
</script>

<script>
$(document).ready(function(){
   $("#TxtClientes").change(function () {
           $("#TxtClientes option:selected").each(function () {
            Select1 = $(this).val();
            //var Select2 = $("#TxtCantidad option:selected").val();
            //alert(Select1)
            $.post("SelectCliente.php", { Select1: Select1}, function(data){
                $("#info").html(data); 
            });            
        });
   })
});
</script>

<script type="text/javascript">
$(document).ready(function(){
$("#TxtDocumento").keyup(function(){ //se crea la funcioin keyup
var texto = $(this).val();//se recupera el valor de la caja de texto y se guarda en la variable texto
var dataString = 'ValNuevoCliente='+ texto;//se guarda en una variable nueva para posteriormente pasarla a busqueda.php

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


    <?php include("Lib/Favicon.php") ?>

    <style type="text/css">
#nuevoboton{
  /* background: #0288d1;
    background: -webkit-linear-gradient(45deg, #0288d1 0%, #26c6da 100%);
    background: linear-gradient(45deg, #0288d1 0%, #26c6da 100%);*/
background: #8e24aa;
    background: -webkit-linear-gradient(45deg, #8e24aa 0%, #ff6e40 100%);
    background: linear-gradient(45deg, #8e24aa 0%, #ff6e40 100%);
    color: #FFFFFF !important;
}

    </style>
   <!--  <style>
@keyframes rotate {from {transform: rotate(0deg);}
    to {transform: rotate(360deg);}}
@-webkit-keyframes rotate {from {-webkit-transform: rotate(0deg);}
  to {-webkit-transform: rotate(360deg);}}
.imgr{
    -webkit-animation: 2s rotate linear infinite;
    animation: 2s rotate linear infinite;
    -webkit-transform-origin: 50% 50%;
    transform-origin: 50% 50%;
}
/*#imgr2 {
     -webkit-animation-direction: reverse;
     animation-direction: reverse;
}*/
</style> -->
<!-- build:js jquery.tinycircleslider.js -->
	

	</head>

	<body class="skin-1">

	<?php 
  $Valide=$_GET['Mensaje'];

    if ($Valide==2) {
        echo "<script>jQuery(function(){swal(\"¡Lo Sentimos!\", \"Datos Incorrectos\", \"error\");});</script>";
    };
     if ($Valide==555) {
        echo "<script>jQuery(function(){swal(\"¡Lo Sentimos!\", \"Datos Incompletos\", \"error\");});</script>";
    };
     if ($Valide==556) {
        echo "<script>jQuery(function(){swal(\"¡Lo Sentimos no cargo algún valor al Recibo!\", \"Datos Incompletos\", \"error\");});</script>";
    };
    if ($Valide==1) {
        echo "<script>jQuery(function(){swal(\"¡ Cliente Creado!\", \"Correctamente \", \"success\");});</script>";
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
							
						<!-- 	<div class="col-sm-12">
							<a  href="panel-produccion.php">
							<div class="infobox" id="nuevoboton">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-industry"></i>
											</div>

											<div class="infobox-data" >
												<span class="infobox-data-number">Área Producción</span>
												
											</div>

											
							</div>
							</a>
							<a  href="producto-crear.php">
							<div class="infobox " id="nuevoboton">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-magic"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number">Diseño</span>
							</div>
							</div>
						</a>
							<a href="Compras.php">
							<div class="infobox" id="nuevoboton">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-cart-arrow-down"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number"> Ventas</span>
											</div>
							</div>
							</a>
						<a href="">
							<div class="infobox" id="nuevoboton">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-industry"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number">4. PRODUCCIÓN</span>				
							</div>
											
							</div>
						</a>
						<hr>
						

							</div> -->
	 <!-- Generator: Jssor Slider Maker -->
    <!-- Source: https://www.jssor.com -->
    <script src="https://modasof.com/espejo/assets/js/jssor.slider-25.2.0.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        jssor_1_slider_init = function() {

            var jssor_1_options = {
              $AutoPlay: 1,
              $Idle: 0,
              $SlideDuration: 2500,
              $SlideEasing: $Jease$.$Linear,
              $PauseOnHover: 4,
              $SlideWidth: 300,
              $Cols: 4
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*#region responsive code begin*/
            /*remove responsive code if you don't want the slider scales while window resizing*/
            function ScaleSlider() {
                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 1280);
                    jssor_1_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            //$Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            /*#endregion responsive code end*/
        };
    </script>

						</div>
						<!-- Fin botones de acceso rápido -->
<!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="row">
        <div class="col-md-2 col-sm-6 col-xs-12">
          <div class="info-box">
            <a href="gastos-tienda.php"><span class="info-box-icon bg-aqua"><i class="fa fa-sign-out"></i></span></a>

            <div class="info-box-content">
              <a href="gastos-tienda.php"><span class="info-box-text">Gastos</span></a>
              <?php $ValorGastos=SumaGastosDiaTienda($MyIdTienda); ?>
              <span class="info-box-number"><?php Echo(formatomoneda($ValorGastos)) ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-2 col-sm-6 col-xs-12">
          <div class="info-box">
            <a href="egresos-tienda.php"><span class="info-box-icon bg-red"><i class="fa fa-sign-out"></i></span></a>

            <div class="info-box-content">
              <a href="egresos-tienda.php"><span class="info-box-text">Egresos</span></a>
              <?php $ValorEgresos=SumaEgresosDiaTienda($MyIdTienda); ?>
              <span class="info-box-number"><?php Echo(formatomoneda($ValorEgresos)); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <a href="CrearVenta.php"><span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span></a>

            <div class="info-box-content">
              <a href="CrearVenta.php"><span class="info-box-text">Crear Venta</span></a>
              <span class="info-box-number"><?php Echo(formatomoneda(TotalFacturado($MyIdTienda))) ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-2 col-sm-6 col-xs-12">
          <div class="info-box">
      <a href="CrearRemisionTienda.php"><span class="info-box-icon bg-yellow"><i class="fa fa-sign-out"></i></span></a>

            <div class="info-box-content">
              <a href="CrearRemisionTienda.php"><span class="info-box-text">Remisión</span></a>
              <span class="info-box-number">$0</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
         <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
      <a href="CrearPlanSepare.php"><span class="info-box-icon bg-yellow"><i class="fa fa-sign-out"></i></span></a>

            <div class="info-box-content">
              <a href="CrearPlanSepare.php"><span class="info-box-text">Plan Separe</span></a>
              <span class="info-box-number">$0</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
       
       
      </div>
      <!-- /.row -->


						<div class="col-sm-8 col-xs-12"><!-- Panel 2  -->
						<div class="clearfix">
							<div class="widget-body">
								<h4 class="widget-title lighter">
													<i class="ace-icon fa fa-search blue"></i>
												Consultar entrega de pedidos por rango de fecha
											
													
												</h4>
													
														
														
														

														<div class="row">
															<form action="index-ventas.php" method="post" id="FormFechas" autocomplete="off">
																
																
															<div class="col-xs-12 col-sm-6">
																<div class="input-daterange input-group">
																	<input type="text" class="input-sm form-control" name="start" />
																	<span class="input-group-addon">
																		<i class="fa fa-exchange"></i>
																	</span>
																	<input type="text" class="input-sm form-control" name="end" />
																</div>
																
															</div>
															
															<div class="form-group">
										
										<div class="col-xs-12 col-sm-6">
											<button class="btn btn-primary btn-sm" type="Submit">Realizar Consulta</button>
												
					</div>
						
				</div>

														
															
															</form>
														</div>
														
													
							</div>
							<hr>
											<!-- <div class="pull-left tableTools-container"></div> -->
										</div>
										<div class="table-header" style="background-color: #000;">
<?php 

date_default_timezone_set("America/Bogota");
$MarcaTemporal = date('Y-m-d');
$FechaInicioDia=($MarcaTemporal." 00:00:000");
$FechaFinalDia=($MarcaTemporal." 23:59:000");


$FechaUno=$_POST['start'];
$FechaDos=$_POST['end'];
// Validación de la fecha en que inicia el Día

							if ($FechaUno=="") {
								$FechaStart=$FechaInicioDia;
							}
							else
							{
								$FechaStart=($FechaUno." 00:00:000");
							}
// Validación de la fecha en que Termina el Día
							if ($FechaDos=="") {
								$FechaEnd=$FechaFinalDia;
							}
							else
							{
								$FechaEnd=($FechaDos." 23:59:000");
							}

							 ?>
											Entrega de pedidos 
											<?php 
												if ($FechaUno=="") {
												 	 Echo(fechasql($FechaActual));
												}
												else
												{
													Echo("Pedidos del ".fechaSql($FechaUno)." al ".fechaSql($FechaDos));
												}
												 ?> 
										</div>
										
										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
<?php 

// ************** Arreglo Total Insumos ***************//
$sql ="SELECT Id_Pedido FROM t_pedido WHERE Tienda_Id_Tienda='".$MyIdTienda."' and Fecha_Entrega >='".$FechaStart."' and Fecha_Entrega <='".$FechaEnd."'  order by Id_Pedido  DESC";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$Lista=$Lista.$row['Id_Pedido'].",";                  
 }
}
$Cadena=explode(",", $Lista);
//Split al Arreglo
$longitud = count($Cadena);
$min=$longitud-1;
// ************** Arreglo Total Insumos ***************//
 ?>
									<table style="font-size: 12px;" id="dynamic-table"  class="table table-responsive table-striped table-bordered table-hover" width="100%">
									 <tfoot style="display: table-header-group;">
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
														
														<th class="tdcustom" style="width: 5%;">Pedido Nº</th>
														<th class="tdcustom" style="width: 5%;">Estado</th>
														<th class="tdcustom" style="width: 5%;">Entregar el</th>
														<th class="tdcustom" style="width: 10%;">Cliente</th>
														<th class="tdcustom" style="width: 20%;">Detalle</th>
														<th class="tdcustom" style="width: 20%;">Valor Pedido</th>
														<th class="tdcustom" style="width: 20%;">Abonos</th>
														<th class="tdcustom" style="width: 20%;">Saldo</th>
														
													</tr>
													<tr>
														
														<th class="tdcustom" style="width: 5%;">Pedido Nº</th>
														<th class="tdcustom" style="width: 5%;">Estado</th>
														<th class="tdcustom" style="width: 5%;">Entregar el</th>
														<th class="tdcustom" style="width: 10%;">Cliente</th>
														<th class="tdcustom" style="width: 20%;">Detalle</th>
														<th class="tdcustom" style="width: 20%;">Valor Pedido</th>
														<th class="tdcustom" style="width: 20%;">Abonos</th>
														<th class="tdcustom" style="width: 20%;">Saldo</th>
														
													</tr>
												</thead>

												<tbody>
<?php 
for($i=0; $i<$min; $i++)
{
$sql ="SELECT date_format(Fecha_Pedido,CONCAT(CONCAT(ELT(WEEKDAY(Fecha_Pedido) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(Fecha_Pedido), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS FechaPedido,date_format(Fecha_Entrega,CONCAT(CONCAT(ELT(WEEKDAY(Fecha_Entrega) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(Fecha_Entrega), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS FechaEntrega, Id_Pedido, Cod_Pedido, Cliente_Id_Cliente, Fecha_Pedido, Total_Pedido, Descuento, Estado_Pedido, Saldo_Abonado, Pedido_Id_Usuario, Fecha_Entrega, Tienda_Id_Tienda, B.Nombres,B.Apellidos,B.Img_perfil,C.Nom_Cliente,C.Ape_Cliente,C.Avatar_Cliente FROM t_pedido as A, t_usuarios as B, t_clientes as C WHERE Id_Pedido='".$Cadena[$i]."' and A.Pedido_Id_Usuario=B.Id_Usuario and A.Cliente_Id_Cliente=C.Id_Cliente "; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $FechaPedido=$row['FechaPedido'];
        $FechaEntrega=$row['FechaEntrega'];
        $Id_Pedido=$row['Id_Pedido'];
        $Cod_Pedido=$row['Cod_Pedido'];
        $Cliente_Id_Cliente=$row['Cliente_Id_Cliente'];
        $Fecha_Pedido=$row['Fecha_Pedido'];
        $Total_Pedido=$row['Total_Pedido'];
        $Descuento=$row['Descuento'];
        $Estado_Pedido=$row['Estado_Pedido'];
        $Saldo_Abonado=$row['Saldo_Abonado'];
        $Fecha_Entrega=$row['Fecha_Entrega'];
        $Pedido_Id_Usuario=$row['Pedido_Id_Usuario'];
        $Nombres=$row['Nombres'];
        $Apellidos=$row['Apellidos'];
        $AvatarVendedor=$row['Img_perfil'];
        $AvatarCliente=$row['Avatar_Cliente'];
        $Nom_Cliente=$row['Nom_Cliente'];
        $Ape_Cliente=$row['Ape_Cliente'];

        $CalculoAbono=1-($Saldo_Abonado/$Total_Pedido);
        $PorcentajeAbonado=$CalculoAbono*100;
        $Saldo_Pendiente=$Total_Pedido-$Saldo_Abonado;
        $dateSol = new DateTime($Fecha_Pedido);

        $HoraSol=$dateSol->format('H:i:s a');
        $FechaSol=$dateSol->format('Y-m-d');




	}
}

													 ?>
													 <?php 

														
					
						$DiasTotales=dias_transcurridos($FechaSol,$Fecha_Entrega);
										

															$DiasTranscurridos=dias_transcurridos($FechaSol,$FechaActual);
															$DiasPasados=dias_transcurridos($FechaActual,$Fecha_Entrega);
															if ($DiasTotales!=0) {
											$CalculoDias=$DiasPasados/$DiasTotales;
										}
										else{
											$CalculoDias=0;
										}
															$PorcentajeDias=round($CalculoDias*100,1);
															//Echo ("Dias pedido".$DiasTotales."<br> han pasado:".$DiasPasados); 

															?>

														<tr>
														
														
														<td>
			<a data-rel="tooltip" data-placement="top" title="Detalles Pedido" href="Pedido-Ver.php?PedidoCliente=<?php Echo($Cod_Pedido); ?>">
															PDC<?php echo utf8_encode($Cod_Pedido); ?>	

															</a>
														</td>
														<td>
															<?php 
    $sql ="SELECT `Id_Estado_Pedido`,Nom_Estado_Pedido, `Color_Estado`, `Desc_Estado`, `Rol_Id_Rol` FROM `t_estado_pedidos` WHERE Id_Estado_Pedido='".$Estado_Pedido."'"; 
    //Echo($sql); 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    $Id_Estado_Pedido=$row['Id_Estado_Pedido'];
    $Nom_Estado_Pedido=$row['Nom_Estado_Pedido'];
    $Color_Estado=$row['Color_Estado'];
      Echo("<span class='label' style='background-color:".$Color_Estado."'>".htmlentities($Nom_Estado_Pedido)."</span> <span class='action-icons'></span>");
      }
    }
            ?>
														</td>
														<td>
															<?php Echo($FechaEntrega); ?>
														</td>
														
														
														
														<td class="tdcustom">
															<?php Echo strtoupper(utf8_encode($Nom_Cliente." ".$Ape_Cliente)) ?>	
														</td>
														
														<td>
															<?php 
    $sql ="SELECT F.Img_Referencia, Estado_Solicitud_Cliente FROM t_temporal_sol AS A, t_usuarios as B, t_bodegas as C, t_tallas as D, t_tiendas as E,t_referencias as F WHERE  A.Vendedor_Id_Usuario=B.Id_Usuario and A.Bodega_Id_Bodega=C.Id_Bodega and A.Talla_Solicitada=D.Id_Talla and A.Tienda_Id_Tienda=E.Id_Tienda and A.Referencia_Id_Referencia=F.Cod_Referencia  and Pedido_Id_Pedido='".$Cod_Pedido."'   ORDER BY UNIX_TIMESTAMP(Fecha_Solicitud) DESC"; 
    //Echo($sql); 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
   
    $Img_Referencia=$row['Img_Referencia']; 

     $Estado_Solicitud_Cliente=$row['Estado_Solicitud_Cliente'];


    if ($Estado_Solicitud_Cliente==1) {
      $NomEstado="Lista de Espera";
    }
    elseif ($Estado_Solicitud_Cliente==2) {
      $NomEstado="Producción";
    }
    elseif ($Estado_Solicitud_Cliente==3) {
      $NomEstado="Acabados";
    }
     elseif ($Estado_Solicitud_Cliente==5) {
      $NomEstado="Solicitado a Proveedor";
    }
    elseif ($Estado_Solicitud_Cliente==4) {
      $NomEstado="C. Distribución";
    }
    elseif ($Estado_Solicitud_Cliente==10) {
      $NomEstado="Enviado";
    }
     ?>
     

   <a style="position: relative;" data-rel="tooltip" data-placement="top" title="<?php Echo htmlentities($Nom_Estado_Pedido);?>" class="image-link" href="<?php echo utf8_encode($Img_Referencia); ?>"><img src="<?php echo utf8_encode($Img_Referencia); ?>" width="45px" height="45px" >
    	
    	<?php 
    	if ($Estado_Solicitud_Cliente<=5) {
    		?>
    		<div style="position: absolute; left: 10px; top: 2px;"><i class="fa  fa-times red fa-2x"></i></div>
    		<?php
    	}
    	else
    	{
    		?>
    		<div style="position: absolute; left: 10px; top: 2px;"><i class="fa  fa-check green fa-2x"></i></div>
    		<?php
    	}

    	 ?>

    	
    </a>

    	
    </a>

     <?php 
 }
}
      ?>
														</td>
														
													
														
														
															<td class="center">
															<?php Echo utf8_encode("$ ".number_format($Total_Pedido));  ?>
														</td>
														<td class="center">
			
															<?php Echo utf8_encode("$ ".number_format($Saldo_Abonado));  ?>
														</td>
													
														<!-- <td class="center">
															<span class="badge bg-red">
																<?php echo (round($PorcentajeAbonado,0)); ?>%
															</span>
														</td> -->
														<td class="center">
															<?php Echo utf8_encode("$ ".number_format($Saldo_Pendiente));  ?>
														</td>
														
														

														
													
													</tr>
													<?php 
													
}
													 ?>
												</tbody>
											</table>
										</div>
						</div> <!-- Fin Panel 2 -->

						<div class="col-sm-4 col-xs-12"><!-- Inicio Panel Derecho -->
		<!-- <div class="col-md-12 col-sm-12 col-xs-12 center">
        	<a style="color:black;" href="CrearVenta.php"><h1>Registrar Venta <img style="width: 150px;height: 80px;" src="../administrator/images/Logos/logo-blanco.png"></h1></a>
        </div> -->

        <hr>
       
       
         <div class="col-md-12 col-xs-12">
        <!--  <a href="gastos-tienda.php"><h3><i class="fa fa-sign-out fa-1x"></i> Registrar Gasto</h3></a>
         <a href="egresos-tienda.php"><h3><i class="fa fa-sign-out fa-1x"></i> Registrar Egreso Caja</h3></a>
         <a href="CajaTienda.php"><h3><i class="fa fa-archive fa-1x"></i> Auditar Caja</h3></a>
         <a href="CrearRemisionTienda.php"><h3><i class="fa fa-archive fa-1x"></i> Registrar Remisión</h3></a> -->
        </div>
         <?php

 $sql ="SELECT Consecutivo_ReciboCaja FROM t_config_tienda WHERE Tienda_Id_Tienda='".$MyIdTienda."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Consecutivo_ReciboCaja=$row['Consecutivo_ReciboCaja']+1;
    }
  }
                                     ?>
        <h3 class="m-b-0 text-white">CREAR ANTICIPO  ORDEN CORTE<br><small><strong>Vendedor: <?php Echo utf8_encode($NomSesion) ?></strong></small> </h3>

                                                         

            <form action="GuardarIngresoAnticipo.php" method="post" id="FormPago" autocomplete="off" >
                                <table class="table product-overview">
                                  <tr>
                                   
                                   
                                  <td>
                                     <input class=" nav-search-input input-sm" type="text"  id="demo1" placeholder="$ 0" name="demo1"  required="true" />
                         
                               
                                <script type="text/javascript">     
$("#demo1").maskMoney({
prefix:'$ ', // The symbol to be displayed before the value entered by the user
allowZero:false, // Prevent users from inputing zero
allowNegative:false, // Prevent users from inputing negative values
defaultZero:true, // when the user enters the field, it sets a default mask using zero
thousands: '.', // The thousands separator
decimal: '.' , // The decimal separator
precision: 0, // How many decimal places are allowed
affixesStay : true, // set if the symbol will stay in the field after the user exits the field. 
symbolPosition : 'left' // use this setting to position the symbol at the left or right side of the value. default 'left'
}); //
    </script>
                                  </td>
                               
                                   <td>
                                     <select name="TxtMedioPago" id="TxtMedioPago">
                                      <option value="">Seleccionar</option>
                                       <?php 
    $sql ="SELECT Id_Medio_Pago, Nom_MedioPago FROM t_medios_pago Where Estado_MedioPago='1' order by Id_Medio_Pago ASC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Id_Medio_Pago=$row['Id_Medio_Pago'];
      $Nom_MedioPago=$row['Nom_MedioPago'];
      Echo("<option value='".$Id_Medio_Pago."'>".$Nom_MedioPago."</option>");
    }
  }
                                       ?>
                                    </select>


                                     <script type="text/javascript">
   $('#TxtMedioPago').change(function(){
    var valorCambiado =$(this).val();
    if((valorCambiado == '2')||(valorCambiado == '3')||(valorCambiado == '4')||(valorCambiado == '6')){
     
       $('#Confirmacion').css('display','');
     }
     else if(valorCambiado == '1')
     {
          $('#Confirmacion').css('display','none');
     }
});
    </script>

                                  </td>

                                   <td>
                                    <button class="btn btn-success btn-sm green">
                                      <i class="fa fa-plus-square"></i>
                                    </button>
                                    
                                  </td>
                                 
                                  </tr>
                                  <tr id="Confirmacion" style="display: none;">
                                    <td>Confirmación</td>
                                    <td>
                                       <input type=""  name="TxtVoucher" placeholder="Nº Confirmación">
                                    </td>
                                  </tr>
                                </table>
                                </form>  
                                 <hr>
                                  <table class="table product-overview">
                                  <thead>
                                  <th class="info" style="width: 30%"></th>
                                  <th class="pull-rigth info" style="width: 40%" >Medio de Pago</th>
                                  <th class="pull-rigth info" style="width: 30%">Valor</th>
                                  </thead>

                                  <?php 
                                  $sql ="SELECT Id_Ingreso_Tempora, Tipo_Pago_Temporal, Valor_Pago_Temporal, Voucher, Usuario_Ingreso,Nom_MedioPago FROM ingreso_temporal_usuario as A, t_medios_pago as B WHERE Usuario_Ingreso='".$IdUser."' and Pago_De='Anticipo' and A.Tipo_Pago_Temporal=B.Id_Medio_Pago";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Id_Ingreso_Tempora=$row['Id_Ingreso_Tempora'];
      $Tipo_Pago_Temporal=$row['Tipo_Pago_Temporal'];
      $Valor_Pago_Temporal=$row['Valor_Pago_Temporal'];
      $Voucher=$row['Voucher'];
      $PagoRealizado=$row['Nom_MedioPago'];

                                   ?>
                                 <tr >
                                    <td><a class="red" href="index-ventas.php?PagoTemporal=<?php Echo($Id_Ingreso_Tempora) ?>">Eliminar</a></td>
                                    <td>
                                      <?php Echo($PagoRealizado); ?>
                                        <?php 
                                        if ($Voucher!="") {
                                          Echo("(".$Voucher.")");
                                        }
                                         ?>
                                      </td>
                                     <td style="text-align: right;">
                                       <?php Echo(formatomoneda($Valor_Pago_Temporal)) ;?>
                                     </td>
                                  </tr>
                                  <?php 

                                }
                              }
                              else {
                                   ?>


                                  <tr>
                                    <td style="text-align: center;" colspan="3"><strong>Indique el valor y seleccione el medio de pago <i class="fa fa-caret-up red"></i></strong></td>
                                  </tr>
                                  <?php 
                                  }
                                   ?>
                                  
                                    <?php 
                $sql ="SELECT SUM(Valor_Pago_Temporal) as SumaPagos FROM ingreso_temporal_usuario WHERE Usuario_Ingreso='".$IdUser."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $SumaPagos=$row['SumaPagos'];
 }
}
                 ?>

                                   <tr class="pull-rigth success">
                                    <td style="text-align: right;" colspan="2"><strong>Total Pago:</strong></td>
                                    <td style="text-align: right;"><strong><?php Echo(formatomoneda($SumaPagos)); ?></strong></td>
                                  </tr>
                                 
                                
                                </table>
                                <form method="post" action="guardarReciboCaja.php" id="FormGuardarventa">
<input style="display: none;" type="text" name="VentaTienda" value="<?php Echo($MyIdTienda);?>">
 <?php 

 // Detalle pagos la Factura
$sql ="SELECT Id_Ingreso_Tempora,Valor_Pago_Temporal,Tipo_Pago_Temporal,Voucher FROM ingreso_temporal_usuario WHERE Usuario_Ingreso='".$IdUser."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Id_Ingreso_Tempora=$row['Id_Ingreso_Tempora'];
      $MontoPago=$row['Valor_Pago_Temporal'];
      $TipoPago=$row['Tipo_Pago_Temporal'];
      $Voucher=$row['Voucher'];
      ?>
      
      <input style="display: none;" type="text" name="TxtIdPago[]" value="<?php Echo($Id_Ingreso_Tempora);?>">
      <input style="display: none;" type="text" name="TxtValorPago[]" value="<?php Echo($MontoPago);?>">
      <input style="display: none;" type="text" name="TxtTipoPago[]" value="<?php Echo($TipoPago);?>">
      <input style="display: none;" type="text" name="TxtVoucherPago[]" value="<?php Echo($Voucher);?>">
      <input style="display: none;" type="text" name="TxtSumaPagos" value="<?php Echo($SumaPagos);?>">
      <?php
    }
  }
  else
  {
  	?>
  	 <input style="display: none;" type="text" name="TxtVerificaValor" value="1">
  	<?php
  }
// Detalle venta Factura

  
// Valor Factura
 $sql ="SELECT Consecutivo_ReciboCaja FROM t_config_tienda WHERE Tienda_Id_Tienda='".$MyIdTienda."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Consecutivo_ReciboCaja=$row['Consecutivo_ReciboCaja']+1;
      ?>
      <input style="display: none;" type="text" name="ReciboCajaAnticipo" value="<?php Echo($Consecutivo_ReciboCaja);?>">
      <?php
    }
  }

?>
                          <h4 class="card-title">Seleccionar Cliente</h4> 
                                <select required="true" class="chosen-select input-xxlarge" name="TxtClientes" id="TxtClientes" data-placeholder="Seleccionar...">
                            <option value="">Empiece a digitar el documento </option>
                  <?php
$sql ="SELECT Id_Cliente,Documento_Cliente, Nom_Cliente,Ape_Cliente FROM t_clientes  order by Nom_Cliente ASC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $SelectId_Cliente=$row['Id_Cliente'];
      $SelectDocumento_Cliente=$row['Documento_Cliente'];  
       $Nom_Cliente=$row['Nom_Cliente'];  
        $Ape_Cliente=$row['Ape_Cliente'];             
      echo ("<option value='".$SelectId_Cliente."'>".utf8_encode($SelectDocumento_Cliente." - ".$Nom_Cliente." ".$Ape_Cliente)."</option>");
 }
}
        
?>      
                                  
                        </select>
                                o
                                <br>
                                  <a  data-toggle="modal" data-target="#modal-form2" href="#"><span class="btn  btn-success btn-xs"><i class="fa fa-plus-square"> </i> Crear Nuevo Cliente</span></a>
                                <table id="info" class="table product-overview">
                                 
                                </table>

                               <hr>
                                 <button type="submit" class="btn btn-danger btn-outline"><i class="fa fa-print"> </i> Imprimir Recibo de Caja</button>
                                 </form>
                            
    
         
         
       
        <!-- /.col -->


						</div><!-- Fin Panel Derecho -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->



<!-- Inicio Modal -->
		<div id="modal-form2" class="modal" tabindex="-1">
							 <!-- Inicio Modal -->
    <div>
     
              <form action="Cliente-Crear.php?ForVenta=5" method="post" id="FormNuevoCliente" autocomplete="off">
                  <div class="modal-dialog ">
                    <div class="modal-content">
                      <div class="modal-header">
                        <a href="CrearVenta.php" type="button" class="close" data-dismiss="modal">&times;</a>
                        <h4 class="black bigger">Nuevo Cliente</h4>
                      </div>

                      <div class="modal-body">
                        <div class="row">
                          <div class="col-xs-12 col-sm-6 ">
                             <div class="form-group">
                              <label for="form-field-select-3">Documento Cliente</label>

                              <div class="input-group">
                                <span class="input-group-addon">
                                  <i class="ace-icon fa fa-bank"></i>
                                </span>
                        <input type="number" name="TxtDocumento" id="TxtDocumento" class="input-large" placeholder="Documento" style="text-transform:uppercase;">
                              </div>
                            
                            </div>
                            <div id="MsjError"></div>
                            <div class="form-group">
                              <label for="form-field-select-3">Nombres</label>

                              <div class="input-group">
                                <span class="input-group-addon">
                                  <i class="ace-icon fa fa-user"></i>
                                </span>
                        <input type="text" autocomplete="off" name="TxtNombre" id="TxtNombre" class="input-large" placeholder="Nombre del Cliente" style="text-transform:uppercase;">
                              </div>
                            
                            </div>
                             <div class="form-group">
                              <label for="form-field-select-3">Apellidos</label>

                              <div class="input-group">
                                <span class="input-group-addon">
                                  <i class="ace-icon fa fa-user"></i>
                                </span>
                        <input type="text" autocomplete="off" name="TxtApellido" id="TxtApellido" class="input-large" placeholder="Apellidos del Cliente" style="text-transform:uppercase;">
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
                             
                              <label for="form-field-select-3">Ciudad</label>
                             
                          <div class="col-md-12 col-sm-12">
                        <!-- <select class="" name="TxtCiudad" data-placeholder="Seleccionar..."> -->
            <select required="true" class="chosen-select input-xxlarge" name="TxtCiudad" id="TxtCiudad" data-placeholder="Seleccionar...">
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
                              <label for="form-field-select-3">E-mail</label>

                              <div class="input-group">
                                <span class="input-group-addon">
                                  <i class="ace-icon fa fa-envelope"></i>
                                </span>
              <input type="email" name="TxtCorreo" class="input-large" placeholder="Dirección de Proveedor" >
                              </div>
                            
                            </div>
                    
                          </div>

                          
                        </div>
                      </div>

                      <div class="modal-footer">
                        <a href="CrearVenta.php" class="btn btn-sm btn-danger" data-dismiss="modal">
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
		<script type="text/javascript" src="https://modasof.com/espejo/assets/js/jquery.tinycircleslider.js"></script>
    <!-- /build -->
	<script type="text/javascript">
		$(document).ready(function()
		{
			$('#rotatescroll').tinycircleslider({ interval: true, dotsSnap: true, dotsHide: true });
		});
	</script>

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

		<script src="https://modasof.com/espejo/assets/js/dataTables.responsive.min.js"></script>
		<!-- 		<script src="dist/js/demo.js"></script> -->
		<script src="https://modasof.com/espejo/assets/js/jquery.magnific-popup.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.magnific-popup.min.js"></script>
		
		<!-- inline scripts related to this page -->

		 <script type="text/javascript">
        $(document).ready(function()
        {
             $("#FormNuevoCliente").validate({
             	errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
                 rules: {
                     "TxtDocumento": { required:true },
                     "TxtNombre": { required:true }, 
                     "TxtApellido": { required:true }, 
                     "UpTxtCiudad": { required:true },
                     "TxtCiudad": { required:true }, 
                     "TxtCelular": { required:true }, 
                     "UpTxtWhp": { required:true }, 
                     "UpTxtTel": { required:true }, 
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
        $(document).ready(function()
        {
             $("#FormGuardarventa").validate({
             	errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
                 rules: {
                     "TxtClientes": { required:true },
                   "TxtVerificaValor": { required:true },


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
             $("#FormPago").validate({
             	errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
                 rules: {
                     "TxtMedioPago": { required:true },
                      "demo1": { required:true },
                   

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
		

	 <script>
   function format2(n, currency) {
    return currency + " " + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
}
        $(document).ready(function() {
    $('#example').DataTable( {
         "searching": true,
        "ordering": true,
        "paging":   true,
        "info":     true,
        "aLengthMenu": [[100, 200, 300, -1], [100, 200, 300, "Todas"]],
    "pageLength": 100,
       
       
    } );
} );
    </script>

		
		<script type="text/javascript">
			jQuery(function($) {
			
$('#dynamic-table thead tr:eq(1) th').each( function () {
        var title = $('#dynamic-table thead tr:eq(0) th').eq( $(this).index() ).text();
        $(this).html( '<input style="width:100%;border:black solid 1px;" type="text" placeholder="Buscar '+title+'" />' );
    } ); 
  
    var table = $('#dynamic-table').DataTable({
    	responsive:true,
    	"order": [[ 1, "Desc" ]],
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
					"footerCModasofack": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

 
            // Total over all pages
           
            // Total over this page
            pageTotal5 = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            // Total over this page
            pageTotal6 = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            // Total over this page
            pageTotal7 = api
                .column( 7, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
             // Update footer
            $( api.column( 5 ).footer() ).html(
                '$'+format2(pageTotal5,'' )
            );
            // Update footer
            $( api.column( 6 ).footer() ).html(
                '$'+format2(pageTotal6,'' )
            );  

             // Update footer
            $( api.column( 7 ).footer() ).html(
                '$'+format2(pageTotal7,'' )
            );  
        },

    });
  
    // Apply the search
    table.columns().every(function (index) {
        $('#dynamic-table thead tr:eq(1) th:eq(' + index + ') input').on('keyup change', function () {
            table.column($(this).parent().index() + ':visible')
                .search(this.value)
                .draw();    
        });
    });

				var myTable = 
				$('#dynamic-table')
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
		<!-- Final Scripts Tablas -->

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
					todayHighlight: true,
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
	</body>
</html>
