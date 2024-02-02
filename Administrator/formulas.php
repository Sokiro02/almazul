<?php 
//*******************************************************************************************************************
//*******************************  Colocar el Signo Pesos a valores extraídos por base ******************************

function formatomoneda($valor)
{
   $VAR=number_format($valor, 0,'.', '.');
   echo("$".$VAR);
}


//*******************************************************************************************************************
//*******************************  Guardar notificaciones  ******************************
//*******************************************************************************************************************
function EnviarNotificacion($UsuarioEnvia,$Comentario,$TipoNotificacion,$UsuarioReceptor)
{

date_default_timezone_set("America/Bogota");
$MarcaTemporal = date('Y-m-d H:i:s');
$Estado=1;
include("conexion.php");
$sql = "INSERT INTO t_notificaciones (Usuario_id_Usuario,Tipo_Notificacion,Fecha_Not,Comentario,Usuario_Receptor,Estado_notificacion)
VALUES ('".utf8_decode($UsuarioEnvia)."','".utf8_decode($TipoNotificacion)."', '".utf8_decode($MarcaTemporal)."', '".utf8_decode($Comentario)."','".utf8_decode($UsuarioReceptor)."','".utf8_decode($Estado)."')";
//echo($sql);
$result = $conexion->query($sql);
}

//*******************************************************************************************************************
//*****************Quitar signos y puntos a valores enviados por form de campos Money ******************************
//*******************************************************************************************************************

function FormatoMascara($valor)
{
$V1=str_replace(".","",$valor);
$V2=str_replace(" ", "", $V1);
$valor_final=str_replace("$", "", $V2);
$valornumero=(int) $valor_final;
return $valornumero;

}


//*******************************************************************************************************************
//*********************************Días de Validación de una fecha a otra *******************************************
//*******************************************************************************************************************
function dias_transcurridos($fecha_i,$fecha_f)
{
    $dias   = (strtotime($fecha_i)-strtotime($fecha_f))/86400;
    $dias   = abs($dias); $dias = floor($dias);     
    return $dias;
}

//*******************************************************************************************************************
//***************************** Formato Fecha Larga para valor extraído por Base****** ******************************
//*******************************************************************************************************************

function fechaSql($fechaSql)
{
$date = new DateTime($fechaSql);
$W=$date->format('w');
$d=$date->format('d');
$n=$date->format('n');
$Y=$date->format('Y');

$dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
$meses = array("Ene-","Feb-","Mar-","Abr-","May-","Jun-","Jul-","Ago-","Sep-","Oct-","Nov-","Dic-");
$NuevaFecha=($dias[date($W)].", ".date($d)." de ".$meses[date($n)-1]. " ".date($Y));

return $NuevaFecha;
}

function NomMes($MesEnviado)
{
    $NomMesCase =$MesEnviado ;
switch ($NomMesCase) {
    case 1:
        $NomMes="Ene";
        break;
    case 2:
       $NomMes="Feb";
        break;
    case 3:
        $NomMes="Mar";
        break;
     case 4:
        $NomMes="Abr";
        break;
    case 5:
        $NomMes="May";
        break;
    case 6:
        $NomMes="Jun";
        break;
    case 7:
        $NomMes="Jul";
        break;
    case 8:
        $NomMes="Ago";
        break;
    case 9:
        $NomMes="Sep";
        break;
     case 10:
        $NomMes="Oct";
        break;
     case 11:
        $NomMes="Nov";
        break;
     case 12:
        $NomMes="Dic";
        break;
}
return $NomMes;
}


//*******************************************************************************************************************
//********************************* Fórmulas Módulo Tareas **********************************************************
//*******************************************************************************************************************

function ContadorTareas($Dificultad,$UsuarioTarea)
{
    include("conexion.php");
$sql="SELECT count(Id_Tarea) as CuentaTarea From T_Tareas where  Dificultad_id_dificultad='".$Dificultad."' and Usuario_id_usuario='".$UsuarioTarea."'";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $CuentaTarea=$row['CuentaTarea'];
    }
}
$TotalTareas= $CuentaTarea;
return $TotalTareas;
 } 

 function ContadorTerminadas($Terminada,$UsuarioTarea)
{
    include("conexion.php");
$sql="SELECT count(Id_Tarea) as CuentaTerminadas From T_Tareas where  Estado_id_estado_tarea='".$Terminada."' and Usuario_id_usuario='".$UsuarioTarea."'";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $CuentaTerminadas=$row['CuentaTerminadas'];
    }
}
$TotalTerminadas= $CuentaTerminadas;
return $TotalTerminadas;
 }  


function ColorTarea($TipoTarea)
{
    include("conexion.php");
$sql="SELECT Color_Estado  From T_Estado_Tarea where  Id_estado_tarea='".$TipoTarea."'";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Color_Estado=$row['Color_Estado'];
    }
}
return $Color_Estado;
 }  
