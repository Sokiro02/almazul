<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
include("Lib/estadisticas_index.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];
include("Lib/permisos.php");
include("Lib/seguridad.php");
//$seguridad = AgregarLog($IdUser,"Entrada a Pagina Principal","index.php");

$mes_inicio_trim = NomMes(date("n")-2);
$mes_sig_trim = NomMes(date("n")-1);
$mes_fin_trim = NomMes(date("n"));

$FechaActual = date('Y-m-d');
$DiaActual=date("d");
$MesActual=date("m");

$GraficaArriba=date("m")-2;
$GraficaAbajo=date("m")-1;

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


// Variables de Fechas 
date_default_timezone_set("America/Bogota");
$MarcaTemporal = date('Y-m-d');

$FechaInicioDia=($MarcaTemporal." 00:00:000");
$FechaFinalDia=($MarcaTemporal." 23:59:000");

// Día Anterior 
$diaantes=date("Y-m-d",strtotime($MarcaTemporal."- 1 day")); 
$FechaIniciodiaantes=$diaantes." 00:00:0000";
$FechaFinaldiaantes=$diaantes." 23:59:0000";

// Últimos 30 días
$mesantes=date("Y-m-d",strtotime($MarcaTemporal."- 1 month")); 
$FechaInicio30dias=$mesantes." 00:00:0000";
$FechaFinal30dias=$MarcaTemporal." 23:59:0000";

// Últimos 60 días
$dosmesantes=date("Y-m-d",strtotime($MarcaTemporal."- 2 month")); 
$FechaInicio60dias=$dosmesantes." 00:00:0000";
$FechaFinal60dias=$mesantes." 23:59:0000";





// Salidas contables por tienda y fecha ayer y hoy 
// 1 Fila 
$valle_salidasayer=Salidascontablesporfecha(1,$FechaIniciodiaantes,$FechaFinaldiaantes);
$barra_salidasayer=Salidascontablesporfecha(11,$FechaIniciodiaantes,$FechaFinaldiaantes);
$valle_salidashoy=Salidascontablesporfecha(1,$FechaInicioDia,$FechaFinalDia);
$barra_salidashoy=Salidascontablesporfecha(11,$FechaInicioDia,$FechaFinalDia);

$totaltabla_1_1=$valle_salidasayer+$barra_salidasayer;
$totaltabla_1_2=$valle_salidashoy+$barra_salidashoy;

// Ingresos y fecha ayer y hoy 
// 1 Fila 
$Jvalle_salidasayer=Ingresosporfecha($FechaIniciodiaantes,$FechaFinaldiaantes);

$Jvalle_salidashoy=Ingresosporfecha($FechaInicioDia,$FechaFinalDia);


$Jtotaltabla_1_1=$Jvalle_salidasayer;
$Jtotaltabla_1_2=$Jvalle_salidashoy;



// Salidas contables por tienda y fecha Mes a mes
// 1 Fila 
$valle_salidasmesActual=Salidascontablesporfecha(1,$FechaInicio30dias,$FechaFinal30dias);
$barra_salidasmesActual=Salidascontablesporfecha(11,$FechaInicio30dias,$FechaFinal30dias);
$valle_salidasmesAnterior=Salidascontablesporfecha(1,$FechaInicio60dias,$FechaFinal60dias);
$barra_salidasmesAnterior=Salidascontablesporfecha(11,$FechaInicio60dias,$FechaFinal60dias);

$MesActualtotaltabla_1_1=$valle_salidasmesActual+$barra_salidasmesActual;
$MesAnteriortotaltabla_1_2=$valle_salidasmesAnterior+$barra_salidasmesAnterior;

// Contar Salidas contables por tienda y fecha Mes a mes
// 1 Fila 
$Contarvalle_salidasmesActual=ContarSalidascontablesporfecha(1,$FechaInicio30dias,$FechaFinal30dias);
$Contarbarra_salidasmesActual=ContarSalidascontablesporfecha(11,$FechaInicio30dias,$FechaFinal30dias);
$Contarvalle_salidasmesAnterior=ContarSalidascontablesporfecha(1,$FechaInicio60dias,$FechaFinal60dias);
$Contarbarra_salidasmesAnterior=ContarSalidascontablesporfecha(11,$FechaInicio60dias,$FechaFinal60dias);

$ContarMesActualtotaltabla_1_1=$Contarvalle_salidasmesActual+$Contarbarra_salidasmesActual;
$ContarMesAnteriortotaltabla_1_2=$Contarvalle_salidasmesAnterior+$Contarbarra_salidasmesAnterior;




// Salidas contables por tienda y fecha ayer y hoy 
// 2 Fila 
$Bvalle_salidasayer=TotalPrendasporfecha(1,$FechaIniciodiaantes,$FechaFinaldiaantes);
$Bbarra_salidasayer=TotalPrendasporfecha(11,$FechaIniciodiaantes,$FechaFinaldiaantes);
$Bvalle_salidashoy=TotalPrendasporfecha(1,$FechaInicioDia,$FechaFinalDia);
$Bbarra_salidashoy=TotalPrendasporfecha(11,$FechaInicioDia,$FechaFinalDia);

$Btotaltabla_1_1=$Bvalle_salidasayer+$Bbarra_salidasayer;
$Btotaltabla_1_2=$Bvalle_salidashoy+$Bbarra_salidashoy;



// Salidas contables por tienda y fecha Mes a mes
// 2 Fila 
$Bvalle_salidasmesActual=TotalPrendasporfecha(1,$FechaInicio30dias,$FechaFinal30dias);
$Bbarra_salidasmesActual=TotalPrendasporfecha(11,$FechaInicio30dias,$FechaFinal30dias);
$Bvalle_salidasmesAnterior=TotalPrendasporfecha(1,$FechaInicio60dias,$FechaFinal60dias);
$Bbarra_salidasmesAnterior=TotalPrendasporfecha(11,$FechaInicio60dias,$FechaFinal60dias);

$BMesActualtotaltabla_1_1=$Bvalle_salidasmesActual+$Bbarra_salidasmesActual;
$BMesAnteriortotaltabla_1_2=$Bvalle_salidasmesAnterior+$Bbarra_salidasmesAnterior;


// Total Pedidos por tienda y fecha ayer y hoy 
// 3 Fila 
$Cvalle_salidasayer=ValorPedidosporfecha(1,$FechaIniciodiaantes,$FechaFinaldiaantes);
$Cbarra_salidasayer=ValorPedidosporfecha(11,$FechaIniciodiaantes,$FechaFinaldiaantes);
$Cvalle_salidashoy=ValorPedidosporfecha(1,$FechaInicioDia,$FechaFinalDia);
$Cbarra_salidashoy=ValorPedidosporfecha(11,$FechaInicioDia,$FechaFinalDia);

$Ctotaltabla_1_1=$Cvalle_salidasayer+$Cbarra_salidasayer;
$Ctotaltabla_1_2=$Cvalle_salidashoy+$Cbarra_salidashoy;


// Total Pedidos por tienda y fecha Mes a mes
// 3 Fila 
$Cvalle_salidasmesActual=ValorPedidosporfecha(1,$FechaInicio30dias,$FechaFinal30dias);
$Cbarra_salidasmesActual=ValorPedidosporfecha(11,$FechaInicio30dias,$FechaFinal30dias);
$Cvalle_salidasmesAnterior=ValorPedidosporfecha(1,$FechaInicio60dias,$FechaFinal60dias);
$Cbarra_salidasmesAnterior=ValorPedidosporfecha(11,$FechaInicio60dias,$FechaFinal60dias);

$CMesActualtotaltabla_1_1=$Cvalle_salidasmesActual+$Cbarra_salidasmesActual;
$CMesAnteriortotaltabla_1_2=$Cvalle_salidasmesAnterior+$Cbarra_salidasmesAnterior;


// Total Pedidos por tienda franquicias y fecha Mes a mes
// 3 Fila 
$CFvalle_salidasmesActual=ValorPedidosporfecha(3,$FechaInicio30dias,$FechaFinal30dias);
$CFbarra_salidasmesActual=ValorPedidosporfecha(7,$FechaInicio30dias,$FechaFinal30dias);
$CFvalle_salidasmesAnterior=ValorPedidosporfecha(3,$FechaInicio60dias,$FechaFinal60dias);
$CFbarra_salidasmesAnterior=ValorPedidosporfecha(7,$FechaInicio60dias,$FechaFinal60dias);

$CFMesActualtotaltabla_1_1=($CFvalle_salidasmesActual+$CFbarra_salidasmesActual)/2;
$CFMesAnteriortotaltabla_1_2=($CFvalle_salidasmesAnterior+$CFbarra_salidasmesAnterior)/2;






// Contar Pedidos por tienda y fecha ayer y hoy 
// 4 Fila 
$Dvalle_salidasayer=ContarPedidosporfecha(1,$FechaIniciodiaantes,$FechaFinaldiaantes);
$Dbarra_salidasayer=ContarPedidosporfecha(11,$FechaIniciodiaantes,$FechaFinaldiaantes);
$Dvalle_salidashoy=ContarPedidosporfecha(1,$FechaInicioDia,$FechaFinalDia);
$Dbarra_salidashoy=ContarPedidosporfecha(11,$FechaInicioDia,$FechaFinalDia);

$Dtotaltabla_1_1=$Dvalle_salidasayer+$Dbarra_salidasayer;
$Dtotaltabla_1_2=$Dvalle_salidashoy+$Dbarra_salidashoy;


// Contar Pedidos por tienda y fecha Mes a mes
// 4 Fila 
$Dvalle_salidasmesActual=ContarPedidosporfecha(1,$FechaInicio30dias,$FechaFinal30dias);
$Dbarra_salidasmesActual=ContarPedidosporfecha(11,$FechaInicio30dias,$FechaFinal30dias);
$Dvalle_salidasmesAnterior=ContarPedidosporfecha(1,$FechaInicio60dias,$FechaFinal60dias);
$Dbarra_salidasmesAnterior=ContarPedidosporfecha(11,$FechaInicio60dias,$FechaFinal60dias);

$DMesActualtotaltabla_1_1=$Dvalle_salidasmesActual+$Dbarra_salidasmesActual;
$DMesAnteriortotaltabla_1_2=$Dvalle_salidasmesAnterior+$Dbarra_salidasmesAnterior;

// Contar Pedidos por Franquicia tienda y fecha Mes a mes
// 4 Fila 
$DFvalle_salidasmesActual=ContarPedidosporfecha(3,$FechaInicio30dias,$FechaFinal30dias);
$DFbarra_salidasmesActual=ContarPedidosporfecha(7,$FechaInicio30dias,$FechaFinal30dias);
$DFvalle_salidasmesAnterior=ContarPedidosporfecha(3,$FechaInicio60dias,$FechaFinal60dias);
$DFbarra_salidasmesAnterior=ContarPedidosporfecha(7,$FechaInicio60dias,$FechaFinal60dias);

$DFMesActualtotaltabla_1_1=$DFvalle_salidasmesActual+$DFbarra_salidasmesActual;
$DFMesAnteriortotaltabla_1_2=$DFvalle_salidasmesAnterior+$DFbarra_salidasmesAnterior;


// Contar Prendas Pedidos por tienda y fecha ayer y hoy 
// 5 Fila 
$Evalle_salidasayer=ContarPrendasPedidosporfecha(1,$FechaIniciodiaantes,$FechaFinaldiaantes);
$Ebarra_salidasayer=ContarPrendasPedidosporfecha(11,$FechaIniciodiaantes,$FechaFinaldiaantes);
$Evalle_salidashoy=ContarPrendasPedidosporfecha(1,$FechaInicioDia,$FechaFinalDia);
$Ebarra_salidashoy=ContarPrendasPedidosporfecha(11,$FechaInicioDia,$FechaFinalDia);

$Etotaltabla_1_1=$Evalle_salidasayer+$Ebarra_salidasayer;
$Etotaltabla_1_2=$Evalle_salidashoy+$Ebarra_salidashoy;


// Contar Prendas Pedidos por tienda y fecha Mes a mes
// 5 Fila 
$Evalle_salidasmesActual=ContarPrendasPedidosporfecha(1,$FechaInicio30dias,$FechaFinal30dias);
$Ebarra_salidasmesActual=ContarPrendasPedidosporfecha(11,$FechaInicio30dias,$FechaFinal30dias);
$Evalle_salidasmesAnterior=ContarPrendasPedidosporfecha(1,$FechaInicio60dias,$FechaFinal60dias);
$Ebarra_salidasmesAnterior=ContarPrendasPedidosporfecha(11,$FechaInicio60dias,$FechaFinal60dias);

$EMesActualtotaltabla_1_1=$Evalle_salidasmesActual+$Ebarra_salidasmesActual;
$EMesAnteriortotaltabla_1_2=$Evalle_salidasmesAnterior+$Ebarra_salidasmesAnterior;

// Contar Prendas Pedidos Franquicias por tienda y fecha Mes a mes
// 5 Fila 
$EFvalle_salidasmesActual=ContarPrendasPedidosporfecha(3,$FechaInicio30dias,$FechaFinal30dias);
$EFbarra_salidasmesActual=ContarPrendasPedidosporfecha(7,$FechaInicio30dias,$FechaFinal30dias);
$EFvalle_salidasmesAnterior=ContarPrendasPedidosporfecha(3,$FechaInicio60dias,$FechaFinal60dias);
$EFbarra_salidasmesAnterior=ContarPrendasPedidosporfecha(7,$FechaInicio60dias,$FechaFinal60dias);

$EFMesActualtotaltabla_1_1=$EFvalle_salidasmesActual+$EFbarra_salidasmesActual;
$EFMesAnteriortotaltabla_1_2=$EFvalle_salidasmesAnterior+$EFbarra_salidasmesAnterior;


// Contar Clientes por tienda y fecha Mes a mes
// 6 Fila 
$Fvalle_salidasmesActual=numeroclientesFecha(1,$FechaInicio30dias,$FechaFinal30dias);
$Fbarra_salidasmesActual=numeroclientesFecha(11,$FechaInicio30dias,$FechaFinal30dias);
$Fvalle_salidasmesAnterior=numeroclientesFecha(1,$FechaInicio60dias,$FechaFinal60dias);
$Fbarra_salidasmesAnterior=numeroclientesFecha(11,$FechaInicio60dias,$FechaFinal60dias);

$FMesActualtotaltabla_1_1=$Fvalle_salidasmesActual+$Fbarra_salidasmesActual;
$FMesAnteriortotaltabla_1_2=$Fvalle_salidasmesAnterior+$Fbarra_salidasmesAnterior;

// Contar Clientes por tienda y fecha Mes a mes
// 7 Fila 
$Gvalle_salidasmesActual=numeroclientesNuevosFecha($FechaInicio30dias,$FechaFinal30dias);
$Gvalle_salidasmesAnterior=numeroclientesNuevosFecha($FechaInicio60dias,$FechaFinal60dias);


$GMesActualtotaltabla_1_1=$Gvalle_salidasmesActual;
$GMesAnteriortotaltabla_1_2=$Gvalle_salidasmesAnterior;


// Promedio compra Clientes por tienda y fecha Mes a mes
// 8 Fila 
$Hvalle_salidasmesActual=promediofechacompratienda(1,$FechaInicio30dias,$FechaFinal30dias);
$Hbarra_salidasmesActual=promediofechacompratienda(11,$FechaInicio30dias,$FechaFinal30dias);
$Hvalle_salidasmesAnterior=promediofechacompratienda(1,$FechaInicio60dias,$FechaFinal60dias);
$Hbarra_salidasmesAnterior=promediofechacompratienda(11,$FechaInicio60dias,$FechaFinal60dias);

$HMesActualtotaltabla_1_1=($Hvalle_salidasmesActual+$Hbarra_salidasmesActual)/2;
$HMesAnteriortotaltabla_1_2=($Hvalle_salidasmesAnterior+$Hbarra_salidasmesAnterior)/2;

// Ingresos en Dinero
// 9 Fila 
$Ivalle_salidasmesActual=Ingresosporfecha($FechaInicio30dias,$FechaFinal30dias);
$Ivalle_salidasmesAnterior=Ingresosporfecha($FechaInicio60dias,$FechaFinal60dias);

$IMesActualtotaltabla_1_1=$Ivalle_salidasmesActual;
$IMesAnteriortotaltabla_1_2=$Ivalle_salidasmesAnterior;

?>
<?php 
		include("semana.php");
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
	
	</head>

	<body class="skin-1">

	<?php 
  $Valide=$_GET['Mensaje'];

    if ($Valide==1) {
        echo "<script>jQuery(function(){swal(\"¡ Gasto Subido!\", \"Correctamente \", \"success\");});</script>";
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
								<a href="index.php">Auditar Cajas Modasof</a>
							</li>
							<li class="dropdown">
													<a data-toggle="dropdown" class="dropdown-toggle black" href="#">
														<strong class="badge bg-black">Informe por Tienda &nbsp;</strong>
														<i class="ace-icon fa fa-caret-down bigger-110 width-auto"></i>
													</a>

													<ul class="dropdown-menu dropdown-info">
														<li>
				<a  href="Informe-Ingresos.php">Ver todas las tiendas</a>
			</li>
														<?php
$sql ="SELECT Id_Tienda, Nom_Tienda FROM t_tiendas where Id_Tienda<>'2' AND Id_Tienda<>'3'AND Id_Tienda<>'4'AND Id_Tienda<>'5'AND Id_Tienda<>'6' AND Id_Tienda<>'7' AND Id_Tienda<>'8' AND Id_Tienda<>'9' AND Id_Tienda<>'10' order by Nom_Tienda asc";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
    	$SelectDown=$row['Id_Tienda'];
    	$NomDown=$row['Nom_Tienda'];             
    	?>
    		<li>
				<a  href="Informe-flujocajatienda.php?QueryCon=<?php Echo($SelectDown);?>&Mensaje="><?php Echo utf8_encode($NomDown); ?></a>
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

     <div style="margin-bottom: -10px;" class="owl-carousel">

    <?php
$sql ="SELECT DISTINCT(Pedido_Id_Usuario),SUM(Total_Pedido) as total FROM `t_pedido` WHERE MONTH(Fecha_Pedido)='".$MesActual."' and YEAR(Fecha_Pedido)='".$AnoActual."' GROUP BY Pedido_Id_Usuario ORDER BY total DESC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
    	$total=$row['total'];
    	$Pedido_Id_Usuario=$row['Pedido_Id_Usuario'];
    	$fotoperfil=ObtenerfotoUsuario($Pedido_Id_Usuario);
    	$nombreperfil=ObtenersolonombreUsuario($Pedido_Id_Usuario);          
    	?>
           <ul style="list-style:none;" class="small-block-grid-3 medium-block-grid-4 large-block-grid-6">
                <li style="text-align: center;">
                	 <img style="width: 50px;height: 50px; margin-left: 30px;" class="img-circle" src="<?php echo($fotoperfil) ?>" alt="User Image">
                   <h6 class="text-left accion up text-blue" title="Total Pedidos Mes Actual"><?php echo(ucfirst($nombreperfil)); ?></h6>
                   <h6 style="color: blue;" class="subheader accion up text-blue"><span class="var right"><i class="fa fa-bar-chart"> </i> <strong> Pedidos: </strong> $ <?php echo(number_format($total,0)); ?></span><br class="show-for-small"></h6>
                  
                </li>
          </ul>
          <?php
 }
}
            
