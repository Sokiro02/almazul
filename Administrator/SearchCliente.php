<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];


$R1=$_POST['Select1'];

$sql ="SELECT * FROM t_clientes as A, t_ciudades as B WHERE A.Ciudad_Id_Ciudad=B.Id_Ciudad  and Id_Cliente='".$R1."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Nom_Cliente=$row['Nom_Cliente'];
         $Id_Cliente=$row['Id_Cliente'];
        $Ape_Cliente=$row['Ape_Cliente'];
        $Cel1_Cliente=$row['Cel1_Cliente'];
        $Cel2_Cliente=$row['Cel2_Cliente'];
        $Cel2_Cliente=$row['Cel2_Cliente'];
        $Correo_Cliente=$row['Correo_Cliente'];
        $Nom_Ciudad=$row['Nom_Ciudad'];
        $Dir_Cliente=$row['Dir_Cliente'];
        $Documento_Cliente=$row['Documento_Cliente'];
        
    }
}
//header("location:index.php");
 ?>
                                     <tr>
                                    <td><strong><i class="fa fa-mobile-user"> </i> Id: </strong></td>
                                    <td colspan="2"><?php Echo utf8_encode($Id_Cliente) ?></td>
                                  </tr>
                                   <tr>
                                    <td><strong><i class="fa fa-mobile-user"> </i> Documento: </strong></td>
                                    <td colspan="2"><?php Echo utf8_encode($Documento_Cliente) ?></td>
                                  </tr>
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
                                    <td colspan="2"><?php Echo utf8_encode($Dir_Cliente); ?></td>
                                  </tr>
                                    <tr>
                                    <td><strong><i class="fa fa-map-marker"> </i> Ciudad: </strong></td>
                                    <td colspan="2"><?php Echo utf8_encode($Nom_Ciudad); ?></td>
                                  </tr>
                                   <tr>
                                    <td><strong><i class="fa fa-envelope"> </i> E-mail: </strong></td>
                                    <td colspan="2"><?php Echo utf8_encode($Correo_Cliente); ?></td>
                                  </tr>
                                  <tr>
                                      <td colspan="3">
                                      <hr>

                                        <a class='btn btn-warning btn-outline' href='Clientesupdate.php?EditTask=<?php echo ($R1); ?>'>Actualizar Datos Cliente</a>

                            <a target="_blank" href="Vista-Cliente.php?Cartera=<?php echo($R1);?>" class="btn btn-red btn-outline" data-rel="tooltip" data-placement="top" title="Cartera Cliente">
                                  <i class="fa fa-money bigger-110">Ver Cartera</i>
                            </a>
                                        <hr>
                                      </td>
                                  </tr>

                          
