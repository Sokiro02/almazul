<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];
//SINO EXISTE LA SESSION KEY, CREAR UNA..
if (!isset($_SESSION['KEY'])){
    $KeyTemporal = rand(1001,9999);
    $_SESSION['KEY']=$KeyTemporal;
}
//echo $_SESSION['KEY'];
$variable = $_GET['RefSel']; 
$_SESSION['referencia'] = $variable; 


include("Lib/permisos.php");
date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');
if (isset($_GET['RefSel'])){
 $Cod_Referencia = $_GET['RefSel'];

 //OBTENER LA REFERENCIA DESDE LA TABLA REFERENCIAS
  $query = mysqli_query($conexion, "SELECT * FROM t_referencias WHERE Cod_Referencia='$Cod_Referencia'")
                                  or die('error '.mysqli_error($mysqli));                                
  $data = mysqli_fetch_assoc($query);
  $IdReferencia= $data['Id_Referencia'];
  $_SESSION['Id_Referencia']=$IdReferencia;
  $imagen = $data['Img_Referencia'];
  $coleccion = $data['Coleccion_Id_Coleccion'];
  $Nombre_Coleccion = $data['Coleccion_Nom_Coleccion']; 
  $Categoria_Id_Categoria_Prod = $data['Categoria_Id_Categoria_Prod'];
  $SubCategoria_Id_Subcategoria_Prod = $data['SubCategoria_Id_Subcategoria_Prod'];
  $Insumo_Ppal = $data['Insumo_Ppal'];
  $Tipo_Tela = $data['Tipo_Tela'];
  $Color_Insumo_Ppal = $data['Color_Insumo_Ppal'];
  $Insumo_Sec = $data['Insumo_Sec'];
  
  $Estado_Ref = $data['Estado_Ref'];
  
  $Costo_Proyectado_Pref=$data['Costo_Proyectado_Pref'];
  $_SESSION['Costo_Proyectado']=$Costo_Proyectado_Pref;
  
  $V_Mano_Obra_Ref=$data['V_Mano_Obra_Ref'];
  $PVP_Ref=$data['PVP_Ref'];
  $P_Mayor=$data['P_Mayor'];
  $Detalle_Referencia=$data['Detalle_Referencia'];
  $Ref_Publicada=$data['Ref_Publicada'];
  $Tipo_Referencia=$data['Tipo_Referencia'];
  $Ref_Antigua=$data['Ref_Antigua'];
  $Detalle_Antiguo=$data['Detalle_Antiguo'];
  $Creado_Por=$data['Creado_Por'];
  $Modificado_Por=$data['Modificado_Por'];
  
//OBTENER CATEGORIA  
 $sql ="SELECT Cod_Cat_Producto,Nom_Cat_Producto FROM t_categoria_producto WHERE Id_Cat_Producto='".$Categoria_Id_Categoria_Prod."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $CategoriaProducto=$row['Nom_Cat_Producto'];
      $CodigoCategoria=$row['Cod_Cat_Producto'];            
 }
}

//OBTENER SUB CATEGORIA
$sql ="SELECT Cod_SubCat_Producto,Nom_SubCat_Producto FROM t_subcategoria_producto WHERE Id_SubCat_Producto='".$SubCategoria_Id_Subcategoria_Prod."'";  
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $SubCategoria=$row['Nom_SubCat_Producto'];
      $CodigoSubCategoria=$row['Cod_SubCat_Producto'];         
 }
}

//OBTENER DATOS DE INSUMO PRINCIPAL
$sql_insumos ="SELECT * FROM t_insumos WHERE Cod_Insumo='".$Insumo_Ppal."'";  
//Echo($sql);
$result_insumos = $conexion->query($sql_insumos);
if ($result_insumos->num_rows > 0) {
    while ($row_ins = $result_insumos->fetch_assoc()) {
        $Id_Insumo_Ppal=$row_ins['Id_Insumo'];
        $Nombre_insumo_ppal = $row_ins['Nom_Insumo'];
 }
}

//OBTENER DATOS DE INSUMO SECUNDARIO
$sql_insumos_SEC ="SELECT * FROM t_insumos WHERE Cod_Insumo='".$Insumo_Sec."'";  
//Echo($sql);
$result_insumosS = $conexion->query($sql_insumos_SEC);
if ($result_insumosS->num_rows > 0) {
    while ($row_insS = $result_insumosS->fetch_assoc()) {
        $Id_Insumo_Sec=$row_insS['Id_Insumo'];
        $Cod_Insumo_Sec = $row_insS['Cod_Insumo'];
        $Nombre_insumo_sec = $row_insS['Nom_Insumo'];
 }
}