?>	
          
    <?php 

    //**************************************************************************************
    //**************************************************************************************
    //**************************************************************************************
    //**************************************************************************************
    //**************************************************************************************

     ?>
     <?php 
$sql ="SELECT B.Img_Referencia, Referencia_Id_Referencia, IFNULL(SUM(Cant_Solicitada),0) AS TotalVentas FROM t_ventas as A, t_referencias as B WHERE A.Referencia_Id_Referencia=B.Cod_Referencia and month(fecha_solicitud)='".$MesActual."' and YEAR(fecha_solicitud)='".$AnoActual."' GROUP BY Referencia_Id_Referencia ORDER BY SUM(Cant_Solicitada) DESC LIMIT 0 , 5"; 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $VImg_Referencia=$row['Img_Referencia'];
         $VTotalVentas=$row['TotalVentas'];
         $VReferencia_Id_Referencia=$row['Referencia_Id_Referencia'];
		 ?>
			<ul style="list-style:none;" class="small-block-grid-3 medium-block-grid-4 large-block-grid-6">
                <li style="text-align: center;">
                	 <img style="width: 50px;height: 50px; margin-left: 30px;" class="img-circle" src="<?php echo($VImg_Referencia) ?>" alt="User Image">
                   <h6 class="text-left accion up text-blue" title="Total Ventas Mes Actual"> <?php echo(ucfirst($VReferencia_Id_Referencia)); ?></h6>
                   <h6 style="color: green;" class="subheader accion up text-blue"><span class="var right"><i class="fa fa-arrow-circle-up"> </i><strong> Top 5 Ventas: </strong><?php echo($VTotalVentas); ?> Und.</span><br class="show-for-small"></h6>
                  
                </li>
          </ul>	

		<?php 
	}
}
		 ?>
        
      
          
     <?php 

    //**************************************************************************************
    //**************************************************************************************
    //**************************************************************************************
    //**************************************************************************************
    //**************************************************************************************

     ?>
        
       <?php 
