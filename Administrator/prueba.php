

<!-- <form method="POST" action="prueba.php">
  <p>
	   <input type="text" name="numero">
	   <input type="submit" value="Convertir">
	</p>
</form> -->
<!-- <embed src="audio.mp3" autostart="true" loop="true" volume="80" width="0" height="0"> -->

	<!-- <audio src="audio.mp3"></audio>
<audio src="audio.mp3" autoplay loop></audio> -->

<?php 
	$variable=1;

	if ($variable==2) {
		?>
	<audio  autoplay controls>
    <source src="audio.mp3" type="audio/ogg" preload="none">
    <source src="audio.mp3" type="audio/mpeg" preload="none">
    <source src="audio.mp3" type="audio/wav" preload="none">
</audio>
		<?php
	}
	else{
		?>
		<audio  controls>
    <source src="audio.mp3" type="audio/ogg" preload="none">
    <source src="audio.mp3" type="audio/mpeg" preload="none">
    <source src="audio.mp3" type="audio/wav" preload="none">
</audio>
		<?php
	}




 ?>