//OBTENER LOS INSUMOS DE LAS REFERENCIAS
// Eliminar Diseño en Tabla Temporal 
$sql ="DELETE FROM t_temporal_ref2 WHERE Orden_Temporal='".$IdUser."'";
//$sql ="DELETE FROM t_temporal_ref2 WHERE Orden_Temporal='".$IdUser."' and Referencia_Temporal='".$Cod_Referencia."' and key_temp='".$KeyTemporal."'";
$result = $conexion->query($sql);




// Bucle para conocer los codigos que se requieren para el producto 
$sql ="SELECT Cod_Insumo FROM t_insumos_ref WHERE Referencia_Cod_Referencia='".$Cod_Referencia."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$ListaInsumos=$ListaInsumos.$row['Cod_Insumo'].",";                  
 }
}
$CadenaInsumos=explode(",", $ListaInsumos);
//Split al Arreglo
$longitud = count($CadenaInsumos);
$min=$longitud-1;
//Recorro todos los elementos

for($i=0; $i<$min; $i++)
{

// Consulta Cantidad utilizada por Código  
$sql ="SELECT Cant_Solicitada,Cod_Insumo,Costo_Insumo_Ref from t_insumos_ref where Cod_Insumo='".$CadenaInsumos[$i]."' and Referencia_Cod_Referencia='".$Cod_Referencia."'"; 
//echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$Cantidad_Solicitada = $row['Cant_Solicitada'];
 $Codigo_insumo =$row['Cod_Insumo'];
  $Costo_insumo_ref = $row['Costo_Insumo_Ref'];
 }
}

$sql ="SELECT Nom_Insumo from t_insumos where Cod_Insumo='".$CadenaInsumos[$i]."' and SubCategoria_Id_Subcategoria_Insumo<>'0'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    $Nombre_Insumo =$row['Nom_Insumo'];
 }
}

$sql ="SELECT Unidad_Insumo from t_insumos where Cod_Insumo='".$CadenaInsumos[$i]."' and SubCategoria_Id_Subcategoria_Insumo<>'0'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    $UnidadInsumo = $row['Unidad_Insumo'];
 }
}

$sql ="SELECT DISTINCT(Url_Insumo) from t_insumos where Cod_Insumo='".$CadenaInsumos[$i]."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    $ImagenI = $row['Url_Insumo'];
 }
}

$sql ="SELECT Costo_Insumo as ValPromedio from t_insumos where Cod_Insumo='".$CadenaInsumos[$i]."' ORDER by Id_Insumo DESC LIMIT 1";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
     $Costo_I = $row['ValPromedio'];
 }
}

$Valor_Temporal = $Costo_I * $Cantidad_Solicitada;
   //GUARDAR EN LA TABLA TEMPORAL DE INSUMOS
                $sqlg="INSERT INTO t_temporal_ref2 (Cod_Temporal,Nom_Temporal, Img_Temporal, Cant_Temporal,Unidad_Temporal, 
                Prom_Temporal, Valor_Temporal,Orden_Temporal,Referencia_Temporal) 
                VALUES ('".$Codigo_insumo."','".$Nombre_Insumo."','".$ImagenI."','".$Cantidad_Solicitada."','".$UnidadInsumo."',
                '".$Costo_I."','".$Valor_Temporal."','".$IdUser."','".$Cod_Referencia."')";
                $result = $conexion->query($sqlg);
}

/////////////////////////////////////////////////////////////////////////////
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Modificar Referencia Modasof</title>

		<meta name="description" content="Common form elements and layouts" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		 <!-- Notificaciones Push -->
		<script src="https://modasof.com/espejo/assets/js/push.min.js"></script>
		

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/jquery-ui.custom.min.css" />
		
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <link href="https://modasof.com/espejo/assets/css/sweetalert.css" rel="stylesheet">
    <!-- Custom functions file -->
    <script src="https://modasof.com/espejo/assets/js/functions.js"></script>
    <!-- Sweet Alert Script -->
    <script src="https://modasof.com/espejo/assets/js/sweetalert.min.js"></script>
    <!--/Fin Alertas-->
     <!-- Inicio Libreria formato moneda -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
