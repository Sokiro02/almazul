<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

$ValueCod=$_POST['ValorCod'];
$inputValue=$_POST['inputValue'];
$ImgInsumo=$_POST['ImgInsumo'];
$PromInsumo=$_POST['PromInsumo'];
$Nombre=$_POST['Nombre'];
$UnidadInsumo=$_POST['UnidadInsumo'];
$ValorTotal=$inputValue*$PromInsumo;

if ($ValueCod!="") { // Validamos si llega un Código
	$sql ="SELECT Cod_Temporal From t_temporal_ref WHERE Cod_Temporal='".$ValueCod."'"; // Consulta para confirmar si está agregado
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $ValidaCod=$row['Cod_Temporal'];
      }
  }
// Fin de la Consulta 


if ($ValidaCod=="") { // Si es igual a vacia insertamos dato e imprimimos la tabla con consulta por IdUser

// Inicio del Insert
$sql=("INSERT INTO t_temporal_ref (Cod_Temporal,Nom_Temporal, Img_Temporal, Cant_Temporal,Unidad_Temporal, Prom_Temporal, Valor_Temporal,Orden_Temporal) VALUES ('".$ValueCod."','".$Nombre."','".$ImgInsumo."','".$inputValue."','".$UnidadInsumo."','".$PromInsumo."','".$ValorTotal."','".$IdUser."') ");
//Echo($sql);
$result = $conexion->query($sql);
// Fin del Insert 

// Inicio Consulta para dibujar tabla
$sql ="SELECT Cod_Temporal, Nom_Temporal,Img_Temporal, Cant_Temporal,Unidad_Temporal, Prom_Temporal, Valor_Temporal From t_temporal_ref WHERE Orden_Temporal='".$IdUser."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Tb_Cod_Temporal=$row['Cod_Temporal'];
        $Tb_Nom_Temporal=$row['Nom_Temporal'];
        $Tb_Img_Temporal=$row['Img_Temporal'];
        $Tb_Cant_Temporal=$row['Cant_Temporal'];
        $Tb_Unidad_Temporal=$row['Unidad_Temporal'];
        $Tb_Prom_Temporal=$row['Prom_Temporal'];
        $Tb_Valor_Temporal=$row['Valor_Temporal'];
 ?>
 <tr> 
                          <td><img width="35" height="35" src="<?php Echo($Tb_Img_Temporal) ?>"/></td> 
                          <td>
                          <?php Echo($Tb_Cod_Temporal." - ".$Tb_Nom_Temporal); ?>
                          <input style="display:none;" name="TxtCod[]" type="text" value="<?php Echo($Tb_Cod_Temporal) ?>"/>
                          </td>  
                         <td>
                         <?php Echo(round($Tb_Cant_Temporal,1)." ".$Tb_Unidad_Temporal) ?>
                         <input style="display:none;" name="TxtCant[]" type="text" value="<?php Echo($Tb_Cant_Temporal) ?>"/>
                         </td>   
                          <td><?php Echo(Formatomoneda($Tb_Prom_Temporal)." ".$Tb_Unidad_Temporal) ?></td>
                          <td><?php Echo(Formatomoneda($Tb_Valor_Temporal)) ?></td>  
                          <td><a href="#" class="remove_product" id="<?php Echo($Tb_Cod_Temporal) ?>"><span class="text-danger"><i class="fa fa-trash-o bigger-140"></i> </span></a></td>  
                     </tr> 
<?php 
}
}

else
{
	Echo("<tr><td colspan='5'>No ha seleccionado ningún Insumo</td></tr>");
}
// Fin de la Consulta 
?>
 <tr>  
                     <td class="success" style="font-weight: bold;"  colspan="4" align="right">Proyección de Costo (Insumos):</td>  
          <td class="success" style="font-weight: bold;" ><?php Echo(Formatomoneda(TotalInsumosAgregados($IdUser))) ?><span id="total_price"></span></td>  
                </tr> 
