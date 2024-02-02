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
//
$OrdenSalida=$_GET['Salida'];

$Update=$_GET['Update'];
$TxtDetalle=$_POST['TxtDetalle'];

if ($Update!="") {
	$sql="UPDATE t_temporal_sol SET Observa_Cliente='".$TxtDetalle."' WHERE Id_Temporal_Sol='".$Update."'";
	$result=$conexion->query($sql);
	header("OrdenCliente.php?Mensaje=1");
}

$Delete=$_GET['Delete'];

if ($Delete!="") {
	$sql="DELETE FROM t_temporal_sol  WHERE Id_Temporal_Sol='".$Delete."'";
	$result=$conexion->query($sql);
	header("OrdenCliente.php");
}


$PagoTemporal=$_GET['PagoTemporal'];

if ($PagoTemporal!="") {
  $sql="DELETE FROM ingreso_temporal_usuario  WHERE Id_Ingreso_Tempora='".$PagoTemporal."'";
  $result=$conexion->query($sql);
  header("OrdenCliente-Salida.php?Salida=".$OrdenSalida."");
}


// Contador de LLamadas 
$sql ="SELECT *  FROM t_pedido as A, t_clientes as B WHERE Cod_Pedido='".$OrdenSalida."' and A.Cliente_Id_Cliente=B.Id_Cliente";  
$result = $conexion->query($sql);
//Echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Nom_ClienteSel=$row['Nom_Cliente'];
      $Ape_ClienteSel=$row['Ape_Cliente'];
       $Id_ClienteSel=$row['Id_Cliente'];
        $Cel1_ClienteSel=$row['Cel1_Cliente'];
        $Cel2_ClienteSel=$row['Cel2_Cliente'];
        $Correo_ClienteSel=$row['Correo_Cliente'];
 }
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Orden de Cliente</title>

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
		<link href="https://modasof.com/espejo/assets/Ecommerce/css/pages/ecommerce.css" rel="stylesheet">

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




<style>  
    
   #caja_busqueda /*estilos para la caja principal de busqueda*/
{
width:400px;
height:25px;
border:solid 2px #979DAE;
font-size:16px;
}
#display /*estilos para la caja principal en donde se puestran los resultados de la busqueda en forma de lista*/
{
width:300px;
display:none;
overflow:hidden;
z-index:10;
border: solid 1px #666;
}
.display_box /*estilos para cada caja unitaria de cada usuario que se muestra*/
{
padding:2px;
padding-left:6px; 
font-size:18px;
height:63px;
text-decoration:none;
color:#3b5999; 
}

.display_box:hover /*estilos para cada caja unitaria de cada usuario que se muestra. cuando el mause se pocisiona sobre el area*/
{
background: #415AB5;
color: #FFF;
}
.desc
{
color:#666;
font-size:16;
}
.desc:hover
{
color:#FFF;
}
           </style>

    <?php include("Lib/Favicon.php") ?>
  

	</head>

	<body class="skin-1">

	<?php 
  $Valide=$_GET['Mensaje'];

    if ($Valide==21) {
        echo "<script>jQuery(function(){swal(\"¡Lo Sentimos!\", \"Datos Incorrectos\", \"error\");});</script>";
    };
    if ($Valide==22) {
        echo "<script>jQuery(function(){swal(\"¡Lo Sentimos!\", \"No ha incluido ningún valor\", \"error\");});</script>";
    };
    if ($Valide==1) {
        echo "<script>jQuery(function(){swal(\"¡ Observación Actualizada!\", \"Correctamente \", \"success\");});</script>";
    };
     if ($Valide==333) {
        echo "<script>jQuery(function(){swal(\"¡ Orden de Cliente creada!\", \"Correctamente \", \"success\");});</script>";
    };
     if ($Valide==2) {
        echo "<script>jQuery(function(){swal(\"¡ Insumo  Eliminado!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==23) {
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
							<!-- <li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="index.php">Inicio</a>
							</li> -->
							<li>
								<i class="ace-icon fa fa-times"></i>
								<a href="Pedidos.php">Regresar</a>
							</li>
							<li>
								<i class="ace-icon fa fa-users"></i>
								<a href="OrdenCliente.php">Salida Contable Orden Cliente</a>
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

 <div class="row">
                    <!-- Column -->
                    <div class="col-md-8 col-lg-8">
                        <div class="card">
<?php
// Consecutivo Factura
$sql ="SELECT Consecutivo_Factura FROM t_config_tienda WHERE Tienda_Id_Tienda='".$MyIdTienda."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Consecutivo_Factura=$row['Consecutivo_Factura']+1;
    }
  }

 $sql ="SELECT consecutivo_sc FROM t_config_tienda WHERE Tienda_Id_Tienda='".$MyIdTienda."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $consecutivo_sc=$row['consecutivo_sc']+1;
    }
  }
  ?>
                 
                                <h3 class="m-b-0 text-white">Salida Contable Nº <?php Echo($consecutivo_sc) ?> <br><small><strong>Vendedor: <?php Echo utf8_encode($NomSesion) ?></strong></small> </h3>

                          
                 
                                <h3 class="m-b-0 text-white">Orden de Corte Nº PDC<?php Echo($OrdenSalida) ?></h3>
                            
                            <div class="card-body">
                                <div class="table-responsive">
                          <?php
