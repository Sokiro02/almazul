<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];
$Propietario=$_GET['Propietario'];
include("Lib/seguridad.php");
$seguridad = AgregarLog($IdUser,"Entrada a Perfil del Usuario","perfil.php");


if ($Propietario=="") {
	$PerfilUser=$IdUser;
}
else{
	$PerfilUser=$Propietario;
}


$IdRol=$_SESSION['IdRol'];

//Validación de Permisos
$sql ="SELECT Actualizar_TekMaster, Editar_TekMaster, Eliminar_TekMaster, Insertar_TekMaster, Ver_TekMaster FROM t_rol_usuario WHERE Id_Rol='".$IdRol."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
    	$Val_Actualizar=$row['Actualizar_TekMaster'];             
        $Val_Editar=$row['Editar_TekMaster'];
        $Val_Eliminar=$row['Eliminar_TekMaster'];
        $Val_Insertar=$row['Insertar_TekMaster'];
        $Val_Ver=$row['Ver_TekMaster'];
 }
}
//Validación de Permisos
?>

<?php 
	
		$sql ="SELECT Id_Usuario, Nombres, Apellidos, Documento, User_Name, Pass, Empresa, Img_Perfil, Rol_id_Rol, Estado_id_estado_usuario,Correo,cel,Tel,Nombre_Rol FROM t_usuarios as A, t_contacto_usuario as B, t_rol_usuario as C WHERE Id_Usuario='".$PerfilUser."' and A.Id_Usuario=B.Usuario_id_usuario and A.Rol_id_Rol=C.Id_Rol";
					$result = $conexion->query($sql);
				if ($result->num_rows > 0) {
   					 while ($row = $result->fetch_assoc()) {  
   					 $Edit_IdUsuario=$row['Id_Usuario'];              
     				   $Edit_Nombres=$row['Nombres'];
      					  $Edit_Apellidos=$row['Apellidos'];
      					  $Edit_Username=$row['User_Name'];
      					  $Edit_Correo=$row['Correo'];
      					  $Edit_tel=$row['Tel'];
      					  $Edit_cel=$row['cel'];
      					  $Edit_img=$row['Img_Perfil'];
    					    $Edit_Rol=$row['Rol_id_Rol'];
    					    $Edit_NombreRol=$row['Nombre_Rol'];
    					    	$Edit_Pass=$row['Pass'];
 }
}

$DeleteNotf=$_GET['NotDelete'];
$DelPropietario=$_GET['Propietario'];

