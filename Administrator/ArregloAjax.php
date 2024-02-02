<script>  
 $(document).ready(function(data){  
      $('.product_drag_area').on('dragover', function(){  
           $(this).addClass('product_drag_over');  
           return false;  
      });  
      $('.product_drag_area').on('dragleave', function(){  
           $(this).removeClass('product_drag_over');  
           return false;  
      });  
      $('.product_drag').on('dragstart', function(e){  
           e.originalEvent.dataTransfer.setData("id", $(this).data("id")); 
           e.originalEvent.dataTransfer.setData("name", $(this).data("name"));  
           e.originalEvent.dataTransfer.setData("price", $(this).data("price"));
           e.originalEvent.dataTransfer.setData("foto", $(this).data("foto"));  
           e.originalEvent.dataTransfer.setData("unidad", $(this).data("unidad"));  
      });  


      $('.product_drag_area').on('drop', function(e){  
           e.preventDefault();  
           $(this).removeClass('product_drag_over');  
           var id = e.originalEvent.dataTransfer.getData('id'); 
           var name = e.originalEvent.dataTransfer.getData('name');  
           //alert(name);
           var price = e.originalEvent.dataTransfer.getData('price');
           var foto = e.originalEvent.dataTransfer.getData('foto'); 
           var unidad = e.originalEvent.dataTransfer.getData('unidad');
           //var cant = prompt("Ingrese la cantidad solicitada", "1"); 


           swal({
  title: name,
  text: "Indique la cantidad solicitada:",
  type: "input",
  inputType: "number",
  inputValue: "1",
  showCancelButton: true,
  closeOnConfirm: false,
  inputPlaceholder: "Decimales separados con punto"
}, function (inputValue) {
  if (inputValue === false) return false;
  if (inputValue === "") {
    swal.showInputError("¡Tienes que indicar la cantidad!");
    return false
  }
  swal("Correcto!", "A solicitado: " + inputValue+unidad, "success");

           var action = "add";  
           $.ajax({  
                url:"busqueda.php?uno=1",  
                method:"POST",  
                data:{id:id, name:name, price:price, foto:foto,unidad:unidad,inputValue:inputValue, action:action},  
                success:function(data){
                     $('#dragable_product_order').html(data);
                }  

           })
          }); 
      });   

         
 });  
 </script> 
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
                <div class="table-responsive">  
                     <table class="table table-bordered">  
                          <tr class="info">  
                              <th width="10%">Img.</th>
                               <th width="25%">Código - Nombre Insumo</th>  
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
                          '.$values["item_id"].' - '.$values["item_name"].'
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
                     <td class="success" style="font-weight: bold;"  colspan="4" align="right">Costo Promedio Insumos:</td>  
                     <td class="success" style="font-weight: bold;" >$ <span id="total_price">'.number_format($total, 2).'</span></td>  
                </tr>  
           </table>  
           ';  
      }  
      return $output;  
 }  
 ?> 