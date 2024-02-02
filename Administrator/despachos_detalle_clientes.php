<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];
$SesionNomTienda=$_SESSION['SesionNomTienda'];
include("Lib/permisos.php");
//print_r(session_get_cookie_params());
$Tienda=$_GET['TxtTienda'];  
$TiempoActual = date('Y-m-d H:i:s');

$id_cliente = $_GET['cliente'];

include("Lib/seguridad.php");
$Datos="Ingreso al Detalle del despacho nro: ".$id_despachos;
$Paginas= $_SERVER['PHP_SELF'];
$seguridad = AgregarLog($IdUser,$Datos,$Paginas);

/* REALIZA LA SUMA DEL INVENTARIO ENVIADO*/
$consulta_inventario ="SELECT  sum(valor_total) as suma,id_tienda,id_ref,img_ref,cod_ref,detalle_ref,nom_tienda,talla_id,cantidad,valor_unidad,valor_total,talla,id_user FROM t_temporal_inventario WHERE id_cliente_sol='".$id_cliente."'";
$resultados = $conexion->query($consulta_inventario) or die('Error:'.mysqli_error($conexion));
if($resultados->num_rows>0){
	while ($row = $resultados->fetch_assoc()) {
	   //312-3687047
	   $usuario_id = $row['id_user'];
	   $suma = $row['suma'];
       $id_refencia =$row['id_ref']; 
       $img_ref=$row['img_ref'];
       $cod_ref=$row['cod_ref'];
       $detalle_ref=$row['detalle_ref'];
       $talla_id=$row['talla_id'];
       $cantidad=$row['cantidad'];
       $valor_unidad=$row['valor_unidad'];
       $valor_total=$row['valor_total'];
       $talla =$row['talla'];
       $nom_tienda=$row['nom_tienda'];
       $id_tienda=$row['id_tienda'];
    }
 }

    $consulta = "SELECT CONCAT(Nom_Cliente,' ',Ape_Cliente) as NomApe FROM t_clientes WHERE Id_Cliente = '".$id_cliente."'";
    $resultado = $conexion->query($consulta) or die('Error:'.mysqli_error($conexion));;
    $fila=$resultado->fetch_assoc();
    $NombreCliente = $fila['NomApe'];
    $Img_Perfil1 = $fila['Avatar_Cliente'];
 
    /* USUARIO QUE ENVIO EL PEDIDO*/
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

	<!--/Inicio Alertas-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link href="https://modasof.com/espejo/assets/css/sweetalert.css" rel="stylesheet">
    <!-- Custom functions file -->
    <script src="https://modasof.com/espejo/assets/js/functions.js"></script>
    <!-- Sweet Alert Script -->
    <script src="https://modasof.com/espejo/assets/js/sweetalert.min.js"></script>
    <!--/Fin Alertas-->

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
					<a href="listado_recepcion_clientes.php">Atras</a>
				</li>
			</ul><!-- /.breadcrumb -->						
		</div>

		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
                
<div class="col-sm-4 yellow">
	<div class="widget-box">
		<div class="widget-body">
			<div class="widget-main">
<h5>PEDIDOS DEL CLIENTE:</h5>
<h5><img style="width: 15%;height: 15%;" class="nav-user-photo" src="../Administrator/<?php Echo utf8_encode($Img_Perfil1); ?>" alt="" /> <?php Echo utf8_encode($NombreCliente); ?></h5>
<h5><i class="fa fa-clock-o"></i> <?php Echo ($TiempoActual) ?> </h5>	
			</div>
		</div>
	</div>
</div>
        <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user center negros">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-black">
              <h3 class="widget-user-username"><?php Echo($nom_tienda); ?></h3>
            </div>
            <div class="widget-user-image negros">
              <img class="img-circle" src="../Administrator/Images/Logos/logo-tiendas.jpg" width="100" height="100" alt="User Avatar">
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
        
<div class="col-sm-4 center">
<?php 
// Valor de cantidad solicitada.
$sql ="SELECT  Sum(Cantidad_Solicitada*Costo_Insumo) as SumaOrden FROM t_orden_compra_insumos  WHERE Cod_Orden_Prov='".$NumeroOrden."'";  
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $SumaOrden=$row['SumaOrden'];
 }
}
?>
								
<div class="infobox infobox-green">
	<div class="infobox-icon">
		<i class="ace-icon fa fa-dollar"></i>
	</div>

	<div class="infobox-data">
		<span class="infobox-data-number"><?php Formatomoneda($suma); ?></span>
		<div class="infobox-content">Total Despacho</div>
	</div>