$sql ="SELECT B.Img_Referencia, Referencia_Id_Referencia, IFNULL(SUM(Cant_Solicitada),0) AS TotalVentas FROM t_temporal_sol as A, t_referencias as B WHERE A.Referencia_Id_Referencia=B.Cod_Referencia and month(A.fecha_solicitud)='".$MesActual."' and YEAR(A.fecha_solicitud)='".$AnoActual."'  GROUP BY Referencia_Id_Referencia ORDER BY SUM(Cant_Solicitada) DESC LIMIT 0 , 5"; 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Img_Referencia=$row['Img_Referencia'];
         $TotalVentas=$row['TotalVentas'];
         $Referencia_Id_Referencia=$row['Referencia_Id_Referencia'];
		 ?>
			<ul style="list-style:none;" class="small-block-grid-3 medium-block-grid-4 large-block-grid-6">
                <li style="text-align: center;">
                	 <img style="width: 50px;height: 50px; margin-left: 30px;" class="img-circle" src="<?php echo($Img_Referencia) ?>" alt="User Image">
                   <h6 class="text-left accion up text-blue" title="Total Pedidos Mes Actual"> <?php echo(ucfirst($Referencia_Id_Referencia)); ?></h6>
                   <h6 style="color: red;" class="subheader accion up text-blue"><span class="var right"><i class="fa fa-arrow-circle-up"> </i><strong> Top 5 Pedidos: </strong><?php echo($TotalVentas); ?> Und.</span><br class="show-for-small"></h6>
                  
                </li>
          </ul>	

		<?php 
	}
}
		 ?>

      </div>
