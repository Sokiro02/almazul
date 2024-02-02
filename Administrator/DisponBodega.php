<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");

$IdUser=$_SESSION['IdUser'];
$Taller=$_POST['Select1'];
$RefSel=$_GET['ReferenciaAjax'];
$Insumo_Ppal=$_GET['InsumoP'];
//Echo($Taller);
 ?>

 <?php
$sql ="SELECT Cod_Insumo,Referencia_Cod_Referencia FROM t_insumos_ref WHERE Referencia_Cod_Referencia='".$RefSel."' order by Cod_Insumo asc";  
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    $Cod_Insumo=$row['Cod_Insumo'];
    $Ref=$row['Referencia_Cod_Referencia'];
    $PedidoMax=DisponibilidadInsumoTaller($Cod_Insumo,$Ref,$Taller);
    //Echo($PedidoMax);
    // Arreglo Insumos disponibles x Taller
    $ListaProveedores=$ListaProveedores.(int)$PedidoMax.",";     
 }
}

$CadenaProveedores=explode(",", $ListaProveedores);
$longitud = count($CadenaProveedores);
$min=$longitud-1;

if ($min==1) {
   $Lista = substr ($ListaProveedores, 0, strlen($ListaProveedores) - 1);
    $claves = preg_split("/[\s,]+/", $Lista);
    $PedidoMax=max($claves)+1;
}
else{
     $Listados = substr ($ListaProveedores, 0, strlen($ListaProveedores) - 1);
     $claves = preg_split("/[\s,]+/", $Listados);
        $CantidadMaxima=min($claves);
    $PedidoMax=$CantidadMaxima+1;
}



?>  
<?php 

    if ($PedidoMax==1) {
        ?>
<select class="col-lg-3 col-xs-12" name="TxtCantidadEspera" id="TxtCantidadEspera">
          <option value="">Indicar Cantidad</option>
          <option value="1">1 Und. a Lista de Espera</option>
                    <?php 
                    for ($m=2; $m <30 ; $m++) { 
                        Echo("<option value='".$m."'>".$m." Unds. a Lista de Espera</option>");
                    }
               ?>
          </select> 
        <?php
    }
    elseif ($PedidoMax==0) {
      ?>
      <select class="col-lg-3 col-xs-12" name="TxtCantidadEspera" id="TxtCantidadEspera">
          <option value="">Indicar Cantidad</option>
          <option value="1">1 Und. a Lista de Espera</option>
                    <?php 
                    for ($m=2; $m <30 ; $m++) { 
                        Echo("<option value='".$m."'>".$m." Unds. a Lista de Espera</option>");
                    }
               ?>
          </select> 
      <?php
     } 
     else
    {
        ?>
        <select class="col-lg-3 col-xs-12" name="TxtCantidad" id="TxtCantidad">
          <option value="">Indicar Cantidad</option>
                    <?php 
                     for ($i=1; $i <$PedidoMax ; $i++) { 
                        Echo("<option value='".$i."'>".$i." Un.</option>");
                    }
               ?>
        </select> 
        <?php
    }
 ?>
