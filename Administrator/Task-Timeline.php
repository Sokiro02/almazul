<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];

//Validación de Permisos
$sql ="SELECT Editar_TekMaster, Eliminar_TekMaster, Insertar_TekMaster, Ver_TekMaster FROM t_rol_usuario WHERE Id_Rol='".$IdRol."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Val_Editar=$row['Editar_TekMaster'];
        $Val_Eliminar=$row['Eliminar_TekMaster'];
        $Val_Insertar=$row['Insertar_TekMaster'];
        $Val_Ver=$row['Ver_TekMaster'];
 }
}
//Validación de Permisos
?>
<?php 
$sql ="SELECT Horas_Laborales FROM t_config WHERE Desarrollador='TEKSYSTEM S.A.S'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Qr_Horas_Laborales=$row['Horas_Laborales'];
 }
}
?>
<?php

$IdView = $_GET['View'];
$Propietario=$_GET['Propietario'];

if ($IdView!="") {

$sql ="SELECT date_format(Fecha_Asignada,CONCAT(CONCAT(ELT(WEEKDAY(Fecha_Asignada) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(Fecha_Asignada), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS fecha,Id_Tarea, Fecha_Asignada, Titulo, Detalle_Tarea, DIficultad_id_dificultad,Tiempo_Destinado,Usuario_Jefe,Tiempo_Invertido,Estado_Id_Estado_Tarea,Nom_Estado_Tarea,Fecha_Reporte FROM T_Tareas as A, T_Estado_Tarea as B WHERE Cod_Tarea='".$IdView."' and Usuario_id_usuario='".$Propietario."' and A.Estado_Id_Estado_Tarea=B.Id_estado_Tarea";  
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                

    	$Qr_IdRegistro=$row['Id_Tarea'];
        $Qr_Titulo=$row['Titulo'];
        $Qr_Detalle=$row['Detalle_Tarea'];
        $Qr_Fecha=$row['fecha'];
        $Qr_Dificultad=$row['DIficultad_id_dificultad'];
        $Qr_Tiempo=$row['Tiempo_Destinado'];
        $Qr_Fecha_Asignada=$row['Fecha_Asignada'];
        $Qr_EstadoInicial=$row['Estado_Id_Estado_Tarea'];
        $Qr_NomEstadoInicial=$row['Nom_Estado_Tarea'];
        $Qr_Tiempo_Invertido=$row['Tiempo_Invertido'];
        $Qr_Fecha_Reporte=$row['Fecha_Reporte'];
        $Usuario_Jefe=$row['Usuario_Jefe'];
 }
}

}
else
{
	header("location:Task.php");
}

// Insertar Nota en Actividad

$ValNota=$_GET['ValNota'];
if ($ValNota==1) {

date_default_timezone_set("America/Bogota");
$MarcaTemporal = date('Y-m-d H:i:s');

	$MiNota=$_POST['MiNota'];
	$SelEstado=$_POST['SelEstado'];
	$RegistroNota=$_POST['RegistroNota'];
	$UserNota=$_POST['UserNota'];

$sql = "INSERT INTO T_Timeline_Tareas (Tareas_Cod_Tarea, Usuario_id_usuario, Fecha_Timeline, Datos_Timeline) VALUES ('".utf8_decode($IdView)."','".utf8_decode($IdUser)."','".utf8_decode($MarcaTemporal)."','".utf8_decode($MiNota)."')";
//echo($sql);
$result = $conexion->query($sql);

$EstadoNotifica=1;
$NotiPublicada=1;
$sql = "INSERT INTO t_notificaciones (Not_Cod_Tarea, Usuario_Envia, Usuario_Recibe, Datos_Notifica, Fecha_Notifica, Estado_Notifica, Publicado) VALUES ('".utf8_decode($IdView)."','".utf8_decode($IdUser)."','".utf8_decode($UserNota)."','".utf8_decode($MiNota)."','".utf8_decode($MarcaTemporal)."','".utf8_decode($EstadoNotifica)."','".utf8_decode($NotiPublicada)."')";
//echo($sql);
$result = $conexion->query($sql);


// Acá toca enviar el idregistro

$sql ="UPDATE T_Tareas SET Estado_Id_Estado_Tarea='".utf8_decode($SelEstado)."' WHERE Id_Tarea='".$RegistroNota."'";  
//echo($sql);
$result = $conexion->query($sql);


$Valida=header("location:Task-Timeline.php?View=".$IdView."&Mensaje=1&Propietario=".$Propietario."");


}
// Fin Insertar Nota



