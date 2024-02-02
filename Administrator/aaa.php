<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];



date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');

$ID=$_POST['Select1'];
$ID2=$_POST['Select2'];
$ID3 = $_POST['Select3']; //ID TIENDA QUE ENVIA
$ID4 = $_POST['Select4']; //ID TIENDA QUE RECIBE
$var1  = $ID;
$var2 = $ID2;
$porciones = explode("-", $var1);
$Id_Produccion=$porciones[0]; // Id de Produccion
$Id_Referencia = $porciones[1]; // Id de la Referencia
$Nombre_Talla = $porciones[2]; // Nombre de la Talla
$Talla_Id= $porciones[3]; // Nombre de la Talla

$sqlusuario ="SELECT * FROM t_usuarios WHERE Id_Usuario='".$IdUser."'";
$resultadousuarios = $conexion->query($sqlusuario);
$filas = $resultadousuarios->fetch_assoc();
$usuario = $filas['Nombres']." ".$filas['Apellidos'];
$Img_Perfil = $filas['Img_Perfil'];

?>
		<script src="https://modasof.com/espejo/assets/js/bootstrap.min.js"></script>


		<script src="https://modasof.com/espejo/assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="https://modasof.com/espejo/assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="https://modasof.com/espejo/assets/js/jquery-ui.custom.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/chosen.jquery.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/moment.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.knob.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/autosize.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/bootstrap-tag.min.js"></script>

		<!-- ace scripts -->
		<script src="https://modasof.com/espejo/assets/js/ace-elements.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/ace.min.js"></script>

		<!-- Inicio scripts Tablas -->
		<!-- page specific plugin scripts -->
		<script src="https://modasof.com/espejo/assets/js/dataTables.buttons.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/buttons.flash.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/buttons.html5.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/buttons.print.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/buttons.colVis.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/dataTables.select.min.js"></script>
		
		
		<script src="https://modasof.com/espejo/assets/js/jquery.validate.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery-additional-methods.min.js"></script>

		<script src="https://modasof.com/espejo/assets/js/jquery.magnific-popup.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.magnific-popup.min.js"></script>
        <!--<script src="https://modasof.com/espejo/assets/js/dataTables.responsive.min.js"></script>-->

		 <!-- Notificaciones Push -->
		<script src="https://modasof.com/espejo/assets/js/push.min.js"></script>
		

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/chosen.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/ImageSelect.css" />

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
    
      <style>
    .negros2 { 
     background-color: #000000;
    }
    .negros {
      background-color: #000000; 
      color: #FFFFFF;
    }
  </style>
    <script src="https://modasof.com/espejo/assets/js/chosen.jquery.js"></script>
<script src="https://modasof.com/espejo/assets/js/ImageSelect.jquery.js"></script>

    <?php include("Lib/Favicon.php") ?>
    <link rel="stylesheet" href="https://modasof.com/espejo/assets/css/magnific-popup.css">

<script language="Javascript" type="text/javascript">
//FUNCION PARA ELIMINAR UN DETALLE
function miFuncionEliminar(id) {
    if ( confirm("Estas seguro de eliminar el registro?") ) {
            $.post("traslados_eliminar_detalle.php", { Eliminar: id}, function(data){
                //$("#Tallas").html(data);
                if(data.trim() == "true"){
                    //alert(data.trim());
                    refreshDivs('tabla',1,'traslados_tabla_detalle.php');
                } else {
                    alert("Error al eliminar el registro "+data);
                }
            });          
        return true;
    } else {
     evt.preventDefault();
    }
}

