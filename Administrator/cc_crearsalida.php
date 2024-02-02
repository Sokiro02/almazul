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

$Update=$_GET['Update'];
$TxtDetalle=$_POST['TxtDetalle'];

if ($Update!="") {
	$sql="UPDATE t_temporal_sol SET Observa_Cliente='".$TxtDetalle."' WHERE Id_Temporal_Sol='".$Update."'";
	$result=$conexion->query($sql);
	header("OrdenCliente.php?Mensaje=1");
}

$Delete=$_GET['Delete'];

if ($Delete!="") {
	$sql="DELETE FROM t_salidas_cc  WHERE Id_Venta='".$Delete."'";
	$result=$conexion->query($sql);
	header("cc_crearsalida.php?Mensaje=1");
}


$PagoTemporal=$_GET['PagoTemporal'];

if ($PagoTemporal!="") {
  $sql="DELETE FROM ingreso_temporal_usuario  WHERE Id_Ingreso_Tempora='".$PagoTemporal."'";
  $result=$conexion->query($sql);
  header("cc_crearsalida.php");
}



$CancelVenta=$_GET['CancelVenta'];

if ($CancelVenta=="true") {
	$sql="DELETE FROM t_salidas_cc  WHERE Vendedor_Id_Usuario='".$IdUser."'";
	$result=$conexion->query($sql);
	
  // Eliminar los ingresos temporales
  $sql="DELETE FROM ingreso_temporal_usuario  WHERE Usuario_Ingreso='".$IdUser."'";
  $result=$conexion->query($sql);
  header("cc_crearsalida.php");
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Servicio</title>

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

<script type="text/javascript">
$(document).ready(function(){
$("#TxtDocumento").keyup(function(){ //se crea la funcioin keyup
var texto = $(this).val();//se recupera el valor de la caja de texto y se guarda en la variable texto
var dataString = 'ValNuevoCliente='+ texto;//se guarda en una variable nueva para posteriormente pasarla a busqueda.php

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

<!-- <script type="text/javascript">
  $(document).ready(function(){
    $("#LeerRef").keypress(function(e) {
        //no recuerdo la fuente pero lo recomiendan para
        //mayor compatibilidad entre navegadores.
        var code = (e.keyCode ? e.keyCode : e.which);
        if(code==13){
            obtenerDatos();
            return false;
        }
    });
});
</script>
<script type="text/javascript">
  function obtenerDatos() { var valor = $("#LeerRef").val();
    $.ajax({
      type: 'POST', 
      url:  'PruebaEnter.php',
      data: "valor=" + valor,
      success: function(response){
            $("#wrap").html(response);
      }
    });
}
</script> -->
<style>  
    
   .caja_busqueda /*estilos para la caja principal de busqueda*/
{
width:400px;
height:25px;
border:solid 2px #979DAE;
font-size:16px;
text-transform:uppercase; 
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
  $GetFactura=$_GET['Factura'];
  $get_prenda = $_GET['get_prenda'];


    if ($Valide==21) {
        echo "<script>jQuery(function(){swal(\"¡Referencia No Encontrada!\", \"Datos Incorrectos\", \"error\");});</script>";
    };

    if ($Valide==222) {
        echo "<script>jQuery(function(){swal(\"¡Referencia sin inventario en tienda!\", \"Verificar Inventario\", \"error\");});</script>";
    };

     if ($Valide==223) {
        echo "<script>jQuery(function(){swal(\"¡Referencia ".$get_prenda." sin inventario en tienda!\", \"Verificar Inventario\", \"error\");});</script>";
    };
     if ($Valide==224) {
        echo "<script>jQuery(function(){swal(\"¡Referencia ".$get_prenda." sin inventario en tienda!\", \"Verificar Inventario\", \"error\");});</script>";
    };

     if ($Valide==555) {
        echo "<script>jQuery(function(){swal(\"Cliente ya Existe!\", \"Buscar en la lista\", \"error\");});</script>";
    };

     if ($Valide==551) {
        echo "<script>jQuery(function(){swal(\"¡Error en el consecutivo !\", \" De la Factura\", \"error\");});</script>";
    };

     if ($Valide==552) {
        echo "<script>jQuery(function(){swal(\"¡Faltó diligenciar !\", \"Algún campo\", \"error\");});</script>";
    };

     if ($Valide==553) {
        echo "<script>jQuery(function(){swal(\"¡Selecciono contado y el valor registrado!\", \"No coincide\", \"error\");});</script>";
    };

     if ($Valide==22) {
        echo "<script>jQuery(function(){swal(\"¡Referencia ya Agregada!\", \"Verificar Tabla\", \"error\");});</script>";
    };
    if ($Valide==23) {
        echo "<script>jQuery(function(){swal(\"¡El precio supera el valor permitido!\", \"Verificar Dato\", \"error\");});</script>";
    };
     if ($Valide==24) {
        echo "<script>jQuery(function(){swal(\"¡Ref. no existente en su inventario!\", \"Verificar Dato\", \"error\");});</script>";
    };
    if ($Valide==1) {
        echo "<script>jQuery(function(){swal(\"¡ Item Eliminado!\", \"Correctamente \", \"success\");});</script>";
    };
     if ($Valide==2) {
        echo "<script>jQuery(function(){swal(\"¡ Item  Actualizado!\", \"Correctamente \", \"success\");});</script>";
    };
     if ($Valide==4) {
        echo "<script>jQuery(function(){swal(\"¡ Cliente Creado!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==333) {
        echo "<script>jQuery(function(){swal(\"¡ Remisión Creada Correctamente!\", \"FACT. Nº".$GetFactura." \", \"success\");});</script>";
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
$sql ="SELECT Count(Id_Temporal_Sol) as TotalRef FROM t_temporal_sol WHERE Solicitud_Id_Usuari='".$IdUser."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $TotalRef=$row['TotalRef'];
 }
}

$sql ="SELECT Sum(Cant_Solicitada) as TotalPrendas FROM t_temporal_sol WHERE Solicitud_Id_Usuari='".$IdUser."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $TotalPrendas=$row['TotalPrendas'];
 }
}

 $sql ="SELECT Cons_cc FROM t_config WHERE Desarrollador='TEKSYSTEM S.A.S'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Cons_cc=$row['Cons_cc']+1;
    }
  }
                                     ?>
                 
                                <h3 class="m-b-0 text-white">Cuenta Cobro Nº <?php Echo($Cons_cc) ?> <br>

                                    <a  data-toggle="modal" data-target="#modal-form3" href="#"><span class="btn  btn-success btn-xs"><i class="fa fa-search"> </i> Ver Tallas</span></a>
                                    <small><strong>Vendedor: <?php Echo utf8_encode($NomSesion) ?></strong></small> </h3>

              <form action="cc_PruebaEnterSalida.php" method="post" autocomplete="off">
                              <div class="form-group">
              <input required="true" type="text" class="caja_busqueda input-xlarge" name="valor" placeholder="Escanear Referencia" autofocus="true" id="LeerRef">

                              <hr>
                             
                            </div>
              </form>
                            <div class="card-body">
                                <div class="table-responsive">
                    
                                    <table class="table product-overview">
                                        <thead>
                                            <tr>
                                                <th style="width: 10%;">Img.</th>
                                                <th style="width: 50%;">Referencia</th>
                                                <th style="width: 50%;">Talla</th>
                                                <th style="text-align:center;width: 10%;">Valor Un.</th>
                                                <th style="width: 5%;">Cantidad</th>
                                               
                                                <th style="text-align:center;width: 10%;">Total</th>
                                                <th style="text-align:center;width: 15%;">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                    <?php 

// La consulta se realiza por la venta de cada usuario en estado inicial que es 1
$sql="SELECT C.Nom_Talla,Id_Venta, Cant_Solicitada, Talla_Solicitada, Tienda_Id_Tienda, A.Referencia_Id_Referencia, Fecha_Solicitud, Vendedor_Id_Usuario, Valor_Prenda,Valor_Final,B.Img_Referencia FROM t_salidas_cc as A, t_referencias as B, t_tallas as C  WHERE A.Referencia_Id_Referencia=B.Cod_Referencia and A.Talla_Solicitada=C.Id_Talla and Vendedor_Id_Usuario='".$IdUser."' and Estado_Venta='1' order by Referencia_Id_Referencia Desc";
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$Id_Venta=$row['Id_Venta'];
$Nom_Talla=$row['Nom_Talla'];
$FotoPrenda=$row['Img_Referencia'];
$Cant_Solicitada=$row['Cant_Solicitada'];
$Talla_Solicitada=$row['Talla_Solicitada'];
$Tienda_Id_Tienda=$row['Tienda_Id_Tienda'];
$Referencia_Id_Referencia=$row['Referencia_Id_Referencia'];
$Fecha_Solicitud=$row['Fecha_Solicitud'];
$Vendedor_Id_Usuario=$row['Vendedor_Id_Usuario'];
$Valor_Prenda=$row['Valor_Prenda'];
$Valor_Final=$row['Valor_Final'];

$TotalPedido=$Cant_Solicitada*$Valor_Final;
$CalculoDescuento=1-($Valor_Final/$Valor_Prenda);
//$VrDescuento=$CalculoDescuento*100;
                                     ?>
                                            <tr>
                                                <td>
                                                	<img src="<?php Echo($FotoPrenda) ?>" alt="iMac" width="60">

                                                </td>
                                                <td>
                                                    <h5><?php Echo($Referencia_Id_Referencia)  ?> </h5> 
                                                </td>
                                                 <td>
                                                    <h5><?php Echo($Nom_Talla)  ?> </h5> 
                                                </td>
<form action="cc_Actualizar-Carrito3.php" method="post">
                                                <td style="padding-top: 15px;">
                        <input type="text" name="TxtIdVenta" value="<?php Echo($Id_Venta) ?>" style="display: none;">
                        <input type="text" name="TxtRef" value="<?php Echo($Referencia_Id_Referencia) ?>" style="display: none;">

                      <input class=" nav-search-input input-sm" type="text" value="<?php Echo(formatomoneda($Valor_Final)) ?>" id="demo9" placeholder="$ 0" name="demo9"  required="true" />
                         
                               
                                <script type="text/javascript">     
$("#demo9").maskMoney({
prefix:'$ ', // The symbol to be displayed before the value entered by the user
allowZero:true, // Prevent users from inputing zero
allowNegative:true, // Prevent users from inputing negative values
defaultZero:false, // when the user enters the field, it sets a default mask using zero
thousands: '.', // The thousands separator
decimal: '.' , // The decimal separator
precision: 0, // How many decimal places are allowed
affixesStay : true, // set if the symbol will stay in the field after the user exits the field. 
symbolPosition : 'left' // use this setting to position the symbol at the left or right side of the value. default 'left'
}); //
    </script>	
                                                	</td>
                                                <td class="center" style="padding-top: 15px;">
                                                 <select name="TxtCantidad" required="true">
                                                   <option value="<?php Echo($Cant_Solicitada) ?>"><?php Echo($Cant_Solicitada) ?>Und.</option>
                                                   <?php 
                                                   for ($i=1; $i <100 ; $i++) { 
                                                     Echo("<option value='".$i."'>".$i." Unds.</option>");
                                                   }
                                                    ?>
                                                 </select>
                                                    
                                                </td>
                                             
                                                <td style="padding-top: 20px;" class="font-500" align="center"><strong><?php Echo(formatomoneda($TotalPedido)) ?></strong></td>
                                                <td style="padding-top: 20px;" align="center">
                                                	<a href="cc_crearsalida.php?Delete=<?php Echo($Id_Venta); ?>&Mensaje=1" data-rel="tooltip" data-placement="top" title="Eliminar Referencia"  class="text-inverse btn-xs" title="" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash bigger-150 red"></i></a>
                                                  <button data-rel="tooltip" data-placement="top" type="submit" title="Actualizar"  class="text-inverse btn-xs" title="" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-refresh bigger-120 green"></i></button>
                                                </td>
                                          </form>
                                            </tr>
                                       <?php 
                                   }
                               }
                               else
                               {
                               	?>
                               	<tr>
                               		<td colspan="6">
                               			<h2><i class="fa fa-barcode"> Digite la Referencia o escanee la prenda con el lector  </i></h2>
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
                        <div class="card">
                            <div class="card-body">
                     

                                                          <?php 
                               // Consulta Valor de la prenda
$sql ="SELECT SUM(Valor_Final*Cant_Solicitada) as TotalPedido FROM t_salidas_cc WHERE Vendedor_Id_Usuario='".$IdUser."' and Estado_Venta='1'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $TotalPedido=$row['TotalPedido'];
      $TotalSinIva=$TotalPedido/1.19;
      $TotalIva=$TotalPedido-$TotalSinIva;
 }
}

