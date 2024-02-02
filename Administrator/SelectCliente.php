<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];


$R1=$_POST['Select1'];

$sql ="SELECT Nom_Cliente,Ape_Cliente,Cel1_Cliente,Cel2_Cliente,Correo_Cliente,Dir_cliente from t_clientes WHERE Id_Cliente='".$R1."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Nom_Cliente=$row['Nom_Cliente'];
        $Ape_Cliente=$row['Ape_Cliente'];
        $Cel1_Cliente=$row['Cel1_Cliente'];
        $Cel2_Cliente=$row['Cel2_Cliente'];
        $Correo_Cliente=$row['Correo_Cliente'];
        $Dir_cliente=$row['Dir_cliente'];
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
                                    <td><strong><i class="fa fa-map"> </i> Dirección: </strong></td>
                                    <td colspan="2"><?php Echo utf8_encode($Dir_cliente) ?></td>
                                  </tr>
                                  <tr>
                                    <td><strong><i class="fa fa-envelope"> </i> E-mail: </strong></td>
                                    <td colspan="2">

                                    <?php 
                                    if ($Correo_Cliente=="") {
                                      $validacioncorreo=0;
                                      echo("<a class='btn btn-warning btn-outline' href='Clientesupdate.php?EditTask=".$R1."'>Actualizar Datos Cliente</a>");
                                    }
                                    else
                                    {
                                      Echo utf8_encode($Correo_Cliente);  
                                      echo("<hr><a class='btn btn-warning btn-outline' href='Clientesupdate.php?EditTask=".$R1."'>Actualizar Datos Cliente</a>");
                                    }
                                     ?>
                                      

                                    </td>
                            </tr>
