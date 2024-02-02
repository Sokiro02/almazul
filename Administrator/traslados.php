<?php

include ("Lib/sesion.php");
include ("Lib/display_error.php");
include ("Lib/conexion.php");
include ("Lib/formulas.php");
$IdUser = $_SESSION['IdUser'];
$IdRol = $_SESSION['IdRol'];
include ("Lib/permisos.php");
$MiTienda = $_SESSION['nicktienda'];
$MyIdTienda = $_SESSION['IdTienda'];
date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');

include("Lib/seguridad.php");
$Datos="Ingreso a traslados de Mercancia";
$Paginas= $_SERVER['PHP_SELF'];
$seguridad = AgregarLog($IdUser,$Datos,$Paginas);



//ELIMINAMOS LOS REGISTROS QUE SE ESTAN PROCESANDO POR DICHO USUARIO.. DIO AL BOTON CANCELAR
$sqleliminar ="DELETE FROM t_traslados_detalle WHERE id_user='".$IdUser."' and status='PROCESANDO'";
$EJECUTAR = $conexion->query($sqleliminar);


?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Solicitud Traslado Modasof</title>

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
    <!--<link href="../assets1/Ecommerce/css/style.min.css" rel="stylesheet">-->
     <!-- Custom CSS -->
    
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

    <!-- Inicio Libreria formato moneda -->
<script src="https://modasof.com/espejo/assets/js/jquery.maskMoney.js" type="text/javascript"></script>

    <!-- Custom functions file -->
    <script src="https://modasof.com/espejo/assets/js/functions.js"></script>
    <!-- Sweet Alert Script -->
    <script src="https://modasof.com/espejo/assets/js/sweetalert.min.js"></script>
    <!--/Fin Alertas-->

    <?php

include ("Lib/Favicon.php")

?>

<script>
        $(document).ready(function(){
            $(".chosen").chosen({
    width: "100%"
});
       });
jQuery(document).ready(function(){
	//jQuery(".my-select").chosen();
    $("#TxtInsumoSel").chosen().change(function () {
    $("#TxtInsumoSel option:selected").each(function () {
            Select1 = $(this).val();
            $.post("datos_produccion.php", { Select1: Select1}, function(data){
                $("#Tallas").html(data); 
            });            
        });
    });  
    $("#TxtInsumoSel").chosen().change(function () {
    $("#TxtInsumoSel option:selected").each(function () {
            Select1 = $(this).val();
            $.post("datos_produccion.php", { Select1: Select1}, function(data){
                $("#Tallas").html(data); 
            });            
        });
    });
    $("#TxtInsumoSel").chosen().change(function () {
        $("#TxtInsumoSel option:selected").each(function () {
            Select1 = $(this).val();
            $.post("datos_produccion2.php", { Select1: Select1}, function(data){
                $("#Cantidad").html(data); 
            });            
        });
    });    
});
    //$(".my-select").chosen();

</script>
   
    <script>
/*$(document).ready(function(){
   $("#TxtTalla").change(function () {
           $("#TxtTalla option:selected").each(function () {
            Select1 = $(this).val();
           var Select2 = $("#TxtTienda option:selected").val();
            //var Select3 = $("#TxtInsumoSel option:selected").val();
            //alert(Select2)
            $.post("DisponTraslado.php?ReferenciaAjax=<?php

echo ($RefSel);

?>&InsumoP=<?php

echo ($Insumo_Ppal);

?>", { Select1: Select1, Select2: Select2}, function(data){
                $("#TxtCantidad").html(data); 
            });            
        });
   })
}); */
</script>

 <script>
/* $(document).ready(function(){
   $("#TxtTienda").change(function () {
           $("#TxtTienda option:selected").each(function () {
            Select2 = $(this).val();
           var Select1 = $("#TxtTalla option:selected").val();
            //var Select3 = $("#TxtInsumoSel option:selected").val();
            //alert(Select2)
            $.post("DisponTraslado.php?ReferenciaAjax=<?php ?>&InsumoP=<?php ?>", { Select1: Select1, Select2: Select2}, function(data){
                $("#TxtCantidad").html(data); 
            });            
        });
   })
}); */
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

