<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];

//Validación de Permisos
$sql ="SELECT Actualizar_TekMaster, Editar_TekMaster, Eliminar_TekMaster, Insertar_TekMaster, Ver_TekMaster FROM t_rol_usuario WHERE Id_Rol='".$IdRol."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
    	$Val_Actualizar=$row['Actualizar_TekMaster'];             
        $Val_Editar=$row['Editar_TekMaster'];
        $Val_Eliminar=$row['Eliminar_TekMaster'];
        $Val_Insertar=$row['Insertar_TekMaster'];
        $Val_Ver=$row['Ver_TekMaster'];
 }
}
//Validación de Permisos
?>


<?php 

include("Lib/seguridad.php");
$seguridad = AgregarLog($IdUser,"Entrada Balance de Compras y Ventas","balance.php");


$mes_inicio_trim = NomMes(date("n")-2);
$mes_sig_trim = NomMes(date("n")-1);
$mes_fin_trim = NomMes(date("n"));



// -------------- CALCULO DE COMPRAS ------------ //
//TOTAL DE COMPRAS ULTIMO TRIMESTRE A CONTADO
$sql ="SELECT SUM(Cantidad_Solicitada*Costo_Insumo) as TotalOrden FROM t_orden_compra_insumos WHERE  MONTH(Fecha_Solicitud)>=MONTH(CURDATE())-2 and Forma_Pago=1"; 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $total_compras_contado=$row['TotalOrden'];
        //echo $total_compras_contado." COMPRAS CONTADO <BR>";
    }
}


//TOTAL DE COMPRAS ULTIMO TRIMESTRE A CREDITO
$sql2 ="SELECT SUM(Cantidad_Solicitada*Costo_Insumo) as TotalOrden FROM t_orden_compra_insumos WHERE  MONTH(Fecha_Solicitud)>=MONTH(CURDATE())-2 and Forma_Pago=2"; 
$result2 = $conexion->query($sql2);
if ($result2->num_rows > 0) {
    while ($row2 = $result2->fetch_assoc()) {                
        $total_compras_credito=$row2['TotalOrden'];
        if (empty($total_compras_credito)){
            $total_compras_credito=0;
        }
        //echo $total_compras_credito." COMPRAS CREDITO <BR>";
    }
}else{
    $total_compras_credito=0;
    //echo $total_compras_credito." COMPRAS CREDITO <BR>";
}


//TOTAL DE COMPRAS INICIO TRIMESTRE
$sql ="SELECT SUM(Cantidad_Solicitada*Costo_Insumo) as TotalOrden FROM t_orden_compra_insumos WHERE  MONTH(Fecha_Solicitud)=MONTH(CURDATE())-2"; 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $total_compras_INICIO=$row['TotalOrden'];
        //echo $total_compras_contado." COMPRAS CONTADO <BR>";
    }
}

//TOTAL DE COMPRAS SIGUIENTE TRIMESTRE
$sql ="SELECT SUM(Cantidad_Solicitada*Costo_Insumo) as TotalOrden FROM t_orden_compra_insumos WHERE  MONTH(Fecha_Solicitud)=MONTH(CURDATE())-1"; 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $total_compras_SIGUIENTE=$row['TotalOrden'];
        //echo $total_compras_contado." COMPRAS CONTADO <BR>";
    }
}

//TOTAL DE COMPRAS FIN TRIMESTRE
$sql ="SELECT SUM(Cantidad_Solicitada*Costo_Insumo) as TotalOrden FROM t_orden_compra_insumos WHERE  MONTH(Fecha_Solicitud)=MONTH(CURDATE())"; 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $total_compras_FIN=$row['TotalOrden'];
        //echo $total_compras_contado." COMPRAS CONTADO <BR>";
    }
}

if (empty($total_compras_INICIO)){
    $total_compras_INICIO=0;
}
if (empty($total_compras_SIGUIENTE)){
    $total_compras_SIGUIENTE=0;
}

if (empty($total_compras_FIN)){
    $total_compras_FIN=0;
}

// -------------- FIN CALCULO DE COMPRAS ------------ //


