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

// Recibimos la Variable del Pedido

$PedidoCliente=$_GET['PedidoCliente'];

$sql ="SELECT date_format(Fecha_Pedido,CONCAT(CONCAT(ELT(WEEKDAY(Fecha_Pedido) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(Fecha_Pedido), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS FechaPedido,date_format(Fecha_Entrega,CONCAT(CONCAT(ELT(WEEKDAY(Fecha_Entrega) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(Fecha_Entrega), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS FechaEntrega, Id_Pedido, Cod_Pedido, Cliente_Id_Cliente, Fecha_Pedido, Total_Pedido, Descuento, Estado_Pedido, Saldo_Abonado, Pedido_Id_Usuario, Fecha_Entrega, Tienda_Id_Tienda, C.Nom_Cliente,C.Ape_Cliente FROM t_pedido as A, t_clientes as C WHERE Cod_Pedido='".$PedidoCliente."' and  A.Cliente_Id_Cliente=C.Id_Cliente"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $FechaPedido=$row['FechaPedido'];
        $FechaEntrega=$row['FechaEntrega'];
        $Id_Pedido=$row['Id_Pedido'];
        $Cod_Pedido=$row['Cod_Pedido'];
        $Cliente=$row['Cliente_Id_Cliente'];
        $Fecha_Pedido=$row['Fecha_Pedido'];
        $Total_Pedido=$row['Total_Pedido'];
        $Descuento=$row['Descuento'];
        $Estado_Pedido=$row['Estado_Pedido'];
        $Saldo_Abonado=$row['Saldo_Abonado'];
        $Fecha_Entrega=$row['Fecha_Entrega'];
        $Pedido_Id_Usuario=$row['Pedido_Id_Usuario'];
        $Nombres=$row['Nombres'];
        $Apellidos=$row['Apellidos'];
        $AvatarVendedor=$row['Img_perfil'];
        $Nom_Cliente=$row['Nom_Cliente'];
        $Ape_Cliente=$row['Ape_Cliente'];

        $CalculoAbono=1-($Saldo_Abonado/$Total_Pedido);
        $PorcentajeAbonado=$CalculoAbono*100;
        $Saldo_Pendiente=$Total_Pedido-$Saldo_Abonado;

        $date = new DateTime($Fecha_Solicitud);
        $Hora=$date->format('H:i:s a');
  }
}

// Actualizar Estado a Producción
$CambioEstado=$_GET['CambioEstado'];



?>
<?php 

  $ValNota=$_GET['ValNota'];
if ($ValNota==1) {

date_default_timezone_set("America/Bogota");
$MarcaTemporal = date('Y-m-d H:i:s');

  $MiComentario=htmlentities($_POST['MiNota']);
  $OrdenNumero=$_POST['OrdenNumero'];
$sql = "INSERT INTO t_comentarios_produccion_cliente (Usuario_id_usuario, Fecha_Comentario, Comentario_Prod, Solicitud_Cod_Orden) VALUES ('".utf8_decode($IdUser)."','".utf8_decode($MarcaTemporal)."','".$MiComentario."','".utf8_decode($OrdenNumero)."')";
//echo($sql);
$result = $conexion->query($sql);

$Valida=header("location:Pedido-Ver.php?Solicitud=".$OrdenNumero."&Mensaje=1&Propietario=".$Propietario."&PedidoCliente=".$PedidoCliente."");
}
// Fin Insertar Comentario
   ?>
<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		
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

 

 
   <!-- Inicio Libreria formato moneda -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
