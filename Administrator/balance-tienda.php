<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];
include("Lib/permisos.php");
include("Lib/seguridad.php");
$seguridad = AgregarLog($IdUser,"Entrada a Pagina Principal","index.php");

$TiendaSel=$_GET['QueryCon'];

$sql ="SELECT Nom_Tienda FROM t_tiendas WHERE Id_Tienda='".$TiendaSel."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
    	$NombreTienda=$row['Nom_Tienda']; 
 }
}
   
$mes_inicio_trim = NomMes(date("n")-2);
$mes_sig_trim = NomMes(date("n")-1);
$mes_fin_trim = NomMes(date("n"));

$FechaActual = date('Y-m-d');
$DiaActual=date("d");
$MesActual=date("m");
$AnoActual=date("Y");
$HoraActual=date("H:i:s");

$Resta1Mes = strtotime ( '-1 month' , strtotime ( $FechaActual ) ) ;
$MesAtras = date ( 'Y-m-d' , $Resta1Mes );
$NumeroMesAtras=date("m", strtotime($MesAtras)); 
$NumeroAnoAtras=date("Y", strtotime($MesAtras)); 

$InicioMesAtras=($NumeroAnoAtras."-".$NumeroMesAtras."-01 00:00:000");
$FinMesAtras=($NumeroAnoAtras."-".$NumeroMesAtras."-".$DiaActual." ".$HoraActual);
$InicioMes=($AnoActual."-".$MesActual."-01 00:00:000");
$FinMes=($AnoActual."-".$MesActual."-".$DiaActual." ".$HoraActual);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Modasof</title>

		<meta name="description" content="Common form elements and layouts" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
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
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/tinycircleslider.css" type="text/css" media="screen"/>
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

	</head>

	<body class="skin-1">

	<?php 
  $Valide=$_GET['Mensaje'];

    if ($Valide==1) {
        echo "<script>jQuery(function(){swal(\"¡Lo Sentimos!\", \"El archivo ya existe\", \"error\");});</script>";
    };
    if ($Valide==2) {
        echo "<script>jQuery(function(){swal(\"¡Lo Sentimos!\", \"El archivo tiene un peso superior a 5MB.\", \"error\");});</script>";
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
								<a href="index.php">Informe Modasof</a>
							</li>
							<li class="dropdown">
													<a data-toggle="dropdown" class="dropdown-toggle black" href="#">
														<strong class="badge bg-black">Informe por Tienda &nbsp;</strong>
														<i class="ace-icon fa fa-caret-down bigger-110 width-auto"></i>
													</a>

													<ul class="dropdown-menu dropdown-info">
														<li>
				<a  href="index.php">Ver todas las tiendas</a>
			</li>
														<?php
$sql ="SELECT Id_Tienda, Nom_Tienda FROM t_tiendas order by Nom_Tienda asc";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
    	$SelectDown=$row['Id_Tienda'];
    	$NomDown=$row['Nom_Tienda'];             
    	?>
    		<li>
				<a  href="balance-tienda.php?QueryCon=<?php Echo($SelectDown);?>&Mensaje=27"><?php Echo utf8_encode($NomDown); ?></a>
			</li>
    	<?php
 }
}
            
?>	
													</ul>
												</li>
						</ul><!-- /.breadcrumb -->

						
					</div>

					<div class="page-content">
						<div class="row">
		
			<div class="col-sm-12 col-xs-12"><!-- Panel 2  -->
			
			<div id="rotatescroll" class="col-xs-12 col-sm-4">

		<div class="viewport">
			<ul class="overview">
		<?php 
$sql ="SELECT B.Img_Referencia, Referencia_Id_Referencia, SUM(Cant_Solicitada) AS TotalVentas FROM t_ventas as A, t_referencias as B WHERE A.Tienda_id_tienda='".$TiendaSel."' and A.Referencia_Id_Referencia=B.Cod_Referencia and month(fecha_solicitud)='".$MesActual."' GROUP BY Referencia_Id_Referencia ORDER BY SUM(Cant_Solicitada) DESC LIMIT 0 , 5"; 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Img_Referencia=$row['Img_Referencia'];
        //echo $total_compras_contado." COMPRAS CONTADO <BR>";
  
		 ?>
				<li><a href="http://www.baijs.com"><img class="responsive" width="280" height="280" src="<?php Echo($Img_Referencia) ?>" /></a></li>

		<?php 
	}
}
		 ?>
			</ul>
		</div>
		<div class="dot"></div>
		<div class="overlay"></div>
		<div class="thumb"></div>
		<h3>Prendas más vendidas Modasof en <?php echo($NombreTienda); ?> <?php echo($mes_fin_trim." ".$AnoActual); ?></h3>
		<table class="table table-striped table-bordered table-hover">
		<?php 