// -------------- CALCULO DE VENTAS ------------ //

//TOTAL DE VENTAS ULTIMO TRIMESTRE 
$sql ="SELECT SUM(Total_Factura) as TotalFactura FROM t_facturas WHERE  MONTH(Fecha_Factura)>=MONTH(CURDATE())-2"; 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $ventastotales=$row['TotalFactura'];
        //echo $total_compras_contado." COMPRAS CONTADO <BR>";
    }
}

//TOTAL VENTAS INICIO TRIMESTRE
$sql ="SELECT SUM(Total_Factura) as TotalFactura FROM t_facturas WHERE  MONTH(Fecha_Factura)=MONTH(CURDATE())-2"; 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $ventastotales_INICIO=$row['TotalFactura'];
        //echo $total_compras_contado." COMPRAS CONTADO <BR>";
    }
}
if (empty($ventastotales_INICIO)){
    $ventastotales_INICIO = 0;
}
//TOTAL VENTAS SEGUIDO TRIMESTRE
$sql ="SELECT SUM(Total_Factura) as TotalFactura FROM t_facturas WHERE  MONTH(Fecha_Factura)=MONTH(CURDATE())-1"; 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $ventastotales_SIGUIENTE=$row['TotalFactura'];
        //echo $total_compras_contado." COMPRAS CONTADO <BR>";
    }
}
if (empty($ventastotales_SIGUIENTE)){
    $ventastotales_SIGUIENTE= 0;
}

//TOTAL VENTAS FIN TRIMESTRE
$sql ="SELECT SUM(Total_Factura) as TotalFactura FROM t_facturas WHERE  MONTH(Fecha_Factura)=MONTH(CURDATE())"; 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $ventastotales_FIN=$row['TotalFactura'];
        //echo $ventastotales_FIN." $ventastotales_FIN <BR>";
    }
}if (empty($ventastotales_FIN)){
    $ventastotales_FIN= 0;
}


// -------------- FIN CALCULO DE COMPRAS ------------ //


