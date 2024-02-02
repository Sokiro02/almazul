<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];
include("Lib/permisos.php");


date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');

$RefSel=$_GET['RefSel'];
$sql ="SELECT date_format(Fecha_Creacion,CONCAT(CONCAT(ELT(WEEKDAY(Fecha_Creacion) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(Fecha_Creacion), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS CreadaFecha,Id_Referencia, Cod_Referencia, Img_Referencia, Fecha_Creacion,Estado_Ref, Costo_Proyectado_Pref, V_Mano_Obra_Ref, PVP_Ref, P_Mayor, Detalle_Referencia,Ref_Publicada,Coleccion_Nom_Coleccion,Insumo_Ppal  FROM t_referencias WHERE Cod_Referencia='".$RefSel."' order by Fecha_Creacion ASC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$Id_Referencia=$row['Id_Referencia'];
$Cod_Referencia=$row['Cod_Referencia'];
$Img_Referencia=$row['Img_Referencia'];
$Fecha_Creacion=$row['Fecha_Creacion'];
$Coleccion_Nom_Coleccion=$row['Coleccion_Nom_Coleccion'];
$CreadaFecha=$row['CreadaFecha'];
$Estado_Ref=$row['Estado_Ref'];
$Costo_Proyectado_Pref=$row['Costo_Proyectado_Pref'];
$PVP_Ref=$row['PVP_Ref'];
$P_Mayor=$row['P_Mayor'];
$P_Mayor=$row['P_Mayor'];
$Insumo_Ppal=$row['Insumo_Ppal'];
$Detalle_Referencia=$row['Detalle_Referencia'];
$Operacion1=((int)$Costo_Proyectado_Pref/(int) $PVP_Ref);
$Operacion2=(1-$Operacion1);
$Operacion3=$Operacion2*100;
$UtilidadBruta=$Operacion3;
 }
}

$Delete=$_GET['Delete'];

if ($Delete!="") {
  $RefSel=$_GET['RefSel'];
  // Eliminar la Solicitud
  $sql="DELETE FROM t_solicitudes_prod WHERE Cod_Solicitud_Prod='".$Delete."'";
  $result=$conexion->query($sql);
  // Eliminar Movimientos en Insumos
  $sql="DELETE FROM t_mov_insumos WHERE Solicitud_Id_Solicitud='".$Delete."'";
  $result=$conexion->query($sql);
  //Eliminar Comentario Inicial
  $sql="DELETE FROM t_comentarios_produccion WHERE Solicitud_Cod_Orden='".$Delete."'";
  $result=$conexion->query($sql);

  // Retornar Página
  header("location:Produccion-Solicitud.php?Mensaje=2&RefSel=".$RefSel."");

}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Disponibilidad Modasof</title>

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

		<!-- ace styles -->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/ace-rtl.min.css" />

		 <!-- chartist CSS -->
    <link href="https://modasof.com/espejo/assets/Ecommerce/css/pages/ecommerce.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../assets1/Ecommerce/css/style.min.css" rel="stylesheet">
     <!-- Custom CSS -->
    <link rel="stylesheet" href="https://modasof.com/espejo/assets/css/AdminLTE.css">
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
   
    <script>