// Aceptar Actividad

$AceptoActividad=$_GET['AceptoActividad'];
if ($AceptoActividad==1) {

date_default_timezone_set("America/Bogota");
$MarcaTemporal = date('Y-m-d H:i:s');

	$MiNotaAcep="Tarea recibida y aceptada";

$sql = "INSERT INTO T_Timeline_Tareas (Tareas_Cod_Tarea, Usuario_id_usuario, Fecha_Timeline, Datos_Timeline) VALUES ('".utf8_decode($IdView)."','".utf8_decode($IdUser)."','".utf8_decode($MarcaTemporal)."','".utf8_decode($MiNotaAcep)."')";
//echo($sql);
$result = $conexion->query($sql);

// Ingreso la notificación 

$EstadoNotifica=1;
$NotiPublicada=1;
$UserAcepta=$_GET['UserAcepta'];

$sql = "INSERT INTO t_notificaciones (Not_Cod_Tarea, Usuario_Envia, Usuario_Recibe, Datos_Notifica, Fecha_Notifica, Estado_Notifica, Publicado) VALUES ('".utf8_decode($IdView)."','".utf8_decode($IdUser)."','".utf8_decode($UserAcepta)."','".utf8_decode($MiNotaAcep)."','".utf8_decode($MarcaTemporal)."','".utf8_decode($EstadoNotifica)."','".utf8_decode($NotiPublicada)."')";
//echo($sql);
$result = $conexion->query($sql);


$Enproceso=7;

$sql ="UPDATE T_Tareas SET Estado_Id_Estado_Tarea='".utf8_decode($Enproceso)."' WHERE Cod_Tarea='".$IdView."'";  
//echo($sql);
$result = $conexion->query($sql);

$Valida=header("location:Task-Timeline.php?View=".$IdView."&Mensaje=5&Propietario=".$Propietario."");

}
// Fin Aceptar Actividad


$DeleteNote=$_GET['DeleteNote'];

if ($DeleteNote==1) {

	$NoteDel=$_GET['NoteDel'];

$sql ="DELETE FROM T_Timeline_Tareas WHERE Id_Timeline='".$NoteDel."'";  
$result = $conexion->query($sql);

header("location:Task-Timeline.php?View=".$IdView."&Mensaje=4&Propietario=".$Propietario."");
}

 ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Timeline</title>

		<meta name="description" content="based on widget boxes with 2 different styles" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		 <!-- Notificaciones Push -->
		<script src="https://modasof.com/espejo/assets/js/push.min.js"></script>
		

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="https://modasof.com/espejo/assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="https://modasof.com/espejo/assets/js/ace-extra.min.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="https://modasof.com/espejo/assets/js/html5shiv.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/respond.min.js"></script>
		<![endif]-->
	<!--/Inicio Alertas-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link href="https://modasof.com/espejo/assets/css/sweetalert.css" rel="stylesheet">
    <!-- Custom functions file -->
    <script src="https://modasof.com/espejo/assets/js/functions.js"></script>
    <!-- Sweet Alert Script -->
    <script src="https://modasof.com/espejo/assets/js/sweetalert.min.js"></script>
    <!--/Fin Alertas-->

	</head>

	<body class="skin-1">

	<?php 
  $Valide=$_GET['Mensaje'];

    if ($Valide==2) {
        echo "<script>jQuery(function(){swal(\"¡Lo Sentimos!\", \"Datos Incorrectos\", \"error\");});</script>";
    };
    if ($Valide==1) {
        echo "<script>jQuery(function(){swal(\"¡ Nota Agregada!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==3) {
        echo "<script>jQuery(function(){swal(\"¡ Nota Actualizada!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==4) {
        echo "<script>jQuery(function(){swal(\"¡ Nota Eliminada!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==5) {
        echo "<script>jQuery(function(){swal(\"¡ Actividad Recibida!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==6) {
        echo "<script>jQuery(function(){swal(\"¡ Actividad Terminada!\", \"Con Éxito \", \"success\");});</script>";
    };
    if ($Valide==12) {
        echo "<script>jQuery(function(){swal(\"¡ Rol Actualizado!\", \"Correctamente \", \"success\");});</script>";
    };
     if ($Valide==14) {
        echo "<script>jQuery(function(){swal(\"¡Lo Sentimos Usuario no registrado!\", \"Ponte en contacto con el Web Master: fredy.gonzalez@tekstem.co\", \"error\");});</script>";
    };
 
   ?>

	<?php 
	include("Lib/Alertas.php")
	 ?>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar   responsive                    ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>
				<?php 
	include("Lib/links.php");
	include("Lib/menuleft.php");