$sql ="SELECT SUM(Cant_Solicitada) as SumaPrendas FROM t_salidas_cc WHERE Vendedor_Id_Usuario='".$IdUser."'and Estado_Venta='1'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $SumaPrendas=$row['SumaPrendas'];
 }
}
      


                                ?>
                                <table class="table product-overview">
                                  <tr>
                                    <td>
                                     <!--  <a class="btn btn-danger btn-sm" href="cc_crearsalida.php?CancelVenta=true"><i class="fa fa-times"></i> Cancelar Venta</a> -->
                                    </td>
                                  </tr>
                                  <tr>
                                  <th class="warning">En la cesta de articulos </th>
                                  <th class="pull-rigth warning" style="padding: 10px;" ><i class="fa fa-shopping-cart"> </i> <?php Echo($SumaPrendas); ?> Prendas</th>
                                  </tr>
                                  <tr>
                                    <td>Sub-Total:</td>
                                    <td style="text-align: right;"><?php Echo(formatomoneda($TotalSinIva)); ?></td>
                                  </tr>
                                   <tr>
                                    <td>19% IVA:</td>
                                    <td style="text-align: right;"><?php Echo(formatomoneda($TotalIva)); ?></td>
                                  </tr>
                                  <tr class="success">
                                     <td><strong>Total Salida:</strong></td>
                                    <td style="text-align: right;"><strong><?php Echo(formatomoneda($TotalPedido)); ?></strong></td>
                                  </tr>
                                </table>

            
                                 <hr>
                           
                               

                         