<script src="https://modasof.com/espejo/assets/js/jquery.maskMoney.js" type="text/javascript"></script>

<script src="https://modasof.com/espejo/assets/js/chosen.jquery.js" type="text/javascript"></script>
<script src="https://modasof.com/espejo/assets/js/ImageSelect.jquery.js" type="text/javascript"></script>

  <link rel="stylesheet" href="https://modasof.com/espejo/assets/css/ImageSelect.css">

    <?php include("Lib/Favicon.php") ?>

		<script language='javascript'>
			$(function(){
				$('#envio').on('click', function (e){
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
					paqueteDeDatos.append('fotoportada', $('#id-input-file-3')[0].files[0]);
					paqueteDeDatos.append('TxtCategoria', $('#TxtCategoria').prop('value'));
					paqueteDeDatos.append('TxtSubCategoria', $('#TxtSubCategoria').prop('value'));
                    paqueteDeDatos.append('TxtInsumo1', $('#TxtInsumo1').prop('value'));
                    paqueteDeDatos.append('TxtInsumo2', $('#TxtInsumo2').prop('value'));
                    paqueteDeDatos.append('TxtTotalCosto', $('#TxtTotalCosto').prop('value'));
                    paqueteDeDatos.append('TxtManodeObra', $('#TxtManodeObra').prop('value'));
                    paqueteDeDatos.append('TxtColeccion', $('#TxtColeccion').prop('value'));
                    paqueteDeDatos.append('demo2', $('#demo2').prop('value'));
                    paqueteDeDatos.append('demo3', $('#demo3').prop('value'));
                    paqueteDeDatos.append('TxtDetalle', $('#TxtDetalle').prop('value'));
                    paqueteDeDatos.append('Consecutivo_Prod', $('#Consecutivo_Prod').prop('value'));
					paqueteDeDatos.append('TxtNomAnterior', $('#TxtNomAnterior').prop('value'));
					paqueteDeDatos.append('TxtDetalleAnterior', $('#TxtDetalleAnterior').prop('value'));
					paqueteDeDatos.append('TipoReferencia', $('#TipoReferencia').prop('value'));
                    paqueteDeDatos.append('Modificar', 'Modificar');
          			document.getElementById("envio").value = "MODIFICANDO...";
                    document.getElementById("envio").disabled = true;                    
					var destino = "pruebas.php"; // El script que va a recibir los campos de formulario.
					/* Se envia el paquete de datos por ajax. */
					$.ajax({
						url: destino,
						type: 'POST', // Siempre que se envíen ficheros, por POST, no por GET.
						contentType: false,
						data: paqueteDeDatos, // Al atributo data se le asigna el objeto FormData.
						processData: false,
						cache: false, 
						success: function(resultado){ // En caso de que todo salga bien.
							console.log(resultado);
                            alert("Todo Excelente, Datos guardados con exito.");
                            <?php 
                            $LaRef=$_GET['RefSel'];
                            ?>
                            var var12 ='<?php Echo($LaRef); ?>';
                            document.location.href = "Producto-modificar.php?RefSel=" + var12+"&Mensaje=123";
						},
						error: function (){ // Si hay algún error.
							alert("Algo ha fallado. Verifique que toda la información es correcta");
                            var var1 ="21";
                            document.getElementById("envio").value = "Enviar";
                            document.getElementById("envio").disabled = false; 
                            document.location.href = "Producto-modficar.php?Mensaje=" + var1 + "&";
                            //document.location.href = "www.google.com";							
						}
					});
				});
			});
		</script>

    
    <script type="text/javascript">
$(document).ready(function(){
    $select = $('#TxtManodeObra'); //Seleccionar mano de obra 
    $select.trigger('change'); //Para cambiar el costo de produccion		
    $(".busca").keyup(function(){ //se crea la funcioin keyup
        var texto = $(this).val();//se recupera el valor de la caja de texto y se guarda en la variable texto
        var dataString = 'palabra='+ texto;//se guarda en una variable nueva para posteriormente pasarla a busqueda.php
        
        if(texto==''){//si no tiene ningun valor la caja de texto no realiza ninguna 
            //ninguna acción
        }else{
        
        //pero si tiene valor entonces
        $.ajax({//metodo ajax
            type: "GET",//aqui puede  ser get o post
            url: "busqueda2.php",//la url adonde se va a mandar la cadena a buscar
            data: dataString,
            //cache: false,
            success: function(html){//funcion que se activa al recibir un dato
            $("#display").html(html).show();// funcion jquery que muestra el div con identificador display, como formato html, tambien puede ser .text
            }
        });

}
return false;    
});
});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		var VerificarOrden='<?php Echo($IdUser); ?>';
		var miUser = 'Validacion='+ VerificarOrden;
		$.ajax({
			type:"Post",
			url:"AgregarInsumosAjax2.php",
			data:miUser,
			success: function(html){//funcion que se activa al recibir un dato
                $("#tablainsumos").html(html).show();// funcion jquery que muestra el div con identificador display, como formato html, tambien puede ser .text
                //location.reload();
}
		});
	});
