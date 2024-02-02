<?php     
    include('miniatura.class.php');      
    $image=new thumbnail($_GET['file']); 
    $image->size($_GET['x'],$_GET['y']); 
    $image->show(); 
?>