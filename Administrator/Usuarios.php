<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];
include("Lib/seguridad.php");
$seguridad = AgregarLog($IdUser,"Entrada a Usuarios del Sistema","Entrada Principal");

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

$IdDelete = $_GET['Delete'];

$Inactivo=2;

if ($IdDelete!="") {
	$sql ="UPDATE t_usuarios SET Estado_id_estado_usuario='".$Inactivo."' WHERE Id_Usuario='".$IdDelete."'";  
$result = $conexion->query($sql);

header("location:Usuarios.php?Mensaje=19");
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Usuarios</title>

		<meta name="description" content="Common form elements and layouts" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/chosen.min.css" />
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/bootstrap-datepicker3.min.css" />
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/bootstrap-timepicker.min.css" />
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/daterangepicker.min.css" />
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/bootstrap-datetimepicker.min.css" />
		<link rel="stylesheet" href="https://modasof.com/espejo/assets/css/bootstrap-colorpicker.min.css" />

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

    if ($Valide==1) {
        echo "<script>jQuery(function(){swal(\"¡Lo Sentimos!\", \"El archivo ya existe\", \"error\");});</script>";
    };
    if ($Valide==2) {
        echo "<script>jQuery(function(){swal(\"¡Lo Sentimos!\", \"El archivo tiene un peso superior a 5MB.\", \"error\");});</script>";
    };
    if ($Valide==3) {
        echo "<script>jQuery(function(){swal(\"¡Lo Sentimos!\", \"Formatos permitidos JPG, JPEG, PNG & GIF .\", \"error\");});</script>";
    };
    if ($Valide==4) {
        echo "<script>jQuery(function(){swal(\"¡Archivo No Subido!\", \"Verificar Nuevamente\", \"error\");});</script>";
    };
    if ($Valide==5) {
        echo "<script>jQuery(function(){swal(\"¡Archivo No Subido!\", \"última validación\", \"error\");});</script>";
    };
    if ($Valide==6) {
        echo "<script>jQuery(function(){swal(\"¡ Usuario Creado!\", \"Correctamente\", \"success\");});</script>";
    };
    if ($Valide==7) {
        echo "<script>jQuery(function(){swal(\"¡ Error!\", \"No se borro el documento\", \"success\");});</script>";
    };
    if ($Valide==8) {
        echo "<script>jQuery(function(){swal(\"¡ Soporte Eliminado!\", \"Correctamente\", \"success\");});</script>";
    };
    if ($Valide==18) {
        echo "<script>jQuery(function(){swal(\"¡ Usuario Editado!\", \"Correctamente\", \"success\");});</script>";
    };
    if ($Valide==19) {
        echo "<script>jQuery(function(){swal(\"¡ Usuario Eliminado!\", \"Correctamente\", \"success\");});</script>";
    };
    if ($Valide==9) {
        echo "<script>jQuery(function(){swal(\"¡ ERROR !\", \"Del Sistema\", \"success\");});</script>";
    };
    if ($Valide==10) {
        echo "<script>jQuery(function(){swal(\"¡ ERROR !\", \"Este E-mail ya está registrado, recupere su contraseña\", \"error\");});</script>";
    };
     if ($Valide==13) {
        echo "<script>jQuery(function(){swal(\"¡Verifique su E-mail!\", \"Se han enviado el usuario y el pass\", \"success\");});</script>";
    };
    if ($Valide==12) {
        echo "<script>jQuery(function(){swal(\"¡ ERROR !\", \"Verifique sus datos nuevamente\", \"error\");});</script>";
    };
    if ($Valide==14) {
        echo "<script>jQuery(function(){swal(\"¡ LO SENTIMOS !\", \"El E-mail que indica no está registrado. \", \"error\");});</script>";
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
								<a href="index.php">Inicio</a>
							</li>

							<li>
								<a class="active" href="Usuarios.php">Usuarios</a>
							</li>
						
						</ul><!-- /.breadcrumb -->

						
					</div>

					<div class="page-content">
				<?php 
					//include("Lib/colors.php");
				?>
						<div class="row">

						<!-- Incio Formulario Crear Usuario -->
						<!-- Inicio Modal -->
	<?php 
	$New=$_GET['New'];
	if ($New==1) {
	 ?>
<div>
	<form action="Admin-NuevoUsuario.php" id="validation-form" method="post" enctype="multipart/form-data">
									<div class="modal-dialog">
										<div class="modal-content ">
											<div class="modal-header">
												<a href="Usuarios.php" type="button" class="close" data-dismiss="modal">&times;</a>
												<h4 class="black bigger">Nuevo Usuario</h4>
											</div>

											<div class="modal-body">
												<div class="row">
													<div class="col-xs-12 col-sm-6 ">
														<div class="form-group">
																<label for="phone">Nombres:</label>

																<div >
																	<div class="input-group">
																		<span class="input-group-addon">
																			<i class="ace-icon fa fa-user"></i>
																		</span>

																		<input type="text" name="TxtNombreUser" />
																	</div>
																</div>
															</div>
														<div class="form-group">
																<label for="phone">Apellidos:</label>

																<div>
																	<div class="input-group">
																		<span class="input-group-addon">
																			<i class="ace-icon fa fa-user"></i>
																		</span>

																		<input type="text"  name="TxtApellidos" />
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

																		<input type="tel"  name="TxtCelular" class="form-control input-mask-phone" type="text" id="form-field-mask-2"/>
																	</div>
																</div>
															</div>
												
								
													</div>

													<div class="col-xs-12 col-sm-6 ">
														
														<div class="form-group">
															<label for="form-field-select-3">Rol</label>
															<div>
																<select class="chosen-select" name="TxtRol" data-placeholder="Seleccionar...">
																	<option value="">Seleccionar</option>
																	<?php
$sql ="SELECT Id_Rol, Nombre_Rol FROM t_rol_usuario";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
    	$SelectIdRol=$row['Id_Rol'];
    	$SelectNombreRol=$row['Nombre_Rol'];             
    	echo ("<option value='".$SelectIdRol."'>".$SelectNombreRol."</option>");
 }
}
            
?>
																</select>
															</div>
														</div>
														<div class="form-group">
																<label for="phone">E-mail:</label>

																<div >
																	<div class="input-group">
																		<span class="input-group-addon">
																			<i class="ace-icon fa fa-envelope"></i>
																		</span>

																		<input type="email"  name="TxtCorreo" />
																	</div>
																</div>
															</div>
														<div class="form-group">
																<label for="phone">Password:</label>

																<div >
																	<div class="input-group">
																		<span class="input-group-addon">
																			<i class="ace-icon fa fa-user"></i>
																		</span>

																		<input type="text"  name="TxtPass" />
																	</div>
																</div>
															</div>
														<div class="space-9"></div>

													</div>

													
												</div>
											</div>

											<div class="modal-footer">
												<a class="btn btn-sm" href="Usuarios.php"> <i class="ace-icon fa fa-times"></i> Cancelar</a>
												
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
						<!-- Final Formulario Crear Usuario -->

<?php 
	}
 ?>
						<!-- Inicio Formulario Editar -->
						<div>
							<!-- Inicio Modal -->
					<?php 
					$EditTask = $_GET['EditTask'];
						if ($EditTask!="") {
					 ?>
								<div id="DivEditar">
						<?php 
	
							$sql ="SELECT Id_Usuario, Nombres, Apellidos, Documento, User_Name, Pass, Empresa, Img_Perfil, Rol_id_Rol, Estado_id_estado_usuario,Correo,cel,tel,Nombre_Rol FROM t_usuarios as A, t_contacto_usuario as B, t_rol_usuario as C WHERE Id_Usuario='".$EditTask."' and A.Id_Usuario=B.Usuario_id_usuario and A.Rol_id_Rol=C.Id_Rol";
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
    					    $Edit_Rol=$row['Rol_id_Rol'];
    					    $Edit_NombreRol=$row['Nombre_Rol'];
    					    	$Edit_Pass=$row['Pass'];
 }
}
						
						 ?>


							<form action="Admin-EditarUsuario.php" method="post" id="FormEditarUsuario">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												
												<h4 class="blue bigger">Editar Usuario</h4>
											</div>

											<div class="modal-body">
												<div class="row">
													<div class="col-xs-12 col-sm-6">
														<div class="form-group">
																<label for="phone">Nombres:</label>

																<div >
																	<div class="input-group">
																		<span class="input-group-addon">
																			<i class="ace-icon fa fa-user"></i>
																		</span>

																	<input type="text" name="TxtEdNombreUser" value="<?php Echo($Edit_Nombres) ;?>" />
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

																		<input type="text"  name="TxtEdApellidos" value="<?php Echo($Edit_Apellidos) ;?>" />
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

																		<input type="tel"  name="TxtEdCelular" value="<?php Echo($Edit_cel) ;?>"/>
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

																		<input type="tel"  name="TxEdtFijo" value="<?php Echo($Edit_tel) ;?>" />
																	</div>
																</div>
															</div>
														
														
													
													</div>

													<div class="col-xs-12 col-sm-6">

														<div class="form-group">
															<label for="form-field-select-3">Rol</label>
															<div>
																<select class="chosen-select" name="TxtEdRol" data-placeholder="Seleccionar...">
																	<option value="<?php Echo($Edit_Rol);?>"><?php Echo($Edit_NombreRol);?></option>
																	<?php