$(document).ready(function(){
   $("#TxtBodega").change(function () {
           $("#TxtBodega option:selected").each(function () {
            Select1 = $(this).val();
           // var Select2 = $("#TxtSubCategoria option:selected").val();
            //var Select3 = $("#TxtInsumoSel option:selected").val();
            //alert(Select1)
            $.post("DisponBodega.php?ReferenciaAjax=<?php Echo($RefSel);?>&InsumoP=<?php Echo($Insumo_Ppal);?>", { Select1: Select1}, function(data){
                $("#TxtCantidad").html(data); 
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

	</head>

	<body class="skin-1">

	<?php 
  $Valide=$_GET['Mensaje'];

    if ($Valide==21) {
        echo "<script>jQuery(function(){swal(\"¡Lo Sentimos!\", \"Datos Incorrectos\", \"error\");});</script>";
    };
     if ($Valide==11) {
        echo "<script>jQuery(function(){swal(\"¡ Notificación Realizada!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==1) {
        echo "<script>jQuery(function(){swal(\"¡ Pedido  Agregado!\", \"Correctamente \", \"success\");});</script>";
    };
     if ($Valide==2) {
        echo "<script>jQuery(function(){swal(\"¡ Orden  Eliminada!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==23) {
        echo "<script>jQuery(function(){swal(\"¡ Extra Cargada a Cliente!\", \"".$ClienteSel." \", \"success\");});</script>";
    };
   ?>
 <?php 

if (isset($_GET['DeleteInsumo'])) {
   $DeleteInsumo=$_GET['DeleteInsumo'];

    if ($DeleteInsumo!="") {
      ?>
      <script>jQuery(function(){
      swal({
  title: "¿Desea Agregar más productos o agregar anticipo?",
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
    window.location.href = 'Lista-Referencias.php?Confirmation=<?php Echo($DeleteInsumo); ?>';
  } else {
    window.location.href = 'Lista-Referencias.php';
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
	//include("Lib/links.php");
	//include("Lib/menuleft.php");
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
								<a href="Vista-Referencias.php">Regresar a Galeria</a>
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
			<!-- <div class="form-group col-sm-3" >
	<form>

  <div  >
     <input type="text" class="busca nav-search-input input-xlarge"   id="caja_busqueda nav-search-input" name="clave" placeholder="Buscar Referencia por palabra clave"/>
     <br />
  </div>       
</form>
		

	</div> -->

<div class="col-sm-12 col-xs-12"><!-- Inicio Panel Inferior-->

  <?php 
  $OrdenCorte=$_GET['OrdenCorte'];
  if ($OrdenCorte!="") {
   ?>
   <!-- Inicio Modal -->
    <div>
              <form action="Proveedor-CrearProveedor.php" method="post" id="FormNuevoProveedor">
                  <div class="modal-dialog ">
                    <div class="modal-content">
                      <div class="modal-header">
                        <a href="Producto-Disponibilidad.php?RefSel=<?php Echo($RefSel); ?>" type="button" class="close" data-dismiss="modal">&times;</a>
                        <h4 class="black bigger">Solicitar a Producción</h4>
                      </div>

                      <div class="modal-body">
                        <div class="row">
                         

                      <div class="col-xs-12 col-sm-6 ">
                          <div class="form-group">
                              <label for="form-field-select-3">Seleccionar Taller</label>

                              <div>
                    <select class="chosen-select input-xxlarge" id="TxtBodega" name="TxtBodega" data-placeholder="Seleccionar...">
                      <option value="">Seleccionar...</option>
                           <?php 
$sql ="SELECT Id_Bodega, Nom_Bodega FROM t_bodegas order by Nom_Bodega ASC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $SelectId_Bodega=$row['Id_Bodega'];
      $SelectNom_Bodega=$row['Nom_Bodega'];             
      echo ("<option value='".$SelectId_Bodega."'>".utf8_decode($SelectNom_Bodega)."</option>");
 }
}
                                     ?>
                                  
                        </select>
                              </div>
                            
                            </div>
                            <div  class="form-group" id="TxtCantidad">
                              
                            </div> 
                            <div class="form-group">
                              <label for="form-field-select-3">Seleccionar Talla</label>

                              <div>
                    <select class="chosen-select input-xxlarge" id="TxtBodega" name="TxtBodega" data-placeholder="Seleccionar...">
                     <option value="">Seleccionar...</option>
                                    <?php 
$sql ="SELECT Id_Talla, Nom_Talla FROM t_tallas order by Nom_Talla ASC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $SelectId_Talla=$row['Id_Talla'];
      $SelectNom_Talla=$row['Nom_Talla'];             
      echo ("<option value='".$SelectId_Talla."'>".utf8_encode($SelectNom_Talla)."</option>");
 }
}
                                     ?>
                        </select>
                              </div>
                            
                            </div>

                            <div class="form-group">
                              <label for="form-field-select-3">Seleccionar Tienda</label>

                              <div>
                    <select class="chosen-select input-xxlarge" id="TxtBodega" name="TxtBodega" data-placeholder="Seleccionar...">
                      <option value="">Seleccionar ...</option>
                                    <?php 
$sql ="SELECT Id_Tienda, Nom_Tienda FROM t_tiendas order by Nom_Tienda ASC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $SelectId_Tienda=$row['Id_Tienda'];
      $SelectNom_Tienda=$row['Nom_Tienda'];             
      echo ("<option value='".$SelectId_Tienda."'>".utf8_encode($SelectNom_Tienda)."</option>");
 }
}
                                     ?>
                        </select>
                              </div>
                            
                            </div>

                          </div>
                        </div>
                      </div>

                      <div class="modal-footer">
                       
                        <button type="submit" class="btn btn-sm btn-success">
                          <i class="ace-icon fa fa-check"></i>
                          Agregar Orden de Corte Cliente
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
                </div><!-- PAGE CONTENT ENDS -->
            <!-- FINAL MODAL -->
<?php 
  }
 ?>
 <!-- Info box Content -->
                <!-- ============================================================== -->
                <div class="row" >
                	 <!-- Column -->
                    <div class="col-lg-12">

       
                      <!-- Inicio Modal -->
  <form method="post" action="Llamada-Guardar.php?RefSel=<?php Echo($RefSel); ?>" id="FormLlamada" >
    <div id="modal-form2" class="modal" tabindex="-1">
              <div class="modal-dialog ">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="black bigger"><i class="fa fa-bell"> Notificación a Tienda</i></h4>
                      </div>

                      <div class="modal-body">
                        <!-- <div class="row col-xs-12 col-sm-12"> -->
                        
            <div class="row">

                  <div class="form-group">
                              <label for="form-field-select-3">Origen del Cliente</label>

                              <div>
                    <select class="input-xxlarge" id="TxtCanal" name="TxtCanal" data-placeholder="Seleccionar...">
                      <option value="">Seleccionar ...</option>
                      <option value="Instagram">Instagram</option>
                      <option value="Whatsapp">Whatsapp</option>
                      <option value="Facebook">Facebook</option>
                      <option value="Nuevo Cliente">Nuevo Cliente</option>
                      <option value="Cliente Referido">Cliente Referido</option>
                      <option value="Cliente Modasof">Cliente Modasof</option>
                      <option value="Otro">Otro</option>
                        </select>
                              </div>
                            
                            </div>
                       <div class="form-group">
                              <label for="form-field-select-3">Notificar Llamada a</label>

                              <div>
                    <select class="input-xxlarge" id="TxtTienda" name="TxtTienda" data-placeholder="Seleccionar...">
                      <option value="">Seleccionar Tienda</option>
                                    <?php 
$sql ="SELECT Id_Tienda, Nom_Tienda FROM t_tiendas order by Nom_Tienda ASC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $SelectId_Tienda=$row['Id_Tienda'];
      $SelectNom_Tienda=$row['Nom_Tienda'];             
      echo ("<option value='".$SelectId_Tienda."'>".utf8_encode($SelectNom_Tienda)."</option>");
 }
}
                                     ?>
                        </select>
                              </div>
                            
                            </div>
                    <div class="form-group">
                      <input style="display: none;" type="text" name="TxtRefSel" value="<?php Echo($RefSel);?>">
                    </div>
                    <div class="form-group">
                      <input class="input-xxlarge" type="text" name="TxtNombreCliente"  placeholder="Nombre Cliente">
                    </div>
                    <div class="form-group">
                      <input class="input-xxlarge" type="text" name="TxtCelularCliente"  placeholder="Celular de Contacto">
                    </div>
                     <div class="form-group">
                       <textarea class="autosize-transition form-control" placeholder="Agregar Observación" name="TxtObserva" id="form-field-9" rows="3" maxlength="2000">Ref:<?php Echo($RefSel); ?></textarea>
                    </div>

                </div>
            </div>
                        <!-- </div> -->
                      <div class="modal-footer">
                        <button class="btn btn-sm btn-danger" type="submit">
                          <i class="ace-icon fa fa-times"></i>
                          Enviar
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                </form>
              </div>    
      </div>
                  
            <!-- FINAL MODAL -->

          <!-- Inicio Modal -->
  <form method="post" action="Llamada-Guardar.php?RefSel=<?php Echo($RefSel); ?>" id="FormLlamada" >
    <div id="modal-form3" class="modal" tabindex="-1">
              <div class="modal-dialog ">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="black bigger"><i class="fa fa-exchange"> Solicitud de Traslado Ref. <?php Echo($RefSel) ?> </i></h4>
                      </div>

                      <div class="modal-body">
                        <!-- <div class="row col-xs-12 col-sm-12"> -->
                        
            <div class="row">

                 
                       <div class="form-group">
                              <label for="form-field-select-3">Solicitar a:</label>

                              <div>
                    <select class="input-xxlarge" id="TxtTienda" name="TxtTienda" data-placeholder="Seleccionar...">
                      <option value="">Seleccionar Tienda</option>
                                    <?php 
$sql ="SELECT Id_Tienda, Nom_Tienda FROM t_tiendas order by Nom_Tienda ASC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $SelectId_Tienda=$row['Id_Tienda'];
      $SelectNom_Tienda=$row['Nom_Tienda'];             
      echo ("<option value='".$SelectId_Tienda."'>".utf8_encode($SelectNom_Tienda)."</option>");
 }
}
                                     ?>
                        </select>
                              </div>
                            
                            </div>

                   

                     <div class="form-group">
                              <label for="form-field-select-3">Seleccionar Talla:</label>

                              <div>
                    <select class="input-xxlarge" id="TxtTienda" name="TxtTienda" data-placeholder="Seleccionar...">
                      <option value="">Seleccionar Talla...</option>
                                    <?php 
$sql ="SELECT Id_Talla, Nom_Talla FROM t_tallas order by Nom_Talla ASC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $SelectId_Talla=$row['Id_Talla'];
      $SelectNom_Talla=$row['Nom_Talla'];             
      echo ("<option value='".$SelectId_Talla."'>".utf8_encode($SelectNom_Talla)."</option>");
 }
}
                                     ?>
                        </select>
                              </div>
                            
                            </div>

                             <div class="form-group">
                              <label for="form-field-select-3">Enviar a:</label>

                              <div>
                    <select class="input-xxlarge" id="TxtTienda" name="TxtTienda" data-placeholder="Seleccionar...">
                      <option value="">Seleccionar Tienda</option>
                                    <?php 
$sql ="SELECT Id_Tienda, Nom_Tienda FROM t_tiendas order by Nom_Tienda ASC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $SelectId_Tienda=$row['Id_Tienda'];
      $SelectNom_Tienda=$row['Nom_Tienda'];             
      echo ("<option value='".$SelectId_Tienda."'>".utf8_encode($SelectNom_Tienda)."</option>");
 }
}
                                     ?>
                        </select>
                              </div>
                            
                            </div>

                    <div class="form-group">
                      <input style="display: none;" type="text" name="TxtRefSel" value="<?php Echo($RefSel);?>">
                    </div>
                   
                     <div class="form-group">
                       <textarea class="autosize-transition form-control" placeholder="Agregar Observación" name="TxtObserva" id="form-field-9" rows="3" maxlength="2000">Ref:<?php Echo($RefSel); ?></textarea>
                    </div>

                </div>
            </div>
                        <!-- </div> -->
                      <div class="modal-footer">
                        <button class="btn btn-sm btn-danger" type="submit">
                          <i class="ace-icon fa fa-times"></i>
                          Enviar
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                </form>
              </div>    
      </div>
                  
            <!-- FINAL MODAL -->





                        <div class="card">
                            <div class="card-body">
                               
                                <h6 class="card-subtitle">Colección: <?php Echo($Coleccion_Nom_Coleccion); ?></h6>
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-6">
                                        <div class="white-box text-center">
                                        <!--  <img src="<?php Echo($Img_Referencia); ?>" class="img-responsive"> 
 -->
                                         <?php
                            $ruta_img = utf8_encode($Img_Referencia);
                                                        $mostrar_img = "miniatura.php?x=150&y=150&file=".$ruta_img;
                            ?>
                          <img src="<?php echo $mostrar_img; ?>" width="200px" height="200px">
                                        </div>
                                        <h4>P.V.P <?php Echo(Formatomoneda($PVP_Ref)); ?></h4>
                                      

                                     
                                    </div>

                                    <div class="col-lg-10 col-md-10 col-sm-6">
                                      <h3 class="m-t-40">Disponibilidad Ref. <?php Echo($RefSel); ?></h3>
     <?php 

  $sql="SELECT Id_Tienda FROM t_tiendas Where Estado_Tienda='1'";
  $result=$conexion->query($sql);
  if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc ()) {
      $ListaTiendas=$ListaTiendas.$row['Id_Tienda'].",";                  
 }
}
$CadenaTiendas=explode(",", $ListaTiendas);
//Split al Arreglo
$longitud = count($CadenaTiendas);
$min=$longitud-1;
//Recorro todos los elementos
//for($i=0; $i<$min; $i++)
//{
 ?>

 <?php 

 for($i=0; $i<$min; $i++)
{

  $sql="SELECT Nom_Tienda,Dir_Tienda,Nom_Ciudad FROM t_tiendas as A, t_ciudades as B WHERE A.Ciudad_Id_Ciudad=B.Id_Ciudad and Id_Tienda='".$CadenaTiendas[$i]."'";
  $result=$conexion->query($sql);
  if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc ()) {
      $Nom_Tienda=$row['Nom_Tienda'];  
      $Dir_Tienda=$row['Dir_Tienda'];  
      $Nom_Ciudad=$row['Nom_Ciudad'];                  
 }
}

  ?>
                                     <div class="col-md-6">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-black">
              <div class="widget-user-image">
                <img class="img-circle" src="../Administrator/Images/Logos/logo-tiendas.jpg" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username"><?php Echo($Nom_Tienda) ?></h3>
              <h5 class="widget-user-desc">Ref.<?php Echo($RefSel); ?></h5>
            </div>
            <div class="box-footer no-padding">

 <table>
                <tr>
                  <ul class="nav nav-stacked">
                <li><a href="#">
                  Disponible en Tienda<span class="pull-right badge bg-green">
                    
                     <?php 
              $sql="SELECT  IFNULL(sum(Cantidad),0) as TotalporTalla FROM t_inventario WHERE Referencia='".$RefSel."'  And Id_Tienda='".$CadenaTiendas[$i]."'";
             // Echo($sql);
  $result=$conexion->query($sql);
  if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc ()) {
      $SaldoRef=$row['TotalporTalla'];           
 }
}


