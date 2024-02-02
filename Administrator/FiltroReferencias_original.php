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
    <?php 

$sql ="SELECT Cod_Insumo,Referencia_Cod_Referencia FROM t_insumos_ref WHERE Referencia_Cod_Referencia='".$CadenaReferencias[$i]."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    $Cod_Insumo=$row['Cod_Insumo'];
    $Ref=$row['Referencia_Cod_Referencia'];
    $PedidoMax=DisponibilidadInsumo($Cod_Insumo,$Ref);
    // Arreglo Insumos disponibles x Taller
    $ListaProveedores=$ListaProveedores.(int)$PedidoMax.",";     
 }
}
$CadenaProveedores=explode(",", $ListaProveedores);
$longitud2 = count($CadenaProveedores);
$min2=$longitud2-1;

if ($min2==1) {
   $Lista = substr ($ListaProveedores, 0, strlen($ListaProveedores) - 1);
    $claves = preg_split("/[\s,]+/", $Lista);
    $PedidoMax=max($claves);
}
else{
     $Listados = substr ($ListaProveedores, 0, strlen($ListaProveedores) - 1);
     $claves = preg_split("/[\s,]+/", $Listados);
        $CantidadMaxima=min($claves);
    $PedidoMax=$CantidadMaxima;
}


     ?>
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6" style="border: 1px dotted;border-color: #D8D8D8!important;">
                        <div class="card">
                            
                            <div class="card-body">
                                <div class="product-img">
                                    <h5 class="card-title m-b-2"><?php Echo($Coleccion_Nom_Coleccion); ?></h5>
                                    <h5 class="card-title m-b-2">Ref. <?php Echo($Cod_Referencia); ?></h5>
                                    <img width="100%" height="250" src="<?php Echo($Img_Referencia); ?>">
                                    <div class="pro-img-overlay">
                                        <a href="Produccion-Solicitud.php?RefSel=<?php Echo($Cod_Referencia); ?>&Referencia=<?php Echo($Coleccion_Nom_Coleccion); ?>" class="bg-info"><i class="fa fa-cogs"></i></a> 

                                         <a href="Produccion-SolicitudCliente.php?RefSel=<?php Echo($Cod_Referencia); ?>&Referencia=<?php Echo($Coleccion_Nom_Coleccion); ?>" class="bg-info"><i class="fa fa-cart-plus"></i></a> 

                                    </div>
                                </div>
                                <div class="product-text">
                                   
                                <a href="Ficha_Tecnica_Modasof.php?Ref=<?php Echo($Cod_Referencia); ?>"><span class="pro-price bg-primary" style="background-color: #f5f5f5;"><i class="fa fa-file-pdf-o red bigger-150"></i></span></a>
                                              
                                    
                                    <small>Fecha Diseño: <?php Echo($CreadaFecha) ?> </small>
                                    <table class="table table-bordered">
                                        
                                        <tr>
                                            
    <td colspan="2" class="center"> <span class="label label-success">Referencia <?php Echo($Estado_Ref); ?></span></td>
                                        </tr>
                                        <tr>
                                           
                                            
                                        </tr> 
                                        <tr class="warning">
                                            <td>Solicitud de Producción</td>
                                            <td><?php 


                                             
                                            if ($PedidoMax==0) {
                                                Echo("<span class='label label-danger'>No Disponible</span>");
                                            }
                                            else
                                            {
                                                Echo("<span class='label label-success'>Disponible</span>");
                                            }

                                            ?> 
                                        </td>

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
    
$sql ="SELECT * FROM t_referencias WHERE Cod_Referencia LIKE '%".$Filtro."%' || Costo_Proyectado_Pref LIKE '%".$Filtro."%' || Fecha_Creacion LIKE '%".$Filtro."%' || Estado_Ref LIKE '%".$Filtro."%' || PVP_Ref LIKE '%".$Filtro."%' || P_Mayor LIKE '%".$Filtro."%' || Coleccion_Nom_Coleccion LIKE '%".$Filtro."%' || Tipo_Tela LIKE '%".$Filtro."%' || Color_Insumo_Ppal LIKE '%".$Filtro."%' order by Fecha_Creacion ASC";  
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
    <?php 

$sql ="SELECT Cod_Insumo,Referencia_Cod_Referencia FROM t_insumos_ref WHERE Referencia_Cod_Referencia='".$Cod_Referencia."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    $Cod_Insumo=$row['Cod_Insumo'];
    $Ref=$row['Referencia_Cod_Referencia'];
    $PedidoMax=DisponibilidadInsumo($Cod_Insumo,$Cod_Referencia);
    // Arreglo Insumos disponibles x Taller
    $ListaProveedores=$ListaProveedores.(int)$PedidoMax.",";     
 }
}

$CadenaProveedores=explode(",", $ListaProveedores);
$longitud3 = count($CadenaProveedores);
$min3=$longitud2-1;

if ($min3==1) {
   $Lista = substr ($ListaProveedores, 0, strlen($ListaProveedores) - 1);
    $claves = preg_split("/[\s,]+/", $Lista);
    $PedidoMax=max($claves);
}
else{
     $Listados = substr ($ListaProveedores, 0, strlen($ListaProveedores) - 1);
     $claves = preg_split("/[\s,]+/", $Listados);
        $CantidadMaxima=min($claves);
    $PedidoMax=$CantidadMaxima;
}
     ?>
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6" style="border: 1px dotted;border-color: #D8D8D8!important;">
                        <div class="card">
                            <div class="card-body">
                                <div class="product-img">
                                    <h5 class="card-title m-b-2"><?php Echo($Coleccion_Nom_Coleccion); ?></h5>
                                    <h5 class="card-title m-b-2">Ref. <?php Echo($Cod_Referencia); ?></h5>
                                    <img width="100%" height="250" src="<?php Echo($Img_Referencia); ?>">
                                    <div class="pro-img-overlay"><a href="Produccion-Solicitud.php?RefSel=<?php Echo($Cod_Referencia); ?>&Referencia=<?php Echo($Coleccion_Nom_Coleccion); ?>" class="bg-info"><i class="fa fa-cogs"></i></a> 
                                         <a href="Produccion-SolicitudCliente.php?RefSel=<?php Echo($Cod_Referencia); ?>&Referencia=<?php Echo($Coleccion_Nom_Coleccion); ?>" class="bg-info"><i class="fa fa-cart-plus"></i></a> 
                                    </div>
                                </div>
                                <div class="product-text">
                                   <a href="Ficha_Tecnica_Modasof.php?Ref=<?php Echo($Cod_Referencia); ?>"><span class="pro-price bg-primary" style="background-color: #f5f5f5;"><i class="fa fa-file-pdf-o red bigger-150"></i></span></a>

                                    
                                    <small>Fecha Diseño: <?php Echo($CreadaFecha) ?> </small>
                                    <table class="table table-bordered">
                                        
                                        <tr>
                                            
    <td colspan="2" class="center"> <span class="label label-success">Referencia <?php Echo($Estado_Ref); ?></span></td>
                                        </tr>
                                        <tr>
                                           
                                            
                                        </tr> 
                                        <tr class="warning">
                                            <td>Solicitud de Producción</td>
                                            <td><?php 


                                             
                                            if ($PedidoMax==0) {
                                                Echo("<span class='label label-danger'>No Disponible</span>");
                                            }
                                            else
                                            {
                                                Echo("<span class='label label-success'>Disponible</span>");
                                            }

                                            ?> 
                                        </td>

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


