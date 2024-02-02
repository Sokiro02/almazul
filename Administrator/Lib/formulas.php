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

function FormatoMascaraDecimal($valor)
{
$V1=str_replace(".","",$valor);
$V2=str_replace(",",".",$valor);
$V3=str_replace(" ", "", $V2);
$valor_final=str_replace("$", "", $V3);
//$valornumero=(int) $valor_final;
$valordecimal= number_format($valor_final,2);
return $valordecimal;

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
        $NomMes="Enero";
        break;
    case 2:
       $NomMes="Febrero";
        break;
    case 3:
        $NomMes="Marzo";
        break;
     case 4:
        $NomMes="Abril";
        break;
    case 5:
        $NomMes="Mayo";
        break;
    case 6:
        $NomMes="Junio";
        break;
    case 7:
        $NomMes="Julio";
        break;
    case 8:
        $NomMes="Agosto";
        break;
    case 9:
        $NomMes="Septiembre";
        break;
     case 10:
        $NomMes="Octubre";
        break;
     case 11:
        $NomMes="Noviembre";
        break;
     case 12:
        $NomMes="Diciembre";
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
    mysqli_free_result($result);
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
    mysqli_free_result($result);
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
    mysqli_free_result($result);
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
    mysqli_free_result($result);
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
    mysqli_free_result($result);
}
   // 2. Ingreso por Transferencias entre Talleres

    $sql="SELECT IFNULL(sum(Cant_Mov),0) as IngresoTransTaller From t_mov_insumos where  Bodega_Id_Bodega_Recibe='".$Bodega."' and Insumo_Cod_Insumo='".$CodInsumo."' and Tipo_Mov_Insumo='Ingreso por Transferencia';";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $IngresoTransTaller=$row['IngresoTransTaller'];
    }
    mysqli_free_result($result);
}

 // 1. Ingreso por Compras realizadas
$sql="SELECT IFNULL(sum(Cant_Mov),0) as IngresoInicial From t_mov_insumos where  Bodega_Id_Bodega_Recibe='".$Bodega."' and Insumo_Cod_Insumo='".$CodInsumo."' and Tipo_Mov_Insumo='Ingreso Inicial.';";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $IngresoInicial=$row['IngresoInicial'];
    }
    mysqli_free_result($result);
}

///////////////////  Egresos de Insumos a Taller ////////////////////

    // 1. Egreso por Transferencia realizada entre talleres

$sql="SELECT IFNULL(sum(Cant_Mov),0) as EgresoTransTaller From t_mov_insumos where  Bodega_Id_Bodega_Retira='".$Bodega."' and Insumo_Cod_Insumo='".$CodInsumo."' and Tipo_Mov_Insumo='Retiro Transferencia';";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $EgresoTransTaller=$row['EgresoTransTaller'];
    }
    mysqli_free_result($result);
}

    // 2. Egreso por Producción

$sql="SELECT IFNULL(sum(Cant_Mov),0) as EgresoProd From t_mov_insumos where  Bodega_Id_Bodega_Retira='".$Bodega."' and Insumo_Cod_Insumo='".$CodInsumo."' and Tipo_Mov_Insumo='Retiro Prod.';";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $EgresoProd=$row['EgresoProd'];
    }
    mysqli_free_result($result);
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
    mysqli_free_result($result);
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
    mysqli_free_result($result);
}

    // 2. Egreso por Producción

$sql="SELECT IFNULL(sum(Cant_Mov),0) as EgresoProd From t_mov_insumos where  Insumo_Cod_Insumo='".$CodInsumo."' and Tipo_Mov_Insumo='Retiro Prod.';";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $EgresoProd=$row['EgresoProd'];
    }
    mysqli_free_result($result);
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
    mysqli_free_result($result);
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
    mysqli_free_result($result);
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
    mysqli_free_result($result);
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
    mysqli_free_result($result);
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
    mysqli_free_result($result);
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
    mysqli_free_result($result);
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
        mysqli_free_result($result);
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
        mysqli_free_result($result);
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
        mysqli_free_result($result);
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
        mysqli_free_result($result);
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
 mysqli_free_result($result);
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
        mysqli_free_result($result);
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
        mysqli_free_result($result);
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
        mysqli_free_result($result);
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
        mysqli_free_result($result);
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
        mysqli_free_result($result);
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
        mysqli_free_result($result);
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
        mysqli_free_result($result);
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
        mysqli_free_result($result);
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
        mysqli_free_result($result);
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
  mysqli_free_result($result);
}

  $sql="SELECT  SUM(Cantidad_Inv) as IngresoDespacho FROM t_inventario_ref as A WHERE Inv_Ref='".$Referencia."'  and  Tienda_Id_Tienda='".$Tienda."' and Talla_Id_Talla='".$Talla."' and Tipo_Mov_Inv='DESPACHO' GROUP BY Talla_Id_Talla";
  //Echo($sql);
  $result=$conexion->query($sql);
  if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc ()) {

      $IngresoDespacho=$row['IngresoDespacho'];
  }
  mysqli_free_result($result);
}

 $sql="SELECT  SUM(Cantidad_Inv) as IngresoProd FROM t_inventario_ref WHERE Inv_Ref='".$Referencia."'  and Tienda_Id_Tienda='".$Tienda."' and Talla_Id_Talla='".$Talla."' and Tipo_Mov_Inv='Ingreso de Prod' and Solicitud_Prod<>'0' GROUP BY Talla_Id_Talla";
