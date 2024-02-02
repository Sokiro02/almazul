<?php
include "Lib/sesion.php";
include "Lib/display_error.php";
include "Lib/conexion.php";
include "Lib/formulas.php";
$IdUser     = $_SESSION['IdUser'];
$IdRol      = $_SESSION['IdRol'];
$MyIdTaller = $_SESSION['IdTaller'];
$MiTaller   = $_SESSION['nicktaller'];
include "Lib/permisos.php";
date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');
$DiaActual    = date('Y-m-d');

$DeleteRegistro    = $_GET['DeleteRegistro'];
$getsalidagenerica = $_GET['salidagenerica'];

if ($getsalidagenerica == 1) {

    $fecha_salida   = $_POST['fecha_salida'];
    $taller_id      = $_POST['taller_id'];
    $ref_id         = $_POST['ref_id'];
    $talla_id       = $_POST['talla_id'];
    $nom_talla      = $_POST['nom_talla'];
    $cantidad       = $_POST['cantidad'];
    $pedido_numero  = $_POST['pedido_numero'];
    $creado_por     = $_POST['creado_por'];
    $marca_temporal = $_POST['marca_temporal'];
    $post_Id= $_POST['Id_Solicitud_Prod'];

    $sql = "INSERT INTO t_salidas_genericas (fecha_salida, taller_id, ref_id, talla_id, nom_talla, cantidad, pedido_numero, creado_por, marca_temporal) values ('" . $fecha_salida . "','" . $taller_id . "','" . $ref_id . "','" . $talla_id . "','" . $nom_talla . "','" . $cantidad . "','" . $pedido_numero . "','" . $creado_por . "','" . $marca_temporal . "');";
    //echo($sql);
    $result = $conexion->query($sql);

    $SqlActualizar ="UPDATE t_solicitudes_prod SET Existencias_Ref=Existencias_Ref-'".$cantidad."' WHERE Id_Solicitud_Prod='".$post_Id."'";
    $ResultActualizar = $conexion->query($SqlActualizar);

    header("location:Centro-Distribucion.php?Stock=1&Mensaje=2");
}