<form method="post" action="cc_GuardarSalida.php" id="FormGuardarventa">

 <?php 

 
// Detalle venta Factura

    $sql ="SELECT Id_Venta,Referencia_Id_Referencia,Talla_Solicitada,Ref_Vendida, Cant_Solicitada FROM t_salidas_cc WHERE Vendedor_Id_Usuario='".$IdUser."' and Estado_Venta='1'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Id_Venta=$row['Id_Venta'];
      $Ref_Venta=$row['Referencia_Id_Referencia'];
      $Talla_Venta=$row['Talla_Solicitada'];
      $RefCompleta_Venta=$row['Ref_Vendida'];
      $Cantidad_Venta=$row['Cant_Solicitada'];
      ?>
      <input  style="display: none;" type="text" name="TxtCadIdVenta[]" value="<?php Echo($Id_Venta);?>">
       <input style="display: none;" type="text" name="TxtRefVenta[]" value="<?php Echo($Ref_Venta);?>">
       <input style="display: none;" type="text" name="TxtTallaVenta[]" value="<?php Echo($Talla_Venta);?>">
       <input style="display: none;" type="text" name="TxtRefCompletaVenta[]" value="<?php Echo($RefCompleta_Venta);?>">
        <input style="display: none;" type="text" name="TxtCantVenta[]" value="<?php Echo($Cantidad_Venta);?>">
      <?php
    }
  }