function NomEstado($NomTarea)
{
    include("conexion.php");
$sql="SELECT Nom_Estado_Tarea  From T_Estado_Tarea where  Id_estado_tarea='".$NomTarea."'";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Nom_Estado_Tarea=$row['Nom_Estado_Tarea'];
    }
}
return $Nom_Estado_Tarea;
 }  


function ConversorTiempo($DiaLaboral,$CtDias,$CtHoras,$CtMinutos)
{
    $Hora=60;
    $TotalDias=$DiaLaboral*$CtDias;
    $TotalHoras=$CtHoras;
    $TotalMinutos=round($CtMinutos/$Hora,1);
    $TiempoTotal=round($TotalDias+$TotalHoras+$TotalMinutos,1);

    return $TiempoTotal;
}
function Tiponotificacion($Tipo,$NomUser,$Avatar,$UrlApp)
{
    if ($Tipo==1) {
        $tmp='<script type="text/javascript">
            Push.create("'.utf8_encode($NomUser).'",{
                body:"Acaba de crear una actividad",
                icon:"../Administrator/'.$Avatar.'",
                timeout:20000,
                onClick:function(){
                    window.location="'.$UrlApp.'";
                    this.close();
                }
            });
        </script>';
        return $tmp;
    }
}


//*******************************************************************************************************************
//********************************* Total Inventario de Insumo por Taller *******************************************
//*******************************************************************************************************************

function DisponibilidadBodega($Bodega,$CodInsumo)
{
  include("conexion.php");

///////////////////  Ingreso de Insumos a Taller ////////////////////

    // 1. Ingreso por Compras realizadas
$sql="SELECT IFNULL(sum(Cant_Mov),0) as IngresoCompra From t_mov_insumos where  Bodega_Id_Bodega_Recibe='".$Bodega."' and Insumo_Cod_Insumo='".$CodInsumo."' and Tipo_Mov_Insumo='Ingreso por Compra';";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $IngresoCompra=$row['IngresoCompra'];
    }
}
   // 2. Ingreso por Transferencias entre Talleres

    $sql="SELECT IFNULL(sum(Cant_Mov),0) as IngresoTransTaller From t_mov_insumos where  Bodega_Id_Bodega_Recibe='".$Bodega."' and Insumo_Cod_Insumo='".$CodInsumo."' and Tipo_Mov_Insumo='Ingreso por Transferencia';";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $IngresoTransTaller=$row['IngresoTransTaller'];
    }
}

 // 1. Ingreso por Compras realizadas
$sql="SELECT IFNULL(sum(Cant_Mov),0) as IngresoInicial From t_mov_insumos where  Bodega_Id_Bodega_Recibe='".$Bodega."' and Insumo_Cod_Insumo='".$CodInsumo."' and Tipo_Mov_Insumo='Ingreso Inicial.';";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $IngresoInicial=$row['IngresoInicial'];
    }
}

///////////////////  Egresos de Insumos a Taller ////////////////////

    // 1. Egreso por Transferencia realizada entre talleres

$sql="SELECT IFNULL(sum(Cant_Mov),0) as EgresoTransTaller From t_mov_insumos where  Bodega_Id_Bodega_Retira='".$Bodega."' and Insumo_Cod_Insumo='".$CodInsumo."' and Tipo_Mov_Insumo='Retiro Transferencia';";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $EgresoTransTaller=$row['EgresoTransTaller'];
    }
}

    // 2. Egreso por Producción

$sql="SELECT IFNULL(sum(Cant_Mov),0) as EgresoProd From t_mov_insumos where  Bodega_Id_Bodega_Retira='".$Bodega."' and Insumo_Cod_Insumo='".$CodInsumo."' and Tipo_Mov_Insumo='Retiro Prod.';";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $EgresoProd=$row['EgresoProd'];
    }
}

    // Arqueo Inventario Final 

$IngresoInsumos=$IngresoCompra+$IngresoTransTaller+$IngresoInicial;
$EgresoInsumos= $EgresoTransTaller+$EgresoProd;
$SumaTotal=$IngresoInsumos-$EgresoInsumos;

if ($SumaTotal==0) {
    $ValorTotal=0;
}
else
{
    $ValorTotal=$SumaTotal;
}

return $ValorTotal;   
}

//*******************************************************************************************************************
//**************** Fórmula disponibilidad de insumos para realizar 1 Prenda en producción *******************************
//*******************************************************************************************************************

function DisponibilidadInsumo($CodInsumo,$Referencia)
{
  include("conexion.php");

///////////////////  Ingreso de Insumos a Taller ////////////////////

    // 1. Ingreso por Compras realizadas
$sql="SELECT IFNULL(sum(Cant_Mov),0) as IngresoCompra From t_mov_insumos where Insumo_Cod_Insumo='".$CodInsumo."' and Tipo_Mov_Insumo='Ingreso por Compra';";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $IngresoCompra=$row['IngresoCompra'];
    }
}
   // 2. Ingreso por Transferencias entre Talleres

    $sql="SELECT IFNULL(sum(Cant_Mov),0) as IngresoTransTaller From t_mov_insumos where  Insumo_Cod_Insumo='".$CodInsumo."' and Tipo_Mov_Insumo='Ingreso por Transferencia';";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $IngresoTransTaller=$row['IngresoTransTaller'];
    }
}