//Echo($sql);
  $result=$conexion->query($sql);
  if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc ()) {

      $IngresoProd=$row['IngresoProd'];
  }
  mysqli_free_result($result);
}

$sql="SELECT  SUM(Cantidad_Inv) as SalidaVenta FROM t_inventario_ref WHERE Inv_Ref='".$Referencia."'  and Tienda_Id_Tienda='".$Tienda."' and Talla_Id_Talla='".$Talla."' and Tipo_Mov_Inv='Salida Venta' GROUP BY Talla_Id_Talla";
//Echo($sql);
  $result=$conexion->query($sql);
  if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc ()) {

      $SalidaVenta=$row['SalidaVenta'];
  }
  mysqli_free_result($result);
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
  mysqli_free_result($result);
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
  mysqli_free_result($result);
}

 $sql="SELECT  SUM(Cantidad_Inv) as IngresoProd FROM t_inventario_ref WHERE Inv_Ref='".$Referencia."'  and Tienda_Id_Tienda='".$Tienda."' and Tipo_Mov_Inv='Ingreso de Prod' and Solicitud_Prod<>'0' ";
//Echo($sql);
  $result=$conexion->query($sql);
  if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc ()) {

      $IngresoProd=$row['IngresoProd'];
  }
  mysqli_free_result($result);
}

$sql="SELECT  SUM(Cantidad_Inv) as SalidaVenta FROM t_inventario_ref WHERE Inv_Ref='".$Referencia."'  and Tienda_Id_Tienda='".$Tienda."' and Tipo_Mov_Inv='Salida Venta'";
//Echo($sql);
  $result=$conexion->query($sql);
  if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc ()) {

      $SalidaVenta=$row['SalidaVenta'];
  }
  mysqli_free_result($result);
}

$sql="SELECT  SUM(Cantidad_Inv) as SalidaRemision FROM t_inventario_ref WHERE Ref_Completa='".$Referencia."'  and Tienda_Id_Tienda='".$Tienda."' and Tipo_Mov_Inv='Salida Remision'";
//Echo($sql);
  $result=$conexion->query($sql);
  if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc ()) {

      $SalidaRemision=$row['SalidaRemision'];
  }
  mysqli_free_result($result);
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
  mysqli_free_result($result);
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
  mysqli_free_result($result);
}

 $sql="SELECT  SUM(Cantidad_Inv) as IngresoDespachos FROM t_inventario_ref  WHERE Ref_Completa='".$RefCompleta."'  and  Tienda_Id_Tienda='".$Tienda."' and Tipo_Mov_Inv='DESPACHO' ";
  $result=$conexion->query($sql);
  if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc ()) {

      $IngresoDespachos=$row['IngresoDespachos'];
  }
  mysqli_free_result($result);
}


$sql="SELECT  SUM(Cantidad_Inv) as SalidaVenta FROM t_inventario_ref WHERE Ref_Completa='".$RefCompleta."'  and Tienda_Id_Tienda='".$Tienda."' and Tipo_Mov_Inv='Salida Venta'";
//Echo($sql);
  $result=$conexion->query($sql);
  if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc ()) {

      $SalidaVenta=$row['SalidaVenta'];
  }
  mysqli_free_result($result);
}


$sql="SELECT  SUM(Cantidad_Inv) as SalidaRemision FROM t_inventario_ref WHERE Ref_Completa='".$RefCompleta."'  and Tienda_Id_Tienda='".$Tienda."' and Tipo_Mov_Inv='Salida Remision'";
//Echo($sql);
  $result=$conexion->query($sql);
  if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc ()) {

      $SalidaRemision=$row['SalidaRemision'];
  }
  mysqli_free_result($result);
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
  mysqli_free_result($result);
}



    return $TotalRef;
}


//*******************************************************************************************************************
//*********************************** Función Descontar Inventario Telas Orden C.************************************
//*******************************************************************************************************************

function BucleDescuentoInsumos($RefCompleta,$CantidadSolicitada,$taller)
{
    include("conexion.php");

   // Bucle para conocer los codigos que se requieren para el producto 
$sql ="SELECT Cod_Insumo FROM t_insumos_ref WHERE Referencia_Cod_Referencia='".$RefCompleta."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$ListaInsumos=$ListaInsumos.$row['Cod_Insumo'].",";                  
 }
 mysqli_free_result($result);
}
$CadenaInsumos=explode(",", $ListaInsumos);
//Split al Arreglo
$longitud2 = count($CadenaInsumos);
$min2=$longitud2-1;
//Recorro todos los elementos