if ($DeleteRegistro != "") {
    $sql = "DELETE FROM t_solicitudes_prod where Cod_Solicitud_Prod='" . $DeleteRegistro . "';";

    $result = $conexion->query($sql);
    header("Centro-Distribucion.php?Stock=1");
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Centro Distribución Modasof</title>

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
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/AdminLTE.css">
        <link rel="stylesheet" href="https://modasof.com/espejo/assets/css/_all-skins.min.css">

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

    <link rel="stylesheet" href="https://modasof.com/espejo/assets/css/magnific-popup.css">
<script type="text/javascript">
	$(document).ready(function() {
  $('.image-link').magnificPopup({type:'image'});
});
</script>

    <?php include "Lib/Favicon.php"?>

     <script type="text/javascript">
$(document).ready(function(){
$("#TxtNombre").keyup(function(){ //se crea la funcioin keyup
var texto = $(this).val();//se recupera el valor de la caja de texto y se guarda en la variable texto
var dataString = 'ValProveedor='+ texto;//se guarda en una variable nueva para posteriormente pasarla a busqueda.php

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

	</head>

	<body class="skin-1">

	<?php
$Valide        = $_GET['Mensaje'];
$OrdenDespacho = $_GET['OrdenDespacho'];

if ($Valide == 1) {
    echo "<script>jQuery(function(){swal(\"¡Lo Sentimos!\", \"Seleccione al menos una orden para despacho\", \"error\");});</script>";
}
;
if ($Valide == 2) {
    echo "<script>jQuery(function(){swal(\"¡ Salida de Referencia creada!\", \"Correctamente \", \"success\");});</script>";
}
;
if ($Valide == 18) {
    echo "<script>jQuery(function(){swal(\"¡ Proveedor Eliminado!\", \"Correctamente \", \"success\");});</script>";
}
;
if ($Valide == 28) {
    echo "<script>jQuery(function(){swal(\"¡ Proveedor Actualizado!\", \"Correctamente \", \"success\");});</script>";
}
;
if ($Valide == 22) {
    echo "<script>jQuery(function(){swal(\"¡ Orden de Desapacho Nº!\", \"" . $OrdenDespacho . " \", \"success\");});</script>";
}
;
?>

  <?php

if (isset($_GET['DeleteTask'])) {
    $DeleteTask = $_GET['DeleteTask'];

    if ($DeleteTask != "") {
        ?>
    	<script>jQuery(function(){
    	swal({
  title: "¿Está seguro de eliminar este Proveedor?",
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
    window.location.href = 'Proveedores.php?Confirmation=<?php echo ($DeleteTask); ?>';
  } else {
    window.location.href = 'Proveedores.php';
  }
});
// swal({
//   title: "¿Qué transacción desea realizar?",
//   text: "<a href='negocios.php?valido=1'>Retiro </a>-<a href='negocios.php?valido=1'>Aporte</a>",
//   html: true,
//   showCancelButton: true,
//   closeOnConfirm: false,
//   showLoaderOnConfirm: false,
// });


   //swal("Good job!", "You clicked the button!", "success");
    });
    	</script>;
    	<?php
}
    ;
}

?>

	<?php
include "Lib/Alertas.php"
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
include "Lib/links.php";
include "Lib/menuleft.php";
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
								<a href="Centro-Distribucion.php">Centro de Distribución</a>
							</li>

							<li>
								<i class="ace-icon fa fa-users blue"></i>
								<a class="blue" href="Centro-Distribucion.php?Stock=1">Despacho para Stock</a>
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

<?php

$Stock = $_GET['Stock'];

if ($Stock == 1) {

    ?>



<?php

    $sql    = "SELECT Cons_Despacho FROM t_config WHERE Desarrollador='TEKSYSTEM S.A.S'";
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $Cons_Despacho = $row['Cons_Despacho'] + 1;
        }
    }
    ?>

<input type="text" name="TxtConsecutivo" value="<?php echo ($Cons_Despacho) ?>" style="display: none;"/>
										</div>

<!-- Link Ventana Modal -->


<!-- INICIO TABLA -->
						<div class="clearfix">
							<hr>
											<div class="pull-left tableTools-container"></div>

										</div>
										<div class="table-header" style="background-color: #6FB3E0;">
											Lista de Pedidos a Producción <?php echo ($MiTaller); ?>
										</div>

										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
							<table style="font-size: 12px;" id="dynamic-table" class="table table-responsive table-striped table-bordered table-hover" width="100%">
												<thead>

													<tr class="warning">
														<th class="tdcustom">
															Orden Producción

														</th>
														<th class="tdcustom">Fecha Solicitud</th>
                            <th class="tdcustom" style="width: 5%;">Img</th>
														<th class="tdcustom" >Referencia</th>
                            <th class="tdcustom" style="width: 5%;">Talla</th>

														<th class="tdcustom" style="width: 5%;">Cantidad</th>
														 <th class="tdcustom" style="width: 5%;">Valor Und.</th>
														 <th class="tdcustom" style="width: 5%;">Valor Total.</th>
														<th class="tdcustom" >Centro Distribución</th>

											<th class="tdcustom" style="width: 30%;">Acción</th>


													</tr>

													<tr>
														<th class="tdcustom">
															Orden Producción

														</th>
														<th class="tdcustom">Fecha Solicitud</th>
                            <th class="tdcustom" style="width: 5%;">Img</th>
														<th class="tdcustom" >Referencia</th>
                            <th class="tdcustom" style="width: 5%;">Talla</th>

														<th class="tdcustom" style="width: 5%;">Cantidad</th>
														 <th class="tdcustom" style="width: 5%;">Valor Und.</th>
														 <th class="tdcustom" style="width: 5%;">Valor Total.</th>
														<th class="tdcustom" >Centro Distribución</th>

											<th class="tdcustom" style="width: 30%;" >Acción</th>


													</tr>

												</thead>

												<tbody>
	<?php
$sql = "SELECT Cod_Solicitud_Prod FROM t_solicitudes_prod WHERE Estado_Solicitud_Prod='7' and Existencias_Ref>'0' and Bodega_Id_Bodega='" . $MyIdTaller . "' order by Cod_Solicitud_Prod Desc ";
//Echo($sql);
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $ListaOrdenes = $ListaOrdenes . $row['Cod_Solicitud_Prod'] . ",";
        }
    }
    $CadenaOrdenes = explode(",", $ListaOrdenes);
//Split al Arreglo
    $longitud = count($CadenaOrdenes);
    $min      = $longitud - 1;
//Recorro todos los elementos
    //for($i=0; $i<$min; $i++)
    //{
    ?>

<?php
for ($i = 0; $i < $min; $i++) {
        //***************************************************************************************************
        $sql = "SELECT date_format(Fecha_Solicitud,CONCAT(CONCAT(ELT(WEEKDAY(Fecha_Solicitud) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(Fecha_Solicitud), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS CreadaFecha,B.Nombres,B.Apellidos,B.Img_Perfil,Id_Solicitud_Prod, C.Nom_Bodega, Cant_Solicitada, D.Nom_Talla,D.Id_Talla, Referencia_Id_Referencia, Estado_Solicitud_Prod, Existencias_Ref, Fecha_Solicitud,Sastre_Id_Usuario,Cod_Solicitud_Prod, F.Img_Referencia,F.pvp_Ref FROM t_solicitudes_prod AS A, t_usuarios as B, t_bodegas as C, t_tallas as D,t_referencias as F WHERE Cod_Solicitud_Prod='" . $CadenaOrdenes[$i] . "' AND A.Solicitud_Id_Usuario=B.Id_Usuario and A.Bodega_Id_Bodega=C.Id_Bodega and A.Talla_Solicitada=D.Id_Talla and  A.Referencia_Id_Referencia=F.Cod_Referencia  ORDER BY UNIX_TIMESTAMP(Fecha_Solicitud) DESC";
        //Echo($sql);
        $result = $conexion->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $CreadaFecha              = $row['CreadaFecha'];
                $Cod_Solicitud_Prod       = $row['Cod_Solicitud_Prod'];
                $Fecha_Solicitud          = $row['Fecha_Solicitud'];
                $Nombres                  = $row['Nombres'];
                $Apellidos                = $row['Apellidos'];
                $Img_Perfil               = $row['Img_Perfil'];
                $Img_Referencia           = $row['Img_Referencia'];
                $Id_Solicitud_Prod        = $row['Id_Solicitud_Prod'];
                $Nom_Bodega               = $row['Nom_Bodega'];
                $Cant_Solicitada          = $row['Cant_Solicitada'];
                $Existencias_Ref          = $row['Existencias_Ref'];
                $Nom_Talla                = $row['Nom_Talla'];
                $Id_Talla                 = $row['Id_Talla'];
                $pvp_Ref                  = $row['pvp_Ref'];
                $Referencia_Id_Referencia = $row['Referencia_Id_Referencia'];
                $Estado_Solicitud_Prod    = $row['Estado_Solicitud_Prod'];
                $Sastre                   = $row['Sastre_Id_Usuario'];

                $TotalStock = $pvp_Ref * $Existencias_Ref;

                if ($Estado_Solicitud_Prod == 1) {
                    $NomEstado = "Pendiente";
                } elseif ($Estado_Solicitud_Prod == 2) {
                    $NomEstado = "Producción";
                } elseif ($Estado_Solicitud_Prod == 3) {
                    $NomEstado = "Acabados";
                } elseif ($Estado_Solicitud_Prod == 5) {
                    $NomEstado = "En Destino";
                }
                $date = new DateTime($Fecha_Solicitud);
            }
        }

        ?>

														<tr>
															<td class="center">

														SLP<?php echo ($Cod_Solicitud_Prod); ?>

													</td>
													<td class="tdcustom center">
													<?php echo ($CreadaFecha); ?>
													</td>
                          <td>
                            <a class="image-link" href="<?php echo utf8_encode($Img_Referencia); ?>"><img src="<?php echo utf8_encode($Img_Referencia); ?>" width="40px" height="40px"></a>
                          </td>
														<td class="tdcustom">
															<?php echo utf8_encode($Referencia_Id_Referencia); ?>
														</td>
                            <td class="tdcustom">
                              <?php echo utf8_encode($Nom_Talla); ?>
                            </td>



										<td class="tdcustom center"><?php echo ($Existencias_Ref) ?></td>
										<td class="tdcustom center"><?php echo (formatomoneda($pvp_Ref)); ?></td>
										<td class="tdcustom center"><?php echo (formatomoneda($TotalStock)); ?></td>

										<td class="tdcustom center"><?php echo ($Nom_Bodega) ?></td>

										<td class="tdcustom center">

	<form action="Centro-Distribucion.php?Stock=1&&salidagenerica=1" method="post">

		<input type="hidden" name="fecha_salida" value="<?php echo ($DiaActual); ?>">
		<input type="hidden" name="Id_Solicitud_Prod" value="<?php echo ($Id_Solicitud_Prod); ?>">
		<input type="hidden" name="ref_id" value="<?php echo ($Referencia_Id_Referencia); ?>">
		<input type="hidden" name="talla_id" value="<?php echo ($Id_Talla); ?>">
		<input type="hidden" name="nom_talla" value="<?php echo ($Nom_Talla); ?>">
		<input type="hidden" name="creado_por" value="<?php echo ($IdUser); ?>">
		<input type="hidden" name="marca_temporal" value="<?php echo ($TiempoActual); ?>">
		<input type="hidden" name="taller_id" value="<?php echo ($MyIdTaller); ?>">


		<input class="input-small" type="number" min='1' max="<?php echo ($Existencias_Ref) ?>" value="" name="cantidad" placeholder="Cantidad" required>
			<input  type="text" placeholder="Pedido Nº" name="pedido_numero" class="input-small" value="" autocomplete="off" required>

								<button class="btn btn-sm btn-success">
									<i class="fa fa-check ">Registrar Salida</i>
								</button>

												</form>


											<a style="display: none;" data-rel="tooltip" data-placement="top" title="Eliminar Pedido"  href="Centro-Distribucion.php?Stock=1&DeleteRegistro=<?php echo ($Cod_Solicitud_Prod) ?>"><i class="fa fa-close red "></i> Eliminar Registro</a>




										</td>


													</tr>
													<?php

    }
    ?>
    <?php

    ?>
												</tbody>
											</table>
										</div>
						<!-- FIN TABLA -->
