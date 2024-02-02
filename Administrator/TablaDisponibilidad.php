<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$Taller=$_POST['Select1'];
$RefSel=$_GET['ReferenciaAjax'];
$Insumo_Ppal=$_GET['InsumoP'];
 ?>
 <?php
$sql ="SELECT Nom_Bodega FROM t_bodegas WHERE Id_Bodega='".$Taller."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    $Nom_Bodega=$row['Nom_Bodega'];   
 }
}
?>  

   <h4 class="box-title m-t-40"> <?php Echo($Nom_Bodega); ?></h4>
                                            <table class="table">
                                                <tbody>
                                        <?php 
$sql ="SELECT A.Cod_Insumo, A.Costo_Insumo_Ref, A.Cant_Solicitada, A.Referencia_Cod_Referencia, B.Nom_Insumo,B.Unidad_Insumo FROM t_insumos_ref as A,t_insumos as B WHERE Referencia_Cod_Referencia='".$RefSel."' and A.Cod_Insumo=B.Cod_Insumo";  
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$Ins_Cod_Insumo=$row['Cod_Insumo'];
$Ins_Costo_Insumo_Ref=$row['Costo_Insumo_Ref'];
$Ins_Cant_Solicitada=$row['Cant_Solicitada'];
$Ins_Nom_Insumo=$row['Nom_Insumo'];
$Ins_Unidad_Insumo=$row['Unidad_Insumo'];
                                       ?>

                                                    <tr>
                                                        <td width="90">
                                                          <?php 
                                            $DisponT=(DisponibilidadInsumoTaller($Ins_Cod_Insumo,$RefSel,$Taller));
                                            if ($DisponT==0) {
                              ?>
                              <i class="fa fa-ban red bigger-150"></i>
                             <!--  <a href="Proveedores.php?EditTask=<?php echo($Ins_Cod_Insumo);?>&Taller=<?php echo($Taller);?>" class="tooltip-primary blue" data-rel="tooltip" data-placement="top" title="Insumo No disponible">
                                <i class="fa fa-commenting bigger-150"></i>
                            </a> -->

                              <?php
                                            }
                                            else
                                            {
                                                Echo("<span class='label label-success'><i class='fa fa-check'></i></span>");
                                               
                                            }

                                            ?>
                                                        </td>
                                                        <td> <?php Echo("<b>".$Ins_Cod_Insumo."<b/> ".$Ins_Nom_Insumo) ?> </td>
                                                        <td>
                                                          <b><?php Echo($DisponT); ?> Un.</b>
                                                          
                                                        </td>
                                                        
                                                    </tr>
                                               <?php 

                                           }
                                       }
                                                ?>
                                                </tbody>
                                            </table>
 