?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Informes</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->

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
	</head>

	<body class="skin-1">
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
								<a href="Admin2.php">Inicio</a>
							</li>
							<li class="active">Escritorio</li>
						</ul><!-- /.breadcrumb -->

						
					</div>

					<div class="page-content">
						

						<div class="page-header">
							<h1>
								Balance General
							</h1>

						</div><!-- /.page-header -->
                         <div class="row">
                               <h3><CENTER><B>GRAFICOS DE VENTAS, GENERALES Y POR TIENDA</B></CENTER></h3>
                               <div class="col-xs-12">
                               <br />
                               <br />
                                <div class="widget-box">
                                    <div class="widget-header widget-header-flat widget-header-small">
                                       <h5 class="widget-title">
                                       <i class="ace-icon fa fa-signal"></i>
                                       Reporte Ventas Generales
                                       </h5>
                                    </div>
                                    <div class="widget-body">
                                       <div class="widget-main">
                                          <!-- <div id="piechart-placeholder"></div> -->
                                            <div class="tab-info chart-info  active">
                                                  <div id="chartContainer2" style="height: 250px; width: 100%;"></div>
                                            </div>

                                        </div><!-- /.widget-main -->
                                        <br /><br />
                                    </div><!-- /.widget-body -->
                                    <div class="vspace-32-sm"></div>
                                    
                                    <?php
                                    $sql="SELECT * from t_tiendas";
                                    $result = $conexion->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $Nom_Tienda=$row['Nom_Tienda'];
                                            $id_graf_t = $row['Id_Tienda'];
                                    ?>
                                    <div class="col-sm-6">
                                    <div class="widget-header widget-header-flat widget-header-small">
                                       <h5 class="widget-title">
                                       <i class="ace-icon fa fa-signal"></i>
                                       Ventas <?php echo $Nom_Tienda; ?>
                                       </h5>
                                    </div>
                                    <div class="widget-body">
                                       <div class="widget-main">
                                          <!-- <div id="piechart-placeholder"></div> -->
                                            <div class="tab-info chart-info  active">
                                                  <div id="ventas<?php echo($id_graf_t)?>" style="height: 250px; width: 100%;"></div>
                                            </div>
                                            <div class="hr hr8 hr-double"></div>
                                        </div><!-- /.widget-main -->
                                    </div><!-- /.widget-body -->  
                                    </div>                                    
                                    <?php
                                        }
                                    }else{echo "Error mostrando datos";}   

                                ?>
                                </div>
                            </div>
                        </div> <!-- Fin Row VENTAS--> 
                        <div class="row">
                            <div class="col-xs-12">
                            <h3><CENTER><B>GRAFICOS DE COMPRAS, GENERALES Y POR BODEGA</B></CENTER></h3>
                                <div class="widget-box">
                                    <div class="widget-header widget-header-flat widget-header-small">
									   <h5 class="widget-title">
									   <i class="ace-icon fa fa-signal"></i>
									   Reporte Compras Generales
									   </h5>
                                    </div>
                                    <div class="widget-body">
									   <div class="widget-main">
										  <!-- <div id="piechart-placeholder"></div> -->
										    <div class="tab-info chart-info  active">
										          <div id="chartContainer" style="height: 250px; width: 100%;"></div>
                                            </div>
											<!--
                                            
                                            <div class="clearfix">
                                                <div class="grid6 pull-right">
												    <span class="grey">
								                        <i class="ace-icon "></i>
													   &nbsp; Gastos Totales:
													</span>
													<h6 class="bigger pull-right">$24.580.000</h4>
											     </div>
											</div> -->
                                        </div><!-- /.widget-main -->
									</div><!-- /.widget-body -->
                                    <div class="vspace-32-sm"></div>
                                    <?php
                                    $sql="SELECT * from t_bodegas";
                                    $result = $conexion->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $Nom_Bodega=$row['Nom_Bodega'];
                                            $id_graf = $row['Id_Bodega'];
                                    ?>
                                    <div class="col-sm-4">
                                    <div class="widget-header widget-header-flat widget-header-small">
									   <h5 class="widget-title">
									   <i class="ace-icon fa fa-signal"></i>
									   Compras <?php echo $Nom_Bodega; ?>
									   </h5>
                                    </div>
                                    <div class="widget-body">
									   <div class="widget-main">
										  <!-- <div id="piechart-placeholder"></div> -->
										    <div class="tab-info chart-info  active">
										          <div id="comprasbodega<?php echo($id_graf)?>" style="height: 250px; width: 100%;"></div>
                                            </div>
                                            <div class="hr hr8 hr-double"></div>
											<!--
                                            <div class="clearfix">
                                                <div class="grid6 pull-right">
												    <span class="grey">
								                        <i class="ace-icon "></i>
													   &nbsp; Gastos Totales:
													</span>
													<h6 class="bigger pull-right">$24.580.000</h6>
											     </div>
											</div> -->
                                        </div><!-- /.widget-main -->
									</div><!-- /.widget-body -->  
                                    </div>                                    
                                    <?php
                                        }
                                    }else{echo "Error mostrando datos";}   

                                ?>
                                </div>
                            </div>
                        </div> <!-- Fin Row COMPRAS-->
                        
                                              
                        <div class="row">
                               <h3><CENTER><B>GRAFICOS DE VENTAS VS COMPRAS, GENERALES Y POR TIENDA</B></CENTER></h3>
                               <div class="col-xs-12">
                               <br />
                               <br />
                                <div class="widget-box">
                                    <div class="widget-header widget-header-flat widget-header-small">
									   <h5 class="widget-title">
									   <i class="ace-icon fa fa-signal"></i>
									   Reporte Ventas Generales
									   </h5>
                                    </div>
                                    <div class="widget-body">
									   <div class="widget-main">
										  <!-- <div id="piechart-placeholder"></div> -->
										    <div class="tab-info chart-info  active">
										          <div id="chartContainer3" style="height: 250px; width: 100%;"></div>
                                            </div>

                                        </div><!-- /.widget-main -->
                                        <br /><br />
									</div><!-- /.widget-body -->
                                    <div class="vspace-32-sm"></div>
                                    
                                    <?php
                                    $sql="SELECT * from t_tiendas";
                                    $result = $conexion->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $Nom_Tienda=$row['Nom_Tienda'];
                                            $id_graf_t = $row['Id_Tienda'];
                                    ?>
                                    <div class="col-sm-4">
                                    <div class="widget-header widget-header-flat widget-header-small">
									   <h5 class="widget-title">
									   <i class="ace-icon fa fa-signal"></i>
									   Ventas <?php echo $Nom_Tienda; ?>
									   </h5>
                                    </div>
                                    <div class="widget-body">
									   <div class="widget-main">
										  <!-- <div id="piechart-placeholder"></div> -->
										    <div class="tab-info chart-info  active">
										          <div id="compras_ventas<?php echo($id_graf_t)?>" style="height: 250px; width: 100%;"></div>
                                            </div>
                                            <div class="hr hr8 hr-double"></div>
                                        </div><!-- /.widget-main -->
									</div><!-- /.widget-body -->  
                                    </div>                                    
                                    <?php
                                        }
                                    }else{echo "Error mostrando datos";}   

                                ?>
                                </div>
                            </div>
                        </div> <!-- Fin Row COMPRAS/VENTAS-->                            
						
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
		<script src="https://modasof.com/espejo/assets/js/jquery.easypiechart.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.sparkline.index.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.flot.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.flot.pie.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.flot.resize.min.js"></script>

		<!-- ace scripts -->
		<script src="https://modasof.com/espejo/assets/js/ace-elements.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/ace.min.js"></script>

		<script src="https://modasof.com/espejo/assets/js/jquery.canvasjs.min.js"></script>
	<!-- <script src="script/charts.js"></script> -->
	<!-- <script src="https://modasof.com/espejo/assets/js/sorttable.js"></script> -->		
	<script type="text/javascript">
		$(function () {
    //Better to construct options first and then pass it as a parameter
    var options = {

     title:{
			text: "COMPRAS TRIMESTRALES"
		},
		exportFileName: "COMPRAS",
		exportEnabled: true,
                animationEnabled: true,
		legend:{
			verticalAlign: "bottom",
			horizontalAlign: "center"
		},
		data: [
		{       
			type: "pie",
			showInLegend: true,
			toolTipContent: "${y} ",
			indexLabel: "{name} {y}",
			dataPoints: [
				{  y: <?php echo $total_compras_contado;?>, name: "CONTADO", exploded: true},
				{  y: <?php echo $total_compras_credito;?>, name: "CREDITO"}
			]
	}
	]
    };

    $("#chartContainer").CanvasJSChart(options);

});
</script>
<?php
$sql="SELECT * from t_bodegas";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id_graf = $row['Id_Bodega'];
        $Nom_Bodega = $row['Nom_Bodega'];
        //TOTAL DE COMPRAS ULTIMO TRIMESTRE A CONTADO
        $sql2 ="SELECT SUM(Cantidad_Solicitada*Costo_Insumo) as TotalOrden FROM t_orden_compra_insumos WHERE  MONTH(Fecha_Solicitud)>=MONTH(CURDATE())-2 and Forma_Pago=1 and Bodega_Id_Bodega='".$id_graf."'"; 
        $result2 = $conexion->query($sql2);
        if ($result2->num_rows > 0) {
            while ($row2 = $result2->fetch_assoc()) {                
                $total_compras_contado=$row2['TotalOrden'];
                if (empty($total_compras_contado)){
                    $total_compras_contado=0;
                }

            }
        }
        //TOTAL DE COMPRAS ULTIMO TRIMESTRE A CREDITO
        $sql3 ="SELECT SUM(Cantidad_Solicitada*Costo_Insumo) as TotalOrden FROM t_orden_compra_insumos WHERE  MONTH(Fecha_Solicitud)>=MONTH(CURDATE())-2 and Forma_Pago=2 and Bodega_Id_Bodega='".$id_graf."'"; 
        $result3 = $conexion->query($sql3);
        if ($result3->num_rows > 0) {
            while ($row3 = $result3->fetch_assoc()) {                
                $total_compras_credito=$row3['TotalOrden'];
                if (empty($total_compras_credito)){
                    $total_compras_credito=0;
                }
            }
        }else{
        $total_compras_credito=0;
        }
        //$suma100 = $total_compras_contado+$total_compras_credito;
        //$porcencontado = ($total_compras_contado*100)/$suma100;
        //$porcencredito = ($total_compras_credito*100)/$suma100;        
    ?>
    <script type="text/javascript">
	$(function () {
    var options = {
     title:{
			text: "COMPRAS  <?php echo $Nom_Bodega;?>"
		},
		exportFileName: "COMPRAS",
		exportEnabled: true,
                animationEnabled: true,
		legend:{
			verticalAlign: "bottom",
			horizontalAlign: "center"
		},
		data: [
		{       
			type: "pie",
			showInLegend: true,
			toolTipContent: "${y}",
			indexLabel: "{name} {y}%",
			dataPoints: [
				{  y: <?php echo $total_compras_contado;?>, name: "CONTADO", exploded: true},
				{  y: <?php echo $total_compras_credito;?>, name: "CREDITO"}
			]
	}
	]
    };

    $("#comprasbodega<?php echo($id_graf)?>").CanvasJSChart(options);

});
    </script>    
    <?php    
    }
}
$mes_inicio_trim = NomMes(date("n")-2);
$mes_sig_trim = NomMes(date("n")-1);
$mes_fin_trim = NomMes(date("n"));
?>

  
  	<script type="text/javascript">
		$(function () {
    //Better to construct options first and then pass it as a parameter
    var options = {
	  exportFileName: "Ventas Trimestre",
      exportEnabled: true,
      animationEnabled: true,
      zoomEnabled: true,
      zoomType: "x",
      title:{
       text: "Ventas de los ultimos tres meses",
      },
      subtitles: [{
           text: "<?php echo $mes_inicio_trim;?> - <?php echo $mes_sig_trim;?> - <?php echo $mes_fin_trim;?>"
      }
      ],    
      data: [
      {
        type: "column",
        dataPoints: [
            { label: "<?php echo $mes_inicio_trim;?>", y: <?php echo $ventastotales_INICIO;?>,indexLabel:"<?php echo formatomoneda($ventastotales_INICIO);?>"},
            { label: "<?php echo $mes_sig_trim;?>", y: <?php echo $ventastotales_SIGUIENTE;?> ,indexLabel:"<?php echo formatomoneda($ventastotales_SIGUIENTE);?>"},
            { label: "<?php echo $mes_fin_trim;?>", y: <?php echo $ventastotales_FIN;?> ,indexLabel:"<?php echo formatomoneda($ventastotales_FIN);?>"}
        ]
      }
      ]

    };

    $("#chartContainer2").CanvasJSChart(options);

});
	</script>