// Contador de LLamadas 
$sql ="SELECT Sum(Cant_Solicitada*Valor_Final) as SumaPedido FROM t_temporal_sol WHERE Pedido_id_pedido='".$OrdenSalida."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $SumaPedido=$row['SumaPedido'];
 }
}
                                     ?>
                                    <table class="table product-overview">
                                        <thead>
                                            <tr>
                                                <th style="width: 10%;">Ref.</th>
                                                <th style="width: 50%;">Observaciones</th>
                                                <th style="text-align:center;width: 10%;">Valor</th>
                                                <th style="width: 5%;">Cantidad</th>
                                                
                                                <th style="text-align:center;width: 10%;">Total</th>
                                                <!-- <th style="text-align:center">Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>

                                    <?php 
$sql="SELECT C.Nom_Talla,B.Img_Referencia,Id_Temporal_Sol, Bodega_Id_Bodega, Cant_Solicitada, Talla_Solicitada, Tienda_Id_Tienda, Referencia_Id_Referencia, Fecha_Solicitud, Solicitud_Id_Usuari, Valor_Prenda,Valor_Final,Valor_Adicional, Observa_Cliente FROM t_temporal_sol as A, t_referencias as B, t_tallas as C  WHERE A.Referencia_Id_Referencia=B.Cod_Referencia and A.Talla_Solicitada=C.Id_Talla and Pedido_id_pedido='".$OrdenSalida."' and Solicitud_Facturada='0' order by Id_Temporal_Sol Desc";
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$Id_Temporal_Sol=$row['Id_Temporal_Sol'];
$Nom_Talla=$row['Nom_Talla'];
$Img_Referencia=$row['Img_Referencia'];
$Bodega_Id_Bodega=$row['Bodega_Id_Bodega'];
$Cant_Solicitada=$row['Cant_Solicitada'];
$Talla_Solicitada=$row['Talla_Solicitada'];
$Tienda_Id_Tienda=$row['Tienda_Id_Tienda'];
$Referencia_Id_Referencia=$row['Referencia_Id_Referencia'];
$Fecha_Solicitud=$row['Fecha_Solicitud'];
$Solicitud_Id_Usuari=$row['Solicitud_Id_Usuari'];
$Valor_Prenda=$row['Valor_Prenda'];
$Valor_Adicional=$row['Valor_Adicional'];
$Valor_Final1=$row['Valor_Final'];
$Valor_Final=$Valor_Prenda+$Valor_Adicional;

$Observa_Cliente=$row['Observa_Cliente'];