// Valor Factura
 $sql ="SELECT Cons_cc FROM t_config WHERE Desarrollador='TEKSYSTEM S.A.S'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Cons_cc=$row['Cons_cc']+1;
      ?>
      <input style="display: none;" type="text" name="FactNum" value="<?php Echo($Cons_cc);?>">
      <?php
    }
  }

?>
    <input style="display: none;" type="text" name="ValorTotal" value="<?php Echo($TotalPedido);?>">
    <input style="display: none;" type="text" name="ValorSubtotal" value="<?php Echo round(($TotalSinIva));?>">
    <input style="display: none;" type="text" name="ValorIva" value="<?php Echo round(($TotalIva));?>">
     <input style="display: none;" type="text" name="VentaTienda" value="<?php Echo ($MyIdTienda);?>">

<?php 
    if ($PendientePago<0) {
      ?>
      <h4 class="red"><i class="fa fa-info-circle"> </i> Valor ingresado supera la Factura - Verificar</h4>
      <?php
    }
    else
    {
 ?>
    

   
     
    <h4 class="card-title">Seleccionar Cliente</h4> 
    <input type="hidden" name="TxtClientes" value="7">

                                <select required="true" class="chosen-select input-xxlarge" name="TxtProveedor" id="TxtProveedor" data-placeholder="Seleccionar...">
                                    <option value="">Empiece a digitar el documento </option>
                  <?php
$sql ="SELECT Id_Cliente,Documento_Cliente, Nom_Cliente,Ape_Cliente FROM t_clientes  order by Nom_Cliente ASC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $SelectId_Cliente=$row['Id_Cliente'];
      $SelectDocumento_Cliente=$row['Documento_Cliente'];  
       $Nom_Cliente=$row['Nom_Cliente'];  
        $Ape_Cliente=$row['Ape_Cliente'];             
      echo ("<option value='".$SelectId_Cliente."'>".utf8_encode($SelectDocumento_Cliente." - ".$Nom_Cliente." ".$Ape_Cliente)."</option>");
 }
}
        