for($x=0; $x<$min2; $x++)
{
    $IdTaller=$taller;
date_default_timezone_set("America/Bogota");
$DiaActual = date('Y-m-d H:i:s');

// Consulta Cantidad utilizada por Código  
$sql ="SELECT Cant_Solicitada from t_insumos_ref where Cod_Insumo='".$CadenaInsumos[$x]."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$CantInsumo=$row['Cant_Solicitada'];
 }
 mysqli_free_result($result);
}
$TotalInsumoDescontado=round($CantInsumo,1)*$CantidadSolicitada; // Valor total a descontar
$TotalInsumoDescontadoNegativo=round($TotalInsumoDescontado*-1,1); // Valor total a descontar en caso que no esté el insumo en inventario.

// Consulta Saber si el código está en el inventario 
$sql ="SELECT Cod_Insumo_Cod FROM t_inventario_telas WHERE Cod_Insumo_Cod='".$CadenaInsumos[$x]."' and taller_id_taller='".$taller."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$VerificarInsumo=$row['Cod_Insumo_Cod']; 
 }
 mysqli_free_result($result);
}

// Consulta Saber si el código está en el inventario 
$sql ="SELECT Id_Insumo,Unidad_Insumo FROM t_insumos WHERE Cod_Insumo='".$CadenaInsumos[$x]."' and Subcategoria_Id_Subcategoria_Insumo<>'0'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$TxtIdInsumo=$row['Id_Insumo'];
$Qr_Unidad_Insumo=$row['Unidad_Insumo']; 
 }
 mysqli_free_result($result);
}


    if ($VerificarInsumo!="") {
        $SqlActualizar ="UPDATE t_inventario_telas SET Cantidad_Inv=Cantidad_Inv-'".round($TotalInsumoDescontado,1)."' WHERE Cod_Insumo_Cod='".$CadenaInsumos[$x]."' and taller_id_taller='".$IdTaller."'"; //ACTUALIZAMOS EL INVENTARIO
        $ResultActualizar = $conexion->query($SqlActualizar)or die (mysqli_error($conexion));
        }
    else
    {
        $sql=("INSERT INTO t_inventario_telas(taller_id_taller, Insumo_Id_Insumo, Cod_Insumo_Cod, Cantidad_Inv, Medida_Inv, Fecha_Ingreso, Responsable_Id_Usuario) VALUES('".$IdTaller."','".$TxtIdInsumo."','".$CadenaInsumos[$x]."','".round($TotalInsumoDescontadoNegativo,1)."','".$Qr_Unidad_Insumo."','".$DiaActual."','".$IdUser."');");
            //Echo($sql);
            $result = $conexion->query($sql);

    }

}

}


//*******************************************************************************************************************
//*********************************** Función Sumar Inventario Telas Orden C.************************************
//*******************************************************************************************************************

function BucleSumaInsumos($RefCompleta,$CantidadSolicitada,$taller)
{
    include("conexion.php");

   // Bucle para conocer los codigos que se requieren para el producto 
$sql ="SELECT Cod_Insumo FROM t_insumos_ref WHERE Referencia_Cod_Referencia='".$RefCompleta."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$ListaInsumos3=$ListaInsumos3.$row['Cod_Insumo'].",";                  
 }
 mysqli_free_result($result);
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
 mysqli_free_result($result);
}

// Consulta Id Insumo utilizada por Código  
$sql ="SELECT Id_Insumo,Unidad_Insumo from t_insumos where Cod_Insumo='".$CadenaInsumos3[$s]."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$DelId_Insumo=$row['Id_Insumo'];
$DelUnidadInsumo=$row['Unidad_Insumo'];
 }
 mysqli_free_result($result);
}

// Consulta Saber si el código está en el inventario 
$sql ="SELECT Cod_Insumo_Cod FROM t_inventario_telas WHERE Cod_Insumo_Cod='".$CadenaInsumos3[$s]."' and taller_id_taller='".$taller."'";   
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$VerificarInsumo=$row['Cod_Insumo_Cod']; 
 }
 mysqli_free_result($result);
}


$TotalInsumoSumado=$CantInsumo*$CantidadSolicitada; // Valor total a descontar

  if ($VerificarInsumo!="") {
    $SqlActualizar ="UPDATE t_inventario_telas SET Cantidad_Inv=Cantidad_Inv+'".round($TotalInsumoSumado,1)."' WHERE Cod_Insumo_Cod='".$CadenaInsumos3[$s]."' and taller_id_taller='".$taller."'"; //ACTUALIZAMOS EL INVENTARIO
        $ResultActualizar = $conexion->query($SqlActualizar)or die (mysqli_error($conexion)); 
    //Echo($SqlActualizar);
    }
    else{
         $SqlActualizar ="INSERT INTO t_inventario_telas (taller_id_taller, Insumo_Id_Insumo, Cod_Insumo_Cod, Cantidad_Inv, Medida_Inv, Fecha_Ingreso, Responsable_Id_Usuario) VALUES ('".$taller."','".$DelId_Insumo."','".$CadenaInsumos3[$s]."','".round($TotalInsumoSumado,1)."','".$DelUnidadInsumo."','".$DiaActual."','".$IdUser."')"; 
         //INGRESA AL INVENTARIO LA CANTIDAD DEVUELTA
    }

}

}