<?php
}
//************************* INICIO DESPACHOS CLIENTES ******************************************//
else {
    ?>

 <!-- Link Ventana Modal -->
<form action="OrdenDespacho-Crear.php" method="post" enctype="multipart/form-data" autocomplete="off">
<!-- <button class="btn btn-info pull-right">
	Crear Remisión
</button>


<div class="col-md-2 pull-right">
<input required="true" class="form-control date-picker" id="id-date-picker-1" type="text" data-date-format="yyyy-mm-dd" name="TxtFechaSolicitud" value=""  placeholder="Fecha Envio" />
</div>
<input type="text"  class="pull-right input-xlarge" name="Txtguia" required="true" placeholder="Número de Guía">
<input type="text"  class="pull-right input-xlarge" name="TxtTransportadora" required="true" placeholder="Indique la Transportadora">
<div class="col-md-3 pull-right">
  <label>Seleccione los productos que va a enviar:</label> -->



<?php

    $sql    = "SELECT Cons_Despacho FROM t_config WHERE Desarrollador='TEKSYSTEM S.A.S'";
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $Cons_Despacho = $row['Cons_Despacho'] + 1;
        }
    }
    ?>

<input type="text" name="TxtConsecutivo" value="<?php echo ($Cons_Despacho) ?>" style="display: none;"/>
										</div>