//SCRIPT PARA CARGAR LA TABLA DE TRASLADOS EN EL DIV TABLA
function refreshDivs(divid,secs,url)
    {
    
    // define our vars
    var divid,secs,url,fetch_unix_timestamp;
    
    // Chequeamos que las variables no esten vacias..
    if(divid == ""){ alert('Error: escribe el id del div que quieres refrescar'); return;}
    else if(!document.getElementById(divid)){ alert('Error: el Div ID selectionado no esta definido: '+divid); return;}
    else if(secs == ""){ alert('Error: indica la cantidad de segundos que quieres que el div se refresque'); return;}
    else if(url == ""){ alert('Error: la URL del documento que quieres cargar en el div no puede estar vacia.'); return;}
    
    // The XMLHttpRequest object
    
    var xmlHttp;
        try{
            xmlHttp=new XMLHttpRequest(); // Firefox, Opera 8.0+, Safari
        }
    catch (e){
        try{
            xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
            }
        catch (e){
            try{
                xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e){
                alert("Tu explorador no soporta AJAX.");
                return false;
            }
        }
    }
    
    // Timestamp para evitar que se cachee el array GET
    
    fetch_unix_timestamp = function()
    {
    return parseInt(new Date().getTime().toString().substring(0, 10))
    }
    
    var timestamp = fetch_unix_timestamp();
    var nocacheurl = url+"?t="+timestamp;
    
    // the ajax call
    xmlHttp.onreadystatechange=function(){
    if(xmlHttp.readyState == 4 && xmlHttp.status == 200){
    document.getElementById(divid).innerHTML=xmlHttp.responseText;
    setTimeout(function(){refreshDivs(divid,secs,url);},secs*1000);
    }
    }
    xmlHttp.open("GET",nocacheurl,true);
    xmlHttp.send(null);
    }
    
    // LLamamos las funciones con los repectivos parametros de los DIVs que queremos refrescar.
    window.onload = function startrefresh(){
        refreshDivs('tabla',30,'traslados_tabla_detalle.php');
    }
</script>

<script language='javascript'> 
//FUNCION AL PRECIONAR EL BOTON GUARDAR (GUARDA TODA LA INFORMACIÓN DEL TRASLADO)
$(function(){
    $('#guardar').on('click', function (e){
        e.preventDefault(); // Evitamos que salte el enlace.
        var paqueteDeDatos = new FormData();
        paqueteDeDatos.append('IdTiendaOrigen', $('#IdTiendaOrigen').prop('value'));
        paqueteDeDatos.append('IdTiendaDestino', $('#IdTiendaDestino').prop('value'));
        document.getElementById("guardar").value = "ENVIANDO...";
        document.getElementById("guardar").disabled = true;
        var destino = "traslados_guardar.php"; // El script que va a recibir los campos de formulario.        
		$.ajax({
			url: destino,
			type: 'POST', // Siempre que se envíen ficheros, por POST, no por GET.
			contentType: false,
			data: paqueteDeDatos, // Al atributo data se le asigna el objeto FormData.
			processData: false,
			cache: false, 
			success: function(resultado){ // En caso de que todo salga bien.
                var var1 ="1";
               
                if(resultado.trim() == "true")
                   {     
                      alert("Traslado guardado con exito.");
                      document.location.href = "traslados.php?Mensaje=" + var1;
                   }else{
                      alert("Error al guardar datos.");
                      alert("Algo ha fallado. Verifique que toda la información es correcta");
                      refreshDivs('tabla',1,'traslados_tabla_detalle.php');
                      document.getElementById("guardar").value = "Guardar";
                      document.getElementById("guardar").disabled = false; 
                   }
                console.log(resultado);
			},
			error: function (){ // Si hay algún error.
				alert("Algo ha fallado. Verifique que toda la información es correcta");
                var var1 ="21";
                document.getElementById("guardar").value = "Guardar";
                document.getElementById("guardar").disabled = false; 
                //document.location.href = "producto-crear.php?Mensaje=" + var1 + "&";					
			}
		});
    });
});

</script>