if ($DeleteNotf!="") {

$sql ="DELETE FROM t_notificaciones WHERE Id_Notifica='".$DeleteNotf."'";  
$result = $conexion->query($sql);

header("location:Perfil.php?Propietario=".$DelPropietario."&Mensaje=2&TAB=tabs-2");
}

						 ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Perfil</title>

		<meta name="description" content="3 styles with inline editable feature" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/jquery.gritter.min.css" />
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/select2.min.css" />
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/bootstrap-datepicker3.min.css" />
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/bootstrap-editable.min.css" />

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
        echo "<script>jQuery(function(){swal(\"¡ Perfil Actualizado!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==2) {
        echo "<script>jQuery(function(){swal(\"¡ Notificación Eliminada!\", \"Correctamente \", \"success\");});</script>";
    };
     if ($Valide==4) {
        echo "<script>jQuery(function(){swal(\"¡ Actividad Editada!\", \"Correctamente \", \"success\");});</script>";
    };
     if ($Valide==5) {
        echo "<script>jQuery(function(){swal(\"¡ Actividad Reasignada!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==10) {
        echo "<script>jQuery(function(){swal(\"¡ Avatar Editado!\", \"Correctamente \", \"success\");});</script>";
    };

    if ($Valide==11) {
        echo "<script>jQuery(function(){swal(\"¡ Rol Creado!\", \"Correctamente \", \"success\");});</script>";
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

			<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
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
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="index.php">Home</a>
							</li>

							<li>
								<a href="perfil.php">Mi Perfil</a>
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
						
								<div class="hr dotted"></div>


								<div >
									<div id="user-profile-2" class="user-profile">
										<div class="tabbable" id="tabs">
											<ul class="nav nav-tabs padding-18">
												<li class="active">
													<a data-toggle="tab" href="#tabs-1">
														<i class="green ace-icon fa fa-tachometer bigger-120"></i>
														Indicadores
													</a>
												</li>

												<li>
													<a data-toggle="tab" href="#tabs-2">
														<i class="orange ace-icon fa fa-rss bigger-120"></i>
														Actividad Reciente
													</a>
												</li>

												<li>
													<a data-toggle="tab" href="#tabs-3">
														<i class="blue ace-icon fa fa-users bigger-120"></i>
														Perfil
													</a>
												</li>

												<!-- <li>
													<a data-toggle="tab" href="#pictures">
														<i class="pink ace-icon fa fa-picture-o bigger-120"></i>
														Pictures
													</a>
												</li> -->
											</ul>

											<div class="tab-content no-border padding-24">
												<?php 
												if ($PerfilUser!="") {
													$sql ="SELECT Nombres,Apellidos FROM t_usuarios WHERE Id_Usuario='".$PerfilUser."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
    	$Nom_Propietario=$row['Nombres'];
    	$Ape_Propietario=$row['Apellidos'];             
        Echo utf8_encode("<h2>".$Nom_Propietario." ".$Ape_Propietario."</h2>");
 }
}

												}
									
												 ?>
												<div id="tabs-1" class="tab-pane in active">
													<div class="row">
														<div class="col-xs-12 col-sm-2 center">
															<span class="profile-picture">

																<img class="editable img-responsive" alt="Alex's Avatar" id="avatar2" src="../administrator/<?php Echo($Edit_img); ?>" />
															</span>
																<div class="form-group">
																<label for="name">Cambiar Foto Perfil:</label>
												<form class="form-horizontal" id="FormAvatar" role="form" method="post" action="Admin-EditarAvatar.php" enctype="multipart/form-data">
																<div>
																	<div class="clearfix">
																		<input type="file" name="Fotoperfil" id="Fotoperfil" value="<?php Echo utf8_encode($Edit_img) ;?>" />
																		<input type="text" name="TxtEdIdUsuario" value="<?php Echo($Edit_IdUsuario) ?>" style="display: none;">
																	</div>
																</div>
																<div>
																	<button class="btn btn-success btn-sm">Cambiar Avatar</button>
																</div>
													</form>
														</div>

															<div class="space space-4"></div>

															
															
														</div><!-- /.col -->

														<div class="col-xs-12 col-sm-10">
															<div class="col-sm-10">
									
										<div class="row">
											<div class="col-xs-12 col-sm-4">

											<?php 
											for ($i=1; $i<11 ; $i++) { 
												?>
												

												 <?php 
												 $TotalActividades=ContadorTareas($i,$PerfilUser);
												 if ($TotalActividades==0) {
												 }
												 else
												 {
												 $Finalizada=4;
												
												$TotalTerminadas=ContadorTerminadas($Finalizada,$PerfilUser);
												if ($TotalTerminadas==0) {
												
												}
												else
												{
												$SumaActividades=(int)$TotalTerminadas+(int)$TotalActividades;
												$PorcentaPendientes=($TotalActividades/$SumaActividades)*100;
												$PorcentaTerminadas=($TotalTerminadas/$SumaActividades)*100;
												}
												 	?>
												 	<h5><span><strong>Dificultad <?php Echo($i) ?> : <?php Echo(ContadorTareas($i,$PerfilUser)) ?> Act.</strong></span></h5>
												 	<div class="progress progress-striped">
												 		
													<div class="progress-bar progress-bar-success" style="width:<?php Echo round($PorcentaTerminadas,0);?>%"><?php Echo round($PorcentaTerminadas,0)?>%</div>
													

													<div class="progress-bar progress-bar-danger" style="width: <?php Echo round($PorcentaPendientes,0);?>%"><?php Echo round($PorcentaPendientes,0) ?>%</div>
												</div>
												
												 	<?php
												 }

												  ?>

											<?php
											}
											 ?>
											

												
											</div><!-- /.col -->

											<div class="col-xs-12 col-sm-8 center">

												<div class="clearfix">
										<?php 
													$sql ="SELECT AVG(Tiempo_Invertido) AS PromTiempo FROM T_Tareas WHERE Usuario_Id_Usuario='".$PerfilUser."'AND Estado_Id_Estado_Tarea='4'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
    	$PromTiempo=$row['PromTiempo'];
 }
}
 ?>
 <?php 
$sql ="SELECT AVG(Nota_Cumplimiento) AS NotaCumplimiento,AVG(Nota_Efectividad) as PromEfect FROM T_Tareas WHERE Usuario_Id_Usuario='".$PerfilUser."'AND Estado_Id_Estado_Tarea='4'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
    	$NotaCumplimiento=$row['NotaCumplimiento'];
    	$PromEfect=$row['PromEfect'];
    	$SumaNotas=$NotaCumplimiento+$PromEfect;
    	$PromedioFinal=$SumaNotas/2;
 }
}
 ?>
																			<div class="grid3 center">
																				<div class="easy-pie-chart percentage" data-percent="<?php Echo($PromTiempo) ?>" data-color="#CA5952">
																					<span class="percent"><?php Echo($PromTiempo) ?></span>%
																				</div>

																				<div class="space-2"></div>
																				Efectividad
																			</div>

																			<div class="grid3 center">
																				<div class="center easy-pie-chart percentage" data-percent="<?php Echo((int)$NotaCumplimiento*20) ?>" data-color="#0c37b1">

																					<span class="percent"><?php Echo round($NotaCumplimiento,1) ?></span>
																				</div>

																				<div class="space-2"></div>
																				Nota Cumplimiento
																			</div>

																			<div class="grid3 center">
																				<div class="center easy-pie-chart percentage" data-percent="<?php Echo((int)$PromedioFinal*20) ?>" data-color="#9585BF">
																					<span class="percent"><?php Echo round($PromedioFinal,1) ?></span>
																				</div>

																				<div class="space-2"></div>
																				Calificación Prom.
																			</div>
																		</div>
															<div id="Indicadores">
												<div class="col-sm-12">
										<h3 class="header smaller lighter green">Escala de Calificación</h3>

										<p>
											<span class="label label-danger arrowed-in">1 Pésimo</span>
											<span class="label label-info arrowed-in">2 Aceptable</span>
											<span class="label label-warning arrowed-in">3 Esperado</span>
											<span class="label label-success arrowed-in">4 Bueno</span>
											<span class="label label-success arrowed-in">5 Excelente</span>
										</p>
									</div><!-- /.span -->

												<h3>Total Actividades</h3>	
												<?php 
