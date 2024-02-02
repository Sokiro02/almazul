<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

$AllProd=$_POST['AllProd'];

if ($AllProd!="") {
    
$sql ="SELECT Cod_Referencia FROM t_referencias order by Fecha_Creacion ASC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$ListaReferencias=$ListaReferencias.$row['Cod_Referencia'].",";                  
 }
}
$CadenaReferencias=explode(",", $ListaReferencias);
//Split al Arreglo
$longitud = count($CadenaReferencias);
$min=$longitud-1;
//Recorro todos los elementos
for($i=0; $i<$min; $i++)
{

$sql ="SELECT date_format(Fecha_Creacion,CONCAT(CONCAT(ELT(WEEKDAY(Fecha_Creacion) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(Fecha_Creacion), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS CreadaFecha,Id_Referencia, Cod_Referencia, Img_Referencia, Fecha_Creacion,Estado_Ref, Costo_Proyectado_Pref, V_Mano_Obra_Ref, PVP_Ref, P_Mayor, Ref_Publicada,Coleccion_Nom_Coleccion,Insumo_Ppal  FROM t_referencias WHERE Cod_Referencia='".$CadenaReferencias[$i]."' order by Fecha_Creacion ASC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$Id_Referencia=$row['Id_Referencia'];
$Cod_Referencia=$row['Cod_Referencia'];
$Img_Referencia=$row['Img_Referencia'];
$Fecha_Creacion=$row['Fecha_Creacion'];
$Coleccion_Nom_Coleccion=$row['Coleccion_Nom_Coleccion'];
$CreadaFecha=$row['CreadaFecha'];
$Estado_Ref=$row['Estado_Ref'];
$Costo_Proyectado_Pref=$row['Costo_Proyectado_Pref'];
$PVP_Ref=$row['PVP_Ref'];
$P_Mayor=$row['P_Mayor'];
$P_Mayor=$row['P_Mayor'];
$Insumo_Ppal=$row['Insumo_Ppal'];

$Operacion1=((int)$Costo_Proyectado_Pref/(int) $PVP_Ref);
$Operacion2=(1-$Operacion1);
$Operacion3=$Operacion2*100;
$UtilidadBruta=$Operacion3;
 }
}


    ?>
                    <!-- Column -->
                    <div class="col-lg-4 col-md-6" style="border: 1px dotted;border-color: #D8D8D8!important;">
                        <div class="card">
                            
                            <div class="card-body">
                                <div class="product-img">
                                    <h5 class="card-title m-b-2"><?php Echo($Coleccion_Nom_Coleccion); ?></h5>
                                    <h5 class="card-title m-b-2">Ref. <?php Echo($Cod_Referencia); ?></h5>
                                    <img width="100%" height="250" src="<?php Echo($Img_Referencia); ?>">
                                    <div class="pro-img-overlay"><a href="Produccion-Solicitud.php?RefSel=<?php Echo($Cod_Referencia); ?>&Referencia=<?php Echo($Coleccion_Nom_Coleccion); ?>" class="bg-info"><i class="fa fa-plus-square"></i></a> <a href="Compras.php" class="bg-danger"><i class="fa fa-trash"></i></a><a href="Compras.php" class="bg-success"><i class="fa fa-check"></i></a></div>
                                </div>
                                <div class="product-text">
                                    <span class="pro-price bg-primary">0 Un.</span>
                                    <small>Fecha Diseño: <?php Echo($CreadaFecha) ?> </small>
                                    <table class="table table-bordered">
                                        
                                        <tr>
                                            
                                            <td colspan="2" class="center"> <span class="label label-success"><?php Echo($Estado_Ref); ?></span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                Opción de Colores: 
                                                 <?php 
$sql ="SELECT Nom_Color,Valor_Color FROM t_colores_ref as A,t_colores as B WHERE A.Referencia_Cod_Referencia='".$CadenaReferencias[$i]."' and A.Color_Id_Color=B.Id_Color";  
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$Nom_Color=$row['Nom_Color'];
$Valor_Color=$row['Valor_Color'];


                                                 ?>

