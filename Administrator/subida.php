<?php 
if (isset($_FILES['image'])) {
	move_uploaded_file($_FILES['image']['tmp_name'], $_FILES['image']['name']);
}
?>