function ObtenernombreUsuario($id)
{
    include("conexion.php");

   // VALIDAMOS EL NOMBRE DEL VENDEDOR
$sql ="SELECT Nombres,Apellidos FROM t_usuarios WHERE Id_usuario='".$id."'";
    //Echo($sql);
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
     $Nombres=$row['Nombres'];
     $Apellidos=$row['Apellidos']; 
     $NombreUsuario=$Nombres." ".$Apellidos;              
 }
 mysqli_free_result($result);
}

    return $NombreUsuario;
}

function ObtenersolonombreUsuario($id)
{
    include("conexion.php");

   // VALIDAMOS EL NOMBRE DEL VENDEDOR
$sql ="SELECT Nombres,Apellidos FROM t_usuarios WHERE Id_usuario='".$id."'";
    //Echo($sql);
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
     $Nombres=$row['Nombres'];
     $Apellidos=$row['Apellidos']; 
     $NombreUsuario=$Nombres;              
 }
 mysqli_free_result($result);
}

    return $NombreUsuario;
}



function ObtenerfotoUsuario($id)
{
    include("conexion.php");

   // VALIDAMOS EL NOMBRE DEL VENDEDOR
$sql ="SELECT Img_Perfil FROM t_usuarios WHERE Id_usuario='".$id."'";
    //Echo($sql);
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
     $FotoUser=$row['Img_Perfil'];        
 }
 mysqli_free_result($result);
}

    return $FotoUser;
}



function ObtenernombreCliente($id)
{
    include("conexion.php");

   // VALIDAMOS EL NOMBRE DEL VENDEDOR
$sql ="SELECT Nom_cliente,Ape_Cliente FROM t_clientes WHERE Id_cliente='".$id."'";
    //Echo($sql);
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
     $Nom_cliente=$row['Nom_cliente'];
     $Ape_Cliente=$row['Ape_Cliente']; 
     $NombreCliente=$Nom_cliente." ".$Ape_Cliente;              
 }
 mysqli_free_result($result);
}

    return $NombreCliente;
}

function ObtenerdocumentoCliente($id)
{
    include("conexion.php");

   // VALIDAMOS EL NOMBRE DEL VENDEDOR
$sql ="SELECT Documento_Cliente FROM t_clientes WHERE Id_cliente='".$id."'";
    //Echo($sql);
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
     $Documento_Cliente=$row['Documento_Cliente'];           
 }
 mysqli_free_result($result);
}

    return $Documento_Cliente;
}

function ObtenernombreTienda($id)
{
    include("conexion.php");

   // CONFIRMACIÓN DE QUE  TIENDA
$sql ="SELECT * FROM t_tiendas WHERE Id_tienda='".$id."'";
        //Echo($sql);
        $result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {  
       $Nombre_Tienda=$row['Nom_Tienda'];
    }
    mysqli_free_result($result);
}

    return $Nombre_Tienda;
}


function ObtenerComentarioRemision($id)
{
    include("conexion.php");
   // CONFIRMACIÓN DE QUE  TIENDA
$sql ="SELECT Observa_Remision FROM t_remisiones WHERE Num_Remision='".$id."'";
        //Echo($sql);
        $result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {  
       $Observa_Remision=$row['Observa_Remision'];
    }
    mysqli_free_result($result);
}

    return $Observa_Remision;
}


function ObtenernombreEstadoPedido($id)
{
    include("conexion.php");

   // CONFIRMACIÓN DE QUE  TIENDA
$sql ="SELECT * FROM t_estado_pedidos WHERE Id_Estado_Pedido='".$id."'";
        //Echo($sql);
        $result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {  
       $Nom_Estado_Pedido=$row['Nom_Estado_Pedido'];
    }
    mysqli_free_result($result);
}

    return $Nom_Estado_Pedido;
}

function ObtenercolorEstadoPedido($id)
{
    include("conexion.php");

   // CONFIRMACIÓN DE QUE  TIENDA
$sql ="SELECT * FROM t_estado_pedidos WHERE Id_Estado_Pedido='".$id."'";
        //Echo($sql);
        $result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {  
       $Color_Estado=$row['Color_Estado'];
    }
    mysqli_free_result($result);
}

    return $Color_Estado;
}


function ObtenernombreTalla($id)
{
    include("conexion.php");

   // CONFIRMACIÓN DE QUE  TIENDA
$sql ="SELECT * FROM t_tallas WHERE Id_talla='".$id."'";
        //Echo($sql);
        $result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {  
       $Nom_Talla=$row['Nom_Talla'];
    }
    mysqli_free_result($result);
}

    return $Nom_Talla;
}