$sql ="SELECT count(Id_Tarea) AS TotalTareas FROM T_Tareas WHERE Usuario_Id_Usuario='".$PerfilUser."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
    	$TotalTareas=$row['TotalTareas'];
 }
}
 ?>		
 <?php 
$sql ="SELECT count(Id_Tarea) AS TotalTareasT FROM T_Tareas WHERE Usuario_Id_Usuario='".$PerfilUser."' and Estado_Id_Estado_Tarea='4'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
    	$TotalTareasT=$row['TotalTareasT'];
 }
}
 ?>		

												<span class="btn btn-app btn-sm btn-primary no-hover">
													<span class="line-height-1 bigger-170"> <?php Echo($TotalTareas); ?> </span>

													<br />
													<span class="line-height-1 smaller-80"> Actividades <br>Asignadas </span>
												</span>
												<span class="btn btn-app btn-sm btn-success no-hover">
													<span class="line-height-1 bigger-170"> <?php Echo($TotalTareasT); ?> </span>

													<br />
													<span class="line-height-1 smaller-80"> Actividades <br> Terminadas </span>
												</span>
												
															</div>
											</div><!-- /.col -->
										</div><!-- /.row -->
									</div><!-- /.col -->
															
												
															
														</div><!-- /.col -->
													</div><!-- /.row -->

												</div><!-- /#home -->

												<div id="tabs-2" class="tab-pane">
													<div class="profile-feed row">
                                                    <table style="font-size: 12px;" id="dynamic-table"  class="table table-responsive table-striped table-bordered table-hover" width="100%">
                    	   <thead>
                    	       <tr class="warning">
                    					<th class="tdcustom" style="width: 2%;">Id</th>
                    					<th class="tdcustom" style="width: 10%;">Fecha</th>
                    					<th class="tdcustom" style="width: 25%;">Acción</th>
                    					<th class="tdcustom" style="width: 15%;">Pagina PHP</th>
                                </tr>
                                <tr>
                    					<th class="tdcustom" style="width: 2%;">Id</th>
                    					<th class="tdcustom" style="width: 10%;">Fecha</th>
                    					<th class="tdcustom" style="width: 25%;">Acción</th>
                    					<th class="tdcustom" style="width: 15%;">Pagina PHP</th>
                                </tr>
                            </thead>
                    		<tbody>
                            <?php
                                $sql="SELECT * FROM t_usuarios_log WHERE Id_Usuario='".$PerfilUser."' ORDER BY fecha DESC LIMIT 500";
                                $result = $conexion->query($sql) ;
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $ID=$row['id'];
                                        $FECHA=$row['fecha'];
                                        $ACCION=$row['accion'];
                                        $OBSERV=$row['observacion'];
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $ID;?>
                                            </td>
                                            <td>
                                                <?php echo $FECHA;?>
                                            </td>
                                            <td>
                                                <?php echo $ACCION;?>
                                            </td>
                                            <td>
                                                <?php echo $OBSERV;?>
                                            </td>
                                        </tr>
                                        <?php  
                                    }
                                }   

                                
                            ?>
                            </tbody>
                            </table>
                            
														<div class="col-sm-6">
															<h3 class="header smaller lighter blue">Notificaciones Enviadas</h3>
										<?php 
$sql ="SELECT Id_Notifica, Not_Cod_Tarea, Usuario_Envia, Usuario_Recibe, Datos_Notifica, Fecha_Notifica, Estado_Notifica, Publicado, Nombres,Apellidos,Img_Perfil FROM t_notificaciones as A, t_usuarios as B WHERE Usuario_Envia='".$PerfilUser."' and A.Usuario_Envia=B.Id_Usuario order by Fecha_Notifica desc";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
    	$Not_Idnotificacion=$row['Id_Notifica'];
    	$Not_Codigo=$row['Not_Cod_Tarea'];
    	$Not_NombreEnvia=$row['Nombres'];
    	$Not_ApellidoEnvia=$row['Apellidos'];
    	$Not_DatosEn=$row['Datos_Notifica'];
    	$Not_Fecha=$row['Fecha_Notifica'];
    	$Not_avatar=$row['Img_Perfil'];

 ?>	

															<div class="profile-activity clearfix">
																<div>
																	<img class="pull-left" alt="Alex Doe's avatar" src="../administrator/<?php Echo utf8_encode($Not_avatar) ?>" />
																	<a class="user" href="#"> <?php Echo utf8_encode($Not_NombreEnvia." ".$Not_ApellidoEnvia) ?> </a>
																	<?php Echo utf8_encode($Not_DatosEn) ?>
																	<br>de
																	<a href="#">Actividad Cod: <?php Echo utf8_encode($Not_Codigo+1300) ?></a>

																	<div class="time">
																		<i class="ace-icon fa fa-clock-o bigger-110"></i>
																		<?php Echo utf8_encode($Not_Fecha) ?>
																	</div>
																</div>

																<div class="tools action-buttons">
															<?php 
															if ($Val_Eliminar==1) {
																?>

																<a href="Perfil.php?Propietario=<?php Echo($Propietario)?>&NotDelete=<?php Echo($Not_Idnotificacion) ?>" class="red">
																		<i class="ace-icon fa fa-times bigger-125"></i>
																</a>

																<?php
															}
															 ?>
																	
																	
																</div>
															</div>
								<?php 

							}
						}
								 ?>
														</div><!-- /.col -->

														<div class="col-sm-6">

															<h3 class="header smaller lighter blue">Notificaciones Recibidas</h3>
							<?php 
