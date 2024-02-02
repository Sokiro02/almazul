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

		<meta name="description" content="Common form elements and layouts" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		 <!-- Notificaciones Push -->
		<script src="https://modasof.com/espejo/assets/js/push.min.js"></script>
		

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/fonts.googleapis.com.css" />
         <link rel="stylesheet" href="https://modasof.com/espejo/assets/css/AdminLTE.css">
        <link rel="stylesheet" href="./assets/css/_all-skins.min.css">

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
        echo "<script>jQuery(function(){swal(\"¡ Orden de Estancia Guardada!\", \"Correctamente \", \"success\");});</script>";
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

							
						
						</ul><!-- /.breadcrumb -->

						
					</div>

					<div class="page-content">
				<?php 
					//include("Lib/colors.php");
				?>
						<div class="row">

						
							<div class="col-xs-12 col-sm-12">
								

				<div class="col-sm-12 col-xs-12"><!-- Inicio Panel Inferior-->
					<hr>
					<div class="row">
					<div class="col-sm-4 col-xs-12">
					
                    <div class="card earning-widget">
                        <div class="card-body">
                            <div class="card-title">
                           
                            </div>
                        </div>
                        <div class="card-body b-t">
                            <table class="table v-middle no-border">
                                <tbody>
                                	
 <?php
 $sql="SELECT Id_Usuario,Nombres, Apellidos, Img_Perfil From t_usuarios Where Rol_id_rol='4' and Estado_id_Estado_Usuario='1'";
 $result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
    	$SastreNombres=$row['Nombres'];
    	$SastreApellidos=$row['Apellidos'];
    	$SastreAvatar=$row['Img_Perfil'];
        $SastreId=$row['Id_Usuario'];
 ?>

                                    <tr>
                                        <td style="width:40px"><a href="Sastres.php?SastreSelect=<?php Echo($SastreId) ?>"><img src="<?php Echo($SastreAvatar) ?>" width="50" class="img-circle" alt="logo"></a></td>
                                        <td><?php Echo($SastreNombres." ".$SastreApellidos) ?></td>
                                        <td align="right">
                                        	
                                            <span class="pull-right badge bg-yellow">Ordenes Pendientes 12</span>
                                            
                                        </td>
                                    </tr>
                                   <?php 
                               }
                           }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
					</div>

        <!-- Incio panel de 8 -->
                            <div class="col-sm-8 col-xs-12" style="border: 1px dotted black;">
                <?php 
                $SastreSelect=$_GET['SastreSelect'];

    //***************************************************************************************************
  
 

                if ($SastreSelect=="") {
                Echo("<h1 class='center' style='color:#8E8B8A;''>Seleccione un Sastre <i class='fa fa-search'></i></h1>");
                }
                else
                {
        Echo("<h2 style='color:#8E8B8A;''> Resumen Sastre </h2>");   
                
                 ?>
                        

        <!-- Column -->
                    <div class="col-lg-12 col-xlg-12 col-md-8">
                        <div class="card">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Asignadas</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">OK</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Desprendibles</a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                      <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-5 col-xs-6 b-r"> <strong>Tiempo Promedio: 5 días</strong>
                                            </div>
                                        </div>
                                        <hr>
                                  <h3>Detalle Insumos x 1 Prenda</h3>  
                <div class="table-responsive">  
                     <table class="table table-bordered"> 
                     <thead> 
                          <tr class="warning">  
                              <th >Orden</th>
                               <th >Referencia</th>
                                <th >Asignada el</th> 
                                <th >Días</th>  
                               <th class="center">Estado</th> 
                                
                          </tr> 
                       </thead>
                       <tbody id="tablainsumos">
                        <?php 
              $sql="SELECT Id_Solicitud_Prod,Cod_Solicitud_Prod, Cant_Solicitada, Referencia_Id_Referencia, Estado_Solicitud_Prod FROM t_solicitudes_prod WHERE Sastre_Id_Usuario='".$SastreSelect."' and Estado_Solicitud_Prod='2'";
              $result=$conexion->query($sql);
              if ($result->num_rows > 0 ) {
               while ($row = $result->fetch_assoc()) {
                 $Id_Solicitud_Prod=$row['Id_Solicitud_Prod'];
                 $Cod_Solicitud_Prod=$row['Cod_Solicitud_Prod'];
                 $Cant_Solicitada=$row['Cant_Solicitada'];
                 $Referencia_Id_Referencia=$row['Referencia_Id_Referencia'];
                 $Estado_Solicitud_Prod=$row['Estado_Solicitud_Prod'];
                 
                         ?>
                        <tr>
                          <td><?php Echo($Cod_Solicitud_Prod) ?></td>
                          <td><?php Echo($Referencia_Id_Referencia) ?></td>
                          <td><?php Echo($Fecha_Solicitud) ?></td>
                          <td>1</td>
                          <td><?php Echo($Cant_Solicitada) ?>Und.</td>
                        </tr>
                    <?php 
                  }
                }
                     ?>
                          
                     </tbody> 
              
                
           </table>  
       </div>
                                        
                                    </div>
                                </div>
                                <!--second tab-->
                            
                                <div class="tab-pane" id="profile" role="tabpanel">
                                   <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-5 col-xs-6 b-r"> <strong>Seleccionar las Ordenes que va a pagar</strong>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 col-xs-6 b-r">
                                               Fecha del Pago<input type="date" name="">
                                            </div>
                                            <div class="col-md-3 col-xs-6 b-r">
                                                <button class="btn btn-danger ">Crear Desprendible</button>
                                            </div>
                                        </div>
                                        <hr>
                                  <h3>Detalle Insumos x 1 Prenda</h3>  
                <div class="table-responsive">  
                     <table class="table table-bordered"> 
                     <thead> 
                          <tr class="success">  
                            <th ><input type="chekcbox" name=""></th>
                              <th >Orden</th>
                               <th >Referencia</th>
                                <th >Asignada el</th> 
                                <th >Días</th>  
                               <th class="center">Estado</th> 
                                
                          </tr> 
                       </thead>

                       <tbody id="tablainsumos">
                        <?php 
              $sql="SELECT Id_Solicitud_Prod,Cod_Solicitud_Prod, Cant_Solicitada, Referencia_Id_Referencia, Estado_Solicitud_Prod FROM t_solicitudes_prod WHERE Sastre_Id_Usuario='".$SastreSelect."' and Estado_Solicitud_Prod='2'";
              $result=$conexion->query($sql);
              if ($result->num_rows > 0 ) {
               while ($row = $result->fetch_assoc()) {
                 $Id_Solicitud_Prod=$row['Id_Solicitud_Prod'];
                 $Cod_Solicitud_Prod=$row['Cod_Solicitud_Prod'];
                 $Cant_Solicitada=$row['Cant_Solicitada'];
                 $Referencia_Id_Referencia=$row['Referencia_Id_Referencia'];
                 $Estado_Solicitud_Prod=$row['Estado_Solicitud_Prod'];
                 
                         ?>
                        <tr>
                            <td><input type="chekcbox" name=""></td>
                          <td><?php Echo($Cod_Solicitud_Prod) ?></td>
                          <td><?php Echo($Referencia_Id_Referencia) ?></td>
                          <td><?php Echo($Fecha_Solicitud) ?></td>
                          <td>1</td>
                          <td><?php Echo($Cant_Solicitada) ?>Und.</td>
                        </tr>
                    <?php 
                  }
                }
                     ?>
                          
                     </tbody> 
              
                
           </table>  
       </div>
                                        
                                    </div>
                                </div>
                                <div class="tab-pane" id="settings" role="tabpanel">
                                    <div class="card-body">
                                       <a class="btn btn-xlarge btn-white"><i class="fa fa-file-pdf-o red">  </i> Descargar Ficha Técnica</a>
                                       
                                      
                                       <!--  <a href="barcode.php?text=<?php Echo($Referencia_Id_Referencia."-".$Nom_Talla) ?>&size=50&orientation=horizontal&codetype=Code128&print=true" class="btn btn-xlarge btn-white"><i class="fa fa-barcode red">  </i> Imprimir Código de Barras </a> -->
                                    </div>
                                    <hr>
                                     <div id="CodigoBarras">
                                      <div class="col-sm-6" style="border: solid 1px black;">
                                         <img src="barcode.php?text=<?php Echo($Referencia_Id_Referencia."-".$Nom_Talla) ?>&size=30&orientation=horizontal&codetype=Code128&print=true"><br><strong>$230.000</strong>
                                       </div>
                                       <div class="col-sm-6" style="border: solid 1px black;">
                                         <img src="barcode.php?text=<?php Echo($Referencia_Id_Referencia."-".$Nom_Talla) ?>&size=30&orientation=horizontal&codetype=Code128&print=true"><br><strong>$230.000</strong>
                                       </div>
                                       <div class="col-sm-6" style="border: solid 1px black;">
                                         <img src="barcode.php?text=<?php Echo($Referencia_Id_Referencia."-".$Nom_Talla) ?>&size=30&orientation=horizontal&codetype=Code128&print=true"><br><strong>$230.000</strong>
                                       </div>
                                       <div class="col-sm-6" style="border: solid 1px black;">
                                         <img src="barcode.php?text=<?php Echo($Referencia_Id_Referencia."-".$Nom_Talla) ?>&size=30&orientation=horizontal&codetype=Code128&print=true"><br><strong>$230.000</strong>
                                       </div>
                                      </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
        <?php 
}
         ?>
                    </div>
					<!-- Fin Panel de 8 -->
					