///////////////////  Egresos de Insumos a Taller ////////////////////

    // 1. Egreso por Transferencia realizada entre talleres

$sql="SELECT IFNULL(sum(Cant_Mov),0) as EgresoTransTaller From t_mov_insumos where  Insumo_Cod_Insumo='".$CodInsumo."' and Tipo_Mov_Insumo='Retiro Transferencia';";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $EgresoTransTaller=$row['EgresoTransTaller'];
    }
}

    // 2. Egreso por Producción

$sql="SELECT IFNULL(sum(Cant_Mov),0) as EgresoProd From t_mov_insumos where  Insumo_Cod_Insumo='".$CodInsumo."' and Tipo_Mov_Insumo='Retiro Prod.';";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $EgresoProd=$row['EgresoProd'];
    }
}

    // Arqueo Inventario Final 

$IngresoInsumos=$IngresoCompra+$IngresoTransTaller;
$EgresoInsumos= $EgresoTransTaller+$EgresoProd;
$SumaTotal=$IngresoInsumos-$EgresoInsumos;

if ($SumaTotal==0) {
    $InsumoDisponible=0;
}
else
{
    // Validar Cantidad Solicitada para hacer un producto
$sql="SELECT IFNULL(sum(Cant_Solicitada),0) as Cant_Solicitada From t_insumos_ref where  Cod_Insumo='".$CodInsumo."' and Referencia_Cod_Referencia='".$Referencia."';";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Cant_Solicitada=$row['Cant_Solicitada'];
    }
}

    $InsumoDisponible=round($SumaTotal/$Cant_Solicitada,0);
}

return $InsumoDisponible;   
}

//*******************************************************************************************************************
//**************** Fórmula Disponibilidad de insumos para realizar 1 Prenda por taller ******************************
//*******************************************************************************************************************

function DisponibilidadInsumoTaller($CodInsumo,$Referencia)
{
  include("conexion.php");

///////////////////  Ingreso de Insumos a Taller ////////////////////

    // 1. Ingreso por Compras realizadas
$sql="SELECT IFNULL(sum(Cantidad_Inv),0) as TotalInventario From t_inventario_telas where  Cod_Insumo_Cod='".$CodInsumo."'";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $TotalInventario=$row['TotalInventario'];
    }
}
   


if ($TotalInventario==0) {
    $InsumoDisponible=0;
}
else
{
    // Validar Cantidad Solicitada para hacer un producto
$sql="SELECT IFNULL(sum(Cant_Solicitada),0) as Cant_Solicitada From t_insumos_ref where  Cod_Insumo='".$CodInsumo."' and Referencia_Cod_Referencia='".$Referencia."';";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Cant_Solicitada=$row['Cant_Solicitada'];
    }
}

    $InsumoDisponible=round($TotalInventario/$Cant_Solicitada,0);
}

return $InsumoDisponible;   
}

//*******************************************************************************************************************
//**************** Validación de cantidad insumos comprados Vs Cantidad Recibidos   ******************************
//*******************************************************************************************************************

function CantidadRecibida($OrdenCompra,$CodInsumo,$BodegaRecibe)
{
  include("conexion.php");
$sql="SELECT IFNULL(sum(Cant_Mov),0) as SumaRecibida From t_mov_insumos where  OrdenCompra='".$OrdenCompra."' and Insumo_Cod_Insumo='".$CodInsumo."' and Bodega_Id_Bodega_Recibe='".$BodegaRecibe."' and Tipo_Mov_Insumo='Ingreso por Compra';";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $SumaRecibida=$row['SumaRecibida'];
    }
}

return $SumaRecibida;   
}


//*******************************************************************************************************************
//**************************** Función para conocer valores por mes enviando la tabla  ******************************
//*******************************************************************************************************************


function SumaporFechas($campo,$tabla,$nmeses,$campofecha,$multiplicador)
{
    include("conexion.php");

//Formato Fecha Ultimo Trimestre
date_default_timezone_set("America/Bogota");
$MarcaTemporal = date('Y-m-d H:i:s');

// Validación del Mes a consultar.
if ($nmeses=="Actual") {
   $Mes=date('n');
}
elseif ($nmeses=="Anterior") {
    $Mes=date('n'+1);
}
elseif ($nmeses=="Posterior") {
    $Mes=date('n'+3);
}
// 
$sql="SELECT IFNULL(sum(".$campo."*".$multiplicador."),0) as TotalMes from ".$tabla." WHERE MONTH(".$campofecha.") ='".$Mes."'";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $TotalMes=$row['TotalMes'];
    }
}
return $TotalMes;
}


