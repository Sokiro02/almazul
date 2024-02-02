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
$FechaActual = date('Y-m-d');

$TxtConsultaVen=$MyIdTienda;

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Abonos Cartera</title>

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
    <script src="../https://modasof.com/espejo/assets/js/functions.js"></script>
    <!-- Sweet Alert Script -->
    <script src="https://modasof.com/espejo/assets/js/sweetalert.min.js"></script>
    <!--/Fin Alertas-->

     <!-- Inicio Libreria formato moneda -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
<script src="https://modasof.com/espejo/assets/js/jquery.maskMoney.js" type="text/javascript"></script>



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
     if ($Valide==333) {
        echo "<script>jQuery(function(){swal(\"¡ Abono Agregado!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==27) {
        echo "<script>jQuery(function(){swal(\" Informe ".utf8_encode($ConSeleccionado)."\", \"Taller Seleccionado\", \"success\");});</script>";
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
								<i class="ace-icon fa fa-users"></i>
								<a href="Cartera.php">Regresar</a>
							</li>
						</ul><!-- /.breadcrumb -->

						
					</div>

					<div class="page-content">
				<?php 
					//include("Lib/colors.php");
				?>
						<div class="row">
			<?php 
			$AbonosFactura=$_GET['AbonosCartera'];
			if ($AbonosFactura!="") {
			 ?>
							<div class="col-sm-7 col-xs-7 center">
				<?php 
				$sql ="SELECT B.Id_Cliente, B.Nom_Cliente,B.Ape_Cliente FROM t_cartera as A, t_clientes as B WHERE Id_Cartera='".$AbonosFactura."' and A.Cliente_Id_Cliente=B.Id_Cliente";
	//Echo($sql);
	$result = $conexion->query($sql);
	if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
	$Nom_Cliente=$row['Nom_Cliente'];
	$Ape_Cliente=$row['Ape_Cliente'];
  $Id_Cliente=$row['Id_Cliente'];

}
}

$sql ="SELECT Valor_Cartera FROM t_cartera WHERE Id_Cartera='".$AbonosFactura."'";
	//Echo($sql);
	$result = $conexion->query($sql);
	if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
	$Total_Factura=$row['Valor_Cartera'];
}
}

$sql ="SELECT IFNULL(sum(Valor_Ingreso),0) as TotalAbonos FROM t_ingresos WHERE Cartera_Id_Cartera='".$AbonosFactura."'";
	//Echo($sql);
	$result = $conexion->query($sql);
	if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
	$VrAbonos=$row['TotalAbonos'];                  
 }
}

				 ?>
								<h4>Abonos a Cartera de Cliente <?php Echo($Nom_Cliente." ".$Ape_Cliente); ?> <br>
									Registro Cartera Nº <?php Echo($AbonosFactura); ?><br>
								</h4>
							 <table class="table product-overview">
                                  <thead>
                                    <th class="info" >Recibo Caja Nº</th>
                                  <th class="info" >Fecha Ingreso</th>
                                  <th class="pull-rigth info"  >Medio de Pago</th>
                                  <th class="pull-rigth info"  >Voucher</th>
                                  <th class="pull-rigth info" >Valor</th>
                                  <th class="pull-rigth info" >Recibido por</th>
                                  <th class="pull-rigth info" ><i class="fa fa-file-pdf-o"></i></th>
                                  </thead>
                                  <tbody>
                               <?php 