<?php
}
else // Código ya está incluido en la tabla
{
	// Consulta para dibujar la tabla y enviar mensaje de error 
	$sql ="SELECT Cod_Temporal, Nom_Temporal,Img_Temporal, Cant_Temporal,Unidad_Temporal, Prom_Temporal, Valor_Temporal From t_temporal_ref WHERE Orden_Temporal='".$IdUser."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Tb_Cod_Temporal=$row['Cod_Temporal'];
        $Tb_Nom_Temporal=$row['Nom_Temporal'];
        $Tb_Img_Temporal=$row['Img_Temporal'];
        $Tb_Cant_Temporal=$row['Cant_Temporal'];
        $Tb_Unidad_Temporal=$row['Unidad_Temporal'];
        $Tb_Prom_Temporal=$row['Prom_Temporal'];
        $Tb_Valor_Temporal=$row['Valor_Temporal'];
 ?>
 
 <tr> 
                          <td><img width="35" height="35" src="<?php Echo($Tb_Img_Temporal) ?>"/></td> 
                          <td>
                          <?php Echo($Tb_Cod_Temporal." - ".$Tb_Nom_Temporal); ?>
                          <input style="display:none;" name="TxtCod[]" type="text" value="<?php Echo($Tb_Cod_Temporal) ?>"/>
                          </td>  
                         <td>
                         <?php Echo(round($Tb_Cant_Temporal,1)." ".$Tb_Unidad_Temporal) ?>
                         <input style="display:none;" name="TxtCant[]" type="text" value="<?php Echo($Tb_Cant_Temporal) ?>"/>
                         </td>   
                          <td><?php Echo(Formatomoneda($Tb_Prom_Temporal)." ".$Tb_Unidad_Temporal) ?></td>
                          <td><?php Echo(Formatomoneda($Tb_Valor_Temporal)) ?></td>  
                          <td><a href="#" class="remove_product" id="<?php Echo($Tb_Cod_Temporal) ?>"><span class="text-danger"><i class="fa fa-trash-o bigger-140"></i> </span></a></td>  
                     </tr> 
<?php 
}
}
else
{
	Echo("<tr><td colspan='5'>No ha seleccionado ningún Insumo</td></tr>");
}
// Fin de la consulta para dibujar la tabla
?>
 <tr>  
                     <td class="success" style="font-weight: bold;"  colspan="4" align="right">Proyección de Costo (Insumos):</td>  
          <td class="success" style="font-weight: bold;" ><?php Echo(Formatomoneda(TotalInsumosAgregados($IdUser))) ?><span id="total_price"></span></td>  
                </tr> 
<?php

// Envio de Mensaje de error
	echo "<script>jQuery(function(){swal(\"¡Lo Sentimos!\", \"Insumo ya cargado\", \"error\");});</script>";

} // Fin de validación de variable buscada en la base

}

 ?>

<?php 

$Validacion=$_POST['Validacion']; // Variable enviada desde Producto-Crear.php para verificar si ya se tiene una referencia en proceso de creación.