$sql ="SELECT Id_Notifica, Not_Cod_Tarea, Usuario_Envia, Usuario_Recibe, Datos_Notifica, Fecha_Notifica, Estado_Notifica, Publicado, Nombres,Apellidos,Img_Perfil FROM t_notificaciones as A, t_usuarios as B WHERE Usuario_Recibe='".$PerfilUser."' and A.Usuario_Envia=B.Id_Usuario order by Fecha_Notifica desc";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
    	$Not_Idnotificacion=$row['Id_Notifica'];
    	$Not_Codigo=$row['Not_Cod_Tarea'];
    	$Not_NombreRe=$row['Nombres'];
    	$Not_ApellidoRe=$row['Apellidos'];
    	$Not_DatosRe=$row['Datos_Notifica'];
    	$Not_FechaRe=$row['Fecha_Notifica'];
    	$Not_avatar=$row['Img_Perfil'];

 ?>	
															<div class="profile-activity clearfix">
																<div>
																	<img class="pull-left" alt="Alex Doe's avatar" src="../administrator/<?php Echo utf8_encode($Not_avatar) ?>" />
																	<a class="user" href="#"> <?php Echo utf8_encode($Not_NombreRe." ".$Not_ApellidoRe) ?> </a>
																	<?php Echo utf8_encode($Not_DatosRe) ?>
																	<br>
																	<a href="#">Actividad Cod: <?php Echo utf8_encode($Not_Codigo+1300) ?></a>

																	<div class="time">
																		<i class="ace-icon fa fa-clock-o bigger-110"></i>
																		<?php Echo utf8_encode($Not_FechaRe) ?>
																	</div>
																</div>

																<div class="tools action-buttons">
																	
																	<?php 
															if ($Val_Eliminar==1) {
																?>

																<a href="Perfil.php?Propietario=<?php Echo($Propietario)?>&NotDelete=<?php Echo($Not_Idnotificacion) ?>" class="red">
																		<i class="ace-icon fa fa-times bigger-125"></i>
																</a>

																<?php
															}
															 ?>q
																</div>
															</div>
													<?php 
												}
											}
													 ?>

															
														</div><!-- /.col -->
													</div><!-- /.row -->

													<div class="space-12"></div>

													
												</div><!-- /#feed -->

												<div id="tabs-3" class="tab-pane">
													
													<div class="hr hr10 hr-double"></div>
			<form class="form-horizontal" id="validation-form" role="form" method="post" action="Admin-EditarPerfil.php" enctype="multipart/form-data">
							<div class="col-xs-12">
					<div class="col-xs-12 col-sm-4">
														<div class="form-group">
																<label for="phone">Nombres:</label>

																<div >
																	<div class="input-group">
																		<span class="input-group-addon">
																			<i class="ace-icon fa fa-user"></i>
																		</span>

																	<input type="text" name="TxtEdNombreUser" value="<?php Echo utf8_encode($Edit_Nombres) ;?>" />
																	<input type="text" name="TxtEdIdUsuario" value="<?php Echo($Edit_IdUsuario) ?>" style="display: none;">
																	</div>
																</div>
															</div>
														<div class="form-group">
																<label for="phone">Apellidos:</label>

																<div >
																	<div class="input-group">
																		<span class="input-group-addon">
																			<i class="ace-icon fa fa-user"></i>
																		</span>

																		<input type="text"  name="TxtEdApellidos" value="<?php Echo utf8_encode($Edit_Apellidos) ;?>" />
																	</div>
																</div>
															</div>
														
														<div class="form-group">
																<label for="phone">Celular:</label>

																<div >
																	<div class="input-group">
																		<span class="input-group-addon">
																			<i class="ace-icon fa fa-phone"></i>
																		</span>

																		<input type="tel"  name="TxtEdCelular" value="<?php Echo utf8_encode($Edit_cel) ;?>"/>
																	</div>
																</div>
															</div>
														<div class="form-group">
																<label for="phone">Número Fijo:</label>

																<div >
																	<div class="input-group">
																		<span class="input-group-addon">
																			<i class="ace-icon fa fa-phone"></i>
																		</span>

																		<input type="tel"  name="TxEdtFijo" value="<?php Echo utf8_encode($Edit_tel);?>" />
																	</div>
																</div>
															</div>
														
														
													
													</div>
													<div class="col-xs-12 col-sm-6">

													
														
														<div class="form-group">
																<label for="phone">E-mail:</label>

																<div >
																	<div class="input-group">
																		<span class="input-group-addon">
																			<i class="ace-icon fa fa-envelope"></i>
																		</span>

																		<input type="email"  name="TxtEdCorreo" value="<?php Echo utf8_encode($Edit_Correo) ;?>" />
																	</div>
																</div>
														</div>
														<div class="form-group">
																<label for="password">Password Antiguo:</label>

																<div >
																	<div class="input-group">
																		<span class="input-group-addon">
																			<i class="ace-icon fa fa-phone"></i>
																		</span>

																		<input type="text"  name="TxtEdPassA" value="<?php Echo utf8_encode($Edit_Pass) ;?>" readonly="true" />
																	</div>
																</div>
															</div>
														<div class="form-group">
																<label for="password">Nuevo Password:</label>

																<div >
																	<div class="input-group">
																		<span class="input-group-addon">
																			<i class="ace-icon fa fa-phone"></i>
																		</span>

																		<input type="text"  name="TxtEdPass" value="" />
																	</div>
																</div>
															</div>                                                            
														<div class="space-9"></div>
														<div >
											
												<button class="btn btn-sm btn-primary">
													<i class="ace-icon fa fa-check"></i>
													Actualizar Perfil
												</button>
											</div>