?>

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							

							<li>
								<i class="ace-icon fa fa-close home-icon"></i>
								<a class="active" href="Task.php">Cerrar</a>
							</li>
						
						</ul><!-- /.breadcrumb -->

						
					</div>

					<div class="page-content">
				<?php 
					//include("Lib/colors.php");
				?>
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<?php 

$date1 = new DateTime($Qr_Fecha_Asignada);
$date2 = new DateTime("now");
$diff = $date1->diff($date2);

$TotalMinutos=$Qr_Horas_Laborales*60;

// 38 minutes to go [number is variable]
$valhora= ( ($diff->days * $Qr_Horas_Laborales ) * 60 ) + ( $diff->i ) . '';
// passed means if its negative and to go means if its positive
//echo ($diff->invert == 1 ) ? ' passed ' : ' Trasncurridos ';

								 ?>

		<?php 

if ($Qr_EstadoInicial==4) {
	$Bloqueo="style='display: none;'";

$Cal1=round(($Qr_Tiempo_Invertido/$Qr_Tiempo)*100,0);

	if ($Cal1==100) {
		$EstadoFinal="Esperada";
		$Calculo=$Cal1;
		$NotaFinal=$Calculo."%";
		$Califica="3/5";
		$valorEficacia=3;
	}
	else if ($Cal1<=90 ) {
		$EstadoFinal="Excelente";
		$Calculo=(100-$Cal1);
		$NotaFinal="-".$Calculo."%";
		$Califica="5/5";
		$valorEficacia=5;
	}
	else if ($Cal1>90 and $Cal1<=99) {
		$EstadoFinal="Buena";
		$Calculo=(100-$Cal1);
		$NotaFinal="-".$Calculo."%";
		$Califica="4/5";
		$valorEficacia=4;
	}
	else if ($Cal1>=101 and $Cal1<=110) {
		$EstadoFinal="Aceptable";
		$Calculo=($Cal1-100);
		$NotaFinal="+".$Calculo."%";
		$Califica="2/5";
		$valorEficacia=2;
	}
	else if ($Cal1>110 ) {
		$EstadoFinal="Pésima";
		$Calculo=($Cal1-100);
		$NotaFinal="+".$Calculo."%";
		$Califica="1/5";
		$valorEficacia=1;
	}

$date1 = new DateTime($Qr_Fecha_Asignada);
$date2 = new DateTime($Qr_Fecha_Reporte);
$diff = $date1->diff($date2);
// 38 minutes to go [number is variable]
$T=( ($diff->days * 24 ) * 60 ) + ( $diff->i ) . '';
// passed means if its negative and to go means if its positive
//echo ($diff->invert == 1 ) ? ' passed ' : ' to go ';


$Cal2=$T-$Qr_Tiempo_Invertido;

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

$SumaNotas=$valorEficacia+$valorCumplimiento;
$PromedioNota=$SumaNotas/2;

?>
								<div class="col-xs-12 col-sm-6">
									<div class="center">
										<h1>Indicadores Finales: </h1>
										
												
												<span class="btn btn-app btn-lg btn-yellow no-hover">
													<span class="line-height-1 bigger-170"> <?php Echo ($NotaFinal);?> </span>

													<br />
													<span class="line-height-1 smaller-90">Del Tiempo <br>Esperado</span>
												</span>
												<span class="btn btn-app btn-lg btn-primary no-hover">
													<span class="line-height-1 bigger-170"> <?php Echo($Califica); ?> </span>

													<br />
													<span class="line-height-1 smaller-90"> Efectividad <br><?php Echo($EstadoFinal); ?></span>
												</span>
												<span class="btn btn-app btn-lg btn-grey no-hover">
													<span class="line-height-1 bigger-170"> <?php Echo($CalificaCump); ?> </span>
													<br />
													<span class="line-height-1 smaller-70"> Cumplimiento <br><?php Echo($EstadoFinalCump); ?>
													</span>
												</span>
												<span class="btn btn-app btn-lg btn-success no-hover">
													<span class="line-height-1 bigger-170"> <?php Echo($Qr_Dificultad); ?> </span>

													<br />
													<span class="line-height-1 smaller-90"> Grado de<br>Dificultad  </span>
												</span>

												<span class="btn btn-app btn-lg btn-pink no-hover">
													<span class="line-height-1 bigger-170"> <?php Echo round($PromedioNota,2); ?> </span>

													<br />
													<span class="line-height-1 smaller-90"> Calificación <br>Final</span>
												</span>

												

												
												<h1>Actividad Terminada</h1>
												
												<a href="perfil.php?Propietario=<?php Echo($Propietario); ?>"><h5>Ver Perfil</h5></a>

												
											</div>
								</div>
				<?php
}

 ?>
					<form action="Task-Timeline.php?View=<?php Echo($IdView);?>&ValNota=1&Propietario=<?php Echo($Propietario);?>" method="post" id="validation-form">
								<div class="col-xs-12 col-sm-6" <?php Echo($Bloqueo); ?> >
									<div class="alert alert-danger">
											
												

											<strong>
												
												<?php 
	Echo("Estado de la Actividad:<stron> ".$Qr_NomEstadoInicial."<br>Propietario (s):<br></strong>");
	$sql ="SELECT Nombres,Apellidos FROM T_Tareas as A,t_usuarios as B WHERE Cod_Tarea='".$IdView."' and A.Usuario_id_usuario=B.Id_Usuario";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $NomAsig=$row['Nombres'];
        $ApeAsig=$row['Apellidos'];
        $UserAsignados=$NomAsig." ".$ApeAsig;
        Echo("<stron> ".utf8_encode($UserAsignados)."</strong><br>");
 }
}
	
	

	

												 ?>
											</strong>
										</div>
											<div class="widget-box">
												<div class="widget-header">
													<h4 class="widget-title red">Agregar Nota</h4>

													<div class="widget-toolbar">
														<a href="#" data-action="collapse">
															<i class="ace-icon fa fa-chevron-up"></i>
														</a>
													</div>
												</div>

												<div class="widget-body">
													<div class="widget-main">
														<div>
															<label for="form-field-8">Seleccionar Estado</label>
															<select name="SelEstado">
																<option value="">Seleccionar</option>
																<option value="6">Aplazada</option>
																<option value="7">En curso</option>
																<option value="8">No Iniciada</option>
																<option value="9">Esperando por un Tercero</option>
																
															</select>
														</div>
														<div>
											
															<label for="form-field-8">Descripción</label>

															<textarea  name="MiNota" class="form-control" id="form-field-8" placeholder="Indicar observaciones acerca de la actividad asignada"></textarea>
															<input type="text" name="RegistroNota" value="<?php Echo($Qr_IdRegistro) ?>" style="display: none;">
															<?php 
															if ($IdRol==1) {
															?>
															<input type="text" name="UserNota" value="<?php Echo($Propietario);?>" style="display: none;">
															<?php
															}
															else {
																?>
																<input type="text" name="UserNota" value="<?php Echo($Usuario_Jefe);?>" style="display: none;">
															<?php
															}
															 ?>
															
															
														</div>
														<div>
															<button type="submit" class="btn btn-sm btn-success">
													<i class="ace-icon fa fa-check"></i>
													Guardar Nota
												</button>
														</div>
														
													</div>
												</div>
											</div>
										</div><!-- /.span -->
							</form>




								<div class="col-xs-12 col-sm-6" >
											<div class="widget-box">
												<div class="widget-header">
									<h4 class="widget-title blue">Actividad 
										<?php 
									$VerificaId=$IdView+1300;
									echo utf8_encode($VerificaId); ?>
										: <?php 
									echo utf8_encode($Qr_Titulo) ?></h4>

													<div class="widget-toolbar">
														<a href="#" data-action="collapse">
															<i class="ace-icon fa fa-chevron-up"></i>
														</a>
													</div>
												</div>

												<div class="widget-body">

													<div class="widget-main">
														<div>
															<textarea rows="7"  class="form-control" id="form-field-8" placeholder="Default Text"><?php echo utf8_encode($Qr_Detalle) ?></textarea>

														</div>

														
													</div>
													<div class="col-sm-6 col-sm-6">
															<span>
																<strong>Asignada el:</strong> <i class="fa fa-clock-o"></i> <?php echo($Qr_Fecha_Asignada); ?>
															</span>
															<br>
													<?php 
													if ($Val_Eliminar==1) {
														?>
														<span>
																<strong>Dificultad:</strong> <i class="fa fa-clock-o"></i> <?php echo($Qr_Dificultad); ?>
															</span>
															<br>
															<span>
																<strong>Tiempo Destinado:</strong> <i class="fa fa-clock-o"></i> <?php echo($Qr_Tiempo); ?> Horas
															</span>
														<?php
													}
													 ?>
															
													</div>
													<div class="col-sm-6 col-sm-6">
															<span>
																<strong>Ejecutada el:</strong> <i class="fa fa-clock-o"></i> <?php echo($Qr_Fecha_Reporte); ?>
															</span>
															<br>
													<?php 
													if ($Val_Eliminar==1) {
														?>
															<span>
																<strong>Dificultad:</strong> <i class="fa fa-clock-o"></i> <?php echo($Qr_Dificultad); ?>
															</span>
															<br>
															<span>
																<strong>Tiempo Invertido:</strong> <i class="fa fa-clock-o"></i> <?php echo($Qr_Tiempo_Invertido); ?> Horas
															</span>
													<?php
													}
													 ?>
													</div>
													<?php 
													if ($Qr_EstadoInicial!=4 ) {
	
														?>
														<?php 

														if ($IdRol==1) {
															$Elpropietario=$Propietario;
														}
														else
														{
															$Elpropietario=$Usuario_Jefe;
														}

														 ?>
														<a href="Task-Timeline.php?View=<?php Echo($IdView); ?>&AceptoActividad=1&UserAcepta=<?php Echo($Elpropietario); ?>"><span class="btn btn-success btn-sm pull-right"><i class="fa fa-check" style="font-size: 17px;"> Aceptar Actividad </i></span></a>
														<?php
													}

													 ?>

													 <?php 
													if ($Qr_EstadoInicial!=4 ) {
														?>
														<a  data-toggle="modal" data-target="#modal-form" href="#"><span class="btn btn-danger btn-sm pull-right"><i class="fa fa-check" style="font-size: 17px;"> Finalizar Actividad </i></span></a>
														<?php
													}
													 ?>
													
													
													

													<!-- Inicio Modal -->
								<div id="modal-form" class="modal" tabindex="-1">
									
							<form action="Task-FinalizarTarea.php?Propietario=<?php Echo($Propietario); ?>" method="post" id="validation-form">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="blue bigger">Finalizar Actividad</h4>
											</div>

											<div class="modal-body">
												<div class="row">
													<div class="col-xs-12 col-sm-6">
														
														<div class="form-group">
															<label class="col-xs-12 col-sm-12" for="form-field-select-3">Por favor indique el tiempo invertido en la Actividad</label>
															<div>
																<h5 class="red"><strong>Recuerde que 1 día equivale a   <?php echo($Qr_Horas_Laborales) ?> Horas Laborales</strong></h5>
															</div>
														</div>
														
													</div>

													<div class="col-xs-12 col-sm-6">
														
														<div class="form-group">
															
															<div>

											<input style="display: none;" type="text" name="TxtActividad" value="<?php Echo($Qr_IdRegistro); ?>">

											<input style="display: none;" type="text" name="TxtHoras" value="<?php Echo($Qr_Horas_Laborales); ?>">
																<select class="chosen-select" name="TxtEdTiempoDia" data-placeholder="Seleccionar...">
																	<option value="">Días</option>
																	<?php
				//$divisor = (int)$Qr_Horas_Laborales;
				$Mes=365;