Echo($SaldoRef." Und.");       
               ?>
                  </span>
                </a>
              </li>
            </ul>
                </tr>

                <tr>
        <?php 
            $sql="SELECT  Referencia_Completa,A.Id_Talla,Nom_Talla FROM t_inventario as A, t_tallas as B WHERE Referencia='".$RefSel."' and  Id_Tienda='".$CadenaTiendas[$i]."' and A.Id_Talla=B.Id_Talla  GROUP BY Id_Talla";
           //Echo($sql);
  $result=$conexion->query($sql);
  if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc ()) {
     $TallaId=$row['Id_Talla'];
      $Nom_Talla=$row['Nom_Talla'];
      $ReferenciaCompleta=$row['Referencia_Completa'];
      

      $TallaDisponible=ArqueoInventarioTalla($ReferenciaCompleta,$TallaId,$CadenaTiendas[$i]);                 
            if ($TallaDisponible==0) {
              ?>
                 <th style="border: dotted 1px; width: 5%;" class="center" ></th>
              <?php
            }
         else 
         {


             ?>
                  <th style="border: dotted 1px; width: 5%;" class="center" ><?php Echo($Nom_Talla); ?></th>
          <?php 
          }
        }
      }
      else
      {
        ?>
               <th style="border: dotted 1px; width: 5%;" class="center" >Disponibles en Tienda</th>
        <?php
      }
           ?>
                </tr>
               <tr>

                 <?php 
            $sql="SELECT  Referencia_Completa,A.Id_Talla,Nom_Talla FROM t_inventario as A, t_tallas as B WHERE Referencia='".$RefSel."' and  Id_Tienda='".$CadenaTiendas[$i]."' and A.Id_Talla=B.Id_Talla  GROUP BY Id_Talla";
            //Echo($sql);
  $result=$conexion->query($sql);
  if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc ()) {

      $TallaId=$row['Id_Talla'];
      $Nom_Talla=$row['Nom_Talla'];
      $ReferenciaCompleta=$row['Referencia_Completa'];
      

      $TallaDisponible=ArqueoInventarioTalla($ReferenciaCompleta,$TallaId,$CadenaTiendas[$i]);              
            if ($TallaDisponible==0) {
              ?>
                 <td style="border: dotted 1px; width: 5%;font-size: 14px;" class="center" ></td>
              <?php
            }
            else{

            ?> 
                  <td style="border: dotted 1px; width: 5%;font-size: 14px;" class="center" ><?php Echo($TallaDisponible); ?></td>
            <?php 
            }
        }
      }
      else
      {
        ?>
               <td style="border: dotted 1px; width: 5%;font-size: 14px;" class="center" >0 Unidades</td>
        <?php
      }
           ?>   
      
                </tr>
              </table>
             

           

               <table>
                <tr>
                   <ul class="nav nav-stacked">
                <li><a href="#">
                  En Producción<span class="pull-right badge bg-blue">

              <?php 
              $sql="SELECT  IFNULL(sum(Cant_Solicitada),0) as TotalProduccion FROM t_solicitudes_prod as A WHERE Referencia_Id_Referencia='".$RefSel."' and Estado_Solicitud_Prod<>'10' And Tienda_Id_Tienda='".$CadenaTiendas[$i]."'";
  $result=$conexion->query($sql);
  if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc ()) {
      $TotalProduccion=$row['TotalProduccion'];  
        Echo($TotalProduccion." Und.");                
 }
}
               ?>
                  

                </span>
                </a>
              </li>
            </ul>
                </tr>
                <tr>
        <?php 
            $sql="SELECT  IFNULL(sum(Cant_Solicitada),0) as TotalporTalla,B.Nom_Talla FROM t_solicitudes_prod as A, t_tallas as B WHERE Referencia_Id_Referencia='".$RefSel."'  and A.Talla_Solicitada=B.Id_Talla  And Tienda_Id_Tienda='".$CadenaTiendas[$i]."' and Estado_Solicitud_Prod<>'10' GROUP BY Talla_Solicitada";
           // Echo($sql);
  $result=$conexion->query($sql);
  if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc ()) {
      $TotalporTalla=$row['TotalporTalla'];  
      $Nom_Talla=$row['Nom_Talla'];                   

             ?>
                  <th style="border: dotted 1px; width: 5%;" class="center" ><?php Echo($Nom_Talla); ?></th>
          <?php 
        }
      }
      else
      {
        ?>
               <th style="border: dotted 1px; width: 5%;" class="center" >Disponibles en Taller</th>
        <?php
      }
           ?>
                </tr>
               <tr>
       <?php 
            $sql="SELECT  SUM(Cant_Solicitada) as TotalporTalla,B.Nom_Talla FROM t_solicitudes_prod as A, t_tallas as B WHERE Referencia_Id_Referencia='".$RefSel."'  and A.Talla_Solicitada=B.Id_Talla  And Tienda_Id_Tienda='".$CadenaTiendas[$i]."' and Estado_Solicitud_Prod<>'10' GROUP BY Talla_Solicitada";
            //Echo($sql);
  $result=$conexion->query($sql);
  if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc ()) {
      $TotalporTalla=$row['TotalporTalla'];  
      $Nom_Talla=$row['Nom_Talla'];                   

             ?>           
                  <td style="border: dotted 1px; width: 5%;font-size: 14px;" class="center" ><?php Echo($TotalporTalla); ?></td>
              <?php 
        }
      }
      else
      {
        ?>
               <td style="border: dotted 1px; width: 5%;font-size: 14px;" class="center" >0 Unidades</td>
        <?php
      }
           ?>     
                </tr>
              </table>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
