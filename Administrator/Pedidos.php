<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
include("Lib/modelotaller.php");


$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];

include("Lib/permisos.php");

 $MyIdTienda=$_SESSION['IdTienda'];
 $MiTienda=$_SESSION['nicktienda'];
 $MyIdTaller=$_SESSION['IdTaller'];
 $MiTaller=$_SESSION['nicktaller'];

date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');
$FechaActual = date('Y-m-d');

$Confirmation=$_GET['Confirmation'];
$ConfirmationBaja=$_GET['ConfirmationBaja'];
$NumPedido=$_GET['NumPedido'];

$VerificaAbonos=$_GET['VerificaAbonos'];

if ($VerificaAbonos>0) {
			header("location:Pedidos.php?Mensaje=28");
		}
		else{

			if ($Confirmation!="") {
	
	
	// Verificamos si es un pedido activo
	$sql ="SELECT Id_Pedido FROM t_pedido WHERE Cod_Pedido='".$Confirmation."'";
	$result = $conexion->query($sql);
	if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
	$Id_PedidoDel=$row['Id_Pedido'];                  
 }
}

	
	if ($Id_PedidoDel!="") {

		
		// Bucle para conocer las referencias solicitadas
$sql ="SELECT Id_Temporal_Sol FROM t_temporal_sol WHERE Pedido_Id_Pedido='".$Confirmation."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$ListaReferencias=$ListaReferencias.$row['Id_Temporal_Sol'].",";                  
 }
}
$CadenaRef=explode(",", $ListaReferencias);
//Split al Arreglo
$longitud = count($CadenaRef);
$min=$longitud-1;
//Recorro todos los elementos

for($i=0; $i<$min; $i++)
{

$sql ="SELECT Referencia_Id_Referencia,Bodega_Id_Bodega FROM t_temporal_sol WHERE Id_Temporal_Sol='".$CadenaRef[$i]."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$ReferenciaSol=$row['Referencia_Id_Referencia'];  
$Taller=$row['Bodega_Id_Bodega'];          
 }
}

$sql ="SELECT Cant_Solicitada FROM t_temporal_sol WHERE Id_Temporal_Sol='".$CadenaRef[$i]."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$SolicitadaSol=$row['Cant_Solicitada'];                  
 }
}


BucleSumaInsumos($ReferenciaSol,$SolicitadaSol,$Taller);

}

		
		
		//Elimina las solicitudes de ese pedido
		$sql ="DELETE FROM t_temporal_sol WHERE Pedido_Id_Pedido='".$Confirmation."'";  
		//echo($sql);
		$result = $conexion->query($sql);

		$sql ="DELETE FROM t_pedido WHERE Id_Pedido='".$Id_PedidoDel."'";  
		//echo($sql);
		$result = $conexion->query($sql);

		
	}

header("location:Pedidos.php?Mensaje=18");

}
		}



if ($ConfirmationBaja!="") {
	
	$EstadoCargarInventario=14;
	
	$sql=("UPDATE t_pedido SET Estado_Pedido='".$EstadoCargarInventario."' WHERE Cod_Pedido='".$ConfirmationBaja."'");
   //echo($sql);
   $result = $conexion->query($sql);
   $sql=("UPDATE t_temporal_sol SET Estado_Solicitud_Cliente='".$EstadoCargarInventario."' WHERE Pedido_Id_Pedido='".$ConfirmationBaja."'");
   //echo($sql);
   $result = $conexion->query($sql);
	
   header("location:Pedidos.php?Mensaje=19");

}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Pedidos Modasof</title>

		<meta name="description" content="Common form elements and layouts" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		
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

			<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/bootstrap-datepicker3.min.css" />
	<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/bootstrap-timepicker.min.css" />
	<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/daterangepicker.min.css" />
	<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/bootstrap-datetimepicker.min.css" />

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


 <script>