</div>

				
							
				</div><!-- Fin Panel Inferior -->
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
        // based on prepared DOM, initialize echarts instance
        var myChart = echarts.init(document.getElementById('grafica'));

        // specify chart configuration item and data
      option = {
    title: {
        text: ''
    },
    tooltip : {
        trigger: 'axis',
        axisPointer: {
            type: 'cross',
            label: {
                backgroundColor: '#6a7985'
            }
        }
    },
    legend: {
        data:['Camisas','Pantalones','Bermudas','Camisetas','Producción']
    },
    toolbox: {
        feature: {
            saveAsImage: {}
        }
    },
    grid: {
        left: '3%',
        right: '4%',
        bottom: '3%',
        containLabel: true
    },
    xAxis : [
        {
            type : 'category',
            boundaryGap : false,
            data : ['Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto']
        }
    ],
    yAxis : [
        {
            type : 'value'
        }
    ],
    series : [
        {
            name:'Camisas',
            type:'line',
            stack: '总量',
            areaStyle: {normal: {}},
            data:[120, 132, 101, 134, 90, 230, 210]
        },
        {
            name:'Pantalones',
            type:'line',
            stack: '总量',
            areaStyle: {normal: {}},
            data:[220, 182, 191, 234, 290, 330, 310]
        },
        {
            name:'Bermudas',
            type:'line',
            stack: '总量',
            areaStyle: {normal: {}},
            data:[150, 232, 201, 154, 190, 330, 410]
        },
        {
            name:'Camisetas',
            type:'line',
            stack: '总量',
            areaStyle: {normal: {}},
            data:[320, 332, 301, 334, 390, 330, 320]
        },
        {
            name:'Producción',
            type:'line',
            stack: '总量',
            label: {
                normal: {

                    show: true,
                    color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                        offset: 0,
                        color: '#3023AE'
                    }, {
                        offset: 1,
                        color: '#C96DD8'
                    }]),
                    position: 'top'
                },
            },
            areaStyle: {normal: {
            	color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                        offset: 0,
                        color: '#3023AE'
                    }, {
                        offset: 1,
                        color: '#C96DD8'
                    }]),
            }},
            data:[820, 932, 901, 934, 1290, 1330, 1320]
        }
    ]
};


        // use configuration item and data specified to show chart
        myChart.setOption(option);
    </script>

	
	</body>
</html>
