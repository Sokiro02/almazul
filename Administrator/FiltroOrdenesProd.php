<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

$AllProd=$_POST['AllProd'];

if ($AllProd!="") {
    
    ?>
    
          <div class="card-body b-t" style="height:400px;overflow:scroll;">
                            <table class="table v-middle no-border">
                                <tbody>
<?php 
    $sql ="SELECT date_format(Fecha_Solicitud,CONCAT(CONCAT(ELT(WEEKDAY(Fecha_Solicitud) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(Fecha_Solicitud), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS CreadaFecha,B.Nombres,B.Apellidos,B.Img_Perfil,Id_Solicitud_Prod,Cod_Solicitud_Prod, C.Nom_Bodega, Cant_Solicitada, D.Nom_Talla, E.Nom_Tienda, Referencia_Id_Referencia, Estado_Solicitud_Prod, Fecha_Solicitud FROM t_solicitudes_prod AS A, t_usuarios as B, t_bodegas as C, t_tallas as D, t_tiendas as E WHERE  A.Solicitud_Id_Usuario=B.Id_Usuario and A.Bodega_Id_Bodega=C.Id_Bodega and A.Talla_Solicitada=D.Id_Talla and A.Tienda_Id_Tienda=E.Id_Tienda and Estado_Solicitud_Prod<>'4' ORDER BY UNIX_TIMESTAMP(Fecha_Solicitud) DESC"; 
    //Echo($sql); 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    $CreadaFecha=$row['CreadaFecha']; 
    $Fecha_Solicitud=$row['Fecha_Solicitud']; 
    $Nombres=$row['Nombres']; 
    $Apellidos=$row['Apellidos']; 
    $Img_Perfil=$row['Img_Perfil']; 
    $Id_Solicitud_Prod=$row['Id_Solicitud_Prod'];
    $Cod_Solicitud_Prod=$row['Cod_Solicitud_Prod'];   
    $Nom_Bodega=$row['Nom_Bodega'];
    $Cant_Solicitada=$row['Cant_Solicitada'];
    $Nom_Talla=$row['Nom_Talla'];
    $Nom_Almacen=$row['Nom_Tienda']; 
    $Referencia_Id_Referencia=$row['Referencia_Id_Referencia'];
    $Estado_Solicitud_Prod=$row['Estado_Solicitud_Prod'];
    $date = new DateTime($Fecha_Solicitud);


     ?>
                                    
                                    <tr>
                                        
                                        <td style="width:40px"><a href="Panel-Produccion.php?Solicitud=<?php Echo($Cod_Solicitud_Prod) ?>"><img src="<?php Echo($Img_Perfil) ?>" width="50" class="img-circle" alt="logo"></a></td>
                                        <td><a href="Panel-Produccion.php?Solicitud=<?php Echo($Cod_Solicitud_Prod) ?>">Solicitud Nº:<strong><?php Echo($Cod_Solicitud_Prod) ?></strong></a> <a href="Panel-Produccion.php?Solicitud=<?php Echo($Cod_Solicitud_Prod) ?>"></a></td>
                                        <td align="right">
                                <span class="date"><?php Echo($CreadaFecha); ?>  <?php echo $date->format('H:i:s a');  ?></span><br>
                                            <!-- <span class="label label-info"><a style="color:white;" href="Vista-Orden.php">$2.300.000</a></span> -->
                                            
                                <span class="label label-dark bg-grey"><?php Echo($Cant_Solicitada); ?> Un. <?php Echo($Referencia_Id_Referencia."-".$Nom_Talla) ?></span> <span class="action-icons"></span>
                              <?php 
                                if ($Estado_Solicitud_Prod==1) {
      $NomEstado="Pendiente";
      Echo("<span class='label label-danger'>Estado ".$NomEstado."</span> <span class='action-icons'></span>");
    }
    elseif ($Estado_Solicitud_Prod==2) {
      $NomEstado="Producción";
       Echo("<span class='label label-warning'>Estado ".$NomEstado."</span> <span class='action-icons'></span>");
    }
    elseif ($Estado_Solicitud_Prod==3) {
      $NomEstado="Acabados";
       Echo("<span class='label label-success'>Estado ".$NomEstado."</span> <span class='action-icons'></span>");
    }
     elseif ($Estado_Solicitud_Prod==0) {
      $NomEstado="Lista de Espera";
       Echo("<span class='label label-danger'>Estado ".$NomEstado."</span> <span class='action-icons'></span>");
    }

                                 ?>
                                        </td>
                                       
                                    </tr>
                                     <?php 
                                 }
                             }
                                      ?>
                                </tbody>
                            </table>
                        </div>