<script src="https://modasof.com/espejo/assets/js/jquery.maskMoney.js" type="text/javascript"></script>



 
<script type="text/javascript">
    $("#Impresion").click(function(){
    // var ValorCod = $("#ValorCod<?php echo $Id_Insumo;?>").val();
    // var Nombre = $("#NombreInsumo<?php echo $Id_Insumo;?>").val();
    // var ImgInsumo = $("#UrlInsumo<?php echo $Id_Insumo;?>").val();
    // var PromInsumo = $("#Promedio<?php echo $Id_Insumo;?>").val();
    // var UnidadInsumo = $("#Unidad<?php echo $Id_Insumo;?>").val();

    sweetAlert({
  title: "Oops!", 
    text: "Something went wrong on the page!", 
    type: "error"
});
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
    <?php 

    $sql="SELECT Id_Not_Push, Usuario_Id_Usuario_Envia, Usuario_Id_Usuario_Recibe, Mensaje_Push, Fecha_Mensaje_Push, Estado_Mensaje_Push, Leido_Mensaje_Push FROM t_notificaciones_push WHERE Usuario_Id_Usuario_Recibe='".$IdUser."'";
    $result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    $Id_Not_Push=$row['Id_Not_Push']; 
    $Mensaje_Push=$row['Mensaje_Push']; 
    $Fecha_Mensaje_Push=$row['Fecha_Mensaje_Push']; 
   
    $tem='<script type="text/javascript">
        Push.create("Notificación Modasof",{
            body:"'.$Mensaje_Push.'",
            icon:"../Administrator/Images/favicon/favicon-96x96.png",
            timeout: 500000,
            requireInteraction:true,
            vibrate:[400,200],
            onClick: function(){
                window.location="perfil.php?TAB=tabs-2"
               this.close();
            }
        });
    </script>
    '  ;
   //Echo($tem); 
    }
}

     ?>

      <script type="text/javascript">
    function printDiv(nombreDiv) {
     var contenido= document.getElementById(nombreDiv).innerHTML;
     var contenidoOriginal= document.body.innerHTML;

     document.body.innerHTML = contenido;

     window.print();

     document.body.innerHTML = contenidoOriginal;
}
  </script>

	</head>
  

	<body class="skin-1">

	<?php 
  $Valide=$_GET['Mensaje'];

    if ($Valide==232) {
        echo "<script>jQuery(function(){swal(\"¡Lo Sentimos!\", \"Datos Incorrectos\", \"error\");});</script>";
    };
      if ($Valide==555) {
        echo "<script>jQuery(function(){swal(\"¡No puede tener descuento y adicional al mismo tiempo!\", \"Verificar Valores\", \"error\");});</script>";
    };

    if ($Valide==20) {
        echo "<script>jQuery(function(){swal(\"¡ Estado Actualizado!\", \"Correctamente \", \"success\");});</script>";
    };

    if ($Valide==1) {
        echo "<script>jQuery(function(){swal(\"¡ Comentario Agregado!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==2) {
        echo "<script>jQuery(function(){swal(\"¡ Comentario Actualizado!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==3) {
        echo "<script>jQuery(function(){swal(\"¡ Orden Asignada a Sastre!\", \"Correctamente \", \"success\");});</script>";
    };
     if ($Valide==33) {
        echo "<script>jQuery(function(){swal(\"¡ Observación Actualizada!\", \"Correctamente \", \"success\");});</script>";
    };

    if ($Valide==333) {
        echo "<script>jQuery(function(){swal(\"¡ Valor de Pedido modificado!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==4) {
        echo "<script>jQuery(function(){swal(\"¡ Orden en estado acabados!\", \"Correctamente \", \"success\");});</script>";
    };

     if ($Valide==5) {
        echo "<script>jQuery(function(){swal(\"¡ Orden enviada al centro de Distribución!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==23) {
        echo "<script>jQuery(function(){swal(\"¡ Comentario Actualizado!\", \"".$ClienteSel." \", \"success\");});</script>";
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
              <?php 
        if ($MyIdTienda=="") {
          ?>
         <li>
                <i class="ace-icon fa fa-cubes home-icon"></i>
                <a href="Pedidos.php">Pedidos</a>
              </li>
          <?php
        }
        else {
          ?>
         <li>
                <i class="ace-icon fa fa-users home-icon"></i>
                <a href="Pedidos.php">Mis Pedidos</a>
              </li>
          <?php
        }
        
          ?>
							
            </ul><!-- /.breadcrumb -->

						
					</div>

					<div class="page-content">
				<?php 
					//include("Lib/colors.php");
				?>
						<div class="row">

						
							<div class="col-xs-12 col-sm-12">
								  <div class="row">
          <!-- ./col -->
    <?php 
     $sql ="SELECT B.Nom_Ciudad,Id_Cliente, Documento_Cliente,Avatar_Cliente, Nom_Cliente, Ape_Cliente, Ciudad_Id_Ciudad, Correo_Cliente, Tel_Cliente, Cel1_Cliente, Cel2_Cliente, Tipo_Cliente from t_clientes as A, t_ciudades as B  WHERE  Id_Cliente='".$Cliente."' and A.Ciudad_Id_Ciudad=B.Id_Ciudad";     
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Id_Cliente=$row['Id_Cliente'];
        $Documento_Cliente=$row['Documento_Cliente'];
        $Avatar_Cliente=$row['Avatar_Cliente'];
         $Nom_Cliente=$row['Nom_Cliente'];
         $Nom_Ciudad=$row['Nom_Ciudad'];
        $Ape_Cliente=$row['Ape_Cliente'];
        $Correo_Cliente=$row['Correo_Cliente'];
        $Cel1_Cliente=$row['Cel1_Cliente'];
        $Cel2_Cliente=$row['Cel2_Cliente'];
      }
    }
     ?>
         <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-white">
              <div class="widget-user-image">
                <img class="img-circle" src="<?php Echo($Avatar_Cliente); ?>" alt="User Avatar">

              </div>
              <!-- /.widget-user-image -->
              <h5 class="widget-user-desc"><strong>Cliente Cl-5000<?php Echo($Id_Cliente); ?>:</strong><br><?php Echo utf8_encode($Nom_Cliente." ".$Ape_Cliente); ?></h5>
              <h5 class="widget-user-desc"><strong>NIT/CC #:</strong><?php Echo utf8_encode($Documento_Cliente); ?></h5>
              <h5 class="widget-user-desc"><strong>E-mail: </strong><?php Echo utf8_encode($Correo_Cliente); ?></h5>
              
            </div>
           
          </div>
          <!-- /.widget-user -->
        </div>
        <!-- ./col -->
         <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-3">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-white">
             
              <!-- /.widget-user-image -->
              <h5 class="widget-user-desc"><strong>Dirección: </strong><br><?php Echo utf8_encode($Nom_Cliente." ".$Ape_Cliente); ?></h5>
              <h5 class="widget-user-desc"><strong>Ciudad: </strong><br><?php Echo utf8_encode($Nom_Ciudad); ?></h5>
              <h5 class="widget-user-desc"><strong>Teléfonos: </strong><?php Echo utf8_encode($Cel1_Cliente."//".$Cel2_Cliente); ?></h5>
              <hr>
            </div>
           
          </div>
          <!-- /.widget-user -->
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-black">
            <div class="inner">
               <?php