<!-- Link Ventana Modal -->


<!-- INICIO TABLA -->
						<div class="clearfix">
							<hr>
											<div class="pull-left tableTools-container"></div>

										</div>
										<div class="table-header" style="background-color: #000;">
											Lista Despachos a Cliente
										</div>

										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
											<table style="font-size: 12px;"   class="table table-responsive table-striped table-bordered table-hover" width="100%">
												<thead>

													<tr class="warning">
														<th>Sol</th>
														<th class="tdcustom">Cliente</th>
														<th class="tdcustom">Fecha Solicitud</th>
                            <th class="tdcustom" style="width: 5%;">Img</th>
														<th class="tdcustom" >Referencia</th>
                            <th class="tdcustom" style="width: 5%;">Talla</th>
														<th class="tdcustom" style="width: 5%;">Cantidad</th>
														<th class="tdcustom" style="width: 5%;">Total</th>
														<th class="tdcustom" >Centro Distribución</th>


													</tr>
													<!-- <tr>
														<th class="tdcustom">
															<label class="pos-rel">
															<input type="checkbox" class="ace" />
															<span class="lbl"></span>
														</label>
														</th>

														<th class="tdcustom">Cliente</th>
														<th class="tdcustom">Fecha Solicitud</th>
														<th class="tdcustom" style="width: 5%;">Img</th>
                            <th class="tdcustom" >Referencia</th>
                             <th class="tdcustom" style="width: 5%;">Talla</th>
														<th class="tdcustom" style="width: 5%;">Cantidad</th>
														<th class="tdcustom" >Centro Distribución</th>
														<th class="tdcustom">Enviar A</th>

														<th class="tdcustom">Estado</th>
													</tr> -->
												</thead>

		<tbody>
	<?php