<div class="col-md-3">
		<div class="box">
            <div class="box-header">
              <h4 class="box-title">Indicadores Online  <i class="fa fa-circle text-success"></i></h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table style="font-size: 13px;" class="table table-hover">
                <tbody><tr>
                  <th></th>
                  <th>Ayer<br><small style="font-size: 8px;color: #ABBAC3;"><?php echo($diaantes) ?></small></th>
                  <th>Hoy<br><small style="font-size: 8px;color: #ABBAC3;"><?php echo($MarcaTemporal) ?></small></th>
                 
                  
                </tr>
                
                <tr>
                  <td>Salidas Contables</td>
                  <td><a href="Informe-salidacontable.php?QueryCon=&start=<?php echo($diaantes);?>&end=<?php echo($diaantes); ?>"><?php echo("$ ".number_format($totaltabla_1_1,0)) ?></a></td>
                  <td><a href="Informe-salidacontable.php?QueryCon=&start=<?php echo($MarcaTemporal);?>&end=<?php echo($MarcaTemporal); ?>"><?php echo("$ ".number_format($totaltabla_1_2,0)) ?></a></td>
                 
                </tr>
                <tr>
                  <td>Ingresos</td>
                  <td><a href="Informe-Ingresos.php?QueryCon=&start=<?php echo($diaantes);?>&end=<?php echo($diaantes); ?>"><?php echo("$ ".number_format($Jtotaltabla_1_1,0)) ?></a></td>
                  <td><a href="Informe-Ingresos.php?QueryCon=&start=<?php echo($MarcaTemporal);?>&end=<?php echo($MarcaTemporal); ?>"><?php echo("$ ".number_format($Jtotaltabla_1_2,0)) ?></a></td>
                 
                </tr>
                 <tr>
                  <td>Prendas Vendidas</td>
                  <td><a href="Misventasne.php?QueryCon=&start=<?php echo($diaantes);?>&end=<?php echo($diaantes); ?>"><?php echo($Btotaltabla_1_1) ?></a></td>
                  <td><a href="Misventasne.php?QueryCon=&start=<?php echo($MarcaTemporal);?>&end=<?php echo($MarcaTemporal); ?>"><?php echo($Btotaltabla_1_2) ?></a></td>
                 
                </tr>
                <tr class="info">
                	<td style="font-weight: bold;" colspan="3">Indicadores Pedidos VALL-BARR</td>
                </tr>
                 <tr>
                  <td>Total en Pedidos</td>

                   <td><a href="pedidosfecha.php?QueryCon=&start=<?php echo($diaantes);?>&end=<?php echo($diaantes); ?>"><?php echo("$ ".number_format($Ctotaltabla_1_1,0)) ?></a></td>
                  <td><a href="pedidosfecha.php?QueryCon=&start=<?php echo($MarcaTemporal);?>&end=<?php echo($MarcaTemporal); ?>"><?php echo("$ ".number_format($Ctotaltabla_1_2,0)) ?></a></td>
                  
                </tr>
                
                  <tr>
                  <td>Nº Pedidos</td>
                  <td><a href="pedidosfecha.php?QueryCon=&start=<?php echo($diaantes);?>&end=<?php echo($diaantes); ?>"><?php echo($Dtotaltabla_1_1) ?></a></td>
                  <td><a href="pedidosfecha.php?QueryCon=&start=<?php echo($MarcaTemporal);?>&end=<?php echo($MarcaTemporal); ?>"><?php echo($Dtotaltabla_1_2) ?></a></td>
                </tr>
                  <tr>
                  <td>Prendas a producir</td>
                 <td><a href="pedidosfecha.php?QueryCon=&start=<?php echo($diaantes);?>&end=<?php echo($diaantes); ?>"><?php echo($Etotaltabla_1_1) ?></a></td>
                  <td><a href="pedidosfecha.php?QueryCon=&start=<?php echo($MarcaTemporal);?>&end=<?php echo($MarcaTemporal); ?>"><?php echo($Etotaltabla_1_2) ?></a></td>
                  
                </tr>
                 </tr>
                  <tr>
                  <td>Pedidos/Prendas </td>
                   <td>
                  	<?php
                  	if ($Dtotaltabla_1_1==0) {
                  	 	$promedioprendas1=0;
                  	 } 
                  	else
                  	{
                  		$promedioprendas1=$Etotaltabla_1_1/$Dtotaltabla_1_1;
                  	}
                  	echo(round($promedioprendas1,2)." Prendas");
                   ?></td>
                  <td>
                  	<?php 
                  	if ($Dtotaltabla_1_2==0) {
                  		$promedioprendas2=0;
                  	}
                  	else{
                  		$promedioprendas2=$Etotaltabla_1_2/$Dtotaltabla_1_2;
                  	}
                  	

                  	echo(round($promedioprendas2,2)." Prendas");
                   ?>
                  </td>
                  
                </tr>
                 
               
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
		</div>