$(document).ready(function(){
   $("#TxtCategoria").change(function () {
           $("#TxtCategoria option:selected").each(function () {
            Select1 = $(this).val();
            //var Select2 = $("#TxtCantidad option:selected").val();
            //alert(Select1)
            $.post("SelectCategoriaIns.php", { Select1: Select1}, function(data){
                $("#info").html(data); 
            });            
        });
   })
});
</script>

    <?php // include("Lib/Favicon.php") ?>

	</head>

	<body class="skin-1">

	<?php 
  $Valide=$_GET['Mensaje'];

    if ($Valide==2) {
        echo "<script>jQuery(function(){swal(\"¡Lo Sentimos!\", \"Datos Incorrectos\", \"error\");});</script>";
    };
     if ($Valide==28) {
        echo "<script>jQuery(function(){swal(\"¡Esta orden ya tiene abonos !\", \"No se puede eliminar haga una nueva orden y contacte al administrador para que transfiera el recibo de caja\", \"error\");});</script>";
    };
    if ($Valide==1) {
        echo "<script>jQuery(function(){swal(\"¡ Insumo Creado!\", \"Correctamente \", \"success\");});</script>";
    };
     if ($Valide==111) {
        echo "<script>jQuery(function(){swal(\"¡ Insumo Actualizado!\", \"Correctamente \", \"success\");});</script>";
    };
     if ($Valide==123) {
        echo "<script>jQuery(function(){swal(\"¡ Pedido Creado!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==18) {
        echo "<script>jQuery(function(){swal(\"¡ Pedido Eliminado!\", \"Correctamente \", \"success\");});</script>";
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
     if ($Valide==19) {
        echo "<script>jQuery(function(){swal(\"¡ Estado de Pedido No Entregado !\", \"Correctamente \", \"success\");});</script>";
    };
     if ($Valide==16) {
        echo "<script>jQuery(function(){swal(\"¡ Nombre Atributo Actualizado!\", \"Correctamente \", \"success\");});</script>";
    };
   ?>


   <?php 

if (isset($_GET['NumPedidoDel'])) {
	 $NumPedidoDel=$_GET['NumPedidoDel'];
$ValorAbonos=$_GET['ValorAbonos'];
    if ($NumPedidoDel!="") {
    	
    	?>
    	<script>jQuery(function(){
    	swal({
  title: "¿Está seguro de eliminar este Pedido?",
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
    window.location.href = 'Pedidos.php?Confirmation=<?php Echo($NumPedidoDel);?>&VerificaAbonos=<?php Echo($ValorAbonos); ?>';
  } else {
    window.location.href = 'Pedidos.php';
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


if (isset($_GET['NumPedidoBaja'])) {
	 $NumPedidoBaja=$_GET['NumPedidoBaja'];

 if ($NumPedidoBaja!="") {
    	?>
    	<script>jQuery(function(){
    	swal({
  title: "¿Está seguro de cambiar a Estado No Entregado ?",
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
    window.location.href = 'Pedidos.php?ConfirmationBaja=<?php Echo($NumPedidoBaja); ?>';
  } else {
    window.location.href = 'Pedidos.php';
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
								<i class="ace-icon fa fa-industry"></i>
								<a href="Pedidos.php">Pedidos</a>
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
<hr>


</div><!-- Fin Panel Inferior -->
<div class="col-sm-12"><!-- Inicio Panel 12 -->
										<div class="tabbable">
											<ul class="nav nav-tabs" id="myTab">
												<li class="active">
													<a data-toggle="tab" href="#tabs-1">
														<i class="green ace-icon fa fa-users bigger-120"></i>
														Pedidos Clientes
													</a>
												</li>

												<!-- <li id="Tab-Categoria-Insumos">
													<a data-toggle="tab" href="#tabs-2">
												<i class="blue ace-icon fa fa-list bigger-120"></i>
														Solicitudes Producción
													</a>
												</li> -->
											</ul>

											<div class="tab-content">
											<?php 
											if ($MyIdTaller!="") {
												include("listapedidos31.php");
											}
											elseif($MyIdTaller=="" & $IdRol==1)
											{
												include("listapedidos31.php");
											}
											else
											{
												include("listapedidos1.php");
											}

											 ?>

											</div>
										</div>
									</div><!-- Fin Panel 12 -->



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
		<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="https://modasof.com/espejo/assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		
		<script src="https://modasof.com/espejo/assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="https://modasof.com/espejo/assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="https://modasof.com/espejo/assets/js/jquery-ui.custom.min.js"></script>
		
		<!-- ace scripts -->
		<script src="https://modasof.com/espejo/assets/js/ace-elements.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/ace.min.js"></script>
			<script src="https://modasof.com/espejo/assets/js/bootstrap-datepicker.min.js"></script>
	<script src="https://modasof.com/espejo/assets/js/bootstrap-timepicker.min.js"></script>
	<script src="https://modasof.com/espejo/assets/js/moment.min.js"></script>
	<script src="https://modasof.com/espejo/assets/js/daterangepicker.min.js"></script>
	<script src="https://modasof.com/espejo/assets/js/bootstrap-datetimepicker.min.js"></script>

		
		<script src="https://modasof.com/espejo/assets/js/jquery.dataTables.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/dataTables.buttons.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/buttons.flash.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/buttons.html5.min.js"></script>
	
		<script src="https://modasof.com/espejo/assets/js/buttons.colVis.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/dataTables.select.min.js"></script>
		
		<script src="https://modasof.com/espejo/assets/js/vfs_fonts.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jszip.min.js"></script>
		

		<script src="https://modasof.com/espejo/assets/js/dataTables.responsive.min.js"></script>
		


		<?php 
	$TabActive=$_GET['TAB'];
 ?>




   <script>
   	$('.input-daterange').datepicker({
				todayHighlight: true,
				autoclose: true,
				format: 'yyyy-mm-dd',

			});
   </script>
		

	

	 <script>
   function format2(n, currency) {
    return currency + " " + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
}
        $(document).ready(function() {
    $('#example').DataTable( {
         "searching": true,
        "paging":   true,
        "info":     true,
        "aLengthMenu": [[100, 200, 300, -1], [100, 200, 300, "Todas"]],
    "pageLength": 100,
       
       
    } );
} );
    </script>
<?php 
	if ($MyIdTaller!="") {
 ?>
		
		<script type="text/javascript">
			jQuery(function($) {
			
$('#dynamic-table thead tr:eq(1) th').each( function () {
        var title = $('#dynamic-table thead tr:eq(0) th').eq( $(this).index() ).text();
        $(this).html( '<input style="width:100%;border:black solid 1px;" type="text" placeholder="Buscar '+title+'" />' );
    } ); 
  
    var table = $('#dynamic-table').DataTable({
    	responsive:true,
    	"order": [[ 1, "Desc" ]],
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
					"footerCModasofack": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

 
            // Total over all pages
           
            // Total over this page
           
            pageTotal6 = api
                .column( 10, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
           
          
            // Update footer
            $( api.column( 10 ).footer() ).html(
                '$'+format2(pageTotal6,'' )
            );  
        },

    });
  
    // Apply the search
    table.columns().every(function (index) {
        $('#dynamic-table thead tr:eq(1) th:eq(' + index + ') input').on('keyup change', function () {
            table.column($(this).parent().index() + ':visible')
                .search(this.value)
                .draw();    
        });
    });

				var myTable = 
				$('#dynamic-table')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
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

						"extend": "excelHtml5",
						"text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Exportar a Excel</span>",
						"className": "btn btn-white btn-primary btn-bold"

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
		<!-- Final Scripts Tablas -->

	<?php 

} 
else
{
?>
		<script type="text/javascript">
			jQuery(function($) {
			
$('#dynamic-table thead tr:eq(1) th').each( function () {
        var title = $('#dynamic-table thead tr:eq(0) th').eq( $(this).index() ).text();
        $(this).html( '<input style="width:100%;border:black solid 1px;" type="text" placeholder="Buscar '+title+'" />' );
    } ); 
  
    var table = $('#dynamic-table').DataTable({
    	responsive:true,
    	"order": [[ 1, "Desc" ]],
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
					"footerCModasofack": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

 
            // Total over all pages
           
            // Total over this page
            pageTotal5 = api
                .column( 9, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            // Total over this page
            pageTotal6 = api
                .column( 10, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            // Total over this page
            pageTotal7 = api
                .column( 11, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
             // Update footer
            $( api.column( 9 ).footer() ).html(
                '$'+format2(pageTotal5,'' )
            );
            // Update footer
            $( api.column( 10 ).footer() ).html(
                '$'+format2(pageTotal6,'' )
            );  

             // Update footer
            $( api.column( 11 ).footer() ).html(
                '$'+format2(pageTotal7,'' )
            );  
        },

    });
  
    // Apply the search
    table.columns().every(function (index) {
        $('#dynamic-table thead tr:eq(1) th:eq(' + index + ') input').on('keyup change', function () {
            table.column($(this).parent().index() + ':visible')
                .search(this.value)
                .draw();    
        });
    });

				var myTable = 
				$('#dynamic-table')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
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

						"extend": "excelHtml5",
						"text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Exportar a Excel</span>",
						"className": "btn btn-white btn-primary btn-bold"

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
		<!-- Final Scripts Tablas -->

<?php 
	}
 ?>




	
	</body>
</html>