<?php 
}
 ?>

<?php
$Filtro=$_POST['palabra'];

if ($Filtro!="") {
    ?>
      <div class="card-body b-t" style="height:400px;overflow:scroll;">
                            <table class="table v-middle no-border">
                                <tbody>
<?php 
    $sql ="SELECT date_format(Fecha_Solicitud,CONCAT(CONCAT(ELT(WEEKDAY(Fecha_Solicitud) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(Fecha_Solicitud), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS CreadaFecha,B.Nombres,B.Apellidos,B.Img_Perfil,Id_Solicitud_Prod,Cod_Solicitud_Prod, C.Nom_Bodega, Cant_Solicitada, D.Nom_Talla, E.Nom_Tienda, Referencia_Id_Referencia, Estado_Solicitud_Prod, Fecha_Solicitud FROM t_solicitudes_prod AS A, t_usuarios as B, t_bodegas as C, t_tallas as D, t_tiendas as E WHERE  A.Solicitud_Id_Usuario=B.Id_Usuario and A.Bodega_Id_Bodega=C.Id_Bodega and A.Talla_Solicitada=D.Id_Talla and A.Tienda_Id_Tienda=E.Id_Tienda and Estado_Solicitud_Prod<>'4' and Cod_Solicitud_Prod LIKE '%".$Filtro."%' ORDER BY UNIX_TIMESTAMP(Fecha_Solicitud) DESC"; 
    //Echo($sql); 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    $CreadaFecha=$row['CreadaFecha']; 
    $Fecha_Solicitud=$row['Fecha_Solicitud']; 
    $Nombres=$row['Nombres']; 
    $Apellidos=$row['Apellidos']; 
    $Img_Perfil=$row['Img_Perfil']; 
    $Id_Solicitud_Prod=$row['Id_Solicitud_Prod'];
    $Cod_Solicitud_Prod=$row['Cod_Solicitud_Prod'];   
    $Nom_Bodega=$row['Nom_Bodega'];
    $Cant_Solicitada=$row['Cant_Solicitada'];
    $Nom_Talla=$row['Nom_Talla'];
    $Nom_Almacen=$row['Nom_Tienda']; 
    $Referencia_Id_Referencia=$row['Referencia_Id_Referencia'];
    $Estado_Solicitud_Prod=$row['Estado_Solicitud_Prod'];

    



    $date = new DateTime($Fecha_Solicitud);


     ?>
                                    
                                    <tr>
                                        
                                        <td style="width:40px"><a href="Panel-Produccion.php?Solicitud=<?php Echo($Cod_Solicitud_Prod) ?>"><img src="<?php Echo($Img_Perfil) ?>" width="50" class="img-circle" alt="logo"></a></td>
                                        <td>Solicitud Nº:<strong><?php Echo($Cod_Solicitud_Prod) ?></strong> <a href="Panel-Produccion.php?Solicitud=<?php Echo($Cod_Solicitud_Prod) ?>"><?php Echo utf8_encode($Nombres." ".$Apellidos) ?></a></td>
                                        <td align="right">
                                <span class="date"><?php Echo($CreadaFecha); ?>  <?php echo $date->format('H:i:s a');  ?></span><br>
                                            <!-- <span class="label label-info"><a style="color:white;" href="Vista-Orden.php">$2.300.000</a></span> -->
                                            
                                <span class="label label-dark bg-grey"><?php Echo($Cant_Solicitada); ?> Un. <?php Echo($Referencia_Id_Referencia."-".$Nom_Talla) ?></span> <span class="action-icons"></span>

                                <?php 
                                if ($Estado_Solicitud_Prod==1) {
      $NomEstado="Pendiente";
      Echo("<span class='label label-danger'>Estado ".$NomEstado."</span> <span class='action-icons'></span>");
    }
    elseif ($Estado_Solicitud_Prod==2) {
      $NomEstado="Producción";
       Echo("<span class='label label-warning'>Estado ".$NomEstado."</span> <span class='action-icons'></span>");
    }
    elseif ($Estado_Solicitud_Prod==3) {
      $NomEstado="Acabados";
       Echo("<span class='label label-success'>Estado ".$NomEstado."</span> <span class='action-icons'></span>");
    }
     elseif ($Estado_Solicitud_Prod==0) {
      $NomEstado="Lista de Espera";
       Echo("<span class='label label-danger'>Estado ".$NomEstado."</span> <span class='action-icons'></span>");
    }

                                 ?>

                                 
                                             
                                              
                                        </td>
                                       
                                    </tr>
                                     <?php 
                                 }
                             }
                                      ?>
                                </tbody>
                            </table>
                        </div>

                  