function ObtenerimagenRef($id)
{
    include("conexion.php");

   // CONFIRMACIÓN DE QUE  TIENDA
$sql ="SELECT Img_Referencia FROM t_referencias WHERE Cod_Referencia='".$id."'";
        //Echo($sql);
        $result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {  
       $Img_Referencia=$row['Img_Referencia'];
    }
    mysqli_free_result($result);
}

    return $Img_Referencia;
}

function ObtenertipotelaRef($id)
{
    include("conexion.php");

   // CONFIRMACIÓN DE QUE  TIENDA
$sql ="SELECT Tipo_Tela FROM t_referencias WHERE Cod_Referencia='".$id."'";
        //Echo($sql);
        $result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {  
       $campo=$row['Tipo_Tela'];
    }
    mysqli_free_result($result);
}

    return $campo;
}


function ObtenerCodRef($id)
{
    include("conexion.php");

   // CONFIRMACIÓN DE QUE  TIENDA
$sql ="SELECT Cod_Referencia FROM t_referencias WHERE Id_Referencia='".$id."'";
        //Echo($sql);
        $result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {  
       $Cod_Referencia=$row['Cod_Referencia'];
    }
    mysqli_free_result($result);
}

    return $Cod_Referencia;
}


function ObtenerDetalleRef($id)
{
    include("conexion.php");

   // CONFIRMACIÓN DE QUE  TIENDA
$sql ="SELECT Detalle_Referencia FROM t_referencias WHERE Cod_Referencia='".$id."'";
        //Echo($sql);
        $result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {  
       $Detalle_Referencia=$row['Detalle_Referencia'];
    }
    mysqli_free_result($result);
}

    return $Detalle_Referencia;
}


function InsumoPpalRef($id)
{
    include("conexion.php");

   // CONFIRMACIÓN DE QUE  TIENDA
$sql ="SELECT Insumo_Ppal FROM t_referencias WHERE Cod_Referencia='".$id."'";
        //Echo($sql);
        $result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {  
       $Insumo_Ppal=$row['Insumo_Ppal'];
    }
    mysqli_free_result($result);
}
    return $Insumo_Ppal;
}

function ColorPpalRef($id)
{
    include("conexion.php");

   // CONFIRMACIÓN DE QUE  TIENDA
$sql ="SELECT B.Nom_Color FROM t_insumos AS A, t_colores AS B WHERE Cod_Insumo='".$id."' AND A.Color_Ppal=B.Id_Color";
        //Echo($sql);
        $result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {  
       $Nom_Color=$row['Nom_Color'];
    }
    mysqli_free_result($result);
}
    return $Nom_Color;
}



function ObtenerColorRef($id)
{
    include("conexion.php");

   // CONFIRMACIÓN DE QUE  TIENDA
$sql ="SELECT Detalle_Referencia FROM t_referencias WHERE Cod_Referencia='".$id."'";
        //Echo($sql);
        $result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {  
       $Detalle_Referencia=$row['Detalle_Referencia'];
    }
    mysqli_free_result($result);
}

    return $Detalle_Referencia;
}

function ObtenerfechaFactura($id)
{
    include("conexion.php");

   // CONFIRMACIÓN DE QUE  TIENDA
$sql ="SELECT Fecha_Factura FROM t_facturas WHERE Num_Factura='".$id."'";
        //Echo($sql);
        $result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {  
       $Fecha_Factura=$row['Fecha_Factura'];
    }
    mysqli_free_result($result);
}
    return $Fecha_Factura;
}

function ObtenerfechaSalidaContable($id,$tienda)
{
    include("conexion.php");

   // CONFIRMACIÓN DE QUE  TIENDA
$sql ="SELECT Fecha_Factura FROM t_facturas WHERE num_consecutivo_sc='".$id."' and tienda_id_tienda='".$tienda."'";
        //Echo($sql);
        $result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {  
       $Fecha_Factura=$row['Fecha_Factura'];
    }
    mysqli_free_result($result);
}
    return $Fecha_Factura;
}

function Obtenersubrubro($id)
{
    include("conexion.php");

   // CONFIRMACIÓN DE QUE  TIENDA
$sql ="SELECT Nom_Subrubro FROM t_subrubros WHERE Id_subrubro='".$id."'";
        //Echo($sql);
        $result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {  
       $Nom_Subrubro=$row['Nom_Subrubro'];
    }
    mysqli_free_result($result);
}
    return $Nom_Subrubro;
}

function totalfrecuencia($tienda,$fechainicio,$fechafinal)
{
  include("conexion.php");
$sql="SELECT IFNULL(sum(valor),0) as total From t_frecuencia_clientes where tienda_id_tienda='".$tienda."' and fecha_registro >='".$fechainicio."' and fecha_registro <='".$fechafinal."'";
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $total=$row['total'];
    }
    mysqli_free_result($result);
}

return $total;   
}


