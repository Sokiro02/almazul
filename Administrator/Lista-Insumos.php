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
$tiposel=$_GET['tipo'];


$Confirmation=$_GET['Confirmation'];

if ($Confirmation!="") {
	$sql ="UPDATE t_insumos SET ref_activa='1' WHERE Cod_Insumo='".$Confirmation."'";  
//echo($sql);
$result = $conexion->query($sql);

header("location:Lista-Insumos.php?Mensaje=18");
}

$ConfirmationActivate=$_GET['ConfirmationActivate'];

if ($ConfirmationActivate!="") {
	$sql ="UPDATE t_insumos SET ref_activa='0' WHERE Cod_Insumo='".$ConfirmationActivate."'";  
//echo($sql);
$result = $conexion->query($sql);

header("location:Lista-Insumos.php?Mensaje=88");
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Insumos Modasof</title>

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
        echo "<script>jQuery(function(){swal(\"¡ Insumo Creado!\", \"Correctamente \", \"success\");});</script>";
    };
     if ($Valide==111) {
        echo "<script>jQuery(function(){swal(\"¡ Insumo Actualizado!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==18) {
        echo "<script>jQuery(function(){swal(\"¡ Insumo Eliminado!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==88) {
        echo "<script>jQuery(function(){swal(\"¡ Insumo Activado!\", \"Correctamente \", \"success\");});</script>";
    };
     if ($Valide==2) {
        echo "<script>jQuery(function(){swal(\"¡ Proveedor Actualizado!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==22) {
        echo "<script>jQuery(function(){swal(\"¡ Extra Cargada a Cliente!\", \"".$ClienteSel." \", \"success\");});</script>";
    };
     if ($Valide==11) {
        echo "<script>jQuery(function(){swal(\"¡ Categoria de Insumo Creada!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==12) {
        echo "<script>jQuery(function(){swal(\"¡ Sub-Categoria de Insumo Creada!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==122) {
        echo "<script>jQuery(function(){swal(\"¡ Atributo Creado!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==13) {
        echo "<script>jQuery(function(){swal(\"¡ Nombre Categoria Actualizado!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==14) {
        echo "<script>jQuery(function(){swal(\"¡ Nombre Sub-Categoria Actualizado!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==15) {
        echo "<script>jQuery(function(){swal(\"¡ Estado Categoria Actualizado!\", \"Correctamente \", \"success\");});</script>";
    };
     if ($Valide==16) {
        echo "<script>jQuery(function(){swal(\"¡ Nombre Atributo Actualizado!\", \"Correctamente \", \"success\");});</script>";
    };
   ?>


   <?php 

if (isset($_GET['DeleteInsumo'])) {
	 $DeleteInsumo=$_GET['DeleteInsumo'];

    if ($DeleteInsumo!="") {
    	?>
    	<script>jQuery(function(){
    	swal({
  title: "¿Está seguro de eliminar este Insumo?",
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
    window.location.href = 'Lista-Insumos.php?Confirmation=<?php Echo($DeleteInsumo); ?>';
  } else {
    window.location.href = 'Lista-Insumos.php';
  }
});

    });
    	</script>;
    	<?php
    };
}

   ?>

    <?php 