$TotalPedido=$Cant_Solicitada*$Valor_Final;
$CalculoDescuento=1-($Valor_Final/$Valor_Prenda);
$VrDescuento=$CalculoDescuento*100;
$disponibilidad=DisponibilidadInventario($Tienda_Id_Tienda,$Referencia_Id_Referencia,$Talla_Solicitada);
if ($disponibilidad==0) {
    $contadorInv=0;
   $labelinventario="<span class='badge bg-red'>No disponible en Inventario</span>"; 
}
else
{
  $contadorInv=1;
  $labelinventario="<span class='badge bg-green'>Disponible en Inventario</span>";
}

                                     ?>
                                            <tr>
                                                <td>
                                                	<img src="<?php Echo($Img_Referencia) ?>" alt="iMac" width="90">

                                                </td>
                                                <td>
                                                    <form action="OrdenCliente.php?Update=<?php Echo($Id_Temporal_Sol); ?>&Mensaje=1" method="post">
                                                    <h5><?php Echo($Referencia_Id_Referencia."-".$Nom_Talla."   ")  ?> <?php echo($labelinventario); ?></h5> 

                                                     <textarea disabled="true" class="autosize-transition form-control" name="TxtDetalle" id="form-field-9" rows="3" maxlength="2000"><?php Echo($Observa_Cliente) ?></textarea>
                                                    </form>
                                                </td>
                                                <td style="padding-top: 70px;">
                                                	<strong><?php Echo(formatomoneda($Valor_Final)) ?></strong>
                                                		
                                                	</td>
                                                <td class="center" style="padding-top: 70px;">
                                                    <strong><?php Echo($Cant_Solicitada); ?> Und.</strong>
                                                </td>
                                              
                                                <td style="padding-top: 70px;" class="font-500" align="center"><strong><?php Echo(formatomoneda($TotalPedido)) ?></strong></td>
                                               <!--  <td style="padding-top: 70px;" align="center">
                                                	<a href="OrdenCliente.php?Delete=<?php Echo($Id_Temporal_Sol); ?>" data-rel="tooltip" data-placement="top" title="Eliminar Referencia" href="javascript:void(0)" class="text-inverse" title="" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-times bigger-150 red"></i></a>
                                                </td> -->
                                            </tr>
                                       <?php 
                                   }
                               }
                               else
                               {
                               	?>
                               	<tr>
                               		<td colspan="6">
                               			<h2><i class="fa fa-info-circle"> Seleccione un producto de la lista de las Referencias <i class="fa fa-cut"></i> <a class="red" href="Lista-Referencias.php"><small class="red">Aquí</small></a></i></h2>
                               		</td>
                               	</tr>
                               	<?php
                               }

                                        ?>
                                           
                                        </tbody>
                                    </table>
                                    <hr>
                                   
                                    
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-4 col-lg-4">
                        <?php 
// CONFIGURACIÓN DE LA TIENDA. 
$sql="SELECT * From t_config_tienda where Tienda_Id_Tienda='".$MyIdTienda."'";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $aplicaiva=utf8_encode($row['aplica_iva']);
    }
}

// Validamos si la tienda aplica el Iva o no

if ($aplicaiva=="Si") {
  
    // Consulta Valor de la prenda
$sql ="SELECT SUM(Valor_Final*Cant_Solicitada) as TotalPedido FROM t_temporal_sol WHERE  Pedido_id_pedido='".$OrdenSalida."' and Solicitud_Facturada='0'"; 
//Echo($sql); 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
     
      $TotalPedido=$row['TotalPedido'];
      $TotalSinIva=round($TotalPedido/1.19,0);
      $TotalIva=round($TotalPedido-$TotalSinIva,0);
      $ValorfinalFormulario=round($TotalSinIva+$TotalIva,0);
 }
}
  // Fin de la consulta

}
else
{

  // Consulta Valor de la prenda
$sql ="SELECT SUM(Valor_Final*Cant_Solicitada) as TotalPedido FROM t_temporal_sol WHERE  Pedido_id_pedido='".$OrdenSalida."' and Solicitud_Facturada='0'"; 
//Echo($sql); 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
     
      $TotalPedido=$row['TotalPedido'];
      $TotalSinIva=round($TotalPedido/1.19,0);
      $TotalIva=0;
      $ValorfinalFormulario=round($TotalSinIva+$TotalIva,0);
 }
}
  // Fin de la consulta


}