$sql ="SELECT Id_Rol, Nombre_Rol FROM t_rol_usuario";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
    	$SelectIdRol=$row['Id_Rol'];
    	$SelectNombreRol=$row['Nombre_Rol'];             
    	echo ("<option value='".$SelectIdRol."'>".$SelectNombreRol."</option>");
 }
}
            
?>
																</select>
															</div>
														</div>
														<div class="form-group">
																<label for="phone">User Name:</label>

																<div >
																	<div class="input-group">
																		<span class="input-group-addon">
																			<i class="ace-icon fa fa-envelope"></i>
																		</span>

																		<input type="text"  name="TxtEdUserName" value="<?php Echo($Edit_Username);?>" />
																	</div>
																</div>
															</div>
														<div class="form-group">
																<label for="phone">E-mail:</label>

																<div >
																	<div class="input-group">
																		<span class="input-group-addon">
																			<i class="ace-icon fa fa-envelope"></i>
																		</span>

																		<input type="email"  name="TxtEdCorreo" value="<?php Echo($Edit_Correo);?>" />
																	</div>
																</div>
															</div>
														<div class="form-group">
																<label for="phone">Password:</label>

																<div >
																	<div class="input-group">
																		<span class="input-group-addon">
																			<i class="ace-icon fa fa-phone"></i>
																		</span>

																		<input type="text"  name="TxtEdPass" value="<?php Echo($Edit_Pass);?>" />
																	</div>
																</div>
															</div>


														
													</div>
												</div>
											</div>

											<div class="modal-footer">
											<a class="btn btn-sm" href="Usuarios.php"><i class="ace-icon fa fa-times"></i>
													Cancelar</a>
												

												<button class="btn btn-sm btn-primary">
													<i class="ace-icon fa fa-check"></i>
													Actualizar
												</button>
											</div>
										</div>
									</div>
								</div><!-- PAGE CONTENT ENDS -->
						<!-- FINAL MODAL -->
						</div>
					<?php 
				}
					 ?>
						
						<div>

							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
									<!-- <a href="#modal-form" role="button" class="blue" data-toggle="modal"> Form Inside a Modal Box </a> -->
									<?php 
									if ($Val_Insertar==1) {
										?>
		<a href="Usuarios.php?New=1"><span class="btn btn-danger pull-right"><i class="fa fa-plus-square"> Crear Usuario </i></span></a>
										<?php
									}
									 ?>