$Valide = $_GET['Mensaje'];

if ($Valide == 11)
{
    echo "<script>jQuery(function(){swal(\"¡Lo Sentimos!\", \"Este valor es mayor al permitido\", \"error\");});</script>";
}
;
if ($Valide == 1)
{
    echo "<script>jQuery(function(){swal(\"¡ Pedido  Agregado!\", \"Correctamente \", \"success\");});</script>";
}
;
if ($Valide == 2)
{
    echo "<script>jQuery(function(){swal(\"¡ Orden  Eliminada!\", \"Correctamente \", \"success\");});</script>";
}
;
if ($Valide == 23)
{
    echo "<script>jQuery(function(){swal(\"¡ Extra Cargada a Cliente!\", \"" . $ClienteSel .
        " \", \"success\");});</script>";
}
;

?>


	<?php

include ("Lib/Alertas.php")

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

include ("Lib/links.php");
include ("Lib/menuleft.php");

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
								<i class="ace-icon fa fa-close"></i>
								<a href="#">Volver</a>
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

 <!-- Info box Content -->
<!-- ============================================================== -->
<div class="row" >
    <!-- Column -->
    <div class="col-lg-12">
        <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="col-sm-12 col-xs-12"><!-- Inicio Panel Inferior-->
                        <h6 class="box-title m-t-40"><b>Solicitud Traslado entre tiendas:</b> Seleccione la tienda origen y la tienda destino y despues hacer clic en cargar 
                        </h6>
                        <!-- <form action="#" method="post" id="FormSolicitud"> -->
                            <div > 
                            </div> 
                            <div id="VistaCliente" class="col-xs-12 col-sm-12">
                            </div> 
                                <select class="col-lg-3 col-xs-12"  name="TxtTienda" id="TxtTienda">
                                    <label><strong>Tienda de Origen</strong></label>
                                    <option value="">Seleccionar Tienda Origen</option>
                                    <?php

$sqltiendas = "SELECT * FROM t_tiendas WHERE Estado_Tienda='1'";
$resultado = $conexion->query($sqltiendas);
if ($resultado->num_rows > 0)
{
    while ($fila = $resultado->fetch_assoc())
    {
        $id_tienda = $fila['Id_Tienda'];
        $nom_tienda = $fila['Nom_Tienda'];
        echo "<option value='" . $id_tienda . "'>$nom_tienda</option>";
    }
}

?>
                               
                                  </select>
                    
                               <select class="col-lg-3 col-xs-12"  name="TxtTienda2" id="TxtTienda2">
                                    <label><strong>Tienda de Destino</strong></label>                           
                                    <option value="">Seleccionar Tienda Destino</option>
                                    <?php

$sqltiendas = "SELECT * FROM t_tiendas WHERE Id_Tienda='".$MyIdTienda."'";
$resultado = $conexion->query($sqltiendas);
if ($resultado->num_rows > 0)
{
    while ($fila = $resultado->fetch_assoc())
    {
        $id_tienda = $fila['Id_Tienda'];
        $nom_tienda = $fila['Nom_Tienda'];
        echo "<option value='" . $id_tienda . "'>$nom_tienda</option>";
    }
}

?>          
                                  </select>
