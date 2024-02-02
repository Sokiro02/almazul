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
$HoraActual = date('H:i:s');
$MyIdTienda=$_SESSION['IdTienda'];
//print_r(session_get_cookie_params());

//////////////////////// Control de Caja Diario.//////////////////////////////////////
// Formula en ruta Lib/Formulas.php
$ValorEfectivo= SumaMediosdePago($MyIdTienda,1);
$ValorEfectivoKaren= SumaMediosdePago($MyIdTienda,9); 
$ValorTarjeta=SumaMediosdePago($MyIdTienda,2);
$ValorTarjetaKaren=SumaMediosdePago($MyIdTienda,8);
$ValorTransferencia=SumaMediosdePago($MyIdTienda,3);
$ValorEfecty=SumaMediosdePago($MyIdTienda,4);
$ValorPagina=SumaMediosdePago($MyIdTienda,12);
$Valoraddi=SumaMediosdePago($MyIdTienda,11);
$Valormercadopago=SumaMediosdePago($MyIdTienda,13);
$Valorsistecredito=SumaMediosdePago($MyIdTienda,14);
$Valornubia=SumaMediosdePago($MyIdTienda,15);
$Valoredgardo=SumaMediosdePago($MyIdTienda,16);

$ValorGastos=SumaGastosDiaTienda($MyIdTienda);
$ValorEgresos=SumaEgresosDiaTienda($MyIdTienda);
$totaltarjeta=$ValorTarjeta+$ValorTarjetaKaren;
$totalefectivo=$ValorEfectivo+$ValorEfectivoKaren;

$TotalDia=$totaltarjeta+$totalefectivo+$ValorTransferencia+$ValorEfecty+$ValorPagina+$Valoraddi+$Valormercadopago+$Valorsistecredito+$Valornubia+$Valoredgardo;

$SaldoenCajaDia=$totalefectivo-$ValorGastos-$ValorEgresos;

///////////////////////// Control de Caja General ///////////////////////////////////////////////
// Formula en ruta Lib/Formulas.php
$Total_ValorEfectivo=TotalSumaMediosdePago($MyIdTienda,1);
$Total_ValorBaloto=TotalSumaMediosdePago($MyIdTienda,4); 
$Total_ValorGastos=TotalSumaGastosDiaTienda($MyIdTienda);
$Total_ValorEgresos=TotalSumaEgresosDiaTienda($MyIdTienda);
$TotalCaja=$Total_ValorEfectivo-$Total_ValorGastos-$Total_ValorEgresos-$Total_ValorBaloto;
//$SaldoAnterior=$TotalCaja-$SaldoenCajaDia;


date_default_timezone_set("America/Bogota");
$MarcaTemporal = date('Y-m-d');
$FechaAnterior = strtotime ( '-1 day' , strtotime ( $MarcaTemporal ) ) ;
$FechaAnterior = date ( 'Y-m-d' , $FechaAnterior );

$FechaInicioDia=($FechaAnterior." 00:00:000");
$FechaFinalDia=($FechaAnterior." 23:59:000");



$FechaInicioApertura=($MarcaTemporal." 00:00:000");
$FechaFinalApertura=($MarcaTemporal." 23:59:000");


$sql ="SELECT Valor_Confirmado From t_registro_caja WHERE Tienda_Id_Tienda='".$MyIdTienda."' and Fecha_Registro >='".$FechaInicioApertura."' and Fecha_Registro <='".$FechaFinalApertura."' and Tipo_Registro='1'"; // Consulta para confirmar si está agregado
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $SaldoAnterior=$row['Valor_Confirmado'];
      }
  }

$sql ="SELECT Valor_Caja From t_registro_caja WHERE Tienda_Id_Tienda='".$MyIdTienda."' and Fecha_Registro >='".$FechaInicioApertura."' and Fecha_Registro <='".$FechaFinalApertura."' and Tipo_Registro='1'"; // Consulta para confirmar si está agregado
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $AperturaCaja=$row['Valor_Caja'];
      }
  }