</script>
<script>
$(document).ready(function(){
   $("#TxtCategoria").change(function () {
           $("#TxtCategoria option:selected").each(function () {
            Select1 = $(this).val();
           // var Select2 = $("#TxtSubCategoria option:selected").val();
            //var Select3 = $("#TxtInsumoSel option:selected").val();
            //alert(Select1)
            $.post("refcat.php", { Select1: Select1}, function(data){
                $("#Cat").html(data); 
            });            
        });
   })
});
</script>
<script>$(document).ready(function(){
//  $("#sel").val("3");
});
</script>

<script>
$(document).ready(function(){
   $("#TxtSubCategoria").change(function () {
           $("#TxtSubCategoria option:selected").each(function () {
            Select1 = $(this).val();
            $.post("refsubcat.php", { Select1: Select1}, function(data){
                $("#SubCat").html(data); 
            });            
        });
   })
});
</script>

<script>
//$(document).ready(function(){
//   $("#TxtSubCategoria").change(function () {
//            IdConsulta ='<?php Echo($IdUser); ?>' ;
//            //Envio por ajax para crear lista de insumos
//            $.post("reflistainsumos.php", { IdConsulta: IdConsulta}, function(data){
//                $("#SelectTelas").html(data); 
//           });            
//   });
//});
</script>
<script>
//$(document).ready(function(){
//   $("#TxtSubCategoria").change(function () {
//            IdConsulta ='<?php Echo($IdUser); ?>' ;
            //Envio por ajax para crear lista de insumos
//            $.post("reflistainsumos3.php", { IdConsulta: IdConsulta}, function(data){
//                $("#SelectTelas2").html(data); 
//            });            
//   });
//});
</script>
<script>
$(document).ready(function(){
   $("#TxtManodeObra").change(function () {
           $("#TxtManodeObra option:selected").each(function () {
            Select1 = $(this).val();
            $.post("refcost2.php", { Select1: Select1}, function(data){
                $("#Total").html(data); 
            });            
        });
   })
});
</script>





	</head>

	<body class="skin-1">

	<?php 
  $Valide=$_GET['Mensaje'];

    if ($Valide==5) {
        echo "<script>jQuery(function(){swal(\"¡Lo Sentimos!\", \"Imagen demasiado grande\", \"error\");});</script>";
    };
    if ($Valide==21) {
        echo "<script>jQuery(function(){swal(\"¡Lo Sentimos!\", \"Datos Incorrectos Error al guardar\", \"error\");});</script>";
    };
     if ($Valide==111) {
        echo "<script>jQuery(function(){swal(\"¡Verifique el peso de la imagen!\", \"Ref. No Creada\", \"error\");});</script>";
    };

    if ($Valide==551) {
        echo "<script>jQuery(function(){swal(\"¡No selecciono Tipo de Producto!\", \"Ref. No Creada\", \"error\");});</script>";
    };
    if ($Valide==552) {
        echo "<script>jQuery(function(){swal(\"¡No Selecciono la Categoria!\", \"Ref. No Creada\", \"error\");});</script>";
    };
    if ($Valide==553) {
        echo "<script>jQuery(function(){swal(\"¡No selecciono Insumo Ppal!\", \"Ref. No Creada\", \"error\");});</script>";
    };
    if ($Valide==554) {
        echo "<script>jQuery(function(){swal(\"¡No Selecciono Insumo Ppal!\", \"Ref. No Creada\", \"error\");});</script>";
    };

    if ($Valide==1) {
        echo "<script>jQuery(function(){swal(\"¡ Insumo  Agregado!\", \"Correctamente \", \"success\");});</script>";
    };
      if ($Valide==123) {
        echo "<script>jQuery(function(){swal(\" Referencia Actualizada\", \"Correctamente \", \"success\");});</script>";
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
								<i class="ace-icon fa fa-magic"></i>
								<a href="Producto-Crear.php">Crear Referencia</a>
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
<form action="#" method="post" id="FormProducto" enctype="multipart/form-data" autocomplete="off">
 <div class="form-group col-sm-3 col-xs-12"><!-- div Imagen del producto -->
	<script>
    function ValidateSize(file) {
        var FileSize = file.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 1.5) {
            //alert('La imagen excede los 1.5 MB, El sistema dara error al guardar dicha imagen');
            //document.getElementById("fotoportada").value = "";
            $('#fotoportada').trigger('fileselect', [1, ""]);
            return;
           //$("#fotoportada").val(''); //for clearing with Jquery
        } else {

        }
    }
    </script>			
	
				<input name="fotoportada" height="200"  type="file" id="id-input-file-3" class="col-xs-10 col-sm-5" />
		
