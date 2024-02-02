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
$categoriaSel=$_GET['categoriaSel'];
$nomcategoria=$_GET['nomcategoria'];
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Referencias Modasof</title>

		<meta name="description" content="Common form elements and layouts" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/jquery-ui.custom.min.css" />
		

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

   
	</head>

	<body class="skin-1">

	<?php 
  $Valide=$_GET['Mensaje'];

    if ($Valide==2) {
        echo "<script>jQuery(function(){swal(\"¡Lo Sentimos!\", \"Datos Incorrectos\", \"error\");});</script>";
    };
    if ($Valide==1) {
        echo "<script>jQuery(function(){swal(\"¡ Referencia Creada!\", \"Correctamente \", \"success\");});</script>";
    };

      if ($Valide==4) {
        echo "<script>jQuery(function(){swal(\"¡Referencia Modificada!\", \"Correctamente\", \"success\");});</script>";
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
								<i class="ace-icon fa fa-list"></i>
								<a href="Lista-Referencias.php">Referencias Modasof</a>
							</li>
							<li>
								<i  class="ace-icon fa fa-eye-slash"></i>
								<a id="ocultar">Ocultar Filtros</a>
							</li>
							<li>
								<i class="ace-icon fa fa-eye"></i>
								<a id="mostrar" >Mostrar Filtros</a>
							</li>
						</ul><!-- /.breadcrumb -->

						
					</div>

					<div class="page-content">

						<div class="row">
	
	 <script type="text/javascript">
          	$(document).ready(function(){
		$("#mostrar").on( "click", function() {
			$('#target').show(); //muestro mediante id
			
		 });
		$("#ocultar").on( "click", function() {
			$('#target').hide(); //oculto mediante id
			
		});
	});
          </script>					
<div class="col-md-3">
	<form action="Lista-Referencias.php" method="post" autocomplete="off" >
		<input style="width: 250px;" type="text" name="codigobuscado" placeholder="Buscar por código" maxlength='5'>
		<input style="width: 250px;" type="text" name="preciobuscado" placeholder="Buscar por valor">
		<button type="submit" class="btn btn-primary btn-block margin-bottom">Buscar</button>
	</form> 
         
	
          <div style="display: none;" id="target" class="box box-solid">
            <div class="box-header with-border">
            <a href="Lista-Referencias.php?categoriaSel=ninguna&nomcategoria=">
              <h3 class="box-title">Categorías <span class="label label-warning pull-right">Borrar Filtros <i class="fa fa-eraser"> </i></span> </h3>
            </a>
            
            </div>
            <div class="box-body no-padding" style="">
              <ul class="nav nav-pills nav-stacked">
              	<li><a style="font-size: 12px;padding: 3px 5px; color: #82AF6F;" href="Lista-Referencias.php?categoriaSel=todos&nomcategoria=Todas"><i class="fa fa-filter"></i> REF. ACTIVAS <span class="label label-success pull-right">
              		<?php 
	$Tcantidadreferencia=contarcategoriastotal(0);
	echo($Tcantidadreferencia);
	 ?>
              		

              	</span></a>
                </li>
                <li><a style="font-size: 12px;padding: 3px 5px; color: red;" href="Lista-Referencias.php?categoriaSel=anteriores&nomcategoria=anteriores"><i class="fa fa-filter"></i> REF. INACTIVAS <span class="label label-danger pull-right">
                	<?php 
	$Tcantidadreferencia=contarcategoriastotal(1);
	echo($Tcantidadreferencia);
	 ?>
                </span></a>
                </li>
               <?php 
	$sql ="SELECT Nom_Cat_Producto,Id_Cat_Producto FROM t_categoria_producto order by Nom_Cat_Producto ASC ";
//Echo($sql);
	$result = $conexion->query($sql);
	if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
	$Nom_Cat_Producto=$row['Nom_Cat_Producto']; 
	$Id_Cat_Producto=$row['Id_Cat_Producto'];
	$cantidadreferencia=contarcategorias($Id_Cat_Producto);
	if ($cantidadreferencia>=1) {
?>
	<li><a style="font-size: 12px;padding: 3px 5px;" href="Lista-Referencias.php?categoriaSel=<?php echo($Id_Cat_Producto); ?>&nomcategoria=<?php echo($Nom_Cat_Producto) ?>"><i class="fa fa-filter"></i> <?php echo(utf8_decode($Nom_Cat_Producto)); ?> <span class="label label-info pull-right">
	<?php 
	
	echo($cantidadreferencia);
	 ?>

	</span></a>
                </li>

	<?php
   }
 }
 mysqli_free_result($result);
}
				 ?>
                
                
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>

							<div class="col-xs-12 col-sm-9">
							

							<div class="space-7"></div>