<script type="text/javascript">
function miFuncionEliminar(id) {
    
    }
  function miFuncion() {
    //alert('Has hecho click en "miboton"');
    $("TxtTienda2").prop('disabled', true);
    $("TxtTienda").prop('disabled', false);
    $("TxtTienda").attr('disabled','disabled');
    if($("#TxtTienda").val().length > 0) {
        if ($("#TxtTienda2").val().length > 0){
                if($("#TxtTienda").val() != $("#TxtTienda2").val()){
                //alert('El campo no esta vacio "miboton"');
                document.getElementById('TxtTienda').disabled= true;
                document.getElementById('TxtTienda2').disabled= true;
                //document.getElementById('TxtTienda').getAttribute("value")
                //document.getElementById('desde').getAttribute("value")="TIENDA YYYY";
                /* Para obtener el valor */
                    //var cod = document.getElementById("TxtTienda").value;
                    //alert(cod);
                    
                    /* Para obtener el texto de la tienda 1*/
                    var combo = document.getElementById("TxtTienda");
                    var selected = combo.options[combo.selectedIndex].text;
                    //var selectedDesde = combo.options[combo.selectedIndex].value;
                    
                    var combo = document.getElementById("TxtTienda2");
                    var selected2 = combo.options[combo.selectedIndex].text;
                    
                    Select1 = selected;
                    Select2 = selected2;
                    var Select3 = $("#TxtTienda option:selected").val();
                    var Select4 = $("#TxtTienda2 option:selected").val();
                    $('#cambio2').html('<div class="loading center"><img src="loader.gif" alt="loading" /><br/>Espere un momento, por favor...</div>');
                    $.post("aaa.php", { Select1: Select1, Select2: Select2, Select3: Select3, Select4: Select4}, function(data){                     
                        $("#cambio2").html(data);
                        $('#cargar').attr("disabled", true);
                    });            
                
                    $(".chosen").chosen({
                       width: "100%"
                    });
            
                //$("#cambio").show();
                $("#cambio2").show();
                
                //document.getElementById("desde").innerHTML = $("#TxtTienda").val();
                //document.getElementById("desde").innerHTML = selected;
                //document.getElementById("hasta").innerHTML = selected2;
                //document.getElementById("IdTiendaOrigen").value = selected;                                
                //document.getElementById("IdTiendaDestino").value = selected2;

                

            }else{
                alert('Debe seleccionar dos tiendas diferentes');
            }
        }
    }
  }
</script>

                                  
<div class="col-lg-3 col-xs-12">
            <button class="btn btn-success btn-rounded btn-sm" id="cargar" onclick="miFuncion()"><i class="fa fa-plus-square"></i> Cargar</button>
           </div>  

             <div class="form-group col-sm-12 col-xs-12">
            </div>
        </div>
        <!-- </form> -->
<!-- CONTENIDO NUEVO-->
<div class="row">
    <div style="display:none;" id="cambio2">  <!-- CONTENIDO PARA EL TRASPASO DE LA MERCANCIA  <div style="display:none;" id="cambio">-->
    </div>
     <!-- ./FIN CONTENIDO PARA EL TRASPASO DE LA MERCANCIA -->
</div> <!-- /.ROW -->
                                  
<div class="col-lg-12 col-md-12 col-sm-12">
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

//include ("Lib/footer.php")

?>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->

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
		<script src="https://modasof.com/espejo/assets/js/vfs_fonts.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jszip.min.js"></script>
		
		<script src="https://modasof.com/espejo/assets/js/jquery.validate.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery-additional-methods.min.js"></script>

		
		 <script type="text/javascript">
        $(document).ready(function()
        {
             $("#FormSolicitud").validate({
             	errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
                 rules: {
                     "TxtTienda2": { required:true }, 
                     "TxtTienda": { required:true },       
                 },

                 messages: {
                     
                    	"TxtTienda": { required:"Por favor seleccione la tienda origen" },
                        "TxtTienda2": { required:"Por favor seleccione la tienda destino" },
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
                     "TxtCiudad": { required:true },   
                     "TxtCelular": { required:true }, 
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
				$('.input-daterange').datepicker({autoclose:true});
			
			
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
	
<script>
    $(".chosen").chosen({
    width: "100%"
});
    $("#TxtInsumoSel").chosen().change(function () {
           $("#TxtInsumoSel option:selected").each(function () {
            Select1 = $(this).val();
            $.post("datos_produccion.php", { Select1: Select1}, function(data){
                $("#Tallas").html(data); 
            });            
        });
   });
    $("#TxtInsumoSel").chosen().change(function () {
           $("#TxtInsumoSel option:selected").each(function () {
            Select1 = $(this).val();
            $.post("datos_produccion2.php", { Select1: Select1}, function(data){
                $("#Cantidad").html(data); 
            });            
        });
   });
</script>


	
	</body>
</html>