<?php 
}
 ?>


<?php
$ValPendiente=$_POST['ValPendiente'];

if ($ValPendiente!="") {
    
    ?>
    
          <div class="card-body b-t" style="height:400px;overflow:scroll;">
                            <table class="table v-middle no-border">
                                <tbody>
<?php 
    $sql ="SELECT date_format(Fecha_Solicitud,CONCAT(CONCAT(ELT(WEEKDAY(Fecha_Solicitud) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(Fecha_Solicitud), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS CreadaFecha,B.Nombres,B.Apellidos,B.Img_Perfil,Id_Solicitud_Prod,Cod_Solicitud_Prod, C.Nom_Bodega, Cant_Solicitada, D.Nom_Talla, E.Nom_Tienda, Referencia_Id_Referencia, Estado_Solicitud_Prod, Fecha_Solicitud FROM t_solicitudes_prod AS A, t_usuarios as B, t_bodegas as C, t_tallas as D, t_tiendas as E WHERE  A.Solicitud_Id_Usuario=B.Id_Usuario and A.Bodega_Id_Bodega=C.Id_Bodega and A.Talla_Solicitada=D.Id_Talla and A.Tienda_Id_Tienda=E.Id_Tienda and Estado_Solicitud_Prod='".$ValPendiente."' ORDER BY UNIX_TIMESTAMP(Fecha_Solicitud) DESC"; 
    //Echo($sql); 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    $CreadaFecha=$row['CreadaFecha']; 
    $Fecha_Solicitud=$row['Fecha_Solicitud']; 
    $Nombres=$row['Nombres']; 
    $Apellidos=$row['Apellidos']; 
    $Img_Perfil=$row['Img_Perfil']; 
    $Id_Solicitud_Prod=$row['Id_Solicitud_Prod'];
    $Cod_Solicitud_Prod=$row['Cod_Solicitud_Prod'];   
    $Nom_Bodega=$row['Nom_Bodega'];
    $Cant_Solicitada=$row['Cant_Solicitada'];
    $Nom_Talla=$row['Nom_Talla'];
    $Nom_Almacen=$row['Nom_Tienda']; 
    $Referencia_Id_Referencia=$row['Referencia_Id_Referencia'];
    $Estado_Solicitud_Prod=$row['Estado_Solicitud_Prod'];
    $date = new DateTime($Fecha_Solicitud);


     ?>
                                    
                                    <tr>
                                        
                                        <td style="width:40px"><a href="Panel-Produccion.php?Solicitud=<?php Echo($Cod_Solicitud_Prod) ?>"><img src="<?php Echo($Img_Perfil) ?>" width="50" class="img-circle" alt="logo"></a></td>
                                        <td>Solicitud Nº:<strong><?php Echo($Cod_Solicitud_Prod) ?></strong> <a href="Panel-Produccion.php?Solicitud=<?php Echo($Cod_Solicitud_Prod) ?>"><?php Echo utf8_encode($Nombres." ".$Apellidos) ?></a></td>
                                        <td align="right">
                                <span class="date"><?php Echo($CreadaFecha); ?>  <?php echo $date->format('H:i:s a');  ?></span><br>
                                            <!-- <span class="label label-info"><a style="color:white;" href="Vista-Orden.php">$2.300.000</a></span> -->
                                            
                                <span class="label label-dark bg-grey"><?php Echo($Cant_Solicitada); ?> Un. <?php Echo($Referencia_Id_Referencia."-".$Nom_Talla) ?></span> <span class="action-icons"></span>
                              <?php 
                                if ($Estado_Solicitud_Prod==1) {
      $NomEstado="Pendiente";
      Echo("<span class='label label-danger'>Estado ".$NomEstado."</span> <span class='action-icons'></span>");
    }
    elseif ($Estado_Solicitud_Prod==2) {
      $NomEstado="Producción";
       Echo("<span class='label label-warning'>Estado ".$NomEstado."</span> <span class='action-icons'></span>");
    }
    elseif ($Estado_Solicitud_Prod==3) {
      $NomEstado="Acabados";
       Echo("<span class='label label-success'>Estado ".$NomEstado."</span> <span class='action-icons'></span>");
    }

                                 ?>
                                        </td>
                                       
                                    </tr>
                                     <?php 
                                 }
                             }
                             else
                             {
                              Echo("<p> No se encontraron resultados </p>");
                             }
                                      ?>
                                </tbody>
                            </table>
                        </div>
<?php 
}
 ?>