$EfectivoActual=$SaldoenCajaDia+$SaldoAnterior;


//$TotalPedidos=$ValorEfectivo+$ValorTarjeta+$ValorTransferencia+$ValorEfecty+$ValorPagina;




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
		<link rel="stylesheet" href="./assets/css/_all-skins.min.css">
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
	
  <script type="text/javascript">
    function printDiv(nombreDiv) {
     var contenido= document.getElementById(nombreDiv).innerHTML;
     var contenidoOriginal= document.body.innerHTML;

     document.body.innerHTML = contenido;

     window.print();

     document.body.innerHTML = contenidoOriginal;
}
  </script>
	</head>

	<body class="skin-1">

	<?php 
  $Valide=$_GET['Mensaje'];

    if ($Valide==2) {
        echo "<script>jQuery(function(){swal(\"¡Lo Sentimos!\", \"Datos Incorrectos\", \"error\");});</script>";
    };
    if ($Valide==333) {
        echo "<script>jQuery(function(){swal(\"¡ Arpertura guardada!\", \"Correctamente \", \"success\");});</script>";
    };
     if ($Valide==222) {
        echo "<script>jQuery(function(){swal(\"¡ Cierre guardado!\", \"Correctamente \", \"success\");});</script>";
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
								<a href="CajaTienda.php">CAJA <?php Echo($Mitienda); ?></a>
               
                <button onclick="printDiv('PanelCaja')" class="btn-sm btn-white"><i class="fa fa-print"></i></button>
							</li>

            <?php 
            if ($AperturaCaja=="") {
             ?>
              <li>
                 <a  data-toggle="modal" data-target="#modal-form2" href="#"><span class="btn  btn-success btn-xs"><i class="fa fa-plus-square"> </i> Confirmar Apertura</span></a>
              </li>

             <?php
            }
             ?>
              
              <li>
                 <a  data-toggle="modal" data-target="#modal-form3" href="#"><span class="btn  btn-danger btn-xs"><i class="fa fa-plus-square"> </i> Confirmar Cierre</span></a>
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
  
   <?php 
       if ($AperturaCaja=="") {
         Echo("<h1 class='red'> <i class='fa fa-info-circle'> </i> No ha Registrado la Apertura de su Caja </h1>");
         Echo("<div class='row' id='PanelCaja' style='display:none;'>");
       }
       else
       {
        Echo("<div class='row' id='PanelCaja'>");
       }
 ?>
      
       <h3>CAJA <?php Echo($Mitienda); ?> <?php Echo(fechaSql($TiempoActual)); ?>  <small><i class="fa fa-clock-o"></i> <?php Echo($HoraActual); ?></small> </h3>




       
       <hr>
       <div class="col-md-4">

<div class="box box-widget widget-user-2">

<div class="widget-user-header bg-green">
<div class="widget-user-image">
<img class="img-circle" src="../Administrator/Images/Logos/logo-tiendas.jpg" alt="User Avatar">
</div>

<h3 class="widget-user-username">Entradas Tienda</h3>
<h5 class="widget-user-desc">CAJA <?php Echo($Mitienda); ?> <?php Echo(fechaSql($TiempoActual)); ?>  <small><i class="fa fa-clock-o"></i> <?php Echo($HoraActual); ?></h5>
</div>
<div class="box-footer no-padding">
<ul class="nav nav-stacked">
<li><a href="#">Entradas en Efectivo <span class="pull-right badge bg-black">
<?php Echo(formatomoneda($ValorEfectivo)); ?>
</span></a></li>

<li><a href="#">Entradas en Efectivo Karen <span class="pull-right badge bg-black">
<?php Echo(formatomoneda($ValorEfectivoKaren)); ?>
</span></a></li>

<li><a href="#">Entradas con Tarjeta <span class="pull-right badge bg-black">
<?php Echo(formatomoneda($ValorTarjeta)); ?>
</span></a></li>

<li><a href="#">Entradas con Tarjeta Karen <span class="pull-right badge bg-black">
<?php Echo(formatomoneda($ValorTarjetaKaren)); ?>
</span></a></li>

<li><a href="#">Entradas por Transferencias <span class="pull-right badge bg-black">
<?php Echo(formatomoneda($ValorTransferencia)); ?>
</span></a></li>

<li><a href="#">Entradas por Efecty Baloto <span class="pull-right badge bg-black">
<?php Echo(formatomoneda($ValorEfecty)); ?>
</span></a></li>

<li><a href="#">Entradas por Payu <span class="pull-right badge bg-black">
<?php Echo(formatomoneda($ValorPagina)); ?>
</span></a></li>

<li><a href="#">Entradas por Addi <span class="pull-right badge bg-black">
<?php Echo(formatomoneda($Valoraddi)); ?>
</span></a></li>

<li><a href="#">Entradas Mercado Pago <span class="pull-right badge bg-black">
<?php Echo(formatomoneda($Valormercadopago)); ?>
</span></a></li>

<li><a href="#">Entradas SisteCrédito<span class="pull-right badge bg-black">
<?php Echo(formatomoneda($Valorsistecredito)); ?>
</span></a></li>

<li><a href="#">Entradas Nubia Agamez<span class="pull-right badge bg-black">
<?php Echo(formatomoneda($Valornubia)); ?>
</span></a></li>

<li><a href="#">Entradas Edgardo Carrascal<span class="pull-right badge bg-black">
<?php Echo(formatomoneda($Valoredgardo)); ?>
</span></a></li>

</ul>
</div>
</div>

</div>
        <!-- ./col -->

      <div class="col-md-4">
          <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-dollar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Ingresos</span>
              <span class="info-box-number"><a href="Informe-IngresosTienda.php"> $ <?php Echo(number_format($TotalDia,0)); ?></a></span>
              <span><i class="fa fa-clock-o"></i> <?php Echo($TiempoActual); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
         <!-- /.col -->
      <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa fa-dollar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Facturado</span>

              <span class="info-box-number"><a href="Informe-VentasTienda.php"><?php Echo(formatomoneda(TotalFacturado($MyIdTienda))) ?></a></span>
             <div class="progress">
                <div class="progress-bar" style="width: 75%"></div>
              </div>
              
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
         <!-- /.col -->

          <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa fa-dollar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Abonos a Facturas</span>

              <span class="info-box-number"><a href="Informe-VentasTienda.php"><?php Echo(formatomoneda(AbonosDiaTienda($MyIdTienda))) ?></a></span>
             <div class="progress">
                <div class="progress-bar" style="width: 75%"></div>
              </div>
              
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

          <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa  fa-cut"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Anticipos Ordenes de Corte</span>
              <span class="info-box-number"><?php Echo(formatomoneda(AnticiposDiaTienda($MyIdTienda))); ?></span>
              <div class="progress">
                <div class="progress-bar" style="width: 75%"></div>
              </div>
               
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
         <!-- /.col -->
         <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-white"><i class="fa  fa-clock-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Base Día Anterior</span>
              <span class="info-box-number"><?php Echo(formatomoneda($SaldoAnterior)); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
         <!-- /.col -->

    </div>


      <div class="col-md-4">
        
      <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Efectivo</span>
              <span class="info-box-number"><?php Echo(formatomoneda($totalefectivo)); ?></span>
              <span><i class="fa fa-clock-o"></i> <?php Echo($TiempoActual); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
         <!-- /.col -->
          <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa  fa-sign-out"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Gastos Caja Tienda</span>
              <span class="info-box-number"><a href="Informe-GastosTienda.php"><?php Echo(formatomoneda($ValorGastos)); ?></a></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
         <!-- /.col -->
         
          <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa  fa-sign-out"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Egresos Caja</span>
              <span class="info-box-number"><?php Echo(formatomoneda($ValorEgresos)); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
         <!-- /.col -->
          <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa  fa-dollar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Saldo en Efectivo</span>
              <span class="info-box-number"><?php Echo(formatomoneda($EfectivoActual)); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
         <!-- /.col -->

    </div>
      </div>
      <!-- /.row -->
         <div class="row">
       
       
      </div>

						<div class="col-sm-12 col-xs-12"><!-- Panel 2  -->
					
							

						</div> <!-- Fin Panel 2 -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->


      <!-- Inicio Modal -->
    <div id="modal-form2" class="modal" tabindex="-1">
               <!-- Inicio Modal -->
    <div>
    
<form action="Caja-GuardarApertura.php" method="post" id="FormArpetura" autocomplete="off">
     
          <input style="display: none;" type="text" value="<?php Echo($SaldoAnterior) ?>" name="TxtValorCaja">
          <input style="display: none;" type="text" value="<?php Echo($MyIdTienda) ?>" name="TxtTienda"> 
               
                  <div class="modal-dialog ">
                    <div class="modal-content">
                      <div class="modal-header">
                        <a href="CrearVenta.php" type="button" class="close" data-dismiss="modal">&times;</a>
                        <h4 class="black bigger">Apertura Caja realizad por : <?php Echo($NomSesion) ?></h4>
                      </div>

                       <table class="table product-overview center" style="width: 80%;">
                        <tr>
                          <td>
                            Efectivo en Caja
                                     <input disabled="true" class="nav-search-input input-sm" type="text" required="true" value="<?php Echo(formatomoneda($SaldoAnterior));?>" />
                          </td>
                          <td colspan="2">
                           Confirmar Valor
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
                        </tr>
                                  <tr>
                                   
                                   
                                  <td colspan="2">
                                    <textarea  class="autosize-transition form-control" name="TxtObserva" id="form-field-9" placeholder="Indicar Observaciones o anomalías encontradas en caja" rows="3" maxlength="2000"></textarea>
                                    
                                  </td>
                               
                                 
                                  
                                 
                                  </tr>
                                
                                </table>

                      <div class="modal-footer">
                        <a href="Clientes-Abonos.php?AbonosFactura=<?php Echo($AbonosFactura) ?>" class="btn btn-sm btn-danger" data-dismiss="modal">
                          <i class="ace-icon fa fa-times"></i>
                          Cancelar
                        </a>

                        <button class="btn btn-sm btn-success">
                          <i class="ace-icon fa fa-check"></i>
                          Confirmar
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





 <!-- Inicio Modal -->
    <div id="modal-form3" class="modal" tabindex="-1">
               <!-- Inicio Modal -->
    <div>
    
<form action="Caja-GuardarCierre.php" method="post" id="FormCierre" autocomplete="off">
     
          <input style="display: none;" type="text" value="<?php Echo($EfectivoActual) ?>" name="TxtValorCaja">
          <input style="display: none;" type="text" value="<?php Echo($MyIdTienda) ?>" name="TxtTienda"> 
               
                  <div class="modal-dialog ">
                    <div class="modal-content">
                      <div class="modal-header">
                        <a href="CrearVenta.php" type="button" class="close" data-dismiss="modal">&times;</a>
                        <h4 class="black bigger">Cierre Caja realizad por : <?php Echo($NomSesion) ?></h4>
                      </div>

                       <table class="table product-overview center" style="width: 80%;">
                        <tr>
                          <td>
                            Efectivo en Caja para Cierre
                                     <input disabled="true" class="nav-search-input input-sm" type="text" required="true" value="<?php Echo(formatomoneda($EfectivoActual));?>" />
                          </td>
                          <td colspan="2">
                           Confirmar Valor
                                     <input class=" nav-search-input input-sm" type="text"  id="demo2" placeholder="$ 0" name="demo2"  required="true" />
                         
                               
                                <script type="text/javascript">     
$("#demo2").maskMoney({
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
                        </tr>
                                  <tr>
                                   
                                   
                                  <td colspan="2">
                                    <textarea  class="autosize-transition form-control" name="TxtObserva" id="form-field-9" placeholder="Indicar Observaciones o anomalías encontradas en caja" rows="3" maxlength="2000"></textarea>
                                    
                                  </td>
                               
                                 
                                  
                                 
                                  </tr>
                                
                                </table>

                      <div class="modal-footer">
                        <a href="Clientes-Abonos.php?AbonosFactura=<?php Echo($AbonosFactura) ?>" class="btn btn-sm btn-danger" data-dismiss="modal">
                          <i class="ace-icon fa fa-times"></i>
                          Cancelar
                        </a>

                        <button class="btn btn-sm btn-success">
                          <i class="ace-icon fa fa-check"></i>
                          Confirmar
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

		
		
		<!-- inline scripts related to this page -->

		
	<script type="text/javascript">
        $(document).ready(function()
        {
             $("#validation-form").validate({
             	errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
                 rules: {
                     "TxtTitulo": { required:true },
                     "TxtHoras": { required:true }, 
                     "TxtTiempoDia": { required:true }, 
                     "TxtTiempoHora": { required:true },
                     "TxtTiempoMinuto": { required:true }, 
                     "TxtDetalle": { required:true }, 
                     "TxtUsuario": { required:true }, 

                 },
                 messages: {
                     "txtNombre": { required:"Debes incluir al menos un Usuario",},
                    
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
             $("#FormArpetura").validate({
             	errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
                 rules: {
                     "demo1": { required:true },
                     "TxtObserva": { required:true }, 
                 },
                 messages: {
                     "TxtObserva": { required:"Si no hay observación digitar Ninguna",},
                    
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
             $("#FormCierre").validate({
              errorElement: 'div',
          errorClass: 'help-block',
          focusInvalid: true,
          ignore: "",
                 rules: {
                     "demo2": { required:true },
                     "TxtObserva": { required:true }, 
                 },
                 messages: {
                     "TxtObserva": { required:"Si no hay observación digitar Ninguna",},
                    
                 },

                 // submitHandler: function(form){
                 //     alert("Los datos son correctos");
                 // }

             });
        });
    </script>

		
		<script type="text/javascript">
			jQuery(function($) {
				//initiate dataTables plugin

				// Setup - add a text input to each header cell
    
// Inicio Script para Filtros con Selects
	// 	 $('#dynamic-table').DataTable( {

    //     initComplete: function () {
    //         this.api().columns([1,2,3]).every( function () {
    //             var column = this;
    //             var select = $('<select><option value="">Filtrar...</option></select>')
    //                 .appendTo( $(column.header()).empty() )
    //                 .on( 'change', function () {
    //                     var val = $.fn.dataTable.util.escapeRegex(
    //                         $(this).val()
    //                     );
    //                     column
    //                         .search( val ? '^'+val+'$' : '', true, false )
    //                         .draw();
    //                 } );
    //                 orderCellsTop: true,
 
    //             column.data().unique().sort().each( function ( d, j ) {
    //                 select.append( '<option value="'+d+'">'+d+'</option>' )
    //             } );
    //         } );
    //     }

// Fin Script  para Filtros con Selects

    // } );
$('#dynamic-table thead tr:eq(1) th').each( function () {
        var title = $('#dynamic-table thead tr:eq(0) th').eq( $(this).index() ).text();
        $(this).html( '<input style="width:100%;border:black solid 1px;" type="text" placeholder="Buscar '+title+'" />' );
    } ); 
  
    var table = $('#dynamic-table').DataTable({

    	"order": [[ 3, "Asc" ]],
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
					  null, null,null, null,null,null,null,
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
						"text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
						"className": "btn btn-white btn-primary btn-bold"
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