$sql ="SELECT SUM(Cant_Solicitada) as SumaPrendas FROM t_temporal_sol WHERE Pedido_id_pedido='".$OrdenSalida."' and Solicitud_Facturada='0'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $SumaPrendas=$row['SumaPrendas'];
 }
}
      


                                ?>
                                <table class="table product-overview">
                                  
                                  <tr>
                                  <th class="warning">En la cesta de articulos </th>
                                  <th class="pull-rigth warning" style="padding: 10px;" ><i class="fa fa-shopping-cart"> </i> <?php Echo($SumaPrendas); ?> Prendas</th>
                                  </tr>
                                  <tr>
                                    <td>Sub-Total:</td>
                                    <td style="text-align: right;"><?php Echo(formatomoneda($TotalSinIva)); ?></td>
                                  </tr>
                                   <tr>
                                    <td>19% IVA:<br><small class="red">Dato Informativo</small></td>
                                    <td style="text-align: right;"><?php Echo(formatomoneda($TotalIva)); ?></td>
                                  </tr>
                                  <tr class="success">
                                     <td><strong>Total a Pagar:</strong></td>
                                    <td style="text-align: right;"><strong><?php Echo(formatomoneda($ValorfinalFormulario)); ?></strong></td>
                                  </tr>
                                </table>

                     <form action="GuardarIngresoAbono.php?AbonoSalida=2&Salida=<?php Echo($OrdenSalida); ?>" method="post" id="FormPago" autocomplete="off" >
                                <table class="table product-overview">
                                  <tr>
                                   
                                   
                                  <td>
                                     <input class=" nav-search-input input-sm" type="text"  id="demo1" placeholder="$ 0" name="demo1"  />
                         
                               
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
    $sql ="SELECT Id_Medio_Pago, Nom_MedioPago FROM t_medios_pago Where Estado_MedioPago='1' and Id_Medio_Pago<>'5' order by Id_Medio_Pago ASC";  
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
    if((valorCambiado == '2')||(valorCambiado == '3')||(valorCambiado == '4') ||(valorCambiado == '6')||(valorCambiado == '7') ){
     
       $('#Confirmacion').css('display','');
     }
     else if(valorCambiado == '5')
     {
          $('#Confirmacionnota').css('display','');
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
                                   <tr>
                                    
                                   <td colspan="2">
                                      <select  class="chosen-select input-large" name="valornotasel"  data-placeholder="Seleccionar...">
                            <option value="">Buscar Nota Crédito </option>
                  <?php
// Listado de Devoluciones de Cliente

date_default_timezone_set("America/Bogota");
$MarcaTemporal = date('Y-m-d');

$MarcaTemporal = date('Y-m-d');
$AnoActual=date("Y")-1;
$DiaActual=date("d");
$MesActual=date("m");
$Unanoatras=($AnoActual."-".$MesActual."-".$DiaActual);

$FechaInicioDia=($Unanoatras." 00:00:000");

$FechaFinalDia=($MarcaTemporal." 23:59:000");


$sql ="SELECT Distinct(notacredito_num) FROM t_devoluciones WHERE Fecha_Devolucion >='".$FechaInicioDia."' and Fecha_Devolucion <='".$FechaFinalDia."' and Cliente_Id_Cliente='".$Id_ClienteSel."'  ORDER BY Id DESC";
    //Echo($sql);
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    $Lista=$Lista.$row['notacredito_num'].",";                  
 }
}

$Cadena=explode(",", $Lista);
//Split al Arreglo
$longitud = count($Cadena);
$min=$longitud-1;
for($i=0; $i<$min; $i++)
{
    $sql ="SELECT SUM(Total_Devolucion) as TotalDevoluciones,Cliente_Id_Cliente,notacredito_num FROM t_devoluciones WHERE notacredito_num='".$Cadena[$i]."'";
    //Echo($sql);
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    $TotalDevoluciones=$row['TotalDevoluciones']; 
    $Cliente_Id_Cliente=$row['Cliente_Id_Cliente'];       
    $notacredito_num=$row['notacredito_num'];                  
 }
}


$sql ="SELECT Nom_Cliente,Ape_Cliente,Documento_Cliente FROM t_clientes WHERE Id_cliente='".$Cliente_Id_Cliente."'";
    //Echo($sql);
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    $Nom_Cliente=$row['Nom_Cliente']; 
     $Documento_Cliente=$row['Documento_Cliente']; 
    $Ape_Cliente=$row['Ape_Cliente'];                  
 }
}

$sql ="SELECT SUM(Valor_Ingreso) as TotalRedimido FROM t_ingresos WHERE Cliente_Id_Cliente='".$Cliente_Id_Cliente."' and Medio_Pago='5'and Num_Transaccion='".$notacredito_num."'";
    //Echo($sql);
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    $TotalRedimido=$row['TotalRedimido'];                  
 }
}