<script language='javascript'>
//FUNCION AL PRECIONAR EL BOTON CARGAR ITEM (GUARDA LA INFORMACIÓN DE LA REFERENCIA A TRASLADAR)
			$(function(){
				$('#envio').on('click', function (e){
				    //jQuery.validator.messages.required = 'Esta campo es obligatorio.';
                    //$("#FormProducto").validate();
                    //var validado = $("#FormProducto").valid();
					e.preventDefault(); // Evitamos que salte el enlace.
					/* Creamos un nuevo objeto FormData. Este sustituye al 
					atributo enctype = "multipart/form-data" que, tradicionalmente, se 
					incluía en los formularios (y que aún se incluye, cuando son enviados 
					desde HTML. */
					var paqueteDeDatos = new FormData();
					/* Todos los campos deben ser añadidos al objeto FormData. Para ello 
					usamos el método append. Los argumentos son el nombre con el que se mandará el 
					dato al script que lo reciba, y el valor del dato.
					Presta especial atención a la forma en que agregamos el contenido 
					del campo de fichero, con el nombre 'archivo'. */
					paqueteDeDatos.append('TxtInsumoSel', $('#TxtInsumoSel').prop('value'));
					paqueteDeDatos.append('TxtTalla', $('#TxtTalla').prop('value'));
                    paqueteDeDatos.append('TxtCantidad', $('#TxtCantidad').prop('value'));
                    paqueteDeDatos.append('IdTiendaOrigen', $('#IdTiendaOrigen').prop('value'));
                    paqueteDeDatos.append('IdTiendaDestino', $('#IdTiendaDestino').prop('value'));
                    
          			document.getElementById("envio").value = "ENVIANDO...";
                    document.getElementById("envio").disabled = true;
                    //$('#tabla').html('<div class="loading center"><img src="loader.gif" alt="loading" /><br/>Espere un momento, por favor...</div>');                    
					var destino = "traslados_detalle_guardar.php"; // El script que va a recibir los campos de formulario.
					/* Se envia el paquete de datos por ajax. */
					$.ajax({
						url: destino,
						type: 'POST', // Siempre que se envíen ficheros, por POST, no por GET.
						contentType: false,
						data: paqueteDeDatos, // Al atributo data se le asigna el objeto FormData.
						processData: false,
						cache: false, 
						success: function(resultado){ // En caso de que todo salga bien.
                            var var1 ="1";
                            
                            if(resultado.trim() == "true")
	                           {     
		                          alert("Todo Excelente, Datos guardados con exito.");
                                  document.getElementById("envio").value = "Cargar Item";
                                  document.getElementById("envio").disabled = false;
                                  refreshDivs('tabla',1,'traslados_tabla_detalle.php');
                                  //$("#tabla").load('traslado_tabla_detalle.php');             
                                  
	                           }else{
    		                      alert("Error al guardar datos.");
                                  alert("Algo ha fallado. Verifique que toda la información es correcta");
                                  //$("#tabla").load(" #tabla");
                                  refreshDivs('tabla',1,'traslados_tabla_detalle.php');
                                    var var1 ="21";
                                    document.getElementById("envio").value = "Enviar";
                                    document.getElementById("envio").disabled = false; 
                                    //document.location.href = "producto-crear.php?Mensaje=" + var1 + "&";
                               }
                            console.log(resultado);
						},
						error: function (){ // Si hay algún error.
							alert("Algo ha fallado. Verifique que toda la información es correcta");
                            var var1 ="21";
                            document.getElementById("envio").value = "Enviar";
                            document.getElementById("envio").disabled = false; 
                            //document.location.href = "producto-crear.php?Mensaje=" + var1 + "&";					
						}
					});
				});
			});
		</script>

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

</script

        <div class="col-sm-12 col-xs-12"><!-- Inicio Panel Inferior-->
            <!-- Primer Fila  -->
            <div class="col-sm-4 yellow">
            	<div class="widget-box">
            		<div class="widget-body">
            			<div class="widget-main">
                            <h5><b>TRASLADO SOLICITADO POR: </b></h5>
                            <h5><img style="width: 15%;height: 15%;" class="nav-user-photo" src="../Administrator/<?php

echo utf8_encode($Img_Perfil);

?>" alt="Usuario" /> <?php

echo utf8_encode($usuario);

?></h5>
                            <h5><i class="fa fa-clock-o"></i> <?php

echo ($TiempoActual)