<div class="col-sm-12 col-xs-12"><!-- Inicio Panel Inferior-->
	
<!-- INICIO TABLA -->
						<div class="clearfix">
											<div class="pull-left tableTools-container"></div>
											
										</div>
										<div class="table-header" style="background-color: #000;">
											Lista de Referencias categoria <?php echo utf8_decode($nomcategoria); ?> Modasof
										</div>
										
										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
						<form>
											<table style="font-size: 12px;" id="dynamic-table"  class="table table-responsive table-striped table-bordered table-hover" width="100%">
												<thead>
											
													<tr class="warning">
														<th class="tdcustom">ID</th>
														<th class="tdcustom" >Img</th>
														<th class="tdcustom" >Línea</th>
														<th class="tdcustom" >Referencia</th>
														
														<th class="tdcustom" >Tipo Producto</th>
														
														<th class="tdcustom" >Detalle</th>
														<th class="tdcustom" >PVP</th>
														
														<th style="width: 15%" class="tdcustom" >Acciones</th>
													</tr>
													<tr>
														<th class="tdcustom">ID</th>
														<th class="tdcustom" >Img</th>
														<th class="tdcustom" >Línea</th>
														<th class="tdcustom" >Referencia</th>
														
														<th class="tdcustom" >Tipo Producto</th>
														
														<th class="tdcustom" >Detalle</th>
														
														<th class="tdcustom" >PVP</th>
														
														<th style="width: 15%" class="tdcustom" >Acciones</th>
													</tr>
												</thead>


												<tbody>
	<?php 

$codigobuscado=$_POST['codigobuscado'];
$preciobuscado=$_POST['preciobuscado'];


if ($categoriaSel=="todos") {
	$sql ="SELECT Cod_Referencia FROM t_referencias WHERE ref_activa='0' order by Id_Referencia ASC"; 
}
elseif ($categoriaSel=="anteriores") {
	$sql ="SELECT Cod_Referencia FROM t_referencias WHERE ref_activa='1' order by Id_Referencia ASC"; 
}
elseif ($codigobuscado!="") {
	$sql ="SELECT Cod_Referencia FROM t_referencias WHERE  ref_activa='0'and Cod_Referencia LIKE '%".$codigobuscado."%'";
}
elseif ($preciobuscado!="") {
	$sql ="SELECT Cod_Referencia FROM t_referencias WHERE  ref_activa='0'and PVP_Ref LIKE '%".$preciobuscado."%'";
}
elseif ($categoriaSel=="") {
	$sql ="SELECT Cod_Referencia FROM t_referencias WHERE ref_activa='0' order by Id_Referencia DESC LIMIT 0 , 20";
}
else
{
	$sql ="SELECT Cod_Referencia FROM t_referencias WHERE Categoria_Id_Categoria_Prod='".$categoriaSel."' and ref_activa='0' order by Id_Referencia  ASC";
} 
$result = $conexion->query($sql);
//Echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$Lista=$Lista.$row['Cod_Referencia'].",";                  
 }
 mysqli_free_result($result);
}
$Cadena=explode(",", $Lista);
//Split al Arreglo
$longitud = count($Cadena);
$min=$longitud-1;
//Recorro todos los elementos
//for($i=0; $i<$min; $i++)
//{
?>

<?php 
for($i=0; $i<$min; $i++)
{
	$sql ="SELECT Id_Referencia,Cod_Referencia,Img_Referencia,Categoria_Id_Categoria_Prod,SubCategoria_Id_Subcategoria_Prod,Coleccion_Nom_Coleccion,Insumo_Ppal,Tipo_Tela,Costo_Proyectado_Pref,V_Mano_Obra_Ref,PVP_Ref,P_Mayor,Ref_Publicada,Detalle_Antiguo,Tipo_Referencia FROM t_referencias  WHERE Cod_Referencia='".$Cadena[$i]."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Id_Referencia=$row['Id_Referencia'];
        $Cod_Referencia=$row['Cod_Referencia'];
        $Img_Referencia=$row['Img_Referencia'];
        $Categoria_Id_Categoria_Prod=$row['Categoria_Id_Categoria_Prod'];
        $SubCategoria_Id_Subcategoria_Prod=$row['SubCategoria_Id_Subcategoria_Prod'];
        //$FechaCreacion=$row['FechaCreacion'];
        $Coleccion_Nom_Coleccion=$row['Coleccion_Nom_Coleccion'];
        $Insumo_Ppal=$row['Insumo_Ppal'];
        $Tipo_Tela=$row['Tipo_Tela'];
        $Costo_Proyectado_Pref=$row['Costo_Proyectado_Pref'];
        $V_Mano_Obra_Ref=$row['V_Mano_Obra_Ref'];
        $PVP_Ref=$row['PVP_Ref'];
        $P_Mayor=$row['P_Mayor'];
        $Ref_Publicada=$row['Ref_Publicada'];
        $Detalle_Antiguo=$row['Detalle_Antiguo'];
        $Tipo_Referencia=$row['Tipo_Referencia'];

        $CostoInsumos=$Costo_Proyectado_Pref-$V_Mano_Obra_Ref;
       $TotalCosto=$V_Mano_Obra_Ref+$CostoInsumos;

if ($Costo_Proyectado_Pref==0) {
    $Operacion1=0;
}
elseif($PVP_Ref==0)
{
    $Operacion1=0;
}else{
	$Operacion1=((int)$Costo_Proyectado_Pref/(int) $PVP_Ref);	
}


$Operacion2=(1-$Operacion1);
$Operacion3=$Operacion2*100;
$UtilidadBruta=$Operacion3;
}
mysqli_free_result($result);
}

