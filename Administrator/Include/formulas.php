<?php 

function SumaTotal($IdSocio,$TipoMovimiento,$EstadoMov)
{
	include("conexion.php");
$sql="SELECT IFNULL(SUM(valor_mov),0) as Sumatotal From Tmovimientos_socios where Socio_id_socio='".$IdSocio."' and Tipo_Movimiento='".$TipoMovimiento."' and Estado_mov_id_estado_mov='".$EstadoMov."'";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $ResultadoSuma=$row['Sumatotal'];
    }
}
return $ResultadoSuma;
}
//*******************************************************************************************************************
function SumaGeneral($TipoMovimiento,$EstadoMov)
{
include("conexion.php");
$sql="SELECT IFNULL(SUM(valor_mov),0) as Sumatotal From Tmovimientos_socios where  Tipo_Movimiento='".$TipoMovimiento."' and Estado_mov_id_estado_mov='".$EstadoMov."'";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $ResultadoSuma=$row['Sumatotal'];
    }
}
return $ResultadoSuma;
}

//*******************************************************************************************************************

function formatomoneda($valor)
{
   $VAR=number_format($valor, 0,'.', '.');
   echo("$ ".$VAR);
}
//*******************************************************************************************************************
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

function FormatoMascara($valor)
{

$V1=str_replace(".","",$valor);
$V2=str_replace(" ", "", $V1);
$valor_final=str_replace("$", "", $V2);
$valornumero=(int) $valor_final;
return $valornumero;
}
//*******************************************************************************************************************

function Patrimonio($Socio)
{
// &&&&&&&&&&&&&&&&&&&&&&&&&      Movimientos Socio      &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
	// Estados Movimientos
	$PendienteAprobado=1;
	$Disponible=2;
	$Aprobado=3;
	$Invertido=4;
		//Recursos Pendiente Aprobación
		$CapitalSinAprobar=SumaTotal($Socio,"Ingreso Socio",$PendienteAprobado);

		//Recursos Disponibles
		$CapitalActivo=SumaTotal($Socio,"Ingreso Socio",$Disponible);

		//Activos Corrientes-No Corrientes
		$CompraActivos=SumaTotal($Socio,"Retiro-Compra",$Invertido);

		//Utilidades
		$Utilidades=SumaTotal($Socio,"Ingreso-Venta",$Disponible);

		//Retiros
		$RetirosTotales=SumaTotal($Socio,"Retiro-Total",$Aprobado);

		//Retiros Parciales
		$RetirosParciales=SumaTotal($Socio,"Retiro-Parcial",$Aprobado);

		//Total Retiros
		$TotalRetiros=$RetirosTotales+$RetirosParciales;

		//Capital Disponible
		$CapitalDisponible=$CapitalActivo-$TotalRetiros-$CompraActivos;

		//Total Dinero Socio
		$TotalDineroSocio=$CapitalDisponible+$CompraActivos;

		return $TotalDineroSocio;
}
//*******************************************************************************************************************

function AccionesSocio($Socio)
{
	// Estados Movimientos
	$PendienteAprobado=1;
	$Disponible=2;
	$Aprobado=3;
	$Invertido=4;
	$Vacio="";

	$DineroSocio=Patrimonio($Socio);

		//Recursos Pendiente Aprobación
		$CapitalSinAprobar=SumaGeneral("Ingreso Socio",$PendienteAprobado);

		//Recursos Disponibles
		$CapitalActivo=SumaGeneral("Ingreso Socio",$Disponible);

		//Activos Corrientes-No Corrientes
		$CompraActivos=SumaGeneral("Retiro-Compra",$Invertido);

		//Utilidades
		$Utilidades=SumaGeneral("Ingreso-Venta",$Disponible);

		//Retiros
		$RetirosTotales=SumaGeneral("Retiro-Total",$Aprobado);

		//Retiros Parciales
		$RetirosParciales=SumaGeneral("Retiro-Parcial",$Aprobado);

		//Total Retiros
		$TotalRetiros=$RetirosTotales+$RetirosParciales;

		//Capital Disponible
		$CapitalDisponible=$CapitalActivo-$TotalRetiros-$CompraActivos;

		//Total Dinero
		$TotalDinero=$CapitalDisponible+$CompraActivos;

		if ($TotalDinero==0) {
			$Division=0;
		}
		else{
			$Division=($DineroSocio/$TotalDinero);
		}
		
		//$Accion = $Division; 
		//$Accion= number_format($Accion * 100, 2, ",", ".")." %"; 

		return $Division;
}

//*******************************************************************************************************************

function ResultadoVoto($Proyecto,$SocioVotante)
{
include("conexion.php");
$sql="SELECT voto From T_Proyectos as A, T_votaciones as B where A.Id_proyecto=B.proyecto_id_proyecto and A.Id_proyecto='".$Proyecto."' and Socio_id_socio='".$SocioVotante."'";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Mivoto=$row['voto'];
    }
}
return $Mivoto;
}
//*******************************************************************************************************************

//*******************************************************************************************************************
function dias_transcurridos($fecha_i,$fecha_f)
{
    $dias   = (strtotime($fecha_i)-strtotime($fecha_f))/86400;
    $dias   = abs($dias); $dias = floor($dias);     
    return $dias;
}

function comparar($valor1,$valor2)
{
	
if ($valor1>$valor2) {
		Echo("<i class='fa fa-arrow-circle-up' style='color: green;''> </i>");
							}
	elseif ($valor1<$valor2) {
			Echo("<i class='fa fa-arrow-circle-down' style='color: red;''> </i>");
									}
				else
										{
					Echo("<i class='fa fa-arrow-circle-left' style='color: black;''> </i>");
										}												

}

function ContadorProyectos($EstadoProyecto)
{
    include("conexion.php");
$sql="SELECT count(Id_Proyecto) as CuentaProyecto From T_Proyectos where  Estado_id_estado_proyecto='".$EstadoProyecto."'";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $CuentaProyecto=$row['CuentaProyecto'];
    }
}
$TotalProyectos=(int) $CuentaProyecto;
return $TotalProyectos;
 } 

 ?>