</div><!-- Fin imagen del producto -->

		<h3><i class="fa fa-search"></i> Busqueda de Insumos</h3>

     <input type="text" class="busca nav-search-input input-xxlarge"   id="caja_busqueda nav-search-input" name="clave" placeholder="Busque el insumo aquí y haga clic en Agregar"/>
     <br />
      

<div id="display"  class="col-sm-9 col-xs-12" style="height:400px;overflow:scroll;">
								
</div>
<?php 

 ?>
<div class="col-sm-12 col-xs-12">
 <h3>Detalle de Insumos</h3>  
                <div class="table-responsive">  
                     <table class="table table-bordered"> 
                     <thead> 
                          <tr class="info">  
                              <th width="10%">Img.</th>
                               <th width="25%">Codigo - Nombre Insumo </th>  
                               <th class="center" width="8%">Cantidad</th> 
                               <th width="15%">Precio Prom.</th> 
                               <th width="15%">Total.</th>  
                               <th width="10%">Accion</th>  
                          </tr> 
                       </thead>
                       <tbody id="tablainsumos"> 
                          
                     </tbody> 
              
                
           </table>  
       </div>
</div>
<div class="col-sm-12 col-xs-12"> <!-- Inicio Campos Ref. Producto -->
	 <h5><i class="fa fa-check"></i> Producto REF: 
 <span id="Cat" class="blue"></span><span id="SubCat" class="blue"></span><span id="TelaSel" class="blue"></span><span class="blue"> 
<?php echo $Cod_Referencia; ?></span>

  <input style="display: none;" type="text" id="Consecutivo_Prod" name="Consecutivo_Prod" style="" value="<?php Echo($Cod_Referencia); ?>">
  <input type="text" name="TipoReferencia" style="display: none;" value="1">

   </h5>


 <div class="form-group col-sm-3 col-xs-12">
                              <label for="form-field-select-3">Producto</label>

                              <div>
                        <select class="input-xxlarge" id="TxtCategoria" name="TxtCategoria" data-placeholder="Seleccionar..." disabled="">
                            <option value="<?php echo $Categoria_Id_Categoria_Prod;?>"><?php echo $CategoriaProducto; ?></option>
                            <?php
$sql ="SELECT Id_Cat_Producto, Nom_Cat_Producto FROM t_categoria_producto order by Nom_Cat_Producto ASC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $SelectId_Cat=$row['Id_Cat_Producto'];
      $SelectNom_Cat=$row['Nom_Cat_Producto'];             
      echo ("<option value='".$SelectId_Cat."'>".utf8_encode($SelectNom_Cat)."</option>");
 }
}
        
?>  
                                  
                        </select>
                              </div>
  </div>

  <div class="form-group col-sm-3 col-xs-12">
                              <label for="form-field-select-3">Categoria</label>
                              <div>
                        <select class=" input-xxlarge" id="TxtSubCategoria" name="TxtSubCategoria" data-placeholder="Seleccionar..." disabled="">
                            <option value="<?php echo $SubCategoria_Id_Subcategoria_Prod;?>"><?php echo $SubCategoria;?></option>
                        <?php
$sql ="SELECT Id_SubCat_Producto, Nom_SubCat_Producto FROM t_subcategoria_producto order by Nom_SubCat_Producto ASC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $SelectId_SubCat=$row['Id_SubCat_Producto'];
      $SelectNom_SubCat=$row['Nom_SubCat_Producto'];             
      echo ("<option value='".$SelectId_SubCat."'>".utf8_encode($SelectNom_SubCat)."</option>");
 }
}
        