function ObtenercantidadProduccion($ref,$talla,$fechainicio,$fechafinal)
{
  include("conexion.php");
$sql="SELECT IFNULL(sum(Cant_Solicitada),0) as total From t_temporal_sol where Estado_Solicitud_Cliente='1' and Talla_Solicitada='".$talla."' and Referencia_Id_Referencia='".$ref."' and Fecha_Solicitud >='".$fechainicio."' and Fecha_Solicitud <='".$fechafinal."'";
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $total=$row['total'];
    }
    mysqli_free_result($result);
}

return $total;   
}


function SumatotalPrendas($ref,$fechainicio,$fechafinal)
{
  include("conexion.php");
$sql="SELECT IFNULL(sum(Cant_Solicitada),0) as total from t_temporal_sol where Estado_Solicitud_Cliente='1' and  Referencia_Id_Referencia='".$ref."' and Fecha_Solicitud >='".$fechainicio."' and Fecha_Solicitud <='".$fechafinal."'";
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $total=$row['total'];
    }
    mysqli_free_result($result);
}

return $total;   
}


function totalleads($fechainicio,$fechafinal)
{
  include("conexion.php");
$sql="SELECT  IFNULL(sum(valor),0) as total From t_frecuencia_clientes where fecha_registro >='".$fechainicio."' and fecha_registro <='".$fechafinal."'";
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $total=$row['total'];
    }
    mysqli_free_result($result);
}

if ($total==0) {
   return ("<td class='center danger' style='color:#c00000;'>".$total."</td>");   
}
else
{
    return ("<td class='center success' style='color:green;'>".$total."</td>");  
}

}

function totalleadstienda($fechainicio,$fechafinal,$tienda)
{
  include("conexion.php");
$sql="SELECT  IFNULL(sum(valor),0) as total From t_frecuencia_clientes where fecha_registro >='".$fechainicio."' and fecha_registro <='".$fechafinal."' and tienda_id_tienda='".$tienda."'";
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $total=$row['total'];
    }
    mysqli_free_result($result);
}

if ($total==0) {
   return ("<td class='center danger' style='color:#c00000;'>".$total."</td>");   
}
else
{
    return ("<td class='center success' style='color:green;'>".$total."</td>");  
}

}


function numeroleads($fechainicio,$fechafinal)
{
  include("conexion.php");
$sql="SELECT  IFNULL(sum(valor),0) as total From t_frecuencia_clientes where fecha_registro >='".$fechainicio."' and fecha_registro <='".$fechafinal."'";
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $total=$row['total'];
    }
    mysqli_free_result($result);
}


    return $total;  

}

function numeroleadstienda($fechainicio,$fechafinal,$tienda)
{
  include("conexion.php");
$sql="SELECT  IFNULL(sum(valor),0) as total From t_frecuencia_clientes where fecha_registro >='".$fechainicio."' and fecha_registro <='".$fechafinal."' and tienda_id_tienda='".$tienda."'";
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $total=$row['total'];
    }
    mysqli_free_result($result);
}


    return $total;  

}

function numeroleadsMes($mes)
{
  include("conexion.php");
  $anoactual = date('Y');
$sql="SELECT IFNULL(SUM(valor),0) as total FROM `t_frecuencia_clientes` WHERE MONTH(fecha_registro)='".$mes."' and YEAR(fecha_registro)='".$anoactual."'";
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $total=$row['total'];
    }
    mysqli_free_result($result);
}
    return $total;  
}

function numeroleadsMestienda($mes,$tienda)
{
  include("conexion.php");
  $anoactual = date('Y');
$sql="SELECT IFNULL(SUM(valor),0) as total FROM `t_frecuencia_clientes` WHERE MONTH(fecha_registro)='".$mes."' and Tienda_Id_Tienda='".$tienda."' and YEAR(fecha_registro)='".$anoactual."'";
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $total=$row['total'];
    }
    mysqli_free_result($result);
}
    return $total;  
}


function numeroclientesMes($mes)
{
  include("conexion.php");
  $anoactual = date('Y');
$sql="SELECT COUNT(DISTINCT cliente_id_cliente) as total FROM `t_facturas` WHERE MONTH(Fecha_Factura)='".$mes."' and YEAR(Fecha_Factura)='".$anoactual."'";

$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $total=$row['total'];
    }
    mysqli_free_result($result);
}
    return $total;  
}

function numeroclientesMestienda($mes,$tienda)
{
  include("conexion.php");
   $anoactual = date('Y');
$sql="SELECT COUNT(DISTINCT cliente_id_cliente) as total FROM `t_facturas` WHERE MONTH(Fecha_Factura)='".$mes."' and tienda_id_tienda='".$tienda."' and YEAR(Fecha_Factura)='".$anoactual."'";
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $total=$row['total'];
    }
    mysqli_free_result($result);
}
    return $total;  
}


function arreglofrecuencia($mes)
{
  include("conexion.php");
  $anoactual = date('Y');

$sql="SELECT COUNT( cliente_id_cliente) as total FROM `t_facturas` WHERE MONTH(Fecha_Factura)='".$mes."' and YEAR(Fecha_Factura)='".$anoactual."' GROUP by Cliente_Id_Cliente";
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $total=$total.$row['total'].",";
    }
    mysqli_free_result($result);
}
    return $total;  
}