<div class="space-4"></div>
						<!-- INICIO TABLA -->
						<div class="clearfix">
											<div class="pull-left tableTools-container"></div>
										</div>
										<div class="table-header">
											Lista de Actividades
										</div>
										
										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
											<table style="font-size: 12px;" id="dynamic-table"  class="table table-responsive table-striped table-bordered table-hover" width="100%">
												<thead>
													<tr class="warning">
														<th class="tdcustom" style="width: 5%;">Id</th>
														<th class="tdcustom style="width: 5%;"">Foto</th>
														<th class="tdcustom">Nombres</th>
														<th class="tdcustom">Rol</th>
														
														<th class="tdcustom" style="width: 5%;">User</th>
														<th class="tdcustom" style="width: 5%;">Celular</th>
														<th class="tdcustom" style="width: 5%;">Tel</th>
														<th class="tdcustom" style="width: 5%;">Estado</th>
													
														<th class="tdcustom">Acciones</th>
													</tr>
													<tr>
														<th class="tdcustom" style="width: 5%;">Id</th>
														<th class="tdcustom" style="width: 5%;">Foto</th>
														<th class="tdcustom">Nombres</th>
														<th class="tdcustom">Rol</th>
														
														<th class="tdcustom" style="width: 5%;">User</th>
														<th class="tdcustom" style="width: 5%;">Celular</th>
														<th class="tdcustom" style="width: 5%;">Tel</th>
														<th class="tdcustom" style="width: 5%;">Estado</th>
													
														<th class="tdcustom">Acciones</th>
													</tr>
												</thead>

												<tbody>