// Contador de LLamadas 
$sql ="SELECT Sum(Cant_Solicitada*Valor_Final) as SumaPedido FROM t_temporal_sol WHERE Solicitud_Id_Usuari='".$IdUser."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $SumaPedido=$row['SumaPedido'];
 }
}
                                     ?>
              <h4>Pedido Nº PDC<?php Echo($Cod_Pedido); ?></h4>
              <h4>Fecha Entrega: <?php Echo($FechaEntrega) ?></h4>
            
             
            </div>
           
            
          </div>
        </div>
      
        
      </div>
      <!-- /.row -->

				<div class="col-sm-12 col-xs-12"><!-- Inicio Panel Inferior-->
					<hr>
					<div class="row">
					<div class="col-sm-4 col-xs-12" >
						 <!-- ============================================================== -->
                    <!-- Totla Earning copy and paste this code-->
                    <!-- ============================================================== -->
                    <!-- Card -->
                    <div class="card earning-widget">
                        <div class="card-body">
                            <div class="card-title">
                           
                                <div class="d-flex">
                                    <span>
                                <h4 class="card-title m-b-0">Solicitudes a producción Pedido Nº: PDC<?php Echo($PedidoCliente) ?></h4>
                               <!--  <h2 class="m-t-0">$5.987.000</h2> --></span>
                                    
                                </div>

                            </div>
                        </div>
                <div class="row" id="Referencias"> 
                  <div class="card-body b-t" style="height:400px;overflow:scroll;">
                            <table class="table v-middle no-border">
                                <tbody>
<?php 
    $sql ="SELECT date_format(A.Fecha_Solicitud,CONCAT(CONCAT(ELT(WEEKDAY(A.Fecha_Solicitud) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(A.Fecha_Solicitud), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS CreadaFecha,B.Nombres,B.Apellidos,B.Img_Perfil,Id_Temporal_Sol,Pedido_Id_Pedido, C.Nom_Bodega, Cant_Solicitada, D.Nom_Talla, E.Nom_Tienda, Referencia_Id_Referencia, Estado_Solicitud_Cliente, A.Fecha_Solicitud,F.Img_Referencia,G.Nom_Estado_Pedido,G.Color_Estado FROM t_temporal_sol AS A, t_usuarios as B, t_bodegas as C, t_tallas as D, t_tiendas as E,t_referencias as F, t_estado_pedidos as G WHERE  A.Vendedor_Id_Usuario=B.Id_Usuario and A.Bodega_Id_Bodega=C.Id_Bodega and A.Talla_Solicitada=D.Id_Talla and A.Tienda_Id_Tienda=E.Id_Tienda and A.Referencia_Id_Referencia=F.Cod_Referencia and  Pedido_Id_Pedido='".$PedidoCliente."' and A.Estado_Solicitud_Cliente=G.Id_Estado_Pedido   ORDER BY UNIX_TIMESTAMP(Fecha_Solicitud) DESC"; 
    //Echo($sql); 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    $CreadaFecha=$row['CreadaFecha']; 
    $Fecha_Solicitud=$row['Fecha_Solicitud']; 
    $Nombres=$row['Nombres']; 
    $Apellidos=$row['Apellidos']; 
    $Img_Perfil=$row['Img_Perfil'];
    $Img_Referencia=$row['Img_Referencia']; 
    $Id_Temporal_Sol=$row['Id_Temporal_Sol'];
    $Pedido_Id_Pedido=$row['Pedido_Id_Pedido'];   
    $Nom_Bodega=$row['Nom_Bodega'];
    $Cant_Solicitada=$row['Cant_Solicitada'];
    $Nom_Talla=$row['Nom_Talla'];
    $Nom_Almacen=$row['Nom_Tienda']; 
    $Referencia_Id_Referencia=$row['Referencia_Id_Referencia'];
    $Estado_Solicitud_Cliente=$row['Estado_Solicitud_Cliente'];
    $Color_Estado=$row['Color_Estado'];
    $Nom_Estado_Pedido=$row['Nom_Estado_Pedido'];
    $date = new DateTime($Fecha_Solicitud);
    $Hora=$date->format('H:i:s a');

     ?>
                                    
                                    <tr>
                                        
                                        <td style="width:40px"><a href="Pedido-Ver.php?Solicitud=<?php Echo($Id_Temporal_Sol) ?>&PedidoCliente=<?php Echo($PedidoCliente) ?>"><img data-rel="tooltip" data-placement="top" title="<?php Echo($Nombres." ".$Apellidos."\r\n".$Hora) ?>" src="<?php Echo($Img_Perfil) ?>" width="50" class="img-circle" alt="logo"></a></td>
                                        <td>
                                          <a href="Pedido-Ver.php?Solicitud=<?php Echo($Id_Temporal_Sol) ?>&PedidoCliente=<?php Echo($PedidoCliente) ?>">
                                            <strong>SCL<?php Echo($Id_Temporal_Sol) ?></strong>
                                          </a> 
                                          <img src="<?php Echo($Img_Referencia) ?>" width="90" heigth="90" alt="logo">
                                          <a href="Pedido-Ver.php?Solicitud=<?php Echo($Id_Temporal_Sol) ?>&PedidoCliente=<?php Echo($PedidoCliente) ?>"></a>
                                        </td>
                                        <td align="right">
                                <span class="date"><strong class="pull-left">Solicitado el:</strong><br><?php Echo($CreadaFecha); ?><br>  <?php echo $date->format('H:i:s a');  ?></span><br>
                                            <!-- <span class="label label-info"><a style="color:white;" href="Vista-Orden.php">$2.300.000</a></span> -->
                                            
                                <span class="label label-dark bg-black"><?php Echo($Cant_Solicitada); ?> Un. <?php Echo($Referencia_Id_Referencia."-".$Nom_Talla) ?></span> <span class="action-icons"></span>
                             <?php 

                             Echo("<span class='label' style='background-color:".$Color_Estado."'>".utf8_encode($Nom_Estado_Pedido)."</span> <span class='action-icons'></span>");
                              ?>
                                 <br>
                                 <span><?php Echo($Nom_Almacen); ?></span>
                                 <br>
                                 <span><?php Echo($Nom_Bodega); ?></span>
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
					</div>

      <div class="col-sm-8 col-xs-12" style="border: 1px dotted black;">
                <?php 
  $SolicitudSelect=$_GET['Solicitud'];

    //***************************************************************************************************
   $sql ="SELECT date_format(Fecha_Solicitud,CONCAT(CONCAT(ELT(WEEKDAY(Fecha_Solicitud) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(Fecha_Solicitud), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS CreadaFecha,B.Nombres,B.Apellidos,B.Img_Perfil,Id_Temporal_Sol, C.Nom_Bodega,C.Id_Bodega, Cant_Solicitada, D.Nom_Talla, E.Nom_Tienda, Referencia_Id_Referencia, Estado_Solicitud_Cliente, Fecha_Solicitud,Sastre_Id_Usuario, Observa_Cliente,Fecha_Observacion,Valor_Prenda,Valor_Adicional,Valor_Final FROM t_temporal_sol AS A, t_usuarios as B, t_bodegas as C, t_tallas as D, t_tiendas as E WHERE Id_Temporal_Sol='".$SolicitudSelect."' AND A.Vendedor_Id_Usuario=B.Id_Usuario and A.Bodega_Id_Bodega=C.Id_Bodega and A.Talla_Solicitada=D.Id_Talla and A.Tienda_Id_Tienda=E.Id_Tienda ORDER BY UNIX_TIMESTAMP(Fecha_Solicitud) DESC"; 
    //Echo($sql); 