function arreglofrecuenciatienda($mes,$tienda)
{
  include("conexion.php");
  $anoactual = date('Y');
$sql="SELECT COUNT( cliente_id_cliente) as total FROM `t_facturas` WHERE MONTH(Fecha_Factura)='".$mes."' and tienda_id_tienda='".$tienda."' and YEAR(Fecha_Factura)='".$anoactual."' GROUP by Cliente_Id_Cliente";
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $total=$total.$row['total'].",";
    }
    mysqli_free_result($result);
}
    return $total;  
}


function promediocompra($mes)
{
  include("conexion.php");
  $anoactual = date('Y');
$sql="SELECT AVG(Subtotal_Factura) as total FROM `t_facturas` WHERE MONTH(Fecha_Factura)='".$mes."' and YEAR(Fecha_Factura)='".$anoactual."'";
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $total=$row['total'];
    }
    mysqli_free_result($result);
}
    return $total;  
}

function promediocompratienda($mes,$tienda)
{
  include("conexion.php");
  $anoactual = date('Y');
$sql="SELECT AVG(Subtotal_Factura) as total FROM `t_facturas` WHERE MONTH(Fecha_Factura)='".$mes."' and Tienda_Id_Tienda='".$tienda."' and YEAR(Fecha_Factura)='".$anoactual."'";
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $total=$row['total'];
    }
    mysqli_free_result($result);
}
    return $total;  
}


function totalventames($mes)
{
  include("conexion.php");
  $anoactual = date('Y');
$sql="SELECT IFNULL(SUM(Subtotal_Factura),0) as total FROM `t_facturas` WHERE MONTH(Fecha_Factura)='".$mes."' and YEAR(Fecha_Factura)='".$anoactual."'";
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $total=$row['total'];
    }
    mysqli_free_result($result);
}
    return $total;  
}

function totalventamestienda($mes,$tienda)
{
  include("conexion.php");
  $anoactual = date('Y');
$sql="SELECT IFNULL(SUM(Subtotal_Factura),0) as total FROM `t_facturas` WHERE MONTH(Fecha_Factura)='".$mes."' and tienda_id_tienda='".$tienda."' and YEAR(Fecha_Factura)='".$anoactual."'";
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $total=$row['total'];
    }
    mysqli_free_result($result);
}
    return $total;  
}


function totalcostosmes($mes)
{
  include("conexion.php");
  $anoactual = date('Y');
$sql="SELECT IFNULL(SUM(A.Costo_Insumo_Ref*A.Cant_Solicitada),0) AS total FROM t_insumos_ref as A, t_ventas as B WHERE A.Referencia_Cod_Referencia=B.Referencia_Id_Referencia and MONTH(B.Fecha_Solicitud)='".$mes."' and YEAR(B.Fecha_Solicitud)='".$anoactual."'";
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $total=$row['total'];
    }
    mysqli_free_result($result);
}
    return $total;  
}

function totalcostosReferencia($referencia)
{
  include("conexion.php");
  $anoactual = date('Y');
$sql="SELECT IFNULL(SUM(A.Costo_Insumo_Ref*A.Cant_Solicitada),0) AS total FROM t_insumos_ref as A WHERE Referencia_Cod_Referencia='".$referencia."'";
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $total=$row['total'];
    }
    mysqli_free_result($result);
}
    return $total;  
}


function totalcostosmestienda($mes,$tienda)
{
  include("conexion.php");
   $anoactual = date('Y');
$sql="SELECT IFNULL(SUM(A.Costo_Insumo_Ref*A.Cant_Solicitada),0) AS total FROM t_insumos_ref as A, t_ventas as B WHERE A.Referencia_Cod_Referencia=B.Referencia_Id_Referencia and MONTH(B.Fecha_Solicitud)='".$mes."' and YEAR(B.Fecha_Solicitud)='".$anoactual."' and B.tienda_id_tienda='".$tienda."'";
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $total=$row['total'];
    }
    mysqli_free_result($result);
}
    return $total;  
}



function totalmanobrames($mes)
{
  include("conexion.php");
  $anoactual = date('Y');
$sql="SELECT IFNULL(SUM(A.V_Mano_Obra_Ref),0) as total  FROM t_referencias as A, t_ventas AS B WHERE A.Cod_Referencia=B.Referencia_Id_Referencia AND MONTH(B.Fecha_Solicitud)='".$mes."' and YEAR(B.Fecha_Solicitud)='".$anoactual."'";
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $total=$row['total'];
    }
    mysqli_free_result($result);
}
    return $total;  
}


function totalmanobramestienda($mes,$tienda)
{
  include("conexion.php");
  $anoactual = date('Y');
$sql="SELECT IFNULL(SUM(A.V_Mano_Obra_Ref),0) as total  FROM t_referencias as A, t_ventas AS B WHERE A.Cod_Referencia=B.Referencia_Id_Referencia AND MONTH(B.Fecha_Solicitud)='".$mes."' and B.tienda_id_tienda='".$tienda."' and YEAR(B.Fecha_Solicitud)='".$anoactual."'";
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $total=$row['total'];
    }
    mysqli_free_result($result);
}
    return $total;  
}