<div class="col-md-5">
		<div class="box">
            <div class="box-header">
              <h4 class="box-title">Indicadores Pedidos  <i class="fa fa-circle text-success"></i></h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table style="font-size: 13px;" class="table table-hover">
                <tbody><tr>
                  <th></th>
                  <th>Corte Anterior <br><small style="font-size: 8px;color: #ABBAC3;"><?php echo($dosmesantes." Al ".$mesantes) ?></small></th>
                  <th>Últ. 30 días <br><small style="font-size: 8px;color: #ABBAC3;"><?php echo($mesantes." Al ".$MarcaTemporal) ?></small></th>
                  <th>%</th>
                  
                </tr>
               
                <tr class="info">
                	<td style="font-weight: bold;" colspan="3">Indicadores Pedidos VALL-BARR</td>
                </tr>
                 <tr>
                  <td>Total en Pedidos</td>
                  <td><a href="pedidosfecha.php?QueryCon=&start=<?php echo($dosmesantes);?>&end=<?php echo($mesantes); ?>"><?php echo("$ ".number_format($CMesAnteriortotaltabla_1_2,0)) ?></a></td>
                  <td><a href="pedidosfecha.php?QueryCon=&start=<?php echo($mesantes);?>&end=<?php echo($MarcaTemporal); ?>"><?php echo("$ ".number_format($CMesActualtotaltabla_1_1,0)) ?></a></td>
                  <?php 
                  

                  	if ($CMesActualtotaltabla_1_1==0) {
                  		$valorpedidosporcentaje=0;
                  	}else{
                  			$valorpedidosporcentaje=(($CMesActualtotaltabla_1_1-$CMesAnteriortotaltabla_1_2)/$CMesAnteriortotaltabla_1_2)*100;
                  	}

                  	if ($valorpedidosporcentaje>0) {
            	echo "<td><span class='label label-success'><i class='fa fa-caret-up'></i> ".round($valorpedidosporcentaje,2)." %</span></td>";
                  	}
                  	else
                  	{
                echo "<td><span class='label label-danger'><i class='fa fa-caret-down'></i> ".round($valorpedidosporcentaje,2)." %</span></td>";
                  	}
                  	
                  	 ?>
                </tr>
              
                  <tr>
                  <td>Nº Pedidos</td>
                   <td><a href="pedidosfecha.php?QueryCon=&start=<?php echo($dosmesantes);?>&end=<?php echo($mesantes); ?>"><?php echo($DMesAnteriortotaltabla_1_2) ?></a></td>
                  <td><a href="pedidosfecha.php?QueryCon=&start=<?php echo($mesantes);?>&end=<?php echo($MarcaTemporal); ?>"><?php echo($DMesActualtotaltabla_1_1) ?></a></td>
                  <?php 
                  	
                  	if ($DMesActualtotaltabla_1_1==0) {
                  		$contarpedidosporcentaje=0;
                  	}else{
                  			$contarpedidosporcentaje=(($DMesActualtotaltabla_1_1-$DMesAnteriortotaltabla_1_2)/$DMesAnteriortotaltabla_1_2)*100;

                  	}

                  	if ($contarpedidosporcentaje>0) {
            	echo "<td><span class='label label-success'><i class='fa fa-caret-up'></i> ".round($contarpedidosporcentaje,2)." %</span></td>";
                  	}
                  	else
                  	{
                echo "<td><span class='label label-danger'><i class='fa fa-caret-down'></i> ".round($contarpedidosporcentaje,2)." %</span></td>";
                  	}
                  	
                  	 ?>
                </tr>
                  <tr>
                  <td>Prendas a producir</td>
                   <td><a href="pedidosfecha.php?QueryCon=&start=<?php echo($dosmesantes);?>&end=<?php echo($mesantes); ?>"><?php echo($EMesAnteriortotaltabla_1_2) ?></a></td>
                  <td><a href="pedidosfecha.php?QueryCon=&start=<?php echo($mesantes);?>&end=<?php echo($MarcaTemporal); ?>"><?php echo($EMesActualtotaltabla_1_1) ?></a></td>
                  <?php 
                  

                  		if ($EMesActualtotaltabla_1_1==0) {
                  		$contarprendaspedidosporcentaje=0;
                  	}else{
                  				$contarprendaspedidosporcentaje=(($EMesActualtotaltabla_1_1-$EMesAnteriortotaltabla_1_2)/$EMesAnteriortotaltabla_1_2)*100;

                  	}


                  	if ($contarprendaspedidosporcentaje>0) {
            	echo "<td><span class='label label-success'><i class='fa fa-caret-up'></i> ".round($contarprendaspedidosporcentaje,2)." %</span></td>";
                  	}
                  	else
                  	{
                echo "<td><span class='label label-danger'><i class='fa fa-caret-down'></i> ".round($contarprendaspedidosporcentaje,2)." %</span></td>";
                  	}
                  	
                  	 ?>
                </tr>
                 </tr>
                  <tr>
                  <td>Pedidos/Prendas </td>
                  <td>
                  	<?php 

                  		if ($EMesAnteriortotaltabla_1_2==0) {
                  		$promedioprendas3=0;
                  	}else{
                  				$promedioprendas3=$EMesAnteriortotaltabla_1_2/$DMesAnteriortotaltabla_1_2;
                  	echo(round($promedioprendas3,2)." Prendas");

                  	}

                  	
                   ?></td>
                  <td>
                  	<?php 

                  	if ($EMesActualtotaltabla_1_1==0) {
                  		$promedioprendas4=0;
                  	}else{
                  				$promedioprendas4=$EMesActualtotaltabla_1_1/$DMesActualtotaltabla_1_1;
                  	echo(round($promedioprendas4,2)." Prendas");

                  	}

                  	
                   ?>
                  </td>
                  <?php 
                  if ($promedioprendas4==0) {
                  		$contarprendaspedidosporcentajepr=0;
                  	}else{
                  				$contarprendaspedidosporcentajepr=(($promedioprendas4-$promedioprendas3)/$promedioprendas4)*100;

                  	}

                  	
                  	if ($contarprendaspedidosporcentajepr>0) {
            	echo "<td><span class='label label-success'><i class='fa fa-caret-up'></i> ".round($contarprendaspedidosporcentajepr,2)." %</span></td>";
                  	}
                  	else
                  	{
                echo "<td><span class='label label-danger'><i class='fa fa-caret-down'></i> ".round($contarprendaspedidosporcentajepr,2)." %</span></td>";
                  	}
                  	
                  	 ?>
                </tr>
                 <tr class="warning">
                	<td style="font-weight: bold;" colspan="3">Indicadores Pedidos Franquicias (-50% Descuento)</td>
                </tr>
                 <tr>
                  <td>Total en Pedidos </td>
                  <td><a href="pedidosfecha.php?QueryCon=&start=<?php echo($dosmesantes);?>&end=<?php echo($mesantes); ?>"><?php echo("$ ".number_format($CFMesAnteriortotaltabla_1_2,0)) ?></a></td>
                  <td><a href="pedidosfecha.php?QueryCon=&start=<?php echo($mesantes);?>&end=<?php echo($MarcaTemporal); ?>"><?php echo("$ ".number_format($CFMesActualtotaltabla_1_1,0)) ?></a></td>
                  <?php 