<?php

$sqlt="SELECT * from t_tiendas";
$resulttiendas = $conexion->query($sqlt);
if ($resulttiendas->num_rows > 0) {
    while ($rowtiendas = $resulttiendas->fetch_assoc()) {
        $Id_Tienda=$rowtiendas['Id_Tienda'];
        //TOTAL VENTAS INICIO TRIMESTRE
        $sql ="SELECT SUM(Total_Factura) as TotalFactura FROM t_facturas WHERE  MONTH(Fecha_Factura)=MONTH(CURDATE())-2 and Tienda_Id_Tienda='".$Id_Tienda."'"; 
        $result = $conexion->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {                
                $ventastotales_INICIOs=$row['TotalFactura'];
                //echo $total_compras_contado." COMPRAS CONTADO <BR>";
            }
        }
        if (empty($ventastotales_INICIOs)){
            $ventastotales_INICIOs = 0;
        }
        //TOTAL VENTAS SEGUIDO TRIMESTRE
        $sql ="SELECT SUM(Total_Factura) as TotalFactura FROM t_facturas WHERE  MONTH(Fecha_Factura)=MONTH(CURDATE())-1 and Tienda_Id_Tienda='".$Id_Tienda."'"; 
        $result = $conexion->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {                
                $ventastotales_SIGUIENTEs=$row['TotalFactura'];
                //echo $total_compras_contado." COMPRAS CONTADO <BR>";
            }
        }
        if (empty($ventastotales_SIGUIENTEs)){
            $ventastotales_SIGUIENTEs= 0;
        }
        
        //TOTAL VENTAS FIN TRIMESTRE
        $sql ="SELECT SUM(Total_Factura) as TotalFactura FROM t_facturas WHERE  MONTH(Fecha_Factura)=MONTH(CURDATE()) and Tienda_Id_Tienda='".$Id_Tienda."'"; 
        $result = $conexion->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {                
                $ventastotales_FINs=$row['TotalFactura'];
                //echo $ventastotales_FIN." $ventastotales_FIN <BR>";
            }
        }if (empty($ventastotales_FINs)){
            $ventastotales_FINs= 0;
        }
    ?>
  	<script type="text/javascript">
		$(function () {
    //Better to construct options first and then pass it as a parameter
    var options = {
	  exportFileName: "Ventas Trimestre",
      exportEnabled: true,
      animationEnabled: true,
      zoomEnabled: true,
      zoomType: "x",
      title:{
       text: "Ventas de <?php echo $mes_inicio_trim;?> - <?php echo $mes_sig_trim;?> - <?php echo $mes_fin_trim;?>",
      },
      subtitles: [{
           text: "<?php echo $mes_inicio_trim;?> - <?php echo $mes_sig_trim;?> - <?php echo $mes_fin_trim;?>"
      }
      ],    
      data: [
      {
        type: "column",
        dataPoints: [
            { label: "<?php echo $mes_inicio_trim;?>", y: <?php echo $ventastotales_INICIOs;?>,indexLabel:"<?php echo formatomoneda($ventastotales_INICIOs);?>"},
            { label: "<?php echo $mes_sig_trim;?>", y: <?php echo $ventastotales_SIGUIENTEs;?> ,indexLabel:"<?php echo formatomoneda($ventastotales_SIGUIENTEs);?>"},
            { label: "<?php echo $mes_fin_trim;?>", y: <?php echo $ventastotales_FINs;?> ,indexLabel:"<?php echo formatomoneda($ventastotales_FINs);?>"}
        ]
      }
      ]

    };

    $("#ventas<?php echo $Id_Tienda;?>").CanvasJSChart(options);

});
	</script>    
    <?php        
    }
}
        