?>  
                                  
                        </select>

                      
                                  <a data-toggle="modal" data-target="#modal-form2" href="#"><span class="btn  btn-success btn-xs"><i class="fa fa-plus-square"> </i> Crear Nuevo Cliente</span></a>
<hr>

 <textarea style="display: none;" required name="Txtobservaciones" class="form-control" placeholder="Agregar Observaciones" >Pauta publicitaria de la marca ModasofAUTE, atraves de medio digitales y redes sociales</textarea>
                               
                               <hr>
                                 <button type="submit" class="btn btn-danger btn-outline"><i class="fa fa-print"> </i>Imprimir Cuenta Cobro</button>
                                 </form>
                            
    <?php 
  }
     ?>
                
                               <div class="card">
                          
                        </div>
                               
                            </div>
                        </div>
                      
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
      

              <form action="Cliente-Crear.php?ForVenta=8" method="post" id="FormNuevoCliente" autocomplete="off">
                  <div class="modal-dialog ">
                    <div class="modal-content">
                      <div class="modal-header">
                        <a href="cc_crearsalida.php" type="button" class="close" data-dismiss="modal">&times;</a>
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
                        <input type="number" name="TxtDocumento" id="TxtDocumento" class="input-large" placeholder="Documento" style="text-transform:uppercase;">
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
                              <div class="form-group">
                              <label for="form-field-select-3">E-mail</label>

                              <div class="input-group">
                                <span class="input-group-addon">
                                  <i class="ace-icon fa fa-envelope"></i>
                                </span>
              <input type="email" name="TxtCorreo" required="true" class="input-large" placeholder="Dirección de Proveedor" >
                              </div>
                            
                            </div>
                    
                          </div>
                           <div class="row">
                  <div class="col-sm-12 col-xs-12 col-md-12">
                    <div class="col-sm-4 col-md-4">
                      <label>Fecha de Nacimiento</label>
                    </div>
                    <div class="col-sm-8 col-xs-8 col-md-8">
                      <label for="form-field-select-3">Día</label>
                      <select name="Fechadia">
                        <option value="">Día</option>
                        <?php 
                          for ($i=1; $i <32 ; $i++) { 
                            echo("<option value='".$i."'>".$i."</option>");
                          }
                         ?>
                      </select>
                      <label for="form-field-select-3">Mes</label>
                      <select name="Fechames">
                        <option value="">Mes</option>
                        <?php 
                          for ($i=1; $i <13 ; $i++) { 
                            echo("<option value='".$i."'>".$i."</option>");
                          }
                         ?>
                      </select>
                      <label for="form-field-select-3">Año</label>
                      <select name="Fechaano">
                        <option value="">Año</option>
                        <?php 
                          for ($i=1919; $i <2020 ; $i++) { 
                            echo("<option value='".$i."'>".$i."</option>");
                          }
                         ?>
                      </select>
                    </div>
                    </div>
                </div>


                          
                        </div>
                      </div>

                      <div class="modal-footer">
                        <a href="cc_crearsalida.php" class="btn btn-sm btn-danger" data-dismiss="modal">
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

    <!-- Inicio Modal -->
    <div id="modal-form3" class="modal" tabindex="-1">
               <!-- Inicio Modal -->
    <div>
      
              <form action="Cliente-Crear.php?ForVenta=1" method="post" id="FormNuevoCliente" autocomplete="off">
                  <div class="modal-dialog ">
                    <div class="modal-content">
                      <div class="modal-header">
                        <a href="CrearVenta.php" type="button" class="close" data-dismiss="modal">&times;</a>
                        <h4 class="black bigger">Tallas Modasof</h4>
                      </div>

                      <div class="modal-body">
                        <div class="row">
                          <div class="col-xs-12 col-sm-6 ">
                            <h3>Tallas Camisas</h3>
                            <table class="table product-overview">
                              <tr>
                                <th>Código Talla</th>
                                <th>Talla</th>
                              </tr>
                            <?php