for($i = 0; $i <= $Mes; $i ++) {
        
        	echo ("<option value='".$i."'>".$i." Días </option>");
       
}
?>
																</select>


															</div>
															<br>
															<div>
																<select class="chosen-select" name="TxtEdTiempoHora" data-placeholder="Seleccionar...">
																	<option value="">Horas</option>
<?php
				$divisor = (int)$Qr_Horas_Laborales;
				//$Mes=60;
for($i = 0; $i < $divisor; $i ++) {
        
        	echo ("<option value='".$i."'>".$i." Horas </option>");
       
}
?>
																</select>

																
															</div>
															<br>
															<div>
																<select class="chosen-select" name="TxtEdTiempoMinuto" data-placeholder="Seleccionar...">
																	<option value="">Minutos</option>
<?php
				//$divisor = (int)$Qr_Horas_Laborales;
				$Hora=60;
for($i = 0; $i < $Hora; $i ++) {
        
        	echo ("<option value='".$i."'>".$i." Minutos </option>");
       
}
?>
																</select>

																
															</div>

															
														</div>
														
													</div>

												
												</div>
											</div>

											<div class="modal-footer">
												<button class="btn btn-sm" data-dismiss="modal">
													<i class="ace-icon fa fa-times"></i>
													Cancelar
												</button>

												<button class="btn btn-sm btn-primary">
													<i class="ace-icon fa fa-check"></i>
													Guardar
												</button>
											</div>
										</div>
									</div>
									</form>
								</div><!-- PAGE CONTENT ENDS -->

						<!-- FINAL MODAL -->
												</div>

											</div>
										</div><!-- /.span -->


				<?php 
				$EditNote=$_GET['EditNote'];