</div>
</div>                
 
 			<!-- PAGE CONTENT BEGINS -->
			<!-- Inicio botones de acceso rápido -->
                <div class="col-sm-12 col-xs-12">
                    <script src="https://modasof.com/espejo/assets/js/jssor.slider-25.2.0.min.js" type="text/javascript"></script>

                    <div class="col-sm-12 col-xs-12"><!-- Panel 2  -->						
                    </div> <!-- Fin Panel 2 -->
                    <div class="row">



							<div class="col-sm-12 col-xs-12">
							
							<!-- INICIO TABLA -->
						<div class="clearfix">
											<!-- <div class="pull-left tableTools-container"></div> -->
										</div>
										<div class="table-header">
											Despacho realizado a la Tienda: <?php Echo($nom_tienda); ?>
										</div>
										
										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
							<table style="font-size: 12px;" id="dynamic-table"  class="table table-responsive table-striped table-bordered table-hover" width="100%">
												<thead>
													<tr class="warning">
														<th class="tdcustom" style="width: 2%;">Id</th>
														<th class="tdcustom" style="width: 2%;">Foto</th>
														<th class="tdcustom" style="width: 7%;">Código Referencia</th>
														<th class="tdcustom" style="width: 12%;">Detalle Referencia</th>
														<th class="tdcustom" style="width: 2%;">Talla</th>
														<th class="tdcustom" style="width: 2%;">Cantidad</th>
														<th class="tdcustom" style="width: 5%;">Valor Unidad</th>
														<th class="tdcustom" style="width: 5%;">Vr. Total</th>
                                                        <th class="tdcustom" style="width: 5%;">Nro Despacho</th>
													</tr>

												</thead>

												<tbody>
<?php 
	$consulta_inventario ="SELECT  * FROM t_temporal_inventario WHERE id_cliente_sol='".$id_cliente."'ORDER BY id_despacho DESC ";
	$resultados = $conexion->query($consulta_inventario);
	if($resultados->num_rows>0){
	   $colum = $resultados->num_rows;
	   echo "NUMERO DE REFERENCIAS ENVIADAS ES: <B>".$colum."</B>";
		while ($row = $resultados->fetch_assoc()) {
			$id = $row['id'];
			$imagen = $row['img_ref'];
			$codigo_ref = $row['cod_ref'];
			$detalle_ref = $row['detalle_ref'];
			$talla =  $row['talla_id'];
			$cantidad = $row['cantidad'];
			$valor_unidad = $row['valor_unidad'];
			$valor_total = $row['valor_total'];
			$id_tienda = $row['id_tienda'];
            $cliente = $row['cliente'];
            $id_cliente = $row['id_cliente_sol'];
            $id_despacho = $row['id_despacho'];

            //$consultac = "SELECT * FROM t_clientes WHERE Id_Cliente = '".$id_cliente."'";
            $consulta = "SELECT CONCAT(Nom_Cliente,' ',Ape_Cliente) as NomApe FROM t_clientes WHERE Id_Cliente = '".$id_cliente."' ";
            $resultado = $conexion->query($consulta) or die('Error:'.mysqli_error($conexion));;
            $fila=$resultado->fetch_assoc();
            $NombreCliente = $fila['NomApe'];
            
			$ruta_img = utf8_encode($imagen);
			$mostrar_img = "miniatura.php?x=50&y=50&file=".$ruta_img;
			?>
				<tr>
					<td>
						<?php echo utf8_encode($id); ?>
					</td>
					<td>
						<a class="image-link" href="<?php echo utf8_encode($imagen); ?>"><img src="<?php echo utf8_encode($mostrar_img); ?>" width="45px" height="45px"></a>
					</td>
					<td>
						<?php echo utf8_encode($codigo_ref); ?>
					</td>
					<td>
						<?php echo utf8_encode($detalle_ref); ?>
					</td>					
					<td>
						<?php echo utf8_encode($talla); ?>
					</td>
					<td>
						<?php echo utf8_encode($cantidad); ?>
					</td>
					<td>
						<?php echo Formatomoneda($valor_unidad); ?>
					</td>
					<td>
						<?php echo Formatomoneda($valor_total); ?>
					</td>
					<td>
						<a href="despachos_detalle.php?Despacho=<?php echo $id_despacho; ?>"><?php echo $id_despacho; ?></a>
					</td>
				</tr>
			<?php
		}                
	}
?>
												</tbody>
											</table>
										</div>
						<!-- FIN TABLA -->
<div class="center">
<form method="post" action="codigos_barra2.php" id="FormOrden">
    <input style="display: none;" type="text" name="ID" value="<?php Echo($id_despachos) ?>">
    <input style="display: none;" type="text" name="ID_TIENDA" value="<?php Echo($id_tienda) ?>">
    <input style="display: none;" type="text" name="TOTAL" value="<?php Echo($suma) ?>">
    
    <div class="form-group">
    	<div>
            <button type="submit" name="submit" class="btn btn-xs btn-success"><i class="fa fa-save"></i> Imprimir Codigos de Barra</button>
    	</div>
    </div>
</form>
</div>                        
					</div>
                    </div>
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

		
		
		<!-- inline scripts related to this page -->

		
	<script type="text/javascript">
        $(document).ready(function()
        {
             $("#FormOrden").validate({
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
                     "comentarios": { required:true }, 

                 },
                 messages: {
                     //"comentarios": { required:"Debes ingresar al menos un comentario sobre la recepción de la mercancia",},
                     "comentarios": { required:"Debes incluir al menos un Usuario"},
                 },

                 // submitHandler: function(form){
                 //     alert("Los datos son correctos");
                 // }

             });
        });
    </script>


	</body>
</html>