//*******************************************************************************************************************
//**************** Función para promediar costo de insumo traído por más de un proveedor  ***************************
//*******************************************************************************************************************

function PromedioCostoInsumo($CodigoInsumo)
{
    include("conexion.php");
$sql="SELECT AVG(Costo_Insumo) AS Promedio FROM t_insumos WHERE Cod_Insumo='".$CodigoInsumo."'";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Promedio=$row['Promedio'];
    }
}
return $Promedio;
}

//*******************************************************************************************************************
//****************************          Función Total Insumos por Orden de Pedido      ******************************
//*******************************************************************************************************************

function TotalInsumosAgregados($IdOrden)
{
    include("conexion.php");
    $sql="SELECT IFNULL(sum(Valor_Temporal),0) as TotalInsumos FROM t_temporal_ref Where Orden_Temporal='".$IdOrden."'";
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $TotalInsumos=$row['TotalInsumos'];
        }
    }
    return $TotalInsumos;
}

function TotalInsumosAgregados2($IdOrden)
{
    include("conexion.php");
    $sql="SELECT IFNULL(sum(Valor_Temporal),0) as TotalInsumos FROM t_temporal_ref2 Where Orden_Temporal='".$IdOrden."'";
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $TotalInsumos=$row['TotalInsumos'];
        }
    }
    return $TotalInsumos;
}

//*******************************************************************************************************************
//*************************************** Total Prendas por Estado   ************************************************
//*******************************************************************************************************************

function SumaEstadoProduccion($EstadoProduccion)
{
    include("conexion.php");
    $sql="SELECT IFNULL(sum(Cant_Solicitada),0) as TotalPrendas FROM t_solicitudes_prod Where Estado_Solicitud_Prod='".$EstadoProduccion."'";
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $TotalPrendas=$row['TotalPrendas'];
        }
    }
    return $TotalPrendas;
}

//*******************************************************************************************************************
//************************************* Total Prendas por Estado detallado por Tienda  ******************************
//*******************************************************************************************************************

function SumaEstadoProduccionBodega($EstadoProduccion,$Tienda)
{
    include("conexion.php");
    $sql="SELECT IFNULL(sum(Cant_Solicitada),0) as TotalPrendas FROM t_solicitudes_prod Where Estado_Solicitud_Prod='".$EstadoProduccion."' and Tienda_Id_Tienda='".$Tienda."'";
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $TotalPrendas=$row['TotalPrendas'];
        }
    }
    return $TotalPrendas;
}

//*******************************************************************************************************************
//********************************************* Cantidad Máxima para Producir   *************************************
//*******************************************************************************************************************

function DisponibilidadRefporTaller($RefConsultada,$TallerConsultado)
{

// Validación de Insumos y Cantidades Disponibles para producir
include("conexion.php");
$sql ="SELECT Cod_Insumo,Referencia_Cod_Referencia FROM t_insumos_ref WHERE Referencia_Cod_Referencia='".$RefConsultada."' order by Cod_Insumo asc";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    $Cod_Insumo=$row['Cod_Insumo'];
    $Ref=$row['Referencia_Cod_Referencia'];
    $PedidoMax=DisponibilidadInsumoTaller($Cod_Insumo,$Ref);
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
 
 return $PedidoMax;
}

//*******************************************************************************************************************
//************************* Función Ingresos - Medio de Pago Ventas diarias por Tienda  *****************************
//*******************************************************************************************************************

function SumaMediosdePago($Tienda,$MedioPago) 
{
    include("conexion.php");


date_default_timezone_set("America/Bogota");
$MarcaTemporal = date('Y-m-d');
$FechaInicioDia=($MarcaTemporal." 00:00:000");
$FechaFinalDia=($MarcaTemporal." 23:59:000");
// Validación de la fecha en que inicia el Día

    $sql="SELECT IFNULL(sum(Valor_Ingreso),0) as TotalSuma FROM t_ingresos Where Tienda_Id_Tienda='".$Tienda."' and Medio_Pago='".$MedioPago."' and Fecha_Ingreso >='".$FechaInicioDia."' and Fecha_Ingreso <='".$FechaFinalDia."'";
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $TotalSuma=$row['TotalSuma'];
        }
    }
    return $TotalSuma;
}

//*******************************************************************************************************************
//************************* Función Ingresos - Medio de Pago Ventas Totales por Tienda  *****************************
//*******************************************************************************************************************

function TotalSumaMediosdePago($Tienda,$MedioPago)
{
    include("conexion.php");

    $sql="SELECT IFNULL(sum(Valor_Ingreso),0) as TotalSuma FROM t_ingresos Where Tienda_Id_Tienda='".$Tienda."' and Medio_Pago='".$MedioPago."'";
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $TotalSuma=$row['TotalSuma'];
        }
    }
    return $TotalSuma;
}

//*******************************************************************************************************************
//******************************** Función Gastos Diarios  por Tienda  **********************************************
//*******************************************************************************************************************

