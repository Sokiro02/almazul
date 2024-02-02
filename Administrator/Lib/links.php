<?php 
	if ($IdRol==1) {
	
 ?>
<div class="sidebar-shortcuts" id="sidebar-shortcuts">
	<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
		<a href="balance.php">
			<button class="btn btn-success" title="Informes">
				<i class="ace-icon fa fa-area-chart"></i>
			</button>
        </a>
		<a style="color:white;" href="Usuarios.php">
			<button class="btn btn-warning" title="Usuarios">
			  <i class="ace-icon fa fa-users"></i>
		    </button>
        </a>
		<a style="color:white;" href="config.php">
			<button class="btn btn-danger" title="Configurar">
				<i class="ace-icon fa fa-cogs"></i>
			</button>
		</a>
	</div>
    <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
        <span class="btn btn-success"></span>
        <span class="btn btn-info"></span>
        <span class="btn btn-warning"></span>
        <span class="btn btn-danger"></span>
    </div>
</div><!-- /.sidebar-shortcuts -->
				<?php 
				}
				 ?>