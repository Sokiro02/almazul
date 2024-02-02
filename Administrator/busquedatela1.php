<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <!--/Inicio Alertas-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link href="https://modasof.com/espejo/assets/css/sweetalert.css" rel="stylesheet">
    <!-- Custom functions file -->
    <script src="https://modasof.com/espejo/assets/js/functions.js"></script>
    <!-- Sweet Alert Script -->
    <script src="https://modasof.com/espejo/assets/js/sweetalert.min.js"></script>
    <!--/Fin Alertas-->
 
</head>
<body>

			<ul class="ace-thumbnails clearfix filtros">
<?php 
$q=$_GET['palabra']; //se recibe la cadena que queremos buscar
if ($q!="") {
  ?>

  <?php

$sql ="SELECT Id_Insumo,Cod_Insumo, Nom_CategoriaIns,Categoria_Id_Categoria_Insumo, Nom_Insumo, Unidad_Insumo, Url_Insumo, Detalle_Insumo from t_insumos as A, t_categorias_insumos as B WHERE A.Categoria_Id_Categoria_Insumo=B.Id_Categoria_Insumo and Concatenar_Bus LIKE '%".$q."%'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Id_Insumo=$row['Id_Insumo'];
        $Nom_CategoriaIns=$row['Nom_CategoriaIns'];
        $Cod_Insumo=$row['Cod_Insumo'];
        $Cod_Proveedor=$row['Cod_Proveedor'];
        $Nom_Insumo=$row['Nom_Insumo'];
        $Url_Insumo=$row['Url_Insumo'];
        $Unidad_Insumo=$row['Unidad_Insumo'];
        $Costo_Insumo=$row['Costo_Insumo'];
        $Promedio=PromedioCostoInsumo($Cod_Insumo);
 ?>
										<li class="<?php echo($Nom_CategoriaIns);?>">
											
							<img width="90" height="90" alt="150x150" src="<?php echo ($Url_Insumo); ?>" data-name="<?php echo $Nom_Insumo; ?>" data-price="<?php echo $Promedio; ?>" data-foto="<?php echo ($Url_Insumo); ?>" data-unidad="<?php echo $Unidad_Insumo; ?>" class="img-responsive product_drag" />
												
												<div class="tags">
													<span class="label-holder">
														
    <span id="InsumoSel<?php echo $Id_Insumo;?>" data-id="<?php echo $Cod_Insumo;?>"  class="label label-success arrowed"><i class="fa fa-plus-square"> </i></span>
<input style="display: none;" type="text" name="ValorCod" id="ValorCod<?php echo $Id_Insumo;?>" value="<?php echo $Cod_Insumo; ?>">
                     
														
													</span>
													<span class="label-holder">
														<span class="label label-info">Cód:<?php echo $Cod_Insumo; ?></span>
													</span>

												<!-- 	<span class="label-holder">
														<span class="label label-info"><?php echo $Nom_Insumo; ?></span>
													</span> -->
												</div>
											
										</li>
                    <script type="text/javascript">
  $("#InsumoSel<?php echo $Id_Insumo;?>").click(function(){
    var ValorCod = $("#ValorCod<?php echo $Id_Insumo;?>").val();
    var dataString = 'Tela1='+ ValorCod;
    $.ajax({//metodo ajax
type: "GET",//aqui puede  ser get o post
url: "Producto-Crear.php",//la url adonde se va a mandar la cadena a buscar
data: dataString,
//cache: false,
success: function(html){//funcion que se activa al recibir un dato
$("#ResultadoTela1").html(html).show();// funcion jquery que muestra el div con identificador display, como formato html, tambien puede ser .text
}
});
});
</script>
									 <?php 
         }
}
else
{
	Echo("<h5>Lo sentimos no se encontraron resultados en su búsqueda</h5>");
}
}
          ?>
									</ul>

 
 </body>
</html> 