function SumaGastosDiaTienda($Tienda)
{
    include("conexion.php");


date_default_timezone_set("America/Bogota");
$MarcaTemporal = date('Y-m-d');
$FechaInicioDia=($MarcaTemporal." 00:00:000");
$FechaFinalDia=($MarcaTemporal." 23:59:000");
// Validación de la fecha en que inicia el Día

    $sql="SELECT IFNULL(sum(Valor_gasto),0) as TotalSuma FROM t_gastos Where Tienda_Id_Tienda='".$Tienda."' and  Fecha_gasto >='".$FechaInicioDia."' and Fecha_gasto <='".$FechaFinalDia."'";
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $TotalSuma=$row['TotalSuma'];
        }
    }
    return $TotalSuma;
}


//*******************************************************************************************************************
//******************************** Función Gastos Totales  por Tienda  **********************************************
//*******************************************************************************************************************

function TotalSumaGastosDiaTienda($Tienda)
{
    include("conexion.php");

    $sql="SELECT IFNULL(sum(Valor_gasto),0) as TotalSuma FROM t_gastos Where Tienda_Id_Tienda='".$Tienda."'";
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $TotalSuma=$row['TotalSuma'];
        }
    }
    return $TotalSuma;
}

//*******************************************************************************************************************
//******************************** Función Egresos Diarios  por Tienda  **********************************************
//*******************************************************************************************************************


function SumaEgresosDiaTienda($Tienda)
{
    include("conexion.php");

date_default_timezone_set("America/Bogota");
$MarcaTemporal = date('Y-m-d');
$FechaInicioDia=($MarcaTemporal." 00:00:000");
$FechaFinalDia=($MarcaTemporal." 23:59:000");
// Validación de la fecha en que inicia el Día


    $sql="SELECT IFNULL(sum(Valor_Transferido),0) as TotalSuma FROM t_mov_cuentas Where Id_Cuenta_Sale='".$Tienda."' and  Fecha_Transf >='".$FechaInicioDia."' and Fecha_Transf <='".$FechaFinalDia."'";
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $TotalSuma=$row['TotalSuma'];
        }
    }
    return $TotalSuma;
}


//*******************************************************************************************************************
//******************************** Función Egresos Diarios  por Tienda  **********************************************
//*******************************************************************************************************************


function TotalSumaEgresosDiaTienda($Tienda)
{
    include("conexion.php");


// Validación de la fecha en que inicia el Día


    $sql="SELECT IFNULL(sum(Valor_Transferido),0) as TotalSuma FROM t_mov_cuentas Where Id_Cuenta_Sale='".$Tienda."'";
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $TotalSuma=$row['TotalSuma'];
        }
    }
    return $TotalSuma;
}


//*******************************************************************************************************************
//******************************** Función Total Facturado  por Tienda  **********************************************
//*******************************************************************************************************************

function TotalFacturado($Tienda)
{
    include("conexion.php");


date_default_timezone_set("America/Bogota");
$MarcaTemporal = date('Y-m-d');
$FechaInicioDia=($MarcaTemporal." 00:00:000");
$FechaFinalDia=($MarcaTemporal." 23:59:000");
// Validación de la fecha en que inicia el Día

    $sql="SELECT IFNULL(sum(Total_Factura),0) as TotalFacturas FROM t_facturas Where Tienda_Id_Tienda='".$Tienda."' and Fecha_Factura >='".$FechaInicioDia."' and Fecha_Factura <='".$FechaFinalDia."'";
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $TotalFacturas=$row['TotalFacturas'];
        }
    }
    return $TotalFacturas;
}


//*******************************************************************************************************************
//*********************************** TOTAL ANTICIPOS DIARIOS POR TIENDA  *******************************************
//*******************************************************************************************************************

function AnticiposDiaTienda($Tienda)
{
    include("conexion.php");


date_default_timezone_set("America/Bogota");
$MarcaTemporal = date('Y-m-d');
$FechaInicioDia=($MarcaTemporal." 00:00:000");
$FechaFinalDia=($MarcaTemporal." 23:59:000");
// Validación de la fecha en que inicia el Día

    $sql="SELECT IFNULL(sum(Valor_Ingreso),0) as AnticiposDia FROM t_ingresos Where Tienda_Id_Tienda='".$Tienda."' and Fecha_Ingreso >='".$FechaInicioDia."' and Fecha_Ingreso <='".$FechaFinalDia."' and Cod_Recibo_Caja<>0";
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $AnticiposDia=$row['AnticiposDia'];
        }
    }
    return $AnticiposDia;
}

//*******************************************************************************************************************
//***************************************** Abonos realizados a Facturas  *******************************************
//*******************************************************************************************************************