?>






	<script type="text/javascript">
		$(function () {
    //Better to construct options first and then pass it as a parameter
    var options = {

   title:{
      text: "Gastos Vs Ventas"   
      },
      exportFileName: "Gastos Vs Ventas",
		exportEnabled: true,
      animationEnabled: true,
      axisX:{
        title: "Ventas"
      },
      axisY:{
        title: "Porcentaje"
      },
      data: [
      {        
        type: "stackedColumn100",
        name: "Ventas",
        showInLegend: "true",
        dataPoints: [
        {  y: <?php echo $ventastotales_INICIO; ?>, label: "<?php echo $mes_inicio_trim;?>"},
        {  y: <?php echo $ventastotales_SIGUIENTE; ?>, label: "<?php echo $mes_sig_trim;?>" },
        {  y: <?php echo $ventastotales_FIN; ?>, label: "<?php echo $mes_fin_trim;?>" },
                        
        ]
      }, {        
        type: "stackedColumn100",        
        name: "Gastos",
        showInLegend: "true",
        dataPoints: [
        {  y: <?php echo $total_compras_INICIO;?>, label: "<?php echo $mes_inicio_trim;?>"},
        {  y: <?php echo $total_compras_SIGUIENTE;?>, label: "<?php echo $mes_sig_trim;?>" },
        {  y: <?php echo $total_compras_FIN;?>, label: "<?php echo $mes_fin_trim;?>" },
                       
        ]
      }

      ]
    };

    $("#chartContainer3").CanvasJSChart(options);

});
</script>

	</body>
</html>