$sql ="SELECT Id_Talla, Nom_Talla FROM t_tallas  order by Nom_Talla ";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $SelectId_Talla=$row['Id_Talla'];
      $SelectNom_Talla=$row['Nom_Talla'];             
      ?>
     <tr>
       <td><?php Echo($SelectId_Talla); ?></td>
       <td><?php Echo($SelectNom_Talla); ?></td>
     </tr>
      <?php
 }
}
        
?>
       </table>                   

                          </div>

                      <div class="col-xs-12 col-sm-6 ">
                         <h3>Otras Tallas</h3>
                            <table class="table product-overview">
                              <tr>
                                <th>Código Talla</th>
                                <th>Talla</th>
                              </tr>
                            <?php
$sql ="SELECT Id_Talla, Nom_Talla FROM t_tallas  order by Nom_Talla DESC LIMIT 10, 50";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $SelectId_Talla=$row['Id_Talla'];
      $SelectNom_Talla=$row['Nom_Talla'];             
      ?>
     <tr>
       <td><?php Echo($SelectId_Talla); ?></td>
       <td><?php Echo($SelectNom_Talla); ?></td>
     </tr>
      <?php
 }
}
        
?>
       </table>                  
                          </div>

                          
                        </div>
                      </div>

                      <div class="modal-footer">
                        <a href="CrearVenta.php" class="btn btn-sm btn-danger" data-dismiss="modal">
                          <i class="ace-icon fa fa-times"></i>
                          Cerrar
                        </a>

                       
                      </div>
                    </div>
                  </div>
                </form>
                </div><!-- PAGE CONTENT ENDS -->
            <!-- FINAL MODAL -->
              </div>  


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
		
		
		
		<script src="https://modasof.com/espejo/assets/js/jquery.validate.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery-additional-methods.min.js"></script>

		<script src="https://modasof.com/espejo/assets/js/dataTables.responsive.min.js"></script>
		 <script type="text/javascript">
        $(document).ready(function()
        {
             $("#FormPago").validate({
             	errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
                 rules: {
                     "demo1": { required:true },
                     "TxtMedioPago": { required:true }, 
                 },
                
             });
        });
    </script>
     <script type="text/javascript">
        $(document).ready(function()
        {
             $("#FormGuardarventa").validate({
              errorElement: 'div',
          errorClass: 'help-block',
          focusInvalid: true,
          ignore: "",
                 rules: {
                     "TxtClientes": { required:true },
                 },
                
             });
        });
    </script>
    
     <script type="text/javascript">
        $(document).ready(function()
        {
             $("#FormNuevoCliente").validate({
             	errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
                 rules: {
                     "TxtDocumento": { required:true },
                     "TxtNombre": { required:true }, 
                     "TxtApellido": { required:true }, 
                     "UpTxtCiudad": { required:true },
                     "TxtCiudad": { required:true }, 
                     "TxtCelular": { required:true }, 
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