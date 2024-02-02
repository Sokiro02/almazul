<?php
include "../Administrator/Lib/conexion.php";
session_start();
$IdUser = $_SESSION['IdUser'];

if ($IdUser == 58) {

    $sql    = "SELECT * FROM t_usuarios  WHERE Id_Usuario='54'";
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cambiouser=$row['User_Name']; 
        }
    }

  header("location:login.php?cambiouser=".$cambiouser."");

}