$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    $CreadaFecha=$row['CreadaFecha']; 
    $Fecha_Solicitud=$row['Fecha_Solicitud']; 
    $Fecha_Observacion=$row['Fecha_Observacion']; 
    $Nombres=$row['Nombres']; 
    $Apellidos=$row['Apellidos']; 
    $Img_Perfil=$row['Img_Perfil']; 
    $Id_Solicitud_Prod=$row['Id_Temporal_Sol'];   
    $Nom_Bodega=$row['Nom_Bodega'];
     $Id_Bodega=$row['Id_Bodega'];
    $Cant_Solicitada=$row['Cant_Solicitada'];
    $NumeroPrendas=$row['Cant_Solicitada'];
    $Nom_Talla=$row['Nom_Talla'];
    $Nom_Almacen=$row['Nom_Tienda'];
    $Observa_Cliente=$row['Observa_Cliente']; 
    $Referencia_Id_Referencia=$row['Referencia_Id_Referencia'];
    $Estado_Solicitud_Cliente=$row['Estado_Solicitud_Cliente'];
     $Sastre=$row['Sastre_Id_Usuario'];
    $Valor_Prenda=$row['Valor_Prenda'];
    $Valor_Final=$row['Valor_Final'];
    $Valor_Adicional=$row['Valor_Adicional'];
    $Valor_Descuento=$Valor_Prenda-$Valor_Final;

    $date = new DateTime($Fecha_Solicitud);
    $FechaSol=$date->format('Y-m-d');
      }
    }

  //***************************************************************************************************
   $sql ="SELECT Img_Referencia,Coleccion_Nom_Coleccion,Insumo_Ppal,Cod_Referencia,Tipo_Referencia FROM t_referencias  WHERE Cod_Referencia='".$Referencia_Id_Referencia."'"; 
    //Echo($sql); 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    $Img_Referencia=$row['Img_Referencia'];
    $Coleccion_Nom_Coleccion=$row['Coleccion_Nom_Coleccion'];
    $Insumo_Ppal=$row['Insumo_Ppal']; 
    $Cod_Referencia=$row['Cod_Referencia'];
    $Tipo_Referencia=$row['Tipo_Referencia'];
    
      }
    }


  //***************************************************************************************************
    // Seleccionar el tipo de prenda que se está elaborando
  //***************************************************************************************************
   $sql ="SELECT Categoria_Id_Categoria_Prod  FROM t_referencias  WHERE Cod_Referencia='".$Referencia_Id_Referencia."'"; 
    //Echo($sql); 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    $Categoria_Id_Categoria_Prod=$row['Categoria_Id_Categoria_Prod'];  
      }
    }