if ($CFMesActualtotaltabla_1_1==0) {
                  		$valorpedidosporcentajeF=0;
                  	}else{
                  				$valorpedidosporcentajeF=(($CFMesActualtotaltabla_1_1-$CFMesAnteriortotaltabla_1_2)/$CFMesAnteriortotaltabla_1_2)*100;

                  	}

                  	
                  	if ($valorpedidosporcentajeF>0) {
            	echo "<td><span class='label label-success'><i class='fa fa-caret-up'></i> ".round($valorpedidosporcentajeF,2)." %</span></td>";
                  	}
                  	else
                  	{
                echo "<td><span class='label label-danger'><i class='fa fa-caret-down'></i> ".round($valorpedidosporcentajeF,2)." %</span></td>";
                  	}
                  	
                  	 ?>
                </tr>
              
                  <tr>
                  <td>Nº Pedidos </td>
                   <td><a href="pedidosfecha.php?QueryCon=&start=<?php echo($dosmesantes);?>&end=<?php echo($mesantes); ?>"><?php echo($DFMesAnteriortotaltabla_1_2) ?></a></td>
                  <td><a href="pedidosfecha.php?QueryCon=&start=<?php echo($mesantes);?>&end=<?php echo($MarcaTemporal); ?>"><?php echo($DFMesActualtotaltabla_1_1) ?></a></td>
                  <?php 

                  if ($DFMesActualtotaltabla_1_1==0) {
                  		$contarpedidosporcentajeF=0;
                  	}else{
                  				$contarpedidosporcentajeF=(($DFMesActualtotaltabla_1_1-$DFMesAnteriortotaltabla_1_2)/$DFMesAnteriortotaltabla_1_2)*100;

                  	}

                  	
                  	if ($contarpedidosporcentajeF>0) {
            	echo "<td><span class='label label-success'><i class='fa fa-caret-up'></i> ".round($contarpedidosporcentajeF,2)." %</span></td>";
                  	}
                  	else
                  	{
                echo "<td><span class='label label-danger'><i class='fa fa-caret-down'></i> ".round($contarpedidosporcentajeF,2)." %</span></td>";
                  	}
                  	
                  	 ?>
                </tr>
                  <tr>
                  <td>Prendas a producir </td>
                   <td><a href="pedidosfecha.php?QueryCon=&start=<?php echo($dosmesantes);?>&end=<?php echo($mesantes); ?>"><?php echo($EFMesAnteriortotaltabla_1_2) ?></a></td>
                  <td><a href="pedidosfecha.php?QueryCon=&start=<?php echo($mesantes);?>&end=<?php echo($MarcaTemporal); ?>"><?php echo($EFMesActualtotaltabla_1_1) ?></a></td>
                  <?php 

                   if ($EFMesActualtotaltabla_1_1==0) {
                  			$contarprendaspedidosporcentajeF=0;
                  	}else{
                  					$contarprendaspedidosporcentajeF=(($EFMesActualtotaltabla_1_1-$EFMesAnteriortotaltabla_1_2)/$EFMesAnteriortotaltabla_1_2)*100;

                  	}

                  
                  	if ($contarprendaspedidosporcentajeF>0) {
            	echo "<td><span class='label label-success'><i class='fa fa-caret-up'></i> ".round($contarprendaspedidosporcentajeF,2)." %</span></td>";
                  	}
                  	else
                  	{
                echo "<td><span class='label label-danger'><i class='fa fa-caret-down'></i> ".round($contarprendaspedidosporcentajeF,2)." %</span></td>";
                  	}
                  	
                  	 ?>
                </tr>
                 </tr>
                  <tr>
                  <td>Pedidos/Prendas </td>
                  <td>
                  	<?php 

                  	if ($EFMesAnteriortotaltabla_1_2==0) {
                  			$promedioprendas3F=0;
                  	}else{
                  			$promedioprendas3F=$EFMesAnteriortotaltabla_1_2/$DFMesAnteriortotaltabla_1_2;
                  	echo(round($promedioprendas3F,2)." Prendas");

                  	}

                  	
                   ?></td>
                  <td>
                  	<?php 

                  	if ($EFMesActualtotaltabla_1_1==0) {
                  			$promedioprendas4F=0;
                  	}else{
                  			$promedioprendas4F=$EFMesActualtotaltabla_1_1/$DFMesActualtotaltabla_1_1;
                  	echo(round($promedioprendas4F,2)." Prendas");

                  	}
                  	
                   ?>
                  </td>
                  <?php 

                  if ($promedioprendas4F==0) {
                  			$contarprendaspedidosporcentajeprF=0;
                  	}else{
                  			$contarprendaspedidosporcentajeprF=(($promedioprendas4F-$promedioprendas3F)/$promedioprendas4F)*100;

                  	}

                  	
                  	if ($contarprendaspedidosporcentajeprF>0) {
            	echo "<td><span class='label label-success'><i class='fa fa-caret-up'></i> ".round($contarprendaspedidosporcentajeprF,2)." %</span></td>";
                  	}
                  	else
                  	{
                echo "<td><span class='label label-danger'><i class='fa fa-caret-down'></i> ".round($contarprendaspedidosporcentajeprF,2)." %</span></td>";
                  	}
                  	
                  	 ?>
                </tr>
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
		</div>


	<div class="col-md-4">
		<div class="box">
            <div class="box-header">
              <h4 class="box-title">Indicadores Ventas  <i class="fa fa-circle text-success"></i></h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table style="font-size: 13px;" class="table table-hover">
                <tbody><tr>
                  <th></th>
                  <th>Mes Anterior <br><small style="font-size: 8px;color: #ABBAC3;"><?php echo($dosmesantes." Al ".$mesantes) ?></small></th>
                  <th>Últ. 30 días <br><small style="font-size: 8px;color: #ABBAC3;"><?php echo($mesantes." Al ".$MarcaTemporal) ?></small></th>
                  <th style="width: 10%">%</th>
                  
                </tr>
                <tr>
                  <td>Total Ventas</td>
                  <td><a href="Informe-salidacontable.php?QueryCon=&start=<?php echo($dosmesantes);?>&end=<?php echo($mesantes); ?>"><?php echo("$ ".number_format($MesAnteriortotaltabla_1_2,0)) ?></a></td>
                  <td><a href="Informe-salidacontable.php?QueryCon=&start=<?php echo($mesantes);?>&end=<?php echo($MarcaTemporal); ?>"><?php echo("$ ".number_format($MesActualtotaltabla_1_1,0)) ?></a></td>
                  <?php 
                  //(D3-C3)/C3
                   if ($MesActualtotaltabla_1_1==0) {
                  			$salidascontablesporcentaje=0;
                  	}else{
                  			$salidascontablesporcentaje=(($MesActualtotaltabla_1_1-$MesAnteriortotaltabla_1_2)/$MesAnteriortotaltabla_1_2)*100;

                  	}

                  	
                  	if ($salidascontablesporcentaje>0) {
            	echo "<td><span class='label label-success'><i class='fa fa-caret-up'></i> ".round($salidascontablesporcentaje,2)." %</span></td>";
                  	}
                  	else
                  	{
                echo "<td><span class='label label-danger'><i class='fa fa-caret-down'></i> ".round($salidascontablesporcentaje,2)." %</span></td>";
                  	}
                  	
                  	 ?>
                  
                </tr>
                <tr>
                  <td>Nº Ventas</td>
                  <td><?php echo($ContarMesAnteriortotaltabla_1_2) ?></td>
                  <td><?php echo($ContarMesActualtotaltabla_1_1) ?></td>
                  <?php 
                  //(D3-C3)/C3
                  if ($ContarMesActualtotaltabla_1_1==0) {
                  			$salidascontablesporcentajecontar=0;
                  	}else{
                  			$salidascontablesporcentajecontar=(($ContarMesActualtotaltabla_1_1-$ContarMesAnteriortotaltabla_1_2)/$ContarMesAnteriortotaltabla_1_2)*100;

                  	}

                  	
                  	if ($salidascontablesporcentajecontar>0) {
            	echo "<td><span class='label label-success'><i class='fa fa-caret-up'></i> ".round($salidascontablesporcentajecontar,2)." %</span></td>";
                  	}
                  	else
                  	{
                echo "<td><span class='label label-danger'><i class='fa fa-caret-down'></i> ".round($salidascontablesporcentajecontar,2)." %</span></td>";
                  	}
                  	
                  	 ?>
                  
                </tr>
                 <tr>
                  <td>Cant. Prendas </td>
                  <td><a href="Misventasne.php?QueryCon=&start=<?php echo($dosmesantes);?>&end=<?php echo($mesantes); ?>"><?php echo($BMesAnteriortotaltabla_1_2) ?></a></td>
                  <td><a href="Misventasne.php?QueryCon=&start=<?php echo($mesantes);?>&end=<?php echo($MarcaTemporal); ?>"><?php echo($BMesActualtotaltabla_1_1) ?></a></td>
                  <?php 
                  //(D3-C3)/C3

                   if ($BMesActualtotaltabla_1_1==0) {
                  			$CantidadPrendasporcentaje=0;
                  	}else{
                  			$CantidadPrendasporcentaje=(($BMesActualtotaltabla_1_1-$BMesAnteriortotaltabla_1_2)/$BMesAnteriortotaltabla_1_2)*100;

                  	}

                  	
                  	if ($CantidadPrendasporcentaje>0) {
            	echo "<td><span class='label label-success'><i class='fa fa-caret-up'></i> ".round($CantidadPrendasporcentaje,2)." %</span></td>";
                  	}
                  	else
                  	{
                echo "<td><span class='label label-danger'><i class='fa fa-caret-down'></i> ".round($CantidadPrendasporcentaje,2)." %</span></td>";
                  	}
                  	
                  	 ?>
                </tr>
                 <tr>
                  <td>Total Clientes </td>
                  <td><?php echo($FMesAnteriortotaltabla_1_2) ?></td>
                  <td><?php echo($FMesActualtotaltabla_1_1) ?></td>
                  <?php 
                  //(D3-C3)/C3

                   if ($FMesActualtotaltabla_1_1==0) {
                  			$CantidadClientesporcentaje=0;
                  	}else{
                  			$CantidadClientesporcentaje=(($FMesActualtotaltabla_1_1-$FMesAnteriortotaltabla_1_2)/$FMesAnteriortotaltabla_1_2)*100;

                  	}

                  	
                  	if ($CantidadClientesporcentaje>0) {
            	echo "<td><span class='label label-success'><i class='fa fa-caret-up'></i> ".round($CantidadClientesporcentaje,2)." %</span></td>";
                  	}
                  	else
                  	{
                echo "<td><span class='label label-danger'><i class='fa fa-caret-down'></i> ".round($CantidadClientesporcentaje,2)." %</span></td>";
                  	}
                  	
                  	 ?>
                </tr>
                 <tr>
                  <td>Ticket Prom.</td>
                  <td><?php echo("$ ".number_format($HMesAnteriortotaltabla_1_2,0)) ?></td>
                  <td><?php echo("$ ".number_format($HMesActualtotaltabla_1_1,0)) ?></td>
                  <?php 
                  //(D3-C3)/C3

                  if ($HMesActualtotaltabla_1_1==0) {
                  			$salidascontablespromedioporcentaje=0;
                  	}else{
                  			$salidascontablespromedioporcentaje=(($HMesActualtotaltabla_1_1-$HMesAnteriortotaltabla_1_2)/$HMesAnteriortotaltabla_1_2)*100;

                  	}

                  	
                  	if ($salidascontablespromedioporcentaje>0) {
            	echo "<td><span class='label label-success'><i class='fa fa-caret-up'></i> ".round($salidascontablespromedioporcentaje,2)." %</span></td>";
                  	}
                  	else
                  	{
                echo "<td><span class='label label-danger'><i class='fa fa-caret-down'></i> ".round($salidascontablespromedioporcentaje,2)." %</span></td>";
                  	}
                  	
                  	 ?>
                </tr>

                 <tr>
                  <td>Clientes Nuevos</td>
                  <td><?php echo($GMesAnteriortotaltabla_1_2) ?></td>
                  <td><?php echo($GMesActualtotaltabla_1_1) ?></td>
                  <?php 
                  //(D3-C3)/C3

                  if ($GMesActualtotaltabla_1_1==0) {
                  			$CantidadClientesNuevosporcentaje=0;
                  	}else{
                  			$CantidadClientesNuevosporcentaje=(($GMesActualtotaltabla_1_1-$GMesAnteriortotaltabla_1_2)/$GMesAnteriortotaltabla_1_2)*100;

                  	}

                  	
                  	if ($CantidadClientesNuevosporcentaje>0) {
            	echo "<td><span class='label label-success'><i class='fa fa-caret-up'></i> ".round($CantidadClientesNuevosporcentaje,2)." %</span></td>";
                  	}
                  	else
                  	{
                echo "<td><span class='label label-danger'><i class='fa fa-caret-down'></i> ".round($CantidadClientesNuevosporcentaje,2)." %</span></td>";
                  	}
                  	
                  	 ?>
                </tr>
                 <tr class="success">
                	<td style="font-weight: bold;" colspan="3">Ingresos</td>
                </tr>
                 <tr>
                  <td>Flujo de Dinero</td>
                  <td><a href="Informe-Ingresos.php?QueryCon=&start=<?php echo($dosmesantes);?>&end=<?php echo($mesantes); ?>"><?php echo("$ ".number_format($IMesAnteriortotaltabla_1_2,0)) ?></a></td>
                  <td><a href="Informe-Ingresos.php?QueryCon=&start=<?php echo($mesantes);?>&end=<?php echo($MarcaTemporal); ?>"><?php echo("$ ".number_format($IMesActualtotaltabla_1_1,0)) ?></a></td>
                  <?php 
                  //(D3-C3)/C3

                  if ($IMesActualtotaltabla_1_1==0) {
                  				$Ingresosporcentaje=0;
                  	}else{
                  				$Ingresosporcentaje=(($IMesActualtotaltabla_1_1-$IMesAnteriortotaltabla_1_2)/$IMesAnteriortotaltabla_1_2)*100;

                  	}

                  
                  	if ($Ingresosporcentaje>0) {
            	echo "<td><span class='label label-success'><i class='fa fa-caret-up'></i> ".round($Ingresosporcentaje,2)." %</span></td>";
                  	}
                  	else
                  	{
                echo "<td><span class='label label-danger'><i class='fa fa-caret-down'></i> ".round($Ingresosporcentaje,2)." %</span></td>";
                  	}
                  	
                  	 ?>
                </tr>



              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
		</div>
			


							
						</div><!-- /.row -->
	 <!-- /.row -->

					
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="https://modasof.com/espejo/assets/js/jquery-2.1.4.min.js"></script>
	
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