$sql ="SELECT B.Img_Referencia, Referencia_Id_Referencia, IFNULL(SUM(Cant_Solicitada),0) AS TotalVentas FROM t_ventas as A, t_referencias as B WHERE A.Tienda_id_tienda='".$TiendaSel."' and A.Referencia_Id_Referencia=B.Cod_Referencia and month(fecha_solicitud)='".$MesActual."' GROUP BY Referencia_Id_Referencia ORDER BY SUM(Cant_Solicitada) DESC LIMIT 0 , 5"; 
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Referencia_Id_Referencia=$row['Referencia_Id_Referencia'];
         $TotalVentas=$row['TotalVentas'];
        //echo $total_compras_contado." COMPRAS CONTADO <BR>";
  
		 ?>
				<tr>
					<td><?php echo($Referencia_Id_Referencia) ?></td>
					<td><?php echo($TotalVentas) ?>Un.</td>
				</tr>

		<?php 
	}
}
		 ?>
		</table>
	</div>
	<?php 
		include("semana.php");
	 ?>
	<div class="col-xs-12 col-sm-8  widget-container-col" id="widget-container-col-2">
											<div class="widget-box widget-color-blue" id="widget-box-2">
												<div class="widget-header">
													<h5 class="widget-title bigger lighter">
														<i class="ace-icon fa fa-table"></i>
														Prospectos Modasof <?php echo($NombreTienda); ?>
													</h5>
												</div>

												<div class="widget-body">
													<div class="widget-main no-padding">
														<table class="table table-striped table-bordered table-hover">
															
															<tbody>
																<tr class="warning">
																	<td class="">HORARIO</td>
																	<td class="center">L</td>
																	<td class="center">M</td>
																	<td class="center">X</td>
																	<td class="center">J</td>
																	<td class="center">V</td>
																	<td class="center">S</td>
																	<td class="center">D</td>
																	<td class="center">TT</td>
																</tr>
																<tr>
																	<td class="">8:00 AM A 9:00 AM</td>
																	<?php echo(totalleadstienda($fechalunes8,$fechalunes9,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechamartes8,$fechamartes9,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechamiercoles8,$fechamiercoles9,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechajueves8,$fechajueves9,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechaviernes8,$fechaviernes9,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechasabado8,$fechasabado9,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechadomingo8,$fechadomingo9,$TiendaSel)) ?>
																	<td class="warning center">
									<?php
                 $L8=numeroleadstienda($fechalunes8,$fechalunes9,$TiendaSel);
                 $M8=numeroleadstienda($fechamartes8,$fechamartes9,$TiendaSel);
                 $X8=numeroleadstienda($fechamiercoles8,$fechamiercoles9,$TiendaSel);
                 $J8=numeroleadstienda($fechajueves8,$fechajueves9,$TiendaSel);
                 $V8=numeroleadstienda($fechaviernes8,$fechaviernes9,$TiendaSel);
                 $S8=numeroleadstienda($fechasabado8,$fechasabado9,$TiendaSel);
                 $D8=numeroleadstienda($fechadomingo8,$fechadomingo9,$TiendaSel);
                 
                 $suma8=$L8+$M8+$X8+$J8+$V8+$S8+$D8;
                 echo  ($suma8);
                  ?>
																	 </td>
																</tr>

																<tr>
																	<td class="">9:00 AM A 10:00 AM</td>
																	<?php echo(totalleadstienda($fechalunes9,$fechalunes10,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechamartes9,$fechamartes10,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechamiercoles9,$fechamiercoles10,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechajueves9,$fechajueves10,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechaviernes9,$fechaviernes10,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechasabado9,$fechasabado10,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechadomingo9,$fechadomingo10,$TiendaSel)) ?>
																	<td class="warning center">
									<?php
                 $L9=numeroleadstienda($fechalunes9,$fechalunes10,$TiendaSel);
                 $M9=numeroleadstienda($fechamartes9,$fechamartes10,$TiendaSel);
                 $X9=numeroleadstienda($fechamiercoles9,$fechamiercoles10,$TiendaSel);
                 $J9=numeroleadstienda($fechajueves9,$fechajueves10,$TiendaSel);
                 $V9=numeroleadstienda($fechaviernes9,$fechaviernes10,$TiendaSel);
                 $S9=numeroleadstienda($fechasabado9,$fechasabado10,$TiendaSel);
                 $D9=numeroleadstienda($fechadomingo9,$fechadomingo10,$TiendaSel);
                 
                 $suma9=$L9+$M9+$X9+$J9+$V9+$S9+$D9;
                 echo  ($suma9);
                  ?>
																	</td>
																</tr>

																<tr>
																	<td class="">10:00 AM A 11:00 AM</td>
																	<?php echo(totalleadstienda($fechalunes10,$fechalunes11,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechamartes10,$fechamartes11,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechamiercoles10,$fechamiercoles11,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechajueves10,$fechajueves11,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechaviernes10,$fechaviernes11,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechasabado10,$fechasabado11,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechadomingo10,$fechadomingo11,$TiendaSel)) ?>
																	<td class="warning center">
																	<?php
																	$L10=numeroleadstienda($fechalunes10,$fechalunes11,$TiendaSel);
																	$M10=numeroleadstienda($fechamartes10,$fechamartes11,$TiendaSel);
																	$X10=numeroleadstienda($fechamiercoles10,$fechamiercoles11,$TiendaSel);
																	$J10=numeroleadstienda($fechajueves10,$fechajueves11,$TiendaSel);
																	$V10=numeroleadstienda($fechaviernes10,$fechaviernes11,$TiendaSel);
																	$S10=numeroleadstienda($fechasabado10,$fechasabado11,$TiendaSel);
																	$D10=numeroleadstienda($fechadomingo10,$fechadomingo11,$TiendaSel);
																	
																	$suma10=$L10+$M10+$X10+$J10+$V10+$S10+$D10;
																	echo  ($suma10);
																	 ?>
																	</td>
																</tr>

																<tr>
																	<td class="">11:00 AM A 12:00 PM</td>
																	<?php echo(totalleadstienda($fechalunes11,$fechalunes12,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechamartes11,$fechamartes12,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechamiercoles11,$fechamiercoles12,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechajueves11,$fechajueves12,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechaviernes11,$fechaviernes12,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechasabado11,$fechasabado12,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechadomingo11,$fechadomingo12,$TiendaSel)) ?>
																	<td class="warning center">
																		<?php
                 $L11=numeroleadstienda($fechalunes11,$fechalunes12,$TiendaSel);
                 $M11=numeroleadstienda($fechamartes11,$fechamartes12,$TiendaSel);
                 $X11=numeroleadstienda($fechamiercoles11,$fechamiercoles12,$TiendaSel);
                 $J11=numeroleadstienda($fechajueves11,$fechajueves12,$TiendaSel);
                 $V11=numeroleadstienda($fechaviernes11,$fechaviernes12,$TiendaSel);
                 $S11=numeroleadstienda($fechasabado11,$fechasabado12,$TiendaSel);
                 $D11=numeroleadstienda($fechadomingo11,$fechadomingo12,$TiendaSel);
                 
                 $suma11=$L11+$M11+$X11+$J11+$V11+$S11+$D11;
                 echo  ($suma11);
                  ?>
																	</td>
																</tr>
																<tr>
																	<td class="">12:00 PM A 1:00 PM</td>
																	<?php echo(totalleadstienda($fechalunes12,$fechalunes13,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechamartes12,$fechamartes13,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechamiercoles12,$fechamiercoles13,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechajueves12,$fechajueves13,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechaviernes12,$fechaviernes13,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechasabado12,$fechasabado13,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechadomingo12,$fechadomingo13,$TiendaSel)) ?>
																	<td class="warning center">
																		<?php
                 $L12=numeroleadstienda($fechalunes12,$fechalunes13,$TiendaSel);
                 $M12=numeroleadstienda($fechamartes12,$fechamartes13,$TiendaSel);
                 $X12=numeroleadstienda($fechamiercoles12,$fechamiercoles13,$TiendaSel);
                 $J12=numeroleadstienda($fechajueves12,$fechajueves13,$TiendaSel);
                 $V12=numeroleadstienda($fechaviernes12,$fechaviernes13,$TiendaSel);
                 $S12=numeroleadstienda($fechasabado12,$fechasabado13,$TiendaSel);
                 $D12=numeroleadstienda($fechadomingo12,$fechadomingo13,$TiendaSel);
                 
                 $suma12=$L12+$M12+$X12+$J12+$V12+$S12+$D12;
                 echo  ($suma12);
                  ?>
																	</td>
																</tr>
																<tr>
																	<td class="">1:00 PM A 2:00 PM</td>
																	<?php echo(totalleadstienda($fechalunes13,$fechalunes14,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechamartes13,$fechamartes14,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechamiercoles13,$fechamiercoles14,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechajueves13,$fechajueves14,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechaviernes13,$fechaviernes14,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechasabado13,$fechasabado14,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechadomingo13,$fechadomingo14,$TiendaSel)) ?>
																	<td class="warning center">
																		<?php
                 $L13=numeroleadstienda($fechalunes13,$fechalunes14,$TiendaSel);
                 $M13=numeroleadstienda($fechamartes13,$fechamartes14,$TiendaSel);
                 $X13=numeroleadstienda($fechamiercoles13,$fechamiercoles14,$TiendaSel);
                 $J13=numeroleadstienda($fechajueves13,$fechajueves14,$TiendaSel);
                 $V13=numeroleadstienda($fechaviernes13,$fechaviernes14,$TiendaSel);
                 $S13=numeroleadstienda($fechasabado13,$fechasabado14,$TiendaSel);
                 $D13=numeroleadstienda($fechadomingo13,$fechadomingo14,$TiendaSel);
                 
                 $suma13=$L13+$M13+$X13+$J13+$V13+$S13+$D13;
                 echo  ($suma13);
                  ?>
																	</td>
																</tr>
																<tr>
																	<td class="">2:00 PM A 3:00 PM</td>
																	<?php echo(totalleadstienda($fechalunes14,$fechalunes15,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechamartes14,$fechamartes15,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechamiercoles14,$fechamiercoles15,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechajueves14,$fechajueves15,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechaviernes14,$fechaviernes15,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechasabado14,$fechasabado15,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechadomingo14,$fechadomingo15,$TiendaSel)) ?>
																	<td class="warning center">
																		<?php
                 $L14=numeroleadstienda($fechalunes14,$fechalunes15,$TiendaSel);
                 $M14=numeroleadstienda($fechamartes14,$fechamartes15,$TiendaSel);
                 $X14=numeroleadstienda($fechamiercoles14,$fechamiercoles15,$TiendaSel);
                 $J14=numeroleadstienda($fechajueves14,$fechajueves15,$TiendaSel);
                 $V14=numeroleadstienda($fechaviernes14,$fechaviernes15,$TiendaSel);
                 $S14=numeroleadstienda($fechasabado14,$fechasabado15,$TiendaSel);
                 $D14=numeroleadstienda($fechadomingo14,$fechadomingo15,$TiendaSel);
                 
                 $suma14=$L14+$M14+$X14+$J14+$V14+$S14+$D14;
                 echo  ($suma14);
                  ?>
																	</td>
																</tr>
																<tr>
																	<td class="">3:00 PM A 4:00 PM</td>
																	<?php echo(totalleadstienda($fechalunes15,$fechalunes16,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechamartes15,$fechamartes16,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechamiercoles15,$fechamiercoles16,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechajueves15,$fechajueves16,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechaviernes15,$fechaviernes16,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechasabado15,$fechasabado16,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechadomingo15,$fechadomingo16,$TiendaSel)) ?>
																	<td class="warning center">
																		<?php
                 $L15=numeroleadstienda($fechalunes15,$fechalunes16,$TiendaSel);
                 $M15=numeroleadstienda($fechamartes15,$fechamartes16,$TiendaSel);
                 $X15=numeroleadstienda($fechamiercoles15,$fechamiercoles16,$TiendaSel);
                 $J15=numeroleadstienda($fechajueves15,$fechajueves16,$TiendaSel);
                 $V15=numeroleadstienda($fechaviernes15,$fechaviernes16,$TiendaSel);
                 $S15=numeroleadstienda($fechasabado15,$fechasabado16,$TiendaSel);
                 $D15=numeroleadstienda($fechadomingo15,$fechadomingo16,$TiendaSel);
                 
                 $suma15=$L15+$M15+$X15+$J15+$V15+$S15+$D15;
                 echo  ($suma15);
                  ?>
																	</td>
																</tr>
																<tr>
																	<td class="">4:00 PM A 5:00 PM</td>
																	<?php echo(totalleadstienda($fechalunes16,$fechalunes17,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechamartes16,$fechamartes17,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechamiercoles16,$fechamiercoles17,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechajueves16,$fechajueves17,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechaviernes16,$fechaviernes17,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechasabado16,$fechasabado17,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechadomingo16,$fechadomingo17,$TiendaSel)) ?>
																	<td class="warning center">
																		<?php
                 $L16=numeroleadstienda($fechalunes16,$fechalunes17,$TiendaSel);
                 $M16=numeroleadstienda($fechamartes16,$fechamartes17,$TiendaSel);
                 $X16=numeroleadstienda($fechamiercoles16,$fechamiercoles17,$TiendaSel);
                 $J16=numeroleadstienda($fechajueves16,$fechajueves17,$TiendaSel);
                 $V16=numeroleadstienda($fechaviernes16,$fechaviernes17,$TiendaSel);
                 $S16=numeroleadstienda($fechasabado16,$fechasabado17,$TiendaSel);
                 $D16=numeroleadstienda($fechadomingo16,$fechadomingo17,$TiendaSel);
                 
                 $suma16=$L16+$M16+$X16+$J16+$V16+$S16+$D16;
                 echo  ($suma16);
                  ?>
																	</td>
																</tr>
																<tr>
																	<td class="">5:00 PM A 6:00 PM</td>
																	<?php echo(totalleadstienda($fechalunes17,$fechalunes18,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechamartes17,$fechamartes18,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechamiercoles17,$fechamiercoles18,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechajueves17,$fechajueves18,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechaviernes17,$fechaviernes18,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechasabado17,$fechasabado18,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechadomingo17,$fechadomingo18,$TiendaSel)) ?>
																	<td class="warning center">
																		<?php
                 $L17=numeroleadstienda($fechalunes17,$fechalunes18,$TiendaSel);
                 $M17=numeroleadstienda($fechamartes17,$fechamartes18,$TiendaSel);
                 $X17=numeroleadstienda($fechamiercoles17,$fechamiercoles18,$TiendaSel);
                 $J17=numeroleadstienda($fechajueves17,$fechajueves18,$TiendaSel);
                 $V17=numeroleadstienda($fechaviernes17,$fechaviernes18,$TiendaSel);
                 $S17=numeroleadstienda($fechasabado17,$fechasabado18,$TiendaSel);
                 $D17=numeroleadstienda($fechadomingo17,$fechadomingo18,$TiendaSel);
                 
                 $suma17=$L17+$M17+$X17+$J17+$V17+$S17+$D17;
                 echo  ($suma17);
                  ?>
																	</td>
																</tr>
																<tr>
																	<td class="">6:00 PM A 7:00 PM</td>
																	<?php echo(totalleadstienda($fechalunes18,$fechalunes19,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechamartes18,$fechamartes19,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechamiercoles18,$fechamiercoles19,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechajueves18,$fechajueves19,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechaviernes18,$fechaviernes19,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechasabado18,$fechasabado19,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechadomingo18,$fechadomingo19,$TiendaSel)) ?>
																	<td class="warning center">
																		<?php
                 $L18=numeroleadstienda($fechalunes18,$fechalunes19,$TiendaSel);
                 $M18=numeroleadstienda($fechamartes18,$fechamartes19,$TiendaSel);
                 $X18=numeroleadstienda($fechamiercoles18,$fechamiercoles19,$TiendaSel);
                 $J18=numeroleadstienda($fechajueves18,$fechajueves19,$TiendaSel);
                 $V18=numeroleadstienda($fechaviernes18,$fechaviernes19,$TiendaSel);
                 $S18=numeroleadstienda($fechasabado18,$fechasabado19,$TiendaSel);
                 $D18=numeroleadstienda($fechadomingo18,$fechadomingo19,$TiendaSel);
                 
                 $suma18=$L18+$M18+$X18+$J18+$V18+$S18+$D18;
                 echo  ($suma18);
                  ?>
																	</td>
																</tr>
																<tr>
																	<td class="">7:00 PM A 8:00 PM</td>
																	<?php echo(totalleadstienda($fechalunes19,$fechalunes20,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechamartes19,$fechamartes20,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechamiercoles19,$fechamiercoles20,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechajueves19,$fechajueves20,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechaviernes19,$fechaviernes20,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechasabado19,$fechasabado20,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechadomingo19,$fechadomingo20,$TiendaSel)) ?>
																	<td class="warning center">
																		<?php
                 $L19=numeroleadstienda($fechalunes19,$fechalunes20,$TiendaSel);
                 $M19=numeroleadstienda($fechamartes19,$fechamartes20,$TiendaSel);
                 $X19=numeroleadstienda($fechamiercoles19,$fechamiercoles20,$TiendaSel);
                 $J19=numeroleadstienda($fechajueves19,$fechajueves20,$TiendaSel);
                 $V19=numeroleadstienda($fechaviernes19,$fechaviernes20,$TiendaSel);
                 $S19=numeroleadstienda($fechasabado19,$fechasabado20,$TiendaSel);
                 $D19=numeroleadstienda($fechadomingo19,$fechadomingo20,$TiendaSel);
                 
                 $suma19=$L19+$M19+$X19+$J19+$V19+$S19+$D19;
                 echo  ($suma19);
                  ?>
																	</td>
																</tr>
																<tr>
																	<td class="">8:00 PM A 9:00 PM</td>
																	<?php echo(totalleadstienda($fechalunes20,$fechalunes21,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechamartes20,$fechamartes21,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechamiercoles20,$fechamiercoles21,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechajueves20,$fechajueves21,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechaviernes20,$fechaviernes21,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechasabado20,$fechasabado21,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechadomingo20,$fechadomingo21,$TiendaSel)) ?>
																	<td class="warning center">
																		<?php
                 $L20=numeroleadstienda($fechalunes20,$fechalunes21,$TiendaSel);
                 $M20=numeroleadstienda($fechamartes20,$fechamartes21,$TiendaSel);
                 $X20=numeroleadstienda($fechamiercoles20,$fechamiercoles21,$TiendaSel);
                 $J20=numeroleadstienda($fechajueves20,$fechajueves21,$TiendaSel);
                 $V20=numeroleadstienda($fechaviernes20,$fechaviernes21,$TiendaSel);
                 $S20=numeroleadstienda($fechasabado20,$fechasabado21,$TiendaSel);
                 $D20=numeroleadstienda($fechadomingo20,$fechadomingo21,$TiendaSel);
                 
                 $suma20=$L20+$M20+$X20+$J20+$V20+$S20+$D20;
                 echo  ($suma20);
                  ?>
																	</td>
																</tr>
																<tr class="warning">
																	<td class=""><strong>Total Día</strong></td>
																	<?php echo(totalleadstienda($fechalunes8,$fechalunes21,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechamartes8,$fechamartes21,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechamiercoles8,$fechamiercoles21,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechajueves8,$fechajueves21,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechaviernes8,$fechaviernes21,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechasabado8,$fechasabado21,$TiendaSel)) ?>
																	<?php echo(totalleadstienda($fechadomingo8,$fechadomingo21,$TiendaSel)) ?>
																<td class="center btn-success">
																	<?php 
		$sumaleads=$suma8+$suma9+$suma10+$suma11+$suma12+$suma13+$suma14+$suma15+$suma16+$suma17+$suma18+$suma19+$suma20;
		echo($sumaleads);
																	 ?>
																</td>
																	
																</tr>

															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div><!-- /.span -->

