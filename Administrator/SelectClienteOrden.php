<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];


$R1=$_POST['Select1'];

$sql ="SELECT Nom_Cliente,Ape_Cliente,Cel1_Cliente,Cel2_Cliente,Correo_Cliente from t_clientes WHERE Id_Cliente='".$R1."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Nom_Cliente=$row['Nom_Cliente'];
        $Ape_Cliente=$row['Ape_Cliente'];
        $Cel1_Cliente=$row['Cel1_Cliente'];
        $Cel2_Cliente=$row['Cel2_Cliente'];
        $Correo_Cliente=$row['Correo_Cliente'];
    }
}
//header("location:index.php");
 ?>

  <tr>
  	<input type="text" name="TxtIdCliente" value="<?php Echo utf8_encode($R1) ?>" style="display: none;">
                                    <td><strong><i class="fa fa-user"> </i> Cliente: </strong></td>
                                    <td colspan="2"><?php Echo utf8_encode($Nom_Cliente." ".$Ape_Cliente) ?></td>
                                  </tr>
                                   <tr>
                                    <td><strong><i class="fa fa-mobile-phone"> </i> Celular: </strong></td>
                                    <td colspan="2"><?php Echo utf8_encode($Cel1_Cliente." // ".$Cel2_Cliente) ?></td>
                                  </tr>
                                  <tr>
                                    <td><strong><i class="fa fa-envelope"> </i> E-mail: </strong></td>
                                    <td colspan="2">
                                      <?php 
                                    if ($Correo_Cliente=="") {
                                      $validacioncorreo=0;
                                      echo("<a class='btn btn-warning btn-outline' href='Clientesupdateorden.php?EditTask=".$R1."'>Actualizar Datos Cliente</a>");
                                    }
                                    else
                                    {
                                      Echo utf8_encode($Correo_Cliente);  
                                      echo("<hr><a class='btn btn-warning btn-outline' href='Clientesupdateorden.php?EditTask=".$R1."'>Actualizar Datos Cliente</a>");
                                    }
                                     ?>
                                      
                                    </td>
                            </tr>
                            <tr>
                              <td colspan="3">
                                 <h4>Seleccionar Recibos de Caja</h4>
                              </td>
                            </tr>
                          
<?php 
      
$sql ="SELECT Id_Ingreso, Concepto_Ingreso, Medio_Pago,Num_Transaccion,Valor_Ingreso,Cod_Recibo_Caja FROM t_ingresos WHERE Cliente_Id_Cliente='".$R1."' and Estado_Ingreso='2' and Valor_Ingreso<>'0' and Concepto_Ingreso NOT like '%PAGO BONO%'";  

$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Id_Ingreso=$row['Id_Ingreso'];
        $Concepto_Ingreso=$row['Concepto_Ingreso'];
        $Medio_Pago=$row['Medio_Pago'];
        $Num_Transaccion=$row['Num_Transaccion'];
        $Valor_Ingreso=$row['Valor_Ingreso'];
        $Cod_Recibo_Caja=$row['Cod_Recibo_Caja'];
        
        if ($Medio_Pago==1) {
            $FormaPago="EFECTIVO";
        }
        else if ($Medio_Pago==2) {
            $FormaPago="TARJETA";
        }
        else if ($Medio_Pago==3) {
            $FormaPago="TRANSFERENCIA";
        }
         else if ($Medio_Pago==4) {
            $FormaPago="OTRO";
        }

        ?>
      
        <tr style="border: 1px solid;padding: 3px;">
          <td class="center">
            <input type="checkbox" name="TxtIdIngreso[]" required="true" value="<?php Echo($Id_Ingreso) ?>">
          </td>
          <td>
            Recibo Caja Nº<?php Echo($Cod_Recibo_Caja); ?>
          </td>
          <td>
            <?php Echo(formatomoneda($Valor_Ingreso)); ?>
          </td>
          <td>
            <?php Echo($FormaPago); ?>
          </td>
          
        </tr>


        <?php
    }
}
else
{
  Echo("<tr></tr>");
}

 ?>
    <?php 
    $sql ="SELECT SUM(Valor_Ingreso) as TotalAnticipo FROM t_ingresos WHERE Cliente_Id_Cliente='".$R1."' and Estado_Ingreso='2' and Concepto_Ingreso NOT like '%PAGO BONO%'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $TotalAnticipo=$row['TotalAnticipo'];
       
    }
    ?>
     <tr>
       <td colspan="2">
         <strong>Total Anticipo: </strong>
       </td>
       <td>
         <?php Echo(formatomoneda($TotalAnticipo)); ?>
       </td>
     </tr>
    <?php
}
else {
  Echo("<tr></tr>");
}

     ?>
    