if (isset($_GET['ActiveInsumo'])) {
	 $ActiveInsumo=$_GET['ActiveInsumo'];

    if ($ActiveInsumo!="") {
    	?>
    	<script>jQuery(function(){
    	swal({
  title: "¿Está seguro de activar este Insumo?",
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
    window.location.href = 'Lista-Insumos.php?ConfirmationActivate=<?php Echo($ActiveInsumo); ?>';
  } else {
    window.location.href = 'Lista-Insumos.php';
  }
});

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
								<i class="ace-icon fa fa-list"></i>
								<a href="Lista-Insumos.php">Insumos Modasof</a>
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
	<form action="Lista-Insumos.php" method="post" autocomplete="off" >
		<input style="width: 250px;" type="text" name="codigobuscado" placeholder="Buscar por código" maxlength='5'>
		<button type="submit" class="btn btn-primary btn-block margin-bottom">Buscar</button>
	</form> 
         
	
    <div  id="target" class="box box-solid">
            <div class="box-header with-border">
            <a href="Lista-Insumos.php?categoriaSel=ninguna&nomcategoria=">
              <h3 class="box-title">Producción <span class="label label-warning pull-right">Borrar Filtros <i class="fa fa-eraser"> </i></span> </h3>
            </a>
            
            </div>
            <div class="box-body no-padding" style="">
              <ul class="nav nav-pills nav-stacked">

              <li><a style="font-size: 12px;padding: 3px 5px; color: red;" href="Lista-Insumos.php?categoriaSel=anteriores&nomcategoria=anteriores"><i class="fa fa-filter"></i> Eliminados <span class="label label-danger pull-right">
                	<?php 
	$Tcantidadreferencia=contarinsumoseliminados();
	echo($Tcantidadreferencia);
	 ?>
                </span></a>
                </li>
              
               
               <?php 
	$sql ="SELECT DISTINCT(A.Id_Categoria_Insumo), A.Nom_CategoriaIns FROM t_categorias_insumos as A, t_insumos as B WHERE A.Id_Categoria_Insumo=B.Categoria_Id_Categoria_Insumo and B.tipo_insumo='1' order by A.Nom_CategoriaIns ASC; ";
//Echo($sql);
	$result = $conexion->query($sql);
	if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
	$Nom_CategoriaIns=$row['Nom_CategoriaIns']; 
	$Id_Categoria_Insumo=$row['Id_Categoria_Insumo'];
	$cantidadreferencia=contarcategoriasinsumos($Id_Categoria_Insumo,1);
	if ($cantidadreferencia!=1) {
?>
	<li><a style="font-size: 12px;padding: 3px 5px;" href="Lista-Insumos.php?categoriaSel=<?php echo($Id_Categoria_Insumo); ?>&nomcategoria=<?php echo($Nom_CategoriaIns) ?>&tipo=1"><i class="fa fa-filter"></i> <?php echo(utf8_decode($Nom_CategoriaIns)); ?> <span class="label label-info pull-right">
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



            <div class="box-header with-border">
            <a href="Lista-Insumos.php?categoriaSel=ninguna&nomcategoria=">
              <h3 class="box-title">Maquila <span class="label label-warning pull-right">Borrar Filtros <i class="fa fa-eraser"> </i></span> </h3>
            </a>
            
            </div>
            <div class="box-body no-padding" style="">
              <ul class="nav nav-pills nav-stacked">
              
               
               <?php 
	$sql ="SELECT DISTINCT(A.Id_Categoria_Insumo), A.Nom_CategoriaIns FROM t_categorias_insumos as A, t_insumos as B WHERE A.Id_Categoria_Insumo=B.Categoria_Id_Categoria_Insumo and B.tipo_insumo='2' order by A.Nom_CategoriaIns ASC; ";
//Echo($sql);
	$result = $conexion->query($sql);
	if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
	$Nom_CategoriaIns=$row['Nom_CategoriaIns']; 
	$Id_Categoria_Insumo=$row['Id_Categoria_Insumo'];
	$cantidadreferencia=contarcategoriasinsumos($Id_Categoria_Insumo,2);
	if ($cantidadreferencia!=1) {
?>
	<li><a style="font-size: 12px;padding: 3px 5px;" href="Lista-Insumos.php?categoriaSel=<?php echo($Id_Categoria_Insumo); ?>&nomcategoria=<?php echo($Nom_CategoriaIns) ?>&tipo=2"><i class="fa fa-filter"></i> <?php echo(utf8_decode($Nom_CategoriaIns)); ?> <span class="label label-info pull-right">
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
							<!-- Link Ventana Modal -->
<a  href="Insumos-Nuevo.php?New=1"><span class="btn btn-info pull-right"><i class="fa fa-plus-square"> </i> Crear Insumo</span></a> 
<!-- Link Ventana Modal -->	
											<div class="pull-left tableTools-container"></div>
											
										</div>
										<div class="table-header" style="background-color: #000;">
											Lista de Insumos categoria <?php echo utf8_decode($nomcategoria); ?> Modasof
										</div>
										
										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
						<form>
											<table style="font-size: 12px;" id="dynamic-table"  class="table table-responsive table-striped table-bordered table-hover" width="100%">
												<thead>
											
													<tr class="warning">
														<th class="tdcustom" style="width: 5%;">Cód.</th>
														<th class="tdcustom" style="width: 5%;">Img</th>
														<!-- <th class="tdcustom" style="width: 5%;">Categoria</th> -->
														<th class="tdcustom" style="width: 10%;">Nombre</th>
														
														<!-- <th class="tdcustom" style="width: 5%;">Disp. Valledupar</th>
														<th class="tdcustom" style="width: 5%;">Disp. Barranquilla</th> -->
														<!-- <th class="tdcustom" style="width: 5%;">T. Inventario</th> -->
														<th class="tdcustom" style="width: 5%;">Tipo Insumo</th>
														<th class="tdcustom" style="width: 10%;">Proveedor</th>
														<th class="tdcustom" style="width: 5%;">Precio</th>
														<th class="tdcustom" style="width: 10%;">Acciones</th>
													</tr>
													<tr>
														<th class="tdcustom" style="width: 5%;">Cód.</th>
														<th class="tdcustom" style="width: 5%;">Img</th>
														<!-- <th class="tdcustom" style="width: 5%;">Categoria</th> -->
														<th class="tdcustom" style="width: 10%;">Nombre</th>
														
														<!-- <th class="tdcustom" style="width: 5%;">Disp. Valledupar</th>
														<th class="tdcustom" style="width: 5%;">Disp. Barranquilla</th> -->
														<!-- <th class="tdcustom" style="width: 5%;">T. Inventario</th> -->
														<th class="tdcustom" style="width: 5%;">Tipo Insumo</th>
														<th class="tdcustom" style="width: 10%;">Proveedor</th>
														<th class="tdcustom" style="width: 5%;">Precio</th>
														<th class="tdcustom" style="width: 10%;">Acciones</th>
													</tr>
												</thead>


												<tbody>
	<?php 

$codigobuscado=$_POST['codigobuscado'];



if ($categoriaSel=="todos") {
	$sql ="SELECT DISTINCT(Cod_Insumo) FROM t_insumos WHERE ref_activa='0' order by Id_Insumo ASC"; 
}
elseif ($categoriaSel=="anteriores") {
	$sql ="SELECT DISTINCT(Cod_Insumo) FROM t_insumos WHERE ref_activa='1' order by Id_Insumo ASC"; 
}

elseif ($categoriaSel!="" and $tiposel!="") {
	$sql ="SELECT DISTINCT(Cod_Insumo) FROM t_insumos WHERE ref_activa='0' and Categoria_Id_Categoria_Insumo='".$categoriaSel."' and tipo_insumo='".$tiposel."' order by Id_Insumo ASC"; 
}

elseif ($codigobuscado!="") {
	$sql ="SELECT DISTINCT(Cod_Insumo) FROM t_insumos WHERE  ref_activa='0' and Cod_Insumo LIKE '%".$codigobuscado."%'";
}
elseif ($categoriaSel=="") {
	$sql ="SELECT DISTINCT(Cod_Insumo) FROM t_insumos WHERE ref_activa='0' order by Id_Insumo DESC LIMIT 0 , 20";
}
else
{
	$sql ="SELECT DISTINCT(Cod_Insumo) FROM t_insumos  order by Id_Insumo DESC LIMIT 20";
} 
$result = $conexion->query($sql);
//Echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$Lista=$Lista.$row['Cod_Insumo'].",";                  
 }
 mysqli_free_result($result);
}
$CadenaInsumos=explode(",", $Lista);
//Split al Arreglo
$longitud = count($CadenaInsumos);
$min=$longitud-1;
//Recorro todos los elementos
//for($i=0; $i<$min; $i++)
//{
?>

<?php 
for($i=0; $i<$min; $i++)
{
	$sql ="SELECT C.Nom_Color,Id_Insumo, Cod_Insumo, Nom_Insumo, Unidad_Insumo, Url_Insumo, Detalle_Insumo,Nom_CategoriaIns,Tipo_Insumo,ref_activa FROM t_insumos as A, t_categorias_insumos as B,t_colores as C WHERE Cod_Insumo='".$CadenaInsumos[$i]."' and A.Categoria_Id_Categoria_Insumo=B.Id_Categoria_Insumo and A.Color_Ppal=C.Id_Color"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Tb_Id_Insumo=$row['Id_Insumo'];
        $Tb_Cod_Insumo=$row['Cod_Insumo'];
        $Tb_Nom_Insumo=$row['Nom_Insumo'];
        $Tb_Nom_Color=$row['Nom_Color'];
        $Tb_Tipo_Insumo=$row['Tipo_Insumo'];
        $Tb_Unidad_Insumo=$row['Unidad_Insumo'];
        $Tb_Url_Insumo=$row['Url_Insumo'];
        $Tb_Nom_CategoriaIns=$row['Nom_CategoriaIns'];
        $ref_activa=$row['ref_activa'];

        if ($Tb_Tipo_Insumo==1) {
        	$Nom_Tipo_Insumo="PRODUCCIÓN";
        }
         if ($Tb_Tipo_Insumo==2) {
        	$Nom_Tipo_Insumo="PRODUCTO TERMINADO";
        }
}
mysqli_free_result($result);
}

				 ?>

														<tr>
														<td>
															<?php echo utf8_encode($Tb_Cod_Insumo); ?>	
														</td>
														<td class="center">
															<a target="_blank" href="<?php Echo($Tb_Url_Insumo); ?>">
														<?php
														$ruta_img = utf8_encode($Tb_Url_Insumo);
                                                        $mostrar_img = "miniatura.php?x=30&y=30&file=".$ruta_img;
														?>
													<img src="<?php echo $mostrar_img; ?>" width="30px" height="30px">
													</a>
														</td>
														<!-- <td class="tdcustom">
															<?php Echo utf8_encode($Tb_Nom_CategoriaIns) ?>
																
															</td> -->
														<td class="tdcustom">
															<?php Echo strtoupper(utf8_encode($Tb_Nom_Insumo." ".$Tb_Nom_Color)) ?>
																
															</td>
														
														
														<td>
															<?php Echo ($Nom_Tipo_Insumo); ?>
														</td>
														<td>
															<?php 
	$sql ="SELECT Cod_Insumo, Proveedor_Id_Proveedor,Nom_Prov,MIN(Costo_Insumo) as MinCosto FROM t_insumos as A, t_proveedores as B WHERE Cod_Insumo='".$CadenaInsumos[$i]."' and A.Proveedor_Id_Proveedor=B.Id_Proveedor  order by Costo_Insumo asc"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        
        $Min_Cod_Insumo=$row['Cod_Insumo'];
        $Min_Nom_Prov=$row['Nom_Prov'];
        $Min_Costo_Insumo=$row['MinCosto'];
       }
   }
								 ?>	
								
												<?php echo ($Min_Nom_Prov); ?>
														
														</td>

														<td class="center">
										<?php 
	$sql ="SELECT Cod_Insumo, Proveedor_Id_Proveedor,Nom_Prov,MIN(Costo_Insumo) as MinCosto FROM t_insumos as A, t_proveedores as B WHERE Cod_Insumo='".$CadenaInsumos[$i]."' and A.Proveedor_Id_Proveedor=B.Id_Proveedor  order by Costo_Insumo asc"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        
        $Min_Cod_Insumo=$row['Cod_Insumo'];
        $Min_Nom_Prov=$row['Nom_Prov'];
        $Min_Costo_Insumo=$row['MinCosto'];
       }
   }
								 ?>	
								 <a href="" class="tooltip-primary blue" data-rel="tooltip" data-placement="top" title="Mejor Precio en el Mercado">
																	<?php echo (Formatomoneda($Min_Costo_Insumo)); ?>
														</a>

														</td>

														
														<td >
															<div">

												
															<div class="btn-group">
												<button data-toggle="dropdown" class="tooltip-primary dropdown-toggle">
													Crear Pedido a:
													<i class="ace-icon fa fa-angle-down icon-on-right"></i>
												</button>

												<ul class="dropdown-menu tooltip-primary">
								<?php 
	$sql ="SELECT Cod_Insumo, Proveedor_Id_Proveedor,Nom_Prov,Costo_Insumo FROM t_insumos as A, t_proveedores as B WHERE Cod_Insumo='".$CadenaInsumos[$i]."' and A.Proveedor_Id_Proveedor=B.Id_Proveedor  order by Costo_Insumo asc"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Tb_Id_Proveedor=$row['Proveedor_Id_Proveedor'];
        $Tb_Cod_Insumo=$row['Cod_Insumo'];
        $Tb_Nom_Prov=$row['Nom_Prov'];
        $Tb_Costo_Insumo=$row['Costo_Insumo'];
       
								 ?>

													<li>
														<a href="Proveedor-CrearOrden.php?NomProv=<?php Echo utf8_encode($Tb_Nom_Prov) ?>&DocSel=<?php Echo utf8_encode($Tb_Id_Proveedor) ?>"><?php Echo utf8_encode($Tb_Nom_Prov) ?> <strong>(<?php Echo(Formatomoneda($Tb_Costo_Insumo)) ?>)</strong></a>
													</li>

													
									<?php 
								}
									}
									 ?>
												</ul>
											</div><!-- /.btn-group -->
														<?php 
										if ($ref_activa==0) {
												?>

											   <a href="Lista-Insumos.php?DeleteInsumo=<?php echo($Tb_Cod_Insumo);?>" class="tooltip-danger red" data-rel="tooltip" data-placement="top" title="Eliminar Insumo">
															<i class="fa fa-trash-o bigger-150"></i>
												</a>
												<?php
											}else{
												?>

								<a href="Lista-Insumos.php?ActiveInsumo=<?php echo($Tb_Cod_Insumo);?>" class="tooltip-success green" data-rel="tooltip" data-placement="top" title="Activar Insumo">
															<i class="fa fa-check bigger-150"></i>
												</a>

												<?php
											}


											 ?>		
										<a href="insumos.php?EditTask=<?php echo($Tb_Id_Insumo);?>" class="tooltip-primary blue" data-rel="tooltip" data-placement="top" title="Editar Insumo">
												<i class="fa fa-pencil"></i>
														</a>
										<a target="_blank" href="Insumos-Proveedores.php?Addproveedor=<?php echo($Tb_Id_Insumo);?>&CodigoInsumo=<?php Echo($Tb_Cod_Insumo); ?>" class="tooltip-primary blue" data-rel="tooltip" data-placement="top" title="Agregar Proveedores">
												<i class="fa fa-user"></i>
														</a>

											 <!--  <a href="Proveedores.php?EditTask=<?php echo($Tb_Id_Insumo);?>" class="tooltip-danger red" data-rel="tooltip" data-placement="top" title="Transferir Insumos">
															<i class="fa fa-exchange bigger-150"></i>
												</a>
 -->
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