</div> <!-- Fin Panel 2 -->

          
                      


							
						</div><!-- /.row -->
						<hr>
						<div class="row"> <!--SEGUNDA FILA-->

							<div class="col-sm-4 col-xs-12">
										<div class="widget-box transparent">
											<div class="widget-header widget-header-flat">
												<h4 class="widget-title lighter">
													<i class="ace-icon fa fa-line-chart green"></i>
													Gestión Comercial Modasof <?php echo($NombreTienda) ?>
												</h4>

												<div class="widget-toolbar">
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
																<th style="width: 40%">
																	<i class="ace-icon fa fa-caret-down blue"></i>Elemento
																</th>

																<th>
																	<i class="ace-icon fa fa-caret-down blue"></i><?php echo($mes_sig_trim) ?>
																</th>

																<th class="">
																	<i class="ace-icon fa fa-caret-down blue"></i><?php echo($mes_fin_trim) ?>
																</th>
															</tr>
														</thead>

														<tbody>
															<tr>
																<td>Nº Prospectos</td>
																<td class="center">
										<b class="blue"><?php $totalprosAt=(numeroleadsMestienda($NumeroMesAtras,$TiendaSel));echo($totalprosAt) ?></b>
																</td>
																	<td class="center">
										<b class="blue"><?php $totalprosAc=(numeroleadsMestienda($MesActual,$TiendaSel));echo($totalprosAc) ?></b>
																</td>
															</tr>

														

															<tr>
																<td>Nº Clientes</td>

																	<td class="center">
										<?php $totalclientesAt=(numeroclientesMestienda($NumeroMesAtras,$TiendaSel));  ?>
										<span class="label label-danger arrowed arrowed-right"><?php echo($totalclientesAt); ?></span>
																</td>
																	<td class="center">
										<?php $totalclientesAc=(numeroclientesMestienda($MesActual,$TiendaSel));  ?>
										<span class="label label-danger arrowed arrowed-right"><?php echo($totalclientesAc); ?></span>
																</td>
															</tr>
																<tr>
																<td>Tasa de Cierre</td>

																	<td class="center">
										<b class="blue">
											<?php 
											if ($totalprosAt=='0') {
													$cierreAt=0;
											}
											else
											{
												$cierreAt=$totalclientesAt/$totalprosAt*100; 
											}
											 ?>
												<?php echo(round($cierreAt,1)) ?>%
											</b>
																</td>
																	<td class="center">
																	<b class="blue">
																		<?php 
											if ($totalprosAc=='0') {
													$cierreAc=0;
											}
											else
											{
												$cierreAc=$totalclientesAc/$totalprosAc*100; 
											}
											 ?>
												<?php echo(round($cierreAc,1)) ?>%
																	</b>
																</td>
															</tr>

															<tr>
																<td>Frecuencia de compra</td>

																	<td class="center">
																	<b class="blue">
																		<?php 
																		$arregloAt=(arreglofrecuenciatienda($NumeroMesAtras,$TiendaSel));
																		$CadenaAt=explode(",", $arregloAt);
																		$longitudAt = count($CadenaAt)-1;
																		$sumaAt=array_sum($CadenaAt);
																		if ($sumaAt==0) {
																			$promedioAt=0;
																		}
																		else
																		{
																			$promedioAt=$sumaAt/$longitudAt;
																		}
																		
																		echo(round($promedioAt,2));
																		 ?>
																	</b>
																</td>
																	<td class="center">
																	<b class="blue">
																		<?php 
																		$arregloAc=(arreglofrecuenciatienda($MesActual,$TiendaSel));
																		$CadenaAc=explode(",", $arregloAc);
																		$longitudAc = count($CadenaAc)-1;
																		$sumaAc=array_sum($CadenaAc);
																		if ($sumaAc==0) {
																			$promedioAc=0;
																		}
																		else
																		{
																			$promedioAc=$sumaAc/$longitudAc;
																		}
																		echo(round($promedioAc,2));
																		 ?>
																	</b>
																</td>
															</tr>

															<tr>
																<td>Venta promedio</td>

																	<td class="center">
																	<b class="blue">
																		<?php 
																		$ventapromAt=(promediocompratienda($NumeroMesAtras,$TiendaSel));
																		
																	 ?>
						<?php echo("$ ".number_format($ventapromAt)); ?>
																	 	
																	 </b>
																</td>
																	<td class="center">
																	<b class="blue">
																		<?php 
																		$ventapromAc=(promediocompratienda($MesActual,$TiendaSel));
																	 ?>
							<?php echo("$ ".number_format($ventapromAc)); ?>
																	</b>
																</td>
															</tr>
															<tr>
																<td>Total Venta (Sin Iva)</td>
																<td class="center">
																	<b class="blue">
																		<?php 
																		$ventaAt=(totalventamestienda($NumeroMesAtras,$TiendaSel));
																		
																	 ?>
								<span class="label label-danger arrowed arrowed-right"><?php echo("$ ".number_format($ventaAt)); ?></span>
																	</b>
																</td>

																<td class="center">
																	<b class="blue">
																		<?php 
																		$ventaAc=(totalventamestienda($MesActual,$TiendaSel));
																		
																	 ?>
								<span class="label label-danger arrowed arrowed-right"><?php echo("$ ".number_format($ventaAc)); ?></span>
																	</b>
																</td>
															</tr>
															<tr>
																<td>Costo Producción (Sin M. Obra)</td>
																<td class="center">
																	<b class="blue">
																		<?php 
																		$insumosAt=(totalcostosmestienda($NumeroMesAtras,$TiendaSel));
																		$manoAt=(totalmanobramestienda($NumeroMesAtras,$TiendaSel));
																		$costosAt=(int)$insumosAt;
																		echo("$".number_format($costosAt));
																		 ?>
																	</b>
																</td>

																<td class="center">
																	<b class="blue">
																		<?php 
																		$insumosAc=(totalcostosmestienda($MesActual,$TiendaSel));
																		$manoAc=(totalmanobramestienda($MesActual,$TiendaSel));
																		$costosAc=(int)$insumosAc;
																		echo("$".number_format($costosAc));
																		 ?>
																	</b>
																</td>
															</tr>
															<tr>
																<td>Margen Bruto</td>
																<td class="center">
																	<b class="blue">
																		<?php 
																		if ($ventaAt==0) {
																			$margenbrutoAt=0;
																		}
																		else
																		{
																			$opera1=$costosAt/$ventaAt;
																			$opera2=1-$opera1;
																			$margenbrutoAt=$opera2*100;

																		}
																		echo(round($margenbrutoAt,1));
																		 ?>
																		 %
																	</b>
																</td>

																<td class="center">
																	<b class="blue">
																		<?php 
																		if ($ventaAc==0) {
																			$margenbrutoAc=0;
																		}
																		else
																		{
																			$opera1ac=$costosAc/$ventaAc;
																			$opera2ac=1-$opera1ac;
																			$margenbrutoAc=$opera2ac*100;

																		}
																		echo(round($margenbrutoAc,1));
																		 ?>
																		 %
																	</b>
																</td>
															</tr>
																<tr>
																<td>Utilidad Bruta</td>
																<td class="center">
																	<b class="blue">
																		<?php 
																		$utilbrutaAt=$ventaAt-$costosAt;
																		 ?>
						<span class="label label-danger arrowed arrowed-right"><?php echo("$ ".number_format($utilbrutaAt)) ?></span>
																	</b>
																</td>

																<td class="center">
																	<b class="blue">
																		<?php 
																		$utilbrutaAc=$ventaAc-$costosAc;
																		 ?>
						<span class="label label-danger arrowed arrowed-right"><?php echo("$ ".number_format($utilbrutaAc)) ?></span>
																	</b>
																</td>
															</tr>
															<tr>
																<td>Gastos</td>
																<td class="center">
																	<b class="blue">
																		<?php 
																		$gastosAt=(totalgastosmestienda($NumeroMesAtras,$TiendaSel));
																		echo("$ ".number_format($gastosAt));
																		 ?>
																	</b>
																</td>

																<td class="center">
																	<b class="blue">
																		<?php 
																		$gastosAc=(totalgastosmestienda($MesActual,$TiendaSel));
																		echo("$ ".number_format($gastosAc));
																		 ?>
																	</b>
																</td>
															</tr>
															<tr>
																<td>Utilidad Neta</td>
																<td class="center">
																	<b class="blue">
																		<?php 
																		$utilnetaAt=$utilbrutaAt-$gastosAt;
																		 ?>
						<span class="label label-danger arrowed arrowed-right"><?php echo("$ ".number_format($utilnetaAt)) ?></span>
																	</b>
																</td>

																<td class="center">
																	<b class="blue">
																		<?php 
																		$utilnetaAc=$utilbrutaAc-$gastosAc;
																		 ?>
						<span class="label label-danger arrowed arrowed-right"><?php echo("$ ".number_format($utilnetaAc)) ?></span>
																	</b>
																</td>
															</tr>
															<tr>
																<td>Margen Neto</td>
																<td class="center">
																	<b class="blue">
																		<?php 
																		if ($ventaAt==0) {
																			$margennetoAt=0;
																		}
																		else
																		{
																			$sumagastosAt=$costosAt+$gastosAt;
																			$opera1=$sumagastosAt/$ventaAt;
																			$opera2=1-$opera1;
																			$margennetoAt=$opera2*100;

																		}
																		echo(round($margennetoAt,1));
																		 ?>
																		 %
																	</b>
																</td>

																<td class="center">
																	<b class="blue">
																		<?php 
																		if ($ventaAc==0) {
																			$margennetoAc=0;
																		}
																		else
																		{
																			$sumagastosAc=$costosAc+$gastosAc;
																			$opera1ac=$sumagastosAc/$ventaAc;
																			$opera2ac=1-$opera1ac;
																			$margennetoAc=$opera2ac*100;

																		}
																		echo(round($margennetoAc,1));
																		 ?>
																		 %
																	</b>
																</td>
															</tr>
														</tbody>
													</table>
												</div><!-- /.widget-main -->
											</div><!-- /.widget-body -->
										</div><!-- /.widget-box -->
									</div><!-- /.col -->
										<div class="col-xs-12 col-sm-8"><!-- /INICIO GRAFICA -->
        <div id="chartContainer" style="height: 350px; width: 100%;"></div>
        <h2><a href="Informe-flujocajatienda.php?QueryCon=<?php echo $TiendaSel; ?>">Auditar flujo de caja tienda <?php echo($NombreTienda); ?> <i class="fa fa-external-link"> </i></a></h2>
      </div><!-- /FINAL GRAFICA -->
      <hr>
						</div><!-- /FINAL SEGUNDA LINEA -->
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
		<script type="text/javascript" src="https://modasof.com/espejo/assets/js/jquery.tinycircleslider.js"></script>
    <!-- /build -->
	<script type="text/javascript">
		$(document).ready(function()
		{
			$('#rotatescroll').tinycircleslider({ interval: true, dotsSnap: true, dotsHide: true });
		});
	</script>
	 <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer", {
		exportEnabled: true,
	title:{
		text: "Flujo de Ingresos Modasof <?php echo($mes_fin_trim); ?>"
	},
	axisY:[{
		title: "Medios de Pago",
		lineColor: "#C24642",
		tickColor: "#C24642",
		labelFontColor: "#C24642",
		titleFontColor: "#C24642",
      	prefix: "$",
		suffix: ""
	},
	],
      axisY2:[{
		title: "Total Ingresos",
		lineColor: "#C24642",
		tickColor: "#C24642",
		labelFontColor: "#C24642",
		titleFontColor: "#C24642",
      	prefix: "$",
		suffix: ""
	},
	],
	toolTip: {
		shared: true
	},
	legend: {
		cursor: "pointer",
		itemclick: toggleDataSeries
	},
	data: [{
		type: "line",
		name: "Efectivo",
		color: "#369EAD",
		showInLegend: true,
		axisYIndex: 1,
		dataPoints: [

		<?php 
// Consulta por día 
$mesactualgra = date("n");
$mesvector=$mesactualgra-1;

$sql ="SELECT DATE_FORMAT(fecha_ingreso, '%d') as DIA, IFNULL(SUM(Valor_Ingreso),0) AS total FROM t_ingresos WHERE MONTH(Fecha_Ingreso)='".$mesactualgra."' and Tienda_id_tienda='".$TiendaSel."' and Medio_Pago='1' and YEAR(Fecha_Ingreso)='".$AnoActual."' GROUP by DIA";  
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$DIA=$row['DIA'];
$TB=$row['total'];
     ?> 
      { x: new Date(2019, <?php echo($mesvector) ?>, <?php echo($DIA) ?>), y: <?php echo($TB) ?> },
     <?php 
   }
  }
      ?>
		]
	},
	{
		type: "line",
		name: "Total",
		color: "#C24642",
		axisYIndex: 0,
		showInLegend: true,
		dataPoints: [
			<?php 
// Consulta por día 
$mesactualgra = date("n");
$mesvector=$mesactualgra-1;

$sql ="SELECT DATE_FORMAT(fecha_ingreso, '%d') as DIA, IFNULL(SUM(Valor_Ingreso),0) AS total FROM t_ingresos WHERE MONTH(Fecha_Ingreso)='".$mesactualgra."' and Tienda_id_tienda='".$TiendaSel."' and YEAR(Fecha_Ingreso)='".$AnoActual."' GROUP by DIA";  
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$DIA=$row['DIA'];
$TB=$row['total'];
     ?> 
      { x: new Date(2019, <?php echo($mesvector) ?>, <?php echo($DIA) ?>), y: <?php echo($TB) ?> },
     <?php 
   }
  }
      ?>
		]
	},
	{
		type: "line",
		name: "Transferencia",
		color: "#7F6084",
		
		showInLegend: true,
		dataPoints: [
		
		]
	}]
});
chart.render();