function AbonosDiaTienda($Tienda)
{
    include("conexion.php");


date_default_timezone_set("America/Bogota");
$MarcaTemporal = date('Y-m-d');
$FechaInicioDia=($MarcaTemporal." 00:00:000");
$FechaFinalDia=($MarcaTemporal." 23:59:000");
// Validación de la fecha en que inicia el Día

    $sql="SELECT IFNULL(sum(Valor_Ingreso),0) as AbonosDia FROM t_ingresos as A, t_facturas as B Where B.Tienda_Id_Tienda='".$Tienda."' and Fecha_Ingreso >='".$FechaInicioDia."' and Fecha_Ingreso <='".$FechaFinalDia."' and B.Num_Factura=A.Factura_Cod_Factura and Factura_Paga='2'";
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $AbonosDia=$row['AbonosDia'];
        }
    }
    return $AbonosDia;
}

//*******************************************************************************************************************
//*********************************** Función cantidad por tallas en tienda  ****************************************
//*******************************************************************************************************************

function ArqueoInventarioTalla_old($Referencia,$Talla,$Tienda)
{
    include("conexion.php");

    $sql="SELECT  SUM(Cantidad_Inv) as IngresoInicial FROM t_inventario_ref as A WHERE Inv_Ref='".$Referencia."'  and  Tienda_Id_Tienda='".$Tienda."' and Talla_Id_Talla='".$Talla."' and Tipo_Mov_Inv='Ingreso Inicial' GROUP BY Talla_Id_Talla";
  $result=$conexion->query($sql);
  if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc ()) {

      $IngresoInicial=$row['IngresoInicial'];
  }
}

  $sql="SELECT  SUM(Cantidad_Inv) as IngresoDespacho FROM t_inventario_ref as A WHERE Inv_Ref='".$Referencia."'  and  Tienda_Id_Tienda='".$Tienda."' and Talla_Id_Talla='".$Talla."' and Tipo_Mov_Inv='DESPACHO' GROUP BY Talla_Id_Talla";
  //Echo($sql);
  $result=$conexion->query($sql);
  if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc ()) {

      $IngresoDespacho=$row['IngresoDespacho'];
  }
}

 $sql="SELECT  SUM(Cantidad_Inv) as IngresoProd FROM t_inventario_ref WHERE Inv_Ref='".$Referencia."'  and Tienda_Id_Tienda='".$Tienda."' and Talla_Id_Talla='".$Talla."' and Tipo_Mov_Inv='Ingreso de Prod' and Solicitud_Prod<>'0' GROUP BY Talla_Id_Talla";
//Echo($sql);
  $result=$conexion->query($sql);
  if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc ()) {

      $IngresoProd=$row['IngresoProd'];
  }
}

$sql="SELECT  SUM(Cantidad_Inv) as SalidaVenta FROM t_inventario_ref WHERE Inv_Ref='".$Referencia."'  and Tienda_Id_Tienda='".$Tienda."' and Talla_Id_Talla='".$Talla."' and Tipo_Mov_Inv='Salida Venta' GROUP BY Talla_Id_Talla";
//Echo($sql);
  $result=$conexion->query($sql);
  if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc ()) {

      $SalidaVenta=$row['SalidaVenta'];
  }
}

    $TotalIngresoRef=$IngresoInicial+$IngresoProd+$IngresoDespacho;
    $TotalEgresoRef=$SalidaVenta;
    $TotalRef=$TotalIngresoRef-$TotalEgresoRef;


    return $TotalRef;
}

//*******************************************************************************************************************
//*********************************** Función cantidad por tallas en tienda  ****************************************
//*******************************************************************************************************************

function ArqueoInventarioTalla($Referencia,$Talla,$Tienda)
{
    include("conexion.php");

    $sql="SELECT  Cantidad FROM t_inventario  WHERE Referencia_Completa='".$Referencia."'  and  Id_Tienda='".$Tienda."'  GROUP BY Id_Talla";
  $result=$conexion->query($sql);
  if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc ()) {

      $TotalRef=$row['Cantidad'];
  }
}

  
    return $TotalRef;
}
//*******************************************************************************************************************
//*********************************** Función cantidad por Referencia en tienda  ************************************
//*******************************************************************************************************************


function ArqueoInventarioRef_Old($Referencia,$Tienda)
{
    include("conexion.php");

    $sql="SELECT  SUM(Cantidad_Inv) as IngresoInicial FROM t_inventario_ref as A WHERE Inv_Ref='".$Referencia."'  and  Tienda_Id_Tienda='".$Tienda."' and Tipo_Mov_Inv='Ingreso Inicial' ";
  $result=$conexion->query($sql);
  if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc ()) {

      $IngresoInicial=$row['IngresoInicial'];
  }
}

 $sql="SELECT  SUM(Cantidad_Inv) as IngresoProd FROM t_inventario_ref WHERE Inv_Ref='".$Referencia."'  and Tienda_Id_Tienda='".$Tienda."' and Tipo_Mov_Inv='Ingreso de Prod' and Solicitud_Prod<>'0' ";