</form>
													
												
												</div><!-- /#friends -->

											<?php 
											$hola=1;
											?>

											</div>
										</div>
									</div>
								</div>

								
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

		<!--[if lte IE 8]>
		  <script src="https://modasof.com/espejo/assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="https://modasof.com/espejo/assets/js/jquery-ui.custom.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.gritter.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/bootbox.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.easypiechart.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/bootstrap-datepicker.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.hotkeys.index.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/bootstrap-wysiwyg.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/select2.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/spinbox.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/bootstrap-editable.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/ace-editable.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.maskedinput.min.js"></script>

		<!-- ace scripts -->
		<script src="https://modasof.com/espejo/assets/js/ace-elements.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/ace.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.validate.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery-additional-methods.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.dataTables.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/dataTables.buttons.min.js"></script>

		<?php 
	$TabActive=$_GET['TAB'];
 ?>


<script type="text/javascript">
  function activaTab(tab){
    $('.nav-tabs a[href="#' + tab + '"]').tab('show');
};

activaTab('<?php Echo($TabActive); ?>');

</script>



		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			
				//editables on first profile page
				$.fn.editable.defaults.mode = 'inline';
				$.fn.editableform.loading = "<div class='editableform-loading'><i class='ace-icon fa fa-spinner fa-spin fa-2x light-blue'></i></div>";
			    $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="ace-icon fa fa-check"></i></button>'+
			                                '<button type="button" class="btn editable-cancel"><i class="ace-icon fa fa-times"></i></button>';    
				
				//editables 
				
				//text editable
			    $('#username')
				.editable({
					type: 'text',
					name: 'username'		
			    });
			
			
				
				//select2 editable
				var countries = [];
			    $.each({ "CA": "Canada", "IN": "India", "NL": "Netherlands", "TR": "Turkey", "US": "United States"}, function(k, v) {
			        countries.push({id: k, text: v});
			    });
			
				var cities = [];
				cities["CA"] = [];
				$.each(["Toronto", "Ottawa", "Calgary", "Vancouver"] , function(k, v){
					cities["CA"].push({id: v, text: v});
				});
				cities["IN"] = [];
				$.each(["Delhi", "Mumbai", "Bangalore"] , function(k, v){
					cities["IN"].push({id: v, text: v});
				});
				cities["NL"] = [];
				$.each(["Amsterdam", "Rotterdam", "The Hague"] , function(k, v){
					cities["NL"].push({id: v, text: v});
				});
				cities["TR"] = [];
				$.each(["Ankara", "Istanbul", "Izmir"] , function(k, v){
					cities["TR"].push({id: v, text: v});
				});
				cities["US"] = [];
				$.each(["New York", "Miami", "Los Angeles", "Chicago", "Wysconsin"] , function(k, v){
					cities["US"].push({id: v, text: v});
				});
				
				var currentValue = "NL";
			    $('#country').editable({
					type: 'select2',
					value : 'NL',
					//onblur:'ignore',
			        source: countries,
					select2: {
						'width': 140
					},		
					success: function(response, newValue) {
						if(currentValue == newValue) return;
						currentValue = newValue;
						
						var new_source = (!newValue || newValue == "") ? [] : cities[newValue];
						
						//the destroy method is causing errors in x-editable v1.4.6+
						//it worked fine in v1.4.5
						/**			
						$('#city').editable('destroy').editable({
							type: 'select2',
							source: new_source
						}).editable('setValue', null);
						*/
						
						//so we remove it altogether and create a new element
						var city = $('#city').removeAttr('id').get(0);
						$(city).clone().attr('id', 'city').text('Select City').editable({
							type: 'select2',
							value : null,
							//onblur:'ignore',
							source: new_source,
							select2: {
								'width': 140
							}
						}).insertAfter(city);//insert it after previous instance
						$(city).remove();//remove previous instance
						
					}
			    });
			
				$('#city').editable({
					type: 'select2',
					value : 'Amsterdam',
					//onblur:'ignore',
			        source: cities[currentValue],
					select2: {
						'width': 140
					}
			    });
			
			
				
				//custom date editable
				$('#signup').editable({
					type: 'adate',
					date: {
						//datepicker plugin options
						    format: 'yyyy/mm/dd',
						viewformat: 'yyyy/mm/dd',
						 weekStart: 1
						 
						//,nativeUI: true//if true and browser support input[type=date], native browser control will be used
						//,format: 'yyyy-mm-dd',
						//viewformat: 'yyyy-mm-dd'
					}
				})
			
			    $('#age').editable({
			        type: 'spinner',
					name : 'age',
					spinner : {
						min : 16,
						max : 99,
						step: 1,
						on_sides: true
						//,nativeUI: true//if true and browser support input[type=number], native browser control will be used
					}
				});
				
			
			    $('#login').editable({
			        type: 'slider',
					name : 'login',
					
					slider : {
						 min : 1,
						  max: 50,
						width: 100
						//,nativeUI: true//if true and browser support input[type=range], native browser control will be used
					},
					success: function(response, newValue) {
						if(parseInt(newValue) == 1)
							$(this).html(newValue + " hour ago");
						else $(this).html(newValue + " hours ago");
					}
				});
			
				$('#about').editable({
					mode: 'inline',
			        type: 'wysiwyg',
					name : 'about',
			
					wysiwyg : {
						//css : {'max-width':'300px'}
					},
					success: function(response, newValue) {
					}
				});
				
				
				
				// *** editable avatar *** //
				try {//ie8 throws some harmless exceptions, so let's catch'em
			
					//first let's add a fake appendChild method for Image element for browsers that have a problem with this
					//because editable plugin calls appendChild, and it causes errors on IE at unpredicted points
					try {
						document.createElement('IMG').appendChild(document.createElement('B'));
					} catch(e) {
						Image.prototype.appendChild = function(el){}
					}
			
					var last_gritter
					$('#avatar').editable({
						type: 'image',
						name: 'avatar',
						value: null,
						//onblur: 'ignore',  //don't reset or hide editable onblur?!
						image: {
							//specify ace file input plugin's options here
							btn_choose: 'Change Avatar',
							droppable: true,
							maxSize: 110000,//~100Kb
			
							//and a few extra ones here
							name: 'avatar',//put the field name here as well, will be used inside the custom plugin
							on_error : function(error_type) {//on_error function will be called when the selected file has a problem
								if(last_gritter) $.gritter.remove(last_gritter);
								if(error_type == 1) {//file format error
									last_gritter = $.gritter.add({
										title: 'File is not an image!',
										text: 'Please choose a jpg|gif|png image!',
										class_name: 'gritter-error gritter-center'
									});
								} else if(error_type == 2) {//file size rror
									last_gritter = $.gritter.add({
										title: 'File too big!',
										text: 'Image size should not exceed 100Kb!',
										class_name: 'gritter-error gritter-center'
									});
								}
								else {//other error
								}
							},
							on_success : function() {
								$.gritter.removeAll();
							}
						},
					    url: function(params) {
							// ***UPDATE AVATAR HERE*** //
							//for a working upload example you can replace the contents of this function with 
							//examples/profile-avatar-update.js
			
							var deferred = new $.Deferred
			
							var value = $('#avatar').next().find('input[type=hidden]:eq(0)').val();
							if(!value || value.length == 0) {
								deferred.resolve();
								return deferred.promise();
							}
			
			
							//dummy upload
							setTimeout(function(){
								if("FileReader" in window) {
									//for browsers that have a thumbnail of selected image
									var thumb = $('#avatar').next().find('img').data('thumb');
									if(thumb) $('#avatar').get(0).src = thumb;
								}
								
								deferred.resolve({'status':'OK'});
			
								if(last_gritter) $.gritter.remove(last_gritter);
								last_gritter = $.gritter.add({
									title: 'Avatar Updated!',
									text: 'Uploading to server can be easily implemented. A working example is included with the template.',
									class_name: 'gritter-info gritter-center'
								});
								
							 } , parseInt(Math.random() * 800 + 800))
			
							return deferred.promise();
							
							// ***END OF UPDATE AVATAR HERE*** //
						},
						
						success: function(response, newValue) {
						}
					})
				}catch(e) {}
				
				/**
				//let's display edit mode by default?
				var blank_image = true;//somehow you determine if image is initially blank or not, or you just want to display file input at first
				if(blank_image) {
					$('#avatar').editable('show').on('hidden', function(e, reason) {
						if(reason == 'onblur') {
							$('#avatar').editable('show');
							return;
						}
						$('#avatar').off('hidden');
					})
				}
				*/
			
				//another option is using modals
				$('#avatar4').on('click', function(){
					var modal = 
					'<div class="modal fade">\
					  <div class="modal-dialog">\
					   <div class="modal-content">\
						<div class="modal-header">\
							<button type="button" class="close" data-dismiss="modal">&times;</button>\
							<h4 class="blue">Cambiar Imagen</h4>\
						</div>\
						\
						<form  class="no-margin" action="test.php" method="get">\
						 <div class="modal-body">\
							<div class="space-4"></div>\
							<div style="width:75%;margin-left:12%;">\
							<input type="file" name="file-input" />\
							<input type="text" name="prueba" value="<?php Echo($hola); ?>" />\
							</div>\
						 </div>\
						\
						 <div class="modal-footer center">\
							<button type="submit" class="btn btn-sm btn-success"><i class="ace-icon fa fa-check"></i> Cambiar</button>\
							<button type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i> Cancelar</button>\
						 </div>\
						</form>\
					  </div>\
					 </div>\
					</div>';
					
					
					var modal = $(modal);
					modal.modal("show").on("hidden", function(){
						modal.remove();
					});
			
					var working = false;
			
					var form = modal.find('form:eq(0)');
					var file = form.find('input[type=file]').eq(0);
					file.ace_file_input({
						style:'well',
						btn_choose:'Click para cambiar imagen',
						btn_change:null,
						no_icon:'ace-icon fa fa-picture-o',
						thumbnail:'small',
						before_remove: function() {
							//don't remove/reset files while being uploaded
							return !working;
						},
						allowExt: ['jpg', 'jpeg', 'png', 'gif'],
						allowMime: ['image/jpg', 'image/jpeg', 'image/png', 'image/gif']
					});
			
					form.on('submit', function(){
						if(!file.data('ace_input_files')) return false;
						
						file.ace_file_input('disable');
						form.find('button').attr('disabled', 'disabled');
						form.find('.modal-body').append("<div class='center'><i class='ace-icon fa fa-spinner fa-spin bigger-150 orange'></i></div>");
						
						var deferred = new $.Deferred;
						working = true;
						deferred.done(function() {
							form.find('button').removeAttr('disabled');
							form.find('input[type=file]').ace_file_input('enable');
							form.find('.modal-body > :last-child').remove();
							
							modal.modal("hide");
			
							var thumb = file.next().find('img').data('thumb');
							if(thumb) $('#avatar2').get(0).src = thumb;
			
							working = false;
						});
						
						
						setTimeout(function(){
							deferred.resolve();
						} , parseInt(Math.random() * 800 + 800));
			
						return false;
					});
							
				});
			
				
			
				//////////////////////////////
				$('#profile-feed-1').ace_scroll({
					height: '250px',
					mouseWheelLock: true,
					alwaysVisible : true
				});
			
				$('a[ data-original-title]').tooltip();
			
				$('.easy-pie-chart.percentage').each(function(){
				var barColor = $(this).data('color') || '#555';
				var trackColor = '#E2E2E2';
				var size = parseInt($(this).data('size')) || 72;
				$(this).easyPieChart({
					barColor: barColor,
					trackColor: trackColor,
					scaleColor: false,
					lineCap: 'butt',
					lineWidth: parseInt(size/10),
					animate:false,
					size: size
				}).css('color', barColor);
				});
			  
				///////////////////////////////////////////
			
				//right & left position
				//show the user info on right or left depending on its position
				$('#user-profile-2 .memberdiv').on('mouseenter touchstart', function(){
					var $this = $(this);
					var $parent = $this.closest('.tab-pane');
			
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $this.offset();
					var w2 = $this.width();
			
					var place = 'left';
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) place = 'right';
					
					$this.find('.popover').removeClass('right left').addClass(place);
				}).on('click', function(e) {
					e.preventDefault();
				});
			
			
				///////////////////////////////////////////
				$('#user-profile-3')
				.find('input[type=file]').ace_file_input({
					style:'well',
					btn_choose:'Change avatar',
					btn_change:null,
					no_icon:'ace-icon fa fa-picture-o',
					thumbnail:'large',
					droppable:true,
					
					allowExt: ['jpg', 'jpeg', 'png', 'gif'],
					allowMime: ['image/jpg', 'image/jpeg', 'image/png', 'image/gif']
				})
				.end().find('button[type=reset]').on(ace.click_event, function(){
					$('#user-profile-3 input[type=file]').ace_file_input('reset_input');
				})
				.end().find('.date-picker').datepicker().next().on(ace.click_event, function(){
					$(this).prev().focus();
				})
				$('.input-mask-phone').mask('(999) 999-9999');
			
				$('#user-profile-3').find('input[type=file]').ace_file_input('show_file_list', [{type: 'image', name: $('#avatar').attr('src')}]);
			
			
				////////////////////
				//change profile
				$('[data-toggle="buttons"] .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					$('.user-profile').parent().addClass('hide');
					$('#user-profile-'+which).parent().removeClass('hide');
				});
				
				
				
				/////////////////////////////////////
				$(document).one('ajaxloadstart.page', function(e) {
					//in ajax mode, remove remaining elements before leaving page
					try {
						$('.editable').editable('destroy');
					} catch(e) {}
					$('[class*=select2]').remove();
				});
			});
		</script>
		<script type="text/javascript">
        $(document).ready(function()
        {
             $("#FormEditarUsuario").validate({
             	errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
                 rules: {
                     "TxtEdNombreUser": { required:true },
                     "TxtEdApellidos": { required:true }, 
                     "TxtEdCelular": { required:true }, 
                     "TxtEdUserName": { required:true },
                     "TxtEdRol": { required:true }, 
                     "TxtEdCorreo": { required:true, email:true },  
                     "TxtEdPass": { required:true }, 

                 },
                 messages: {
                     
                    	"TxtEdCorreo": { required:"Por favor incluir un E-mail válido",email: "Por favor incluir un E-mail válido" },
                 },

                 // submitHandler: function(form){
                 //     alert("Los datos son correctos");
                 // }

             });
        });
    </script>
    
    <!-- INICIO SCRIPT TABLAS-->
		<script type="text/javascript">
			jQuery(function($) {
				//initiate dataTables plugin
$('#dynamic-table thead tr:eq(1) th').each( function () {
        var title = $('#dynamic-table thead tr:eq(0) th').eq( $(this).index() ).text();
        $(this).html( '<input style="width:100%;border:black solid 1px;" type="text" placeholder="Buscar '+title+'" />' );
    } ); 
  
    var table = $('#dynamic-table').DataTable({

    	"order": [[ 1, "desc" ]],
        orderCellsTop: true,
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se ha encontrado nada - Lo sentimos",
            "info": "Mostrar página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
       		 },
			
    "lengthMenu": [[20, 100, 1000, -1], [50, 100, 1000, "All"]],

					select: {
						style: 'multi'
					},
    });
  
    // Apply the search
    table.columns().every(function (index) {
        $('#dynamic-table thead tr:eq(1) th:eq(' + index + ') input').on('keyup change', function () {
            table.column($(this).parent().index() + ':visible')
                .search(this.value)
                .draw();    
        });
    });

				var myTable = 
				$('#dynamic-table')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.DataTable( {
retrieve: true,					
					"aoColumns": [
					  { "bSortable": false },
					  null, null,null, null,null,null,null,
					  { "bSortable": false }
					],
					"aaSorting": [],
					"scrollX": true,
					
					//"bProcessing": true,
			        //"bServerSide": true,
			        //"sAjaxSource": "http://127.0.0.1/table.php"	,
			
					//,
					
					//"sScrollXInner": "120%",
					//"bScrollCollapse": true,
					//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
					//you may want to wrap the table inside a "div.dataTables_borderWrap" element
			
					//"iDisplayLength": 50

			
			    } );
				
				$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
				
				new $.fn.dataTable.Buttons( myTable, {
					buttons: [
					  {
						"extend": "colvis",
						"text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Ver/Ocultar columnas</span>",
						"className": "btn btn-white btn-primary btn-bold",
						columns: ':gt(0)'
					  },
					  {
						"extend": "copy",
						"text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copiar Tabla</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "csv",
						"text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Exportar a CSV</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {

						"extend": "excelHtml5",
						"text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Exportar a Excel</span>",
						"className": "btn btn-white btn-primary btn-bold"

					  },
					  {

						"extend": "pdf",
						"text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "print",
						"text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Imprimir</span>",
						"className": "btn btn-white btn-primary btn-bold",
						autoPrint: true,
						message: 'Está impresión se produjo desde la App'
					  }		  
					]
				} );
				myTable.buttons().container().appendTo( $('.tableTools-container') );
				
				//style the message box
				var defaultCopyAction = myTable.button(1).action();
				myTable.button(1).action(function (e, dt, button, config) {
					defaultCopyAction(e, dt, button, config);
					$('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
				});
				var defaultColvisAction = myTable.button(0).action();
				myTable.button(0).action(function (e, dt, button, config) {
					
					defaultColvisAction(e, dt, button, config);
					if($('.dt-button-collection > .dropdown-menu').length == 0) {
						$('.dt-button-collection')
						.wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
						.find('a').attr('href', '#').wrap("<li />")
					}
					$('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
				});
			
				////
			
				setTimeout(function() {
					$($('.tableTools-container')).find('a.dt-button').each(function() {
						var div = $(this).find(' > div').first();
						if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
						else $(this).tooltip({container: 'body', title: $(this).text()});
					});
				}, 500);
				
				myTable.on( 'select', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
					}
				} );
				myTable.on( 'deselect', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
					}
				} );
			
			
				/////////////////////////////////
				//table checkboxes
				$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
				
				//select/deselect all rows according to table header checkbox
				$('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$('#dynamic-table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) myTable.row(row).select();
						else  myTable.row(row).deselect();
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(this.checked) myTable.row(row).deselect();
					else myTable.row(row).select();
				});
				$(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
					e.stopImmediatePropagation();
					e.stopPropagation();
					e.preventDefault();
				});
				
				//And for the first simple table, which doesn't have TableTools or dataTables
				//select/deselect all rows according to table header checkbox
				var active_class = 'active';
				$('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$(this).closest('table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
						else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#simple-table').on('click', 'td input[type=checkbox]' , function(){
					var $row = $(this).closest('tr');
					if($row.is('.detail-row ')) return;
					if(this.checked) $row.addClass(active_class);
					else $row.removeClass(active_class);
				});
			
				
			
				/********************************/
				//add tooltip for small view action buttons in dropdown menu
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				
				//tooltip placement on right or left
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
				/***************/
				$('.show-details-btn').on('click', function(e) {
					e.preventDefault();
					$(this).closest('tr').next().toggleClass('open');
					$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
				});
				/***************/
				
				/**
				//add horizontal scrollbars to a simple table
				$('#simple-table').css({'width':'2000px', 'max-width': 'none'}).wrap('<div style="width: 1000px;" />').parent().ace_scroll(
				  {
					horizontal: true,
					styleClass: 'scroll-top scroll-dark scroll-visible',//show the scrollbars on top(default is bottom)
					size: 2000,
					mouseWheelLock: true
				  }
				).css('padding-top', '12px');
				*/
			})
		</script>
		<!-- Final Scripts Tablas -->    
    
    
    <script type="text/javascript">
        $(document).ready(function()
        {
             $("#FormAvatar").validate({
             	errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
                 rules: {
                     "Fotoperfil": { required:true, file:true, },
                    
                 },
                 

                 // submitHandler: function(form){
                 //     alert("Los datos son correctos");
                 // }

             });
        });
    </script>
	</body>
</html>