<button class="btn-lg" style="background-color:<?php Echo($Valor_Color); ?>;padding: 8px;border-width: 3px"></button>
<?php 
    }
} 
?>
                                            </td>
                                            
                                        </tr> 
                                        <tr class="warning">
                                            <td>Disponibilidad en Producción</td>
                                            <td><?php 
                                            $Dispon=(DisponibilidadInsumo($Insumo_Ppal,$Cod_Referencia));
                                            if ($Dispon==0) {
                                                Echo("<span class='label label-danger'>No Disponible</span>");
                                            }
                                            else
                                            {
                                                Echo("<span class='label label-warning'>".$Dispon."</span>");
                                               
                                            }

                                            ?> 
                                        </td>

                                        </tr>
                                        <tr>
                                            <td>Proyección de Costo</td>
                                            <td><?php Echo(Formatomoneda($Costo_Proyectado_Pref)) ?></td>

                                        </tr>
                                        <tr>
                                            <td>P.V.P</td>
                                            <td><?php Echo(Formatomoneda($PVP_Ref)) ?></td>

                                        </tr>
                                        <tr>
                                            <td>Valor al Mayor</td>
                                            <td><?php Echo(Formatomoneda($P_Mayor)) ?></td>
                                        </tr>
                                        <tr class="danger">
                                            <td>Margen Bruto Proyectado</td>
                                            <td><?php Echo(round($UtilidadBruta,1)); ?>%</td>
                                        </tr>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
<?php 
}
}
 ?>

<?php
$Filtro=$_POST['palabra'];

if ($Filtro!="") {
    
$sql ="SELECT * FROM t_referencias WHERE Cod_Referencia LIKE '%".$Filtro."%' || Costo_Proyectado_Pref LIKE '%".$Filtro."%' || Fecha_Creacion LIKE '%".$Filtro."%' || Estado_Ref LIKE '%".$Filtro."%' || PVP_Ref LIKE '%".$Filtro."%' || P_Mayor LIKE '%".$Filtro."%' || Coleccion_Nom_Coleccion LIKE '%".$Filtro."%' order by Fecha_Creacion ASC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$ListaReferencias=$ListaReferencias.$row['Cod_Referencia'].",";                  
 }
}
else
{
    Echo("<h4><i class='fa fa-info-circle'></i> Ups!! No se encontraron resultados, intenta con otra palabra.</h4>");
}
$CadenaReferencias=explode(",", $ListaReferencias);
//Split al Arreglo
$longitud = count($CadenaReferencias);
$min=$longitud-1;
//Recorro todos los elementos
for($i=0; $i<$min; $i++)
{

$sql ="SELECT date_format(Fecha_Creacion,CONCAT(CONCAT(ELT(WEEKDAY(Fecha_Creacion) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(Fecha_Creacion), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS CreadaFecha,Id_Referencia, Cod_Referencia, Img_Referencia, Fecha_Creacion,Estado_Ref, Costo_Proyectado_Pref, V_Mano_Obra_Ref, PVP_Ref, P_Mayor, Ref_Publicada,Coleccion_Nom_Coleccion,Insumo_Ppal FROM t_referencias WHERE Cod_Referencia='".$CadenaReferencias[$i]."'  order by Fecha_Creacion ASC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$Id_Referencia=$row['Id_Referencia'];
$Cod_Referencia=$row['Cod_Referencia'];
$Img_Referencia=$row['Img_Referencia'];
$Fecha_Creacion=$row['Fecha_Creacion'];
$Coleccion_Nom_Coleccion=$row['Coleccion_Nom_Coleccion'];
$CreadaFecha=$row['CreadaFecha'];
$Estado_Ref=$row['Estado_Ref'];
$Costo_Proyectado_Pref=$row['Costo_Proyectado_Pref'];
$PVP_Ref=$row['PVP_Ref'];
$P_Mayor=$row['P_Mayor'];
$Ref_Publicada=$row['Ref_Publicada'];
$Insumo_Ppal=$row['Insumo_Ppal'];


$Operacion1=((int)$Costo_Proyectado_Pref/(int) $PVP_Ref);
$Operacion2=(1-$Operacion1);
$Operacion3=$Operacion2*100;
$UtilidadBruta=$Operacion3;
 }
}

    ?>
                    <!-- Column -->
                    <div class="col-lg-4 col-md-6" style="border: 1px dotted;border-color: #D8D8D8!important;">
                        <div class="card">
                            <div class="card-body">
                                <div class="product-img">
                                    <h5 class="card-title m-b-2"><?php Echo($Coleccion_Nom_Coleccion); ?></h5>
                                    <h5 class="card-title m-b-2">Ref. <?php Echo($Cod_Referencia); ?></h5>
                                    <img width="100%" height="250" src="<?php Echo($Img_Referencia); ?>">
                                    <div class="pro-img-overlay"><a href="Produccion-Solicitud.php?RefSel=<?php Echo($Cod_Referencia); ?>&Referencia=<?php Echo($Coleccion_Nom_Coleccion); ?>" class="bg-info"><i class="fa fa-plus-square"></i></a> <a href="Compras.php" class="bg-danger"><i class="fa fa-trash"></i></a><a href="Compras.php" class="bg-success"><i class="fa fa-check"></i></a></div>
                                </div>
                                <div class="product-text">
                                    <span class="pro-price bg-primary">0 Un.</span>
                                    <small>Fecha Diseño: <?php Echo($CreadaFecha) ?> </small>
                                    <table class="table table-bordered"> 
                                         
                                        <tr>
                                            
                                            <td colspan="2" class="center">
                                                
                                                <span class="label label-success"><?php Echo($Estado_Ref); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                Opción de Colores: 
                                                 <?php 