<?php 
}
 ?>










  <?php 

  $sql="SELECT Id_Bodega FROM t_bodegas Where Id_Bodega='5'";
  $result=$conexion->query($sql);
  if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc ()) {
      $ListaBodegas=$ListaBodegas.$row['Id_Bodega'].",";                  
 }
}
$CadenaBodegas=explode(",", $ListaBodegas);
//Split al Arreglo
$longitud = count($CadenaBodegas);
$min=$longitud-1;
//Recorro todos los elementos
//for($i=0; $i<$min; $i++)
//{
 ?>

 <?php 

 for($i=0; $i<$min; $i++)
{

  $sql="SELECT Id_Bodega,Nom_Bodega,Dir_Bodega,Nom_Ciudad FROM t_bodegas as A, t_ciudades as B WHERE A.Ciudad_Id_Ciudad=B.Id_Ciudad and Id_Bodega='".$CadenaBodegas[$i]."'";
  $result=$conexion->query($sql);
  if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc ()) {
      $Nom_Bodega=$row['Nom_Bodega'];
       $Id_Bodega=$row['Id_Bodega'];  
      $Dir_Bodega=$row['Dir_Bodega'];  
      $Nom_Ciudad=$row['Nom_Ciudad'];                  
 }
}

  ?>
                                     <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-blue">
              <div class="widget-user-image">
                <img class="img-circle" src="../Administrator/Images/Logos/logo-tiendas.jpg" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username"><?php Echo($Nom_Bodega) ?></h3>
              <h5 class="widget-user-desc">Ref.<?php Echo($RefSel); ?></h5>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <?php 
                $VerTaller=DisponibilidadRefporTaller($RefSel,$Id_Bodega);
                if ($VerTaller<=0) {
                  Echo("<li> <span class='pull-right badge bg-green'>No hay disponibilidad de Insumos</span></li>");
                }
                else
                {

                 ?>
                <li><h4>Disponible para Producción:</h4><span class="pull-right badge bg-green"><?php Echo(DisponibilidadRefporTaller($RefSel,$Id_Bodega)); ?> Und.</span></li>
                <?php 
                }
                 ?>
                
              </ul>
             
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
<?php 
}
 ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->

        
                    
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->


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

	
		<script src="https://modasof.com/espejo/assets/js/jquery.validate.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery-additional-methods.min.js"></script>

		<script src="https://modasof.com/espejo/assets/js/dataTables.responsive.min.js"></script>
		
     <script type="text/javascript">
        $(document).ready(function()
        {
             $("#FormLlamada").validate({
              errorElement: 'div',
          errorClass: 'help-block',
          focusInvalid: true,
          ignore: "",
                 rules: {
                     "TxtCanal": { required:true },
                     "TxtTienda": { required:true },
                     "TxtNombreCliente": { required:true }, 
                     "TxtCelularCliente": { required:true }, 
                      
                 },
                
             });
        });
    </script>

     <script type="text/javascript">
        $(document).ready(function()
        {
             $("#FormSolicitud").validate({
             	errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
                 rules: {
                     "TxtBodega": { required:true },
                     "TxtCantidad": { required:true }, 
                     "TxtColor": { required:true }, 
                     "TxtCiudad": { required:true },
                     "TxtTalla": { required:true }, 
                     "TxtAlmacen": { required:true },       
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
	


	
	</body>
</html>