$sql ="SELECT Id_Ingreso,date_format(Fecha_Ingreso,CONCAT(CONCAT(ELT(WEEKDAY(Fecha_Ingreso) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(Fecha_Ingreso), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS IngresoAbono,Valor_Ingreso, Medio_Pago,Num_Transaccion,Fecha_Ingreso, B.Nombres,B.Apellidos,C.Nom_MedioPago,A.Cod_Recibo_Caja FROM t_ingresos as A, t_usuarios as B,t_medios_pago as C WHERE Cartera_Id_Cartera='".$AbonosFactura."' and A.Ingreso_Id_Usuario=B.Id_Usuario and A.Medio_Pago=C.Id_Medio_Pago order by Id_Ingreso ASC";
	//Echo($sql);
	$result = $conexion->query($sql);
	if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
	
    $Id_Ingreso=$row['Id_Ingreso'];
	$Valor_Ingreso=$row['Valor_Ingreso'];
	$Medio_Pago=$row['Medio_Pago'];
  $Cod_Recibo_Caja=$row['Cod_Recibo_Caja'];
	$Num_Transaccion=$row['Num_Transaccion'];
	$IngresoAbono=$row['IngresoAbono'];
	$Nombres=$row['Nombres'];
	$Apellidos=$row['Apellidos'];
  $PagoEn=$row['Nom_MedioPago'];
                                ?>
                                  	<tr>
                                      <?php 
                                      if ($Cod_Recibo_Caja==0) {
                                        ?>
                                        <td>Sin Recibo</td>
                                        <?php
                                      }
                                      else
                                      {
                                       ?>
                                       <td><?php Echo($Cod_Recibo_Caja); ?></td>
                                       <?php
                                     }
                                      ?>
                                  		<td><?php Echo($IngresoAbono); ?></td>
                                  		<td><?php Echo($PagoEn); ?></td>
                                  		<td><?php Echo($Num_Transaccion); ?></td>
                                  		<td><?php Echo(formatomoneda($Valor_Ingreso)); ?></td>
                                  		<td><?php Echo($Nombres." ".$Apellidos); ?></td>
                                  		<td>
                                        <?php 
                                        if ($Cod_Recibo_Caja!=0) {
                                          
                                      
                                         ?>
                                        <a  data-rel="tooltip" data-placement="top" title="Imprimir Recibo" href="Pdf_ReciboCajaCartera.php?AbonoCliente=<?php Echo($Id_Ingreso) ?>&AbonosFactura=<?php Echo($AbonosFactura) ?>"><i class="fa fa-file-pdf-o bigger-110 red"></i></a>
                                        <?php 
                                      }
                                         ?>
                                      </td>
                                  	</tr>
                                  	<?php 
                                  }
                              }
                              else
                              {
                              	?>
                              	<tr>
                              		<td colspan="6"><strong>No hay abonos en esta Cartera</strong></td>
                              	</tr>
                              	<?php
                              }
                                  	 ?>
                                  	 <tr>
                                  	 	<td class="success" colspan="3"><strong>Total Cartera <?php Echo(formatomoneda($Total_Factura)); ?></strong></td>
                                  	 	<td class="success"><strong>Abonos:</strong></td>

                                  	 	<td class="success"><strong>
                                  	 		<?php Echo(formatomoneda($VrAbonos)) ;?></strong></td>
                                  	 	<td class="success" colspan="2">
                                  	 		<strong>
                                  	 		Saldo: <?php Echo(formatomoneda($Total_Factura-$VrAbonos)) ;?></strong>
                                  	 	</td>
                                  	 </tr>
                                  	 <tr>
                                      <?php 
                                      if ($IdRol==1) {
                                        ?>
                                          <td colspan="3">
                                     <a class="btn  btn-danger btn-xs" href="Informe-Cartera.php"><i class="fa fa-times bigger-110"> </i> Cerrar Vista</a>
                                      </td>
                                        <?php
                                      }
                                       ?>
                                    <?php 
                                    if ($IdRol==3) {
                                     ?>
                                     <td colspan="3">
                                    <a  data-toggle="modal" data-target="#modal-form2" href="#"><span class="btn  btn-success btn-xs"><i class="fa fa-plus-square"> </i> Agregar Abono</span></a>
                                      </td>
                                      <td colspan="3">
                                     <a class="btn  btn-danger btn-xs" href="Cartera.php"><i class="fa fa-times bigger-110"> </i> Cerrar Vista</a>
                                      </td>
                                     <?php
                                    }
                                     ?>
                                  	 	
                                  	 </tr>
                                  </tbody>
                         </table>
						</div>
			<?php } ?>
							<div class="col-xs-12 col-sm-12">
						

							<div class="space-7"></div>

<div class="col-sm-12 col-xs-12"><!-- Inicio Panel Inferior-->
<hr>



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
    
      <form action="Clientes-GuardarAbonoCartera.php?AbonosFactura=<?php Echo($AbonosFactura); ?>" method="post" id="FormAnticipo" autocomplete="off">