<?php 

	$sql ="SELECT Id_Usuario, Nombres, Apellidos, Documento, User_Name, Pass, Img_Perfil,Tel,Cel,Nombre_Rol,Nombre_Estado_Usuario FROM t_usuarios as A, t_rol_usuario as B, t_estado_usuario as C, t_contacto_usuario as D WHERE  A.Rol_id_Rol=B.Id_Rol and A.Estado_id_estado_usuario=C.Id_estado_usuario and A.Id_Usuario=D.Usuario_id_usuario and A.Estado_id_estado_usuario<>2"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Tb_IdUsuario=$row['Id_Usuario'];
        $Tb_NomUsuario=$row['Nombres'];
        $Tb_ApeUsuario=$row['Apellidos'];
        $Tb_Username=$row['User_Name'];
        $Tb_Pass=$row['Pass'];
        $Tb_Fotoperfil=$row['Img_Perfil'];
        $Tb_Tel=$row['Tel'];
        $Tb_Cel=$row['Cel'];
        $Tb_NomRol=$row['Nombre_Rol'];
        $Tb_NomEstado=$row['Nombre_Estado_Usuario'];

													 ?>

													<tr>
														<td>
															<?php echo utf8_encode($Tb_IdUsuario); ?>
														</td>
														<td>
															<img style="width:45px;height:45px;" class="nav-user-photo" src="../Administrator/<?php Echo utf8_encode($Tb_Fotoperfil); ?>" />
														</td>
														<td>
															<a href="Perfil.php?Propietario=<?php echo($Tb_IdUsuario);?>" class="tooltip-primary blue" data-rel="tooltip" data-placement="top" title="Ver Perfil">
																	<?php echo utf8_encode($Tb_NomUsuario." ".$Tb_ApeUsuario); ?>
																</a>

															
														</td>
														<td>
															<?php echo utf8_encode($Tb_NomRol); ?>
														</td>
														<td class="tdcustom"><?php echo utf8_encode($Tb_Username); ?></td>
														<td class="tdcustom"><?php echo utf8_encode($Tb_Cel); ?></td>
														<td class="tdcustom"><?php echo utf8_encode($Tb_Tel); ?></td>
														
														<td class="center">
															<?php echo utf8_encode($Tb_NomEstado); ?>
														</td>
														

														

														<td>
															<div class="hidden-sm hidden-xs action-buttons">
																

															

															 <?php 
															if ($Val_Editar==1) {
																?>
																<a href="Usuarios.php?EditTask=<?php echo($Tb_IdUsuario);?>" class="tooltip-success green" data-rel="tooltip" data-placement="top" title="Editar Usuario">
																	<i class="ace-icon fa fa-pencil bigger-130"></i>
																</a>
															<?php
															}
															 ?>


																

															<?php 
															if ($Val_Eliminar==1) {
																?>
																<a href="Usuarios.php?Delete=<?php echo($Tb_IdUsuario);?>" class="tooltip-error red" data-rel="tooltip" data-placement="top" title="Desvincular Usuario">
																	<i class="ace-icon fa fa-trash-o bigger-130"></i>
																</a>
															<?php
															}
															 ?>

																

															</div>

															<div class="hidden-md hidden-lg">
																<div class="inline pos-rel">
																	<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
																		<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
																	</button>

																	<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
																<li>
																
																		</li>




																		<li>
																			<?php 
															if ($Val_Eliminar==1) {
																?>
																<a href="Usuarios.php?Delete=<?php echo($Tb_IdUsuario);?>" class="tooltip-error red" data-rel="tooltip" title="Desvincular Usuario">
																	<i class="ace-icon fa fa-trash-o bigger-130"></i>
																</a>
															<?php
															}
															 ?>
																		</li>

																		
																	</ul>
																</div>
															</div>
														</td>
													</tr>

													<?php 
													}
}
													 ?>
												</tbody>
											</table>
										</div>

						<!-- FIN TABLA -->

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
		<script src="https://modasof.com/espejo/assets/js/chosen.jquery.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/spinbox.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/bootstrap-datepicker.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/bootstrap-timepicker.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/moment.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/daterangepicker.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/bootstrap-datetimepicker.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/bootstrap-colorpicker.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.knob.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/autosize.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.inputlimiter.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.maskedinput.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/bootstrap-tag.min.js"></script>

		<!-- ace scripts -->
		<script src="https://modasof.com/espejo/assets/js/ace-elements.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/ace.min.js"></script>


		<!-- Inicio scripts Tablas -->
		<!-- page specific plugin scripts -->
		<script src="https://modasof.com/espejo/assets/js/jquery.dataTables.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/dataTables.buttons.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/buttons.flash.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/buttons.html5.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/buttons.print.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/buttons.colVis.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/dataTables.select.min.js"></script>
		
		<script src="https://modasof.com/espejo/assets/js/pdfmake.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/vfs_fonts.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jszip.min.js"></script>
		
		
		<script src="https://modasof.com/espejo/assets/js/jquery.validate.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/jquery-additional-methods.min.js"></script>
		<script src="https://modasof.com/espejo/assets/js/dataTables.responsive.min.js"></script>

		
		<!-- inline scripts related to this page -->

		
	