?>  
                        </select>
                              </div>
  </div>
  
  <!-- Selects Listados con Ajax -->
   <div class="form-group col-sm-3 col-xs-12" id="SelectTelas">
        <label for="form-field-select-3">Insumo  Principal</label>

      <div>
            <select class="input-xxlarge" id="TxtInsumo1" name="TxtInsumo1" data-placeholder="Seleccionar..." disabled="true">
                        <option value="<?php echo $Id_Insumo_Ppal; ?>"><?php echo $Insumo_Ppal." - ".$Nombre_insumo_ppal; ?></option>
                         <?php

                        $sql ="SELECT * from t_temporal_ref2 WHERE Orden_Temporal ='".$IdUser."'"; 
                        //Echo($sql);
                        $result = $conexion->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {                
                                //$Sel_Id_Insumo=$row['Id_Insumo'];
                                $Sel_Cod_Temporal=$row['Cod_Temporal'];
                                $Sel_Nom_Temporal=$row['Nom_Temporal'];
                               ?>
                               <option value="<?php Echo($Sel_Id_Insumo); ?>"><?php Echo($Sel_Cod_Temporal." - ".$Sel_Nom_Temporal); ?></option>
                               <?php
                            }
                        }
                        //header("location:index.php");
                         ?>
                    </select>
      </div>
   </div>
   
   <div class="form-group col-sm-3 col-xs-12" id="SelectTelas2">
   
        <label for="form-field-select-3">Insumo  Secundario</label>
        <div>
                <select class="input-xxlarge" id="TxtInsumo2" name="TxtInsumo2" data-placeholder="Seleccionar...">
                            <option value="<?php echo $Id_Insumo_Sec; ?>"><?php echo $Cod_Insumo_Sec." - ".$Nombre_insumo_sec; ?></option>
                             <?php

                        $sql ="SELECT * from t_temporal_ref2 WHERE Orden_Temporal ='".$IdUser."'"; 
                        //Echo($sql);
                        $result = $conexion->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {                
                                $Sel_Id_Insumo=$row['Id_Temporal'];
                                $Sel_Cod_Temporal=$row['Cod_Temporal'];
                                $Sel_Nom_Temporal=$row['Nom_Temporal'];
                               ?>
                               <option value="<?php Echo($Sel_Id_Insumo); ?>"><?php Echo($Sel_Cod_Temporal." - ".$Sel_Nom_Temporal); ?></option>
                               <?php
                            }
                        }
                         ?>
                        </select>
                        <script>
                            document.ready = document.getElementById("TxtInsumo2").value = '<?php echo $Id_Insumo_Sec; ?>';
                            $(document).ready(function(){
                               $("#TxtInsumo2").val("<?php echo $Id_Insumo_Sec; ?>");
                            });
                        </script>

        </div>
   </div>

  <!-- Fin Selects  -->
  <div class="col-xs-12 col-sm-12">
  <h5><i class="fa fa-money"></i> Costos del Producto </h5>
  <div style="display: none;" class="form-group col-sm-3 col-xs-12">
                              <label for="form-field-select-3">Vr. Mano de Obra</label>
                              <div>
                        <select class="input-xxlarge" id="TxtManodeObra" name="TxtManodeObra" data-placeholder="Seleccionar...">
                            <option value="<?php echo $V_Mano_Obra_Ref;?>"><?php echo "$".number_format($V_Mano_Obra_Ref,0,'.', '.'); ?></option>
                        <?php
                        for ($i=0; $i <200000 ; $i+=1000) { 
                        	Echo("<option value='".$i."'>$".number_format($i, 0,'.', '.')."</option>");
                        }
        
							?>  
                        </select>
                              </div>
  </div>
<div style="display: none;" class="form-group col-sm-3 col-xs-12" id="Total">
       <label for="form-field-select-3">Total Costo Proyectado</label>
         <div>
         	<input class="input-xlarge" id="TxtTotalCosto" name="TxtTotalCosto" type="text" disabled="true" value="<?php Echo(formatomoneda($Costo_Proyectado_Pref)) ?>" />
         </div>                       
</div>
<div class="form-group col-sm-3 col-xs-12">
              <label for="form-field-select-3">P.V.P</label>
                              <div>
                          <input class="input-xlarge" type="text" id="demo2" placeholder="Costo Proveedor 1" name="demo2"  required="true" value="<?php Echo(formatomoneda($PVP_Ref)) ?>" />
                                </div>
                                <script type="text/javascript">     