?> </h5>	
            			</div>
            		</div>
            	</div>
            </div>
        <div class="col-sm-4 yellow">
        	<div class="widget-box">
        		<div class="widget-body">
        			<div class="widget-main">
                        <h5><b>TRASLADO DESDE LA TIENDA:</b></h5>
                        <b><h5 id="desde"><?php echo $ID;?></h5></b>
                        <h5><b>HASTA LA TIENDA:</b></h5>
                        <b><h5 id="hasta"><?php echo $ID2;?></h5></b>
        			</div>
        		</div>
        	</div>
        </div>  
        <div class="col-sm-4 center"> 
        	<h5>ORDEN TRASLADO: OT254</h5>
            <div class="infobox infobox-green">
            	<div class="infobox-icon">
            		<i class="ace-icon fa fa-dollar"></i>
            	</div>
        
            	<div class="infobox-data">
            		<span class="infobox-data-number"><?php

Formatomoneda($suma);

?></span>
            		<div class="infobox-content">Total Despacho</div>
            	</div>
            </div>
        </div>              
    </div> <!-- ./ Fin Panel Inferior-->
    
<!-- Inicio Formulario  -->
			<div class="col-sm-12">
				<div class="widget-box">
					<div class="widget-header">
						<h4 class="widget-title">SELECCIONE REFERENCIAS A PEDIR TRASLADO</h4>

						<span class="widget-toolbar">
							
							<a href="#" data-action="collapse">
								<i class="ace-icon fa fa-chevron-up"></i>
							</a>

							
						</span>
					</div>
<form method="post" id="FormOrden">

    <div class="widget-body">
	   <div class="widget-main">
	       <div class="row">
                <div class="form-group  col-sm-6">
                <label for="form-field-select-3">Seleccionar Referencias</label>
            <div>
                <select required class="chosen col-sm-10" id="TxtInsumoSel" name="TxtInsumoSel" >

<?php
Echo("<option value=''>Seleccionar Referencia...</option>");
$buscarinventario ="SELECT * FROM t_inventario WHERE Id_Tienda='".$ID3."' and Cantidad>0";
$Resultados = $conexion->query($buscarinventario);
if ($Resultados->num_rows>0){
    while ($fila_consulta = $Resultados->fetch_assoc()){
        $referencia = $fila_consulta['Referencia'];
        $referencia_completa = $fila_consulta['Referencia_Completa'];
        $cantidad = $fila_consulta['Cantidad'];
        $talla_id = $fila_consulta['Id_Talla'];
        $Existencia=$cantidad;
        
        //OBTENER EL NOMBRE DE LA TALLA
            $ssql="SELECT * FROM t_tallas WHERE Id_Talla='".$talla_id."'";
            $sresult = $conexion->query($ssql);
            $sfila = $sresult->fetch_assoc();
            $Nombre_Talla = $sfila['Nom_Talla'];
        
        //OBTENER LOS DATOS DE LA REFERENCIA
        $sqlbuscarreferencia = "SELECT * FROM t_inventario_ref ";
        $sql ="SELECT * FROM t_referencias WHERE Cod_Referencia='".$referencia."'";  
        $result = $conexion->query($sql) or die('Error:'.mysqli_error($conexion));;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {   
            	$SelectIdInsumo=$row['Id_Referencia'];
            	$SelectNombreInsumo=$row['Detalle_Referencia'];   
            	$SelectCodInsumo=$row['Cod_Referencia'];  
                $SelectCodInsumo2=substr($SelectCodInsumo, 5,5);
            	$SelectUrlInsumo=$row['Img_Referencia']; 
            	$ruta_img = utf8_encode($SelectUrlInsumo);
                $mostrar_img = "miniatura.php?x=50&y=50&file=".$ruta_img;
            	
            	Echo("<option value='".$referencia."-".$SelectIdInsumo."-".$Nombre_Talla."-".$talla_id."-".$Existencia."' data-img-src='".$mostrar_img."'>".$SelectCodInsumo2." ".$SelectNombreInsumo." Talla: ".$Nombre_Talla." Existencia: ".$Existencia."</option>");
                //Echo("<option value='".$referencia."-".$SelectIdInsumo."-".$Nombre_Talla."-".$talla_id."-".$Existencia."' data-img-src='".$mostrar_img."'>".$SelectCodInsumo."</option>");
              }
       }        
    }
}
?>
    </select>
    </div>