//Echo($sql);
  $result=$conexion->query($sql);
  if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc ()) {

      $IngresoProd=$row['IngresoProd'];
  }
}

$sql="SELECT  SUM(Cantidad_Inv) as SalidaVenta FROM t_inventario_ref WHERE Inv_Ref='".$Referencia."'  and Tienda_Id_Tienda='".$Tienda."' and Tipo_Mov_Inv='Salida Venta'";
//Echo($sql);
  $result=$conexion->query($sql);
  if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc ()) {

      $SalidaVenta=$row['SalidaVenta'];
  }
}

$sql="SELECT  SUM(Cantidad_Inv) as SalidaRemision FROM t_inventario_ref WHERE Ref_Completa='".$Referencia."'  and Tienda_Id_Tienda='".$Tienda."' and Tipo_Mov_Inv='Salida Remision'";
//Echo($sql);
  $result=$conexion->query($sql);
  if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc ()) {

      $SalidaRemision=$row['SalidaRemision'];
  }
}

    $TotalIngresoRef=$IngresoInicial+$IngresoProd;
    $TotalEgresoRef=$SalidaVenta+$SalidaRemision;
    $TotalRef=$TotalIngresoRef-$TotalEgresoRef;


    return $TotalRef;
}

//*******************************************************************************************************************
//*********************************** Función cantidad por Referencia en tienda  ************************************
//*******************************************************************************************************************


function ArqueoInventarioRef($Referencia,$Tienda)
{
    include("conexion.php");

    $sql="SELECT  Cantidad  FROM t_inventario as A WHERE Referencia='".$Referencia."'  and  Id_Tienda='".$Tienda."'";
  $result=$conexion->query($sql);
  if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc ()) {

      $TotalRef=$row['Cantidad'];
  }
}


    return $TotalRef;
}


//*******************************************************************************************************************
//*********************************** Función Informe Inventario por Ref  ************************************
//*******************************************************************************************************************

function InventarioReal_Old2($RefCompleta,$Tienda)
{
    include("conexion.php");

    $sql="SELECT  SUM(Cantidad_Inv) as IngresoInicial FROM t_inventario_ref  WHERE Ref_Completa='".$RefCompleta."'  and  Tienda_Id_Tienda='".$Tienda."' and Tipo_Mov_Inv='Ingreso Inicial' ";
  $result=$conexion->query($sql);
  if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc ()) {

      $IngresoInicial=$row['IngresoInicial'];
  }
}

 $sql="SELECT  SUM(Cantidad_Inv) as IngresoDespachos FROM t_inventario_ref  WHERE Ref_Completa='".$RefCompleta."'  and  Tienda_Id_Tienda='".$Tienda."' and Tipo_Mov_Inv='DESPACHO' ";
  $result=$conexion->query($sql);
  if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc ()) {

      $IngresoDespachos=$row['IngresoDespachos'];
  }
}


$sql="SELECT  SUM(Cantidad_Inv) as SalidaVenta FROM t_inventario_ref WHERE Ref_Completa='".$RefCompleta."'  and Tienda_Id_Tienda='".$Tienda."' and Tipo_Mov_Inv='Salida Venta'";
//Echo($sql);
  $result=$conexion->query($sql);
  if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc ()) {

      $SalidaVenta=$row['SalidaVenta'];
  }
}


$sql="SELECT  SUM(Cantidad_Inv) as SalidaRemision FROM t_inventario_ref WHERE Ref_Completa='".$RefCompleta."'  and Tienda_Id_Tienda='".$Tienda."' and Tipo_Mov_Inv='Salida Remision'";
//Echo($sql);
  $result=$conexion->query($sql);
  if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc ()) {

      $SalidaRemision=$row['SalidaRemision'];
  }
}


    $TotalIngresoRef=$IngresoInicial+$IngresoDespachos;
    $TotalEgresoRef=$SalidaVenta+$SalidaRemision;

    $TotalRef=$TotalIngresoRef-$TotalEgresoRef;


    return $TotalRef;
}

//*******************************************************************************************************************
//*********************************** Función Informe Inventario por Ref  ************************************
//*******************************************************************************************************************

function InventarioReal($RefCompleta,$Tienda)
{
    include("conexion.php");

    $sql="SELECT  Cantidad FROM t_inventario  WHERE Referencia_Completa='".$RefCompleta."'  and  Id_Tienda='".$Tienda."'";
  $result=$conexion->query($sql);
  if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc ()) {

      $TotalRef=$row['Cantidad'];
  }
}



    return $TotalRef;
}


//*******************************************************************************************************************
//*********************************** Función Descontar Inventario Telas Orden C.************************************
//*******************************************************************************************************************

function BucleDescuentoInsumos($RefCompleta,$CantidadSolicitada)
{
    include("conexion.php");

   // Bucle para conocer los codigos que se requieren para el producto 
$sql ="SELECT Cod_Insumo FROM t_insumos_ref WHERE Referencia_Cod_Referencia='".$RefCompleta."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$ListaInsumos=$ListaInsumos.$row['Cod_Insumo'].",";                  
 }
}
$CadenaInsumos=explode(",", $ListaInsumos);
//Split al Arreglo
$longitud2 = count($CadenaInsumos);
$min2=$longitud2-1;
//Recorro todos los elementos

