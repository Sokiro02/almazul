<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];
include("Lib/permisos.php");
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
 

</head>




<?php  
 //action.php  
 session_start();  
 if($_POST["action"] == "add")  
 {  
      if(isset($_SESSION['shopping_cart']))  
      {  
           $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");  
           if(!in_array($_POST["id"], $item_array_id))  
           {  
                $count = count($_SESSION["shopping_cart"]);  
                $item_array = array(  
                     'item_id'               =>     $_POST["id"],  
                     'item_name'             =>     $_POST["name"],  
                     'item_price'            =>     $_POST["price"], 
                     'item_foto'            =>      $_POST["foto"],
                     'item_unidad'            =>      $_POST["unidad"],  
                     'item_quantity'         =>     $_POST["inputValue"], 
                );  
                $_SESSION["shopping_cart"][$count] = $item_array;  
           }  
           else  
           {  
                echo "<script>jQuery(function(){swal(\"¡Lo Sentimos!\", \"Insumo ya cargado\", \"error\");});</script>";
           }  
      }  
      else  
      {  
           $item_array = array(  
                'item_id'               =>     $_POST["id"],  
                'item_name'               =>     $_POST["name"],  
                'item_price'          =>     $_POST["price"],  
                 'item_foto'            =>     $_POST["foto"], 
                 'item_unidad'            =>      $_POST["unidad"], 
                'item_quantity'          =>     $_POST["inputValue"],
                'item_con'          =>     1,

           );  
           $_SESSION["shopping_cart"][0] = $item_array;  
      }  
      echo make_cart_table();  
 }  
 if($_POST["action"] == "delete")  
 {  
      foreach($_SESSION["shopping_cart"] as $keys => $values)  
      {  
           if($values['item_id'] == $_POST["id"])  
           {  
                unset($_SESSION["shopping_cart"][$keys]);  
                echo make_cart_table();  
           }  
      }  
 }  

 if($_POST["action"] == "save")  
 {  
      foreach($_SESSION["shopping_cart"] as $keys => $values)  
      {  
           alert($values['item_id']);
      }  
 }  




 function make_cart_table()  
 {  
      $output = '';  

      if(!empty($_SESSION["shopping_cart"]))  
      {  
           $total = 0;  
           $output .= '  
                <h3>Detalle de Insumos</h3>  
                <div class="table-responsive" style="height:700px;overflow:scroll;">  
                     <table class="table table-bordered">  
                          <tr class="info">  
                              <th width="10%">Cód.</th>
                               <th width="25%">Nombre Insumo</th>  
                               <th class="center" width="8%">Cantidad</th> 
                               <th width="15%">Precio Prom.</th> 
                               <th width="15%">Total.</th>  
                               <th width="10%">Acción</th>  
                          </tr>  
           ';  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
            $var=1;
                $output .= '  
                     <tr> 
                          <td><img width="35" height="35" src="'.$values["item_foto"].'"/></td> 
                          <td>
                          '.$values["item_name"].'
                          <input style="display:none;" name="TxtCod[]" type="text" value="'.$values["item_id"].'"/>
                          </td>  
                         <td>
                         '.$values["item_quantity"].' '.$values["item_unidad"].'
                         <input style="display:none;" name="TxtCant[]" type="text" value="'.$values["item_quantity"].'"/>
                         </td>   
                          <td>$'.number_format($values["item_price"],0).'   (1'.$values["item_unidad"].')</td>
                          <td>$ '.number_format($values["item_quantity"]* $values["item_price"],2).'</td>  
                          <td><a href="#" class="remove_product" id="'.$values["item_id"]. '"><span class="text-danger"><i class="fa fa-trash-o bigger-140"></i> </span></a></td>  
                     </tr>  
                '; 
                $total = $total + ($values["item_quantity"] * $values["item_price"]);  
           }  
           $output .= '  
                <tr>  
                     <td colspan="4" align="right">Costo Promedio Insumos:</td>  
                     <td>$ <span id="total_price">'.number_format($total, 2).'</span></td>  
                </tr>  
           </table>  
           ';  
      }  
      return $output;  
 }  
 ?> 
 <h3 ><i class="fa fa-check"></i> Clasificación del Producto </h3>

 <div class="form-group col-sm-4">
                              <label for="form-field-select-3">Producto</label>

                              <div>
                        <select class="chosen-select input-xxlarge" name="TxtCategoria" data-placeholder="Seleccionar...">
                            <option value="">Seleccionar...</option>
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

  <div class="form-group col-sm-4">
                              <label for="form-field-select-3">Categoria</label>
                              <div>
                        <select class="chosen-select input-xxlarge" name="TxtSubCategoria" data-placeholder="Seleccionar...">
                            <option value="">Seleccionar...</option>
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
   <div class="form-group col-sm-4">
                              <label for="form-field-select-3">Insumo Principal</label>

                              <div>
                        <select class="chosen-select input-xxlarge" name="TxtCategoria" data-placeholder="Seleccionar...">
                            <option value="">Seleccionar...</option>
                             <?php 
       foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {
             echo ("<option value=".$values["item_name"].">".$values["item_name"]."</option>");
           }
           
      ?>
                                  
                        </select>
                              </div>
  </div>
 
  <div class="form-group col-sm-3" style="display: none;">
    <label for="form-field-select-3">Costo Insumos</label>
   <span>
      <?php 
       foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {
             $total = $total + ($values["item_quantity"] * $values["item_price"]);
           }
           Echo(formatomoneda($total));
      ?>
   </span>
  </div>

  <h3><i class="fa fa-money"></i> Costo y Valor del Producto </h3>
  <div class="form-group col-sm-4">
              <label for="form-field-select-3">Valor Mano de Obra</label>
                              <div>
                          <input class="input-sm" type="text" id="demo1" placeholder="Costo Proveedor 1" name="demo1"  required="true" />
                                </div>
                                <script type="text/javascript">     
$("#demo1").maskMoney({
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
<div class="form-group col-sm-4">
              <label for="form-field-select-3">Total Costo</label>
                              <div id="Total">
                          <input class="input-sm" type="text" disabled="true" value="<?php Echo(formatomoneda($total)) ?>" />
                              </div>
                                
</div>
<div class="form-group col-sm-4">
              <label for="form-field-select-3">P.V.P</label>
                              <div>
                          <input class="input-sm" type="text" id="demo2" placeholder="Costo Proveedor 1" name="demo2"  required="true" />
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
                     
                      <div>
                      <label for="form-field-9">Características</label>

                  <textarea class="form-control limited" name="TxtDetalle" id="form-field-9" rows="2" maxlength="300"></textarea>
                  </div>
                  

                  <button type="submit" id="guardar" class="btn btn-xs btn-danger">
                    Guardar y Cerrar
                  </button>


</html> 