<script type="text/javascript">
        $(document).ready(function()
        {
             $("#FormUsuario").validate({
             	errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
                 rules: {
                     "TxtNombreUser": { required:true },
                     "TxtApellidos": { required:true }, 
                     "TxtCelular": { required:true }, 
                     "Fotoperfil": { required:true },
                     "TxtRol": { required:true }, 
                     "TxtCorreo": { required:true, email:true },  
                     "TxtPass": { required:true }, 

                 },
                 messages: {
                     "Fotoperfil": { required:"Debes subir una imagen",},
                    	"TxtCorreo": { required:"Por favor incluir un E-mail válido",email: "Por favor incluir un E-mail válido" },
                 },

                 // submitHandler: function(form){
                 //     alert("Los datos son correctos");
                 // }

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

		
		<script type="text/javascript">
			jQuery(function($) {
				//initiate dataTables plugin

				// Setup - add a text input to each header cell
    
// Inicio Script para Filtros con Selects
	// 	 $('#dynamic-table').DataTable( {

    //     initComplete: function () {
    //         this.api().columns([1,2,3]).every( function () {
    //             var column = this;
    //             var select = $('<select><option value="">Filtrar...</option></select>')
    //                 .appendTo( $(column.header()).empty() )
    //                 .on( 'change', function () {
    //                     var val = $.fn.dataTable.util.escapeRegex(
    //                         $(this).val()
    //                     );
    //                     column
    //                         .search( val ? '^'+val+'$' : '', true, false )
    //                         .draw();
    //                 } );
    //                 orderCellsTop: true,
 
    //             column.data().unique().sort().each( function ( d, j ) {
    //                 select.append( '<option value="'+d+'">'+d+'</option>' )
    //             } );
    //         } );
    //     }

// Fin Script  para Filtros con Selects

    // } );
$('#dynamic-table thead tr:eq(1) th').each( function () {
        var title = $('#dynamic-table thead tr:eq(0) th').eq( $(this).index() ).text();
        $(this).html( '<input style="width:100%;border:black solid 1px;" type="text" placeholder="Buscar '+title+'" />' );
    } ); 
  
    var table = $('#dynamic-table').DataTable({
    	"responsive":true,
    	"order": [[ 3, "Asc" ]],
        orderCellsTop: true,
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se ha encontrado nada - Lo sentimos",
            "info": "Mostrar página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
       		 },
			
    "lengthMenu": [[500, 700, 1000, -1], [500, 700, 1000, "All"]],

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

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				$('#id-disable-check').on('click', function() {
					var inp = $('#form-input-readonly').get(0);
					if(inp.hasAttribute('disabled')) {
						inp.setAttribute('readonly' , 'true');
						inp.removeAttribute('disabled');
						inp.value="This text field is readonly!";
					}
					else {
						inp.setAttribute('disabled' , 'disabled');
						inp.removeAttribute('readonly');
						inp.value="This text field is disabled!";
					}
				});
			
			
				if(!ace.vars['touch']) {
					$('.chosen-select').chosen({allow_single_deselect:true}); 
					//resize the chosen on window resize
			
					$(window)
					.off('resize.chosen')
					.on('resize.chosen', function() {
						$('.chosen-select').each(function() {
							 var $this = $(this);
							 $this.next().css({'width': $this.parent().width()});
						})
					}).trigger('resize.chosen');
					//resize chosen on sidebar collapse/expand
					$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
						if(event_name != 'sidebar_collapsed') return;
						$('.chosen-select').each(function() {
							 var $this = $(this);
							 $this.next().css({'width': $this.parent().width()});
						})
					});
			
			
					$('#chosen-multiple-style .btn').on('click', function(e){
						var target = $(this).find('input[type=radio]');
						var which = parseInt(target.val());
						if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
						 else $('#form-field-select-4').removeClass('tag-input-style');
					});
				}
			
			
				$('[data-rel=tooltip]').tooltip({container:'body'});
				$('[data-rel=popover]').popover({container:'body'});
			
				autosize($('textarea[class*=autosize]'));
				
				$('textarea.limited').inputlimiter({
					remText: '%n character%s remaining...',
					limitText: 'max allowed : %n.'
				});
			
				$.mask.definitions['~']='[+-]';
				$('.input-mask-date').mask('99/99/9999');
				$('.input-mask-phone').mask('(999) 999-9999');

				jQuery.validator.addMethod("phone", function (value, element) {
					return this.optional(element) || /^\(\d{3}\) \d{3}\-\d{4}( x\d{1,6})?$/.test(value);
				}, "Ingresar un número válido");

				$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
				$(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});
			
			
			
				$( "#input-size-slider" ).css('width','200px').slider({
					value:1,
					range: "min",
					min: 1,
					max: 8,
					step: 1,
					slide: function( event, ui ) {
						var sizing = ['', 'input-sm', 'input-lg', 'input-mini', 'input-small', 'input-medium', 'input-large', 'input-xlarge', 'input-xxlarge'];
						var val = parseInt(ui.value);
						$('#form-field-4').attr('class', sizing[val]).attr('placeholder', '.'+sizing[val]);
					}
				});
			
				$( "#input-span-slider" ).slider({
					value:1,
					range: "min",
					min: 1,
					max: 12,
					step: 1,
					slide: function( event, ui ) {
						var val = parseInt(ui.value);
						$('#form-field-5').attr('class', 'col-xs-'+val).val('.col-xs-'+val);
					}
				});
			
			
				
				//"jQuery UI Slider"
				//range slider tooltip example
				$( "#slider-range" ).css('height','200px').slider({
					orientation: "vertical",
					range: true,
					min: 0,
					max: 100,
					values: [ 17, 67 ],
					slide: function( event, ui ) {
						var val = ui.values[$(ui.handle).index()-1] + "";
			
						if( !ui.handle.firstChild ) {
							$("<div class='tooltip right in' style='display:none;left:16px;top:-6px;'><div class='tooltip-arrow'></div><div class='tooltip-inner'></div></div>")
							.prependTo(ui.handle);
						}
						$(ui.handle.firstChild).show().children().eq(1).text(val);
					}
				}).find('span.ui-slider-handle').on('blur', function(){
					$(this.firstChild).hide();
				});
				
				
				$( "#slider-range-max" ).slider({
					range: "max",
					min: 1,
					max: 10,
					value: 2
				});
				
				$( "#slider-eq > span" ).css({width:'90%', 'float':'left', margin:'15px'}).each(function() {
					// read initial values from markup and remove that
					var value = parseInt( $( this ).text(), 10 );
					$( this ).empty().slider({
						value: value,
						range: "min",
						animate: true
						
					});
				});
				
				$("#slider-eq > span.ui-slider-purple").slider('disable');//disable third item
			
				
				$('#id-input-file-1 , #Fotoperfil').ace_file_input({
					no_file:'No se ha seleccionado un archivo ...',
					btn_choose:'Seleccionar',
					btn_change:'Cambiar',
					droppable:false,
					onchange:null,
					thumbnail:true, //| true | large
					whitelist:'gif|png|jpg|jpeg',
					blacklist:'exe|php|csv|xls',
					//onchange:''
					//
				});
				//pre-show a file name, for example a previously selected file
				//$('#id-input-file-1').ace_file_input('show_file_list', ['myfile.txt'])
			
			
				$('#id-input-file-3').ace_file_input({
					style: 'well',
					btn_choose: 'Drop files here or click to choose',
					btn_change: null,
					no_icon: 'ace-icon fa fa-cloud-upload',
					droppable: true,
					thumbnail: 'small'//large | fit
					//,icon_remove:null//set null, to hide remove/reset button
					/**,before_change:function(files, dropped) {
						//Check an example below
						//or examples/file-upload.html
						return true;
					}*/
					/**,before_remove : function() {
						return true;
					}*/
					,
					preview_error : function(filename, error_code) {
						//name of the file that failed
						//error_code values
						//1 = 'FILE_LOAD_FAILED',
						//2 = 'IMAGE_LOAD_FAILED',
						//3 = 'THUMBNAIL_FAILED'
						//alert(error_code);
					}
			
				}).on('change', function(){
					//console.log($(this).data('ace_input_files'));
					//console.log($(this).data('ace_input_method'));
				});
				
				
				//$('#id-input-file-3')
				//.ace_file_input('show_file_list', [
					//{type: 'image', name: 'name of image', path: 'http://path/to/image/for/preview'},
					//{type: 'file', name: 'hello.txt'}
				//]);
			
				
				
			
				//dynamically change allowed formats by changing allowExt && allowMime function
				$('#id-file-format').removeAttr('checked').on('change', function() {
					var whitelist_ext, whitelist_mime;
					var btn_choose
					var no_icon
					if(this.checked) {
						btn_choose = "Drop images here or click to choose";
						no_icon = "ace-icon fa fa-picture-o";
			
						whitelist_ext = ["jpeg", "jpg", "png", "gif" , "bmp"];
						whitelist_mime = ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"];
					}
					else {
						btn_choose = "Drop files here or click to choose";
						no_icon = "ace-icon fa fa-cloud-upload";
						
						whitelist_ext = null;//all extensions are acceptable
						whitelist_mime = null;//all mimes are acceptable
					}
					var file_input = $('#id-input-file-3');
					file_input
					.ace_file_input('update_settings',
					{
						'btn_choose': btn_choose,
						'no_icon': no_icon,
						'allowExt': whitelist_ext,
						'allowMime': whitelist_mime
					})
					file_input.ace_file_input('reset_input');
					
					file_input
					.off('file.error.ace')
					.on('file.error.ace', function(e, info) {
						//console.log(info.file_count);//number of selected files
						//console.log(info.invalid_count);//number of invalid files
						//console.log(info.error_list);//a list of errors in the following format
						
						//info.error_count['ext']
						//info.error_count['mime']
						//info.error_count['size']
						
						//info.error_list['ext']  = [list of file names with invalid extension]
						//info.error_list['mime'] = [list of file names with invalid mimetype]
						//info.error_list['size'] = [list of file names with invalid size]
						
						
						/**
						if( !info.dropped ) {
							//perhapse reset file field if files have been selected, and there are invalid files among them
							//when files are dropped, only valid files will be added to our file array
							e.preventDefault();//it will rest input
						}
						*/
						
						
						//if files have been selected (not dropped), you can choose to reset input
						//because browser keeps all selected files anyway and this cannot be changed
						//we can only reset file field to become empty again
						//on any case you still should check files with your server side script
						//because any arbitrary file can be uploaded by user and it's not safe to rely on browser-side measures
					});
					
					
					/**
					file_input
					.off('file.preview.ace')
					.on('file.preview.ace', function(e, info) {
						console.log(info.file.width);
						console.log(info.file.height);
						e.preventDefault();//to prevent preview
					});
					*/
				
				});
			
				$('#spinner1').ace_spinner({value:0,min:0,max:200,step:10, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
				.closest('.ace-spinner')
				.on('changed.fu.spinbox', function(){
					//console.log($('#spinner1').val())
				}); 
				$('#spinner2').ace_spinner({value:0,min:0,max:10000,step:100, touch_spinner: true, icon_up:'ace-icon fa fa-caret-up bigger-110', icon_down:'ace-icon fa fa-caret-down bigger-110'});
				$('#spinner3').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
				$('#spinner4').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus', icon_down:'ace-icon fa fa-minus', btn_up_class:'btn-purple' , btn_down_class:'btn-purple'});
			
				//$('#spinner1').ace_spinner('disable').ace_spinner('value', 11);
				//or
				//$('#spinner1').closest('.ace-spinner').spinner('disable').spinner('enable').spinner('value', 11);//disable, enable or change value
				//$('#spinner1').closest('.ace-spinner').spinner('value', 0);//reset to 0
			
			
				//datepicker plugin
				//link
				$('.date-picker').datepicker({
					autoclose: true,
					todayHighlight: true
				})
				//show datepicker when clicking on the icon
				.next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
			
				//or change it into a date range picker
				$('.input-daterange').datepicker({autoclose:true});
			
			
				//to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
				$('input[name=date-range-picker]').daterangepicker({
					'applyClass' : 'btn-sm btn-success',
					'cancelClass' : 'btn-sm btn-default',
					locale: {
						applyLabel: 'Apply',
						cancelLabel: 'Cancel',
					}
				})
				.prev().on(ace.click_event, function(){
					$(this).next().focus();
				});
			
			
				$('#timepicker1').timepicker({
					minuteStep: 1,
					showSeconds: true,
					showMeridian: false,
					disableFocus: true,
					icons: {
						up: 'fa fa-chevron-up',
						down: 'fa fa-chevron-down'
					}
				}).on('focus', function() {
					$('#timepicker1').timepicker('showWidget');
				}).next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
				
				
			
				
				if(!ace.vars['old_ie']) $('#date-timepicker1').datetimepicker({
					
				 format: 'YYYY-MM-DD H:mm:ss',//use this option to display seconds
				 icons: {
					time: 'fa fa-clock-o',
					date: 'fa fa-calendar',
					up: 'fa fa-chevron-up',
					down: 'fa fa-chevron-down',
					previous: 'fa fa-chevron-left',
					next: 'fa fa-chevron-right',
					today: 'fa fa-arrows ',
					clear: 'fa fa-trash',
					close: 'fa fa-times'
				 }
				}).next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
				
			
				$('#colorpicker1').colorpicker();
				//$('.colorpicker').last().css('z-index', 2000);//if colorpicker is inside a modal, its z-index should be higher than modal'safe
			
				$('#simple-colorpicker-1').ace_colorpicker();
				//$('#simple-colorpicker-1').ace_colorpicker('pick', 2);//select 2nd color
				//$('#simple-colorpicker-1').ace_colorpicker('pick', '#fbe983');//select #fbe983 color
				//var picker = $('#simple-colorpicker-1').data('ace_colorpicker')
				//picker.pick('red', true);//insert the color if it doesn't exist
			
			
				$(".knob").knob();
				
				
				var tag_input = $('#form-field-tags');
				try{
					tag_input.tag(
					  {
						placeholder:tag_input.attr('placeholder'),
						//enable typeahead by specifying the source array
						source: ace.vars['US_STATES'],//defined in ace.js >> ace.enable_search_ahead
						/**
						//or fetch data from database, fetch those that match "query"
						source: function(query, process) {
						  $.ajax({url: 'remote_source.php?q='+encodeURIComponent(query)})
						  .done(function(result_items){
							process(result_items);
						  });
						}
						*/
					  }
					)
			
					//programmatically add/remove a tag
					var $tag_obj = $('#form-field-tags').data('tag');
					$tag_obj.add('Programmatically Added');
					
					var index = $tag_obj.inValues('some tag');
					$tag_obj.remove(index);
				}
				catch(e) {
					//display a textarea for old IE, because it doesn't support this plugin or another one I tried!
					tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
					//autosize($('#form-field-tags'));
				}
				
				
				/////////
				$('#modal-form input[type=file]').ace_file_input({
					style:'well',
					btn_choose:'Drop files here or click to choose',
					btn_change:null,
					no_icon:'ace-icon fa fa-cloud-upload',
					droppable:true,
					thumbnail:'large'
				})
				
				//chosen plugin inside a modal will have a zero width because the select element is originally hidden
				//and its width cannot be determined.
				//so we set the width after modal is show
				$('#modal-form').on('shown.bs.modal', function () {
					if(!ace.vars['touch']) {
						$(this).find('.chosen-container').each(function(){
							$(this).find('a:first-child').css('width' , '210px');
							$(this).find('.chosen-drop').css('width' , '210px');
							$(this).find('.chosen-search input').css('width' , '200px');
						});
					}
				})
				/**
				//or you can activate the chosen plugin after modal is shown
				//this way select element becomes visible with dimensions and chosen works as expected
				$('#modal-form').on('shown', function () {
					$(this).find('.modal-chosen').chosen();
				})
				*/
			
				
				
				$(document).one('ajaxloadstart.page', function(e) {
					autosize.destroy('textarea[class*=autosize]')
					
					$('.limiterBox,.autosizejs').remove();
					$('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
				});
			
			});
		</script>
	</body>
</html>