</div>
<div class="form-group  col-sm-1"> </div>
<input style="display: none;" type="text" id="IdTiendaOrigen" name="IdTiendaOrigen" value="<?php echo $ID3;?>">
<input style="display: none;" type="text" id="IdTiendaDestino" name="IdTiendaDestino" value="<?php echo $ID4;?>">

<input style="display: none;" type="text" name="TxtStatus" value="PROCESANDO">


<div class="form-group  col-sm-1" id="Tallas">
</div>
<div class="form-group  col-sm-1" id="Cantidad">
</div>
							
							<div id="info">
							
							</div>

							
							<div class="form-group col-sm-1">
								<label for="form-field-select-3" style="color: white;">Fin</label>
								<div>
									<button type="submit" id="envio" class="btn btn-xs btn-success"><i class="fa fa-plus-square"></i> Cargar Item</button>
								</div>
								
							</div>

							</div>
						
						</div>

					</div>
		</form>
				</div>
			</div>
										<!-- Fin Formulario -->  

<div class="col-sm-12 col-xs-12" > <!-- INICIO TABLA -->
<div class="clearfix">
<!-- <div class="pull-left tableTools-container"></div> -->
</div>
<div class="table-header">
    Traslado de Productos
</div>
<div id="tabla"> <!-- AQUI SE CARGA LA INFORMACION DE LA TABLA--> 

    <table style="font-size: 12px;" id="dynamic-table"  class="table table-responsive table-striped table-bordered table-hover" width="100%">
    	<thead>
    		<tr class="warning">
    			<th class="tdcustom" style="width: 3%;">Foto</th>
    			<th class="tdcustom" style="width: 8%;">Código Referencia</th>
    			<th class="tdcustom" style="width: 15%;">Detalle Referencia</th>
    			<th class="tdcustom" style="width: 2%;">Talla</th>
    			<th class="tdcustom" style="width: 2%;">Cantidad</th>
    			<th class="tdcustom" style="width: 1%;">Acciones</th>
    		</tr>
    
    	</thead>
        <tbody>
<?php 
include("Lib/conexion.php");
    $sql="SELECT * FROM t_traslados_detalle WHERE id_user='".$IdUser."' and status='PROCESANDO'";
    $result = $conexion->query($sql);
    if ($result->num_rows>0){
        while ($fil = $result->fetch_assoc()) {
            $id_detalle = $fil['id'];
            $foto = $fil['imagen'];
            $cod_ref_completa = $fil['cod_ref_completa'];
            $romper = explode("-",$cod_ref_completa);
            $Nom_Talla = $romper[1];
            $detalle = $fil['cod_ref_completa'];
            $cantidad = $fil['cantidad'];
            $talla = $fil['talla_id'];
            
           	$ruta_img = utf8_encode($foto);
			$mostrar_img = "miniatura.php?x=50&y=50&file=".$ruta_img;
            ?>
            <tr>
                <td>
                <a class="image-link" href=""><img src="<?php echo utf8_encode($mostrar_img); ?>" width="45px" height="45px"></a>
                </td>
                <td><?php echo $cod_ref_completa;?> </td>
                <td><?php echo $detalle;?> </td>
                <td><?php echo $Nom_Talla;?> </td>
                <td><?php echo $cantidad;?> </td>
                <td><a onclick="miFuncionEliminar(<?php echo $id_detalle;?>)"><i class="ace-icon fa fa-trash-o bigger-110"> </i> Eliminar</a></td>                
            </tr>
            <?php
        }
        
    }
?>        
        </tbody>
     </table>
</div>
<div class="center">
<button type="submit" id="guardar" class="btn btn-xs btn-success"><i class="fa fa-plus-square"></i> GUARDAR</button>
<a href="traslados.php"><button type="reset" id="cancelar" class="btn btn-xs btn-error"><i class="fa fa-plus-square"></i> CANCELAR</button></a>
</div>

</div> <!-- ./FIN TABLA -->
                                        

<script>
 $(".chosen").chosen({
    width: "100%"
 });
</script>