date_default_timezone_set("America/Bogota");
$MarcaTemporal = date('Y-m-d H:i:s');


                if ($SolicitudSelect=="") {
                Echo("<h1 class='center' style='color:#8E8B8A;''>Seleccione la solicitud que desea ver <i class='fa fa-search'></i></h1>");
                }
                else
                {
        Echo("<h2 style='color:#8E8B8A;''> Orden de Producción Nº SCL".$SolicitudSelect."<span class='pull-right badge bg-green'>Días Transcurridos ".dias_transcurridos($FechaSol,$MarcaTemporal)."</span></h2><h4>".$Referencia_Id_Referencia."-".$Nom_Talla."<span class='red'> ".$Cant_Solicitada." Und.</span></h4>");   
                
                 ?>
                        
                        <!-- Column -->
                    <div class="col-lg-3 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">

                                <center class="m-t-30"> <img src="<?php Echo($Img_Referencia); ?>" class="img-circle" width="150" />
                                <?php 
                $sql ="SELECT `Id_Estado_Pedido`,Nom_Estado_Pedido, `Color_Estado`, `Desc_Estado`, `Rol_Id_Rol` FROM `t_estado_pedidos` WHERE Id_Estado_Pedido='".$Estado_Solicitud_Cliente."'"; 
    //Echo($sql); 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    $Id_Estado_Pedido=$row['Id_Estado_Pedido'];
    $Nom_Estado_Pedido=$row['Nom_Estado_Pedido'];
    $Color_Estado=$row['Color_Estado'];
      Echo("<span class='label' style='background-color:".$Color_Estado."'>".utf8_encode($Nom_Estado_Pedido)."</span> <span class='action-icons'></span>");
      }
    }
            ?>
  <?php 
  if ($Estado_Solicitud_Cliente==7) {
    ?>
    <form style="display: none;" method="post" action="Pedido-CambioEstado.php" id="FormSastre" >
    <?php
  }
  else
  {
    ?>
    <form  method="post" action="Pedido-CambioEstado.php" id="FormSastre" >
    <?php
  }

   ?>
  
    <input type="text" name="TxtPedido" value="<?php Echo($Pedido_Id_Pedido); ?>" style="display: none;">
    <input type="text" name="TxtOrdenNumero" value="<?php Echo($SolicitudSelect); ?>" style="display: none;">
    <input type="text" name="TxtCantidad" value="<?php Echo($Cant_Solicitada); ?>" style="display: none;">
    <input type="text" name="TxtTipoPrenda" value="<?php Echo($Categoria_Id_Categoria_Prod); ?>" style="display: none;">
    <input type="text" name="TxtRef" value="<?php Echo($Referencia_Id_Referencia); ?>" style="display: none;">
    <input type="text" name="TxtBodega" value="<?php Echo($Id_Bodega); ?>" style="display: none;">
                  
    <?php 
        //if ($MyIdTienda==0) {
            ?>

                <select name="SelectEstado" id="TxtEstado" required>
                    <option value="">Seleccionar Estado</option>
                    <?php 
                    if ($IdRol==1) {
                      $sql ="SELECT `Id_Estado_Pedido`, `Nom_Estado_Pedido`, `Desc_Estado`, `Rol_Id_Rol` FROM `t_estado_pedidos` order by Nom_Estado_Pedido ASC"; 
                    }
                    else
                    {
                       $sql ="SELECT `Id_Estado_Pedido`, `Nom_Estado_Pedido`, `Desc_Estado`, `Rol_Id_Rol` FROM `t_estado_pedidos` WHERE Rol_Id_Rol='".$IdRol."'  order by Nom_Estado_Pedido ASC"; 
                    }
                    
    //Echo($sql); 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    $Id_Estado_Pedido=$row['Id_Estado_Pedido'];
    $Nom_Estado_Pedido=$row['Nom_Estado_Pedido'];
      Echo("<option value='".$Id_Estado_Pedido."'>".htmlentities($Nom_Estado_Pedido)."</option>");
      }
    }
                     ?>
                  </select>

   <script type="text/javascript">
   $('#TxtEstado').change(function(){
    var valorCambiado =$(this).val();
    if((valorCambiado == '13')){
     
       $('#Confirmacion').css('display','');
     }
     else if(valorCambiado != '13')
     {
          $('#Confirmacion').css('display','none');
     }
});
    </script>
    <hr>
    <div id="Confirmacion" style="display: none;">
    <label>Indique el motivo</label>
        <textarea  class="autosize-transition form-control" name="TxtDetalle" id="form-field-9" rows="5" maxlength="2000"></textarea>
  </div>
                  <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-refresh"></i> Cambiar Estado</button>
                  

            <?
        //}

     ?>




                
                                   
</form>
                                </center>
                            </div>
                            <div>
                                 </div>
                            <div class="card-body"> <small class="text-muted">Solicitado por:</small>
                                <h6><?php Echo utf8_encode($Nombres." ".$Apellidos) ?></h6> <small class="text-muted p-t-30 db">Solicitado a Taller</small>
                                <h6><?php Echo utf8_encode($Nom_Bodega) ?></h6> <small class="text-muted p-t-30 db">Enviar a Tienda</small>
                                 <h6><?php Echo utf8_encode($Nom_Almacen) ?></h6>
                                <br/>
                                
                                
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-9 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Comentarios Modasof</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Detalles</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Cambiar Valor</a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                    <div class="card-body">

                  <form action="Pedido-Ver.php?Solicitud=<?php Echo($SolicitudSelect);?>&ValNota=1&PedidoCliente=<?php Echo($PedidoCliente);?>" method="post" id="validation-form">
                <div>
                      <div class="widget-box">
                        <div class="widget-header">
                          <h4 class="widget-title red">Agregar Comentario</h4>

                          <div class="widget-toolbar">
                            <a href="#" data-action="collapse">
                              <i class="ace-icon fa fa-chevron-up"></i>
                            </a>
                          </div>
                        </div>

                        <div class="widget-body">
                          <div class="widget-main">
                           <!--  <div>
                              <label for="form-field-8">Seleccionar Estado</label>
                              <select name="SelEstado">
                                <option value="">Seleccionar</option>
                                <option value="6">Aplazada</option>
                                <option value="7">En curso</option>
                                <option value="8">No Iniciada</option>
                                <option value="9">Esperando por un Tercero</option>
                                
                              </select>
                            </div> -->
                            <div>
                      
                              <!-- <label for="form-field-8">Descripción</label> -->

                              <textarea  name="MiNota" class="form-control" id="form-field-8" placeholder="Indique aquí su Comentario"></textarea>

                              <input style="display: none;" type="text" name="OrdenNumero" value="<?php Echo($SolicitudSelect)?>">
                            </div>
                            <div>
                              <button type="submit" class="btn btn-sm btn-success">
                          <i class="ace-icon fa fa-comment"></i>
                          Guardar Comentario
                        </button>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                    </div><!-- /.span -->
              </form>
                  <?php 
        $EditNote=$_GET['EditNote'];

$sql ="SELECT date_format(Fecha_Comentario,CONCAT(CONCAT(ELT(WEEKDAY(Fecha_Comentario) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(Fecha_Comentario), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS fecha,time(Fecha_Comentario) AS Mihora,Id_Comentario_Produccion, Usuario_id_usuario, Fecha_Comentario, Comentario_Prod,Nombres,Apellidos,Img_Perfil FROM t_comentarios_produccion_cliente as A, t_usuarios as B WHERE Solicitud_Cod_Orden='".$SolicitudSelect."' and A.Usuario_id_usuario=B.Id_Usuario ORDER BY UNIX_TIMESTAMP(Fecha_Comentario) DESC";  
//echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $FechaNota=$row['fecha'];
        $Hora_Timeline=$row['Mihora'];
        $InfoTimeline=$row['Comentario_Prod'];
        $Id_Timeline=$row['Id_Comentario_Produccion'];
        $Timeline_Nombres=$row['Nombres'];
        $Timeline_Apellidos=$row['Apellidos'];
        $Timeline_Imagen=$row['Img_Perfil'];
        $UsuarioComentario=$row['Usuario_id_usuario'];