function totalgastosmes($mes)
{
  include("conexion.php");
   $anoactual = date('Y');
$sql="SELECT IFNULL(SUM(Valor_gasto),0) as total FROM `t_gastos` WHERE MONTH(Fecha_gasto)='".$mes."' and area_id_area='2' and tipo_gasto='0' and YEAR(Fecha_gasto)='".$anoactual."'";
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $total=$row['total'];
    }
    mysqli_free_result($result);
}
    return $total;  
}

function totalgastosmestaller($mes)
{
  include("conexion.php");
   $anoactual = date('Y');
$sql="SELECT IFNULL(SUM(Valor_gasto),0) as total FROM `t_gastos` WHERE MONTH(Fecha_gasto)='".$mes."' and YEAR(Fecha_gasto)='".$anoactual."' and area_id_area<>'2' and tipo_gasto='0' ";
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $total=$row['total'];
    }
    mysqli_free_result($result);
}
    return $total;  
}

function totalgastosmesadmin($mes)
{
  include("conexion.php");
   $anoactual = date('Y');
$sql="SELECT IFNULL(SUM(Valor_gasto),0) as total FROM `t_gastos` WHERE MONTH(Fecha_gasto)='".$mes."' and YEAR(Fecha_gasto)='".$anoactual."' and tipo_gasto='1'";
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $total=$row['total'];
    }
    mysqli_free_result($result);
}
    return $total;  
}


function totalgastosmestienda($mes,$tienda)
{
  include("conexion.php");
   $anoactual = date('Y');
$sql="SELECT IFNULL(SUM(Valor_gasto),0) as total FROM `t_gastos` WHERE MONTH(Fecha_gasto)='".$mes."' and YEAR(Fecha_gasto)='".$anoactual."' and Tienda_Id_Tienda='".$tienda."'";
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $total=$row['total'];
    }
    mysqli_free_result($result);
}
    return $total;  
}


function DisponibilidadInventario($tienda,$referencia,$talla)
{
  include("conexion.php");
$sql="SELECT IFNULL(sum(cantidad),0) as total From t_inventario where Id_Tienda='".$tienda."' and Referencia='".$referencia."' and Id_talla='".$talla."'";
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $total=$row['total'];
    }
    mysqli_free_result($result);
}
return $total;   
}


function Nombremediopago($mediopago)
{
  include("conexion.php");
$sql ="SELECT * FROM  t_medios_pago WHERE Id_Medio_Pago='".$mediopago."'"; 
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
         $nombrepago=$row['Nom_MedioPago'];
    }
    mysqli_free_result($result);
}
return $nombrepago; 
}

function Cantidadprendas($pedido)
{
  include("conexion.php");
$sql ="SELECT IFNULL(SUM(Cant_Solicitada),0) AS total  FROM t_temporal_sol WHERE Pedido_Id_Pedido='".$pedido."'"; 
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
         $total=$row['total'];
    }
    mysqli_free_result($result);
}
return $total; 
}

function contarcategorias($categoria)
{
  include("conexion.php");
$sql ="SELECT COUNT(DISTINCT(Cod_Referencia)) AS total  FROM t_referencias WHERE Categoria_Id_Categoria_Prod='".$categoria."' and ref_activa='0'"; 
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
         $total=$row['total'];
    }
    mysqli_free_result($result);
}
return $total; 
}


function contarcategoriasinsumos($id,$tipo)
{
  include("conexion.php");
$sql ="SELECT COUNT(Categoria_Id_Categoria_Insumo) AS total  FROM t_insumos WHERE Categoria_Id_Categoria_Insumo='".$id."' and tipo_insumo='".$tipo."' and ref_activa='0';"; 
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
         $total=$row['total'];
    }
    mysqli_free_result($result);
}
return $total; 
}

function contarinsumoseliminados()
{
  include("conexion.php");
$sql ="SELECT COUNT(Categoria_Id_Categoria_Insumo) AS total  FROM t_insumos WHERE ref_activa='1';"; 
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
         $total=$row['total'];
    }
    mysqli_free_result($result);
}
return $total; 
}


function contarcategoriastotal($estado)
{
  include("conexion.php");
$sql ="SELECT COUNT(DISTINCT(Cod_Referencia)) AS total  FROM t_referencias WHERE ref_activa='".$estado."'"; 
$result = $conexion->query($sql);
//echo($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
         $total=$row['total'];
    }
    mysqli_free_result($result);
}
return $total; 
}


//SELECT IFNULL(SUM(A.V_Mano_Obra_Ref),0) as total  FROM t_referencias as A, t_ventas AS B WHERE A.Cod_Referencia=B.Referencia_Id_Referencia AND MONTH(B.Fecha_Solicitud)='04'

 ?>















