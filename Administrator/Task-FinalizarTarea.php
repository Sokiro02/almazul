<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];


$TxtActividad=$_POST['TxtActividad'];

$Propietario=$_GET['Propietario'];

$TxtHoras=$_POST['TxtHoras'];

$TxtTiempoDia=$_POST['TxtEdTiempoDia'];

$TxtTiempoHora=$_POST['TxtEdTiempoHora'];

$TxtTiempoMinuto=$_POST['TxtEdTiempoMinuto'];

$TiempoTotal=ConversorTiempo($TxtHoras,$TxtTiempoDia,$TxtTiempoHora,$TxtTiempoMinuto);

//Echo($TiempoTotal);

date_default_timezone_set("America/Bogota");
$MarcaTemporal = date('Y-m-d H:i:s');

$Terminada=4;


$sql ="UPDATE T_Tareas SET Tiempo_Invertido='".utf8_decode($TiempoTotal)."', Fecha_Reporte='".utf8_decode($MarcaTemporal)."', Estado_Id_Estado_Tarea='".utf8_decode($Terminada)."' WHERE Id_Tarea='".$TxtActividad."'";  
			//echo($sql);
			$result = $conexion->query($sql);


///// Verificar Efectividad
$sql ="SELECT  Cod_Tarea,Fecha_Asignada, Tiempo_Destinado,Tiempo_Invertido,Fecha_Reporte FROM T_Tareas WHERE Id_Tarea='".$TxtActividad."'"; 
//echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        
        $Cod_Tarea=$row['Cod_Tarea'];
        $Mifecha=$row['Fecha_Asignada'];
        $Qr_Destinado=$row['Tiempo_Destinado'];
        $Qr_Invertido=$row['Tiempo_Invertido'];
        $Qr_Fecha_Reporte=$row['Fecha_Reporte'];
        $Qr_UsuarioAsignado=$row['Usuario_Id_Usuario'];
        
}
}

$Cal1=round(($Qr_Invertido/$Qr_Destinado)*100,1);

    if ($Cal1==100) {
		$valorEfectividad=3;
	}
	else if ($Cal1<=90 ) {
		$valorEfectividad=5;
	}
	else if ($Cal1>90 and $Cal1<=99) {
		$valorEfectividad=4;
	}
	else if ($Cal1>=101 and $Cal1<=110) {
		$valorEfectividad=2;
	}
	else if ($Cal1>110 ) {
		$valorEfectividad=1;
	}

//// Fin Verificar Efectividad
$date1 = new DateTime($Mifecha);
$date2 = new DateTime($Qr_Fecha_Reporte);
$diff = $date1->diff($date2);
// 38 minutes to go [number is variable]
$T=( ($diff->days * 24 ) * 60 ) + ( $diff->i ) . '';
// passed means if its negative and to go means if its positive
//echo ($diff->invert == 1 ) ? ' passed ' : ' to go ';


$Cal2=$T-$Qr_Invertido;

$MinutosLaborales=$Qr_Horas_Laborales*60;
$Dosdias=$MinutosLaborales*2;
$MedioTiempo=$MinutosLaborales/2;



if ($Cal2==$MinutosLaborales) {
		$EstadoFinalCump="Esperado";
		$CalificaCump="3/5";
		$valorCumplimiento=3;

	}
	else if ($Cal2<=$MedioTiempo ) {
		$EstadoFinalCump="Excelente";
		$CalificaCump="5/5";
		$valorCumplimiento=5;
	}
	else if ($Cal2>$MedioTiempo and $Cal2<=($MinutosLaborales-1)) {
		$EstadoFinalCump="Bueno";
		$CalificaCump="4/5";
		$valorCumplimiento=4;
	}
	else if ($Cal2>$MinutosLaborales and $Cal2<=($Dosdias-1)) {
		$EstadoFinalCump="Aceptable";
		$CalificaCump="2/5";
		$valorCumplimiento=2;
	}
	else if ($Cal2>$Dosdias ) {
		$EstadoFinalCump="Pésimo";
		$CalificaCump="1/5";
		$valorCumplimiento=1;
	}


//Actualizar Notas
	$sql ="UPDATE T_Tareas SET Efectividad_User='".utf8_decode($Cal1)."', Nota_Efectividad='".utf8_decode($valorEfectividad)."', Nota_Cumplimiento='".utf8_decode($valorCumplimiento)."' WHERE Id_Tarea='".$TxtActividad."'";  
			//echo($sql);
			$result = $conexion->query($sql);
// Fin Actualizar Notas

			
	$Valida=header("location:Task-Timeline.php?View=".$Cod_Tarea."&Mensaje=6&Propietario=".$Propietario."");
 ?>