$SaldoNotas=$TotalDevoluciones-$TotalRedimido;
    
    if ($notacredito_num<>0 and $SaldoNotas<>0) {
        echo ("<option value='".$notacredito_num."'>".utf8_encode($Documento_Cliente." - ".$Nom_Cliente." ".$Ape_Cliente."- $".number_format($SaldoNotas))." - NC:".$notacredito_num."</option>");

    }

}

 
?>      
                                  
                        </select>  

                        <small style="color: blue;">Solo aplica para pagos con Nota Crédito</small>
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
                                  $sql ="SELECT Id_Ingreso_Tempora, Tipo_Pago_Temporal, Valor_Pago_Temporal, Voucher, Usuario_Ingreso,Nom_MedioPago FROM ingreso_temporal_usuario as A, t_medios_pago as b WHERE Usuario_Ingreso='".$IdUser."' and Pago_De='Orden' and A.Tipo_Pago_Temporal=b.Id_Medio_Pago";
                                  //echo($sql);
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
                                    <td><a class="red" href="OrdenCliente-Salida.php?PagoTemporal=<?php Echo($Id_Ingreso_Tempora) ?>&Salida=<?php Echo($OrdenSalida); ?>">Eliminar</a></td>
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
                                   ?>
                      <?php 

                       $sql ="SELECT Id_Ingreso, Medio_Pago, Valor_Ingreso, Num_Transaccion, Ingreso_id_Usuario,Cod_Recibo_Caja FROM t_ingresos WHERE Pedido_id_pedido='".$OrdenSalida."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Id_Ingreso=$row['Id_Ingreso'];
       $Medio_Pago=$row['Medio_Pago'];
        $Valor_Ingreso=$row['Valor_Ingreso'];
         $Num_Transaccion=$row['Num_Transaccion'];
         $Cod_Recibo_Caja=$row['Cod_Recibo_Caja'];

       if ($Medio_Pago==1) {
        $PagoRealizado="Efectivo";
      }
      elseif ($Medio_Pago==2) {
        $PagoRealizado="Tarjeta C.";
      }
      elseif ($Medio_Pago==3) {
        $PagoRealizado="Transacción";
      }
      elseif ($Medio_Pago==4) {
        $PagoRealizado="Efecty/Baloto";
      }
      ?>
       <tr >
                                    <td>R.Caja Nº<?php Echo($Cod_Recibo_Caja) ?></td>
                                    <td>
                                      <?php Echo($PagoRealizado); ?>
                                        <?php 
                                        if ($Num_Transaccion!="") {
                                          Echo("(".$Num_Transaccion.")");
                                        }
                                         ?>
                                      </td>
                                     <td style="text-align: right;">
                                       <?php Echo(formatomoneda($Valor_Ingreso)) ;?>
                                     </td>
                                  </tr>
      <?php
    }
  }
                       ?>
                                  
                                    <?php 
// Consulta de pagos agregados.
$sql ="SELECT SUM(Valor_Pago_Temporal) as SumaPagos FROM ingreso_temporal_usuario WHERE Usuario_Ingreso='".$IdUser."' and Pago_De='Orden'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $SumaPagos=$row['SumaPagos'];
 }
}
// Consulta de Anticipos Anteriores.
$sql ="SELECT SUM(Valor_Ingreso) as SumaAnticipos FROM t_ingresos WHERE Pedido_id_pedido='".$OrdenSalida."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $SumaAnticipos=$row['SumaAnticipos'];
 }
}

$PendientePago=$ValorfinalFormulario-$SumaPagos-$SumaAnticipos;
                 ?>

                                   <tr class="pull-rigth success">
                                    <td style="text-align: right;" colspan="2"><strong>Total Pago:</strong></td>
                                    <td style="text-align: right;"><strong><?php Echo(formatomoneda($SumaPagos)); ?></strong></td>
                                  </tr>
                                  <tr class="pull-rigth danger">
                                    <td style="text-align: right;" colspan="2"><strong>Saldo Pendiente:</strong></td>
              
                                    <td style="text-align: right;"><strong><?php Echo(formatomoneda($PendientePago)); ?></strong></td>
                                  </tr>
                                
                                </table>

<form method="post" action="Pedido-Entregar.php" id="FormGuardarventa" autocomplete="off">

   <?php
$sql ="SELECT Consecutivo_ReciboCaja FROM t_config_tienda WHERE Tienda_Id_Tienda='".$MyIdTienda."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Consecutivo_ReciboCaja=$row['Consecutivo_ReciboCaja']+1;
    }
  }
                                     ?>