$sql    = "SELECT Id_Temporal_Sol FROM t_temporal_sol WHERE Estado_Solicitud_Cliente='7' and Bodega_Id_Bodega='" . $MyIdTaller . "' ";
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $ListaOrdenes = $ListaOrdenes . $row['Id_Temporal_Sol'] . ",";
        }
    }
    $CadenaOrdenes = explode(",", $ListaOrdenes);
//Split al Arreglo
    $longitud = count($CadenaOrdenes);
    $min      = $longitud - 1;
//Recorro todos los elementos
    //for($i=0; $i<$min; $i++)
    //{
    ?>

<?php
for ($i = 0; $i < $min; $i++) {
        //***************************************************************************************************
        $sql = "SELECT date_format(Fecha_Solicitud,CONCAT(CONCAT(ELT(WEEKDAY(Fecha_Solicitud) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(Fecha_Solicitud), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS CreadaFecha,B.Nom_Cliente,B.Ape_Cliente, C.Nom_Bodega, D.Nom_Talla, E.Nom_Tienda, A.Referencia_Id_Referencia, A.Estado_Solicitud_Cliente,A.Cant_Solicitada, A.Fecha_Solicitud,A.Sastre_Id_Usuario, A.Pedido_Id_Pedido,F.Img_Referencia,Id_Temporal_Sol,Valor_Final FROM t_temporal_sol AS A, t_clientes as B,   t_bodegas as C, t_tallas as D, t_tiendas as E,t_referencias as F WHERE Id_Temporal_Sol='" . $CadenaOrdenes[$i] . "' AND  A.Bodega_Id_Bodega=C.Id_Bodega and A.Talla_Solicitada=D.Id_Talla and A.Tienda_Id_Tienda=E.Id_Tienda and A.Referencia_Id_Referencia=F.Cod_Referencia and A.Cliente_Id_Cliente=B.Id_Cliente ORDER BY UNIX_TIMESTAMP(Fecha_Solicitud) DESC";
        //Echo($sql);
        $result = $conexion->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $CreadaFecha              = $row['CreadaFecha'];
                $Pedido_Id_Pedido         = $row['Pedido_Id_Pedido'];
                $IdBodega                 = $row['Bodega_Id_Bodega'];
                $IdTienda                 = $row['Tienda_Id_Tienda'];
                $Fecha_Solicitud          = $row['Fecha_Solicitud'];
                $Nombres                  = $row['Nom_Cliente'];
                $Apellidos                = $row['Ape_Cliente'];
                $Img_Referencia           = $row['Img_Referencia'];
                $Id_Temporal_Sol          = $row['Id_Temporal_Sol'];
                $Nom_Bodega               = $row['Nom_Bodega'];
                $Cant_Solicitada          = $row['Cant_Solicitada'];
                $Nom_Talla                = $row['Nom_Talla'];
                $Valor_Final              = $row['Valor_Final'];
                $Referencia_Id_Referencia = $row['Referencia_Id_Referencia'];
                $Estado_Solicitud_Prod    = $row['Estado_Solicitud_Cliente'];
                $Sastre                   = $row['Sastre_Id_Usuario'];

                $TotalStock = $Valor_Final * $Cant_Solicitada;

                if ($Estado_Solicitud_Prod == 1) {
                    $NomEstado = "Pendiente";
                } elseif ($Estado_Solicitud_Prod == 2) {
                    $NomEstado = "Producción";
                } elseif ($Estado_Solicitud_Prod == 3) {
                    $NomEstado = "Acabados";
                } elseif ($Estado_Solicitud_Prod == 10) {
                    $NomEstado = "Enviado";
                }
                $date = new DateTime($Fecha_Solicitud);
            }
        }

        ?>

														<tr>
															<td class="center">
						<input type="text" name="TxtCant[]" value="<?php echo ($Cant_Solicitada); ?>" style="display: none;"/>
						<input type="text" name="TxtPedido" value="<?php echo ($Pedido_Id_Pedido); ?>" style="display: none;"/>



					<!-- 	<label class="pos-rel">
						<input type="checkbox"  class="ace" name="TxtCod[]" value="<?php echo ($Id_Temporal_Sol) ?>" />
						<span class="lbl"></span>
						</label>
					 -->


														PDC<?php echo ($Pedido_Id_Pedido); ?>

													</td>
													<td>
														<?php echo utf8_encode($Nombres . " " . $Apellidos); ?>
													</td>
													<td class="tdcustom center">
													<?php echo ($CreadaFecha); ?>
													</td>
                          <td>
                            <a class="image-link" href="<?php echo utf8_encode($Img_Referencia); ?>"><img src="<?php echo utf8_encode($Img_Referencia); ?>" width="40px" height="40px"></a>
                          </td>
														<td class="tdcustom">
															<?php echo utf8_encode($Referencia_Id_Referencia); ?>
														</td>
                            <td class="tdcustom">
                              <?php echo utf8_encode($Nom_Talla); ?>
                            </td>



														<td class="tdcustom center"><?php echo ($Cant_Solicitada) ?> Und.</td>
														<td class="tdcustom center"><?php echo (formatomoneda($TotalStock)); ?></td>
														<td class="tdcustom center"><?php echo ($Nom_Bodega) ?></td>

													</tr>
													<?php

    }
    ?>
    <?php

    ?>
												</tbody>
											</table>
										</div>
						<!-- FIN TABLA -->
	</form>
	<?php
}
?>
</div><!-- Fin Panel Inferior -->



							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->






		<?php