$("#demo2").maskMoney({
prefix:'$ ', // The symbol to be displayed before the value entered by the user
allowZero:false, // Prevent users from inputing zero
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
<div class="form-group col-sm-3 col-xs-12">
              <label for="form-field-select-3">Precio al Mayor</label>
                              <div>
                          <input class="input-xlarge" type="text" id="demo3" placeholder="" name="demo3"  required="true" value="<?php Echo(formatomoneda($P_Mayor)) ?>"/>
                                </div>
                                <script type="text/javascript">     
$("#demo3").maskMoney({
prefix:'$ ', // The symbol to be displayed before the value entered by the user
allowZero:false, // Prevent users from inputing zero
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
</div>
<div class="col-sm-12 col-xs-12">
	<h5> <i class="fa fa-cogs"></i> Caracteristicas</h5>
  <div class="form-group col-sm-3 col-xs-12">
                              <label for="form-field-select-3">Nombre Coleccion</label>

                              <div>
                        <select class=" input-xxlarge" id="TxtColeccion" name="TxtColeccion" data-placeholder="Seleccionar...">
                            <option value="<?php Echo($coleccion) ?>"><?php Echo($Nombre_Coleccion) ?></option>
                            <?php
$sql ="SELECT Id_Coleccion,Nom_Coleccion FROM t_colecciones order by Nom_Coleccion ASC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $SelectId_Coleccion=$row['Id_Coleccion'];
      $SelectNom_Coleccion=$row['Nom_Coleccion'];             
      echo ("<option value='".$SelectId_Coleccion."'>".utf8_encode($SelectNom_Coleccion)."</option>");
 }
}
        
?>  
                                  
                        </select>
                              </div>
  </div>
   <div class="form-group col-sm-3 col-xs-12">
                              <label for="form-field-select-3">Referencia Antigua</label>

                              <div>
                       <input type="text" id="TxtNomAnterior" name="TxtNomAnterior" class="input-xlarge" value="<?php echo ($Ref_Antigua)?>">
                              </div>
  </div>
  <div class="form-group col-sm-6 col-xs-12">
                              <label for="form-field-select-3">Detalle Prenda (Antigua)</label>

                              <div>
                       <input type="text" id="TxtDetalleAnterior" name="TxtDetalleAnterior" class="input-xxlarge" value="<?php echo ($Detalle_Antiguo)?>">
                              </div>
  </div>
  

</div>
<div class="col-xs-12 col-sm-12">
	 <div class="form-group col-sm-6 col-xs-12">
                      <label for="form-field-9">Caracteristicas</label>

                  <textarea class="autosize-transition form-control" id="TxtDetalle" name="TxtDetalle" id="form-field-9" rows="5" maxlength="2000"><?php echo ($Detalle_Referencia)?></textarea>
                  </div>

      <div class="form-group col-sm-6 col-xs-12" style="margin-top: 12px;">
      		    <!-- <a href='#' id='envio' class='btn btn-primary btn-lg'>Enviar Datos</a> -->
				<!--														  
				<button type="submit" class="btn btn-inverse btn-xlg" id="envio" value="GUARDAR REFERENCIA..">
      			   <i style="margin: 10px;" class="fa fa-save"></i> 
      		    </button> -->
			<input type="submit" class="btn btn-primary btn-lg fa fa-save" id="envio" value="MODIFICAR REFERENCIA.."/>
            
            													   
      </div>
</div>


</div>

                   
</form>
	
</div><!-- Fin Panel Inferior -->



							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->



<!-- Inicio Modal -->
		<div id="modal-form2" class="modal" tabindex="-1">
							<div class="modal-dialog ">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="black bigger"><i class="fa fa-pie-chart"> Proveedores</i></h4>
											</div>

											<div class="modal-body">
												<!-- <div class="row col-xs-12 col-sm-12"> -->
												
						<div class="row">
							
							<div class="col-sm-10 col-xs-12 center">
								
							
								<div class="center " id="grafica">
									<img src="http://Modasofaute.net/Administrator/Images/Perfiles/7160-logoTek.png">
								</div>
								</div>
						</div>
												<!-- </div> -->
											<div class="modal-footer">
												<button class="btn btn-sm btn-danger" data-dismiss="modal">
													<i class="ace-icon fa fa-times"></i>
													Cerrar
												</button>
											</div>
										</div>
									</div>
								</div>
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

		<script src="https://modasof.com/espejo/assets/js/jquery.magnific-popup.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.magnific-popup.min.js"></script>

		<script type="text/javascript">


			 $(document).on('click', '.remove_product', function(){  
           if(confirm("¿Seguro que quieres eliminar este insumo?"))  
           {  
                var id = $(this).attr("id");  
                //var action="delete";  
                $.ajax({  
                     url:"AgregarInsumosAjax2.php",  
                     method:"POST",  
                     data:{id:id},  
                     success:function(data){  
                          $('#tablainsumos').html(data);
                          $select = $('#TxtManodeObra'); //Seleccionar mano de obra 
                          $select.trigger('change'); //Para cambiar el costo de produccion
                     }  
                });  
           }  
           else  
           {  
                return false;  
           }  
      }); 
		</script>

<?php 
//SCRIPT PARA MODIFICAR LA CANTIDAD DE UN INSUMO
?>
        
<script type="text/javascript">
            $(document).on('click', '.modify_product', function(){  
            var idmodificar = $(this).attr("id");
           if(confirm("¿Seguro que quieres modificar este insumo?"))  
           {  
            var Nombre = "Modificar Insumo";
            
            swal({
            title: Nombre,
              text: "Indique la nueva cantidad solicitada del Insumo:",
              type: "input",
              inputType: "number",
              //inputValue: "1",
              showCancelButton: true,
              closeOnConfirm: false,
              inputPlaceholder: "Decimales separados con punto o coma"
             }, function (inputValue) {
              if (inputValue === false) return false;
              if (inputValue === "") {
                swal.showInputError("¡Tienes que indicar la cantidad!");
                return false
              }
              swal("Correcto!", "A solicitado: " + inputValue, "success");            
                            //var div1 = document.getElementById("modify_product");
                            //var idmodificar = div1.getAttribute("id");
                            //var $this = $(this);
                            //var idmodificar = $this.id;
                            $.ajax({  
                                 url:"AgregarInsumosAjax3.php",  
                                 method:"POST",  
                                 data:{idmodificar:idmodificar,inputValue:inputValue},  
                                 success:function(data){  
                                      $('#tablainsumos').html(data);
                                      $select = $('#TxtManodeObra'); //Seleccionar mano de obra 
                                      $select.trigger('change'); //Para cambiar el costo de produccion
                                 }  
                            });  
                       });
                       }  
                       else  
                       {  
                            return false;  
                       }  
                  }); 
            
</script>        
        
        
     <script type="text/javascript">
        $(document).ready(function()
        {
             $("#FormProducto").validate({
              errorElement: 'div',
          errorClass: 'help-block',
          focusInvalid: true,
          ignore: "",
                 rules: {
                     "TxtCategoria": { required:true },
                     "TxtSubCategoria": { required:true },
                     "TxtInsumo1":{required:true},
                     "TxtColor1":{required:true},
                     "TxtColeccion":{required:true},
                     "fotoportada": { required:true }, 
                     "demo2": { required:true }, 
                     "demo3": { required:true }, 
                     "TxtDetalle":{required:true},
                 },
                 
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
					btn_choose: 'Seleccione la Imagen del Producto',
					btn_change: 'Modificar imagen',
					no_icon: 'ace-icon fa fa-cloud-upload',
					droppable: true,
					maxSize: 1500000,//bytes
					allowExt: ["jpeg", "jpg", "png", "gif"],
					allowMime: ["image/jpg", "image/jpeg", "image/png", "image/gif"],
					thumbnail: 'fit'//large | fit
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
				}).on('file.error.ace', function(ev, info) {
					if(info.error_count['ext'] || info.error_count['mime']) alert('Tipo de archivo invalido, por favor seleccione una imagen!');
					if(info.error_count['size']) alert('Tamaño de archivo invalido, Max 1.5MB');
					
					//you can reset previous selection on error
					//ev.preventDefault();
					//file_input.ace_file_input('reset_input');
				});
				
				
				$('#id-input-file-3').ace_file_input('show_file_list', [
					{type: 'image', name: 'Imagen', path: '<?php echo $imagen; ?>'},
					//{type: 'file', name: 'hello.txt'}
				]);
			
				
				
			
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
<?php
}else{
    echo "No se  ha recibido codigo de referencia ";
    exit;
}
?>