if ($Validacion!="") { //Validación de variable al cargar la página
	
$sql ="SELECT Cod_Temporal, Nom_Temporal,Img_Temporal, Cant_Temporal,Unidad_Temporal, Prom_Temporal, Valor_Temporal From t_temporal_ref WHERE Orden_Temporal='".$Validacion."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Tb_Cod_Temporal=$row['Cod_Temporal'];
        $Tb_Nom_Temporal=$row['Nom_Temporal'];
        $Tb_Img_Temporal=$row['Img_Temporal'];
        $Tb_Cant_Temporal=$row['Cant_Temporal'];
        $Tb_Unidad_Temporal=$row['Unidad_Temporal'];
        $Tb_Prom_Temporal=$row['Prom_Temporal'];
        $Tb_Valor_Temporal=$row['Valor_Temporal'];
 ?>
 <tr> 
                          <td><img width="35" height="35" src="<?php Echo($Tb_Img_Temporal) ?>"/></td> 
                          <td>
                          <?php Echo($Tb_Cod_Temporal." - ".$Tb_Nom_Temporal); ?>
                          <input style="display:none;" name="TxtCod[]" type="text" value="<?php Echo($Tb_Cod_Temporal) ?>"/>
                          </td>  
                         <td>
                         <?php Echo(round($Tb_Cant_Temporal,1)." ".$Tb_Unidad_Temporal) ?>
                         <input style="display:none;" name="TxtCant[]" type="text" value="<?php Echo($Tb_Cant_Temporal) ?>"/>
                         </td>   
                          <td><?php Echo(Formatomoneda($Tb_Prom_Temporal)." ".$Tb_Unidad_Temporal) ?></td>
                          <td><?php Echo(Formatomoneda($Tb_Valor_Temporal)) ?></td>  
                          <td><a href="#" class="remove_product" id="<?php Echo($Tb_Cod_Temporal) ?>"><span class="text-danger"><i class="fa fa-trash-o bigger-140"></i> </span></a></td>  
                     </tr> 
<?php 
}
}
else
{
	Echo("<tr><td colspan='5'>No ha seleccionado ningún Insumo</td></tr>");
}
?>
 <tr>  
                     <td class="success" style="font-weight: bold;"  colspan="4" align="right">Proyección de Costo (Insumos):</td>  
          <td class="success" style="font-weight: bold;" ><?php Echo(Formatomoneda(TotalInsumosAgregados($Validacion))) ?><span id="total_price"></span></td>  
                </tr> 
<?php
} //Fin Validación de variable al cargar la página

$idDelete=$_POST['id'];

	if ($idDelete!="") {
		// Eliminamos el código 
		$sql=("DELETE FROM t_temporal_ref WHERE Cod_Temporal='".$idDelete."'");
		$result=$conexion->query($sql);

		// Inicio Consulta para dibujar tabla
$sql ="SELECT Cod_Temporal, Nom_Temporal,Img_Temporal, Cant_Temporal,Unidad_Temporal, Prom_Temporal, Valor_Temporal From t_temporal_ref WHERE Orden_Temporal='".$IdUser."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Tb_Cod_Temporal=$row['Cod_Temporal'];
        $Tb_Nom_Temporal=$row['Nom_Temporal'];
        $Tb_Img_Temporal=$row['Img_Temporal'];
        $Tb_Cant_Temporal=$row['Cant_Temporal'];
        $Tb_Unidad_Temporal=$row['Unidad_Temporal'];
        $Tb_Prom_Temporal=$row['Prom_Temporal'];
        $Tb_Valor_Temporal=$row['Valor_Temporal'];
 ?>
 <tr> 
                          <td class="center"><img width="45" height="45" src="<?php Echo($Tb_Img_Temporal) ?>"/></td> 
                          <td>
                          <?php Echo($Tb_Cod_Temporal." - ".$Tb_Nom_Temporal); ?>
                          <input style="display:none;" name="TxtCod[]" type="text" value="<?php Echo($Tb_Cod_Temporal) ?>"/>
                          </td>  
                         <td>
                         <?php Echo(round($Tb_Cant_Temporal,1)." ".$Tb_Unidad_Temporal) ?>
                         <input style="display:none;" name="TxtCant[]" type="text" value="<?php Echo($Tb_Cant_Temporal) ?>"/>
                         </td>   
                          <td><?php Echo(Formatomoneda($Tb_Prom_Temporal)." ".$Tb_Unidad_Temporal) ?></td>
                          <td><?php Echo(Formatomoneda($Tb_Valor_Temporal)) ?></td>  
                          <td><a href="#" class="remove_product" id="<?php Echo($Tb_Cod_Temporal) ?>"><span class="text-danger"><i class="fa fa-trash-o bigger-140"></i> </span></a></td>  
                     </tr> 
<?php 
}
}
else
{
	Echo("<tr><td colspan='5'>No ha seleccionado ningún Insumo</td></tr>");
}
?>
 <tr>  
                     <td class="success" style="font-weight: bold;"  colspan="4" align="right">Proyección de Costo (Insumos):</td>  
          <td class="success" style="font-weight: bold;" ><?php Echo(Formatomoneda(TotalInsumosAgregados($IdUser))) ?><span id="total_price"></span></td>  
                </tr> 
<?php
// Fin de la Consulta 

	}

 ?>