<input style="display: none;" type="text" name="TxtConsecutivo" value="<?php Echo($Consecutivo_Factura);?>">
<input style="display: none;" type="text" name="TxtScNum" value="<?php Echo($consecutivo_sc);?>">
<input style="display: none;" type="text" name="TxtConsecutivoCaja" value="<?php Echo($Consecutivo_ReciboCaja);?>">
<input style="display: none;" type="text" name="TxtTotalsinIva" value="<?php Echo($TotalSinIva);?>">
<input style="display: none;" type="text" name="TxtTotalIva" value="<?php Echo($TotalIva);?>">
<input style="display: none;" type="text" name="TxtSumaPedido" value="<?php Echo($ValorfinalFormulario);?>">
<input style="display: none;" type="text" name="SumaAbono" value="<?php Echo($SumaPagos);?>">
<input style="display: none;" type="text" name="SumaAnticipos" value="<?php Echo($SumaAnticipos);?>">
<input style="display: none;" type="text" name="TxtTienda" value="<?php Echo ($MyIdTienda);?>">
<input style="display: none;" type="text" name="TxtClienteSel" value="<?php Echo ($Id_ClienteSel);?>">
<input style="display: none;" type="text" name="TxtConsecutivoPedido" value="<?php Echo ($OrdenSalida);?>">
<?php

 $sql ="SELECT Id_Temporal_Sol,Referencia_Id_Referencia,Talla_Solicitada, Cant_Solicitada,Nom_Talla,Valor_Prenda,Valor_Final FROM t_temporal_sol as A, t_tallas as B WHERE Pedido_id_pedido='".$OrdenSalida."' and A.Talla_Solicitada=B.Id_Talla"; 
 //Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Id_Venta=$row['Id_Temporal_Sol'];
      $Ref_Venta=$row['Referencia_Id_Referencia'];
      $Talla_Venta=$row['Talla_Solicitada'];
      $RefCompleta_Venta=$row['Referencia_Id_Referencia']."-".$row['Nom_Talla'];
      $Cantidad_Venta=$row['Cant_Solicitada'];
      $Valor_Venta=$row['Valor_Prenda'];
      $Valor_Final=$row['Valor_Final'];
      ?>
      <input style="display: none;"  type="text" name="TxtCadIdVenta[]" value="<?php Echo($Id_Venta);?>">
      <input style="display: none;"  type="text" name="TxtRefVenta[]" value="<?php Echo($Ref_Venta);?>">
      <input style="display: none;"  type="text" name="TxtTallaVenta[]" value="<?php Echo($Talla_Venta);?>">
      <input style="display: none;"  type="text" name="TxtRefCompletaVenta[]" value="<?php Echo($RefCompleta_Venta);?>">
      <input style="display: none;"  type="text" name="TxtCantVenta[]" value="<?php Echo($Cantidad_Venta);?>">
      <input style="display: none;"  type="text" name="TxtValorVenta[]" value="<?php Echo($Valor_Venta);?>">
      <input style="display: none;"  type="text" name="TxtValorFinal[]" value="<?php Echo($Valor_Final);?>">
      <?php
    }
  }

 // Detalle pagos del abono o totalidad
$sql ="SELECT Id_Ingreso_Tempora,Valor_Pago_Temporal,Tipo_Pago_Temporal,Voucher FROM ingreso_temporal_usuario WHERE Usuario_Ingreso='".$IdUser."' and Pago_De='Orden'";  
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
      <input style="display: none;" type="text" name="TxtTiporPago[]" value="<?php Echo($TipoPago);?>">
      <input style="display: none;" type="text" name="TxtVoucherPago[]" value="<?php Echo($Voucher);?>">
      <?php
    }
  }
// Detalle del Pedido
  