include "Lib/footer.php"
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

		<!-- <script src="https://modasof.com/espejo/assets/js/echarts.min.js"></script> -->

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

		<!-- 		<script src="dist/js/demo.js"></script> -->
		<script src="https://modasof.com/espejo/assets/js/jquery.magnific-popup.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.magnific-popup.min.js"></script>

		<script src="https://modasof.com/espejo/assets/js/dataTables.responsive.min.js"></script>
		 <script type="text/javascript">
        $(document).ready(function()
        {
             $("#FormNuevoProveedor").validate({
             	errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
                 rules: {
                     "TxtNombre": { required:true },
                     "TxtNit": { required:true },
                     "TxtContacto": { required:true },
                     "TxtCiudad": { required:true },
                     "TxtDir": { required:true },
                      // "TxtCelular": { required:true },
                      //  "TxtWhp": { required:true },
                      //   "TxtTel": { required:true },
                     "TxtCorreo": { required:true, email:true },
                     "TxtTipoInsumo": { required:true },

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
             $("#FormUpdateProveedor").validate({
             	errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
                 rules: {
                     "UpTxtNombre": { required:true },
                     "UpTxtNit": { required:true },
                     "UpTxtContacto": { required:true },
                     "UpTxtCiudad": { required:true },
                     "UpTxtDir": { required:true },
                     // "UpTxtCelular": { required:true },
                     // "UpTxtWhp": { required:true },
                     // "UpTxtTel": { required:true },
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

		<!-- inline scripts related to this page -->
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

    "lengthMenu": [[500, 700, 1000, -1], [500, 700, 1000, "All"]],

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



	</body>
</html>