<?php 

  $sql ="SELECT `Id_Config_Tienda`, `Consecutivo_Factura`, `Consecutivo_ReciboCaja`, `Tienda_Id_Tienda` FROM `t_config_tienda` WHERE Tienda_Id_Tienda='".$MyIdTienda."'";
  //Echo($sql);
  $result = $conexion->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
  $Consecutivo_ReciboCaja=$row['Consecutivo_ReciboCaja']+1;
}
}

 ?>
     
                <input style="display: none;" type="text" value="<?php Echo($AbonosFactura) ?>" name="TxtNumFactura"> 
                <input style="display: none;" type="text" name="TxtCliente" value="<?php Echo($Id_Cliente) ?>"> 
                <input style="display: none;" type="text" name="TxtTienda" value="<?php Echo($MyIdTienda) ?>">
                <input style="display: none;" type="text" name="TxtReciboCaja" value="<?php Echo($Consecutivo_ReciboCaja) ?>"> 
                  <div class="modal-dialog ">
                    <div class="modal-content">
                      <div class="modal-header">
                        <a href="CrearVenta.php" type="button" class="close" data-dismiss="modal">&times;</a>
                        <h4 class="black bigger">Agregar Abono</h4>
                      </div>

                       <table class="table product-overview center" style="width: 80%;">
                       	<tr>
                       		<td>
                       			Seleccione la Fecha del Abono:
                       		</td>
                       		<td colspan="2">
                       			<div class="input-group">
                                  
                                  <input required="true" class="form-control date-picker" id="id-date-picker-1" type="text" data-date-format="yyyy-mm-dd" name="TxtFechaAnticipo" value="" />
                                  <span class="input-group-addon">
                                    <i class="fa fa-calendar bigger-110"></i>
                                  </span>
                                </div>
                       		</td>
                         
                       	</tr>
                                  <tr>
                                   
                                   
                                  <td>
                                  	Ingrese el Valor:
                                     <input class=" nav-search-input input-sm" type="text"  id="demo1" placeholder="$ 0" name="demo1"  required="true" />
                         
                               
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
                                   	Seleccione el medio de Pago:
                                      <select name="TxtMedioPago" id="TxtMedioPago">
                                        <option value="">Seleccionar</option>
                                      <?php 
    $sql ="SELECT Id_Medio_Pago, Nom_MedioPago FROM t_medios_pago Where Estado_MedioPago='1' order by Id_Medio_Pago ASC";  
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
    if((valorCambiado == '2')||(valorCambiado == '3')||(valorCambiado == '4')||(valorCambiado == '6')||(valorCambiado == '7')){
     
       $('#Confirmacion').css('display','');
     }
     else if(valorCambiado == '1')
     {
          $('#Confirmacion').css('display','none');
     }
});
    </script>

                                  </td>

                                  
                                 
                                  </tr>
                                  <tr id="Confirmacion" style="display: none;">
                                    <td>Confirmación</td>
                                    <td>
                                       <input type="text"  name="TxtVoucher" placeholder="Nº Confirmación">
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      ¿ Cliente cancela la deuda en totalidad?:
                                    </td>
                                    <td>
                                      <select name="TxtCancela" required="true">
                                        <option value="">Seleccionar...</option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                      </select>
                                    </td>
                                  </tr>
                                 
                                </table>

                      <div class="modal-footer">
                        <a href="Clientes-AbonosCartera.php?AbonosFactura=<?php Echo($AbonosFactura) ?>" class="btn btn-sm btn-danger" data-dismiss="modal">
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
		<!-- 		<script src="dist/js/demo.js"></script> -->
		<script src="https://modasof.com/espejo/assets/js/jquery.magnific-popup.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.magnific-popup.min.js"></script>


		<?php 
	$TabActive=$_GET['TAB'];
 ?>


<script type="text/javascript">
  function activaTab(tab){
    $('.nav-tabs a[href="#' + tab + '"]').tab('show');
};

activaTab('<?php Echo($TabActive); ?>');
</script>

		
   
		 <script type="text/javascript">
        $(document).ready(function()
        {
             $("#FormAnticipo").validate({
             	errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
                 rules: {
                     "TxtFechaAnticipo": { required:true },
                     "TxtMedioPago": { required:true }, 
                      "TxtCancela": { required:true }, 
                 },
                
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
					remText: '%n carácteres%s restantes...',
					limitText: 'Máx permitidos : %n.'
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
					no_file:'Sin Archivo ...',
					btn_choose:'Seleccionar',
					btn_change:'Cambiar',
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
				//or change it into a date range picker
				$('.input-daterange').datepicker({
					todayHighlight: true,
					autoclose:true,
					format: 'yyyy-mm-dd',

				});
			
			
				//to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
				$('input[name=date-range-picker]').daterangepicker({
					'applyClass' : 'btn-sm btn-success',
					'cancelClass' : 'btn-sm btn-default',
					locale: {
						applyLabel: 'Apply',
						cancelLabel: 'Cancel',
					}
				})
				.prev().on(ace.click_event, function(){
					$(this).next().focus();
				});
			
			
				$('#timepicker1').timepicker({
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
				 //format: 'MM/DD/YYYY h:mm:ss A',//use this option to display seconds
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