$sql ="SELECT date_format(Fecha_Timeline,CONCAT(CONCAT(ELT(WEEKDAY(Fecha_Timeline) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(Fecha_Timeline), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS fecha,time(Fecha_Timeline) AS Mihora,Id_Timeline,Tarea_id_tarea, Usuario_id_usuario, Fecha_Timeline, Datos_Timeline,Nombres,Apellidos,Img_Perfil FROM T_Timeline_Tareas as A, t_usuarios as B WHERE Tareas_Cod_Tarea='".$IdView."' and A.Usuario_id_usuario=B.Id_Usuario order by Mihora desc";  
//echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $FechaNota=$row['fecha'];
        $Hora_Timeline=$row['Mihora'];
        $InfoTimeline=$row['Datos_Timeline'];
        $Id_Timeline=$row['Id_Timeline'];
        $Timeline_Nombres=$row['Nombres'];
        $Timeline_Apellidos=$row['Apellidos'];
        $Timeline_Imagen=$row['Img_Perfil'];


?>


								<div id="timeline-<?php Echo($Id_Timeline) ?>">
									<div class="row">
										<div class="col-xs-12 col-sm-10 col-sm-offset-1">
											<div class="timeline-container">
												<div class="timeline-label">
													<span class="label label-primary arrowed-in-right label-lg">
														<b><?php echo($FechaNota); ?></b>
													</span>
												</div>

												<div class="timeline-items">
													<div class="timeline-item clearfix">
														<div class="timeline-info">
															<img alt="Susan't Avatar" src="../administrator/<?php Echo($Timeline_Imagen); ?>" />
															<span class="label label-info label-sm"><?php Echo($Hora_Timeline); ?></span>
														</div>
														<div class="widget-box transparent">
															<div class="widget-header widget-header-small">
																<h5 class="widget-title smaller">
																	<a href="#" class="blue"><?php Echo utf8_encode($Timeline_Nombres." ".$Timeline_Apellidos) ?></a>
																	<!-- <span class="grey">reviewed a product</span> -->
																</h5>
																<span class="widget-toolbar no-border">
																	<i class="ace-icon fa fa-clock-o bigger-110"></i>
																	<?php Echo($Hora_Timeline); ?>
																</span>

																<span class="widget-toolbar">
																	<a href="#" data-action="collapse">
																		<i class="ace-icon fa fa-chevron-up"></i>
																	</a>
																</span>
														</div>

															<div class="widget-body">
																<div class="widget-main">
																	<?php Echo utf8_encode($InfoTimeline); ?>
																	
																	<div class="space-6"></div>

																	<div class="widget-toolbox clearfix">
																		<!-- <div class="pull-left">
																			<i class="ace-icon fa fa-hand-o-right grey bigger-125"></i>
																			<a href="#" class="bigger-110">Click to read &hellip;</a>
																		</div> -->

																		<div class="pull-right action-buttons">
																			<?php 
																			if ($EditNote==1) {
																				?>

																			<a href="Task-Timeline.php?View=<?php echo($IdView);?>&Propietario=<?php echo($Propietario);?>" class="tooltip-success green" data-rel="tooltip" data-placement="top" title="Cancelar Edición">
																				<i class="ace-icon fa fa-close red bigger-130"></i>
																			</a>
																			<?php
																			}
																			 ?>

																			<a href="Task-Timeline.php?View=<?php Echo($IdView);?>&EditNote=1&Propietario=<?php Echo($Propietario);?>">
																				<i class="ace-icon fa fa-pencil blue bigger-125"></i>
																			</a>

																			<?php 
																			if ($Val_Editar==1) {
																				?>
																				<a href="Task-Timeline.php?View=<?php Echo($IdView);?>&DeleteNote=1&NoteDel=<?php Echo($Id_Timeline);?>&Propietario=<?php echo($Propietario);?>">
																				<i class="ace-icon fa fa-trash-o red bigger-125"></i>
																			</a>
																			<?php
																			}
																			 ?>

																			
																		</div>
																	</div>
																</div>
															</div>
							<?php 

							if ($EditNote==1) {
								?>

									<form  action="Task-UpdateNota.php?Propietario=<?php Echo($Propietario); ?>" method="post">
												<div class="widget-body">
									
													<div class="widget-main">
														<div>

												<textarea  name="EditMiNota" class="form-control" id="form-field-8" placeholder="Indicar observaciones acerca de la actividad asignada"><?php Echo utf8_encode($InfoTimeline); ?></textarea>
												<input style="display: none;" type="text" name="IdTimeline" value="<?php Echo($Id_Timeline); ?>">
													<input style="display: none;" type="text" name="IdTareaSel" value="<?php Echo($IdView); ?>">

														</div>
														<div>
														</div>
														
													</div>
													<button type="submit" class="btn btn-sm btn-success">
													<i class="ace-icon fa fa-check"></i>
													Actualizar Nota
												</button>
										
												</div>
									</form>
							<?php
							}
							 ?>
								
											
									
														</div>
													</div>

												</div><!-- /.timeline-items -->
											</div><!-- /.timeline-container -->
										</div>

									</div>
								</div>




	<?php 
		}
	}
 ?>


								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<?php 
	include("Lib/footer.php")
	 ?>
			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="https://modasof.com/espejo/assets/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="https://modasof.com/espejo/assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='https://modasof.com/espejo/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="https://modasof.com/espejo/assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!-- ace scripts -->
		<script src="https://modasof.com/espejo/assets/js/ace-elements.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				$('[data-toggle="buttons"] .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					$('[id*="timeline-"]').addClass('hide');
					$('#timeline-'+which).removeClass('hide');
				});
			});
		</script>
		<script src="https://modasof.com/espejo/assets/js/jquery.validate.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery-additional-methods.min.js"></script>

		
		<!-- inline scripts related to this page -->

		
	<script type="text/javascript">
        $(document).ready(function()
        {
             $("#validation-form").validate({
             	errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
                 rules: {
                     "SelEstado": { required:true },
                     "MiNota": { required:true }, 
                      
                     

                 },
                 messages: {
                     "txtNombre": { required:"Debes incluir al menos un Usuario",},
                    
                 },

                 // submitHandler: function(form){
                 //     alert("Los datos son correctos");
                 // }

             });
        });
    </script>

	</body>
</html>