function toggleDataSeries(e) {
	if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	} else {
		e.dataSeries.visible = true;
	}
	e.chart.render();
}

}
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

		
		<!-- inline scripts related to this page -->

		
	

<script type="text/javascript">
        $(document).ready(function()
        {
             $("#FormUsuario").validate({
             	errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
                 rules: {
                     "TxtNombreUser": { required:true },
                     "TxtApellidos": { required:true }, 
                     "TxtCelular": { required:true }, 
                     "Fotoperfil": { required:true },
                     "TxtRol": { required:true }, 
                     "TxtCorreo": { required:true, email:true },  
                     "TxtPass": { required:true }, 

                 },
                 messages: {
                     "Fotoperfil": { required:"Debes subir una imagen",},
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
             $("#FormEditarUsuario").validate({
             	errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
                 rules: {
                     "TxtEdNombreUser": { required:true },
                     "TxtEdApellidos": { required:true }, 
                     "TxtEdCelular": { required:true }, 
                     "TxtEdUserName": { required:true },
                     "TxtEdRol": { required:true }, 
                     "TxtEdCorreo": { required:true, email:true },  
                     "TxtEdPass": { required:true }, 

                 },
                 messages: {
                     
                    	"TxtEdCorreo": { required:"Por favor incluir un E-mail válido",email: "Por favor incluir un E-mail válido" },
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
    	"responsive":true,
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

				jQuery.validator.addMethod("phone", function (value, element) {
					return this.optional(element) || /^\(\d{3}\) \d{3}\-\d{4}( x\d{1,6})?$/.test(value);
				}, "Ingresar un número válido");

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
			
				
				$('#id-input-file-1 , #Fotoperfil').ace_file_input({
					no_file:'No se ha seleccionado un archivo ...',
					btn_choose:'Seleccionar',
					btn_change:'Cambiar',
					droppable:false,
					onchange:null,
					thumbnail:true, //| true | large
					whitelist:'gif|png|jpg|jpeg',
					blacklist:'exe|php|csv|xls',
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