for($x=0; $x<$min2; $x++)
{
    $IdValledupar=5;
date_default_timezone_set("America/Bogota");
$DiaActual = date('Y-m-d H:i:s');

// Consulta Cantidad utilizada por Código  
$sql ="SELECT Cant_Solicitada from t_insumos_ref where Cod_Insumo='".$CadenaInsumos[$x]."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$CantInsumo=$row['Cant_Solicitada'];
 }
}
$TotalInsumoDescontado=round($CantInsumo,1)*$CantidadSolicitada; // Valor total a descontar
$TotalInsumoDescontadoNegativo=round($TotalInsumoDescontado*-1,1); // Valor total a descontar en caso que no esté el insumo en inventario.

// Consulta Saber si el código está en el inventario 
$sql ="SELECT Cod_Insumo_Cod FROM t_inventario_telas WHERE Cod_Insumo_Cod='".$CadenaInsumos[$x]."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$VerificarInsumo=$row['Cod_Insumo_Cod']; 
 }
}

// Consulta Saber si el código está en el inventario 
$sql ="SELECT Id_Insumo,Unidad_Insumo FROM t_insumos WHERE Cod_Insumo='".$CadenaInsumos[$x]."' and Subcategoria_Id_Subcategoria_Insumo<>'0'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$TxtIdInsumo=$row['Id_Insumo'];
$Qr_Unidad_Insumo=$row['Unidad_Insumo']; 
 }
}


    if ($VerificarInsumo!="") {
        $SqlActualizar ="UPDATE t_inventario_telas SET Cantidad_Inv=Cantidad_Inv-'".round($TotalInsumoDescontado,1)."' WHERE Cod_Insumo_Cod='".$CadenaInsumos[$x]."'"; //ACTUALIZAMOS EL INVENTARIO
        $ResultActualizar = $conexion->query($SqlActualizar)or die (mysqli_error($conexion));
        }
    else
    {
        $sql=("INSERT INTO t_inventario_telas(taller_id_taller, Insumo_Id_Insumo, Cod_Insumo_Cod, Cantidad_Inv, Medida_Inv, Fecha_Ingreso, Responsable_Id_Usuario) VALUES('".$IdValledupar."','".$TxtIdInsumo."','".$CadenaInsumos[$x]."','".$TotalInsumoDescontadoNegativo."','".$Qr_Unidad_Insumo."','".$DiaActual."','".$IdUser."');");
            //Echo($sql);
            $result = $conexion->query($sql);

    }

}

}


//*******************************************************************************************************************
//*********************************** Función Sumar Inventario Telas Orden C.************************************
//*******************************************************************************************************************

function BucleSumaInsumos($RefCompleta,$CantidadSolicitada)
{
    include("conexion.php");

   // Bucle para conocer los codigos que se requieren para el producto 
$sql ="SELECT Cod_Insumo FROM t_insumos_ref WHERE Referencia_Cod_Referencia='".$RefCompleta."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$ListaInsumos3=$ListaInsumos3.$row['Cod_Insumo'].",";                  
 }
}
$CadenaInsumos3=explode(",", $ListaInsumos3);
//Split al Arreglo
$longitud3 = count($CadenaInsumos3);
$min3=$longitud3-1;
//Recorro todos los elementos

for($s=0; $s<$min3; $s++)
{
$IdValledupar=5;
date_default_timezone_set("America/Bogota");
$DiaActual = date('Y-m-d H:i:s');

// Consulta Cantidad utilizada por Código  
$sql ="SELECT Cant_Solicitada from t_insumos_ref where Cod_Insumo='".$CadenaInsumos3[$s]."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$CantInsumo=$row['Cant_Solicitada'];
 }
}

// Consulta Saber si el código está en el inventario 
$sql ="SELECT Cod_Insumo_Cod FROM t_inventario_telas WHERE Cod_Insumo_Cod='".$CadenaInsumos3[$s]."'";   
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$VerificarInsumo=$row['Cod_Insumo_Cod']; 
 }
}


$TotalInsumoSumado=round($CantInsumo,1)*$CantidadSolicitada; // Valor total a descontar

  if ($VerificarInsumo!="") {
    $SqlActualizar ="UPDATE t_inventario_telas SET Cantidad_Inv=Cantidad_Inv+'".round($TotalInsumoSumado,1)."' WHERE Cod_Insumo_Cod='".$CadenaInsumos3[$s]."'"; //ACTUALIZAMOS EL INVENTARIO
        $ResultActualizar = $conexion->query($SqlActualizar)or die (mysqli_error($conexion)); 
    Echo($SqlActualizar);
    }

}

}




 ?>















