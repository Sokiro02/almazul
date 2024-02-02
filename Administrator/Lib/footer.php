<?php 
$sql ="SELECT Footer_App, Url_Web,Url_Facebook,Url_Instagram,Url_Twitter FROM t_config WHERE Desarrollador='TEKSYSTEM S.A.S'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Footer_App=$row['Footer_App'];
        $Url_Web=$row['Url_Web'];
          $Url_Facebook=$row['Url_Facebook'];
          $Url_Instagram=$row['Url_Instagram'];
          $Url_Twitter=$row['Url_Twitter'];
 }
}
?>	
<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<?php echo utf8_encode($Footer_App); ?>
						</span>

						&nbsp; &nbsp;
						<span class="action-buttons">
							<a target="_blank" href="<?php echo $Url_Twitter; ?>">
								<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
							</a>

							<a target="_blank" href="<?php echo $Url_Facebook; ?>">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>

							<a target="_blank" href="<?php echo $Url_Instagram; ?>">
								<i class="ace-icon fa fa-instagram orange bigger-150"></i>
							</a>
							<a target="_blank" href="<?php echo $Url_Web; ?>">
								<i class="ace-icon fa fa-chrome red bigger-150"></i>
							</a>
						</span>
					</div>
				</div>
			</div>