$sql ="SELECT DATE_FORMAT(fecha_ingreso, '%d') as DIA, IFNULL(SUM(Valor_Ingreso),0) AS total FROM t_ingresos WHERE MONTH(Fecha_Ingreso)='".$mesactualgra."' and YEAR(Fecha_Ingreso)='".$AnoActual."' and Medio_Pago='1' GROUP by DIA";  
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

$sql ="SELECT DATE_FORMAT(fecha_ingreso, '%d') as DIA, IFNULL(SUM(Valor_Ingreso),0) AS total FROM t_ingresos WHERE MONTH(Fecha_Ingreso)='".$mesactualgra."' and YEAR(Fecha_Ingreso)='".$AnoActual."' GROUP by DIA";  
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link href="https://modasof.com/espejo/assets/css/sweetalert.css" rel="stylesheet">
    <!-- Custom functions file -->
    <script src="https://modasof.com/espejo/assets/js/functions.js"></script>
    <!-- Sweet Alert Script -->
    <script src="https://modasof.com/espejo/assets/js/sweetalert.min.js"></script>
    <!--/Fin Alertas-->

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
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
          <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>

<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/owl.carousel.min.css">
<!--<link rel="stylesheet" href="dist/css/owl.theme.default.min.css">-->
<!--<script src="dist/js/jquery.min.js"></script>-->
<script src="https://modasof.com/espejo/assets/js/owl.carousel.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
  $('.owl-carousel').owlCarousel({
    rtl:false,
    loop:true,
    margin:5,
    nav:false,
    autoplay:true,
    autoplayTimeout:2500,
    autoplayHoverPause:true,
    autoWidth:true,
    items:6
    // responsive:{
    //     500:{
    //         items:3
    //     },
    //     100:{
    //         items:4
    //     },
    //     0:{
    //         items:5
    //     }
    // }
})
});
</script>