?>
<label>Seleccionar si la Venta es a: </label>
      <select required="true" class="chosen-select input-xxlarge" name="TxtTipoVenta" id="TxtTipoVenta"  data-placeholder="Seleccionar...">
          <option value="">Seleccionar</option>
          <?php 
          if ($PendientePago==0) {
           ?>
            <option value="1">De Contado</option>
           <?php
          }
          else
          {
            ?>
             <option value="2">A Crédito</option>
            <?php
          }

           ?>
         
          
      </select>

                                  
                                <table  class="table product-overview">
                                 <tr>
    
                                    <td><strong><i class="fa fa-user"> </i> Cliente: </strong></td>
                                    <td colspan="2"><?php Echo utf8_encode($Nom_ClienteSel." ".$Ape_ClienteSel) ?></td>
                                  </tr>
                                   <tr>
                                    <td><strong><i class="fa fa-mobile-phone"> </i> Celular: </strong></td>
                                    <td colspan="2"><?php Echo utf8_encode($Cel1_ClienteSel." // ".$Cel2_ClienteSel) ?></td>
                                  </tr>
                                  <tr>
                                    <td><strong><i class="fa fa-envelope"> </i> E-mail: </strong></td>
                                    <td colspan="2"><?php Echo utf8_encode($Correo_ClienteSel) ?></td>
                            </tr>
                                </table>
                                <?php 
                                if ($contadorInv==0) {
                                  ?>
                                  <h2>Prenda sin disponibilidad, por favor contactar al administrador. </h2>
                                  <?php
                                }
                                else
                                {
                                  ?>

                                   <button type="submit" class="btn btn-danger btn-outline"><i class="fa fa-print"> </i> Salida Contable Pedido</button>


                                  <?php
                                }


                                 ?>

                                
                             
     
                                 
                                 </form>
                               
                    </div>
                </div>

</div><!-- Fin Panel Inferior -->



							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->



<!-- Inicio Modal -->
    <div id="modal-form2" class="modal" tabindex="-1">
               <!-- Inicio Modal -->
    <div>
              <form action="Cliente-Crear.php?ForVenta=1" method="post" id="FormNuevoCliente">
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
                        <input type="text" name="TxtDocumento" id="TxtDocumento" class="input-large" placeholder="Documento" style="text-transform:uppercase;">
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

                            
                            <div class="form-group">
                             
                              <label for="form-field-select-3">Ciudad</label>
                             
                              <div>
                        <select class="" name="TxtCiudad" data-placeholder="Seleccionar...">
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
                              <label for="form-field-select-3">What's App</label>

                              <div class="input-group">
                                <span class="input-group-addon">
                                  <i class="ace-icon fa fa-whatsapp"></i>
                                </span>

                <input name="TxtWhp" class="form-control input-mask-phone" type="text" id="form-field-mask-2" />
                              </div>
                            
                        </div>
                      <div class="form-group">
                              <label for="form-field-select-3">Teléfono</label>

                              <div class="input-group">
                                <span class="input-group-addon">
                                  <i class="ace-icon fa fa-phone"></i>
                                </span>

                <input name="TxtTel" class="form-control input-mask-phone" type="text" id="form-field-mask-2" />
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
        $(document).ready(function()
        {
             $("#FormNuevoPedido").validate({
             	errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
                 rules: {
                     "ConfirmarCliente": { required:true },
                     "TxtCorreoUp": { required:true }, 
                     "TxtCelularUp": { required:true }, 
                 },
                
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
                     "UpTxtCelular": { required:true }, 
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
        // based on prepared DOM, initialize echarts instanc

        var myChart = echarts.init(document.getElementById('grafica'));
        
        // specify chart configuration item and data
   option = {

   	
    title : {

        text: 'Pedidos Proveedores',
        subtext: 'Marzo',
        x:'center',
        fontFamily: "The time new Román",
    },

    tooltip : {
        trigger: 'item',
        // formatter: "{a} <br/>{b} : {c} ({d}%)",
        formatter: function (params) {
                    var value = (params.value + '').split('.');
                    value = value[0].replace(/(\d{1,3})(?=(?:\d{3})+(?!\d))/g, '$1,');
                    return params.seriesName + '<br/>' + params.name + ' :$ ' + value;
                }
    },

    legend: {
        orient: 'horizontal',
        //left: 'center',
        bottom: 10,
        left: 'center',
        data: ['Pago a Crédito','Pago Inmediato'],
        
    },

            calculable: true,
    series : [

        {
            name: 'Pedidos con',
            type: 'pie',
            radius : '65%',
            center: ['55%', '50%'],
            label: {
                normal: {
                    show: true,
                    position: 'inside',
                    formatter: "({d}%)",
                }
            },
            data:[
                {value:3351231, name:'Pago a Crédito'},
                {value:3101212, name:'Pago Inmediato'},
               
            ],
            itemStyle: {
                emphasis: {
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            }
        }

    ]
};

        // use configuration item and data specified to show chart
        myChart.setOption(option);

       
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