$PedidoGet=$_GET['PedidoCliente'];
?>
                                <div id="timeline-<?php Echo($Id_Timeline) ?>">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-11 ">
                                            <div class="timeline-container">
                                                <div class="timeline-label">
                                                    <span class="label label-primary arrowed-in-right label-lg">
                                                        <b><?php echo("$FechaNota"); ?></b>
                                                    </span>
                                                </div>

                                                <div class="timeline-items">
                                                    <div class="timeline-item clearfix">
                                                        <div class="timeline-info">
                                                            <img alt="<?php Echo($Timeline_Nombres); ?>" src="../Administrator/<?php Echo($Timeline_Imagen) ?>" />
                                                            <span class="label label-info label-sm"><?php Echo($Hora_Timeline); ?></span>
                                                        </div>
                                                        <div class="widget-box transparent">
                                                            <div class="widget-header widget-header-small">
                                                                <h5 class="widget-title smaller">
                                                                    <a href="#" class="blue"><?php Echo utf8_encode($Timeline_Nombres." ".$Timeline_Apellidos) ?></a>
                                                                    <!-- <span class="grey">reviewed a product</span> -->
                                                                </h5>
                                                                <span class="widget-toolbar no-border">
                                                                    <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                                                    <?php Echo($Hora_Timeline); ?>
                                                                </span>

                                                                <span class="widget-toolbar">
                                                                    <a href="#" data-action="collapse">
                                                                        <i class="ace-icon fa fa-chevron-up"></i>
                                                                    </a>
                                                                </span>
                                                        </div>

                                                            <div class="widget-body">
                                                                <div class="widget-main">
                                                                    <?php Echo utf8_encode($InfoTimeline); ?>
                                                                    
                                                                    <div class="space-6"></div>

                                                                    <div class="widget-toolbox clearfix">
                                                                        <!-- <div class="pull-left">
                                                                            <i class="ace-icon fa fa-hand-o-right grey bigger-125"></i>
                                                                            <a href="#" class="bigger-110">Click to read &hellip;</a>
                                                                        </div> -->

                                                                        <div class="pull-right action-buttons">
                                                                            <?php 
                                                                            if ($IdUser==$UsuarioComentario) {
                                                                                ?>

                                                                            <a href="Pedido-Ver.php?Solicitud=<?php echo($SolicitudSelect);?>&PedidoCliente=<?php echo($PedidoGet);?>" class="tooltip-success green" data-rel="tooltip" data-placement="top" title="Cancelar Edición">
                                                                                <i class="ace-icon fa fa-close red bigger-130"></i>
                                                                            </a>
                                                                            <?php
                                                                            }
                                                                             ?>
                                                                      <?php 
                                                                      if ($UsuarioComentario==$IdUser) {
                                                                        ?>
      <a href="Pedido-Ver.php?Solicitud=<?php echo($SolicitudSelect);?>&EditNote=1&PedidoCliente=<?php echo($PedidoGet);?>">
                                                                                <i class="ace-icon fa fa-pencil blue bigger-125"></i>
                                                                            </a>
                                                                        <?php
                                                                      }
                                                                       ?>
                                                                            

                                                                            <?php 
                                                                            if ($Val_Editar==5) {
                                                                                ?>
                                                                                <a href="Pedido-Ver.php?Solicitud=<?php echo($SolicitudSelect);?>&DeleteNote=1&NoteDel=<?php Echo($Id_Timeline);?>&PedidoCliente=<?php echo($PedidoGet);?>">
                                                                                <i class="ace-icon fa fa-trash-o red bigger-125"></i>
                                                                            </a>
                                                                            <?php
                                                                            }
                                                                             ?>

                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <?php 

              if ($EditNote==1 & $IdUser==$UsuarioComentario) {
                ?>

                  <form  action="Produccion-UpdateComentarioCl.php?Solicitud=<?php Echo($SolicitudSelect); ?>" method="post">
                        <div class="widget-body">
                  
                          <div class="widget-main">
                            <div>

                        <textarea  name="EditMiNota" class="form-control" id="form-field-8" placeholder="Indicar observaciones acerca de la actividad asignada"><?php Echo ($InfoTimeline); ?></textarea>
                        <input style="display: none;" type="text" name="IdTimeline" value="<?php Echo($Id_Timeline); ?>">
                          <input style="display: none;" type="text" name="IdTareaSel" value="<?php Echo($SolicitudSelect); ?>">
                          <input style="display: none;" type="text" name="PedidoCliente" value="<?php Echo($PedidoGet); ?>">

                            </div>
                            <div>
                            </div>
                            
                          </div>
                          <button type="submit" class="btn btn-sm btn-success">
                          <i class="ace-icon fa fa-check"></i>
                          Actualizar Comentario
                        </button>
                    
                        </div>
                  </form>
              <?php
              }
               ?>
                
                            
                                
                                            
                                    
                                                        </div>
                                                    </div>

                                                </div><!-- /.timeline-items -->
                                            </div><!-- /.timeline-container -->
                                        </div>

                                    </div>
                                </div>
                              <?php 
                            }
                          }

                               ?>
                                    </div>
                                </div>
                                <!--second tab-->
                                <?php 


                                 ?>
                                <div class="tab-pane" id="profile" role="tabpanel">

                                    <div class="card-body" id="DetalleOrden">

                                        <div class="row">
                                            <div class="col-md-12 col-xs-12"> 
                                              <strong>Ref. <?php Echo($Cod_Referencia."-".$Nom_Talla); ?> <br> Solicitud SCL<?php Echo($SolicitudSelect); ?> para pedido PDC<?php Echo($PedidoCliente); ?> </strong>
                      <button onclick="printDiv('DetalleOrden')" class="btn-sm btn-white"><i class="fa fa-print"></i></button>
                                                <br>
                                                <hr>
      <?php 
      // Consulta Usuario y Observación