// CONSULTA NOMBRE CATEGORIA

$sql ="SELECT Nom_Cat_Producto FROM t_categoria_producto WHERE Id_Cat_Producto='".$Categoria_Id_Categoria_Prod."' ";
//Echo($sql);
	$result = $conexion->query($sql);
	if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
	$Nom_Cat_Producto=$row['Nom_Cat_Producto']; 
 }
 mysqli_free_result($result);
}

// CONSULTA NOMBRE sub CATEGORIA

$sql ="SELECT Nom_SubCat_Producto FROM t_subcategoria_producto WHERE Id_SubCat_Producto='".$SubCategoria_Id_Subcategoria_Prod."' ";
//Echo($sql);
	$result = $conexion->query($sql);
	if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
	$Nom_SubCat_Producto=$row['Nom_SubCat_Producto']; 
 }
 mysqli_free_result($result);
}



				 ?>

														<tr>
															<td class="tdcustom">
															<a target="_blank" href="Producto-Disponibilidad.php?RefSel=<?php Echo($Cod_Referencia); ?>&Referencia=<?php Echo($Coleccion_Nom_Coleccion); ?>" class="tooltip-success green" data-rel="tooltip" data-placement="top" title="Ver Disponibilidad"><?php Echo utf8_encode($Id_Referencia) ?>	</a>
															</td>
															<td class="tdcustom">
															<a target="_blank" href="<?php Echo($Img_Referencia); ?>">
														<?php
														$ruta_img = utf8_encode($Img_Referencia);
                                                        $mostrar_img = "miniatura.php?x=60&y=60&file=".$ruta_img;
														?>
													<img src="<?php echo $mostrar_img; ?>" width="50px" height="50px">
													</a>
															</td>
															<td class="tdcustom">
															<?php Echo utf8_encode($Nom_SubCat_Producto) ?>	
															</td>
															<td class="tdcustom">
															<?php Echo utf8_encode($Cod_Referencia) ?>	
															</td>
															
															<td class="tdcustom">
															<?php Echo utf8_encode($Nom_Cat_Producto." ".$Tipo_Tela) ?>	
															</td>
															
															<td class="tdcustom">
															<?php Echo ($Detalle_Antiguo) ?>		
															</td>
															
															<td class="tdcustom">
															<?php Echo utf8_encode(formatomoneda($PVP_Ref)) ?>	
															</td>
															
														
														
														<td class="center">
															<div class=" action-buttons">

											<?php 
											if ($IdRol==1) {
												?>
											
												<a target="_blank" href="Cargar-Inventario.php?RefSel=<?php Echo($Cod_Referencia); ?>&Referencia=<?php Echo($Coleccion_Nom_Coleccion); ?>" class="tooltip-success black" data-rel="tooltip" data-placement="top" title="Cargar a Inventario"><i class="fa fa-cloud-download bigger-130"></i></a>
													
													<a target="_blank" href="Producto-modificar.php?RefSel=<?php Echo($Cod_Referencia); ?>" class="tooltip-success black" data-rel="tooltip" data-placement="top" title="Modificar Referencia"><i class="fa fa-edit bigger-130"></i></a>
													<a href="Produccion-Solicitud.php?RefSel=<?php Echo($Cod_Referencia); ?>&Referencia=<?php Echo($Coleccion_Nom_Coleccion); ?>" class="tooltip-success black" data-rel="tooltip" data-placement="top" title="Solicitud de Producción"><i class="fa fa-cogs bigger-130"></i></a>
													<a target="_blank" href="Producto-Disponibilidad.php?RefSel=<?php Echo($Cod_Referencia); ?>&Referencia=<?php Echo($Coleccion_Nom_Coleccion); ?>" class="tooltip-success green" data-rel="tooltip" data-placement="top" title="Ver Disponibilidad"><i class="fa fa-eye bigger-130"></i></a>
												<?php
											}
											elseif ($IdRol==2)
											{

											 ?>
											 <a target="_blank" href="Producto-modificar.php?RefSel=<?php Echo($Cod_Referencia); ?>" class="tooltip-success black" data-rel="tooltip" data-placement="top" title="Modificar Referencia"><i class="fa fa-edit bigger-130"></i></a>

											 <a target="_blank" href="Produccion-Solicitud.php?RefSel=<?php Echo($Cod_Referencia); ?>&Referencia=<?php Echo($Coleccion_Nom_Coleccion); ?>" class="tooltip-success black" data-rel="tooltip" data-placement="top" title="Solicitud de Producción"><i class="fa fa-cogs bigger-130"></i></a>

												<a target="_blank" href="Producto-Disponibilidad.php?RefSel=<?php Echo($Cod_Referencia); ?>&Referencia=<?php Echo($Coleccion_Nom_Coleccion); ?>" class="tooltip-success green" data-rel="tooltip" data-placement="top" title="Ver Disponibilidad"><i class="fa fa-eye bigger-130"></i></a>
												
											<?php 
											}
											elseif ($IdRol==3 and $IdUser=='97' and $MyIdTienda=='10')
											{
												?>

												<a target="_blank" href="Cargar-Inventario.php?RefSel=<?php Echo($Cod_Referencia); ?>&Referencia=<?php Echo($Coleccion_Nom_Coleccion); ?>" class="tooltip-success black" data-rel="tooltip" data-placement="top" title="Cargar a Inventario"><i class="fa fa-cloud-download bigger-130"></i></a>

												 <a target="_blank" href="Produccion-Solicitud.php?RefSel=<?php Echo($Cod_Referencia); ?>&Referencia=<?php Echo($Coleccion_Nom_Coleccion); ?>" class="tooltip-success black" data-rel="tooltip" data-placement="top" title="Solicitud de Producción"><i class="fa fa-cogs bigger-130"></i></a>
												 
												<a target="_blank" href="Producto-Disponibilidad.php?RefSel=<?php Echo($Cod_Referencia); ?>&Referencia=<?php Echo($Coleccion_Nom_Coleccion); ?>" class="tooltip-success green" data-rel="tooltip" data-placement="top" title="Ver Disponibilidad"><i class="fa fa-eye bigger-130"></i></a>
												
												<?php
											}else{
												?>
												 <a target="_blank" href="Produccion-Solicitud.php?RefSel=<?php Echo($Cod_Referencia); ?>&Referencia=<?php Echo($Coleccion_Nom_Coleccion); ?>" class="tooltip-success black" data-rel="tooltip" data-placement="top" title="Solicitud de Producción"><i class="fa fa-cogs bigger-130"></i></a>
												 
												<a target="_blank" href="Producto-Disponibilidad.php?RefSel=<?php Echo($Cod_Referencia); ?>&Referencia=<?php Echo($Coleccion_Nom_Coleccion); ?>" class="tooltip-success green" data-rel="tooltip" data-placement="top" title="Ver Disponibilidad"><i class="fa fa-eye bigger-130"></i></a>
												<!-- <a href="Cargar-Inventario.php?RefSel=<?php Echo($Cod_Referencia); ?>&Referencia=<?php Echo($Coleccion_Nom_Coleccion); ?>" class="tooltip-success black" data-rel="tooltip" data-placement="top" title="Cargar a Inventario"><i class="fa fa-cloud-download bigger-130"></i></a> -->
												<?php

											}

											 ?>

															</div>

															
														</td>
													</tr>
													<?php 
													
}
													 ?>
												</tbody>
											</table>
											</form>
										</div>
						<!-- FIN TABLA -->

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
		
		<!-- ace scripts -->
		<script src="https://modasof.com/espejo/assets/js/ace-elements.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/ace.min.js"></script>

		
		
		<script src="https://modasof.com/espejo/assets/js/jquery.dataTables.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/dataTables.buttons.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/buttons.flash.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/buttons.html5.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/buttons.print.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/buttons.colVis.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/dataTables.select.min.js"></script>
		<!-- <script src="https://modasof.com/espejo/assets/js/pdfmake.min.js"></script> -->
		<!-- <script src="https://modasof.com/espejo/assets/js/vfs_fonts.js"></script> -->
		<script src="https://modasof.com/espejo/assets/js/jszip.min.js"></script>
		
		<script src="https://modasof.com/espejo/assets/js/jquery.validate.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery-additional-methods.min.js"></script>

		<script src="https://modasof.com/espejo/assets/js/dataTables.responsive.min.js"></script>
		 
    
		
		
	
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
			
    "lengthMenu": [[5000, 7000, 10000, -1], [5000, 7000, 10000, "All"]],

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