$sql ="SELECT Nom_Color,Valor_Color FROM t_colores_ref as A,t_colores as B WHERE A.Referencia_Cod_Referencia='".$CadenaReferencias[$i]."' and A.Color_Id_Color=B.Id_Color";  
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$Nom_Color=$row['Nom_Color'];
$Valor_Color=$row['Valor_Color'];


                                                 ?>

<button class="btn-lg" style="background-color:<?php Echo($Valor_Color); ?>;padding: 8px;border-width: 3px"></button>
<?php 
    }
} 
?>
                                            </td>
                                            
                                        </tr> 
                                        <tr class="warning">
                                            <td>Disponibilidad en Producción</td>
                                            <td><?php 
                                            $Dispon=(DisponibilidadInsumo($Insumo_Ppal,$Cod_Referencia)); 
                                            if ($Dispon==0) {
                                                Echo("<span class='label label-danger'>No Disponible</span>");
                                            }
                                            else
                                            {
                                                Echo("<span class='label label-warning'>".$Dispon."</span>");
                                            }

                                            ?> 
                                        </td>

                                        </tr>
                                        <tr>
                                            <td>Proyección de Costo</td>
                                            <td><?php Echo(Formatomoneda($Costo_Proyectado_Pref)) ?></td>

                                        </tr>
                                        <tr>
                                            <td>P.V.P</td>
                                            <td><?php Echo(Formatomoneda($PVP_Ref)) ?></td>

                                        </tr>
                                        <tr>
                                            <td>Valor al Mayor</td>
                                            <td><?php Echo(Formatomoneda($P_Mayor)) ?></td>
                                        </tr>
                                        <tr class="danger">
                                            <td>Margen Bruto Proyectado</td>
                                            <td><?php Echo(round($UtilidadBruta,1)); ?>%</td>

                                        </tr>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
<?php 
}
}
 ?>