$sql ="SELECT Observa_Cliente,Fecha_Observacion, Observa_Id_Usuario, B.Nombres, B.Apellidos from t_temporal_sol as A, t_usuarios as B WHERE Id_Temporal_Sol='".$SolicitudSelect."' and A.Observa_Id_Usuario=B.Id_Usuario";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$DetalleOrdenSel=$row['Observa_Cliente'];
$NombresObserva=$row['Nombres'];
$ApellidosObserva=$row['Apellidos'];
$Fecha_UltimaObservacion=$row['Fecha_Observacion'];
$IdUserActualiza=$row['Observa_Id_Usuario'];

 }
}
// Fin de la consulta 
       ?>
                                <p class="text-muted"><strong>Observaciones: </strong><?php Echo ($DetalleOrdenSel); ?></p>
                                  <?php 
                                if ($IdRol==1) {
                                   ?>
                                    <button id="BtnTendencias" class="btn btn-sm btn-white"><i class="fa fa-pencil"></i></button>
                                   <?php
                                }
                                 ?>
                                  <button style="display: none;" id="BtnOcultar" class="btn btn-sm btn-white"><i class="fa fa-close"></i></button>

                                                  <script type="text/javascript">
      $(document).ready(function(){
    $("#BtnTendencias").on( "click", function() {
      $('#EditarObservacion').show(); //muestro mediante id
      $('#BtnOcultar').show(); //muestro mediante id
     });
    $("#BtnOcultar").on( "click", function() {
      $('#EditarObservacion').hide(); //oculto mediante id
      $('#BtnOcultar').hide(); //oculto mediante id
    });
  });
    </script>


   


  <form style="display: none;" id="EditarObservacion"  action="ActualizarObservacion.php" method="post">
  <h5><?php Echo($Referencia_Id_Referencia."-".$Nom_Talla."   ")  ?> <button type="submit" class="btn btn-success btn-xs" data-rel="tooltip" data-placement="top" title="Actualizar Observación"><i class="fa fa-refresh"></i></button></h5> 
  <input style="display: none;" type="text" name="TxtSolicitud" value="<?php Echo($SolicitudSelect)?>">
  <input style="display: none;"  type="text" name="TxtPedido" value="<?php Echo($PedidoCliente)?>">
  <input style="display: none;" type="text" name="TxtUsuarioObserva" value="<?php Echo($IdUserActualiza)?>">

                                                     <textarea class="autosize-transition form-control" name="TxtDetalle" id="form-field-9" rows="3" maxlength="2000"><?php Echo($Observa_Cliente) ?></textarea>
                                                    </form>
    <p>Última Actualización: <?php Echo($Fecha_UltimaObservacion); ?> realizada por <?php Echo($NombresObserva." ".$ApellidosObserva); ?></p>
     <h3>Cliente <?php Echo utf8_decode($Nom_Cliente." ".$Ape_Cliente) ?></h3> 
                                            </div>
                                        </div>
                                        <hr>
                                  <h3 style="display: none;">Cliente <?php Echo utf8_decode($Nom_Cliente." ".$Ape_Cliente) ?></h3>  
                <div style="display: none;" class="table-responsive">  
                      <div class="col-lg-12 col-xlg-12 col-md-12" style="border: dotted 1px black;padding: 8px;">
                
                <?php 
                 $sql ="SELECT Id_Cliente, Documento_Cliente,Avatar_Cliente, Nom_Cliente, Ape_Cliente, Ciudad_Id_Ciudad, Correo_Cliente, Tel_Cliente, Cel1_Cliente, Cel2_Cliente, Tipo_Cliente,Largo_Manga, Largo_Camisa, Espalda, Pecho, Abdomen, Contorno_Cuello, Cintura, Cadera, Tiro, Pierna, Rodilla, Pantorrilla, Bota, Largo_Pantalon from t_clientes  WHERE  Documento_Cliente='".$Documento_Cliente."'"; 


      
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Id_Cliente=$row['Id_Cliente'];
        $Documento_Cliente=$row['Documento_Cliente'];
        $Avatar_Cliente=$row['Avatar_Cliente'];
         $Nom_Cliente=$row['Nom_Cliente'];
        $Ape_Cliente=$row['Ape_Cliente'];
        $Correo_Cliente=$row['Correo_Cliente'];
        $Cel1_Cliente=$row['Cel1_Cliente'];
        $Cel2_Cliente=$row['Cel2_Cliente'];

         $Largo_Manga=$row['Largo_Manga'];
          $Largo_Camisa=$row['Largo_Camisa'];
           $Espalda=$row['Espalda'];
            $Pecho=$row['Pecho'];
             $Abdomen=$row['Abdomen'];
              $Contorno_Cuello=$row['Contorno_Cuello'];
               $Cintura=$row['Cintura'];
                $Cadera=$row['Cadera'];
                 $Tiro=$row['Tiro'];
                  $Pierna=$row['Pierna'];
                   $Rodilla=$row['Rodilla'];
                    $Pantorrilla=$row['Pantorrilla'];
                     $Bota=$row['Bota'];
                      $Largo_Pantalon=$row['Largo_Pantalon'];
                    }
                  }
                 ?>
                      <div style="display: none;" class="col-lg-12 col-xlg-12 col-md-12" >
                         <center class="m-t-30"> <img src="../Administrator/images/Rotate/Superior.jpg" class="img-circle" width="50" />
                                    <h4 class="card-title m-t-10">Outfit Superior</h4>
                        <table style="display: none;">
                          <tr>
                            <td style="width: 50%">Largo Manga</td>
    <td><input type="number" class="col-xs-6" name="TxtLargoManga" step="any" value="<?php Echo($Largo_Manga)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Largo Camisa</td>
    <td><input type="number" class="col-xs-6" name="TxtLargoCamisa" step="any" value="<?php Echo($Largo_Camisa)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Espalda</td>
    <td><input type="number" class="col-xs-6" name="TxtEspalda" step="any" value="<?php Echo($Espalda)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Pecho</td>
    <td><input type="number" class="col-xs-6" name="TxtPecho" step="any" value="<?php Echo($Pecho)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Abdomen</td>
    <td><input type="number" class="col-xs-6" name="TxtAbdomen" step="any" value="<?php Echo($Abdomen)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Contorno Cuello</td>
    <td><input type="number" class="col-xs-6" name="TxtContornoCuello" step="any" value="<?php Echo($Contorno_Cuello)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Cintura</td>
    <td><input type="number" class="col-xs-6" name="TxtCintura" step="any" value="<?php Echo($Cintura)?>">&nbsp;Cm.</td>
                          </tr>
                        </table>
                      </div>
                       <div class="col-lg-12 col-xlg-12 col-md-12" >
                         <center class="m-t-30"> <img src="../Administrator/images/Rotate/Inferior.jpg" class="img-circle" width="50" />
                                    <h4 class="card-title m-t-10">Outfit Inferior</h4>
                        <table>
                          <tr>
                            <td style="width: 50%">Cadera</td>
    <td><input type="number" class="col-xs-6" name="TxtCadera" step="any" value="<?php Echo($Cadera)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Tiro</td>
    <td><input type="number" class="col-xs-6" name="TxtTiro" step="any" value="<?php Echo($Tiro)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Pierna</td>
    <td><input type="number" class="col-xs-6" name="TxtPierna" step="any" value="<?php Echo($Pierna)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Rodilla</td>
    <td><input type="number" class="col-xs-6" name="TxtRodilla" step="any" value="<?php Echo($Rodilla)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Pantorrilla</td>
    <td><input type="number" class="col-xs-6" name="TxtPantorrilla" step="any" value="<?php Echo($Pantorrilla)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Bota</td>
    <td><input type="number" class="col-xs-6" name="TxtBota" step="any" value="<?php Echo($Bota)?>">&nbsp;Cm.</td>
                          </tr>
                           <tr>
                            <td style="width: 50%">Largo Pantalón</td>
    <td><input type="number" class="col-xs-6" name="TxtLargoPantalon" step="any" value="<?php Echo($Largo_Pantalon)?>">&nbsp;Cm.</td>
                          </tr>
                        </table>
                      </div>
                    </div>
       </div>
                                        
                                    </div>
                                </div>
                                <div class="tab-pane" id="settings" role="tabpanel">
                                    <div class="card-body">
                                       <h5>Valor de la Prenda <?php Echo(formatomoneda($Valor_Prenda)); ?></h5>
                                    </div>
                                    <hr>
                                     <div id="CodigoBarras">
                                      <form action="ActualizarValoresPedido.php" method="post">

                            
                            <input style="display: none;" type="text" name="TxtSolicitud" value="<?php Echo($SolicitudSelect)?>" >
                            <input style="display: none;" type="text" name="TxtPedido" value="<?php Echo($PedidoCliente)?>" >
                            <input style="display: none;" type="number" name="TxtValorPrenda" value="<?php Echo($Valor_Prenda)?>" >

                            <label>
                              Actualizar Costo de la Referencia
                            </label>
                           <div class="form-group">

                              <div>
                          <input value="<?php Echo($Valor_Final) ?>" class="input-sm" type="text" id="demo9"  name="demo9"  required="true" />
                                </div>
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
                                
                              </div>
                              <small>El valor actualizado solo aplica para la orden de corte Seleccionada</small>
                            <hr>
                           
                             <div class="card-body">
                                       <h5>Valor Final <?php Echo(formatomoneda($Valor_Final)); ?></h5>
                                    </div>
                                    <hr>

                       <label>
                              Valores Adicionales
                            </label>
                            <div class="form-group">

                              <div>
                          <input disabled="true" class="input-sm" type="text" id="demo8"  name="demo822" value="<?php Echo(formatomoneda($Valor_Adicional)) ?>" required="true" />
                                </div>
                               <script type="text/javascript">     
$("#demo8").maskMoney({
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
                                
                              </div>
                             <hr>

                              <label>
                              Descuentos
                            </label>
                            <div class="form-group">

                              <div>
                          <input disabled="true" class="input-sm" type="text" id="demo8"  name="demo822" value="<?php Echo(formatomoneda($Valor_Descuento)) ?>" required="true" />
                                </div>
                               <script type="text/javascript">     
$("#demo8").maskMoney({
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
                                
                              </div>
                             <hr>


                        <button type="submit" class="btn btn-xlarge btn-white"><i class="fa fa-refresh red">  </i> Actualizar Valores</button>
                                     
                                      </form>
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
				
					<!-- <div class="col-sm-12 col-xs-12">
						
								<div id="grafica" style="width: 100%; height: 450px;">
									
								</div>
								 
					</div> -->
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
  
		<!--    <script src="dist/js/demo.js"></script> -->
    <script src="https://modasof.com/espejo/assets/js/jquery.magnific-popup.js"></script>
    <script src="https://modasof.com/espejo/assets/js/jquery.magnific-popup.min.js"></script>

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
