<?php 
$RolUser=$_SESSION['IdRol'];
$sql ="SELECT Nombres,Id_Usuario, Apellidos,Img_Perfil,Empresa,Cel,Correo,banco,tipo_cuenta,num_cuenta,rol_id_rol FROM t_usuarios as A, t_contacto_usuario AS B, T_Socios as C WHERE A.Id_Usuario=B.Usuario_id_Usuario and  A.Id_Usuario=C.Usuario_id_Usuario and Id_Usuario='".$IdUser."' ";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Nombres=$row['Nombres'];
        // $Qridusuario=$row['Id_Usuario'];
        // $Apellidos=$row['Apellidos'];
         $Img_Perfil=$row['Img_Perfil'];
        // $Empresa=$row['Empresa'];
        // $Cel=$row['Cel'];
        // $Correo=$row['Correo'];
        // $banco=$row['banco'];
        // $tipo_cuenta=$row['tipo_cuenta'];
        // $num_cuenta=$row['num_cuenta'];

    }
}
 ?>
<header>
		<div class="container-fluid custom-container">
			<div class="row no_row row-header">
<div class="brand-be">
	<a href="negocios.php">
		<img class=" be_logo logo-c active"  src="img/logo.png" alt="logo" >
		<img class="logo-c be_logo" src="img/logo-green.png" alt="logo" >
		<img  class="logo-c be_logo" src="img/logo-orang.png" alt="logo" >
		<img class="logo-c be_logo" src="img/logo-red.png" alt="logo">
	</a>
</div>
				<div class="login-header-block">
					<div class="login_block">																	
						<!-- <a class="notofications-popup" href="mensajes.php">
							<i class="fa fa-bell-o"></i>
							<span class="noto-count">2</span>
						</a> -->
						<div class="noto-popup notofications-block">
						<div class="m-close"><i class="fa fa-times"></i></div>
							<div class="noto-label">Tus Notificaciones</div>
							<div class="noto-body">

								<div class="noto-entry">
									<div class="noto-content clearfix">
										<div class="noto-img">	
											<a href="mensajes.php">
												<img src="img/c1.png" alt="" class="be-ava-comment">
											</a>
										</div>
										<div class="noto-text">
											<div class="noto-text-top">
												<span class="noto-name"><a href="mensajes.php">Fredy González</a></span>
												<span class="noto-date"><i class="fa fa-clock-o"></i> May0 27, 2017</span>
											</div>
											<a href="mensajes.php" class="noto-message">Sigue este Negocio</a>
										</div>
									</div>
								</div>
																	
							</div>							
						</div>
						<?php 
$sql ="SELECT count(Id_Mensaje) as CuentaMensajes FROM t_usuarios as A  , T_Mensajes as B where A.Id_Usuario=B.Usuario_id_usuario_de and Usuario_id_usuario_para='".$IdUser."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $CuentaMensajes=$row['CuentaMensajes'];
  
       }
   }
        ?>
						<a class="messages-popup" href="mensajes.php">
							<i class="fa fa-envelope-o"></i>
							<span class="noto-count"><?php Echo utf8_encode($CuentaMensajes); ?></span>
						</a>
						<div class="noto-popup messages-block">
						<div class="m-close"><i class="fa fa-times"></i></div>
							<div class="noto-label">Sus Mensajes <span class="noto-label-links"><a href="Crearmensaje.php">Ver mis Mensajes</a></span></div>
							<div class="noto-body">
							<?php 
$sql ="SELECT Id_Mensaje,Img_Perfil,Nombres, Apellidos, Fecha,Asunto,Mensaje  FROM t_usuarios as A  , T_Mensajes as B where A.Id_Usuario=B.Usuario_id_usuario_de and Usuario_id_usuario_para='".$IdUser."' order by Id_Mensaje DESC";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $ApellidoSocio=$row['Apellidos'];
        $NombreSocio=$row['Nombres'];
        $ImgPerfil=$row['Img_Perfil'];
        $FechaMensaje=$row['Fecha'];
        $ElAsunto=$row['Asunto'];
        $ElMensaje=$row['Mensaje'];

        if ($ElAsunto=="") {
        	echo("<li>No tiene mensajes</li>");
        }
        else
        {
        ?>
								<div class="noto-entry style-2">
									<div class="noto-content clearfix">
										<div class="noto-img">	
											<a href="mensajes.php">
												<img src="Admin/<?php Echo utf8_encode($ImgPerfil); ?>" alt="" class="be-ava-comment">
											</a>
										</div>
										<div class="noto-text">
											<div class="noto-text-top">
												<span class="noto-name"><a href="Crearmensaje.php">Mensaje de: <?php Echo utf8_encode($NombreSocio); ?></a></span>
												<span class="noto-date"><i class="fa fa-clock-o"></i><?php Echo utf8_encode($FechaMensaje) ?></span>
											</div>
											<div class="noto-message"><strong>Asunto:</strong><?php Echo utf8_encode($ElAsunto); ?></div>
										</div>
									</div>
								</div>

							<?php 
						}
					}
				}
							 ?>
								
															
																		
							</div>							
						</div>  

						<div class="be-drop-down login-user-down">
							<img class="login-user" style="width: 30px;height: 30px;" src="Admin/<?php echo($Img_Perfil); ?>" alt="">
							<span class="be-dropdown-content">Hola, <span><?php echo($Nombres); ?></span></span>
							<div class="drop-down-list a-list">
								<a href="misnegocios.php">Mis Proyectos</a>
								<a href="finanzas.php">Finanzas </a>
								<a href="perfil.php">Editar Perfil</a>
								<a href="Logout.php">Salir</a>
							</div>
						</div>																		
					</div>	
				</div>
				<div class="header-menu-block">
					<button class="cmn-toggle-switch cmn-toggle-switch__htx"><span></span></button>
					<ul class="header-menu" id="one">
						<li><a href="negocios.php">Actividad Reciente</a></li>
						<li><a href="misnegocios.php">Portafolio</a></li>
						<!-- <li><a href="search.html">Discover</a>
							<ul>
								<li><a href="search.html">Explore</a></li>
								<li><a href="socios.php">Socios</a></li>
								<li><a href="gallery.html">Negocios</a></li>
							</ul>
						</li> -->
						<li><a href="perfil.php">Perfil</a></li>
						<li><a href="finanzas.php">Reportes</a></li>

						<?php 
						if (isset($RolUser)) {
							if ($RolUser==1) {
								?>
								<li id="ad-work-li"><a id="add-work-btn" class="btn color-1" href="Crearproyecto.php">Agregar Negocio </a></li>

								<?php
							}
							else if ($RolUser==2) {
								?>
								<li id="ad-work-li"><a id="add-work-btn" class="btn color-1" href="perfil.php?Value=1">Aportes - Retiros</a></li>

								<?php

							}

						}
						else
						{
							echo("Error Línea 196");
						}

						 ?>


						
					</ul>
				</div>				
			</div>
		</div>
	</header>