<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.stock.min.js"></script>
<script type="text/javascript">
window.onload = function () {
  var dataPoints11 = [], dataPoints21 = [];
  var stockChart = new CanvasJS.StockChart("stockChartContainer2",{
    theme: "light2",
    animationEnabled: true,
    title:{
      text:"Pedidos VALL-BARR"
    },
    subtitles: [{
      text: "Solicitadas vs Entregadas"
    }],
    charts: [{
      axisY: {
        title: ""
      },
      toolTip: {
        shared: true
      },
      legend: {
            cursor: "pointer",
            itemclick: function (e) {
              if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible)
                e.dataSeries.visible = false;
              else
                e.dataSeries.visible = true;
              e.chart.render();
            }
        },
      data: [{
      	 type: "area",
        showInLegend: true,
        name: "Prendas Solicitadas",
        yValueFormatString: "#,##0",
        xValueType: "dateTime",
        dataPoints : dataPoints11
      },{
        showInLegend: true,
         type: "area",
        name: "Prendas Entregadas",
        yValueFormatString: "#,##0",
        dataPoints : dataPoints21
      }]
    }],
    rangeSelector: {
      enabled: true
    },
    navigator: {
      data: [{
      	 type: "area",
        dataPoints: dataPoints11
      }],
      slider: {
       minimum: new Date(2021, <?php echo ($GraficaArriba) ?>, <?php echo($DiaActual) ?>),
        maximum: new Date(2021, <?php echo ($GraficaAbajo) ?>, <?php echo($DiaActual) ?>)
      }
    }
  });
 
 <?php
$sql ="SELECT DATE_FORMAT(Fecha_Solicitud,'%Y-%m-%d') AS FechaFinal,DATE_FORMAT(Fecha_Solicitud,'%Y') AS ANO,DATE_FORMAT(Fecha_Solicitud,'%m') AS MES,DATE_FORMAT(Fecha_Solicitud,'%d') AS DIA,IFNULL(sum(Cant_Solicitada),0) as totales FROM t_temporal_sol WHERE Tienda_Id_Tienda<>'2' AND Tienda_Id_Tienda<>'3'AND Tienda_Id_Tienda<>'4'AND Tienda_Id_Tienda<>'5'AND Tienda_Id_Tienda<>'6' AND Tienda_Id_Tienda<>'7' AND Tienda_Id_Tienda<>'8' AND Tienda_Id_Tienda<>'9' AND Tienda_Id_Tienda<>'10' AND YEAR(Fecha_Solicitud)='2023' and MONTH(Fecha_Solicitud)>='6' GROUP BY FechaFinal ORDER BY FechaFinal ASC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
    	$FechaFinal=$row['FechaFinal'];
    	$ANO=$row['ANO'];
    	$MES=$row['MES']-1;
    	$MESsql=$row['MES'];
    	$DIA=$row['DIA'];
    	$totaldiario=$row['totales']; 
    	$E1=graficacontarprendasentregadas($ANO,$MESsql,$DIA,10,1);
    	$E2=graficacontarprendasentregadas($ANO,$MESsql,$DIA,10,11);
    	$Totalentregadas=$E1+$E2;
    	?>           
dataPoints11.push({x: new Date(<?php echo($ANO.",".$MES.",".$DIA); ?>), y: Number(<?php echo($totaldiario); ?>)});

dataPoints21.push({x: new Date(<?php echo($ANO.",".$MES.",".$DIA); ?>), y: Number(<?php echo($Totalentregadas); ?>)});
   <?php 
 }
}
   ?>    
  
    stockChart.render();
  // Segunda gráfica

   var dataPoints2 = [];
  var stockChart2 = new CanvasJS.StockChart("stockChartContainer",{
    title:{
      text:"Total Ventas"
    },
    charts: [{
      data: [{
        type: "column",
       xValueFormatString: "YYYY MMM DD",
        color: "#82AF6F",
        yValueFormatString: "$#,###.##",
        dataPoints : dataPoints2
      }]
    }],
    navigator: {
      slider: {
        minimum: new Date(2021, <?php echo ($GraficaArriba) ?>, <?php echo($DiaActual) ?>),
        maximum: new Date(2021, <?php echo ($GraficaAbajo) ?>, <?php echo($DiaActual) ?>)
      }
    }
  });

  	<?php
$sql ="SELECT DATE_FORMAT(Fecha_Factura,'%Y-%m-%d') AS FechaFinal,DATE_FORMAT(Fecha_Factura,'%Y') AS ANO,DATE_FORMAT(Fecha_Factura,'%m') AS MES,DATE_FORMAT(Fecha_Factura,'%d') AS DIA,IFNULL(sum(Total_Factura),0) as totales FROM t_facturas WHERE num_consecutivo_sc<>'0' and YEAR(Fecha_Factura)='2023' and MONTH(Fecha_Factura)>='6'  GROUP BY FechaFinal ORDER BY FechaFinal ASC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
    	$FechaFinal=$row['FechaFinal'];
    	$ANO=$row['ANO'];
    	$MES=$row['MES']-1;
    	$DIA=$row['DIA'];
    	$totaldiario=$row['totales']; 
    	
    	?>           
dataPoints2.push({x: new Date(<?php echo($ANO.",".$MES.",".$DIA); ?>), y: Number(<?php echo($totaldiario); ?>)});
   <?php 
 }
}
   ?>         	
    stockChart2.render();
 
};
</script>

<script type="text/javascript">
      jQuery(function($) {
     
    var table = $('#cotizaciones').DataTable({
        
      "responsive":true,
     "scrollX": true,
     "ordering": true,
      "searching": false,
       "paging":   false,
        "info":     false,

        "order": [[ <?php echo($tope-$topemin+1); ?>, "desc" ]],
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se ha encontrado nada - Lo sentimos",
            "info": "Mostrar página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
           },
      
    "lengthMenu": [[5000, 7000, 10000, -1], [5000, 7000, 10000, "All"]],

          select: {
            style: 'multi'
          },
          
    });
      })
    </script>

    <script type="text/javascript">
      jQuery(function($) {
     
    var table = $('#cotizaciones2').DataTable({
        
      "responsive":true,
     "scrollX": true,
     "ordering": true,
      "searching": false,
       "paging":   false,
        "info":     false,
        "order": [[ <?php echo($tope); ?>, "desc" ]],
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se ha encontrado nada - Lo sentimos",
            "info": "Mostrar página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
           },
      
    "lengthMenu": [[5000, 7000, 10000, -1], [5000, 7000, 10000, "All"]],

          select: {
            style: 'multi'
          },
          
    });
      })
    </script>
		
	
	</body>
</html>
